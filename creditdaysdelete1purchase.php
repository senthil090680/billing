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
$financialyear = $_SESSION["financialyear"];

$task = $_REQUEST['task'];
$anum = $_REQUEST['anum'];

if ($task == 'delete' && $anum != '')
{
	$query19 = "select * from master_purchase where auto_number = '$anum' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
	$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
	while ($res19 = mysql_fetch_array($exec19))
	{
		$res19anum = $res19["auto_number"];
		$delbillnumber = $res19['billnumber'];
		
		$query15 = "update master_purchase set creditdaysstatus = 'COMPLETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
		$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
	
	}
}

header ("location:creditdaysreport1purchase.php?task=deleted");

?>