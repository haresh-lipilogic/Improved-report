<?php
include("includes/connection_jay.php");
error_reporting(0);


$startdate='';
$enddate='';
$operator='';
$partner='';
$type='';
$count=0;
$cc=0; 
if(isset($_POST['submit']))
{
	
	$count=1;	
	$advpb=$_POST['advpb'];
	$db=$_POST['country'];
	$country=$_POST['country'];
	$startdate=date('Y-m-d',strtotime($_POST['start_date']))." 00:00:00";  
	$enddate=date('Y-m-d',strtotime($_POST['end_date']))." 23:59:59";
	
	if($db=="fashionbardb_psjw" || $db=="fashionbardb_psoo")
	{
		$sql="SELECT 
		advname, SUM(c) cg, SUM(b) act, ((b / c) * 100) p
			FROM
				(SELECT 
					COUNT(a.msisdn) c, COUNT(b.msisdn) b, a.advertiserid
				FROM
					(SELECT DISTINCT
					msisdn msisdn, advertiserid
				FROM
					".$db.".subscriber
				WHERE
					subscriptionstartdate >= '".$startdate."'
						AND subscriptionstartdate <= '".$enddate."'
						AND (charging_mode = 'act'
            OR charging_mode = 'low')) a
				LEFT JOIN (SELECT DISTINCT
					msisdn msisdn, advertiserid
				FROM
					".$db.".subscriber
				WHERE
					subscriptionstartdate >= '".$startdate."'
						AND (charging_mode = 'act'
						OR charging_mode = 'ren')) b ON a.msisdn = b.msisdn
				GROUP BY advertiserid) aa
					INNER JOIN
				advertiserdb.advertiser ON advertiser.advertiserid = aa.advertiserid
		GROUP BY advname , p;
				";	
	}
	else if($db=="gamebar_iqmw_api" || $db=="gamebar_iqmw_api")
	{
		 $sql="SELECT advname, SUM(c) cg, SUM(b) act, ((b / c) * 100) p FROM (SELECT COUNT(a.msisdn) c, COUNT(b.msisdn) b, a.advid advertiserid FROM (SELECT DISTINCT msisdn msisdn, advid FROM ".$db.".subscriber WHERE subscriptionstartdate >= '".$startdate."' AND subscriptionstartdate <= '".$enddate."' AND (charging_mode = 'trial' )) a LEFT JOIN (SELECT DISTINCT msisdn msisdn, advid FROM ".$db.".subscriber WHERE subscriptionstartdate >= '".$startdate."' AND (charging_mode = 'act' OR charging_mode = 'ren' and amount>0)) b ON a.msisdn = b.msisdn GROUP BY a.advid) aa INNER JOIN advertiserdb.advertiser ON advertiser.advertiserid = aa.advertiserid GROUP BY advname , p;
				";	
	}
	
	else{
			$sql="SELECT 
				advname, SUM(c) cg, SUM(b) act, ((b / c) * 100) p
					FROM
						(SELECT 
							COUNT(a.msisdn) c, COUNT(b.msisdn) b, a.advertiserid
						FROM
							(SELECT DISTINCT
							msisdn msisdn, advertiserid
						FROM
							".$db.".subscriber
						WHERE
							subscriptionstartdate >= '".$startdate."'
								AND subscriptionstartdate <= '".$enddate."'
								AND (charging_mode = 'cg')) a
						LEFT JOIN (SELECT DISTINCT
							msisdn msisdn, advertiserid
						FROM
							".$db.".subscriber
						WHERE
							subscriptionstartdate >= '".$startdate."'
								AND (charging_mode = 'act'
								OR charging_mode = 'ren')) b ON a.msisdn = b.msisdn
						GROUP BY advertiserid) aa
							INNER JOIN
						advertiserdb.advertiser ON advertiser.advertiserid = aa.advertiserid
				GROUP BY advname , p;
            ";
	
	}

	

	
	
	$res=$conn->query($sql);
	
	

	
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
                  
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left input_mask" method="post">
					
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Country
						<select name="country" class="form-control select2_single" >
							
							
							<option value="fashionbardb_etisalat" <?php if($country=='fashionbardb_etisalat'){$selected='selected';}else{$selected='';} echo $selected; ?>>UAE</option>
							<option value="fashionbardb_omooredoo" <?php if($country=='fashionbardb_omooredoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>OMAN OOREDOO</option>
							<option value="fashionbardb_omantel" <?php if($country=='fashionbardb_omantel'){$selected='selected';}else{$selected='';} echo $selected; ?>>OMAN OMANTEL</option>
							<option value="fashionbardb_kwoo" <?php if($country=='fashionbardb_kwoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>KW</option>
							<option value="fashionbardb_psjw" <?php if($country=='fashionbardb_psjw'){$selected='selected';}else{$selected='';} echo $selected; ?>>PALESTINE JAWWAL</option>
							<option value="fashionbardb_psoo" <?php if($country=='fashionbardb_psoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>PALESTINE OOREDOO</option>
							<option value="gamebar_iqmw_api" <?php if($country=='gamebar_iqmw_api'){$selected='selected';}else{$selected='';} echo $selected; ?>>IRAQ</option>
							<option value="fashionbardb_qatarooredoo" <?php if($country=='fashionbardb_qatarooredoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>QA OOREDOO</option>
							<option value="fashionbardb_qatarvodafone" <?php if($country=='fashionbardb_qatarvodafone'){$selected='selected';}else{$selected='';} echo $selected; ?>>QA Vodafone</option>
							<option value="fashionbardb_safaricom_new" <?php if($country=='fashionbardb_safaricom_new'){$selected='selected';}else{$selected='';} echo $selected; ?>>KE Gamebar</option>
							<option value="fashionbardb_safaricompkm" <?php if($country=='fashionbardb_safaricompkm'){$selected='selected';}else{$selected='';} echo $selected; ?>>KE 11players</option>
							<!--<option value="pl" <?php if($country=='pl'){$selected='selected';}else{$selected='';} echo $selected; ?>>POLAND</option>
							<option value="bh" <?php if($country=='bh'){$selected='selected';}else{$selected='';} echo $selected; ?>>BH</option> -->
						</select>
						</div>
						
						
						
					
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($startdate!=''){echo date('d-m-Y',strtotime($startdate));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($enddate!=''){echo date('d-m-Y',strtotime($enddate));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>

						</br>
						
						<div class="col-md-2 col-sm-2 col-xs-12">
						 
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
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>Publisher</strong></td>								
									<td><strong>CG</strong></td>								
									<td><strong>Charged</strong></td>								
									<td><strong>%</strong></td>								
									
								</tr>
							</thead>


							<tbody>
								<?php 
							
								
								$clicks_sum='';
								$act_sum='';
								$cg_sum='';
								
								
								
									while($row=$res->fetch())
									{
										
								?>
									<tr>
										
										<td  style="width:7%"><?php echo ucfirst($row['advname']);  ?></td>
									
										
											
										<td style="width:7%"><?php echo number_format($row['cg']); $cg_sum=$cg_sum+$row['cg']; ?></td>	
										
										<td style="width:7%"><?php echo number_format($row['act']); $act_sum=$act_sum+$row['act']; ?></td>	
										
										<td style="width:7%"><?php echo number_format(($row['act']/$row['cg'])*100,2);  ?>%</td>	
										
										
									</tr>
								
								
								
								<?php
									}
								?>
								
								
							</tbody>
							
							<thead>
								<tr>
									<td>Total</td>

									<td><?php echo number_format($cg_sum); ?></td>
								
									<td><?php echo number_format($act_sum); ?></td>
									
									<td><?php echo number_format(($act_sum/$cg_sum)*100,2);  ?>%</td>	
	
								</tr>
							</thead>
								
								
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
		var partner = $("#partner").val();
        
		//alert("ajax/find_advertiser.php?operator="+operator+"&partner="+partner);
		$.ajax({
			
			
            type: "GET",
            url: "ajax/find_advertiser.php?operator="+operator+"&partner="+partner         
			//url:"ajax/find_advertiser.php?operator=ais&partner=svmobi"
        }).done(function(data){
            $(".response").html(data);
			 
        });
    });
});
</script>
