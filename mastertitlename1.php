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

$errno = '';
$errmodule = '';
$saleserrmsg = '';
$salesreturnerrmsg = '';
$purchaseerrmsg = '';
$purchasereturnerrmsg = '';
$proformainvoiceerrmsg = '';
$salesordererrmsg = '';

if (isset($_REQUEST["errno"])) { $errno = $_REQUEST["errno"]; } else { $errno = ""; }
//$errno = $_REQUEST['errno'];
if (isset($_REQUEST["errmodule"])) { $errmodule = $_REQUEST["errmodule"]; } else { $errmodule = ""; }
//$errmodule = $_REQUEST['errmodule'];
if ($errno == 1)
{
	if ($errmodule == 'sales')
	{
		$saleserrmsg = "* Print Out Title Name Already Exists.";
	}
	if ($errmodule == 'salesreturn')
	{
		$salesreturnerrmsg = "* Print Out Title Name Already Exists.";
	}
	if ($errmodule == 'purchase')
	{
		$purchaseerrmsg = "* Print Out Title Name Already Exists.";
	}
	if ($errmodule == 'purchasereturn')
	{
		$errmsg = "* Print Out Title Name Already Exists.";
	}
	if ($errmodule == 'proformainvoice')
	{
		$errmsg = "* Print Out Title Name Already Exists.";
	}
	if ($errmodule == 'salesorder')
	{
		$errmsg = "* Print Out Title Name Already Exists.";
	}
}

if ($errno == 2)
{
	if ($errmodule == 'sales')
	{
		$saleserrmsg = "* Print Out Title Name Included.";
	}
	if ($errmodule == 'salesreturn')
	{
		$salesreturnerrmsg = "* Print Out Title Name Included.";
	}
	if ($errmodule == 'purchase')
	{
		$purchaseerrmsg = "* Print Out Title Name Included.";
	}
	if ($errmodule == 'purchasereturn')
	{
		$purchasereturnerrmsg = "* Print Out Title Name Included.";
	}
	if ($errmodule == 'proformainvoice')
	{
		$proformainvoiceerrmsg = "* Print Out Title Name Included.";
	}
	if ($errmodule == 'salesorder')
	{
		$salesordererrmsg = "* Print Out Title Name Included.";
	}
}

if ($errno == 3)
{
	if ($errmodule == 'sales')
	{
		$saleserrmsg = "* Print Out Title Name Deleted.";
	}
	if ($errmodule == 'salesreturn')
	{
		$salesreturnerrmsg = "* Print Out Title Name Deleted.";
	}
	if ($errmodule == 'purchase')
	{
		$purchaseerrmsg = "* Print Out Title Name Deleted.";
	}
	if ($errmodule == 'purchasereturn')
	{
		$purchasereturnerrmsg = "* Print Out Title Name Deleted.";
	}
	if ($errmodule == 'proformainvoice')
	{
		$proformainvoiceerrmsg = "* Print Out Title Name Deleted.";
	}
	if ($errmodule == 'salesorder')
	{
		$salesordererrmsg = "* Print Out Title Name Deleted.";
	}
}

