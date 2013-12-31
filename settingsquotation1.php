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
$custid = '';
$custname = '';
$errmsg = '';
$bgcolorcode = '';

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st==3)
{
	$errmsg1="Add Settings To Quotation And Save";
}

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_POST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{

	$companytitle = $_REQUEST['companytitle'];
	$companytitle = strtoupper($companytitle);
	$companytitle = trim($companytitle);
	$headerline1left  = $_REQUEST['headerline1left'];
	$headerline2left  = $_REQUEST['headerline2left'];
	$headerline3left  = $_REQUEST['headerline3left'];
	$headerline1right = '';
	$headerline2right = '';
	$headerline3right  = '';
	$quotationtitle = $_REQUEST['quotationtitle'];
	$quotationnumberprefix = $_REQUEST['quotationnumberprefix'];
	$quotationnumber  = '';
	$customernameprefix1  = $_REQUEST['customernameprefix1'];
	$addressline1 = '';
	$kindattntext = $_REQUEST['kindattntext'];
	$deartext  = $_REQUEST['deartext'];
	$subtext = $_REQUEST['subtext'];
	$reftext = $_REQUEST['reftext'];
	$quotationstarttext  = $_REQUEST['quotationstarttext'];
	$tcline1 = $_REQUEST['tcline1'];
	$tcline2 = $_REQUEST['tcline2'];
	$tcline3 = $_REQUEST['tcline3'];
	$tcline4 = $_REQUEST['tcline4'];
	$tcline5 = $_REQUEST['tcline5'];
	$tcline6 = $_REQUEST['tcline6'];
	$tcline7 = $_REQUEST['tcline7'];
	$tcline8 = $_REQUEST['tcline8'];
	$quotationendtext = $_REQUEST['quotationendtext'];
	$footerline1 = $_REQUEST['footerline1'];
	$footerline2 = $_REQUEST['footerline2'];
	$footerline3 = $_REQUEST['footerline3'];
	$footerline4 = $_REQUEST['footerline4'];
	$footerline5 = $_REQUEST['footerline5'];
	$footerline6 = $_REQUEST['footerline6'];
	
	$fontsize1 = $_REQUEST['fontsize1'];
	$fontsize2 = $_REQUEST['fontsize2'];
	$fontsize3 = $_REQUEST['fontsize3'];
	$fontsize4 = '';
	
	$dateposted = $updatedatetime;
	
	$dateposted = $updatedatetime;
	$query3 = "select auto_number from settings_quotation where companyanum ='$companyanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$rowcount3 = mysql_num_rows($exec3);
	if ($rowcount3 != 0)
	{
		$query1 = "update settings_quotation set companytitle = '$companytitle', 
		headerline1left = '$headerline1left', headerline2left = '$headerline2left', 
		headerline3left = '$headerline3left', headerline1right = '$headerline1right', 
		headerline2right = '$headerline2right', headerline3right = '$headerline3right', 
		quotationtitle = '$quotationtitle', quotationnumberprefix = '$quotationnumberprefix', 
		quotationnumber = '$quotationnumber', customernameprefix1 = '$customernameprefix1', 
		addressline1 = '$addressline1', 
		kindattntext = '$kindattntext', deartext = '$deartext', 
		subtext = '$subtext', reftext = '$reftext', quotationstarttext = '$quotationstarttext', 
		tcline1 = '$tcline1', tcline2 = '$tcline2', tcline3 = '$tcline3', 
		tcline4 = '$tcline4', tcline5 = '$tcline5', tcline6 = '$tcline6', 
		tcline7 = '$tcline7', tcline8 = '$tcline8', quotationendtext = '$quotationendtext', 
		footerline1 = '$footerline1', footerline2 = '$footerline2', footerline3 = '$footerline3', 
		footerline4 = '$footerline4', footerline5 = '$footerline5', 
		footerline6 = '$footerline6', 
		fontsize1 = '$fontsize1', fontsize2 = '$fontsize2', fontsize3 = '$fontsize3', fontsize4 = '$fontsize4', 
		ipaddress = '$ipaddress', updatedate = '$dateposted' where companyanum = '$companyanum'";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$errmsg="Quotation Settings Updated";
		$bgcolorcode="success";
	}
	else
	{
		$query1 = "insert into settings_quotation(companytitle, headerline1left, headerline2left, 
		headerline3left, headerline1right, headerline2right, headerline3right, 
		quotationtitle, quotationnumberprefix, quotationnumber, customernameprefix1, 
		addressline1, kindattntext, deartext, subtext, reftext, quotationstarttext, 
		tcline1, tcline2, tcline3, tcline4, tcline5, tcline6, 
		tcline7, tcline8, quotationendtext, footerline1, footerline2, footerline3, 
		footerline4, footerline5, footerline6, fontsize1, fontsize2, fontsize3, fontsize4, 
		ipaddress, updatedate, companyanum, companyname,cstid,cstname) 
		values ('$companytitle', '$headerline1left','$headerline2left', '$headerline3left','$headerline1right', 
		'$headerline2right','$headerline3right', '$quotationtitle','$quotationnumberprefix', 
		'$quotationnumber','$customernameprefix1', '$addressline1', '$kindattntext','$deartext', 
		'$subtext','$reftext','$quotationstarttext', '$tcline1','$tcline2','$tcline3', 
		'$tcline4','$tcline5','$tcline6', '$tcline7','$tcline8','$quotationendtext', 
		'$footerline1','$footerline2','$footerline3', '$footerline4','$footerline5', 
		'$footerline6', '$fontsize1','$fontsize2','$fontsize3','$fontsize4', 
		'$ipaddress','$dateposted', '$companyanum', '$companyname','$custid','$custname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$errmsg="Quotation Settings Added";
		$bgcolorcode="success";
	}
			

}


	$query2 = "select * from settings_quotation where companyanum = '$companyanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	
	$companytitle = $res2['companytitle'];
	$companytitle = strtoupper($companytitle);
	$companytitle = trim($companytitle);
	$headerline1left  = $res2['headerline1left'];
	$headerline2left  = $res2['headerline2left'];
	$headerline3left  = $res2['headerline3left'];
	$headerline1right = $res2['headerline1right'];
	$headerline2right = $res2['headerline2right'];
	$headerline3right  = $res2['headerline3right'];
	$quotationtitle = $res2['quotationtitle'];
	$quotationtitle = strtoupper($quotationtitle);
	$quotationtitle = trim($quotationtitle);
	$quotationnumberprefix = $res2['quotationnumberprefix'];
	$quotationnumberprefix = strtoupper($quotationnumberprefix);
	$quotationnumberprefix = trim($quotationnumberprefix);
	$quotationnumber  = $res2['quotationnumber'];
	$addressline1 = $res2['addressline1'];
	$kindattntext = $res2['kindattntext'];
	$deartext  = $res2['deartext'];
	$subtext = $res2['subtext'];
	$reftext = $res2['reftext'];
	$quotationstarttext  = $res2['quotationstarttext'];
	$tcline1 = $res2['tcline1'];
	$tcline2 = $res2['tcline2'];
	$tcline3 = $res2['tcline3'];
	$tcline4 = $res2['tcline4'];
	$tcline5 = $res2['tcline5'];
	$tcline6 = $res2['tcline6'];
	$tcline7 = $res2['tcline7'];
	$tcline8 = $res2['tcline8'];
	$quotationendtext = $res2['quotationendtext'];
	$footerline1 = $res2['footerline1'];
	$footerline2 = $res2['footerline2'];
	$footerline3 = $res2['footerline3'];
	$footerline4 = $res2['footerline4'];
	$footerline5 = $res2['footerline5'];
	$footerline6 = $res2['footerline6'];
	
	$fontsize1 = $res2['fontsize1'];
	$fontsize2 = $res2['fontsize2'];
	$fontsize3 = $res2['fontsize3'];
	$fontsize4 = $res2['fontsize4'];
	
	if ($fontsize1 == '') $fontsize1 = '5';
	if ($fontsize2 == '') $fontsize2 = '3';
	if ($fontsize3 == '') $fontsize3 = '3';
	if ($fontsize4 == '') $fontsize4 = '3';
	
	$customernameprefix1 = $res2['customernameprefix1'];
	$kindattntext2 = $res2['kindattntext'];
	
	$dateposted = $res2['updatedate'];



