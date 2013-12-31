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

//$financialyear = $_SESSION["financialyear"];

	$query6 = "select * from master_company where auto_number = '$companyanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$res6companycode = $res6["companycode"];
	
	$query7 = "select * from master_settings where companycode = '$res6companycode' and modulename = 'SETTINGS' and 
	settingsname = 'CURRENT_FINANCIAL_YEAR'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$financialyear = $res7["settingsvalue"];
	$_SESSION["financialyear"] = $financialyear;
	//echo $_SESSION['financialyear'];

//$custid=$_SESSION["cstid"];
//$custname=$_SESSION["cstname"];
$jloopcount = "";

		  $kindattn1string = "";
		  $kindattnfinalstring = "";
		  $kindattn2string = "";
		  $kindattn3string = "";

if (isset($_REQUEST["qanum"])) { $qanum = $_REQUEST["qanum"]; } else { $qanum = ""; }
//$qanum = $_REQUEST["qanum"];

$query2 = "select * from settings_quotation where companyanum = '$companyanum'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);

$companytitle = $res2["companytitle"];
$companytitle = strtoupper($companytitle);
$companytitle = trim($companytitle);
$headerline1left  = $res2["headerline1left"];
$headerline2left  = $res2["headerline2left"];
$headerline3left  = $res2["headerline3left"];
$headerline1right = $res2["headerline1right"];
$headerline2right = $res2["headerline2right"];
$headerline3right  = $res2["headerline3right"];
$quotationtitle = $res2["quotationtitle"];
$quotationtitle = strtoupper($quotationtitle);
$quotationtitle = trim($quotationtitle);
$addressline1 = $res2["addressline1"];
$kindattntext = $res2["kindattntext"];

$query202 = "select * from settings_bill where companyanum = '$companyanum'";
$exec202 = mysql_query($query202) or die ("Error in Query202".mysql_error());
$res202 = mysql_fetch_array($exec202);
$companylogo = $res202["companylogo"];
$showlogo = $res202["showlogo"];

if ($qanum == '')
{
	$qnum = $_REQUEST["qnum"];
	$query31 = "select * from master_quotation where quotationnumber = '$qnum' and status <> 'DELETED' and companyanum = '$companyanum'";
	$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
	$res31 = mysql_fetch_array($exec31);
	$qanum = $res31["auto_number"];
}

$query3 = "select * from master_quotation where auto_number = '$qanum' and status <> 'DELETED'";
$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
$res3 = mysql_fetch_array($exec3);

$quotationnumberprefix = $res3["quotationnumberprefix"];
$quotationnumberprefix = strtoupper($quotationnumberprefix);
$quotationnumberprefix = trim($quotationnumberprefix);
$quotationnumber = $res3["quotationnumber"];
$quotationnumberprefix = $quotationnumberprefix.''.$quotationnumber;

$res3date = $res3["updatedate"];

$billtime = substr($res3date, 11, 8);
$billdateonly = substr($res3date, 0, 10);
$dotarray = explode("-", $billdateonly);

$dotyear = $dotarray[0];
$dotmonth = $dotarray[1];
$dotday = $dotarray[2];
$dbdateday = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
$quotationdate = $dbdateday;

$customername = $res3["customername"];
if ($customername != '') $customername = 'M/s. '.$customername;
$address = $res3["address"];
$location = $res3["location"];
$city = $res3["city"];
$state = $res3["state"];
$pincode = $res3["pincode"];
$city = $city.', '.$state;
if ($pincode != '') $city = $city.' - '.$pincode;

$title1 = $res3["title1"];
$title2 = $res3["title2"];
$title3 = $res3["title3"];
$contactperson1 = $res3["contactperson1"];
$contactperson2 = $res3["contactperson2"];
$contactperson3 = $res3["contactperson3"];
$designation1  = $res3["designation1"];
$designation2  = $res3["designation2"];
$designation3  = $res3["designation3"];
$department1  = $res3["department1"];
$department2  = $res3["department2"];
$department3  = $res3["department3"];

if($contactperson1 != '')
{
	$kindattn1string = $contactperson1;
	if ($title1 != '')
	{
		$kindattn1string = $title1.' '.$kindattn1string;
	}
	if ($designation1 != '')
	{
		$kindattn1string = $kindattn1string.' - '.$designation1;
	}
	if ($department1 != '')
	{
		$kindattn1string = $kindattn1string.' - '.$department1;
	}
}

