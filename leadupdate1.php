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
	background-color: #E0E0E0;
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
      <td width="21%" align="left" valign="middle" bordercolor="#F3F3F3"  class="bodytext3"><strong>Customer Name </strong><strong></strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><input type="text" name="customername" id="customername" value="<?php echo $customername; ?>">
	  <strong></strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Phone / Mobile </strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><input name="phonenumber" type="text" id="phonenumber" value="<?php echo $phonenumber; ?>" size="10"> 
      / 
      <input name="mobilenumber" type="text" id="mobilenumber" value="<?php echo $mobilenumber; ?>" size="10"></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Contact Person </strong><strong></strong></td>
      <td width="28%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input type="text" name="contactperson" id="contactperson" value="<?php echo $contactperson; ?>">
      </span></td>
      <td width="21%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3"><strong>City / Pincode </strong></span></td>
      <td width="30%" colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input name="city" type="text" id="city" value="<?php echo $city; ?>" size="10">
/
<input name="pincode" type="text" id="pincode" value="<?php echo $pincode; ?>" size="10">
      </span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Email ID </strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input type="text" name="emailid" id="emailid" value="<?php echo $emailid; ?>">
      </span></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3"><strong>State / Country </strong></span></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input name="state" type="text" id="state" value="<?php echo $state; ?>" size="10">
