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

if (isset($_REQUEST["st"])) { $st = $_REQUEST["st"]; } else { $st = ""; }
//$st = $_REQUEST['st'];
if (isset($_REQUEST["modulename"])) { $modulename = $_REQUEST["modulename"]; } else { $modulename = ""; }
//$modulename = $_REQUEST['modulename'];



if (isset($_REQUEST["salestitle1"])) { $salestitle1 = $_REQUEST["salestitle1"]; } else { $salestitle1 = ""; }
//$salestitle1 = $_REQUEST['salestitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];
if ($salestitle1 == 'salestitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=sales");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('sales', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=sales");
	}
}

if ($st == 'del' and $modulename == 'sales')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=sales");
}
if ($st == 'activate' and $modulename == 'sales')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=sales");
}



if (isset($_REQUEST["salesreturntitle1"])) { $salesreturntitle1 = $_REQUEST["salesreturntitle1"]; } else { $salesreturntitle1 = ""; }
//$salesreturntitle1 = $_REQUEST['salesreturntitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];

if ($salesreturntitle1 == 'salesreturntitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=salesreturn");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('salesreturn', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=salesreturn");
	}
}

if ($st == 'del' and $modulename == 'salesreturn')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=salesreturn");
}
if ($st == 'activate' and $modulename == 'salesreturn')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=salesreturn");
}






if (isset($_REQUEST["purchasetitle1"])) { $purchasetitle1 = $_REQUEST["purchasetitle1"]; } else { $salesreturntitle1 = ""; }
//$purchasetitle1 = $_REQUEST['purchasetitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];

if ($purchasetitle1 == 'purchasetitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=purchase");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('purchase', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=purchase");
	}
}

if ($st == 'del' and $modulename == 'purchase')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=purchase");
}
if ($st == 'activate' and $modulename == 'purchase')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=purchase");
}









if (isset($_REQUEST["purchasereturntitle1"])) { $purchasereturntitle1 = $_REQUEST["purchasereturntitle1"]; } else { $purchasereturntitle1 = ""; }
//$purchasereturntitle1 = $_REQUEST['purchasereturntitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];

if ($purchasereturntitle1 == 'purchasereturntitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=purchasereturn");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('purchasereturn', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=purchasereturn");
	}
}

if ($st == 'del' and $modulename == 'purchasereturn')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=purchasereturn");
}
if ($st == 'activate' and $modulename == 'purchasereturn')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=purchasereturn");
}








if (isset($_REQUEST["proformainvoicetitle1"])) { $proformainvoicetitle1 = $_REQUEST["proformainvoicetitle1"]; } else { $proformainvoicetitle1 = ""; }
//$purchasereturntitle1 = $_REQUEST['purchasereturntitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];

if ($proformainvoicetitle1 == 'proformainvoicetitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=proformainvoice");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('proformainvoice', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=proformainvoice");
	}
}

if ($st == 'del' and $modulename == 'proformainvoice')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=proformainvoice");
}
if ($st == 'activate' and $modulename == 'proformainvoice')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=proformainvoice");
}








if (isset($_REQUEST["salesordertitle1"])) { $salesordertitle1 = $_REQUEST["salesordertitle1"]; } else { $salesordertitle1 = ""; }
//$purchasereturntitle1 = $_REQUEST['purchasereturntitle1'];
if (isset($_REQUEST["titlename"])) { $titlename = $_REQUEST["titlename"]; } else { $titlename = ""; }
//$titlename = $_REQUEST['titlename'];

if ($salesordertitle1 == 'salesordertitle1' and $titlename != '')
{
	$titlename = $_POST['titlename'];
	$titlename = trim($titlename);
	//$billprintheader = strtoupper($billprintheader);
	$query4 = "select * from master_titlename where titlename='$titlename'";
	$exec4 = mysql_query($query4)or die("error in query4".mysql_error());
	$res4=mysql_fetch_array($exec4);
	$row=mysql_num_rows($exec4);
	if($row>0)
	{
		//$errmsg = "* Sales Bill Print Header Already Exists.";
		header ("location:mastertitlename1.php?errno=1&&errmodule=salesorder");
	}
	else
	{
		$query1 = "insert into master_titlename (modulename, titlename, companyanum, companyname) 
		values ('salesorder', '$titlename', '$companyanum', '$companyname')";
		$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
		//$errmsg = "* New Sales Bill Print Header Included.";
		header ("location:mastertitlename1.php?errno=2&&errmodule=salesorder");
	}
}

if ($st == 'del' and $modulename == 'salesorder')
{
	$masanum1 = $_GET['anum'];
	$query2 = "update master_titlename set status = 'deleted' where auto_number = '$masanum1'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	header ("location:mastertitlename1.php?errno=3&&errmodule=salesorder");
}
if ($st == 'activate' and $modulename == 'salesorder')
{
	$masanum1 = $_GET['anum'];
	$query3 = "update master_titlename set status = '' where auto_number = '$masanum1'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	header ("location:mastertitlename1.php?errno=4&&errmodule=salesorder");
}









?>