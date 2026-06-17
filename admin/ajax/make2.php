<?php
include("../includes/connection.php");

$currencytoinr=$_GET['currencytoinr'];
$id=$_GET['id'];

//$commondb="commondb";

	//ajax/make.php?operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&type="+type+"&db="+database
	
				$update_advertiser="update gamebardb_vodafone_qatar_report.currency set toinr ='".$currencytoinr."' where id = '".$id."'";
				$res_advertiser=mysqli_query($con,$update_advertiser);
				
				
		


?>