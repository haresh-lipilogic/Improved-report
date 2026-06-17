<?php

ini_set('max_execution_time', 6000);

//include("includes/check_session.php");
//include("includes/connection.php");
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



if(isset($_POST['submit']))
{

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
 $advertiserid=$_POST['advertiserid']; 
//print_r($_POST);
//exit;

	$sql_ad="select * from gamebardb_vodafone_qatar_report.operatorurls where product='".$product."' order by operatorname asc";
	$res_op=mysqli_query($con,$sql_ad);
	
	
	$sql="select * from gamebardb_vodafone_qatar_report.operatorurls where product='".$product."' and operatorname='".$operator."' ";
			$res=mysqli_query($con,$sql);
			
			while($row=mysqli_fetch_array($res))
			{
				$query=$row['advertiserquery'];
				$url=$row['advertiserurl'];
				$advertiserwisequery=$row['advertiserwise_query'];
			
			}
	//echo $advertiserid;exit;
	
	$res_ad=mysqli_query($con,$query);
	$advertiserwisequery=str_replace("[advid]",$advertiserid,$advertiserwisequery);
	
	
	
			//echo $advertiserwisequery;exit;		
	$cc=1;
	$res1=mysqli_query($con1,$advertiserwisequery);
	
	while($row1=mysqli_fetch_array($res1))
			{
				$advid=$row1['advertiserid'];
				$advname=$row1['advname'];
				$uid=$row1['uid'];
			
			}
	//echo $advid;exit;
	$url=str_replace("[adid]",$advid,$url);
	$url=str_replace("[uid]",$uid,$url);
	
	//echo $url;exit;
	

	//					exit;

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
                    <h2>Search URLs <small></small></h2>
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
					
						<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback"> Product
						<select name="product" class="form-control" id="product" >
							<option>Product</option>
							<option value="gamebar" <?php if($product=='gamebar'){$selected='selected';}else{$selected='';} echo $selected; ?>>Gamebar</option>
							<option value="glambar" <?php if($product=='glambar'){$selected='selected';}else{$selected='';} echo $selected; ?> >Glambar</option>
							<option value="11Players" <?php if($product=='11Players'){$selected='selected';}else{$selected='';} echo $selected; ?> >11Players</option>
							<option value="Contest" <?php if($product=='Contest'){$selected='selected';}else{$selected='';} echo $selected; ?> >Contest</option>
							
						</select>
						</div>
						
						<?php
						if($count==0)
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback first"> operator
							<span class="response1">
							</span>
							
							</div>
						<?php
						}
						else
						{
							//echo $operator;exit;
						?>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback two"> operator
								<span class="response1" id="f1">
								</span>
								<span id="t1">
								<select name="operator" id="operator" class="form-control select1_single sel1" onchange="myfun1()">
									<?php
									
									
									while($row_op=mysqli_fetch_array($res_op))
									{
										if($row_op['operatorname']==$operator)
										{
											$selected="selected";
										}
										else
										{
											$selected="";
										}
									?>
									<option value="<?php echo $row_op['operatorname']; ?>" <?php echo $selected; ?>><?php echo $row_op['operatorname']; ?></option>
									<?php
									}
									?>
									
								</select>
								</span>
							</div>
						<?php
						}
						?>
						
						
						<?php
						if($count==0)
						{
						?>
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback first"> Advertiser
							<span class="response">
							</span>
							
							</div>
						<?php
						}
						else
						{
							//echo $operator;exit;
						?>
							
							<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback two"> Advertiser
								<span class="response" id="f">
								</span>
								<span id="t">
								<select name="advertiserid" class="form-control select2_single sel">
									<?php
									
									
									while($row_ad=mysqli_fetch_array($res_ad))
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
						

						<br><br><br><br>
						<div class="col-md-9 col-sm-9 col-xs-12">
						 
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
			//echo $operator;
			
				
			if($count==1)
			{
				$k=$l=0;
				//echo $cc;exit;
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>id</strong></td>
									<td><strong>advname</strong></td>
									<td><strong>url</strong></td>
									
									
									
								</tr>
							</thead>


							<tbody>
								
									<tr>
										<td><?php echo $advid;  ?></td>
										<td><?php echo $advname;  ?></td>
										<td><?php echo $url;  ?></td>
										
										
										
									</tr>
								
								
								
								
							</tbody>
							
							
								
								
						</table>
					  </div>
				<!--<div id="advertiser"></div>-->
			<?php
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
            url: "ajax/find_operator.php?product="+product         
			
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
        var operator = $("#operator").val();
		var product = $("#product").val();
        $.ajax({
            type: "GET",
            url: "ajax/advertiser.php?operator="+operator+"&product="+product         
			
        }).done(function(data){
            $(".response").html(data);
			 
        });

}	
</script>		




<script type="text/javascript">
function myfun() {
	var x = document.getElementById("product").value;
    //alert(x);
	if(x =='glambar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Thailand', 'thailand_svobi');
		select.options[select.options.length] = new Option('New_Thailand', 'new_thailand');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Kenya_Oxygen', 'kenya_oxygen');
		select.options[select.options.length] = new Option('Poland', 'poland');
		select.options[select.options.length] = new Option('Vodacom_Wfh', 'vodacom_wfh');
		select.options[select.options.length] = new Option('Vodacom_Fg', 'vodacom_fg');
		select.options[select.options.length] = new Option('Vodacom_Bt', 'vodacom_bt');
		select.options[select.options.length] = new Option('Cosmote_Greece', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Vodafone_Greece', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Wind_Greece', 'Wind_Greece');
		select.options[select.options.length] = new Option('All_Greece D', 'all_greece');
	}
	else if(x =='gamebar')
	{
		document.getElementById('operator').options.length = 0;
		var select = document.getElementById("operator");
		select.options[select.options.length] = new Option('--operator--', '');
		select.options[select.options.length] = new Option('Vodafone_Qatar', 'Vodafone_Qatar');
		
		select.options[select.options.length] = new Option('Ooredoo_Oman', 'ooredoo_oman');
		select.options[select.options.length] = new Option('Qatar_Gamestation', 'qatar_gamestation');
		select.options[select.options.length] = new Option('Ooredoo_Qatar', 'ooredoo_qatar');
		select.options[select.options.length] = new Option('Qu_Qatar', 'qu_qatar');
		select.options[select.options.length] = new Option('Cellcom_Malaysia', 'malaysia_cellcom');
		
		
		//select.options[select.options.length] = new Option('Airtel_India', 'airtel_india');
	//	select.options[select.options.length] = new Option('Bsnl_India', 'bsnl_india');
		select.options[select.options.length] = new Option('Spain', 'spain');
		select.options[select.options.length] = new Option('Indonesia', 'indonesia');
		select.options[select.options.length] = new Option('Egypt', 'egypt');
		select.options[select.options.length] = new Option('Du_Dubai', 'du_dubai');
		select.options[select.options.length] = new Option('Kenya_Oxygen', 'kenya_oxygen');
		
		select.options[select.options.length] = new Option('Myanmar', 'myanmar');
		//select.options[select.options.length] = new Option('Kazakistan', 'kazakistan');
	
		
		select.options[select.options.length] = new Option('Poland', 'poland');
		select.options[select.options.length] = new Option('Bangladesh', 'Bangladesh_Robi');
		select.options[select.options.length] = new Option('Srilanka', 'dialog_srilanka');
		select.options[select.options.length] = new Option('Cosmote_Greece', 'Cosmote_Greece');
		select.options[select.options.length] = new Option('Vodafone_Greece', 'Vodafone_Greece');
		select.options[select.options.length] = new Option('Wind_Greece', 'Wind_Greece');
		select.options[select.options.length] = new Option('All_Greece D', 'all_greece');
		//select.options[select.options.length] = new Option('Mts_Serbia', 'Mts_Serbia');
		//select.options[select.options.length] = new Option('Vip_Serbia', 'Vip_Serbia');
		select.options[select.options.length] = new Option('Du_UAE', 'du_uae');
		select.options[select.options.length] = new Option('Etisalad_UAE', 'etisalad_uae');
		select.options[select.options.length] = new Option('Palestine', 'palestine');
		select.options[select.options.length] = new Option('Blazon_etisalad', 'blazon_etisalad');
		select.options[select.options.length] = new Option('Algeria', 'algeria');
		select.options[select.options.length] = new Option('Kuwait-Zain', 'kwzain');
		select.options[select.options.length] = new Option('Kuwait-Viva', 'kwviva');
		select.options[select.options.length] = new Option('Pk-Telenor', 'pk_telenor');
		select.options[select.options.length] = new Option('U.K.', 'unitedkingdom');
		//select.options[select.options.length] = new Option('Upstream_Thailand', 'upstream_thailand');
		select.options[select.options.length] = new Option('NL-D', 'netherland');
		select.options[select.options.length] = new Option('NL-N', 'netherland_netsmart');
		select.options[select.options.length] = new Option('France', 'france');
		select.options[select.options.length] = new Option('Bahrain', 'bahrain');
		select.options[select.options.length] = new Option('Greece N', 'gr2');
		select.options[select.options.length] = new Option('Norway', 'norway');
		select.options[select.options.length] = new Option('Saudi_Mobily', 'saudi_mobily');
		
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
 
