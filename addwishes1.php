<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = '';
$bgcolorcode = '';

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_POST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{

	$wishesontop = $_REQUEST['wishesontop'];
	$wishesonbottom = $_REQUEST['wishesonbottom'];
	$wishesontop = strtoupper($wishesontop);
	$wishesonbottom = strtoupper($wishesonbottom);
	$showontop = $_REQUEST['showontop'];
	$showonbottom = $_REQUEST['showonbottom'];
	
	$query1 = "update master_wishes set wishesontop = '$wishesontop', wishesonbottom = '$wishesonbottom', 
	showontop = '$showontop', showonbottom = '$showonbottom', username = '$username', lastupdate = '$updatedatetime', 
	ipaddress = '$ipaddress'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$errmsg = "Success. Wishes Updated.";
	$bgcolorcode = 'success';

}

$query2 = "select * from master_wishes";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$wishesontop = $res2['wishesontop'];
$wishesonbottom = $res2['wishesonbottom'];
$showontop = $res2['showontop'];
$showonbottom = $res2['showonbottom'];


?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">



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
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
            <tr>
              <td><form name="form1" id="form1" method="post" action="addwishes1.php" onKeyDown="return disableEnterKey()" onSubmit="return process1()">
                  <table width="700" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Wishes Master - Add New </strong></td>
                      </tr>
					  <tr>
                        <td colspan="2" align="left" valign="middle"   
						bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
					  <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Wishes On Bill Printout Top </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="wishesontop" id="wishesontop" style="border: 1px solid #001E6A;text-transform: uppercase;" value="<?php echo $wishesontop; ?>" size="50" maxlength="30" /></td>
					  </tr>
					  <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Wishes On Bill Printout Bottom </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="wishesonbottom" id="wishesonbottom" style="border: 1px solid #001E6A;text-transform: uppercase;"  value="<?php echo $wishesonbottom; ?>" size="50" maxlength="30" /></td>
                      </tr>
					  <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Show Wishes On Top </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<select name="showontop">
						<option value="<?php echo $showontop; ?>"><?php echo strtoupper($showontop); ?></option>
						<option value="yes">YES</option>
						<option value="no">NO</option>
                        </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Show Wishes On Bottom </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<select name="showonbottom">
						<option value="<?php echo $showonbottom; ?>"><?php echo strtoupper($showonbottom); ?></option>
                          <option value="yes">YES</option>
                          <option value="no">NO</option>
                        </select></td>
                      </tr>
                      <tr>
                        <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF"><div align="right">
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />
                          <input type="reset" name="Submit2" value="Reset" style="border: 1px solid #001E6A" />
                        </div></td>
                      </tr>
                      <!--  <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Imprint Name </div></td>
                        <td valign="top" align="left" ><input name="imprintname1" id="imprintname1" style="border: 1px solid #001E6A" size="20" />
                        &nbsp;<input type="submit" value="Search" style="border: 1px solid #001E6A"/></td>
                      </tr>
					   <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Publisher Name </div></td>
                        <td valign="top" align="left" ><input name="publisher1" id="publisher1" style="border: 1px solid #001E6A" size="20" />
                        &nbsp;<input type="submit" value="Search" style="border: 1px solid #001E6A"/></td>
                      </tr>-->
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