if ($errno == 4)
{
	if ($errmodule == 'sales')
	{
		$saleserrmsg = "* Print Out Title Name Activated.";
	}
	if ($errmodule == 'salesreturn')
	{
		$salesreturnerrmsg = "* Print Out Title Name Activated.";
	}
	if ($errmodule == 'purchase')
	{
		$purchaseerrmsg = "* Print Out Title Name Activated.";
	}
	if ($errmodule == 'purchasereturn')
	{
		$purchasereturnerrmsg = "* Print Out Title Name Activated.";
	}
	if ($errmodule == 'proformainvoice')
	{
		$proformainvoiceerrmsg = "* Print Out Title Name Activated.";
	}
	if ($errmodule == 'salesorder')
	{
		$salesordererrmsg = "* Print Out Title Name Activated.";
	}
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
.bodytext31 {	FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma; text-decoration:none
}
-->
</style>
<link href="datepickerstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/adddate.js"></script>
<script type="text/javascript" src="js/adddate2.js"></script>
<script language="javascript">

function salestitle1()
{
	if (document.salestitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.salestitle1.titlename.focus();
		return false;
	}
}


function salesreturntitle1()
{
	if (document.salesreturntitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.salesreturntitle1.titlename.focus();
		return false;
	}
}


function purchasetitle1()
{
	if (document.purchasetitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.purchasetitle1.titlename.focus();
		return false;
	}
}


function purchasereturntitle1()
{
	if (document.purchasereturntitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.purchasereturntitle1.titlename.focus();
		return false;
	}
}



function proformainvoicetitle1()
{
	if (document.proformainvoicetitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.proformainvoicetitle1.titlename.focus();
		return false;
	}
}



function salesordertitle1()
{
	if (document.salesordertitle1.titlename.value == "")
	{
		alert ("Please Enter Print Title Name.");
		document.salesordertitle1.titlename.focus();
		return false;
	}
}

</script>
<style type="text/css">
<!--
.bodytext31 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3b3b3c; FONT-FAMILY: Tahoma
}
-->
</style>
</head>

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
    <td colspan="2" rowspan="24">&nbsp;</td>
    <td width="99%" valign="top">


      	<form id="salestitle1" name="salestitle1" method="post" action="mastertitlename2.php" onSubmit="return salestitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($saleserrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $saleserrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: INVOICE, BILL ) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="salestitle1" id="salestitle1" value="salestitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'sales' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=sales&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'sales' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=sales&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">
	
	
      	<form id="salesreturntitle1" name="salesreturntitle1" method="post" action="mastertitlename2.php" onSubmit="return salesreturntitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Return Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($salesreturnerrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $salesreturnerrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: SALES RETURN) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="salesreturntitle1" id="salesreturntitle1" value="salesreturntitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Return Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'salesreturn' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=salesreturn&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Return Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'salesreturn' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=salesreturn&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">
	
	
      	<form id="purchasetitle1" name="purchasetitle1" method="post" action="mastertitlename2.php" onSubmit="return purchasetitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase  Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($purchaseerrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $purchaseerrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: PURCHASE RECEIPT) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="purchasetitle1" id="purchasetitle1" value="purchasetitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase  Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'purchase' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=purchase&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase  Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'purchase' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=purchase&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">
	
	
      	<form id="purchasereturntitle1" name="purchasereturntitle1" method="post" action="mastertitlename2.php" onSubmit="return purchasereturntitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Return Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($purchasereturnerrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $purchasereturnerrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: PURCHASE RETURN) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="purchasereturntitle1" id="purchasereturntitle1" value="purchasereturntitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Return Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'purchasereturn' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=purchasereturn&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Purchase Return Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'purchasereturn' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=purchasereturn&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">
	
	
      	<form id="proformainvoicetitle1" name="proformainvoicetitle1" method="post" action="mastertitlename2.php" onSubmit="return proformainvoicetitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Proforma Invoice  Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($proformainvoiceerrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $proformainvoiceerrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td valign="top" align="left" >
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: PROFORMA INVOICE) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td valign="top" align="left" width="58%" >
		  <input type="hidden" name="proformainvoicetitle1" id="proformainvoicetitle1" value="proformainvoicetitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Proforma Invoice  Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'proformainvoice' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=proformainvoice&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Proforma Invoice  Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'proformainvoice' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=proformainvoice&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">
	
	
	
	
      	<form id="salesordertitle1" name="salesordertitle1" method="post" action="mastertitlename2.php" onSubmit="return salesordertitle1()">
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Order  Print Out Title Name Master - Add New </strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="middle"  
		  bgcolor="<?php if ($salesordererrmsg == '') { echo '#FFFFFF'; } else { echo '#AAFF00'; } ?>" class="bodytext3"><?php echo $salesordererrmsg; ?>&nbsp;</td>
          </tr>
        <tr>
          <td align="left" valign="middle"  bgcolor="#FFFFFF" class="bodytext3">Add New  Print Title Name </td>
          <td align="left" valign="top"  bgcolor="#FFFFFF">
		  <input name="titlename" id="titlename" size="20" style="border: 1px solid #001E6A" />
            <span class="bodytext3">(Ex: SALES ORDER) </span></td>
        </tr>
        <tr>
          <td width="42%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
          <td width="58%" align="left" valign="top"  bgcolor="#FFFFFF">
		  <input type="hidden" name="salesordertitle1" id="salesordertitle1" value="salesordertitle1" />
		  <input type="submit" name="Submit" value="Submit" style="border: 1px solid #001E6A" />            </td>
        </tr>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>  
	<table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Order Print Out Title Name Master - Existing List </strong></td>
        </tr>
		<?php
		$query1 = "select * from master_titlename where modulename = 'salesorder' and status <> 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><div align="center">
		  <a href="mastertitlename2.php?st=del&&modulename=salesorder&&anum=<?php echo $masanum1; ?>"><img src="images/b_drop.png" width="16" height="16" border="0" /></a></div></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
      <tbody>
        <tr bgcolor="#011E6A">
          <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Sales Order Print Out Title Name Master - Deleted </strong></td>
        </tr>
        <?php
		$query1 = "select * from master_titlename where modulename = 'salesorder' and status = 'deleted' order by titlename ";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		while ($res1 = mysql_fetch_array($exec1))
		{
		$titlename = $res1['titlename'];
		$masanum1 = $res1['auto_number'];
		?>
        <tr>
          <td width="15%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		  <a href="mastertitlename2.php?st=activate&&modulename=salesorder&&anum=<?php echo $masanum1; ?>" class="bodytext3"><div align="center" class="bodytext3">Activate</div></a></td>
          <td width="85%" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3"><?php echo $titlename; ?>&nbsp;</td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td align="middle" colspan="2" >&nbsp;</td>
        </tr>
      </tbody>
    </table>
	</form>	</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
  <tr>
    <td valign="top">&nbsp;</td>
</table>
<?php include ("includes/footer1.php"); ?>
</body>
</html>