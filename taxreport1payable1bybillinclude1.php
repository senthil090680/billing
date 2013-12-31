<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
<table width="1110" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1105" 
            align="left" border="0">
      <tbody>
        <tr>
          <td colspan="4" bgcolor="#cccccc" class="bodytext31"><strong>Tax Report - By Sales&nbsp;</strong></td>
          <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
				  }
			  }
			  }
			  }
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
        </tr>
        <tr>
          <td width="3%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
          <td width="5%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill No. </strong></div></td>
          <td width="8%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill Date </strong></div></td>
          <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong> Customer </strong></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>SubTotal</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Tax <?php echo round($res1taxtaxpercent, 2).'%'; ?>&nbsp;</strong></div></td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>Taxable Amount</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>SubTax '.round($taxsubpercent, 2).' %'.'</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>TaxTotal</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Nett</strong></div></td>
        </tr>
        <?php
if ($cbfrmflag1 == 'cbfrmflag1')
{
$sno = '';
$finalsubtotal = '';

$dotarray = explode("-", $transactiondateto);
$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));

$query3 = "select * from master_sales where billdate between '$transactiondatefrom' and '$transactiondateto' and 
recordstatus <> 'deleted'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
//$res3 = mysql_fetch_array($exec3);
$rowcount3 = mysql_num_rows($exec3);
//if ($rowcount3 > 0) //if1
while ($res3 = mysql_fetch_array($exec3))
{
$showtotaltaxamount = '';

		
			$billdate = $res3['billdate'];
			$billnumber = $res3['billnumber'];
			$billnumberprefix = $res3['billnumberprefix'];
			$billnumberpostfix = $res3['billnumberpostfix'];
			$customername = $res3['customername'];
			$customercode = $res3['customercode'];
			
			$query31 = "select * from master_customer where customercode = '$customercode'";
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$tinnumber = $res31['tinnumber'];
			
			//$sumsubtotal = $res3['subtotal'];
			$totaltaxamount = '';
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
			
			$sno = $sno + 1;
			?>
        <tr <?php echo $colorcode; ?>>
          <td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left"> <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left">
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
          <td class="bodytext31" valign="center"  align="left"><div class="bodytext31"> <?php echo $customername; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $sumsubtotal; ?>&nbsp;</div></td>
          <?php
			//echo '<br>'.$query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			$query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number = '$taxtype'";
			$exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			while ($res1tax = mysql_fetch_array($exec1tax))
			{
				$res1taxauto_number = $res1tax['auto_number'];
				$res1taxtaxpercent = $res1tax['taxpercent'];
				//if ($res1taxauto_number == $res4taxanum)
				if ($res1taxauto_number != '')
				{

				$query2 = "select sum(amountbeforetax) as sumamountbeforetax, sum(taxamount) as sumtaxamount from sales_tax 
				where tax_autonumber = '$res1taxauto_number' and billnumber = '$billnumber' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				$res2 = mysql_fetch_array($exec2);
			
				$sumamountbeforetax = $res2['sumamountbeforetax'];
				$sumtaxamount = $res2['sumtaxamount'];
					
					?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo $sumtaxamount; ?></div></td>
          <?php
					$query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";
					$exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
					while ($res2tax = mysql_fetch_array($exec2tax))
					{
						$res2taxauto_number = $res2tax['auto_number'];
						$taxsubpercent = $res2tax['taxsubpercent'];
						
						$taxsubamount = $sumtaxamount * $taxsubpercent;
						$taxsubamount = $taxsubamount / 100;
						$taxsubamount = number_format($taxsubamount, 2, '.', '');
						
						if ($res2taxauto_number != '')
						{
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$sumtaxamount.'&nbsp;</div></td>';
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$taxsubamount.'&nbsp;</div></td>';
							$totaltaxsubamount = $totaltaxsubamount + $taxsubamount;
						}
					}
				}
				$showtotaltaxamount = $showtotaltaxamount + $sumtaxamount + $totaltaxsubamount;
				$showtotaltaxamount = number_format($showtotaltaxamount, 2, '.', '');
				
				$shownettamount = $nettamount + $totaltaxsubamount;
				$shownettamount = number_format($shownettamount, 2, '.', '');
			} 
			?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $showtotaltaxamount; ?>&nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $shownettamount; ?>&nbsp;</div></td>
          <?php
			$nettamount = '';
			$totaltaxamount = '';
			$totaltaxsubamount = '';
			$showfinaltaxamount = $showfinaltaxamount + $showtotaltaxamount;
			$showfinalnettamount = $showfinalnettamount + $shownettamount;
			}//if1 
		//} //while 2
		
	//} //while1
			
	$showfinaltaxamount = number_format($showfinaltaxamount, 2, '.', '');
	$showfinalnettamount = number_format($showfinalnettamount, 2, '.', '');
		
