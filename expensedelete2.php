<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION[username];
$companyanum = $_SESSION[companyanum];
$companyname = $_SESSION[companyname];

//$task = $_REQUEST[task];
if (isset($_REQUEST["task"])) { $task = $_REQUEST["task"]; } else { $task = ""; }
//$anum = $_REQUEST[anum];
if (isset($_REQUEST["anum"])) { $anum = $_REQUEST["anum"]; } else { $anum = ""; }

if ($task == 'delete' && $anum != '')
{
	$query1 = "update expensesub_details set recordstatus = 'DELETED' where auto_number = '$anum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
}

header ("location:expensereport2.php?task=deleted");

?>