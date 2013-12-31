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
$paymentreceiveddatefrom = date('Y-m-d', strtotime('-1 month'));
$paymentreceiveddateto = date('Y-m-d');
$recordstatus = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$leadautonumber = $_REQUEST["leadautonumber"];
	$leadcode = $_REQUEST["leadcode"];
	$customername = $_REQUEST["customername"];
	$contactperson=$_REQUEST["contactperson"];
	$city = $_REQUEST["city"];
	$state = $_REQUEST["state"];
	$pincode = $_REQUEST["pincode"];
	$country = $_REQUEST["country"];
	$emailid = $_REQUEST["emailid"];
	$phonenumber = $_REQUEST["phonenumber"];
	$mobilenumber = $_REQUEST["mobilenumber"];
	$leaddate = $_REQUEST["leaddate"];
	$leadassignedto = $_REQUEST["leadassignedto"];
	$leadcategoryname = $_REQUEST["leadcategoryname"];
	$leadstatusname = $_REQUEST["leadstatusname"];
	$leadsourcename = $_REQUEST["leadsourcename"];
	$customerbudget = $_REQUEST["customerbudget"];
	$leadactiontobetaken = $_REQUEST["leadactiontobetaken"];
	$leadactionpriority = $_REQUEST["leadactionpriority"];
	$leadsubject = $_REQUEST["leadsubject"];
	$leaddetails = $_REQUEST["leaddetails"];
	$leadapprovalstatus = $_REQUEST["leadapprovalstatus"];
	$remarks = $_REQUEST["remarks"];
	$leadstagename = $_REQUEST["leadstagename"];
	$leadlostreasonname = $_REQUEST["leadlostreasonname"];
	
	$responseby = $_REQUEST["responseby"];
	$responsedatetime = $_REQUEST["responsedatetime"];
	$responsedetails = $_REQUEST["responsedetails"];


	$query2 = "select * from master_leads where leadcode = '$leadcode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 != 0)
	{
		$query1 = "update master_leads set leadcode = '$leadcode', customername = '$customername', 
		contactperson = '$contactperson', city = '$city', state = '$state', pincode = '$pincode', country = '$country', 
		emailid = '$emailid', phonenumber = '$phonenumber', mobilenumber = '$mobilenumber', leaddate = '$leaddate', 
		leadassignedto = '$leadassignedto', leadcategoryname = '$leadcategoryname', leadstatusname = '$leadstatusname', 
		leadsourcename = '$leadsourcename', customerbudget = '$customerbudget',	leadactiontobetaken = '$leadactiontobetaken', 
		leadactionpriority = '$leadactionpriority', leaddetails = '$leaddetails', leadsubject = '$leadsubject', 
		leadapprovalstatus = '$leadstatusname', remarks = '$remarks', leadlostreasonname = '$leadlostreasonname', 
		username = '$username', recordstatus = '$recordstatus', ipaddress = '$ipaddress', leadstagename = '$leadstagename', 
		where leadcode = '$leadcode' and auto_number = '$leadautonumber'";
		//$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	}
	
	if ($responsedetails != '')
	{
		echo $query3 = "insert into master_leadfollowup (leadautonumber, leadcode, responseby, responsedatetime, responsedetails, 
		recordstatus, username, ipaddress) 
		values ('$leadautonumber', '$leadcode', '$responseby', '$responsedatetime', '$responsedetails', 
		'$recordstatus', '$username', '$ipaddress')";
		$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	}
		
	header ("location:leadupdate1.php?leadanum=$leadautonumber&&st=success");
	
}
else
{
	header ("location:index.php");
}


?>