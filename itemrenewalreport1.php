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

$billdatefrom = date('Y-m-d', strtotime('-1 month'));
$billdateto = date('Y-m-d');

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{
	$billdatefrom = $_REQUEST['ADate1'];
	$billdateto = $_REQUEST['ADate2'];
}

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
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function loadprintpage1(banum)
{
	var varbanum = banum;
	//alert (varqanum);
	window.open("print_bill1.php?billautonumber="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}
function funcRedirectWindow1()
{
	window.location = "billreport1.php";
}


</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1015" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td colspan="9" bgcolor="#6487DC"><?php include ("includes/alertmessages1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#8CAAE6"><?php include ("includes/title1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9" bgcolor="#003399"><?php include ("includes/menu1.php"); ?></td>
  </tr>
  <tr>
    <td colspan="9"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="99%" valign="top"><table width="1010" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
              <form name="cbform1" method="get" action="itemrenewalreport1.php">
		<table width="867" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Renewal Report</strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td colspan="3" bgcolor="#CCCCCC" class="bodytext3">&nbsp;</td>
            </tr>
            <tr>
              <td width="92" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date From </td>
              <td width="130" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $billdatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>
			  </span></td>
              <td width="97" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
              <td width="153" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $billdateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
			  </span></td>
              <td width="343" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"><input type="hidden" name="cbfrmflag12" value="cbfrmflag1">
                <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
                <input onClick="return funcRedirectWindow1()" name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            </tr>
          </tbody>
        </table>
              </form>		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		
		<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="934" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="13%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="17%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
			  <td width="11%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="23%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="9%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="15%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bill No. </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Bill Date </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong> Customer </strong></td>
			  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Item Code </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Item Name </strong></div></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Renewal  </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Renewal Date </strong></td>
              </tr>
				<?php
				$serialnumber = 0;
				
				//To go behind one year.
				$dotarray = explode("-", $billdatefrom);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$billdatefrom = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear - 1));

				//To go behind one year.
				$dotarray = explode("-", $billdateto);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$billdateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear - 1));
				
				$query2 = "select * from master_sales where companyanum = '$companyanum' and 
				billdate between '$billdatefrom' and '$billdateto' order by billnumber desc";
				$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
				while ($res2 = mysql_fetch_array($exec2))
				{
				$billautonumber = $res2['auto_number'];
				$customername = $res2['customername'];
				$billnumber = $res2['billnumber'];
				$billdate = $res2['billdate'];
				$billdate = substr($billdate, 0, 10);
				
				$query3 = "select * from sales_details where bill_autonumber = '$billautonumber'";
				$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
				while ($res3 = mysql_fetch_array($exec3))
				{
				$itemcode = $res3['itemcode'];
				$itemname = $res3['itemname'];
				
				$query4 = "select * from master_renewal where itemcode = '$itemcode'";
				$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
				$res4 = mysql_fetch_array($exec4);
				$renewalmonths = $res4['renewalmonths'];

				$currentdate = date('Y-m-d');
				$date_diff = strtotime($currentdate) - strtotime($billdate);
				$monthsdifference = floor(($date_diff)/2628000);
				
				if ($monthsdifference == $renewalmonths)
				{
				
				$dotarray = explode("-", $billdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$renewaldate = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear + 1));

				$serialnumber = $serialnumber + 1;
				$showcolor = ($serialnumber & 1); 
				if ($showcolor == 0)
				{
					$colorcode = 'bgcolor="#CBDBFA"';
				}
				else
				{
					$colorcode = 'bgcolor="#D3EEB7"';
				}
				
			
				$billdate = substr($billdate, 0, 10);
				$dotarray = explode("-", $billdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$billdate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));

				?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $serialnumber; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $billnumber; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $billdate; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $customername; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $itemcode; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $itemname; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $renewalmonths.' Months'; ?></td>
              <td class="bodytext31" valign="center"  align="left"><?php echo $renewaldate; ?></td>
            </tr>
				<?php
				}
				}
				}
				?>
                <tr>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
				bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                  <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc">&nbsp;</td>
                </tr>
          </tbody>
        </table>		</td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

