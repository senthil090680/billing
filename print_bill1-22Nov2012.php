<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];


if (isset($_REQUEST["billautonumber"])) { $billautonumber = $_REQUEST["billautonumber"]; } else { $billautonumber = ""; }
//$billautonumber = $_REQUEST["billautonumber"];

//$billnumber = $_REQUEST["banum"];
//$banum = $_REQUEST["billautonumber"];

if (isset($_REQUEST["printsource"])) { $printsource = $_REQUEST["printsource"]; } else { $printsource = ""; }
//$printsource = $_REQUEST["printsource"];

//banum coming from cancel bill print preview.
//if ($banum == '') $banum = $cancelbillnumber;
//if ($banum == '') $banum = $editbillnumber;

//if ($banum != '') 
//{

	//if ($_REQUEST["copy1"] == '')
	if ($printsource == '')
	{
		//$query22 = "select * from master_sales where auto_number = '$banum'";// and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
		$query22 = "select * from master_sales where auto_number = '$billautonumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
	}
	if ($printsource == 'billpage')
	{
		//$query22 = "select * from master_sales where auto_number = '$banum'";// and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
		$query22 = "select * from master_sales where billnumber = ".$_REQUEST["billnumber"]." and recordstatus <> 'DELETED' and companyanum = '$companyanum' and financialyear = '$financialyear'";
	}
	else if ($printsource == 'printselectionpage')
	{
		//$query22 = "select * from master_sales where billnumber = '$banum' and status <> 'CANCELLED' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";
		$query22 = "select * from master_sales where billnumber = ".$_REQUEST["billnumber"]." and recordstatus <> 'DELETED' and companyanum = '$companyanum' and financialyear = '$financialyear'";
	}
	
	$exec22 = mysql_query($query22) or die ("Error in Query22".mysql_error());
	$res22 = mysql_fetch_array($exec22);
	$res22bnum = $res22["billnumber"];
	$billautonumber = $res22["auto_number"];
	$res22billnumberprefix = $res22["billnumberprefix"];
	$res22billnumberpostfix = $res22["billnumberpostfix"];
	$res22anum = $res22["auto_number"];
	$banum = $res22bnum;
	if ($banum == '')
	{
		echo "Bill Number Does Not Exist.";
		exit;
	}

//}
if (isset($_REQUEST["copy1 "])) { $copy1  = $_REQUEST["copy1 "]; } else { $copy1  = ""; }
//$copy1  = $_REQUEST["copy1 "];

if (isset($_REQUEST["title1 "])) { $title1  = $_REQUEST["title1 "]; } else { $title1  = ""; }
//$title1  = $_REQUEST["title1 "];
//echo $banum;

$query2 = "select * from settings_bill where companyanum = '$companyanum'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);


	$f1 = $res2["f1"];
	$f2 = $res2["f2"];
	$f3 = $res2["f3"];
	$f4 = $res2["f4"];
	$f5 = $res2["f5"];
	$f6 = $res2["f6"];
	$f7 = $res2["f7"];
	$f8 = $res2["f8"];
	$f9 = $res2["f9"];
	$f10 = $res2["f10"];
	$f11 = $res2["f11"];
	$f12 = $res2["f12"];
	$f13 = $res2["f13"];
	$f14 = $res2["f14"];
	$f15 = $res2["f15"];
	$f16 = $res2["f16"];
	$f17 = $res2["f17"];
	$f18 = $res2["f18"];
	$f19 = $res2["f19"];
	$f20 = $res2["f20"];
	$f21 = $res2["f21"];
	$f22 = $res2["f22"];
	$f23 = $res2["f23"];
	$f24 = $res2["f24"];
	$f25 = $res2["f25"];
	$f26 = $res2["f26"];
	$f27 = $res2["f27"];
	$f28 = $res2["f28"];
	$f29 = $res2["f29"];
	$f30 = $res2["f30"];
	$f31 = $res2["f31"];
	$f32 = $res2["f32"];
	$f9size = $res2["f9size"];
	$f27size = $res2["f27size"];
	$f28size = $res2["f28size"];
	$letterheadprinting = $res2["letterheadprinting"];

//$query21 = "select auto_number from master_sales where billnumber = '$banum' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";
$query21 = "select auto_number from master_sales where auto_number = '$res22anum' and financialyear = '$financialyear'";// and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
$res21 = mysql_fetch_array($exec21);
$res21anum = $res21["auto_number"];

