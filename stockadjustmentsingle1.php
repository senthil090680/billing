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
$errmsg = "";
$bgcolorcode = '';

//To populate the autocompetelist_services1.js
include ("autocompletebuild_item1.php");

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{
	$itemcode = $_REQUEST['selecteditemcode'];
	$adjustmentdate = $_REQUEST['ADate1'];
	$itemquantity = $_REQUEST['adjustmentquantity'];
	$adjustmenttype = $_REQUEST['adjustmenttype'];
	if ($adjustmenttype == 'ADJUSTMENT ADD')
	{
		$transactionparticular = 'BY ADJUSTMENT ADD';
	}
	else if ($adjustmenttype == 'ADJUSTMENT MINUS')
	{
		$transactionparticular = 'BY ADJUSTMENT MINUS';
	}
	//$stockparticulars = 'INWARD';
	$remarks = $_REQUEST['stockremarks'];
	
	$query40 = "select * from master_item where itemcode = '$itemcode'";
	$exec40 = mysql_query($query40) or die ("Error in Query40".mysql_error());
	$res40 = mysql_fetch_array($exec40);
	$itemname = $res40['itemname'];
	$itemmrp = $res40['rateperunit'];
	
	$itemsubtotal = $itemmrp * $itemquantity;
	
			
	$query41 = "insert into master_stock (itemcode, itemname, transactiondate, transactionmodule, 
	transactionparticular, billautonumber, billnumber, quantity, remarks, 
	customercode, customername, suppliercode, suppliername, username, ipaddress, rateperunit, totalrate, companyanum, companyname)  
	values ('$itemcode', '$itemname', '$adjustmentdate', 'ADJUSTMENT', 
	'$transactionparticular', '$billautonumber', '$billnumber', '$itemquantity', '$remarks', 
	'$customercode', '$customername', '$suppliercode', '$suppliername', '$username', '$ipaddress', '$itemmrp', '$itemsubtotal', '$companyanum', '$companyname')";
	$res41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	
	header ("location:stockadjustmentsingle1.php?st=1");
	exit;
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == '1')
{
	$errmsg = "Stock Adjustment Update Completed.";
	$bgcolorcode = 'failed';
}






?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
-->
</style>
<!--
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
-->
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<!--<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />-->
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<?php include ("js/dropdownlist1scripting1stock1.php"); ?>
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/autosuggest1itemstock1.js"></script>
<script type="text/javascript" src="js/autocomplete_item1.js"></script>
<script type="text/javascript" src="js/stockcount1.js"></script>

<!--<script type="text/javascript" src="js/adddate.js"></script>-->
<!--<script type="text/javascript" src="js/adddate2.js"></script>-->
<script type="text/javascript">

function cashentryonfocus1()
{
	if (document.getElementById("adjustmentquantity").value == "0.00")
	{
		document.getElementById("adjustmentquantity").value = "";
		document.getElementById("adjustmentquantity").focus();
	}
}

function stockinwardvalidation1()
{
	
	if (document.stockinward.selecteditemcode.value == "")
	{
		alert ("Please Select Item Name.")
		return false;
	}
	else if (document.stockinward.adjustmentquantity.value == "")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (isNaN(document.stockinward.adjustmentquantity.value))
	{
		alert ("Please Enter Only Numbers Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (document.stockinward.adjustmentquantity.value == "0")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (document.stockinward.adjustmentquantity.value == "0.0")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (document.stockinward.adjustmentquantity.value == "0.00")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (document.stockinward.adjustmentquantity.value == "0.000")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.adjustmentquantity.focus();
		return false;
	}
	else if (document.stockinward.adjustmenttype.value == "")
	{
		alert ("Please Enter Adjustment Type.")
		document.stockinward.adjustmenttype.focus();
		return false;
	}
	/*
	else if (document.stockinward.remarks.value == "")
	{
		alert ("Please Enter Remarks.")
		document.stockinward.remarks.focus();
		return false;
	}
	*/

}


function itemcodeentry2()
{
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}
	
	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		//itemcodeentry1();
		return false;
	}
	else
	{
		return true;
	}
}




</script>

<script src="js/datetimepicker_css.js"></script>

