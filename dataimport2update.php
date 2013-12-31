<?php
session_start();
set_time_limit(0);
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION['username'];
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

if (isset($_REQUEST["upload"])) { $upload = $_REQUEST["upload"]; } else { $upload = ""; }
//$upload = $_REQUEST['upload'];
if ($upload == 'success')
{

	$importstarted = date("d-M-Y H:i:s");

	$skipcountservice = 0;
	$skipcountcategory = 0;
	$skipcounttax = 0;
	$skipcountunit = 0;
	$successcount = 0;
	$forloopcount = 0;
	$foldername = "tab_file_dump/";
	$filename = $username."_tabdump.txt";
	$filepath = $foldername.$filename;
	$fd = fopen ($filepath, "r");
	$fullcontents = fread ($fd,filesize ($filepath));
	fclose ($fd); 
	
	$linebreak = "\n"; //for line breaks
	$linecounter = 0;
	$splitcontents = explode($linebreak, $fullcontents);
	//print_r($splitcontents);
	$totallinecount = count($splitcontents);
	//echo "<br>";
	
	foreach ( $splitcontents as $linecontent )
	{
		$forloopcount = $forloopcount + 1;
		//echo "<br>";
		if ($forloopcount > 1 && $forloopcount < $totallinecount) // to skip header row. to skip last empty row to avoid empty array error.
		{
			//echo "<br><br>";
			$linecounter = $linecounter + 1;
			$linecontent; //contains the text of each line.
			
			$delimiter = "\t"; // for tab delimit breaks
			$delimitercount = 0;
			$splitdelimiter = explode($delimiter, $linecontent);
			//echo count($splitdelimiter);
			$serialnumber = $splitdelimiter[0];
			$itemcode = $splitdelimiter[1];
			$itemname = $splitdelimiter[2];
			//echo "<br>";
			$purchaseprice = $splitdelimiter[3];
			$itemrate = $splitdelimiter[4];
			$itemunit = $splitdelimiter[5];
			$categoryname = $splitdelimiter[6];
			$taxpercent = $splitdelimiter[7];
			 
			$serialnumber = trim($serialnumber);
			$itemcode = trim($itemcode);
			$itemname = trim($itemname);

			//$itemname = ereg_replace("[^A-Za-z0-9%_ -]", " ", $itemname);
			preg_match ('/[!,^,+,=,[,],;,,,{,},|,\,<,>,?,~]/', $itemname);
			
			$itemrate = trim($itemrate);
			$itemunit = trim($itemunit);
			$categoryname = trim($categoryname);
			
			if ($categoryname != '')
			{
				$query3 = "select * from master_category where categoryname = '$categoryname'";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				$rowcount3 = mysql_num_rows($exec3);
				if ($rowcount3 != 0)
				{
					$query1 = "select * from master_item where itemcode = '$itemcode'";
					$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
					$rowcount1 = mysql_num_rows($exec1);
					if ($rowcount1 != 0) //item already exists
					{
						$query4 = "select * from master_tax where taxpercent = '$taxpercent'";// and status = ''";
						$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
						$rowcount4 = mysql_num_rows($exec4);
						if ($rowcount4 == 0)
						{
							$skipcounttax = $skipcounttax + 1;
						}
						else
						{
							$query5 = "select * from master_units where unitname_abbreviation = '$itemunit'";
							$exec5 = mysql_query($query4) or die ("Error in Query5".mysql_error());
							$rowcount5 = mysql_num_rows($exec5);
							if ($rowcount5 != 0)
							{
								$res4 = mysql_fetch_array($exec4);
								$taxanum = $res4['auto_number'];
								$taxname = $res4['taxname'];
								
								$query2 = "update master_item set itemname = '$itemname', categoryname = '$categoryname', 
								unitname_abbreviation = '$itemunit', rateperunit = '$itemrate', ipaddress = '$ipaddress', 
								updatetime = '$updatedatetime', taxanum = '$taxanum', taxname = '$taxname', purchaseprice = '$purchaseprice'  
								where itemcode = '$itemcode'";
								$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
								$successcount = $successcount + 1;
							}
							else
							{
								$skipcountunit = $skipcountunit + 1;
							}
						}
					}
					else
					{
						$skipcountservice = $skipcountservice + 1;
					}
				}
				else
				{
					$skipcountcategory = $skipcountcategory + 1;
					$chummacount = $chummacount + 1;
				}
			}
		}
		//echo "<br><br>";
	}

	$importfinished = date("d-M-Y H:i:s");

}


//echo "<br>cc".$skipcountcategory;
//echo "<br>cs".$skipcountservice;
//echo "<br>cu".$skipcountunit;
//echo "<br>sc".$successcount;

$errmsg = "Please See The Import Details Below.";
$bgcolorcode = "failed";

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
                  <table width="83%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                    <tbody>
                      <tr bgcolor="#011E6A">
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Item / Services Data Import From TAB Delimited File </strong></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="left" valign="middle"   bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3"><div align="left"><?php echo $errmsg; ?></div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Import Start Time </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF"  class="bodytext3"><?php echo $importstarted; ?></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Records Found </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $totallinecount = $totallinecount - 1; ?><span class="bodytext3"> (Including Header Line) (Header Line Will Not Be Imported) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Category Name </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountcategory; ?> <span class="bodytext3">(Please Check The Category Name Exists In The Category Masters) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Item Code </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountservice; ?> <span class="bodytext3">(Please Check If You Are Trying To Import Already Existing Item Code) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Unit Abbreviation </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountunit; ?> <span class="bodytext3">(Please Check The Unit Abbreviation Exists In The Unit Masters) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Tax Percent </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcounttax; ?> <span class="bodytext3">(Please Check The Tax Percent Exists In The Tax Masters) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Error Count </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $totalerrorcount = $skipcountcategory + $skipcountservice + $skipcountunit + $skipcounttax; ?></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Update Count </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $successcount; ?> <span class="bodytext3">(Header Line Not Included.) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Import Finish Time </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF"  class="bodytext3"><?php echo $importfinished; ?></td>
                      </tr>
                      <tr>
                        <td width="28%" align="left" valign="top"  class="bodytext3">&nbsp;</td>
                        <td valign="top" align="left" width="72%" >&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="middle" colspan="2" >&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
				  <br>
				  <br>
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

