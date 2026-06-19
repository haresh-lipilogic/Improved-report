<?php
error_reporting(0);
require_once dirname(__DIR__) . '/includes/config.php';

$operator = $_GET['operator'] ?? '';
$product  = $_GET['product']  ?? '';

$res_ad = mysqli_query($con, "SELECT * FROM advertiserdb.advertiser ORDER BY advname ASC");
?>
<select name="advertiserid" class="form-control" required>
    <option value="all">All</option>
    <?php while ($row_ad = mysqli_fetch_array($res_ad)): ?>
    <option value="<?php echo htmlspecialchars($row_ad['advertiserid']); ?>">
        <?php echo htmlspecialchars($row_ad['advname']); ?>
    </option>
    <?php endwhile; ?>
</select>
