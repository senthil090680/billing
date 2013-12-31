<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

$task = $_REQUEST['task'];
$anum = $_REQUEST['anum'];

if ($task == 'delete' && $anum != '')
{
	$query1 = "update master_quotation set status = 'DELETED' where auto_number = '$anum' and companyanum = '$companyanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());

	$query2 = "update quotation_details set status = 'DELETED' where quotationanum = '$anum'";// and companyanum = '$companyanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	$query3 = "update quotation_tax set status = 'DELETED' where quotation_autonumber = '$anum'";// and companyanum = '$companyanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	
}

header ("location:quotationreport1.php?task=deleted");

?>