$query3 = "select * from master_sales where auto_number = '$res21anum' and companyanum = '$companyanum' and financialyear = '$financialyear'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
$res3 = mysql_fetch_array($exec3);

$billnumberprefix = $res3["billnumberprefix"];
$billnumberprefix = strtoupper($billnumberprefix);
$billnumberprefix = trim($billnumberprefix);

$billnumberpostfix = $res3["billnumberpostfix"];
$billnumberpostfix = strtoupper($billnumberpostfix);
$billnumberpostfix = trim($billnumberpostfix);

$billnumber = $res3["billnumber"];
$billnumberprefix = $billnumberprefix.''.$billnumber.''.$billnumberpostfix;

$res3date = $res3["billdate"];
$billtime = substr($res3date, 11, 8);
$billdateonly = substr($res3date, 0, 10);
$dotarray = explode("-", $billdateonly);
$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));

//$billdate = $dbdateday.' '.$billtime;
$billdate = $dbdateday;//.' '.$billtime;
$billtype = $res3["billtype"];

$customername = $res3["customername"];
//if ($customername != '') $customername = 'M/s. '.$customername;
$address = $res3["address"];
$location = $res3["location"];
$city = $res3["city"];
$state = $res3["state"];
$pincode = $res3["pincode"];
$city = $city.', '.$state;
if ($pincode != '') $city = $city.' - '.$pincode;
$deliveryaddress = $res3["deliveryaddress"];

$subtotal = $res3["subtotal"];

$subtotalamountdiscountpercent = $res3["subtotalamountdiscountpercent"];
$subtotalamountdiscountamount = $res3["subtotalamountdiscountamount"];
$subtotalaftercombinediscount = $res3["subtotalaftercombinediscount"];

$delivery = $res3["delivery"];
$deliverymode = $res3["deliverymode"];
$roundoff = $res3["roundoff"];
$totalamount = $res3["totalamount"];
$billremarks = $res3["remarks"];

$footerline1 = $res3["footerline1"];
$footerline2 = $res3["footerline2"];
$footerline3 = $res3["footerline3"];
$footerline4 = $res3["footerline4"];
$footerline5 = $res3["footerline5"];
$footerline6 = $res3["footerline6"];

$tinnumber = $res3["tinnumber"];
$cstnumber = $res3["cstnumber"];

$companyanum = $_SESSION["companyanum"];
$query4 = "select * from master_company where auto_number = '$companyanum'";
$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
$res4 = mysql_fetch_array($exec4);

$discountexists = "";
$query4 = "select * from sales_details where bill_autonumber = '$billautonumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
while ($res4 = mysql_fetch_array($exec4))
{

	$discountpercent = $res4["discountpercentage"];
	$discountamount = $res4["discountrupees"];
	if ($discountpercent != '0.00' || $discountamount != '0.00')
	{
		$discountexists = 'yes';
	}
}

if ($discountexists == 'yes')
{
	$columncount = 8;
}
else
{
	$columncount = 6;
}


?>
<style type="text/css">
<!--
.style6 {<?php echo 'font-size: '.$fontsize4.'px'; ?>;}
.style8 {<?php echo 'font-size: '.$fontsize4.'px'; ?>; font-weight: bold; }


/*
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 24px;
}

.style2 {font-size: 10px}
.style5 {font-family: "Times New Roman", Times, serif; font-weight: bold; font-size: 18px; }
.style6 {font-size: 14px}
.style8 {font-size: 14px; font-weight: bold; }
*/

table.sample {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
.style12 {font-size: 18px; font-weight: bold; }
.style27 {font-size: 14px; }
.style28 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 24px;
}
.style29 {font-family: Neuropol}

-->
</style>
<script language="javascript">

function escapekeypressed()
{
	//alert(event.keyCode);
	if(event.keyCode=='27'){ window.close(); }
}

