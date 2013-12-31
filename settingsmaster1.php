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

$stockalertsettings1errmsg = '';
$salesentrytaxcalculationsettings1errmsg = '';
$purchaseentrytaxcalculationsettings1errmsg = '';
$itemcodeprintoutsettings1errmsg = '';
$financialyearsettings1errmsg = '';
$itempricegetsettings1errmsg = '';
$phonenumbersalesprintsettings1errmsg = '';
$salesamountinwordssettings1errmsg = '';
$showcolumnsettings1errmsg = '';
$salesstockupdatesettings1errmsg = '';
$purchasestockupdatesettings1errmsg = '';
$dcstockupdatesettings1errmsg = '';

if (isset($_REQUEST["errno"])) { $errno = $_REQUEST["errno"]; } else { $errno = ""; }
//$errno = $_REQUEST['errno'];
if (isset($_REQUEST["errmodule"])) { $errmodule = $_REQUEST["errmodule"]; } else { $errmodule = ""; }
//$errmodule = $_REQUEST['errmodule'];
if ($errno == 1)
{
	if ($errmodule == 'stockalertsettings1')
	{
		$stockalertsettings1errmsg = "* Stock Alert Settings Update Completed.";
	}
	if ($errmodule == 'salesentrytaxcalculationsettings1')
	{
		$salesentrytaxcalculationsettings1errmsg = "* Sales Entry Tax Calculation Settings Update Completed.";
	}
	if ($errmodule == 'purchaseentrytaxcalculationsettings1')
	{
		$purchaseentrytaxcalculationsettings1errmsg = "* Purchase Entry Tax Calculation Settings Update Completed.";
	}
	if ($errmodule == 'itemcodeprintoutsettings1')
	{
		$itemcodeprintoutsettings1errmsg = "* Item Code Printout Settings Update Completed.";
	}
	if ($errmodule == 'financialyearsettings1')
	{
		$financialyearsettings1errmsg = "* Financial Year Settings Update Completed.";
	}
	if ($errmodule == 'itempricegetsettings1')
	{
		$itempricegetsettings1errmsg = "* Item Price Get Settings Update Completed.";
	}
	if ($errmodule == 'phonenumbersalesprintsettings1') 
	{
		$phonenumbersalesprintsettings1errmsg = "* Phone Number Show Settings Update Completed.";
	}
	if ($errmodule == 'salesamountinwordssettings1settings1') 
	{
		$salesamountinwordssettings1errmsg = "* Amount In Words Show Settings Update Completed.";
	}
	if ($errmodule == 'showcolumnsettings1')
	{
		$showcolumnsettings1errmsg = "* Show Column In Printout Settings Update Completed.";
	}
	if ($errmodule == 'salesstockupdatesettings1')
	{
		$salesstockupdatesettings1errmsg = "* Sales Stock Update Settings Update Completed.";
	}
	if ($errmodule == 'purchasestockupdatesettings1')
	{
		$purchasestockupdatesettings1errmsg = "* Purchase Stock Update Settings Update Completed.";
	}
	if ($errmodule == 'dcstockupdatesettings1')
	{
		$dcstockupdatesettings1errmsg = "* Delivery Challan Stock Update Settings Update Completed.";
	}
}




