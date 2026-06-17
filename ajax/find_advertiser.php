<?php 
include("../includes/connection.php");

$product=$_GET['product'];

//echo "<script>alert('".$product."');</script>"; 
if($product == 'games')
{
	$sql11="select * from gamesdblog_idea.advertiser";
	$res11=mysql_query($sql11);
	
}
else
{
	
	$sql11="select * from hotshotsdblog_idea.advertiser";
	$res11=mysql_query($sql11);
}

?>
<label  class="control-label col-md-3">Advertiser <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12 ">
                          
                        
	<select name="adv_advertiser[]" class="form-control select2_multiple" multiple="multiple" required >
		
		<?php
		while($row_ad=mysql_fetch_array($res11))
		{
			
		?>
		<option value="<?php echo $row_ad[0]; ?>"><?php echo $row_ad[1]; ?></option>
		<?php
		}
		?>
		<option value="all">All</option>
	</select>
	</div>
	
	
	<script type="text/javascript">
	 $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
	</script>