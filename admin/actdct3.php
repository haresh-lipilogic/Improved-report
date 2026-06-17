<?php
include("includes/check_session.php");
include("includes/connection.php");

//$con1=mysql_connect("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysql_error()); //cluster 1

$con1=$con;
error_reporting(0);
$sum=0;
$start_date='';
$end_date='';
$operator='';
$product='';
$count=0;


if(isset($_POST['submit']))
{
	
	
	$count=1;
		$operator=$_POST['operator'];
		$product=$_POST['product'];
		$date1=date('Y-m-d');
		//$type=$_POST['type'];
		//$display=$_POST['display']; 
		//$advertiserid=$_POST['advertiserid'];
		$b=$c=0;
		if($start_date == $end_date)
		{
			$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
			$end_date=date('Y-m-d 23:59:59',strtotime($_POST['end_date']));
			$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
			$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
			//$hours=$_POST['hours'];
		}	
		else
		{
			$start_date=date('Y-m-d 00:00:00',strtotime($_POST['start_date']));
			$end_date=date('Y-m-d 00:00:00',strtotime($_POST['end_date']));
			$start_date1=date('Y-m-d',strtotime($_POST['start_date']));
			$end_date1=date('Y-m-d',strtotime($_POST['end_date']));
			//$hours=$_POST['hours'];
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
		
		
	if($product== 'Hotshots')
	{
		if($operator=='Vodafone')
		{
			$db='hotshotsnewdb_voda_0617';
			$dblog='hotshotsdblog1';
			
			if($b==1)
			{
				$sql2="select * from ".$db.".actdct_report where date >= '".$start_date1."' and date <= '".$end_date1."'"; 
				//echo $sql2;
				//exit;		
			$res2=mysql_query($sql2,$con1);
			
				
			}
			if($c==1)
			{
				
				$start_date=$date1." 00:00:00";
				$end_date=$date1." 23:59:59";
				 $sql="
				SELECT 
					aa.dt dt1,
					COUNT(aa.reqid) act,
					COUNT(bb.reqid) dct,
					((COUNT(bb.reqid) / COUNT(aa.reqid)) * 100) perc,
					CASE
						WHEN aa.advertiserid IS NULL THEN - 1
						ELSE aa.advertiserid
					END advertiser,
					CASE
						WHEN
							aa.advertiserid = - 1
								OR aa.advertiserid IS NULL
						THEN
							'other'
						ELSE aa.advname
					END ad1
				FROM
					(SELECT DISTINCT
						subscriptiondetail.reqid,
							subscriptiondetail.msisdn,
							advname,
							MAX(userlogid),
							userlog.advertiserid,
							DATE(subscriptionstartdate) dt
					FROM
						".$db.".subscriptiondetail
					LEFT JOIN ".$db.".userlog ON subscriptiondetail.reqid = userlog.txnid
					LEFT JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND amount > 0
							AND isrenew = 0 group by subscriptiondetail.txnid) aa
						LEFT JOIN
					(SELECT DISTINCT
						subscriptiondetail.reqid,
							subscriptiondetail.msisdn,
							DATE(subscriptionstartdate) dt
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND amount = 0
							AND charging_mode = 'null') bb ON aa.dt = bb.dt AND aa.msisdn = bb.msisdn
				GROUP BY aa.dt , advertiser;"; 
				//echo $sql;
						
			$res=mysql_query($sql,$con1);
		}
		}
		elseif($operator=='Airtel')
		{
			$db='hotshotsnewdb_airtel_0617';
			$dblog='hotshotsdblog_airtel1';
			
			if($b==1)
			{
				$sql2="select * from ".$db.".actdct_report where date >= '".$start_date1."' and date <= '".$end_date1."'"; 
				//echo $sql2;
				//exit;		
			$res2=mysql_query($sql2,$con1);
			
				
			}
			if($c==1)
			{
				
				$start_date=$date1." 00:00:00";
				$end_date=$date1." 23:59:59";
				
				
					/*$sql="SELECT 
						aa.dt dt1,
						COUNT(DISTINCT aa.txnid) act,
						COUNT(bb.msisdn) dct,
						((COUNT(bb.msisdn) / COUNT(aa.txnid)) * 100) perc,
						CASE
							WHEN aa.advertiserid IS NULL THEN - 1
							ELSE aa.advertiserid
						END advertiser,
						CASE
							WHEN
								aa.advertiserid = - 1
									OR aa.advertiserid IS NULL
							THEN
								'other'
							ELSE aa.advname
						END ad1
					FROM
						(SELECT DISTINCT
							subscriptiondetail.txnid,
								userlog.msisdn,
								advname,
								advertcallback.advertiserid,
								DATE(subscriptionstartdate) dt,
								max(userlogid)
						FROM
							".$db.".subscriptiondetail
						LEFT JOIN ".$db.".userlog ON subscriptiondetail.txnid = userlog.txnid
						INNER join ".$db.".advertcallback on subscriptiondetail.txnid = advertcallback.txnid 
						INNER JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
						WHERE
							subscriptionstartdate >='".$start_date."'
								AND subscriptionstartdate <= '".$end_date."'
								AND amount > 0
								AND isrenew = 0
								AND subscriptiondetail.charging_mode != 541729
								AND subscriptiondetail.errorcode = 1000
						GROUP BY subscriptiondetail.txnid) aa
							LEFT JOIN
						(SELECT DISTINCT
							subscriptiondetail.txnid,
								subscriptiondetail.msisdn,
								DATE(subscriptionstartdate) dt
						FROM
							".$db.".subscriptiondetail
						WHERE
							subscriptionstartdate >='".$start_date."'
								AND subscriptionstartdate <= '".$end_date."'
								AND amount = 0
								AND subscriptiondetail.charging_mode != 541729
								AND subscriptiondetail.errorcode = 1001
								AND subscriptiondetail.subscriptionstartdate = subscriptiondetail.subscriptionenddate) bb ON aa.msisdn = bb.msisdn
					GROUP BY aa.dt , advertiser";*/
					
					$sql="select 
						case when act is null then 0
						else act
						end act,
						dt1,
						case when dct is null then 0
						else dct
						end dct,
						dt2,
						case when x.advertiserid is null then '-1'
						else x.advertiserid
						end advertiser,
						case when x.advname is null then 'other'
						else x.advname
						end ad1,
						(dct / act) * 100 perc from
						(select count(txnid) act,dt1,advertiserid,advname from
							(SELECT DISTINCT subscriptiondetail.txnid,subscriptiondetail.msisdn,userlog.advertiserid,advname,date(subscriptionstartdate)dt1
							FROM
								".$db.".subscriptiondetail
								left join ".$db.".userlog on subscriptiondetail.msisdn=userlog.msisdn
								left join ".$db.".advertiser on userlog.advertiserid=advertiser.advertiserid 		
							WHERE
								isrenew = 0 AND amount > 0 and (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178) and errorcode = 1000
									AND subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."')y group by advertiserid
						)x
						left join
						(select date(dctdt) dt2,count(dtxnid)dct,advertiserid,advname from(
						select b.txnid dtxnid,b.msisdn dmsisdn,b.dctdt,sb actdt,advertiserid,advname from(SELECT DISTINCT subscriptiondetail.txnid,subscriptiondetail.msisdn,subscriptionstartdate dctdt,subdate(subscriptionstartdate, 1) bkdate,isrenew,amount,userlog.advertiserid,advertiser.advname
							FROM
								".$db.".subscriptiondetail
								left join ".$db.".userlog on subscriptiondetail.msisdn=userlog.msisdn
								left join ".$db.".advertiser on userlog.advertiserid=advertiser.advertiserid 		
							WHERE
								 (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178) and errorcode = 1001
									AND subscriptionstartdate >= '".$start_date."'
									AND subscriptionstartdate < '".$end_date."')b	

						inner join (SELECT DISTINCT txnid,msisdn,subscriptionstartdate actdt,isrenew,amount,max(subscriptionstartdate) sb
							FROM
								".$db.".subscriptiondetail
							WHERE
								isrenew = 0 AND amount > 0 and (charging_mode != 541729  and charging_mode != 548184 and charging_mode != 548185 and charging_mode != 548186 and charging_mode != 548178) and errorcode = 1000
									group by txnid)a on a.msisdn=b.msisdn and bkdate < a.actdt)c group by advertiserid)aa on aa.dt2=x.dt1 and x.advertiserid=aa.advertiserid group by ad1;";
				//echo $sql;
			
			$res=mysql_query($sql,$con1);
			}
		}
		else
		{	
			
			$db='hotshotsnewdb_idea_0617';
			$dblog='hotshotsdblog_idea';
		 	
			if($b==1)
			{
				$sql2="select * from ".$db.".actdct_report where date >= '".$start_date1."' and date <= '".$end_date1."'"; 
				//echo $sql2;
				//exit;		
			$res2=mysql_query($sql2,$con1);
			
				
			}
			if($c==1)
			{
				
				$start_date=$date1." 00:00:00";
				$end_date=$date1." 23:59:59";

				$sql="
				SELECT 
					aa.dt dt1,
					COUNT(aa.txnid) act,
					COUNT(bb.msisdn) dct,
					((COUNT(bb.msisdn) / COUNT(aa.txnid)) * 100) perc,
					CASE
						WHEN aa.advertiserid IS NULL THEN - 1
						ELSE aa.advertiserid
					END advertiser,
					CASE
						WHEN
							aa.advertiserid = - 1
								OR aa.advertiserid IS NULL
						THEN
							'other'
						ELSE aa.advname
					END ad1
				FROM
					(SELECT DISTINCT
						subscriptiondetail.txnid,
							subscriptiondetail.msisdn,
							advname,
							max(userlogid),
						  
							userlog.advertiserid,
							DATE(subscriptionstartdate) dt
					FROM
						".$db.".subscriptiondetail
					inner JOIN ".$db.".userlog ON subscriptiondetail.msisdn=userlog.msisdn
					left JOIN ".$db.".advertiser ON userlog.advertiserid = advertiser.advertiserid
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND amount > 0
							AND (charging_mode LIKE '%ACT%'
							OR charging_mode LIKE '%UPGRD%')
							group by msisdn
					) aa
						LEFT JOIN
					(SELECT DISTINCT
						subscriptiondetail.txnid,
							subscriptiondetail.msisdn,
							DATE(subscriptionstartdate) dt
					FROM
						".$db.".subscriptiondetail
					WHERE
						subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate <= '".$end_date."'
							AND amount = 0
							AND charging_mode LIKE '%DCT%') bb ON aa.dt = bb.dt AND aa.msisdn = bb.msisdn
				GROUP BY aa.dt , advertiser;"; 
					//echo $sql;
				
			$res=mysql_query($sql,$con1);
			}
		}
	}
	else
	{
		$c=1;
		if($operator=='Vodafone')
		{
			$c=1;
			//echo "hi";exit;
			$db='gamesdb_voda';
			$dblog='gamesdblog_voda';
		
		 $sql="
				SELECT 
					a.*, b.*, (b.dct / a.act) * 100 perc
				FROM
					(SELECT 
						COUNT(mobilenumber) act, DATE(a.actdt) dt1, ad1
					FROM
						(SELECT DISTINCT
						subscriptiondetail.subscriberid,
							mobilenumber,
							DATE(subscriptionstartdate) actdt,
							advertiser.advname ad1,
							min(accesstime)
					FROM
						".$db.".subscriptiondetail
					INNER JOIN ".$db.".subscriber ON subscriber.subscriberid = subscriptiondetail.subscriberid
					INNER JOIN ".$dblog.".annonymoustracking ON annonymoustracking.userid = subscriber.mobilenumber
					INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
					WHERE
						isrenew = 0 AND amount > 0
							AND subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."' group by mobilenumber
							) a
					GROUP BY dt1 , ad1) a
						LEFT JOIN
					(SELECT 
						COUNT(mobilenumber) dct, DATE(a.actdt) dt2, ad2
					FROM
						(SELECT DISTINCT
						subscriptiondetail.subscriberid,
							mobilenumber,
							subscriptionstartdate actdt,
							advertiser.advname ad2,
							min(accesstime)
					FROM
						".$db.".subscriptiondetail
					INNER JOIN ".$db.".subscriber ON subscriber.subscriberid = subscriptiondetail.subscriberid
					INNER JOIN ".$dblog.".annonymoustracking ON annonymoustracking.userid = subscriber.mobilenumber
					INNER JOIN ".$dblog.".advertiser ON advertiser.advertiserid = annonymoustracking.advertiserid
					WHERE
						isrenew = 0 AND amount > 0
							AND subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."' group by mobilenumber
							) a
					INNER JOIN (SELECT DISTINCT
						subscriptiondetail.subscriberid,userid,
							subscriptionstartdate dctdt, min(accesstime)
					FROM
						".$db.".subscriptiondetail
					INNER JOIN ".$db.".subscriber ON subscriber.subscriberid = subscriptiondetail.subscriberid
					INNER JOIN ".$dblog.".annonymoustracking ON annonymoustracking.userid = subscriber.mobilenumber
					WHERE
						(charging_mode = 'null' OR charging_mode like '%suspend%') AND amount = 0
							AND subscriptionstartdate >= '".$start_date."'
							AND subscriptionstartdate < '".$end_date."' group by userid
							) b ON a.subscriberid = b.subscriberid
							
					  
					GROUP BY dt2 , ad2) b ON a.dt1 = b.dt2 AND a.ad1 = b.ad2
					";
					//echo $sql;
		$res=mysql_query($sql,$con);					
		}
		else
		{
			$db='gamesdb';
			$dblog='gamesdblog_idea';
			$sql="select a.*,b.* ,(b.dct/a.act)*100 perc from (select  COUNT(mobilenumber) act, DATE(a.actdt) dt1, ad1 from (
			select distinct subscriptiondetail.subscriberid,mobilenumber, subscriptionstartdate actdt, advertiser.advname ad1 ,
			min(accesstime)
			from ".$db.".subscriptiondetail 
			inner join ".$db.".subscriber on subscriber.subscriberid= subscriptiondetail.subscriberid
			inner join ".$dblog.".annonymoustracking on annonymoustracking.userid=subscriber.mobilenumber
			inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid
			where charging_mode like '%ACT%' and amount > 0   and subscriptionstartdate>='".$start_date."' 
			and subscriptionstartdate  < '".$end_date."' group by mobilenumber ) a group by  dt1,ad1) a 
			left join
			(select  COUNT(mobilenumber) dct, DATE(a.actdt) dt2, ad2 from (
			select distinct subscriptiondetail.subscriberid,mobilenumber, subscriptionstartdate actdt, advertiser.advname ad2,
			min(accesstime)
			from ".$db.".subscriptiondetail 
			inner join ".$db.".subscriber on subscriber.subscriberid= subscriptiondetail.subscriberid
			inner join ".$dblog.".annonymoustracking on annonymoustracking.userid=subscriber.mobilenumber
			inner join ".$dblog.".advertiser on advertiser.advertiserid=annonymoustracking.advertiserid
			where charging_mode like '%ACT%' and amount > 0  and subscriptionstartdate>='".$start_date."' 
			and subscriptionstartdate  < '".$end_date."' group by mobilenumber
			) a 
			inner join (
			select distinct subscriptiondetail.subscriberid, subscriptionstartdate dctdt,userid,min(accesstime) from ".$db.".subscriptiondetail 
			inner join ".$db.".subscriber on subscriber.subscriberid= subscriptiondetail.subscriberid
			inner join ".$dblog.".annonymoustracking on annonymoustracking.userid=subscriber.mobilenumber
			where charging_mode like '%DCT%' and subscriptionstartdate>='".$start_date."' 
			and subscriptionstartdate  < '".$end_date."'  group by userid
			) b on a.subscriberid=b.subscriberid    group by dt2, ad2) b on  a.dt1=b.dt2 and a.ad1=b.ad2";
			//echo $sql;
			$res=mysql_query($sql,$con);
		}
	}
	
	
	
}

