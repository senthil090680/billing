<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetitme = date ("d-m-Y H:i:s");
$dateonly=date("Y-m-d");
$username = $_SESSION['username'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

//To populate the autocompetelist_services1.js
include ("autocompletebuild_item1.php");

$delbillst = '';

//To Edit Bill
if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
//$delbillst = $_REQUEST["delbillst"];
if (isset($_REQUEST["delbillautonumber"])) { $delbillautonumber = $_REQUEST["delbillautonumber"]; } else { $delbillautonumber = ""; }
//$delbillautonumber = $_REQUEST["delbillautonumber"];
if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
//$delbillnumber = $_REQUEST["delbillnumber"];

if (isset($_REQUEST["frm1submit1"])) { $frm1submit1 = $_REQUEST["frm1submit1"]; } else { $frm1submit1 = ""; }
//$frm1submit1 = $_REQUEST["frm1submit1"];
if ($frm1submit1 == 'frm1submit1')
{
	$delbillst = $_REQUEST["delbillst"];
	$delbillstanum = $_REQUEST["delbillautonumber"];
	$delbillnumber = $_REQUEST["delbillnumber"];
	//if ($delbillst == 'billedit' && $delbillstanum != '' && $delbillnumber != '')
	if ($delbillst == 'billedit' && $delbillnumber != '')
	{
		//$query19 = "select auto_number,lastupdate from master_production where auto_number = '$delbillautonumber' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";
		$query19 = "select auto_number,lastupdate from master_production where billnumber = '$delbillnumber' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
		$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
		while ($res19 = mysql_fetch_array($exec19))
		{
			$res19anum = $res19["auto_number"];
			$billdatetime=$res19["updatedate"];
			
			//$query15 = "update master_production set recordstatus = 'DELETED' where auto_number = '$res19anum' and companyanum = '$companyanum'";
			$query15 = "update master_production set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
			$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		
			//$query16 = "update production_details set recordstatus = 'DELETED' where bill_autonumber = '$res19anum' and companyanum = '$companyanum'";
			$query16 = "update production_details set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
			$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		
			//$query17 = "update production_tax set recordstatus = 'DELETED' where bill_autonumber = '$res19anum' and companyanum = '$companyanum'";
			$query17 = "update production_tax set recordstatus = 'DELETED' where billnumber = '$delbillnumber' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
			$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
			
			//$query20="update master_stock set recordstatus='DELETED' where transactionmodule = 'SALES' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
			//$exec20=mysql_query($query20) or die("Error in Query19".mysql_error());
	
		}
	}
}


include ("production1include1.php"); //handles all the production insert operations


if ($delbillst == "" && $delbillnumber == "")
{
	/*
	$res41customername = "";
	$res41customercode = "";
	$res41tinnumber = "";
	$res41cstnumber = "";
	$res41address1 = "";
	$res41deliveryaddress = "";
	$res41area = "";
	$res41city = "";
	$res41pincode = "";
	$res41billdate = "";
	$billnumberprefix = "";
	$billnumberpostfix = "";
	*/
}
if ($delbillst == 'billedit' && $delbillnumber != '')
{
	$query41 = "select * from master_production where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";// and financialyear = '$financialyear'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
	//$res41customername = $res41["customername"];
	//$res41customercode = $res41["customercode"];
	//$res41tinnumber = $res41["tinnumber"];
	//$res41cstnumber = $res41["cstnumber"];
	//$res41address1 = $res41["address"];
	//$res41area = $res41["location"];
	//$res41city = $res41["city"];
	//$res41pincode = $res41["pincode"];
	$res41billdate = $res41["billdate"];
	$res41billdate = substr($res41billdate, 0, 10);
	$dateonly = $res41billdate;
	//$billnumberprefix = $res41["billnumberprefix"];
	//$billnumberpostfix = $res41["billnumberpostfix"];
	//$res41deliveryaddress = $res41["deliveryaddress"];
	$enditemcode = $res41['enditemcode'];
}


?>
<?php include ("includes/pagetitle1.php"); ?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>

<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>

<?php include ("js/production1scripting1.php"); ?>
<?php include ("js/production2scripting2.php"); ?>

<script type="text/javascript" src="js/productioninsertitem1.js"></script>
<script type="text/javascript" src="js/autoitemsearch2.js"></script><!--Common For Sales1.php-->
<script type="text/javascript" src="js/autosuggest2item.js"></script>
<script type="text/javascript" src="js/autocomplete_item1.js"></script>
<script type="text/javascript" src="js/autocomplete_itemsearch1.js"></script>
<script type="text/javascript" src="js/autocomplete_itemsearch3.js"></script> <!-- For mouse click event of item name drop down list. -->
<script type="text/javascript" src="js/autoitemsearch1production.js"></script> <!-- For mouse click event of item name drop down list. -->
<script language="javascript">

function funcOnLoadBodyFunctionCall()
{
	funcBodyOnLoad(); //To reset any previous values in text boxes. source .js - production1scripting1.php
	
	funcProductionDropDownSearch1(); //To handle ajax dropdown list.
	
	//alert ("Auto Print Function Runs Here.");
	<?php
	if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
	//$src = $_REQUEST["src"];
	if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
	//$st = $_REQUEST["st"];
	if (isset($_REQUEST["billnumber"])) { $previousbillnumber = $_REQUEST["billnumber"]; } else { $previousbillnumber = ""; }
	//$previousbillnumber = $_REQUEST["billnumber"];
	if (isset($_REQUEST["billautonumber"])) { $previousbillautonumber = $_REQUEST["billautonumber"]; } else { $previousbillautonumber = ""; }
	//$previousbillautonumber = $_REQUEST["billautonumber"];
	if (isset($_REQUEST["companyanum"])) { $previouscompanyanum = $_REQUEST["companyanum"]; } else { $previouscompanyanum = ""; }
	//$previouscompanyanum = $_REQUEST["companyanum"];
	if ($src == 'frm1submit1' && $st == 'success')
	{
	$query1print = "select * from master_printer where defaultstatus = 'default' and status <> 'deleted'";
	$exec1print = mysql_query($query1print) or die ("Error in Query1print.".mysql_error());
	$res1print = mysql_fetch_array($exec1print);
	$papersize = $res1print['papersize'];
	$paperanum = $res1print['auto_number'];
	$printdefaultstatus = $res1print['defaultstatus'];
	if ($paperanum == '1') //For 40 Column paper
	{
	?>
		//quickprintbill1production();
	<?php
	}
	else if ($paperanum == '2') //For A4 Size paper
	{
	?>
		loadprintpage1('A4');
	<?php
	}
	else if ($paperanum == '3') //For A4 Size paper
	{
	?>
		loadprintpage1('A5');
	<?php
	}
	}
	?>

}

//Print() is at bottom of this page.

</script>
<script type="text/javascript">

function loadprintpage1(varPaperSizeCatch)
{
	//var varBillNumber = document.getElementById("billnumber").value;
	var varPaperSize = varPaperSizeCatch;
	//alert (varPaperSize);
	//return false;
	<?php
	//To previous js error if empty. 
	if ($previousbillnumber == '') 
	{ 
		$previousbillnumber = 1; 
		$previousbillautonumber = 1; 
		$previouscompanyanum = 1; 
	} 
	?>
	var varBillNumber = document.getElementById("quickprintbill").value;
	var varBillAutoNumber = "<?php //echo $previousbillautonumber; ?>";
	var varBillCompanyAnum = "<?php echo $_SESSION['companyanum']; ?>";
	if (varBillNumber == "")
	{
		alert ("Bill Number Cannot Be Empty.");//quickprintbill
		document.getElementById("quickprintbill").focus();
		return false;
	}
	
	var varPrintHeader = "PRODUCTION RECEIPT";
	var varTitleHeader = "ORIGINAL";
	if (varTitleHeader == "")
	{
		alert ("Please Select Print Title.");
		document.getElementById("titleheader").focus();
		return false;
	}
	
	//alert (varBillNumber);
	//alert (varPrintHeader);
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
	if (varPaperSize == "A4")
	{
		window.open("print_bill1_production1.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber+"","OriginalWindowA4<?php //echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	}
	if (varPaperSize == "A5")
	{
		window.open("print_bill1_production1_a5.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber+"","OriginalWindowA5<?php //echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	}
}
</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext312 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {
	font-size: 36px;
	font-weight: bold;
}
.style2 {
	font-size: 18px;
	font-weight: bold;
}
.style4 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; }
.style6 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration: none; }
.style8 {COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none; font-size: 11px;}
-->
</style>
</head>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        

<script src="js/datetimepicker_css.js"></script>

<body onLoad="return funcOnLoadBodyFunctionCall();">
<form name="frmproduction" id="frmproduction" method="post" action="productionentry1.php" onKeyDown="return disableEnterKey(event)">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
<!--  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
-->
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="950" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table width="99%" border="0" align="left" cellpadding="2" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="13%" bgcolor="#CCCCCC" class="bodytext3"><strong>Production Entry </strong></td>
                <td width="44%" bgcolor="#CCCCCC" class="bodytext3"><strong> 
                  PRD No. 
				  <?php
				  if ($delbillst == 'billedit' && $delbillnumber != '')
				  {
					$billnumber = $delbillnumber; 
					$billnumbertextboxvalidation = 'readonly="readonly"';
				  }
				  else if ($delbillst == 'importsalesorder' && $delbillnumber != '')
				  {
					//$billnumber = $delbillnumber; 
					$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
				  }
				  else
				  {
					$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
				  }
				  ?>
                  <input name="billnumber" id="billnumber" value="<?php echo $billnumber; ?>" <?php echo 'readonly="readonly"'; //if ($delbillst == '') { echo 'onBlur="return billvalidation()"'; } else { echo 'readonly="readonly"'; } ?> style="border: 1px solid #001E6A; text-align:right" size="8" />
                </strong></td>
                <td width="11%" bgcolor="#CCCCCC" class="bodytext3"><strong>PRD  Date </strong></td>
                <td width="15%" bgcolor="#CCCCCC" class="bodytext3">
				<input name="ADate" id="ADate"  style="border: 1px solid #001E6A" value="<?php echo $dateonly; ?>" size="8" readonly>
                  <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate')" style="cursor:pointer"/>				</td>
                <td width="5%" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
                <td bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
              </tr>
			  
				<?php
				if (isset($_REQUEST["src"])) { $src = $_REQUEST["src"]; } else { $src = ""; }
				//$src = $_REQUEST["src"];
				if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
				//$st = $_REQUEST["st"];
				
				if ($src == 'frm1submit1' && $st == 'success')
				{
				?>
				<tr>
				<td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">* Success. Bill Saved. Click  Print Button To Print or View Previous Bill </td>
				</tr>
				<?php
				}
				?>
				
				
			  <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    </tr>
			  <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><strong>Select End Item </strong></td>
			    <td align="left" valign="top" ><span class="bodytext312">
				<select name="enditemcode" id="enditemcode">
				<?php
				if ($enditemcode != '')
				{
				$query43 = "select * from master_item where itemcode = '$enditemcode'";
				$exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
				$res43 = mysql_fetch_array($exec43);
				?>
				<option value="<?php echo $enditemcode; ?>" selected="selected"><?php echo $res43['itemcode'].' - '.$res43['itemname']; ?></option>
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
				$query42 = "select itemcode, itemname from master_item order by itemname";
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
				</select>
			    </span></td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td width="12%" align="left" valign="top" ><span class="bodytext3"><span class="style6"><span class="bodytext312"><a href="javascript:displayDatePicker('ADate1', false, 'ymd', '-');"></a></span></span></span></td>
			    </tr>
			  <tr>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="top" >&nbsp;</td>
			    <td align="left" valign="middle"  bgcolor="#E0E0E0"  class="bodytext3">&nbsp;</td>
			    <td width="12%" align="left" valign="top" >&nbsp;</td>
			  </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td>
		<table id="newtable" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
            <tbody id="tblrowinsert">
              <tr>
                <td width="4%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong>No.</strong></td>
                <td width="9%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong> Code </strong></td>
                <td width="38%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong>Item Name </strong></td>
                <td width="5%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31">&nbsp;</td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong>Rate</strong></td>
                <td width="6%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong>Qty </strong></td>
                <td width="6%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31">&nbsp;</td>
                <td width="6%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31">&nbsp;</td>
                <td width="5%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><span class="bodytext311"><strong><!--Tax%-->
                   Tax% </strong></span></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31"><strong>Total </strong></td>
                <td width="7%" align="left" valign="center"  
                bgcolor="#FFCC00" class="bodytext31">&nbsp;</td>
              </tr>
				<?php
				$itemcount = "";
				//To populate items already in the bill if in edit mode.
				include ('productionentry_edit1listing1.php');
				//value to initiate serial number if in edit mode.
				$itemcount = $itemcount;
				?>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
          <tbody id="foo">

            <tr>
              <td width="3%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input type="hidden" name="dummy1" id="dummy1" style="border: 0px solid #001E6A; background-color:#66CC00; text-align:left" value="" size="1" readonly="readonly" />
			  <input type="text" value="<?php echo $itemcount + 1; ?>" name="itemserialnumber" id="itemserialnumber" style="border: 1px solid #001E6A; text-align:right" size="1" readonly="readonly" /></td>
              <td width="8%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input onKeyDown="return itemcodekeypress1()" name="itemcode" id="itemcode" style="border: 1px solid #001E6A; text-align:left;text-transform: uppercase;" value="" size="10" /></td>
              <td width="37%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input name="itemname" id="itemname" autocomplete="off" style="border: 1px solid #001E6A; text-align:left" value="" size="40" /></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input type="button" name="itemsearch2" onClick="javascript:itemsearch1('productionentry')" value="Alt+S" accesskey="s" style="border: 1px solid #001E6A"></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input onKeyDown="return itemquantitykeypress1()" onBlur="return itemtotalamountupdate1()" name="itemmrp" value="0.00" id="itemmrp" style="border: 1px solid #001E6A; text-align:right" size="6" /></td>
              <td width="4%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input onKeyDown="return itemquantitykeypress1()" onBlur="return itemtotalamountupdate1()" name="itemquantity" value="1" id="itemquantity" style="border: 1px solid #001E6A; text-align:right" size="4" /></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input type="hidden" onKeyDown="return itemquantitykeypress1()" onBlur="return itemtotalamountupdate1()" name="itemdiscountpercent" value="0.00" id="itemdiscountpercent" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input type="hidden" onKeyDown="return itemquantitykeypress1()" onBlur="return itemtotalamountupdate1()" name="itemdiscountrupees" value="0.00" id="itemdiscountrupees" style="border: 1px solid #001E6A; text-align:right" size="3" /></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31"><span class="bodytext311">
              <input type="text" onKeyDown="return itemquantitykeypress1()" onBlur="return itemtotalamountupdate1()" name="itemtaxpercent" value="0.00" id="itemtaxpercent" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />
              <input type="hidden" id="itemtaxautonumber" name="itemtaxautonumber" value="">
              <input type="hidden" id="itemtaxname" name="itemtaxname" value="">
			  </span></td>
              <td width="6%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input name="itemtotalamount" value="0.00" id="itemtotalamount" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
              <td width="18%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">
			  <input name="Submit22222" type="button" value="Add" onClick="return insertitem1()" class="button" style="border: 1px solid #001E6A"/></td>
              <td width="18%" align="left" valign="center"  bgcolor="#66CC00" class="bodytext31">&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td class="bodytext31" valign="middle">
		<strong><div align="left">&nbsp;</div>
		</strong></td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="2" width="99%" 
            align="left" border="0">
            <tbody id="foo">
                        <tr>
                          <td width="6%" rowspan="5" align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                          <td width="42%" rowspan="5" align="left" valign="top"  
                bgcolor="#F3F3F3" class="bodytext31">
				<table width="99%" border="0" align="right" cellpadding="2" cellspacing="0"  style="BORDER-COLLAPSE: collapse">
                            <tr bordercolor="#f3f3f3">
                              <td width="60%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#F3F3F3" class="bodytext311">&nbsp;</td>
                              <td><span class="style6">
                              <input name="subtotaldiscountamountonlyapply1" id="subtotaldiscountamountonlyapply1" onBlur="return funcSubTotalDiscountApply1()" 
				type="hidden" style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="4" />
                              <input name="subtotaldiscountamountonlyapply2" id="subtotaldiscountamountonlyapply2" onBlur="return funcSubTotalDiscountApply1()" readonly="readonly"  
				type="hidden" style="border: 1px solid #001E6A; text-align:right; background-color:#CCCCCC" value="0.00" size="4" />
                              <span class="bodytext311">
                              <input type="hidden" name="allitemdiscountpercent" id="allitemdiscountpercent" onBlur="return funcAllItemDiscountApply1()" 
				style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="6" />
                              <input name="subtotaldiscountpercent" id="subtotaldiscountpercent" onKeyDown="return funcResetPaymentInfo1()" 
					 type="hidden" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" />
                              <input name="totaldiscountamount" id="totaldiscountamount" value="0.00" type="hidden" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                              <input type="hidden" name="subtotaldiscountrupees" id="subtotaldiscountrupees" onKeyDown="return funcResetPaymentInfo1()" onBlur="return funcbillamountcalc1()" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8" />
                              <input type="hidden" name="afterdiscountamount" id="afterdiscountamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                              <strong>
                              <input type="hidden" name="subtotaldiscountpercentapply1" id="subtotaldiscountpercentapply1" onBlur="return funcSubTotalDiscountApply1()"
				style="border: 1px solid #001E6A; text-align:right;" value="0.00" size="4" />
                              <input name="subtotaldiscountamountapply1" id="subtotaldiscountamountapply1" onBlur="return funcSubTotalDiscountApply1()" readonly="readonly" 
				type="hidden" style="border: 1px solid #001E6A; text-align:right; background-color:#CCCCCC" value="0.00" size="4" />
</strong></span></span></td>
                        </tr>
                            <?php
				if (isset($_REQUEST["defaulttax"])) { $defaulttax = $_REQUEST["defaulttax"]; } else { $defaulttax = ""; }
				//$defaulttax = $_SESSION["defaulttax"];

				if ($defaulttax == '')
				{
					$query5 = "select * from master_tax where status = '' order by taxname desc";
				}
				else
				{
					$query5 = "select * from master_tax where status = '' and auto_number = '$defaulttax' order by taxname desc";
				}
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5['auto_number'];
				$res5taxname = $res5['taxname'];
				$res5taxpercent = $res5['taxpercent'];
				?>
                            <tr>
                              <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext311"><input type="hidden" name="totaltax_autonumber<?php echo $res5anum; ?>" value="<?php echo $res5anum; ?>">
                                <input type="hidden" name="totaltaxname<?php echo $res5anum; ?>" value="<?php echo $res5taxname; ?>">
                                <input type="hidden" name="totaltaxpercent<?php echo $res5anum; ?>" value="<?php echo $res5taxpercent; ?>">
                              <div align="right"><strong><?php echo strtoupper($res5taxname); //.' '.$res5taxpercent.'%'; ?></strong></div></td>
                              <td width="40%"><span class="bodytext312">
                              <input name="totaltaxamount<?php echo $res5anum; ?>" id="totaltaxamount<?php echo $res5anum; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" />
                              </span></td>
                            </tr>
                            <?php
				$res6loopcount = '';
				$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
				$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
				while ($res6 = mysql_fetch_array($exec6))
				{
				$res6anum = $res6['auto_number'];
				$res6taxname = $res6['taxsubname'];
				$res6taxpercent = $res6['taxsubpercent'];
				$res6loopcount = $res6loopcount + 1;
				//echo $res6loopcount;
				?>
                            <tr>
                              <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext311"><input type="hidden" name="totaltaxsub_autonumber<?php echo $res6loopcount; ?>" value="<?php echo $res6anum; ?>">
                                <input type="hidden" name="totaltaxsubname<?php echo $res6loopcount; ?>" value="<?php echo $res6taxname; ?>">
                                <input type="hidden" name="totaltaxsubpercent<?php echo $res6loopcount; ?>" value="<?php echo $res6taxpercent; ?>">
                              <div align="right"><strong><?php echo strtoupper($res6taxname);//.' '.$res6taxpercent.'%'; ?></strong></div></td>
                              <td width="40%"><span class="bodytext312">
                              <input name="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" id="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" />
                              </span></td>
                            </tr>
                            <?php
				}
				}
				?>
                          </table></td>
                          <td width="21%" rowspan="5" align="right" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                          <td align="left" valign="middle"  
                bgcolor="#F3F3F3" class="bodytext31"><span class="bodytext311"><strong>Sub Total</strong></span></td>
                          <td align="left" valign="top" bgcolor="#F3F3F3" ><span class="bodytext311">
                            <input name="subtotal" id="subtotal" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                            </span><span class="bodytext311">
                            <input type="hidden" name="subtotalaftercombinediscount" id="subtotalaftercombinediscount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                          </span></td>
                        </tr>
                      
                  <tr>
                    <td align="left" valign="middle"  
                bgcolor="#F3F3F3" class="bodytext31"><strong>Nett Total </strong></td>
                    <td align="left" valign="top" bgcolor="#F3F3F3" ><span class="bodytext312">
                      <input name="totalaftertax" id="totalaftertax" value="0.00"  onKeyDown="return disableEnterKey()" onBlur="return funcSubTotalCalc()" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly"/>
                      </span>
                        <input type="hidden" name="packaging" id="packaging" value="0.00" onKeyDown="return disableEnterKey()" onBlur="return funcbillamountcalc1()" style="border: 1px solid #001E6A; text-align:right" size="8"/>
                        <span class="bodytext311">
                        <input type="hidden" name="delivery" id="delivery" value="0.00" onKeyDown="return disableEnterKey()" onBlur="return funcbillamountcalc1()" style="border: 1px solid #001E6A; text-align:right" size="8"/>
                        <input type="hidden" name="roundoff" id="roundoff" value="0.00" style="border: 1px solid #001E6A; text-align:right"  readonly="readonly" size="8"/>
                        <input type="hidden" name="totalamount" id="totalamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" size="8"  readonly="readonly" />
                      </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  
                bgcolor="#F3F3F3" class="bodytext31"><strong>Total Units Produced </strong></td>
                    <td align="left" valign="top" bgcolor="#F3F3F3" ><span class="bodytext311"><strong>
                      <input name="totalunitsproduced" onBlur="return funcTotalUnitsProducedLostFocus1()" type="text" id="totalunitsproduced" style="border: 1px solid #001E6A; text-align:right" value="0.00" size="8">
                    </strong></span></td>
                  </tr>
                <tr>
                  <td align="left" valign="middle"  
                bgcolor="#F3F3F3" class="bodytext31"><strong>Cost Per Unit </strong></td>
                  <td align="left" valign="top" bgcolor="#F3F3F3" ><strong>
                    <input name="costperunit" type="text" id="costperunit" style="border: 1px solid #001E6A; text-align:right" value="0.00" readonly="readonly" size="8">
                  </strong></td>
                </tr>
              <tr>
                <td align="left"  
                bgcolor="#F3F3F3" class="bodytext31" valign="middle">&nbsp;</td>
                <td align="left" valign="top" bgcolor="#F3F3F3" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left" valign="top"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="right" valign="center"  
                bgcolor="#F3F3F3" class="bodytext31">&nbsp;</td>
                <td align="left"  
                bgcolor="#F3F3F3" class="bodytext31" valign="top">&nbsp;</td>
                <td align="left" valign="top" bgcolor="#F3F3F3" >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" align="left" valign="center"  
                bgcolor="#CCCCCC" class="bodytext31"><strong>Remarks</strong><span class="bodytext311">
                <input name="remarks" id="remarks" style="border: 1px solid #001E6A; text-transform:uppercase" size="30" />
                </span></td>
                <td width="16%" align="left" valign="center"  
                bgcolor="#CCCCCC" class="bodytext31">
                  <input name="frm1submit1" id="frm1submit1" type="hidden" value="frm1submit1">
                   <input name="delbillst" id="delbillst" type="hidden" value="billedit">
                  <input name="delbillautonumber" id="delbillautonumber" type="hidden" value="<?php echo $delbillautonumber;?>">
                  <input name="delbillnumber" id="delbillnumber" type="hidden" value="<?php echo $delbillnumber;?>">

                 <input name="Submit2223" type="submit" onClick="return funcSaveBill1()" value="Save Production" accesskey="b" class="button" style="border: 1px solid #001E6A"/>				</td>
              </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="99%" border="0" align="left" cellpadding="2" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr>
              <td width="54%" align="left" valign="top" >
                <input name="Button1" type="button" class="button" id="Button1" accesskey="c" style="border: 1px solid #001E6A" onClick="return funcRedirectWindow1()" value="Clear All"/>
                <input type="button" name="itemsearch22" onClick="javascript:itemsearch1('productionentry')" value="Item Alt+S" accesskey="s" style="border: 1px solid #001E6A">
				</td>
              <td width="46%" align="left" valign="top" ><div align="right"><span class="bodytext311">
                <input name="quickprintbill" id="quickprintbill" value="<?php echo $previousbillnumber; ?>" style="border: 1px solid #001E6A; text-align:right; text-transform:uppercase"  size="11"  />
                <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                <input onClick="return loadprintpage1('A4<?php //echo $previousbillnumber; ?>')" value="View A4" 
				  name="printA4" type="button" class="button" id="printA4" style="border: 1px solid #001E6A"/>
                <input onClick="return loadprintpage1('A5<?php //echo $previousbillnumber; ?>')" value="View A5" 
				  name="printA5" type="button" class="button" id="printA5" style="border: 1px solid #001E6A"/>
              </font></font></font></font></font></font></font></font></font></span></div></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
  </table>
</form>
<?php include ("includes/footer1.php"); ?>
<?php //include ("print_bill_dmp4inch1.php"); ?>
</body>
</html>