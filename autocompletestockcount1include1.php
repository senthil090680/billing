<?php
//WARNING//
//*****************************************************************
//This file is called as file_get_contents from autoitemsearch2.php
//*****************************************************************

$totalpurchase = "";
$totalpurchasereturn = "";
$totalsales = "";
$totalsalesreturn = "";
$totaldccustomer = "";
$totaldcsupplier = "";
$totalsumadjustmentadd = "";
$totalsumadjustmentminus = "";


$query1 = "select * from master_item where itemcode = '$itemcode'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$res1itemcode = $res1['itemcode'];
$res1itemname = $res1['itemname'];

$query1 = "select sum(quantity) as sumsales from sales_details where itemcode = '$itemcode' and  recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalsales = $res1['sumsales'];

$query1 = "select sum(quantity) as sumsalesreturn from salesreturn_details where itemcode = '$itemcode' and  recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalsalesreturn = $res1['sumsalesreturn'];

$query1 = "select sum(quantity) as sumpurchase from purchase_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalpurchase = $res1['sumpurchase'];

$query1 = "select sum(quantity) as sumpurchasereturn from purchasereturn_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalpurchasereturn = $res1['sumpurchasereturn'];

$query1 = "select sum(quantity) as sumdccustomer from dccustomer_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totaldccustomer = $res1['sumdccustomer'];

$query1 = "select sum(quantity) as sumdccustomerinward from dccustomerinward_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totaldccustomerinward = $res1['sumdccustomerinward'];

$query1 = "select sum(quantity) as sumdcsupplier from dcsupplier_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totaldcsupplier = $res1['sumdcsupplier'];

$query1 = "select sum(quantity) as sumdcsupplieroutward from dcsupplieroutward_details where itemcode = '$itemcode' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totaldcsupplieroutward = $res1['sumdcsupplieroutward'];
			
$query1 = "select sum(quantity) as sumadjustmentadd from master_stock where itemcode = '$itemcode' and 
transactionmodule = 'ADJUSTMENT' and transactionparticular = 'BY ADJUSTMENT ADD' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalsumadjustmentadd = $res1['sumadjustmentadd'];

$query1 = "select sum(quantity) as sumadjustmentminus from master_stock where itemcode = '$itemcode' and 
transactionmodule = 'ADJUSTMENT' and transactionparticular = 'BY ADJUSTMENT MINUS' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$totalsumadjustmentminus = $res1['sumadjustmentminus'];

$currentstock = $totalpurchase;
$currentstock = $currentstock - $totalpurchasereturn;
$currentstock = $currentstock - $totalsales;
$currentstock = $currentstock + $totalsalesreturn;
$currentstock = $currentstock - $totaldccustomer;
$currentstock = $currentstock + $totaldccustomerinward;
$currentstock = $currentstock + $totaldcsupplier;
$currentstock = $currentstock - $totaldcsupplieroutward;
$currentstock = $currentstock + $totalsumadjustmentadd;
$currentstock = $currentstock - $totalsumadjustmentminus;

?>