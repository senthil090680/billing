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

//To populate the autocompetelist_services1.js
include ("autocompletebuild_item1.php");

$transactiondatefrom = date('Y-m-d', strtotime('-1 week'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["ADate1"])) { $ADate1 = $_REQUEST["ADate1"]; } else { $ADate1 = ""; }
if (isset($_REQUEST["ADate2"])) { $ADate2 = $_REQUEST["ADate2"]; } else { $ADate2 = ""; }

if ($ADate1 != '' && $ADate2 != '')
{
	$transactiondatefrom = $_REQUEST['ADate1'];
	$transactiondateto = $_REQUEST['ADate2'];
}
else
{
	$transactiondatefrom = date('Y-m-d', strtotime('-1 week'));
	$transactiondateto = date('Y-m-d');
}

if (isset($_REQUEST["itemcode"])) { $itemcode = $_REQUEST["itemcode"]; } else { $itemcode = ""; }
//$itemcode = $_REQUEST['itemcode'];
if (isset($_REQUEST["servicename"])) { $servicename = $_REQUEST["servicename"]; } else { $servicename = ""; }
//$servicename = $_REQUEST['servicename'];

if ($servicename == '') $servicename = 'ALL';

if (isset($_REQUEST["searchoption1"])) { $searchoption1 = $_REQUEST["searchoption1"]; } else { $searchoption1 = ""; }
//$searchoption1 = $_REQUEST['searchoption1'];

if (isset($_REQUEST["itemcode"])) { $itemcode = $_REQUEST["itemcode"]; } else { $itemcode = ""; }
//$itemcode = $_REQUEST['itemcode'];
if (isset($_REQUEST["itemname"])) { $searchitemname = $_REQUEST["itemname"]; } else { $searchitemname = ""; }
//$searchitemname = $_REQUEST['itemname'];
if ($searchitemname != '')
{
	$arraysearchitemname = explode('||', $searchitemname);
	$itemcode = $arraysearchitemname[0];
	$itemcode = trim($itemcode);
	$searchoption1 = 'DETAILED';
}
//echo $searchoption1;

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
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>
</head>
<script language="javascript">

</script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<?php include ("js/dropdownlist1scripting1stock1.php"); ?>
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/autosuggest1itemstock2.js"></script>
<script type="text/javascript" src="js/autocomplete_item1.js"></script>
<script type="text/javascript">


function process1()
{
	if (document.stockinward.searchoption1.value == "")
	{
		alert ("Please Select Search Option.")
		return false;
	}
}

