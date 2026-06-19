<?php
error_reporting(0);
require_once dirname(__DIR__) . '/includes/config.php';

$product = $_GET['product'] ?? '';

if (strcasecmp($product, 'glambar') === 0) {
    $sql_ad = "select * from gamebardb_vodafone_qatar_report.mainreportquery where product='glambar' and (mainreport_all is not null and mainreport_all !='') order by operator asc";
} elseif (in_array(strtolower($product), ['11players'])) {
    $sql_ad = "select * from gamebardb_vodafone_qatar_report.mainreportquery where product='11Players' and (mainreport_all is not null and mainreport_all !='') order by operator asc";
} elseif (strcasecmp($product, 'contest') === 0) {
    $sql_ad = "select * from gamebardb_vodafone_qatar_report.mainreportquery where product='Contest' and (mainreport_all is not null and mainreport_all !='') order by operator asc";
} else {
    $sql_ad = "select * from gamebardb_vodafone_qatar_report.mainreportquery where product='gamebar' and (mainreport_all is not null and mainreport_all !='') order by operator asc";
}

$res_ad = mysqli_query($con, $sql_ad);
?>
<select name="operator" id="operator" class="form-control" required>
    <option value="all">All</option>
    <?php while ($row_ad = mysqli_fetch_array($res_ad)): ?>
    <option value="<?php echo htmlspecialchars($row_ad['operator']); ?>">
        <?php echo htmlspecialchars($row_ad['operator']); ?>
    </option>
    <?php endwhile; ?>
</select>
