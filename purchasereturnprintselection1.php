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
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function loadprintpage1()
{
	var varPaperSize = document.getElementById("papersize").value;
	if (varPaperSize == "40 Column Paper")
	{
		alert ("To Print In 40 Column Paper, Please Go To Sales Page & Use Bottom Right Corner Print Options");
	}

	var varBillNumber = document.getElementById("billnumber").value;
	if (varBillNumber == "")
	{
		alert ("Please Enter Bill Number.");
		return false;
	}
	
	var varPrintHeader = document.getElementById("printheader").value;
	var varTitleHeader = document.getElementById("titleheader").value;
	if (varPrintHeader == "")
	{
		alert ("Please Select Print Header.");
		return false;
	}
	if (varTitleHeader == "")
	{
		alert ("Please Select Copy Header.");
		return false;
	}
	if (varTitleHeader != 'ALL')
	{
		//alert (varBillNumber);
		//alert (varPrintHeader);
		//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
		if (varPaperSize == "A4 Sheet Paper")
		{
			window.open("print_bill1_purchasereturn1.php?printsource=printselectionpage&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber,"OriginalWindow<?php echo rand(); //$banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
		}
		if (varPaperSize == "A5 Sheet Paper")
		{
			window.open("print_bill1_purchasereturn1_a5.php?printsource=printselectionpage&&title1="+varTitleHeader+"&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber,"OriginalWindow<?php echo rand(); //$banum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
		}
	}
	else
	{
		alert ('Printing All Copies');
		<?php
		$query11 = "select * from master_billtitleheader where status <> 'deleted' order by billtitleheader ";
		$exec11 = mysql_query($query11) or die ("Error in Query11".mysql_error());
		while ($res11 = mysql_fetch_array($exec11))
		{
		$billtitleheader11 = $res11['billtitleheader'];
		$masanum11 = $res11['auto_number'];
		?>
		if (varPaperSize == "A4 Sheet Paper")
		{
			window.open("print_bill1_purchasereturn1.php?printsource=printselectionpage&&title1=<?php echo $billtitleheader11; ?>&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber,"OriginalWindow<?php echo $masanum11; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
		}
		if (varPaperSize == "A5 Sheet Paper")
		{
			window.open("print_bill1_purchasereturn1_a5.php?printsource=printselectionpage&&title1=<?php echo $billtitleheader11; ?>&&copy1="+varPrintHeader+"&&billnumber="+varBillNumber,"OriginalWindow<?php echo $masanum11; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
		}
		<?php
		}
		?>
		return false;
	}
}

</script>
<body>
<table width="1024" border="0" cellspacing="0" cellpadding="2">
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
    <td width="97%" valign="top"><table width="116%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		<table width="896" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Return Print - Enter Bill Number </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              </tr>
            <tr>
              <td colspan="7" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
            </tr>
            <tr>
                <td width="17%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Purchase Return Number </td>
                <td width="83%" colspan="2" align="left" valign="top"  bgcolor="#FFFFFF">
				<input value="<?php //echo $billnumber; ?>" name="billnumber" type="text" id="billnumber" size="10" style="border: 1px solid #001E6A">
				<select name="printheader" id="printheader">
				<option value="">Print Header</option>
				<?php
				//$query1 = "select * from master_purchasereturnprintheader where status <> 'deleted' order by billprintheader ";
				$query1 = "select * from master_titlename where modulename = 'purchasereturn' and status <> 'deleted' order by titlename ";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$billprintheader = $res1['titlename'];
				$masanum1 = $res1['auto_number'];
				?>
				<option value="<?php echo $billprintheader; ?>"><?php echo $billprintheader; ?></option>
				<?php
				}
				?>
				</select>
				<select name="titleheader" id="titleheader">
				<option value="">Copy Header</option>
				<option value="ALL">ALL</option>
				<?php
				$query1 = "select * from master_billtitleheader where status <> 'deleted' order by billtitleheader ";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$billtitleheader = $res1['billtitleheader'];
				$masanum1 = $res1['auto_number'];
				?>
				<option value="<?php echo $billtitleheader; ?>"><?php echo $billtitleheader; ?></option>
				<?php
				}
				?>
				</select>
				<select name="papersize" id="papersize">
				<?php
				$selected = "";
				$query1 = "select * from master_printer where status <> 'deleted' order by papersize ";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				while ($res1 = mysql_fetch_array($exec1))
				{
				$papersize = $res1['papersize'];
				$masanum1 = $res1['auto_number'];
				$defaultstatus = $res1['defaultstatus'];
				if ($defaultstatus == 'default') $selected = 'selected="selected"';
				?>
				<option value="<?php echo $papersize; ?>" <?php echo $selected; ?>><?php echo $papersize; ?></option>
				<?php
				$defaultstatus = '';
				$selected = '';
				}
				?>
				</select>
				<input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
                <input onClick="return loadprintpage1()" style="border: 1px solid #001E6A" type="button" value="Print Bill Now" name="billprintbutton" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
          </tbody>
        </table>

		
		
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

