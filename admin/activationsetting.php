<?php
include("includes/check_session.php");
//include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");
//error_reporting(0);
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

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
$date1=date('Y-m-d');




	   $query="select * from gamebardb_vodafone_qatar_report.activationsetting  order by Country asc";
	$res=mysqli_query($con,$query) or die(mysqli_error());
	



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
							<h2>Open Or Close Activation Report Country <small></small></h2>
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

			if($count==1)
			{
				$k=$l=0;
				
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>Product</strong></td>
									<td><strong>Country</strong></td>
									<td><strong>Action</strong></td><!--uniq-->
									
									
									
									
									
								</tr>
							</thead>


							<tbody>
							<tr>
							
								<?php
								
									
									while($row1=mysqli_fetch_array($res))
									{
										?>
										<td><?php echo $row1['Product'];  ?></td>
										<td><?php echo $row1['Country'];?></td>
										
										
									
										
										<td><select onchange="stop_callback(this.value,'<?php echo $row1['Product']; ?>','<?php echo $row1['Country']; ?>')">
										
										<option <?php if($row1['Action']=='Open'){echo "selected";}?> value="Open">Open</option>
										<option <?php if($row1['Action']=='Close'){echo "selected";}?> value="Close">Close</option>
										
										</select>
										
										
										</td>
										
										
										
										
									
										
										
										
										
										
										
										
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
			
			<?php	
			}
			else{
				
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
            url: "ajax/findoperatormainreport.php?product="+product         
			
        }).done(function(data){
			
			
            $(".response1").html(data);
			 
        });
    });
});
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
<script>
	/*function myFunction() {
    var x = document.getElementById("product").value;
	
	//document.getElementById("demo").innerHTML = "You selected: " + x;
    if(x =='Hotshots')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		select.options[select.options.length] = new Option('Airtel', 'Airtel');
	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		select.options[select.options.length] = new Option('Idea', 'Idea');
		//select.options[select.options.length] = new Option('Airtel', 'Airtel');
		select.options[select.options.length] = new Option('Azharbeizan', 'Azharbeizan');
		//select.options[select.options.length] = new Option('etisalat', 'etisalat');
		//select.options[select.options.length] = new Option('ooredoo_qatar', 'ooredoo_qatar');
	}
	
	//document.getElementById("demo").innerHTML = "You selected: " + x;
	}
	
	*/
	</script> 
<script type="text/javascript">

function stop_callback(action,product,country)
{
	
	//alert(action);
	//alert(product);
	//alert(country);
	
//alert("ajax/make.php?callbacktype=act_stop&operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&db="+database);
//alert(advertiserid);		
	$.ajax({
            type: "GET",
            url: "ajax/activationsetting.php?action="+action+"&product="+product+"&country="+country
			});			
			
			
}

</script> 	

<script type="text/javascript">

function stop_callback1(callbackstop_perc,advertiserid,operator,product,database,table,condition)
{
//alert();
		
		$.ajax({
            type: "GET",
            url: "ajax/make.php?callbacktype=spo_stop&operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&db="+database+"&advtable="+table+"&condition="+condition        
			});			
			
			
}

</script> 	


<script type="text/javascript">

function stop_callback2(callbackstop_perc,advertiserid,operator,product,database,table,condition)
{

		
		$.ajax({
            type: "GET",
            url: "ajax/make.php?callbacktype=cg_stop&operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&db="+database+"&advtable="+table+"&condition="+condition        
			});			
			
			
}

</script> 