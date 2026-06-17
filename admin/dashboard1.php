<?php
include("includes/check_session.php");
include("includes/connection.php");
require_once("includes/dbo.php");
error_reporting(0);


$operator='Vodafone';
$product='Hotshots';


$start_date='';
$end_date='';
$current_date=date('Y-m-d 00:00:00');
$current_date1=date('Y-m-d 00:00:00',strtotime('- 1 DAY'));
$prev_date=date('Y-m-d 00:00:00',strtotime('-1 MONTH'));
$prev_date1=date('Y-m-d 00:00:00', strtotime($prev_date. '-1 DAY'));

$db='hotshotsdb1';
$dblog='hotshotsdblog1';
		$sql="select * from ( 
				select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from( 
				select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
				select DISTINCT subscriptiondetail.subscriberid prev_activation, subscriptiondetail.amount prev_amount, 
				DATE(subscriptiondetail.subscriptionstartdate) dt from hotshotsdb1.subscriptiondetail 
				inner join hotshotsdb1.subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
				where isrenew=0 and amount > 0 and subscriptionstartdate >= '".$prev_date1."' and subscriptionstartdate < '".$prev_date."'
				)a 
				group by dt) z )b, ( 
				select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from( 
				select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from ( 
				select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount, 
				DATE(subscriptiondetail.subscriptionstartdate) dt from hotshotsdb1.subscriptiondetail 
				inner join hotshotsdb1.subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
				where isrenew = 0 and amount > 0 and subscriptionstartdate >= '".$current_date1."' and subscriptionstartdate < '".$current_date."'
				)c
				 group by dt) z )d, ( 
				select count(annonymoustrackingid) prev_click from hotshotsdblog1.annonymoustracking 
				where accesstime >= '".$prev_date1."' and accesstime < '".$prev_date."')e, ( 
				select count(annonymoustrackingid) curr_click from hotshotsdblog1.annonymoustracking 
				where accesstime >= '".$current_date1."' and accesstime < '".$current_date."') f, ( 
				select count(*) prev_churn from ( 
				select distinct subscriptiondetail.subscriberid prev_churn, DATE(subscriptiondetail.subscriptionstartdate) dt 
				from hotshotsdb1.subscriptiondetail 
				inner join (
				select * from hotshotsdb1.subscriptiondetail where amount > 0 and subscriptionstartdate < subscriptionenddate 
				and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
				on a.subscriberid = subscriptiondetail.subscriberid 
				where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate 
				and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate 
				and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid and subscriptiondetail.charging_mode != 'PARKING' 
				and subscriptiondetail.charging_mode != 'GRACE' 
				and subscriptiondetail.subscriptionstartdate >= '".$prev_date1."' and subscriptiondetail.subscriptionstartdate < '".$prev_date."' ) b )g, ( 
				select count(*) curr_churn from ( 
				select distinct subscriptiondetail.subscriberid curr_churn,DATE(subscriptiondetail.subscriptionstartdate) dt 
				from hotshotsdb1.subscriptiondetail 
				inner join (
				select * from hotshotsdb1.subscriptiondetail where amount > 0 and subscriptionstartdate < subscriptionenddate 
				and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
				on a.subscriberid = subscriptiondetail.subscriberid 
				where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate 
				and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate 
				and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid and subscriptiondetail.charging_mode != 'PARKING' 
				and subscriptiondetail.charging_mode != 'GRACE' and MONTH(subscriptiondetail.subscriptionstartdate) = MONTH(curdate()) 
				and  subscriptiondetail.subscriptionstartdate >='".$current_date1."' and subscriptiondetail.subscriptionstartdate < '".$current_date."') b )h;		
								"; 
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);

			$sql1="select * from (
					select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from(
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
					select DISTINCT subscriptiondetail.subscriberid prev_activation, 
					subscriptiondetail.amount prev_amount, DATE(subscriptiondetail.subscriptionstartdate) dt 
					from ".$db.".subscriptiondetail inner join ".$db.".subscriber 
					on subscriptiondetail.subscriberid = subscriber.subscriberid where isrenew=0 and amount > 0 
					and  subscriptionstartdate >= '".$prev_date1."' and subscriptionstartdate < '".$prev_date."' )a group by dt) z 
					)b,
					(
					select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount,
					DATE(subscriptiondetail.subscriptionstartdate) dt from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 0  and amount > 0 and subscriptionstartdate >= '".$current_date1."' and subscriptionstartdate < '".$current_date."')c group by dt) z
					)d,
					(
					select count(prev_renewal) prev_renewal, SUM(prev_ren_amount) prev_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_renewal, subscriptiondetail.amount prev_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$prev_date1."' and subscriptionstartdate < '".$prev_date."')a
					)i,
					(
					select count(curr_renewal) curr_renewal, SUM(curr_ren_amount) curr_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_renewal, subscriptiondetail.amount curr_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$current_date1."' and subscriptionstartdate < '".$current_date."')c
					)j				
					";
			$res1=mysql_query($sql1);
			$row1=mysql_fetch_array($res1);

			$sql2="
					select * from(
					select count(requestresponseid) prev_cbs from ".$db.".requestresponse where
					requesttime >= '".$prev_date1."' and requesttime < '".$prev_date."') a,
                    (
					select count(requestresponseid) curr_cbs from ".$db.".requestresponse where
					requesttime >= '".$current_date1."' and requesttime < '".$current_date."'

					)b;

					";
			$res2=mysql_query($sql2);
			$row2=mysql_fetch_array($res2);
				


