<?php
ini_set('max_execution_time', 6000);
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);

$pageTitle = 'Current Month Performance';
$pageIcon  = 'fa-tachometer';

include("includes/check_session.php");
?>
<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<div class="hp-main">
<?php include("includes/top_navigation.php"); ?>
<div class="hp-content">

<!-- ─── Results Area (auto-loaded via AJAX on page open) ────────────────────── -->
<div id="perf-results">
    <div style="padding:80px;text-align:center">
        <i class="fa fa-refresh" style="font-size:34px;color:#667eea;display:inline-block;animation:hp-spin 0.9s linear infinite"></i>
        <p style="color:#a0aec0;margin-top:14px;font-size:14px">Loading performance data...</p>
    </div>
</div>

</div><!-- /.hp-content -->
</div><!-- /.hp-main -->

<?php include("includes/footer.php"); ?>

<script>
$(document).ready(function () {

    $.ajax({
        url    : 'ajax/handler.php',
        method : 'POST',
        data   : { action: 'performance_data' },
        success: function (html) {
            $('#perf-results').html(html);

            if ($('#perf-table').length) {
                $('#perf-table').DataTable({
                    dom    : 'Bfrtip',
                    buttons: [
                        { extend: 'copy',  className: 'btn-sm' },
                        { extend: 'csv',   className: 'btn-sm' },
                        { extend: 'excel', className: 'btn-sm' },
                        {
                            extend   : 'pdfHtml5',
                            className: 'btn-sm',
                            title    : 'Performance Report | SVMobi',
                            customize: function (doc) {
                                // A3 landscape — 13 columns fit comfortably
                                doc.pageSize = { width: 1190.55, height: 841.89 };
                                doc.pageMargins     = [10, 30, 10, 15];
                                doc.defaultStyle.fontSize         = 7;
                                doc.styles.tableHeader.fontSize   = 7;
                                doc.styles.tableBodyOdd.fontSize  = 7;
                                doc.styles.tableBodyEven.fontSize = 7;
                                doc.content.forEach(function (node) {
                                    if (node.table) {
                                        var cols = node.table.body[0].length;
                                        node.table.widths = [];
                                        for (var i = 0; i < cols; i++) node.table.widths.push('*');
                                    }
                                });
                            }
                        },
                        {
                            extend   : 'print',
                            className: 'btn-sm',
                            customize: function (win) {
                                $(win.document.head).append(
                                    '<style>' +
                                    '@page { size: A3 landscape; margin: 5mm; }' +
                                    'body { margin: 0; font-size: 7pt; }' +
                                    'table { border-collapse: collapse; width: 100% !important; table-layout: fixed; }' +
                                    'table th, table td { font-size: 6pt; padding: 1px 2px; word-break: break-word; }' +
                                    '</style>'
                                );
                            }
                        }
                    ],
                    ordering : false,
                    paging   : false
                });
            }
        },
        error: function () {
            $('#perf-results').html(
                '<div style="padding:40px;text-align:center;color:#e53e3e">' +
                '<i class="fa fa-exclamation-circle" style="font-size:32px;display:block;margin-bottom:10px"></i>' +
                'Failed to load performance data. Please refresh the page.</div>'
            );
        }
    });

});
</script>
