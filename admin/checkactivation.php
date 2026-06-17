<?php

ini_set('max_execution_time', 6000);

include("includes/check_session.php");
//include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);
$con=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$con3=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2





//$con1=new mysqli("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster1

$con1=$con;
$start_date='';
$end_date='';
$operator='';
$product='';
$count=0;
$cc=0;
if(isset($_POST['submit']))
{

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
$date1=date('Y-m-d');
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
   $advertiserid=$_POST['advertiserid']; 
//echo $operator;

// report logic below
	
	
	$data['startdate']=$start_date;
	$data['enddate']=$end_date;
	$data['db']=$db;
	//$data['dblog']=$dblog;
	$data['advertiser']=$advertiserid;
	//echo $operator;exit;
$fields=mysqli_num_fields($res);// number of fields in table

//echo "<script>window.location='report.php';</script>";
$start_date2=$_POST['start_date'];
$end_date2=$_POST['end_date'];



$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
 $sql1="select * from gamebardb_vodafone_qatar_report.mainreport where date ='".$start_date."'   and advertiser='0' order by actcount asc,renewcount asc ";
$res1=mysqli_query($con,$sql1);

	//					exit;

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
                    <h2>Search Report <small>Clicks, Activation, Deactivation, Churn, Amount, Revenue</small></h2>
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
					
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date!=''){ echo date('d-m-Y',strtotime($start_date2)); } else { echo date('d-m-Y');} ?>"  type="text">
						</div>
						
						
						
						<br>
						
						

                     
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
			//echo $operator;
			
				
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>Date</strong></td>
									<td><strong>Country</strong></td>
									<td><strong>Product</strong></td>
									<td><strong>Operator</strong></td>
									<td><strong>Activation</strong></td>
									<td><strong>Renewal</strong></td>
									
									
									
									
									
								</tr>
							</thead>


							<tbody>
								<?php 
							//echo $sql;
								$click_sum='';
								$uniq_sum='';
								$cg_sum='';
								$act_sum='';
								$actamnt_sum='';
								$ren_sum='';
								$renamnt_sum='';
								$count_sum='';
								$amount_sum='';
								$low_sum='';
								$cbsent_sum='';
								$churn_sum='';
								$advcost_sum=$svmobiamount_sum='';
									
								
									
									
									if(mysqli_num_rows ($res1)>0)
									{
										$l=1;
									}
									while($row1=mysqli_fetch_array($res1))
									{
										
								?>
									<tr>
										<td><?php echo $dat2=date('d-m-Y',strtotime($row1['Date']));  ?></td>
										<td><?php echo $row1['country'];?></td>
										<td><?php echo $row1['product'];?></td>
										<td><?php echo $row1['operator'];?></td>
										<td <?php if($row1['actcount']==0){?> style="color:white;font-weight:bold;background:#ff9999;padding:5px;" <?php }?>><?php echo $row1['actcount'];?></td>
										<td <?php if($row1['renewcount']==0){?> style="color:white;font-weight:bold;background:#ff9999;padding:5px;" <?php }?>><?php echo $row1['renewcount'];?></td>
										
										
										
									</tr>
								<?php
									}
								
								
								?>
							</tbody>
							
							
								
								
						</table>
					  </div>
				<!--<div id="advertiser"></div>-->
			<?php
			
			
			?>
					</div>
                </div>
			</div>
			
		</div>
        <!-- /page content -->
		
       <?php
	   include("includes/footer.php");
		?>
		
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
	if(x =='glambar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Greece_All D', 'all_greece');
		select.options[select.options.length] = new Option('Greece_Cosmote', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Greece_Vodafone', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Greece_Wind', 'Wind_Greece');
		select.options[select.options.length] = new Option('Italy_Tim', 'italy_tim');
		select.options[select.options.length] = new Option('New_Thailand', 'new_thailand');
		select.options[select.options.length] = new Option('Poland_TMobile', 'poland');
		select.options[select.options.length] = new Option('SouthAfrica_Bt', 'vodacom_bt');
		select.options[select.options.length] = new Option('SouthAfrica_Fg', 'vodacom_fg');
		select.options[select.options.length] = new Option('SouthAfrica_Wfh', 'vodacom_wfh');
		select.options[select.options.length] = new Option('Spain_Vodafone', 'spain');
		select.options[select.options.length] = new Option('Thailand', 'thailand_svobi');

	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		//select.options[select.options.length] = new Option('Qatar_Vodafone', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('Algeria', 'algeria');
		select.options[select.options.length] = new Option('Bahrain_All', 'bahrain');
		select.options[select.options.length] = new Option('Bahrain_stc', 'bahrain_stc');
		select.options[select.options.length] = new Option('Bahrain_Batelco', 'bahrain_batelco');
		select.options[select.options.length] = new Option('Bahrain_zain', 'buhrain_zain');
		select.options[select.options.length] = new Option('Bangladesh_Robi', 'Bangladesh_Robi');
		select.options[select.options.length] = new Option('Egypt', 'egypt');
		//select.options[select.options.length] = new Option('Etisalad_Blazon', 'blazon_etisalad');
		select.options[select.options.length] = new Option('France', 'france');
		select.options[select.options.length] = new Option('Greece_All D', 'all_greece');
		select.options[select.options.length] = new Option('Greece_Cosmote', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Greece_N', 'gr2');
		select.options[select.options.length] = new Option('Greece_Vodafone', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Greece_Wind', 'Wind_Greece');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('Italy_Tim', 'italy_tim');
		select.options[select.options.length] = new Option('KSA_All', 'ksa_all');
		select.options[select.options.length] = new Option('KSA_Mobily', 'saudi_mobily');
		select.options[select.options.length] = new Option('KSA_Stc', 'stc_ksa');
		select.options[select.options.length] = new Option('KSA_Zain', 'saudiarabia_zain');
		select.options[select.options.length] = new Option('Kuwait_Zain', 'kwzain');
		select.options[select.options.length] = new Option('Malaysia_Cellcom', 'malaysia_cellcom');
		select.options[select.options.length] = new Option('Malaysia_maxis', 'malaysiamaxis');
		select.options[select.options.length] = new Option('Myanmar_Telenor', 'myanmar');
		select.options[select.options.length] = new Option('Netherland_N', 'netherland_netsmart');
		select.options[select.options.length] = new Option('Norway', 'norway');
		select.options[select.options.length] = new Option('Oman_Ooredoo', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Pakistan_Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('Pakistan_zong', 'pk_zong');
		select.options[select.options.length] = new Option('Poland_TMobile', 'poland');
		select.options[select.options.length] = new Option('Qatar_Gamestation', 'qatar_gamestation');
		select.options[select.options.length] = new Option('Qatar_Ooredoo', 'ooredoo_qatar');
		select.options[select.options.length] = new Option('Qatar_Vodafone', 'vodafoneqatar');
		select.options[select.options.length] = new Option('Russia', 'russia');
		//select.options[select.options.length] = new Option('SaudiArabia_Zain', 'saudiarabia_zain');
		select.options[select.options.length] = new Option('SouthAfrica_Cellc', 'southafricacellc');
		select.options[select.options.length] = new Option('SouthAfrica_Mtn', 'southafricamtn');
		select.options[select.options.length] = new Option('SouthAfrica_Vodacom', 'vodacom_za');
		select.options[select.options.length] = new Option('Spain_Vodafone', 'spain');
		select.options[select.options.length] = new Option('Srilanka_Dialog', 'dialog_srilanka');
		select.options[select.options.length] = new Option('UAE_Etisalat', 'uae_etisalat');
		

		
		
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

