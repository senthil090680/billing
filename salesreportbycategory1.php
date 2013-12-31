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
$errmsg = '';
$colorloopcount = '';
$sno = '';
$stockdate = '';
$transactionparticular = '';
$stockremarks = '';

$totalsalestotalrate = '0.00';
$totalsalesreturntotalrate = '0.00';
$totalpurchasetotalrate = '0.00';
$totalpurchasereturntotalrate = '0.00';
$totaltotalrate = '0.00';
//$transactiondatefrom = date('Y-m-d', strtotime('-1 week'));
$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
$transactiondateto = date('Y-m-d');

	
if (isset($_REQUEST["ADate1"])) { $ADate1 = $_REQUEST["ADate1"]; } else { $ADate1 = ""; }
if (isset($_REQUEST["ADate2"])) { $ADate2 = $_REQUEST["ADate2"]; } else { $ADate2 = ""; }
if ($ADate1 != '' && $ADate2 != '')
{
	$transactiondatefrom = $_REQUEST['ADate1'];
	$transactiondateto = $_REQUEST['ADate2'];
}
else
{
	//$transactiondatefrom = date('Y-m-d', strtotime('-1 week'));
	$transactiondatefrom = date('Y-m-d', strtotime('-1 month'));
	$transactiondateto = date('Y-m-d');
}

if (isset($_REQUEST["itemcode"])) { $itemcode = $_REQUEST["itemcode"]; } else { $itemcode = ""; }
//$itemcode = $_REQUEST['itemcode'];
if (isset($_REQUEST["servicename"])) { $servicename = $_REQUEST["servicename"]; } else { $servicename = ""; }
//$servicename = $_REQUEST['servicename'];

if ($servicename == '') $servicename = 'ALL';

if (isset($_REQUEST["searchoption1"])) { $searchoption1 = $_REQUEST["searchoption1"]; } else { $searchoption1 = ""; }
//$searchoption1 = $_REQUEST['searchoption1'];


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
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
.style1 {FONT-WEIGHT: bold; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma; }
-->
</style>
</head>
<script language="javascript">

</script>
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />        
<script type="text/javascript">


function process1()
{
	if (document.stockinward.categoryname.value == "")
	{
		alert ("Please Select Category Name.")
		return false;
	}
	if (document.stockinward.searchoption1.value == "")
	{
		alert ("Please Select Search Option.")
		return false;
	}
}


function itemcodeentry2()
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
		//itemcodeentry1();
		return false;
	}
	else
	{
		return true;
	}
}




</script>

<script src="js/datetimepicker_css.js"></script>

<body <?php //echo $loadprintpage; ?>>
<table width="103%" border="0" cellspacing="0" cellpadding="2">
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
    <td width="1%" rowspan="3">&nbsp;</td>
    <td valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		
		
			<form name="stockinward" action="salesreportbycategory1.php" method="post" onKeyDown="return disableEnterKey()" onSubmit="return process1()">
	<table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="791" 
            align="left" border="0">
      <tbody id="foo">
        <tr>
          <td colspan="5" bgcolor="#cccccc" class="bodytext31"><strong>Sales By Category  - Report </strong></td>
          </tr>
        <tr>
          <td colspan="5" align="left" valign="center"  
                 bgcolor="<?php if ($errmsg == '') { echo '#FFFFFF'; } else { echo '#FFCC99'; } ?>" class="bodytext31"><?php echo $errmsg; ?>&nbsp;</td>
          </tr>
        <script language="javascript">

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


function process1rateperunit()
{
	servicenameonchange1();
}


function deleterecord1(varEntryNumber,varAutoNumber)
{
	var varEntryNumber = varEntryNumber;
	var varAutoNumber = varAutoNumber;
	var fRet;
	fRet = confirm('Are you sure want to delete the stock entry no. '+varEntryNumber+' ?');
	//alert(fRet);
	if (fRet == false)
	{
		alert ("Stock Entry Delete Not Completed.");
		return false;
	}
	else
	{
		window.location="stockreport2.php?task=del&&delanum="+varAutoNumber;		
	}
}


