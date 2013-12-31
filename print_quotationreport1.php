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
	if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
	//$username = $_REQUEST['username'];
	if (isset($_REQUEST["companyanum"])) { $companyanum = $_REQUEST["companyanum"]; } else { $companyanum = ""; }
	//$companyanum = $_REQUEST['companyanum'];
	if (isset($_REQUEST["companyname"])) { $companyname = $_REQUEST["companyname"]; } else { $companyname = ""; }
	//$companyname = $_REQUEST['companyname'];
	if (isset($_REQUEST["financialyear"])) { $financialyear = $_REQUEST["financialyear"]; } else { $financialyear = ""; }
	//$financialyear = $_REQUEST['financialyear'];
}

$quotedatefrom = date('Y-m-d', strtotime('-1 month'));
$quotedateto = date('Y-m-d');

$cbcustomername = '';
$cbbillnumber = '';
$cbbillstatus = '';
$customername = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';
$totalsumsubtotal1 = '0.00';
$totalsumtotaltax1 = '0.00';
$totaldelivery1 = '0.00';
$totalsumtotalamount1 = '0.00';

$query1 = "select * from master_company where auto_number = '$companyanum'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$companyname = $res1['companyname'];

if (isset($_REQUEST["ADate1"])) { $ADate1 = $_REQUEST["ADate1"]; } else { $ADate1 = ""; }
//$ADate1 = $_REQUEST['ADate1'];
if ($ADate1 != '')
{

	$cbcustomername = $_REQUEST['cbcustomername'];
	$customername = $_REQUEST['cbcustomername'];
	$quotedatefrom = $_REQUEST['ADate1'];
	$quotedateto = $_REQUEST['ADate2'];

}
/*			$dotarray = explode("-", $quotedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
*/


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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="871" 
            align="left" border="1">
  <tbody>
    
            <tr>
              <td colspan="10" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>Quotation Report</strong></div></td>
            </tr>
            <tr>
              <td colspan="10" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong><?php echo $companyname; ?></strong>&nbsp;</div></td>
            </tr>
            <tr>
              <td colspan="10" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"><div align="center"><strong><?php echo 'Report Date From '.$quotedatefrom.' To '.$quotedateto; ?></strong></div></td>
            </tr>
            <tr>
              <td width="4%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="7%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="12%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="18%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="9%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td width="14%" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>SNo.</strong></td>
              <!--<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>PDF</strong></td>-->
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>QuoteNo </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Date </strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>SubTotal</strong></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><div align="left"><span class="bodytext31"><strong>Tax</strong></span></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><div align="left"><span class="bodytext31"><strong>Packing</strong></span></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><div align="left"><span class="bodytext31"><strong>Delivery</strong></span></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" 
                bgcolor="#ffffff" class="style1"><div align="left"><span class="bodytext31"><strong>RoundOff</strong></span></div></td>
              <!--<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><strong>Delivery</strong></td>-->
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Total</strong></div></td>
            </tr>
			<?php
			
			$dotarray = explode("-", $quotedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));


			$query2 = "select * from master_quotation where customername like '%$customername%' and quotationdate between '$quotedatefrom' and '$quotedateto' and status <> 'DELETED' order by quotationnumber desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2loopcount = $res2loopcount + 1;
			$customername = $res2['customername'];
			$city = $res2['city'];
			$contact = $res2['contactperson1'];
			if ($res2['contactperson2'] != '')  $contact = $contact.', '.$res2['contactperson2'];
			if ($res2['contactperson3'] != '')  $contact = $contact.', '.$res2['contactperson3'];
			$quotenumber1 = $res2['quotationnumberprefix'];
			$quotenumber2 = $res2['quotationnumber'];
			if ($quotenumber1 != '') $quotenumber2 = $quotenumber1.'-'.$quotenumber2;
			$quotedate = $res2['updatedate'];
			//$quotedate = substr($quotedate, 0, 11);
			$res2anum = $res2['auto_number'];
			//$paymentdate = $res2['paymententrydate'];
			//$paymentdate = substr($paymentdate, 0, 11);
			//$paymentmode = $res2['paymentmode'];
			//$chequenumber = $res2['chequenumber'];
			$status = strtoupper($res2['status']);
			$packaging = $res2['packaging'];
			$delivery = $res2['transportation'];
			
			$subtotal = $res2['subtotal'];
			$totalaftertax = $res2['totalaftertax'];
			$totaltax = $totalaftertax - $subtotal;
			$totaltax = number_format($totaltax, 2, '.', '');
			$roundoff = $res2['roundoff'];
			$totalamount = $res2['totalamount'];
			
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
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31">
			  <?php echo $res2loopcount; ?></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="left"> 
			  <?php echo $quotenumber2; ?></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="left">
              <?php echo substr($quotedate, 0, 10); ?></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div class="bodytext31"> 
			  <?php echo $customername; ?></div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $subtotal; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $totaltax; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $packaging; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $delivery; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $roundoff; ?>&nbsp;</div></td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#FFFFFF" class="bodytext31"><div align="right"> 
			  <?php echo $totalamount; ?>&nbsp;</div></td>
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
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumsubtotal1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumtotaltax1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totaldelivery1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totaldelivery1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totaldelivery1, 2, '.', '');; ?></strong></div></td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" 
                bgcolor="#FFFFFF"><div align="right"><strong><?php echo number_format($totalsumtotalamount1, 2, '.', '');; ?></strong></div></td>
            </tr>
            
            <tr>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
              <td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>
            </tr>
  </tbody>
</table>
</body>