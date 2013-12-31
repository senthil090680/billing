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
$errmsg = '';
$banum = '';

$expensedatefrom = date('Y-m-d', strtotime('-1 month'));
$expensedateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{
	$expensedatefrom = $_REQUEST['ADate1'];
	$expensedateto = $_REQUEST['ADate2'];
}

if (isset($_REQUEST["task"])) { $task = $_REQUEST["task"]; } else { $task = ""; }
//$task = $_REQUEST['task'];
if ($task == 'deleted')
{
	$errmsg = "Expense Entry Delete Completed.";
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
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<script language="javascript">

function funcPrintReceipt1(varRecAnum)
{
	var varRecAnum = varRecAnum
	//alert (varRecAnum);
	//window.open("print_bill1.php?printsource=billpage&&billautonumber="+varBillAutoNumber+"&&companyanum="+varBillCompanyAnum+"&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber+"","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	window.open("print_expense_receipt1.php?receiptanum="+varRecAnum+"","OriginalWindow<?php echo $banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
}

function funcDeleteExpense1(varExpenseSerialNumber)
{
	var varExpenseSerialNumber = varExpenseSerialNumber;
	var fRet;
	fRet = confirm('Are you sure want to delete this expense entry serial number '+varExpenseSerialNumber+'?');
	//alert(fRet);
	if (fRet == true)
	{
		alert ("Expense Entry Delete Completed.");
		//return false;
	}
	if (fRet == false)
	{
		alert ("Expense Entry Delete Not Completed.");
		return false;
	}
	//return false;
}

</script>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1900" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="116%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
		
              <form name="cbform1" method="post" action="expensereport2.php">
		<table width="700" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Expense Report </strong></td>
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
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
              <td align="left" valign="middle"  bgcolor="#FFFFFF">&nbsp;</td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Expense Sub </div></td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF"><select name="expensesubanum" id="expensesubanum"  >
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
              <td align="left" valign="middle"  bgcolor="#FFFFFF"><span class="bodytext3"> Expense Mode </span></td>
              <td align="left" valign="top"  bgcolor="#FFFFFF">
			  <select name="expensemode" id="expensemode" style="width: 130px;">
                        <option value="" selected="selected">All</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="CASH">CASH</option>
                        <option value="ONLINE">ONLINE</option>
                        <option value="CARD">CARD</option>
                        <option value="ADJUSTMENT">ADJUSTMENT</option>
                    </select>					</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"> Date From </td>
              <td width="34%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $expensedatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>				</td>
              <td width="16%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
              <td width="33%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $expensedateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
			  </span></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1571" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td colspan="12" bgcolor="<?php if ($errmsg == '') { echo '#cccccc'; } else { echo '#AAFF00'; } ?>" class="bodytext31">
			  <?php echo $errmsg;?>&nbsp;
			  <?php
				if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
				//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					if (isset($_REQUEST["expensemainanum"])) { $expensemainanum = $_REQUEST["expensemainanum"]; } else { $expensemainanum = ""; }
					//$expensemainanum = $_REQUEST['expensemainanum'];
					if (isset($_REQUEST["expensesubanum"])) { $expensesubanum = $_REQUEST["expensesubanum"]; } else { $expensesubanum = ""; }
					//$expensesubanum = $_REQUEST['expensesubanum'];
					if (isset($_REQUEST["expensemode"])) { $expensemode = $_REQUEST["expensemode"]; } else { $expensemode = ""; }
					//$expensemode = $_REQUEST['expensemode'];
					
					//$expensemainanum = $_REQUEST['expensemainanum'];
					//$expensesubanum = $_REQUEST['expensesubanum'];
					//$expensemode = $_REQUEST['expensemode'];
					
					$expensedatefrom = $_REQUEST['ADate1'];
					$expensedateto = $_REQUEST['ADate2'];
					
					$urlpath = "cbfrmflag1=$cbfrmflag1&&expensemainanum=$expensemainanum&&expensesubanum=$expensesubanum&&expensemode=$expensemode&&ADate1=$expensedatefrom&&ADate2=$expensedateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				else
				{
					//$urlpath = "cbfrmflag1=$cbfrmflag1&&expensemainanum=$expensemainanum&&expensesubanum=$expensesubanum&&expensemode=$expensemode&&ADate1=$expensedatefrom&&ADate2=$expensedateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
					$urlpath = "";
				}
				?>
 				<?php
				//For excel file creation.
				
				$applocation1 = $applocation1; //Value from db_connect.php file giving application path.
				$filename1 = "print_expensereport1.php?$urlpath";
				$fileurl = $applocation1."/".$filename1;
				$filecontent1 = @file_get_contents($fileurl);
				
				$indiatimecheck = date('d-M-Y-H-i-s');
				$foldername = "dbexcelfiles";
				$fp = fopen($foldername.'/ExpenseReport.xls', 'w+');
				fwrite($fp, $filecontent1);
				fclose($fp);

				?>
                <script language="javascript">
				function printbillreport1()
				{
					window.open("print_expensereport1.php?<?php echo $urlpath; ?>","Window1",'width=900,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				function printbillreport2()
				{
					window.location = "dbexcelfiles/ExpenseReport.xls"
				}
				</script>
                <input value="Print Report" onClick="javascript:printbillreport1()" name="printreport" type="submit" id="printreport"  style="border: 1px solid #001E6A" />
&nbsp;				<input value="Export Excel" onClick="javascript:printbillreport2()" name="excelexport" type="button" id="excelexport"  style="border: 1px solid #001E6A" />
			  </td>
              <td width="9%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="12%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td width="3%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Print</strong></div></td>
              <td width="9%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Date </strong></div></td>
              <td width="13%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Particulars </strong></div></td>
              <td width="6%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Paid Amount </strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cash</strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Card</strong></div></td>
              <td width="6%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Online</strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cheque</strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Adjustments</strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Mode </strong></div></td>
              <td width="6%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cheque No. </strong></div></td>
              <td width="8%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cheque Date </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bank Name </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Remarks</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Delete</strong></div></td>
              </tr>
			<?php
			$snocount = '';
			$colorloopcount = '';
			$pendingamount = '0.00';
			$looptotalpaidamount = '0.00';
			$looptotalpendingamount = '0.00';
			$looptotaladjustmentamount = '0.00';
			$looptotalcashamount = '0.00';
			$looptotalcreditamount = '0.00';
			$looptotalcardamount = '0.00';
			$looptotalonlineamount = '0.00';
			$looptotalchequeamount = '0.00';
			$looptotaltdsamount = '0.00';
			$looptotaladjustmentamount = '0.00';
			
			if (isset($_REQUEST["expensemainanum"])) { $expensemainanum = $_REQUEST["expensemainanum"]; } else { $expensemainanum = ""; }
			//$expensemainanum = $_REQUEST['expensemainanum'];
			
			$query1 = "select * from master_expensemain where auto_number = '$expensemainanum'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			$res1 = mysql_fetch_array($exec1);
			$expensemainname = $res1['expensemainname'];
		
			if (isset($_REQUEST["expensesubanum"])) { $expensesubanum = $_REQUEST["expensesubanum"]; } else { $expensesubanum = ""; }
			//$expensesubanum = $_REQUEST['expensesubanum'];
			
			$query1 = "select * from master_expensesub where auto_number = '$expensesubanum'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			$res1 = mysql_fetch_array($exec1);
			$expensesubname = $res1['expensesubname'];
			
			if (isset($_REQUEST["expensemode"])) { $expensemode = $_REQUEST["expensemode"]; } else { $expensemode = ""; }
			//$expensemode = $_REQUEST['expensemode'];
			
			$dotarray = explode("-", $expensedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$expensedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
			
			//$query1 = "select * from master_expense where auto_number = '$expensename'";
			//$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			//$res1 = mysql_fetch_array($exec1);
			//$expensename = $res1['expensename'];

		  //$query2 = "select * from expensesub_details where expensemainname like '%$expensemainname%' and expensesubname like '%$expensesubname%' and transactiontype like '%$expensename%' and transactionmode like '%$expensemode%' and recordstatus <> 'DELETED' and companyanum = '$companyanum' and transactiondate between '$expensedatefrom' and '$expensedateto' order by transactiondate, auto_number desc";
		  $query2 = "select * from expensesub_details where expensemainname like '%$expensemainname%' and expensesubname like '%$expensesubname%' and transactionmode like '%$expensemode%' and recordstatus <> 'DELETED' and companyanum = '$companyanum' and transactiondate between '$expensedatefrom' and '$expensedateto' order by transactiondate, auto_number desc";
		  $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		  $rowcount2 = mysql_num_rows($exec2);
		  if ($rowcount2 != 0)
		  {
		  while ($res2 = mysql_fetch_array($exec2))
		  {
     	  $receiptanum = $res2['auto_number'];
		  $paymentamount = '0.00';
		  
		  $res2expensemainname = $res2['expensemainname'];
		  $res2expensesubname = $res2['expensesubname'];
		  
		  $dateofpayment = $res2['transactiondate'];
		  $typeofpayment = $res2['particulars'];
		  $cashamount = $res2['cashamount'];
		  $creditamount = $res2['creditamount'];
		  $onlineamount = $res2['onlineamount'];
		  $cardamount = $res2['cardamount'];
		  $chequeamount = $res2['chequeamount'];
		  $tdsamount = '';
		  $adjustmentamount = $res2['adjustmentamount'];
		  $transactionamount = $res2['transactionamount'];
		  
			$totalamount = $res2['transactionamount'];
			$paymentdate = $res2['transactiondate'];
			$paymentmode = $res2['transactionmode'];
			$chequenumber = $res2['chequenumber'];
			$chequedate = $res2['chequedate'];
			$chequedate = substr($chequedate, 0, 11);
			$bankname = $res2['bankname'];
			$bankbranch = $res2['bankbranch'];
			$remarks = $res2['remarks'];

		  if ($cashamount != '0.00') { $paymentamount = $cashamount; }
		  if ($creditamount != '0.00') { $paymentamount = $creditamount; }
		  if ($onlineamount != '0.00') { $paymentamount = $onlineamount; }
		  if ($cardamount != '0.00') { $paymentamount = $cardamount; }
		  if ($chequeamount != '0.00') { $paymentamount = $chequeamount; }
		  if ($adjustmentamount != '0.00') { $paymentamount = $adjustmentamount; }
		
			
			if ($paymentamount != '0.00')
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
			
			$snocount = $snocount + 1;
			
			$paymentdate = substr($paymentdate, 0, 10);
			$dotarray = explode("-", $paymentdate);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$paymentdate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));

			?>
           <tr <?php echo $colorcode; ?>>
             <td class="bodytext31" valign="center"  align="left"><?php echo $snocount; ?></td>
             <td class="bodytext31" valign="center"  align="left"><div align="center"> 
			 <a href="#" class="bodytext31" onClick="return funcPrintReceipt1('<?php echo $receiptanum; ?>')">Print</a></div></td>
             <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $paymentdate; ?></a></div></td>
              <td class="bodytext31" valign="center"  align="left">
			    <div align="left"><?php echo $res2expensemainname.' - '.$res2expensesubname; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($paymentamount != '0.00') echo $paymentamount; //echo $paymentamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($cashamount != '0.00') echo $cashamount; //echo $cashamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($cardamount != '0.00') echo $cardamount; //echo $cardamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($onlineamount != '0.00') echo $onlineamount; //echo $onlineamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($chequeamount != '0.00') echo $chequeamount; //echo $chequeamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="right"><?php if ($adjustmentamount != '0.00') echo $adjustmentamount; //echo $adjustmentamount; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="left"><?php echo $paymentmode; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
                <div align="left"><?php echo $chequenumber; ?></a></div></td><td class="bodytext31" valign="center"  align="left">
				<div align="left"><?php echo $chequedate; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="left"><?php echo $bankname.' '.$bankbranch; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $remarks; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div align="center">
			  <a href="expensedelete2.php?task=delete&&anum=<?php echo $receiptanum; ?>" onClick="return funcDeleteExpense1(<?php echo $snocount;?>)">
			  <img src="images/b_drop.png" width="16" height="16" border="0">			  </a>			  </div>			  </td>
              </tr>
			<?php
			
			$looptotalpaidamount = $paymentamount + $looptotalpaidamount;
			$looptotalpendingamount = $pendingamount + $looptotalpendingamount;
			$looptotaladjustmentamount = $adjustmentamount + $looptotaladjustmentamount;
			$looptotalcashamount = $cashamount + $looptotalcashamount;
			$looptotalcreditamount = $creditamount + $looptotalcreditamount;
			$looptotalcardamount = $cardamount + $looptotalcardamount;
			$looptotalonlineamount = $onlineamount + $looptotalonlineamount;
			$looptotalchequeamount = $chequeamount + $looptotalchequeamount;
			$looptotaltdsamount = $tdsamount + $looptotaltdsamount;
			$looptotaladjustmentamount = $adjustmentamount + $looptotaladjustmentamount;
			
			}
			}
			}
		    
			$looptotalpaidamount = number_format($looptotalpaidamount, 2, '.', '');
			$looptotalpendingamount = number_format($looptotalpendingamount, 2, '.', '');
			$looptotaladjustmentamount = number_format($looptotaladjustmentamount, 2, '.', '');
			$looptotalcashamount = number_format($looptotalcashamount, 2, '.', '');
			$looptotalcreditamount = number_format($looptotalcreditamount, 2, '.', '');
			$looptotalcardamount = number_format($looptotalcardamount, 2, '.', '');
			$looptotalonlineamount = number_format($looptotalonlineamount, 2, '.', '');
			$looptotalchequeamount = number_format($looptotalchequeamount, 2, '.', '');
			$looptotaltdsamount = number_format($looptotaltdsamount, 2, '.', '');
			$looptotaladjustmentamount = number_format($looptotaladjustmentamount, 2, '.', '');

			?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotalpaidamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotalcashamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotalcardamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotalonlineamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotalchequeamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $looptotaladjustmentamount; ?></strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
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
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