if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
//echo $st;
if ($st == '1')
{
	$errmsg = "Success. Quotation Settings Updated.";
	$bgcolorcode = 'success';
}

if ($st == '2')
{
	$errmsg = "Failed. Quotation Settings Not Updated.";
	$bgcolorcode = 'failed';
}

if ($st == '3')
{
	$query10 = "select * from master_company where auto_number='$companyanum'";
	$exec10 = mysql_query($query10) or die("error in Query10".mysql_error());
	$res10 = mysql_fetch_array($exec10);
	$companytitle = $res10['companyname'];
	$headerline1left = $res10['address1'];
	$headerline2 = $res10['city'];
	$headerline3 = strtoupper($res10['state']);
	$headerline2left = $headerline2.'.'.$headerline3;
	$phonenumbernew = $res10['phonenumber1'];
	$phonenumbernew2 = $res10['phonenumber2'];

	if($phonenumbernew != '' and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew.' / '.$phonenumbernew2;
	}
	elseif($phonenumbernew != '' and $phonenumbernew2 == '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew;
	}
	elseif($phonenumbernew == ' 'and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew2;
	}
	
	$quotationtitle = "QUOTATION";
	$quotationnumberprefix = "QT";
	$kindattntext2 = "KIND ATTN";
	$tcline1 = "Price is valid for only 30 days from the date of quotation.";
	$tcline2 = "Applicable taxes as per govt rules will extra.";
	$tcline3 = "Orders will be confirmed based on your purchase order.";
	$tcline4 = "Terms & Conditions subject to change without notice.";
	$tcline5 = "Items are subject to availability.";
	$tcline6 = "";
	$quotationendtext = "We hope our quote will be suitable for your requirement. Kindly consider our proposal.";
	$footerline3 = "For".' '.$companytitle;
	$footerline4 = "Authorized Signatory";
	$quotationstarttext = "We are pleased to give our best rates";
	$reftext = "With ref to our telephone conversation today.";
	$deartext = "Dear Sir / Madam";
	$subtext = "Rate for your requirement";
}

