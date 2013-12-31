<?php
session_start();
include ("db/db_connect.php");
$errmsg = '';

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST[st];
if ($st == 'browserfailed')
{
	$errmsg = "This is not Microsoft Internet Explorer. (MSIE).";
}
else if ($st == 'versionfailed')
{
	$errmsg = "Version Is Less Than 6.";
}


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
</head>
<body>
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top">
		  	  	<form id="form1" name="form1" method="post" action="login1.php" onSubmit="return process1login1()">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
        <tr>
          <td><table width="70%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
              <tbody>
                <tr>
                  <td colspan="2" align="left" valign="top"  
				  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FF9900'; } ?>" class="bodytext3">&nbsp;</td>
                </tr>
                <tr>
                  <td width="9%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                  <td width="91%" align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3"><strong>Sorry. This software will run only in Google Chrome / Mozilla Firefox / Microsoft Internet Explorer. </strong></span></td>
                </tr>
                <tr>
                  <td width="9%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                  <td width="91%" align="left" valign="top"  bgcolor="#FFFFFF">
				  <span class="bodytext3"><?php echo $errmsg; ?></span></td>
                </tr>
                <tr>
                  <td align="middle" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="middle" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</form>
    
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>