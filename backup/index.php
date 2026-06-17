<?php

include("includes/connection.php");

//$con=mysql_connect("43.231.124.191","webserveruser","K&dN&r4a8N@du0") or die(mysql_error()); // Old Back
error_reporting(0);


$start_date='';
$end_date='';
$operator='';
$product='';
$server1='';
$server2='';
$count=0;

if(isset($_POST['submit']))
{

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
$server1=$_POST['server1'];


	if($start_date == $end_date)
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
	}	
	else
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
	}
	
	if($server1 == 'live_back')
	{
		$condition=1;
		$con1=mysql_connect("10.125.0.50","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
		$con2=mysql_connect("43.231.124.191","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
	}
	elseif($server1 == 'live_inter')
	{
		$condition=2;
		$con1=mysql_connect("10.125.0.50","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
		$con2=mysql_connect("10.125.0.52","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
	}
	else
	{
		$condition=3;
		$con1=mysql_connect("10.125.0.52","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
		$con2=mysql_connect("43.231.124.191","productionuser","Zb8#fNIsXnoP12") or die(mysql_error());
	}
	
	
	
	
	
	

if($product=='hotshots' || $product=='Hotshots')
{
	if($operator == 'Vodafone')
	{
		if($condition == 1)
		{
			$db="hotshotsdb1";
			$dblog="hotshotsdblog1";
			
			$db1="hotshotsdb1_Oct_2016";
			$dblog1="hotshotsdblog1_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		elseif($condition == 2)
		{
			
				$db="hotshotsdb1";
				$dblog="hotshotsdblog1";
				
				$sql="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$sql1="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$res=mysql_query($sql,$con1);
				$res1=mysql_query($sql1,$con2);
			
		}
		else
		{
			$db="hotshotsdb1";
			$dblog="hotshotsdblog1";
			
			$db1="hotshotsdb1_Oct_2016";
			$dblog1="hotshotsdblog1_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		
	}
	elseif($operator == 'Airtel')
	{
		if($condition == 1)
		{
				$db="hotshotsdb_airtel1";
				$dblog="hotshotsdblog_airtel1";
				
				$db1="hotshotsdb_airtel1_Oct_2016";
				$dblog1="hotshotsdblog_airtel1_Oct_2016";
				
				$sql="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
				
				
				$sql1="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db1.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db1.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db1.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db1.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog1.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
			";
			
			$res=mysql_query($sql,$con1);
			$res1=mysql_query($sql1,$con2);
		}
		elseif($condition == 2)
		{
			
				$db="hotshotsdb_airtel1";
				$dblog="hotshotsdblog_airtel1";
				
				
				$sql="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$sql1="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$res=mysql_query($sql,$con1);
				$res1=mysql_query($sql1,$con2);
			
		}
		else
		{
			$db="hotshotsdb_airtel1";
			$dblog="hotshotsdblog_airtel1";
			
			$db1="hotshotsdb_airtel1_Oct_2016";
			$dblog1="hotshotsdblog_airtel1_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		
	}
	else
	{
		if($condition == 1)
		{
			$db="hotshotsdb_idea";
			$db_1="hotshotsdb";
			$dblog="hotshotsdblog_idea";
			
			$db1="hotshotsdb_idea_Oct_2016";
			$db2="hotshotsdb_Oct_2016";
			$dblog1="hotshotsdblog_idea_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db_1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db2.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		elseif($condition == 2)
		{
			
			$db="hotshotsdb_idea";
			$db_1="hotshotsdb";
			$dblog="hotshotsdblog_idea";
			
			
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db_1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db_1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
				$res=mysql_query($sql,$con1);
				$res1=mysql_query($sql1,$con2);
			
		}
		else
		{
			$db="hotshotsdb_idea";
			$db_1="hotshotsdb";
			$dblog="hotshotsdblog_idea";
			
			$db1="hotshotsdb_idea_Oct_2016";
			$db2="hotshotsdb_Oct_2016";
			$dblog1="hotshotsdblog_idea_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db_1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db2.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		
	}
}
else
{
	if($operator == 'Vodafone')
	{	
		if($condition == 1)
		{
			$db="gamesdb_voda";
			$dblog="gamesdblog_voda";
			
			$db1="gamesdb_voda_Oct_2016";
			$dblog1="gamesdblog_voda_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		elseif($condition == 2)
		{
			
				$db="gamesdb_voda";
				$dblog="gamesdblog_voda";
				
				$sql="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$sql1="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$res=mysql_query($sql,$con1);
				$res1=mysql_query($sql1,$con2);
			
		}
		else
		{
			$db="gamesdb_voda";
			$dblog="gamesdblog_voda";
			
			$db1="gamesdb_voda_Oct_2016";
			$dblog1="gamesdblog_voda_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		
	}
	elseif($operator == 'Airtel')
	{
	
	}
	else
	{
		
		if($condition == 1)
		{
			$db="gamesdb";
			$dblog="gamesdblog_idea";
			
			$db1="gamesdb_Oct_2016";
			$dblog1="gamesdblog_idea_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		elseif($condition == 2)
		{
			
				$db="gamesdb";
				$dblog="gamesdblog_idea";
				
				$sql="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$sql1="
				SELECT 
					cnt1, cnt2, cnt3, cnt4, cnt5, dt1
				FROM
					(SELECT DISTINCT
						COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
					FROM
						".$db.".requestresponse
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt1) a,
					(SELECT DISTINCT
						COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
					FROM
						".$db.".callbackrequests
					WHERE
						requesttime >= '".$start_date."'
							AND requesttime < '".$end_date."'
					GROUP BY dt2) b,
					(SELECT DISTINCT
						COUNT(callbackresponsesid) cnt3,
							DATE(callbackresponsetime) dt3
					FROM
						".$db.".callbackresponses
					WHERE
						callbackresponsetime >= '".$start_date."'
							AND callbackresponsetime < '".$end_date."'
					GROUP BY dt3) c,
					(SELECT DISTINCT
						COUNT(subscriptiondetailid) cnt4,
							DATE(subscriptionstartdate) dt4
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."'
					GROUP BY dt4) d,
					(SELECT DISTINCT
						COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
					FROM
						".$dblog.".annonymoustracking
					WHERE
						accesstime >= '".$start_date."'
							AND accesstime < '".$end_date."'
					GROUP BY dt5) e
				WHERE
					dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
						AND dt4 = dt5;
				";
			
				$res=mysql_query($sql,$con1);
				$res1=mysql_query($sql1,$con2);
			
		}
		else
		{
			$db="gamesdb";
			$dblog="gamesdblog_idea";
			
			$db1="gamesdb_Oct_2016";
			$dblog1="gamesdblog_idea_Oct_2016";
			
			$sql="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
			";
			
			
			$sql1="
			SELECT 
				cnt1, cnt2, cnt3, cnt4, cnt5, dt1
			FROM
				(SELECT DISTINCT
					COUNT(requestresponseid) cnt1, DATE(requesttime) dt1
				FROM
					".$db1.".requestresponse
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt1) a,
				(SELECT DISTINCT
					COUNT(callbackrequestsid) cnt2, DATE(requesttime) dt2
				FROM
					".$db1.".callbackrequests
				WHERE
					requesttime >= '".$start_date."'
						AND requesttime < '".$end_date."'
				GROUP BY dt2) b,
				(SELECT DISTINCT
					COUNT(callbackresponsesid) cnt3,
						DATE(callbackresponsetime) dt3
				FROM
					".$db1.".callbackresponses
				WHERE
					callbackresponsetime >= '".$start_date."'
						AND callbackresponsetime < '".$end_date."'
				GROUP BY dt3) c,
				(SELECT DISTINCT
					COUNT(subscriptiondetailid) cnt4,
						DATE(subscriptionstartdate) dt4
				FROM
					".$db1.".subscriptiondetail
				WHERE
					subscriptionstartdate >= '".$start_date."'
						AND subscriptionstartdate < '".$end_date."'
				GROUP BY dt4) d,
				(SELECT DISTINCT
					COUNT(annonymoustrackingid) cnt5, DATE(accesstime) dt5
				FROM
					".$dblog1.".annonymoustracking
				WHERE
					accesstime >= '".$start_date."'
						AND accesstime < '".$end_date."'
				GROUP BY dt5) e
			WHERE
				dt1 = dt2 AND dt2 = dt3 AND dt3 = dt4
					AND dt4 = dt5;
		";
		
		$res=mysql_query($sql,$con1);
		$res1=mysql_query($sql1,$con2);
		}
		
			
	}
}


$res=mysql_query($sql,$con1);
$res1=mysql_query($sql1,$con2);

//echo $num= mysql_num_rows($res);
//echo $num1= mysql_num_rows($res1); exit;
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
                    <h2>Table's Count Report </h2>
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
                  
                    <br />
                    <form class="form-horizontal form-label-left input_mask" method="post">
					<div class="x_content">
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control" id="product">
							<option>Product</option>
							<option value="Hotshots" <?php if($product=='Hotshots'){$selected='selected';}else{$selected='';} echo $selected; ?> >Hotshots</option>
							<option value="GamezZone" <?php if($product=='GamezZone'){$selected='selected';}else{$selected='';} echo $selected; ?>>GamezZone</option>
						</select>
						</div>
					
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control" id="operator">
							<option>Select Operator</option>
							<option value="Vodafone" <?php if($operator=='Vodafone'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone</option>
							<option value="Airtel" <?php if($operator=='Airtel'){$selected='selected';}else{$selected='';} echo $selected; ?>>Airtel</option>
							<option value="Idea" <?php if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date!=''){echo date('d-m-Y',strtotime($start_date));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date!=''){echo date('d-m-Y',strtotime($end_date));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>

					
						
					
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback"> Server
						<select name="server1" class="form-control" id="product">
							<option>Select Server</option>
							<option value="live_back" <?php if($server1=='live_back'){$selected='selected';}else{$selected='';} echo $selected; ?>>Live vs  Master (Full Backup) Server</option>
							<option value="live_inter" <?php if($server1=='live_inter'){$selected='selected';}else{$selected='';} echo $selected; ?> >Live vs Intermediate Server</option>
							<option value="inter_back" <?php if($server1=='inter_back'){$selected='selected';}else{$selected='';} echo $selected; ?>>Intermediate vs  Master (Full Backup) Server</option>
							
						</select>
						</div>
						
						
						

                     
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
						  <button type="submit" name="submit" class="btn btn-success">Submit</button>
						</div>
                      
					</div>
                    </form>
                  
                </div>
				
              
              </div>
            </div>
			
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Output Records</h2>
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
									<td><strong>Requestresponse</strong></td>
									<td><strong>Callbackrequests</strong></td>									
									<td><strong>Callbackresponses</strong></td>									
									<td><strong>Subscriptiondetail</strong></td>								
									<td><strong>Annonymoustracking</strong></td>					
								</tr>
							</thead>


							<tbody>
								<?php 
								while((($row=mysql_fetch_array($res)) && ($row1=mysql_fetch_array($res1))) 
									|| (($row=mysql_fetch_array($res)) || ($row1=mysql_fetch_array($res1))))
								{
								
								?>
								<tr>
								
									<td><?php echo $row['dt1'];  ?></td>
									
									<?php 
									if($row['cnt1'] != $row1['cnt1'])
									{
									?>
										<td style="color:#ff0000;font-weight:bold;"><?php echo $row['cnt1']."-".$row1['cnt1'];  ?></td>
									<?php
									}
									else
									{
									?>
										<td style="color:#228900;font-weight:bold;"><?php echo $row['cnt1']."-".$row1['cnt1'];  ?></td>
									<?php
									}
									?>
									
									<?php 
									if($row['cnt2'] != $row1['cnt2'])
									{
									?>
										<td style="color:#ff0000;font-weight:bold;"><?php echo $row['cnt2']."-".$row1['cnt2'];  ?></td>
									<?php
									}
									else
									{
									?>
										<td style="color:#228900;font-weight:bold;"><?php echo $row['cnt2']."-".$row1['cnt2'];  ?></td>
									<?php
									}
									?>
									
									<?php 
									if($row['cnt3'] != $row1['cnt3'])
									{
									?>
										<td style="color:#ff0000;font-weight:bold;"><?php echo $row['cnt3']."-".$row1['cnt3'];  ?></td>
									<?php
									}
									else
									{
									?>
										<td style="color:#228900;font-weight:bold;"><?php echo $row['cnt3']."-".$row1['cnt3'];  ?></td>
									<?php
									}
									?>
									
									<?php 
									if($row['cnt4'] != $row1['cnt4'])
									{
									?>
										<td style="color:#ff0000;font-weight:bold;"><?php echo $row['cnt4']."-".$row1['cnt4'];  ?></td>
									<?php
									}
									else
									{
									?>
										<td style="color:#228900;font-weight:bold;"><?php echo $row['cnt4']."-".$row1['cnt4'];  ?></td>
									<?php
									}
									?>
									
									<?php 
									if($row['cnt5'] != $row1['cnt5'])
									{
									?>
										<td style="color:#ff0000;font-weight:bold;"><?php echo $row['cnt5']."-".$row1['cnt5'];  ?></td>
									<?php
									}
									else
									{
									?>
										<td style="color:#228900;font-weight:bold;"><?php echo $row['cnt5']."-".$row1['cnt5'];  ?></td>
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