if($contactperson2 != '')
{
	$kindattn2string = $contactperson2;
	if ($title2 != '')
	{
		$kindattn2string = $title2.' '.$kindattn2string;
	}
	if ($designation2 != '')
	{
		$kindattn2string = $kindattn2string.' - '.$designation2;
	}
	if ($department2 != '')
	{
		$kindattn2string = $kindattn2string.' - '.$department2;
	}
}
if($contactperson3 != '')
{
	$kindattn3string = $contactperson3;
	if ($title3 != '')
	{
		$kindattn3string = $title3.' '.$kindattn3string;
	}
	if ($designation3 != '')
	{
		$kindattn3string = $kindattn3string.' - '.$designation3;
	}
	if ($department3 != '')
	{
		$kindattn3string = $kindattn3string.' - '.$department3;
	}
}

//echo "<br>".$kindattn1string;
//echo "<br>".$kindattn2string;
//echo "<br>".$kindattn3string;

$lumpsum = $res3["lumpsum"];
$subtotal = $res3["subtotal"];
$totalamount=$res3["totalamount"];
$deartext = $res3["deartext"];
$subtext = $res3["subtext"];
if ($subtext != '') $subtext = 'Sub : '.$subtext;
$reftext = $res3["reftext"];
if ($reftext != '') $reftext = 'Ref : '.$reftext;
$quotationstarttext = $res3["quotationstarttext"];
$quotationendtext = $res3["quotationendtext"];
$transportation = $res3["transportation"];
$packaging = $res3["packaging"];

$totalaftertax = $res3["totalaftertax"];
$totalamount = $res3["totalamount"];
//$roundoff = $totalamount - $totalaftertax;
$roundoff = $res3["roundoff"];
$roundoff = number_format($roundoff, 2, '.', '');


$query21 = "select * from settings_bill where companyanum = '$companyanum'";
$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
$res21 = mysql_fetch_array($exec21);
$f29=$res21["f29"];
$f30=$res21["f30"];
$letterheadprinting = $res21["letterheadprinting"];

$footerline1 = $res3["footerline1"];
$footerline2 = $res3["footerline2"];
$footerline3 = $res3["footerline3"];
$footerline4 = $res3["footerline4"];
$footerline5 = $res3["footerline5"];
$footerline6 = $res3["footerline6"];

$fontsize1 = $res2["fontsize1"]; //F1 customer title
$fontsize2 = $res2["fontsize2"]; // F2 Header lines.
$fontsize3 = $res2["fontsize3"]; // F3 Body of bill.
$fontsize4 = $res2["fontsize4"]; // F4 Tabular Columns.

//echo $fontsize1;
$companyanum = $_SESSION["companyanum"];
$query4 = "select * from master_company where auto_number = '$companyanum'";
$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
$res4 = mysql_fetch_array($exec4);

//$f9color = $res4["f9color"];
//$f10color = $res4["f10color"];
//$f25color = $res4["f25color"];

$f9color = "";
$f10color = "";
$f25color = "";

//echo $f9color;


$columncount = 2;

include ("print_column_count_include1.php");

//echo $columncount;


?>
<style type="text/css">
<!--

