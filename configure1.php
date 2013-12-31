<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$code=date('msyiYsH'); // Month-Second-Year-Minute-YearFull-Second-Hour
$errmsg = '';
$bgcolorcode = '';

$query1 = "select * from master_edition";// where cstid='$custid' and cstname='$custname'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$res1productcode = $res1['productcode'];
if ($res1productcode == '')
{
	$rand1 = $code;
	$res1productcode=$rand1;
	$query3 = "update master_edition set productcode = '$rand1'";// where cstid='$custid' and cstname='$custname'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	//if (strlen($rand1) == 9) $rand1 = '0'.$rand1;
	
//  $query3 = "insert into master_edition(productcode,edition,allowed,status,updatedate,cstid,cstname)values('$rand1','FREE','30','ACTIVE','$updatedatetime','$custid','$custname')";
//	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
//	$query30 = "insert into master_edition(productcode,edition,allowed,status,updatedate,cstid,cstname)values('$rand1','PAID','30000','','$updatedatetime','$custid','$custname')";
//	$exec30 = mysql_query($query30) or die ("Error in Query30".mysql_error());
}

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{	
	$activationcode = $_REQUEST['activationcode'];
	$activationcode = strtoupper($activationcode);
	$productcode = $_REQUEST['productcode'];
	
	//$systemcode1 = substr($productcode, 0, 8);
	//$systemcode2 = substr($productcode, 8, 16);
	//$systemcode3 = $systemcode2.$systemcode1;

	$systemcode1 = substr($productcode, 0, 4);
	$systemcode2 = substr($productcode, 4, 4);
	$systemcode3 = substr($productcode, 8, 4);
	$systemcode4 = substr($productcode, 12, 4);
	$systemcode = $systemcode4.$systemcode3.$systemcode2.$systemcode1;
	
	$usercount = substr($activationcode, 16, 3); //To get number of allowed users.
	$activationcode = substr($activationcode, 0, 16); //To get only the activation code without users.
	
	if ($systemcode == $activationcode)
	{
			if (strlen($usercount) == 3)
			{
				$query4 = "update master_edition set status = 'ACTIVE', users = '$usercount' where edition = 'PAID'";// and cstid='$custid' and cstname='$custname'";
				$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
		
				$query5 = "update master_edition set status = '' where edition = 'FREE'";// and cstid='$custid' and cstname='$custname'";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				$errmsg = "Activation Completed. Thank You.";
			}
			else
			{
				$errmsg = "Activation Failed. Code Is Not Valid. (ErrNo:1)";
			}
	}
	else
	{
		$errmsg = "Activation Failed. Code Is Not Valid. (ErrNo:2)";
	}
}

$query2 = "select * from master_edition where status = 'ACTIVE'";// and cstid='$custid' and cstname='$custname'";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2edition = $res2['edition'];
$res2productcode = $res2['productcode'];
$usersallowed = $res2['users'];

if ($res2edition == 'FREE')
{
	$errmsg2 = "Your Software Version : Free";
}
else if ($res2edition == 'PAID')
{
	$errmsg2 = "Your Software Version : Professional";
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


function process1backkeypress1()
{
	if (event.keyCode==8) 
	{
		event.keyCode=0; return event.keyCode 
	}
}


function process1configure1()
{
	if(document.form1.activationcode.value == "")
	{
		alert ("Activation Code Cannot Be Empty.");
		document.form1.activationcode.focus();
		return false;
	}
	if(document.form1.usersallowed.value == "")
	{
		alert ("Number Of Users Cannot Be Empty.");
		document.form1.usersallowed.focus();
		return false;
	}
	if(isNaN(document.form1.usersallowed.value))
	{
		alert ("Number Of Users Can Only Be Numbers.");
		document.form1.usersallowed.focus();
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
              <td><form name="form1" id="form1" method="post" action="configure1.php" onSubmit="return process1configure1()">
                  <table width="700" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Software Configuration </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext3"><?php echo $errmsg; ?>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<?php echo $errmsg2; ?>						</td>
                      </tr>
                      <tr>
                        <td width="29%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						Product Code</td>
                        <td width="71%" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<input type="text" name="productcode" value="<?php echo $res1productcode; ?>" readonly="readonly" onKeyDown="return process1backkeypress1()">
Your Product Serial Number. </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Number Of Users Allowed </td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<input type="text" name="usersallowed" value="<?php echo $usersallowed; ?>" readonly="readonly" onKeyDown="return process1backkeypress1()">
                          Simultaneous Logins Allowed. </td>
                      </tr>
					 <?php 
					 if ($res2edition == 'FREE')
					 {
						?>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						Acitivation Code</td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<input type="text" name="activationcode" value="" onKeyDown="return process1backkeypress1()">
Enter	Your	Activation	Code Here. </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                          <input type="hidden" name="frmflag1" value="frmflag1">
						  <input name="Submit222" type="submit"  value="Submit" class="button" style="border: 1px solid #001E6A"/>
                        </font></font></font></font></font></td>
                      </tr>
					  <?php
					  }
					  ?>
                       <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><strong> Website : www.simpleindia.com </strong></td>
                      </tr>
                     <tr>
                        <td colspan="2" align="middle" >&nbsp;</td>
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

