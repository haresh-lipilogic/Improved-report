<?php

ini_set('max_execution_time', 6000);

//include("includes/check_session.php");
//include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);
$con=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$con3=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2

$report='gamebardb_vodafone_qatar_report';



//$con1=new mysqli("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster1

$con1=$con;
$start_date='';
$end_date='';
$operator='';
$product='';
$count=0;
$cc=0;
$date1=date('Y-m-d');



if(isset($_POST['submit']))
{
	//print_r($_POST);exit;

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
 $advertiserid=$_POST['advertiserid']; 
 $display=$_POST['display']; 
 $hours=$_POST['hours']; 
//print_r($_POST); exit;
if($start_date == $end_date)
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
		$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
		$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
	}	
	else
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
		$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
		$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
	}

	 $sql_ad="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."' and (perform_act like '%call%' or perform_callback  like '%call%' or perform_click like '%call%' or perform_lowbalance like '%call%' or perform_trial like '%call%' or perform_pinconfirm  like '%call%' or perform_centtocg  like '%call%') order by operator asc ";
	$res_op=mysqli_query($con,$sql_ad);
	
	
	$sql="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."' and operator='".$operator."' ";
			$res=mysqli_query($con,$sql);
			
			while($row=mysqli_fetch_array($res))
			{
				$act=$row['perform_act'];
				$callback=$row['perform_callback'];
				$click=$row['perform_click'];
				$lowbalance=$row['perform_lowbalance'];
				$trial=$row['perform_trial'];
				$pinconfirm=$row['perform_pinconfirm'];
				$centtocg=$row['perform_centtocg'];
				$cr=$row['perform_cr'];
				$renewal=$row['perform_renewal'];
				$pc=$row['perform_chargingpercent'];
			
			}
			
			if($display=='activation')
			{
				$url=$act;
				//$url1=$mainreportall;
				//$adve=0;
				//$advertiserid=0;
			}
			else if($display=='callbacksent'){
				$url=$callback;
				
			}
			else if($display=='clicks'){
				$url=$click;
				
			}
			else if($display=='low'){
				$url=$lowbalance;
				
			}
			else if($display=='trial'){
				$url=$trial;
				
			}
			else if($display=='pinconfirmed'){
				$url=$pinconfirm;
				
			}
			else if($display=='cr'){
				$url=$cr;
				
			}
			else if($display=='pc'){
				$url=$pc;
				
			}
			else if($display=='renewal'){
				$url=$renewal;
				
			}
			else{
				$url=$centtocg;
			}
			
			
		
	
	//echo $url;exit;
	
	
	
	$url=str_replace("[start_date]",$start_date,$url);
	$url=str_replace("[end_date]",$end_date,$url);
	$query=str_replace("[hours]",$hours,$url);
	
	//$query=str_replace("[advid]",$adve,$url);
	
	
	//echo$query;exit;
	
	$res=mysqli_query($con,$query);
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					$act = array();
					while($row=mysqli_fetch_array($res))
					{
							//echo $row['dt'];exit;
						if($prevdate == "")
							$prevdate = $row['dt'];
						
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act = array();
							$prevdate = $row['dt'];
						}
						
						
							$act[$row['advname']]= $row['act'];	
						
						
						
						if(!in_array($row['advname'], $advname)) 
							$advname[] = $row['advname'];

						if(!in_array($row['dt'], $arrdt)) 
							$arrdt[] = $row['dt'];		
						
					}
					$dt[$prevdate]= $act;
					
					//print_r($dt);exit;
					//$advname=array_merge($advname,$advname2);
					//$act=array_merge($act,$act2);
					//$arrdt=array_merge($arrdt,$arrdt2);
					//$advname=array_unique($advname);
					//$dt=array_merge($dt,$dt2);
	
	//print_r($dt);exit;
	
	
	
	
	
			
	$start_date2=$_POST['start_date'];
