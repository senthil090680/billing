<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$colorloopcount = "";

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{

	$expensemainanum = $_REQUEST["expensemainanum"];
	$expensesubname = $_REQUEST["expensesubname"];
	$expensesubname = strtoupper($expensesubname);
	$expensesubname = trim($expensesubname);
	$length=strlen($expensesubname);
	//echo $length;
	if ($length<=100)
	{
	$query1 = "select * from master_expensemain where auto_number = '$expensemainanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	$expensemainname = $res1["expensemainname"];
	
	$query2 = "select * from master_expensesub where expensemainanum = '$expensemainanum' and expensesubname = '$expensesubname'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_expensesub (expensemainanum, expensemainname, expensesubname, ipaddress, updatetime) 
		values ('$expensemainanum', '$expensemainname', '$expensesubname', '$ipaddress', '$updatedatetime')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$errmsg = "Success. New Expense Sub Updated.";
		$bgcolorcode = 'success';
		
	}
	//exit();
	else
	{
		$errmsg = "Failed. Expense Sub Already Exists.";
		$bgcolorcode = 'failed';
	}
	}
	else
	{
		$errmsg = "Failed. Only 100 Characters Are Allowed.";
		$bgcolorcode = 'failed';
	}

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if (isset($_REQUEST["anum"])) { $delanum = $_REQUEST["anum"]; } else { $delanum = ""; }
if ($st == 'del')
{
	$query3 = "update master_expensesub set status = 'deleted' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}
if ($st == 'activate')
{
	$query3 = "update master_expensesub set status = '' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}
if ($st == 'default')
{
	$query4 = "update master_expensesub set defaultstatus = '' where cstid='$custid' and cstname='$custname'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());

	$query5 = "update master_expensesub set defaultstatus = 'DEFAULT' where auto_number = '$delanum'";
	$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
}
if ($st == 'removedefault')
{
	$query6 = "update master_expensesub set defaultstatus = '' where auto_number = '$delanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
}

?>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	background-color: #E0E0E0;
}
.bodytext3 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
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

function addexpensesub1process1()
{
	//alert ("Inside Funtion");
	if (document.form1.expensemainanum.value == "")
	{
		alert ("Please Select Expense Main Name.");
		document.form1.expensemainanum.focus();
		return false;
	}
	if (document.form1.expensesubname.value == "")
	{
		alert ("Please Enter Expense Sub Name.");
		document.form1.expensesubname.focus();
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
              <td><form name="form1" id="form1" method="post" action="addexpensesub1.php" onSubmit="return addexpensesub1process1()">
                  <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Expense Main  - Add New </strong></td>
                      </tr>
					  <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Expense Main </div></td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF">
						<select name="expensemainanum" id="expensemainanum"  >
						<option value="" selected="selected">Select Expense Main Name</option>
						<?php
						$query1 = "select * from master_expensemain where status <> 'deleted'";
						$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$expensemainanum = $res1["auto_number"];
						$expensemainname = $res1["expensemainname"];
						?>
						<option value="<?php echo $expensemainanum; ?>"><?php echo $expensemainname; ?></option>
						<?php
						}
						?>
						</select>
						<span class="bodytext3">Example: TELEPHONE </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Add New Expense Sub </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="expensesubname" id="expensesubname" style="border: 1px solid #001E6A" size="20" />
                          <span class="bodytext3">Example: TEL-04442012133, TEL-42012134... </span></td>
                      </tr>
                      <tr>
                        <td width="25%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td width="75%" align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="frmflag" value="addnew" />
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                            <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />
                          <span class="bodytext3">(* You cannot change name later) </span> </td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="2" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <table width="600" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Expense Sub - Existing List </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="6%" bgcolor="#FFFFFF" class="bodytext3"><div align="center"><strong>Delete</strong></div></td>
                        <td bgcolor="#FFFFFF" class="bodytext3"><strong>Expense Main </strong></td>
                        <td bgcolor="#FFFFFF" class="bodytext3"><strong>Expense Sub </strong></td>
                      </tr>
                      <?php
	    $query1 = "select * from master_expensesub where status <> 'deleted' order by expensemainname, expensesubname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$expensemainname = $res1["expensemainname"];
		$expensesubname = $res1["expensesubname"];
		$auto_number = $res1["auto_number"];
		$defaultstatus = $res1["defaultstatus"];

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
                        <td align="left" valign="top"  class="bodytext3">
						<div align="center"><a href="addexpensesub1.php?st=del&&anum=<?php echo $auto_number; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
                        <td width="42%" align="left" valign="top"  class="bodytext3">
						<?php echo $expensemainname; ?> </td>
                        <td width="52%" align="left" valign="top"  class="bodytext3">
						<?php echo $expensesubname; ?></td>
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
                        <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Expense Sub - Deleted </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="11%" bgcolor="#FFFFFF" class="bodytext3"><div align="center"><strong>Activate</strong></div></td>
                        <td width="37%" bgcolor="#FFFFFF" class="bodytext3"><strong>Expense</strong></td>
                        <td width="52%" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                      </tr>
                      <?php
		
	    $query1 = "select * from master_expensesub where status = 'deleted' order by expensemainname, expensesubname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$expensemainname = $res1["expensemainname"];
		$expensesubname = $res1["expensesubname"];
		$auto_number = $res1["auto_number"];

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
						<a href="addexpensesub1.php?st=activate&&anum=<?php echo $auto_number; ?>" class="bodytext3">
                          <div align="center" class="bodytext3">Activate</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $expensemainname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $expensesubname; ?></td>
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

