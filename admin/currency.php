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
		
		$sql3="select * from ".$database.".currency";
		$res_ad=mysqli_query($con,$sql3);
	


?>

		<?php include("includes/header.php"); ?>
		<?php include("includes/sidebar.php"); ?>
		<?php include("includes/top_navigation.php"); ?>
            
			

        <!-- page content -->
        <div class="right_col" role="main" >
          <div class="footer_down">

            
            

            
			
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Currency Change Portal <small></small></h2>
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
			//echo $sql;

			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>id</strong></td>
									<td><strong>Country</strong></td>
									<td><strong>Country to inr</strong></td><!--uniq-->
									
									
									
								</tr>
							</thead>


							<tbody>
							<tr>
							
								<?php
								
									
									while($row1=mysqli_fetch_array($res_ad))
									{
										?>
										<td><?php echo $row1['id'];  ?></td>
										<td><?php echo $row1['country'];?></td>
										
										<td><input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['toinr']; ?>' onblur="stop_callback(this.value,<?php echo $row1['id']; ?>)" placeholder=""></td>
										
										
										
										
										
										
									</tr>
								
								
								
								<?php
									}
								
							
							
						?>		
								
						</table>
					  </div>
				<!--<div id="advertiser"></div>-->
			
							</tbody>
							</table>
					  </div>
			
			
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
		var product = $("#product").val();
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
	if(x =='glambar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		//select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('South_Africa_oxygen', 'south_africa');
		select.options[select.options.length] = new Option('South_Africa_intarget', 'south_africa_intarget');
		//select.options[select.options.length] = new Option('Idea_India', 'idea');
		//select.options[select.options.length] = new Option('Vodafone_India', 'vodafone');
		select.options[select.options.length] = new Option('Airtel_India', 'airtel_india');
		//select.options[select.options.length] = new Option('Bsnl_India', 'bsnl_india');
		//select.options[select.options.length] = new Option('Thailand', 'thailand_svobi');
	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		//select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('South_Africa_oxygen', 'south_africa');
		select.options[select.options.length] = new Option('South_Africa_intarget', 'south_africa_intarget');
		//select.options[select.options.length] = new Option('Ooredoo_Oman', 'ooredoo_oman');
		//select.options[select.options.length] = new Option('Ooredoo_Qatar', 'ooredoo_qatar');
		//select.options[select.options.length] = new Option('Cellcom_Malaysia', 'malaysia_cellcom');
		//select.options[select.options.length] = new Option('Idea_India', 'idea');
		//select.options[select.options.length] = new Option('Vodafone_India', 'vodafone');
		select.options[select.options.length] = new Option('Airtel_India', 'airtel_india');
		//select.options[select.options.length] = new Option('Bsnl_India', 'bsnl_india');
		//select.options[select.options.length] = new Option('Portugal', 'portugal');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		/*select.options[select.options.length] = new Option('Airtel', 'Airtel');
		select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		select.options[select.options.length] = new Option('etisalat', 'etisalat');
		select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo');
		select.options[select.options.length] = new Option('srilanka', 'srilanka');*/
	}
	
	/*if(x=="glambar")
	{
		 //alert("hi");
	document.getElementById('azharbeizan').style.visibility = 'hidden';
	}else
	{
		document.getElementById('azharbeizan').style.visibility = 'visible';
	}*/
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

function stop_callback(currencytoinr,advertiserid)
{
		//alert("ajax/make2.php?currencytoinr="+currencytoinr+"&id="+advertiserid);
		$.ajax({
            type: "GET",
            url: "ajax/make2.php?currencytoinr="+currencytoinr+"&id="+advertiserid       
			});			
			
			
}

</script> 	

