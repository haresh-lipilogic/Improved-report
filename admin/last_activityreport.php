<?php
include("includes/check_session.php");
include("includes/connection.php");

//$con1=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error()); //cluster 1
$con1=$con;
//error_reporting(0);


 $sql="select * from gamebardb_vodafone_qatar_report.lastactivity order by id asc";
				//echo $sql;
			
			$res=mysqli_query($con,$sql);


?>

		<?php include("includes/header.php"); ?>
		<?php include("includes/sidebar.php"); ?>
		<?php include("includes/top_navigation.php"); ?>
            

        <!-- page content -->
        <div class="right_col" role="main" >
          <div class="footer_down">          

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>cron_reporting time Report</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                  </div>
                </div>
				
              
              </div>
            </div>
			
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Output Records <small></small></h2>
							<ul class="nav navbar-right panel_toolbox">
							  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							  </li>
							  <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
								  <li><a href="#">Settings 1</a>
								  </li>
								  <li><a href="#">Settings 2</a>
								  </li>
								</ul>
							  </li>
							  <li><a class="close-link"><i class="fa fa-close"></i></a>
							  </li>
							</ul>
							<div class="clearfix"></div>
						</div>
						
			
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							
								<thead>
									<tr>
										<td><strong>ID</strong></td>
										<td><strong>Product</strong></td>
										<td><strong>Operator</strong></td>
										<td><strong>Activation</strong></td>
										<td><strong>Renewal</strong></td>
										<td><strong>CallBackSent</strong></td>
										
										
	
									</tr>
								</thead>


								<tbody>
								<?php
									/*
									if($perc > 15){echo "<span style='color:red;'>".$perc."</span>";}else{echo "<span style='color:green;'>".$perc."</span>";}
									*/
									$date2=date('Y-m-d',strtotime("-1 days"));
									$date2=$date2." 23:59:59";
									while($row=mysqli_fetch_array($res))
									{
										
										$sql1=$row['query'];
										$res1=mysqli_query($con55,$sql1);
										$row1=mysqli_fetch_array($res1);
								?>
								
									<tr>
									<td><?php echo $row['id']; ?></td>
										<td><?php echo $row['product']; ?></td>
										<td><?php echo $row['operator']; ?></td>
										<?php 
										/*
										echo "dd=". $row1['act_date'];
										echo "<br>aa=".date('Y-m-d');
										if($row1['act_date']>date('Y-m-d'))
										{
											echo "hi";
											//exit;
										}
										else{
											echo "hi1";
											//exit;
										}
										*/
										?>
										<td ><?php if($row1['act_date']>date('Y-m-d') && $row1['act_date'] !='' ){?><span style='color:white;font-weight:bold;background:green;padding:5px;'> <?php echo $row1['act_date']; }else{?><span style='color:white;font-weight:bold;background:red;padding:5px;'> <?php echo $row1['act_date']; }?></span></td>
										<td><?php if($row1['ren_date']>date('Y-m-d') && $row1['ren_date'] !='' ){?><span style='color:white;font-weight:bold;background:green;padding:5px;'> <?php echo $row1['ren_date']; }else{?><span style='color:white;font-weight:bold;background:red;padding:5px;'> <?php echo $row1['ren_date']; }?></span></td>
										<td><?php if($row1['cb_date']>date('Y-m-d') && $row1['cb_date'] !='' ){?><span style='color:white;font-weight:bold;background:green;padding:5px;'> <?php echo $row1['cb_date']; }else{?><span style='color:white;font-weight:bold;background:red;padding:5px;'> <?php echo $row1['cb_date']; }?></span></td>
										
									</tr>
									
									
									
								<?php
								//echo "perc= ".$row['perc'];
									$con55->next_result();
									}
									
								
									
								?>
								
								
								</tbody>
								
							
							
							
							
							
								
								
						</table>
					  </div>
				
			
					</div>
                </div>
			</div>
		</div>
        <!-- /page content -->

       <?php
	   include("includes/footer.php");
	   ?>