/
<input name="country" type="text" id="country" value="<?php echo $country; ?>" size="10">
      </span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3"><strong>Lead Details </strong><strong></strong></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Date </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
	  <span class="bodytext31">
        <input name="leaddate" id="leaddate" value="<?php echo $leaddate; ?>" readonly="readonly" onKeyDown="return disableEnterKey()"  size="20" />
        <img src="images2/cal.gif" onClick="javascript:NewCssCal('leaddate')" style="cursor:pointer"/>		</span></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Assigned To </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadassignedto" name="leadassignedto" >
		<option value="<?php echo $leadassignedto; ?>"><?php echo $leadassignedto; ?></option>
		<?php
		$query1 = "select * from master_leadassignedto where status <> 'deleted' order by leadassignedto";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadassignedto = $res1["leadassignedto"];
		?>
		<option value="<?php echo $res1leadassignedto; ?>"><?php echo $res1leadassignedto; ?></option>
		<?php
		}
		?>
		</select>	  </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Category </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadcategoryname" name="leadcategoryname" >
		<option value="<?php echo $leadcategoryname; ?>"><?php echo $leadcategoryname; ?></option>
		<?php
		$query1 = "select * from master_leadcategory where status <> 'deleted' order by leadcategoryname";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadcategoryname = $res1["leadcategoryname"];
		?>
		<option value="<?php echo $res1leadcategoryname; ?>"><?php echo $res1leadcategoryname; ?></option>
		<?php
		}
		?>
		</select>	  </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Stage </strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadstagename" name="leadstagename">
		<option value="<?php echo $leadstagename; ?>"><?php echo $leadstagename; ?></option>
		<?php
		$query1 = "select * from master_leadstage where status <> 'deleted' order by leadstagename";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadstagename = $res1["leadstagename"];
		?>
		<option value="<?php echo $res1leadstagename; ?>"><?php echo $res1leadstagename; ?></option>
		<?php
		}
		?>
		</select>	  </td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Source </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadsourcename" name="leadsourcename" >
		<option value="<?php echo $leadsourcename; ?>"><?php echo $leadsourcename; ?></option>
		<?php
		$query1 = "select * from master_leadsource where status <> 'deleted' order by leadsourcename";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadsourcename = $res1["leadsourcename"];
		?>
		<option value="<?php echo $res1leadsourcename; ?>"><?php echo $res1leadsourcename; ?></option>
		<?php
		}
		?>
		</select>	  </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Customer Budget </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input type="text" name="customerbudget" id="customerbudget" value="<?php echo $customerbudget; ?>">
      </span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Action To Be Taken </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadactiontobetaken" name="leadactiontobetaken" >
		<option value="<?php echo $leadactiontobetaken; ?>"><?php echo $leadactiontobetaken; ?></option>
		<?php
		$query1 = "select * from master_leadactiontobetaken where status <> 'deleted' order by leadactiontobetaken";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadactiontobetaken = $res1["leadactiontobetaken"];
		?>
		<option value="<?php echo $res1leadactiontobetaken; ?>"><?php echo $res1leadactiontobetaken; ?></option>
		<?php
		}
		?>
		</select>	  </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Priority Of Action </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
	  <select id="leadactionpriority" name="leadactionpriority" >
		<option value="<?php echo $leadactionpriority; ?>"><?php echo $leadactionpriority; ?></option>
        <option value="HIGH">HIGH</option>
        <option value="MEDIUM">MEDIUM</option>
        <option value="LOW">LOW</option>
      </select>	  </td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Approval Status </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
	  <select id="leadapprovalstatus" name="leadapprovalstatus" >
		<option value="<?php echo $leadapprovalstatus; ?>"><?php echo $leadapprovalstatus; ?></option>
        <option value="APPROVED">APPROVED</option>
        <option value="PENDING">PENDING</option>
        <option value="DENIED">DENIED</option>
      </select>	  </td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Entry Time </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3"><?php echo $leadentrydate; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Subject </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input type="text" name="leadsubject" id="leadsubject" value="<?php echo $leadsubject; ?>">
      </span></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Details </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3"><p class="bodytext3">
          <textarea name="leaddetails" cols="70" rows="5" id="leaddetails"><?php echo nl2br($leaddetails); ?></textarea>
      </p>      </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Remarks</strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3"><span class="bodytext3">
        <input type="text" name="remarks" id="remarks" value="<?php echo $remarks; ?>">
      </span></td>
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
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3">
	  <strong>Response By &amp; Date Time </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3"
	  ><span class="bodytext3"><?php echo strtoupper($res2responseby).' - '.$res2responsedatetime; ?></span></td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3">
	  <strong>Response Details </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3">
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
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#CCCCCC" class="bodytext3"><strong>New Response Entry </strong></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Response By</strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3">
	  <span class="style2"><?php echo strtoupper($username);//.' - '.date('d-M-Y H:m:s'); ?></span>
	  <input name="responseby" id="responseby" type="hidden" value="<?php echo $username; ?>">	  </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Response Date Time </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3">
	  <span class="bodytext31">
        <input name="responsedatetime" id="responsedatetime" value="<?php echo date('Y-m-d H:m:s'); ?>" style="background-color:#CCCCCC;" readonly="readonly" onKeyDown="return disableEnterKey()"  size="20" />
        <!--<img src="images2/cal.gif" onClick="javascript:NewCssCal('responsedate')" style="cursor:pointer"/>--> 
		</span></td>
    </tr>
    <tr bgcolor="#D3EEB7">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Response  Details </strong><strong></strong></td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3">
        <textarea name="responsedetails" cols="70" rows="5" id="responsedetails"></textarea>      </td>
    </tr>
    <tr bgcolor="#CBDBFA">
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Update Lead Status </strong></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3">
	  <select id="leadstatusname" name="leadstatusname" >
		<option value="<?php echo $leadstatusname; ?>"><?php echo $leadstatusname; ?></option>
          <option value="OPEN">OPEN</option>
          <option value="WON">WON</option>
          <option value="DROPPED">DROPPED</option>
          <option value="LOST">LOST</option>
      </select></td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" class="bodytext3"><strong>Lead Lost Reason </strong><strong></strong></td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3">
		<select id="leadlostreasonname" name="leadlostreasonname">
		<option value="">Select Lead Lost Reason</option>
		<?php
		$query1 = "select * from master_leadlostreason where status <> 'deleted' order by leadlostreasonname";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$res1leadlostreasonname = $res1["leadlostreasonname"];
		?>
		<option value="<?php echo $res1leadlostreasonname; ?>"><?php echo $res1leadlostreasonname; ?></option>
		<?php
		}
		?>
		</select>	  </td>
    </tr>
    <tr>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
        <input name="leadautonumber" id="leadautonumber" value="<?php echo $leadanum; ?>" type="hidden">
        <input name="leadcode" id="leadcode" value="<?php echo $leadcode; ?>" type="hidden">
        <input name="frmflag1" id="frmflag1" value="frmflag1" type="hidden">
		<input name="Submit222" type="submit"  value="Save &amp; Update Lead" class="button" style="border: 1px solid #001E6A"/>
      </font></font></font></font></font></td>
    </tr>
    <tr>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="3" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td colspan="-1" align="left" valign="middle" bordercolor="#F3F3F3" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
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