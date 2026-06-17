<?php
$oldconn = new PDO("mysql:host=10.125.1.51", 'productionuser', 'Zb8#fNIsXnoP12') or die(print_r($conn->error));
$newconn = new PDO("mysql:host=10.125.1.51;port=3308;", 'productionuser', 'Zb8#fNIsXnoP12') or die(print_r($conn->error));

$dbname="glambardb_southafrica";

$sql="SELECT table_name FROM information_schema.tables where table_schema='".$dbname."'";
$res=$oldconn->query($sql);
while($row=$res->fetch())
{
echo "<br><br>".$tbl=$row['table_name']; // table name
//$tbl='activeuserlog'; // table name

// primary key fetch karva
$sql_pk="SHOW KEYS FROM ".$dbname.".".$tbl." WHERE Key_name = 'PRIMARY'";
$res_pk=$oldconn->query($sql_pk);
$row_pk=$res_pk->fetch();


$pk=$row_pk['Column_name']; // primary key name


//New server ma last id check karva
$sql_last_id="select ".$pk." lid from ".$dbname.".".$tbl." order by ".$pk." desc limit 1 ";
$res_last_id=$newconn->query($sql_last_id);
$row_last_id=$res_last_id->fetch();

$last_id=$row_last_id['lid']; 

$sql_data="select * from ".$dbname.".".$tbl." where ".$pk." > '".$last_id."' limit 10000"; 
$res_data=$oldconn->query($sql_data);
$a1="";
while($row_data = $res_data->fetch() )
{
$sql_fields="SHOW COLUMNS FROM ".$dbname.".".$tbl."";
$res_fields=$oldconn->query($sql_fields);
$a="(";
while($row_fields = $res_fields -> fetch())
{
$field=$row_fields['Field'];
$a.="'".$row_data[$field]."',";
}

$a=rtrim($a,',')."),";

$a1.=$a;



}

$a1=rtrim($a1,',');
$insert="insert into ".$dbname.".".$tbl." values ".$a1." "; 
$res_insert=$newconn->exec($insert);
echo "=". $res_insert;



}



?>