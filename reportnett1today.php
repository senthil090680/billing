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

//$transactiondatefrom = date('Y-m-d', strtotime('-1 day'));
$transactiondatefrom = date('Y-m-d');//, strtotime('-1 day'));
$transactiondateto = date('Y-m-d');
$todaydate = date('Y-m-d');

//echo $arraycustomercode;
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




</script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<body>
<table width="1150" border="0" cellspacing="0" cellpadding="2">
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
        <td>
		
		
              <form name="cbform1" method="post" action="collectionageing1bybillnumber1.php">
		<table width="600" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td width="59%" bgcolor="#CCCCCC" class="bodytext3"><strong>Report Nett Today</strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="600" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="47%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="23%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="22%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong> Particulars </strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>By Collection</strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="right"><strong>By Payment</strong></div></td>
              </tr>
			<?php
			$sno = '';
			
			//To Calculate Total Sales Today.
			$query2 = "select sum(cashamount) as sumcashsalesamount from master_transaction where recordstatus <> 'DELETED' and 
			supplieranum = '0' and suppliername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'COLLECTION' and transactionmodule = 'SALES' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashsalesamount = $res2['sumcashsalesamount'];

			$query2 = "select sum(cashamount) as sumcashsalesreturnamount from master_transaction where recordstatus <> 'DELETED' and 
			supplieranum = '0' and suppliername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'PAYMENT' and transactionmodule = 'SALES RETURN' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashsalesreturnamount = $res2['sumcashsalesreturnamount'];

			$query2 = "select sum(cashamount) as sumcashpurchaseamount from master_transaction where recordstatus <> 'DELETED' and 
			customeranum = '0' and customername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'PAYMENT' and transactionmodule = 'PURCHASE' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashpurchaseamount = $res2['sumcashpurchaseamount'];

			$query2 = "select sum(cashamount) as sumcashpurchasereturnamount from master_transaction where recordstatus <> 'DELETED' and 
			customeranum = '0' and customername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'COLLECTION' and transactionmodule = 'PURCHASE RETURN' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashpurchasereturnamount = $res2['sumcashpurchasereturnamount'];

			$query2 = "select sum(cashamount) as sumcashcollectionamount from master_transaction where recordstatus <> 'DELETED' and 
			supplieranum = '0' and suppliername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'COLLECTION' and transactionmodule = 'COLLECTION' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashcollectionamount = $res2['sumcashcollectionamount'];

			$query2 = "select sum(cashamount) as sumcashpaymentamount from master_transaction where recordstatus <> 'DELETED' and 
			customeranum = '0' and customername = '' and companyanum = '$companyanum' and 
			transactiondate like '%$todaydate%' and 
			transactiontype = 'PAYMENT' and transactionmodule = 'PAYMENT' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashpaymentamount = $res2['sumcashpaymentamount'];

			$query2 = "select sum(cashamount) as sumcashexpenseamount from expensesub_details where recordstatus <> 'DELETED' and 
			companyanum = '$companyanum' and transactiondate like '%$todaydate%' and 
			transactiontype = '' and transactionmodule = 'EXPENSE' and transactionmode = 'CASH' 
			order by transactiondate desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$res2 = mysql_fetch_array($exec2);
			$sumcashexpenseamount = $res2['sumcashexpenseamount'];
			
			$totalcashcollection = $sumcashsalesamount + $sumcashpurchasereturnamount + $sumcashcollectionamount;
			$totalcashpayment = $sumcashpurchaseamount + $sumcashsalesreturnamount + $sumcashpaymentamount + $sumcashexpenseamount;
			
			$totalcashnettamount = $totalcashcollection - $totalcashpayment;
			
			$totalcurrentstockpurchasevalue = '';
			$query3 = "select * from master_item where status <> 'deleted'";// limit 1";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			while ($res3 = mysql_fetch_array($exec3))
			{
				$itemcode = $res3['itemcode'];
				$purchaseprice = $res3['purchaseprice'];
				
				include ("autocompletestockcount1include1.php");
				$currentstock = $currentstock;
				if ($currentstock > 0)
				{
					$currentstockpurchasevalue = $currentstock * $purchaseprice;
				}
				else
				{
					$currentstockpurchasevalue = '0.00';
				}
				
				$totalcurrentstockpurchasevalue = $totalcurrentstockpurchasevalue + $currentstockpurchasevalue;
			}			
			//echo $totalcurrentstockpurchasevalue;
			
			$netttotal = $totalcurrentstockpurchasevalue + $totalcashnettamount;
			
			/*
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
			*/
			?>
            <tr bgcolor="#D3EEB7"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH SALES'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashsalesamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $billdate; ?></div></td>
              </tr>
            <tr bgcolor="#CBDBFA"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH SALES RETURN'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashsalesreturnamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashsalesreturnamount; ?></div></td>
              </tr>
            <tr bgcolor="#D3EEB7"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH COLLECTION'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashcollectionamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashpurchaseamount; ?></div></td>
              </tr>
            <tr bgcolor="#CBDBFA"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH PURCHASE'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashsalesreturnamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashpurchaseamount; ?></div></td>
              </tr>
            <tr bgcolor="#D3EEB7"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH PURCHASE RETURN'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashpurchasereturnamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashpurchaseamount; ?></div></td>
              </tr>
            <tr bgcolor="#CBDBFA"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By CASH PAYMENT'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashpaymentamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashpaymentamount; ?></div></td>
              </tr>
            <tr bgcolor="#D3EEB7"<?php //echo $colorcode; ?>>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <?php echo $sno = $sno + 1; ?></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			  <div class="bodytext31"><?php echo 'By EXPENSE PAYMENT'; ?></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php //echo $sumcashpaymentamount; ?></div><div align="right"></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left">
			    <div align="right"><?php echo $sumcashexpenseamount; ?></div></td>
              </tr>
			<?php
			
			?>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong>
                <?php echo number_format($totalcashcollection, 2, '.', ''); ?>
              </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong>
				<?php echo number_format($totalcashpayment, 2, '.', ''); ?>
				</strong></div></td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><strong>Nett Cash Collection </strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo $sumcashexpenseamount; ?></strong></div></td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><strong>Total Stock Purchase Value </strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalcurrentstockpurchasevalue, 2, '.', ''); ?></strong></div></td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><strong>Total</strong></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($netttotal, 2, '.', ''); ?></strong></div></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

