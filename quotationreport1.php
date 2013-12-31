<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$updatedatetime = date('Y-m-d H:i:s');
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];

$quotedatefrom = date('Y-m-d', strtotime('-1 month'));
$quotedateto = date('Y-m-d');

$cbcustomername = '';
$cbbillnumber = '';
$cbbillstatus = '';
$customername = '';
$paymenttype = '';
$billstatus = '';
$res2loopcount = '';
$custid = '';
$custname = '';
$colorloopcount = '';


if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	$cbcustomername = $_REQUEST['cbcustomername'];
	$customername = $_REQUEST['cbcustomername'];
	$quotedatefrom = $_REQUEST['ADate1'];
	$quotedateto = $_REQUEST['ADate2'];
	
	if (isset($_REQUEST["billstatus"])) { $billstatus = $_REQUEST["billstatus"]; } else { $billstatus = ""; }
	//$billstatus = $_REQUEST['billstatus'];

}
/*			$dotarray = explode("-", $quotedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
*/

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
<script language="javascript">

function cbcustomername1()
{
	document.cbform1.submit();
}

</script>
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

function loadprintpage1(qanum)
{
	var varqanum = qanum;
	//alert (varqanum);
	window.open("print_quotation1.php?qanum="+varqanum+"","Window"+varqanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}


function loadpdfpage1(qanum)
{
	//alert ("Please Wait Few Seconds. The PDF File is being created. Do Not Close Popup Window.");
	var varqanum = qanum;
	//alert (varqanum);
	window.open("mailquotation1.php?qanum="+varqanum+"","Window1q","menubar=no,width=450,height=450,toolbar=no,scrollbars=yes,status=yes,left=100,top=100");
	//window.open("print_bill1.php?banum="+varbanum+"","Window"+varbanum+"",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
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

function funcDeleteQuotation1(varQuotationSerialNumber)
{
	var varQuotationSerialNumber = varQuotationSerialNumber;
	var fRet;
	fRet = confirm('Are you sure want to delete this Quotation entry number '+varQuotationSerialNumber+'?');
	//alert(fRet);
	if (fRet == true)
	{
		alert ("Quotation Entry Delete Completed.");
		//return false;
	}
	if (fRet == false)
	{
		alert ("Quotation Entry Delete Not Completed.");
		return false;
	}
	//return false;
}

</script>

<script src="js/datetimepicker_css.js"></script>

<body>
<table width="1020" border="0" cellspacing="0" cellpadding="2">
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
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="99%" valign="top"><table width="102%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="860">
		
              <form name="cbform1" method="post" action="quotationreport1.php">
		<table width="81%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Quotation Report     - Select Customer </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">&nbsp;</td>
            </tr>
            <!--<tr bordercolor="#000000" >
                  <td  align="left" valign="middle"  class="bodytext3"  colspan="4"><strong>Registration</strong></font></div></td>
                </tr>-->
            <!--<tr>
                  <tr  bordercolor="#000000" >
                  <td  align="left" valign="top"  class="bodytext3" colspan="4"><div align="right">* Indicates Mandatory</div></td>
                </tr>-->
            <tr>
                <td width="14%"  align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Select Customer </td>
                <td align="left" valign="top"  bgcolor="#FFFFFF">
				<input value="<?php echo $cbcustomername; ?>" name="cbcustomername" type="text" id="cbcustomername" size="50" style="border: 1px solid #001E6A"></td>
                <td align="left" valign="middle"  bgcolor="#FFFFFF"><span class="bodytext3">Bill Status </span></td>
                <td align="left" valign="top"  bgcolor="#FFFFFF">
				<select name="billstatus" id="billstatus">
                  <?php
				if ($billstatus == 'CONFIRMED')
				{
				?>
                  <option value="CONFIRMED" selected="selected">SHOW CONFIRMED</option>
                  <?php
				}
				else if ($billstatus == 'DELETED')
				{
				?>
                  <option value="DELETED" selected="selected">SHOW DELETED</option>
                  <?php
				}
				?>
                  <option value="CONFIRMED">SHOW CONFIRMED</option>
                  <option value="DELETED">SHOW DELETED</option>
                </select></td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#FFFFFF"> Date From </td>
              <td width="42%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31">
			  <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $quotedatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
				<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>				</td>
              <td width="11%" align="left" valign="center"  bgcolor="#FFFFFF" class="bodytext31"> Date To </td>
              <td width="33%" align="left" valign="center"  bgcolor="#FFFFFF"><span class="bodytext31">
                <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $quotedateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
              <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
			  </span></td>
              </tr>
            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF">
                <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
			  <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
			  <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" /></td>
            </tr>
          </tbody>
        </table>
              </form>		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="975" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td colspan="4" bgcolor="#cccccc" class="bodytext31">
			  <?php
				if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
				//$cbfrmflag1 = $_REQUEST['cbfrmflag1'];
				if ($cbfrmflag1 == 'cbfrmflag1')
				{
					$cbcustomername = $_REQUEST['cbcustomername'];
					$customername = $_REQUEST['cbcustomername'];
					
					if (isset($_REQUEST["cbbillnumber"])) { $cbbillnumber = $_REQUEST["cbbillnumber"]; } else { $cbbillnumber = ""; }
					//$cbbillnumber = $_REQUEST['cbbillnumber'];
					if (isset($_REQUEST["cbbillstatus"])) { $cbbillstatus = $_REQUEST["cbbillstatus"]; } else { $cbbillstatus = ""; }
					//$cbbillstatus = $_REQUEST['cbbillstatus'];
					
					$transactiondatefrom = $_REQUEST['ADate1'];
					$transactiondateto = $_REQUEST['ADate2'];
					
					if (isset($_REQUEST["paymenttype"])) { $paymenttype = $_REQUEST["paymenttype"]; } else { $paymenttype = ""; }
					//$paymenttype = $_REQUEST['paymenttype'];
					if (isset($_REQUEST["billstatus"])) { $billstatus = $_REQUEST["billstatus"]; } else { $billstatus = ""; }
					//$billstatus = $_REQUEST['billstatus'];
					
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$quotedatefrom&&ADate2=$quotedateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				else
				{
					$urlpath = "cbcustomername=$cbcustomername&&cbbillnumber=$cbbillnumber&&cbbillstatus=$cbbillstatus&&ADate1=$quotedatefrom&&ADate2=$quotedateto&&username=$username&&financialyear=$financialyear&&companyanum=$companyanum";//&&companyname=$companyname";
				}
				?>
 				<?php
				//For excel file creation.
				
				$applocation1 = $applocation1; //Value from db_connect.php file giving application path.
				$filename1 = "print_quotationreport1.php?$urlpath";
				$fileurl = $applocation1."/".$filename1;
				$filecontent1 = @file_get_contents($fileurl);
				
				$indiatimecheck = date('d-M-Y-H-i-s');
				$foldername = "dbexcelfiles";
				$fp = fopen($foldername.'/QuotationReport.xls', 'w+');
				fwrite($fp, $filecontent1);
				fclose($fp);

				?>
                <script language="javascript">
				function printbillreport1()
				{
					window.open("print_quotationreport1.php?<?php echo $urlpath; ?>","Window1",'width=900,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
					//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
				}
				function printbillreport2()
				{
					window.location = "dbexcelfiles/QuotationReport.xls"
				}
				</script>
                <input value="Print Report" onClick="javascript:printbillreport1()" name="resetbutton2" type="submit" id="resetbutton2"  style="border: 1px solid #001E6A" />
&nbsp;				<input value="Export Excel" onClick="javascript:printbillreport2()" name="resetbutton22" type="button" id="resetbutton22"  style="border: 1px solid #001E6A" />
</td>
              <td width="7%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="4%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td width="4%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="center"><strong>View</strong></div></td>
              <td width="5%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Quote</strong></div></td>
              <td width="10%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong>Date </strong></div></td>
              <!--<td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="center"><strong>PDF</strong></div></td>-->
              <td width="37%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><div align="left"><strong> Customer </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>SubTotal </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Tax</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Packing</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Delivery</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>RoundOff</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Total</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="center"><strong>Edit </strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Delete</strong></div></td>
            </tr>
			<?php
			$snocount = '';
			
			$dotarray = explode("-", $quotedateto);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedateto = date("Y-m-d", mktime(0, 0, 0, $dotmonth, $dotday + 1, $dotyear));
			
			if ($billstatus == 'CONFIRMED')
			{
				$billstatusquery1 = " status <> 'deleted' ";
			}
			else if ($billstatus == '')
			{
				$billstatusquery1 = " status <> 'deleted' ";
			}
			else
			{
				$billstatusquery1 = " status = 'deleted' ";
			}		

			$query2 = "select * from master_quotation where customername like '%$customername%' and $billstatusquery1 and 
			quotationdate between '$quotedatefrom' and '$quotedateto' order by quotationnumber desc";
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2loopcount = $res2loopcount + 1;
			$customername = $res2['customername'];
			$city = $res2['city'];
			$contact = $res2['contactperson1'];
			if ($res2['contactperson2'] != '')  $contact = $contact.', '.$res2['contactperson2'];
			if ($res2['contactperson3'] != '')  $contact = $contact.', '.$res2['contactperson3'];
			$quotenumber1 = $res2['quotationnumberprefix'];
			$quotenumber2 = $res2['quotationnumber'];
			$res2quotationnumber = $res2['quotationnumber'];
			if ($quotenumber1 != '') $quotenumber2 = $quotenumber1.'-'.$quotenumber2;
			$quotedate = $res2['updatedate'];
			//$quotedate = substr($quotedate, 0, 11);
			$res2anum = $res2['auto_number'];
			//$paymentdate = $res2['paymententrydate'];
			//$paymentdate = substr($paymentdate, 0, 11);
			//$paymentmode = $res2['paymentmode'];
			//$chequenumber = $res2['chequenumber'];
			$status = strtoupper($res2['status']);
			
			$subtotal = $res2['subtotal'];
			$totalaftertax = $res2['totalaftertax'];
			$totaltax = $totalaftertax - $subtotal;
			$totaltax = number_format($totaltax, 2, '.', '');
			$roundoff = $res2['roundoff'];
			$totalamount = $res2['totalamount'];
			$packaging = $res2['packaging'];
			$delivery = $res2['transportation'];
			
			$quotedate = substr($quotedate, 0, 10);
			$dotarray = explode("-", $quotedate);
			$dotyear = $dotarray[0];
			$dotmonth = $dotarray[1];
			$dotday = $dotarray[2];
			$quotedate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
			
			$colorloopcount = $colorloopcount + 1;
			$showcolor = ($colorloopcount & 1); 
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

			$snocount = $snocount + 1;
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left"><?php echo $res2loopcount; ?></td>
              <td class="bodytext31" valign="center"  align="left"><div align="center">
			  <a href="javascript:loadprintpage1(<?php echo $res2anum; ?>)" class="bodytext3"> <span class="bodytext3">View</span></a>
			  <a href="javascript:loadprintpage1(<?php echo $res2anum; ?>)" class="bodytext3"></a></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php echo $quotenumber2; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left"> 
			  <?php echo substr($quotedate, 0, 10); ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
                <div class="bodytext31">
                  <div align="left"><?php echo $customername; ?></div>
                </div>              </td>
              <td class="bodytext31" valign="center"  align="left"> <div align="right">
			  <?php if ($subtotal != '0.00') echo $subtotal; //echo $subtotal; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left">
			    <div align="right">
				<?php if ($totaltax != '0.00') echo $totaltax; //echo $totaltax; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php if ($packaging != '0.00') echo $packaging; //echo $packaging; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php if ($delivery != '0.00') echo $delivery; //echo $delivery; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"> <div align="right">
			  <?php if ($roundoff != '0.00') echo $roundoff; //echo $roundoff; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="right"> 
			  <?php if ($totalamount != '0.00') echo $totalamount; //echo $totalamount; ?>&nbsp;</div></td>
              <td class="bodytext31" valign="center"  align="left">
              <?php
			  if ($billstatus != 'DELETED')
			  {
			  ?>
				<div align="center">
				<a href="quotation1.php?delbillst=billedit&&delbillautonumber=<?php echo $res2anum; ?>&&delbillnumber=<?php echo $res2quotationnumber; ?>" class="bodytext3" target="_blank">
				<span class="bodytext3">Edit</span>
				</a>              
				</div>	
			<?php
			}
			?>
				  </td>
               <td class="bodytext31" valign="center"  align="left"><div align="center"> 
             <?php
			  if ($billstatus != 'DELETED')
			  {
			  ?>
			  <a href="quotationdelete1.php?task=delete&&anum=<?php echo $res2anum; ?>" class="bodytext3" onClick="return funcDeleteQuotation1(<?php echo $res2quotationnumber;?>)"> <img src="images/b_drop.png" width="16" height="16" border="0"> </a> </div>
			<?php
			}
			?>
			  </td>
            </tr>
			<?php
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
        </table></td>
      </tr>
    </table>
  </table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>

