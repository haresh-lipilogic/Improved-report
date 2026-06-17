<?php
include("includes/check_session.php");
include("includes/connection.php");
$con1=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error());
error_reporting(0);
$sum=0;
$start_date='';
$end_date='';
$operator='';
$product='';
$count=0;
$display='';
$type='';

if(isset($_POST['submit']))
{
	$count=1;
	$operator=$_POST['operator'];
	$product=$_POST['product'];
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
	
	
	$type=$_POST['type'];
	$display=$_POST['display']; 
	$advertiserid=$_POST['advertiserid'];
	
	//echo $operator;exit;
	if($type=='Activation')
	{
		if($display=='Count' || $display == 'Amount')
		{
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					$db='hotshotsnewdb_voda_0417';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="							
							SELECT 
								aa.dt dt,
								hr,
								COUNT(reqid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.reqid,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND amount > 0
										AND isrenew = 0) aa
							GROUP BY aa.dt , hr;
						"; 
						//echo $sql;
						$res=mysql_query($sql,$con1);	
					}
					else
					{
						$sql="							
							SELECT 
								aa.dt dt,
								hr,
								COUNT(reqid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.reqid,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										and advertiser.advertiserid='".$advertiserid."'
										AND amount > 0
										AND isrenew = 0) aa
							GROUP BY aa.dt , hr;
						"; 
						//echo $sql;
					$res=mysql_query($sql,$con1);	
					}
				}
				elseif($operator=='Airtel')
				{
					$db='hotshotsdb_airtel1';
					$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{
						$db='hotshotsnewdb_airtel_0417';
						
						
						$sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							INNER join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									AND subscriptiondetail.charging_mode != 541729
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						$db='hotshotsnewdb_airtel_0417';
						$sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							INNER join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									and advertiser.advertiserid=".$advertiserid."
									AND amount > 0
									AND isrenew = 0
									AND subscriptiondetail.charging_mode != 541729
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="							
							SELECT 
								aa.dt dt,hr, COUNT(msisdn) act, aa.advname advname,	sum(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.msisdn,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.msisdn = userlog.msisdn
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										
										AND amount > 0
										AND (charging_mode like '%act%' or charging_mode like '%UPGRD%')) aa
							GROUP BY aa.dt , hr;

					"; 
					//echo $sql;
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						$sql="							
							SELECT 
								aa.dt dt,hr, COUNT(msisdn) act, aa.advname advname,	sum(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.msisdn,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.msisdn = userlog.msisdn
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND advertiser.advertiserid= '".$advertiserid."'
									
										AND amount > 0
										AND (charging_mode like '%act%' or charging_mode like '%UPGRD%')) aa
							GROUP BY aa.dt , hr;

						"; 
					$res=mysql_query($sql,$con1);	
					}
									
					
				}
					
			}
			else
			{
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{

						$sql="SELECT 
							COUNT(mobilenumber)act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								mobilenumber, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								mobilenumber,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriptiondetail
							INNER JOIN ".$db.".subscriber ON subscriptiondetail.subscriberid = subscriber.subscriberid
							INNER JOIN ".$dblog.".annonymoustracking ON mobilenumber = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew = 0
									AND amount > 0
								   
							GROUP BY subscriptiondetail.subscriberid , dt) a ON a.atid = annonymoustrackingid) b
						GROUP BY dt , hr; 
						"; 