?>
        </tr>
        <?php
} //cbfrmflag

?>
        <tr>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total : </strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $finalsubtotal; ?>&nbsp;</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinaltaxamount; ?>&nbsp;</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinalnettamount; ?>&nbsp;</strong></div></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1105" 
            align="left" border="0">
      <tbody>
        <tr>
          <td colspan="4" bgcolor="#cccccc" class="bodytext31"><strong>Tax Report - By Sales Return </strong></td>
          <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
				  }
			  }
			  }
			  }
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
        </tr>
        <tr>
          <td width="3%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
          <td width="5%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill No. </strong></div></td>
          <td width="8%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill Date </strong></div></td>
          <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong> Customer </strong></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>SubTotal</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Tax <?php echo round($res1taxtaxpercent, 2).'%'; ?>&nbsp;</strong></div></td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>Taxable Amount</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>SubTax '.round($taxsubpercent, 2).' %'.'</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>TaxTotal</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Nett</strong></div></td>
        </tr>
        <?php
if ($cbfrmflag1 == 'cbfrmflag1')
{
$sno = '';
$finalsubtotal = '';

$dotarray = explode("-", $transactiondateto);
$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));

$query3 = "select * from master_salesreturn where billdate between '$transactiondatefrom' and '$transactiondateto' and 
recordstatus <> 'deleted'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
//$res3 = mysql_fetch_array($exec3);
$rowcount3 = mysql_num_rows($exec3);
//if ($rowcount3 > 0) //if1
while ($res3 = mysql_fetch_array($exec3))
{
$showtotaltaxamount = '';

		
			$billdate = $res3['billdate'];
			$billnumber = $res3['billnumber'];
			$billnumberprefix = $res3['billnumberprefix'];
			$billnumberpostfix = $res3['billnumberpostfix'];
			$customername = $res3['customername'];
			$customercode = $res3['customercode'];
			
			$query31 = "select * from master_customer where customercode = '$customercode'";
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$tinnumber = $res31['tinnumber'];
			
			//$sumsubtotal = $res3['subtotal'];
			$totaltaxamount = '';
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
			
			$sno = $sno + 1;
			?>
        <tr <?php echo $colorcode; ?>>
          <td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left"> <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left">
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
          <td class="bodytext31" valign="center"  align="left"><div class="bodytext31"> <?php echo $customername; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $sumsubtotal; ?>&nbsp;</div></td>
          <?php
			//echo '<br>'.$query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			$query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number = '$taxtype'";
			$exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			while ($res1tax = mysql_fetch_array($exec1tax))
			{
				$res1taxauto_number = $res1tax['auto_number'];
				$res1taxtaxpercent = $res1tax['taxpercent'];
				//if ($res1taxauto_number == $res4taxanum)
				if ($res1taxauto_number != '')
				{

				$query2 = "select sum(amountbeforetax) as sumamountbeforetax, sum(taxamount) as sumtaxamount from salesreturn_tax 
				where tax_autonumber = '$res1taxauto_number' and billnumber = '$billnumber' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				$res2 = mysql_fetch_array($exec2);
			
				$sumamountbeforetax = $res2['sumamountbeforetax'];
				$sumtaxamount = $res2['sumtaxamount'];
					
					?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo $sumtaxamount; ?></div></td>
          <?php
					$query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";
					$exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
					while ($res2tax = mysql_fetch_array($exec2tax))
					{
						$res2taxauto_number = $res2tax['auto_number'];
						$taxsubpercent = $res2tax['taxsubpercent'];
						
						$taxsubamount = $sumtaxamount * $taxsubpercent;
						$taxsubamount = $taxsubamount / 100;
						$taxsubamount = number_format($taxsubamount, 2, '.', '');
						
						if ($res2taxauto_number != '')
						{
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$sumtaxamount.'&nbsp;</div></td>';
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$taxsubamount.'&nbsp;</div></td>';
							$totaltaxsubamount = $totaltaxsubamount + $taxsubamount;
						}
					}
				}
				$showtotaltaxamount = $showtotaltaxamount + $sumtaxamount + $totaltaxsubamount;
				$showtotaltaxamount = number_format($showtotaltaxamount, 2, '.', '');
				
				$shownettamount = $nettamount + $totaltaxsubamount;
				$shownettamount = number_format($shownettamount, 2, '.', '');
			} 
			?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $showtotaltaxamount; ?>&nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $shownettamount; ?>&nbsp;</div></td>
          <?php
			$nettamount = '';
			$totaltaxamount = '';
			$totaltaxsubamount = '';
			$showfinaltaxamount = $showfinaltaxamount + $showtotaltaxamount;
			$showfinalnettamount = $showfinalnettamount + $shownettamount;
			}//if1 
		//} //while 2
		
	//} //while1
			
	$showfinaltaxamount = number_format($showfinaltaxamount, 2, '.', '');
	$showfinalnettamount = number_format($showfinalnettamount, 2, '.', '');
		