/*
if ($st == '4')
{
	$query10 = "select * from master_company where auto_number='$companyanum'";
	$exec10 = mysql_query($query10) or die("error in Query10".mysql_error());
	$res10 = mysql_fetch_array($exec10);
	$companytitle = $res10['companyname'];
	$headerline1left = $res10['address'];
	$headerline2 = $res10['city'];
	$headerline3 = strtoupper($res10['state']);
	$headerline2left = $headerline2.'.'.$headerline3;
	$phonenumbernew = $res10['phonenumber1'];
	$phonenumbernew2 = $res10['phonenumber2'];
	
	if($phonenumbernew != '' and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew.' / '.$phonenumbernew2;
	}
	elseif($phonenumbernew != '' and $phonenumbernew2 == '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew;
	}
	elseif($phonenumbernew == '' and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew2;
	}
	
	$quotationtitle = "QUOTATION";
	$quotationnumberprefix = "QT";
	$kindattntext2 = "KIND ATTN";
	$tcline1 = "Price is valid for only 30 days from the date of quotation.";
	$tcline2 = "Applicable taxes as per govt rules will extra.";
	$tcline3 = "Orders will be confirmed based on your purchase order.";
	$tcline4 = "Terms & Conditions subject to change without notice.";
	$tcline5 = "Items are subject to availability.";
	$tcline6 = "";
	$quotationendtext = "We hope our quote will be suitable for your requirement. Kindly consider our proposal.";
	$footerline3 = "For".' '.$companytitle;
	$footerline4 = "Authorized Signatory";
	$quotationstarttext = "We are pleased to give our best rates";
	$reftext = "With ref to our telephone conversation today.";
	$deartext = "Dear Sir / Madam";
	$subtext = "Rate for your requirement";
}
*/

