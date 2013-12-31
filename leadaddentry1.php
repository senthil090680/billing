<?php
session_start();
//include ("includes/loginverify.php"); //to prevent indefinite loop, loginverify is disabled.
if (!isset($_SESSION["username"])) header ("location:index.php");
include ("db/db_connect.php");
//date_default_timezone_set('Asia/Calcutta'); 
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$recordstatus = 'ACTIVE';
$errmsg = "";
$bgcolorcode = "";

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$leadcode=$_REQUEST["leadcode"];
	$customername = $_REQUEST["customername"];
	//$customername = strtoupper($customername);
	$customername = trim($customername);
	$contactperson=$_REQUEST["contactperson"];
	$city  = $_REQUEST["city"];
	$state  = $_REQUEST["state"];
	$pincode = $_REQUEST["pincode"];
	$country = $_REQUEST["country"];
	$emailid = $_REQUEST["emailid"];
	$phonenumber = $_REQUEST["phonenumber"];
	$mobilenumber = $_REQUEST["mobilenumber"];
	$leaddate = $_REQUEST["leaddate"];
	$leadassignedto = $_REQUEST["leadassignedto"];
	$leadcategoryname = $_REQUEST["leadcategoryname"];
	$leadstatusname=$_REQUEST["leadstatusname"];
	$leadsourcename=$_REQUEST["leadsourcename"];
	$customerbudget=$_REQUEST["customerbudget"];
	$leadactiontobetaken=$_REQUEST["leadactiontobetaken"];
	$leadactionpriority=$_REQUEST["leadactionpriority"];
	$leadsubject=$_REQUEST["leadsubject"];
	$leaddetails=$_REQUEST["leaddetails"];
	$leadapprovalstatus=$_REQUEST["leadapprovalstatus"];
	$remarks=$_REQUEST["remarks"];
	$leadentrydate=$_REQUEST["leadentrydate"];
	$leadstagename=$_REQUEST["leadstagename"];
		
	$query2 = "select * from master_leads where leadcode = '$leadcode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_leads (leadcode, customername, contactperson, city, state, 
		pincode, country, emailid, phonenumber, mobilenumber, leaddate, leadassignedto, leadcategoryname, leadstatusname, 
		leadsourcename, customerbudget,	leadactiontobetaken, leadactionpriority, leaddetails, leadsubject, 
		leadapprovalstatus, remarks, leadentrydate, username, recordstatus, ipaddress, leadstagename) 
		values('$leadcode','$customername','$contactperson','$city','$state',
		'$pincode','$country', '$emailid','$phonenumber','$mobilenumber','$leaddate','$leadassignedto','$leadcategoryname','$leadstatusname',
		'$leadsourcename','$customerbudget', '$leadactiontobetaken','$leadactionpriority','$leaddetails', '$leadsubject', 
		'$leadstatusname', '$remarks', '$leadentrydate','$username','$recordstatus', '$ipaddress', '$leadstagename')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//exit;
			
		$leadcode = '';
		$customername = '';
		$customername = trim($customername);
		$contactperson = '';
		$city = '';
		$state = '';
		$pincode = '';
		$country = '';
		$emailid = '';
		$phonenumber = '';
		$mobilenumber = '';
		$leaddate = date('Y-m-d');;
		$leadassignedto = '';
		$leadcategoryname = '';
		$leadstatusname = '';
		$leadsourcename = '';
		$customerbudget = '';
		$leadactiontobetaken = '';
		$leadactionpriority = '';
		$leadsubject = '';
		$leaddetails = '';
		$leadapprovalstatus = '';
		$remarks = '';
		$leadentrydate = $updatedatetime;
		$leadstagename = '';
	
		header("location:leadaddentry1.php?st=success");
		//header ("location:addcompany1.php?st=success&&cpynum=1");
	}
	else
	{
		header ("location:leadaddentry1.php?st=failed");
	}

}
else
{
	$leadcode = '';
	$customername = '';
	$contactperson = '';
	$city = '';
	$state = '';
	$pincode = '';
	$country = '';
	$emailid = '';
	$phonenumber = '';
	$mobilenumber = '';
	$leaddate = date('Y-m-d');;
	$leadassignedto = '';
	$leadcategoryname = '';
	$leadstatusname = '';
	$leadsourcename = '';
	$customerbudget = '';
	$leadactiontobetaken = '';
	$leadactionpriority = '';
	$leadsubject = '';
	$leaddetails = '';
	$leadapprovalstatus = '';
	$remarks = '';
	$leadentrydate = $updatedatetime;
	$leadstagename = '';
}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'success')
{
		$errmsg = "Success. New Lead Entry Updated.";
}

