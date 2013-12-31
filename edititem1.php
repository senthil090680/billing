<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";

if (isset($_REQUEST["sanum"])) { $sanum = $_REQUEST["sanum"]; } else { $sanum = ""; }
if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$itemcode = $_REQUEST["itemcode"];
	//$itemcode = strtoupper($itemcode);
	$itemcode = trim($itemcode);
	$itemname = $_REQUEST["itemname"];
	//$itemname = strtoupper($itemname);
	$itemname = trim($itemname);
	$categoryname = $_REQUEST["categoryname"];
	$purchaseprice  = $_REQUEST["purchaseprice"];
	$rateperunit  = $_REQUEST["rateperunit"];
	//$expiryperiod = $_REQUEST["expiryperiod"];
	$description=$_REQUEST["description"];
	$unitname_abbreviation = $_REQUEST["unitname_abbreviation"];
	$taxanum = $_REQUEST["taxanum"];
	
	$query4 = "select * from master_tax where auto_number = '$taxanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$res4taxname = $res4["taxname"];
	
	$query1 = "update master_item set unitname_abbreviation = '$unitname_abbreviation', taxanum = '$taxanum',  
	rateperunit = '$rateperunit', itemname = '$itemname', categoryname = '$categoryname',   
	ipaddress = '$ipaddress', updatetime = '$updatedatetime', description = '$description', purchaseprice = '$purchaseprice' 
	where auto_number = '$sanum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$errmsg = "Success. Edit Item Completed.";
	$bgcolorcode = 'success';
}

if ($sanum != '')
{
	$query2 = "select * from master_item where auto_number = '$sanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$categoryname = $res2["categoryname"];
	$itemcode = $res2["itemcode"];
	$itemname = $res2["itemname"];
	$unitname_abbreviation = $res2["unitname_abbreviation"];
	$purchaseprice = $res2["purchaseprice"];
	$rateperunit = $res2["rateperunit"];
	$expiryperiod = $res2["expiryperiod"];
	$description=$res2["description"];

	$taxanum = $res2["taxanum"];
	$query4 = "select * from master_tax where auto_number = '$taxanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$taxname = $res4["taxname"];

}
else
{
	header ("location:additem1.php");
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
		return false;
	}
	else
	{
		return true;
	}

}

function edititem1process1()
{
	//alert ("Inside Funtion");
	if (document.form1.categoryname.value == "")
	{	
		alert ("Please Select Category Name.");
		document.form1.categoryname.focus();
		return false;
	}
	else if (document.form1.itemcode.value == "")
	{	
		alert ("Please Enter Item Code.");
		document.form1.itemcode.focus();
		return false;
	}
	else if (document.form1.itemname.value == "")
	{
		alert ("Pleae Enter Item Name.");
		document.form1.itemname.focus();
		return false;
	}
	else if (document.form1.unitname_abbreviation.value == "")
	{
		alert ("Pleae Select Unit Name.");
		document.form1.unitname_abbreviation.focus();
		return false;
	}
	else if (document.form1.rateperunit.value == "")
	{	
		alert ("Please Enter Rate Per Unit.");
		document.form1.rateperunit.focus();
		return false;
	}
	else if (document.form1.taxanum.value == "")
	{	
		alert ("Please Select Applicable Tax.");
		document.form1.taxanum.focus();
		return false;
	}
	else if (isNaN(document.form1.rateperunit.value) == true)
	{	
		alert ("Please Enter Rate Per Unit In Numbers.");
		document.form1.rateperunit.focus();
		return false;
	}
	else if (document.form1.rateperunit.value == "0.00")
	{
		var fRet; 
		fRet = confirm('Rate Per Unit Is 0.00, Are You Sure You Want To Continue To Save?'); 
		//alert(fRet);  // true = ok , false = cancel
		if (fRet == false)
		{
			return false;
		}
/*		else if (document.form1.unitname_abbreviation.value == "SR")
		{
			if (document.form1.expiryperiod.value == "")
			{	
				alert ("Please Select Expiry Period.");
				document.form1.expiryperiod.focus();
				return false;
			}
		}
*/	}
/*	else if (document.form1.unitname_abbreviation.value == "SR")
	{
		if (document.form1.expiryperiod.value == "")
		{	
			alert ("Please Select Expiry Period.");
			document.form1.expiryperiod.focus();
			return false;
		}
	}
*/}

/*
function process1()
{
	//alert (document.form1.unitname.value);
	if (document.form1.unitname_abbreviation.value == "SR")
	{
		document.getElementById('expiryperiod').style.visibility = '';
	}
	else
	{
		document.getElementById('expiryperiod').style.visibility = 'hidden';
	}
}
*/
function process2()
{
	//document.getElementById('expiryperiod').style.visibility = 'hidden';
}


