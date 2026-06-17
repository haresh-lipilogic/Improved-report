<?php
ini_set('max_execution_time', 6000);

//include("includes/check_session.php");
//include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);
$con=new mysqli("10.34.240.3","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$con3=new mysqli("10.34.240.3","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2

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
	$display=$_POST['display']; 
	$advertiserid=$_POST['advertiserid'];
	$b=$c=0;
	if($start_date == $end_date)
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
		$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
		$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
	}	
	else
	{
		$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
		$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
		$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
		$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
	}
	
	if($product=='gamebar' || $product=='gamebar')
	{
		
		if($operator=='Vodafone_Qatar')
		{
			$db="gamebardb_vodafone_qatar";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="hotshotsdblog1";
			$sql_ad="select * from ".$db.".advertiser where operator=1 ";
			$res_ad=mysql_query($sql_ad,$con);
			
			
		}
		else if($operator=='vodafone_egypt')
		{
			
			$db="gamebardb_vodafone_egypt";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="gamesdblog_voda";
			
			$sql_ad="select * from ".$db.".advertiser where operator=1 ";
			$res_ad=mysqli_query($con,$sql_ad);
		}
		else if($operator=='indonesia')
		{
			$db="gamebardb_indonesia";
			$dblog="gamebardblog_indonesia";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="hotshotsdblog1";
			$sql_ad="select * from ".$db.".advertiser where operator=1 ";
			$res_ad=mysql_query($sql_ad,$con);
			
			
		}
		elseif ($operator=='airtel_india')
		{
			$db="gamebardb_airtel";
		//	$dblog="hotshotsdblog_airtel1";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='spain')
		{
			$db="gamebardb_spain";
			$dblog="gamebardblog_spain";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='pk_telenor')
		{
			$db="gamebar_pk";
			$dblog="gamebar_pk_log";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser where serviceid=1 ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='pk_zong')
		{
			$db="gamebar_pk";
			$dblog="gamebar_pk_log";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser where serviceid=2 ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		
		elseif ($operator=='kwstc')
		{
			$db="fashionbardb_slakwstc";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbslakwstc.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='qatar_ooredoo')
		{
			$db="fashionbardb_qatarooredoo";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbqatarooredoo.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		
		elseif ($operator=='kwzain')
		{
			$db="fashionbardb_slakwzain";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		
		
		
		elseif ($operator=='stc_ksa')
		{
			$db="fashionbardb_timwezain";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='uae_etisalat')
		{
			$db="fashionbardb_etisalat";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbetisalat.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		else if($operator=='zain_ksa')
		{
			$db="fashionbardb_timwezain";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbksazain.advertiser";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='vodafone')
		{
			$db="gamebardb_svmobi";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		else if($operator=='gamezone_vodafone')
		{
			$db="gamesnewdb_voda";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		
		
		else if($operator=='myanmar')
		{
			
			$db="fashionbardb_myanmartelenor";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="gamesdblog_voda";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);

		}
				
		else if($operator=='a1_austria')
		{
			
			$db="gamebardb_a1";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="gamesdblog_voda";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);
			
		}
		else if($operator=='tmobile_austria')
		{
			
			$db="gamebardb_tmobile";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="gamesdblog_voda";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);
			
		}
		else if($operator=='hutchison_austria')
		{
			
			$db="gamebardb_dimoco";
			$report="gamebardb_vodafone_qatar_report";
			//$dblog="gamesdblog_voda";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);
			
		}


		else if($operator=='poland')
		{
			$db="gamebar_poland";
			$dblog="gamebar_poland_log";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);
		}
		
		
		else if($operator=='finland')
		{
			$db="fashionbardb_finland";
			$dblog="gamebar_poland_log";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select advertiserid,advertiser_name advname from commondbfinland.advertiser ";
					$res_ad=mysql_query($sql_ad,$con);
		}
		
		
		else if($operator=='vodacom_za')
		{
			$db="vodacom_za";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser where serviceid=4";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		else if($operator=='buhrain_zain')
		{
			$db="fashionbardb_bh";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select advertiserid,advertiser_name advname from commondbbh.advertiser";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		else if($operator=='saudiarabia_zain')
		{
			$db="fashionbardb_timwezain";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select advertiserid,advertiser_name advname from commondbtimwezain.advertiser";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		/*
		else
		{
			$db="hotshotsnewdb_idea_0717";
			//$db1="hotshotsdb";
			//$dblog="hotshotsdblog_idea";
			$sql_ad="select * from ".$db.".advertiser where operator=2 ";
			$res_ad=mysql_query($sql_ad,$con);
			
			
		}*/
		
	}
	else
	{
		
		if ($operator=='airtel_india')
		{
			$db="funzonedb_airtel";
		//	$dblog="hotshotsdblog_airtel1";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		elseif ($operator=='spain')
		{
			$db="fashionbardb_spain";
			$dblog="fashionbardblog_spain";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		
		

		
		
		elseif ($operator=='vodafone')
		{
			$db="fashionbardb_svmobi";
			
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
			$res_ad=mysql_query($sql_ad,$con);
		}
		
		else if($operator=='hotshots_vodafone')
		{
			$db="hotshotsnewdb_voda_0617";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		else if($operator=='poland')
		{
			$db="glambar_poland";
			$dblog="glambar_poland_log";
			$report="gamebardb_vodafone_qatar_report";
			$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con);
		}
		else if($operator=='vodacom_wfh')
		{
			$db="vodacom_za";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser where serviceid=1";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		else if($operator=='vodacom_fg')
		{
			$db="vodacom_za";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser where serviceid=2";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		else if($operator=='vodacom_bt')
		{
			$db="vodacom_za";
			$dblog="vodacom_za_log";
			$report="gamebardb_vodafone_qatar_report";
			
			$sql_ad="select * from ".$db.".advertiser where serviceid=3";
			$res_ad=mysqli_query($con,$sql_ad);
			
		}
		
		
		
		
	}
	
	if($end_date1 == $date1 && $start_date1 == $date1)
	{
		$c=1;//currentdate
	}
	elseif($end_date1 == $date1 && $start_date1 != $date1)
	{
		
		$b=1;
		$c=1;
	}
	else{
		
		$b=1;
	}
		
	
	if($type=='Activation')
	{
		if($display=='Count' || $display == 'Amount')
		{
			if($product=='gamebar')
			{
				if($operator=='Vodafone_Qatar')
				{
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and advname='all' and type='activation' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='activation' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						///echo hi2;exit;
						
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
							//echo "hi";exit;
						
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
							
							
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
										left JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
										left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
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
										left JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
										left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
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
					
				}
				
				elseif($operator=='vodacom_za')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=4 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											and serviceid=4
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=4
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='buhrain_zain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					//$sql_ad="select * from ".$db.".advertiser where serviceid=4 ";
					//$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_bh.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_bh.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;

						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				else if($operator=='vodafone_egypt')
				{
					$c=1;
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and advname='all' and type='activation' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='activation' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						///echo hi2;exit;
						
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
							//echo "hi";exit;
						
						//$start_date=date('Y-m-d')." 00:00:00";
						//$end_date=date('Y-m-d')." 23:59:59";
							
							
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
										left JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
										left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
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
										left JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
										left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
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
					
				}
				
				
				
				
				else if($operator=='ooredoo_oman')
				{
					//echo "hi";
					
					
					$sql_ad="select * from ".$commondbomooredoo.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						 $sql="SELECT 
							COUNT(msisdn) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								msisdn,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								fashionbardb_omooredoo.subscriber
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND charging_mode = 'act'
									AND amount > 0
							GROUP BY dt , msisdn) a
						GROUP BY dt , hr;
						"; 
						$res=mysql_query($sql,$con1);	
					}
					else{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT  DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_omooredoo.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						"; 
						$res=mysql_query($sql,$con1);	
						
					}
					
				}
				
				else if($operator=='indonesia')
				{
					
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."'  and type='activation' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='activation' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											And advid='".$advertiserid."'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; ; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
					}
				}
				
				
			
			
				elseif($operator=='spain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion+startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion+startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='finland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_finland.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_finland.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				elseif($operator=='pk_telenor')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ACT'
										and mnc='06'
										AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ACT'
										and mnc='06'
										AND amount > 0
										and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				elseif($operator=='uae_etisalat')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from commondbetisalat.advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_etisalat.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'act'
											AND amount > 0
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				elseif($operator=='pk_zong')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ACT'
										and mnc='04'
										AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ACT'
										and mnc='04'
										AND amount > 0
										and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				elseif($operator=='stc_ksa')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_timwezain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										and operator='stc'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_timwezain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										and advertiserid='".$advertiserid."'
										and operator='stc'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;		
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='kwstc')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwstc.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;

						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwstc.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='kwzain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwstc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_slakwzain.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'act'
											AND amount > 0
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;

						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_slakwzain.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'act'
											AND amount > 0
											AND advertiserid = '".$advertiserid."'
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				elseif($operator=='saudiarabia_zain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksazain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_timwezain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										and operator='zain'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				elseif($operator=='poland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					//echo $sql;exit;
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
						
						
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				
				
				elseif($operator=='a1_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='tmobile_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='hutchison_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 0
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='myanmar')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="	SELECT 
							HOUR(subscriptionstartdate) hr,
							DATE(subscriptionstartdate) dt,
							COUNT(DISTINCT clickid) act,
								0 amt
						FROM
							
							".$db.".subscriber 
						WHERE
							subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND charging_mode = 'act'
							GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql=" 
				 			SELECT 
							HOUR(subscriptionstartdate) hr,
							DATE(subscriptionstartdate) dt,
							COUNT(DISTINCT clickid) act,
								0 amt
						FROM
							".$db.".subscriber 
						WHERE
							subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND charging_mode = 'act'
							AND advertiserid = ".$advertiserid."
							GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				elseif($operator=='vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'activation'
									AND amount > 0
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'activation'
									AND amount > 0
									and advertid=".$advertiserid."
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='gamezone_vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
						
						$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							left join ".$db.".userlog on subscriptiondetail.reqid=userlog.txnid
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									and advertiserid=".$advertiserid."
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
				}
			
			
			
			}
			else
			{
				
				if($operator=='airtel_india')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."'  and type='activation' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='activation' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					if($c==1)
					{
						
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									subscriptiondetail.msisdn,
									advname,
									subscriptiondetail.advertid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							left JOIN ".$db.".advertiser ON subscriptiondetail.advertid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									AND (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178)
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(txnid) act,
							aa.advname advname,
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.txnid,
									subscriptiondetail.msisdn,
									advname,
									subscriptiondetail.advertid,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							LEFT JOIN ".$db.".advertiser ON subscriptiondetail.advertid = advertiser.advertiserid
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									and advertiser.advertiserid=".$advertiserid."
									AND amount > 0
									AND isrenew = 0
									AND (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178)
									AND subscriptiondetail.errorcode = 1000
							GROUP BY subscriptiondetail.txnid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					}
				}
				elseif($operator=='spain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion+startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion+startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='poland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					//echo $sql;exit;
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
						
						
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				elseif($operator=='vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'activation'
									AND amount > 0
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'activation'
									AND amount > 0
									and advertid=".$advertiserid."
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='hotshots_vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
						
						$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							left join ".$db.".userlog on subscriptiondetail.reqid=userlog.txnid
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 0
									and advertiserid=".$advertiserid."
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
				}
				elseif($operator=='vodacom_bt')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=3 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											and serviceid=3
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=3
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='vodacom_wfh')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=1
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=1
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='vodacom_fg')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=2
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ACT'
											AND amount > 0
											and serviceid=2
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
			}
		}
		
	
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$advname2 = [];
					$arrdt = [];
					$act="";
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
					
					while($row2=mysql_fetch_array($res2))
					{	
						if($prevdate == "")
						 $prevdate = $row2['dt'];
							
						if($prevdate != $row2['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row2['dt'];
						}
						$hour=$row2['hr'];
						if($display=='Count')
							$advname2[$prevdate][$hour]=$row2['act']."";	
						else
							$advname2[$prevdate][$hour]= $row2['amt'];	
					}
					//print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
					
					
					
					
	}
	elseif($type=='Renewal')
	{	
		if($display=='Count' || $display == 'Amount')
		{
			if($product=='gamebar')
			{
				
				if($operator=='Vodafone_Qatar')
				{
					//$db='hotshotsdb1';
					//$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and advname='all' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
						if($advertiserid=='all')
						{
							//$db='hotshotsnewdb_voda_0617';
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
							//$db='hotshotsnewdb_voda_0617';
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
				}
				
				if($operator=='vodafone_egypt')
				{
					//$db='hotshotsdb1';
					//$dblog='hotshotsdblog1';
					$c=1;
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and advname='all' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						//$start_date=date('Y-m-d')." 00:00:00";
						//$end_date=date('Y-m-d')." 23:59:59";
						if($advertiserid=='all')
						{
							//$db='hotshotsnewdb_voda_0617';
							 $sql="							
								SELECT 
									aa.dt dt,
									hr,
									COUNT(reqid) act,
									
									SUM(amount) amt
								FROM
									(SELECT DISTINCT
										subscriptiondetail.reqid,
											
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										".$db.".subscriptiondetail
									
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
							//$db='hotshotsnewdb_voda_0617';
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
				}
				
				
				else if($operator=='ooredoo_oman')
				{
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					$dblog='commondbomooredoo';
					
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_omooredoo.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr; 
						"; 
						$res=mysql_query($sql,$con1);	
					}
					
					else{
						$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT 
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_omooredoo.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'act'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						"; 
						$res=mysql_query($sql,$con1);	
						
					}
					
				}
				
				else if($operator=='indonesia')
				{
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
					
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='REN'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='REN'
											And advid='".$advertiserid."'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; ; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
					}	
				}
				elseif($operator=='spain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='REN'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion+startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion+startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='REN'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				elseif($operator=='finland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_finland.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'ren'
											AND amount > 0
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_finland.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'ren'
											AND amount > 0
											AND advertiserid = '".$advertiserid."'
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				
				
				
				elseif($operator=='uae_etisalat')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from commondbetisalat.advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_etisalat.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'ren'
											AND amount > 0
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				elseif($operator=='vodacom_za')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=3 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											and serviceid=4
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=4
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='buhrain_zain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_bh.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_bh.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				elseif($operator=='pk_telenor')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										and mnc='06'
										AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										and mnc='06'
										AND amount > 0
										and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='pk_zong')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										and mnc='04'
										AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate > '".$start_date."'
										AND subsriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										and mnc='04'
										AND amount > 0
										and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				elseif($operator=='poland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					//echo $sql;exit;
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
						
						
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				elseif($operator=='stc_ksa')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_timwezain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										and operator='stc'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;	
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_timwezain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate < '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										and advertiserid='".$advertiserid."'
										and operator='stc'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				elseif($operator=='kwstc')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwstc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwstc.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwstc.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='kwzain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwzain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwzain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'ren'
										AND amount > 0
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='saudiarabia_zain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksazain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="	
						 SELECT 
							COUNT(msisdn) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT 
							msisdn,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								fashionbardb_timwezain.subscriber
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."'
									AND charging_mode = 'ren'
									AND amount > 0
									and operator='zain'
							GROUP BY dt , msisdn) a
						GROUP BY dt , hr;	
						";
					
					$res=mysql_query($sql,$con1);	
					}
					
			
				}
				
				
				elseif($operator=='a1_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='tmobile_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='hutchison_austria')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT subscriber.txnid) act,
									0 amt
							FROM
								".$db.".subscriber inner join ".$db.".userlog on subscriber.txnid=userlog.txnid 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <=  '".$end_date."'
								AND amount > 0
								AND charging_mode = 'start-subscription'
								AND isrenew = 1
								AND userlog.advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				elseif($operator=='vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'renew'
									AND amount > 0
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'renew'
									AND amount > 0
									and advertid=".$advertiserid."
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='gamezone_vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
						
						$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 1
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							left join ".$db.".userlog on subscriptiondetail.reqid=userlog.txnid
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 1
									and advertiserid=".$advertiserid."
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
				}
			
			
			
			}
			else
			{
				
				if($operator=='airtel_india')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='renew' and operator='".$operator."' and product='".$product."' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
						if($advertiserid=='all')
						{
							//$db='hotshotsnewdb_airtel_0717';
						 	 $sql="SELECT 
								aa.dt dt,
								hr,
								COUNT(txnid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.txnid,
										subscriptiondetail.msisdn,
										advname,
										subscriptiondetail.advertid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								
								left JOIN ".$db.".advertiser ON subscriptiondetail.advertid = advertiser.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND amount > 0
										AND isrenew = 1
										AND (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178)
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
							//$db='hotshotsnewdb_airtel_0717';
							 $sql="SELECT 
								aa.dt dt,
								hr,
								COUNT(txnid) act,
								aa.advname advname,
								SUM(amount) amt
							FROM
								(SELECT DISTINCT
									subscriptiondetail.txnid,
										subscriptiondetail.msisdn,
										advname,
										subscriptiondetail.advertid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									".$db.".subscriptiondetail
								
								left JOIN ".$db.".advertiser ON subscriptiondetail.advertid = advertiser.advertiserid
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND amount > 0
										AND isrenew = 0
										and advertiser.advertiserid=".$advertiserid."
										AND (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178)
										AND subscriptiondetail.errorcode = 1000
								GROUP BY subscriptiondetail.txnid
										) aa
							GROUP BY aa.dt , hr;
								"; 
								$res=mysql_query($sql,$con1);	
						}
					}
				}
				
				elseif($operator=='poland')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					//echo $sql;exit;
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
						
						
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				
				
				elseif($operator=='vodacom_bt')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=3 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											and serviceid=3
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=3
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='vodacom_wfh')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=1
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=1
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='vodacom_fg')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2 ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=2
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode ='ren'
											AND amount > 0
											and serviceid=2
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				
				
				elseif($operator=='myanmar')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <= '".$end_date."'
								AND charging_mode = 'ren'
								GROUP BY dt,hr ;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
								HOUR(subscriptionstartdate) hr,
								DATE(subscriptionstartdate) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$db.".subscriber 
							WHERE
								subscriptionstartdate >= '".$start_date."'
								AND subscriptionstartdate <= '".$end_date."'
								AND charging_mode = 'ren'
								AND advertiserid = ".$advertiserid."
								GROUP BY dt,hr ;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				
				elseif($operator=='spain')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='REN'
											AND amount > 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion+startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion+startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='REN'
											AND amount > 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
				elseif($operator=='vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'renew'
									AND amount > 0
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							COUNT(txnid) act, dt, hr, SUM(amount) amt
						FROM
							(SELECT DISTINCT
								txnid,
									DATE(fromdate) dt,
									HOUR(fromdate) hr,
									amount
							FROM
								".$db.".subscriber
							WHERE
								fromdate >=  '".$start_date."'
									AND fromdate <  '".$end_date."'
									AND action = 'renew'
									AND amount > 0
									and advertid=".$advertiserid."
							GROUP BY dt , txnid) a
						GROUP BY dt , hr
						";
					$res=mysql_query($sql,$con1);	
					}
					
			
			
				}
			
				elseif($operator=='hotshots_vodafone')
				{
					//$db='hotshotsdb_airtel1';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
						
						$c=1;
					if($advertiserid=='all')
					{
						//$db='hotshotsnewdb_airtel_0717';
						
						
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 1
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					
					$res=mysql_query($sql,$con1);	
					}
					else
					{
						//$db='hotshotsnewdb_airtel_0717';
						 $sql="SELECT 
							aa.dt dt,
							hr,
							COUNT(reqid) act,
							
							SUM(amount) amt
						FROM
							(SELECT DISTINCT
								subscriptiondetail.reqid,
									subscriptiondetail.msisdn,
									
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr,
									amount
							FROM
								".$db.".subscriptiondetail
							left join ".$db.".userlog on subscriptiondetail.reqid=userlog.txnid
							
							
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <= '".$end_date."'
									AND amount > 0
									AND isrenew = 1
									and advertiserid=".$advertiserid."
									
							GROUP BY subscriptiondetail.reqid
									) aa
						GROUP BY aa.dt , hr;
						";
					$res=mysql_query($sql,$con1);	
					}
					
				}
				
				
				
				
			}
					//$res=mysql_query($sql);	
					
					$cnt = 0;
					$prevdate = "";
					$advname = [];
					$advname2=[];
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
					while($row2=mysql_fetch_array($res2))
					{	
						if($prevdate == "")
						 $prevdate = $row2['dt'];
							
						if($prevdate != $row2['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row2['dt'];
						}
						$hour=$row2['hr'];
						if($display=='Count')
							$advname2[$prevdate][$hour]=$row2['act']."";	
						else
							$advname2[$prevdate][$hour]= $row2['amt'];	
					}
					//print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
				
			}
		}
	
	elseif($type=='Clicks')
	{
		if($display=='Count')
		{
			if($product=='gamebar')
			{
				if($operator=='Vodafone_Qatar')
				{
				//	$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								  $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and advname='all' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
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
				
				if($operator=='vodafone_egypt')
				{
				//	$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					$c=1;
					$sql_ad="select * from ".$db.".advertiser where operator=1 ";
					$res_ad=mysql_query($sql_ad,$con1);
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								  $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and advname='all' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						//$start_date=date('Y-m-d')." 00:00:00";
						//$end_date=date('Y-m-d')." 23:59:59";
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
				
				else if($operator=='vodacom_za')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=4";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=4  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=4 and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='buhrain_zain')
				{
					
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_bh.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_bh.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='uae_etisalat')
				{
					
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_etisalat.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_etisalat.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				else if($operator=='ooredoo_oman')
				{
					//echo "hi";
					$db='gamesdb_ooredoo_oman';
					$dblog='commondbomooredoo';
					
					
					$sql_ad="select * from ".$dblog.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					if($advertiserid=='all')
					{
						 $sql="SELECT 
							COUNT(userlogid) act,
							DATE(accesstime) dt,
							HOUR(accesstime) hr
						FROM
							fashionbardb_omooredoo.userlog
						WHERE
							accesstime >= '".$start_date."'
								AND accesstime <= '".$end_date."'
						GROUP BY dt , hr"; 
						$res=mysql_query($sql,$con1);	
					}
					else{
						
						$sql="SELECT 
								COUNT(userlogid) act,
								DATE(accesstime) dt,
								HOUR(accesstime) hr
							FROM
								fashionbardb_omooredoo.userlog
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
									AND advertiserid = '".$advertiserid."'
							GROUP BY dt , hr"; 
						$res=mysql_query($sql,$con1);	
						
					}
				}
				else if($operator=='indonesia')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					}
				}
				else if($operator=='spain')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				else if($operator=='finland')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_finland.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <= '".$end_date."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_finland.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <= '".$end_date."'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				
				
				
				
				else if($operator=='pk_telenor')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='pk_zong')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='kwzain')
				{
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_slakwzain.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_slakwzain.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='kwstc')
				{
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_slakwstc.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(accesstime) dt,
									HOUR(accesstime) hr
								FROM
									fashionbardb_slakwstc.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime <=- '".$end_date."'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				
				else if($operator=='saudiarabia_zain')
				{
					$sql_ad="select advertiserid,advertiser_name advname from commondbksazain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_timwezain.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and operator='zain'
								GROUP BY dt , hr;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_timwezain.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and advertiserid=".$advertiserid."
										and operator='zain'
								GROUP BY dt , hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='stc_ksa')
				{
					$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								COUNT(userlogid) act,
								DATE(AccessTime) dt,
								HOUR(AccessTime) hr
							FROM
								fashionbardb_timwezain.userlog
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime < '".$end_date."'
									and operator='stc'
									
							GROUP BY dt , hr;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(userlogid) act,
									DATE(AccessTime) dt,
									HOUR(AccessTime) hr
								FROM
									fashionbardb_timwezain.userlog
								WHERE
									accesstime >= '".$start_date."'
										AND accesstime < '".$end_date."'
										and advertiserid=".$advertiserid."
										and operator='stc'
								GROUP BY dt , hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				
				
				else if($operator=='poland')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$dblog.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							
							//echo $sql;exit;
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$dblog.".userlog  where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='a1_austria')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog  where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='tmobile_austria')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog  where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='hutchison_austria')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT txnid) act,
									0 amt
							FROM
								".$db.".userlog  where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='vodafone')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse   where requesttime >= '".$start_date."'  and requesttime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse   where requesttime >= '".$start_date."'  and requesttime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				if($operator=='gamezone_vodafone')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					$c=1;
						
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
				
				
				
				elseif($operator=='airtel_india')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
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
				}
			}
			else
			{
				
				if($operator=='airtel_india')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								$sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='clicks' and operator='".$operator."' and product='".$product."' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
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
				}
				else if($operator=='spain')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='vodacom_bt')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=3";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=3  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=3 and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='vodacom_wfh')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=1  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=1 and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				else if($operator=='vodacom_fg')
				{
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=2  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(userlogid) act, date(AccessTime) dt, hour(AccessTime) hr from ".$dblog.".userlog   where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and  serviceid=2 and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				else if($operator=='poland')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$dblog.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$dblog.".userlog  where accesstime >= '".$start_date."'  and accesstime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				else if($operator=='myanmar')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$db.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								HOUR(accesstime) hr,
								DATE(accesstime) dt,
								COUNT(DISTINCT clickid) act,
									0 amt
							FROM
								".$db.".userlog 
							WHERE
								accesstime >= '".$start_date."'
									AND accesstime <= '".$end_date."'
									 AND advertiserid = ".$advertiserid."
							GROUP BY dt,hr ;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				
				
				
				else if($operator=='vodafone')
				{
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
						$c=1;
					
						if($advertiserid=='all')
						{
							 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse   where requesttime >= '".$start_date."'  and requesttime < '".$end_date."'  group by dt, hr"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(requestresponseid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".requestresponse   where requesttime >= '".$start_date."'  and requesttime < '".$end_date."' and advertiserid=".$advertiserid." group by dt, hr;"; 
							$res=mysql_query($sql,$con1);	
							
						}
					
				}
				
				if($operator=='hotshots_vodafone')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser  ";
					$res_ad=mysql_query($sql_ad,$con1);
					$c=1;
						
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
					$advname2=[];
					while($row2=mysql_fetch_array($res2))
					{	
						if($prevdate == "")
						 $prevdate = $row2['dt'];
							
						if($prevdate != $row2['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row2['dt'];
						}
						$hour=$row2['hr'];
						if($display=='Count')
							$advname2[$prevdate][$hour]=$row2['act']."";	
						else
							$advname2[$prevdate][$hour]= $row2['amt'];	
					}
					//print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					//print_r($advname);
					//exit;
					
					
					$dt[$prevdate]= $act;
			
		}
	}		
	elseif($type =='Callbacks')
	{
		
			if($product=='gamebar')
			{
				if($operator=='Vodafone_Qatar')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
					
					
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
				if($operator=='vodafone_egypt')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					$c=1;
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						//$start_date=date('Y-m-d')." 00:00:00";
						//$end_date=date('Y-m-d')." 23:59:59";
					
					
						if($advertiserid=='all')
						{
							 $sql="select count(act)act,dt,hr from ( select distinct txnid act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' group by txnid)a   group by  dt, hr
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
				
				else if($operator=='vodacom_za')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=4";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1 and serviceid=4  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=4 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				else if($operator=='buhrain_zain')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
				
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(DISTINCT msisdn) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_bh.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
								GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(DISTINCT msisdn) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_bh.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='uae_etisalat')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
				
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_etisalat.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
								GROUP BY dt , hr
															"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
								COUNT(DISTINCT clickid) act,
								DATE(advertdatetime) dt,
								HOUR(advertdatetime) hr
							FROM
								fashionbardb_etisalat.advertcallback
							WHERE
								advertdatetime >= '".$start_date."'
									AND advertdatetime <= '".$end_date."'
									AND advertresponse != 'stop'
									AND advertiserid = '".$advertiserid."'
							GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				
				
				else if($operator=='ooredoo')
				{
					$db='gamesdb_ooredoo_oman';
					$dblog='gamesdblog_ooredoo_oman';
					
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
				else if($operator=='indonesia')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."'and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
					
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					}
				}
				else if($operator=='spain')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				else if($operator=='finland')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_finland.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
								GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_finland.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				
				
				
				else if($operator=='poland')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				else if($operator=='pk_telenor')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1 and serviceid=6 group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=6 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='pk_zong')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  and serviceid=4 group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=4 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				else if($operator=='kwzain')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_slakwzain.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
								GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_slakwzain.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='kwstc')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbslakwzain.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								COUNT(DISTINCT clickid) act,
								DATE(advertdatetime) dt,
								HOUR(advertdatetime) hr
							FROM
								fashionbardb_slakwstc.advertcallback
							WHERE
								advertdatetime >= '".$start_date."'
									AND advertdatetime <= '".$end_date."'
									AND advertresponse != 'stop'
							GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
								 $sql="SELECT 
										COUNT(DISTINCT clickid) act,
										DATE(advertdatetime) dt,
										HOUR(advertdatetime) hr
									FROM
										fashionbardb_slakwstc.advertcallback
									WHERE
										advertdatetime >= '".$start_date."'
											AND advertdatetime <= '".$end_date."'
											AND advertresponse != 'stop'
											AND advertiserid = '".$advertiserid."'
									GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				else if($operator=='stc_ksa')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								COUNT(DISTINCT clickid) act,
								DATE(advertdatetime) dt,
								HOUR(advertdatetime) hr
							FROM
								fashionbardb_timwezain.advertcallback
							WHERE
								advertdatetime >= '".$start_date."'
									AND advertdatetime <= '".$end_date."'
									AND advertresponse != 'stop'
									AND operator = 'stc'
							GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_timwezain.advertcallback
								WHERE
									advertdatetime > '".$start_date."'
										AND advertdatetime < '".$end_date."'
										AND advertresponse != 'stop'
										AND advertiserid= ".$advertiserid."
										and operator='stc'
								GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				else if($operator=='saudiarabia_zain')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbksastc.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
								COUNT(DISTINCT clickid) act,
								DATE(advertdatetime) dt,
								HOUR(advertdatetime) hr
							FROM
								fashionbardb_timwezain.advertcallback
							WHERE
								advertdatetime >= '".$start_date."'
									AND advertdatetime <= '".$end_date."'
									AND advertresponse != 'stop'
									AND operator = 'zain'
							GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_timwezain.advertcallback
								WHERE
									advertdatetime > '".$start_date."'
										AND advertdatetime < '".$end_date."'
										AND advertresponse != 'stop'
										AND advertiserid= ".$advertiserid."
										and operator='zain'
								GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='ooredoo_oman')
				{
					
					$sql_ad="select advertiserid,advertiser_name advname from commondbomooredoo.advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(DISTINCT clickid) act,
									DATE(advertdatetime) dt,
									HOUR(advertdatetime) hr
								FROM
									fashionbardb_omooredoo.advertcallback
								WHERE
									advertdatetime >= '".$start_date."'
										AND advertdatetime <= '".$end_date."'
										AND advertresponse != 'stop'
								GROUP BY dt , hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="SELECT 
										COUNT(DISTINCT clickid) act,
										DATE(advertdatetime) dt,
										HOUR(advertdatetime) hr
									FROM
										fashionbardb_omooredoo.advertcallback
									WHERE
										advertdatetime >= '".$start_date."'
											AND advertdatetime <= '".$end_date."'
											AND advertresponse != 'stop'
											AND advertiserid = '".$advertiserid."'
									GROUP BY dt , hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				
				
				
			}
			else
			{
				
				if($operator=='airtel_india')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='callback' and operator='".$operator."' and product='".$product."' and advertiserid = ".$advertiserid." group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
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
				else if($operator=='spain')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='vodafone')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							  $sql="select count(distinct msisdn) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' and action='act'  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct msisdn) act, date(senttime) dt, hour(senttime) hr from ".$db.".advertcallback  where senttime > '".$start_date."' and senttime < '".$end_date."' and advertiserid=".$advertiserid." and action='act' group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='vodacom_bt')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=3";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1 and serviceid=3  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=3 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				else if($operator=='vodacom_wfh')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1 and serviceid=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				else if($operator=='vodacom_fg')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1 and serviceid=2  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 and serviceid=2 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				else if($operator=='poland')
				{
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					
					$c=1;
						if($advertiserid=='all')
						{
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and issent=1  group by dt, hr
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							
							 $sql="select count(distinct clickid) act, date(requesttime) dt, hour(requesttime) hr from ".$db.".callbackresponse  where requesttime > '".$start_date."' and requesttime < '".$end_date."' and advertiserid=".$advertiserid." and issent=1 group by dt, hr
								"; 
							$res=mysql_query($sql,$con);	
							
						}
					
				}
				
				
				elseif($operator=='hotshots_vodafone')
				{
					//$db='hotshotsnewdb_airtel_0717';
					//$dblog='hotshotsdblog_airtel1';
					
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
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
					
					$advname2=[];
					while($row2=mysql_fetch_array($res2))
					{	
						if($prevdate == "")
						 $prevdate = $row2['dt'];
							
						if($prevdate != $row2['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row2['dt'];
						}
						$hour=$row2['hr'];
						if($display=='Count')
							$advname2[$prevdate][$hour]=$row2['act']."";	
						else
							$advname2[$prevdate][$hour]= $row2['amt'];	
					}
					//print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
			
		
	}
	elseif($type=='Parking')
	{
		
			if($product=='gamebar')
			{
				if($b==1)//code of previous data
					{
						
							
							if($advertiserid=='all')
							{
								 $sql="SELECT date dt,sum(act)act,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='parking' and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);
								
							}
							else{
								$sql="SELECT date dt,sum(act)act ,sum(amt)amt,hr,type FROM ".$report.".`trend_report` WHERE date >='".$start_date1."' and date <='".$end_date1."' and type='parking' and advertiserid = ".$advertiserid." and operator='".$operator."' and product='".$product."' group by hr,dt  order by dt asc,hr asc ";
								//echo $sql;exit;
								$res2=mysql_query($sql,$con1);	
								
							}
						
					}
				
				
				if($operator=='Vodafone_Qatar')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					
					if($c==1)
					{
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
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
				}
				
				else if($operator=='vodafone_egypt')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					$c=1;
					$sql_ad="select * from ".$db.".advertiser where operator=1";
					$res_ad=mysql_query($sql_ad);
					
					
					if($c==1)
					{
						//$start_date=date('Y-m-d')." 00:00:00";
						//$end_date=date('Y-m-d')." 23:59:59";
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
											AND isrenew = 0
											and amount=0
										   
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
											AND isrenew=0
											and amount=0
										   
									) b
								GROUP BY dt , hr;
								"; 
								$res=mysql_query($sql);	
						}
					}
				}
				
				
				else if($operator=='ooredoo_oman')
				{
					$db='gamesdb_ooredoo_oman';
					$dblog='gamesdblog_ooredoo_oman';
					
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
				else if ($operator=='indonesia')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					if($c==1)
					{
						//echo "hi";
						$start_date=date('Y-m-d')." 00:00:00";
						$end_date=date('Y-m-d')." 23:59:59";
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='act'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".mo
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='act'
											And advid='".$advertiserid."'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; ; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
					}	
				}
				
				else if ($operator=='spain')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
				else if ($operator=='poland')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
				
				else if ($operator=='pk_telenor')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate >= '".$start_date."'
											AND subsriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and mnc='06'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate >= '".$start_date."'
											AND subsriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and mnc='06'
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
				else if ($operator=='pk_zong')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate >= '".$start_date."'
											AND subsriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and mnc='04'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subsriptionstartdate) dt,
											HOUR(subsriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subsriptionstartdate >= '".$start_date."'
											AND subsriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and mnc='04'
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				else if ($operator=='vodacom_za')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=4";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and serviceid=4
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
											and serviceid=4
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
			}
			else
			{
				
				if ($operator=='spain')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriprion_startdate) dt,
											HOUR(subscriprion_startdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriprion_startdate >= '".$start_date."'
											AND subscriprion_startdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				//$res=mysql_query($sql);	
					
				 if ($operator=='vodacom_bt')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=3";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and serviceid=3
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
											and serviceid=3
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				else if ($operator=='vodacom_wfh')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and serviceid=1
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
											and serviceid=1
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
				else if ($operator=='poland')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							 $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
						}
						
				}
				
				
				
				
				
				else if ($operator=='vodacom_fg')
				{
					
					//echo "hi";
					//$db='gamesdb_ooredoo_oman';
					//$dblog='gamesdblog_ooredoo_oman';
					
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
					$c=1;
						//echo "hi";
						
						if($advertiserid=='all')
						{
							  $sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and serviceid=2
									GROUP BY dt,clickid) a
								GROUP BY dt , hr;
							"; 
							$res=mysql_query($sql,$con1);	
						}
						else{
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid, DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr, amount
									FROM
										".$db.".subscriber
								
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate < '".$end_date."'
											AND charging_mode ='low'
											AND amount = 0
											and advid='".$advertiserid."'
											and serviceid=2
									GROUP BY dt,clickid) a
								GROUP BY dt , hr; 
							"; 
							$res=mysql_query($sql,$con1);	
							
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
					
					
					$advname2=[];
					while($row2=mysql_fetch_array($res2))
					{	
						if($prevdate == "")
						 $prevdate = $row2['dt'];
							
						if($prevdate != $row2['dt'])
						{
							$dt[$prevdate]= $act;		
							$act[] = [];
							$prevdate = $row2['dt'];
						}
						$hour=$row2['hr'];
						if($display=='Count')
							$advname2[$prevdate][$hour]=$row2['act']."";	
						else
							$advname2[$prevdate][$hour]= $row2['amt'];	
					}
					//print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
			
		
	}
	
	elseif($type=='Pin confirmed')
	{
		
			if($product=='gamebar')
			{
				
				if($operator=='saudiarabia_zain')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					
					
						
						if($advertiserid=='all')
						{

						 $sql="SELECT count(distinct clickid ) act,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr
							FROM
								fashionbardb_timwezain.subscriber
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <='".$end_date."'
									AND charging_mode = 'cg'
									AND operator='zain'
							GROUP BY dt,hr 
								"; 
								
									
						
						}
						else
						{
							
						}
				}
				
				
				else if($operator=='saudiarabia_zain')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
					
					
						
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_finland.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
								
									
						
						}
						else
						{
							
							$sql="SELECT 
									COUNT(clickid) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										clickid,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_finland.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'cg'
											AND advertiserid = '".$advertiserid."'
									GROUP BY dt , clickid) a
								GROUP BY dt , hr;
								"; 
								
							
							
						}
				}
				
				
				else if($operator=='stc_ksa')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="SELECT count(distinct clickid ) act,
									DATE(subscriptionstartdate) dt,
									HOUR(subscriptionstartdate) hr
							FROM
								fashionbardb_timwezain.subscriber
							WHERE
								subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate <='".$end_date."'
									AND charging_mode = 'cg'
									AND operator='stc'
							GROUP BY dt,hr 
								"; 
								
						//		
						
						}
						else
						{
							$sql="
								"; 
								
						}
					}
	
				else if($operator=='kwzain')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="
								SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwzain.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'freetrial'
										
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
										COUNT(clickid) act, dt, hr, SUM(amount) amt
									FROM
										(SELECT DISTINCT
											clickid,
												DATE(subscriptionstartdate) dt,
												HOUR(subscriptionstartdate) hr,
												amount
										FROM
											fashionbardb_slakwzain.subscriber
										WHERE
											subscriptionstartdate >= '".$start_date."'
												AND subscriptionstartdate <= '".$end_date."'
												AND charging_mode = 'freetrial'
											   
												AND advertiserid = '".$advertiserid."'
										GROUP BY dt , clickid) a
									GROUP BY dt , hr;
								"; 
								
						}
				}
	
				else if($operator=='kwstc')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="
								SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_slakwstc.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'freetrial'
										
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
											COUNT(clickid) act, dt, hr, SUM(amount) amt
										FROM
											(SELECT DISTINCT
												clickid,
													DATE(subscriptionstartdate) dt,
													HOUR(subscriptionstartdate) hr,
													amount
											FROM
												fashionbardb_slakwstc.subscriber
											WHERE
												subscriptionstartdate >= '".$start_date."'
													AND subscriptionstartdate <= '".$end_date."'
													AND charging_mode = 'freetrial'
												   
													AND advertiserid = '".$advertiserid."'
											GROUP BY dt , clickid) a
										GROUP BY dt , hr;
								"; 
								
						}
				}
	
	
				
				
	
				else if($operator=='buhrain_zain')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="SELECT 
										COUNT(clickid) act, dt, hr, SUM(amount) amt
									FROM
										(SELECT DISTINCT
											clickid,
												DATE(subscriptionstartdate) dt,
												HOUR(subscriptionstartdate) hr,
												amount
										FROM
											fashionbardb_bh.subscriber
										WHERE
											subscriptionstartdate >= '".$start_date."'
												AND subscriptionstartdate <= '".$end_date."'
												AND charging_mode = 'freetrial'
										GROUP BY dt , clickid) a
									GROUP BY dt , hr;
								"; 
								
						//		
						
						}
						else
						{
							$sql="
								"; 
								
						}
				}
	
				else if($operator=='uae_etisalat')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
														SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
								
						}
				}
				
				else if($operator=='ooredoo_oman')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="SELECT 
									COUNT(msisdn) act, dt, hr, SUM(amount) amt
								FROM
									(SELECT DISTINCT
										msisdn,
											DATE(subscriptionstartdate) dt,
											HOUR(subscriptionstartdate) hr,
											amount
									FROM
										fashionbardb_omooredoo.subscriber
									WHERE
										subscriptionstartdate >= '".$start_date."'
											AND subscriptionstartdate <= '".$end_date."'
											AND charging_mode = 'cg'
								 
									GROUP BY dt , msisdn) a
								GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="SELECT 
								COUNT(msisdn) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT  DISTINCT
									msisdn,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_omooredoo.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , msisdn) a
							GROUP BY dt , hr;
								"; 
								
						}
				}
	
				
				
				//echo $sql;exit;
				$res=mysql_query($sql,$con1);	
			
			}
							$cnt = 0;
					$prevdate = "";
					$advname = [];
					$advname2 = [];
					$arrdt = [];
					$act="";
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
					
					
				//	print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					
					//print_r($advname);
					//exit;
					$dt[$prevdate]= $act;
					
					
					//print_r($dt);exit;
	}
				
	elseif($type=='trial')
	{
		
		if($product=='gamebar')
			{
				
				if($operator=='uae_etisalat')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
														SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									fashionbardb_etisalat.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'cg'
										AND advertiserid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
								
						}
				}
	
				else if($operator=='vodacom_za')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					//echo $hi;exit;
					$sql_ad="select * from ".$db.".advertiser where serviceid=4";
					$res_ad=mysql_query($sql_ad,$con1);
					
				//	echo hi;exit;
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=4
										and amount=0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=4
										and amount=0
										AND advid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
							//echo $sql;exit;	
						}
				}
	
				else if($operator=='pk_telenor')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					//echo $hi;exit;
					$sql_ad="select * from ".$db.".advertiser ";
					$res_ad=mysql_query($sql_ad,$con1);
					
				//	echo hi;exit;
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										
										and amount=0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and amount=0
										AND advid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
							//echo $sql;exit;	
						}
				}
	
	
				//echo $sql;exit;
				$res=mysql_query($sql,$con1);	
			
			}
			else
			{
				
				if($operator=='vodacom_wfh')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					//echo $hi;exit;
					$sql_ad="select * from ".$db.".advertiser where serviceid=1";
					$res_ad=mysql_query($sql_ad,$con1);
					
				//	echo hi;exit;
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=1
										and amount=0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=1
										and amount=0
										AND advid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
							//echo $sql;exit;	
						}
				}
				
				else if($operator=='vodacom_fg')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					//echo $hi;exit;
					$sql_ad="select * from ".$db.".advertiser where serviceid=2";
					$res_ad=mysql_query($sql_ad,$con1);
					
				//	echo hi;exit;
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=2
										and amount=0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=2
										and amount=0
										AND advid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
							//echo $sql;exit;	
						}
				}
				else if($operator=='vodacom_bt')
				{
					//$db='hotshotsnewdb_voda_0617';
					//$dblog='hotshotsdblog1';
					//echo $hi;exit;
					$sql_ad="select * from ".$db.".advertiser where serviceid=3";
					$res_ad=mysql_query($sql_ad,$con1);
					
				//	echo hi;exit;
						if($advertiserid=='all')
						{

						 $sql="SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=3
										and amount=0
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;"; 
								
						//		
						
						}
						else
						{
							$sql="
									SELECT 
								COUNT(clickid) act, dt, hr, SUM(amount) amt
							FROM
								(SELECT DISTINCT
									clickid,
										DATE(subscriptionstartdate) dt,
										HOUR(subscriptionstartdate) hr,
										amount
								FROM
									vodacom_za.subscriber
								WHERE
									subscriptionstartdate >= '".$start_date."'
										AND subscriptionstartdate <= '".$end_date."'
										AND charging_mode = 'trial'
										and serviceid=3
										and amount=0
										AND advid = '".$advertiserid."'
								GROUP BY dt , clickid) a
							GROUP BY dt , hr;
								"; 
							//echo $sql;exit;	
						}
				}
	
	
				//echo $sql;exit;
				$res=mysql_query($sql,$con1);	
			
			}
			
							$cnt = 0;
					$prevdate = "";
					$advname = [];
					$advname2 = [];
					$arrdt = [];
					$act="";
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
					
					
				//	print_r($advname);
					//echo "<br><br><br>";
					//print_r($advname2);
					//echo "<br><br><br>";
					$advname=array_merge($advname,$advname2);
					
					//print_r($advname);
					//exit;
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
							<option value="gamebar" <?php if($product=='gamebar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Gamebar</option>
							<option value="Glambar" <?php if($product=='Glambar'){$selected='selected';}else{$selected='';} echo $selected; ?>>Glambar</option>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control" id="operator">
						<?php
						if($product == 'gamebar')
						{ ?>
							<option>Operator</option>
							<option value="a1_austria" <?php if($operator=='a1_austria'){$selected='selected';}else{$selected='';} echo $selected; ?> >A1_Austria</option>
							<option value="buhrain_zain" <?php if($operator=='buhrain_zain'){$selected='selected';}else{$selected='';} echo $selected; ?> >Bahrain_Zain</option>
							<option value="finland" <?php if($operator=='finland'){$selected='selected';}else{$selected='';} echo $selected; ?> >Finland</option>
							
							<option  id="indonesia" name="indonesia" value="indonesia" <?php if($operator=='indonesia'){$selected='selected';}else{$selected='';} echo $selected; ?>>Indonesia</option>
							<option value="stc_ksa" <?php if($operator=='stc_ksa'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_STC</option>
							<option value="saudiarabia_zain" <?php if($operator=='saudiarabia_zain'){$selected='selected';}else{$selected='';} echo $selected; ?> >KSA_Zain</option>
							<option value="kwstc" <?php if($operator=='kwstc'){$selected='selected';}else{$selected='';} echo $selected; ?> >KW_STC</option>
							<option value="kwzain" <?php if($operator=='kwzain'){$selected='selected';}else{$selected='';} echo $selected; ?> >KW_Zain</option>
							
							
							
							<option value="myanmar" <?php if($operator=='myanmar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Myanmar</option>
							<option  id="ooredoo_oman" name="ooredoo_oman" value="ooredoo_oman" <?php if($operator=='ooredoo_oman'){$selected='selected';}else{$selected='';} echo $selected; ?>>Ooredoo-Oman</option>
							<option value="pk_telenor" <?php if($operator=='pk_telenor'){$selected='selected';}else{$selected='';} echo $selected; ?> >Pakistan_Telenor</option>
							<option value="pk_zong" <?php if($operator=='pk_zong'){$selected='selected';}else{$selected='';} echo $selected; ?> >Pakistan_Zong</option>
							<option value="poland" <?php if($operator=='poland'){$selected='selected';}else{$selected='';} echo $selected; ?> >Poland</option>
							<option  id="qatar_ooredoo" name="qatar_ooredoo" value="ooredoo_oman" <?php if($operator=='qatar_ooredoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>Qatar_Ooredoo</option>
							<option value="vodacom_za" <?php if($operator=='vodacom_za'){$selected='selected';}else{$selected='';} echo $selected; ?> >SouthAfrica_Vodacom</option>
							<option  id="spain" name="spain" value="spain" <?php if($operator=='spain'){$selected='selected';}else{$selected='';} echo $selected; ?>>Spain</option>
							<option value="vodafone_egypt" <?php if($operator=='vodafone_egypt'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone_Egypt</option>
							<option value="Vodafone_Qatar" <?php if($operator=='Vodafone_Qatar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone_Qatar</option>
							<option value="uae_etisalat" <?php if($operator=='uae_etisalat'){$selected='selected';}else{$selected='';} echo $selected; ?> >UAE_Etisalat</option>

							
						<?php
						}
						else if($product == 'Glambar'){
						?>
							<option value="poland" <?php if($operator=='poland'){$selected='selected';}else{$selected='';} echo $selected; ?> >Poland</option>
							<option  id="spain" name="spain" value="spain" <?php if($operator=='spain'){$selected='selected';}else{$selected='';} echo $selected; ?>>Spain</option>
							<option value="vodacom_bt" <?php if($operator=='vodacom_bt'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodacom_Bt</option>
							<option value="vodacom_fg" <?php if($operator=='vodacom_fg'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodacom_Fg</option>
							<option value="vodacom_wfh" <?php if($operator=='vodacom_wfh'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodacom_Wfh</option>

							<!--<option value="Vodafone_Qatar" <?php //if($operator=='Vodafone_Qatar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone_Qatar</option>
							<option value="Idea" <?php //if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
							<option  id="azharbeizan" name="azharbeizan" value="Azharbeizan" <?php //if($operator=='Azharbeizan'){$selected='selected';}else{$selected='';} echo $selected; ?>>Azharbeizan</option>
							<option  id="ooredoo" name="ooredoo" value="ooredoo" <?php //if($operator=='ooredoo'){$selected='selected';}else{$selected='';} echo $selected; ?>>Ooredoo-Qatar</option>
							<option  id="etisalat" name="etisalat" value="etisalat" <?php //if($operator=='etisalat'){$selected='selected';}else{$selected='';} echo $selected; ?>>etisalat</option>
							<option  id="srilanka" name="srilanka" value="srilanka" <?php //if($operator=='srilanka'){$selected='selected';}else{$selected='';} echo $selected; ?>>srilanka</option>-->
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
								
									<option value="Clicks" <?php  $selected=''; if($type=='Clicks') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Clicks</option>
								
									<option value="lowbalance" <?php  $selected=''; if($type=='lowbalance') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Lowbalance</option>
								
									<option value="callback" <?php  $selected=''; if($type=='callback') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Callback-Sent</option>
									<option value="Pin confirmed" <?php  $selected=''; if($type=='Pin confirmed') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Pin confirmed</option>
									<option value="trial" <?php  $selected=''; if($type=='trial') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Trial</option>
									<option value="centtocg" <?php  $selected=''; if($type=='centtocg') {$selected='selected';} else{ $selcted='';}  echo $selected;  ?>>Cent To CG</option>
								
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
	if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('A1_Austria', 'a1_austria');
		select.options[select.options.length] = new Option('Bahrain_zain', 'buhrain_zain');
		select.options[select.options.length] = new Option('Finland', 'finland');
		
		select.options[select.options.length] = new Option('Gamezone_Vodafone', 'gamezone_vodafone');
		select.options[select.options.length] = new Option('Hutchison_Austria', 'hutchison_austria');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('KSA_STC', 'stc_ksa');
		select.options[select.options.length] = new Option('KSA_Zain', 'saudiarabia_zain');
		select.options[select.options.length] = new Option('KW_STC', 'kwstc');
		select.options[select.options.length] = new Option('KW_Zain', 'kwzain');
		
		select.options[select.options.length] = new Option('Myanmar', 'myanmar');
		select.options[select.options.length] = new Option('Ooredoo_Oman', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Qatar_Ooredoo', 'qatar_ooredoo');
		select.options[select.options.length] = new Option('Pakistan_Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('Pakistan_Zong', 'pk_zong');
		select.options[select.options.length] = new Option('Poland', 'poland');
		//select.options[select.options.length] = new Option('SaudiArabia_Zain', 'saudiarabia_zain');
		select.options[select.options.length] = new Option('SouthAfrica_Vodacom', 'vodacom_za');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Tmobile_Austria', 'tmobile_austria');
		select.options[select.options.length] = new Option('Vodafone', 'vodafone');
		select.options[select.options.length] = new Option('Vodafone_Egypt', 'vodafone_egypt');
		select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('UAE_Etisalat', 'uae_etisalat');

		
	}
	else if(x =='Glambar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Poland', 'poland');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Vodacom_Bt', 'vodacom_bt');
		select.options[select.options.length] = new Option('Vodacom_Fg', 'vodacom_fg');
		select.options[select.options.length] = new Option('Vodacom_Wfh', 'vodacom_wfh');

		//select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		//select.options[select.options.length] = new Option('Idea', 'Idea');
		//select.options[select.options.length] = new Option('Airtel', 'Airtel');
		//select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		//select.options[select.options.length] = new Option('etisalat', 'etisalat');
		//select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo');
		//select.options[select.options.length] = new Option('srilanka', 'srilanka');
	}
	
	/*if(x=="gamebar")
	{
		 //alert("hi");
	document.getElementById('azharbeizan').style.visibility = 'hidden';
	}else
	{
		document.getElementById('azharbeizan').style.visibility = 'visible';
	}*/
}
</script>		
