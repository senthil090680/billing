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

$sno = '';
$colorloopcount = '';
$totalsalesamount = '0.00';
$totalsalesreturnamount = '0.00';
$totalsalesamount2 = '0.00';
$sumsalestaxamount2 = '0.00';
$totalsalesreturnamount2 = '0.00';
$sumsalesreturntaxamount2 = '0.00';
$nettsalesamount2 = '0.00';
$nettsalestaxamount2 = '0.00';
$nettsalestotalamount = '0.00';
$nettsalestotalamount2 = '0.00';

$totalpurchaseamount = '0.00';
$totalpurchasereturnamount = '0.00';
$totalpurchaseamount2 = '0.00';
$sumpurchasetaxamount2 = '0.00';
$totalpurchasereturnamount2 = '0.00';
$sumpurchasereturntaxamount2 = '0.00';
$nettpurchaseamount2 = '0.00';
$nettpurchasetaxamount2 = '0.00';
$nettpurchasetotalamount = '0.00';
$nettpurchasetotalamount2 = '0.00';

$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
//$transactiondatefrom = date('Y-m-d');//, strtotime('-1 day'));
$transactiondateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{
	if (isset($_REQUEST["transactiondatefrom"])) { $transactiondatefrom = $_REQUEST["transactiondatefrom"]; } else { $transactiondatefrom = ""; }
	//$transactiondatefrom = $_REQUEST['ADate1'];
	if (isset($_REQUEST["transactiondateto"])) { $transactiondateto = $_REQUEST["transactiondateto"]; } else { $transactiondateto = ""; }
	//$transactiondateto = $_REQUEST['ADate2'];
	
	if (isset($_REQUEST["taxtype"])) { $taxtype = $_REQUEST["taxtype"]; } else { $taxtype = ""; }
	//$taxtype = $_REQUEST['taxtype'];

	$transactiondatefrom = $_REQUEST['ADate1'];
	$transactiondateto = $_REQUEST['ADate2'];
}



