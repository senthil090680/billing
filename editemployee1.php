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
	if ($res2 != 0)
	{
		$query1 = "update master_employee set employeename = '$employeename', password = '$password', 
		status = '$status', lastupdate = '$updatedatetime', 
		lastupdateusername = '$sessionusername', lastupdateipaddress = '$ipaddress' 
		where employeecode = '$employeecode' and username = '$username'";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		
		///*
		if ($username != 'admin')
		{
		//*/
			
			$query33 = "delete from master_employeerights where username = '$username' and employeecode = '$employeecode'";
			$exec33 = mysql_query($query33) or die ("Error in Query33".mysql_error());	
			
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
			header ("location:editemployee1.php?st=success");
		///*
		}
		else
		{
			header ("location:editemployee1.php?st=success");
		}
		//*/

	}
	else
	{
		header ("location:editemployee1.php?st=failed");
	}

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == 'success')
{
		$errmsg = "Success. Employee Updated.";
}
else if ($st == 'failed')
{
		$errmsg = "Failed. Employee Already Exists.";
}

if (isset($_REQUEST["selectemployeecode"])) { $selectemployeecode = $_REQUEST["selectemployeecode"]; } else { $selectemployeecode = ""; }
//$selectemployeecode = $_REQUEST['selectemployeecode'];
$query7 = "select * from master_employee where employeecode = '$selectemployeecode'";
$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
$res7 = mysql_fetch_array($exec7);

$res7employeecode=$res7['employeecode'];
$res7employeename = $res7['employeename'];
$res7employeename = strtoupper($res7employeename);
$res7employeename = trim($res7employeename);
$res7username = $res7['username'];
$res7password = $res7['password'];
$res7status = $res7['status'];
$res7lastupdate = $res7['lastupdate'];



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
}