//$res=mysql_query($sql) or die(mysql_error());
//$fields=mysql_num_fields($res);// number of fields in table

//echo "<script>window.location='report.php';</script>";

//echo $sql;

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
                    <h2>Sameday Churn Report</h2>
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
						<select name="product" class="form-control" id="product">
							<option>Product</option>
							<option value="Hotshots" <?php if($product=='Hotshots'){$selected='selected';}else{$selected='';} echo $selected; ?> >Hotshots</option>
							<option value="GamezZone" <?php if($product=='GamezZone'){$selected='selected';}else{$selected='';} echo $selected; ?>>GamezZone</option>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Operator
						<select name="operator" class="form-control" id="operator">
							<option>Operator</option>
							<option value="Vodafone" <?php if($operator=='Vodafone'){$selected='selected';}else{$selected='';} echo $selected; ?> >Vodafone</option>
							<option value="Airtel" <?php if($operator=='Airtel'){$selected='selected';}else{$selected='';} echo $selected; ?>>Airtel</option>
							<option value="Idea" <?php if($operator=='Idea'){$selected='selected';}else{$selected='';} echo $selected; ?>>Idea</option>
						</select>
						</div>
						
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Start Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="start_date" value="<?php if($start_date1!=''){echo date('d-m-Y',strtotime($start_date1));}else{ echo date('d-m-Y');} ?>"  type="text">
						</div>

						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> End Date
						<input class="date-picker form-control col-md-7 col-xs-12 birthday" name="end_date" value="<?php if($end_date1!=''){echo date('d-m-Y',strtotime($end_date1));}else{ echo date('d-m-Y');} ?>" type="text">
						</div>
				
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
										<td><strong>Advertiser</strong></td>
										<td><strong>Activation</strong></td>
										<td><strong>Deactivation</strong></td>
										<td><strong>Percentage</strong></td>
	
									</tr>
								</thead>


								<tbody>
								<?php
									$act=0;
									$dct=0;
									$perc=0;
									
									if($c==1)
									{
									while($row=mysql_fetch_array($res))
									{
										
								?>
									<tr>
										<td><?php echo $row['dt1']; ?></td>
										<td><?php echo $row['ad1']; ?></td>
										<td><?php echo number_format($row['act']); $act=$act+$row['act']; ?></td>
										<td><?php echo number_format($row['dct']); $dct=$dct+$row['dct']; ?></td>
										<td><?php echo number_format($row['perc'],2)." %"; ?></td>
									</tr>
									
								<?php
								//echo "perc= ".$row['perc'];
									}
									}
									if($b==1)
									{
										
									while($row2=mysql_fetch_array($res2))
									{
										
								?>
									<tr>
										<td><?php echo $row2['date']; ?></td>
										<td><?php echo $row2['advname']; ?></td>
										<td><?php echo number_format($row2['act']); $act=$act+$row2['act']; ?></td>
										<td><?php echo number_format($row2['dct']); $dct=$dct+$row2['dct']; ?></td>
										<td><?php echo number_format($row2['perc'],2)." %"; ?></td>
									</tr>
									
								<?php
								//echo "perc= ".$row['perc'];
									}
										
									}
									
								?>
								
								<tr>
									<td><strong>Total</strong></td>
									<td></td>
									<td><strong><?php echo $act; ?></strong></td>
									<td><strong><?php echo $dct; ?></strong></td>
									<td><strong><?php $perc=number_format(($dct/$act)*100,2)." %"; if($perc > 15){echo "<span style='color:red;'>".$perc."</span>";}else{echo "<span style='color:green;'>".$perc."</span>";}?></strong></td>
								</tr>
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