function stockinwardvalidation1()
{
	
/*	if (document.stockinward.itemcode.value == "")
	{
		alert ("Please Select Item Name.")
		return false;
	}
	else if (document.stockinward.servicename.value == "")
	{
		alert ("Please Select Item Name.")
		document.stockinward.servicename.focus();
		return false;
	}
	else if (document.stockinward.stockquantity.value == "")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.stockquantity.focus();
		return false;
	}
	else if (isNaN(document.stockinward.stockquantity.value))
	{
		alert ("Please Enter Only Numbers Stock Quantity.")
		document.stockinward.stockquantity.focus();
		return false;
	}
	else if (document.stockinward.stockquantity.value == "0")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.stockquantity.focus();
		return false;
	}
	else if (document.stockinward.stockquantity.value == "0.0")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.stockquantity.focus();
		return false;
	}
	else if (document.stockinward.stockquantity.value == "0.00")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.stockquantity.focus();
		return false;
	}
	else if (document.stockinward.stockquantity.value == "0.000")
	{
		alert ("Please Enter Stock Quantity.")
		document.stockinward.stockquantity.focus();
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
<table width="2000" border="0" cellspacing="0" cellpadding="2">
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
    <td width="1%" rowspan="3">&nbsp;</td>
    <td width="1%" rowspan="3" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		
			<form name="stockinward" action="stockreportbydate1.php" method="post" onKeyDown="return disableEnterKey()" onSubmit="return process1()">
	<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="800" 
            align="left" border="0">
      <tbody id="foo">
        <tr>
          <td colspan="5" bgcolor="#cccccc" class="bodytext31"><strong>Stock - Report By Date</strong></td>
          </tr>
        <tr>
          <td colspan="5" align="left" valign="center"  
                 bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext31"><?php echo $errmsg; ?>&nbsp;</td>
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


function deleterecord1(varEntryNumber,varAutoNumber)
{
	var varEntryNumber = varEntryNumber;
	var varAutoNumber = varAutoNumber;
	var fRet;
	fRet = confirm('Are you sure want to delete the stock entry no. '+varEntryNumber+' ?');
	//alert(fRet);
	if (fRet == false)
	{
		alert ("Stock Entry Delete Not Completed.");
		return false;
	}
	else
	{
		window.location="stockreport2.php?task=del&&delanum="+varAutoNumber;		
	}
}


</script>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Category</strong></td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><select name="categoryname" id="categoryname">
            <?php
			$categoryname = $_REQUEST['categoryname'];
			if ($categoryname != '')
			{
			?>
            <option value="<?php echo $categoryname; ?>" selected="selected"><?php echo $categoryname; ?></option>
            <option value="">Show All Category</option>
            <?php
			}
			else
			{
			?>
            <option selected="selected" value="">Show All Category</option>
            <?php
			}
			?>
            <?php
			$query42 = "select * from master_category where status = '' order by categoryname";
			$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
			while ($res42 = mysql_fetch_array($exec42))
			{
			$categoryname = $res42['categoryname'];
			?>
            <option value="<?php echo $categoryname; ?>"><?php echo $categoryname; ?></option>
            <?php
			}
			?>
          </select></td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Search</strong></td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="itemname" type="text" id="itemname" style="border: 1px solid #001E6A; text-align:left" size="50" autocomplete="off">
            <input name="searchbutton12" type="submit" id="searchbutton12" style="border: 1px solid #001E6A" value="Search Item Name" /></td>
        </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Item Name </strong></td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <select name="itemcode" id="itemcode">
				<?php
				if ($itemcode != '')
				{
				$query43 = "select * from master_item where itemcode = '$itemcode' and status <> 'DELETED'";
				$exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
				$res43 = mysql_fetch_array($exec43);
				?>
				<option value="<?php echo $itemcode; ?>" selected="selected"><?php echo $res43['itemcode'].' - '.$res43['itemname']; ?></option>
				<?php
				}
				else
				{
				?>
				<option selected="selected" value="">All Items</option>
				<?php
				}
				?>
            <?php
				$query42 = "select itemcode, itemname from master_item where status <> 'DELETED' order by itemname";
				$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
				while ($res42 = mysql_fetch_array($exec42))
				{
				$itemcode42 = $res42['itemcode'];
				$itemname42 = $res42['itemname'];
				?>
            <option value="<?php echo $itemcode42; ?>"><?php echo $itemcode42.' - '.$itemname42; ?></option>
            <?php
				}
				?>
          </select></td>
          </tr>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Customer</strong></td>
          <td colspan="2" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="customername" type="text" id="customername" style="border: 1px solid #001E6A; text-align:left">
		  </td>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="right"><strong>Supplier</strong></div></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <input name="suppliername" type="text" id="suppliername" style="border: 1px solid #001E6A; text-align:left">
		  </td>
        </tr>
        <tr>
          <td width="76" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong> Date From </strong></td>
          <td width="123" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>			</td>
          <td width="51" align="left" valign="center"  bgcolor="#FFFFFF" class="style1"><span class="bodytext31"><strong> Date To </strong></span></td>
          <td width="129" align="left" valign="center"  bgcolor="#ffffff"><span class="bodytext31">
            <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
		  </span></td>
          <td width="372" align="left" valign="center"  bgcolor="#ffffff">
			<select name="searchoption1" id="searchoption1">
			<!--<option value="">Select Search Option</option>-->
			<?php
			if ($searchoption1 == 'CUMULATIVE')
			{
			?>
			<option value="CUMULATIVE" selected="selected">CUMULATIVE SEARCH ( List By Item )</option>
			<?php
			}
			?>
			<?php
			if ($searchoption1 == 'DETAILED')
			{
			?>
			<option value="DETAILED" selected="selected">DETAILED SEARCH ( List By Date )</option>
			<?php
			}
			?>
			<option value="CUMULATIVE">CUMULATIVE SEARCH ( List By Item )</option>
			<option value="DETAILED">DETAILED SEARCH ( List By Date )</option>
			</select>		  </td>
        </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><input type="hidden" name="itemcode2" id="itemcode2" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" value="<?php echo $itemcode; ?>" size="10" readonly="readonly" /></td>
          <td colspan="3" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <strong><!--Item Code : --><?php echo $itemcode; ?></strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><div align="right">
            <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
            <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" />
			<input type="hidden" name="frmflag1" value="frmflag1" id="frmflag1">
          </div></td>
        </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><strong>Date Range : <?php echo $transactiondatefrom.' To '.$transactiondateto; ?></strong></td>
        </tr>
      </tbody>
    </table>
    </form>		
	</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="98%" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="2%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="5%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="21%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="11%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Item Code </strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Item Name </strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>PartyName </strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Sales</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>SalesReturn</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Purchase</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>PurchaseReturn</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Customer DC IN </strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Customer DC OUT </strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Supplier DC IN </strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Supplier DC OUT </strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>AdjustAdd</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>AdjustMinus</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Date</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Particulars </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Remarks</strong></div></td>
            </tr>
            <?php
			if (isset($_REQUEST["categoryname"])) { $categoryname = $_REQUEST["categoryname"]; } else { $categoryname = ""; }
			//$categoryname = $_REQUEST['categoryname'];
			if (isset($_REQUEST["customername"])) { $customername = $_REQUEST["customername"]; } else { $customername = ""; }
			//$searchitemname = $_REQUEST['itemname'];
			if (isset($_REQUEST["suppliername"])) { $suppliername = $_REQUEST["suppliername"]; } else { $suppliername = ""; }
			//$searchitemname = $_REQUEST['itemname'];
			
			$colorloopcount = '';
			$sno = '';
			$totalquantity = '';
			$stockdate = '';
			$transactionparticular = '';
			$stockremarks = '';
			$partyname = '';

			$salesquantity = '';
			$salesreturnquantity = '';
			$purchasequantity = '';
			$purchasereturnquantity = '';
			$dcinwardcustomerquantity = '';
			$dcinwardsupplierquantity = '';
			$dcoutwardcustomerquantity = '';
			$dcoutwardsupplierquantity = '';
			$adjustmentaddquantity = '';
			$adjustmentminusquantity = '';
			$totalsalesquantity = '';
			$totalsalesreturnquantity = '';
			$totalpurchasequantity = '';
			$totalpurchasereturnquantity = '';
			$totaldcinwardcustomerquantity = '';
			$totaldcinwardsupplierquantity = '';
			$totaldcoutwardcustomerquantity = '';
			$totaldcoutwardsupplierquantity = '';
			$totaladjustmentaddquantity = '';
			$totaladjustmentminusquantity = '';

			if ($searchoption1 != '')
			{
			
			
			if ($searchoption1 == 'DETAILED')
			{
				$query2 = "select * from master_stock where itemcode like '%$itemcode%' and customername like '%$customername%' and suppliername like '%$suppliername%' and transactiondate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' and companyanum = '$companyanum' order by lastupdate";// and cstid='$custid' and cstname='$custname'";
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				$query2 = "select *, sum(quantity) as sumquantity from master_stock where itemcode like '%$itemcode%' and customername like '%$customername%' and suppliername like '%$suppliername%' and transactiondate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' and companyanum = '$companyanum' group by itemcode, transactionmodule order by itemname";// and cstid='$custid' and cstname='$custname'";
			}
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['auto_number'];
			$itemcode = $res2['itemcode'];
			$itemname = $res2['itemname'];
			$transactionmodule = $res2['transactionmodule'];
			$res2transactionparticular = $res2['transactionparticular'];
			
			$query3 = "select * from master_item where itemcode = '$itemcode' and categoryname like '%$categoryname%' and status <> 'DELETED'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			$rowcount3 = mysql_num_rows($exec3);
			if ($rowcount3 > 0)
			{
			
			if ($searchoption1 == 'DETAILED')
			{
				$sumquantity = $res2['quantity'];
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				$sumquantity = $res2['sumquantity'];
			}
			
			if ($transactionmodule == 'SALES')
			{
				//$salesquantity = $res2['quantity'];
				$salesquantity = $sumquantity;
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$salesquantity = round($salesquantity, 4);
				$totalsalesquantity = $totalsalesquantity + $salesquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['customername'];
				}
			}
			if ($transactionmodule == 'SALES RETURN')
			{
				$salesquantity = '';
				$salesreturnquantity = $sumquantity;
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$salesreturnquantity = round($salesreturnquantity, 4);
				$totalsalesreturnquantity = $totalsalesreturnquantity + $salesreturnquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['customername'];
				}
			}
			if ($transactionmodule == 'PURCHASE')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = $sumquantity;
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$purchasequantity = round($purchasequantity, 4);
				$totalpurchasequantity = $totalpurchasequantity + $purchasequantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['suppliername'];
				}
			}
			if ($transactionmodule == 'PURCHASE RETURN')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = $sumquantity;
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$purchasereturnquantity = round($purchasereturnquantity, 4);
				$totalpurchasereturnquantity = $totalpurchasereturnquantity + $purchasereturnquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['suppliername'];
				}
			}
			if ($transactionmodule == 'DC CUSTOMER')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = $sumquantity;
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$dcoutwardcustomerquantity = round($dcoutwardcustomerquantity, 4);
				$totaldcoutwardcustomerquantity = $totaldcoutwardcustomerquantity + $dcoutwardcustomerquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['customername'];
				}
			}
			if ($transactionmodule == 'DC CUSTOMER IN')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = $sumquantity;
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$dcinwardcustomerquantity = round($dcinwardcustomerquantity, 4);
				$totaldcinwardcustomerquantity = $totaldcinwardcustomerquantity + $dcinwardcustomerquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['customername'];
				}
			}
			if ($transactionmodule == 'DC SUPPLIER')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = $sumquantity;
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$dcinwardsupplierquantity = round($dcinwardsupplierquantity, 4);
				$totaldcinwardsupplierquantity = $totaldcinwardsupplierquantity + $dcinwardsupplierquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['suppliername'];
				}
			}
			if ($transactionmodule == 'DC SUPPLIER OUT')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = $sumquantity;
				$adjustmentaddquantity = '';
				$adjustmentminusquantity = '';
				$dcoutwardsupplierquantity = round($dcoutwardsupplierquantity, 4);
				$totaldcoutwardsupplierquantity = $totaldcoutwardsupplierquantity + $dcoutwardsupplierquantity;
				if ($searchoption1 == 'DETAILED')
				{
					$partyname = $res2['suppliername'];
				}
			}
			if ($transactionmodule == 'ADJUSTMENT')
			{
				$salesquantity = '';
				$salesreturnquantity = '';
				$purchasequantity = '';
				$purchasereturnquantity = '';
				$dcinwardcustomerquantity = '';
				$dcinwardsupplierquantity = '';
				$dcoutwardcustomerquantity = '';
				$dcoutwardsupplierquantity = '';
				if ($res2transactionparticular == 'BY ADJUSTMENT ADD')
				{
					$adjustmentaddquantity = $sumquantity;
					$adjustmentminusquantity = '';
					$adjustmentaddquantity = round($adjustmentaddquantity, 4);
					$totaladjustmentaddquantity = $totaladjustmentaddquantity + $adjustmentaddquantity;
				}
				if ($res2transactionparticular == 'BY ADJUSTMENT MINUS')
				{
					$adjustmentaddquantity = '';
					$adjustmentminusquantity = $sumquantity;
					$adjustmentminusquantity = round($adjustmentminusquantity, 4);
					$totaladjustmentminusquantity = $totaladjustmentminusquantity + $adjustmentminusquantity;
				}
			}
			else
			{	
				$quantity = '0';
			}
			
			
			if ($searchoption1 == 'DETAILED')
			{
				$quantity = $res2['quantity'];
				$stockdate = $res2['transactiondate'];
				$stockremarks = $res2['remarks'];
				$transactionparticular = $res2['transactionparticular'];
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				$quantity = $res2['sumquantity'];
			}
			
			
			$quantity = round($quantity, 4);
			
			if ($stockdate != '')
			{
				$stockdate = substr($stockdate, 0, 10);
				$dotarray = explode("-", $stockdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$stockdate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
			}
			
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
			if ($showcolor == 0)
			{
				//echo "if";
				$colorcode = 'bgcolor="#CBDBFA"';
			}
			else
			{
				//echo "else";
				$colorcode = 'bgcolor="#D3EEB7"';
			}
			
			$sno = $sno + 1;
			
			$totalquantity = $totalquantity + $quantity;
			
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left">
			  <?php echo $sno; ?></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $itemcode; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $itemname; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                <div align="left"><?php echo $partyname; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31">
                <div align="right"><?php echo $salesquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $salesreturnquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $purchasequantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $purchasereturnquantity; ?></div>
              </div></td>
              <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                  <div align="right"><?php echo $dcinwardcustomerquantity; ?></div>
              </div></td>
              <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                  <div align="right"><?php echo $dcoutwardcustomerquantity; ?></div>
              </div></td>
              <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                  <div align="right"><?php echo $dcinwardsupplierquantity; ?></div>
              </div></td>
              <td  align="left" valign="center" class="bodytext31"><div class="bodytext31">
                  <div align="right"><?php echo $dcoutwardsupplierquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $adjustmentaddquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $adjustmentminusquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
			  <?php echo $stockdate; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="left"><?php echo $transactionparticular; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left">
			  <?php echo $stockremarks; ?>
			  </div></td>
            </tr>
            <?php
			}
			
			}
			
			}
			?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total Quantity</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalsalesquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalsalesreturnquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalpurchasequantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalpurchasereturnquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaldcinwardcustomerquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaldcoutwardcustomerquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaldcinwardsupplierquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaldcoutwardsupplierquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaladjustmentaddquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totaladjustmentminusquantity; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>    
  <tr>
    <td valign="top">    
  <tr>
    <td width="98%" valign="top">    
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>