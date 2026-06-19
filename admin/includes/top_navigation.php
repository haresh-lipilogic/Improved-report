<div class="hp-topnav">
  <div class="hp-topnav-left">
    <button class="hp-sidebar-toggle" id="sidebarToggle" title="Toggle Sidebar">
      <i class="fa fa-bars"></i>
    </button>
    <div class="hp-topnav-title">
      <i class="fa <?php echo $pageIcon ?? 'fa-bolt'; ?>"></i> <?php echo $pageTitle ?? 'Report'; ?>
    </div>
  </div>
  <div class="hp-topnav-right">
    <div class="hp-user-chip">
      <img src="images/dp.jpg" class="hp-user-avatar" alt="Durgesh Panchal">
      <span>Durgesh Panchal</span>
    </div>
    <span class="hp-date-badge">
      <i class="fa fa-calendar"></i> <?php echo date('d M Y'); ?>
    </span>
  </div>
</div>
