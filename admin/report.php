<?php
ini_set('max_execution_time', 6000);
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);

// ─── Database ─────────────────────────────────────────────────────────────────
$con    = mysqli_connect("localhost", "root", "") or die(mysqli_error());
$report = 'gamebardb_vodafone_qatar_report';

// ─── Defaults ─────────────────────────────────────────────────────────────────
$count        = 0;
$operator     = $product = $advertiserid = '';
$start_date2  = $end_date2 = '';
$cost         = 0.0;
$revenue      = 0.6;
$rows         = [];
$res_op       = $res_ad = null;
$today        = date('Y-m-d');

// ─── Normalize a DB row into a unified structure ───────────────────────────────
function normalizeRow(array $row, string $fmt, float $cost): array
{
    if ($fmt === 'live') {
        $act     = (int)$row['act'];
        $clicks  = max(1, (int)$row['clicks']);
        $actamnt = (float)$row['actamnt'];
        $renamnt = (float)$row['renamnt'];
        $cbsent  = (int)$row['cbsent'];
        $total   = $actamnt + $renamnt;
        return [
            'date'         => date('d-m-Y', strtotime($row['dt'])),
            'clicks'       => (int)$row['clicks'],
            'uniq'         => (int)$row['uniq'],
            'cg'           => (int)$row['cg'],
            'conv'         => ($act * 100) / $clicks,
            'act'          => $act,
            'actamnt'      => $actamnt,
            'ren'          => (int)$row['ren'],
            'renamnt'      => $renamnt,
            'total_count'  => $act + (int)$row['ren'],
            'total_amount' => $total,
            'churn'        => (int)$row['dct'],
            'low_bal'      => (int)$row['Low'],
            'cbsent'       => $cbsent,
            'cbsent_pct'   => $act > 0 ? ($cbsent * 100) / $act : 0,
            'advcost'      => $cbsent * $cost,
        ];
    }
    // historical format
    $cbsent = (int)$row['cbsent'];
    $total  = (float)$row['totalamount'];
    return [
        'date'         => date('d-m-Y', strtotime($row['Date'])),
        'clicks'       => (int)$row['clicks'],
        'uniq'         => (int)$row['uniq'],
        'cg'           => (int)$row['cg'],
        'conv'         => (float)$row['conversion'],
        'act'          => (int)$row['actcount'],
        'actamnt'      => (float)$row['actamount'],
        'ren'          => (int)$row['renewcount'],
        'renamnt'      => (float)$row['renewamount'],
        'total_count'  => (int)$row['totalcount'],
        'total_amount' => $total,
        'churn'        => (int)$row['churn'],
        'low_bal'      => (int)$row['park'],
        'cbsent'       => $cbsent,
        'cbsent_pct'   => (float)$row['cbsentpercent'],
        'advcost'      => $cbsent * $cost,
    ];
}