if(isset($_POST['submit']))
{	
$operator=$_POST['operator'];
$product=$_POST['product'];
$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
$start_date1=date('Y-m-d 00:00:00',strtotime($start_date. '-1 MONTH'));
$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
$end_date1=date('Y-m-d 00:00:00',strtotime($end_date. '-1 MONTH'));

	if($operator=='Vodafone')
	{

		if($product=='Hotshots')
		{
			$db='hotshotsdb1';
			$dblog='hotshotsdblog1';
			$sql="select * from (
					select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from(
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
					select DISTINCT subscriptiondetail.subscriberid prev_activation, 
					subscriptiondetail.amount prev_amount, DATE(subscriptiondetail.subscriptionstartdate) dt 
					from ".$db.".subscriptiondetail inner join ".$db.".subscriber 
					on subscriptiondetail.subscriberid = subscriber.subscriberid where isrenew=0 and amount > 0 
					and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."' )a group by dt) z 
					)b,
					(
					select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount,
					DATE(subscriptiondetail.subscriptionstartdate) dt from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 0  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c group by dt) z
					)d,
					(
					select count(annonymoustrackingid) prev_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date1."' and accesstime < '".$end_date1."')e,
					(
					select count(annonymoustrackingid) curr_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date."' and accesstime < '".$end_date."') f,
					(
					select count(*) prev_churn  from (
					select distinct subscriptiondetail.subscriberid prev_churn, DATE(subscriptiondetail.subscriptionstartdate) dt
					from ".$db.".subscriptiondetail 
					inner join (select * from ".$db.".subscriptiondetail  where amount > 0 and subscriptionstartdate < subscriptionenddate 
					and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
					on a.subscriberid = subscriptiondetail.subscriberid  
					where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate  
					and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid  
					and subscriptiondetail.charging_mode != 'PARKING' and subscriptiondetail.charging_mode != 'GRACE' 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date1."' and subscriptiondetail.subscriptionstartdate < '".$end_date1."') b
					)g,
					(
					select count(*) curr_churn from (
					select distinct subscriptiondetail.subscriberid curr_churn,DATE(subscriptiondetail.subscriptionstartdate) dt
					from ".$db.".subscriptiondetail 
					inner join (select * from ".$db.".subscriptiondetail  where amount > 0 and subscriptionstartdate < subscriptionenddate 
					and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
					on a.subscriberid = subscriptiondetail.subscriberid  
					where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate  
					and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid  
					and subscriptiondetail.charging_mode != 'PARKING' and subscriptiondetail.charging_mode != 'GRACE' 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date."' and subscriptiondetail.subscriptionstartdate < '".$end_date."') b
					)h		
				"; 
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);

			$sql1="select * from (
					select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from(
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
					select DISTINCT subscriptiondetail.subscriberid prev_activation, 
					subscriptiondetail.amount prev_amount, DATE(subscriptiondetail.subscriptionstartdate) dt 
					from ".$db.".subscriptiondetail inner join ".$db.".subscriber 
					on subscriptiondetail.subscriberid = subscriber.subscriberid where isrenew=0 and amount > 0 
					and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."' )a group by dt) z 
					)b,
					(
					select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount,
					DATE(subscriptiondetail.subscriptionstartdate) dt from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 0  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c group by dt) z
					)d,
					(
					select count(prev_renewal) prev_renewal, SUM(prev_ren_amount) prev_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_renewal, subscriptiondetail.amount prev_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)i,
					(
					select count(curr_renewal) curr_renewal, SUM(curr_ren_amount) curr_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_renewal, subscriptiondetail.amount curr_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)j				
					";
			$res1=mysql_query($sql1);
			$row1=mysql_fetch_array($res1);

			$sql2="
					select * from(
					select count(requestresponseid) prev_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date1."' and requesttime < '".$end_date1."') a,
                    (
					select count(requestresponseid) curr_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date."' and requesttime < '".$end_date."'	)b;

					";
			$res2=mysql_query($sql2);
			$row2=mysql_fetch_array($res2);
				
		}
		else
		{
			$db='gamesdb_voda';
			$dblog='gamesdblog_voda';
					$sql="select * from (
					select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from(
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
					select DISTINCT subscriptiondetail.subscriberid prev_activation, 
					subscriptiondetail.amount prev_amount, DATE(subscriptiondetail.subscriptionstartdate) dt 
					from ".$db.".subscriptiondetail inner join ".$db.".subscriber 
					on subscriptiondetail.subscriberid = subscriber.subscriberid where isrenew=0 and amount > 0 
					and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."' )a group by dt) z 
					)b,
					(
					select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount,
					DATE(subscriptiondetail.subscriptionstartdate) dt from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 0  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c group by dt) z
					)d,
					(
					select count(annonymoustrackingid) prev_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date1."' and accesstime < '".$end_date1."')e,
					(
					select count(annonymoustrackingid) curr_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date."' and accesstime < '".$end_date."') f,
					(
					select count(*) prev_churn  from (
					select distinct subscriptiondetail.subscriberid prev_churn, DATE(subscriptiondetail.subscriptionstartdate) dt
					from ".$db.".subscriptiondetail 
					inner join (select * from ".$db.".subscriptiondetail  where amount > 0 and subscriptionstartdate < subscriptionenddate 
					and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
					on a.subscriberid = subscriptiondetail.subscriberid  
					where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate  
					and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid  
					and subscriptiondetail.charging_mode != 'PARKING' and subscriptiondetail.charging_mode != 'GRACE' 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date1."' and subscriptiondetail.subscriptionstartdate < '".$end_date1."') b
					)g,
					(
					select count(*) curr_churn from (
					select distinct subscriptiondetail.subscriberid curr_churn,DATE(subscriptiondetail.subscriptionstartdate) dt
					from ".$db.".subscriptiondetail 
					inner join (select * from ".$db.".subscriptiondetail  where amount > 0 and subscriptionstartdate < subscriptionenddate 
					and subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE)) a 
					on a.subscriberid = subscriptiondetail.subscriberid  
					where subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate  
					and subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid  
					and subscriptiondetail.charging_mode != 'PARKING' and subscriptiondetail.charging_mode != 'GRACE' 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date."' and subscriptiondetail.subscriptionstartdate < '".$end_date."') b
					)h		
				"; 
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);

			$sql1="select * from (
					select SUM(prev_activation) prev_activation,SUM(prev_amount) prev_amount from(
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from ( 
					select DISTINCT subscriptiondetail.subscriberid prev_activation, 
					subscriptiondetail.amount prev_amount, DATE(subscriptiondetail.subscriptionstartdate) dt 
					from ".$db.".subscriptiondetail inner join ".$db.".subscriber 
					on subscriptiondetail.subscriberid = subscriber.subscriberid where isrenew=0 and amount > 0 
					and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."' )a group by dt) z 
					)b,
					(
					select SUM(curr_activation) curr_activation,SUM(curr_amount) curr_amount from(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount,
					DATE(subscriptiondetail.subscriptionstartdate) dt from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 0  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c group by dt) z
					)d,
					(
					select count(prev_renewal) prev_renewal, SUM(prev_ren_amount) prev_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_renewal, subscriptiondetail.amount prev_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)i,
					(
					select count(curr_renewal) curr_renewal, SUM(curr_ren_amount) curr_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_renewal, subscriptiondetail.amount curr_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where isrenew = 1  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)j				
					";
			$res1=mysql_query($sql1);
			$row1=mysql_fetch_array($res1);

			$sql2="
					select * from(
					select count(requestresponseid) prev_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date1."' and requesttime < '".$end_date1."') a,
                    (
					select count(requestresponseid) curr_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date."' and requesttime < '".$end_date."'	)b;

					";
			$res2=mysql_query($sql2);
			$row2=mysql_fetch_array($res2);
		}
	}
	else
	{
		if($product=='Hotshots')
		{
			$db='hotshotsdb_idea';
			$db1='hotshotsdb';
			$dblog='hotshotsdblog_idea';
				$sql="select * from (
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_activation, subscriptiondetail.amount prev_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)b,
					(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)d,
					(
					select count(annonymoustrackingid) prev_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date1."' and accesstime < '".$end_date1."')e,
					(
					select count(annonymoustrackingid) curr_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date."' and accesstime < '".$end_date."') f,
					(
					select count(*) prev_churn  from (
					select distinct subscriptiondetail.subscriberid from ".$db.".subscriptiondetail  inner join (  
					select * from ".$db.".subscriptiondetail  
					where amount > 0 )  a 
					on a.subscriberid = subscriptiondetail.subscriberid  where left(subscriptiondetail.charging_mode, 3) = 'DCT'  and 
					subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date1."' and subscriptiondetail.subscriptionstartdate < '".$end_date1."'
					)b)g,
					(
					select count(*) curr_churn  from (
					select distinct subscriptiondetail.subscriberid from ".$db.".subscriptiondetail  inner join (  
					select * from ".$db.".subscriptiondetail  
					where amount > 0 )  a 
					on a.subscriberid = subscriptiondetail.subscriberid  where left(subscriptiondetail.charging_mode, 3) = 'DCT'  and 
					subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date."' and subscriptiondetail.subscriptionstartdate < '".$end_date."'
					)b)h
				"; 
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);

			$sql1="select * from (
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_activation, subscriptiondetail.amount prev_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)b,
					(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)d,
					(
					select count(prev_renewal) prev_renewal, SUM(prev_ren_amount) prev_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_renewal, subscriptiondetail.amount prev_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%'  and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)i,
					(
					select count(curr_renewal) curr_renewal, SUM(curr_ren_amount) curr_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_renewal, subscriptiondetail.amount curr_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%'  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)j				
					";
			$res1=mysql_query($sql1);
			$row1=mysql_fetch_array($res1);

			$sql2="
					select * from(
					select count(requestresponseid) prev_cbs from ".$db1.".requestresponse where
					requesttime >= '".$start_date1."' and requesttime < '".$end_date1."') a,
                    (
					select count(requestresponseid) curr_cbs from ".$db1.".requestresponse where
					requesttime >= '".$start_date."' and requesttime < '".$end_date."'

					)b

					";
			$res2=mysql_query($sql2);
			$row2=mysql_fetch_array($res2);
				
		}
		else
		{
			$db='gamesdb';
			
			$dblog='gamesdblog_idea';
				$sql="select * from (
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_activation, subscriptiondetail.amount prev_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)b,
					(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)d,
					(
					select count(annonymoustrackingid) prev_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date1."' and accesstime < '".$end_date1."')e,
					(
					select count(annonymoustrackingid) curr_click from ".$dblog.".annonymoustracking 
					where accesstime >= '".$start_date."' and accesstime < '".$end_date."') f,
					(
					select count(*) prev_churn  from (
					select distinct subscriptiondetail.subscriberid from ".$db.".subscriptiondetail  inner join (  
					select * from ".$db.".subscriptiondetail  
					where amount > 0 )  a 
					on a.subscriberid = subscriptiondetail.subscriberid  where left(subscriptiondetail.charging_mode, 3) = 'DCT'  and 
					subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date1."' and subscriptiondetail.subscriptionstartdate < '".$end_date1."'
					)b)g,
					(
					select count(*) curr_churn  from (
					select distinct subscriptiondetail.subscriberid from ".$db.".subscriptiondetail  inner join (  
					select * from ".$db.".subscriptiondetail  
					where amount > 0 )  a 
					on a.subscriberid = subscriptiondetail.subscriberid  where left(subscriptiondetail.charging_mode, 3) = 'DCT'  and 
					subscriptiondetail.subscriptionstartdate > a.subscriptionstartdate  
					and subscriptiondetail.subscriptiondetailid > a.subscriptiondetailid 
					and subscriptiondetail.subscriptionstartdate >= '".$start_date."' and subscriptiondetail.subscriptionstartdate < '".$end_date."'
					)b)h
				"; 
			$res=mysql_query($sql);
			$row=mysql_fetch_array($res);

			$sql1="select * from (
					select count(prev_activation) prev_activation, SUM(prev_amount) prev_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_activation, subscriptiondetail.amount prev_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)b,
					(
					select count(curr_activation) curr_activation, SUM(curr_amount) curr_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_activation, subscriptiondetail.amount curr_amount 
					from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%' and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)d,
					(
					select count(prev_renewal) prev_renewal, SUM(prev_ren_amount) prev_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid prev_renewal, subscriptiondetail.amount prev_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%'  and amount > 0 and subscriptionstartdate >= '".$start_date1."' and subscriptionstartdate < '".$end_date1."')a
					)i,
					(
					select count(curr_renewal) curr_renewal, SUM(curr_ren_amount) curr_ren_amount from (
					select DISTINCT subscriptiondetail.subscriberid curr_renewal, subscriptiondetail.amount curr_ren_amount from ".$db.".subscriptiondetail 
					inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
					where charging_mode like '%ACT%'  and amount > 0 and subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."')c
					)j				
					";
			$res1=mysql_query($sql1);
			$row1=mysql_fetch_array($res1);

			$sql2="
					select * from(
					select count(requestresponseid) prev_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date1."' and requesttime < '".$end_date1."') a,
                    (
					select count(requestresponseid) curr_cbs from ".$db.".requestresponse where
					requesttime >= '".$start_date."' and requesttime < '".$end_date."'

					)b

					";
			$res2=mysql_query($sql2);
			$row2=mysql_fetch_array($res2);
				

		}
	}

}
//echo "<script>window.location='report.php';</script>";
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
						
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control">
							<option>Select product</option>
							<option value="Hotshots" <?php if($product=='Hotshots'){$selected='selected';}else{$selected='';} echo $selected; ?> >Hotshots</option>
							<option value="Games" <?php if($product=='Games'){$selected='selected';}else{$selected='';} echo $selected; ?>>Gamezone</option>
						</select>
						</div>
						
                      

						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control">
							<option>Select Operator</option>
							<option value="Vodafone" <?php if($operator=='Vodafone'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone</option>
							<option value="Airtel" <?php if($operator=='Airtel'){$selected='selected';}else{$selected='';} echo $selected; ?>>Airtel</option>
							<option value="Idea" <?php if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
						</select>
						</div>

						
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date!=''){echo date('d-m-Y',strtotime($start_date));}else{ echo date('d-m-Y');} ?>"  type="text" >
						</div>

						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date!=''){echo date('d-m-Y',strtotime($end_date));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
						  <button type="submit" name="submit" class="btn btn-success">Submit</button>
						</div>

						

                    </form>
                  </div>
                </div>
				
              
              </div>
            </div>
			<h3><?php echo $product." ".$operator; ?></h3>
			<!-- top tiles -->
			<div class="row tile_count">
				
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-clock-o"></i> Clicks</span>
					<?php
					if($row['prev_click']>$row['curr_click'])
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($row['curr_click']/$row['prev_click'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> From last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($row['curr_click']/$row['prev_click'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> From last month</span>
					<?php
					}
					?>
					
				  
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-user"></i> Activation Count</span>
				  <?php
					if($row['prev_activation']>$row['curr_activation'])
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($row['curr_activation']/$row['prev_activation'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> From last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($row['curr_activation']/$row['prev_activation'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> From last month</span>
					<?php
					}
					?>
				  
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-user"></i> Activation Amount</span>
				  <?php
					if($row['prev_amount']>$row['curr_amount'])
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($row['curr_amount']/$row['prev_amount'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($row['curr_amount']/$row['prev_amount'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
				  
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-user"></i> Churn Count</span>
				  <?php
					if($row['prev_churn']>$row['curr_churn'])
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($row['curr_churn']/$row['prev_churn'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($row['curr_churn']/$row['prev_churn'])),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
				  
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-user"></i> Net Adds</span>
				  <?php
					 $total1=$row['prev_activation']-$row['prev_churn'];
					 $total2=$row['curr_activation']-$row['curr_churn'];
					if($total1 > $total2)
					{
					?>
						<div class="count red" ><?php  echo "".number_format((($total2/$total1)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($total2/$total1)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
						
					
				  
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				  <span class="count_top"><i class="fa fa-user"></i> Total Amount</span>
				  <?php
					$prev_ren_total=$row1['prev_amount']+$row1['prev_ren_amount'];
					$curr_ren_total=$row1['curr_amount']+$row1['curr_ren_amount']; 
					if($prev_ren_total > $curr_ren_total)
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($curr_ren_total/$prev_ren_total)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($curr_ren_total/$prev_ren_total)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
				</div>

				
				
			</div>
			<div class="row tile_count">
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> CR </span>
				  <?php
					$cr_prev=($row['prev_activation']/$row['prev_click'])*100;
					$cr_curr=($row['curr_activation']/$row['prev_click'])*100;
					if($cr_prev > $cr_curr)
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($cr_curr/$cr_prev)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($cr_curr/$cr_prev)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<span class="count_top"><i class="fa fa-user"></i> Digital Invest </span>
				  <?php
					if($operator=='Vodafone')
					{
						$prev_cbs=$row2['prev_cbs']*0.37;
						$curr_cbs=$row2['curr_cbs']*0.37;
					}
					else
					{
						$prev_cbs=$row2['prev_cbs']*0.34;
						$curr_cbs=$row2['curr_cbs']*0.34;
					}
					
					if($prev_cbs > $curr_cbs)
					{
					?>
						<div class="count red" ><?php  echo "-".number_format((($curr_cbs/$prev_cbs)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-desc red"></i> to last month</span>
					<?php
					}
					else
					{
					?>
						<div class="count green" ><?php  echo number_format((($curr_cbs/$prev_cbs)),2)."%" ;?></div>
						<span class="count_bottom"><i class="fa fa-sort-asc green"></i> to last month</span>
					<?php
					}
					?>
				</div>
			</div>
			<!-- /top tiles -->
		</div>
        <!-- /page content -->

       <?php
	   include("includes/footer.php");
	   ?>