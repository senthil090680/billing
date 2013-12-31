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
	var varQuotationNumber = document.getElementById("quotationnumber").value;
	if (varQuotationNumber == "")
	{
		alert ("Please Enter Quotation Number.");
		return false;
	}
	
	//alert ('Printing all copies');
	window.open("print_quotation1.php?printsource=printselectionpage&&title1=<?php //echo $quotationtitleheader11; ?>&&qnum="+varQuotationNumber,"OriginalWindow<?php //echo $masanum11; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	return false;
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
        <td width="860">
		
		<table width="650" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Quotation Print - Enter Quotation Number </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php //echo $errmgs; ?>&nbsp;</td>-->
              </tr>
            <tr>
              <td colspan="7" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
            </tr>
            <tr>
                <td width="21%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Enter Quotation Number </td>
                <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF">
				<input value="<?php //echo $quotationnumber; ?>" name="quotationnumber" type="text" id="quotationnumber" size="10" style="border: 1px solid #001E6A">
				<input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
                <input onClick="return loadprintpage1()" style="border: 1px solid #001E6A" type="button" value="Print Quotation Now" name="quotationprintbutton" /></td>
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