?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<body>
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top">


      	<form id="stockalertsettings1" name="stockalertsettings1" method="post" action="settingsmaster2.php">
	<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Out Of Stock Alert On Sales Entry - Show Settings </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($stockalertsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $stockalertsettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="36%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Out Of Stock Alert On Sales Entry </strong></td>
          <td width="64%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'SALES' and settingsname = 'SALES_ENTRY_STOCK_ALERT' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="SHOW ALERT">SHOW ALERT</option>
			<option value="HIDE ALERT">HIDE ALERT</option>
			</select>
            <input type="hidden" name="stockalertsettings1" id="stockalertsettings1" value="stockalertsettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">*If SHOW ALERT Enabled, Sales Entry Of Items With Zero Stock Will Not Be Allowed. </td>
          </tr>
      </tbody>
    </table>  
	    </form>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td width="97%" valign="top">
	
	
	<form id="salesentrytaxcalculationsettings1" name="salesentrytaxcalculationsettings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Entry Tax Calculation Settings - Select Reverse or Forward Calculation </strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($salesentrytaxcalculationsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $salesentrytaxcalculationsettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Sales  Entry Tax Calculation </strong></td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue" id="settingsvalue">
                  <?php
			$query1 = "select * from master_settings where modulename = 'SALES' and settingsname = 'SALES_TAX_CALCULATE' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
                  <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                  <?php
			}
			?>
                  <option value="REVERSE CALCULATE">REVERSE CALCULATE</option>
                  <option value="FORWARD CALCULATE">FORWARD CALCULATE</option>
                </select>
                  <input type="hidden" name="salesentrytaxcalculationsettings1" id="salesentrytaxcalculationsettings1" value="salesentrytaxcalculationsettings1" />
                  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Reverse Selected - Tax Will Be Inclusive Of Sales Item Amount. </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Forward Selected - Tax Will Be Exclusive Of Sales Item Amount. </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Sales Settings Are Also Applicable To<strong> Quotation Entry.</strong></td>
            </tr>
          </tbody>
        </table>
    </form>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><form id="purchaseentrytaxcalculationsettings1" name="purchaseentrytaxcalculationsettings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Entry Tax Calculation Settings - Select Reverse or Forward Calculation </strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($purchaseentrytaxcalculationsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $purchaseentrytaxcalculationsettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Purchase  Entry Tax Calculation </strong></td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue" id="settingsvalue">
                  <?php
			$query1 = "select * from master_settings where modulename = 'PURCHASE' and settingsname = 'PURCHASE_TAX_CALCULATE' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
                  <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                  <?php
			}
			?>
                  <option value="REVERSE CALCULATE">REVERSE CALCULATE</option>
                  <option value="FORWARD CALCULATE">FORWARD CALCULATE</option>
                </select>
                  <input type="hidden" name="purchaseentrytaxcalculationsettings1" id="purchaseentrytaxcalculationsettings1" value="purchaseentrytaxcalculationsettings1" />
                  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Reverse Selected - Tax Will Be Inclusive Of Purchase Item Amount. </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Forward Selected - Tax Will Be Exclusive Of Purchase Item Amount. </td>
            </tr>
          </tbody>
        </table>
    </form>	 </td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
      	<form id="itemcodeprintoutsettings1" name="itemcodeprintoutsettings1" method="post" action="settingsmaster2.php">
	<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Item Code Printout  Settings - Select Whether Item Code To Show On Printout </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($itemcodeprintoutsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $itemcodeprintoutsettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Item Code Printout Settings </strong></td>
          <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'PRINTOUT' and settingsname = 'ITEM_CODE_PRINTOUT' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="SHOW ITEM CODE">SHOW ITEM CODE</option>
			<option value="HIDE ITEM CODE">HIDE ITEM CODE</option>
			</select>
            <input type="hidden" name="itemcodeprintoutsettings1" id="itemcodeprintoutsettings1" value="itemcodeprintoutsettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Show Item Code Selected - Item Code Will Appear In All Printouts. </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* If Hide Item Code Selected - Item Code Will Not Appear In All Printouts. </td>
        </tr>
      </tbody>
    </table>  
	    </form>		</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
   	  <form id="financialyearsettings1" name="financialyearsettings1" method="post" action="settingsmaster2.php">
	<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Current Financial Year Settings - Select The Current Financial Year To Make It Default Year </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($financialyearsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $financialyearsettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Current Financial Year Settings </strong></td>
          <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'CURRENT_FINANCIAL_YEAR' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected">FINANCIAL YEAR - <?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="2012">FINANCIAL YEAR - 2012</option>
			<option value="2013">FINANCIAL YEAR - 2013</option>
			<option value="2014">FINANCIAL YEAR - 2014</option>
			<option value="2015">FINANCIAL YEAR - 2015</option>
			<option value="2016">FINANCIAL YEAR - 2016</option>
			<option value="2017">FINANCIAL YEAR - 2017</option>
			<option value="2018">FINANCIAL YEAR - 2018</option>
			<option value="2019">FINANCIAL YEAR - 2019</option>
			<option value="2020">FINANCIAL YEAR - 2020</option>
			</select>
            <input type="hidden" name="financialyearsettings1" id="financialyearsettings1" value="financialyearsettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />		  </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Bill Number Will Be Reset To Number One For Every New Financial Year. </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Have Continuous Bill Number, Do Not Update Financial Year.  </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Bill Number Update Will Be Effective Only For Sales Entry. Not Applicable To Purchase Or Other Entries. </td>
        </tr>
      </tbody>
    </table>  
      </form>	  </td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	<form id="itempricegetsettings1" name="itempricegetsettings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Get Item Price  Settings - Select Price From Master Or Previous Invoice</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($itempricegetsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $itempricegetsettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Item Price Settings </strong></td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
				<select name="settingsvalue" id="settingsvalue">
				<?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'ITEM_PRICE_SETTING' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
				<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
				<?php
				}
				?>
				<option value="GET PRICE FROM ITEM MASTER ENTRY">GET PRICE FROM ITEM MASTER ENTRY</option>
				<option value="GET PRICE FROM PREVIOUS INVOICE">GET PRICE FROM PREVIOUS INVOICE</option>
				</select>
				<input type="hidden" name="itempricegetsettings1" id="itempricegetsettings1" value="itempricegetsettings1" />
				<input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />				  </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Get Item Price From Masters - Select Get Price From Item Master Entry </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Get Item Price From Previous Invoices - Select Get Price From Previous Invoice </td>
            </tr>
          </tbody>
        </table>
    </form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	
	<form id="phonenumbersalesprintsettings1" name="phonenumbersalesprintsettings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Show Customer Phone Number On Sales Printout   Settings</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($phonenumbersalesprintsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $phonenumbersalesprintsettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Customer Phone No. On Sales Print  </strong></td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			  <select name="settingsvalue" id="settingsvalue">
                  <?php
				$query1 = "select * from master_settings where modulename = 'SALES' and settingsname = 'PHONE_NUMBER_SALES_PRINT_SETTING' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                  <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                  <?php
				}
				?>
                  <option value="SHOW PHONE NUMBER ON SALES PRINTOUT">SHOW PHONE NUMBER ON SALES PRINTOUT</option>
                  <option value="HIDE PHONE NUMBER ON SALES PRINTOUT">HIDE PHONE NUMBER ON SALES PRINTOUT</option>
                </select>
                  <input type="hidden" name="phonenumbersalesprintsettings1" id="phonenumbersalesprintsettings1" value="phonenumbersalesprintsettings1" />
                  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Show Phone Number On Sales Printout - Select Show Phone Number </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Hide Phone Number On Sales Printout - Select Hide Phone Number </td>
            </tr>
          </tbody>
        </table>
    </form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	
	<form id="salesamountinwordssettings1" name="salesamountinwordssettings1settings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Show Amont In Words As Bold Text In Sales Printout   Settings</strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($salesamountinwordssettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $salesamountinwordssettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Show Amount In Words As Bold  </strong></td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			  <select name="settingsvalue" id="settingsvalue">
                  <?php
				$query1 = "select * from master_settings where modulename = 'SALES' and settingsname = 'AMOUNT_IN_WORDS_SALES_PRINT_SETTING' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                  <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                  <?php
				}
				?>
                  <option value="SALES AMOUNT IN WORDS AS BOLD TEXT">SALES AMOUNT IN WORDS AS BOLD TEXT</option>
                  <option value="SALES AMOUNT IN WORDS AS NORMAL TEXT">SALES AMOUNT IN WORDS AS NORMAL TEXT</option>
                </select>
                  <input type="hidden" name="salesamountinwordssettings1settings1" id="salesamountinwordssettings1settings1" value="salesamountinwordssettings1settings1" />
                  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Show Amount In Words Bold - Select Show Sales Amount In Words Bold Text </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Show Amount In Words Normal - Select Show Sales Amount In Words Normal Text </td>
            </tr>
          </tbody>
        </table>
    </form>
	
	
	
	</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	<form id="showcolumnsettings1" name="showcolumnsettings1" method="post" action="settingsmaster2.php">
        <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Show Column In Printout   Settings - Select Respective Columns To Show On Printouts </strong></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($showcolumnsettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $showcolumnsettings1errmsg; ?>&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Rate Column Settings </strong></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue1" id="settingsvalue1">
                  <?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_RATE' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                  <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                  <?php
				}
				?>
                  <option value="SHOW COLUMN RATE">SHOW COLUMN RATE</option>
                  <option value="HIDE COLUMN RATE">HIDE COLUMN RATE</option>
                </select></td>
            </tr>
            <tr>
              <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Quantity Column Settings </strong></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue2" id="settingsvalue2">
                <?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_QUANTITY' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                <?php
				}
				?>
                <option value="SHOW COLUMN QUANTITY">SHOW COLUMN QUANTITY</option>
                <option value="HIDE COLUMN QUANTITY">HIDE COLUMN QUANTITY</option>
              </select></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Unit Column Settings </strong></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue3" id="settingsvalue3">
                <?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_UNIT' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                <?php
				}
				?>
                <option value="SHOW COLUMN UNIT">SHOW COLUMN UNIT</option>
                <option value="HIDE COLUMN UNIT">HIDE COLUMN UNIT</option>
              </select></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Tax Column Settings </strong></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue4" id="settingsvalue4">
                <?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_TAX' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                <?php
				}
				?>
                <option value="SHOW COLUMN TAX">SHOW COLUMN TAX</option>
                <option value="HIDE COLUMN TAX">HIDE COLUMN TAX</option>
              </select></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Discount Column Settings </strong></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><select name="settingsvalue5" id="settingsvalue5">
                <?php
				$query1 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'SHOW_COLUMN_DISCOUNT' 
				and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$res1settingsvalue = $res1['settingsvalue'];
				?>
                <option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
                <?php
				}
				?>
                <option value="SHOW COLUMN DISCOUNT">SHOW COLUMN DISCOUNT</option>
                <option value="HIDE COLUMN DISCOUNT">HIDE COLUMN DISCOUNT</option>
              </select></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="showcolumnsettings1" id="showcolumnsettings1" value="showcolumnsettings1" />
              <input type="submit" name="Submit2" value="Submit" style="border: 1px solid #001E6A" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* To Show or Hide Columns On Printouts. </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Applicable To Sales / Sales Return / Quotation / Proforma Invoice </td>
            </tr>
          </tbody>
        </table>
    </form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
      	<form id="salesstockupdatesettings1" name="salesstockupdatesettings1" method="post" action="settingsmaster2.php">
	<!--<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Stock Update Settings - Select Whether Stock Update Required On Sales Entry </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($salesstockupdatesettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $salesstockupdatesettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Sales Stock Update  Settings </strong></td>
          <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'STOCK' and settingsname = 'SALES_STOCK_UPDATE' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="SALES WITH STOCK UPDATE">SALES WITH STOCK UPDATE</option>
			<option value="SALES WITHOUT STOCK UPDATE">SALES WITHOUT STOCK UPDATE</option>
			</select>
            <input type="hidden" name="salesstockupdatesettings1" id="salesstockupdatesettings1" value="salesstockupdatesettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Sales With Stock - Stock Will Be Updated On Sales Entry. </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Sales Without Stock - Stock Will Not Be Updated On Sales Entry. </td>
        </tr>
      </tbody>
    </table>-->  
	    </form>		</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
      	<form id="purchasestockupdatesettings1" name="purchasestockupdatesettings1" method="post" action="settingsmaster2.php">
	<!--<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Stock Update Settings - Select Whether Stock Update Required On Purchase Entry </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($purchasestockupdatesettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $purchasestockupdatesettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Purchase Stock Update   </strong></td>
          <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'STOCK' and settingsname = 'PURCHASE_STOCK_UPDATE' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="PURCHASE WITH STOCK UPDATE">PURCHASE WITH STOCK UPDATE</option>
			<option value="PURCHASE WITHOUT STOCK UPDATE">PURCHASE WITHOUT STOCK UPDATE</option>
			</select>
            <input type="hidden" name="purchasestockupdatesettings1" id="purchasestockupdatesettings1" value="purchasestockupdatesettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Purchase With Stock - Stock Will Be Updated On Purchase.</td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Purchase Without Stock - Stock Will Not Be Updated On Purchase Entry. </td>
        </tr>
      </tbody>
    </table>-->  
	    </form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	
      	<form id="dcstockupdatesettings1" name="dcstockupdatesettings1" method="post" action="settingsmaster2.php">
	<!--<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>DC Stock Update Settings - Select Whether Stock Update Required On Delivery Challan Entry </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($dcstockupdatesettings1errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $dcstockupdatesettings1errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td width="35%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>DC Stock Update  Settings </strong></td>
          <td width="65%" align="left" valign="top"  bgcolor="#FFFFFF">
			<select name="settingsvalue" id="settingsvalue">
			<?php
			$query1 = "select * from master_settings where modulename = 'STOCK' and settingsname = 'DC_STOCK_UPDATE' 
			and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$res1settingsvalue = $res1['settingsvalue'];
			?>
			<option value="<?php echo $res1settingsvalue; ?>" selected="selected"><?php echo $res1settingsvalue; ?></option>
			<?php
			}
			?>
			<option value="DC WITH STOCK UPDATE">DC WITH STOCK UPDATE</option>
			<option value="DC WITHOUT STOCK UPDATE">DC WITHOUT STOCK UPDATE</option>
			</select>
            <input type="hidden" name="dcstockupdatesettings1" id="dcstockupdatesettings1" value="dcstockupdatesettings1" />
          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Delivery Challan With Stock - Stock Will Be Updated On Delivery Challan Entry. </td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">* Delivery Challan Without Stock - Stock Will Not Be Updated On Delivery Challan Entry. </td>
        </tr>
      </tbody>
    </table>-->  
	    </form>		</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>