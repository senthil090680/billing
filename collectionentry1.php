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
$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
$transactiondateto = date('Y-m-d');


//$financialyear = $_SESSION["financialyear"];

	$query6 = "select * from master_company where auto_number = '$companyanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$res6companycode = $res6["companycode"];
	
	$query7 = "select * from master_settings where companycode = '$res6companycode' and modulename = 'SETTINGS' and 
	settingsname = 'CURRENT_FINANCIAL_YEAR'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$financialyear = $res7["settingsvalue"];
	$_SESSION["financialyear"] = $financialyear;
	//echo $_SESSION['financialyear'];


$errmsg = "";
$banum = "1";
$customeranum = "";
$custid = "";
$custname = "";
$balanceamount = "0.00";
$openingbalance = "0.00";
$searchcustomername = "";
$cbcustomername = "";

//This include updatation takes too long to load for hunge items database.
include ("autocompletebuild_customer1.php");

if (isset($_REQUEST["canum"])) { $getcanum = $_REQUEST["canum"]; } else { $getcanum = ""; }
//$getcanum = $_GET['canum'];
if ($getcanum != '')
{
	$query4 = "select * from master_customer where auto_number = '$getcanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$cbcustomername = $res4['customername'];
	$customername = $res4['customername'];
}

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_POST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$searchcustomername = $_POST['searchcustomername'];
	if ($searchcustomername != '')
	{
		$arraycustomer = explode("#", $searchcustomername);
		$arraycustomername = $arraycustomer[0];
		$arraycustomername = trim($arraycustomername);
		$arraycustomercode = $arraycustomer[1];
		
		$query1 = "select * from master_customer where customercode = '$arraycustomercode'";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$res1 = mysql_fetch_array($exec1);
		$customeranum = $res1['auto_number'];
		$openingbalance = $res1['openingbalance'];
		
		$cbcustomercode = $arraycustomercode;
		$cbcustomername = $arraycustomername;
		$customername = $arraycustomername;
	}
	else
	{
		$cbcustomercode = $_REQUEST['cbcustomercode'];
		$cbcustomername = $_REQUEST['cbcustomername'];
		$customername = $_REQUEST['cbcustomername'];
		$customername = $_REQUEST['cbcustomercode'];
	}

	//$transactiondatefrom = $_REQUEST['ADate1'];
	//$transactiondateto = $_REQUEST['ADate2'];

}

if (isset($_REQUEST["cbfrmflag2"])) { $cbfrmflag2 = $_REQUEST["cbfrmflag2"]; } else { $cbfrmflag2 = ""; }
//$cbfrmflag2 = $_REQUEST['cbfrmflag2'];
if (isset($_REQUEST["frmflag2"])) { $frmflag2 = $_REQUEST["frmflag2"]; } else { $frmflag2 = ""; }
//$frmflag2 = $_POST['frmflag2'];

