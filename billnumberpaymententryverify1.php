<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include ("db/db_connect.php");
include ("includes/loginverify.php");
$updatedatetime = date("Y-m-d H:i:s");
$indiandatetime = date ("d-m-Y H:i:s");
$dateonly=date("Y-m-d");
$username = $_SESSION['username'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$financialyear = $_SESSION['financialyear'];
$billstatus = "";
$billnumber = $_REQUEST['billnumber'];
$suppliercode = $_REQUEST['suppliercode'];

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

$query2 = "select * from master_purchase where billnumber = '$billnumber' and suppliercode = '$suppliercode' and recordstatus <> 'deleted' and companyanum = '$companyanum'";// and financialyear = '$financialyear'";
//$query2 = "select * from master_transaction where transactiontype = 'PAYMENT' and transactionmode <> 'CREDIT' and transactionmodule = 'SALES' and billnumber = '$billnumber' and companyanum='$companyanum' and recordstatus = ''";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$rowcount2 = mysql_num_rows($exec2);

	if ($rowcount2 == 0)
	{
		$billstatus = 'BillNumberNotExists';
	}
	else
	{
		//$singlerecord = 'BillNumberExists';
		$res2 = mysql_fetch_array($exec2);
		$billtotalamount = $res2['totalamount'];

		$query3 = "select * from master_transaction where transactiontype = 'PAYMENT' and transactionmode <> 'CREDIT' and billnumber = '$billnumber' and companyanum='$companyanum' and recordstatus = ''";// and financialyear = '$financialyear'";
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
		
		$totalpayment = $cashamount2 + $chequeamount2 + $onlineamount2 + $cardamount2;
		$netpayment = $totalpayment + $tdsamount2 + $writeoffamount2;
		$balanceamount = $billtotalamount - $netpayment;
		
		$billtotalamount = number_format($billtotalamount, 2, '.', '');
		$netpayment = number_format($netpayment, 2, '.', '');
		$balanceamount = number_format($balanceamount, 2, '.', '');
		
		$billstatus = $billtotalamount.'||'.$netpayment.'||'.$balanceamount;
	}

echo $billstatus;

?>