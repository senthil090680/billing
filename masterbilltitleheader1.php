<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = '';
$bgcolorcode = '';

if (isset($_REQUEST["billtitleheader"])) { $billtitleheader = $_REQUEST["billtitleheader"]; } else { $billtitleheader = ""; }
if (isset($_REQUEST["frmflag"])) { $frmflag = $_REQUEST["frmflag"]; } else { $frmflag = ""; }

if ($frmflag == 'addnew' and $billtitleheader != '')
{
	$billtitleheader = $_POST['billtitleheader'];
	$billtitleheader=strtoupper($billtitleheader);
	$query4 = "select * from master_billtitleheader where billtitleheader='$billtitleheader'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	//$education1=$res4['education'];
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		$errmsg = "* Bill Title Header Already Exists.";

	}
	else
	{
	$query1 = "insert into master_billtitleheader (billtitleheader) values ('$billtitleheader')";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$errmsg = "*New Bill Title Header Included.";
}
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if ($st == 'del')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_billtitleheader set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
}

if ($st == 'activate')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_billtitleheader set status = '' where auto_number = '$masanum1'";
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
<script language="javascript">

function process1()
{
	if (document.form1.billtitleheader.value == "")
	{
		alert ("Pleae Enter Bill Title Header.");
		document.form1.billtitleheader.focus();
		return false;
	}
}

</script>
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>

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
    <td width="97%" valign="top">


      	<form id="form1" name="form1" method="post" action="masterbilltitleheader1.php" onSubmit="return process1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Bill Copy Header  Master - Add New </strong></td>
        </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $errmsg; ?>&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New Bill Copy Header </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="billtitleheader" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: ORIGINAL, DUPLICATE) </span></td>
        </tr>
        <tr>
          <td width="37%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="63%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="frmflag" value="addnew" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Bill Copy Header Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_billtitleheader where status <> 'deleted' order by billtitleheader ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$billtitleheader = $res1['billtitleheader'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center"><a href="masterbilltitleheader1.php?st=del&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $billtitleheader; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Bill Copy Header Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_billtitleheader where status = 'deleted' order by billtitleheader ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$billtitleheader = $res1['billtitleheader'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><a href="masterbilltitleheader1.php?st=activate&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $billtitleheader; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>  

</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

