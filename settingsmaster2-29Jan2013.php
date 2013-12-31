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
$companycode = $_SESSION['companycode'];

if (isset($_REQUEST["settingsvalue"])) { $settingsvalue = $_REQUEST["settingsvalue"]; } else { $settingsvalue = ""; }
//$settingsvalue = $_POST['settingsvalue'];

if (isset($_REQUEST["settingsvalue1"])) { $settingsvalue1 = $_REQUEST["settingsvalue1"]; } else { $settingsvalue1 = ""; }
//$settingsvalue = $_POST['settingsvalue'];
if (isset($_REQUEST["settingsvalue2"])) { $settingsvalue2 = $_REQUEST["settingsvalue2"]; } else { $settingsvalue2 = ""; }
//$settingsvalue = $_POST['settingsvalue'];
if (isset($_REQUEST["settingsvalue3"])) { $settingsvalue3 = $_REQUEST["settingsvalue3"]; } else { $settingsvalue3 = ""; }
//$settingsvalue = $_POST['settingsvalue'];
if (isset($_REQUEST["settingsvalue4"])) { $settingsvalue4 = $_REQUEST["settingsvalue4"]; } else { $settingsvalue4 = ""; }
//$settingsvalue = $_POST['settingsvalue'];
if (isset($_REQUEST["settingsvalue5"])) { $settingsvalue5 = $_REQUEST["settingsvalue5"]; } else { $settingsvalue5 = ""; }
//$settingsvalue = $_POST['settingsvalue'];

if (isset($_REQUEST["stockalertsettings1"])) { $stockalertsettings1 = $_REQUEST["stockalertsettings1"]; } else { $stockalertsettings1 = ""; }
//$stockalertsettings1 = $_REQUEST['stockalertsettings1'];
if ($stockalertsettings1 == 'stockalertsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SALES' and settingsname = 'SALES_ENTRY_STOCK_ALERT' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=stockalertsettings1");
}

if (isset($_REQUEST["salesentrytaxcalculationsettings1"])) { $salesentrytaxcalculationsettings1 = $_REQUEST["salesentrytaxcalculationsettings1"]; } else { $salesentrytaxcalculationsettings1 = ""; }
//$salesentrytaxcalculationsettings1 = $_REQUEST['salesentrytaxcalculationsettings1'];
if ($salesentrytaxcalculationsettings1 == 'salesentrytaxcalculationsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SALES' and settingsname = 'SALES_TAX_CALCULATE' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=salesentrytaxcalculationsettings1");
}

if (isset($_REQUEST["purchaseentrytaxcalculationsettings1"])) { $purchaseentrytaxcalculationsettings1 = $_REQUEST["purchaseentrytaxcalculationsettings1"]; } else { $purchaseentrytaxcalculationsettings1 = ""; }
//$purchaseentrytaxcalculationsettings1 = $_REQUEST['purchaseentrytaxcalculationsettings1'];
if ($purchaseentrytaxcalculationsettings1 == 'purchaseentrytaxcalculationsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'PURCHASE' and settingsname = 'PURCHASE_TAX_CALCULATE' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=purchaseentrytaxcalculationsettings1");
}

if (isset($_REQUEST["itemcodeprintoutsettings1"])) { $itemcodeprintoutsettings1 = $_REQUEST["itemcodeprintoutsettings1"]; } else { $itemcodeprintoutsettings1 = ""; }
//$itemcodeprintoutsettings1 = $_REQUEST['itemcodeprintoutsettings1'];
if ($itemcodeprintoutsettings1 == 'itemcodeprintoutsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'PRINTOUT' and settingsname = 'ITEM_CODE_PRINTOUT' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=itemcodeprintoutsettings1");
}

if (isset($_REQUEST["financialyearsettings1"])) { $financialyearsettings1 = $_REQUEST["financialyearsettings1"]; } else { $financialyearsettings1 = ""; }
//$financialyearsettings1 = $_REQUEST['financialyearsettings1'];
if ($financialyearsettings1 == 'financialyearsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'CURRENT_FINANCIAL_YEAR' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$_SESSION['financialyear'] = $settingsvalue;
	header ("location:settingsmaster1.php?errno=1&&errmodule=financialyearsettings1");
	//header ("location:logout1.php");
}

if (isset($_REQUEST["financialyearsettings1"])) { $financialyearsettings1 = $_REQUEST["financialyearsettings1"]; } else { $financialyearsettings1 = ""; }
//$financialyearsettings1 = $_REQUEST['financialyearsettings1'];
if ($financialyearsettings1 == 'financialyearsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'CURRENT_FINANCIAL_YEAR' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	
	$_SESSION['financialyear'] = $settingsvalue;
	header ("location:settingsmaster1.php?errno=1&&errmodule=financialyearsettings1");
	//header ("location:logout1.php");
}

if (isset($_REQUEST["itempricegetsettings1"])) { $itempricegetsettings1 = $_REQUEST["itempricegetsettings1"]; } else { $itempricegetsettings1 = ""; }
//$salesstockupdatesettings1 = $_REQUEST['salesstockupdatesettings1'];
if ($itempricegetsettings1 == 'itempricegetsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'ITEM_PRICE_SETTING' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=itempricegetsettings1");
}


if (isset($_REQUEST["showcolumnsettings1"])) { $showcolumnsettings1 = $_REQUEST["showcolumnsettings1"]; } else { $showcolumnsettings1 = ""; }
//$salesstockupdatesettings1 = $_REQUEST['salesstockupdatesettings1'];
if ($showcolumnsettings1 == 'showcolumnsettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue1', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_RATE' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	$query2 = "update master_settings set settingsvalue = '$settingsvalue2', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_QUANTITY' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	$query2 = "update master_settings set settingsvalue = '$settingsvalue3', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_UNIT' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	$query2 = "update master_settings set settingsvalue = '$settingsvalue4', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_TAX' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	$query2 = "update master_settings set settingsvalue = '$settingsvalue5', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_DISCOUNT' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());

	header ("location:settingsmaster1.php?errno=1&&errmodule=showcolumnsettings1");
}

if (isset($_REQUEST["purchasestockupdatesettings1"])) { $purchasestockupdatesettings1 = $_REQUEST["purchasestockupdatesettings1"]; } else { $purchasestockupdatesettings1 = ""; }
//$purchasestockupdatesettings1 = $_REQUEST['purchasestockupdatesettings1'];
if ($purchasestockupdatesettings1 == 'purchasestockupdatesettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'STOCK' and settingsname = 'PURCHASE_STOCK_UPDATE' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=purchasestockupdatesettings1");
}

if (isset($_REQUEST["dcstockupdatesettings1"])) { $dcstockupdatesettings1 = $_REQUEST["dcstockupdatesettings1"]; } else { $dcstockupdatesettings1 = ""; }
//$dcstockupdatesettings1 = $_REQUEST['dcstockupdatesettings1'];
if ($dcstockupdatesettings1 == 'dcstockupdatesettings1')
{
	$query2 = "update master_settings set settingsvalue = '$settingsvalue', ipaddress = '$ipaddress', username = '$username' 
	where modulename = 'STOCK' and settingsname = 'DC_STOCK_UPDATE' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:settingsmaster1.php?errno=1&&errmodule=dcstockupdatesettings1");
}


?>