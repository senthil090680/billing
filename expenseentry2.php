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
$errmsg = "";
$banum = "1";
$bgcolorcode = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{
	$expensemainanum = $_REQUEST['expensemainanum'];
	$query1 = "select * from master_expensemain where auto_number = '$expensemainanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$expensemainname = $res1['expensemainname'];

	$expensesubanum = $_REQUEST['expensesubanum'];
	$query1 = "select * from master_expensesub where auto_number = '$expensesubanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$expensesubname = $res1['expensesubname'];

	$expensedate = $_REQUEST['expensedate'];
	$expenseentrydate = $_REQUEST['expenseentrydate'];
	$expenseamount = $_REQUEST['expenseamount'];
	$expensemode = $_REQUEST['expensemode'];
	$chequenumber = $_REQUEST['chequenumber'];
	$bankname = $_REQUEST['bankname'];
	$chequedate = $_REQUEST['ADate1'];
	$remarks = $_REQUEST['remarks'];
	
	/*
	$query1 = "select * from master_expense where auto_number = '$expensename'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$expensename = $res1['expensename'];
	*/
	
	$transactiondate = $expenseentrydate;
	$transactionamount = $expenseamount;
	$transactionmode1 = $expensemode;
	$ipaddress = $ipaddress;
	$updatedate = $updatedatetime;
	
	//to update transaction master form transaction report.
	$transactiontype1 = $expensename;
	$transactionmodule1 = 'EXPENSE';
	$particulars1 = 'BY EXPENSE - '.$expensename;	
	
	$chequeamount = '0.00';
	$cashamount = '0.00';
	$onlineamount = '0.00';
	$cardamount = '0.00';
	$adjustmentamount = '0.00';

	if ($expensemode == 'CHEQUE') $chequeamount = $expenseamount;	
	if ($expensemode == 'CASH') $cashamount = $expenseamount;	
	if ($expensemode == 'ONLINE') $onlineamount = $expenseamount;	
	if ($expensemode == 'CARD') $cardamount = $expenseamount;	
	if ($expensemode == 'ADJUSTMENT') $adjustmentamount = $expenseamount;	
	
	$query9 = "insert into expensesub_details (expensemainanum, expensemainname, expensesubanum, expensesubname, 
	transactiondate, particulars,  
	transactionmode, transactiontype, transactionamount, ipaddress, 
	cashamount, onlineamount, chequeamount, adjustmentamount, cardamount, 
	updatedate, companyanum, companyname, transactionmodule, 
	chequenumber, bankname, chequedate, remarks) 
	values ('$expensemainanum', '$expensemainname', '$expensesubanum', '$expensesubname', 
	'$transactiondate', '$particulars1',  
	'$transactionmode1', '$transactiontype1', '$transactionamount', '$ipaddress', 
	'$cashamount', '$onlineamount', '$chequeamount', '$adjustmentamount', '$cardamount', 
	'$updatedate', '$companyanum', '$companyname', '$transactionmodule1', 
	'$chequenumber', '$bankname', '$chequedate', '$remarks')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	
	header ("location:expenseentry2.php?st=1");
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == '1')
{
	$errmsg = "Success. Expense Payment Entry Updated.";
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
<script type="text/javascript" src="js/autosuggest3.js"></script>
<script type="text/javascript">


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


function paymententry1process1()
{
	//alert ("inside if");
	/*
	if (document.getElementById("expensename").value == "")
	{
		alert ("Please Select Expense Name.");
		document.getElementById("expensename").focus();
		return false;
	}
	*/
	if (document.getElementById("expensemainanum").value == "")
	{
		alert ("Please Select Expense Main Name.");
		document.getElementById("expensemainanum").focus();
		return false;
	}
	if (document.getElementById("expensesubanum").value == "")
	{
		alert ("Please Select Expense Sub Name.");
		document.getElementById("expensesubanum").focus();
		return false;
	}
	if (document.getElementById("expenseamount").value == "")
	{
		alert ("Expense Amount Cannot Be Empty.");
		document.getElementById("expenseamount").focus();
		document.getElementById("expenseamount").value = "0.00"
		return false;
	}
	if (document.getElementById("expenseamount").value == "0.00")
	{
		alert ("Expense Amount Cannot Be Empty.");
		document.getElementById("expenseamount").focus();
		document.getElementById("expenseamount").value = "0.00"
		return false;
	}
	if (isNaN(document.getElementById("expenseamount").value))
	{
		alert ("Expense Amount Can Only Be Numbers.");
		document.getElementById("expenseamount").focus();
		return false;
	}
	if (document.getElementById("expensemode").value == "")
	{
		alert ("Please Select Expense Mode.");
		document.getElementById("expensemode").focus();
		return false;
	}
	if (document.getElementById("expensemode").value == "CHEQUE")
	{
		if(document.getElementById("chequenumber").value == "")
		{
			alert ("If Expense By Cheque, Then Cheque Number Cannot Be Empty.");
			document.getElementById("chequenumber").focus();
			return false;
		} 
		else if (document.getElementById("bankname").value == "")
		{
			alert ("If Expense By Cheque, Then Bank Name Cannot Be Empty.");
			document.getElementById("bankname").focus();
			return false;
		}
		else if (document.getElementById("ADate1").value == "")
		{
			alert ("If Expense By Cheque, Then Cheque Date Cannot Be Empty.");
			document.getElementById("ADate1").focus();
			return false;
		}
	}
	
		
	//return false;
	
}

function funcPrintReceipt1()
{
	//window.open("print_bill1.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber+"","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	window.open("print_expense_receipt1.php","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
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
        <td >
		
		
		
				<form name="form1" id="form1" method="post" action="expenseentry2.php" onSubmit="return paymententry1process1()">
			  <table width="800" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                <tbody>
                  <tr bgcolor="#011E6A">
                    <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Expense Entry - Details </strong></td>
                    <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="8" align="left" valign="middle"  
					bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?></td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">
                    <input name="printreceipt1" type="reset" id="printreceipt1" onClick="return funcPrintReceipt1()" style="border: 1px solid #001E6A" value="Print Receipt - Previous Expense Entry" />
*To Print Other Receipts Please Go To Menu:	Reports	-&gt; Expense Report </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Expense Main </div></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF"><select name="expensemainanum" id="expensemainanum"  >
                        <option value="" selected="selected">Select Expense Main Name</option>
                        <?php
						$query1 = "select * from master_expensemain where status <> 'deleted'";
						$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$expensemainanum = $res1['auto_number'];
						$expensemainname = $res1['expensemainname'];
						?>
                        <option value="<?php echo $expensemainanum; ?>"><?php echo $expensemainname; ?></option>
                        <?php
						}
						?>
                    </select></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Expense Sub </div></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF">
					<select name="expensesubanum" id="expensesubanum"  >
                        <option value="" selected="selected">Select Expense Sub Name</option>
                        <?php
						$query1 = "select * from master_expensesub where status <> 'deleted'";
						$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$expensesubanum = $res1['auto_number'];
						$expensesubname = $res1['expensesubname'];
						?>
                        <option value="<?php echo $expensesubanum; ?>"><?php echo $expensesubname; ?></option>
                        <?php
						}
						?>
                    </select></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Entry Date (YYYY-MM-DD) </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="expenseentrydate" id="expenseentrydate" style="border: 1px solid #001E6A" value="<?php echo date('Y-m-d'); ?>"  readonly="readonly" onKeyDown="return disableEnterKey()" size="20" />
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('expenseentrydate')" style="cursor:pointer"/>					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Expense Amount </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<input name="expenseamount" id="expenseamount" style="border: 1px solid #001E6A" value="0.00"  size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Expense Mode </td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">
					<select name="expensemode" id="expensemode" style="width: 130px;">
                        <option value="" selected="selected">SELECT</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="CASH">CASH</option>
                        <option value="ONLINE">ONLINE</option>
                        <option value="CARD">CARD</option>
                        <option value="ADJUSTMENT">ADJUSTMENT</option>
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
					<input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php //echo date('Y-m-d'); ?>"  size="20"  readonly="readonly" onKeyDown="return disableEnterKey()"/>
					<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>					  </td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Remarks</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="remarks" id="remarks" style="border: 1px solid #001E6A" value=""  size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                    <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#FFFFFF"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                      <input type="hidden" name="cbfrmflag2" value="<?php echo $customeranum; ?>">
                      <input type="hidden" name="frmflag1" value="frmflag1">
                      <input name="Submit" type="submit"  value="Save Expense" class="button" style="border: 1px solid #001E6A"/>
                    </font></td>
                  </tr>
                </tbody>
              </table>
			  </form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

