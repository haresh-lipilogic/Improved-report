<?php
include("connection.php");
$sql_admin="select * from admin_tbl where admin_id ='".$_SESSION['aid']."'"; 
$res_admin=mysql_query($sql_admin);
$row_admin=mysql_fetch_array($res_admin);
?>
<body class="nav-md font1">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><img src="images/logo.png"></a>
            </div>

            <div class="clearfix"></div>

		<!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/dp.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                
                <h2>Durgesh Panchal</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
			<br />
			<br />
			<br />

		<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
              <div class="menu_section">
                
                <ul class="nav side-menu">
					<li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
					
					<li><a href="index.php"><i class="fa  fa-file-text-o"></i> Table's Count</a></li>
					<li><a href="import_pub.php"><i class="fa  fa-file-text-o"></i> Import New PubID</a></li>
					<!-- <li><a href="report.php"><i class="fa  fa-file-text-o"></i> Main Report</a></li>
					<li><a><i class="fa fa-file-text-o"></i> Daily Tasks <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						    <li><a href="logfile.php">Logfile</a></li>
							<li><a href="actdct.php"> Activation & Deactivaiton</a></li>
						</ul>
				    </li> 
					<li><a href="partner_tracking_report.php"><i class="fa  fa-file-text-o"></i> Partner Tracking</a></li>		
					<li><a href="pub.php"><i class="fa  fa-file-text-o"></i> PubID wise Report</a></li>
					<li><a href="perform.php"><i class="fa fa-file-text-o"></i> Perform Report</a></li>				   
					<li><a href="trend_report.php"><i class="fa fa-file-text-o"></i> Trend Report</a></li>
					<li><a><i class="fa fa-file-text-o"></i> Download Count <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="download_report.php?product=hotshots">Hotshots</a></li>
						  <li><a href="download_report.php?product=gamezone">Gamezone</a></li>
						</ul>
					</li>
					<li><a><i class="fa fa-file-text-o"></i> Settings <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="pub_setting.php">PubID Setting</a></li>
						 
						</ul>
					</li>
			
			<li><a href="register.php"><i class="fa fa-file-text-o"></i> Advertiser Registration</a></li> -->
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
			
			<!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
		</div>
        </div>