?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function loadprintpage1(banum)
{
	var varbanum = banum;
	//alert (varqanum);
	window.open("print_bill1.php?billautonumber="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}
function funcRedirectWindow1()
{
	window.location = "taxreport1payable1.php";
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1015" border="0" cellspacing="0" cellpadding="2">
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
    <td colspan="9"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="99%" valign="top"><table width="1010" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
              <form name="cbform1" method="get" action="taxreport1payable1.php" onSubmit="return process1()">
		<table width="867" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Tax Report - Nett Payable</strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td colspan="6" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
            </tr>
            <tr>
              <td width="11%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td width="24%" align="left" valign="top"  bgcolor="#FFFFFF">
			  <input type="hidden" name="taxtype" id="taxtype" value="">
<!--			  
			  <select name="taxtype" id="taxtype">
                  <option value="">Select Tax Name</option>
                  <?php
					$query1billtype = "select * from master_tax where status <> 'deleted'";
					$exec1billtype = mysql_query($query1billtype) or die ("Error in Query1billtype".mysql_error());
					while ($res1billtype = mysql_fetch_array($exec1billtype))
					{
					$taxname = $res1billtype['taxname'];
					$taxanum = $res1billtype['auto_number'];
					?>
                  <option value="<?php echo $taxanum; ?>"><?php echo $taxname; ?></option>
                  <?php
					}
					?>
                </select>              
-->				
				</td>
                <td width="8%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date From </td>
                <td width="15%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>
				</span></td>
                <td width="7%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
                <td width="15%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                  <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
				</span></td>
                <td width="20%" colspan="2" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><input type="hidden" name="cbfrmflag12" value="cbfrmflag1">
                  <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                  <input onClick="return funcRedirectWindow1()" name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
                <input type="hidden" name="cbfrmflag1" id="cbfrmflag1" value="cbfrmflag1">
            </tr>
          </tbody>
        </table>
              </form>		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="934" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="6%" bgcolor="#CCFF33" class="bodytext31">&nbsp;</td>
              <td colspan="9" bgcolor="#CCFF33" class="bodytext31"><div align="left"><strong>Statement of Sales </strong></div></td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#33CCFF">&nbsp;</td>
              <td  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31">&nbsp;</td>
              <td  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31">&nbsp;</td>
              <td colspan="2"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Sales </strong></div></td>
              <td colspan="2"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Sales Return</strong></div></td>
              <td colspan="3"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Nett Sales </strong></div></td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#33CCFF"><strong>S.No.</strong></td>
              <td width="20%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="left"><strong>Particulars</strong></div></td>
              <td width="4%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="right"><strong>Tax%</strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Amount </strong></div></td>
              <td width="9%"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Tax </strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Amount</strong></div></td>
			  <td width="10%"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Tax </strong></div></td>
			  <td width="10%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Amount </strong></div></td>
              <td width="9%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Tax</strong></div></td>
              <td width="12%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Total </strong></div></td>
              </tr>
			<?php
			$query1 = "select * from master_tax where status <> 'deleted'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
				$sno = $sno + 1;
				$taxanum = $res1['auto_number'];
				$taxname = $res1['taxname'];
				$taxpercent = $res1['taxpercent'];
				
				$query2 = "select itemrate, itemquantity from sales_tax where tax_autonumber = '$taxanum' and taxtype = 'main' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				while ($res2 = mysql_fetch_array($exec2))
				{
					$res2itemrate = $res2['itemrate'];
					$res2itemquantity = $res2['itemquantity'];
					
					$res2totalsalesamount = $res2itemrate * $res2itemquantity;
					$totalsalesamount = $totalsalesamount + $res2totalsalesamount;
				}
				//echo '<br>'.$totalsalesamount;
				
				$query3 = "select sum(taxamount) as sumsalestaxamount from sales_tax where tax_autonumber = '$taxanum' and taxtype = 'main' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				$res3 = mysql_fetch_array($exec3);
				$sumsalestaxamount = $res3['sumsalestaxamount'];
				if ($sumsalestaxamount == '') $sumsalestaxamount = '0.00';
				
				//For calculating sub tax amount.
				$sumsalestaxsubamount = '0.00';
				$query11 = "select * from master_taxsub where taxparentanum = '$taxanum' and status <> 'deleted'";
				$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
				while ($res11 = mysql_fetch_array($exec11))
				{
					$taxsubanum = $res11['auto_number'];
					$taxsubname = $res11['taxsubname'];
					$taxsubpercent = $res11['taxsubpercent'];
				
					$query31 = "select sum(taxamount) as sumsalestaxsubamount from sales_tax where tax_autonumber = '$taxsubanum' and taxtype = 'sub' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
					$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
					$res31 = mysql_fetch_array($exec31);
					if ($sumsalestaxsubamount == '') $sumsalestaxsubamount = '0.00';
					$sumsalestaxsubamount = $sumsalestaxsubamount + $res31['sumsalestaxsubamount'];

				}
				//echo $sumsalestaxsubamount;
				
				$query4 = "select itemrate, itemquantity from salesreturn_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'deleted'";
				$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
				while ($res4 = mysql_fetch_array($exec4))
				{
					$res4itemrate = $res4['itemrate'];
					$res4itemquantity = $res4['itemquantity'];
					
					$res4totalsalesreturnamount = $res4itemrate * $res4itemquantity;
					$totalsalesreturnamount = $totalsalesreturnamount + $res4totalsalesreturnamount;
				}
				//echo '<br>'.$totalsalesreturnamount;
				
				$query5 = "select sum(taxamount) as sumsalesreturntaxamount from salesreturn_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				$res5 = mysql_fetch_array($exec5);
				$sumsalesreturntaxamount = $res5['sumsalesreturntaxamount'];
				if ($sumsalesreturntaxamount == '') $sumsalesreturntaxamount = '0.00';

				//For calculating sub tax amount.
				$sumsalesreturntaxsubamount = '0.00';
				$query11 = "select * from master_taxsub where taxparentanum = '$taxanum' and status <> 'deleted'";
				$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
				while ($res11 = mysql_fetch_array($exec11))
				{
					$taxsubanum = $res11['auto_number'];
					$taxsubname = $res11['taxsubname'];
					$taxsubpercent = $res11['taxsubpercent'];
					
					$query31 = "select sum(taxamount) as sumsalesreturntaxsubamount from salesreturn_tax where tax_autonumber = '$taxsubanum' and taxtype = 'sub' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
					$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
					$res31 = mysql_fetch_array($exec31);
					if ($sumsalesreturntaxsubamount == '') $sumsalesreturntaxsubamount = '0.00';
					$sumsalesreturntaxsubamount = $sumsalesreturntaxsubamount + $res31['sumsalesreturntaxsubamount'];
				}
				//echo $sumsalesreturntaxsubamount;

				$sumsalestaxamount = $sumsalestaxamount + $sumsalestaxsubamount;
				$sumsalesreturntaxamount = $sumsalesreturntaxamount + $sumsalesreturntaxsubamount;
				
				$nettsalesamount = $totalsalesamount - $totalsalesreturnamount;
				$nettsalestaxamount = $sumsalestaxamount - $sumsalesreturntaxamount;
				$nettsalestotalamount = $nettsalesamount + $nettsalestaxamount;

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
				
				$taxpercent = number_format($taxpercent, 2, '.', '');
				$totalsalesamount = number_format($totalsalesamount, 2, '.', '');
				$sumsalestaxamount = number_format($sumsalestaxamount, 2, '.', '');
				$totalsalesreturnamount = number_format($totalsalesreturnamount, 2, '.', '');
				$sumsalesreturntaxamount = number_format($sumsalesreturntaxamount, 2, '.', '');
				$nettsalesamount = number_format($nettsalesamount, 2, '.', '');
				$nettsalestaxamount = number_format($nettsalestaxamount, 2, '.', '');
				$nettsalestotalamount = number_format($nettsalestotalamount, 2, '.', '');
			?>
			<tr <?php echo $colorcode; ?>>
			<td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?>&nbsp;</td>
			<td class="bodytext31" valign="center"  align="left"><?php echo $taxname; ?>&nbsp;</td>
			<td  align="left" valign="center" class="bodytext31"><div align="right"><?php if ($taxpercent != '0.00') echo $taxpercent; //echo number_format($taxpercent, 2, '.', ''); ?></div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($totalsalesamount != '0.00') echo $totalsalesamount; //echo number_format($totalsalesamount, 2, '.', ''); ?>&nbsp;</div></td>
			<td  align="left" valign="center" class="bodytext31"><div align="right"><?php if ($sumsalestaxamount != '0.00') echo $sumsalestaxamount; //echo number_format($sumsalestaxamount, 2, '.', ''); ?>&nbsp;</div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($totalsalesreturnamount != '0.00') echo $totalsalesreturnamount; //echo number_format($totalsalesreturnamount, 2, '.', ''); ?>&nbsp;</div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($sumsalesreturntaxamount != '0.00') echo $sumsalesreturntaxamount; //echo number_format($sumsalesreturntaxamount, 2, '.', ''); ?></div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettsalesamount != '0.00') echo $nettsalesamount; //echo number_format($nettsalesamount, 2, '.', ''); ?></div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettsalestaxamount != '0.00') echo $nettsalestaxamount; //echo number_format($nettsalestaxamount, 2, '.', ''); ?></div></td>
			<td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettsalestotalamount != '0.00') echo $nettsalestotalamount; //echo number_format($nettsalestotalamount, 2, '.', ''); ?></div></td>
			</tr>
			<?php
			$totalsalesamount2 = $totalsalesamount2 + $totalsalesamount;
			$sumsalestaxamount2 = $sumsalestaxamount2 + $sumsalestaxamount;
			$totalsalesreturnamount2 = $totalsalesreturnamount2 + $totalsalesreturnamount;
			$sumsalesreturntaxamount2 = $sumsalesreturntaxamount2 + $sumsalesreturntaxamount;
			$nettsalesamount2 = $nettsalesamount2 + $nettsalesamount;
			$nettsalestaxamount2 = $nettsalestaxamount2 + $nettsalestaxamount;
			$nettsalestotalamount2 = $nettsalestotalamount2 + $nettsalestotalamount;
			
			$totalsalesamount = '0.00';
			$sumsalestaxamount = '0.00';
			$totalsalesreturnamount = '0.00';
			$sumsalesreturntaxamount = '0.00';
			$nettsalesamount = '0.00';
			$nettsalestaxamount = '0.00';
			$nettsalestotalamount = '0.00';
			$sumsalestaxsubamount = '0.00';
			$sumsalesreturntaxsubamount = '0.00';
			
			}
			?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsalesamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($sumsalestaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalsalesreturnamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
			  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($sumsalesreturntaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
			  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettsalesamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
				<td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettsalestaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettsalestotalamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              </tr>
          </tbody>
        </table>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="934" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="6%" bgcolor="#CCFF33" class="bodytext31">&nbsp;</td>
              <td colspan="9" bgcolor="#CCFF33" class="bodytext31"><div align="left"><strong>Statement of Purchase </strong></div></td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#33CCFF">&nbsp;</td>
              <td  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31">&nbsp;</td>
              <td  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31">&nbsp;</td>
              <td colspan="2"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Purchase</strong></div></td>
              <td colspan="2"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Purchase Return</strong></div></td>
              <td colspan="3"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Nett Purchase </strong></div></td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#33CCFF"><strong>S.No.</strong></td>
              <td width="20%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="left"><strong>Particulars</strong></div></td>
              <td width="4%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="right"><strong>Tax%</strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Amount </strong></div></td>
              <td width="9%"  align="left" valign="center" 
                bgcolor="#66CC33" class="bodytext31"><div align="center"><strong>Tax </strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Amount</strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#FFCC33" class="bodytext31"><div align="center"><strong>Tax </strong></div></td>
              <td width="10%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Amount </strong></div></td>
              <td width="9%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Tax</strong></div></td>
              <td width="12%"  align="left" valign="center" 
                bgcolor="#33CCFF" class="bodytext31"><div align="center"><strong>Total </strong></div></td>
            </tr>
            <?php
			$query1 = "select * from master_tax where status <> 'deleted'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
				$sno = $sno + 1;
				$taxanum = $res1['auto_number'];
				$taxname = $res1['taxname'];
				$taxpercent = $res1['taxpercent'];
				
				$query2 = "select itemrate, itemquantity from purchase_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				while ($res2 = mysql_fetch_array($exec2))
				{
					$res2itemrate = $res2['itemrate'];
					$res2itemquantity = $res2['itemquantity'];
					
					$res2totalpurchaseamount = $res2itemrate * $res2itemquantity;
					$totalpurchaseamount = $totalpurchaseamount + $res2totalpurchaseamount;
				}
				//echo '<br>'.$totalpurchaseamount;
				
				$query3 = "select sum(taxamount) as sumpurchasetaxamount from purchase_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				$res3 = mysql_fetch_array($exec3);
				$sumpurchasetaxamount = $res3['sumpurchasetaxamount'];
				if ($sumpurchasetaxamount == '') $sumpurchasetaxamount = '0.00';
				
				$query4 = "select itemrate, itemquantity from purchasereturn_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'deleted'";
				$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
				while ($res4 = mysql_fetch_array($exec4))
				{
					$res4itemrate = $res4['itemrate'];
					$res4itemquantity = $res4['itemquantity'];
					
					$res4totalpurchasereturnamount = $res4itemrate * $res4itemquantity;
					$totalpurchasereturnamount = $totalpurchasereturnamount + $res4totalpurchasereturnamount;
				}
				//echo '<br>'.$totalpurchasereturnamount;
				
				//For calculating sub tax amount.
				$sumpurchasetaxsubamount = '0.00';
				$query11 = "select * from master_taxsub where taxparentanum = '$taxanum' and status <> 'deleted'";
				$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
				while ($res11 = mysql_fetch_array($exec11))
				{
					$taxsubanum = $res11['auto_number'];
					$taxsubname = $res11['taxsubname'];
					$taxsubpercent = $res11['taxsubpercent'];
				
					$query31 = "select sum(taxamount) as sumpurchasetaxsubamount from purchase_tax where tax_autonumber = '$taxsubanum' and taxtype = 'sub' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
					$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
					$res31 = mysql_fetch_array($exec31);
					if ($sumpurchasetaxsubamount == '') $sumpurchasetaxsubamount = '0.00';
					$sumpurchasetaxsubamount = $sumpurchasetaxsubamount + $res31['sumpurchasetaxsubamount'];

				}
				//echo $sumpurchasetaxsubamount;

				$query5 = "select sum(taxamount) as sumpurchasereturntaxamount from purchasereturn_tax where tax_autonumber = '$taxanum' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				$res5 = mysql_fetch_array($exec5);
				$sumpurchasereturntaxamount = $res5['sumpurchasereturntaxamount'];
				if ($sumpurchasereturntaxamount == '') $sumpurchasereturntaxamount = '0.00';

				//For calculating sub tax amount.
				$sumpurchasereturntaxsubamount = '0.00';
				$query11 = "select * from master_taxsub where taxparentanum = '$taxanum' and status <> 'deleted'";
				$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
				while ($res11 = mysql_fetch_array($exec11))
				{
					$taxsubanum = $res11['auto_number'];
					$taxsubname = $res11['taxsubname'];
					$taxsubpercent = $res11['taxsubpercent'];
				
					$query31 = "select sum(taxamount) as sumpurchasereturntaxsubamount from purchasereturn_tax where tax_autonumber = '$taxsubanum' and taxtype = 'sub' and billdate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED'";
					$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
					$res31 = mysql_fetch_array($exec31);
					if ($sumpurchasereturntaxsubamount == '') $sumpurchasereturntaxsubamount = '0.00';
					$sumpurchasereturntaxsubamount = $sumpurchasereturntaxsubamount + $res31['sumpurchasereturntaxsubamount'];

				}
				//echo $sumpurchasereturntaxsubamount;

				$sumpurchasetaxamount = $sumpurchasetaxamount + $sumpurchasetaxsubamount;
				$sumpurchasereturntaxamount = $sumpurchasereturntaxamount + $sumpurchasereturntaxsubamount;
				
				$nettpurchaseamount = $totalpurchaseamount - $totalpurchasereturnamount;
				$nettpurchasetaxamount = $sumpurchasetaxamount - $sumpurchasereturntaxamount;
				$nettpurchasetotalamount = $nettpurchaseamount + $nettpurchasetaxamount;

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

				$taxpercent = number_format($taxpercent, 2, '.', '');
				$totalpurchaseamount = number_format($totalpurchaseamount, 2, '.', '');
				$sumpurchasetaxamount = number_format($sumpurchasetaxamount, 2, '.', '');
				$totalpurchasereturnamount = number_format($totalpurchasereturnamount, 2, '.', '');
				$sumpurchasereturntaxamount = number_format($sumpurchasereturntaxamount, 2, '.', '');
				$nettpurchaseamount = number_format($nettpurchaseamount, 2, '.', '');
				$nettpurchasetaxamount = number_format($nettpurchasetaxamount, 2, '.', '');
				$nettpurchasetotalamount = number_format($nettpurchasetotalamount, 2, '.', '');
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?>&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $taxname; ?>&nbsp;</td>
              <td  align="left" valign="center" class="bodytext31"><div align="right"><?php if ($taxpercent != '0.00') echo $taxpercent; //echo number_format($taxpercent, 2, '.', ''); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($totalpurchaseamount != '0.00') echo $totalpurchaseamount; //echo number_format($totalpurchaseamount, 2, '.', ''); ?>&nbsp;</div></td>
              <td  align="left" valign="center" class="bodytext31"><div align="right"><?php if ($sumpurchasetaxamount != '0.00') echo $sumpurchasetaxamount; //echo number_format($sumpurchasetaxamount, 2, '.', ''); ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($totalpurchasereturnamount != '0.00') echo $totalpurchasereturnamount; //echo number_format($totalpurchasereturnamount, 2, '.', ''); ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($sumpurchasereturntaxamount != '0.00') echo $sumpurchasereturntaxamount; //echo number_format($sumpurchasereturntaxamount, 2, '.', ''); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettpurchaseamount != '0.00') echo $nettpurchaseamount; //echo number_format($nettpurchaseamount, 2, '.', ''); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettpurchasetaxamount != '0.00') echo $nettpurchasetaxamount; //echo number_format($nettpurchasetaxamount, 2, '.', ''); ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"><?php if ($nettpurchasetotalamount != '0.00') echo $nettpurchasetotalamount; //echo number_format($nettpurchasetotalamount, 2, '.', ''); ?></div></td>
            </tr>
            <?php
			$totalpurchaseamount2 = $totalpurchaseamount2 + $totalpurchaseamount;
			$sumpurchasetaxamount2 = $sumpurchasetaxamount2 + $sumpurchasetaxamount;
			$totalpurchasereturnamount2 = $totalpurchasereturnamount2 + $totalpurchasereturnamount;
			$sumpurchasereturntaxamount2 = $sumpurchasereturntaxamount2 + $sumpurchasereturntaxamount;
			$nettpurchaseamount2 = $nettpurchaseamount2 + $nettpurchaseamount;
			$nettpurchasetaxamount2 = $nettpurchasetaxamount2 + $nettpurchasetaxamount;
			$nettpurchasetotalamount2 = $nettpurchasetotalamount2 + $nettpurchasetotalamount;
			
			$totalpurchaseamount = '0.00';
			$sumpurchasetaxamount = '0.00';
			$totalpurchasereturnamount = '0.00';
			$sumpurchasereturntaxamount = '0.00';
			$nettpurchaseamount = '0.00';
			$nettpurchasetaxamount = '0.00';
			$nettpurchasetotalamount = '0.00';
			
			}
			?>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalpurchaseamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($sumpurchasetaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($totalpurchasereturnamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($sumpurchasereturntaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettpurchaseamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettpurchasetaxamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong><?php echo number_format($nettpurchasetotalamount2, 2, '.', ''); ?>&nbsp;</strong></div></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="359" 
            align="left" border="0">
          <tbody>
            <tr>
              <td bgcolor="#66CC33" class="bodytext31">&nbsp;</td>
              <td bgcolor="#66CC33" class="bodytext31">&nbsp;</td>
              <td bgcolor="#66CC33" class="bodytext31"><div align="left"><strong>Total Tax By Sales  : </strong></div></td>
              <td bgcolor="#66CC33" class="bodytext31"><div align="right"><strong><?php echo number_format($nettsalestaxamount2, 2, '.', ''); ?></strong></div></td>
              <td bgcolor="#66CC33" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td bgcolor="#FFCC33" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFCC33" class="bodytext31">&nbsp;</td>
              <td bgcolor="#FFCC33" class="bodytext31"><div align="left"><strong>Total Tax By Purchase: </strong></div></td>
              <td bgcolor="#FFCC33" class="bodytext31"><div align="right"><strong><?php echo number_format($nettpurchasetaxamount2, 2, '.', ''); ?></strong></div></td>
              <td bgcolor="#FFCC33" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td width="3%" bgcolor="#CCFF33" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#CCFF33" class="bodytext31">&nbsp;</td>
              <td width="58%" bgcolor="#CCFF33" class="bodytext31"><div align="left"><strong>Total Tax  Payable : </strong></div></td>
              <td width="31%" bgcolor="#CCFF33" class="bodytext31"><div align="right"><strong>
                <?php 
			  $totaltaxpayable = $nettsalestaxamount2 - $nettpurchasetaxamount2;
			  echo number_format($totaltaxpayable, 2, '.', ''); 
			  ?>
              </strong></div></td>
              <td width="4%" bgcolor="#CCFF33" class="bodytext31">&nbsp;</td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

