<?php
session_start();
include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION['username'])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$errmsg = '';

if (isset($_REQUEST["frmflag3"])) { $frmflag3 = $_REQUEST["frmflag3"]; } else { $frmflag3 = ""; }
//$frmflag3 = $_POST['frmflag3'];
if ($frmflag3 == 'paperanum')
{
	//for ($j=1;$j<=10;$j++)
	$query1 = "select * from master_billtype";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	while ($res1 = mysql_fetch_array($exec1))
	{
		$res1anum = $res1['auto_number'];
		$billtypeorder = $_REQUEST['billtypeorder'.$res1anum];
		
		$query2 = "update master_billtype set listorder = '$billtypeorder' where auto_number = '$res1anum'";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	}
	
	header ("location:settingsbilltypelist1.php?st=success");

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == 'success')
{
	$errmsg = "Bill Type Listing Order Settings Updated.";
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
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function process1()
{
	//alert ("Inside Funtion");
	if (document.form1.activecompany.value == "")
	{
		alert ("Pleae Select Company Name.");
		document.form1.activecompany.focus();
		return false;
	}
}

function focusSubmit()
{
	document.getElementById("submit").focus();
}

</script>
<body onLoad="return focusSubmit()">
<table width="101%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399">
	<?php 
	if (isset($_SESSION['companyanum'])) // if the variable is set.
	{
		include ("includes/menu1.php"); 
	}
	else
	{
		include ("includes/menu2.php"); 
	}
	?>
	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
            <tr>
              <td><form name="form1" id="form1" method="post" action="settingsbilltypelist1.php">
                  <table width="800" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Bill Type List Order Settings</strong></td>
                      </tr>
                      <tr>
                        <td colspan="3" align="left" valign="middle"   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong>Bill Type Name </strong></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3"><strong>Existing Order </strong></span></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3"><strong>Change To </strong></span></td>
                      </tr>
					<?php
					$query1billtype = "select * from master_billtype order by listorder";
					$exec1billtype = mysql_query($query1billtype) or die ("Error in Query1billtype".mysql_error());
					while ($res1billtype = mysql_fetch_array($exec1billtype))
					{
					$billtypeanum = $res1billtype['auto_number'];
					$billtype = $res1billtype['billtype'];
					$listorder = $res1billtype['listorder'];
					?>
                      <tr>
                        <td width="31%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						  <div align="left"><strong><?php echo $billtype; ?></strong></div></td>
                        <td width="29%" align="left" valign="top"  bgcolor="#FFFFFF">
						<div align="left"><strong><?php echo round($listorder); ?></strong></div></td>
                        <td width="40%" align="left" valign="top"  bgcolor="#FFFFFF">
							<strong>
                          <select name="billtypeorder<?php echo $billtypeanum; ?>" id="billtypeorder<?php echo $billtypeanum; ?>" >
						  <option value="<?php echo $listorder; ?>" selected="selected"><?php echo round($listorder); ?></option>
						  <?php
						  for ($i=1;$i<=10;$i++)
						  {
						  ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						  <?php
						  }
						  ?>	
                          </select>
					      </strong></td>
                      </tr>
					 <?php
					 }
					 ?>
                      <tr>
                        <td colspan="3" align="middle"  bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3" align="middle"  bgcolor="#FFFFFF">
                          <input type="hidden" name="frmflag3" value="paperanum" />
                          <input type="submit" name="submit" value="Set Bill Type Order " style="border: 1px solid #001E6A" />
						&nbsp;</td>
                      </tr>
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

