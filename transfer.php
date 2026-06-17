<?php

function addUser($usrData) {
   $count = 0;
   $fields = '';

   foreach($usrData as $col => $val) {
      if ($count++ != 0) $fields .= ', ';
      $col = mysql_real_escape_string($col);
      $val = mysql_real_escape_string($val);
      $fields .= "`$col` = $val";
   }

   echo "<br><br>". $query = "INSERT INTO `myTable` SET $fields;";

}


$con=new mysqli("10.125.1.51","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$connew=new mysqli("10.125.1.51:3308","webserveruser","K&dN&r4a8N@du0") or die(mysqli_error());//cluster 2
$db="atlantdb";

$sql="SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='".$db."' ";
$res=mysqli_query($con,$sql) or die(mysqli_error());
//$wor=mysqli_fetch_array($res);
//print_r($wor);

while($wor=mysqli_fetch_array($res))
{

	 $table=$wor['table_name'];
	
	$sql2="SHOW KEYS FROM ".$db.".$table WHERE Key_name = 'PRIMARY'";
	$res2=mysqli_query($connew,$sql2);
	$wor=mysqli_fetch_array($res2);
	$primarykey=$wor['Column_name'];
	echo "<br><br>".$table."=".$wor['Column_name'];
	
	
	 $sql3="Select max($primarykey) max1 from ".$db.".$table ";
	$res3=mysqli_query($connew,$sql3);
	$wor3=mysqli_fetch_array($res3);
	$maximum=$wor3['max1'];
	
	$sql4="select * from ".$db.".$table where $primarykey>$maximum order by $primarykey asc limit 10";
	$res4=mysqli_query($con,$sql4);
	$wor4=mysqli_fetch_array($res4);
	echo "<br>";
	print_r($wor4);
	
}





?>