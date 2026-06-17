<?php

ini_set('max_execution_time', 6000000);
//error_reporting(0);
include("includes/check_session.php");
if($_SESSION['admin']==0)
{
	//echo "<script>alert('you are not allow to use this report');</script>";
	//			echo "<script>window.location='report.php'</script>";
	//header('location:report.php');
}
//include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");

$con=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$con3=new mysqli("10.34.240.214","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2





//$con1=new mysqli("10.125.0.50","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster1

$con1=$con;
$start_date='';
$end_date='';
$country='';
$product='';
$count=0;
$cc=0;
 //$sql_ad="select * from gamebardb_vodafone_qatar_report.mainreportquery where `performance` !=''  ORDER BY product,country,operator ";
//$res_op=mysqli_query($con3,$sql_ad);

$yesterday=date('Y-m-d', strtotime( ' -1 day'));
$twoday=date('Y-m-d', strtotime( ' -2 day'));
$lastday=date('Y-m').'-01';
//echo $totaldays=$lastday-$yesterday;exit;
// $totaldays=date_diff($lastday,$yesterday);

//$diff=date_diff($date1,$date2);
//$diff= $totaldays->format("%R%a days");

//echo $diff;exit;

//$todaystartdate=$today." 00:00:00";
//$todayenddate=$today." 23:59:59";
//$yesterdaystartdate=$yesterday." 00:00:00";
//$yesterdayenddate=$yesterday." 23:59:59";



?>

		<?php include("includes/header.php"); ?>
		<?php include("includes/sidebar.php"); ?>
		<?php include("includes/top_navigation.php"); ?>
            
			<style>

.table>thead>tr>td{
	
	vertical-align:middle;
	Border:1px solid #000;	}
	
 .table>tbody>tr>td{
	
	vertical-align:middle;
	Border:1px solid #000;	}
	
	
	.table>tfooter>tr>td{
	
	vertical-align:middle;
	Border:1px solid #ffffff;	}

</style>

        <!-- page content -->
        <div class="right_col" role="main" >
          <div class="footer_down">

            
            

           
			
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						
						
			<?php 
			//echo $country;
			
				
			
				//echo $cc;exit;
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
					  <input type="button" onclick="tableToExcel('dataTables-example', 'W3C Example Table')" value="Export to Excel"><br><br>
						
												<table id="dataTables-example" class="table table-striped " >
							<thead style="background:#807d7d;color:#fff">
							<td rowspan='3'><b>Country</b></td>
							<td rowspan='3'><b>Product</b></td>
							<td rowspan='3'><b>Operator</b></td>
							<td colspan='4'><b>Activation</b></td>
							<td colspan='4'><b>Renewal</b></td>
							<td colspan='2' rowspan='2' ><b>% Growth</b></td>
							
							
							
							<tr>
							<td colspan='2'><b><?php echo "Average of <br>".$lastday." To ".$yesterday?></b></td>
							<td colspan='2'><b><?php echo $yesterday;?></b></td>
							<td colspan='2'><b><?php echo "Average of <br>".$lastday." To ".$yesterday?></b></td>
							<td colspan='2'><b><?php echo $yesterday;?></b></td>
							
							</tr>
							
								<tr>
									<!--<td><strong>Country</strong></td>
									<td><strong>Activation Count</strong></td>
									<td><strong>url</strong></td>-->
									
									<td><b>Count</b></td>
									<td><b>Amount</b></td>
									<td><b>Count</b> </td>
									<td><b>Amount</b></td> 
									<td><b>Count</b> </td>
									<td><b>Amount</b></td> 
									<td><b>Count</b> </td>
									<td><b>Amount</b></td> 
									<td><b>% Growth Activation</b></td>
									<td><b>% Growth Renewal</b></td>
									
									
									
								</tr>
							</thead>


							<tbody>
								<?php
								$totalact=$totalactamount=$totalrenewcount=$totalrenewamount=$totaltotalcount=$totaltotalamount=$totaldigiinvest=$totalrevenue=$totalprofit=$totalptotal=$totalpdigitin=$totalprevenue=$totalpprofit=0;
								
									$query="select 

												a.`product`,
												a.`country`,
												a.`operator`,

												lastactavg,
												lastactamtavg,
												lastrenavg,
												lastrenamtavg,
												yestactcount,
												yestactamtcount,
												yetrencount,
												yestrenamtcount
												from
												(SELECT 
														   `product`,
														   `country`,
														   `operator`,
															avg(`actcount`)lastactavg,
															avg(`actamount`)lastactamtavg,
															avg(`renewcount`)lastrenavg,
															avg(`renewamount`)lastrenamtavg
													FROM
														gamebardb_vodafone_qatar_report.mainreport
													WHERE
														`Date` >= '".$lastday."'
															AND  `Date` <='".$yesterday."'
															and `advertiser`=0
															group by  product,country,operator)a
															
															
												 join

												(
												SELECT 
														   `product`,
														   `country`,
														   `operator`,
															`actcount` yestactcount,
															`actamount` yestactamtcount,
														   `renewcount` yetrencount,
															`renewamount` yestrenamtcount
													FROM
														gamebardb_vodafone_qatar_report.mainreport
													WHERE
														`Date` >= '".$yesterday."'
															AND  `Date` <='".$yesterday."'
															and `advertiser`=0
															
												)b

												on a.`product`=	b.product  and a.operator=b.operator order by product,country,operator";
												
									//echo $query;exit;			
									$res=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($res))
									{
									
									$product=$row['product'];
									$country=$row['country'];
									$operator=$row['operator'];
									$lastactavg=$row['lastactavg'];
									$lastactamtavg=$row['lastactamtavg'];
									$lastrenavg=$row['lastrenavg'];
									$lastrenamtavg=$row['lastrenamtavg'];
									$yestactcount=$row['yestactcount'];
									$yestactamtcount=$row['yestactamtcount'];
									$yetrencount=$row['yetrencount'];
									$yestrenamtcount=$row['yestrenamtcount'];
									
									
								?>
									<tr  style="background:white;color:Black">
									
									
										
										<td style="background:#dedbdb;color:Black"><b><?php echo $country;?></b> </td>
										<td style="background:#dedbdb;color:Black"><b><?php echo $product;?></b> </td>
										<td style="background:#dedbdb;color:Black"><b><?php echo $operator;?></b> </td>
										
										<td><?php echo number_format($lastactavg,0,'.',',');?> </td>
										<td><?php echo number_format($lastactamtavg,1,'.',',');?> </td>
										
										
										
										<td><?php echo number_format($yestactcount,0,'.',',');?> </td>
										<td><?php echo number_format($yestactamtcount,1,'.',',');?> </td>
										
										
										<td><?php echo number_format($lastrenavg,0,'.',',');?> </td>
										<td><?php echo number_format($lastrenamtavg,1,'.',',');?> </td>
										
										
										
										
										
										<td><?php echo number_format($yetrencount,0,'.',',');?> </td>
										<td><?php echo number_format($yestrenamtcount,1,'.',',');?> </td>
										
										<?php $kk1=number_format(($yestactamtcount-$lastactamtavg)/$lastactamtavg*100,1,'.',',');
										$kk2=number_format(($yestrenamtcount-$lastrenamtavg)/$lastrenamtavg*100,1,'.',',');?>
										
										<td style='color:white;font-weight:bold;<?php if($kk1>=0){echo "background:#79d279";}else{echo "background:#ff9999";}?>;padding:15px;'><?php echo number_format(($yestactamtcount-$lastactamtavg)/$lastactamtavg*100,1,'.',',')."%";?> </td>
										<td style='color:white;font-weight:bold;<?php if($kk2>=0){echo "background:#79d279";}else{echo "background:#ff9999";}?>;padding:15px;'><?php echo number_format(($yestrenamtcount-$lastrenamtavg)/$lastrenamtavg*100,1,'.',',')."%";?> </td>
										
										
									</tr>
								<?php
								}
								
								$res->close();
								$con->next_result();
								
								
								
								
								
								?>
								
							</tbody>
							
							
								
								
						</table>
					  </div>
				<!--<div id="advertiser"></div>-->
			
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
            url: "ajax/find_country.php?product="+product         
			
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
        var country = $("#country").val();
		var product = $("#product").val();
        $.ajax({
            type: "GET",
            url: "ajax/advertiser.php?country="+country+"&product="+product         
			
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
 <script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
