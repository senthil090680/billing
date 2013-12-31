<?php
session_start();
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

$query1 = "select * from master_sales";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$billautonumber = $res1['auto_number'];
	$billdate = $res1['billdate'];

	$query2 = "update sales_tax set billdate = '$billdate' where bill_autonumber = '$billautonumber'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$billautonumber = '';
	$billdate = '';
}


$query1 = "select * from master_salesreturn";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$billautonumber = $res1['auto_number'];
	$billdate = $res1['billdate'];

	$query2 = "update salesreturn_tax set billdate = '$billdate' where bill_autonumber = '$billautonumber'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$billautonumber = '';
	$billdate = '';
}



$query1 = "select * from master_purchase";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$billautonumber = $res1['auto_number'];
	$billdate = $res1['billdate'];

	$query2 = "update purchase_tax set billdate = '$billdate' where bill_autonumber = '$billautonumber'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$billautonumber = '';
	$billdate = '';
}

$query1 = "select * from master_purchasereturn";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
while ($res1 = mysql_fetch_array($exec1))
{
	$billautonumber = $res1['auto_number'];
	$billdate = $res1['billdate'];

	$query2 = "update purchasereturn_tax set billdate = '$billdate' where bill_autonumber = '$billautonumber'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$billautonumber = '';
	$billdate = '';
}

?>