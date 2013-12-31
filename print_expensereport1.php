<?php
session_start();
//include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

//echo $_SERVER['REQUEST_URI'] ;
//echo $_REQUEST["companyname"];

$username = '';
$companyanum = '';
$companyname = '';
$financialyear = '';

//Session Not Working on excel export. To get values from request below change is necessary.
if ($companyanum == '') //For print view.
{
	if (isset($_SESSION["username"])) { $username = $_SESSION["username"]; } else { $username = ""; }
	//$username = $_SESSION['username'];
	if (isset($_SESSION["companyanum"])) { $companyanum = $_SESSION["companyanum"]; } else { $companyanum = ""; }
	//$companyanum = $_SESSION['companyanum'];
	if (isset($_SESSION["companyname"])) { $companyname = $_SESSION["companyname"]; } else { $companyname = ""; }
	//$companyname = $_SESSION['companyname'];
	if (isset($_SESSION["financialyear"])) { $financialyear = $_SESSION["financialyear"]; } else { $financialyear = ""; }
	//$financialyear = $_SESSION['financialyear'];
}
if ($companyanum == '')  // For excel export.
{
	if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
	//$username = $_REQUEST['username'];
	if (isset($_REQUEST["companyanum"])) { $companyanum = $_REQUEST["companyanum"]; } else { $companyanum = ""; }
	//$companyanum = $_REQUEST['companyanum'];
	if (isset($_REQUEST["companyname"])) { $companyname = $_REQUEST["companyname"]; } else { $companyname = ""; }
	//$companyname = $_REQUEST['companyname'];
	if (isset($_REQUEST["financialyear"])) { $financialyear = $_REQUEST["financialyear"]; } else { $financialyear = ""; }
	//$financialyear = $_REQUEST['financialyear'];
}

$expensedatefrom = date('Y-m-d', strtotime('-1 month'));
$expensedateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{
	$expensedatefrom = $_REQUEST['ADate1'];
	$expensedateto = $_REQUEST['ADate2'];
}


?>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<script language="javascript">

function escapekeypressed()
{
	//alert(event.keyCode);
	if(event.keyCode=='27'){ window.close(); }
}

</script>
<!--onLoad="window.print();"-->
<body  onkeydown="escapekeypressed()">
<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1571" 
            align="left" border="0">
  <tbody>
    <tr>
      <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td width="9%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
      <td width="12%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
    </tr>
    <tr>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
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
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $paymentdate; ?></a></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $res2expensemainname.' - '.$res2expensesubname; ?></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($paymentamount != '0.00') echo $paymentamount; //echo $paymentamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($cashamount != '0.00') echo $cashamount; //echo $cashamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($cardamount != '0.00') echo $cardamount; //echo $cardamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($onlineamount != '0.00') echo $onlineamount; //echo $onlineamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($chequeamount != '0.00') echo $chequeamount; //echo $chequeamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="right">
        <?php if ($adjustmentamount != '0.00') echo $adjustmentamount; //echo $adjustmentamount; ?>
      </div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $paymentmode; ?></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $chequenumber; ?></a></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $chequedate; ?></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $bankname.' '.$bankbranch; ?></div></td>
      <td class="bodytext31" valign="center"  align="left"><div align="left"><?php echo $remarks; ?></div></td>
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
    </tr>
  </tbody>
</table>
</body>