?>
        </tr>
        <?php
} //cbfrmflag

?>
        <tr>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total : </strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $finalsubtotal; ?>&nbsp;</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinaltaxamount; ?>&nbsp;</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinalnettamount; ?>&nbsp;</strong></div></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1105" 
            align="left" border="0">
      <tbody>
        <tr>
          <td colspan="4" bgcolor="#cccccc" class="bodytext31"><strong>Tax Report - By Purchase </strong></td>
          <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
				  }
			  }
			  }
			  }
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
        </tr>
        <tr>
          <td width="3%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
          <td width="5%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill No. </strong></div></td>
          <td width="8%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill Date </strong></div></td>
          <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong> Supplier </strong></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>SubTotal</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Tax <?php echo round($res1taxtaxpercent, 2).'%'; ?>&nbsp;</strong></div></td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>Taxable Amount</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>SubTax '.round($taxsubpercent, 2).' %'.'</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>TaxTotal</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Nett</strong></div></td>
        </tr>
        <?php
if ($cbfrmflag1 == 'cbfrmflag1')
{
$sno = '';
$finalsubtotal = '';

$dotarray = explode("-", $transactiondateto);
$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));

$query3 = "select * from master_purchase where billdate between '$transactiondatefrom' and '$transactiondateto' and 
recordstatus <> 'deleted'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
//$res3 = mysql_fetch_array($exec3);
$rowcount3 = mysql_num_rows($exec3);
//if ($rowcount3 > 0) //if1
while ($res3 = mysql_fetch_array($exec3))
{
$showtotaltaxamount = '';

			$billdate = $res3['billdate'];
			$billnumber = $res3['billnumber'];
			$billnumberprefix = $res3['billnumberprefix'];
			$billnumberpostfix = $res3['billnumberpostfix'];
			$suppliername = $res3['suppliername'];
			$suppliercode = $res3['suppliercode'];
			
			$query31 = "select * from master_supplier where suppliercode = '$suppliercode'";
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$tinnumber = $res31['tinnumber'];
			
			//$sumsubtotal = $res3['subtotal'];
			$totaltaxamount = '';
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
			
			$sno = $sno + 1;
			?>
        <tr <?php echo $colorcode; ?>>
          <td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left"> <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left">
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
          <td class="bodytext31" valign="center"  align="left"><div class="bodytext31"> <?php echo $suppliername; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $sumsubtotal; ?>&nbsp;</div></td>
          <?php
			//echo '<br>'.$query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			$query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number = '$taxtype'";
			$exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			while ($res1tax = mysql_fetch_array($exec1tax))
			{
				$res1taxauto_number = $res1tax['auto_number'];
				$res1taxtaxpercent = $res1tax['taxpercent'];
				//if ($res1taxauto_number == $res4taxanum)
				if ($res1taxauto_number != '')
				{

				$query2 = "select sum(amountbeforetax) as sumamountbeforetax, sum(taxamount) as sumtaxamount from purchase_tax 
				where tax_autonumber = '$res1taxauto_number' and billnumber = '$billnumber' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				$res2 = mysql_fetch_array($exec2);
			
				$sumamountbeforetax = $res2['sumamountbeforetax'];
				$sumtaxamount = $res2['sumtaxamount'];
					
					?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo $sumtaxamount; ?></div></td>
          <?php
					$query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";
					$exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
					while ($res2tax = mysql_fetch_array($exec2tax))
					{
						$res2taxauto_number = $res2tax['auto_number'];
						$taxsubpercent = $res2tax['taxsubpercent'];
						
						$taxsubamount = $sumtaxamount * $taxsubpercent;
						$taxsubamount = $taxsubamount / 100;
						$taxsubamount = number_format($taxsubamount, 2, '.', '');
						
						if ($res2taxauto_number != '')
						{
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$sumtaxamount.'&nbsp;</div></td>';
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$taxsubamount.'&nbsp;</div></td>';
							$totaltaxsubamount = $totaltaxsubamount + $taxsubamount;
						}
					}
				}
				$showtotaltaxamount = $showtotaltaxamount + $sumtaxamount + $totaltaxsubamount;
				$showtotaltaxamount = number_format($showtotaltaxamount, 2, '.', '');
				
				$shownettamount = $nettamount + $totaltaxsubamount;
				$shownettamount = number_format($shownettamount, 2, '.', '');
			} 
			?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $showtotaltaxamount; ?>&nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $shownettamount; ?>&nbsp;</div></td>
          <?php
			$nettamount = '';
			$totaltaxamount = '';
			$totaltaxsubamount = '';
			$showfinaltaxamount = $showfinaltaxamount + $showtotaltaxamount;
			$showfinalnettamount = $showfinalnettamount + $shownettamount;
			}//if1 
		//} //while 2
		
	//} //while1
			
	$showfinaltaxamount = number_format($showfinaltaxamount, 2, '.', '');
	$showfinalnettamount = number_format($showfinalnettamount, 2, '.', '');
		
