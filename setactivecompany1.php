<?php
session_start();
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');

//Variable Declaration
$errmsg = '';

$query7 = "select * from master_company";
$exec7 = mysql_query($query7) or die ("Error in Query8".mysql_error());
$res7rowcount = mysql_num_rows($exec7);
if ($res7rowcount == 0) 
{
	header ("location:addcompany1.php?cpycount=firstcompany");
}

$frmflag3 = isset($_POST["frmflag3"]);
if ($frmflag3 == 'activecompany')
{
	$dfcompanyanum = $_REQUEST["activecompany"];

	$query6 = "select * from master_company where auto_number = '$dfcompanyanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$res6companyname = $res6["companyname"];
	$res6companycode = $res6["companycode"];
	
	$_SESSION["companyanum"] = $dfcompanyanum;
	$_SESSION["companyname"] = $res6companyname;
	$_SESSION["companycode"] = $res6companycode;
	
	$query7 = "select * from master_settings where companycode = '$res6companycode' and modulename = 'SETTINGS' and 
	settingsname = 'CURRENT_FINANCIAL_YEAR'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$financialyear = $res7["settingsvalue"];
	
	$_SESSION["financialyear"] = $financialyear;
	
	header ("location:mainmenu1.php");
	//header ("location:setactivefinancialyear1.php");

}

if (isset($_SESSION["companyanum"]))
{
	$companyanum = $_SESSION["companyanum"];
	$companyname = $_SESSION["companyname"];
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
	if (isset($_SESSION["companyanum"])) // if the variable is set.
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
    <td width="2%" valign="top">
	<?php 
	//include ("includes/menu4.php"); 
	if (isset($_SESSION["companyanum"])) // if the variable is set.
	{
		//include ("includes/menu4.php"); 
	}
	?>
      &nbsp;</td>
    <td width="97%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablebackgroundcolor1">
            <tr>
              <td><form name="form1" id="form1" method="post" action="setactivecompany1.php" onSubmit="return process1()">
                  <table width="800" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Select Active Company - Selected Company Will Be Loaded</strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if (isset($errmsg)) { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td width="23%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right">Select Company  </div></td>
                        <td width="77%" align="left" valign="top"  bgcolor="#FFFFFF">
						<select name="activecompany" id="activecompany" >
						<?php
						$selected = '';
						$query1 = "select * from master_company where companystatus = 'Active' order by companyname";// where default = 'default'";
						$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$activecompany = $res1["companyname"];
						$dfcompanyanum = $res1["auto_number"];
						$dfstatus = $res1["activecompany"];
						
						//if ($dfstatus == 'active') { $selected = 'selected="selected"'; }
						if ($dfcompanyanum == $companyanum) { $selected = 'selected="selected"'; }
						?>
						<option value="<?php echo $dfcompanyanum; ?>" <?php echo $selected; ?>><?php echo $activecompany; ?></option>
						<?php
						$selected = '';
						}
						?>
						</select>
                          <input type="hidden" name="frmflag3" value="activecompany" />
                          <input type="submit" name="submit" value="Click To Proceed" style="border: 1px solid #001E6A" /></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="middle"  bgcolor="#FFFFFF"><span class="bodytext3">* In all the bill and quotations selected company will be applicable. You can change it later. </span></td>
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

