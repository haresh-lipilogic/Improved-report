<?php

ini_set('max_execution_time', 6000);

//include("includes/check_session.php");
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
//exit;
$count=1;
$country=$_POST['country'];
//$product=$_POST['product'];
	
	$sql_ad="select * from gamebardb_vodafone_qatar_report.uat where country='".$country."'";
	
	$res_ad=mysqli_query($con,$sql_ad);
	
	$ll=$operator=array();
	
	//$rowad=mysqli_fetch_array($res_ad);
	
	

	while($rowad=mysqli_fetch_array($res_ad))
	{
		
			//$arraykeys=array_keys($rowad);
			$operator=array_merge($operator,array($rowad['operator']));
			$ll =array_merge($ll,array($rowad['operator']=>$rowad));
		
	
	}
	
	//print_r($operator);
	//exit;
	
	
	

	
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
                    <h2>Search UAT <small></small></h2>
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
					
						
						
						<?php
						
						 $sql_ad="select distinct(country)country from gamebardb_vodafone_qatar_report.uat group by country";
							$res_op=mysqli_query($con3,$sql_ad);
							//echo $operator;exit;
						?>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback two"> country
								<span class="response1" id="f1">
								</span>
								<span id="t1">
								<select name="country" id="country" class="form-control select1_single sel1">
									<?php
									
									
									while($row_op=mysqli_fetch_array($res_op))
									{
										if($row_op['country']==$country)
										{
											$selected="selected";
										}
										else
										{
											$selected="";
										}
									?>
									<option value="<?php echo $row_op['country']; ?>" <?php echo $selected; ?>><?php echo $row_op['country']; ?></option>
									<?php
									}
									?>
									
								</select>
								</span>
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
			//echo $operator;
			
				
			if($count==1)
			{
				$k=$l=0;
				//echo $cc;exit;
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									
									<td rowspan=2><strong>Question</strong></td>
									<?php
									$sizeop=sizeof($operator);?>
									<td colspan=<?php echo $sizeop;?>><strong>operator</strong></td>
									<tr>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									
									echo "<td><strong>$operator[$i]</strong></td>";
									
									}
									
									
									?>
									
									
									
								      
							</thead>


							<tbody>
							
									
									<td>Product</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['product']	; ?></td>
									<?php
									}
									?>
									<tr><td>Country</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['country']	; ?></td>
									<?php
									}
									?>
									
									<tr><td>Test URL</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['testurl']	; ?></td>
									<?php
									}
									?>
									<tr><td>Price Point</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['pricepoint']	; ?></td>
									<?php
									}
									?>
									<tr><td>Days of Price Point</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['pricepointperdays']	; ?></td>
									<?php
									}
									?>
									<tr><td>Free Trial</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['freetrial']	; ?></td>
									<?php
									}
									?>
									<tr><td>Free Trial Days</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['freetrialdays']	; ?></td>
									<?php
									}
									?>
									<tr><td>FallBack</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['fallback']	; ?></td>
									<?php
									}
									?>
									
									<tr><td>FallBack Amount</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['actfallbackamount']	; ?></td>
									<?php
									}
									?>
									
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Landing page must include:</h5></td>
									<tr><td>Subscribe button</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['landingpagesubscribebutton']	; ?></td>
									<?php
									}
									?>
									<tr><td>Service Name</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['landingpageservicename']	; ?></td>
									<?php
									}
									?>
									
									<tr><td>Price point</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['landingpagepricepoint']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Service Terms and conditions</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['landingpaget&c']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Opening the MDN entry page or HE page or landing page</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['landingmsisdn']	; ?></td>
									<?php
									}
									?>
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Consent Page:</h5></td>
									<tr><td>Redirecting to Consent page either handled by operator or Pin Page handled by us</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['consentpagehandle']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Is the sub getting activated properly & getting captured in the reporting tool?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['activatedsuccessfully']	; ?></td>
									<?php
									}
									?>
									
									
									
									<tr><td>Are we getting activation call back & amount in the success call-back?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['activationcallbackwithamount']	; ?></td>
									<?php
									}
									?>
									<tr><td>Are we getting activation call back & amount in the success call-back?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['activationcallbackwithamount']	; ?></td>
									<?php
									}
									?>
									<tr><td>Are we getting fallbacks in the activation call back?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['fallbackinactivationcallback']	; ?></td>
									<?php
									}
									?>
									
									<tr><td>How many retries are there in the activation of a subscriber</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['retriesoftheactivation']	; ?></td>
									<?php
									}
									?>
									
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Unsub Flow:</h5></td>
									<tr><td>User is be able to Unsub the service</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['unsubbyuser']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Is the churn captured correctly & is getting in the reporting tool</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['unsubinreport']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Renewal Flow:</h5></td>
									<tr><td>Are we getting the renewal of the subscriber?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['renewalgetting']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Are we getting fallbacks in the renewal?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['fallbackinrenewal']	; ?></td>
									<?php
									}
									?>
									
									<tr><td>Amount of fallbacks in the renewal</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['renfallbackamount']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>How many retries are there in the activation of a subscriber?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['daysforrenewal']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Content Flow:</h5></td>
									<tr><td>Are we directing the user to the content page?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['directcontentpage']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Is the user able to download the games?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['downloadcontentbyuser']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>New portal is being displayed to the user</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['newportal']	; ?></td>
									<?php
									}
									?>
									
									
									
									<tr><td colspan=<?php echo $sizeop+1;?>><h5 style="color:red">Call-backs:</h5></td>
									<tr><td>Is the call-back being sent to the publisher?</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['callbacksent']	; ?></td>
									<?php
									}
									?>
									
									
									<tr><td>Have you placed the geo in reporting tool? Activation, Perform, Trend & Last activity report</td>
									<?php
									for($i=0;$i<$sizeop;$i++)
									{
									?>	
										<td><?php echo $ll [$operator[$i]]['completereport']	; ?></td>
									<?php
									}
									?>
									
									
									
							</tbody>
							
							
								
								
						</table>
					  </div>
				<!--<div id="advertiser"></div>-->
			<?php
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
            url: "ajax/find_operator1.php?product="+product         
			
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
            url: "ajax/advertiser.php?operator="+operator+"&product="+product         
			
        }).done(function(data){
            $(".response").html(data);
			 
        });

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
 
