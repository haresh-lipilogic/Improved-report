<?php
//include("includes/check_session.php");
//include("includes/connection.php");
error_reporting(0);
include("includes/check_session.php");
if($_SESSION['admin']==0)
{
	//echo "<script>alert('you are not allow to use this report');</script>";
	//			echo "<script>window.location='report.php'</script>";
	//header('location:report.php');
}
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



		$database= 'gamebardb_vodafone_qatar_report';
		
		$sql3="select * from ".$database.".uat";
		$res_ad=mysqli_query($con,$sql3);
	
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$stmt1 = $con->prepare("INSERT INTO ".$database.".uat (`product`, `country`, `operator`, `testurl`, `pricepoint`, `pricepointperdays`, `freetrial`, `freetrialdays`, `fallback`, `landingpagesubscribebutton`, `landingpageservicename`, `landingpagepricepoint`, `landingpaget&c`, `landingmsisdn`, `consentpagehandle`, `activatedsuccessfully`, `activationcallbackwithamount`, `fallbackinactivationcallback`, `retriesoftheactivation`, `unsubbyuser`, `unsubinreport`, `renewalgetting`, `fallbackinrenewal`, `daysforrenewal`, `directcontentpage`, `downloadcontentbyuser`, `newportal`, `callbacksent`, `completereport`,actfallbackamount,renfallbackamount) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt1->bind_param("sssssssssssssssssssssssssssssss",$_POST['product'],$_POST['country'],$_POST['operator'],$_POST['url'],$_POST['pricepoint'],$_POST['pricepointdays'],$_POST['freetrial'],$_POST['freetrialdays'],$_POST['fallback'],$_POST['subscribebutton'],$_POST['servicename'],$_POST['pricepointonlanding'],$_POST['servicetnc'],$_POST['openinglp'],$_POST['consenthandle'],$_POST['activatedsuccessfully'],$_POST['activationcallbackwithamount'],$_POST['fallbackinactivationcallback'],$_POST['retriesoftheactivation'],$_POST['unsubbyuser'],$_POST['unsubinreport'],$_POST['renewalgetting'],$_POST['fallbackinrenewal'],$_POST['daysforrenewal'],$_POST['directcontentpage'],$_POST['downloadcontentbyuser'],$_POST['newportal'],$_POST['callbacksent'],$_POST['completereport'],$_POST['actfallbackamount'],$_POST['renfallbackamount']);	
				
				
				$stmt1->execute();
		}
	
	
	
	
	