$end_date2=$_POST['end_date'];

}
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
                    <h2>Search URLs <small></small></h2>
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
                    <form class="form-horizontal form-label-left input_mask" method="post">
					
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control" id="product" >
							<option>Product</option>
							<option value="gamebar" <?php if($product=='gamebar'){$selected='selected';}else{$selected='';} echo $selected; ?>>Gamebar</option>
							<option value="glambar" <?php if($product=='glambar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Glambar</option>
							<option value="11Players" <?php if($product=='11Players'){$selected='selected';}else{$selected='';} echo $selected; ?> >11Players</option>
							<option value="Contest" <?php if($product=='Contest'){$selected='selected';}else{$selected='';} echo $selected; ?> >Contest</option>
							
						</select>
						</div>
						
						<?php
						if($count==0)
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback first"> operator
							<span class="response1">
							</span>
							
							</div>
						<?php
						}
						else
						{
							//echo $operator;exit;
						?>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback two"> operator
								<span class="response1" id="f1">
								</span>
								<span id="t1">
								<select name="operator" id="operator" class="form-control select1_single sel1" onchange="myfun1()">
									<?php
									
									
									while($row_op=mysqli_fetch_array($res_op))
									{
										if($row_op['operator']==$operator)
										{
											$selected="selected";
										}
										else
										{
											$selected="";
										}
									?>
									<option value="<?php echo $row_op['operator']; ?>" <?php echo $selected; ?>><?php echo $row_op['operator']; ?></option>
									<?php
									}
									?>
									
								</select>
								</span>
							</div>
						<?php
						}
						?>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date!=''){ echo date('d-m-Y',strtotime($start_date2)); } else { echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date!=''){echo date('d-m-Y',strtotime($end_date2));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Display
								<select name="display" class="form-control">
									
									<option value="activation" <?php $selected=''; if($display=='activation') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Activations</option>
									<option value="renewal" <?php $selected=''; if($display=='renewal') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Renewal</option>
									<option value="callbacksent" <?php  $selected=''; if($display=='callbacksent') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Callback Sent</option>
									<option value="clicks" <?php  $selected=''; if($display=='clicks') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Clicks</option>
									<option value="low" <?php  $selected=''; if($display=='low') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Low-Balance</option>
									<option value="trial" <?php  $selected=''; if($display=='trial') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Trial</option>
									<option value="pinconfirmed" <?php  $selected=''; if($display=='pinconfirmed') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Pin confirmed</option>
									<option value="sentcg" <?php  $selected=''; if($display=='sentcg') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Sent to CG</option>
									<option value="cr" <?php  $selected=''; if($display=='cr') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Cr</option>
									<option value="pc" <?php  $selected=''; if($display=='pc') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>%Charging</option>
								
								</select>
								
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
						

						<br><br><br><br>
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
						  <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
			if($count==1)
			{
				//print_r($advname);exit;
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							
								<thead>
									<tr>
										
										<td><strong>Date</strong></td>
										
										<?php
										foreach($advname as $key=>$val)
										{
											?>
											<td><?php echo $val; ?></td>
											<?php
										}
										?>
										<td><strong>Total</strong></td>
											
									</tr>
								</thead>


								<tbody>
									
																
									<?php  
									//print_r($dt);exit;

									foreach($dt as $key=>$val) { ?>
										<tr>

											<td><?php echo $key; ?></td>
											<?php $sum=0; foreach($advname as $adkey=>$adval) { 
											if(array_key_exists($adval, $val))
											{
											?>

											
											
											<?php
											//echo $display;exit;
											if($display=='cr'){
											?>
											<td><?php echo  $a=number_format((float)$val[$adval], 2, '.', '') ; $sum=$sum+$a;?></td>
											
											<?php 
											}else{
											?>	
												<td><?php echo $a=$val[$adval]; $sum=$sum+$a;?></td>
												
											<?php	
											}
											}
											else
											{
											?>
											<td><?php echo '0'; ?></td>
											<?php

											}
											}?>
											<td><?php echo $sum; ?></td>
										</tr>

									<?php } ?>
																
								</tbody>
							
							
							
							
								
								
						</table>
					  </div>
				
			<?php
			}
			else
			{}
			?>
					</div>
                </div>
			</div>
		</div>
		
       <?php
	   include("includes/footer.php");
		?>
		
<script type="text/javascript">
 
</script>		
		
		
		
		
		
<script type="text/javascript">
 $(document).ready(function(){

   $("#product").change(function(){
		
		var check1=$("#check1").val();
		if(check1 == 0)
		{
			
		}
		else	
		{
			$(".sel1").val('');
			$("#t1").hide();
			$("#f1").show();
						
		}
       
		var product = $("#product").val();
        $.ajax({
            type: "GET",
            url: "ajax/findoperatorperform.php?product="+product         
			
        }).done(function(data){
			
			
            $(".response1").html(data);
			 
        });
    });
});
</script>
<script type="text/javascript">
function myfun1() {
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
            url: "ajax/advertisermainreport.php?operator="+operator+"&product="+product         
			
        }).done(function(data){
            $(".response").html(data);
			 
        });

}	
</script>		




