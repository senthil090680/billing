<?php
session_start();
//include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');

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
	if (isset($_REQUEST["username"])) { $username = $_SESSION["username"]; } else { $username = ""; }
	//$username = $_REQUEST['username'];
	if (isset($_REQUEST["companyanum"])) { $companyanum = $_REQUEST["companyanum"]; } else { $companyanum = ""; }
	//$companyanum = $_REQUEST['companyanum'];
	if (isset($_REQUEST["companyname"])) { $companyname = $_REQUEST["companyname"]; } else { $companyname = ""; }
	//$companyname = $_REQUEST['companyname'];
	if (isset($_REQUEST["financialyear"])) { $financialyear = $_REQUEST["financialyear"]; } else { $financialyear = ""; }
	//$financialyear = $_REQUEST['financialyear'];
}

$taxtype = '';
$colorloopcount = '';
$showfinaltaxamount = '0.00';
$showfinalnettamount = '0.00';
$finalsubtotal = '0.00';
$totaltaxsubamount = '';
$res2loopcount = '';
$showtaxonlytotal = '';
$showfinaltaxonlytotalamount = '0';
$showfinaltotalitemamount = '0';

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
//$transactiondatefrom = date('Y-m-d');//, strtotime('-1 day'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	if (isset($_REQUEST["cbcustomername"])) { $cbcustomername = $_REQUEST["cbcustomername"]; } else { $cbcustomername = ""; }
	//$cbcustomername = $_REQUEST['cbcustomername'];
	if (isset($_REQUEST["customername"])) { $customername = $_REQUEST["customername"]; } else { $customername = ""; }
	//$customername = $_REQUEST['cbcustomername'];
	
	if (isset($_REQUEST["cbbillnumber"])) { $cbbillnumber = $_REQUEST["cbbillnumber"]; } else { $cbbillnumber = ""; }
	//$cbbillnumber = $_REQUEST['cbbillnumber'];
	if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
	//$cbbillstatus = $_REQUEST['cbbillstatus'];
	
	if (isset($_REQUEST["transactiondatefrom"])) { $transactiondatefrom = $_REQUEST["transactiondatefrom"]; } else { $transactiondatefrom = ""; }
	//$transactiondatefrom = $_REQUEST['ADate1'];
	if (isset($_REQUEST["transactiondateto"])) { $transactiondateto = $_REQUEST["transactiondateto"]; } else { $transactiondateto = ""; }
	//$transactiondateto = $_REQUEST['ADate2'];
	
	if (isset($_REQUEST["taxtype"])) { $taxtype = $_REQUEST["taxtype"]; } else { $taxtype = ""; }
	//$taxtype = $_REQUEST['taxtype'];
	if (isset($_REQUEST["billstatus"])) { $billstatus = $_REQUEST["billstatus"]; } else { $billstatus = ""; }
	//$billstatus = $_REQUEST['billstatus'];

	$transactiondatefrom = $_REQUEST['transactiondatefrom'];
	$transactiondateto = $_REQUEST['transactiondateto'];

}