</script>
        <tr>
          <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Category  </strong></td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
			<select name="categoryname" id="categoryname">
				<?php
				$categoryname = $_REQUEST['categoryname'];
				if ($categoryname != '')
				{
				?>
				<option value="<?php echo $categoryname; ?>" selected="selected"><?php echo $categoryname; ?></option>
				<?php
				}
				else
				{
				?>
				<option selected="selected" value="">Select Category</option>
				<?php
				}
				?>
				<?php
				$query42 = "select * from master_category where status = '' order by categoryname";
				$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
				while ($res42 = mysql_fetch_array($exec42))
				{
				$categoryname = $res42['categoryname'];
				?>
				<option value="<?php echo $categoryname; ?>"><?php echo $categoryname; ?></option>
				<?php
				}
				?>
			</select>		  </td>
          </tr>
        <tr>
          <td width="75" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong> Date From </strong></td>
          <td width="135" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo $transactiondatefrom; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>			</td>
          <td width="95" align="left" valign="center"  bgcolor="#FFFFFF" class="style1"><span class="bodytext31"><strong> Date To </strong></span></td>
          <td width="117" align="left" valign="center"  bgcolor="#ffffff"><span class="bodytext31">
            <input name="ADate2" id="ADate2" style="border: 1px solid #001E6A" value="<?php echo $transactiondateto; ?>"  size="10"  readonly="readonly" onKeyDown="return disableEnterKey()" />
			<img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate2')" style="cursor:pointer"/>
		  </span></td>
          <td width="317" align="left" valign="center"  bgcolor="#ffffff">

		  <select name="searchoption1" id="searchoption1">
		  <!--<option value="">Select Search Option</option>-->
		  <?php
		  if ($searchoption1 == 'CUMULATIVE')
		  {
		  ?>
		  <option value="CUMULATIVE" selected="selected">CUMULATIVE SEARCH ( List By Item )</option>
		  <?php
		  }
		  ?>
		  <?php
		  if ($searchoption1 == 'DETAILED')
		  {
		  ?>
		  <option value="DETAILED" selected="selected">DETAILED SEARCH ( List By Date )</option>
		  <?php
		  }
		  ?>
		  <option value="CUMULATIVE">CUMULATIVE SEARCH ( List By Item )</option>
		  <option value="DETAILED">DETAILED SEARCH ( List By Date )</option>
          </select>          </td>
        </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><input type="hidden" name="itemcode2" id="itemcode2" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" value="<?php echo $itemcode; ?>" size="10" readonly="readonly" /></td>
          <td colspan="3" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
		  <strong>Item Code : <?php echo $itemcode; ?></strong></td>
          <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><div align="right">
            <input type="hidden" name="cbfrmflag1" value="cbfrmflag1">
            <input  style="border: 1px solid #001E6A" type="submit" value="Search" name="Submit" />
            <input name="resetbutton" type="reset" id="resetbutton"  style="border: 1px solid #001E6A" value="Reset" />
		<input type="hidden" name="frmflag1" value="frmflag1" id="frmflag1">
          </div></td>
        </tr>
        <tr>
          <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
          <td colspan="4" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31"><strong>Date Range : <?php echo $transactiondatefrom.' To '.$transactiondateto; ?></strong></td>
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
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="950" 
            align="left" border="0">
          <tbody>
            <tr>
              <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="18%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="6%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="8%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="8%" bgcolor="#cccccc" class="bodytext31"><a 
                  href="#"></a></td>
              <td width="14%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
              <td width="13%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
            </tr>
            <tr>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Category</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Item Name </strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Sales</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>SalesReturn</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Purchase</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>PurchaseReturn</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Date</strong></td>
              <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Particulars </strong></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><div align="left"><strong>Remarks</strong></div></td>
            </tr>
            <?php
			if (isset($_REQUEST["categoryname"])) { $categoryname = $_REQUEST["categoryname"]; } else { $categoryname = ""; }
			//$categoryname = $_REQUEST['categoryname'];
			
			if ($categoryname != '') //To list all categories, if not selected.
			{
			
			if ($searchoption1 == 'DETAILED')
			{
				$query2 = "select * from master_stock where itemcode like '%$itemcode%' and transactiondate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' and companyanum = '$companyanum' order by lastupdate";// and cstid='$custid' and cstname='$custname'";
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				//$query2 = "select *, sum(quantity) as sumquantity from master_stock where itemcode like '%$itemcode%' and transactiondate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' and companyanum = '$companyanum' group by itemcode, transactionmodule order by itemname";// and cstid='$custid' and cstname='$custname'";
				$query2 = "select *, sum(totalrate) as sumtotalrate, sum(quantity) as quantity from master_stock where itemcode like '%$itemcode%' and transactiondate between '$transactiondatefrom' and '$transactiondateto' and recordstatus <> 'DELETED' and companyanum = '$companyanum' group by itemcode, transactionmodule order by itemname";// and cstid='$custid' and cstname='$custname'";
			}
			$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
			$rowcount2 = mysql_num_rows($exec2);
			if ($rowcount2 != 0)
			{
			while ($res2 = mysql_fetch_array($exec2))
			{
			$res2anum = $res2['auto_number'];
			$itemcode = $res2['itemcode'];
			$itemname = $res2['itemname'];
			$transactionmodule = $res2['transactionmodule'];
			$res2transactionparticular = $res2['transactionparticular'];
			$sumquantity = $res2['quantity'];
			
			$query3 = "select * from master_item where itemcode = '$itemcode'";
			$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
			$res3 = mysql_fetch_array($exec3);
			$res3categoryname = $res3['categoryname'];
			$res3itemrate = $res3['rateperunit'];
			$res3unitname_abbreviation = $res3['unitname_abbreviation'];
			
			if ($categoryname == $res3categoryname)
			{
			
			if ($searchoption1 == 'DETAILED')
			{
				$sumtotalrate = $res2['totalrate'];
				$sumquantity = $res2['quantity'];
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				$sumtotalrate = $res2['sumtotalrate'];
				$sumquantity = $res2['quantity'];
			}
			
			if ($transactionmodule == 'SALES')
			{
				//$salesquantity = $res2['quantity'];
				$salestotalrate = $sumtotalrate;
				$salesreturntotalrate = '';
				$purchasetotalrate = '';
				$purchasereturntotalrate = '';
				$adjustmentaddtotalrate = '';
				$adjustmentminustotalrate = '';
				$salestotalrate = round($salestotalrate, 4);
				$totalsalestotalrate = $totalsalestotalrate + $salestotalrate;
			}
			if ($transactionmodule == 'SALES RETURN')
			{
				$salestotalrate = '';
				$salesreturntotalrate = $sumtotalrate;
				$purchasetotalrate = '';
				$purchasereturntotalrate = '';
				$adjustmentaddtotalrate = '';
				$adjustmentminustotalrate = '';
				$salesreturntotalrate = round($salesreturntotalrate, 4);
				$totalsalesreturntotalrate = $totalsalesreturntotalrate + $salesreturntotalrate;
			}
			if ($transactionmodule == 'PURCHASE')
			{
				$salestotalrate = '';
				$salesreturntotalrate = '';
				$purchasetotalrate = $sumtotalrate;
				$purchasereturntotalrate = '';
				$adjustmentaddtotalrate = '';
				$adjustmentminustotalrate = '';
				$purchasetotalrate = round($purchasetotalrate, 4);
				$totalpurchasetotalrate = $totalpurchasetotalrate + $purchasetotalrate;
			}
			if ($transactionmodule == 'PURCHASE RETURN')
			{
				$salestotalrate = '';
				$salesreturntotalrate = '';
				$purchasetotalrate = '';
				$purchasereturntotalrate = $sumtotalrate;
				$adjustmentaddtotalrate = '';
				$adjustmentminustotalrate = '';
				$purchasereturntotalrate = round($purchasereturntotalrate, 4);
				$totalpurchasereturntotalrate = $totalpurchasereturntotalrate + $purchasereturntotalrate;
			}
			else
			{	
				$totalrate = '0';
			}
			
			
			if ($searchoption1 == 'DETAILED')
			{
				$totalrate = $res2['totalrate'];
				$stockdate = $res2['transactiondate'];
				$stockremarks = $res2['remarks'];
				$transactionparticular = $res2['transactionparticular'];
			}
			if ($searchoption1 == 'CUMULATIVE')
			{
				$totalrate = $res2['sumtotalrate'];
			}
			
			
			$totalrate = round($totalrate, 4);
			
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
			
			$sno = $sno + 1;
			
			$totaltotalrate = $totaltotalrate + $totalrate;
			
			if ($stockdate != '')
			{
				$stockdate = substr($stockdate, 0, 10);
				$dotarray = explode("-", $stockdate);
				$dotyear = $dotarray[0];
				$dotmonth = $dotarray[1];
				$dotday = $dotarray[2];
				$stockdate = strtoupper(date("d-M-Y", mktime(0, 0, 0, $dotmonth, $dotday, $dotyear)));
			}
			
			?>
            <tr <?php echo $colorcode; ?>>
              <td class="bodytext31" valign="center"  align="left">
			  <?php echo $sno; ?></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $res3categoryname; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31"><?php echo $itemcode.' - '.$itemname.' - ( '.round($sumquantity, 4).' '.$res3unitname_abbreviation.' )'; ?></div></td>
              <td class="bodytext31" valign="center"  align="left">
			  <div class="bodytext31">
                <div align="right"><?php echo $salestotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $salesreturntotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $purchasetotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="right"><?php echo $purchasereturntotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
			  <?php echo $stockdate; ?></div></td>
              <td class="bodytext31" valign="center"  align="left"><div class="bodytext31">
                  <div align="left"><?php echo $transactionparticular; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left"><div align="left">
			  <?php echo $stockremarks; ?>
			  </div></td>
            </tr>
            <?php
			
			}
			
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
                bgcolor="#cccccc"><div align="right"><strong>Total Quantity</strong></div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalsalestotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalsalesreturntotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalpurchasetotalrate; ?></div>
              </div></td>
              <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#cccccc"><div class="style1">
                <div align="right"><?php echo $totalpurchasereturntotalrate; ?></div>
              </div></td>
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
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>    
  <tr>
    <td valign="top">    
  <tr>
    <td width="99%" valign="top">    
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>