$query2 = "select * from master_leads order by auto_number desc limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2leadcode = $res2["leadcode"];
if ($res2leadcode == '')
{
	$leadcode = 'LDC00000001';
	$openingbalance = '0.00';
}
else
{
	$res2leadcode = $res2["leadcode"];
	$leadcode = substr($res2leadcode, 3, 8);
	$leadcode = intval($leadcode);
	$leadcode = $leadcode + 1;

	$maxanum = $leadcode;
	if (strlen($maxanum) == 1)
	{
		$maxanum1 = '0000000'.$maxanum;
	}
	else if (strlen($maxanum) == 2)
	{
		$maxanum1 = '000000'.$maxanum;
	}
	else if (strlen($maxanum) == 3)
	{
		$maxanum1 = '00000'.$maxanum;
	}
	else if (strlen($maxanum) == 4)
	{
		$maxanum1 = '0000'.$maxanum;
	}
	else if (strlen($maxanum) == 5)
	{
		$maxanum1 = '000'.$maxanum;
	}
	else if (strlen($maxanum) == 6)
	{
		$maxanum1 = '00'.$maxanum;
	}
	else if (strlen($maxanum) == 7)
	{
		$maxanum1 = '0'.$maxanum;
	}
	else if (strlen($maxanum) == 8)
	{
		$maxanum1 = $maxanum;
	}
	
	$leadcode = 'LDC'.$maxanum1;
	$openingbalance = '0.00';
	//echo $companycode;
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
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script language="javascript">


function process1backkeypress1()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
}

function onloadfunction1()
{
	document.form1.customername.focus();	
}


function processflowitem(varstate)
{
	//alert ("Hello World.");
	var varProcessID = varstate;
	//alert (varProcessID);
	var varItemNameSelected = document.getElementById("state").value;
	//alert (varItemNameSelected);
	ajaxprocess5(varProcessID);
	//totalcalculation();
}

