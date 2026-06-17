<?php
error_reporting(0);
include("includes/check_session.php");
include("includes/connection.php");
//$con1=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error());
$con1=$con;

$sum=0;
$start_date='';
$end_date='';
$start_date1='';
$end_date1='';
$operator='';
$product='';
$count=0;
$display='';
$report='gamebardb_vodafone_qatar_report';

if(isset($_POST['submit']))
{
	
	
	$count=1;
	//$operator=$_POST['operator'];
	$product=$_POST['product'];
	$date1=date('Y-m-d');
	
	$hours=$_POST['hours'];
	//$display=$_POST['display']; 
	
	$b=$c=0;
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


	$compare="2020-04-13";
	if(strtotime($start_date1) < strtotime($compare))
	{
		
		$start_date1='2020-04-13  00:00:00';
		$start_date='2020-04-13 00:00:00';
	}
	$backdate=date('Y-m-d',strtotime('-1 days'));
	
	if($enddate1>$date1)
	{
		$end_date1=$backdate." 23:59:59";
		$end_date=$backdate." 00:00:00";
		
	}
	
		//echo time($startdate1);
		//echo Time('2020-04-13');
	
	
	 $sql2="select mainreport.product,mainreport.operator,advertiser,advname,sum(cbsent)sum,operatorcost_usd from ".$report.".mainreport left join ".$report.".operatorcost on mainreport.operator=operatorcost.operator where date >='".$start_date1."' and date<='".$end_date1."' and mainreport.product='".$product."'  and advertiser>0 and cbsent>0 group by  mainreport.product,mainreport.operator,advertiser order by Product asc,operator asc;";


				
				$res2=mysql_query($sql2,$con1);
					
	
	
	
		
		
}
	
	



//$res=mysql_query($sql) or die(mysql_error());
//$fields=mysql_num_fields($res);// number of fields in table

//echo "<script>window.location='report.php';</script>";

//echo $sql;

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
                    <h2>Perform Report</h2>
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
					<input type="text" hidden value="<?php echo $count; ?>"   id="check1">
					
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control" id="product" onchange="myfun()">
							<option>Product</option>
							<option value="gamebar" <?php if($product=='gamebar'){$selected='selected';}else{$selected='';} echo $selected; ?>>Gamebar</option>
							<option value="glambar" <?php if($product=='glambar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Glambar</option>
							
						</select>		
						</div>
						
						
						
						
						
						
						
						
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date1!=''){echo date('d-m-Y',strtotime($start_date1));}else{ echo date('d-m-Y',strtotime('-1 days'));} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date1!=''){echo date('d-m-Y',strtotime($end_date1));}else{ echo date('d-m-Y',strtotime('-1 days') );} ?>" type="text">
						</div>
						
							
							
							
						
						

                     
						<div class="col-md-12 col-sm-12 col-xs-12">
						 
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
										
										
										
										
										<td><strong>Product</strong></td>
										<td><strong>Operator</strong></td>
										<td><strong>Adertiser</strong></td>
										<td><strong>CallBackSent</strong></td>
										<td><strong>Callback Cost</strong></td>
										<td><strong>Total Cost in USD</strong></td>
										
											
									</tr>
								</thead>


								<tbody>
									
																
									<?php
									
									while($row2=mysql_fetch_array($res2))
									{	
										?>
											<tr>
											<td><?php echo $row2['product'];?></td>
											<td><?php echo $row2['operator'];?></td>
											<td><?php echo $row2['advname'];?></td>
											<td><?php echo $row2['sum'];?></td>
											<td><?php echo $row2['operatorcost_usd'];?></td>
											<td><?php echo $row2['sum'] * $row2['operatorcost_usd']    ;?></td>
											</tr>
									<?php
									}
									
									?>							
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
		select.options[select.options.length] = new Option('Thailand', 'thailand_svobi');
		select.options[select.options.length] = new Option('New_Thailand', 'new_thailand');
		select.options[select.options.length] = new Option('Spain_Vodafone', 'spain');
		select.options[select.options.length] = new Option('Poland_TMobile', 'poland');
		select.options[select.options.length] = new Option('SouthAfrica_Wfh', 'vodacom_wfh');
		select.options[select.options.length] = new Option('SouthAfrica_Fg', 'vodacom_fg');
		select.options[select.options.length] = new Option('SouthAfrica_Bt', 'vodacom_bt');
		select.options[select.options.length] = new Option('Greece_Cosmote', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Greece_Vodafone', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Greece_Wind', 'Wind_Greece');
		select.options[select.options.length] = new Option('Greece_All D', 'all_greece');
	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		//select.options[select.options.length] = new Option('Qatar_Vodafone', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('Oman_Ooredoo', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Qatar_Gamestation', 'qatar_gamestation');
		select.options[select.options.length] = new Option('Qatar_Ooredoo', 'ooredoo_qatar');
		select.options[select.options.length] = new Option('Malaysia_Cellcom', 'malaysia_cellcom');
		select.options[select.options.length] = new Option('Spain_Vodafone', 'spain');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('Egypt', 'egypt');
		select.options[select.options.length] = new Option('Myanmar_Telenor', 'myanmar');
		select.options[select.options.length] = new Option('Poland_TMobile', 'poland');
		select.options[select.options.length] = new Option('Bangladesh_Robi', 'Bangladesh_Robi');
		select.options[select.options.length] = new Option('Srilanka_Dialog', 'dialog_srilanka');
		select.options[select.options.length] = new Option('Greece_Cosmote', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Greece_Vodafone', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Greece_Wind', 'Wind_Greece');
		select.options[select.options.length] = new Option('Greece_All D', 'all_greece');
		select.options[select.options.length] = new Option('Etisalad_Blazon', 'blazon_etisalad');
		select.options[select.options.length] = new Option('Algeria', 'algeria');
		select.options[select.options.length] = new Option('Kuwait_Zain', 'kwzain');
		select.options[select.options.length] = new Option('Kuwait_Viva', 'kwviva');
		select.options[select.options.length] = new Option('Pakistan_Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('Pakistan_zong', 'pk_zong');
		select.options[select.options.length] = new Option('Netherland_N', 'netherland_netsmart');
		select.options[select.options.length] = new Option('France', 'france');
		select.options[select.options.length] = new Option('Bahrain', 'bahrain');
		select.options[select.options.length] = new Option('Greece_N', 'gr2');
		select.options[select.options.length] = new Option('Norway', 'norway');
		select.options[select.options.length] = new Option('KSA_Mobily', 'saudi_mobily');
		select.options[select.options.length] = new Option('KSA_Zain', 'zain_ksa');
		select.options[select.options.length] = new Option('KSA_Stc', 'stc_ksa');
		select.options[select.options.length] = new Option('SouthAfrica_Vodacom', 'vodacom_za');
		select.options[select.options.length] = new Option('SouthAfrica_Mtn', 'southafricamtn');
		select.options[select.options.length] = new Option('SouthAfrica_Cellc', 'southafricacellc');
		select.options[select.options.length] = new Option('Malaysia_maxis', 'malaysiamaxis');
		select.options[select.options.length] = new Option('Qatar_Vodafone', 'vodafoneqatar');
		
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
