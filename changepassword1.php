<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$errmsg = '';
$bgcolorcode = '';
//$sessionusername = $_REQUEST['sessionusername'];

date_default_timezone_set('Asia/Calcutta'); 
$todaydate = date('Y-m-d');

if (isset($_REQUEST["change"])) { $change = $_REQUEST["change"]; } else { $change = ""; }
//$change = $_POST['change'];
if ($change == 'changepassword')
{
	//$username=$_SESSION['username'];
	$currentpassword=$_POST['currentpassword'];
	$newpassword=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];
	if($newpassword!=$confirmpassword)
	{
		$errmsg="Password Does Not Match";
	}
	else
	{
		$query1 = "select * from master_employee where password = '$currentpassword' and username = '$username'";
		$exec1 = mysql_query($query1)or die("error in query".mysql_error());
		$row = mysql_num_rows($exec1);
		if($row == 1)
		{
			$query2 = "update master_employee set password = '$newpassword' where username = '$username'";
			$exec2 = mysql_query($query2)or die("error in query2".mysql_error());
			$errmsg = "Password Update Completed";
			$bgcolorcode = 'success';
		}
		else
		{
			$errmsg = "Password Update Failed";
			$bgcolorcode = 'failed';
		}
	}
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
.style4 {color: #000000}
.style6 {
	color: #3B3B3C;
	font-size: 11px;
	font-family: Tahoma;
}
-->
</style>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/DatePicker.js.js"></script>
<script type="text/javascript" src="js/adddate.js"></script>
<script language="javascript" src="js/validation1.js"></script>
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.style4 {color: #000000}
.style6 {	color: #3B3B3C;
	font-size: 11px;
	font-family: Tahoma;
}
-->
</style>
</head>
<script language="javascript">

function process1()
{
	//alert ("Inside Funtion");
	if (document.form1.currentpassword.value == "")
	{
		alert ("Please Enter Current Password.");
		document.form1.currentpassword.focus();
		return false;
	}
	if (document.form1.newpassword.value == "")
	{
		alert ("Please Enter Current Password.");
		document.form1.currentpassword.focus();
		return false;
	}
	if (document.form1.confirmpassword.value == "")
	{
		alert ("Please Enter Current Password.");
		document.form1.currentpassword.focus();
		return false;
	}
	if (document.form1.confirmpassword.value != document.form1.newpassword.value)
	{
		alert ("New Password And Current Password Should Be Same.");
		document.form1.currentpassword.focus();
		return false;
	}
}

</script>
<body>
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr><tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
<form id="form1" name="form1" method="post" action="changepassword1.php" onSubmit="return process1()">
	<table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Change Password</strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top"  
		  bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3">&nbsp;<?php echo $errmsg; ?></td>
        </tr>
        <tr>
          <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">Current Password </td>
          <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="currentpassword" type="password" id="currentpassword" style="border: 1px solid #001E6A" size="20" /></td>
        </tr>
        <tr>
          <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">New Password</td>
          <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="newpassword"  type="password"id="newpassword" style="border: 1px solid #001E6A" size="20" /></td>
        </tr>
        <tr>
          <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">Confirm Password</td>
          <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="confirmpassword"  type="password"id="confirmpassword" style="border: 1px solid #001E6A" size="20" /></td>
        </tr>
        <tr>
          <td width="37%" align="middle" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
          <td valign="top"  bgcolor="#FFFFFF"><div align="left">
              <input type="hidden" value="changepassword" name="change" />
              <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />
          </div></td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>
	
	
	</td>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">&nbsp;</td>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

