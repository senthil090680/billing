<?php
session_start();
include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION['username'])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = '';
$bgcolorcode = '';

if (isset($_REQUEST["frmflag3"])) { $frmflag3 = $_REQUEST["frmflag3"]; } else { $frmflag3 = ""; }
//$frmflag3 = $_POST['frmflag3'];
if ($frmflag3 == 'paperanum')
{
	$paperanum = $_REQUEST['paperanum'];
	
	$query5 = "update master_printer set defaultstatus = ''";
	$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());

	$query6 = "update master_printer set defaultstatus = 'default' where auto_number = '$paperanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	
	header ("location:printersettings1.php?st=success");

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == 'success')
{
	$errmsg = "Default Printer Paper Size Updated.";
}

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
              <td><form name="form1" id="form1" method="post" action="printersettings1.php">
                  <table width="800" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Printer Settings - Set Default </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td width="52%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Select Paper Size To Print Immediately After Bill Save </div></td>
                        <td width="48%" align="left" valign="top"  bgcolor="#FFFFFF">
						<select name="paperanum" id="paperanum" >
						<?php
						$selected = '';
						$query1 = "select * from master_printer where status <> 'deleted' order by papersize";// where default = 'default'";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$papersize = $res1['papersize'];
						$paperanum = $res1['auto_number'];
						$defaultstatus = $res1['defaultstatus'];
						
						if ($defaultstatus == 'default') { $selected = 'selected="selected"'; }
						//if ($dfcompanyanum == $companyanum) { $selected = 'selected="selected"'; }
						?>
						<option value="<?php echo $paperanum; ?>" <?php echo $selected; ?>><?php echo $papersize; ?></option>
						<?php
						$selected = '';
						}
						?>
						</select>
                          <input type="hidden" name="frmflag3" value="paperanum" />
                          <input type="submit" name="submit" value="Set Default Paper " style="border: 1px solid #001E6A" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="middle"  bgcolor="#FFFFFF"><div align="left"><span class="bodytext3">* Please Note: For A4 / A5 size papers, only popup window will appear. You need select printing options from browser menu. </span></div></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="middle"  bgcolor="#FFFFFF"><div align="left"><span class="bodytext3">* A5 is half size paper of A4 size. </span></div></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="middle"  bgcolor="#FFFFFF"><div align="left"><span class="bodytext3">* 40 Column Paper is smaller size 4 inch paper. </span></div></td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="2" >&nbsp;</td>
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

