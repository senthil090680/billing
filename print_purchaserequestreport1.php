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

$cbsuppliername = '';
$cbbillnumber = '';
$suppliername = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';

$totalsumtotalamount1  = '';
$totalsumcashamount1  = '';
$totalsumchequeamount1  = '';
$totalsumonlineamount1  = '';
$totalsumcardamount1 = '';
$totalsumcreditamount1 = '';
$totalsumbalancebillamount1 = '';
$totalsumsubtotal1 = '';
$totalsumtotaltax1 = '';
$totalpackaging1 = '';
$totaldelivery1 = '';

if ($companyanum == '')
{
	$companyanum = $_GET['companyanum'];
	$companyname = $_GET['companyname'];
}
//echo $companyanum;
//echo $companyname;

$query1 = "select * from master_company where auto_number = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$companyname = $res1['companyname'];

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["paymenttype"])) { $paymenttype = $_REQUEST["paymenttype"]; } else { $paymenttype = ""; }
//$paymenttype = $_REQUEST['paymenttype'];

if (isset($_REQUEST["canum"])) { $getcanum = $_REQUEST["canum"]; } else { $getcanum = ""; }
//$getcanum = $_GET['canum'];
if ($getcanum != '')
{
	$query4 = "select * from master_supplier where auto_number = '$getcanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$cbsuppliername = $res4['suppliername'];
	$suppliername = $res4['suppliername'];
}



//$cbfrmflag1 = $_POST['cbfrmflag1'];
//if ($cbfrmflag1 == 'cbfrmflag1')
//if ($transactiondatefrom != '')
//{

	if (isset($_REQUEST["searchsuppliername"])) { $searchsuppliername = $_REQUEST["searchsuppliername"]; } else { $searchsuppliername = ""; }
	//$searchsuppliername = $_POST['searchsuppliername'];
	if ($searchsuppliername != '')
	{
		$arraysupplier = explode("#", $searchsuppliername);
		$arraysuppliername = $arraysupplier[0];
		$arraysuppliername = trim($arraysuppliername);
		$arraysuppliercode = $arraysupplier[1];

		$cbsuppliername = $arraysuppliername;
		$suppliername = $arraysuppliername;
	}
	else
	{
		$cbsuppliername = $_REQUEST['cbsuppliername'];
		$suppliername = $_REQUEST['cbsuppliername'];
	}

	if ($_REQUEST['ADate1'] != '' && $_REQUEST['ADate2'] != '')
	{
		$transactiondatefrom = $_REQUEST['ADate1'];
		$transactiondateto = $_REQUEST['ADate2'];
	}
	else
	{
		$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
		$transactiondateto = date('Y-m-d');
	}

//}
//else
//{
	//exit;
