<?php
session_start();
include ("includes/loginverify.php");
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$username = $_SESSION["username"];
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$financialyear = $_SESSION["financialyear"];
$bgcolorcode = "";

$errmsg = "";
$billnumber = "";
$searchcustomername = "";
$searchcustomercode = "";

$cbcustomername = "";
$cbres1customeranum = "";
$customername = "";
$res42customercode = "";
$contactperson1 = "";
$contactperson2 = "";
$contactperson3 = "";
$title1 = "";
$designation1 = "";
$department1 = "";
$designation2 = "";
$department2 = "";
$designation3 = "";
$department3 = "";
$address = "";
$location = "";
$city = "";
$pincode1 = "";
$state = "";
$phonenumber1 = "";
$emailid1 = "";

//$newname='customerlist1.js';
//$scriptname=$newname;
//$scriptname1='itemlist1.js';
include ("autocompletebuild_customer1.php");
include ("autocompletebuild_item1.php");
//To verify the edition and manage the count of bills.
$thismonth = date('Y-m-');
$query77 = "select * from master_edition where status = 'ACTIVE' ";
$exec77 =  mysql_query($query77) or die ("Error in Query77".mysql_error());
$res77 = mysql_fetch_array($exec77);
$res77allowed = $res77["allowed"];

$query88 = "select count(auto_number) as cntanum from master_quotation";// where updatedate like '$thismonth%'";
$exec88 = mysql_query($query88) or die ("Error in Query88".mysql_error());
$res88 = mysql_fetch_array($exec88);
$res88cntanum = $res88["cntanum"];

if ($res88cntanum > $res77allowed)
{
	//header ("location:usagelimit1.php"); // redirecting.
	//exit;
}

include ("login1salesdataredirect1.php");

//to check the quotation settings are completed. if not go to quotation settings.
$query7 = "select * from settings_quotation where companyanum = '$companyanum'";
$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
$rowcount7 = mysql_num_rows($exec7);
if ($rowcount7 == 0)
{
	header ("location:settingsquotation1.php?st=3");
}

$totalnumberofitem = 1000; // the number service listed in loop.

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_POST["frmflag1"];
if ($frmflag1 == 'frmflag1')
{
	$delbillst = $_REQUEST["delbillst"];
	$delbillstanum = $_REQUEST["delbillautonumber"];
	$delbillnumber = $_REQUEST["delbillnumber"];
	//if ($delbillst == 'billedit' && $delbillstanum != '' && $delbillnumber != '')
	if ($delbillst == 'billedit' && $delbillnumber != '')
	{
		//$query19 = "select auto_number,lastupdate from master_sales where auto_number = '$delbillautonumber' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'DELETED'";
		$query19 = "select auto_number,updatedate from master_quotation where quotationnumber = '$delbillnumber' and companyanum = '$companyanum'";
		$exec19 = mysql_query($query19) or die ("Error in Query19".mysql_error());
		while ($res19 = mysql_fetch_array($exec19))
		{
			$res19anum = $res19["auto_number"];
			$billdatetime=$res19["updatedate"];
			
			$query15 = "update master_quotation set status = 'DELETED' where quotationnumber = '$delbillnumber' and companyanum = '$companyanum'";
			$exec15 = mysql_query($query15) or die ("Error in Query15".mysql_error());
		
			$query16 = "update quotation_details set status = 'DELETED' where quotationanum = '$res19anum'";
			$exec16 = mysql_query($query16) or die ("Error in Query16".mysql_error());
		
			$query17 = "update quotation_tax set status = 'DELETED' where quotation_autonumber = '$res19anum'";
			$exec17 = mysql_query($query17) or die ("Error in Query17".mysql_error());
		}
	}
}


include ("quotation1include1.php");

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST["st"];
if (isset($_REQUEST["qanum"])) { $qanum = $_REQUEST["qanum"]; } else { $qanum = ""; }
//$qanum = $_REQUEST["qanum"];
if ($st == '1')
{
	$errmsg = "Success. New Quotation Updated. You May Continue To Add Another Quotation.";
	$bgcolorcode = 'success';
}
if ($st == '1' && $qanum != '')
{
	$loadprintpage = 'onLoad="javascript:loadprintpage1()"';
}


	$query2 = "select * from settings_quotation where companyanum = '$companyanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	
	$quotationnumberprefix = $res2["quotationnumberprefix"];
	$quotationnumberprefix = strtoupper($quotationnumberprefix);
	$quotationnumberprefix = trim($quotationnumberprefix);
	
	$query3 = "select max(quotationnumber) as maxquotationnumber from master_quotation where companyanum = '$companyanum'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$quotationnumber  = $res3["maxquotationnumber"];
	$quotationnumber  = $quotationnumber + 1;
	//$quotationnumber  = $_REQUEST["quotationnumber"];
	
	$deartext  = $res2["deartext"];
	$subtext = $res2["subtext"];
	$reftext = $res2["reftext"];
	$quotationstarttext  = $res2["quotationstarttext"];
	$tcline1 = $res2["tcline1"];
	$tcline2 = $res2["tcline2"];
	$tcline3 = $res2["tcline3"];
	$tcline4 = $res2["tcline4"];
	$tcline5 = $res2["tcline5"];
	$tcline6 = $res2["tcline6"];
	$tcline7 = $res2["tcline7"];
	$tcline8 = $res2["tcline8"];
	$quotationendtext = $res2["quotationendtext"];
	$footerline1 = $res2["footerline1"];
	$footerline2 = $res2["footerline2"];
	$footerline3 = $res2["footerline3"];
	$footerline4 = $res2["footerline4"];
	$footerline5 = $res2["footerline5"];
	$footerline6 = $res2["footerline6"];

