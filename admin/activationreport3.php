<?php

include("includes/check_session.php");
date_default_timezone_set("Asia/Kolkata");
//include("includes/connection.php");
//error_reporting(0);
//$con=mysql_connect('10.34.240.3','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
$con2=mysqli_connect('10.34.240.3','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
//$con1=mysqli_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster1
$con1=$con2;
//global $con;
//global $con1;
$gvact=$giact=$gooact=$geact=$gazact=0;
$start_date='';
$end_date='';
$date1=date('Y-m-d');
$count=0;
$cc=0;



 $start_date2=$_POST['start_date'];
 $end_date2=$_POST['end_date'];
$hours=$_POST['hours'];
?>

		<?php include("includes/header.php"); ?>
		<?php include("includes/sidebar.php"); ?>
		<?php include("includes/top_navigation.php"); ?>
            
			
<body  onload="setTimeout('document.formname.submit();', 3000);">
        <!-- page content -->
        <div class="right_col" role="main" >
          <div class="footer_down">

            
            

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
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
                    <form class="form-horizontal form-label-left input_mask" name="formname" id="formname" method="post">
					
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date2!=''){echo date('d-m-Y',strtotime($start_date2));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date2!=''){echo date('d-m-Y',strtotime($end_date2));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Hours
								<select name="hours" class="form-control">
									<?php
										for($i=24;$i>0;$i--)
										{
											if($i==$hours)
											{
												$selected='selected';
											}
											else
											{
												$selected='';
											}
										?>
											<option <?php echo $selected ?>><?php echo $i; ?></option>
										<?php
										}
									?>
								</select>
								
							</div>
						
						
						
						

                     
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
						  <input type="submit" name="submit" class="btn btn-success">
						</div>
                      

                    </form>
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
						
			<?php 
			//echo $sql;
			if(isset($_POST['submit']))
			{
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
					
						<table  class="table  table-bordered">
						  <thead>
						 <th rowspan='2'> <center>Date </center></th>
						 <!--<th rowspan='1'> <center>Vodacom </center></th>-->
						 
						  <th colspan='26'><center> Gamebar</center> </th>
							<th colspan='7'> <center>Glambar</center></th>
						 <tr>
							<!--<th>all</th>-->
							
							<th><center>Bahrain</center></th>
							<th><center>Czech</center></th>
							<th><center>Egypt</center></th>
							<th><center>Finland</center></th>
							<th><center>France</center></th>
							<th><center>Greece</center></th>
							<th><center>Indonesia</center></th>
							<th><center>Iraq</center></th>
							<th><center>KSA</center></th>
							<th><center>Kuwait</center></th>
							<th><center>Myanmar</center></th>
							<th><center>Mozambique</center></th>
							<th><center>Oman</center></th>
							<th><center>Pakistan</center></th>
							<th><center>Poland</center></th>
							<th><center>Qatar</center></th>
							<th><center>Romania</center></th>
							<th><center>Slovenia</center></th>
							<th><center>SouthAfrica</center></th>
							
							<th><center>Spain</center></th>
							<th><center>Srilanka</center></th>
							<th><center>Sweden</center></th>
							<th><center>Switzerland</center></th>
							<th><center>Thailand</center></th>
							<th><center>UAE</center></th>
							<th><center>Turkey</center></th>
							
							

							
							<!--Glambar-->
							<th><center>Czech</center></th>
							<th><center>Greece</center></th>
							<th><center>Poland</center></th>
							<th><center>Slovenia</center></th>
							<th><center>SouthAfrica</center></th>
							<th><center>Spain</center></th>
							<th><center>Thailand</center></th>


							
							
						 </tr>
						  
						  </thead>
						  
						

							<tbody>
								<?php 
							//echo $sql;
								
			
					
					$count=1;
				
					$date1=date('Y-m-d');
				
					$b=$c=0;
					if($start_date == $end_date)
					{
						$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
						$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
						$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
						$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
						$hours=$_POST['hours'];
					}	
					else
					{
						$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
						$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
						$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
						$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
						$hours=$_POST['hours'];
					}
					
			
					
					if($end_date1 == $date1 && $start_date1 == $date1)
						{
							$c=1;//currentdate
						}
						elseif($end_date1 == $date1 && $start_date1 != $date1)
						{
							
							$b=1;
							$c=1;
						}
						else{
							
							$b=1;
						}
					
					
				

			if($b==1)
			{	
					//echo "hi";
					$db='gamebardb_vodafone_qatar';
					$report='gamebardb_vodafone_qatar_report';
					$sql="select * from ".$report.".activation_report where date>='".$start_date1."' and date <='".$end_date."' and hour= '".$hours."' order by `date` asc";
					
					$result = $con1->query($sql);
					while($row=mysqli_fetch_array($result))
						{
							?>
							
							
							
							
							<tr>
							<td><?php echo $row['date']; ?></td>
							<!--<td><?php //echo $row['vodacom_all']; ?></td>-->
							<td><?php echo $row['gamebar_bahrain'] ?></td>
							<td><?php echo $row['gamebar_czech']?></td>
							<td><?php echo $row['gamebar_egmon']?></td>
							<td><?php echo $row['gamebar_finland']?></td>
							<td><?php echo $row['gamebar_france'] ?></td>
							<td><?php echo $row['gamebar_paydashgr']?></td>
							<td><?php echo $row['gamebar_indoneisa']?></td>
							<td><?php echo $row['gamebar_iraq']?></td>
							<td><?php echo $row['gamebar_ksa']?></td>
							<td><?php echo $row['gamebar_kuwait']?></td>
							<td><?php echo $row['gamebar_myanmar']?></td>
							<td><?php echo $row['gamebar_Mozambique']?></td>
							<td><?php echo $row['gamebar_oman']?></td>
							<td><?php echo $row['gamebar_pk']?></td>
							<td><?php echo $row['gamebar_pl']?></td>
							<td><?php echo $row['gamebar_qatar']?></td>
							<td><?php echo $row['gamebar_ro']?></td>
							<td><?php echo $row['gamebar_slovenia']?></td>
							<td><?php echo $row['gamebar_southafrica']?></td>
							
							<td><?php echo $row['gamebar_spain']?></td>
							<td><?php echo $row['gamebar_srilanka']?></td>
							<td><?php echo $row['gamebar_sweden']?></td>
							<td><?php echo $row['gamebar_switzerland']?></td>
							<td><?php echo $row['gamebar_thailand']?></td>
							<td><?php echo $row['gamebar_uae']?></td>
							<td><?php echo $row['gamebar_turkey']?></td>
							
							
				
				
				
							<!--glambar-->
							<td><?php echo $row['glambar_czech']?></td>
							<td><?php echo $row['Glambar_paydashgr']?></td>
							<td><?php echo $row['glambar_pl'] + $row['glambar_pldmc'] ?></td>
							<td><?php echo $row['glambar_slovenia']?></td>
							<td><?php echo $row['Glambar_southafrica']?></td>
							<td><?php echo $row['Glambar_spain']?></td>
							<td><?php echo $row['glambar_thailand']?></td>
				
				
				
				
															
												
												
							</tr>
							
							
							
							<?php
							
						}
					
			}


					
					 //$next_date = date('Y-m-d', strtotime($date1 .' +1 day'));
				if($c==1)
				{
					//echo "hi2";
						//do
						//{
						$start_date=$date1." 00:00:00";
						$end_date=$date1." 23:59:59";
						//$haact=$hiact=$hvact=$gvact=$giact=$gooact=$geact=$gazact=0;
						$hvact=0;
						
						
						// "call fashionbardb_france.get_activation('".$start_date."',  '".$end_date."', ".$hours.")";
							$gamebar_france=0;
						
						 $result1 = $con1->query("call fashionbardb_france.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_france=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$glambar_pldmc=0;
						
						 $result1 = $con1->query("call fashionbardb_polandglam.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_pldmc=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$gamebar_turkey=0;
						
						 $result1 = $con1->query("call fashionbardb_tr.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_turkey=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$gamebar_switzerland=0;
						
						 $result1 = $con1->query("call fashionbardb_ch.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_switzerland=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_iraq=0;
						
						 $result1 = $con1->query("call gamebar_iqzain.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_iraq=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						$gamebar_qatar=$gamebar_qatarooredoo=$qatar_vodafone=0;
						
						 $result1 = $con1->query("call fashionbardb_qatarooredoo.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_qatarooredoo=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_qatar=$gamebar_qatarooredoo+$qatar_vodafone;
						//echo"call game_mycell_apigate.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ";exit; 
						
						
						
						
						
						
						
						$gamebar_pk=0;
						
						$result1 = $con1->query("call gamebar_pk.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_pk=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$gamebar_ro=0;
						
						$result1 = $con1->query("call gamebar_ro.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_ro=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_finland=0;
						
						$result1 = $con1->query("call fashionbardb_finland.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_finland=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_slovenia=0;
						
						$result1 = $con1->query("call fashionbardb_si.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_slovenia=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$glambar_slovenia=0;
						
						$result1 = $con1->query("call fashionbardb_siglam.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_slovenia=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$gamebar_sweden=0;
						
						$result1 = $con1->query("call fashionbardb_sweden.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_sweden=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$glambar_czech=0;
						
						$result1 = $con1->query("call fashionbardb_czglam.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_czech=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$gamebar_egmon1=0;
						
						$result1 = $con1->query("call gamebar_egypt.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_egmon1=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$gamebar_egmon2=0;
						
						$result1 = $con1->query("call gamebar_egypt_mondianew.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_egmon2=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$gamebar_egmon=$gamebar_egmon1+$gamebar_egmon2;
						
						
						$gamebar_cz=0;
						
						$result1 = $con1->query("call fashionbardb_cz.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_cz=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_srilanka=0;
						//echo "call gamebar_srilanka.get_activation('".$start_date."',  '".$end_date."', ".$hours.")";
						$result1 = $con1->query("call gamebar_srilanka.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_srilanka=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						
						
						
						$gamebar_ksa=0;
						
						$result1 = $con1->query("call fashionbardb_timwezain.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_ksa=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$glambarsouthafrica=$glambarsouthafrica1=0;
						
						//echo"call fashionbardb_zaglam.activation_report('".$start_date."',  '".$end_date."', ".$hours.")";
						
						$result1 = $con1->query("call fashionbardb_zaglam.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						 $rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambarsouthafrica1=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$sagact=$sagact1=0;
						$result2 = $con1->query("call fashionbardb_za.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$sagact1=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						//za Mobixone
						
						$gamebarmbx=0;
						$result2 = $con1->query("call gamebar_zamobixone.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebarmbx=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$sagact=$gamebarmbx+$sagact1;
						
						
						//Glambar za Mobixone
						
						$glambarmbx=0;
						$result2 = $con1->query("call glambar_zamobixone.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$glambarmbx=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$glambarsouthafrica=$glambarsouthafrica1+$glambarmbx;
						
						
						
						$gamebar_myanmar=0;
						$result2 = $con1->query("call fashionbardb_myanmartelenor.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_myanmar=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_Mozambique=0;
						$result2 = $con1->query("call fashionbardb_mz.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_Mozambique=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						
						
						
						$gamebar_paydashgr=0;
						$result2 = $con1->query("call fashionbardb_greece.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_paydashgr=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
					//	echo"call fashionbardb_greeceglam.get_activation('".$start_date."',  '".$end_date."', ".$hours.")";
						$glambar_paydashgr=0;
						$result2 = $con1->query("call fashionbardb_greeceglambar.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$glambar_paydashgr=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_indonesia=0;
						$result2 = $con1->query("call gamebardb_indonesia.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_indonesia=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_uae=0;
						$result2 = $con1->query("call fashionbardb_etisalat.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_uae=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$glambar_pl=0;
						$result2 = $con1->query("call glambar_plteleaudio.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$glambar_pl=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_pl=0;
						$result2 = $con1->query("call fashionbardb_polandgame.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_pl=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_bahrain=0;
						$result2 = $con1->query("call fashionbardb_bh.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_bahrain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_kuwait=$kuwaitzain=$kuwaitstc=0;
						$result2 = $con1->query("call fashionbardb_slakwzain.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$kuwaitzain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$result2 = $con1->query("call fashionbardb_slakwstc.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$kuwaitstc=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_kuwait=$kuwaitzain+$kuwaitstc;
						
						
						
						$gamebar_spain=0;
						$result2 = $con1->query("call gamebardb_spain.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_spain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						$glambar_spain=0;
						$result2 = $con1->query("call fashionbardb_spain.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$glambar_spain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$glambar_thailand=0;
						$result2 = $con1->query("call fashionbardb_glam9005thailand.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$glambar_thailand=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_thailand=0;
						$result2 = $con1->query("call fashionbardb_game9305thailand.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_thailand=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						
						$gamebar_oman=0;
						$result2 = $con1->query("call fashionbardb_omooredoo.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_oman=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						
						
						
						$cc=1;
						
					
						//echo $airtel_gamebar;
					?>
			
			
			
			
			
				
					<tr>
							<td><?php echo $date1 ?></td>
							<td><?php echo $gamebar_bahrain ?></td>
							<td><?php echo $gamebar_cz;?></td>
							<td><?php echo $gamebar_egmon;?></td>
							<td><?php echo $gamebar_finland;?></td>
							<td><?php echo $gamebar_france ?></td>
							<td><?php echo $gamebar_paydashgr;?></td>
							<td><?php echo $gamebar_indonesia;?></td>
							<td><?php echo $gamebar_iraq;?></td>
							<td><?php echo $gamebar_ksa;?></td>
							<td><?php echo $gamebar_kuwait;?></td>
							<td><?php echo $gamebar_myanmar;?></td>
							<td><?php echo $gamebar_Mozambique;?></td>
							<td><?php echo $gamebar_oman;?></td>
							<td><?php echo $gamebar_pk;?></td>
							<td><?php echo $gamebar_pl;?></td>
							<td><?php echo $gamebar_qatar;?></td>
							<td><?php echo $gamebar_ro;?></td>
							<td><?php echo $gamebar_slovenia;?></td>
							<td><?php echo $sagact; ?></td>	
							<td><?php echo $gamebar_spain;?></td>
							<td><?php echo $gamebar_srilanka;?></td>
							<td><?php echo $gamebar_sweden;?></td>
							<td><?php echo $gamebar_switzerland;?></td>
							<td><?php echo $gamebar_thailand;?></td>
							<td><?php echo $gamebar_uae;?></td>
							<td><?php echo $gamebar_turkey;?></td>
							
							
							
							
							
							
							
							<!--Glambar-->
							<td><?php echo $glambar_czech; ?></td>	
							<td><?php echo $glambar_paydashgr; ?></td>
							<td><?php echo $glambar_pl+$glambar_pldmc; ?></td>	
							<td><?php echo $glambar_slovenia; ?></td>
							<td><?php echo $glambarsouthafrica; ?></td>	
							<td><?php echo $glambar_spain; ?></td>	
							<td><?php echo $glambar_thailand; ?></td>	
							
								
							
							
							
					</tr>
					<?php
							
			
			
			
			

					//echo $start_date."<br>";
					//echo $end_date."<br><br>";
					//echo "<script>window.location='report.php';</script>";
					//$date1 = date('Y-m-d', strtotime($date1 .' +1 day'));
				}
		
				//while($date1 <= $end_date1);
											
								
					}
								?>
							</tbody>
							
							
								
								
						</table>
						
					  </div>
				<!--<div id="advertiser"></div>-->
			
					</div>
                </div>
			</div>
			
		</div>
        <!-- /page content -->
		
       <?php
	   include("includes/footer.php");
		
		?>
</body>
<script type="text/javascript">
 $(document).ready(function(){

   $("#operator").change(function(){
		
		var check1=$("#check1").val();
		if(check1 == 0)
		{
			
		}
		else	
		{
			$(".sel").val('');
			$("#t").hide();
			$("#f").show();
						
		}
        var operator = $("#operator").val();
		var product = $("#product").val();
        $.ajax({
            type: "GET",
            url: "ajax/find_advertiser.php?operator="+operator+"&product="+product         
			
        }).done(function(data){
            $(".response").html(data);
			 
        });
    });
});
</script>
<script type="text/javascript">
function myfun() {
	var x = document.getElementById("product").value;
    //alert(x);
	if(x =='Hotshots')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		select.options[select.options.length] = new Option('Airtel', 'Airtel');
	}
	else if(x =='GamezZone')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		//select.options[select.options.length] = new Option('Airtel', 'Airtel');
		select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		select.options[select.options.length] = new Option('etisalat', 'etisalat');
		select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo');
	}
	
	/*if(x=="Hotshots")
	{
		 //alert("hi");
	document.getElementById('azharbeizan').style.visibility = 'hidden';
	}else
	{
		document.getElementById('azharbeizan').style.visibility = 'visible';
	}*/
}
</script>		
<script>
 function getdata(startdate,enddate,db,dblog,advertiser,parameter){

  
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("advertiser").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","mehul_ajax/mehul_ajax.php?startdate="+startdate+"&enddate="+enddate+"&db="+db+"&dblog="+dblog+"&advertiser="+advertiser+"&parameter="+parameter,true);
        xmlhttp.send();
    }
 
 </script>   
<script>
	/*function myFunction() {
    var x = document.getElementById("product").value;
	
	//document.getElementById("demo").innerHTML = "You selected: " + x;
    if(x =='Hotshots')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		select.options[select.options.length] = new Option('Airtel', 'Airtel');
	}
	else if(x =='GamezZone')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		//select.options[select.options.length] = new Option('Airtel', 'Airtel');
		select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		//select.options[select.options.length] = new Option('etisalat', 'etisalat');
		//select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo_qatar');
	}
	
	//document.getElementById("demo").innerHTML = "You selected: " + x;
	}
	
	*/
	</script> 
<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
         // alert('test');
        document.getElementById('submit').click();
			
		}

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 10000);
        }
    }
</script>