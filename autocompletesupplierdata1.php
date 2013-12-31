<?php
session_start();
include ("db/db_connect.php");

if (isset($_REQUEST["suppliercode"])) { $suppliercode = $_REQUEST["suppliercode"]; } else { $suppliercode = ""; }

$query2 = "select * from master_supplier where suppliercode = '$suppliercode'";// and supplierstatus = 'Active'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2anum = $res2['auto_number'];
$suppliername = $res2['suppliername'];
$address1 = $res2['address1'];
$address2 = $res2['address2'];
$city = $res2['city'];
$state = $res2['state'];
$pincode = $res2['pincode'];
$tinnumber = $res2['tinnumber'];
$cstnumber = $res2['cstnumber'];

$query3 = "select * from master_contact_supplier where suppliercode = '$suppliercode'";// and supplierstatus = 'Active'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
$res3 = mysql_fetch_array($exec3);
$res3anum = $res3['auto_number'];
$title1 = $res3['title1'];
$contactperson1 = $res3['contactperson1'];
$designation1 = $res3['designation1'];
$department1 = $res3['department1'];

if ($res2anum != '')
{
	echo $suppliercode.'||'.$suppliername.'||'.$address1.'||'.$address2.'||'.$city.'||'.$state.'||'.$pincode.'||'.$title1.'||'.$contactperson1.'||'.$designation1.'||'.$department1.'||'.$res2anum.'||'.$tinnumber.'||'.$cstnumber;
}


?>