<?php
error_reporting(0);
include("includes/check_session.php");
//include("includes/connection.php");
//$con1=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error());

$conn1 = new mysqli('10.34.240.3','webserveruser','K&dN&r4a8N@du0');
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
	$operator=$_POST['operator'];
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
	if($operator=='all')
	{
		
		  $sql2="select mainreport.product,mainreport.operator,advertiser,advname,sum(cbsent)sum,operatorcost_usd,sum(pcsent)pcsent1 from ".$report.".mainreport left join ".$report.".operatorcost on mainreport.operator=operatorcost.operator where date >='".$start_date1."' and date<='".$end_date1."' and mainreport.product='".$product."'  and advertiser>0 and cbsent>0 group by  mainreport.product,mainreport.operator,advertiser order by Product asc,operator asc;";
	}
	else
	{
		 $sql2="select mainreport.product,mainreport.operator,advertiser,advname,sum(cbsent)sum,operatorcost_usd,sum(pcsent)pcsent1 from ".$report.".mainreport left join ".$report.".operatorcost on mainreport.operator=operatorcost.operator where date >='".$start_date1."' and date<='".$end_date1."' and mainreport.product='".$product."'  and mainreport.operator='".$operator."' and advertiser>0 and cbsent>0 group by  mainreport.product,mainreport.operator,advertiser order by Product asc,operator asc;";
	
	 // $sql2="select date,advertiser,advname,sum(cbsent)sum,operatorcost_usd from ".$report.".mainreport left join ".$report.".operatorcost on mainreport.operator=operatorcost.operator where date >='".$start_date1."' and date<='".$end_date1."'  and mainreport.operator='".$operator."' and mainreport.product='".$product."'  and advertiser>0 and cbsent>0 group by advertiser order by date;";
	}
