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
$group=0;




if(isset($_POST['submit']))
{
	
	$count=1;	
	$country=$_POST['country']; 
	$group=$_POST['group']; 
	$msisdn=$_POST['msisdn'];
	$startdate=date('Y-m-d',strtotime($_POST['start_date']))." 00:00:00";  
	$enddate=date('Y-m-d',strtotime($_POST['end_date']))." 23:59:59";

	
	if($country == 'qa')
	{
		$db="contestdb_qaoo";
	}
	else{
		$db="contestdb_bh";
	}

	

	
	
				$sql="SELECT 
						dt,
						SUM(act) act,
						SUM(actamnt) actamnt,
						SUM(ren) ren,
						SUM(renamnt) renamnt,
						SUM(oneshot) oneshot,
						SUM(oneshotamt) oneshotamt
					FROM
						(SELECT 
							COUNT(DISTINCT msisdn) act,
								SUM(amount) actamnt,
								0 ren,
								0 renamnt,
								0 oneshot,
								0 oneshotamt,
								DATE(subscriptionstartdate) dt
						FROM
							".$db.".subscriber
						WHERE
							subscriptionstartdate >= '".$startdate."'
								AND subscriptionstartdate <= '".$enddate."'
								AND charging_mode = 'act'
						GROUP BY dt UNION SELECT 
							0 act,
								0 actamnt,
								COUNT( msisdn) ren,
								SUM(amount) renamnt,
								0 oneshot,
								0 oneshotamt,
								DATE(subscriptionstartdate) dt
						FROM
							".$db.".subscriber
						WHERE
							subscriptionstartdate >= '".$startdate."'
								AND subscriptionstartdate <= '".$enddate."'
								AND charging_mode = 'ren'
						GROUP BY dt UNION SELECT 
							0 act,
								0 actamnt,
								0 ren,
								0 renamnt,
								COUNT( msisdn) oneshot,
								SUM(amount) oneshotamt,
								DATE(subscriptionstartdate) dt
						FROM
							".$db.".subscriber
						WHERE
							subscriptionstartdate >= '".$startdate."'
								AND subscriptionstartdate <= '".$enddate."'
								AND charging_mode = 'oneshot'
						GROUP BY dt) a
					GROUP BY dt"; 

		
	
			
				
	
	
	
	$res=$conn->query($sql);
	
	

	
}
else{
	
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
							
							
							<option value="bh" <?php if($country=='bh'){$selected='selected';}else{$selected='';} echo $selected; ?>>BH</option>
							<option value="qa" <?php if($country=='qa'){$selected='selected';}else{$selected='';} echo $selected; ?> >QA</option>
						
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($startdate!=''){echo date('d-m-Y',strtotime($startdate));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($enddate!=''){echo date('d-m-Y',strtotime($enddate));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>

						
						
						<!--
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Group Wise
						<select name="group" class="form-control select2_single" >
							
							<option value="day" <?php if($group=='day'){$selected='selected';}else{$selected='';} echo $selected; ?> >Day</option>
							<option value="all" <?php if($group=='all'){$selected='selected';}else{$selected='';} echo $selected; ?>>All</option>
						
						</select>
						</div>
						
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">MSISDN
						
							
							<input class="form-control col-md-7 col-xs-12 " name="msisdn" value="<?php echo $msisdn; ?>"  type="text">
						
						</div>
						
						-->
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
								<td><strong>Activation</strong></td>								
								<td><strong>Amount</strong></td>								
								<td><strong>Renewal</strong></td>								
								<td><strong>Amount</strong></td>								
								<td><strong>OneShot</strong></td>								
								<td><strong>Amount</strong></td>								
								<td><strong>Total Amount</strong></td>								
									
																	
								</tr>
							</thead>


							<tbody>
								<?php 
							
								
								$act_sum='';
								$ren_sum='';
								$oneshot_sum='';
								$actamt_sum='';
								$renamt_sum='';
								$oneshotamt_sum='';
								$total_amnt='';
								
								
								
									while($row=$res->fetch())
									{
										
								?>
									<tr>
									
									<td  style="width:7%"><?php echo $row['dt'];  ?></td>
									<td  style="width:7%"><?php echo $row['act']; $act_sum=$act_sum+$row['act']; ?></td>
									<td  style="width:7%"><?php echo number_format($row['actamnt'],2); $actamt_sum=$actamt_sum+$row['actamnt']; ?></td>
									<td  style="width:7%"><?php echo $row['ren']; $ren_sum=$ren_sum+$row['ren']; ?></td>
									<td  style="width:7%"><?php echo number_format($row['renamnt'],2); $renamt_sum=$renamt_sum+$row['renamnt']; ?></td>
									<td  style="width:7%"><?php echo $row['oneshot']; $oneshot_sum=$oneshot_sum+$row['oneshot']; ?></td>
									<td  style="width:7%"><?php echo number_format($row['oneshotamt'],2); $oneshotamt_sum=$oneshotamt_sum+$row['oneshotamt']; ?></td>
									<td  style="width:7%"><?php echo number_format(($row['oneshotamt']+$row['renamnt']+ $row['actamnt']),2);  $total_amnt=$total_amnt+($row['oneshotamt']+$row['renamnt'] +$row['actamnt']); ?></td>
										
										
								
									
										
										
									</tr>
								
								
								
								<?php
									}
								?>
								
									<tr>
									
									<td  style="width:7%">Total</td>
									<td  style="width:7%"><?php echo $act_sum; ?></td>
									<td  style="width:7%"><?php echo $actamt_sum; ?></td>
									<td  style="width:7%"><?php echo $ren_sum; ?></td>
									<td  style="width:7%"><?php echo $renamt_sum; ?></td>
									<td  style="width:7%"><?php echo $oneshot_sum; ?></td>
									<td  style="width:7%"><?php echo $oneshotamt_sum; ?></td>
									<td  style="width:7%"><?php echo $total_amnt; ?></td>
										
										
								
									
										
										
									</tr>
								
								
							</tbody>
							
							
								
								
						</table>
					  </div>
				
			<?php
			}
			else
			{ 
				
			}
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