if ($frmflag2 == 'frmflag2')
{
	
	$query2 = "select * from settings_approval where modulename = 'collection' and status <> 'deleted'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$approvalrequired = $res2['approvalrequired'];
	if ($approvalrequired == 'YES')	{
		$approvalstatus = 'PENDING';
	}
	else {
		$approvalstatus = 'APPROVED';
	}
	
	$query8 = "select * from master_customer where auto_number = '$cbfrmflag2'";
	$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
	$res8 = mysql_fetch_array($exec8);
	$res8customername = $res8['customername'];
	
	//echo "inside if";
	$collectionentrydate = $_REQUEST['collectionentrydate'];
	$collectionmode = $_REQUEST['collectionmode'];
	$chequenumber = $_REQUEST['chequenumber'];
	$chequedate = $_REQUEST['ADate1'];
	$bankname = $_REQUEST['bankname'];
	$bankbranch = $_REQUEST['bankbranch'];
	$remarks = $_REQUEST['remarks'];
	$collectionamount = $_REQUEST['collectionamount'];
	$pendingamount = $_REQUEST['pendingamount'];
	$remarks = $_REQUEST['remarks'];
	$billnumber = $_REQUEST['billnumber'];
	
	$query81 = "select auto_number from master_sales where billnumber = '$billnumber' and companyanum = '$companyanum' and financialyear = '$financialyear' and recordstatus <> 'deleted'";
	$exec81 = mysql_query($query81) or die ("Error in Query81".mysql_error());
	$res81 = mysql_fetch_array($exec81);
	$billanum = $res81['auto_number'];
		
	$balanceamount = $pendingamount - $collectionamount;
	$transactiondate = $collectionentrydate;
	
	$transactionmode = $collectionmode;
	if ($transactionmode == 'TDS')
	{
		$transactiontype = 'TDS';
	}
	else
	{
		$transactiontype = 'COLLECTION';
	}
	
	
	//For generating first code
	include ("transactioncodegenerate1.php");

	
	$ipaddress = $ipaddress;
	$updatedate = $updatedatetime;
	$transactionmodule = 'COLLECTION';
	
	if ($collectionmode == 'CASH')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'CASH';
	//$particulars = 'BY CASH '.$billnumberprefix.$billnumber.'';	
	$particulars = 'BY CASH (BILL NO.'.$billnumberprefix.$billnumber.')';	
	$cashamount = $collectionamount;
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactioncode, transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount, cashamount,
	billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, remarks, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactioncode', '$transactiondate', '$particulars', '$cbfrmflag2', '$res8customername', 
	'$transactionmode', '$transactiontype', '$transactionamount', '$cashamount', 
	'$billnumber',  '$billanum', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', '$remarks', 
	'$transactionmodule', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());

	}
	if ($collectionmode == 'ONLINE')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'ONLINE';
	//$particulars = 'BY ONLINE '.$billnumberprefix.$billnumber.'';	
	$particulars = 'BY ONLINE (BILL NO.'.$billnumberprefix.$billnumber.')';	
	$onlineamount = $collectionamount;
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactioncode, transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount, onlineamount,
	billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, remarks, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactioncode', '$transactiondate', '$particulars', '$cbfrmflag2', '$res8customername', 
	'$transactionmode', '$transactiontype', '$transactionamount', '$onlineamount', 
	'$billnumber',  '$billanum', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', '$remarks', 
	'$transactionmodule', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());

	}
	if ($collectionmode == 'CHEQUE')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'CHEQUE';
	//$particulars = 'BY CHEQUE '.$billnumberprefix.$billnumber;		
	$particulars = 'BY CHEQUE (BILL NO.'.$billnumberprefix.$billnumber.')';	
	$chequeamount = $collectionamount;
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactioncode, transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount,
	chequeamount,chequenumber, billnumber, billanum, 
	chequedate, bankname, bankbranch, ipaddress, updatedate, balanceamount, companyanum, companyname, remarks, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactioncode', '$transactiondate', '$particulars', '$cbfrmflag2', '$res8customername', 
	'$transactionmode', '$transactiontype', '$transactionamount',
	'$chequeamount','$chequenumber',  '$billnumber',  '$billanum', 
	'$chequedate', '$bankname', '$bankbranch','$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
	'$remarks', '$transactionmodule', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	
	}
	
	if ($collectionmode == 'WRITEOFF')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'WRITEOFF';
	//$particulars = 'BY WRITEOFF '.$billnumberprefix.$billnumber;		
	$particulars = 'BY WRITEOFF (BILL NO.'.$billnumberprefix.$billnumber.')';	
	$writeoffamount = $collectionamount;
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactioncode, transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount, writeoffamount,
	billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, remarks, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactioncode', '$transactiondate', '$particulars', '$cbfrmflag2', '$res8customername', 
	'$transactionmode', '$transactiontype', '$transactionamount', '$writeoffamount', 
	'$billnumber',  '$billanum', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', '$remarks', 
	'$transactionmodule', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}
	
	header ("location:collectionentry1.php?st=1");
	exit;
	
	//$errmsg = "Success. Payment Entry Updated.";

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == '1')
{
	$errmsg = "Success. Collection Entry Update Completed.";
}
if ($st == '2')
{
	$errmsg = "Failed. Collection Entry Not Completed.";
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
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function cbcustomername1()
{
	document.cbform1.submit();
}

</script>
<script type="text/javascript" src="js/autocomplete_customer1.js"></script>
<!--<script type="text/javascript" src="js/autocustomercodesearch2.js"></script>-->
<script type="text/javascript" src="js/billnumbercollectionentryverify1.js"></script>
<script type="text/javascript" src="js/autosuggest3.js"></script>
<script type="text/javascript">
window.onload = function () 
{
	var oTextbox = new AutoSuggestControl(document.getElementById("searchcustomername"), new StateSuggestions());        
}


function disableEnterKey(varPassed)
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


function process1backkeypress1()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
}

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
		return false;
	}
	else
	{
		return true;
	}

}