.style3 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	<?php //echo 'font-size: '.$fontsize1.'px'; ?>
	font-size: 14px;
}
.style2 {font-size: 14px<?php //echo 'font-size: '.$fontsize2.'px'; ?>}
.style5 {font-family: "Times New Roman", Times, serif; font-weight: bold; font-size: 14px;<?php //echo 'font-size: '.$fontsize3.'px'; ?>; }
.style6 {font-size: 14px<?php //echo 'font-size: '.$fontsize4.'px'; ?>;}
.style8 {font-size: 14px;<?php //echo 'font-size: '.$fontsize4.'px'; ?>; font-weight: bold; }


/*.style2 {font-size: 10px}
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 24px;
}
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
table.sample tr {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
table.sample td {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
.style12 {font-size: 18px; font-weight: bold; }
.style27 {font-size: 14px; }

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
<table width="660" border="0" cellpadding="0" cellspacing="0">
  <tr>
     <td colspan="2" align="left">
	<?php
	//for letter head printing settings
	if ($letterheadprinting == '') // to print on blank paper with headers.
	{
	//echo "inside if";
	?>
	 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
		<?php include ("print_showlogo1.php"); ?>
        <!--<td width="13%"><div align="center"><img src="logofiles/<?php echo $companyanum;?>.jpg" width="75" height="75" /></div></td>-->
        <!--<td width="2%">&nbsp;</td>-->
        <td width="74%"><div align="left" class="style12">
          <div align="left"><span class="style6"> 
		  
              <font <?php  echo 'size="'.$fontsize1.'"';  ?>>
                <?php
			if ($showlogo == 'YES')
			{
			if ($companylogo != '')
			{
				echo '<img src="'.$companylogo.'" height="35" width="35" border="0">';
			}
			}
			?>
                <?php echo $companytitle; ?></font> </span></div>
        </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> 
                  <font <?php if ($fontsize2 != '') { echo 'size="'.$fontsize2.'"'; } ?>><?php echo $headerline1left; ?></font> </span></div>
            </div>
          <div align="center" class="style27">
            <div align="left"><span class="style6"> 
                <font <?php if ($fontsize2 != '') { echo 'size="'.$fontsize2.'"'; } ?>><?php echo $headerline2left; ?></font> </span></div>
          </div>
          <div align="center" class="style27">
            <div align="left"><span class="style6"> 
                <font <?php if ($fontsize2 != '') { echo 'size="'.$fontsize2.'"'; } ?>><?php echo $headerline3left; ?></font> </span></div>
          </div></td>
		  <td  width="26%" valign="top">
    <span class="style28"><b><?php //echo $quotationtitle; ?></b></div></span></td>
      </tr>
    </table>
	<?php
	}
	else if ($letterheadprinting == 'YES') // to print on letter head without headers.
	{
	//echo "inside else";
	?>
	 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="13%" height="100"><div align="center">
		<!--<img src="logofiles/<?php echo $companyanum;?>.jpg" width="75" height="75" />-->
		</div></td>
        <!--<td width="2%">&nbsp;</td>-->
        <td width="74%"><div align="left" class="style12">
          <div align="left"><span class="style6"> 
		  
              <font <?php  echo 'size="'.$fontsize1.'"';  ?>>
            <?php
			if ($showlogo == 'YES')
			{
			if ($companylogo != '')
			{
				//echo '<img src="'.$companylogo.'" height="35" width="35" border="0">';
			}
			}
			?>
            <?php //echo $companytitle; ?></font> </span></div>
        </div>
            <div align="center" class="style27">
              <div align="left"><span class="style6"> 
                  <font <?php if ($f10color != '') { echo 'size="'.$f9size.'"'; } ?>><?php //echo $headerline1left; ?></font> </span></div>
            </div>
          <div align="center" class="style27">
            <div align="left"><span class="style6"> 
                <font <?php if ($f10color != '') { echo 'size="'.$fontsize2.'"'; } ?>><?php //echo $headerline2left; ?></font> </span></div>
          </div>
          <div align="center" class="style27">
            <div align="left"><span class="style6"> 
                <font <?php if ($f10color != '') { echo 'size="'.$fontsize2.'"'; } ?>><?php //echo $headerline3left; ?></font> </span></div>
          </div></td>
		  <td  width="26%" valign="top">
    <span class="style28"><b><?php //echo $quotationtitle; ?></b></div></span></td>
      </tr>
    </table>
	<?php
	}
	//end of letter head printing settings.	  
	?>
	
	</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style28"><div align="center"><b><br/><?php echo $quotationtitle; ?></b></div></span></td>
  </tr>
  <!--<tr>
    <td colspan="2"><div align="center"><span class="style5"><?php echo $quotationtitle; ?></span></div></td>
  </tr>-->
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="482"><span class="style6"><strong><?php echo $addressline1; ?></strong></span></td>
    <td width="200"><span class="style6">Quote No.: <?php echo $quotationnumberprefix; ?></span></td>
  </tr>
  <tr>
    <td><span class="style6"><strong><?php echo $customername; ?></strong></span></td>
    <td><span class="style6">Date : <?php echo $quotationdate; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><strong><?php echo $address; ?></strong></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><strong><?php echo $location; ?></strong></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><strong><?php echo $city; ?></strong></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<div align="center" class="style6">
        <table width="95%" border="0" cellspacing="0" cellpadding="0">
		  <?php
		  
		  for ($i=1;$i<=3;$i++)
		  {
			  if ($i==1 && $kindattn1string != '')
			  {
				$kindattnfinalstring = $kindattn1string;
			  }
			  else if ($i==2 && $kindattn2string != '')
			  {
				$kindattnfinalstring = $kindattn2string;
			  }
			  else if ($i==3 && $kindattn3string != '')
			  {
				$kindattnfinalstring = $kindattn3string;
			  }
			  
			  if ($kindattnfinalstring != '')
			  {
		  ?>
          <tr>
            <td width="18%"><strong>
            <div align="left"><?php echo $kindattntext.' &nbsp;'; ?></div></strong></td>
            <td width="82%"><strong><?php echo $kindattnfinalstring; ?></strong></td>
          </tr>
		  <?php
		  		}
				$kindattnfinalstring = '';
		  }
		  ?>
        </table>
      </div>		</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $deartext; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $subtext; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $reftext; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $quotationstarttext; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="sample">
      <tr>
        <td width="5%"><div align="left" class="style27">&nbsp;SNo.</div></td>
        <td width="64%"><div align="left" class="style27">&nbsp;Description&nbsp;</div></td>
		<?php
		if ($showcolumnunit == 'SHOW COLUMN UNIT')
		{
		?>
        <td width="5%"><div align="left" class="style27">&nbsp;Unit&nbsp;</div></td>
		<?php
		}
		?>
		<?php
		if ($showcolumnrate == 'SHOW COLUMN RATE')
		{
		?>
		<td width="8%"><div align="right"><span class="style27">&nbsp;Rate&nbsp;</span></div></td>
		<?php
		}
		?>
		<?php
		if ($showcolumnquantity == 'SHOW COLUMN QUANTITY')
		{
		?>
		<td width="10%"><div align="left" class="style27">&nbsp;Qty&nbsp;</div></td>
		<?php
		}
		?>
		<?php
		if ($showcolumndiscount == 'SHOW COLUMN DISCOUNT')
		{
		?>
		<td><div align="right" class="style27">&nbsp;Dsc%&nbsp;</div></td>
		<td><div align="right" class="style27">&nbsp;Dsc&nbsp;</div></td>
		<?php
		}
		?>
		<?php
		//echo $lumpsum;
		//if ($lumpsum == '0.00')
		//{
		?>
		<?php
		if ($showcolumntax == 'SHOW COLUMN TAX')
		{
		?>
        <td width="10%"><div align="right"><span class="style27">&nbsp;Tax%&nbsp;</span></div></td>
		<?php
		}
		?>
        <td width="8%"><div align="left" class="style27"><div align="right">&nbsp;Total&nbsp;</div></div></td>
		<?php
			//$columncount = 6;
		//}
		//else
		//{
			//$columncount = 4;
		//}
		?>
      </tr>
	  <?php
	  	$sno  = "";
	  	$query4 = "select * from quotation_details where quotationanum = '$qanum' and status <> 'DELETED'";
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
		//$description = $res8itemcode.' - '.$description;
		
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
		
		$additionaltext = $res4["additionaltext"];
		//if ($additionaltext != '') $description = $description.'<br>&nbsp;'.$additionaltext;
		if ($description != '') 
		{
			if ($additionaltext != '')
			{
				$description = $description.'<br>&nbsp;'.nl2br($additionaltext);
			}
			else
			{
				$description = $description;
			}
		}
		else
		{
			$description = $additionaltext;
		}
		$quantity = $res4["quantity"];
		$quantity = round($quantity, 0);
		$unit = $res4["unit_abbreviation"];
		$rate = $res4["rateperunit"];
		$total = $res4["totalamount"];
		$taxpercent = $res4["taxpercent"];
		$taxamount = $res4["taxamount"];

		
		$discountpercent = $res4["discountpercent"];
		$discountamount = $res4["discountamount"];
		if ($discountpercent != '0.00')
		{
			$discounttext = '<br>&nbsp;Discount Rs.'.$discountamount.' @ '.$discountpercent.'%';
		}
		else if ($discountamount != '0.00')
		{
			$discounttext = '<br>&nbsp;Discount Rs.'.$discountamount;
		}
	  ?>
      <tr>
        <td valign="top"><span class="style6">&nbsp;<?php echo $sno; ?>&nbsp;</span></td>
        <td valign="top" align="left"><span class="style6">&nbsp;<?php echo $description; ?>&nbsp;</span></td>
		<?php
		if ($showcolumnunit == 'SHOW COLUMN UNIT')
		{
		?>
		<td valign="top"><span class="style6">&nbsp;<?php echo $unit; ?>&nbsp;</span></td>
		<?php
		}
		?>
		<?php
		if ($showcolumnrate == 'SHOW COLUMN RATE')
		{
		?>
        <td valign="top"><span class="style6">&nbsp;<?php echo $rate; ?>&nbsp;</span></td>
		<?php
		}
		?>
		<?php
		if ($showcolumnquantity == 'SHOW COLUMN QUANTITY')
		{
		?>
		<td valign="top" align="right"><span class="style6">&nbsp;<?php echo $quantity; ?>&nbsp;</span></td>
		<?php
		}
		?>
		<?php
		if ($showcolumndiscount == 'SHOW COLUMN DISCOUNT')
		{
		?>
		<td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $discountpercent; ?>&nbsp;</span></div></td>
		<td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $discountamount; ?>&nbsp;</span></div></td>
		<?php
		}
		?>
		<?php
		$discounttext = '';
		//if ($lumpsum == '0.00')
		//{
		?>
		<?php
		if ($showcolumntax == 'SHOW COLUMN TAX')
		{
		?>
        <td valign="top"><div align="right"><span class="style6"><?php echo $taxpercent; ?>&nbsp;</span></div></td>
		<?php
		}
		?>
        <td valign="top"><div align="right"><span class="style6"><?php echo $total; ?>&nbsp;</span></div></td>
		<?php
		//}
		?>
      </tr>
	  <?php
	  	}
	  ?>
	  <tr>
	    <td valign="top" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">&nbsp;Sub Total   &nbsp;</span></div></td>
	    <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $subtotal; ?>&nbsp;</span></div></td>
	    </tr>
      <?php
	  	$query6 = "select *, sum(taxamount) as sumtaxamount from quotation_tax where quotation_autonumber = '$qanum' and status <> 'DELETED' group by taxpercent order by auto_number";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		while ($res6 = mysql_fetch_array($exec6))
		{
		$taxname = $res6["taxname"];
		$taxname = strtoupper($taxname);
		$taxpercent = $res6["taxpercent"];
		//$taxamount = $res6["taxamount"];
		$taxamount = $res6["sumtaxamount"];
	  ?>
	  <tr>
	    <td valign="top" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">&nbsp;<?php echo $taxname; //.' @ '.$taxpercent.'%'; ?>&nbsp;</span></div></td>
	    <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $taxamount; ?>&nbsp;</span></div></td>
	    </tr>
      <?php
	  	}
		
		if ($transportation != '0.00')
		{
	  ?>
	  <tr>
	    <td valign="top" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">&nbsp;<?php echo $f29; ?>&nbsp;</span></div></td>
	    <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $transportation; ?>&nbsp;</span></div></td>
	    </tr>
      <?php
	  	}
		
		if ($packaging != '0.00')
		{
	  ?>
	  <tr>
	    <td valign="top" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">&nbsp;<?php echo $f30; ?>&nbsp;</span></div></td>
	    <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $packaging; ?>&nbsp;</span></div></td>
	    </tr>
	  <?php
	  }
	  ?>
	  <tr>
	    <td valign="top" colspan="<?php echo $columncount; ?>"><div align="right"><span class="style27">Round Off   &nbsp;</span></div></td>
	    <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $roundoff; ?>&nbsp;</span></div></td>
	    </tr>
	  <tr>
	  <td valign="top" colspan="<?php echo $columncount; ?>"><span class="style27"><div align="right">&nbsp;Total Amount&nbsp;</div></span></td>
	  <td valign="top"><div align="right"><span class="style27">&nbsp;<?php echo $totalamount;?>&nbsp;</span></div></td>
	  </tr>
    </table>	
	
	
	
	</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <?php
	if ($lumpsum != '0.00')
	{
		include ('convert_currency_to_words.php');
		$convertedwords = covert_currency_to_words($lumpsum); //function call
		echo $lumpsumhtml1 = '<tr><td colspan="2"><span class="style6">Total Amount : '.$lumpsum.'/- ( '.$convertedwords.' )</span></td></tr>';
		//echo $lumpsumhtml2 = '<tr><td colspan="2"><span class="style6">( '.$convertedwords.' )</span></td></tr>';
		echo $lumpsumhtml2 = '<tr><td colspan="2"><span class="style6">&nbsp;</span></td></tr>';
	}
  $tcheaderhtml = '<tr><td colspan="2"><span class="style6">Terms &amp; Conditions:</span></td></tr>';
  for ($j=1;$j<=8;$j++)
  {
  	$tclinetext = $res3["tcline".$j];
	if ($tclinetext != '')
	{
	$jloopcount = $jloopcount + 1;
	echo $tcheaderhtml;
  ?>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $jloopcount.". ".$tclinetext; ?></span></td>
  </tr>
  <?php
	$tcheaderhtml = '';
  	}
  }
  ?>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $quotationendtext; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $footerline1; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $footerline2; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style8"><strong><?php echo $footerline3; ?></strong></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><strong><?php echo $footerline4; ?></strong></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $footerline5; ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6"><?php echo $footerline6; ?></span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style6">
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