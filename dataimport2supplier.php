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
	
	$skipcountsuppliercode = 0;
	$skipcountsuppliername = 0;
	$skipcountaddress1 = 0;
	$skipcountaddress2 = 0;
	$skipcountarea = 0;
	$skipcountcity = 0;
	$skipcountstate = 0;
	$skipcountpincode = 0;
	
	$successcount = 0;
	$forloopcount = 0;
	
	$foldername = "tab_file_dump/";
	$filename = $username."_tabdumpsupplier.txt";
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
			//print_r($splitdelimiter);
			$serialnumber = $splitdelimiter[0];
			$suppliercode = $splitdelimiter[1];
			$suppliername = $splitdelimiter[2];
			//echo "<br>";
			$address1 = $splitdelimiter[3];
			$address2 = $splitdelimiter[4];
			$area = $splitdelimiter[5];
			$city = $splitdelimiter[6];
			$pincode = $splitdelimiter[7];
			$state = $splitdelimiter[8];
			 
			$serialnumber = trim($serialnumber);
			$suppliercode = trim($suppliercode);
			$suppliername = trim($suppliername);
			$address1 = trim($address1);
			$address2 = trim($address2);
			$area = trim($area);
			$city = trim($city);
			$pincode = trim($pincode);
			$state = trim($state);

			$suppliercode = addslashes($suppliercode);
			$suppliername = addslashes($suppliername);
			$address1 = addslashes($address1);
			$address2 = addslashes ($address2);
			$area = addslashes($area);
			$city = addslashes($city);
			$pincode = addslashes($pincode);
			$state = addslashes($state);
			
			/*		
			$customercode = preg_replace('/[^a-zA-Z0-9\']/', ' ', $customercode);
			$customercode = str_replace("'", '', $customercode);
			$customername = preg_replace('/[^a-zA-Z0-9\']/', ' ', $customername);
			$customername = str_replace("'", '', $customername);
			$address1 = preg_replace('/[^a-zA-Z0-9\']/', ' ', $address1);
			$address1 = str_replace("'", '', $address1);
			$address2 = preg_replace('/[^a-zA-Z0-9\']/', ' ', $address2);
			$address2 = str_replace("'", '', $address2);
			$area = preg_replace('/[^a-zA-Z0-9\']/', ' ', $area);
			$area = str_replace("'", '', $area);
			$city = preg_replace('/[^a-zA-Z0-9\']/', ' ', $city);
			$city = str_replace("'", '', $city);
			$pincode = preg_replace('/[^a-zA-Z0-9\']/', ' ', $pincode);
			$pincode = str_replace("'", '', $pincode);
			$state = preg_replace('/[^a-zA-Z0-9\']/', ' ', $state);
			$state = str_replace("'", '', $state);
			*/

			$suppliercode = str_replace('\"\"', '"', $suppliercode); //To replace MS Excel given double quote to string.
			$suppliercode = str_replace('\"', '', $suppliercode); //To retain origina single char double quote and remeove Excel quote.
			$suppliername = str_replace('\"\"', '"', $suppliername); 
			$suppliername = str_replace('\"', '', $suppliername); 
			$address1 = str_replace('\"\"', '"', $address1); 
			$address1 = str_replace('\"', '', $address1); 
			$address2 = str_replace('\"\"', '"', $address2); 
			$address2 = str_replace('\"', '', $address2); 
			$area = str_replace('\"\"', '"', $area); 
			$area = str_replace('\"', '', $area); 
			$city = str_replace('\"\"', '"', $city); 
			$city = str_replace('\"', '', $city); 
			$pincode = str_replace('\"\"', '"', $pincode); 
			$pincode = str_replace('\"', '', $pincode); 
			$state = str_replace('\"\"', '"', $state); 
			$state = str_replace('\"', '', $state); 
			
			$suppliercode = preg_replace('/[^a-zA-Z0-9\']/', ' ', $suppliercode);
			$suppliercode = str_replace("'", '', $suppliercode);
			$suppliername = preg_replace('/[^a-zA-Z0-9\']/', ' ', $suppliername);
			$suppliername = str_replace("'", '', $suppliername);
									
			if ($suppliercode != '')
			{
				$query1 = "select * from master_supplier where suppliercode = '$suppliercode'";
				$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
				$rowcount1 = mysql_num_rows($exec1);
				if ($rowcount1 != 0)
				{
					$skipcountsuppliercode = $skipcountsuppliercode + 1;
				}
				else
				{
					$strlensuppliercode = strlen($suppliercode);
					$startingcharacters = substr($suppliercode, 0, 3);
					if ($strlensuppliercode != 11)
					{
						$skipcountsuppliercode = $skipcountsuppliercode + 1;
					}
					else 
					{
						if ($startingcharacters != 'SUP')
						{
							$skipcountsuppliercode = $skipcountsuppliercode + 1;
						}
						else
						{
							if ($suppliername == '')
							{
								$skipcountsuppliername = $skipcountsuppliername + 1;
							}
							else
							{
								if ($address1 == '')
								{
									$skipcountaddress1 = $skipcountaddress1 + 1;
								}
								else
								{
									//if ($address2 == '')
									//{
										//$skipcountaddress2 = $skipcountaddress2 + 1;
									//}
									//else
									//{
										if ($area == '')
										{
											$skipcountarea = $skipcountarea + 1;
										}
										else
										{
											if ($city == '')
											{
												$skipcountcity = $skipcountcity + 1;
											}
											else
											{
												if ($state == '')
												{
													$skipcountstate = $skipcountstate + 1;
												}
												else
												{
													if ($pincode == '')
													{
														$skipcountpincode = $skipcountpincode + 1;
													}
													else
													{
														$query2 = "insert into master_supplier (suppliercode, suppliername, address1, address2, area, city, state,	pincode) 
														values ('$suppliercode', '$suppliername', '$address1', '$address2', '$area', '$city', '$state', '$pincode')";
														$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
														//echo "<br><br>";
														$successcount = $successcount + 1;
														
													} //For Pincode
												} //For State
											} //For City
										} //For Area
									//} //For Address2
								} //For Address1
							} //For Supplier Name
						} //For Supplier Code Starting Character
					} //For Supplier Code Length
				} //For Supplier Code
			} //For Supplier Code Not Empty

		} //For Loop Count.
		//echo "<br><br>";
	} //For For Each

	$importfinished = date("d-M-Y H:i:s");

}