?>
        </tr>
        <?php
} //cbfrmflag

?>
        <tr>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total : </strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $finalsubtotal; ?>&nbsp;</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinaltaxamount; ?>&nbsp;</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinalnettamount; ?>&nbsp;</strong></div></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="1105" 
            align="left" border="0">
      <tbody>
        <tr>
          <td colspan="4" bgcolor="#cccccc" class="bodytext31"><strong>Tax Report - By Purchase Return </strong></td>
          <td width="8%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
					echo '<td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>';
				  }
			  }
			  }
			  }
			  ?>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
          <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
        </tr>
        <tr>
          <td width="3%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong>No.</strong></td>
          <td width="5%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill No. </strong></div></td>
          <td width="8%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Bill Date </strong></div></td>
          <td width="12%"  align="left" valign="center" 
                bgcolor="#ffffff" class="bodytext31"><strong> Supplier </strong></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>SubTotal</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Tax <?php echo round($res1taxtaxpercent, 2).'%'; ?>&nbsp;</strong></div></td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>Taxable Amount</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
					<div align="right"><strong>SubTax '.round($taxsubpercent, 2).' %'.'</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>TaxTotal</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="right"><strong>Nett</strong></div></td>
        </tr>
        <?php
if ($cbfrmflag1 == 'cbfrmflag1')
{
$sno = '';
$finalsubtotal = '';

$dotarray = explode("-", $transactiondateto);
$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
//$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
$transactiondateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear));

