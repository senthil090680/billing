<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
include ("autocompletebuild_supplier1.php");
$errmsg = "";
$bgcolorcode = "";
$colorloopcount = "";

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{

	$suppliercode = $_REQUEST["suppliercode"];
	$suppliername = $_REQUEST["suppliername"];
	$contactperson2 = $_REQUEST["contactperson2"];
	$title2 = $_REQUEST["title2"];
	$designation1 = $_REQUEST["designation1"];
	$department1 = $_REQUEST["department1"];
	$phonenumber1 = $_REQUEST["phonenumber1"];
	$mobilenumber1 = $_REQUEST["mobilenumber1"];
	$faxnumber1 = $_REQUEST["faxnumber1"];
	$dateposted1 = $_REQUEST["dateposted1"];
	$emailid1 = $_REQUEST["emailid1"];
	$contactstatus1 = $_REQUEST["contactstatus1"];
	
	$query1 = "insert into master_contact_supplier (suppliercode, suppliername, title1, contactperson1, 
	designation1, department1, phonenumber1, mobilenumber1, emailid1, faxnumber1, contactstatus, dateposted, ipaddress) 
	values ('$suppliercode', '$suppliername', '$title2', '$contactperson2', 
	'$designation1', '$department1', '$phonenumber1', '$mobilenumber1', '$emailid1', '$faxnumber1', '$contactstatus1', '$dateposted1', '$ipaddress')";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	
	header ("location:addcontactsupplier1.php?st=1&&suppliercode=$suppliercode");
	exit;

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if (isset($_REQUEST["suppliercode"])) { $suppliercode = $_REQUEST["suppliercode"]; } else { $suppliercode = ""; }
if ($st == '1')
{
	$errmsg = "Success. New Contact Updated.";
	$query1 = "select * from master_supplier where suppliercode = '$suppliercode'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	
	$supplieranum = "";
	$suppliername = "";
	$contactperson2 = "";
	$title = "";
	$designation = "";
	$address = "";
	$location = "";
	$city = "";
	$state = "";
	$phonenumber1 = "";
	$emailid1 = "";
	$mobilenumber1 = "";
	$faxnumber1 = "";
	$pincode1 = "";
}
else
{
	$supplieranum = "";
	$suppliername = "";
	$contactperson2 = "";
	$title = "";
	$designation = "";
	$address = "";
	$location = "";
	$city = "";
	$state = "";
	$phonenumber1 = "";
	$emailid1 = "";
	$mobilenumber1 = "";
	$faxnumber1 = "";
	$pincode1 = "";
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
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function cbsuppliername1()
{
	document.cbform1.submit();
}

function disableEnterKey()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
	
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}
	
	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		return false;
	}
	else
	{
		return true;
	}

}

function process1()
{
	if (document.getElementById("suppliername").value == "")
	{
		alert ("Supplier Name Cannot Be Empty. Please Supplier Before Pr");
		document.form1.suppliername.focus();
		return false;
	}
	else if (document.form1.contactperson2.value == "")
	{
		alert ("Contact Person Name Cannot Be Empty.");
		document.form1.contactperson2.focus();
		return false;
	}
	else if(document.form1.title2.value == "")
	{
		alert ("Contact Person Title Cannot Be Empty.");
		document.form1.contactperson2.focus();
		return false;
	}
/*	else if(document.form1.designation1.value == "")
	{
		alert ("Contact Person Designation Cannot Be Empty.");
		document.form1.designation1.focus();
		return false;
	}
	else if(document.form1.department1.value == "")
	{
		alert ("Contact Person Department Cannot Be Empty.");
		document.form1.department1.focus();
		return false;
	}
*/	else if (document.form1.emailid1.value != "")
	{
		if (document.form1.emailid1.value.indexOf('@')<= 0 || document.form1.emailid1.value.indexOf('.')<= 0)
		{
			window.alert ("Please Enter valid Mail Id");
			document.form1.emailid1.value = "";
			document.form1.emailid1.focus();
			return false;
		}
	}

}



</script>
<script language="javascript">

function suppliercodesearch2()
{
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}
	
	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		suppliercodesearch1()
	}

}

