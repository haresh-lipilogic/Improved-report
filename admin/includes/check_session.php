<?php
error_reporting(0);
session_start();
if(!(isset($_SESSION['userid'])))
{
	//echo "<script>window.location='logout.php';</script>";
}
?>