/*
if ($dateposted == '')
{
	$query10 = "select * from master_company where auto_number='$companyanum'";
	$exec10 = mysql_query($query10) or die("error in Query10".mysql_error());
	$res10 = mysql_fetch_array($exec10);
	$companytitle = $res10['companyname'];
	$headerline1left = $res10['address1'];
	$headerline2 = $res10['city'];
	$headerline3 = strtoupper($res10['state']);
	$headerline2left = $headerline2.'.'.$headerline3;
	$phonenumbernew = $res10['phonenumber1'];
	$phonenumbernew2 = $res10['phonenumber2'];
	
	if($phonenumbernew != '' and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew.' / '.$phonenumbernew2;
	}
	elseif($phonenumbernew != '' and $phonenumbernew2 == '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew;
	}
	elseif($phonenumbernew == '' and $phonenumbernew2 != '')
	{
		$headerline3left = 'PHONE: '.$phonenumbernew2;
	}
	
	$quotationtitle = "QUOTATION";
	$quotationnumberprefix = "QT";
	$kindattntext2 = "KIND ATTN";
	$tcline1 = "Price is valid for only 30 days from the date of quotation.";
	$tcline2 = "Applicable taxes as per govt rules will extra.";
	$tcline3 = "Orders will be confirmed based on your purchase order.";
	$tcline4 = "Terms & Conditions subject to change without notice.";
	$tcline5 = "Items are subject to availability.";
	$tcline6 = "";
	$quotationendtext = "We hope our quote will be suitable for your requirement. Kindly consider our proposal.";
	$footerline3 = "For".' '.$companytitle;
	$footerline4 = "Authorized Signatory";
	$quotationstarttext = "We are pleased to give our best rates";
	$reftext = "With ref to our telephone conversation today.";
	$deartext = "Dear Sir / Madam";
	$subtext = "Rate for your requirement";
}

*/

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
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function process1backkeypress1()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
}

</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function from1submit1()
{

	if (document.form1.companytitle.value == "")
	{
		alert ("Company Title Cannot Be Empty.");
		document.form1.companytitle.focus();
		return false;
	}
	else if (document.form1.quotationtitle.value == "")
	{
		alert ("Quotation Title Cannot Be Empty.");
		document.form1.quotationtitle.focus();
		return false;
	}
	else if (document.form1.quotationnumberprefix.value == "")
	{
		alert ("Quotation Prefix Cannot Be Empty.");
		document.form1.quotationnumberprefix.focus();
		return false;
	}
	else if (document.form1.footerline3.value == "")
	{
		alert ("Footer Line 3 Cannot Be Empty.");
		document.form1.footerline3.focus();
		return false;
	}
	else if (document.form1.footerline4.value == "")
	{
		window.alert ("Footer Line 4 Cannot Be Empty.");
		document.form1.footerline4.focus();
		return false;
	}
}