// ─── Process form submission ──────────────────────────────────────────────────
if (isset($_POST['submit'])) {
    $count        = 1;
    $operator     = mysqli_real_escape_string($con, $_POST['operator']     ?? '');
    $product      = mysqli_real_escape_string($con, $_POST['product']      ?? '');
    $advertiserid = mysqli_real_escape_string($con, $_POST['advertiserid'] ?? 'all');
    $start_date2  = $_POST['start_date'] ?? date('d-m-Y');
    $end_date2    = $_POST['end_date']   ?? date('d-m-Y');

    $start_dt  = date('Y-m-d 00:00:00', strtotime($start_date2));
    $end_dt    = date('Y-m-d 23:59:59', strtotime($end_date2));
    $start_dt1 = date('Y-m-d', strtotime($start_date2));
    $end_dt1   = date('Y-m-d', strtotime($end_date2));

    // Operator cost
    $r = mysqli_query($con, "SELECT operator_cost FROM `{$report}`.`operatorcost` WHERE operator='{$operator}'");
    if ($r && ($w = mysqli_fetch_assoc($r))) {
        $cost = (float)$w['operator_cost'];
    }

    // Revenue share (default 0.6 if not configured)
    $r = mysqli_query($con, "SELECT revenueshare FROM `{$report}`.`svmobi_revenueshare` WHERE operator='{$operator}'");
    if ($r && ($w = mysqli_fetch_assoc($r))) {
        $revenue = (float)$w['revenueshare'] ?: 0.6;
    }

    // Operator dropdown options for selected product
    $res_op = mysqli_query($con, "SELECT * FROM `{$report}`.mainreportquery
        WHERE product='{$product}' AND mainreport_all IS NOT NULL AND mainreport_all != ''
        ORDER BY operator ASC");

    // Query templates for this product + operator
    $tpl_all = $tpl_adv = '';
    $r = mysqli_query($con, "SELECT mainreport_all, mainreport_advertiser FROM `{$report}`.mainreportquery
        WHERE product='{$product}' AND operator='{$operator}'");
    if ($r && ($w = mysqli_fetch_assoc($r))) {
        $tpl_all = $w['mainreport_all'];
        $tpl_adv = $w['mainreport_advertiser'];
    }

    $adve = ($advertiserid === 'all') ? '0' : $advertiserid;
    $tpl  = ($advertiserid === 'all') ? $tpl_all : $tpl_adv;

    // Advertiser list
    $res_ad = mysqli_query($con, "SELECT * FROM advertiserdb.advertiser ORDER BY advname ASC");

    // ─── Fetch report rows based on date range ────────────────────────────────
    if ($start_dt1 === $today && $end_dt1 === $today) {
        // Today only — run live query
        $q   = str_replace(['[startdate]', '[enddate]', '[advid]'], [$start_dt, $end_dt, $adve], $tpl);
        $res = mysqli_query($con, $q);
        if ($res) {
            while ($row = mysqli_fetch_array($res)) {
                $rows[] = normalizeRow($row, 'live', $cost);
            }
        }

    } elseif ($end_dt1 === $today) {
        // Mixed: historical up to yesterday + live today
        $q_hist = "SELECT * FROM `{$report}`.mainreport
                   WHERE date >= '{$start_dt1}'
                     AND date < SUBDATE('{$end_dt1}', INTERVAL 1 DAY)
                     AND advertiser='{$adve}' AND operator='{$operator}' AND product='{$product}'";
        $r_hist = mysqli_query($con, $q_hist);
        if ($r_hist) {
            while ($row = mysqli_fetch_array($r_hist)) {
                $rows[] = normalizeRow($row, 'historical', $cost);
            }
        }
        $t_start = date('Y-m-d 00:00:00');
        $t_end   = date('Y-m-d 23:59:59');
        $q_live  = str_replace(['[startdate]', '[enddate]', '[advid]'], [$t_start, $t_end, $adve], $tpl);
        $r_live  = mysqli_query($con, $q_live);
        if ($r_live) {
            while ($row = mysqli_fetch_array($r_live)) {
                $rows[] = normalizeRow($row, 'live', $cost);
            }
        }

    } else {
        // Historical only
        $q_hist = "SELECT * FROM `{$report}`.mainreport
                   WHERE date >= '{$start_dt1}'
                     AND date < '{$end_dt1}'
                     AND advertiser='{$adve}' AND operator='{$operator}' AND product='{$product}'";
        $r_hist = mysqli_query($con, $q_hist);
        if ($r_hist) {
            while ($row = mysqli_fetch_array($r_hist)) {
                $rows[] = normalizeRow($row, 'historical', $cost);
            }
        }
    }
}
?>
<?php include("includes/header-hp.php"); ?>
<?php include("includes/sidebar-hp.php"); ?>
<div class="hp-main">
<?php include("includes/top_navigation-hp.php"); ?>
<div class="hp-content">

<!-- ─── Filter Card ─────────────────────────────────────────────────────────── -->
<div class="hp-card hp-filter-card">
    <div class="hp-card-header">
        <h4><i class="fa fa-search"></i> Search Report</h4>
    </div>
    <div class="hp-card-body">
        <form method="post">
            <div class="row">

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">Product</label>
                        <select name="product" id="product" class="form-control">
                            <option value="">-- Select --</option>
                            <?php foreach (['gamebar' => 'Gamebar', 'glambar' => 'Glambar', '11Players' => '11Players', 'Contest' => 'Contest'] as $val => $label): ?>
                                <option value="<?php echo $val; ?>" <?php echo ($product === $val) ? 'selected' : ''; ?>>
                                    <?php echo $label; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">Operator</label>
                        <!-- AJAX-loaded operator (shown after product change) -->
                        <span class="response1" id="f1"<?php echo $count > 0 ? ' style="display:none"' : ''; ?>></span>
                        <!-- PHP-rendered operator (shown after form submit) -->
                        <span id="t1"<?php echo $count == 0 ? ' style="display:none"' : ''; ?>>
                            <select name="operator" id="operator" class="form-control">
                                <?php if ($res_op): while ($r = mysqli_fetch_array($res_op)): ?>
                                    <option value="<?php echo htmlspecialchars($r['operator']); ?>"
                                        <?php echo ($r['operator'] === $operator) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($r['operator']); ?>
                                    </option>
                                <?php endwhile; endif; ?>
                            </select>
                        </span>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">Start Date</label>
                        <input class="birthday form-control" name="start_date" type="text"
                            value="<?php echo $start_date2 ? date('d-m-Y', strtotime($start_date2)) : date('d-m-Y'); ?>">
                    </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">End Date</label>
                        <input class="birthday form-control" name="end_date" type="text"
                            value="<?php echo $end_date2 ? date('d-m-Y', strtotime($end_date2)) : date('d-m-Y'); ?>">
                    </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">Advertiser</label>
                        <!-- AJAX-loaded advertiser (shown after operator change) -->
                        <span class="response" id="f"<?php echo $count > 0 ? ' style="display:none"' : ''; ?>></span>
                        <!-- PHP-rendered advertiser (shown after form submit) -->
                        <span id="t"<?php echo $count == 0 ? ' style="display:none"' : ''; ?>>
                            <select name="advertiserid" class="form-control">
                                <option value="all">All</option>
                                <?php if ($res_ad): while ($r = mysqli_fetch_array($res_ad)): ?>
                                    <option value="<?php echo htmlspecialchars($r['advertiserid']); ?>"
                                        <?php echo ($r['advertiserid'] == $advertiserid) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($r['advname']); ?>
                                    </option>
                                <?php endwhile; endif; ?>
                            </select>
                        </span>
                    </div>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label class="hp-filter-label">&nbsp;</label><br>
                        <button type="submit" name="submit" class="btn btn-success btn-block">
                            <i class="fa fa-search"></i> Submit
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- ─── Results Card ─────────────────────────────────────────────────────────── -->
<?php if ($count > 0): ?>
<div class="hp-card">
    <div class="hp-card-header">
        <h4><i class="fa fa-table"></i> Report Results</h4>
    </div>
    <div class="hp-card-body" style="padding:0; overflow-x:auto;">
        <?php if (!empty($rows)):
            // Pre-compute column totals
            $totals = array_fill_keys(
                ['clicks','uniq','cg','act','actamnt','ren','renamnt','total_count','total_amount','svmobi','churn','low_bal','cbsent','advcost'],
                0
            );
            foreach ($rows as $r) {
                $totals['clicks']       += $r['clicks'];
                $totals['uniq']         += $r['uniq'];
                $totals['cg']           += $r['cg'];
                $totals['act']          += $r['act'];
                $totals['actamnt']      += $r['actamnt'];
                $totals['ren']          += $r['ren'];
                $totals['renamnt']      += $r['renamnt'];
                $totals['total_count']  += $r['total_count'];
                $totals['total_amount'] += $r['total_amount'];
                $totals['svmobi']       += $r['total_amount'] * $revenue;
                $totals['churn']        += $r['churn'];
                $totals['low_bal']      += $r['low_bal'];
                $totals['cbsent']       += $r['cbsent'];
                $totals['advcost']      += $r['advcost'];
            }
        ?>
        <table id="datatable-buttons" class="table table-striped table-bordered" style="min-width:1400px">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clicks</th>
                    <th>With MDN</th>
                    <th>Sent CG</th>
                    <th>Conv %</th>
                    <th>Activation</th>
                    <th>Act. Amount</th>
                    <th>Renewal</th>
                    <th>Ren. Amount</th>
                    <th>Total Count</th>
                    <th>Total Amount</th>
                    <th>SVMobi Revenue</th>
                    <th>Churn</th>
                    <th>Low Bal.</th>
                    <th>CB Sent</th>
                    <th>CB %</th>
                    <th>Adv. Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?php echo $r['date']; ?></td>
                    <td><?php echo number_format($r['clicks']); ?></td>
                    <td><?php echo number_format($r['uniq']); ?></td>
                    <td><?php echo number_format($r['cg']); ?></td>
                    <td><?php echo number_format($r['conv'], 2) . '%'; ?></td>
                    <td><?php echo number_format($r['act']); ?></td>
                    <td><?php echo number_format($r['actamnt']); ?></td>
                    <td><?php echo number_format($r['ren']); ?></td>
                    <td><?php echo number_format($r['renamnt']); ?></td>
                    <td><?php echo number_format($r['total_count']); ?></td>
                    <td><?php echo number_format($r['total_amount']); ?></td>
                    <td><?php echo number_format($r['total_amount'] * $revenue); ?></td>
                    <td><?php echo number_format($r['churn']); ?></td>
                    <td><?php echo number_format($r['low_bal']); ?></td>
                    <td><?php echo number_format($r['cbsent']); ?></td>
                    <td><?php echo number_format($r['cbsent_pct']) . '%'; ?></td>
                    <td><?php echo number_format($r['advcost']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="font-weight:bold; background:#f0f4ff">
                    <td>Total</td>
                    <td><?php echo number_format($totals['clicks']); ?></td>
                    <td><?php echo number_format($totals['uniq']); ?></td>
                    <td><?php echo number_format($totals['cg']); ?></td>
                    <td>—</td>
                    <td><?php echo number_format($totals['act']); ?></td>
                    <td><?php echo number_format($totals['actamnt']); ?></td>
                    <td><?php echo number_format($totals['ren']); ?></td>
                    <td><?php echo number_format($totals['renamnt']); ?></td>
                    <td><?php echo number_format($totals['total_count']); ?></td>
                    <td><?php echo number_format($totals['total_amount']); ?></td>
                    <td><?php echo number_format($totals['svmobi']); ?></td>
                    <td><?php echo number_format($totals['churn']); ?></td>
                    <td><?php echo number_format($totals['low_bal']); ?></td>
                    <td><?php echo number_format($totals['cbsent']); ?></td>
                    <td>—</td>
                    <td><?php echo number_format($totals['advcost']); ?></td>
                </tr>
            </tfoot>
        </table>
        <?php else: ?>
        <div style="padding:60px; text-align:center">
            <i class="fa fa-inbox" style="font-size:48px; color:#e2e8f0; display:block; margin-bottom:16px"></i>
            <p style="color:#a0aec0; margin:0">No records found for the selected filters.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!-- footer.php closes hp-content and hp-main with its opening </div></div> -->
<script>
$(document).ready(function () {
    // Product change → reload operators via AJAX, reset advertiser
    $('#product').change(function () {
        var product = $(this).val();
        $('#t1').hide();
        $('#f1').show().html('');
        $('#t').hide();
        $('#f').show().html('');
        if (!product) return;
        $.get('ajax/findoperatormainreport.php?product=' + product, function (data) {
            $('#f1').html(data);
        });
    });

    // Operator change → reload advertisers via AJAX
    // Uses event delegation so it works on both static and AJAX-loaded operator selects
    $(document).on('change', '[name="operator"]', function () {
        loadAdvertisers();
    });
});

function loadAdvertisers() {
    var operator = $('[name="operator"]:visible').val();
    var product  = $('#product').val();
    if (!operator) return;
    $('#t').hide();
    $('#f').show().html('');
    $.get('ajax/advertisermainreport.php?operator=' + operator + '&product=' + product, function (data) {
        $('#f').html(data);
    });
}
</script>

<?php include("includes/footer.php"); ?>
