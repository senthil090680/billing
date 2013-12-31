<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$paymentreceiveddatefrom = date('Y-m-d', strtotime('-1 month'));
$paymentreceiveddateto = date('Y-m-d');
$customername = '';
$colorloopcount = '';
$snocount = '';
$errmsg = '';

if (isset($_REQUEST["leadanum"])) { $leadanum = $_REQUEST["leadanum"]; } else { $leadanum = ""; }

if ($leadanum == '')
{
	header ("location:index.php");
}
else
{
	$query1 = "select * from master_leads where auto_number = '$leadanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	
	$leadautonumber = $res1['auto_number'];
	$leadcode = $res1["leadcode"];
	$customername = $res1["customername"];
	$contactperson = $res1["contactperson"];
	$city = $res1["city"];
	$state = $res1["state"];
	$pincode = $res1["pincode"];
	$country = $res1["country"];
	$emailid = $res1["emailid"];
	$phonenumber = $res1["phonenumber"];
	$mobilenumber = $res1["mobilenumber"];
	$leaddate = $res1["leaddate"];
	$leadassignedto = $res1["leadassignedto"];
	$leadcategoryname = $res1["leadcategoryname"];
	$leadstatusname = $res1["leadstatusname"];
	$leadsourcename = $res1["leadsourcename"];
	$customerbudget = $res1["customerbudget"];
	$leadactiontobetaken = $res1["leadactiontobetaken"];
	$leadactionpriority = $res1["leadactionpriority"];
	$leadsubject = $res1["leadsubject"];
	$leaddetails = $res1["leaddetails"];
	$leadapprovalstatus = $res1["leadapprovalstatus"];
	$remarks = $res1["remarks"];
	$leadentrydate = $res1["leadentrydate"];
	$leadstagename = $res1["leadstagename"];
	$leadlostreasonname = $res1["leadlostreasonname"];

	$leadentrydateonly = substr($leadentrydate, 0, 10);
	$dotarray = explode("-", $leadentrydateonly);
	$dotyear = $dotarray[0];
	$dotmonth = $dotarray[1];
	$dotday = $dotarray[2];
	$leadentrydateonly = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
	$leadentrydate = $leadentrydateonly.' '.substr($leadentrydate, 11, 10);

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
	$errmsg = "Success. Lead Update Completed.";
}


?>
<style type="text/css">
<!--


/*
.style3 {
	font-family: "Times New Roman", Times, serif;
	font-weight: bold;
	font-size: 24px;
}

.style2 {font-size: 10px}
.style5 {font-family: "Times New Roman", Times, serif; font-weight: bold; font-size: 18px; }
.style6 {font-size: 14px}
.style8 {font-size: 14px; font-weight: bold; }
*/

table.sample {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 1px;
	border-spacing: 1px;
	border-style: outset;
	border-color: gray;
	border-collapse: collapse;
	background-color: white;
}
body {
	background-color: #FFFFFF;
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.style2 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; }
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}

-->
</style>
<script language="javascript">

function escapekeypressed()
{
	//alert(event.keyCode);
	if(event.keyCode=='27'){ window.close(); }
}

function funcLeadUpdate1()
{
	if (document.getElementById("leadstatusname").value == 'LOST' && document.getElementById("leadlostreasonname").value == "")
	{
		alert ("For Lost Leads, Please Select Lost Reason.");
		document.getElementById("leadlostreasonname").value;
		return false;
	}
	if (document.getElementById("leadstatusname").value != 'LOST')// && document.getElementById("leadlostreasonname").value != "")
	{
		document.getElementById("leadlostreasonname").value == "";
		//return false;
	}
}

</script>

<script src="js/datetimepicker_css.js"></script>

<body onkeydown="escapekeypressed()">
<form name="form1" id="form1" action="leadupdate2.php" method="post" onSubmit="return funcLeadUpdate1()">
<table width="98%" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
  <tbody>
    <tr bgcolor="#011E6A">
      <td colspan="7" bgcolor="#CCCCCC" class="bodytext3"><strong>Leads Update Entry - <?php echo $customername; ?> - <?php echo $leaddate; ?> - <?php echo $leadstatusname; ?> - <?php echo $leadsubject; ?></strong></td>
    </tr>
    <tr>
      <td colspan="7" align="left" valign="middle" bordercolor="#F3F3F3" 
	  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" 
	  class="bodytext3"><?php echo $errmsg; ?>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3"><strong>Customer Details </strong></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td width="21%" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"  class="bodytext3"><strong>Customer Name </strong><strong></strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong><?php echo $customername; ?></strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Phone / Mobile </strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><?php echo $phonenumber.' / '.$mobilenumber; ?></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Contact Person </strong><strong></strong></td>
      <td width="28%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $contactperson; ?></span></td>
      <td width="21%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><strong>City / Pincode </strong></span></td>
      <td width="30%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $city.' / '.$pincode; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Email ID </strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $emailid; ?></span></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><strong>State / Country </strong></span></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $state.' / '.$country; ?></span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3"><strong>Lead Details </strong><strong></strong></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Date </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">
	  <span class="bodytext31"><span class="bodytext3"><?php echo $leaddate; ?></span></span></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Assigned To </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadassignedto; ?></span> </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Category </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadcategoryname; ?></span> </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Stage <?php echo $errmsg; ?></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadstagename; ?></span> </td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Source </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadsourcename; ?></span> </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Customer Budget </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $customerbudget; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Action To Be Taken </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadactiontobetaken; ?></span> </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Priority Of Action </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadactionpriority; ?></span> </td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Approval Status </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadapprovalstatus; ?></span> </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Entry Time </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadentrydate; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Subject </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $leadsubject; ?></span></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Lead Details </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><p class="bodytext3"><?php echo nl2br($leaddetails); ?></p>      </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"><strong>Remarks</strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><span class="bodytext3"><?php echo $remarks; ?></span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3"><strong>Lead Followup &amp; Update Details </strong></td>
    </tr>
	<?php
	$query2 = "select * from master_leadfollowup where leadautonumber = '$leadautonumber' and recordstatus = ''";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	while ($res2 = mysql_fetch_array($exec2))
	{
	$res2responseby = $res2['responseby'];
	$res2responsedatetime = $res2['responsedatetime'];
	$res2responsedetails = $res2['responsedetails'];
	?>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">
	  <strong>Response By <br>Date Time </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"
	  ><span class="bodytext3"><?php echo strtoupper($res2responseby).' - '.$res2responsedatetime; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">
	  <strong>Response Details </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">
	  <span class="bodytext3"><?php echo nl2br($res2responsedetails); ?></span></td>
    </tr>
    <tr>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td colspan="7" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
    </tr>
    <tr>
      <td align="middle" colspan="7" bordercolor="#F3F3F3">&nbsp;</td>
    </tr>
  </tbody>
</table>
</form>
</body>