function funcEmployeeSelect1()
{
	if (document.getElementById("selectemployeecode").value == "")
	{
		alert ("Please Select Employee Code To Edit.");
		document.getElementById("selectemployeecode").focus();
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
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">
	
	
	<form name="selectemployee" id="selectempoyee" method="post" action="editemployee1.php?st=edit" onSubmit="return funcEmployeeSelect1()">
	<table width="900" height="29" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
	<tbody>
	<?php if ($errmsg != '') { ?>
	<tr>
	  <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
	  <td colspan="2" align="left" valign="middle" 
	  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
	  </tr>
	<?php } ?>
	<tr>
	<td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
	<td width="21%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Select Employee To Edit </strong></td>
	<td width="60%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
	<select name="selectemployeecode" id="selectemployeecode">
	<option value="">Select Employee To Edit</option>
	<?php
	$query21 = "select * from master_employee where status = 'Active'";
	$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
	while ($res21 = mysql_fetch_array($exec21))
	{
	$res21employeecode = $res21['employeecode'];
	$res21employeename = $res21['employeename'];
	?>
	<option value="<?php echo $res21employeecode; ?>"><?php echo $res21employeecode.' - '.$res21employeename; ?></option>
	<?php
	}
	?>
	</select>
	<input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A">	</td>
	</tr>
	</tbody>
	</table>  
	</form>
	
	
	
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">  
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">

			<?php
			if ($selectemployeecode != '')
			{
			?>
      	  <form name="form1" id="form1" method="post" action="editemployee1.php" onKeyDown="return disableEnterKey()" onSubmit="return from1submit1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="900" height="250" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Employee - Edit </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  
				bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td colspan="3" align="left" valign="middle" >&nbsp;</td>
              </tr>
              <tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Employee Code   *</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="employeecode" id="employeecode" value="<?php echo $res7employeecode; ?>" readonly="readonly" style="border: 1px solid #001E6A" size="20"></td>
              </tr>
              <tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Employee Name   *</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="employeename" id="employeename"  value="<?php echo $res7employeename; ?>"style="border: 1px solid #001E6A;text-transform: uppercase;" size="60"></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">User Name </td>
                <td colspan="3" align="left" valign="middle" >
				<input name="username" id="username" style="border: 1px solid #001E6A;" value="<?php echo $res7username; ?>" readonly="readonly"  size="60" maxlength="20" />
                    <span class="bodytext3">(Space or special characters are not allowed.) </span></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Password</td>
                <td colspan="3" align="left" valign="middle" >
				<input name="password" type="password" id="password" style="border: 1px solid #001E6A;" value="<?php echo $res7password; ?>" <?php if ($res7username == 'admin') { echo 'readonly="readonly"'; } ?>  size="60" maxlength="20" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> Status</td>
                <td valign="middle" align="left" >
				<select name="status" id="status" style="width: 130px;">
					<?php
					if ($res7status != '')
					{
					?>
					<option value="<?php echo $res7status; ?>" selected="selected"><?php echo $res7status; ?></option>
					<?php
					}
					?>
                    <option value="Active">Active</option>
                    <option value="Deleted">Deleted</option>
                </select>
				</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Date Posted</td>
                <td valign="middle" align="left" >
				<input name="dateposted" id="dateposted" value="<?php echo $updatedatetime; ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A"  size="20"  readonly="readonly" />                </td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Menu Permissions </strong></td>
                <td valign="middle" align="left" >&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Main Menu </strong></td>
                <td valign="middle" align="left" ><span class="bodytext3"><strong>Sub Menu </strong></span></td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <?php
				 $query2 = "select * from master_menumain where status = '' order by mainmenuorder";
				 $exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				 while ($res2 = mysql_fetch_array($exec2))
				 {
				 $res2anum = $res2['auto_number'];
				 $res2menuid = $res2['mainmenuid'];
				 $res2mainmenutext = $res2['mainmenutext'];
				 
				 $query31 = "select * from master_employeerights where employeecode = '$selectemployeecode' and mainmenuid = '$res2menuid'";
				 $exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
				 $res31 = mysql_fetch_array($exec31);
				 $rowcount31 = mysql_num_rows($exec31);
				 if ($rowcount31 > 0)
				 {
				 	$checkedvalue1 = 'checked="checked"';
				 }
				 
				 ?>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
				<input type="checkbox" name="cbmainmenu<?php echo $res2anum; ?>" <?php echo $checkedvalue1; ?> value="<?php echo $res2anum; ?>">
                    <strong><?php echo $res2mainmenutext; ?></strong></td>
                <td valign="middle" align="left" >&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <?php
				 $query3 = "select * from master_menusub where mainmenuid = '$res2menuid' and status = '' order by submenuorder";
				 $exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				 while ($res3 = mysql_fetch_array($exec3))
				 {
				 $res3anum = $res3['auto_number'];
				 $res3submenuid = $res3['submenuid'];
				 $res3submenutext = $res3['submenutext'];
				 
				 $query32 = "select * from master_employeerights where employeecode = '$selectemployeecode' and submenuid = '$res3submenuid'";
				 $exec32 = mysql_query($query32) or die ("Error in Query32".mysql_error());
				 $res32 = mysql_fetch_array($exec32);
				 $rowcount32 = mysql_num_rows($exec32);
				 if ($rowcount32 > 0)
				 {
				 	$checkedvalue2 = 'checked="checked"';
				 }
				 ?>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" ><span class="bodytext3">
                  <input type="checkbox" name="cbsubmenu<?php echo $res3anum; ?>" <?php echo $checkedvalue2; ?> value="<?php echo $res3anum; ?>">
                  <strong><?php echo $res3submenutext; ?></strong></span></td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <?php
				 $checkedvalue2 = '';
				 }
				 ?>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <?php
				 $checkedvalue1 = '';
				 //}
				 }
				 ?>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                <td valign="middle" align="left" >&nbsp;</td>
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
	<?php
	}
	?>
<script language="javascript">


</script>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

