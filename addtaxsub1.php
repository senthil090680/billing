<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$errmsg = "";
$bgcolorcode = "";
$colorloopcount = "";

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
if ($frmflag1 == 'frmflag1')
{
	$taxparentanum = $_REQUEST["taxparentanum"];
	
	$query4 = "select * from master_tax where auto_number = '$taxparentanum'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$taxparentanum = $res4["auto_number"];
	$taxparentname = $res4["taxname"];
	
	$taxsubname = $_REQUEST["taxsubname"];
	$taxsubname = strtoupper($taxsubname);
	$taxsubpercent = $_REQUEST["taxsubpercent"];
	
	$query2 = "select * from master_taxsub where taxsubname = '$taxsubname'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_num_rows($exec2);
	if ($res2 == 0)
	{
		$query1 = "insert into master_taxsub (taxparentanum, taxparentname, taxsubname, ipaddress, updatetime, taxsubpercent) 
		values ('$taxparentanum', '$taxparentname', '$taxsubname', '$ipaddress', '$updatedatetime', '$taxsubpercent')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		$errmsg = "Success. New Sub Tax Updated.";
	}
	else
	{
		$errmsg = "Failed. Sub Tax Name Already Exists.";
	}

}

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
if ($st == 'del')
{
	$delanum = $_REQUEST["anum"];
	$query3 = "update master_taxsub set status = 'deleted' where auto_number = '$delanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
}
if ($st == 'activate')
{
	$delanum = $_REQUEST["anum"];
	$query3 = "update master_taxsub set status = '' where auto_number = '$delanum'";
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
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">

function addtaxsub1process1()
{
	//alert ("Inside Funtion");
	if (document.form1.taxparentanum.value == "")
	{
		alert ("Please Select Tax Parent Name.");
		document.form1.taxparentanum.focus();
		return false;
	}
	else if (document.form1.taxsubname.value == "")
	{
		alert ("Please Enter Tax Sub Name.");
		document.form1.taxsubname.focus();
		return false;
	}
	else if (document.form1.taxsubpercent.value == "")
	{
		alert ("Please Enter Tax Sub Percent.");
		document.form1.taxsubpercent.focus();
		return false;
	}
	else if (isNaN(document.form1.taxsubpercent.value) == true)
	{	
		alert ("Please Enter Percent In Numbers.");
		document.form1.taxsubpercent.focus();
		return false;
	}
}
//}
//function spl()
//{
//var data=document.form1.taxsubpercent.value ;
////alert(data);
//  var iChars = "!%^&*()+=[];,{}|\:<>?~"; 
//   for (var i = 0; i < data.length; i++) {
//   
//  	if (iChars.indexOf(data.charAt(i)) != -1) {
//	
//  	  alert ("Special Characters Not Allowed In Tax Percent.");
//  	return false;
//  	}
//	}
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
              <td><form name="form1" id="form1" method="post" action="addtaxsub1.php" onSubmit="return addtaxsub1process1()">
                  <table width="800" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Tax Sub  Master - Add New </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">Select Parent Tax Name </div></td>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF">
						<select name="taxparentanum" id="taxparentanum"  >
                          <?php
			if ($taxparentname != '') 
		  	{
			  $query101 = "select * from master_tax where taxname = '$taxparentname'";
			  $exec101 = mysql_query($query101) or die ("Error in Query101".mysql_error());
			  $res101 = mysql_fetch_array($exec101);
			  $res101anum = $res101["auto_number"];
			  
			  echo '<option value="'.$res101anum.'" selected="selected">'.$taxparentname.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}

			$query1 = "select * from master_tax where status <> 'deleted'";
			$exec1 = mysql_query($query1) or die ("Error in Query1.city".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$taxparentanum = $res1["auto_number"];
			$taxparentname = $res1["taxname"];
			$taxparentpercent = $res1["taxpercent"];
			?>
                          <option value="<?php echo $taxparentanum; ?>"><?php echo $taxparentname.' ('.$taxparentpercent.') '; ?></option>
                          <?php
			  }
			  ?>
                        </select></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">* Wherever the parent tax is applicable, the respective sub tax will be calculated. Ex: For Parent Service Tax, Education Cess Child Tax will be calculated </div></td>
                        </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">New Tax Sub Name </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="taxsubname" id="taxsubname" style="border: 1px solid #001E6A" size="20" />
                        <font class="bodytext3">( Ex: Education Cess 2.00 % )</font> </td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="left">New Tax Sub Percentage </div></td>
                        <td align="left" valign="top"  bgcolor="#FFFFFF">
						<input name="taxsubpercent" id="taxsubpercent" style="border: 1px solid #001E6A" size="20"/>
                        %
                          <font class="bodytext3">( Ex:  2.00 )</font></td>
                      </tr>
                      <tr>
                        <td width="19%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
                        <td width="81%" align="left" valign="top"  bgcolor="#FFFFFF"><input type="hidden" name="frmflag" value="addnew" />
                            <input type="hidden" name="frmflag1" value="frmflag1" />
                          <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />                        </td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="2" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <table width="800" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="6" bgcolor="#CCCCCC" class="bodytext3"><strong>Tax Sub Master - Existing List </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="5%" bgcolor="#FFFFFF" class="bodytext3"><div align="center"><strong>Delete</strong></div></td>
                        <td width="6%" bgcolor="#FFFFFF" class="bodytext3"><div align="center"><strong>Edit</strong></div></td>
                        <td width="28%" bgcolor="#FFFFFF" class="bodytext3"><strong>Tax Sub  Name </strong></td>
                        <td width="17%" bgcolor="#FFFFFF" class="bodytext3"><strong>Tax Sub  Percent % </strong></td>
                        <td width="24%" bgcolor="#FFFFFF" class="bodytext3"><strong>Parent Tax   Name </strong></td>
                        <td width="20%" bgcolor="#FFFFFF" class="bodytext3"><strong>Parent Tax   Percent % </strong></td>
                      </tr>
                      <?php
	    $query1 = "select * from master_taxsub where status <> 'deleted' order by taxsubname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$taxsubname = $res1["taxsubname"];
		$auto_number = $res1["auto_number"];
		$taxsubpercent = $res1["taxsubpercent"];
		$taxparentname = $res1["taxparentname"];
		$taxparentanum = $res1["taxparentanum"];
		
		$query5 = "select * from master_tax where auto_number = '$taxparentanum'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		$res5 = mysql_fetch_array($exec5);
		$taxparentpercent = $res5["taxpercent"];
		
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
                        <td align="left" valign="top" ><div align="center">
						<a href="addtaxsub1.php?st=del&&anum=<?php echo $auto_number; ?>" class="bodytext3"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
                        <td align="left" valign="top" >
						<a href="edittaxsub1.php?st=edit&&anum=<?php echo $auto_number; ?>" class="bodytext3">
                          <div align="center" class="bodytext3">Edit</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3">
						<?php echo $taxsubname; ?> </td>
                        <td align="left" valign="top"  class="bodytext3">
						  <div align="right"><?php echo $taxsubpercent; ?> </div></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $taxparentname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $taxparentpercent; ?></span></div></td>
                      </tr>
                      <?php
		}
		?>
                      <tr>
                        <td align="middle" colspan="6" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                <table width="800" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="5" bgcolor="#CCCCCC" class="bodytext3"><strong>Tax Sub  Master - Deleted </strong></td>
                      </tr>
                      <tr bgcolor="#011E6A">
                        <td width="11%" bgcolor="#FFFFFF" class="bodytext3"><div align="center"><strong>Activate</strong></div></td>
                        <td width="28%" bgcolor="#FFFFFF" class="bodytext3"><strong>Tax Sub  Name </strong></td>
                        <td width="18%" bgcolor="#FFFFFF" class="bodytext3"><strong>Tax Sub  Percent % </strong></td>
                        <td width="24%" bgcolor="#FFFFFF" class="bodytext3"><strong>Parent Tax   Name </strong></td>
                        <td width="19%" bgcolor="#FFFFFF" class="bodytext3"><strong>Parent Tax   Percent % </strong></td>
                      </tr>
                      <?php
		
	    $query1 = "select * from master_taxsub where status = 'deleted' order by taxsubname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$taxsubname = $res1["taxsubname"];
		$auto_number = $res1["auto_number"];
		$taxsubpercent = $res1["taxsubpercent"];
		$taxparentname = $res1["taxparentname"];
		
		$query5 = "select * from master_tax where taxname = '$taxparentname'";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		$res5 = mysql_fetch_array($exec5);
		$taxparentpercent = $res5["taxpercent"];
		
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
                        <td align="left" valign="top" ><a class="bodytext3" href="addtaxsub1.php?st=activate&&anum=<?php echo $auto_number; ?>">
                          <div align="center" class="bodytext3">Activate</div>
                        </a></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $taxsubname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $taxsubpercent; ?></span></div></td>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $taxparentname; ?></td>
                        <td align="left" valign="top"  class="bodytext3"><div align="right"><span class="bodytext32"><?php echo $taxparentpercent; ?></span></div></td>
                      </tr>
                      <?php
		}
		?>
                      <tr>
                        <td align="middle" colspan="5" >&nbsp;</td>
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

