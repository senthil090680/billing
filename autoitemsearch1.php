<?php
session_start();
//Called from sales1.php - autoitemsearch1.js

include ("db/db_connect.php");
if (isset($_REQUEST["itemsearch"])) { $itemsearch = $_REQUEST["itemsearch"]; } else { $itemsearch = ""; }
//$itemsearch=$_REQUEST[itemsearch];
$searchresult = "";

$query2 = "select * from master_item where itemname like '%$itemsearch%' and status <> 'deleted' order by itemname";// limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
while ($res2 = mysql_fetch_array($exec2))
{
	$itemcode = $res2['itemcode'];
	$itemname = $res2['itemname'];
	$mrp = $res2['rateperunit'];
	$taxanum = $res2['taxanum'];
	$itemdescription = $res2['description'];
	
	//To get default tax values
	if (isset($_REQUEST["defaulttax"])) { $defaulttax = $_REQUEST["defaulttax"]; } else { $defaulttax = ""; }
	//$defaulttax = $_SESSION[defaulttax];
	
	if ($defaulttax == '')
	{
		$query3 = "select * from master_tax where auto_number = '$taxanum'";
	}
	else
	{
		$query3 = "select * from master_tax where auto_number = '$defaulttax'";
		$taxanum = $defaulttax;
	}

	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$taxname = $res3['taxname'];
	$taxpercent = $res3['taxpercent'];
	
	if ($searchresult == '')
	{
		$searchresult = ''.$itemcode.'||'.$itemname.'||'.$mrp.'||'.$taxname.'||'.$taxpercent.'||'.$taxanum.'||'.$itemdescription.'';
	}
	else
	{
		$searchresult = $searchresult.'||^||'.$itemcode.'||'.$itemname.'||'.$mrp.'||'.$taxname.'||'.$taxpercent.'||'.$taxanum.'||'.$itemdescription.'';
	}
	
}

if ($searchresult != '')
{
	echo $searchresult;
}

?>