function paymententry1process2()
{
	if (document.getElementById("cbfrmflag1").value == "")
	{
		alert ("Search Bill Number Cannot Be Empty.");
		document.getElementById("cbfrmflag1").focus();
		document.getElementById("cbfrmflag1").value = "<?php echo $cbfrmflag1; ?>";
		return false;
	}
}

function paymententry1process1()
{
	//alert ("inside if");
	if (document.getElementById("collectionamount").value == "")
	{
		alert ("Collection Amount Cannot Be Empty.");
		document.getElementById("collectionamount").focus();
		document.getElementById("collectionamount").value = "0.00"
		return false;
	}
	if (document.getElementById("collectionamount").value == "0.00")
	{
		alert ("Collection Amount Cannot Be Empty.");
		document.getElementById("collectionamount").focus();
		document.getElementById("collectionamount").value = "0.00"
		return false;
	}
	if (isNaN(document.getElementById("collectionamount").value))
	{
		alert ("Collection Amount Can Only Be Numbers.");
		document.getElementById("collectionamount").focus();
		return false;
	}
	if (document.getElementById("collectionmode").value == "")
	{
		alert ("Please Select Collection Mode.");
		document.getElementById("collectionmode").focus();
		return false;
	}
	if (document.getElementById("collectionmode").value == "CHEQUE")
	{
		if(document.getElementById("chequenumber").value == "")
		{
			alert ("If Collection By Cheque, Then Cheque Number Cannot Be Empty.");
			document.getElementById("chequenumber").focus();
			return false;
		} 
		else if (document.getElementById("bankname").value == "")
		{
			alert ("If Collection By Cheque, Then Bank Name Cannot Be Empty.");
			document.getElementById("bankname").focus();
			return false;
		}
	}
	if (document.getElementById("billnumber").value == "")
	{
		alert ("Please Enter Bill Number.");
		document.getElementById("billnumber").focus();
		return false;
	}
	if (isNaN(document.getElementById("billnumber").value))
	{
		alert ("Bill Number Can Only Be Numbers.");
		document.getElementById("billnumber").focus();
		return false;
	}
	if (parseFloat(document.getElementById("collectionamount").value) > parseFloat(document.getElementById("billamountpending").value))
	{
		alert ("Collection Amount Cannot Be More Than The Bill Amount Or Pending Amount.");
		document.getElementById("collectionamount").focus();
		return false;
	}
	
	var fRet; 
	fRet = confirm('Are you sure want to save this collection entry?'); 
	//alert(fRet); 
	//alert(document.getElementById("collectionamount").value); 
	//alert(document.getElementById("pendingamounthidden").value); 
	if (fRet == true)
	{
		var varCollectionAmount = document.getElementById("collectionamount").value; 
		var varCollectionAmount = varCollectionAmount * 1;
		var varPendingAmount = document.getElementById("pendingamounthidden").value; 
		var varPendingAmount = parseInt(varPendingAmount);
		var varPendingAmount = varPendingAmount * 1;
		//alert (varPendingAmount);
		/*
		if (varCollectionAmount > varPendingAmount)
		{
			alert('Collection Amount Is Greater Than Pending Amount. Entry Cannot Be Saved.'); 
			alert ("Collection Entry Not Completed.");
			return false;
		}
		*/
	}
	if (fRet == false)
	{
		alert ("Collection Entry Not Completed.");
		return false;
	}
		
	//return false;
	
}

function funcPrintReceipt1()
{
	//window.open("print_bill1.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber+"","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	window.open("print_collection_receipt1.php","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
}


