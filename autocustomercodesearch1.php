<?php
session_start();
include ("db/db_connect.php");

if (isset($_REQUEST["customersearch"])) { $customersearch = $_REQUEST["customersearch"]; } else { $customersearch = ""; }
$searchresult = "";

$query2 = "select * from master_customer where customername like '%$customersearch%' and status <> 'deleted' order by customername";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
	$customercode = $res2["customercode"];
	$customername = $res2["customername"];
	$address1 = $res2["address1"];
	$area = $res2["area"];
	$city = $res2["city"];
	$pincode = $res2["pincode"];
	$tinnumber = $res2["tinnumber"];
	$cstnumber = $res2["cstnumber"];
	
	if ($searchresult == '')
	{
		$searchresult = ''.$customercode.'||'.$customername.'||'.$address1.'||'.$area.'||'.$city.'||'.$pincode.'||'.$tinnumber.'||'.$cstnumber.'';
	}
	else
	{
		$searchresult = $searchresult.'||^||'.$customercode.'||'.$customername.'||'.$address1.'||'.$area.'||'.$city.'||'.$pincode.'||'.$tinnumber.'||'.$cstnumber.'';
	}
	
}

if ($searchresult != '')
{
	echo $searchresult;
}

?>