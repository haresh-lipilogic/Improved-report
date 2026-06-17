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

	
	if($msisdn != '')
	{
		$condition="msisdn = '".$msisdn."' AND ";
		$group="day";
	}
	else{
		
	}
	
	if($group == 'day')
	{
	
		 $sql="SELECT 
					msisdn,
					SUM(CASE
						WHEN result = 'wrong' THEN c
						ELSE 0
					END) AS wrong,
					SUM(CASE
						WHEN result = 'correct' THEN c
						ELSE 0
					END) AS correct,
					SUM(CASE
						WHEN (result = 'missed' OR result = '') THEN c
						ELSE 0
					END) AS missed,
					dt
				FROM
					(SELECT 
						msisdn, COUNT(*) AS c, result, DATE(answerdatetime) dt
					FROM
						".$db.".contestlog
					WHERE
					".$condition."
						msisdn IN (SELECT 
								msisdn
							FROM
								".$db.".subscriber
							WHERE
								subscriberid IN (SELECT 
										MAX(subscriberid) subscriberid
									FROM
										".$db.".subscriber
									GROUP BY msisdn)
									AND charging_mode != 'dct')
					GROUP BY msisdn , result , dt) AS subquery
				GROUP BY msisdn , dt
				ORDER BY msisdn DESC;";



	}
	else{
		
				$sql="SELECT 
				msisdn,
				SUM(CASE
					WHEN result = 'wrong' THEN c
					ELSE 0
				END) AS wrong,
				SUM(CASE
					WHEN result = 'correct' THEN c
					ELSE 0
				END) AS correct,
				SUM(CASE
					WHEN (result = 'missed' OR result = '') THEN c
					ELSE 0
				END) AS missed
			FROM
				(SELECT 
					msisdn, COUNT(*) AS c, result
				FROM
					".$db.".contestlog
				WHERE
				".$condition."
					msisdn IN (SELECT 
							msisdn
						FROM
							".$db.".subscriber
						WHERE
							subscriberid IN (SELECT 
									MAX(subscriberid) subscriberid
								FROM
									".$db.".subscriber
								GROUP BY msisdn)
								AND charging_mode != 'dct')
				GROUP BY msisdn , result) AS subquery
			GROUP BY msisdn;"; 

		
	}
			
				
	
	
	
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
					
					<!--
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($startdate!=''){echo date('d-m-Y',strtotime($startdate));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($enddate!=''){echo date('d-m-Y',strtotime($enddate));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>

						-->
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Country
						<select name="country" class="form-control select2_single" >
							
							<option value="qa" <?php if($country=='qa'){$selected='selected';}else{$selected='';} echo $selected; ?> >QA</option>
							<option value="bh" <?php if($country=='bh'){$selected='selected';}else{$selected='';} echo $selected; ?>>BH</option>
						
						</select>
						</div>
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Group Wise
						<select name="group" class="form-control select2_single" >
							
							<option value="day" <?php if($group=='day'){$selected='selected';}else{$selected='';} echo $selected; ?> >Day</option>
							<option value="all" <?php if($group=='all'){$selected='selected';}else{$selected='';} echo $selected; ?>>All</option>
						
						</select>
						</div>
						
						
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">MSISDN
						
							
							<input class="form-control col-md-7 col-xs-12 " name="msisdn" value="<?php echo $msisdn; ?>"  type="text">
						
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
								<td><strong>MSISDN</strong></td>		
								
								<?php
								if($group=='day')
								{
									?>
									<td><strong>Date</strong></td>		
									<?php
								}
								else
								{}
							
								?>
															
															
									<td><strong>Correct</strong></td>								
									<td><strong>Wrong</strong></td>								
									<td><strong>Missed</strong></td>								
									<td><strong>Score</strong></td>								
									
																	
								</tr>
							</thead>


							<tbody>
								<?php 
							
								
								$correct_sum='';
								$wrong_sum='';
								$missed_sum='';
								$total_sum='';
								
								
								
									while($row=$res->fetch())
									{
										
								?>
									<tr>
									
									<td  style="width:7%"><?php echo ucfirst($row['msisdn']);  ?></td>
									
									<?php
									if($group=='day')
									{
										?>
										<td  style="width:7%"><?php echo date('d-m-Y',strtotime($row['dt']));  ?></td>	
										<?php
									}
									else
									{}
								
									?>
									 
										
										<?php
										if($row['correct'] =='5')
										{
											?>
											<td  style="background: blueviolet;color: aliceblue;font-weight: bold;width:7%" ><?php echo $row['correct']; $correct_sum=$correct_sum+$row['correct'];   ?></td>
											<?php
										}
										else{
											?>
											<td  style="width:7%" ><?php echo $row['correct']; $correct_sum=$correct_sum+$row['correct'];   ?></td>
											<?php
										}
										?>
										
										
										<td  style="width:7%"><?php echo $row['wrong']; $wrong_sum=$wrong_sum+$row['wrong']; ?></td>
										<td  style="width:7%"><?php echo $row['missed']; $missed_sum=$missed_sum+$row['missed']; ?></td>
										
										
										
									<?php
									if($group=='day')
									{
										?>
										<td  style="width:7%"><?php echo ($row['correct']*10); $total_sum=$total_sum+(($row['correct']*10)); ?></td>
										<?php
									}
									else
									{
										?>
										<td  style="width:7%"><?php echo ($row['correct']*10)."+ 100(Bonus) ="; echo ($row['correct']*10)+100; ?></td>
										<?php
									}
								
									?>
										
									
										
										
									</tr>
								
								
								
								<?php
									}
								?>
								
								<?php 
								if($msisdn == '')
								{
									
								}
								else
								{
									?>
									<tr>
									<?php
									if($group=='day')
									{
										?>
										<td><strong>Total</strong></td>		
										<?php
									}
									else
									{}
								
									?>
										<td></td>								
									<td><?php echo number_format($correct_sum); ?></td>	
									<td><?php echo number_format($wrong_sum); ?></td>	
									<td><?php echo number_format($missed_sum); ?></td>

									<?php
									if($group=='day')
									{
										?>
										<td><?php  echo  number_format($total_sum)."+ 100(Bonus) =".number_format($total_sum+100); ?></td>	
										<?php
									}
									else
									{
										?>
										<td><?php  echo  number_format($total_sum)."+ 100(Bonus) =".number_format($total_sum); ?></td>
										<?php
									}
								
									?>
									
									
										
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
