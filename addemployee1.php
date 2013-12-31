<?php
session_start();
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION['username'])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$sessionusername = $_SESSION['username'];
$errmsg = '';
$bgcolorcode = '';

$query7 = "select * from master_edition";
$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
$res7 = mysql_fetch_array($exec7);
$usersallowed1 = $res7['users'];

$query8 = "select * from master_employee";
$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
$rowcount8 = mysql_num_rows($exec8);
$employeecount = $rowcount8;

if ($usersallowed1 == $employeecount)
{
	//If this condition is true, javascript filter will return false.
	$errmsg = "Sorry, Maximum Allowed User Limit Reached. Please Purchase Additional User Licence.";
}

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{
	$employeecode=$_REQUEST['employeecode'];
	$employeename = $_REQUEST['employeename'];
	$employeename = strtoupper($employeename);
	$employeename = trim($employeename);
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$status = $_REQUEST['status'];
	
	$query2 = "select * from master_employee where username = '$username'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_employee (employeecode,employeename, username, password, 
		status, lastupdate, lastupdateusername, lastupdateipaddress) 
		values ('$employeecode','$employeename', '$username', '$password', 
		'$status', '$updatedatetime', '$sessionusername', '$ipaddress')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		
		for ($i=0;$i<=1000;$i++)
		{
			if (isset($_REQUEST["cbmainmenu".$i])) { $cbmainmenu = $_REQUEST["cbmainmenu".$i]; } else { $cbmainmenu = ""; }
			//$cbmainmenu = $_REQUEST['cbmainmenu'.$i];
			if ($cbmainmenu != '')
			{
				//echo '<br>'.$cbmainmenu;
				$query5 = "select * from master_menumain where auto_number = '$cbmainmenu'";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				$res5 = mysql_fetch_array($exec5);
				$res5mainmenuid = $res5['mainmenuid'];
				
				$query3 = "insert into master_employeerights (employeecode, username, mainmenuid, submenuid, 
				lastupdate, lastupdateipaddress, lastupdateusername) 
				values ('$employeecode', '$username', '$res5mainmenuid', '', 
				'$updatedatetime', '$ipaddress', '$sessionusername')";
				$exec3 = mysql_query($query3) or die ("Error in query3".mysql_error());
			}
		}

		//echo '<br><br>';
		for ($i=0;$i<=1000;$i++)
		{
			if (isset($_REQUEST["cbsubmenu".$i])) { $cbsubmenu = $_REQUEST["cbsubmenu".$i]; } else { $cbsubmenu = ""; }
			//$cbsubmenu = $_REQUEST['cbsubmenu'.$i];
			if ($cbsubmenu != '')
			{
				//echo '<br>'.$cbsubmenu;
				$query6 = "select * from master_menusub where auto_number = '$cbsubmenu'";
				$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
				$res6 = mysql_fetch_array($exec6);
				$res6submenuid = $res6['submenuid'];

				$query4 = "insert into master_employeerights (employeecode, username, mainmenuid, submenuid, 
				lastupdate, lastupdateipaddress, lastupdateusername) 
				values ('$employeecode', '$username', '', '$res6submenuid', 
				'$updatedatetime', '$ipaddress', '$sessionusername')";
				$exec4 = mysql_query($query4) or die ("Error in query4".mysql_error());
			}
		}
	
		

		header ("location:addemployee1.php?st=success");
	}
	else
	{
		header ("location:addemployee1.php?st=failed");
	}

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == 'success')
{
		$errmsg = "Success. New Employee Updated.";
}
else if ($st == 'failed')
{
		$errmsg = "Failed. Employee Already Exists.";
}

$query1 = "select * from master_employee order by auto_number desc limit 0, 1";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$rowcount1 = mysql_num_rows($exec1);
if ($rowcount1 == 0)
{
	$employeecode = 'EMP00000001';
}
else
{
	$res1 = mysql_fetch_array($exec1);
	$res1employeecode = $res1['employeecode'];
	$employeecode = substr($res1employeecode, 3, 8);
	$employeecode = intval($employeecode);
	$employeecode = $employeecode + 1;

	$maxanum = $employeecode;
	if (strlen($maxanum) == 1)
	{
		$maxanum1 = '0000000'.$maxanum;
	}
	else if (strlen($maxanum) == 2)
	{
		$maxanum1 = '000000'.$maxanum;
	}
	else if (strlen($maxanum) == 3)
	{
		$maxanum1 = '00000'.$maxanum;
	}
	else if (strlen($maxanum) == 4)
	{
		$maxanum1 = '0000'.$maxanum;
	}
	else if (strlen($maxanum) == 5)
	{
		$maxanum1 = '000'.$maxanum;
	}
	else if (strlen($maxanum) == 6)
	{
		$maxanum1 = '00'.$maxanum;
	}
	else if (strlen($maxanum) == 7)
	{
		$maxanum1 = '0'.$maxanum;
	}
	else if (strlen($maxanum) == 8)
	{
		$maxanum1 = $maxanum;
	}
	
	$employeecode = 'EMP'.$maxanum1;

	//echo $employeecode;
}
//echo $res1employeecode;


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
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
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

	if (document.form1.employeename.value == "")
	{
		alert ("Employee Name Cannot Be Empty.");
		document.form1.employeename.focus();
		return false;
	}
	if (document.form1.username.value == "")
	{
		alert ("User Name Cannot Be Empty.");
		document.form1.username.focus();
		return false;
	}
	if (document.form1.username.value != "")
	{	
		var data = document.form1.username.value;
		//alert(data);
		// var iChars = "!%^&*()+=[];,.{}|\:<>?~"; //All special characters.*
		var iChars = "!^+=[];,{}|\<>?~$'\"@#%&*()-_`. "; 
		for (var i = 0; i < data.length; i++) 
		{
			if (iChars.indexOf(data.charAt(i)) != -1) 
			{
				//alert ("Your Item Name Has Blank White Spaces Or Special Characters. Like ! ^ + = [ ] ; , { } | \ < > ? ~ $ ' \" These are not allowed.");
				alert ("Your User Name Has Blank White Spaces Or Special Characters. These Are Not Allowed.");
				return false;
			}
		}
	}
	if (document.form1.password.value == "")
	{
		alert ("Password Cannot Be Empty.");
		document.form1.password.focus();
		return false;
	}
	<?php
	if ($usersallowed1 == $employeecount)
	{
	?>
		alert ("Sorry, Maximum Allowed User Limit Reached. Please Purchase Additional User Licence.");
		return false;
	<?php
	}
	?>
}

