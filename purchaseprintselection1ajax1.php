<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];

$serialnumber = "";
$itemcount1 = "";
$totalcountlines1  = "";

$startlength = 0;
$showlength = 1200;

$billnumber = $_REQUEST["billnumber"];
//echo $billnumber;
$randomnumber = date('YmdHis');
	
$query5 = "TRUNCATE TABLE purchase_print_dump";
$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());

$query3 = "select * from master_purchase where billnumber = '$billnumber' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";// and financialyear = '$financialyear'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
$res3 = mysql_fetch_array($exec3);
//print_r($res3);
$res3anum = $res3["auto_number"];
$billdate = $res3["billdate"];

$query4 = "select * from purchase_details where bill_autonumber = '$res3anum' and recordstatus <> 'DELETED' and companyanum = '$companyanum' order by auto_number";// and financialyear = '$financialyear'";
$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
while ($res4 = mysql_fetch_array($exec4))
{
	$serialnumber = $serialnumber + 1;
	$billautonumber = $res4["bill_autonumber"];
	$companyanum = $res4["companyanum"];
	$billnumber = $res4["billnumber"];
	$itemanum = $res4["itemanum"];
	$itemcode = $res4["itemcode"];
	$itemname = $res4["itemname"];
	$itemdescription = $res4["itemdescription"];
	$rate = $res4["rate"];
	$quantity = $res4["quantity"];
	$subtotal = $res4["subtotal"];
	$free = $res4["free"];
	$discountpercentage = $res4["discountpercentage"];
	$discountrupees = $res4["discountrupees"];
	$openingstock = $res4["openingstock"];
	$closingstock = $res4["closingstock"];
	$totalamount = $res4["totalamount"];
	$discountamount = $res4["discountamount"];
	$username = $res4["username"];
	$itemtaxpercentage = $res4["itemtaxpercentage"];
	$itemtaxamount = $res4["itemtaxamount"];
	$unit_abbreviation = $res4["unit_abbreviation"];
		
	$itemcount1 = $itemcount1 + 1;
	$countlines1 = substr_count($itemdescription, "\n");
	$countlines1 = $countlines1 + 1; //To adjust even if description is not given, to increment line count
	$totalcountlines1 = $totalcountlines1 + $countlines1;	
	
	//echo '<br><br>'.
	//Insert except item description.
	$query6 = "insert into purchase_print_dump (serialnumber, bill_autonumber, companyanum, 
	billnumber, itemanum, itemcode, itemname, itemdescription, rate, quantity, 
	subtotal, free, discountpercentage, discountrupees, openingstock, closingstock, totalamount, 
	discountamount, username, ipaddress, entrydate, itemtaxpercentage, itemtaxamount, unit_abbreviation, financialyear) 
	values ('$serialnumber', '$billautonumber', '$companyanum', '$billnumber', '$itemanum', '$itemcode', '$itemname', '', '$rate', '$quantity', 
	'$subtotal', '$free', '$discountpercentage', '$discountrupees', '$openingstock', '$closingstock', 
	'$totalamount', '$discountamount', '$username', '$ipaddress', '$billdate', 
	'$itemtaxpercentage', '$itemtaxamount', '$unit_abbreviation', '$financialyear')";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	
	//echo '<br><br>';
	$itemdescriptionarray = explode("\n", $itemdescription);
	//print_r($itemdescriptionarray);
	$itemdescriptionarraycount = count($itemdescriptionarray);
	for ($i=0;$i<$itemdescriptionarraycount;$i++)
	{
		$itemdescriptionvalue = $itemdescriptionarray[$i];
		//$itemdescriptionvalue = ereg_replace("<br />", "", $itemdescriptionvalue);
		//echo '<br><br>'.
		$query7 = "insert into purchase_print_dump (bill_autonumber, companyanum, itemdescription, financialyear) 
		values ('$billautonumber', '$companyanum', '$itemdescriptionvalue', '$financialyear')";
		$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	}

	
	$countlines1 = '';
	$billautonumber = '';
	$companyanum = '';
	$billnumber = '';
	$itemanum = '';
	$itemcode = '';
	$itemname = '';
	$itemdescription = '';
	$rate = '';
	$quantity = '';
	$subtotal = '';
	$free = '';
	$discountpercentage = '';
	$discountrupees = '';
	$openingstock = '';
	$closingstock = '';
	$totalamount = '';
	$discountamount = '';
	$username = '';
	$itemtaxpercentage = '';
	$itemtaxamount = '';
	$unit = '';
	
}
//echo $serialnumber;
//echo $totalcountlines1;

$totalcountlines1 = $totalcountlines1 + $itemcount1 + 1;
//echo $totalcountlines1;
$totalpages = $totalcountlines1 / 24;
//$totalpages = floor($totalpages);
$totalpages = round($totalpages);
//echo $lastpageitemcount = $totalcountlines1 % 18;
//echo $totalpages + 1;
echo $totalpages;

?>