$query3 = "select * from master_purchasereturn where billdate between '$transactiondatefrom' and '$transactiondateto' and 
recordstatus <> 'deleted'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
//$res3 = mysql_fetch_array($exec3);
$rowcount3 = mysql_num_rows($exec3);
//if ($rowcount3 > 0) //if1
while ($res3 = mysql_fetch_array($exec3))
{
$showtotaltaxamount = '';

			$billdate = $res3['billdate'];
			$billnumber = $res3['billnumber'];
			$billnumberprefix = $res3['billnumberprefix'];
			$billnumberpostfix = $res3['billnumberpostfix'];
			$suppliername = $res3['suppliername'];
			$suppliercode = $res3['suppliercode'];
			
			$query31 = "select * from master_supplier where suppliercode = '$suppliercode'";
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$tinnumber = $res31['tinnumber'];
			
			//$sumsubtotal = $res3['subtotal'];
			$totaltaxamount = '';
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
			
			$sno = $sno + 1;
			?>
        <tr <?php echo $colorcode; ?>>
          <td class="bodytext31" valign="center"  align="left"><?php echo $sno; ?></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left"> <?php echo $billnumberprefix.$billnumber.$billnumberpostfix; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="left">
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
          <td class="bodytext31" valign="center"  align="left"><div class="bodytext31"> <?php echo $suppliername; ?></div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $sumsubtotal; ?>&nbsp;</div></td>
          <?php
			//echo '<br>'.$query1tax = "select * from master_tax where auto_number like '%$taxtype%'";
			$query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number = '$taxtype'";
			$exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			while ($res1tax = mysql_fetch_array($exec1tax))
			{
				$res1taxauto_number = $res1tax['auto_number'];
				$res1taxtaxpercent = $res1tax['taxpercent'];
				//if ($res1taxauto_number == $res4taxanum)
				if ($res1taxauto_number != '')
				{

				$query2 = "select sum(amountbeforetax) as sumamountbeforetax, sum(taxamount) as sumtaxamount from purchasereturn_tax 
				where tax_autonumber = '$res1taxauto_number' and billnumber = '$billnumber' and recordstatus <> 'deleted'";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				$res2 = mysql_fetch_array($exec2);
			
				$sumamountbeforetax = $res2['sumamountbeforetax'];
				$sumtaxamount = $res2['sumtaxamount'];
					
					?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"><?php echo $sumtaxamount; ?></div></td>
          <?php
					$query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";
					$exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
					while ($res2tax = mysql_fetch_array($exec2tax))
					{
						$res2taxauto_number = $res2tax['auto_number'];
						$taxsubpercent = $res2tax['taxsubpercent'];
						
						$taxsubamount = $sumtaxamount * $taxsubpercent;
						$taxsubamount = $taxsubamount / 100;
						$taxsubamount = number_format($taxsubamount, 2, '.', '');
						
						if ($res2taxauto_number != '')
						{
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$sumtaxamount.'&nbsp;</div></td>';
							echo '<td class="bodytext31" valign="center"  align="left">
							<div align="right">'.$taxsubamount.'&nbsp;</div></td>';
							$totaltaxsubamount = $totaltaxsubamount + $taxsubamount;
						}
					}
				}
				$showtotaltaxamount = $showtotaltaxamount + $sumtaxamount + $totaltaxsubamount;
				$showtotaltaxamount = number_format($showtotaltaxamount, 2, '.', '');
				
				$shownettamount = $nettamount + $totaltaxsubamount;
				$shownettamount = number_format($shownettamount, 2, '.', '');
			} 
			?>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $showtotaltaxamount; ?>&nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right"> <?php echo $shownettamount; ?>&nbsp;</div></td>
          <?php
			$nettamount = '';
			$totaltaxamount = '';
			$totaltaxsubamount = '';
			$showfinaltaxamount = $showfinaltaxamount + $showtotaltaxamount;
			$showfinalnettamount = $showfinalnettamount + $shownettamount;
			}//if1 
		//} //while 2
		
	//} //while1
			
	$showfinaltaxamount = number_format($showfinaltaxamount, 2, '.', '');
	$showfinalnettamount = number_format($showfinalnettamount, 2, '.', '');
		
?>
        </tr>
        <?php
} //cbfrmflag

