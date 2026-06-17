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
	$country=$_POST['country'];
	$startdate=date('Y-m-d',strtotime($_POST['start_date']))." 00:00:00";  
	$enddate=date('Y-m-d',strtotime($_POST['end_date']))." 23:59:59";

	
	
	$db="fashionbardb_airg_".$country;
	
	
	if($advpb == 'advertiser')
	{
		$sql="SELECT 
			dt,
			SUM(clicks) clicks,
			SUM(uniq) uniq,
			SUM(pg) pg,
			SUM(pv) pv,
			SUM(act) act,
			SUM(cbs) cbs,
			operator,
			advname,
			partner
		FROM
			(SELECT 
				dt,
					SUM(clicks) clicks,
					SUM(uniq) uniq,
					SUM(pg) pg,
					SUM(pv) pv,
					SUM(act) act,
					SUM(cbs) cbs,
					operator,
					advertiserid,
					partner
			FROM
				(SELECT 
				
					COUNT(DISTINCT clickid) clicks,
					0 uniq,
					0 pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(accesstime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".userlog
			WHERE
				accesstime >= '".$startdate."'
					AND accesstime <= '".$enddate."'
			GROUP BY dt , operator , advertiserid,partner UNION SELECT 
					0 clicks,
					COUNT(DISTINCT msisdn) uniq,
					0 pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".requestpin
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
				
			GROUP BY dt , operator , advertiserid,partner UNION SELECT 
					0 clicks,
					0 uniq,
					COUNT(DISTINCT msisdn) pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".requestpin
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
					AND (status = 'success' or status = 'SUCCESS')
			GROUP BY dt , operator , advertiserid,partner UNION SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					COUNT(DISTINCT msisdn) pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".pinverify
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
			GROUP BY dt , operator , advertiserid,partner UNION	SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					0 pv,
					COUNT(distinct msisdn) act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".pinverify
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
					AND (status = 'success'
					or status = 'pending')
			GROUP BY dt , operator , advertiserid,partner UNION SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					0 pv,
					0 act,
					COUNT(DISTINCT msisdn) cbs,
					DATE(advertdatetime) dt,
					operator,
					advertiserid,
					partner
			FROM
				".$db.".advertcallback
			WHERE
				advertdatetime >= '".$startdate."'
					AND advertdatetime <= '".$enddate."'
					AND advertresponse != 'stop'
					AND action = 'cg'
			GROUP BY dt , operator , advertiserid,partner) a
			GROUP BY dt , operator , advertiserid,partner) a
				INNER JOIN
			advertiserdb.advertiser ON a.advertiserid = advertiser.advertiserid
		GROUP BY dt , operator , advname,partner;
							"; 
	}
	else{
		
				$sql="SELECT 
			dt,
			SUM(clicks) clicks,
			SUM(uniq) uniq,
			SUM(pg) pg,
			SUM(pv) pv,
			SUM(act) act,
			SUM(cbs) cbs,
			operator,
			advname
			
		FROM
			(SELECT 
				dt,
					SUM(clicks) clicks,
					SUM(uniq) uniq,
					SUM(pg) pg,
					SUM(pv) pv,
					SUM(act) act,
					SUM(cbs) cbs,
					operator,
					advertiserid
					
			FROM
				(SELECT 
				
					COUNT(DISTINCT clickid) clicks,
					0 uniq,
					0 pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(accesstime) dt,
					operator,
					advertiserid
					
			FROM
				".$db.".userlog
			WHERE
				accesstime >= '".$startdate."'
					AND accesstime <= '".$enddate."'
			GROUP BY dt , operator , advertiserid UNION SELECT 
					0 clicks,
					COUNT(DISTINCT msisdn) uniq,
					0 pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid
					
			FROM
				".$db.".requestpin
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
			
			GROUP BY dt , operator , advertiserid UNION SELECT 
					0 clicks,
					0 uniq,
					COUNT(DISTINCT msisdn) pg,
					0 pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid
					
			FROM
				".$db.".requestpin
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
					AND (status = 'success' or status = 'SUCCESS')
			GROUP BY dt , operator , advertiserid UNION SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					COUNT(DISTINCT msisdn) pv,
					0 act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid
					
			FROM
				".$db.".pinverify
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
			GROUP BY dt , operator , advertiserid UNION SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					0 pv,
					COUNT(distinct msisdn) act,
					0 cbs,
					DATE(pindatetime) dt,
					operator,
					advertiserid
			FROM
				".$db.".pinverify
			WHERE
				pindatetime >= '".$startdate."'
					AND pindatetime <= '".$enddate."'
					AND (status = 'success' or status='pending')
			GROUP BY dt , operator , advertiserid UNION SELECT 
					0 clicks,
					0 uniq,
					0 pg,
					0 pv,
					0 act,
					COUNT(DISTINCT msisdn) cbs,
					DATE(advertdatetime) dt,
					operator,
					advertiserid
			FROM
				".$db.".advertcallback
			WHERE
				advertdatetime >= '".$startdate."'
					AND advertdatetime <= '".$enddate."'
					AND advertresponse != 'stop'
					AND action = 'cg'
			GROUP BY dt , operator , advertiserid) a
			GROUP BY dt , operator , advertiserid) a
				INNER JOIN
			advertiserdb.advertiser ON a.advertiserid = advertiser.advertiserid
		GROUP BY dt , operator , advname;
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
							
							<option value="sa" <?php if($country=='sa'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA</option>
							<option value="ae" <?php if($country=='ae'){$selected='selected';}else{$selected='';} echo $selected; ?>>UAE</option>
							<option value="om" <?php if($country=='om'){$selected='selected';}else{$selected='';} echo $selected; ?>>OMAN</option>
							<option value="kw" <?php if($country=='kw'){$selected='selected';}else{$selected='';} echo $selected; ?>>KW</option>
							<option value="ps" <?php if($country=='ps'){$selected='selected';}else{$selected='';} echo $selected; ?>>PALESTINE</option>
							<option value="iq" <?php if($country=='iq'){$selected='selected';}else{$selected='';} echo $selected; ?>>IRAQ</option>
							<option value="qa" <?php if($country=='qa'){$selected='selected';}else{$selected='';} echo $selected; ?>>QA</option>
							<option value="pl" <?php if($country=='pl'){$selected='selected';}else{$selected='';} echo $selected; ?>>POLAND</option>
							<option value="bh" <?php if($country=='bh'){$selected='selected';}else{$selected='';} echo $selected; ?>>BH</option>
						</select>
						</div>
						
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Advertiser/Publisher
						<select name="advpb" class="form-control select2_single" id="pubad">
							
							<option value="advertiser" <?php if($advpb=='advertiser'){$selected='selected';}else{$selected='';} echo $selected; ?> >Advertiser</option>
							<option value="publisher" <?php if($advpb=='publisher'){$selected='selected';}else{$selected='';} echo $selected; ?>>Publisher</option>
							
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
									<td><strong>Date</strong></td>								
									<td><strong>Publisher</strong></td>								
									<td><strong>Advertiser</strong></td>								
									<td><strong>Clicks</strong></td>								
									<td><strong>UClicks</strong></td>								
									<td><strong>PG</strong></td>								
									<td><strong>PV</strong></td>								
									<td><strong>Operator</strong></td>															
									<td><strong>Activation </strong></td>		
									<td><strong>ACR% </strong></td>												
									<td><strong>CBS </strong></td>									
															
									<td><strong>CR% </strong></td>									
																	
																	
								</tr>
							</thead>


							<tbody>
								<?php 
							
								
								$clicks_sum='';
								$act_sum='';
								$cbs_sum='';
								
								
								
									while($row=$res->fetch())
									{
										
								?>
									<tr>
										<td  style="width:7%"><?php echo date('d-m-Y',strtotime($row['dt']));  ?></td>
										<td  style="width:7%"><?php echo ucfirst($row['advname']);  ?></td>
										<td  style="width:7%"><?php echo ucfirst($row['partner']);  ?></td>
										<td  style="width:7%"><?php echo $row['clicks']; $clicks_sum=$clicks_sum+$row['clicks']; ?></td>
										<td  style="width:7%"><?php echo $row['uniq']; $uniq_sum=$uniq_sum+$row['uniq']; ?></td>
										<td  style="width:7%"><?php echo $row['pg']; $pg_sum=$pg_sum+$row['pg']; ?></td>
										<td  style="width:7%"><?php echo $row['pv']; $pv_sum=$pv_sum+$row['pv']; ?></td>
										<td  style="width:7%"><?php echo $row['operator'];  ?></td>
										
											
										<td style="width:7%"><?php echo number_format($row['act']); $act_sum=$act_sum+$row['act']; ?></td>	
										<td style="width:7%"><?php echo number_format(($row['act']/$row['pv'])*100,2);  ?>%</td>
										<td style="width:7%"><?php echo number_format($row['cbs']); $cbs_sum=$cbs_sum+$row['cbs']; ?></td>	
										
										<td style="width:7%"><?php echo number_format(($row['cbs']/$row['pv'])*100,2);  ?>%</td>	
										
										
									</tr>
								
								
								
								<?php
									}
								?>
								
								<tr>
									<td>Total</td>
									<td></td>	
									<td></td>									
									<td><?php echo number_format($clicks_sum); ?></td>	
									<td><?php echo number_format($uniq_sum); ?></td>	
									<td><?php echo number_format($pg_sum); ?></td>	
									<td><?php echo number_format($pv_sum); ?></td>	
										
										
									<td></td>	
									
									<td><?php echo number_format($act_sum); ?></td>
									<td><?php echo number_format(($act_sum/$pv_sum)*100,2);  ?>%</td>	
									<td><?php echo number_format($cbs_sum); ?></td>
									
									<td><?php echo number_format(($cbs_sum/$pv_sum)*100,2);  ?>%</td>	
	
								</tr>
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