$quotationdate1 = $updatedatetime;

$query21 = "select * from settings_bill where companyanum = '$companyanum'";
$exec21 = mysql_query($query21) or die ("Error in Query21".mysql_error());
$res21 = mysql_fetch_array($exec21);
$f29=$res21["f29"];
$f30=$res21["f30"];

//To Edit Bill
if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
//$delbillst = $_REQUEST["delbillst"];
if (isset($_REQUEST["delbillautonumber"])) { $delbillautonumber = $_REQUEST["delbillautonumber"]; } else { $delbillautonumber = ""; }
//$delbillautonumber = $_REQUEST["delbillautonumber"];
if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
//$delbillnumber = $_REQUEST["delbillnumber"];


if ($delbillst == 'billedit' && $delbillnumber != '')
{
	$errmsg = '';
	
	$query41 = "select * from master_quotation where quotationnumber = '$delbillnumber' and companyanum = '$companyanum' and status <> 'deleted'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
	$customernameprefix1 = $res41["customernameprefix1"];
	$quotationdate1 = $res41["quotationdate"];
	$customeranum = $res41["customeranum"];
	
	$query42 = "select * from master_customer where auto_number = '$customeranum'";
	$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
	$res42 = mysql_fetch_array($exec42);
	$res42customercode = $res42["customercode"];

	$customername = $res41["customername"];
	$contactperson1 = $res41["contactperson1"];
	$title1 = $res41["title1"];
	$designation1 = $res41["designation1"];
	$department1 = $res41["department1"];
	$contactperson2 = $res41["contactperson2"];
	$title2 = $res41["title2"];
	$designation2 = $res41["designation2"];
	$department2 = $res41["department2"];
	$contactperson3 = $res41["contactperson3"];
	$title3 = $res41["title3"];
	$designation3 = $res41["designation3"];
	$department3 = $res41["department3"];
	
	$address = $res41["address"];
	$location = $res41["location"];
	$city = $res41["city"];
	$state = $res41["state"];
	$pincode1 = $res41["pincode"];
	
	$phonenumber1 = '';
	$emailid1 = '';

	$quotationnumberprefix = $res41["quotationnumberprefix"];
	$quotationnumberprefix = strtoupper($quotationnumberprefix);
	$quotationnumberprefix = trim($quotationnumberprefix);
	
	$quotationnumber  = $res41["quotationnumber"];
	$quotationdate1 = $res41["quotationdate"];
	
	$deartext  = $res41["deartext"];
	$subtext = $res41["subtext"];
	$reftext = $res41["reftext"];
	$quotationstarttext  = $res41["quotationstarttext"];
	$tcline1 = $res41["tcline1"];
	$tcline2 = $res41["tcline2"];
	$tcline3 = $res41["tcline3"];
	$tcline4 = $res41["tcline4"];
	$tcline5 = $res41["tcline5"];
	$tcline6 = $res41["tcline6"];
	$tcline7 = $res41["tcline7"];
	$tcline8 = $res41["tcline8"];
	$quotationendtext = $res41["quotationendtext"];
	$footerline1 = $res41["footerline1"];
	$footerline2 = $res41["footerline2"];
	$footerline3 = $res41["footerline3"];
	$footerline4 = $res41["footerline4"];
	$footerline5 = $res41["footerline5"];
	$footerline6 = $res41["footerline6"];
	
	$subtotalamount = $res41["subtotal"];
	
	$totaldiscountpercent = $res41["totaldiscountpercent"];
	$totaldiscountamount = $res41["totaldiscountamount"];
	$totalafterdiscount = $res41["totalafterdiscount"];	
	
	$totalaftertax = $res41["totalaftertax"];
	//$totalaftertax = $subtotalamount + $taxamount;
	$transportation = $res41["transportation"];
	$packaging = $res41["packaging"];
	$roundoff = $res41["roundoff"];
	$totalamount = $res41["totalamount"];
	
	$remarks = $res41["remarks"];	
	$lumpsum = $res41["lumpsum"];	
	
}

if ($delbillst == 'importsalesorder' && $delbillnumber != '')
{
	$query41 = "select * from master_salesorder where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
	$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
	$res41 = mysql_fetch_array($exec41);
	$res41customercode = $res41["customercode"];
	
	$customername = $res41["customername"];
	$address = $res41["address"];
	$location = $res41["location"];
	$city = $res41["city"];
	$state = $res41["state"];
	$pincode1 = $res41["pincode"];
	
	$query42 = "select * from master_customer where customercode = '$res41customercode'";
	$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
	$res42 = mysql_fetch_array($exec42);
	$res42customercode = $res42["customercode"];
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
<script type="text/javascript" src="js/disablebackenterkey.js"></script>
<!--<script type="text/javascript" src="js/adddate.js"></script>-->
<!--<script type="text/javascript" src="js/adddate2.js"></script>-->
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>
<script language="javascript">

function loadprintpage1()
{
	window.open("print_quotation1.php?qanum=<?php echo $qanum; ?>","Window<?php echo $qanum; ?>",'width=722,height=950,toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=1,resizable=1,left=25,top=25');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}

function customercodesearch2()
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
		customercodesearch1()
	}

}

