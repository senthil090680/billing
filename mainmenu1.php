<?php
session_start();
//echo session_id();
include ("db/db_connect.php");
include ("includes/loginverify.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username=$_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];


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

function process1login1()
{
	if (document.form1.username.value == "")
	{
		alert ("Pleae Enter Your Login.");
		document.form1.username.focus();
		return false;
	}
	else if (document.form1.password.value == "")
	{	
		alert ("Pleae Enter Your Password.");
		document.form1.password.focus();
		return false;
	}
}

</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style2 {font-size: 36px}
-->
</style>
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
    <td colspan="10" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="1%" valign="top">&nbsp;</td>
    <td width="98%" valign="top">


<!--
      <table width="101%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
		  <table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="additem1.php"><font color="#2A3F55"><strong>Main Menu - Masters </strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="sales1.php?mms=sales"><font color="#2A3F55"><strong>Main Menu - Sales </strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="collectionentry1.php"><font color="#2A3F55"><strong>Main Menu -Transaction </strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="collectionpending1.php"><font color="#2A3F55"><strong>Main Menu - Report </strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="settingsbill1.php"><font color="#2A3F55"><strong>Main Menu -Settings</strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="57%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td width="100%" bgcolor="#CCCCCC" class="bodytext3"><a href="logout1.php"><font color="#2A3F55"><strong>Main Menu -Logout </strong></font></a></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
-->	  
	  
	  
	  
&nbsp;	  
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">  
	<div align="center">
	<strong>
	<br>
	<br>	
	<span class="style2">
	<?php
	$query2showlogo = "select * from settings_bill where companyanum = '$companyanum'";
	$exec2showlogo = mysql_query($query2showlogo) or die ("Error in Query2showlogo".mysql_error());
	$res2showlogo = mysql_fetch_array($exec2showlogo);
	$showlogo = $res2showlogo['showlogo'];
	if ($showlogo == 'SHOW LOGO')
	{
		?>	
		<img src="logofiles/<?php echo $companyanum;?>.jpg" width="300" height="300" />
		<?php
	}
	else
	{
		echo '<br>';
		echo '<br>';
		echo $_SESSION['companyname']; 
		echo '<br>';
		echo '<br>';
		echo '<br>';
	}
	?>
	</span>
	<br>
	<br>
	<?php 
	echo 'SIMACLE BILLING SOFTWARE 8.0'; 
	?>
	</strong>
	</div>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">  
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

