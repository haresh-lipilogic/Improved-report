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
	
	$count=1;
	$operator=$_POST['operator'];
	$product=$_POST['product'];
	$date1=date('Y-m-d');
	$type=$_POST['type'];
	 
	$advertiserid=$_POST['advertiserid'];
	$b=$c=0;
	
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
		
		$query="select * from advertiserdb.advertiser order by advname asc";
		$res_ad=mysqli_query($con,$query);
	
		
						$sql_ad="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."'  order by operator asc";
						$res_op=mysqli_query($con,$sql_ad);
	
				
					$sql="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."' and operator='".$operator."' ";
					$res=mysqli_query($con,$sql);
			
					while($row=mysqli_fetch_array($res))
					{
						$url=$row['trend'];
					}
					
					$c=1;
					
						//$db='hotshotsnewdb_airtel_0717';
						$url=str_replace("[start_date]",$start_date,$url);
						$url=str_replace("[end_date]",$end_date,$url);
						$url=str_replace("[advid]",$advertiserid,$url);
						$query=str_replace("[type]",$type,$url);
						
						//echo $query;exit;
						// $sql="call";
					
					$res=mysqli_query($con,$query);	
					
					
					
			
	
				
		
	
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$advname2 = [];
					$arrdt = [];
					$act="";
					while($row=mysqli_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							//$act() = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						
							$advname[$prevdate][$hour]=$row['act']."";	
							
					}
					
					
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
					
					
					
					
	
		
	
}



$start_date2=$_POST['start_date'];
$end_date2=$_POST['end_date'];

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
                    <h2>Trend Report <small></small></h2>
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
								<select name="operator" id="operator" class="form-control select1_single sel1" onchange="myfun1()" >
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
						
						
						
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Type
								<select name="type" class="form-control">
									
									<option value="act" <?php $selected=''; if($type=='act') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Activation</option>
									<option value="ren" <?php  $selected=''; if($type=='ren') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Renewal</option>
									<option value="totalamount" <?php  $selected=''; if($type=='totalamount') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Total-amount</option>
								
									<option value="clicks" <?php  $selected=''; if($type=='clicks') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Clicks</option>
								
									<option value="low" <?php  $selected=''; if($type=='low') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Lowbalance</option>
								
									<option value="callback" <?php  $selected=''; if($type=='callback') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Callback-Sent</option>
									<option value="pinconf" <?php  $selected=''; if($type=='pinconf') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Pin confirmed</option>
									<option value="trial" <?php  $selected=''; if($type=='trial') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Trial</option>
									<option value="cg" <?php  $selected=''; if($type=='cg') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>sent To CG</option>
									<option value="cr" <?php  $selected=''; if($type=='cr') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>C.R.</option>
								</select>
								
							</div>
							
							
						
						
						<?php
						if($count==0)
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback first"> Advertiser
							<span class="response">
							</span>
							
							</div>
						<?php
						}
						else
						{
							//echo $operator;exit;
						?>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback two"> Advertiser
								<span class="response" id="f">
								</span>
								<span id="t">
								<select name="advertiserid" class="form-control select2_single sel">
									<option value='all'>All</option>
									<?php
									
									
									while($row_ad=mysqli_fetch_array($res_ad))
									{
										if($row_ad['advertiserid']==$advertiserid)
										{
											$selected="selected";
										}
										else
										{
											$selected="";
										}
									?>
									<option value="<?php echo $row_ad['advertiserid']; ?>" <?php echo $selected; ?>><?php echo $row_ad['advname']; ?></option>
									<?php
									}
									?>
									
								</select>
								</span>
							</div>
						<?php
						}
						?>
						
					</div>
					<div class="x_content">

                     
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
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							
							<thead>
									<tr>
										
										<td><strong>Date</strong></td>
										
										<?php 
										//print_r $key=>$val;
										for($i=0;$i<=23;$i++)
										{
											?>
											<td><?php echo $i; ?></td>
											<?php
										}
										
										
										?>
										<td><strong>Total</strong></td>
											
									</tr>
								</thead>


								<tbody>
									
																
									<?php  foreach($dt as $key=>$val) { ?>
										<tr>

											<td><?php echo $key; ?></td>
											
											<?php $a1=$sum=0; 
											
											$ii=0;
											
											
											
											for ($jj=0 ; $jj < 24; $jj++)
											{
												$a1=$advname[$key][$jj];
												if($a1!= "")
												{
												?>

												<td><?php echo number_format($a1);?></td>

												<?php 
												  $sum=$sum+$a1;
												} else{
													?>
											
													<td><?php echo "<span style='color:white;font-weight:bold;background:red;padding:5px;'>0</span>"; ?></td>
											
												<?php
												}
											}
											
											?>
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
        <!-- /page content -->

       <?php
	   include("includes/footer.php");
	   ?>
	   
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
            url: "ajax/findoperatormainreport.php?product="+product         
			
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