function processflowitem1()
{
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function process1()
{

	if (document.form1.leadcode.value == "")
	{
		alert ("Lead Code Code Cannot Be Empty.");
		document.form1.leadcode.focus();
		return false;
	}
	if (document.form1.customername.value == "")
	{
		alert ("Customer Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
	if (document.form1.contactperson.value == "")
	{
		alert ("Contact Person Cannot Be Empty.");
		document.form1.contactperson.focus();
		return false;
	}
	if (document.form1.emailid.value != "")
	{
		if (document.form1.emailid.value.indexOf('@')<= 0 || document.form1.emailid.value.indexOf('.')<= 0)
		{
			window.alert ("Please Enter valid Mail Id");
			document.form1.emailid.value = "";
			document.form1.emailid.focus();
			return false;
		}
	}
	if (document.form1.mobilenumber.value == "")
	{
		alert ("Mobile Number Cannot Be Empty.");
		document.form1.mobilenumber.focus();
		return false;
	}
	if (document.form1.leaddate.value == "")
	{
		alert ("Lead Date Cannot Be Empty.");
		document.form1.leaddate.focus();
		return false;
	}
	if (document.form1.leadassignedto.value == "")
	{
		alert ("Lead Assigned To Cannot Be Empty.");
		document.form1.leadassignedto.focus();
		return false;
	}
	if (document.form1.leadcategoryname.value == "")
	{
		alert ("Lead Category To Cannot Be Empty.");
		document.form1.leadcategoryname.focus();
		return false;
	}
	if (document.form1.leadstatusname.value == "")
	{
		alert ("Lead Status To Cannot Be Empty.");
		document.form1.leadstatusname.focus();
		return false;
	}
	if (document.form1.leadsourcename.value == "")
	{
		alert ("Lead Source To Cannot Be Empty.");
		document.form1.leadsourcename.focus();
		return false;
	}
	if (document.form1.customerbudget.value == "")
	{
		alert ("Lead Source To Cannot Be Empty.");
		document.form1.customerbudget.focus();
		return false;
	}
	if (isNaN(document.getElementById("customerbudget").value))
	{
		alert ("Customer Budget Can Only Be Numbers");
		document.form1.customerbudget.focus();
		return false;
	}
	if (document.form1.leadactiontobetaken.value == "")
	{
		alert ("Lead Action To Be Taken Cannot Be Empty.");
		document.form1.leadactiontobetaken.focus();
		return false;
	}
	if (document.form1.leadactionpriority.value == "")
	{
		alert ("Lead Action Priority Cannot Be Empty.");
		document.form1.leadactionpriority.focus();
		return false;
	}
	if (document.form1.leadsubject.value == "")
	{
		alert ("Lead Subject Cannot Be Empty.");
		document.form1.leadsubject.focus();
		return false;
	}
	if (document.form1.leaddetails.value == "")
	{
		alert ("Lead Details Cannot Be Empty.");
		document.form1.leaddetails.focus();
		return false;
	}
	if (document.form1.leadapprovalstatus.value == "")
	{
		alert ("Lead Approval Status Cannot Be Empty.");
		document.form1.leadapprovalstatus.focus();
		return false;
	}
	//return false;
}

</script>

<script src="js/datetimepicker_css.js"></script>

<body onLoad="return onloadfunction1()">
<table width="103%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="10" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="10" bgcolor="#003399">
	<?php 
	
		include ("includes/menu1.php"); 
	
	//	include ("includes/menu2.php"); 
	
	?>	</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="2%" valign="top">&nbsp;</td>
    <td width="97%" valign="top">


      	  <form name="form1" id="form1" method="post" action="leadaddentry1.php" onSubmit="return process1()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="860"><table width="800" height="282" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
            <tbody>
              <tr bgcolor="#011E6A">
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Lead - New Entry </strong></td>
                <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
              </tr>
				<tr>
				  <td colspan="4" align="left" valign="middle"  bgcolor="#CCCCCC" class="bodytext3"><span class="bodytext32"><strong>Lead - Customer Details </strong></span></td>
				  </tr>
				<tr>
                <td width="19%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Customer/ Company Name   *</span></td>
                <td colspan="3" align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="customername" id="customername" value="<?php echo $customername; ?>" style="border: 1px solid #001E6A;" size="60"></td>
                </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Contact Person </span></td>
                <td width="35%" align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                  <input name="contactperson" id="contactperson" value="<?php echo $contactperson; ?>" style="border: 1px solid #001E6A;"  size="20" />
                </span></td>
                <td width="17%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">City</td>
                <td width="29%" align="left" valign="middle"  bgcolor="#E0E0E0">
				<input name="city" id="city" value="<?php echo $city; ?>" style="border: 1px solid #001E6A"  size="20" />			</td>
              </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext31"><span class="bodytext32">State</span></span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="state" id="state" value="<?php echo $state; ?>" style="border: 1px solid #001E6A"  size="20" />				</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Pincode</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="pincode" id="pincode" value="<?php echo $pincode; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
				 </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Country </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="country" id="country" value="<?php echo $country; ?>" style="border: 1px solid #001E6A"  size="20" />				</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Email Id</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="emailid" id="emailid" value="<?php echo $emailid; ?>" style="border: 1px solid #001E6A"  size="20"></td>
				 </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Phone Number</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>" style="border: 1px solid #001E6A;" size="20" /></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Mobile Number </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="mobilenumber" id="mobilenumber" value="<?php echo $mobilenumber; ?>" style="border: 1px solid #001E6A;"  size="20" /></td>
				 </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">&nbsp;</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">&nbsp;</td>
			      </tr>
				 <tr>
				   <td colspan="4" align="left" valign="middle"  bgcolor="#CCCCCC" class="bodytext3"><span class="bodytext32"><strong>Lead - Enquiry Details </strong></span></td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Lead Date </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <input name="leaddate" id="leaddate" value="<?php echo $leaddate; ?>" style="border: 1px solid #001E6A;" readonly="readonly" onKeyDown="return disableEnterKey()"  size="20" />
                   <img src="images2/cal.gif" onClick="javascript:NewCssCal('leaddate')" style="cursor:pointer"/>
				   </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead Assigned To </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadassignedto" name="leadassignedto" >
                     <option value="">Select Lead Assigned To</option>
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
                   </select>				   </td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Lead Category </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadcategoryname" name="leadcategoryname" >
                     <option value="">Select Lead Category</option>
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
                   </select>				   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead Stage </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadstagename" name="leadstagename">
                     <option value="">Select Lead Stage</option>
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
                   </select>				</td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Lead Soruce </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadsourcename" name="leadsourcename" >
                       <option value="">Select Lead Source</option>
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
                   </select>				   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Customer Budget </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="customerbudget" id="customerbudget" value="<?php echo $customerbudget; ?>" style="border: 1px solid #001E6A"  size="20" />                   </td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Next Action To Be Taken </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadactiontobetaken" name="leadactiontobetaken" >
                     <option value="">Select Action To Be Taken</option>
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
                   </select>				   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Priority Of Action </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadactionpriority" name="leadactionpriority" >
                     <option value="">Select Lead Action Priority</option>
					 <option value="HIGH">HIGH</option>
					 <option value="MEDIUM">MEDIUM</option>
					 <option value="LOW">LOW</option>
                   </select>				</td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead Subject </td>
				   <td colspan="3" align="left" valign="middle"  bgcolor="#E0E0E0"><input name="leadsubject" id="leadsubject" value="<?php echo $remarks; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Lead Details </span></td>
				   <td colspan="3" align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext31">
                     <textarea name="leaddetails" cols="60" rows="5" id="leaddetails" style="border: 1px solid #001E6A;"><?php echo $leaddetails; ?></textarea>
                   </span></td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><span class="bodytext32">Approval Status </span></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadapprovalstatus" name="leadapprovalstatus" >
                     <option value="">Select Lead Approval Status</option>
					 <option value="APPROVED">APPROVED</option>
					 <option value="PENDING">PENDING</option>
					 <option value="DENIED">DENIED</option>
                   </select>				   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Remarks</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="remarks" id="remarks" value="<?php echo $remarks; ?>" style="border: 1px solid #001E6A"  size="20" />				</td>
				 </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead Status </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <select id="leadstatusname" name="leadstatusname" >
                       <option value="">Select Lead Status</option>
                       <option value="OPEN">OPEN</option>
                       <option value="WON">WON</option>
                       <option value="DROPPED">DROPPED</option>
                       <option value="LOST">LOST</option>
                     </select>
                   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">&nbsp;</td>
			      </tr>
				 <tr>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead ID   </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="leadcode" id="leadcode" value="<?php echo $leadcode; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="20"></td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Lead Entry Date </td>
				   <td align="left" valign="middle"  bgcolor="#E0E0E0">
				   <input name="leadentrydate" id="leadentrydate" value="<?php echo $leadentrydate; ?>" readonly="readonly" style="border: 1px solid #001E6A; background-color:#CCCCCC" size="20"></td>
				 </tr>
				 <tr>
				   <td colspan="4" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
			      </tr>
                 <tr>
                <td colspan="4" align="middle"  bgcolor="#E0E0E0"><div align="right"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                  <input type="hidden" name="frmflag1" value="frmflag1" />
                  <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                  <input name="Submit222" type="submit"  value="Save Lead" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></div></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table>
	</form>
<script language="javascript">


</script>
    </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

