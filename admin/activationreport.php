<?php

include("includes/check_session.php");
date_default_timezone_set("Asia/Kolkata");
//include("includes/connection.php");
//error_reporting(0);
//$con=mysql_connect('10.34.240.3','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
// $con2=mysqli_connect('10.34.240.214','webserveruser','K&dN&r4a8N@du0') or die(mysql_error());//cluster 2
$con2=mysqli_connect("localhost","root","") or die(mysqli_error());//cluster1
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


$report='gamebardb_vodafone_qatar_report';

 $result1 = $con1->query("select Product,count(Country)cc from ".$report.".activationsetting where Action='Open' group by Product ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$Product=$row1['Product'];
							$kk[$row1['Product']]=$row1['cc'];
						}
						$result1->close();
						$con1->next_result();



$result1 = $con1->query("select * from ".$report.".activationsetting  ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$ll[$row1['Product']][$row1['Country']]=$row1['Action'];
							
							
						}
						$result1->close();
						$con1->next_result();




  
						
						//print_r($ll);exit;

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
						<button onclick="transposeTable()">Click Here For Vertical View</button>
						
			<?php 
			//echo $sql;
			if(isset($_POST['submit']))
			{
				//print_r($ll);exit;
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
					
						<table  class="table  table-bordered" id='myTable'>
						  <thead>
						 <th > <center>Date </center></th>
						 <!--<th rowspan='1'> <center>Vodacom </center></th>-->
						 
						  <th colspan='<?php echo $kk['Gamebar'];?>'><center> Gamebar</center> </th>
							<th colspan='<?php echo $kk['Glambar'];?>'> <center>Glambar</center></th>
							<th colspan='<?php echo $kk['11Players'];?>'> <center>11Players</center></th>
							<th colspan='<?php echo $kk['Contest'];?>'> <center>Contest</center></th>
						 <tr>

							<!--<th>all</th>-->
							<th></th>
							<?php if($ll['Gamebar']['Bahrain']=='Open'){ echo "<th><center>Bahrain</center></th>"; }?>
							<?php if($ll['Gamebar']['Bangladesh']=='Open'){ echo "<th><center>Bangladesh</center></th>"; }?>
							<?php if($ll['Gamebar']['Czech']=='Open'){ echo "<th><center>Czech</center></th>"; }?>
							<?php if($ll['Gamebar']['Egypt']=='Open'){ echo "<th><center>Egypt</center></th>"; }?>
							<?php if($ll['Gamebar']['Ethiopia']=='Open'){ echo "<th><center>Ethiopia</center></th>"; }?>
							<?php if($ll['Gamebar']['Finland']=='Open'){ echo "<th><center>Finland</center></th>"; }?>
							<?php if($ll['Gamebar']['France']=='Open'){ echo "<th><center>France</center></th>"; }?>
							<?php if($ll['Gamebar']['Gabon']=='Open'){ echo "<th><center>Gabon</center></th>"; }?>
							<?php if($ll['Gamebar']['Ghana']=='Open'){ echo "<th><center>Ghana</center></th>"; }?>
							<?php if($ll['Gamebar']['Greece']=='Open'){ echo "<th><center>Greece</center></th>"; }?>
							<?php if($ll['Gamebar']['Indonesia']=='Open'){ echo "<th><center>Indonesia</center></th>"; }?>
							<?php if($ll['Gamebar']['Iraq']=='Open'){ echo "<th><center>Iraq</center></th>"; }?>
							<?php if($ll['Gamebar']['Jordan']=='Open'){ echo "<th><center>Jordan</center></th>"; }?>
							<?php if($ll['Gamebar']['Kenya']=='Open'){ echo "<th><center>Kenya</center></th>"; }?>
							<?php if($ll['Gamebar']['KSA']=='Open'){ echo "<th><center>KSA</center></th>"; }?>
							<?php if($ll['Gamebar']['Kuwait']=='Open'){ echo "<th><center>Kuwait</center></th>"; }?>
							<?php if($ll['Gamebar']['Myanmar']=='Open'){ echo "<th><center>Myanmar</center></th>"; }?>
							<?php if($ll['Gamebar']['Mozambique']=='Open'){ echo "<th><center>Mozambique</center></th>"; }?>
							<?php if($ll['Gamebar']['Nigeria']=='Open'){ echo "<th><center>Nigeria</center></th>"; }?>
							<?php if($ll['Gamebar']['Oman']=='Open'){ echo "<th><center>Oman</center></th>"; }?>
							<?php if($ll['Gamebar']['Pakistan']=='Open'){ echo "<th><center>Pakistan</center></th>"; }?>
							<?php if($ll['Gamebar']['Palestine']=='Open'){ echo "<th><center>Palestine</center></th>"; }?>
							<?php if($ll['Gamebar']['Poland']=='Open'){ echo "<th><center>Poland</center></th>"; }?>
							<?php if($ll['Gamebar']['Qatar']=='Open'){ echo "<th><center>Qatar</center></th>"; }?>
							<?php if($ll['Gamebar']['Romania']=='Open'){ echo "<th><center>Romania</center></th>"; }?>
							<?php if($ll['Gamebar']['Slovenia']=='Open'){ echo "<th><center>Slovenia</center></th>"; }?>
							<?php if($ll['Gamebar']['SouthAfrica']=='Open'){ echo "<th><center>SouthAfrica</center></th>"; }?>
							<?php if($ll['Gamebar']['Srilanka']=='Open'){ echo "<th><center>Srilanka</center></th>"; }?>
							
							<?php if($ll['Gamebar']['Switzerland']=='Open'){ echo "<th><center>Switzerland</center></th>"; }?>
							<?php if($ll['Gamebar']['Thailand']=='Open'){ echo "<th><center>Thailand</center></th>"; }?>
							<?php if($ll['Gamebar']['UAE']=='Open'){ echo "<th><center>UAE</center></th>"; }?>
							<?php if($ll['Gamebar']['Turkey']=='Open'){ echo "<th><center>Turkey</center></th>"; }?>
							
							
							<!--Glambar-->
							
							<?php if($ll['Glambar']['Czech']=='Open'){ echo "<th><center>Czech</center></th>"; }?>
							<?php if($ll['Glambar']['Greece']=='Open'){ echo "<th><center>Greece</center></th>"; }?>
							<?php if($ll['Glambar']['Poland']=='Open'){ echo "<th><center>Poland</center></th>"; }?>
							<?php if($ll['Glambar']['Slovenia']=='Open'){ echo "<th><center>Slovenia</center></th>"; }?>
							<?php if($ll['Glambar']['SouthAfrica']=='Open'){ echo "<th><center>SouthAfrica</center></th>"; }?>
							
							<?php if($ll['Glambar']['Thailand']=='Open'){ echo "<th><center>Thailand</center></th>"; }?>
							
							
							<!--11Players-->
							
							<?php if($ll['11Players']['Bangladesh']=='Open'){ echo "<th><center>Bangladesh</center></th>"; }?>
							<?php if($ll['11Players']['Ethiopia']=='Open'){ echo "<th><center>Ethiopia</center></th>"; }?>
							<?php if($ll['11Players']['Ghana']=='Open'){ echo "<th><center>Ghana</center></th>"; }?>
							
							<?php if($ll['11Players']['Kenya']=='Open'){ echo "<th><center>Kenya</center></th>"; }?>
							<?php if($ll['11Players']['KSA']=='Open'){ echo "<th><center>KSA</center></th>"; }?>
							<?php if($ll['11Players']['Nigeria']=='Open'){ echo "<th><center>Nigeria</center></th>"; }?>
							
							
							<!--contest-->
							
							<?php if($ll['Contest']['Bahrain']=='Open'){ echo "<th><center>Bahrain</center></th>"; }?>
							<?php if($ll['Contest']['Qatar']=='Open'){ echo "<th><center>Qatar</center></th>"; }?>

							
							
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
<?php if($ll['Gamebar']['Bahrain']=='Open'){ echo "<td>".$row['gamebar_bahrain']."</td>"; }?>
<?php if($ll['Gamebar']['Bangladesh']=='Open'){ echo "<td>".$row['gamebar_bangladesh']."</td>"; }?>
<?php if($ll['Gamebar']['Czech']=='Open'){ echo "<td>".$row['gamebar_czech']."</td>"; }?>
<?php if($ll['Gamebar']['Egypt']=='Open'){ echo "<td>".$row['gamebar_egmon']."</td>"; }?>
<?php if($ll['Gamebar']['Ethiopia']=='Open'){ echo "<td>".$row['gamebar_ethiopia']."</td>"; }?>
<?php if($ll['Gamebar']['Finland']=='Open'){ echo "<td>".$row['gamebar_finland']."</td>"; }?>
<?php if($ll['Gamebar']['France']=='Open'){ echo "<td>".$row['gamebar_france']."</td>"; }?>
<?php if($ll['Gamebar']['Gabon']=='Open'){ echo "<td>".$row['gamebar_gabon']."</td>"; }?>
<?php if($ll['Gamebar']['Ghana']=='Open'){ echo "<td>".$row['gamebar_ghana']."</td>"; }?>
<?php if($ll['Gamebar']['Greece']=='Open'){ echo "<td>".$row['gamebar_paydashgr']."</td>"; }?>
<?php if($ll['Gamebar']['Indonesia']=='Open'){ echo "<td>".$row['gamebar_indoneisa']."</td>"; }?>
<?php if($ll['Gamebar']['Iraq']=='Open'){ echo "<td>".$row['gamebar_iraq']."</td>"; }?>
<?php if($ll['Gamebar']['Jordan']=='Open'){ echo "<td>".$row['gamebar_jordan']."</td>"; }?>
<?php if($ll['Gamebar']['Kenya']=='Open'){ echo "<td>".$row['gamebar_kenya']."</td>"; }?>
<?php if($ll['Gamebar']['KSA']=='Open'){ echo "<td>".$row['gamebar_ksa']."</td>"; }?>
<?php if($ll['Gamebar']['Kuwait']=='Open'){ echo "<td>".$row['gamebar_kuwait']."</td>"; }?>
<?php if($ll['Gamebar']['Myanmar']=='Open'){ echo "<td>".$row['gamebar_myanmar']."</td>"; }?>
<?php if($ll['Gamebar']['Mozambique']=='Open'){ echo "<td>".$row['gamebar_Mozambique']."</td>"; }?>
<?php if($ll['Gamebar']['Nigeria']=='Open'){ echo "<td>".$row['gamebar_Nigeria']."</td>"; }?>
<?php if($ll['Gamebar']['Oman']=='Open'){ echo "<td>".$row['gamebar_oman']."</td>"; }?>
<?php if($ll['Gamebar']['Pakistan']=='Open'){ echo "<td>".$row['gamebar_pk']."</td>"; }?>
<?php if($ll['Gamebar']['Palestine']=='Open'){ echo "<td>".$row['gamebar_Palestine']."</td>"; }?>
<?php if($ll['Gamebar']['Poland']=='Open'){ echo "<td>".$row['gamebar_pl']."</td>"; }?>
<?php if($ll['Gamebar']['Qatar']=='Open'){ echo "<td>".$row['gamebar_qatar']."</td>"; }?>
<?php if($ll['Gamebar']['Romania']=='Open'){ echo "<td>".$row['gamebar_ro']."</td>"; }?>
<?php if($ll['Gamebar']['Slovenia']=='Open'){ echo "<td>".$row['gamebar_slovenia']."</td>"; }?>
<?php if($ll['Gamebar']['SouthAfrica']=='Open'){ echo "<td>".$row['gamebar_southafrica']."</td>"; }?>
<?php if($ll['Gamebar']['Srilanka']=='Open'){ echo "<td>".$row['gamebar_lk']."</td>"; }?>



<?php if($ll['Gamebar']['Switzerland']=='Open'){ echo "<td>".$row['gamebar_switzerland']."</td>"; }?>
<?php if($ll['Gamebar']['Thailand']=='Open'){ echo "<td>".$row['gamebar_thailand']."</td>"; }?>
<?php if($ll['Gamebar']['UAE']=='Open'){ echo "<td>".$row['gamebar_uae']."</td>"; }?>
<?php if($ll['Gamebar']['Turkey']=='Open'){ echo "<td>".$row['gamebar_turkey']."</td>"; }?>
				
				
	
	<?php  $plt=$row['glambar_pl'] + $row['glambar_pldmc']; ?>
	
				<!--glambar-->
<?php if($ll['Glambar']['Czech']=='Open'){ echo "<td>".$row['glambar_czech']."</td>"; }?>
<?php if($ll['Glambar']['Greece']=='Open'){ echo "<td>".$row['Glambar_paydashgr']."</td>"; }?>
<?php if($ll['Glambar']['Poland']=='Open'){ echo "<td>".$plt."</td>"; }?>
<?php if($ll['Glambar']['Slovenia']=='Open'){ echo "<td>".$row['glambar_slovenia']."</td>"; }?>
<?php if($ll['Glambar']['SouthAfrica']=='Open'){ echo "<td>".$row['Glambar_southafrica']."</td>"; }?>
<?php if($ll['Glambar']['Thailand']=='Open'){ echo "<td>".$row['glambar_thailand']."</td>"; }?>
				
		<!--11Players-->		
<?php if($ll['11Players']['Bangladesh']=='Open'){ echo "<td>".$row['11Players_bd']."</td>"; }?>
<?php if($ll['11Players']['Ethiopia']=='Open'){ echo "<td>".$row['11players_ethiopia']."</td>"; }?>
<?php if($ll['11Players']['Ghana']=='Open'){ echo "<td>".$row['11players_ghana']."</td>"; }?>
<?php if($ll['11Players']['Kenya']=='Open'){ echo "<td>".$row['11Players_kenya']."</td>"; }?>
<?php if($ll['11Players']['KSA']=='Open'){ echo "<td>".$row['11Players_KSA']."</td>"; }?>

<?php if($ll['11Players']['Nigeria']=='Open'){ echo "<td>".$row['11Players_nigeria']."</td>"; }?>			
															
	

<!--Contest-->		
<?php if($ll['Contest']['Bahrain']=='Open'){ echo "<td>".$row['contest_bh']."</td>"; }?>
<?php if($ll['Contest']['Qatar']=='Open'){ echo "<td>".$row['contest_qatar']."</td>"; }?>


	
												
							</tr>
							
							
							
							<?php
							
						}
					
			}


					
					 //$next_date = date('Y-m-d', strtotime($date1 .' +1 day'));
				if($c==1)
				{
					//cho "hi2";
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
						
						
						
						$gamebar_gabon=0;
						
						 $result1 = $con1->query("call fashionbardb_gabon.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_gabon=$row1['act'];
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
						
						 $result1 = $con1->query("call fashionbardb_paygurutr.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_turkey=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$gamebar_switzerland=0;
						
						 $result1 = $con1->query("call gamebar_ch_nth.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_switzerland=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						 $result1 = $con1->query("call fashionbardb_sa11.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$players_ksa=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						
						
						$gamebar_iraq1=$gamebar_iraq=0;
						
						 $result1 = $con1->query("call gamebar_iqzain_qg.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_iraq1=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						
						$gamebar_iraqmwapi=0;
						
						 $result1 = $con1->query("call gamebar_iqmw_api.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_iraqmwapi=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						$gamebar_iraq=$gamebar_iraq1+$gamebar_iraqmwapi;					
						
						
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
						
						$result1 = $con1->query("call fashionbardb_pkzong.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
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
						
						$result1 = $con1->query("call gamebar_slovenia.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result1);
						
						while($row1=mysqli_fetch_array($result1))
						{
							$gamebar_slovenia=$row1['act'];
							$malaysiadt=$row1['dt'];
							
						}
						$result1->close();
						$con1->next_result();
						
						
						
						$glambar_slovenia=0;
						
						$result1 = $con1->query("call glambar_slovenia.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
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
						
						$gamebar_indonesia1=0;
						$result2 = $con1->query("call gamebardb_indonesia.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_indonesia1=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_indonesia2=0;
						$result2 = $con1->query("call fashionbardb_idtelkomsel.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_indonesia2=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_indonesia=$gamebar_indonesia2+$gamebar_indonesia1;
						
						
						
						
						
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
						
						
						
						$gamebar_kenya=0;
						$result2 = $con1->query("call fashionbardb_safaricom.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_kenya=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_jordan1=0;
						
						$result2 = $con1->query("call fashionbardb_joorange.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_jordan1=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_jordanum=0;
						$result2 = $con1->query("call fashionbardb_joumniah.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_jordanum=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_zain=0;
						$result2 = $con1->query("call gamebar_jozain.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_zain=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_jordan=$gamebar_jordan1+$gamebar_jordanum+$gamebar_zain;
						
						
						$gamebar_bangladesh1=0;
						$result2 = $con1->query("call gamebar_bdgrameen.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_bangladesh1=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_bangladesh2=0;
						$result2 = $con1->query("call fashionbardb_bdgp.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_bangladesh2=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_bangladesh3=0;
						$result2 = $con1->query("call gamebar_bdrobi.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_bangladesh3=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_ghana=0;
						$result2 = $con1->query("call gamebar_ghairtel_mtech.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_ghana=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$players_ng=0;
						$result2 = $con1->query("call fashionbardb_ngmtn11.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_ng=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$gamebar_Palestine=0;
						$result2 = $con1->query("call fashionbardb_psjw.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_Palestine=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						
						$gamebar_Nigeriammt=0;
						$result2 = $con1->query("call gamebar_nigeria_MMT.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_Nigeriammt=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						
						
						$gamebar_Nigeriamtn=0;
						$result2 = $con1->query("call fashionbardb_ngmtn.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_Nigeriamtn=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						$gamebar_Nigeria=0;
						$gamebar_Nigeria=$gamebar_Nigeriammt+$gamebar_Nigeriamtn;
						
						
						
						$players_kenya=0;
						$result2 = $con1->query("call fashionbardb_safaricompkm.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_kenya=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						$players_bd=$players_bd_daily=$players_bd_weekly=$players_bd_monthly=0;
						$result2 = $con1->query("call 11players_bdrobi.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_daily=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$result2 = $con1->query("call 11players_bdrobi_weekly.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_weekly=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$result2 = $con1->query("call 11players_bdrobi_monthly.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_bd_monthly=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						$players_bd=$players_bd_daily+$players_bd_weekly+$players_bd_monthly;
						
						
						
						$gamebar_bangladesh=$gamebar_bangladesh2+$gamebar_bangladesh1+$gamebar_bangladesh3;
						
						
						$cc=1;
						
						$contest_qatar=0;
						
						$result2 = $con1->query("call contestdb_qaoo.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$contest_qatar=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						
						$gamebar_et=0;
						
						$result2 = $con1->query("call gamebar_ethopia.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_et=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						$players_et=0;
						
						$result2 = $con1->query("call 11players_ethopia.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_et=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$players_ghana=0;
						
						$result2 = $con1->query("call fashionbardb_ghmtn11.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$players_ghana=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$gamebar_lk=0;
						
						$result2 = $con1->query("call gamebar_lk_dig.getactivation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$gamebar_lk=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
						
						
						$constest_bh=0;
						
						$result2 = $con1->query("call contestdb_bh.get_activation('".$start_date."',  '".$end_date."', ".$hours.") ");
						$rows=mysqli_num_rows($result2);
						$saact=0;
						
						while($row1=mysqli_fetch_array($result2))
						{
							$constest_bh=$row1['act'];
							$sagdate=$row1['dt'];
							
						}
						
						$result2->close();
						$con1->next_result();
						
					
						//echo $airtel_gamebar;
					?>
			
			
			
			
			
				
					<tr>
					<td><?php echo $date1 ?></td>			

<?php if($ll['Gamebar']['Bahrain']=='Open'){ echo "<td>".$gamebar_bahrain."</td>"; }?>
<?php if($ll['Gamebar']['Bangladesh']=='Open'){ echo "<td>".$gamebar_bangladesh."</td>"; }?>

<?php if($ll['Gamebar']['Czech']=='Open'){ echo "<td>".$gamebar_cz."</td>"; }?>
<?php if($ll['Gamebar']['Egypt']=='Open'){ echo "<td>".$gamebar_egmon."</td>"; }?>
<?php if($ll['Gamebar']['Ethiopia']=='Open'){ echo "<td>".$gamebar_et."</td>"; }?>
<?php if($ll['Gamebar']['Finland']=='Open'){ echo "<td>".$gamebar_finland."</td>"; }?>
<?php if($ll['Gamebar']['France']=='Open'){ echo "<td>".$gamebar_france."</td>"; }?>
<?php if($ll['Gamebar']['Gabon']=='Open'){ echo "<td>".$gamebar_gabon."</td>"; }?>
<?php if($ll['Gamebar']['Ghana']=='Open'){ echo "<td>".$gamebar_ghana."</td>"; }?>
<?php if($ll['Gamebar']['Greece']=='Open'){ echo "<td>".$gamebar_paydashgr."</td>"; }?>
<?php if($ll['Gamebar']['Indonesia']=='Open'){ echo "<td>".$gamebar_indonesia."</td>"; }?>
<?php if($ll['Gamebar']['Iraq']=='Open'){ echo "<td>".$gamebar_iraq."</td>"; }?>
<?php if($ll['Gamebar']['Jordan']=='Open'){ echo "<td>".$gamebar_jordan."</td>"; }?>
<?php if($ll['Gamebar']['Kenya']=='Open'){ echo "<td>".$gamebar_kenya."</td>"; }?>
<?php if($ll['Gamebar']['KSA']=='Open'){ echo "<td>".$gamebar_ksa."</td>"; }?>
<?php if($ll['Gamebar']['Kuwait']=='Open'){ echo "<td>".$gamebar_kuwait."</td>"; }?>
<?php if($ll['Gamebar']['Myanmar']=='Open'){ echo "<td>".$gamebar_myanmar."</td>"; }?>
<?php if($ll['Gamebar']['Mozambique']=='Open'){ echo "<td>".$gamebar_Mozambique."</td>"; }?>
<?php if($ll['Gamebar']['Nigeria']=='Open'){ echo "<td>".$gamebar_Nigeria."</td>"; }?>
<?php if($ll['Gamebar']['Oman']=='Open'){ echo "<td>".$gamebar_oman."</td>"; }?>
<?php if($ll['Gamebar']['Pakistan']=='Open'){ echo "<td>".$gamebar_pk."</td>"; }?>
<?php if($ll['Gamebar']['Palestine']=='Open'){ echo "<td>".$gamebar_Palestine."</td>"; }?>
<?php if($ll['Gamebar']['Poland']=='Open'){ echo "<td>".$gamebar_pl."</td>"; }?>
<?php if($ll['Gamebar']['Qatar']=='Open'){ echo "<td>".$gamebar_qatar."</td>"; }?>
<?php if($ll['Gamebar']['Romania']=='Open'){ echo "<td>".$gamebar_ro."</td>"; }?>
<?php if($ll['Gamebar']['Slovenia']=='Open'){ echo "<td>".$gamebar_slovenia."</td>"; }?>
<?php if($ll['Gamebar']['SouthAfrica']=='Open'){ echo "<td>".$sagact."</td>"; }?>
<?php if($ll['Gamebar']['Srilanka']=='Open'){ echo "<td>".$gamebar_lk."</td>"; }?>
<?php if($ll['Gamebar']['Switzerland']=='Open'){ echo "<td>".$gamebar_switzerland."</td>"; }?>
<?php if($ll['Gamebar']['Thailand']=='Open'){ echo "<td>".$gamebar_thailand."</td>"; }?>
<?php if($ll['Gamebar']['UAE']=='Open'){ echo "<td>".$gamebar_uae."</td>"; }?>
<?php if($ll['Gamebar']['Turkey']=='Open'){ echo "<td>".$gamebar_turkey."</td>"; }?>
				
				
	<?php $plt1=$glambar_pl+$glambar_pldmc; ?>
	
	
				<!--glambar-->
<?php if($ll['Glambar']['Czech']=='Open'){ echo "<td>".$glambar_czech."</td>"; }?>
<?php if($ll['Glambar']['Greece']=='Open'){ echo "<td>".$glambar_paydashgr."</td>"; }?>
<?php if($ll['Glambar']['Poland']=='Open'){ echo "<td>".$plt1."</td>"; }?>
<?php if($ll['Glambar']['Slovenia']=='Open'){ echo "<td>".$glambar_slovenia."</td>"; }?>
<?php if($ll['Glambar']['SouthAfrica']=='Open'){ echo "<td>".$glambarsouthafrica."</td>"; }?>
<?php if($ll['Glambar']['Thailand']=='Open'){ echo "<td>".$glambar_thailand."</td>"; }?>
							
								
			<!--11Players-->				
<?php if($ll['11Players']['Bangladesh']=='Open'){ echo "<td>".$players_bd."</td>"; }?>
<?php if($ll['11Players']['Ethiopia']=='Open'){ echo "<td>".$players_et."</td>"; }?>
<?php if($ll['11Players']['Ghana']=='Open'){ echo "<td>".$players_ghana."</td>"; }?>
<?php if($ll['11Players']['Kenya']=='Open'){ echo "<td>".$players_kenya."</td>"; }?>
<?php if($ll['11Players']['KSA']=='Open'){ echo "<td>".$players_ksa."</td>"; }?>

<?php if($ll['11Players']['Nigeria']=='Open'){ echo "<td>".$players_ng."</td>"; }?>	



				
<?php if($ll['Contest']['Bahrain']=='Open'){ echo "<td>".$constest_bh."</td>"; }?>					
<?php if($ll['Contest']['Qatar']=='Open'){ echo "<td>".$contest_qatar."</td>"; }?>					
							
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
						
						
						
					<div id="tableCopyContainer"></div>
					<div id="output"></div>
						
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
<script>
function transposeTable() {
  const table = document.getElementById("myTable");
  const rows = Array.from(table.rows);
  
  // Normalize the table into a grid accounting for colspan and rowspan
  const grid = [];
  let maxCols = 0;

  for (let i = 0; i < rows.length; i++) {
    const row = [];
    let colIndex = 0;
    if (!grid[i]) grid[i] = [];

    for (let cell of rows[i].cells) {
      // Skip filled cells (due to span from previous row)
      while (grid[i][colIndex]) colIndex++;

      const colspan = cell.colSpan || 1;
      const rowspan = cell.rowSpan || 1;

      for (let r = 0; r < rowspan; r++) {
        for (let c = 0; c < colspan; c++) {
          const rowIndex = i + r;
          const cellIndex = colIndex + c;
          if (!grid[rowIndex]) grid[rowIndex] = [];
          grid[rowIndex][cellIndex] = (r === 0 && c === 0) ? cell.cloneNode(true) : null;
        }
      }

      colIndex += colspan;
    }

    maxCols = Math.max(maxCols, grid[i].length);
  }

  // Build transposed table
  const newTable = document.createElement("table");
newTable.border = "1";
  for (let col = 0; col < maxCols; col++) {
    const newRow = newTable.insertRow();
    for (let row = 0; row < grid.length; row++) {
      const cell = grid[row][col];
      if (cell === undefined) continue;
      if (cell === null) continue; // skip spanned positions

      const newCell = cell.tagName === "TH"
        ? document.createElement("th")
        : document.createElement("td");

      newCell.innerHTML = cell.innerHTML;

      // Convert colspan to rowspan
      if (cell.colSpan > 1) newCell.rowSpan = cell.colSpan;
      if (cell.rowSpan > 1) newCell.colSpan = cell.rowSpan;

      newRow.appendChild(newCell);
    }
  }

  document.getElementById("output").innerHTML = "";
  document.getElementById("output").appendChild(newTable);
}
</script>