</script>
<script type="text/javascript" src="js/quotation/customercodesearch1.js"></script>
<script type="text/javascript" src="js/quotation/autosuggest2.js"></script>
<script type="text/javascript" src="js/quotation/autosuggest2service.js"></script>
<!--<script type="text/javascript" src="js/quotation/itemsearch1.js"></script>-->

<!--<script type="text/javascript" src="js/autocomplete_item1.js"></script>-->
<script type="text/javascript" src="js/autocomplete_item1.js"></script>
<script type="text/javascript" src="js/autocomplete_itemsearch2.js"></script>
<!--<script type="text/javascript" src="js/itemcodeentry1.js"></script>-->
<script type="text/javascript" src="js/autocomplete_customer1.js"></script>
<script type="text/javascript" src="js/quotationnovalidation1.js"></script>
<!--
<script type="text/javascript" src="js/quotation/categoryitemsearch1.js"></script>
<script type="text/javascript" src="js/quotation/categoryitemsearch2.js"></script>
<script type="text/javascript" src="js/quotation/servicenameonchange1.js"></script>
<script type="text/javascript" src="js/quotation/servicenameonfocus1.js"></script>
<script type="text/javascript" src="js/quotation/categorynameonfocus1.js"></script>
-->
<link rel="stylesheet" type="text/css" href="css/autosuggest.css" />   
     
<script language="javascript">

<?php
if ($delbillst != 'billedit') // Not in edit mode or other mode.
{
?>
	//Function call from quotationnumber onBlur and Save button click.
	function billvalidation()
	{
		billnovalidation1();
	}
<?php
}
?>

</script>
<script type="text/javascript">
window.onload = function () 
{

	var oTextbox = new AutoSuggestControl(document.getElementById("searchcustomername"), new StateSuggestions());        
    var oTextbox1 = new AutoSuggestControl1(document.getElementById("service1"), new StateSuggestions1());

}

</script>
<link href="css/datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>

<script src="js/datetimepicker_css.js"></script>

<?php include ("quotation_script1.php"); ?>

<body <?php //echo $loadprintpage; ?>>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
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
    <td width="99%" valign="top"><table width="950" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="99%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
          <tbody>
            <tr bgcolor="#011E6A">
              <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>New Quotation  - <?php echo $_SESSION["companyname"]; ?> </strong></td>
              <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
              <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicates Mandatory Fields. </td>
            </tr>
            <tr>
              <td colspan="8" align="left" valign="middle" 
			   bgcolor="<?php if ($bgcolorcode == '') { echo '#FFFFFF'; } else if ($bgcolorcode == 'success') { echo '#FFBF00'; } else if ($bgcolorcode == 'failed') { echo '#AAFF00'; } ?>" class="bodytext3">
				<?php 
				echo $errmsg;
				if ($errmsg != '')
				{
					echo '<input name="billprint" type="button" onClick="return loadprintpage1()" value="Click Here To Print Previous Quotation" class="button" style="border: 1px solid #001E6A"/>';
				}
				?>
			</td>
            </tr>
			<tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Customer </td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="companyname" type="hidden" id="companyname" style="border: 1px solid #001E6A" value="<?php echo $_SESSION["companyname"]; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" size="45">
                <input name="searchcustomername" type="text" id="searchcustomername" style="border: 1px solid #001E6A;" value="<?php echo $searchcustomername; ?>" size="50" autocomplete="off">
              </span></td>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Search Customer Code </td>
              <td align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">
                <input name="searchcustomercode" onBlur="return customercodesearch1()" onKeyDown="return customercodesearch1()" id="searchcustomercode" style="border: 1px solid #001E6A; text-transform:uppercase" value="<?php echo $searchcustomercode; ?>" size="20" />
                <font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                <input name="submitcustomercode" type="button" onClick="return customercodesearch1()" value="Search" class="button" style="border: 1px solid #001E6A"/>
                </font></font></font></font></font></span></td>
            </tr>

            <tr>
              <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
              <td colspan="3" align="left" valign="top"  bgcolor="#FFFFFF"><span class="bodytext3">(If Customer exists in database, you can select from the list to auto complete below fields.) </span></td>
              </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td >
		
		
		<form name="form1" id="form1" method="post" action="quotation1.php" onKeyDown="return disableEnterKey(event)">
          <table width="95%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="99%" border="0" align="left" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
                <tbody>
                  <tr bgcolor="#011E6A">
                    <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Quotation  - New </strong></td>
                    <!--<td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><?php echo $errmgs; ?>&nbsp;</td>-->
                    <td bgcolor="#CCCCCC" class="bodytext3" colspan="2">* Indicated Mandatory Fields. </td>
                  </tr>
				  <?php
					if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
					//$delbillnumber = $_REQUEST["delbillnumber"];
					if (isset($_REQUEST["delbillst"])) { $delbillst = $_REQUEST["delbillst"]; } else { $delbillst = ""; }
					//$delbillst = $_REQUEST["delbillst"];
					if ($delbillst == 'billedit' && $delbillnumber != '')
					{
				  ?>
				  <tr>
					<td colspan="6" align="left" valign="middle"  bgcolor="#FFFF00" class="bodytext3">
					* WARNING : Please Note You Are Editing Quotation No. <?php echo $delbillnumber; ?> . All The Data For This Quote Will Be Over Written. You May Need To Re-Enter Again Everything For This Quotation.				
					</td>
				  </tr>
				  <?php
				  //include ("zprintdmp1test2.php"); 
				  }
				  ?>
                  <tr>
                    <td width="18%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Customer Name * </td>
                    <td colspan="4" align="left" valign="top"  bgcolor="#E0E0E0">
					  <input name="customeranum" id="customeranum" value="<?php echo $cbres1customeranum; ?>" type="hidden">
					  <input name="customername" type="text" id="customername" style="border: 1px solid #001E6A" value="<?php echo $customername; ?>" size="50"></td>
                    </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Address </td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="address" id="address" style="border: 1px solid #001E6A" value="<?php echo $address; ?>"  size="40" /></td>
                    <td width="21%" align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Customer Code </td>
                    <td width="26%" align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="customercode" id="customercode" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A" value="<?php echo $res42customercode; ?>" readonly="readonly" size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Location</td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0"><input name="location" id="location" style="border: 1px solid #001E6A" value="<?php echo $location; ?>"  size="20" /></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">City * </td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="city" id="city" style="border: 1px solid #001E6A" value="<?php echo $city; ?>"  size="20" />					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">State * </td>
                    <td colspan="2" align="left" valign="middle"  bgcolor="#E0E0E0">
					<input name="state" id="state" style="border: 1px solid #001E6A" value="<?php echo $state; ?>"  size="20" />