</script>
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/autocomplete_supplier1.js"></script>
<script type="text/javascript" src="js/autosuppliercodesearch1.js"></script>
<script type="text/javascript" src="js/suppliercodesearch1.js"></script>
<script type="text/javascript" src="js/autosuggest2supplier1.js"></script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<script type="text/javascript">
window.onload = function () 
{
	var oTextbox = new AutoSuggestControl(document.getElementById("searchsuppliername"), new StateSuggestions());        
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
    <td width="97%" valign="top"><table width="850" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		
              <form name="cbform1" method="post" action="addcontactsupplier1.php">
		<table width="98%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Contacts  - Select Supplier </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="8" align="left" valign="middle" 
			   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?></td>
            </tr>
            <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
            <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="top"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Supplier </td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="searchsuppliername" type="text" id="searchsuppliername" style="border: 1px solid #001E6A;" value="<?php //echo $searchsuppliername; ?>" size="50" autocomplete="off">
              </span></td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Supplier Code </td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="searchsuppliercode" onBlur="return suppliercodesearch1()" onKeyDown="return suppliercodesearch2()" id="searchsuppliercode" style="border: 1px solid #001E6A; text-transform:uppercase" value="<?php //echo $searchsuppliercode; ?>" size="20" />
                <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                <input name="submitsuppliercode" type="button" onClick="return suppliercodesearch1()" value="Search" class="button" style="border: 1px solid #001E6A"/>
              </font></font></font></font></font></span></td>
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            </tr>

            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">(If supplier exists in database, you can select from the list to auto complete below fields.) </span></td>
              </tr>
          </tbody>
        </table>
              </form>
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td >
		
         <form name="form1" method="post" action="addcontactsupplier1.php" onSubmit="return process1()">
          <table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="99%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                <tbody>
                  <tr bgcolor="#011E6A">
                    <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Supplier Details </strong></td>
                    <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
                  </tr>
                  <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
                  <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="top"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
                  <tr>
                    <td width="14%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Supplier Name </td>
                    <td width="37%" align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="supplieranum" type="hidden" id="supplieranum" value="<?php echo $supplieranum; ?>">
					<input name="suppliername" type="text" id="suppliername" style="border: 1px solid #001E6A" value="<?php echo $suppliername; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" size="50"></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Supplier Code </td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0"><input name="suppliercode" id="suppliercode" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A" value="<?php //echo $suppliercode; ?>" readonly="readonly" size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address </td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="address" id="address" style="border: 1px solid #001E6A" value="<?php echo $address; ?>"  onKeyDown="return disableEnterKey()" readonly="readonly" size="50" /></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Location</td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="location" id="location" style="border: 1px solid #001E6A" value="<?php echo $location; ?>"  onKeyDown="return disableEnterKey()" readonly="readonly" size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">City </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="city" id="city" style="border: 1px solid #001E6A" value="<?php echo $city; ?>" onKeyDown="return disableEnterKey()"readonly="readonly" size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">State </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="state" id="state" style="border: 1px solid #001E6A" value="<?php echo $state; ?>"  onKeyDown="return disableEnterKey()" readonly="readonly" size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">&nbsp;</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Pincode</td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="pincode1" id="pincode1" style="border: 1px solid #001E6A" value="<?php echo $pincode1; ?>"  onKeyDown="return disableEnterKey()" readonly="readonly" size="20" /></td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
			  <table width="99%" height="255" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                <tbody>
                  <tr bgcolor="#011E6A">
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2"><strong>Contact - Add New </strong></td>
                    <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
                  </tr>
				  <?php
				  if ($errmsg != '')
				  {
				  ?>
                  <tr>
                    <td colspan="8" align="left" valign="middle"  bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $errmsg;?>&nbsp;</td>
                  </tr>
				  <?php
				  }
				  ?>
                  <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
                  <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->

                  <tr>
                    <td width="16%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Contact Person * </td>
                    <td width="35%" align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="contactperson2" id="contactperson2" value="<?php echo $contactperson2; ?>" style="border: 1px solid #001E6A" size="30" /></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Title * </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<select name="title2" id="title2" style="width: 130px;">
                        <?php
		 	if ($title2 != '') 
		  	{
			  echo '<option value="'.$title2.'" selected="selected">'.$title2.'</option>';
		 	}
			else
			{
			  echo '<option value="Mr." selected="selected">Mr.</option>';
			}
			?>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Designation </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input type="text" name="designation1" id="designation1" value="" style="border: 1px solid #001E6A">
					</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Department </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input type="text" name="department1" id="department1" value="" style="border: 1px solid #001E6A">
					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Phone Number</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="phonenumber1" id="phonenumber1" value="<?php echo $phonenumber1; ?>" style="border: 1px solid #001E6A" size="20" />                    </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Mobile Number </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="mobilenumber1" id="mobilenumber1" value="<?php echo $mobilenumber1; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Email Id</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="emailid1" id="emailid1" value="<?php echo $emailid1; ?>" style="border: 1px solid #001E6A"  size="20"></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Fax Number</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="faxnumber1" id="faxnumber1" value="<?php echo $faxnumber1; ?>" style="border: 1px solid #001E6A"  size="20" /></td>
                  </tr>


                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Date Posted</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="dateposted1" id="dateposted1" value="<?php echo $updatedatetime; ?>" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A"  size="20"  readonly="readonly" />                    </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Contact Status * </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<select name="contactstatus1" id="contactstatus1" style="width: 130px;">
                        <?php
		 	if ($contactstatus != '') 
		  	{
			  echo '<option value="'.$status.'" selected="selected">'.$contactstatus.'</option>';
		 	}
			else
			{
			  echo '<option value="Active" selected="selected">Active</option>';
			}
			?>
                        <option value="Active">Active</option>
                        <option value="Deleted">Deleted</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td colspan="4" align="middle"  bgcolor="#E0E0E0"><div align="right">
                      <div align="right"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        <input type="hidden" name="frmflag1" value="frmflag1" />
                        <input type="hidden" name="loopcount" value="<?php echo $i - 1; ?>" />
                        <input name="Submit222" type="submit"  value="Save Contact" class="button" style="border: 1px solid #001E6A"/>
                      </font></font></font></font></font></div>
                    </div></td>
                  </tr>
                </tbody>
              </table>
			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
		    </form>
                   
					
					
					
		  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

