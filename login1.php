<?php
session_start();
session_destroy();
session_start();
session_regenerate_id();
$sessionid = session_id();
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$todaydate = date('Y-m-d');

//Variable Declaration
$errmsg = '';
$totalclosingcash = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = isset($_POST["frmflag1"]);
if ($frmflag1 == 'frmflag1')
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	//$query1 = "select * from master_usercreation where username = '$username' and password = '$password'";
	$query1 = "select * from master_employee where username = '$username' and password = '$password' and status = 'ACTIVE'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$rowcount1 = mysql_num_rows($exec1);
	if ($rowcount1 == 0)
	{
		header ("location:login1.php?st=1");
	}
	else
	{
		$res1 = mysql_fetch_array($exec1);
		$_SESSION["username"] = $username;
		$_SESSION["logintime"] = $updatedatetime;	 
		
		$query2 = "insert into details_login (username, logintime, openingcash, 
		lastupdate, lastupdateipaddress, lastupdateusername, sessionid) 
		value ('$username', '$updatedatetime', '$totalclosingcash', 
		'$updatedatetime', '$ipaddress', '$username', '$sessionid')";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		
		$query4 = "delete from login_restriction where username = '$username'";
		$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		
		$query3 = "insert into login_restriction (username, logintime, 
		lastupdate, lastupdateipaddress, lastupdateusername, sessionid) 
		value ('$username', '$updatedatetime', 
		'$updatedatetime', '$ipaddress', '$username', '$sessionid')";
		$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
		
		$query1 = "select count(auto_number) as countanum from login_restriction";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$res1 = mysql_fetch_array($exec1);
		$logincount = $res1["countanum"];
		
		$query2 = "select * from master_edition where status = 'ACTIVE'";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_fetch_array($exec2);
		$res2usercount = $res2["users"];
		
		/*if ($logincount > $res2usercount)
		{
			//echo 'inside if';
			header ("location:login1restricted1.php");
			exit;
		}*/
		
		
		//header ("location:mainmenu1.php?st=1");
		header ("location:setactivecompany1.php");
	}

}


if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = isset($_REQUEST["st"]);
if ($st == 1)
{
	$errmsg = "Login Failed. Please Try Again With Proper User Id and Password.";
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
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script language="javascript">

// to check browser compatibility.

var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var browserName  = navigator.appName;
var fullVersion  = ''+parseFloat(navigator.appVersion); 
var majorVersion = parseInt(navigator.appVersion,10);
var nameOffset,verOffset,ix;

// In MSIE, the true version is after "MSIE" in userAgent
if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
 browserName = "Microsoft Internet Explorer";
 fullVersion = nAgt.substring(verOffset+5);
}
// In Opera, the true version is after "Opera" 
else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
 browserName = "Opera";
 fullVersion = nAgt.substring(verOffset+6);
}
// In Chrome, the true version is after "Chrome" 
else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 browserName = "Chrome";
 fullVersion = nAgt.substring(verOffset+7);
}
// In Safari, the true version is after "Safari" 
else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
 browserName = "Safari";
 fullVersion = nAgt.substring(verOffset+7);
}
// In Firefox, the true version is after "Firefox" 
else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
 browserName = "Firefox";
 fullVersion = nAgt.substring(verOffset+8);
}
// In most other browsers, "name/version" is at the end of userAgent 
else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < (verOffset=nAgt.lastIndexOf('/')) ) 
{
 browserName = nAgt.substring(nameOffset,verOffset);
 fullVersion = nAgt.substring(verOffset+1);
 if (browserName.toLowerCase()==browserName.toUpperCase()) {
  browserName = navigator.appName;
 }
}
// trim the fullVersion string at semicolon/space if present
if ((ix=fullVersion.indexOf(";"))!=-1) fullVersion=fullVersion.substring(0,ix);
if ((ix=fullVersion.indexOf(" "))!=-1) fullVersion=fullVersion.substring(0,ix);

majorVersion = parseInt(''+fullVersion,10);
if (isNaN(majorVersion)) {
 fullVersion  = ''+parseFloat(navigator.appVersion); 
 majorVersion = parseInt(navigator.appVersion,10);
}

//document.write('Browser name  = '+browserName+'<br>');
//document.write('Full version  = '+fullVersion+'<br>');
//document.write('Major version = '+majorVersion+'<br>');
//document.write('navigator.appName = '+navigator.appName+'<br>');
//document.write('navigator.userAgent = '+navigator.userAgent+'<br>');

if (browserName == "Microsoft Internet Explorer")
{
	//alert ("You Are Using MSIE.");
	//alert (fullVersion);
	if (fullVersion >= 6)
	{
		//alert ("You Are Using Version Greater Than / Equal To 6.");
		//window.location = "login1.php";
	}
	else
	{
		//alert ("Version Is Less Than 6.");
		//alert ("This is not MSIE.");
		//window.location = "browserfailed.php?st=versionfailed";
	}
}
else
{
	//alert ("Version Is Less Than 6.");
	//alert ("This is not MSIE.");
	//window.location = "browserfailed.php?st=browserfailed";
}


</script>
<script language="javascript">

function process1login1()
{
	if (document.form1.username.value == "")
	{
		alert ("Pleae Enter Your User Id.");
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

function setFocus()
{
	document.getElementById("username").focus();
}

</script>
</head>

<body onLoad="return setFocus()">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399"><?php //include ("includes/menu1.php"); ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">
		  	  	<form id="form1" name="form1" method="post" action="login1.php" onKeyDown="return disableEnterKey()" onSubmit="return process1login1()">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
        <tr>
          <td><table width="400" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
              <tbody>
                <tr>
                  <td colspan="2" align="left" valign="top"  
				  bgcolor="#CCCCCC" class="bodytext3"><div class="bodytext3"><b>User Login</b></div></td>
                  </tr>
                <tr>
                  <td colspan="2" align="left" valign="top"  
				  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FF9900'; } ?>" class="bodytext3">
				  <div align="right">&nbsp;
				  <?php
					  echo $errmsg;
				  ?>
                  </div></td>
                </tr>
                <tr>
                  <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">User ID </td>
                  <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF"><input name="username" type="text" id="username" style="border: 1px solid #001E6A" size="20" /></td>
                </tr>
                <tr>
                  <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">Password</td>
                  <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF"><input name="password" type="password" id="password" style="border: 1px solid #001E6A" size="20" /></td>
                </tr>
                <tr>
                  <td align="middle" valign="top"  bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="middle" valign="top"  bgcolor="#FFFFFF"><div align="left">
                      <input type="hidden" name="frmflag1" id="frmflag1" value="frmflag1" />
                      <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />
                      <input type="reset" name="Submit2" value="Reset" style="border: 1px solid #001E6A" />
                  </div></td>
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