//}


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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="973" 
            align="left" border="1">
  <tbody>
    
            <tr>
              <td colspan="18" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Purchase Request  Report</strong></div></td>
            </tr>
            <tr>
              <td colspan="18" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong><?php echo $companyname; ?></strong>&nbsp;</div></td>
            </tr>
            <tr>
              <td colspan="18" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong><?php echo 'Report Date From '.$transactiondatefrom.' To '.$transactiondateto; ?></strong></div></td>
            </tr>
            <tr>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><strong>SNo.</strong></td>
              <!--<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>PDF</strong></td>-->
              <td width="3%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill </strong></div></td>
              <td width="11%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> BillDateShow</strong></div></td>
              <td width="15%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><strong> Supplier </strong></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Nett</strong></div></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cash</strong></div></td>
              <td width="6%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Cheque</strong></div></td>
              <td width="5%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Online</strong></div></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Card</strong></div></td>
              <td width="5%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Credit</strong></div></td>
              <td width="6%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Pending</strong></div></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Total</strong></div></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Tax</strong></span></td>
              <td width="7%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Packing</strong></span></td>
              <td width="7%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><span class="bodytext31"><strong>Delivery</strong></span></td>
              <!--<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>Delivery</strong></td>-->
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><strong>Nett</strong></td>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="7%" align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Remarks</strong></div></td>
            </tr>
            <?php
			
			if (isset($_REQUEST["approvalstatus"])) { $approvalstatus = $_REQUEST["approvalstatus"]; } else { $approvalstatus = ""; }
			//$approvalstatus = $_REQUEST['approvalstatus'];
			if (isset($_REQUEST["financialyear"])) { $financialyear = $_REQUEST["financialyear"]; } else { $financialyear = ""; }
			//$financialyear = $_REQUEST['financialyear'];
			
			if ($financialyear == '') $financialyear = $_SESSION['financialyear'];
			if ($financialyear == 'Show All') $financialyear = '';
			
			if ($billstatus == 'CONFIRMED')
			{
				$billstatusquery1 = " recordstatus <> 'deleted' ";
			}
			else if ($billstatus == '')
			{
				$billstatusquery1 = " recordstatus <> 'deleted' ";
			}
			else
			{
				$billstatusquery1 = " recordstatus = 'deleted' ";
			}

			/*
			if ($approvalstatus == '')
			{
				$approvalstatusquery1 = "and approvalstatus =  'APPROVED'";
			}
			if ($approvalstatus == 'ALL')
			{
				$approvalstatusquery1 = "";
			}
			else if ($approvalstatus == 'APPROVED')
			{
				$approvalstatusquery1 = "and approvalstatus =  'APPROVED'";
			}
			else if ($approvalstatus == 'PENDING')
			{
				$approvalstatusquery1 = "and approvalstatus =  'PENDING'";
			}
			else if ($approvalstatus == 'DENIED')
			{
				$approvalstatusquery1 = "and approvalstatus =  'DENIED'";
			}
			*/

			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));

			$billnumarray = explode('-', $cbbillnumber);
			//print_r($billnumarray);
			if (count($billnumarray) == 0)
			{
				$billnumberprefix = $billnumarray[0];
				$cbbillnumber = $billnumarray[1];
			}
			else
			{
				$billnumberprefix = '';
				$cbbillnumber = '';
			}
			if ($cbbillnumber == '') $cbbillnumber = $billnumberprefix;
			//echo $billnumber;
			//$cbbillnumber = $cbbillnumber;

			
			//$query2 = "select * from master_purchaserequest where suppliername like '%$suppliername%' and billnumber like '%$cbbillnumber%' and recordstatus = '$billstatus' and billtype like '%$paymenttype%' and companyanum = '$companyanum' and lastupdate between '$transactiondatefrom' and '$transactiondateto' order by lastupdate desc";
			$query2 = "select * from master_purchaserequest where suppliername like '%$suppliername%' and billnumber like '%$cbbillnumber%' 
			and $billstatusquery1 and billtype like '%$paymenttype%' and companyanum = '$companyanum' and 
			billdate between '$transactiondatefrom' and '$transactiondateto' order by billnumber desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['auto_number'];
			$billautonumber = $res2['auto_number'];
			$suppliername = $res2['suppliername'];
			$city = $res2['city'];
			//$contact = $res2['contactperson'];
			$totalamount = $res2['totalamount'];
			$billnumberprefix = $res2['billnumberprefix'];
			$billnumber = $res2['billnumber'];
			$billnumberpostfix = $res2['billnumberpostfix'];
			//if ($billnumber1 != '') $billnumber2 = $billnumber1.'-'.$billnumber2;
			//$billdate = $res2['lastupdate'];
			$billdate = $res2['billdate'];
			//$billdate = substr($billdate, 0, 11);
			$res2anum = $res2['auto_number'];
			//$paymentdate = $res2['paymententrydate'];
			//$paymentdate = substr($paymentdate, 0, 11);
			//$paymentmode = $res2['paymentmode'];
			//$chequenumber = $res2['chequenumber'];
			$remarks = $res2['remarks'];
			//$packaging = $res2['packaging'];
			$packaging = '';
			$delivery = $res2['delivery'];
			//$res2financialyear = $res2['financialyear'];
			$res2financialyear = '';
			
			//$billstatus = $res2['status'];
			//$billstatus = strtoupper($billstatus);
			//if ($billstatus == '') $billstatus = 'pending';
			//if ($billstatus == 'CLOSED') $changestatus = 'Open This Bill';
			if ($billstatus == 'CLOSED') $closebill = '';
			if ($billstatus == 'OPEN') $closebill = 'Close Bill';
			
			$res2loopcount = $res2loopcount + 1;
			
			$subtotal = $res2['subtotal'];
			//$totaldiscountpercent = $res2['totaldiscountpercent'];
			//$totaldiscountamount = $res2['totaldiscountamount'];
			//$totalafterdiscount = $res2['totalafterdiscount'];
			//$totaltax = $res2['totaltax'];
			//$totalaftertax = $res2['totalaftertax'];
			//$transportation = $res2['transportation'];
			//$delivery=$res2['delivery'];
			
			$query21 = "select sum(taxamount) as sumtaxamount from purchaserequest_tax where bill_autonumber = '$res2anum'  
			and companyanum = '$companyanum' and 
			updatedate between '$transactiondatefrom' and '$transactiondateto' order by updatedate desc";
			$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
			$res21 = mysql_fetch_array($exec21);
			$sumtaxamount = $res21['sumtaxamount'];
			$totaltax = $sumtaxamount;
			
			$res2billnumber = $res2['billnumber'];
			
			$res2billnumber = $res2['billnumber'];
			$query3 = "select sum(cashamount) as sumcashamount, sum(chequeamount) as sumchequeamount, 
			sum(tdsamount) as sumtdsamount, sum(writeoffamount) as sumwriteoff, sum(onlineamount) as sumonlineamount,  
			sum(creditamount) as sumcreditamount, sum(cardamount) as sumcardamount  
			from master_transaction where billnumber = '$res2billnumber' and 
			transactiontype = 'COLLECTION' and companyanum = '$companyanum' and 
			transactionmodule = 'Proforma Invoice' 
			and supplieranum = '0' and 
			suppliername = '' and cstid='$custid' and cstname='$custname'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			$res3 = mysql_fetch_array($exec3);
			
			$sumcashamount = $res3['sumcashamount'];
			$sumonlineamount = $res3['sumonlineamount'];
			$sumonlineamount = $res3['sumonlineamount'];
			$sumchequeamount = $res3['sumchequeamount'];
			$sumcreditamount = $res3['sumcreditamount'];
			$sumcardamount = $res3['sumcardamount'];
			$sumtdsamount = $res3['sumtdsamount'];
			$sumwriteoff = $res3['sumwriteoff'];

			$totalsumamount = $sumcashamount + $sumonlineamount + $sumchequeamount + $sumcardamount + $sumtdsamount + $sumwriteoff;
			
			$balancebillamount = $totalamount - $totalsumamount;
			$balancebillamount = number_format($balancebillamount, 2, '.', '');
			$totalsumamount = number_format($totalsumamount, 2, '.', '');
			
			  if ($billstatus == 'OPEN')
			  {
			  	//$colorcode = 'bgcolor="#66CC66"';
			  	$colorcode = 'bgcolor="#CBDBFA"';
			  }
			  if ($billstatus == 'CLOSED')
			  {
			  	//$colorcode = 'bgcolor="#FFCC99"';
			  	$colorcode = 'bgcolor="#D3EEB7"';
			  }
			  if ($billstatus == 'DELETED')
			  {
			  	//$colorcode = 'bgcolor="#FFCC99"';
			  }
			  
			  
	
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
			if ($showcolor == 0)
			{
				$colorcode = 'bgcolor="#CBDBFA"';
			}
			else
			{
				$colorcode = 'bgcolor="#D3EEB7"';
			}
		  
			?>
            <tr <?php //echo $colorcode; ?>>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><?php echo $res2loopcount; ?></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="left"> <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="left">
                  <?php 
				 /*
				//echo $billdate; 
				$dotarray = explode("-", $billdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$billdate2 = $dbdateday;
				echo $billdate2;
				*/
				$billtime = substr($billdate, 11, 8);
				$billdateonly = substr($billdate, 0, 10);
				$dotarray = explode("-", $billdateonly);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
				$billdate2 = $dbdateday;
				echo $billdate2;


				if ($billstatus == 'DELETED') { $balancebillamount = ''; }
				
				$totalsumtotalamount1  = $totalsumtotalamount1 + $totalamount;
				$totalsumcashamount1  = $totalsumcashamount1 + $sumcashamount;
				$totalsumchequeamount1  = $totalsumchequeamount1 + $sumchequeamount;
				$totalsumonlineamount1  = $totalsumonlineamount1 + $sumonlineamount;
				$totalsumcardamount1  = $totalsumcardamount1 + $sumcardamount;
				$totalsumcreditamount1  = $totalsumcreditamount1 + $sumcreditamount;
				$totalsumbalancebillamount1  = $totalsumbalancebillamount1 + $balancebillamount;
				$totalsumsubtotal1  = $totalsumsubtotal1 + $subtotal;
				$totalsumtotaltax1  = $totalsumtotaltax1 + $totaltax;
				$totalpackaging1 = $totalpackaging1 + $packaging;
				$totaldelivery1 = $totaldelivery1 + $delivery;
				
			?>
              </div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div class="bodytext31"> <?php echo $suppliername; ?></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $totalamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumcashamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumchequeamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumonlineamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumcardamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumcreditamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $balancebillamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $subtotal; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $totaltax; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $packaging; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $delivery; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $totalamount; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="left"> <?php echo $remarks; ?></div></td>
            </tr>
				<?php
				}
				?>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong>Total : </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumtotalamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumcashamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumchequeamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumonlineamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumcardamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumcreditamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumbalancebillamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumsubtotal1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumtotaltax1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalpackaging1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totaldelivery1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumtotalamount1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
  </tbody>
</table>
</body>