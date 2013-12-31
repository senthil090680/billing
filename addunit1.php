<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$colorloopcount = "";

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{

	$unitname = $_REQUEST["unitname"];
	$unitname = strtoupper($unitname);
	$unitname_abbreviation = $_REQUEST["unitname_abbreviation"];
	$unitname_abbreviation = strtoupper($unitname_abbreviation);
	$len1=strlen($unitname);
	$len2=strlen($unitname_abbreviation);
	if ($len1<=25 && $len2<=10)
	{
	$query2 = "select * from master_units where unitname = '$unitname' and unitname_abbreviation = '$unitname_abbreviation'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_units (unitname, ipaddress, updatetime, unitname_abbreviation) 
		values ('$unitname', '$ipaddress', '$updatedatetime', '$unitname_abbreviation')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$errmsg = "Success. New Unit Updated.";
	}
	else
	{
		$errmsg = "Failed. Unit Full Name or Unit Short Name Already Exists.";
	}
	}
	else
	{
		$errmsg = "Failed. Unit Full Name Length Should Be 25 Characters or Unit Short Name Should Be 10 Characters.";
	}

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if (isset($_REQUEST["anum"])) { $delanum = $_REQUEST["anum"]; } else { $delanum = ""; }
if ($st == 'del')
{
	$query3 = "update master_units set status = 'deleted' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}
if ($st == 'activate')
{
	$query3 = "update master_units set status = '' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
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
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function addunit1process1()
{
	//alert ("Inside Funtion");
	var strUnitAbb = document.form1.unitname_abbreviation.value;
	//alert (strLength.length);
	var strLength = strUnitAbb.length;
	
	if (document.form1.unitname.value == "")
	{
		alert ("Pleae Enter Full Unit Name.");
		document.form1.unitname.focus();
		return false;
	}
	else if (document.form1.unitname_abbreviation.value == "")
	{
		alert ("Pleae Enter Short Unit Name.");
		document.form1.unitname_abbreviation.focus();
		return false;
	}
	else if (strLength > 10)
	{
		alert ("Unit Short Name Should Not Be More Than 3 Characters. Ex: Kilograms = KG");
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
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top"><?php //include ("includes/menu4.php"); ?>
      &nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
            <tr>
              <td><form name="form1" id="form1" method="post" action="addunit1.php" onSubmit="return addunit1process1()">
                  <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Units Master - Add New </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">New Unit Full Name </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="unitname" id="unitname" style="border: 1px solid #001E6A" size="20" />
                        <font class="bodytext3">(Example: KILOGRAM)</font>                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">New Unit Short Name </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="unitname_abbreviation" id="unitname_abbreviation" style="border: 1px solid #001E6A" size="20" maxlength="10" />
                        <font class="bodytext3">(Example: KGM)</font></td>
                      </tr>
                      <tr>
                        <td width="26%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td width="74%" align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="frmflag" value="addnew" />
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />                        </td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="2" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Units Master - Existing List </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="6%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Delete</strong></div></td>
                        <td bgcolor="#CCCCCC" class="bodytext3"><strong>Units - Full Name </strong></td>
                        <td bgcolor="#CCCCCC" class="bodytext3"><strong>Units - Short Name </strong></td>
                      </tr>
                      <?php
	    $query1 = "select * from master_units where status <> 'deleted' order by unitname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$unitname = $res1["unitname"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		
		$colorloopcount = $colorloopcount + 1;
		$showcolor = ($colorloopcount & 1); 
		if ($showcolor == 0)
		{
			$colorcode = 'bgcolor="#CBDBFA"';
		}
		else
		{
			$colorcode = 'bgcolor="#D3EEB7"';
		}
		?>
        <tr <?php echo $colorcode; ?>>
                        <td align="left" valign="top"  class="bodytext3"><div align="center">
						<a href="addunit1.php?st=del&&anum=<?php echo $auto_number; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
                        <td align="left" valign="top"  class="bodytext3">
						<?php echo $unitname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3">
						<?php echo $unitname_abbreviation; ?> </td>
                      </tr>
                      <?php
		}
		?>
                      <tr>
                        <td align="middle" colspan="3" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Units Master - Deleted </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="11%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Activate</strong></div></td>
                        <td width="42%" bgcolor="#CCCCCC" class="bodytext3"><strong>Units</strong></td>
                        <td width="47%" bgcolor="#CCCCCC" class="bodytext3"><strong>Units - Short Name </strong></td>
                      </tr>
                      <?php
		
	    $query1 = "select * from master_units where status = 'deleted' order by unitname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$unitname = $res1["unitname"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		
		$colorloopcount = $colorloopcount + 1;
		$showcolor = ($colorloopcount & 1); 
		if ($showcolor == 0)
		{
			$colorcode = 'bgcolor="#CBDBFA"';
		}
		else
		{
			$colorcode = 'bgcolor="#D3EEB7"';
		}
		?>
        <tr <?php echo $colorcode; ?>>
                        <td align="left" valign="top" >
						<a href="addunit1.php?st=activate&&anum=<?php echo $auto_number; ?>" class="bodytext3">
                          <div align="center" class="bodytext3">Activate</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $unitname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $unitname_abbreviation; ?></td>
                      </tr>
                      <?php
		}
		?>
                      <tr>
                        <td align="middle" colspan="3" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
              </form>
                </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

