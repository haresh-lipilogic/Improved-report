<?php
function login($email,$password)
{
	$sql="select * from advertiser_tbl where adv_email='$email' and adv_password='$password' ";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);
	$num=mysql_num_rows($res);
	$_SESSION['id']=$row['adv_id'];

	if($num > 0)
	{
		echo "<script>window.location='dashboard.php'</script>";
	}
	else
	{
		echo "<script>alert('Username and Password doest not match.');</script>";
	}
}


function do_register($adv_name,$adv_email,$adv_number,$adv_website,$adv_password,$adv_product,$adv_advertiser)
{
	$sql="insert into advertiser_tbl (adv_name,adv_number,adv_website,adv_email,adv_password,adv_product,adv_advertiser) 
	values ('$adv_name','$adv_number','$adv_website','$adv_email','$adv_password','$adv_product','$adv_advertiser')";
	$res=mysql_query($sql);
	
}

function fetch_advertiser_detail($id,$product)
{
	$sql="select * from advertiser_tbl where adv_id='".$id."'";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);
	
	if($product=='hotshots')
	{
	
		$adv_advertiser=$row['adv_hs_advertiser'];
	}
	else
	{
		$adv_advertiser=$row['adv_gm_advertiser'];
		
	}
	return $adv_advertiser;
	
	
}






?>