</script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.style2 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration: none; }
.bodytext311 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1150" border="0" cellspacing="0" cellpadding="2">
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
    <td width="97%" valign="top"><table width="116%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
		
              <form name="cbform1" method="post" action="collectionentry1.php">
		<table width="800" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="4" bgcolor="#CCCCCC" class="bodytext3"><strong>Collection Entry     - Select Customer </strong></td>
              </tr>
            <tr>
              <td colspan="4" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><span class="bodytext32">
              <input name="printreceipt1" type="reset" id="printreceipt1" onClick="return funcPrintReceipt1()" style="border: 1px solid #001E6A" value="Print Receipt - Previous Collection Entry" />
*To Print Other Receipts Please Go To Menu:	Reports	-&gt; Collections Received </span></td>
              </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Customer </td>
              <td width="82%" colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="searchcustomername" type="text" id="searchcustomername" style="border: 1px solid #001E6A;" 
				value="<?php echo $searchcustomername; ?>" size="50" autocomplete="off">
              </span></td>
              </tr>
            <tr>
              <td width="18%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Customer </td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF">
			  <input value="<?php echo $cbcustomername; ?>" name="cbcustomername" type="text" id="cbcustomername" readonly="readonly" onKeyDown="return disableEnterKey()" size="50" style="border: 1px solid #001E6A">
			  <input value="<?php echo $cbcustomercode; ?>" name="customercode" type="text" id="customercode" readonly="readonly" onKeyDown="return disableEnterKey()" size="10" style="border: 1px solid #001E6A"></td>
              </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
			  <input type="hidden" name="searchcustomercode" onBlur="return customercodesearch1()" onKeyDown="return customercodesearch2()" id="searchcustomercode" style="border: 1px solid #001E6A; text-transform:uppercase" value="<?php echo $searchcustomercode; ?>" size="20" /></td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF">
			  <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
                  <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                  <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
            </tr>
          </tbody>
        </table>
		</form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="800" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="30%" bgcolor="#cccccc" class="bodytext31"><strong>Sales Data </strong></td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="13%" bgcolor="#cccccc" class="bodytext31"><strong>Opening Balance </strong></td>
              <td width="12%" bgcolor="#cccccc" class="bodytext31">
			  <div align="right">
			  <?php 
			  echo number_format($openingbalance, 2); 
			  ?>
			  </div>			  </td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Sales </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Collections </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Adjustment </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Balance </strong></div></td>
            </tr>
			<?php
			