</script>
<body>
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" action="settingsquotation1.php" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="900" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Settings - Quotation </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
			 <?php if ($st==3)
			 {?>
			  <tr>
                <td colspan="8" align="left" valign="middle"  bgcolor="#00FF00" class="bodytext3">Add Quotation Settings And Save</td>
              </tr> <?php } 
			  else
			  {?>
              <tr>
                <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg; ?>&nbsp;</td>
              </tr><?php }?>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
              <tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Company Title * </td>
                <td width="29%" align="left" valign="middle" >
				<input name="companytitle" id="companytitle" value="<?php echo $companytitle; ?>" style="border: 1px solid #001E6A" size="40">
				<span class="bodytext3"><!--F1--></span></td>
                <td width="13%" align="left" valign="middle" >&nbsp;</td>
                <td width="39%" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Header Line 1 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="headerline1left" id="headerline1left" value="<?php echo $headerline1left; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Header Line 2 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="headerline2left" id="headerline2left" value="<?php echo $headerline2left; ?>" style="border: 1px solid #001E6A" size="100" />
				<span class="bodytext3"><!--F2--></span> </td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Header Line 3 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="headerline3left" id="headerline3left" value="<?php echo $headerline3left; ?>" style="border: 1px solid #001E6A"  size="100"></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Quotation Title * </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="quotationtitle" id="quotationtitle" value="<?php echo $quotationtitle; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
             <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Quotation Number Prefix*</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="quotationnumberprefix" id="quotationnumberprefix" value="<?php echo $quotationnumberprefix; ?>" style="border: 1px solid #001E6A"  size="40" />				<span class="bodytext3">(Example : ABC00024) (Where ABC is the number prefix.) </span></td>
                </tr>
<!--               <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Quotation Number</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="quotationnumber" id="quotationnumber" value="<?php echo $quotationnumber; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Address Line 1  </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="addressline1" id="addressline1" value="<?php echo $addressline1; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
-->
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Customer Name Prefix </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="customernameprefix1" id="customernameprefix1" value="<?php echo $customernameprefix1; ?>" style="border: 1px solid #001E6A"  size="40" />				<span class="bodytext3">(Example : M/s.) (Leave blank if no prefix applicable.) </span></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Kind Attn Text </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="kindattntext" id="kindattntext" value="<?php echo $kindattntext2; ?>" style="border: 1px solid #001E6A"  size="40" />
				<font class="bodytext3">(Example: KIND ATTN)</font></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Dear</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="deartext" id="deartext" value="<?php echo $deartext;?>" style="border: 1px solid #001E6A"  size="40" />
				<font class="bodytext3">(Example: Dear Sir / Madam)</font></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Sub: </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="subtext" id="subtext" value="<?php echo $subtext;?>" style="border: 1px solid #001E6A"  size="100" />
				<font class="bodytext3"><br>(Example: Rate For Your Requirement)</font></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Ref:</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="reftext" id="reftext" value="<?php echo $reftext;?>" style="border: 1px solid #001E6A"  size="100" />
				<font class="bodytext3"><br>(Example: With ref to our telephone conversation today.)</font></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Quotation Start Text </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="quotationstarttext" id="quotationstarttext" value="<?php echo $quotationstarttext;?>" style="border: 1px solid #001E6A"  size="100" />
				<font class="bodytext3"><br>(Example: We are pleased to give our best rates)</font></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Terms &amp; Conditions </td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 1 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline1" cols="75" id="tcline1" style="border: 1px solid #001E6A"><?php echo $tcline1; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 2 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline2" cols="75" id="tcline2" style="border: 1px solid #001E6A"><?php echo $tcline2; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 3 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline3" cols="75" id="tcline3" style="border: 1px solid #001E6A"><?php echo $tcline3; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 4 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline4" cols="75" id="tcline4" style="border: 1px solid #001E6A"><?php echo $tcline4; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 5 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline5" cols="75" id="tcline5" style="border: 1px solid #001E6A"><?php echo $tcline5; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 6 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline6" cols="75" id="tcline6" style="border: 1px solid #001E6A"><?php echo $tcline6; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 7 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline7" cols="75" id="tcline7" style="border: 1px solid #001E6A"><?php echo $tcline7; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Line 8 </td>
                <td colspan="3" align="left" valign="middle" >
				  <textarea name="tcline8" cols="75" id="tcline8" style="border: 1px solid #001E6A"><?php echo $tcline8; ?></textarea></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Quotation End Text </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="quotationendtext" id="quotationendtext" value="<?php echo $quotationendtext; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 1 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline1" id="footerline1" value="<?php echo $footerline1; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 2 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline2" id="footerline2" value="<?php echo $footerline2; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 3 * </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline3" id="footerline3" value="<?php echo $footerline3; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 4 * </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline4" id="footerline4" value="<?php echo $footerline4; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 5 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline5" id="footerline5" value="<?php echo $footerline5; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Footer Line 6 </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="footerline6" id="footerline6" value="<?php echo $footerline6; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Font Size F1 </td>
                <td colspan="3" align="left" valign="middle" ><select name="fontsize1" id="fontsize1" >
                    <?php
 			 		 echo '<option value="'.$fontsize1.'" selected="selected">'.$fontsize1.'</option>';
				  for ($fsi=1;$fsi<=25;$fsi++)
				  {
				   ?>
                    <option value="<?php echo $fsi; ?>"><?php echo $fsi; ?></option>
                    <?php
					}
					?>
                  </select>
                    <span class="bodytext3">(Company Title) (Standard Size -6) </span></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Font Size F2 </td>
                <td colspan="3" align="left" valign="middle" ><select name="fontsize2" id="fontsize2" >
                    <?php
 			 		 echo '<option value="'.$fontsize2.'" selected="selected">'.$fontsize2.'</option>';
				  for ($fsi=1;$fsi<=25;$fsi++)
				  {
				   ?>
                    <option value="<?php echo $fsi; ?>"><?php echo $fsi; ?></option>
                    <?php
					}
					?>
                  </select>
                    <span class="bodytext3">(Header Lines) </span><span class="bodytext3"> (Standard Size - 6)</span> </td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Font Size F3 </td>
                <td colspan="3" align="left" valign="middle" ><select name="fontsize3" id="fontsize3" >
                    <?php
 			 		 echo '<option value="'.$fontsize3.'" selected="selected">'.$fontsize3.'</option>';
				  for ($fsi=1;$fsi<=25;$fsi++)
				  {
				   ?>
                    <option value="<?php echo $fsi; ?>"><?php echo $fsi; ?></option>
                    <?php
					}
					?>
                  </select>
                    <span class="bodytext3">(Bill Title) </span> <span class="bodytext3"> (Standard Size - 6)</span></td>
                </tr>