?>

		<?php include("includes/header.php"); ?>
		<?php include("includes/sidebar.php"); ?>
		<?php include("includes/top_navigation.php"); ?>
            
			
		   <div class="right_col" role="main" >
          <div class="footer_down">
		 <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ADD UAT <small></small></h2>
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
					
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
						<tbody>
						<tr>
						<td><h5>1.</h5></td>
						<td><h5>Product</h5></td>
						<td><input name="product" style="width:500px;"; class="form-control" type="text" required></td>
						
						
						
						
						<tr>
						<td><h5>2.</h5></td>
						<td><h5>Country</h5></td>
						<td><input name="country" style="width:500px;"; class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>3.</h5></td>
						<td><h5>Operator</h5></td>
						<td><input name="operator" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>4.</h5></td>
						<td><h5>Test URL</h5></td>
						<td><input name="url" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>5.</h5></td>
						<td><h5>Price Point</h5></td>
						<td><input name="pricepoint" class="form-control" type="text" required></td> 
						
						
						<tr>
						<td><h5>6.</h5></td>
						<td><h5>Days of Price Point</h5></td>
						<td><input name="pricepointdays" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>7.</h5></td>
						<td><h5>Free Trial</h5></td>
						<td><input name="freetrial" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td><h5>8.</h5></td>
						<td><h5>Free Trial Days</h5></td>
						<td><input name="freetrialdays" class="form-control" type="text" required></td>
						
						
						
						
						<tr>
						<td><h5>9.</h5></td>
						<td><h5>Fallback</h5></td>
						<td><input name="fallback" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>10.</h5></td>
						<td><h5>Fallback Amount</h5></td>
						<td><input name="actfallbackamount" class="form-control" type="text" required></td>
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Landing page must include:</strong></h4></td>
						
						<tr>
						<td><h5>11.</h5></td>
						<td><h5>Subscribe button</h5></td>
						<td><input name="subscribebutton" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td><h5>12.</h5></td>
						<td><h5>Service Name</h5></td>
						<td><input name="servicename" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td><h5>13.</h5></td>
						<td><h5>Price point</h5></td>
						<td><input name="pricepointonlanding" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>14.</h5></td>
						<td><h5>Service Terms and conditions</h5></td>
						<td><input name="servicetnc" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>15.</h5></td>
						<td><h5>Opening the MDN entry page or HE page or landing page</h5></td>
						<td><input name="openinglp" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Consent Page:</strong></h4></td>
						
						<tr>
						<td><h5>16.</h5></td>
						<td><h5>Redirecting to Consent page either handled by operator or Pin Page handled by us</h5></td>
						<td><input name="consenthandle" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>17.</h5></td>
						<td><h5>Is the sub getting activated properly & getting captured in the reporting tool?</h5></td>
						<td><input name="activatedsuccessfully" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>18.</h5></td>
						<td><h5>Are we getting activation call back & amount in the success call-back?</h5></td>
						<td><input name="activationcallbackwithamount" class="form-control" type="text" required></td>
												
						<tr>
						<td><h5>19.</h5></td>
						<td><h5>Are we getting fallbacks in the activation call back?</h5></td>
						<td><input name="fallbackinactivationcallback" class="form-control" type="text" required></td>
						<tr>
						<td><h5>20.</h5></td>
						<td><h5>How many retries are there in the activation of a subscriber</h5></td>
						<td><input name="retriesoftheactivation" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Unsub Flow:</strong></h4></td>
						
						<tr>
						<td><h5>21.</h5></td>
						<td><h5>User is be able to Unsub the service</h5></td>
						<td><input name="unsubbyuser" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>22.</h5></td>
						<td><h5>Is the churn captured correctly & is getting in the reporting tool</h5></td>
						<td><input name="unsubinreport" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Renewal Flow:</strong></h4></td>
						
						<tr>
						<td><h5>23.</h5></td>
						<td><h5>Are we getting the renewal of the subscriber?</h5></td>
						<td><input name="renewalgetting" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>24.</h5></td>
						<td><h5>Are we getting fallbacks in the renewal?</h5></td>
						<td><input name="fallbackinrenewal" class="form-control" type="text" required></td>
						
						
						<tr>
						<td><h5>25.</h5></td>
						<td><h5>Amount of fallbacks in the renewal</h5></td>
						<td><input name="renfallbackamount" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>26.</h5></td>
						<td><h5>How many retries are there in the activation of a subscriber?</h5></td>
						<td><input name="daysforrenewal" class="form-control" type="text" required></td>
						
						
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Content Flow:</strong></h4></td>
						
						<tr>
						<td><h5>27.</h5></td>
						<td><h5>Are we directing the user to the content page?</h5></td>
						<td><input name="directcontentpage" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>28.</h5></td>
						<td><h5>Is the user able to download the games?</h5></td>
						<td><input name="downloadcontentbyuser" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>29.</h5></td>
						<td><h5>New portal is being displayed to the user</h5></td>
						<td><input name="newportal" class="form-control" type="text" required></td>
						
						
						
						<tr>
						<td colspan=3><h4 style="color:red;"> <strong>Call-backs:</strong></h4></td>
						
						<tr>
						<td><h5>30.</h5></td>
						<td><h5>Is the call-back being sent to the publisher?</h5></td>
						<td><input name="callbacksent" class="form-control" type="text" required></td>
						
						<tr>
						<td><h5>31.</h5></td>
						<td><h5>Have you placed the geo in reporting tool? Activation, Perform, Trend & Last activity report</h5></td>
						<td><input name="completereport" class="form-control" type="text" required></td>
						
						
						
						
						
						
						
						
						
						</tbody>
						</table>
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
						  <button type="submit" name="submit" class="btn btn-success">Submit</button>
						</div>
                      

                    </form>
                  </div>
                </div>
				
              
              </div>
            </div> </div>
            </div>