/*			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
*/

			$totalsales = "0.00";
			$cashamount2 = "0.00";
			$cardamount2 = "0.00";
			$onlineamount2 = "0.00";
			$chequeamount2 = "0.00";
			$tdsamount2 = "0.00";
			$writeoffamount2 = "0.00";
			$colorloopcount = "0";
			$sno = "0";
			
			$query2 = "select * from master_transaction where customeranum = '$customeranum' and financialyear = '$financialyear' and recordstatus = '' group by customeranum";// and approvalstatus =  'APPROVED' and cstid='$custid' and cstname='$custname'";//  order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['customeranum'];
			$res2customername = $res2['customername'];
			$res2customername = $res2['customername'];
			
			$query3 = "select * from master_transaction where transactiontype = 'SALES' and customeranum = '$res2anum' and financialyear = '$financialyear' and recordstatus = ''";// and approvalstatus =  'APPROVED' and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			while ($res3 = mysql_fetch_array($exec3))
			{
				$transactionamount = $res3['transactionamount'];
				$totalsales = $totalsales + $transactionamount;
			}
		
			$query3 = "select * from master_transaction where transactiontype = 'COLLECTION' and customeranum = '$res2anum' and financialyear = '$financialyear' and recordstatus = ''";// and approvalstatus =  'APPROVED' and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			while ($res3 = mysql_fetch_array($exec3))
			{
				
				$cashamount1 = $res3['cashamount'];
				$onlineamount1 = $res3['onlineamount'];
				$chequeamount1 = $res3['chequeamount'];
				$cardamount1 = $res3['cardamount'];
				$tdsamount1 = $res3['tdsamount'];
				$writeoffamount1 = $res3['writeoffamount'];
				
				$cashamount2 = $cashamount2 + $cashamount1;
				$cardamount2 = $cardamount2 + $cardamount1;
				$onlineamount2 = $onlineamount2 + $onlineamount1;
				$chequeamount2 = $chequeamount2 + $chequeamount1;
				$tdsamount2 = $tdsamount2 + $tdsamount1;
				$writeoffamount2 = $writeoffamount2 + $writeoffamount1;
			}
			
			$totalpayments = $cashamount2 + $chequeamount2 + $onlineamount2 + $cardamount2;
			$netpayments = $totalpayments + $tdsamount2 + $writeoffamount2;
			$balanceamount = $totalsales - $netpayments;
			
			if ($res2customername != '')
			{
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

			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $res2customername; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php echo number_format($totalsales, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			    <div align="right"><?php echo number_format($totalpayments, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php echo number_format($writeoffamount2, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php echo number_format($balanceamount, 2); ?></div></td>
            </tr>
			<?php
			}
			}
			$salesbalance = $balanceamount;
			?>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="800" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="30%" bgcolor="#cccccc" class="bodytext31"><strong>Sales Return Data </strong></td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="13%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="12%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Sales Return </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Payments </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Adjustment </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>By Balance </strong></div></td>
            </tr>
            <?php
			
/*			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
*/
			$transactionamount = "0.00";
			$totalsales = "0.00";
			$cashamount1 = "0.00";
			$onlineamount1 = "0.00";
			$chequeamount1 = "0.00";
			$cardamount1 = "0.00";
			$tdsamount1 = "0.00";
			$writeoffamount1 = "0.00";
			$cashamount2 = "0.00";
			$cardamount2 = "0.00";
			$onlineamount2 = "0.00";
			$chequeamount2 = "0.00";
			$tdsamount2 = "0.00";
			$writeoffamount2 = "0.00";
			$totalpayments = "0.00";
			$netpayments = "0.00";
			$balanceamount = "0.00";
			
			
			
			$query2 = "select * from master_transaction where customeranum = '$customeranum' and transactionmodule = 'SALES RETURN' and recordstatus = '' group by customeranum";// and cstid='$custid' and cstname='$custname'";//  order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['customeranum'];
			$res2customername = $res2['customername'];
			
			$query3 = "select * from master_transaction where transactiontype = 'SALES RETURN' and transactionmodule = 'SALES RETURN' and customeranum = '$res2anum' and recordstatus = ''";// and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			while ($res3 = mysql_fetch_array($exec3))
			{
				$transactionamount = $res3['transactionamount'];
				$totalsales = $totalsales + $transactionamount;
			}
		
			$query3 = "select * from master_transaction where transactiontype = 'PAYMENT' and transactionmodule = 'SALES RETURN' and customeranum = '$res2anum' and recordstatus = ''";// and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			while ($res3 = mysql_fetch_array($exec3))
			{
				$cashamount1 = $res3['cashamount'];
				$onlineamount1 = $res3['onlineamount'];
				$chequeamount1 = $res3['chequeamount'];
				$cardamount1 = $res3['cardamount'];
				$tdsamount1 = $res3['tdsamount'];
				$writeoffamount1 = $res3['writeoffamount'];
				
				$cashamount2 = $cashamount2 + $cashamount1;
				$cardamount2 = $cardamount2 + $cardamount1;
				$onlineamount2 = $onlineamount2 + $onlineamount1;
				$chequeamount2 = $chequeamount2 + $chequeamount1;
				$tdsamount2 = $tdsamount2 + $tdsamount1;
				$writeoffamount2 = $writeoffamount2 + $writeoffamount1;
			}
			
			$totalpayments = $cashamount2 + $chequeamount2 + $onlineamount2 + $cardamount2;
			$netpayments = $totalpayments + $tdsamount2 + $writeoffamount2;
			$balanceamount = $totalsales - $netpayments;
			
			
			
			if ($res2customername != '')
			{
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

			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31"><?php echo $res2customername; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo number_format($totalsales, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo number_format($totalpayments, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo number_format($writeoffamount2, 2); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo number_format($balanceamount, 2); ?></div></td>
            </tr>
            <?php
			}
			}
			$salesreturnbalance = $balanceamount;
			
			$actualbalance = $salesbalance - $salesreturnbalance;
			?>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		
		
		
				<form name="form1" id="form1" method="post" action="collectionentry1.php?cbfrmflag1=<?php echo $cbfrmflag1; ?>" onSubmit="return paymententry1process1()">
			  <table width="800" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                <tbody>
                  <tr bgcolor="#011E6A">
                    <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Collection Entry - Details </strong></td>
                    <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">
					<strong>Actual Balance : <?php echo number_format($openingbalance, 2).' + '.number_format($salesbalance, 2).' - '.number_format($salesreturnbalance, 2).' = '.number_format($actualbalance + $openingbalance, 2); ?></strong></td>
                  </tr>
                  <tr>
                    <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="17%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Pending Amount </td>
                    <td width="29%" align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="pendingamount" id="pendingamount" style="border: 1px solid #001E6A; text-align:right" value="<?php echo number_format($actualbalance + $openingbalance, 2, '.', ''); ?>"  size="20" readonly="readonly" onKeyDown="return disableEnterKey()" />
					<input name="pendingamounthidden" id="pendingamounthidden" type="hidden" value="<?php echo $balanceamount; ?>"  size="20" readonly="readonly" onKeyDown="return disableEnterKey()" />					</td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Entry Date (YYYY-MM-DD) </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="collectionentrydate" id="collectionentrydate" style="border: 1px solid #001E6A" value="<?php echo substr($updatedatetime, 0, 10); ?>"  readonly="readonly" onKeyDown="return disableEnterKey()" size="20" />
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('collectionentrydate')" style="cursor:pointer"/>					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Collection Amount </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="collectionamount" id="collectionamount" onFocus="javascript:select(this);" autocomplete="off" style="border: 1px solid #001E6A; text-align:right" value="0.00"  size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Collection Mode </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<select name="collectionmode" id="collectionmode" style="width: 130px;">
                        <option value="" selected="selected">SELECT</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="CASH">CASH</option>
                        <!--<option value="TDS">TDS</option>-->
                        <option value="ONLINE">ONLINE</option>
                        <option value="WRITEOFF">ADJUSTMENT</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Cheque Number </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="chequenumber" id="chequenumber" style="border: 1px solid #001E6A" value=""  size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Bank Name </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="bankname" id="bankname" style="border: 1px solid #001E6A" value=""  size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Cheque  Date </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo date('Y-m-d'); ?>"  size="20"  readonly="readonly" onKeyDown="return disableEnterKey()"/>
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>					  </td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Remarks</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="remarks" id="remarks" style="border: 1px solid #001E6A" value=""  size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left" valign="middle"  class="bodytext3"><span class="style2">* For Bill Number Wise Collection Entry. ( Optional ) </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Enter Bill Number </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="billnumber" id="billnumber" onBlur="return funcBillNumberCollectionEntryVerify1()" onFocus="javascript:select(this);" autocomplete="off" style="border: 1px solid #001E6A; text-align:right" value=""  size="20" />
                    *</td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><span class="bodytext32">Bill Total Amount</span></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF"><input name="billtotalamount" id="billtotalamount" style="border: 1px solid #001E6A; text-align:right" value="0.00"  size="20" readonly="readonly" onKeyDown="return disableEnterKey()" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><span class="bodytext32">Bill Amount Collected </span></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF"><input name="billamountcollected" id="billamountcollected" style="border: 1px solid #001E6A; text-align:right" value="0.00"  size="20" readonly="readonly" onKeyDown="return disableEnterKey()" /></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><span class="bodytext32">Bill Amount Pending </span></td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="billamountpending" id="billamountpending" style="border: 1px solid #001E6A; text-align:right" value="0.00"  size="20" readonly="readonly" onKeyDown="return disableEnterKey()"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Today Date &amp; Time </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="todaydateandtime" id="todaydateandtime" style="border: 1px solid #001E6A" value="<?php echo $updatedatetime; ?>"  readonly="readonly" onKeyDown="return disableEnterKey()" size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                      <input type="hidden" name="cbfrmflag2" value="<?php echo $customeranum; ?>">
                      <input type="hidden" name="frmflag2" value="frmflag2">
                      <input name="Submit" type="submit"  value="Save Collection" class="button" style="border: 1px solid #001E6A"/>
                    </font></td>
                  </tr>
                </tbody>
              </table>
			  </form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		
		
		
		
<?php
	
if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_POST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$searchcustomername = $_POST['searchcustomername'];
	if ($searchcustomername != '')
	{
		$arraycustomer = explode("#", $searchcustomername);
		$arraycustomername = $arraycustomer[0];
		$arraycustomername = trim($arraycustomername);
		$arraycustomercode = $arraycustomer[1];
		
		$query1 = "select * from master_customer where customercode = '$arraycustomercode'";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$res1 = mysql_fetch_array($exec1);
		$customeranum = $res1['auto_number'];
		$openingbalance = $res1['openingbalance'];

		$cbcustomername = $arraycustomername;
		$customername = $arraycustomername;
	}
	else
	{
		$cbcustomername = $_REQUEST['cbcustomername'];
		$customername = $_REQUEST['cbcustomername'];
	}
	
?>
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1100" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="3%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="24%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="8%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="8%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="9%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="8%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="9%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="11%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
              <td width="14%" bgcolor="#cccccc" class="bodytext311">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bill Number </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bill Date </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong> After Bill </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Bill Amount </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Collected</strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Last Collection </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong> After Collection </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Pending</strong></div></td>
            </tr>
            <?php
			$totalbalance = '';
			$sno = 0;
			$cashamount21 = '';
			$cardamount21 = '';
			$onlineamount21 = '';
			$chequeamount21 = '';
			$tdsamount21 = '';
			$writeoffamount21 = '';
			
			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
			$totalsales1=0;
			
			if (isset($_REQUEST["showbilltype"])) { $showbilltype = $_REQUEST["showbilltype"]; } else { $showbilltype = ""; }
			if ($showbilltype == 'All Bills')
			{
				$showbilltype = '';
			}			
			
			
			
			$query2 = "select * from master_sales where customername like '%$customername%' and recordstatus <> 'deleted' and companyanum = '$companyanum';";
			//$query2 = "select * from master_transaction where transactiontype = 'COLLECTION' and transactionmode <> 'CREDIT' and transactionmodule = 'SALES' and billnumber = '$billnumber' and companyanum='$companyanum' and recordstatus = ''";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$rowcount2 = mysql_num_rows($exec2);
			while ($res2 = mysql_fetch_array($exec2))
			{
				$customername = $res2['customername'];
				$billnumber = $res2['billnumber'];
				$billnumberprefix = $res2['billnumberprefix'];
				$billnumberpostfix = $res2['billnumberpostfix'];
				$billdate = $res2['billdate'];
				$billtotalamount = $res2['totalamount'];
	
				$query3 = "select * from master_transaction where transactiontype = 'COLLECTION' and transactionmode <> 'CREDIT' and billnumber = '$billnumber' and companyanum='$companyanum' and recordstatus = ''";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				while ($res3 = mysql_fetch_array($exec3))
				{
					$cashamount1 = $res3['cashamount'];
					$onlineamount1 = $res3['onlineamount'];
					$chequeamount1 = $res3['chequeamount'];
					$cardamount1 = $res3['cardamount'];
					$tdsamount1 = $res3['tdsamount'];
					$writeoffamount1 = $res3['writeoffamount'];
					
					$cashamount21 = $cashamount21 + $cashamount1;
					$cardamount21 = $cardamount21 + $cardamount1;
					$onlineamount21 = $onlineamount21 + $onlineamount1;
					$chequeamount21 = $chequeamount21 + $chequeamount1;
					$tdsamount21 = $tdsamount21 + $tdsamount1;
					$writeoffamount21 = $writeoffamount21 + $writeoffamount1;
				}
			
				$totalcollection = $cashamount21 + $chequeamount21 + $onlineamount21 + $cardamount21;
				$netcollection = $totalcollection + $tdsamount2 + $writeoffamount2;
				$balanceamount = $billtotalamount - $netcollection;
				
				$billtotalamount = number_format($billtotalamount, 2, '.', '');
				$netcollection = number_format($netcollection, 2, '.', '');
				$balanceamount = number_format($balanceamount, 2, '.', '');
				
				$billstatus = $billtotalamount.'||'.$netcollection.'||'.$balanceamount;
				
				//echo $balanceamount;
				if ($balanceamount != '0.00')
				{
				
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
	
				//if ($balanceamount != 0.00)
				//{
			
				$billdate = substr($billdate, 0, 10);
				$date1 = $billdate;
				
				$dotarray = explode("-", $billdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$billdate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
	
				$billtotalamount = number_format($billtotalamount, 2, '.', '');
				$netcollection = number_format($netcollection, 2, '.', '');
				$balanceamount = number_format($balanceamount, 2, '.', '');
				
				$date1 = $date1;
				$date2 = date("Y-m-d");  
				$diff = abs(strtotime($date2) - strtotime($date1));  
				$days = floor($diff / (60*60*24));  
				$daysafterbilldate = $days;

				$query3 = "select * from master_transaction where transactiontype = 'COLLECTION' and transactionmode <> 'CREDIT' and billnumber = '$billnumber' and companyanum='$companyanum' and recordstatus = '' order by auto_number desc";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				$res3 = mysql_fetch_array($exec3);
				$lastcollectiondate = $res3['transactiondate'];
				$lastcollectiondate = substr($lastcollectiondate, 0, 10);
				
				if ($lastcollectiondate != '')
				{
					$date1 = $lastcollectiondate;
					$date2 = date("Y-m-d");  
					$diff = abs(strtotime($date2) - strtotime($date1));  
					$days = floor($diff / (60*60*24));  
					$daysaftercollectiondate = $days;
					
					$dotarray = explode("-", $lastcollectiondate);
					$dotyear = $dotarray[0];
					$dotmonth = $dotarray[1];
					$dotday = $dotarray[2];
					$lastcollectiondate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				}
				else
				{
					$daysaftercollectiondate = '';
					$lastcollectiondate = '';
				}	
						
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div class="bodytext311">
			  <?php echo $customername; ?></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div align="left">
			  <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div align="right">
			  <?php echo $billdate; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><div align="right"><?php echo $daysafterbilldate.' Days'; ?></div>
                  <div align="right"></div>
                <div align="right"></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div align="right">
                <?php if ($billtotalamount != '0.00') echo $billtotalamount; //echo number_format($billtotalamount, 2); ?>
              </div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div align="right">
                <?php if ($netcollection != '0.00') echo $netcollection; //echo number_format($netcollection, 2); ?>
              </div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><div align="right"> <?php echo $lastcollectiondate; ?> </div>
                  <div align="right"></div>
                <div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left"><div align="right">
                <?php if ($daysaftercollectiondate != '') echo $daysaftercollectiondate.' Days'; ?>
              </div>
                  <div align="right"></div>
                <div align="right"></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left"><div align="right">
                <?php if ($balanceamount != '0.00') echo $balanceamount; //echo number_format($balanceamount, 2); ?>
              </div></td>
            </tr>
            <?php
				$totalbalance = $totalbalance + $balanceamount;
				}

				$cashamount21 = '0.00';
				$cardamount21 = '0.00';
				$onlineamount21 = '0.00';
				$chequeamount21 = '0.00';
				$tdsamount21 = '0.00';
				$writeoffamount21 = '0.00';

				$totalcollection = '0.00';
				$netcollection = '0.00';
				$balanceamount = '0.00';
				
				$billtotalamount = '0.00';
				$netcollection = '0.00';
				$balanceamount = '0.00';
				
				$billstatus = '0.00';
				
				//}
			}
			
			?>
            <tr>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong>
                <?php //echo number_format($totalsalesamount, 2); ?>
              </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong>
                <?php //echo number_format($netpaymentamount, 2); ?>
              </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong>
                <?php //echo number_format($netpaymentamount, 2); ?>
              </strong></div></td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext311" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php if ($totalbalance != '') echo number_format($totalbalance, 2, '.', ''); ?></strong></div></td>
            </tr>
          </tbody>
        </table>
<?php
}
?>	
		
		
		
		
		
		
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