$totalerrorcount = $skipcountsuppliercode + $skipcountsuppliername + $skipcountaddress1 + $skipcountaddress2 + $skipcountarea + $skipcountcity + $skipcountstate + $skipcountpincode;

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
                        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Supplier Data Import From TAB Delimited File </strong></td>
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
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $totallinecount = $totallinecount - 1; ?><span class="bodytext3"> ( Including Header Line) (Header Line Will Not Be Imported ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Supplier Code</td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountsuppliercode; ?> <span class="bodytext3">( Please Check The Supplier Code Exists In The Supplier Masters. Code Format SUP00000001) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Supplier Name </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountsuppliername; ?> <span class="bodytext3">( Please Make Sure You Do Not Have Any Special Characters In Supplier Name ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Address 1 </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountaddress1; ?> <span class="bodytext3">( Please Make Sure You Do Not Have Any Special Characters In Address 1 ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Address 2 </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountaddress2; ?> <span class="bodytext3">( Please Make Sure You Do Not Have Any Special Characters In Address 2  ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Area </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountarea; ?> <span class="bodytext3">( Please Make Sure You Do Not Have Any Special Characters In Area ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With City </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountcity; ?><span class="bodytext3"> ( Please Make Sure You Do Not Have Any Special Characters In City ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With State </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountstate; ?><span class="bodytext3"> ( Please Make Sure You Do Not Have Any Special Characters In State ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Error With Pincode </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $skipcountpincode; ?><span class="bodytext3"> ( Please Make Sure You Do Not Have Any Special Characters In Pincode ) </span></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Error Count </td>
                        <td align="left" valign="top" bgcolor="#FFFFFF" ><?php echo $totalerrorcount; ?></td>
                      </tr>
                      <tr>
                        <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Total Import Count </td>
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