</script>
<body onLoad="return process2()">
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
              <td><form name="form1" id="form1" method="post" action="edititem1.php?sanum=<?php echo $sanum; ?>" onSubmit="return edititem1process1()">
                  <table width="800" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Item Master - Add New </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3">
						<div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Category Name  </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<select id="categoryname" name="categoryname">
						<?php
						if ($categoryname != '')
						{
						?>
						<option value="<?php echo $categoryname; ?>" selected="selected"><?php echo $categoryname; ?></option>
						<?php
						}
						else
						{
						?>
						<option value="" selected="selected">Select Category</option>
						<?php
						}
						$query1 = "select * from master_category where status <> 'deleted' order by categoryname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1categoryname = $res1["categoryname"];
						?>
						<option value="<?php echo $res1categoryname; ?>"><?php echo $res1categoryname; ?></option>
						<?php
						}
						?>
						</select>						</td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"> <div align="left">New Item / Item Code or ID </div></td><td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="itemcode" id="itemcode" value="<?php echo $itemcode; ?>" onKeyDown="return process1backkeypress1()" readonly="readonly" style="border: 1px solid #001E6A" size="20" maxlength="10" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Add New Item / Item Name </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="itemname" id="itemname" value="<?php echo htmlentities($itemname); ?>" onKeyDown="return process1backkeypress1()" style="border: 1px solid #001E6A" size="60" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Unit Name  </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<select id="unitname_abbreviation" name="unitname_abbreviation">
        				  			<?php
							if ($unitname_abbreviation != '')
							{
							?>
                            <option value="<?php echo $unitname_abbreviation; ?>" selected="selected"><?php echo $unitname_abbreviation; ?></option>
							<?php
							}
							else
							{
							?>
                            <option value="" selected="selected">Select Unit</option>
							<?php
							}
						$query1 = "select * from master_units where status <> 'deleted' order by unitname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1unitname = $res1["unitname"];
						$unitname_abbreviation = $res1["unitname_abbreviation"];
						?>
                          <option value="<?php echo $unitname_abbreviation; ?>"><?php echo $res1unitname.' ( '.$unitname_abbreviation.' ) '; ?></option>
                          <?php
						}
						?>
                        </select></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Description </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><textarea name="description" cols="60" id="description" style="border: 1px solid #001E6A"><?php echo $description; ?></textarea></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Purchase Price  Per Unit </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF"><input name="purchaseprice" id="purchaseprice" value="<?php echo $purchaseprice; ?>" style="border: 1px solid #001E6A" size="20" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Selling Price  Per Unit </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="rateperunit" id="rateperunit" value="<?php echo $rateperunit; ?>" style="border: 1px solid #001E6A" size="20" /></td>
                      </tr>
					  
					  
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Applicable Tax </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<select id="taxanum" name="taxanum">
						<?php
						if ($taxanum != '')
						{
						?>
						<option value="<?php echo $taxanum; ?>" selected="selected"><?php echo $taxname; ?></option>
						<?php
						}
						else
						{
						?>
						<option value="" selected="selected">Select Tax</option>
						<?php
						}

						$query1 = "select * from master_tax where status <> 'deleted' order by taxname";
						$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
						while ($res1 = mysql_fetch_array($exec1))
						{
						$res1taxname = $res1["taxname"];
						$res1taxpercent = $res1["taxpercent"];
						$res1anum = $res1["auto_number"];
						?>
                            <option value="<?php echo $res1anum; ?>"><?php echo $res1taxname.' ( '.$res1taxpercent.'% ) '; ?></option>
                            <?php
						}
						?>
                        </select></td>
                      </tr>
					  
					  
<!--                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">
						<div align="right">Item Period </div></td>
                        <td valign="top" align="left" >
						<select class="box" id="expiryperiod" 
                  style="BORDER-RIGHT: #001e6a 1px solid; BORDER-TOP: #001e6a 1px solid; BORDER-LEFT: #001e6a 1px solid; BORDER-BOTTOM: #001e6a 1px solid" 
                  name="expiryperiod">
				  			<?php
							if ($expiryperiod != '')
							{
							?>
                            <option value="<?php echo $expiryperiod; ?>" selected="selected"><?php echo $expiryperiod.' Months'; ?></option>
							<?php
							}
							else
							{
							?>
                            <option value="0" selected="selected">No Renewal</option>
							<?php
							}
							for ($i=1;$i<=60;$i++)
							{
							?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
							<?php
							}
							?>
                        </select></td>
                      </tr>
-->					  
					  
                      <tr>
                        <td width="20%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="left"></div></td>
                        <td width="80%" align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="frmflag" value="addnew" />
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                          <input type="submit" name="Submit" value="Save" style="border: 1px solid #001E6A" />                        </td>
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