<script type="text/javascript">
function myfun() {
	var x = document.getElementById("product").value;
    //alert(x);
	if(x =='glambar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Thailand', 'thailand_svobi');
		select.options[select.options.length] = new Option('New_Thailand', 'new_thailand');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Kenya_Oxygen', 'kenya_oxygen');
		select.options[select.options.length] = new Option('Poland', 'poland');
		select.options[select.options.length] = new Option('Vodacom_Wfh', 'vodacom_wfh');
		select.options[select.options.length] = new Option('Vodacom_Fg', 'vodacom_fg');
		select.options[select.options.length] = new Option('Vodacom_Bt', 'vodacom_bt');
		select.options[select.options.length] = new Option('Cosmote_Greece', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Vodafone_Greece', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Wind_Greece', 'Wind_Greece');
		select.options[select.options.length] = new Option('All_Greece D', 'all_greece');
	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		
		select.options[select.options.length] = new Option('Ooredoo_Oman', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Qatar_Gamestation', 'qatar_gamestation');
		select.options[select.options.length] = new Option('Ooredoo_Qatar', 'ooredoo_qatar');
		select.options[select.options.length] = new Option('Qu_Qatar', 'qu_qatar');
		select.options[select.options.length] = new Option('Cellcom_Malaysia', 'malaysia_cellcom');
		
		
		//select.options[select.options.length] = new Option('Airtel_India', 'airtel_india');
	//	select.options[select.options.length] = new Option('Bsnl_India', 'bsnl_india');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('Egypt', 'egypt');
		select.options[select.options.length] = new Option('Du_Dubai', 'du_dubai');
		select.options[select.options.length] = new Option('Kenya_Oxygen', 'kenya_oxygen');
		
		select.options[select.options.length] = new Option('Myanmar', 'myanmar');
		//select.options[select.options.length] = new Option('Kazakistan', 'kazakistan');
	
		
		select.options[select.options.length] = new Option('Poland', 'poland');
		select.options[select.options.length] = new Option('Bangladesh', 'Bangladesh_Robi');
		select.options[select.options.length] = new Option('Srilanka', 'dialog_srilanka');
		select.options[select.options.length] = new Option('Cosmote_Greece', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Vodafone_Greece', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Wind_Greece', 'Wind_Greece');
		select.options[select.options.length] = new Option('All_Greece D', 'all_greece');
		//select.options[select.options.length] = new Option('Mts_Serbia', 'Mts_Serbia');
		//select.options[select.options.length] = new Option('Vip_Serbia', 'Vip_Serbia');
		select.options[select.options.length] = new Option('Du_UAE', 'du_uae');
		select.options[select.options.length] = new Option('Etisalad_UAE', 'etisalad_uae');
		select.options[select.options.length] = new Option('Palestine', 'palestine');
		select.options[select.options.length] = new Option('Blazon_etisalad', 'blazon_etisalad');
		select.options[select.options.length] = new Option('Algeria', 'algeria');
		select.options[select.options.length] = new Option('Kuwait-Zain', 'kwzain');
		select.options[select.options.length] = new Option('Kuwait-Viva', 'kwviva');
		select.options[select.options.length] = new Option('Pk-Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('U.K.', 'unitedkingdom');
		//select.options[select.options.length] = new Option('Upstream_Thailand', 'upstream_thailand');
		select.options[select.options.length] = new Option('NL-D', 'netherland');
		select.options[select.options.length] = new Option('NL-N', 'netherland_netsmart');
		select.options[select.options.length] = new Option('France', 'france');
		select.options[select.options.length] = new Option('Bahrain', 'bahrain');
		select.options[select.options.length] = new Option('Greece N', 'gr2');
		select.options[select.options.length] = new Option('Norway', 'norway');
		select.options[select.options.length] = new Option('Saudi_Mobily', 'saudi_mobily');
		
	}
	
	/*if(x=="glambar")
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
 
