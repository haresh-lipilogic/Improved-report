<?php

include("includes/check_session.php");
//include("includes/connection.php");
error_reporting(0);
$con=mysql_connect('10.125.1.51:3308','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
$con2=mysqli_connect('10.125.1.51:3308','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
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
						 
						  <th colspan='18'><center> Gamebar</center> </th>
							<th colspan='4'> <center>Glambar</center></th>
						 <tr>
							<!--<th>all</th>-->
							
							<th><center>Qatar</center> </th>
							<th><center>Oman</center></th>
							<th><center>Malaysia</center></th>
							<th><center>Indonesia</center></th>
							<th><center>South Africa</center></th>
							
							
							<th><center>Egypt</center></th>
							
							<th><center>Myanmar Telenor</center></th>
							
							<th><center>Spain Vodafone</center></th>
							
							<th><center>Poland</center></th>
							<th><center>Bangladesh Robi</center></th>
							<th><center>Srilanka</center></th>
							<th><center>Greece N</center></th>
							
							<th><center>Kuwait</center></th>
							<th><center>Pakistan</center></th>
							
							
							<th><center>Bahrain</center></th>
							<th><center>KSA</center></th>
							
							<th><center>UAE</center></th>
							<th><center>Sweden</center></th>
							
							
							<th><center>Thailand </center> </th>
							<th><center>Spain Vodafone</center></th>
							<th><center>South Africa</center></th>
							<th><center>Poland</center></th>
							
							
						 </tr>
						  
						  </thead>
						  
						

							<tbody>
								<?php 
							//echo $sql;
								
			//$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
			//$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
			//$start_date2=$_POST['start_date'];
			//$end_date2=$_POST['end_date'];
			//$hours=$_POST['hours'];
			//$count=1;
			//$date1=$start_date1;	
			//$curdate()			
					
					$count=1;
				//	$operator=$_POST['operator'];
				//	$product=$_POST['product'];
					$date1=date('Y-m-d');
				//	$type=$_POST['type'];
				//	$display=$_POST['display']; 
				//	$advertiserid=$_POST['advertiserid'];
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
					$sql="select * from ".$report.".activation_report where date>='".$start_date1."' and date <='".$end_date."' and hour= '".$hours."'";
					
					$result = $con1->query($sql);
					while($row=mysqli_fetch_array($result))
						{
							?>
							
							<tr>
				<td><?php echo $row['date']; ?></td>
				<!--<td><?php //echo $row['vodacom_all']; ?></td>-->
				<td><?php echo $row['vodafone_qatar']+$row['vodafoneqatar2']+$row['ooredoo_qatar']; ?></td>
				<td><?php echo $row['ooredoo_oman']+$row['oman_omantel']; ?></td>
				<td><?php echo $row['malaysia_cellcom']+ $row['malaysia_maxis']; ?></td>
				<td><?php echo $row['gamebar_indonesia'];?></td>
				<!--<td><?php //echo $row['gamebar_southafrica'] + $row['gamebar_southafrica_intarget'];?></td>-->
				<td><?php echo $row['vodacom_all']+$row['gamebar_southafrica']; ?></td>
				
			
				<td><?php echo $row['gamebar_egypt'];?></td>
			<!--	<td><?php //echo $row['gamebar_dudubai'];?></td>-->
				<!--<td><?php //echo $row['gamebar_kenya'];?></td>-->
				
			<!--	<td><?php //echo $row['gamebar_guatemala'];?></td>-->
				<td><?php echo $row['gamebar_myanmar'];?></td>
				<!--<td><?php //echo $row['gamebar_kazakistan'];?></td>-->
			<!--	<td><?php //echo $row['gamebar_ecuardo'];?></td>-->
				<!--<td><?php //echo $row['gamebar_portugal'];?></td>-->
				<td><?php echo $row['gamebar_spain'];?></td>
				<!--<td><?php //echo $row['gamebar_austria'];?></td>-->
				<td><?php echo $row['gamebar_poland'];?></td>
				<td><?php echo $row['gamebar_bangladeshromi'];?></td>
				<td><?php echo $row['dialog_srilanka']+$row['gamestar_srilanka'];?></td>
				<td><?php echo $row['gamebar_greece2'];?></td>
				<!--<td><?php //echo $row['gamebar_serbia'];?></td>-->
				
				<!--<td><?php //echo $row['gamebar_uaeetisalad'];?></td>-->
				<!--<td><?php //echo $row['gamebar_palenstine'];?></td>-->
				<td><?php echo $row['gamebar_kwzain']?></td>
				<td><?php echo $row['gamebar_pktelenor'];?></td>
				
				<!--<td><?php //echo $row['gamebar_netherland'];?></td>-->
				
				<td><?php echo $row['gamebar_bahrain'] + $row['gamebar_bahrain_zain'] ;?></td>
				<td><?php echo $row['gamebar_ksa']+$row['gamebar_ksa_weekly'];?></td>
				
				<td><?php echo $row['gamebar_uae']+ $row['gamebar_uae_du'];?></td>
				<td><?php echo $row['gamebar_sweden'];?></td>
				
				
				
				
				<td><?php echo $row['glambar_thailand'] + $row['glambar_newthailand'];?></td>
				
			<!--	<td><?php //echo $row['glamour_russia'];?></td>-->
				<!--<td><?php //echo $row['glamour_kenya'];?></td>-->
				<!--<td><?php //echo $row['glamour_portugal'];?></td>-->
				<td><?php echo $row['glambar_spain'];?></td>
				<td><?php echo $row['glambar_southafrica']; ?></td>
				<td><?php echo $row['glambar_poland'];?></td>
															
												
												
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
						
						
						// voda foneQatar
						/*$result1 = $con1->query("call gamebardb_vodafone_qatar.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$hvact=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();*/
						
						
						
						$vodafoneqatar=0;
						
						
						// voda foneQatar
						$result1 = $con1->query("call gamesdbnew_197_vodafone_qatar.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$vodafoneqatar=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();

						
						
						// voda foneQatar
						$gamesweden=0;
						$result1 = $con1->query("call gamebar_sweden.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamesweden=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						
						
						$ksa_weekly=0;
						
						
						// ksa_weekly
						$result1 = $con1->query("call fashionbardb_saweekly.activation_report('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$ksa_weekly=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						
						
						
						
						//Egypt
						$gvegypt=0;
						$result1 = $con1->query("call gamebardb_vodafone_egypt.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gvegypt=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
					
						
						//ooredoo-oman
						
						$start_date=$date1." 00:00:00";
						$end_date=$date1." 23:59:59";
						//$haact=$hiact=$hvact=$gvact=$giact=$gooact=$geact=$gazact=0;
						$ooredoo=0;
						
						$result1 = $con1->query("call  fashionbardb_omooredoo.activation_report('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$ooredoo=$row1['act'];
							$ooredoodate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						//Malaysia_Cellcom
						
						$start_date=$date1." 00:00:00";
						$end_date=$date1." 23:59:59";
						//$haact=$hiact=$hvact=$gvact=$giact=$gooact=$geact=$gazact=0;
						
						$malaysia_maxis=0;
						
						$result1 = $con1->query("call gamebar_my.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$malaysia_maxis=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$malaysia_cellcom=0;
						
						$result1 = $con1->query("call gamesdbnew_celcom_malaysia.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$malaysia_cellcom=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$malaysia_cellcom=$malaysia_cellcom+$malaysia_maxis;
						
						
						$indonesia=0;
						$result1 = $con1->query("call gamebardb_indonesia.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$indonesia=$row1['act'];
							$indonesiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$vodacomall=0; 
						$result1 = $con1->query("call vodacom_za.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$vodacomall=$row1['act'];
							$indonesiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$sagact=0;
						$result2 = $con1->query("call fashionbardb_za.activation_report('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$sagact=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						//echo "call fashionbardb_zaglam.activation_report('".$start_date."',  '".$end_date."', ".$hours.")";exit;
						$sagmct=0;
						$result2 = $con1->query("call fashionbardb_zaglam.activation_report('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$sagmct=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
					/*	$result2 = $con1->query("call  fashionbardb_africa.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$saact=$row1['act'];
							$sadate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$saiact=0;	
						if($result1 = $con1->query("call glambardb_southafrica.getactivation('".$start_date."',  '".$end_date."', ".$i.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$saiact=$row1['act'];
							$hvdate=$row1['dt'];
							
						}
						}
						$result1->close();
						$con1->next_result();
						$saact=$saact+$saiact;*/
						
						$ooredoo_qatar=0;
						$result1 = $con1->query("call fashionbardb_qatarooredoo.activation_report('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$ooredoo_qatar=$row1['act'];
							$ooredoodate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						/*
						$airtel_gamebar=0;
						$result1 = $con1->query("call gamebardb_airtel.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$airtel_gamebar=$row1['act'];
							$ooredoodate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$airtel_glambar=0;
						$result1 = $con1->query("call funzonedb_airtel.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$airtel_glambar=$row1['act'];
							$ooredoodate=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$games_idea=0;
						//echo "call gamesworld_idea.mehul_activation_svmobi('".$start_date."',  '".$end_date."',".$hours.",1)";
						$result1 = $con1->query("call gamesworld_idea.mehul_activation_svmobi('".$start_date."',  '".$end_date."',".$hours.",1) ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$games_idea=$row1['act'];
							$ide_date=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$games_voda=0;
						$result1 = $con1->query("call gamesworld_voda.mehul_activation_svmobi('".$start_date."',  '".$end_date."',".$hours.",1) ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$games_voda=$row1['act'];
							$voda_date=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$glamour_idea=0;
						//echo "call gamesworld_idea.mehul_activation_svmobi('".$start_date."',  '".$end_date."',".$hours.",1)";
						$result1 = $con1->query("call glamourworld_idea.mehul_activation_svmobi('".$start_date."',  '".$end_date."',".$hours.",1) ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glamour_idea=$row1['act'];
							$ide_date=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						$glamour_voda=0;
						$result1 = $con1->query("call fashionbardb_svmobi.getactivation('".$start_date."',  '".$end_date."',".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glamour_voda=$row1['act'];
							$voda_date=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						//hotshotsvoda
						$hotshots_voda=0;
						$result1 = $con1->query("call  hotshotsnewdb_voda_0617.getactivation('".$start_date."',  '".$end_date."',".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$hotshots_voda=$row1['act'];
							$voda_date=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$gamezone_voda=0;
						$result1 = $con1->query("call  gamesnewdb_voda.getactivation('".$start_date."',  '".$end_date."',".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamezone_voda=$row1['act'];
							$voda_date=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						/*$gamebar_bsnl=0;
						$result1 = $con1->query("call bsnlgamebar.mehul_gamebarsvmobibsnl('".$start_date."',  '".$end_date."',".$hours.",1) ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_bsnl=$row1['act'];
							$voda_date=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						$glambar_bsnl=0;
						$result1 = $con1->query("call bsnlfashionbar.mehul_glambarsvmobi('".$start_date."',  '".$end_date."',".$hours.",1) ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_bsnl=$row1['act'];
							$glambar_bsnldate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();*/
						
						$glambar_thailand=0;
						$result1 = $con1->query("call fashionbardb_thailand_0218.mehul_glambarthailand('".$start_date."',  '".$end_date."',".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_thailand=$row1['act'];
							$glambar_thailanddate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						$glambar_newthailand=0;
						$result1 = $con1->query("call fashionbardb_glam9005thailand.getact('".$start_date."',  '".$end_date."',".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_newthailand=$row1['act'];
							$glambar_newthailanddate=$row1['dt'];
							
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamerussia=0;
					/*	if($result1 = $con1->query("call gamebardb_beeline.getactrussia('".$start_date."',  '".$end_date."') "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamerussia=$row1['act'];
							$gamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
					
						$glamerussia=0;
						if($result1 = $con1->query("call glambardb_beeline.getactrussia('".$start_date."',  '".$end_date."') "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glamerussia=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						//dudubai
						
						$game_du=0;
						if($result1 = $con1->query("call gamesdb_uaedu.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_du=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						//gamebar_kenya
						/*$game_kenya=0;
						if($result1 = $con1->query("call gamebardb_kenya.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_kenya=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						//glambar_kenya
						$glam_kenya=0;
						if($result1 = $con1->query("call glambardb_kenya.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glam_kenya=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();*/
						
						
						$game_bahrain=0;
						
						
						
						if($result1 = $con1->query("call fashionbardb_bh.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_bahrain=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						//$game_bahrain=$game_bahrain_stc+$game_bahrain_batelco;
						
						
						
						
						$game_uae_du=0;
						if($result1 = $con1->query("call  gamesdb_uaedu_ma.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_uae_du=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						$game_saudi=0;
						if($result1 = $con1->query("call gamesdb_mobily_saudi.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_saudi=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						/*
						$game_guatemala=0;
						if($result1 = $con1->query("call  gamebardb_guatemala.getactguatemala('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_guatemala=$row1['act'];
							$glamerussiadate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						$game_myanmar=0;
						if($result1 = $con1->query("call  fashionbardb_myanmartelenor.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_myanmar=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						/*$game_kazakistan=0;
						if($result1 = $con1->query("call  fashionbardb_kazakhstan.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_kazakistan=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						
						$game_ecuardo=0;
						/*if($result1 = $con1->query("call  gamebardb_ecuador.getactecuador('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_ecuardo=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						/*
						$game_portugal=0;
						if($result1 = $con1->query("call  gamebardb_portugal.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_portugal=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$glam_portugal=0;
						if($result1 = $con1->query("call  fashionbardb_portugal.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glam_portugal=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						
						
						$game_spain=0;
						if($result1 = $con1->query("call  gamebardb_spain.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_spain=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						$glam_spain=0;
						if($result1 = $con1->query("call  fashionbardb_spain.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glam_spain=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						/*
						$hotshotsairtel=0;
						if($result1 = $con1->query("call  hotshotsdb_airtel.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
						//	$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$hotshotsairtel=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						$gamebaraustria=0;
						/*if($result1 = $con1->query("call  gamebardb_a1.getact('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebaraustria=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						
						$gamebarpoland=0;
						if($result1 = $con1->query("call  gamebar_poland.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebarpoland=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						$glambarpoland1=$glambarpoland=0;
						if($result1 = $con1->query("call  glambar_poland.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambarpoland1=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$glambarpoland2=0;
						if($result1 = $con1->query("call glambar_plteleaudio.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambarpoland2=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						$glambarpoland=$glambarpoland1+$glambarpoland2;
						
						
						
						$gamebar_banglaromi=0;
						if($result1 = $con1->query("call  gamesdbnew_robi_bangladesh.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_banglaromi=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						$dialog_srilanka=0;
						if($result1 = $con1->query("call  gamesdbnew_dialog_srilanka.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$dialog_srilanka=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$dialog_srilanka1=0;
						if($result1 = $con1->query("call  gamebar_srilanka.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$dialog_srilanka1=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						$dialog_srilanka=$dialog_srilanka+$dialog_srilanka1;
						
						
						
						$gamebar_greece=0;
						if($result1 = $con1->query("call  gamebardb_greecevf.getactgreece('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_greece=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						$glambar_greece=0;
						if($result1 = $con1->query("call  glambardb_greecevf.getactgreece('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$glambar_greece=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						
						
						$gamebar_serbia=0;
						/*if($result1 = $con1->query("call  gamebardb_serbiamts.getactserbia('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_serbia=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						$result1->close();
						$con1->next_result();
						*/
						
					
						
						
						
						
						$gamebar_palenstine=0;
						if($result1 = $con1->query("call  gamebardb_palestine.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_palenstine=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						$gamebar_algeria=0;
						if($result1 = $con1->query("call  gamebardb_algeria.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_algeria=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						$gamebar_kwzain=$kwzain=$kwstc=0;
						if($result1 = $con1->query("call  fashionbardb_slakwzain.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$kwzain=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						//$gamebar_kwzain=$kwzain=$kwstc=0;
						if($result1 = $con1->query("call fashionbardb_slakwstc.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$kwstc=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						$gamebar_kwzain=$kwzain+$kwstc;
						
						
						
						
						
						
						
						$gamebar_pktelenor=0;
						if($result1 = $con1->query("call  gamebar_pk.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_pktelenor=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						$game_nl=0;
						if($result1 = $con1->query("call gamebardb_nlvf.getactnl('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_nl=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
					
						
						
						
						
						
						
						$game_norway=0;
						if($result1 = $con1->query("call gamebardb_norway.getact('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_norway=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						$game_greece2=0;
						if($result1 = $con1->query("call fashionbardb_greece.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_greece2=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						$game_ksa=0;
						if($result1 = $con1->query("call fashionbardb_timwezain.activation_report('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_ksa=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						$game_oman_omantel=0;
						if($result1 = $con1->query("call gamesdb_omantel_oman.getactivation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_oman_omantel=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						$game_bahrain_zain=0;
						
						/*
						
						if($result1 = $con1->query("call fashionbardb_bh.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_bahrain_zain=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();*/
						
						
						
						
						
						
						$result1->close();
						$con1->next_result();
						
						$game_uae=0;
						if($result1 = $con1->query("call fashionbardb_etisalat.get_activation('".$start_date."',  '".$end_date."',".$hours.") "))
						{
							//$activation++;
							
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$game_uae=$row1['act'];
							$gamemyanmardate=$row1['dt'];
							
						}
						}
						
						
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						$cc=1;
						
					
						//echo $airtel_gamebar;
					?>
			
				
					<tr>
							<td><?php echo $date1 ?></td>
							<!--<td><?php //echo $vodacomall ?></td>-->
							<td><?php echo $hvact + $vodafoneqatar+$ooredoo_qatar; ?></td>
							<td><?php echo $ooredoo+$game_oman_omantel; ?></td>	
							<td><?php echo $malaysia_cellcom; ?></td>	
							<td><?php echo $indonesia;?></td>
							
							<td><?php echo $vodacomall+$sagact ;?></td>
							
							<!--<td><?php //echo $airtel_gamebar;?></td>
							<td><?php //echo $games_idea;?></td>
							<td><?php //echo $games_voda;?></td>
							<td><?php //echo $gamezone_voda;?></td>
						<!--	<td><?php //echo $gamebar_bsnl;?></td>-->
						<!--	<td><?php //echo $gamerussia;?></td>-->
							<td><?php echo $gvegypt;?></td>
						<!--	<td><?php //echo $game_du;?></td>-->
							<!--<td><?php //echo $game_kenya;?></td>-->
							<!--<td><?php //echo $itact;?></td>-->
						<!--	<td><?php //echo $game_guatemala;?></td>-->
							<td><?php echo $game_myanmar;?></td>
							<!--<td><?php //echo $game_kazakistan;?></td>-->
						<!--	<td><?php //echo $game_ecuardo;?></td>-->
							<!--<td><?php //echo $game_portugal;?></td>-->
							<td><?php echo $game_spain;?></td>
						<!--	<td><?php //echo $gamebaraustria;?></td>-->
							<td><?php echo $gamebarpoland;?></td>
							<td><?php echo $gamebar_banglaromi;?></td>
							<td><?php echo $dialog_srilanka;?></td>
							<td><?php echo $game_greece2;?></td>
							
							<!--<td><?php //echo $gamebar_serbia;?></td>-->
						
							<!--<td><?php //echo $gamebar_etisalad;?></td>-->
							<!--<td><?php //echo $gamebar_palenstine;?></td>-->
							<td><?php echo $gamebar_kwzain?></td>
							<td><?php echo $gamebar_pktelenor;?></td>
							
							<!--<td><?php //echo $game_nl;?></td>-->
							<td><?php echo $game_bahrain + $game_bahrain_zain;?></td>
							<td><?php echo $game_saudi+$game_ksa+$ksa_weekly;?></td>
							<td><?php echo $game_uae+$game_uae_du;?></td>
							<td><?php echo $gamesweden;?></td>
							
							
							
							<!--<td><?php //echo $saact;?></td>-->	
							<!--<td><?php //echo $airtel_glambar;?></td>
							<td><?php //echo $hotshotsairtel;?></td>
							<td><?php //echo $glamour_idea;?></td>
							<td><?php //echo $glamour_voda;?></td>
							<td><?php //echo $hotshots_voda;?></td>
							<!--<td><?php //echo $glambar_bsnl;?></td>-->
							<td><?php echo $glambar_thailand + $glambar_newthailand;?></td>
							
							<!--<td><?php //echo $glamerussia;?></td>-->
							<!--<td><?php //echo $glam_kenya;?></td>-->
							<!--<td><?php //echo $glam_portugal;?></td>-->
							<td><?php echo $glam_spain;?></td>
							<td><?php echo $sagmct;?></td>
							<td><?php echo $glambarpoland;?></td>
							
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