</script>
<body>
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td height="58" colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399">
	<?php 
	
		include ("includes/menu1.php"); 
	
	//	include ("includes/menu2.php"); 
	
	?>	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" action="addemployee1.php" onKeyDown="return disableEnterKey()" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="900" height="250" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Employee - New </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  
				bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
              <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
              <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
				<tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Employee Code   *</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="employeecode" id="employeecode" value="<?php echo $employeecode; ?>" readonly="readonly" style="border: 1px solid #001E6A" size="20"></td>
              </tr>
              <tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Employee Name   *</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="employeename" id="employeename" value="" style="border: 1px solid #001E6A;text-transform: uppercase;" size="60"></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">User Name </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="username" id="username" style="border: 1px solid #001E6A;" value=""  size="60" maxlength="20" />
				<span class="bodytext3">(Space or special characters are not allowed.) </span></td>
                </tr>
				 <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Password</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="password" type="password" id="password" style="border: 1px solid #001E6A;" value=""  size="60" maxlength="20" /></td>
                </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Status</td>
                   <td valign="middle" align="left" ><select name="status" id="status" style="width: 130px;">
                       <option value="Active">Active</option>
                       <option value="Deleted">Deleted</option>
                   </select></td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Date Posted</td>
                   <td colspan="2" align="left" valign="middle" ><input name="dateposted" id="dateposted" value="<?php echo $updatedatetime; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="20"  readonly="readonly" />                   </td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td valign="middle" align="left" >&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Menu Permissions </strong></td>
                   <td valign="middle" align="left" >&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Main Menu </strong></td>
                   <td valign="middle" align="left" ><span class="bodytext3"><strong>Sub Menu </strong></span></td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
				 <?php
				 $query2 = "select * from master_menumain order by mainmenuorder";
				 $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				 while ($res2 = mysql_fetch_array($exec2))
				 {
				 $res2anum = $res2['auto_number'];
				 $res2menuid = $res2['mainmenuid'];
				 $res2mainmenutext = $res2['mainmenutext'];
				 
				 //if ($res2mainmenutext != 'Home' && $res2mainmenutext != 'Logout')
				 //{
				 ?>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
				   <input type="checkbox" name="cbmainmenu<?php echo $res2anum; ?>" checked="checked" value="<?php echo $res2anum; ?>">
                     <strong><?php echo $res2mainmenutext; ?></strong></td>
                   <td valign="middle" align="left" >&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
				 <?php
				 $query3 = "select * from master_menusub where mainmenuid = '$res2menuid' order by submenuorder";
				 $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				 while ($res3 = mysql_fetch_array($exec3))
				 {
				 $res3anum = $res3['auto_number'];
				 $res3submenuid = $res3['submenuid'];
				 $res3submenutext = $res3['submenutext'];
				 ?>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td valign="middle" align="left" ><span class="bodytext3">
                     <input type="checkbox" name="cbsubmenu<?php echo $res3anum; ?>" checked="checked" value="<?php echo $res3anum; ?>">
                     <strong><?php echo $res3submenutext; ?></strong></span></td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
 				 <?php
				 }
				 ?>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td valign="middle" align="left"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
				 <?php
				 //}
				 }
				 ?>
                <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td valign="middle" align="left" >&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
                  </tr>
                 <tr>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td valign="middle" align="left" >&nbsp;</td>
                   <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                   <td colspan="2" align="left" valign="middle" >&nbsp;</td>
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
                bgcolor="#cccccc" class="bodytext31"><div align="right">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
				<font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="hidden" name="frmflag1" value="frmflag1" />
                    <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                    <input name="Submit222" type="submit"  value="Save Employee" class="button" style="border: 1px solid #001E6A"/>
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