//echo $sql2;exit;
				
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
                    <h2>callback Report</h2>
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
						
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control" id="operator">
						<?php
						if($product == 'glambar')
						{ ?>
							<option>Operator</option>
							<option value="all" <?php if($operator=='all'){$selected='selected';}else{$selected='';} echo $selected; ?> >All</option>
							<option value="all_greece" <?php if($operator=='all_greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_All D</option>
							<option value="Cosmote_Greece" <?php if($operator=='Cosmote_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Cosmote</option>
							<option value="Vodafone_Greece" <?php if($operator=='Vodafone_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Vodafone</option>
							<option value="Wind_Greece" <?php if($operator=='Wind_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Wind</option>
							<option value="italy_tim" <?php if($operator=='italy_tim'){$selected='selected';}else{$selected='';} echo $selected; ?> >Italy_Tim</option>
							<option value="new_thailand" <?php if($operator=='new_thailand'){$selected='selected';}else{$selected='';} echo $selected; ?> >New_Thailand</option>
							<option value="poland" <?php if($operator=='poland'){$selected='selected';}else{$selected='';} echo $selected; ?> >Poland_TMobile</option>
							<option value="vodacom_bt" <?php if($operator=='vodacom_bt'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Bt</option>
							<option value="vodacom_fg" <?php if($operator=='vodacom_fg'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Fg</option>
							<option value="vodacom_wfh" <?php if($operator=='vodacom_wfh'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Wfh</option>
							<option value="spain" <?php if($operator=='spain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Spain_Vodafone</option>
							<option value="thailand_svobi" <?php if($operator=='thailand_svobi'){$selected='selected';}else{$selected='';} echo $selected; ?> >Thailand
							
							
						<?php
						}
						else if($product == 'gamebar'){
						?>
							
							<option value="all" <?php if($operator=='all'){$selected='selected';}else{$selected='';} echo $selected; ?> >All</option>
							<option value="algeria" <?php if($operator=='algeria'){$selected='selected';}else{$selected='';} echo $selected; ?> >Algeria</option>
							<option value="bahrain" <?php if($operator=='bahrain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bahrain_All</option>
							
							<option value="bahrain_stc" <?php if($operator=='bahrain_stc'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bahrain_stc</option>
							
							<option value="bahrain_batelco" <?php if($operator=='bahrain_batelco'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bahrain_Batelco</option>
							
							
							<option value="buhrain_zain" <?php if($operator=='buhrain_zain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bahrain_zain</option>
							<option value="Bangladesh_Robi" <?php if($operator=='Bangladesh_Robi'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bangladesh_Robi</option>
							
							<option value="cambodia" <?php if($operator=='cambodia'){$selected='selected';}else{$selected='';} echo $selected; ?> >Cambodia</option>
							<option value="egypt" <?php if($operator=='egypt'){$selected='selected';}else{$selected='';} echo $selected; ?> >Egypt</option>
							<!--ion value="blazon_etisalad" <?php//f($operator=='blazon_etisalad'){$selected='selected';}else{$selected='';} echo $selected; ?> >Etisalad_Blazon</option>-->
							<option value="france" <?php if($operator=='france'){$selected='selected';}else{$selected='';} echo $selected; ?> >France</option>
							<option value="all_greece" <?php if($operator=='all_greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_All D</option>
						<!--	<option value="Cosmote_Greece" <?php //if($operator=='Cosmote_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Cosmote</option>-->
							<option value="gr2" <?php if($operator=='gr2'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_N</option>
							<!--<option value="Vodafone_Greece" <?php //if($operator=='Vodafone_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Vodafone</option>
							<option value="Wind_Greece" <?php //if($operator=='Wind_Greece'){$selected='selected';}else{$selected='';} echo $selected; ?> >Greece_Wind</option>-->
							<option value="indonesia" <?php if($operator=='indonesia'){$selected='selected';}else{$selected='';} echo $selected; ?> >Indonesia</option>
							<option value="italy_tim" <?php if($operator=='italy_tim'){$selected='selected';}else{$selected='';} echo $selected; ?> >Italy_Tim</option>
							<option value="ksa_all" <?php if($operator=='ksa_all'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_All</option>
							<option value="saudi_mobily" <?php if($operator=='saudi_mobily'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Mobily</option>

							<option value="stc_ksa" <?php if($operator=='stc_ksa'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Stc</option>
							<option value="saudiarabia_zain" <?php if($operator=='saudiarabia_zain'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Zain</option>
							<option value="ksa_all_weekly" <?php if($operator=='ksa_all_weekly'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_All_weekly</option>
							<option value="ksa_mobily_weekly" <?php if($operator=='ksa_mobily_weekly'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Mobily_weekly</option>
							<option value="ksa_stc_weekly" <?php if($operator=='ksa_stc_weekly'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Stc_Weekly</option>
							<option value="ksa_zain_weekly" <?php if($operator=='ksa_zain_weekly'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Zain_weekly</option>
							<option value="kwzain" <?php if($operator=='kwzain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Kuwait_Zain
							<option value="malaysia_cellcom" <?php if($operator=='malaysia_cellcom'){$selected='selected';}else{$selected='';} echo $selected; ?>>Malaysia_Cellcom</option>
							<option value="malaysiamaxis" <?php if($operator=='malaysiamaxis'){$selected='selected';}else{$selected='';} echo $selected; ?> >Malaysia_maxis</option>
							<option value="myanmar" <?php if($operator=='myanmar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Myanmar_Telenor</option>
							<option value="netherland_netsmart" <?php if($operator=='netherland_netsmart'){$selected='selected';}else{$selected='';} echo $selected; ?> >Netherland_N</option>
							<option value="norway" <?php if($operator=='norway'){$selected='selected';}else{$selected='';} echo $selected; ?> >Norway</option>
							<option value="ooredoo_oman" <?php if($operator=='ooredoo_oman'){$selected='selected';}else{$selected='';} echo $selected; ?>>Oman_Ooredoo</option>
							<option value="oman_omantel" <?php if($operator=='oman_omantel'){$selected='selected';}else{$selected='';} echo $selected; ?>>Oman_Omantel</option>
							<option value="pk_telenor" <?php if($operator=='pk_telenor'){$selected='selected';}else{$selected='';} echo $selected; ?> >Pakistan_Telenor</option>
							<option value="pk_zong" <?php if($operator=='pk_zong'){$selected='selected';}else{$selected='';} echo $selected; ?> >Pakistan_Zong</option>
							<option value="poland" <?php if($operator=='poland'){$selected='selected';}else{$selected='';} echo $selected; ?> >Poland_TMobile</option>
							<option value="qatar_gamestation" <?php if($operator=='qatar_gamestation'){$selected='selected';}else{$selected='';} echo $selected; ?>>Qatar_Gamestation</option>
							<option value="ooredoo_qatar" <?php if($operator=='ooredoo_qatar'){$selected='selected';}else{$selected='';} echo $selected; ?>>Qatar_Ooredoo</option>
							<option value="vodafoneqatar" <?php if($operator=='vodafoneqatar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Qatar_Vodafone</option>
							<option value="russia" <?php if($operator=='russia'){$selected='selected';}else{$selected='';} echo $selected; ?> >Russia</option>
							
							<option value="southafricacellc" <?php if($operator=='southafricacellc'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Cellc</option>
							<option value="southafricamtn" <?php if($operator=='southafricamtn'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Mtn</option>
							<option value="vodacom_za" <?php if($operator=='vodacom_za'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Vodacom</option>
							<option value="spain" <?php if($operator=='spain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Spain_Vodafone</option>
							<option value="dialog_srilanka" <?php if($operator=='dialog_srilanka'){$selected='selected';}else{$selected='';} echo $selected; ?> >Srilanka_Dialog</option>
							<option value="srilanka_gamestore" <?php if($operator=='srilanka_gamestore'){$selected='selected';}else{$selected='';} echo $selected; ?> >Srilanka_Gamestore</option>
							<option value="sweden" <?php if($operator=='sweden'){$selected='selected';}else{$selected='';} echo $selected; ?> >Sweden</option>
							<option value="uae_etisalat" <?php if($operator=='uae_etisalat'){$selected='selected';}else{$selected='';} echo $selected; ?> >UAE_Etisalat</option>
							<option value="uae_du" <?php if($operator=='uae_du'){$selected='selected';}else{$selected='';} echo $selected; ?> >UAE_DU</option>
							
							
							
							
						<?php
						}
						else{
						?>
						<option>Operator</option>
						<?php
						}
						
						?>
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
										<td><strong>Total CallBackSent</strong></td>
										<td><strong>Pin-Confirmed callbacks</strong></td>
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
											<td><?php echo $row2['pcsent1'];?></td>
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
		
		select.options[select.options.length] = new Option('All', 'all');
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
		
		select.options[select.options.length] = new Option('All', 'all');
		select.options[select.options.length] = new Option('Algeria', 'algeria');
		select.options[select.options.length] = new Option('Bahrain_All', 'bahrain');
		select.options[select.options.length] = new Option('Bahrain_stc', 'bahrain_stc');
		select.options[select.options.length] = new Option('Bahrain_Batelco', 'bahrain_batelco');
		select.options[select.options.length] = new Option('Bahrain_zain', 'buhrain_zain');
		select.options[select.options.length] = new Option('Bangladesh_Robi', 'Bangladesh_Robi');
		select.options[select.options.length] = new Option('Cambodia', 'cambodia');
		select.options[select.options.length] = new Option('Egypt', 'egypt');
		//select.options[select.options.length] = new Option('Etisalad_Blazon', 'blazon_etisalad');
		select.options[select.options.length] = new Option('France', 'france');
		select.options[select.options.length] = new Option('Greece_All D', 'all_greece');
		//select.options[select.options.length] = new Option('Greece_Cosmote', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Greece_N', 'gr2');
	//	select.options[select.options.length] = new Option('Greece_Vodafone', 'Vodafone_Greece');
		//select.options[select.options.length] = new Option('Greece_Wind', 'Wind_Greece');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('Italy_Tim', 'italy_tim');
		select.options[select.options.length] = new Option('KSA_All', 'ksa_all');
		
		select.options[select.options.length] = new Option('KSA_Mobily', 'saudi_mobily');
		
		select.options[select.options.length] = new Option('KSA_Stc', 'stc_ksa');
		
		select.options[select.options.length] = new Option('KSA_Zain', 'saudiarabia_zain');
		select.options[select.options.length] = new Option('KSA_All_weekly', 'ksa_all_weekly');
		select.options[select.options.length] = new Option('KSA_Mobily_weekly', 'ksa_mobily_weekly');
		select.options[select.options.length] = new Option('KSA_Stc_Weekly', 'ksa_stc_weekly');
		select.options[select.options.length] = new Option('KSA_Zain_weekly', 'ksa_zain_weekly');
		select.options[select.options.length] = new Option('Kuwait_Zain', 'kwzain');
		select.options[select.options.length] = new Option('Malaysia_Cellcom', 'malaysia_cellcom');
		select.options[select.options.length] = new Option('Malaysia_maxis', 'malaysiamaxis');
		select.options[select.options.length] = new Option('Myanmar_Telenor', 'myanmar');
		select.options[select.options.length] = new Option('Netherland_N', 'netherland_netsmart');
		select.options[select.options.length] = new Option('Norway', 'norway');
		select.options[select.options.length] = new Option('Oman_Ooredoo', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Oman_Omantel', 'oman_omantel');
		select.options[select.options.length] = new Option('Pakistan_Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('Pakistan_zong', 'pk_zong');
		select.options[select.options.length] = new Option('Poland_TMobile', 'poland');
		select.options[select.options.length] = new Option('Qatar_Gamestation', 'qatar_gamestation');
		select.options[select.options.length] = new Option('Qatar_Ooredoo', 'ooredoo_qatar');
		select.options[select.options.length] = new Option('Qatar_Vodafone', 'vodafoneqatar');
		select.options[select.options.length] = new Option('Russia', 'russia');
		select.options[select.options.length] = new Option('SouthAfrica_Cellc', 'southafricacellc');
		select.options[select.options.length] = new Option('SouthAfrica_Mtn', 'southafricamtn');
		select.options[select.options.length] = new Option('SouthAfrica_Vodacom', 'vodacom_za');
		select.options[select.options.length] = new Option('Spain_Vodafone', 'spain');
		select.options[select.options.length] = new Option('Srilanka_Dialog', 'dialog_srilanka');
		select.options[select.options.length] = new Option('Srilanka_gamestore', 'srilanka_gamestore');
		select.options[select.options.length] = new Option('Sweden', 'sweden');
		select.options[select.options.length] = new Option('UAE_Etisalat', 'uae_etisalat');
		select.options[select.options.length] = new Option('UAE_DU', 'uae_du');
		
		
		

		
		
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