?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #FFFFFF;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>
<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="934" 
            align="left" border="0">
  <tbody>
    <tr>
      <td width="3%" bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
      <td colspan="7" bgcolor="#FFFFFF" class="bodytext31"><div align="center"><strong>Tax Report - Sales </strong></div></td>
      <td width="7%" bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
    </tr>
    <tr>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><strong>No.</strong></td>
      <td width="5%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="left"><strong>Bill No. </strong></div></td>
      <td width="8%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="left"><strong>Bill Date </strong></div></td>
      <td width="12%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><strong> Customer </strong></td>
      <td width="8%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="right"><strong>SubTotal</strong></div></td>
      <?php
			  $query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  $res1tax = mysql_fetch_array($exec1tax);
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
      <td width="8%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="right"><strong>Taxable Amont </strong></div></td>
      <td width="7%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="right"><strong>Tax <?php echo $res1taxtaxpercent.' %'; ?>&nbsp;</strong></div></td>
      <?php
			  }
			  ?>
      <td width="7%"  align="left" valign="center" 
                bgcolor="#FFFFFF" class="bodytext31"><div align="right"><strong>TaxTotal</strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong>Nett</strong></div></td>
    </tr>
    <?php
			if ($cbfrmflag1 == 'cbfrmflag1')
			{
					
			$dotarray = explode("-", $transactiondateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
			$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));
			
			$query4 = "select * from master_tax where auto_number = '$taxtype'";
			$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
			$res4 = mysql_fetch_array($exec4);
			$res4taxpercent = $res4['taxpercent'];
			$res4taxanum = $res4['auto_number'];
			
			//$query2 = "select sum(itemtaxamount) as sumitemtaxamount, sum(subtotal) as sumsubtotal, 
			//bill_autonumber, itemtaxpercentage from sales_details 
			//where itemtaxpercentage = '$res4taxpercent' and companyanum = '$companyanum' 
			//group by billnumber, itemtaxpercentage order by billnumber desc";
			$query2 = "select sum(taxamount) as sumitemtaxamount, sum(amountbeforetax) as sumamountbeforetax, 
			bill_autonumber from sales_tax 
			where tax_autonumber = '$res4taxanum' and taxtype = 'main' and companyanum = '$companyanum' 
			and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' 
			group by billnumber order by billnumber desc";
			
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$billautonumber = $res2['bill_autonumber'];
			$totaltaxamount = $res2['sumitemtaxamount'];
			$totalitemamount = $res2['sumamountbeforetax'];
			
			$query3 = "select * from master_sales where auto_number = '$billautonumber' and 
			billdate between '$transactiondatefrom' and '$transactiondateto'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			$res3 = mysql_fetch_array($exec3);
			$rowcount3 = mysql_num_rows($exec3);
			if ($rowcount3 > 0)
			{
			$billdate = $res3['billdate'];
			$billnumber = $res3['billnumber'];
			$customername = $res3['customername'];
			$shownettamount = $res3['totalamount'];
				
			//$sumsubtotal = $res3['subtotal'];
			$sumsubtotal = $res3['subtotalafterdiscount'];
			$finalsubtotal = $finalsubtotal + $sumsubtotal;
			$finalsubtotal = number_format($finalsubtotal, 2, '.', '');
			$nettamount = $totaltaxamount + $sumsubtotal;	
			$nettamount = number_format($nettamount, 2, '.', '');
			
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
    <tr <?php //echo $colorcode; ?>>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><?php echo $res2loopcount; ?></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="left"> <?php echo $billnumber; ?></div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="left">
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

				
				?>
      </div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div class="bodytext31"> <?php echo $customername; ?></div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $sumsubtotal; ?>&nbsp;</div></td>
      <?php
			  //echo '<br>'.$query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			  $query1tax = "select * from master_tax where auto_number = '$taxtype'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  $res1tax = mysql_fetch_array($exec1tax);
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
      <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
			  $res2taxauto_number = $res2tax['auto_number'];
			  $taxsubpercent = $res2tax['taxsubpercent'];
			  
			  $taxsubamount = $totaltaxamount * $taxsubpercent;
			  $taxsubamount = $taxsubamount / 100;
			  $taxsubamount = number_format($taxsubamount, 2, '.', '');
			  
			  /*
			  if ($res2taxauto_number != '')
			  {
				//echo '<td class="bodytext31" valign="center"  align="left">
				//<div align="right">'.$taxsubamount.'&nbsp;</div></td>';
				$totaltaxsubamount = $totaltaxsubamount + $taxsubamount;
			  }
			  */
			  }
			  }
			  $showtotaltaxamount = $totaltaxamount + $totalitemamount;
			  //$showtotaltaxamount = $sumsubtotal + $totaltaxamount;
			  $showtotaltaxamount = number_format($showtotaltaxamount, 2, '.', '');
			  
			  //$shownettamount = $nettamount + $totaltaxsubamount;
			  $shownettamount = number_format($shownettamount, 2, '.', '');
			  ?>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="right"><?php echo $totalitemamount; ?></div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $totaltaxamount; ?>&nbsp;</div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $showtotaltaxamount; ?>&nbsp;</div></td>
      <td  align="left" valign="center" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> <?php echo $shownettamount; ?>&nbsp;</div></td>
    </tr>
    <?php
				$nettamount = '';
				$totaltaxsubamount = '';
				$showfinaltaxamount = $showfinaltaxamount + $showtotaltaxamount;
				$showfinalnettamount = $showfinalnettamount + $shownettamount;
				$showfinaltaxonlytotalamount = $showfinaltaxonlytotalamount + $totaltaxamount;
				$showfinaltotalitemamount = $showfinaltotalitemamount + $totalitemamount;
				}
				}
 			    $showfinaltaxamount = number_format($showfinaltaxamount, 2, '.', '');
 			    $showfinalnettamount = number_format($showfinalnettamount, 2, '.', '');
 			    $showfinaltaxonlytotalamount = number_format($showfinaltaxonlytotalamount, 2, '.', '');
 			    $showfinaltotalitemamount = number_format($showfinaltotalitemamount, 2, '.', '');

				?>
    <tr>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF">&nbsp;</td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong>Total : </strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong> <?php echo $finalsubtotal; ?>&nbsp;</strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong> <?php echo $showfinaltotalitemamount; ?>&nbsp;</strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#FFFFFF"><div align="right"><strong> <?php echo $showfinaltaxonlytotalamount; ?>&nbsp;</strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong> <?php echo $showfinaltaxamount; ?>&nbsp;</strong></div></td>
      <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong> <?php echo $showfinalnettamount; ?>&nbsp;</strong></div></td>
    </tr>
    <?php
}
?>
  </tbody>
</table>