<!--					
					<select name="state" id="state" style="width: 128px;">
                        <?php
		 			 	if ($state != '') 
		  	{
			  echo '<option value="'.$state.'" selected="selected">'.$state.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
		
			$query1 = "select * from master_state where status <> 'deleted'";
			$exec1 = mysql_query($query1) or die ("Error in Query1.state".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$state = $res1["state"];
			?>
                        <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                        <?php
			  }
			  ?>
                    </select>
-->					
					</td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Pincode </td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="pincode1" id="pincode1" style="border: 1px solid #001E6A" value="<?php echo $pincode1; ?>"  size="20" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                    <td width="7%" align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext3"><strong>Mr. / Ms </strong></span></td>
                    <td width="28%" align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext3"><strong>Person Name </strong></span></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"><strong>Designation Name </strong></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0"><span class="bodytext3"><strong>Department Name </strong></span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Kind Attn 1: (Optional) </td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
                      <select name="title1" id="title1" style="width: 50px;">
                        <?php
		 	if ($title1 != '') 
		  	{
			  echo '<option value="'.$title1.'" selected="selected">'.$title1.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
			?>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                      </select>
                      <input name="contactperson1" type="text" id="contactperson1" style="border: 1px solid #001E6A" value="<?php echo $contactperson1; ?>" size="30">
                    </span></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">
					<input name="designation1" type="text" id="designation1" style="border: 1px solid #001E6A" value="<?php echo $designation1; ?>" size="25">
<!--					<select name="designation1" id="designation1" >
                      <?php
		 			 	if ($designation1 != '') 
		  	{
			  echo '<option value="'.$designation1.'" selected="selected">'.$designation1.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
		
			$query1 = "select * from master_designation where status <> 'deleted' order by designation";
			$exec1 = mysql_query($query1) or die ("Error in Query1.state".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$designation1 = $res1["designation"];
			?>
                      <option value="<?php echo $designation1; ?>"><?php echo $designation1; ?></option>
                      <?php
			  }
			  ?>
                    </select>
-->					</td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
					<input name="department1" id="department1" type="text" value="<?php echo $department1; ?>" style="border: 1px solid #001E6A">
<!--                      <select name="department1" id="department1" >
                        <?php
		 			 	if ($department1 != '') 
		  	{
			  echo '<option value="'.$department1.'" selected="selected">'.$department1.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
		
			$query1 = "select * from master_department where status <> 'deleted' order by department";
			$exec1 = mysql_query($query1) or die ("Error in Query1.state".mysql_error());
			while ($res1 = mysql_fetch_array($exec1))
			{
			$department1 = $res1["department"];
			?>
                        <option value="<?php echo $department1; ?>"><?php echo $department1; ?></option>
                        <?php
			  }
			  ?>
                      </select>
-->                    </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Kind Attn 2: (Optional) </td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
                      <select name="title2" id="title2" style="width: 50px;">
                        <?php
		 	if ($title2 != '') 
		  	{
			  echo '<option value="'.$title2.'" selected="selected">'.$title2.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
			?>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                      </select>
                      <input name="contactperson2" type="text" id="contactperson2" style="border: 1px solid #001E6A" value="<?php echo $contactperson2; ?>" size="30">
                    </span></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">
					<input name="designation2" type="text" id="designation2" value="<?php echo $designation2; ?>" size="25" style="border: 1px solid #001E6A"></td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
                      <input name="department2" id="department2" type="text" value="<?php echo $department2; ?>" style="border: 1px solid #001E6A">
                    </span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Kind Attn 3: (Optional) </td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
                      <select name="title3" id="title3" style="width: 50px;">
                        <?php
		 	if ($title3 != '') 
		  	{
			  echo '<option value="'.$title3.'" selected="selected">'.$title3.'</option>';
		 	}
			else
			{
			  echo '<option value="" selected="selected">Select</option>';
			}
			?>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                      </select>
                      <input name="contactperson3" type="text" id="contactperson3" style="border: 1px solid #001E6A" value="<?php echo $contactperson3; ?>" size="30">
                    </span></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">
					<input name="designation3" type="text" id="designation3" value="<?php echo $designation3; ?>" size="25" style="border: 1px solid #001E6A"></td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0"><span class="bodytext3">
                      <input name="department3" type="text" id="department3" style="border: 1px solid #001E6A" value="<?php echo $department3; ?>">
                    </span></td>
                  </tr>
                  <tr>
                     <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;<!--Rate  Apply From --></td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0">&nbsp;
                      <input type="hidden" name="rateapplyfrom" id="rateapplyfrom" value="mastersitemrates">
<!--					
					<select name="rateapplyfrom">
                        <option value="mastersitemrates">From Masters Item Rates</option>
                        <option value="salesbillrates">From Earlier Sales Bill Rates</option>
                      </select>  
-->					  </td>
                    
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Quotation Date </td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<span class="bodytext31">
                      <input name="ADate1" id="ADate1" style="border: 1px solid #001E6A" value="<?php echo substr($quotationdate1, 0, 10); ?>"  size="15"  readonly="readonly" onKeyDown="return disableEnterKey()" />
                    <img src="images2/cal.gif" onClick="javascript:NewCssCal('ADate1')" style="cursor:pointer"/>					</span>					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Quotation Number Prefix</td>
                    <td colspan="2" align="left" valign="top"  bgcolor="#E0E0E0">
					<input name="quotationnumberprefix" id="quotationnumberprefix" value="<?php echo $quotationnumberprefix; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Quotation Number</td>
                    <td align="left" valign="top"  bgcolor="#E0E0E0">
					<!--<input name="quotationnumber" id="quotationnumber" value="<?php echo $quotationnumber; ?>" onKeyDown="return process1backkeypress1()" readonly="readonly" style="border: 1px solid #001E6A"  size="20" />-->
					  <?php
					  if ($delbillst == 'billedit' && $delbillnumber != '')
					  {
						$quotationnumber = $delbillnumber; 
						$billnumbertextboxvalidation = 'readonly="readonly"';
					  }
					  else if ($delbillst == 'importsalesorder' && $delbillnumber != '')
					  {
						//$billnumber = $delbillnumber; 
						$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
					  }
					  else
					  {
						$billnumbertextboxvalidation = 'onBlur="return billvalidation()"';
					  }
					  ?>
					<input name="quotationnumber" id="quotationnumber" value="<?php echo $quotationnumber; ?>"  <?php echo $billnumbertextboxvalidation; ?> style="border: 1px solid #001E6A; text-align:right" size="11" /> 
					<input name="latestquotationnumber" id="latestquotationnumber" value="<?php echo $quotationnumber; ?>" type="hidden" size="5">					</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Begin With :  </strong></td>
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><input name="deartext" id="deartext" value="<?php echo $deartext; ?>" style="border: 1px solid #001E6A"  size="40" /> 
                      (Example : Dear Sir, Respected Sir, Dear Sir/Madam) </td>
                    </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Sub :</strong></td>
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><input name="subtext" id="subtext" value="<?php echo $subtext; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                    </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Ref :</strong></td>
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><input name="reftext" id="reftext" value="<?php echo $reftext; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                    </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Quotation Start Text </strong></td>
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><input name="quotationstarttext" id="quotationstarttext" value="<?php echo $quotationstarttext; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                    </tr>
                  <tr> 
                   <input type="hidden" name="cstnumber" id="cstnumber" value="<?php echo $quotationstarttext; ?>" style="border: 1px solid #001E6A"  size="100" />
				   <input type="hidden" name="tinnumber" id="tinnumber" value="<?php echo $quotationstarttext; ?>" style="border: 1px solid #001E6A"  size="100" />
					<!--<td align="left" valign="center"  
                bgcolor="#FFFFFF" class="bodytext31"><strong>CST Number :  </strong></td>
                    <td colspan="3" align="left" valign="center"  
                class="bodytext31"><input name="cstnumber" id="cstnumber" value="<?php echo $cstnumber; ?>" style="border: 1px solid #001E6A"  size="40" /><td align="left" valign="center"  
                bgcolor="#FFFFFF" class="bodytext31"><strong>Tin Number  </strong></td>
                      <input name="tinnumber" id="tinnumber" value="<?php echo $tinnumber; ?>" style="border: 1px solid #001E6A"  size="40" />                       </td>-->
                    
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                   
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="4" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
			  <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="97%" 
            align="left" border="0">
                <tbody id="foo">
                  <tr>
                    <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td colspan="3" bgcolor="#cccccc" class="bodytext31">* Select Category first to get the item list populated. </td>
                    <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="3%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="6%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="5%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="21%" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    </tr>
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0">&nbsp;</td>
                    <td width="8%" align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Item Search </strong></td>
                    
                    <td colspan="11" align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong><strong>
                      <input name="service1" id="service1" style="border: 1px solid #001E6A; text-align:left" value="" size="80"  autocomplete="off" />
                      <input type="hidden" name="categoryname" value="" id="categoryname" style="border: 1px solid #001E6A; text-align:left" size="5" />
                    </strong></strong></td>
                    </tr>
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>No.</strong></td>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Item Code </strong></td>
                    <td colspan="2" align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Items Name </strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>Unit</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>Rate</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong> Qty </strong></td>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Sub </strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>Dsc%</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>Dsc</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#E0E0E0"><strong>Tax%</strong></td>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><strong>Total </strong></td>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input name="serialnumber" value="" id="serialnumber" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="1" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input name="itemcode" id="itemcode" onBlur="return itemcodeentry1()" onKeyDown="return funcItemCodeEnterKeyPress1(event)" style="border: 1px solid #001E6A; text-align:left" value="" size="7" /></td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" class="bodytext31"><input name="itemname" id="itemname" onBlur="return itemcodeentry1()" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return itemcodeentry2()" readonly="readonly" value="" size="30" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input name="unitname" value="" id="unitname" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input name="rateperunit" value="0.00" id="rateperunit" onKeyDown="return itemquantitykeypress1(event)" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input name="quantity" value="1" id="quantity"  onKeyDown="return itemquantitykeypress1(event)" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" class="bodytext31">
					<input name="subtotal" value="0.00" id="subtotal" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input type="text" name="discountpercent" value="0.00" id="discountpercent" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input type="text" name="discountamount" value="0.00" id="discountamount" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" />
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">
					<input type="text" name="taxpercent" value="" id="taxpercent" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />
                    <input type="hidden" name="taxautonum" value="" id="taxautonum" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" class="bodytext31">
					<input name="totalamount" value="0.00" id="totalamount" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" class="bodytext31">
					<input name="Submit2222" type="button" onClick="return btnClick()"  value="Add" class="button" style="border: 1px solid #001E6A"/></td>
                    </tr>
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#E0E0E0"><strong>Description</strong></td>
                    <td colspan="11" align="left" valign="center"  bgcolor="#E0E0E0" class="bodytext31">
					  <textarea name="additionaltext" cols="50" id="additionaltext" style="border: 1px solid #001E6A; text-align:left"></textarea>
                      (Optional)</td>
                    </tr>
 
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                    <td colspan="10" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                    </tr>
                      <tr>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td colspan="3" bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        <td bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                        </tr>
                      <tr>
                        <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>No.</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Item Code </strong></td>
                    <td width="2%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>
                      <!-- Category -->
                    </strong></td>
                    <td width="35%" align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Items / Services </strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Unit</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Rate</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Qty</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Sub</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Dsc%</strong></td>
                    <td class="bodytext31" valign="center"  align="left" 
                bgcolor="#ffffff"><strong>Dsc</strong></td>
                    <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Tax%</strong></td>
                    <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31"><strong>Total </strong></td>
                    <td align="left" valign="center"  
                bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                  </tr>
					<?php include ("quotation_edit1listing1.php"); ?>
<!--					
                  <tr>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">&nbsp;</td>
                    </tr>
-->					
                </tbody>
              </table>			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
			  <table id="AutoNumber3" style="BORDER-COLLAPSE: collapse" 
            bordercolor="#666666" cellspacing="0" cellpadding="4" width="99%" 
            align="left" border="0">
                <tbody id="foo">
                  <!--<tr>
				  <td align="left" valign="center"  
                class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  
                 class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  
                 class="bodytext31"><div align="right"><strong>Lumpsum : Ignore Individual Rates And Apply This As Total Amount : </strong></div></td>
                    <td align="left" valign="center"  
                 class="bodytext31">
				 </td>
                  </tr>-->
				   <tr>
                     <!--     <td align="left" valign="center"  
                bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>-->
                     <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
				     <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><div align="right"><strong>Sub Total  Amount </strong></div></td>
				     <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><input type="hidden" name="lumpsum" id="lumpsum" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8" />
                         <input name="subtotalamount" id="subtotalamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" /></td>
				     </tr>
				<?php
				$query5 = "select * from master_tax where status = '' order by taxname desc";
				$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
				while ($res5 = mysql_fetch_array($exec5))
				{
				$res5anum = $res5["auto_number"];
				$res5taxname = $res5["taxname"];
				$res5taxpercent = $res5["taxpercent"];
				
				?>
				   <tr>
                     <td align="left" valign="center"  bgcolor="#E0E0E0" 
				 class="bodytext31">&nbsp;</td>
				     <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
				 class="bodytext31"><div align="right"><strong>
				       <input type="hidden" name="totaltax_autonumber<?php echo $res5anum; ?>" value="<?php echo $res5anum; ?>">
                       <input type="hidden" name="totaltaxname<?php echo $res5anum; ?>" value="<?php echo $res5taxname; ?>">
                       <input type="hidden" name="totaltaxpercent<?php echo $res5anum; ?>" value="<?php echo $res5taxpercent; ?>">
                       <?php echo strtoupper($res5taxname); //.' '.$res5taxpercent.'%'; ?></strong></div></td>
				     <td align="left" valign="center"  
				bgcolor="#E0E0E0" class="bodytext31">
				<input name="totaltaxamount<?php echo $res5anum; ?>" id="totaltaxamount<?php echo $res5anum; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" /></td>
				     </tr>
				<?php
				$res6loopcount = '';
				
				$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
				$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
				while ($res6 = mysql_fetch_array($exec6))
				{
				$res6anum = $res6["auto_number"];
				$res6taxname = $res6["taxsubname"];
				$res6taxpercent = $res6["taxsubpercent"];
				$res6loopcount = $res6loopcount + 1;
				//echo $res6loopcount;
				?>
				   <tr>
                     <td align="left" valign="center"  bgcolor="#E0E0E0" 
				 class="bodytext31">&nbsp;</td>
				     <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
				 class="bodytext31"><div align="right"><strong>
				       <input type="hidden" name="totaltaxsub_autonumber<?php echo $res6loopcount; ?>" value="<?php echo $res6anum; ?>">
                       <input type="hidden" name="totaltaxsubname<?php echo $res6loopcount; ?>" value="<?php echo $res6taxname; ?>">
                       <input type="hidden" name="totaltaxsubpercent<?php echo $res6loopcount; ?>" value="<?php echo $res6taxpercent; ?>">
                       <?php echo strtoupper($res6taxname);//.' '.$res6taxpercent.'%'; ?></strong></div></td>
				     <td align="left" valign="center"  
				bgcolor="#E0E0E0" class="bodytext31"><!-- To avaoid duplicates, parent tax anum is joined. see javascript also. -->
                         <input name="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" id="totaltaxsubamount<?php echo $res5anum; ?><?php echo $res6loopcount; ?>" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" /></td>
				     </tr>
				<?php
				}
				}
				?>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><div align="right"><strong>Total After Tax </strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="totalaftertax" id="totalaftertax" value="0.00"  onKeyDown="return disableEnterKey()" onBlur="return funcSubTotalCalc()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><div align="right"><strong> <?php echo $f29; ?></strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="transportation" id="transportation" value="0.00"  onKeyDown="return disableEnterKey()" onBlur="return funcSubTotalCalc()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><div align="right"><strong> <?php echo $f30; ?></strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="packaging" id="packaging" value="0.00"  onKeyDown="return disableEnterKey()" onBlur="return funcSubTotalCalc()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><div align="right"><strong>Round Off </strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="roundoff" id="roundoff" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><div align="right"><strong>Total Amount </strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="netamount" id="netamount" value="0.00" style="border: 1px solid #001E6A; text-align:right" onKeyDown="return disableEnterKey()" size="8"  readonly="readonly" /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><strong>Terms &amp; Conditions </strong></td>
                    <td width="12%" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 1 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline1" cols="75" id="tcline1" style="border: 1px solid #001E6A"><?php echo $tcline1; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 2 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline2" cols="75" id="tcline2" style="border: 1px solid #001E6A"><?php echo $tcline2; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 3 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline3" cols="75" id="tcline3" style="border: 1px solid #001E6A"><?php echo $tcline3; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 4 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline4" cols="75" id="tcline4" style="border: 1px solid #001E6A"><?php echo $tcline4; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 5 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline5" cols="75" id="tcline5" style="border: 1px solid #001E6A"><?php echo $tcline5; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 6 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31"><textarea name="tcline6" cols="75" id="tcline6" style="border: 1px solid #001E6A"><?php echo $tcline6; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 7 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline7" cols="75" id="tcline7" style="border: 1px solid #001E6A"><?php echo $tcline7; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Line 8 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><textarea name="tcline8" cols="75" id="tcline8" style="border: 1px solid #001E6A"><?php echo $tcline8; ?></textarea></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31"><span class="bodytext3">Quotation End Text </span></td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="quotationendtext" id="quotationendtext" value="<?php echo $quotationendtext; ?>" style="border: 1px solid #001E6A"  size="100" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#E0E0E0" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 1 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline1" id="footerline1" value="<?php echo $footerline1; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 2 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline2" id="footerline2" value="<?php echo $footerline2; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 3 * </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline3" id="footerline3" value="<?php echo $footerline3; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 4 * </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline4" id="footerline4" value="<?php echo $footerline4; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 5 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline5" id="footerline5" value="<?php echo $footerline5; ?>" style="border: 1px solid #001E6A"  size="40" /></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3">Footer Line 6 </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><input name="footerline6" id="footerline6" value="<?php echo $footerline6; ?>" style="border: 1px solid #001E6A"  size="40" /><!--<div align="right" ><strong>Select Type </strong></div>--></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31" ><!--<select name="billtype" id="billtype" onChange="return paymentinfo()">
                        <option value="">SELECT TYPE</option>
                        <option value="CASH BILL">QUOTATION</option>
                        <!--                        <option value="CHEQUE BILL">CHEQUE BILL</option>
                        <option value="CREDIT BILL">CREDIT BILL</option>
                        <option value="SPLIT BILL">SPLIT BILL</option>

                    </select>--></td>
                  </tr>
				   <tr>
                    <td align="left" valign="middle"  bgcolor="#E0E0E0" class="bodytext3"> </td>
                    <td colspan="2" align="left" valign="center"  bgcolor="#E0E0E0" 
                 class="bodytext31"><!--<input name="footerline6" id="footerline6" value="<?php echo $footerline6; ?>" style="border: 1px solid #001E6A"  size="40" />-->
                      <div align="right" ><strong>Select Type </strong></div></td>
                    <td align="left" valign="center"  bgcolor="#E0E0E0" 
                class="bodytext31" ><select name="billtype" id="billtype">
                        <option value="">SELECT TYPE</option>
                        <option value="CASH BILL">QUOTATION</option>
                        <!--                        <option value="CHEQUE BILL">CHEQUE BILL</option>
                        <option value="CREDIT BILL">CREDIT BILL</option>
                        <option value="SPLIT BILL">SPLIT BILL</option>
-->
                    </select></td>
                  </tr>
                 <!-- <tr>
                    <td align="left" valign="center"  
                bgcolor="#FFFFFF" class="bodytext31">&nbsp;</td>
                    <!--<td colspan="2" align="left" valign="center"  
                 class="bodytext31">&nbsp;</td>
                    <td align="left" valign="center"  
                 class="bodytext31">&nbsp;</td>-->
                    <!--<td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3"><div align="right"><strong>Select Type </strong></div></td>
                    <td width="13%" align="left" valign="top" ><select name="billtype" id="billtype" onChange="return paymentinfo()">
                        <option value="">SELECT TYPE</option>
                        <option value="CASH BILL">QUOTATION</option>
                        <!--                        <option value="CHEQUE BILL">CHEQUE BILL</option>
                        <option value="CREDIT BILL">CREDIT BILL</option>
                        <option value="SPLIT BILL">SPLIT BILL</option>

                    </select></td>
                  </tr>-->
                  <!--                  <tr>
                    <td align="left" valign="center"  
                bgcolor="#FFFFFF" class="bodytext31"><strong>Remarks :</strong></td>
                    <td colspan="2" align="left" valign="center"  
                 class="bodytext31"><input name="remarks" type="text" size="75" style="border: 1px solid #001E6A; text-align:left"></td>
                    <td align="left" valign="center"  
                 class="bodytext31">&nbsp;</td>
                  </tr>
-->
                  <tr>
                    <td width="20%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td width="43%" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31">&nbsp;</td>
                    <td colspan="2" align="left" valign="center"  
                bgcolor="#cccccc" class="bodytext31"><div align="right"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><font color="#000000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        <input type="hidden" name="frmflag1" value="frmflag1" />
                        <input type="hidden" name="loopcount" value="1000" />
                  <input name="delbillst" id="delbillst" type="hidden" value="billedit">
                  <input name="delbillautonumber" id="delbillautonumber" type="hidden" value="<?php echo $delbillautonumber;?>">
                  <input name="delbillnumber" id="delbillnumber" type="hidden" value="<?php echo $delbillnumber;?>">
                        <input name="Submit2223" type="submit" onClick="return customervalidation()" value="Save Quotation" class="button" style="border: 1px solid #001E6A"/>
                    </font></font></font></font></font></div></td>
                  </tr>
                </tbody>
              </table>			  </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
            </form>        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
</table>
<?php include ("includes/footer1.php"); ?>
<script type="text/javascript">
function funcRecordCheck()
{

	
	var varCheckNoRecords = 0;
	for (m=1;m<=1000;m++)
	{
	//alert(document.getElementById('totalamount'+m))
		if (document.getElementById('totalamount'+m) != null) 
		{
			varCheckNoRecords = varCheckNoRecords + 1;
			//alert("You Have Selecting New Item");
			//alert(document.form1.rateperunit.value);
			//alert("Inside If");
			
			var coderate=document.form1.rateperunit.value;
			var codenew1=document.getElementById('itemcode').value;
			//alert(codenew1);
			alert(coderate);
			alert(document.form1.rateperunit.text);
			
			//alert('You Have Selected' + codenew1 + '.');
			
			var codenew=document.getElementById('itemcode').value;
			//alert(codenew);
			if(codenew!='')// coderate!='')
			{
			alert("inside if");
			return false;
			}
			else
			{
			alert("Inside Else");
			return true;
			}
					}
	}
	//alert (varCheckNoRecords);
	if (varCheckNoRecords == 0)
	{
		//document.getElementById('subtotalamount').value = "0.00";
		//alert ("You Have Not Added Any Items / Service.");
		return false;
	}
		

}

</script>
</body>
</html>