//					echo $sql;
					$res=mysql_query($sql,$con);	
					}
					else
					{
						$sql="SELECT 
							COUNT(mobilenumber)act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								mobilenumber, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								mobilenumber,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriptiondetail
							INNER JOIN ".$db.".subscriber ON subscriptiondetail.subscriberid = subscriber.subscriberid
							INNER JOIN ".$dblog.".annonymoustracking ON mobilenumber = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew = 0
									AND amount > 0
								   and advertiser.advertiserid=".$advertiserid."
							GROUP BY subscriptiondetail.subscriberid , dt) a ON a.atid = annonymoustrackingid) b
						GROUP BY dt , hr;
					"; 
					//echo $sql;
					$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						$sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
						";
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' and advertiser.advertiserid=".$advertiserid." GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
					";
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				else if($operator=='ooredoo')
				{
					//echo "hi";
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									".$db.".subscriber 
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
								GROUP BY dt,subscriberid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr; 
						"; 
						$res=mysql_query($sql,$con1);	
					}
					else{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									".$db.".subscriber 
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										and advertiser.advertiserid=".$advertiserid."
								GROUP BY dt,subscriberid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr; 
						"; 
						$res=mysql_query($sql,$con1);	
						
					}
					
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
							FROM (
							SELECT DISTINCT msisdn,
									DATE(subscriptionstartdate) dt,
									amount,
									HOUR(subscriptionstartdate) hr
							FROM
								".$db.".subscriber

							WHERE
								 charging_mode = 'subscribed' 
								 AND amount > 0
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND subscriptionstartdate < subscriptionenddate
									AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr;";
						$res=mysql_query($sql,$con);	
					}
					else{
						 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
							FROM (
							SELECT DISTINCT msisdn,
									DATE(subscriptionstartdate) dt,
									amount,
									HOUR(subscriptionstartdate) hr
							FROM
								".$db.".subscriber
								inner join ".$dblog.".annonymoustracking  on msisdn=userid
							WHERE
								 charging_mode = 'subscribed' 
								 AND amount > 0
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND subscriptionstartdate < subscriptionenddate
									AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr;";
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from (
						select distinct mobilenumber, dt, hr,amount
						from ".$dblog.".annonymoustracking inner join (
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid,
						 amount
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
						and charging_mode like '%ACT%' and amount > 0 and  (date(accesstime) = date(subscriptionstartdate) or
						date(accesstime) < date(subscriptionstartdate))
						 and annonymoustracking.advertiserid > -1
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=2
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b 
						group by dt,hr;
					"; 
					//echo $sql;
					$res=mysql_query($sql);	
					}
					else
					{
						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from (
						select distinct mobilenumber, dt, hr,amount
						from ".$dblog.".annonymoustracking inner join (
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid,
						 amount
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
						and charging_mode like '%ACT%' and amount > 0 and  (date(accesstime) = date(subscriptionstartdate) or
						date(accesstime) < date(subscriptionstartdate))
						 and annonymoustracking.advertiserid > -1
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=2 and advertiser.advertiserid=".$advertiserid."
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b 
						group by dt,hr;
					"; 
					$res=mysql_query($sql);	
					}
									
					
				}
				
			}
		}
		
	
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						if($display=='Count')
							$advname[$prevdate][$hour]=$row['act']."";	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
							
						
					}
					$dt[$prevdate]= $act;
					
	}
	elseif($type=='Renewal')
	{	
		if($display=='Count' || $display == 'Amount')
		{
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					$db='hotshotsdb1';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{
						$db='hotshotsnewdb_voda_0417';
						 $sql="							
							SELECT 
								aa.dt dt,
								hr,
								COUNT(reqid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.reqid,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND amount > 0
										AND isrenew = 1) aa
							GROUP BY aa.dt , hr;
						"; 
					$res=mysql_query($sql,$con1);
					}
					else
					{
						$db='hotshotsnewdb_voda_0417';
						$sql="SELECT 
								aa.dt dt,
								hr,
								COUNT(reqid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.reqid,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										and advertiser.advertiserid='".$advertiserid."'
										AND amount > 0
										AND isrenew = 1) aa
							GROUP BY aa.dt , hr;
						"; 
						$res=mysql_query($sql,$con1);
					}
				}
				elseif($operator=='Airtel')
				{
					$db='hotshotsdb_airtel1';
					$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{
						$db='hotshotsnewdb_airtel_0417';
						$sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							left join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 1
									AND subscriptiondetail.charging_mode != 541729
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
							";
							//echo $sql;
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						$db='hotshotsnewdb_airtel_0417';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							left join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									and advertiser.advertiserid=".$advertiserid."
									AND subscriptiondetail.charging_mode != 541729
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{
	
						$sql="							
							SELECT 
								aa.dt dt,hr, COUNT(msisdn) act, aa.advname advname,	sum(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.msisdn,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.msisdn = userlog.msisdn
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										and isrenew=1
										AND amount > 0
										) aa
							GROUP BY aa.dt , hr;

						"; 
						//echo $sql;
					$res=mysql_query($sql,$con1);	
					
					
					}
					else
					{
						 $sql="SELECT 
								aa.dt dt,hr, COUNT(msisdn) act, aa.advname advname,	sum(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.msisdn,
										advname,
										advertiser.advertiserid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								INNER JOIN ".$db.".userlog ON subscriptiondetail.msisdn = userlog.msisdn
								INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
								WHERE
									subscriptionstartdate > '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										and isrenew=1
										AND amount > 0
										and advertiser.advertiserid=".$advertiserid."
										) aa
							GROUP BY aa.dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
					}
									
					
				}
			}
			else
			{
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="SELECT 
							COUNT(mobilenumber)act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								mobilenumber, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								mobilenumber,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriptiondetail
							INNER JOIN ".$db.".subscriber ON subscriptiondetail.subscriberid = subscriber.subscriberid
							INNER JOIN ".$dblog.".annonymoustracking ON mobilenumber = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew = 1
									AND amount > 0
								   
							GROUP BY subscriptiondetail.subscriberid , dt) a ON a.atid = annonymoustrackingid) b
						GROUP BY dt , hr; 
						"; 
							$res=mysql_query($sql);	
					
					}
					else
					{
						$sql="SELECT 
							COUNT(mobilenumber)act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								mobilenumber, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								mobilenumber,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriptiondetail
							INNER JOIN ".$db.".subscriber ON subscriptiondetail.subscriberid = subscriber.subscriberid
							INNER JOIN ".$dblog.".annonymoustracking ON mobilenumber = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew = 1
									AND amount > 0
								   and advertiser.advertiserid=".$advertiserid."
							GROUP BY subscriptiondetail.subscriberid , dt) a ON a.atid = annonymoustrackingid) b
						GROUP BY dt , hr; 
						"; 
							$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						$sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
								FROM (
								SELECT DISTINCT msisdn,
										DATE(subscriptionstartdate) dt,
										amount,
										HOUR(subscriptionstartdate) hr
								FROM
									".$db.".subscriber

								WHERE
									 charging_mode='ren' and
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND subscriptionstartdate < subscriptionenddate
										AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr ; 
													";
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="
						SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
								FROM (
								SELECT DISTINCT msisdn,
										DATE(subscriptionstartdate) dt,
										amount,
										HOUR(subscriptionstartdate) hr
								FROM
									".$db.".subscriber
									INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								WHERE
									 charging_mode='ren' and
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND subscriptionstartdate < subscriptionenddate
										and advertiserid=".$advertiserid."
										AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr; 
						";
								
						$res=mysql_query($sql,$con);	
						
					}
				}
				else if($operator=='ooredoo')
				{
					//echo "hi";
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									".$db.".subscriber 
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 1
										AND amount > 0
								GROUP BY dt,subscriberid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr; 
						"; 
						$res=mysql_query($sql,$con1);	
					}
					
					else{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									".$db.".subscriber 
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 1
										AND amount > 0
										and advertiser.advertiserid=".$advertiserid."
								GROUP BY dt,subscriberid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr; 
						"; 
						$res=mysql_query($sql,$con1);	
						
					}
					
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
							FROM (
							SELECT DISTINCT msisdn,
									DATE(subscriptionstartdate) dt,
									amount,
									HOUR(subscriptionstartdate) hr
							FROM
								".$db.".subscriber

							WHERE
								 charging_mode = 'ren' 
								 AND amount > 0
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND subscriptionstartdate < subscriptionenddate
									AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr;";
						$res=mysql_query($sql,$con);	
					}
					else{
						 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt 
							FROM (
							SELECT DISTINCT msisdn,
									DATE(subscriptionstartdate) dt,
									amount,
									HOUR(subscriptionstartdate) hr
							FROM
								".$db.".subscriber
								inner join ".$dblog.".annonymoustracking  on msisdn=userid
							WHERE
								 charging_mode = 'ren' 
								 AND amount > 0
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND subscriptionstartdate < subscriptionenddate
									AND subscriptionstartdate != SUBDATE(subscriptionenddate, INTERVAL 30 MINUTE))b GROUP BY dt , hr;";
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
							and charging_mode like '%REN%'
							and annonymoustracking.advertiserid > -1  and operator=2
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							"; 
							$res=mysql_query($sql);	
					
					}
					else
					{
						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
							and charging_mode like '%REN%'
							and annonymoustracking.advertiserid > -1  and operator=2 and advertiser.advertiserid=".$advertiserid."
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							";
							$res=mysql_query($sql);	
					}
									
					
				}
			}
					//$res=mysql_query($sql);	
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						if($display=='Count')
							$advname[$prevdate][$hour]=$row['act']."";	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
							
						
					}
					$dt[$prevdate]= $act;
			
			}
		}
	
	elseif($type=='Clicks')
	{
		if($display=='Count'   )
		{
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					$db='hotshotsnewdb_voda_0417';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr;
							"; 
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;
							"; 
							$res=mysql_query($sql,$con1);	
					}
				}
				elseif($operator=='Airtel')
				{
					$db='hotshotsnewdb_airtel_0417';
					$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						$sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr;
							"; 
							//echo $sql;
							//exit;
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;
							"; 
							$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$db.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						
						$sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr;
							"; 
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						$sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$db.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;
							"; 
							$res=mysql_query($sql,$con1);	
					}
									
					
				}
			}
			else
			{
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1 ";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{

						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
						
						//echo $sql;
						
					$res=mysql_query($sql,$con);	
					}
					else
					{
						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;
							"; 
							$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						 $sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
						$res=mysql_query($sql,$con);	
						
					}
				}
				else if($operator=='ooredoo')
				{
					//echo "hi";
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						 $sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
						$res=mysql_query($sql,$con1);	
					}
					else{
						
						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
						$res=mysql_query($sql,$con1);	
						
					}
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					 $sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
						$res=mysql_query($sql,$con);	
					}
					else{
						 $sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{

						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr;
							"; 
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select count(annonymoustrackingid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".annonymoustracking   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;
							";
						$res=mysql_query($sql,$con);	
					}
									
					
				}
			}
					//$res=mysql_query($sql);	
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						if($display=='Count')
							$advname[$prevdate][$hour]=$row['act']."";	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
							
						
					}
					$dt[$prevdate]= $act;
			
		}
	}		
	elseif($type =='Callbacks')
	{
		
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					$db='hotshotsnewdb_voda_0417';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{
						$sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con1);	
					}
					else
					{
						$sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
					}
				}
				elseif($operator=='Airtel')
				{
					$db='hotshotsnewdb_airtel_0417';
					$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{
						$sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con1);	
					}
					else
					{
						$sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						$sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."'   group by dt, hr
						"; 
							$res=mysql_query($sql,$con1);	
					}
					else
					{
					 $sql="select count(advertcallbackid) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							";
							$res=mysql_query($sql,$con1);	
					}		
				}
			}
			else
			{
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con);	
					}
					else
					{
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
							$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
						$res=mysql_query($sql,$con);	
						
					}
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con);	
					}
					else{
						 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				
				else if($operator=='ooredoo')
				{
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."'   group by dt, hr
						"; 
						$res=mysql_query($sql,$con1);	
					}
					else{
						
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
						$res=mysql_query($sql,$con);	
						
					}
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					if($advertiserid=='all')
					{
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."'   group by dt, hr
							"; 
							$res=mysql_query($sql);	
					}
					else
					{
						$sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt, hr
							"; 
							$res=mysql_query($sql);	
					}		
				}
			}
					//$res=mysql_query($sql);	
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						if($display=='Count')
							$advname[$prevdate][$hour]=$row['act']."";	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
							
						
					}
					$dt[$prevdate]= $act;
			
		
	}
	elseif($type=='Parking')
	{
		
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					$db='hotshotsnewdb_voda_0417';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

					 $sql="SELECT 
								COUNT(reqid) act, dt, hr, SUM(amount) amt
							FROM
								(
								SELECT DISTINCT
									subscriptiondetail.reqid,
										subscriptiondetail.msisdn,
										DATE(subscriptionstartdate) dt,
										hour(subscriptionstartdate) hr,
										amount

								FROM
									".$db.".subscriptiondetail
								LEFT JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'PARKING'
									   
								) b
							GROUP BY dt , hr;
							"; 
							
							$res=mysql_query($sql);	
					
					}
					else
					{
						$sql="SELECT 
								COUNT(reqid) act, dt, hr, SUM(amount) amt
							FROM
								(
								SELECT DISTINCT
									subscriptiondetail.reqid,
										subscriptiondetail.msisdn,
										DATE(subscriptionstartdate) dt,
										hour(subscriptionstartdate) hr,
										amount

								FROM
									".$db.".subscriptiondetail
								LEFT JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										and advertiserid=".$advertiserid."
										AND charging_mode = 'PARKING'
									   
								) b
							GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql);	
					}
				}
				else if($operator=='Airtel')
				{
					$db='hotshotsnewdb_airtel_0417';
					$sql_ad="select * from ".$db.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					if($advertiserid=='all')
					{
					 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							INNER join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount = 0
									AND isrenew = 0
									AND subscriptiondetail.charging_mode = 541729
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;";
						$res=mysql_query($sql,$con1);	
					}
					else{
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									userlog.msisdn,
									advname,
									advertcallback.advertiserid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount,max(userlogid)
							FROM
								".$db.".subscriptiondetail
							LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
							INNER join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
							INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount = 0
									AND isrenew = 0
									AND subscriptiondetail.charging_mode = 541729
									AND subscriptiondetail.errorcode = 1000
									and advertiserid=".$advertiserid."
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;";

						$res=mysql_query($sql,$con1);	
					}
					
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$db.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						$sql="SELECT 
								COUNT(txnid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.txnid,
										subscriptiondetail.msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode LIKE '%ACT%'
										AND amount = 0) b
							GROUP BY dt , hr
														";  
							
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						 $sql="SELECT 
								COUNT(txnid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.txnid,
										subscriptiondetail.msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode LIKE '%ACT%'
										AND amount = 0 and advertiserid=".$advertiserid.") b
										
							GROUP BY dt , hr
					";
					
							$res=mysql_query($sql,$con1);	
					}
									
					
				}
			}
			else
			{	
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1 ";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{

						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' and charging_mode = 'PARKING'
							and annonymoustracking.advertiserid > -1  and operator=1 
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							"; 
							//echo $sql;
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' and charging_mode = 'PARKING'
							and annonymoustracking.advertiserid > -1  and operator=1 and advertiser.advertiserid=".$advertiserid."
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							"; 
							$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						$sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' and amount=0 GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
						";
							//echo $sql;
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' and amount = 0 and advertiser.advertiserid=".$advertiserid." GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
					";
						$res=mysql_query($sql,$con);	
						
					}
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' and amount=0 GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
						";
						$res=mysql_query($sql,$con);	
					}
					else{
						 $sql="SELECT COUNT(msisdn)act, dt, hr, SUM(amount) amt FROM (SELECT DISTINCT msisdn, dt, hr, amount FROM ".$dblog.".annonymoustracking INNER JOIN (SELECT msisdn, DATE(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, MAX(annonymoustrackingid) atid, amount FROM ".$db.".subscriber INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid left JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid WHERE subscriptionstartdate >= '".$start_date."' AND subscriptionstartdate < '".$end_date."' AND charging_mode='SUB' and amount = 0 and advertiser.advertiserid=".$advertiserid." GROUP BY subscriber.subscriberid , dt) a ON a.atid = annonymoustrackingid) b GROUP BY dt , hr; 
					";
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				else if($operator=='ooredoo')
				{
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									 ".$db.".subscriber
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode ='success'
										and amount=0
										AND annonymoustracking.advertiserid > - 1
										
								GROUP BY subscriberid , dt , advertiser.advertiserid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr"; 
							//echo $sql;
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn, dt, hr, amount
								FROM
									".$dblog.".annonymoustracking
								INNER JOIN (SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(annonymoustrackingid) atid,
										amount
								FROM
									 ".$db.".subscriber
								INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
								INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode ='success'
										and amount=0
										AND annonymoustracking.advertiserid = ".$advertiserid."
										
								GROUP BY subscriberid , dt , advertiser.advertiserid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr"; 
							//echo $sql;
							$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad,$con);
					
					if($advertiserid=='all')
					{

						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
							and charging_mode like '%ACT%' and amount = 0
							and annonymoustracking.advertiserid > -1  and operator=2
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							"; 
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
							select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
							select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
							from ".$db.".subscriptiondetail 
							inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
							inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
							inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
							where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."'
							and charging_mode like '%ACT%' and amount = 0
							and annonymoustracking.advertiserid > -1  and operator=2 and advertiser.advertiserid=".$advertiserid."
							group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr;
							"; 
							$res=mysql_query($sql,$con);	
					}
									
					
				}
			}
					//$res=mysql_query($sql);	
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						if($display=='Count')
							$advname[$prevdate][$hour]=$row['act']."";	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
							
						
					}
					$dt[$prevdate]= $act;
			
		
	}
	elseif($type=='CR')
	{
			if($product=='Hotshots')
			{
				if($operator=='Vodafone')
				{
					
					//$db='hotshotsdb1';
					$db='hotshotsnewdb_voda_0417';
					$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						 $sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(reqid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
									reqid, dt, hr, amount
								FROM
									".$db.".userlog
								INNER JOIN (SELECT 
									reqid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.reqid , dt , advertiser.advertiserid) a ON a.atid = userlogid) b
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;
							"; 
							//echo $sql;
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						$sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(reqid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
									reqid, dt, hr, amount
								FROM
									".$db.".userlog
								INNER JOIN (SELECT 
									reqid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										and advertiser.advertiserid=".$advertiserid."
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.reqid , dt , advertiser.advertiserid) a ON a.atid = userlogid) b
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and advertiserid=".$advertiserid."
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;
													"; 
						$res=mysql_query($sql,$con1);	
					}
				}
				elseif($operator=='Airtel')
				{
					$db='hotshotsnewdb_airtel_0417';
					$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($advertiserid=='all')
					{

						$sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(txnid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT 
									subscriptiondetail.txnid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										AND charging_mode != 541729
										AND errorcode = 1000
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.txnid , dt , advertiser.advertiserid)b 
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;"; 
								//echo $sql;
						$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						 $sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(txnid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT 
									subscriptiondetail.txnid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										AND charging_mode != 541729
										AND errorcode = 1000
										and advertiser.advertiserid=".$advertiserid."
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.txnid , dt , advertiser.advertiserid)b 
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and advertiserid=".$advertiserid."
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;"; 
						$res=mysql_query($sql,$con1);	
					}
				}
				else
				{
					$db='hotshotsnewdb_idea_0417';
					$dblog='hotshotsdblog_idea';
					
					$sql_ad="select * from ".$db.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						 $sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(txnid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT 
									subscriptiondetail.txnid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										AND charging_mode like '%ACT%'
										
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.txnid , dt , advertiser.advertiserid)b 
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;";
							$res=mysql_query($sql,$con1);	
					
					}
					else
					{
						 $sql="SELECT 
								act, dt, hr, amt, act1
							FROM
								(SELECT 
									COUNT(txnid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT 
									subscriptiondetail.txnid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										MAX(userlogid) atid,
										amount
								FROM
									".$db.".subscriptiondetail
								
								INNER JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
								INNER JOIN ".$db.".advertiser ON advertiser.advertiserid = userlog.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND isrenew = 0
										AND amount > 0
										AND charging_mode like '%ACT%'
										and advertiser.advertiserid=".$advertiserid."
										AND DATE(accesstime) = DATE(subscriptionstartdate)
										
										
								GROUP BY subscriptiondetail.txnid , dt , advertiser.advertiserid)b 
								GROUP BY dt , hr) c,
								(SELECT 
									COUNT(userlogid) act1,
										DATE(AccessTime) dt1,
										HOUR(AccessTime) hr1
								FROM
								  ".$db.".userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and advertiser.advertiserid=".$advertiserid."
								GROUP BY dt1 , hr1) d
							WHERE
								d.dt1 = c.dt AND d.hr1 = c.hr;";
						$res=mysql_query($sql,$con1);	
					}
									
					
				}
			}
			else
			{
				if($operator=='Vodafone')
				{
					$db='gamesdb_voda';
					$dblog='gamesdblog_voda';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

						$sql="select act,dt,hr,amt,act1 from ( 
						select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
						select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' and isrenew=0 and amount > 0 and date(accesstime) = date(subscriptionstartdate)  and annonymoustracking.advertiserid > -1 
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=1 
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c,
						(select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking   
						where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr;

							";
							//echo $sql;
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select act,dt,hr,amt,act1 from ( 
						select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
						select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' and isrenew=0 and amount > 0 and
						date(accesstime) = date(subscriptionstartdate)  and annonymoustracking.advertiserid > -1 
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=1 
						and annonymoustracking.advertiserid=".$advertiserid."
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c,
						(select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking   
						where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr;
						"; 
						$res=mysql_query($sql,$con);	
					}
				}
				else if($operator=='Azharbeizan')
				{
					$db="gamesdb_azerbaijan";
					$dblog="gamesdblog_azerbaijan";
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
					  $sql="select act,dt,hr,amt,act1 from ( select count(msisdn) act, dt, hr , sum(amount) amt from ( select distinct msisdn, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( select msisdn, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount from ".$db.".subscriber inner join ".$dblog.".annonymoustracking on msisdn = userid inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate <'".$end_date."' and charging_mode='sub' and date(accesstime) = date(subscriptionstartdate) and annonymoustracking.advertiserid > -1 and accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by subscriber.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c, (select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking where accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr
							"; 
						$res=mysql_query($sql,$con);	
					}
					else{
						$sql="select act,dt,hr,amt,act1 from ( select count(msisdn) act, dt, hr , sum(amount) amt from ( select distinct msisdn, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( select msisdn, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount from ".$db.".subscriber inner join ".$dblog.".annonymoustracking on msisdn = userid inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate <'".$end_date."' and charging_mode='sub' and date(accesstime) = date(subscriptionstartdate) and annonymoustracking.advertiserid > ".$advertiserid." and accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by subscriber.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c, (select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking where accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr
						"; 
						$res=mysql_query($sql,$con);	
						
					}
					
				}
				
				
				else if($operator=='etisalat')
				{
					$db='gamesdb_etisalat';
					$dblog='gamesdblog_etisalat';
					
					$sql_ad="select * from ".$dblog.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
					if($advertiserid=='all')
					{
						 $sql="select act,dt,hr,amt,act1 from ( select count(msisdn) act, dt, hr , sum(amount) amt from ( select distinct msisdn, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( select msisdn, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount from ".$db.".subscriber inner join ".$dblog.".annonymoustracking on msisdn = userid inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate <'".$end_date."' and charging_mode='sub' and date(accesstime) = date(subscriptionstartdate) and annonymoustracking.advertiserid > -1 and accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by subscriber.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c, (select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking where accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr
							";
						$res=mysql_query($sql,$con);	
					}
					else{
						
						$sql="select act,dt,hr,amt,act1 from ( select count(msisdn) act, dt, hr , sum(amount) amt from ( select distinct msisdn, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( select msisdn, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount from ".$db.".subscriber inner join ".$dblog.".annonymoustracking on msisdn = userid inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate <'".$end_date."' and charging_mode='sub' and date(accesstime) = date(subscriptionstartdate) and annonymoustracking.advertiserid > ".$advertiserid." and accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by subscriber.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c, (select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking where accesstime >= '".$start_date."' and accesstime <'".$end_date."' group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr
						"; 
						$res=mysql_query($sql,$con);	
						
					}
				}
				else if($operator=='ooredoo')
				{
					$db='gamesdb_ooredoo_qatar';
					$dblog='gamesdblog_ooredoo_qatar';
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
					  $sql="SELECT 
							act, dt, hr, amt, act1
						FROM
							(SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
								msisdn, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								msisdn,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriber
							INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew=0
									and amount > 0
									AND DATE(accesstime) = DATE(subscriptionstartdate)
									AND annonymoustracking.advertiserid > - 1
									AND accesstime >= '".$start_date."'
									AND accesstime < '".$end_date."'
							GROUP BY subscriber.subscriberid , dt , advertiser.advertiserid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr) c,
							(SELECT 
								COUNT(annonymoustrackingid) act1,
									DATE(AccessTime) dt1,
									HOUR(AccessTime) hr1
							FROM
								".$dblog.".annonymoustracking
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime < '".$end_date."'
							GROUP BY dt1 , hr1) d
						WHERE
							d.dt1 = c.dt AND d.hr1 = c.hr";
						$res=mysql_query($sql,$con1);	
					}
					else{
						
						$sql="SELECT 
							act, dt, hr, amt, act1
						FROM
							(SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
								msisdn, dt, hr, amount
							FROM
								".$dblog.".annonymoustracking
							INNER JOIN (SELECT 
								msisdn,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									MAX(annonymoustrackingid) atid,
									amount
							FROM
								".$db.".subscriber
							INNER JOIN ".$dblog.".annonymoustracking ON msisdn = userid
							INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND isrenew=0
									and amount > 0
									AND DATE(accesstime) = DATE(subscriptionstartdate)
									AND annonymoustracking.advertiserid = ".$advertiserid."
									AND accesstime >= '".$start_date."'
									AND accesstime < '".$end_date."'
							GROUP BY subscriber.subscriberid , dt , advertiser.advertiserid) a ON a.atid = annonymoustrackingid) b
							GROUP BY dt , hr) c,
							(SELECT 
								COUNT(annonymoustrackingid) act1,
									DATE(AccessTime) dt1,
									HOUR(AccessTime) hr1
							FROM
								".$dblog.".annonymoustracking
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime < '".$end_date."'
									and advertiserid=".$advertiserid."
							GROUP BY dt1 , hr1) d
						WHERE
							d.dt1 = c.dt AND d.hr1 = c.hr
						"; 
						$res=mysql_query($sql,$con);	
						
					}
				}
				else
				{
					$db='gamesdb';
					$dblog='gamesdblog_idea';
					
					$sql_ad="select * from ".$dblog.".advertiser where operator=2";
					$res_ad=mysql_query($sql_ad);
					
					if($advertiserid=='all')
					{

					$sql="select act,dt,hr,amt,act1 from ( 
						select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
						select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' 
						and charging_mode like '%ACT%' and amount > 0 and date(accesstime) = date(subscriptionstartdate)  and annonymoustracking.advertiserid > -1 
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=2 
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c,
						(select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking   
						where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr;

							"; 
							$res=mysql_query($sql,$con);	
					
					}
					else
					{
						$sql="select act,dt,hr,amt,act1 from ( 
						select count(mobilenumber) act, dt, hr , sum(amount) amt from ( 
						select distinct mobilenumber, dt, hr,amount from ".$dblog.".annonymoustracking inner join ( 
						select mobilenumber, date(subscriptionstartdate) dt, HOUR(subscriptionstartdate) hr, max(annonymoustrackingid) atid, amount 
						from ".$db.".subscriptiondetail 
						inner join ".$db.".subscriber on subscriptiondetail.subscriberid = subscriber.subscriberid 
						inner join ".$dblog.".annonymoustracking on mobilenumber = userid 
						inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid 
						where subscriptionstartdate >= '".$start_date."' and subscriptionstartdate < '".$end_date."' 
						and charging_mode like '%ACT%' and amount > 0 and
						date(accesstime) = date(subscriptionstartdate)  and annonymoustracking.advertiserid > -1 
						and accesstime >= '".$start_date."' and accesstime < '".$end_date."' and operator=2
						and annonymoustracking.advertiserid=".$advertiserid."
						group by subscriptiondetail.subscriberid, dt, advertiser.advertiserid) a on a.atid = annonymoustrackingid) b group by dt,hr) c,
						(select count(annonymoustrackingid) act1, date(AccessTime) dt1, hour(AccessTime) hr1 from ".$dblog.".annonymoustracking   
						where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid."  group by dt1, hr1) d where d.dt1=c.dt and d.hr1=c.hr;
						"; 
						$res=mysql_query($sql,$con);	
					}
									
					
				}
			}
					
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$arrdt = [];
					while($row=mysql_fetch_array($res))
					{	
						if($prevdate == "")
						 $prevdate = $row['dt'];
							
						if($prevdate != $row['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row['dt'];
						}
						$hour=$row['hr'];
						//$act[$row['hr']]= number_format(($row['act']/$row['act1'])*100,2);	
						if($display=='Count')
							$advname[$prevdate][$hour]=number_format(($row['act']/$row['act1'])*100,2);	
						else
							$advname[$prevdate][$hour]= $row['amt'];	
						
						
						
							
						
					}
					$dt[$prevdate]= $act;
					
					
					
			
		
	}		
	
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
                    <h2>Trend Report</h2>
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
					<input type="text" hidden value="<?php echo $count; ?>"   id="check1">
					
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control" id="product" onchange="myfun()">
							<option>Product</option>
							<option value="Hotshots" <?php if($product=='Hotshots'){$selected='selected';}else{$selected='';} echo $selected; ?> >Hotshots</option>
							<option value="GamezZone" <?php if($product=='GamezZone'){$selected='selected';}else{$selected='';} echo $selected; ?>>GamezZone</option>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control" id="operator">
						<?php
						if($product == 'Hotshots')
						{ ?>
							<option>Operator</option>
							<option value="Vodafone" <?php if($operator=='Vodafone'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone</option>
							<option value="Airtel" <?php if($operator=='Airtel'){$selected='selected';}else{$selected='';} echo $selected; ?>>Airtel</option>
							<option value="Idea" <?php if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
						<?php
						}
						else if($product == 'GamezZone'){
						?>
							<option value="Vodafone" <?php if($operator=='Vodafone'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone</option>
							<option value="Idea" <?php if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
							<option  id="azharbeizan" name="azharbeizan" value="Azharbeizan" <?php if($operator=='Azharbeizan'){$selected='selected';}else{$selected='';} echo $selected; ?>>Azharbeizan</option>
							<option  id="ooredoo" name="ooredoo" value="ooredoo" <?php if($operator=='ooredoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>Ooredoo-Qatar</option>
							<option  id="etisalat" name="etisalat" value="etisalat" <?php if($operator=='etisalat'){$selected='selected';}else{$selected='';} echo $selected; ?>>etisalat</option>
						<?php
						}
						else{
						?>
						<option>Operator</option>
						<?php
						}
						?>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date!=''){echo date('d-m-Y',strtotime($start_date2));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date!=''){echo date('d-m-Y',strtotime($end_date2));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>
						
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Type
								<select name="type" class="form-control">
									
									<option value="Activation" <?php $selected=''; if($type=='Activation') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Activation</option>
									<option value="Renewal" <?php  $selected=''; if($type=='Renewal') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Renewal</option>
								<!--	<option value="Churn" <?php  //$selected=''; if($type=='Churn') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Churn</option> -->
									<option value="Clicks" <?php  $selected=''; if($type=='Clicks') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Clicks</option>
								<!--	<option value="Total" <?php // $selected=''; if($type=='Total') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Total</option>-->
									<option value="Parking" <?php  $selected=''; if($type=='Parking') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Parking</option>
									<option value="CR" <?php  $selected=''; if($type=='CR') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>CR</option>
									<!--<option value="Aggr CR" <?php  //$selected=''; if($type=='Aggr CR') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Aggr CR</option>-->
									<option value="Callbacks" <?php  $selected=''; if($type=='Callbacks') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Callbacks</option>
								
								</select>
								
							</div>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Display
								<select name="display" class="form-control">
							
								<option value="Count" <?php  $selected=''; if($display=='Count') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Count</option>
								<option value="Amount" <?php  $selected=''; if($display=='Amount') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Amount</option>
							
								</select>
							</div>
						
						
						<?php
						if($count==0)
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-12 orm-group has-feedback first"> Advertiser
							<span class="response">
							</span>
							
							</div>
						<?php
						}
						else
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-3 form-group has-feedback two"> Advertiser
								<span class="response" id="f">
								</span>
								<span id="t">
								<select name="advertiserid" class="form-control select2_single sel">
									<option value="all">All</option>
									<?php
										
									while($row_ad=mysql_fetch_array($res_ad))
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

												<td><?php echo $sum=$sum+$a1;?></td>

												<?php 
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
		var product=$("#product").val();
		
        $.ajax({
            type: "GET",
            url: "ajax/find_advertiser.php?operator="+operator+"&product="+product         
			
        }).done(function(data){
            $(".response").html(data);
			 
        });
    });
});
</script>	 
<script type="text/javascript">
function myfun() {
	var x = document.getElementById("product").value;
    //alert(x);
	if(x =='Hotshots')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		select.options[select.options.length] = new Option('Airtel', 'Airtel');
	}
	else if(x =='GamezZone')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone', 'Vodafone');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		//select.options[select.options.length] = new Option('Airtel', 'Airtel');
		select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		select.options[select.options.length] = new Option('etisalat', 'etisalat');
		select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo');
	}
	
	/*if(x=="Hotshots")
	{
		 //alert("hi");
	document.getElementById('azharbeizan').style.visibility = 'hidden';
	}else
	{
		document.getElementById('azharbeizan').style.visibility = 'visible';
	}*/
}
</script>		
