<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$dateonly=date("Y-m-d");
$username = $_SESSION['username'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$financialyear = $_SESSION['financialyear'];

if (isset($_REQUEST["quotationnumber"])) { $quotationnumber = $_REQUEST["quotationnumber"]; } else { $quotationnumber = ""; }
//$quotationnumber=$_REQUEST['quotationnumber'];
$singlerecord = "";

$query2 = "select * from master_quotation where quotationnumber = '$quotationnumber' and status <> 'DELETED' and companyanum = '$companyanum';";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_num_rows($exec2);

	if ($res2 == 0)
	{
		$singlerecord = $quotationnumber;
	}
	else
	{
//		$singlerecord = 'notempty';
		$singlerecord = '';
	}

echo $singlerecord;

?>