<body onLoad="return funcCustomerDropDownSearch1();">
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
	
	<form name="stockinward" action="stockadjustmentsingle1.php" method="post" onKeyDown="return disableEnterKey()">
	<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="900" 
            align="left" border="0">
      <tbody id="foo">
        <tr>
          <td colspan="2" bgcolor="#cccccc" class="bodytext31"><strong>Stock - Adjustment Entry </strong></td>
          </tr>
        <tr>
          <td colspan="2" align="left" valign="center"  
                 bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext31"><?php echo $errmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Search  Item Code </strong></td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<input name="searchitemcode" type="text" id="searchitemcode" style="border: 1px solid #001E6A; text-align:left" size="15" autocomplete="off">
				<input name="searchbutton1" type="button" id="searchbutton1" onClick="return itemcodesearch2()" style="border: 1px solid #001E6A" value="Search Item Code" /></td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Search  Item Name </strong></td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<input name="itemname" type="text" id="itemname" style="border: 1px solid #001E6A; text-align:left" size="50" autocomplete="off">
            <input name="searchbutton12" type="button" id="searchbutton12" onClick="return itemcodesearch3()" style="border: 1px solid #001E6A" value="Search Item Name" /></td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Select Item Name </strong></td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<select name="itemcode" id="itemcode" onChange="return itemcodesearch1()">
				<option selected="selected" value="">Select Item Name</option>
				<?php
				$query42 = "select itemcode, itemname from master_item where status <> 'deleted' order by itemname";
				$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
				while ($res42 = mysql_fetch_array($exec42))
				{
				$itemcode = $res42['itemcode'];
				$itemname = $res42['itemname'];
				?>
				<option value="<?php echo $itemcode; ?>"><?php echo $itemcode.' - '.$itemname; ?></option>
				<?php
				}
				?>
			    </select>				</td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong><!--Selected Item Name -->Code / Name </strong></td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<input name="selecteditemcode" type="text" id="selecteditemcode" style="border: 1px solid #001E6A; text-align:left" size="15" readonly="readonly">
            <input name="selecteditemname" type="text" id="selecteditemname" style="border: 1px solid #001E6A; text-align:left" size="50" readonly="readonly"></td>
        </tr>
        <tr>
          <td width="92" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Current Stock</strong></td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">
				<input name="currentstock" id="currentstock" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:left" value="" size="15" readonly="readonly" /></td>
          </tr>
        <script language="javascript">

function disableEnterKey()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
	
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}
	
	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		return false;
	}
	else
	{
		return true;
	}
	

}


function process1rateperunit()
{
	servicenameonchange1();
}



    </script>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><strong>Adjustment Date</strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo substr($updatedatetime, 0, 10); ?>"  size="15"  readonly="readonly" onKeyDown="return disableEnterKey()" />
            <!--<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>-->			</td>
          </tr>
        <tr>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><strong> Adjustment Qty </strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="adjustmentquantity" type="text" id="adjustmentquantity" onClick="return cashentryonfocus1()" style="border: 1px solid #001E6A; text-align:left" value="0.00" size="15"></td>
        </tr>
        <tr>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><strong>Adjustment Type </strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <select name="adjustmenttype" id="adjustmenttype">
		  <option value="">Select Adjustment Type</option>
		  <option value="ADJUSTMENT ADD">ADD TO CURRENT STOCK</option>
		  <option value="ADJUSTMENT MINUS">MINUS FROM CURRENT STOCK</option>
          </select>          </td>
        </tr>
        <tr>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><strong>Remarks</strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="remarks" type="text" id="remarks" style="border: 1px solid #001E6A; text-align:left" size="50"></td>
        </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="resetbutton2" type="submit" id="resetbutton2" onClick="return stockinwardvalidation1()"  style="border: 1px solid #001E6A" value="Update Stock" />
		  <input name="resetbutton22" type="reset" id="resetbutton22" style="border: 1px solid #001E6A" value="Reset Values" /></td>
          </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
          </tr>
      </tbody>
    </table>
	<input type="hidden" name="frmflag1" value="frmflag1" id="frmflag1">
    </form>
	
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>