<!--              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Font Size F4 </td>
                <td colspan="3" align="left" valign="middle" ><select name="fontsize4" id="fontsize4" >
                    <?php
 			 		 echo '<option value="'.$fontsize4.'" selected="selected">'.$fontsize4.'</option>';
				  for ($fsi=1;$fsi<=12;$fsi++)
				  {
				   ?>
                    <option value="<?php echo $fsi; ?>"><?php echo $fsi; ?></option>
                    <?php
					}
					?>
                  </select>
                    <span class="bodytext3">(Body of Bill &amp; Tabular Columns) </span> <span class="bodytext3"> (Standard Size - 14)</span></td>
                </tr>
-->              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Date Last Updated </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="dateposted" id="dateposted" value="<?php echo $dateposted; ?>" onKeyDown="return process1backkeypress1()" style="background:#CCCCCC"  size="20"  readonly="readonly" />                </td>
                </tr>

              <tr>
                <td align="middle" colspan="4" >&nbsp;</td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="95%" 
            align="left" border="1">
            <tbody>
              <tr>
                <td width="3%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="30%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                <td width="41%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31"><div align="right"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="hidden" name="frmflag1" value="frmflag1" />
                    <input name="Submit222" type="submit"  value="Save Quotation Settings" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
                </tr>
            </tbody>
          </table></td>
        </tr>
    </table>
	</form>
<script language="javascript">


</script>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