</script>
<body onkeydown="escapekeypressed()">
<table width="660" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center">
	<?php
	//for letter head printing settings
	if ($letterheadprinting == '') // to print on blank paper with headers.
	{
	//echo "inside if";
	?>
      <table width="99%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
		<?php include ("print_showlogo1.php"); ?>
          <td width="57%"><div align="center" class="style12">
            <div align="left"><span class="style29"><font <?php echo 'size="'.$f9size.'"'; ?>><?php echo $f9; ?></font></span></div>
          </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php echo 'size="'.$f27size.'"'; ?>><?php echo $f10; ?></font> </span></div>
            </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php echo 'size="'.$f27size.'"'; ?>><?php echo $f11; ?></font> </span></div>
            </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php echo 'size="'.$f27size.'"'; ?>><?php echo $f12; ?></font> </span></div>
            </div></td>
          <td width="29%" valign="top">
		  <div align="right"><span class="style28">
		    <?php 
		  if ($title1 == '')
		  {
		  	echo $f28; 
		}
		else
		{
		 echo $copy1; 
			//echo $title1;
		}
		  ?>
		     </span> <br />
		    </div>
		  <div class="style27">
		    <div align="right"><span class="style6"><?php echo $title1; ?></span>&nbsp;&nbsp;</div>
		  </div></td>
        </tr>
      </table>
	  <?php
	}
	else if ($letterheadprinting == 'YES') // to print on letter head without headers.
	{
	//echo "inside else";
	?>
      <table width="99%" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <td width="14%" height="100">&nbsp;</td>
          <td width="57%"><div align="center" class="style12">
            <div align="left"><span class="style28"><font <?php if ($f9size != '') { echo 'size="'.$f9size.'"'; } ?>><?php //echo $f9; ?>&nbsp;</font></span></div>
          </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php if ($f27size != '') { echo 'size="'.$f27size.'"'; } ?>><?php //echo $f10; ?>&nbsp;</font> </span></div>
            </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php if ($f27size != '') { echo 'size="'.$f27size.'"'; } ?>><?php //echo $f11; ?>&nbsp;</font> </span></div>
            </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> <font <?php if ($f27size != '') { echo 'size="'.$f27size.'"'; } ?>><?php //echo $f12; ?>&nbsp;</font> </span></div>
            </div></td>
          <td width="29%" valign="top">
		  <span class="style28">
		  <?php 
		  if ($title1 == '')
		  {
		  	//echo $f28; 
		}
		else
		{
			//echo $title1;
		}
		  ?>
		  </span><br /><?php //echo $copy1; ?></td>
        </tr>
      </table>
	<?php
	}
	//end of letter head printing settings.	  
	?>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">&nbsp;</div></td>
  </tr>
  
  <tr>
    <td colspan="2"  valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="62%"><table width="97%" border="0" align="left" cellpadding="0" cellspacing="0" class="sample">
          <tr>
            <td>
			<div align="left" class="style27"><span class="style6">
			<?php echo $f13; ?></span></div>
			<div align="left" class="style27"><span class="style6"> 
			<font>
			<?php echo $f14.' '.$customername; ?></font></span></div>
			<div align="left" class="style27"><span class="style6">
			<?php echo $address; ?></span></div>
			<div align="left" class="style27"><span class="style6">
			<?php echo $location.' '.$city; ?></span></div>
			<div align="left"></div>			</td>
          </tr>
        </table></td>
        <td width="38%" valign="top"><table width="92%" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="left" class="style27"><span class="style6"><?php echo $f15.' '.$billnumberprefix; ?></span></div></td>
          </tr>
          <tr>
            <td><div align="left" class="style27"><span class="style6"><?php echo $f16.' '.$billdate; ?></span></div></td>
          </tr>
          <tr>
            <td><div align="left" class="style27"><span class="style6">
              <?php if ($billtype == 'CASH') { echo $billtype.' BILL'; } ?>
            </span></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  
  <?php
  if ($deliveryaddress != '')
  {
  ?>
  <tr>
    <td colspan="3"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="62%"><table width="97%" border="0" align="left" cellpadding="0" cellspacing="0" class="sample">
            <tr>
              <td>
			  <div align="left" class="style27"><span class="style6"> <?php echo 'Delivery Address:'; ?></span></div>
			  <div align="left" class="style27"><span class="style6"> <?php echo nl2br($deliveryaddress); ?></span></div>			  </td>
            </tr>
        </table></td>
        <td width="38%" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <?php
  }
  ?>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	
	
	  <table width="98%" border="0" cellspacing="0" cellpadding="0" class="sample">
        <tr>
          <td width="53%" height="18"><div align="left" class="style27"><span class="style6">&nbsp;<?php echo $f17.' '.$tinnumber; ?></span></div><span class="style27">
          </span><span class="style27">
          </span></td>
          <td width="47%" valign="top"><div align="left" class="style27"><span class="style6">&nbsp;<?php echo $f20.' '.$cstnumber; ?></span></div></td>
        </tr>
      </table>
	  <table width="98%" border="0" cellspacing="0" cellpadding="0" class="sample">

      <tr>
        <td width="53%"><span class="style27"><span class="style6">&nbsp;<?php echo $f18.' '.$footerline1; ?></span></span><span class="style27"><br />
          <span class="style6">&nbsp;<?php echo $f19.' '.$footerline2; ?></span></span></td>
        <td width="47%"><span class="style27"><span class="style6">&nbsp;<?php echo $f21.' '.$footerline3; ?></span></span><span class="style27"><br />
          <span class="style6">&nbsp;<?php echo $f22.' '.$footerline4; ?></span></span></td>
      </tr>
    </table>	</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3">
	
	
	
	
	
	
	
	<table width="98%" border="1" align="left" cellpadding="0" cellspacing="0" frame="box" rules="groups" class="sample">
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      <colgroup span="1">
      </colgroup>
      
      <thead>
        <tr>
          <td width="4%" height="21">
              <div align="left" class="style27">&nbsp;SN</div>         </td>
          <td width="59%"><div align="left" class="style27">&nbsp;Description&nbsp;</div></td>
          <td width="5%"><div align="left" class="style27">
            <div align="right">&nbsp;Rate&nbsp;</div>
          </div></td>
          <td width="5%"><div align="right" class="style27">
            <div align="center">&nbsp;Qty&nbsp;</div>
          </div></td>
          <td width="5%"><div align="right" class="style27">
            <div align="center">&nbsp;Unit&nbsp;</div>
          </div></td>
		  <?php
		  if ($discountexists == 'yes')
		  {
		  ?>
          <td width="5%"><div align="right" class="style27">&nbsp;Dsc%&nbsp;</div></td>
          <td width="5%"><div align="right" class="style27">&nbsp;Dsc&nbsp;</div></td>
		  <?php
		  }
		  ?>
          <td width="11%"><div align="right" class="style27">&nbsp;Tax%&nbsp;</div></td>
          <td width="16%"><div align="right" class="style27">&nbsp;Total&nbsp;</div></td>
        </tr>
		</thead>
		<?php
		$sno = "";
		$totalquantity = "";
		$totaldescriptiontext = "";
		$tablerowcount = "";
		$discounttextcount = "";
		$additionaltextcount  = "";
		$subtotaldiscounttotal = '';
		
	  	$query4 = "select * from sales_details where bill_autonumber = '$billautonumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		while ($res4 = mysql_fetch_array($exec4))
		{
		$sno = $sno + 1;
		$description = $res4["itemname"];
		
		$itemanum = $res4["itemanum"];
		$query8 = "select * from master_item where auto_number = '$itemanum'";
		$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
		$res8 = mysql_fetch_array($exec8);
		$res8itemcode = $res8["itemcode"];
		
		//$tables = mysql_list_tables ($databasename);
		//while (list ($temp) = mysql_fetch_array ($tables)) 
		//{
			//if ($temp == 'master_settings') 
			//{
				//echo "Table Found";
				$query5 = "select * from master_settings where modulename = 'PRINTOUT' and settingsname = 'ITEM_CODE_PRINTOUT' and status <> 'deleted'";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				$res5 = mysql_fetch_array($exec5);
				$settingsvalue1 = $res5["settingsvalue"];
				if ($settingsvalue1 == 'SHOW ITEM CODE')
				{
					$description = $res8itemcode.' - '.$description;
				}
				else
				{
					$description = $description;
				}
			//}
		//}

		$additionaltext = $res4["itemdescription"];
		if ($additionaltext != '') $description = $description.'<br>'.nl2br($additionaltext);
		$quantity = $res4["quantity"];
		$quantity = round($quantity, 4);
		$totalquantity = $totalquantity + $quantity;
		$unit = $res4["unit_abbreviation"];
		$rate = $res4["rate"];
		$total = $res4["totalamount"];
		
		$discountpercent = $res4["discountpercentage"];
		$discountamount = $res4["discountrupees"];
		
		$query9 = "select * from sales_tax where  bill_autonumber = '$billautonumber' and itemanum = '$itemanum' and companyanum = '$companyanum' and financialyear = '$financialyear'";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
		$res9 = mysql_fetch_array($exec9);
		$taxpercent = $res9["taxpercent"];
		
		$totaldescriptiontext = $totaldescriptiontext.'..'.$description;

		if ($discountpercent == '0.00') $discountpercent = '';
		if ($discountamount == '0.00') $discountamount = '';

		?>
        <tr>
        <td height="21" valign="top"><span class="style27">&nbsp;<?php echo $sno; ?>&nbsp;</span></td>
        <td valign="top"><div align="left" class="style27">
			<?php 
			//echo $description.$discounttext; 
			echo $description; 
			?>&nbsp;
        </div>          
          <div align="left"></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $rate; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $quantity; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $unit; ?>&nbsp;</span></div></td>
		  <?php
		  if ($discountexists == 'yes')
		  {
		  ?>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $discountpercent; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $discountamount; ?>&nbsp;</span></div></td>
		<?php
		}
		?>
		<td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $taxpercent; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $total; ?>&nbsp;</span></div></td>
      </tr>
		<?php
		$discounttext = '';
		//table extnesion loop count
		if ($additionaltext != '') $additionaltextcount = $additionaltextcount + 1; // = $tablerowcount + 1;;
		$tablerowcount = $tablerowcount + 1;
		
	  	}
		$additionaltextcount;
		$tablerowcount;

		$tablerowcount = $tablerowcount + $discounttextcount;
		$tablerowcount = $tablerowcount + $additionaltextcount;
		//$tablemaxlines = 14;
		
		$totaldescriptiontext = strlen($totaldescriptiontext);
		$totaldescriptionlines = ($totaldescriptiontext / 40);
		$totaldescriptionlines = round($totaldescriptionlines);
		$totaldescriptionlines = $totaldescriptionlines + 1;
		$tablemaxlines = 17 - $totaldescriptionlines;
		
		$query5 = "select * from master_sales where auto_number = '$res21anum' and financialyear = '$financialyear'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		$res5 = mysql_fetch_array($exec5);
		$subtotal = $res5["subtotal"];
		$subtotaldiscountpercent = $res5["subtotaldiscountpercent"];
		$subtotaldiscountrupees = $res5["subtotaldiscountrupees"];
		
		$subtotaldiscountpercentapply1 = $res5['subtotaldiscountpercentapply1'];
		$subtotaldiscountamountapply1 = $res5['subtotaldiscountamountapply1'];
		$subtotaldiscountamountonlyapply1 = $res5['subtotaldiscountamountonlyapply1'];
		$subtotaldiscountamountonlyapply2 = $res5['subtotaldiscountamountonlyapply2'];
		//$subtotaldiscounttotal = $res5['subtotaldiscounttotal'];
		if ($subtotaldiscountpercentapply1 != "0.00")
		{
			$subtotaldiscounttotal = $res5['subtotaldiscountamountapply1'];
			$subtotaldiscountpercent = $res5['subtotaldiscountpercentapply1'];	
			$discountshowtext = 'Discount @ '.$subtotaldiscountpercent.'%'; 	
		}
		if ($subtotaldiscountamountonlyapply1 != "0.00")
		{
			$subtotaldiscounttotal = $res5['subtotaldiscountamountonlyapply1'];
			$subtotaldiscountpercent = $res5['subtotaldiscountamountonlyapply2'];		
			$discountshowtext = 'Discount Amount'; 
		}
		
		$subtotalafterdiscountamount = $res5["subtotalafterdiscount"];
		$subtotalaftertax = $res5["subtotalaftertax"];
		
		//$subtotalafterdiscountamount = $subtotal - $subtotaldiscounttotal;
		
		if ($subtotaldiscounttotal == '0.00') 
		{
			//$tablemaxlines = $tablemaxlines + 2; //to maintain table height for two lines.
		}
		//if ($transportation == '0.00') $tablemaxlines = $tablemaxlines + 1; //add one line if no delivery charges.
		//$tablemaxlines = $tablemaxlines + 1; //add one line for delivery charges.
		//$tablemaxlines = $tablemaxlines + 1; //add one line for packaging charges.
		//echo $tablediscountamount;
		//echo $tablemaxlines;
		
		//$tablerowcount = $tablerowcount + 1; // to skip on loop.
		//to extent the table height. total rows 17 if no products in bill.
		//echo $tablerowcount;
		//for ($i=$tablerowcount;$i<=$tablemaxlines;$i++)
		//$tablerowcount = 17; // to skip on loop.
		for ($i=1;$i<=$tablemaxlines;$i++)
		{
		?>
		<tr>
          <td valign="top"><span class="style6"><?php //echo $i; ?>&nbsp;</span></td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
		  <?php
		  if ($discountexists == 'yes')
		  {
		  ?>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
		  <?php
		  }
		  ?>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
		<?php
		}
		
		?>
      </thead>
	  <thead>
        <tr>
          <td height="21" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">Sub Total   &nbsp;</span></div></td>
          <td><div align="right"><span class="style27">&nbsp;<?php echo $subtotal; ?>&nbsp;</span></div></td>
        </tr>
       <?php
		if ($subtotaldiscounttotal != '')
		{
		?>
     <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27">
        <?php echo $discountshowtext; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $subtotaldiscounttotal; ?>&nbsp;</span></div></td>
      </tr>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27">
		<?php echo 'Total After Discount'; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $subtotalafterdiscountamount; ?>&nbsp;</span></div></td>
      </tr>
      <?php
	  	}
	  ?>
     <?php
		//$subtotalaftertax = $subtotalafterdiscountamount;

	  	//$query6 = "select *, sum(taxamount) as sumtaxamount from sales_tax where bill_autonumber = '$res22anum' group by taxpercent order by auto_number";
	  	$query6 = "select *, sum(taxamount) as sumtaxamount from sales_tax where bill_autonumber = '$billautonumber' and financialyear = '$financialyear' group by tax_autonumber, taxname order by auto_number";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		while ($res6 = mysql_fetch_array($exec6))
		{
		$taxname = $res6["taxname"];
		$taxname = strtoupper($taxname);
		$taxpercent = $res6["taxpercent"];
		//$taxamount = $res6["taxamount"];
		$taxamount = $res6["sumtaxamount"];
		
		//$subtotalaftertax = $subtotalaftertax + $taxamount;
	  ?>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27"><?php echo $taxname; //.' @ '.$taxpercent.'%'; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $taxamount; ?>&nbsp;</span></div></td>
      </tr>
      <?php
	  	}
		?>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27"><?php echo 'Total After Tax'; //.' @ '.$taxpercent.'%'; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $subtotalaftertax; ?>&nbsp;</span></div></td>
      </tr>
		<?php
		
		if ($delivery != '0.00')
		{
		
	  ?>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27">
		<?php echo $f30; //'Delivery '.$deliverymode;//$f30; ?>&nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;
		<?php echo $delivery; ?>&nbsp;</span></div></td>
      </tr>
	  <?php
	  }
	  ?>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27">Round Off   &nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $roundoff; ?>&nbsp;</span></div></td>
      </tr>
      <tr>
        <td height="21" colspan="<?php echo $columncount; ?>" valign="top"><div align="right"><span class="style27">Total  &nbsp;</span></div></td>
        <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $totalamount; ?>&nbsp;</span></div></td>
      </tr>
      </thead>
    </table>	</td>
  </tr>
  <tr>
    <td colspan="3"><div class="style27">
	<?php
	include ('convert_currency_to_words.php');
	echo $convertedwords = covert_currency_to_words($totalamount); //function call
	?>
	</span></div></td>
  </tr>
  
  <tr>
    <td width="341"><span class="style6"><?php echo 'Total Items : '.round($totalquantity, 4); ?></span></td>
    <td width="319" colspan="2" rowspan="5" valign="top"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><span class="style27"> </span>
                <table width="99%" border="0" align="left">
                  <tr>
                    <td><div align="right"><span class="style27"><b><?php echo $f25; ?></b></span></div></td>
                  </tr>
                </table>
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right"><span class="style6"> </span>
                <table width="99%" border="0" align="left">
                  <tr>
                    <td><div align="right"><span class="style27"> <b><?php echo $f26; ?></b></span></div></td>
                  </tr>
                </table>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <?php
  if ($billremarks != '')
  {
  ?>
  <tr>
    <td><span class="style6"><?php echo 'Remarks : '.$billremarks; ?></span></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td><span class="style6"><?php echo $f31; ?></span></td>
  </tr>
  <tr>
    <td><span class="style6"><?php echo $f32; ?></span></td>
  </tr>
  <tr>
    <td><div class="style27"><span class="style6"><?php echo $f23; ?></span></div></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	
	<table width="96%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="style27">
          <div align="justify"><span class="style6"></span><em><?php echo nl2br($f24); ?></em></div>
        </div></td>
      </tr>
    </table>	</td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><span class="style27">
	<?php 
	$query7 = "select * from master_edition where status = 'ACTIVE'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$res7edition = $res7["edition"];
	if ($res7edition == 'FREE' or $res7edition == 'SPONSORED')
	{
		echo "Free Software By: WWW.SIMPLEINDIA.COM"; 
	}
	?>
	</span></td>
  </tr>
</table>
</body>