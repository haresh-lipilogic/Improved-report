<?php
//include("connection.php");
//$sql_admin="select * from admin_tbl where admin_id ='".$_SESSION['aid']."'"; 
//$res_admin=mysql_query($sql_admin);
//$row_admin=mysql_fetch_array($res_admin);
?>
<body class="nav-md font1">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="dashboard.php" class="site_title"><img src="images/logo2.png"></a>
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
					
					<li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
					<li><a href="subdash.php"><i class="fa fa-home"></i> Sub-Dashboard</a></li>
					
					
					
					</li>
					<li><a href="report.php"><i class="fa  fa-file-text-o"></i> Main Report</a></li>
					<li><a href="activationreport.php"><i class="fa  fa-file-text-o"></i>Activation Report</a></li>
					<li><a href="perform.php"><i class="fa fa-file-text-o"></i> Perform Report</a></li>
					<li><a href="trend_report.php"><i class="fa fa-file-text-o"></i> Trend Report</a></li>
					<li><a href="last_activityreport.php"><i class="fa  fa-file-text-o"></i> Last_Activity</a></li>
					<li><a href="performance.php"><i class="fa  fa-file-text-o"></i> Last_30 Days </a></li>
					<li><a href="performance2.php"><i class="fa  fa-file-text-o"></i>Current Month performance </a></li>
					<li><a href="urlmake.php"><i class="fa  fa-file-text-o"></i> Advertiser Urls</a></li>
					
					
					
					<li><a><i class="fa fa-file-text-o"></i> Contest <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					<li><a href="contest.php"><i class="fa  fa-file-text-o"></i>Leaderboard </a></li>
					<li><a href="contest_charging.php"><i class="fa  fa-file-text-o"></i>Charging Report</a></li>
					<li><a href="promotion.php"><i class="fa  fa-file-text-o"></i>Promotional Activity</a></li>
					<li><a href="engagement.php"><i class="fa  fa-file-text-o"></i>Engagement Activity</a></li>
					</ul>
					</li>
					
					<li><a><i class="fa fa-file-text-o"></i> API <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					<li><a href="api.php"><i class="fa  fa-file-text-o"></i>API Report</a></li>
					<li><a href="apicharge.php"><i class="fa  fa-file-text-o"></i>API Charging %</a></li>
					</ul>
					</li>
					<li><a><i class="fa fa-file-text-o"></i> Other Reports <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
					<li><a href="actdct.php"><i class="fa  fa-file-text-o"></i>SameDay Churn</a></li>	
					<li><a href="samedaydeactivation.php"><i class="fa  fa-file-text-o"></i>Sameday Churn Percentage Report</a></li>
					
					
					<li><a href="partner_tracking_report.php"><i class="fa  fa-file-text-o"></i>Adnetwork Perfomance</a></li>
					<li><a href="pub.php"><i class="fa  fa-file-text-o"></i> PubID wise Report</a></li>
				
				
				
					<li><a href="activationsetting.php"><i class="fa  fa-file-text-o"></i>Activation Report Setting</a></li>
					<li><a href="callbackssetting.php"><i class="fa  fa-file-text-o"></i> Callback Settings</a></li>
					<li><a href="cron_running_report.php"><i class="fa  fa-file-text-o"></i> Cron_Analysis</a></li>

					<li><a href="currency.php"><i class="fa fa-file-text-o"></i> Currency</a></li>
					<li><a href="callbackreport.php"><i class="fa fa-file-text-o"></i> CallBackSent Report</a></li>
					<li><a href="callbackanalysis.php"><i class="fa fa-file-text-o"></i> CallBackSent Analysis</a></li>
					<li><a href="adduat.php"><i class="fa fa-file-text-o"></i> Add UAT</a></li>
					<li><a href="alluat.php"><i class="fa fa-file-text-o"></i> All UAT</a></li>
					<li><a href="checkactivation.php"><i class="fa fa-file-text-o"></i> Check Crons</a></li>
					
					</ul>
					</li>
					
					<!--	<li><a href="Etisalat_vcode_report.php"><i class="fa  fa-file-text-o"></i>Etisalat_vcode_report</a></li>	
					-->
					<!--<li><a href="logfile.php"><i class="fa  fa-file-text-o"></i>Custmer Logs</a></li>	
					
							
					
									   
					
					<li><a><i class="fa fa-file-text-o"></i> Download Count <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="download_report.php?product=hotshots">Hotshots</a></li>
						  <li><a href="download_report.php?product=gamezone">Gamezone</a></li>
						</ul>
					</li>
					
					
					<li><a><i class="fa fa-file-text-o"></i> Settings <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						  <li><a href="pub_setting.php">PubID Setting</a></li>
						  <li><a href="import_pub.php">Import New PubId</a></li>
						 
						</ul>
					</li>
			
<!--			<li><a href="register.php"><i class="fa fa-file-text-o"></i> Advertiser Registration</a></li> -->
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