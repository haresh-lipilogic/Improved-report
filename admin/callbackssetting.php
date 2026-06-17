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
if(isset($_POST['submit']))
{

$count=1;
$operator=$_POST['operator'];
$product=$_POST['product'];
$date1=date('Y-m-d');


 $sql_ad="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."' and (mainreport_all is not null and mainreport_all !='') order by operator asc";
	$res_op=mysqli_query($con,$sql_ad);
	
	 $sql="select * from gamebardb_vodafone_qatar_report.mainreportquery where product='".$product."' and operator='".$operator."' ";
			$res=mysqli_query($con,$sql);
			
			while($row=mysqli_fetch_array($res))
			{
				$advdb=$row['advdb'];
				$advtable=$row['advtable'];
				$condition1=$condition=$row['callbackcondition'];
			
			}

	  $query="select a.advertiserid,a.callbackurl,a.advname,isactive,spo_stop,act_stop,cg_stop from ".$advdb.".".$advtable." inner join advertiserdb.advertiser a on a.advertiserid=".$advtable.".advertiserid ".$condition;
	$res=mysqli_query($con,$query) or die(mysqli_error());
	


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
										if($row_op['operator']==$operator)
										{
											$selected="selected";
										}
										else
										{
											$selected="";
										}
									?>
									<option value="<?php echo $row_op['operator']; ?>" <?php echo $selected; ?>><?php echo $row_op['operator']; ?></option>
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
			//echo $sql;

			if($count==1)
			{
				$k=$l=0;
				
			?>	
			
					  <div class="x_content"  style="overflow:auto;">
						
						<table id="datatable-buttons" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td><strong>id</strong></td>
									<td><strong>AdvName</strong></td>
									<td><strong>Callback Url</strong></td><!--uniq-->
									<td><strong>Activation Callback Stop(%)
									
									
									</strong><br>
									
									<input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['act_stop']; ?>' onblur="stop_callback(this.value,'mehul','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="">
									
									
									</td>
									<td><strong>Spi-lower Callback Stop(%)</strong><br>
									
									<input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['spo_stop']; ?>' onblur="stop_callback1(this.value,'mehul','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="">
									
									
									</td>
									<td><strong>CG Callback Stop(%)</strong>
									<br>
									
									<input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['cg_stop']; ?>' onblur="stop_callback2(this.value,'mehul','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="">
									
									</td>
									
									
									
								</tr>
							</thead>


							<tbody>
							<tr>
							
								<?php
								
									
									while($row1=mysqli_fetch_array($res))
									{
										?>
										<td><?php echo $row1['advertiserid'];  ?></td>
										<td><?php echo $row1['advname'];?></td>
										<td><?php echo $row1['callbackurl'];?></td>
									
										
										<td><input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['act_stop']; ?>' onblur="stop_callback(this.value,'<?php echo $row1['advertiserid']; ?>','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="%"></td>
										
										<td><input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['spo_stop']; ?>' onblur="stop_callback1(this.value,'<?php echo $row1['advertiserid']; ?>','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="%"></td>
										
										
										<td><input type="text" style="width:60px;padding:3px;" value='<?php echo $row1['cg_stop']; ?>' onblur="stop_callback2(this.value,'<?php echo $row1['advertiserid']; ?>','<?php echo $operator; ?>','<?php echo $product; ?>','<?php echo $advdb; ?>','<?php echo $advtable; ?>','<?php echo $condition1; ?>')" placeholder="%"></td>
										
										
										
										
										
										
										
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

function stop_callback(callbackstop_perc,advertiserid,operator,product,database,table,condition)
{
//alert("ajax/make.php?callbacktype=act_stop&operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&db="+database);
//alert(advertiserid);		
	$.ajax({
            type: "GET",
            url: "ajax/make.php?callbacktype=act_stop&operator="+operator+"&product="+product+"&callbackstop_perc="+callbackstop_perc+"&advertiserid="+advertiserid+"&db="+database+"&advtable="+table+"&condition="+condition   
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