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
	$loopcount = $_REQUEST["loopcount"];
	for ($i=1;$i<=$loopcount;$i++)
	{
		$itemcode = $_REQUEST["itemcode".$i];
		$renewalmonths = $_REQUEST["renewalmonths".$i];
		
		$query3 = "select * from master_item where itemcode = '$itemcode'";
		$exec3 = mysql_query($query3) or die ("Error in  Query3".mysql_error());
		$res3 = mysql_fetch_array($exec3);
		$itemname = $res3["itemname"];
		
		$query2 = "select * from master_renewal where itemcode = '$itemcode'";// or itemname = '$itemname'";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_num_rows($exec2);
		if ($res2 == 0)
		{
			$query1 = "insert into master_renewal (itemcode, itemname, renewalmonths, ipaddress, updatetime) 
			values ('$itemcode', '$itemname', '$renewalmonths', '$ipaddress', '$updatedatetime')";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		}
		else
		{
			$query1 = "update master_renewal set renewalmonths = '$renewalmonths', ipaddress = '$ipaddress', 
			updatetime = '$updatedatetime' where itemcode = '$itemcode'";
			$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
			//$errmsg = "Failed. Item Code Already Exists.";
			//$bgcolorcode = 'failed';
		}
		$itemcode = '';
		$itemname = '';
		$renewalmonths  = '';
	}
	
	$errmsg = "Success. Item Renewal Updated.";
	$bgcolorcode = 'success';
	
}


if (isset($_REQUEST["searchflag1"])) { $searchflag1 = $_REQUEST["searchflag1"]; } else { $searchflag1 = ""; }
if (isset($_REQUEST["search1"])) { $search1 = $_REQUEST["search1"]; } else { $search1 = ""; }


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
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
.bodytext32 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
</head>
<script language="javascript">


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
              <td>
			  
			  
			  <form name="form1" id="form1" action="itemrenewal1.php" method="post">
                  <table width="950" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="8" bgcolor="#CCCCCC" class="bodytext3"><strong>Item Master - Existing List - Latest 100 Items </strong></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td colspan="7" bgcolor="#CCCCCC" class="bodytext3">
                            <input name="search1" type="text" id="search1" size="40" value="<?php echo $search1; ?>">
                            <input type="hidden" name="searchflag1" id="searchflag1" value="searchflag1">
                          <input type="submit" name="Submit2" value="Search" style="border: 1px solid #001E6A" /></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td colspan="7" bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3">
						<div align="left">
						<?php echo $errmsg; ?>
						</div></td>
                        </tr>
                      <tr bgcolor="#011E6A">
                        <td bgcolor="#CCCCCC" class="bodytext3"><strong> Code </strong></td>
                          <td width="17%" bgcolor="#CCCCCC" class="bodytext3"><strong>Category</strong></td>
                          <td width="37%" bgcolor="#CCCCCC" class="bodytext3"><strong>Item</strong></td>
                          <td width="5%" bgcolor="#CCCCCC" class="bodytext3"><strong>Unit</strong></td>
                          <td width="7%" bgcolor="#CCCCCC" class="bodytext3"><strong>Tax%</strong></td>
                          <td width="10%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Rate / Unit </strong></div></td>
                          <td width="13%" bgcolor="#CCCCCC" class="bodytext3"><div align="center"><strong>Renewal</strong></div></td>
                        </tr>
                      <?php
	  //$searchflag1 = $_REQUEST["searchflag1"];
	 // if ($searchflag1 == 'searchflag1')
	  //{
		
		$loopcount = 0;
		//$search1 = $_REQUEST["search1"];			  
	    $query1 = "select * from master_item where itemname like '%$search1%' and status <> 'deleted' order by categoryname ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$itemcode = $res1["itemcode"];
		$itemname = $res1["itemname"];
		$categoryname = $res1["categoryname"];
		$rateperunit = $res1["rateperunit"];
		$expiryperiod = $res1["expiryperiod"];
		$auto_number = $res1["auto_number"];
		$unitname_abbreviation = $res1["unitname_abbreviation"];
		$taxname = $res1["taxname"];
		$taxanum = $res1["taxanum"];
		if ($expiryperiod != '0') 
		{ 
			$expiryperiod = $expiryperiod.' Months'; 
		}
		else
		{
			$expiryperiod = ''; 
		}
		
		$query6 = "select * from master_tax where auto_number = '$taxanum'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$res6 = mysql_fetch_array($exec6);
		$res6taxpercent = $res6["taxpercent"];
		
		$loopcount = $loopcount + 1;
			$showcolor = ($loopcount & 1); 
			if ($showcolor == 0)
			{
				//echo "if";
				$colorcode = 'bgcolor="#CBDBFA"';
			}
			else
			{
				//echo "else";
				$colorcode = 'bgcolor="#D3EEB7"';
			}
		
		?>
                      <tr <?php echo $colorcode; ?>>
                        <td align="left" valign="top"  class="bodytext3"><?php echo $itemcode; ?> </td>
                        <td valign="top" align="left"  class="bodytext3"><?php echo $categoryname; ?> </td>
                          <td align="left" valign="top"  class="bodytext3"><?php echo $itemname; ?> </td>
                          <td align="left" valign="top"  class="bodytext3"><?php echo $unitname_abbreviation; ?> </td>
                          <td align="left" valign="top"  class="bodytext3"><?php echo $res6taxpercent; ?> </td>
                          <td valign="top" align="left"  class="bodytext3"><div align="right"><?php echo $rateperunit; ?></div></td>
                          <td align="left" valign="top"  class="bodytext3">
						  <select name="renewalmonths<?php echo $loopcount; ?>" id="renewalmonths<?php echo $loopcount; ?>">
						  <?php
						  $query7 = "select * from master_renewal where itemcode = '$itemcode'";
						  $exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
						  $res7 = mysql_fetch_array($exec7);
						  $res7renewalmonths = $res7["renewalmonths"];
							if ($res7renewalmonths != 0)
							{
							?>
							<option value="<?php echo $res7renewalmonths; ?>" selected="selected"><?php echo $res7renewalmonths; ?> Months</option>
							<?php
							}
							else
							{
							?>
							<option value="0" selected="selected">0 Months</option>
							<?php
							}
							
							for ($i=0;$i<=60;$i++)
							{
							?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?> Months</option>
							<?php
							}
							?>
                          </select>						  
							<input name="itemcode<?php echo $loopcount; ?>" id="itemcode<?php echo $loopcount; ?>" type="hidden" value="<?php echo $itemcode; ?>">						  </td>
                        </tr>
                      <?php
		}
		?>
                      <tr>
                        <td align="middle" colspan="8" >&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="8" ><div align="right"><span class="bodytext32">
                          <input type="submit" name="Submit22" value="Save Renewal Changes" style="border: 1px solid #001E6A" />
							<input type="hidden" name="loopcount" id="loopcount" value="<?php echo $loopcount; ?>">
							<input type="hidden" name="frmflag1" id="frmflag1" value="frmflag1">
                        </span></div></td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="8" >&nbsp;</td>
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