?>
        <tr>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong>Total : </strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $finalsubtotal; ?>&nbsp;</strong></div></td>
          <?php
			  $query1tax = "select * from master_tax where status <> 'deleted'";// where auto_number like '%$taxtype%'";
			  $exec1tax = mysql_query($query1tax) or die ("Error in Query1tax".mysql_error());
			  while ($res1tax = mysql_fetch_array($exec1tax))
			  {
			  $res1taxauto_number = $res1tax['auto_number'];
			  $res1taxtaxpercent = $res1tax['taxpercent'];
			  if ($res1taxauto_number != '')
			  {
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc">&nbsp;</td>
          <?php
			  $query2tax = "select * from master_taxsub where taxparentanum = '$res1taxauto_number'";//taxparentanum = '$taxtype'";
			  $exec2tax = mysql_query($query2tax) or die ("Error in Query2tax".mysql_error());
			  while ($res2tax = mysql_fetch_array($exec2tax))
			  {
				  $res2taxauto_number = $res2tax['auto_number'];
				  $taxsubpercent = $res2tax['taxsubpercent'];
				  if ($res2taxauto_number != '')
				  {
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
					echo '<td class="bodytext31" valign="center"  align="left" bgcolor="#cccccc">
					<div align="right"><strong>&nbsp;</strong></div></td>';
				  }
			  }
			  }
			  }
			  ?>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinaltaxamount; ?>&nbsp;</strong></div></td>
          <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div align="right"><strong> <?php echo $showfinalnettamount; ?>&nbsp;</strong></div></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php
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
      &nbsp;</td>
  </tr>
  <tr>
    <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
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
          <td  align="left" valign="center" class="bodytext31"><div align="right">
            <?php if ($taxpercent != '0.00') echo $taxpercent; //echo number_format($taxpercent, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($totalsalesamount != '0.00') echo $totalsalesamount; //echo number_format($totalsalesamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td  align="left" valign="center" class="bodytext31"><div align="right">
            <?php if ($sumsalestaxamount != '0.00') echo $sumsalestaxamount; //echo number_format($sumsalestaxamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($totalsalesreturnamount != '0.00') echo $totalsalesreturnamount; //echo number_format($totalsalesreturnamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($sumsalesreturntaxamount != '0.00') echo $sumsalesreturntaxamount; //echo number_format($sumsalesreturntaxamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettsalesamount != '0.00') echo $nettsalesamount; //echo number_format($nettsalesamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettsalestaxamount != '0.00') echo $nettsalestaxamount; //echo number_format($nettsalestaxamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettsalestotalamount != '0.00') echo $nettsalestotalamount; //echo number_format($nettsalestotalamount, 2, '.', ''); ?>
          </div></td>
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
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
          <td  align="left" valign="center" class="bodytext31"><div align="right">
            <?php if ($taxpercent != '0.00') echo $taxpercent; //echo number_format($taxpercent, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($totalpurchaseamount != '0.00') echo $totalpurchaseamount; //echo number_format($totalpurchaseamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td  align="left" valign="center" class="bodytext31"><div align="right">
            <?php if ($sumpurchasetaxamount != '0.00') echo $sumpurchasetaxamount; //echo number_format($sumpurchasetaxamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($totalpurchasereturnamount != '0.00') echo $totalpurchasereturnamount; //echo number_format($totalpurchasereturnamount, 2, '.', ''); ?>
            &nbsp;</div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($sumpurchasereturntaxamount != '0.00') echo $sumpurchasereturntaxamount; //echo number_format($sumpurchasereturntaxamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettpurchaseamount != '0.00') echo $nettpurchaseamount; //echo number_format($nettpurchaseamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettpurchasetaxamount != '0.00') echo $nettpurchasetaxamount; //echo number_format($nettpurchasetaxamount, 2, '.', ''); ?>
          </div></td>
          <td class="bodytext31" valign="center"  align="left"><div align="right">
            <?php if ($nettpurchasetotalamount != '0.00') echo $nettpurchasetotalamount; //echo number_format($nettpurchasetotalamount, 2, '.', ''); ?>
          </div></td>
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
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
