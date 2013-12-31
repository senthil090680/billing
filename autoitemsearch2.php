<?php
session_start();
//Called from sales1.php - autoitemsearch2.js
//Item rate called from previous bill entry is done here.

include ("db/db_connect.php");
$companyanum = $_SESSION["companyanum"];
$companyname = $_SESSION["companyname"];
$companycode = $_SESSION['companycode'];
$itemcode=$_REQUEST["itemcode"];
$searchresult = '';

	//$financialyear = $_SESSION["financialyear"];
	$query6 = "select * from master_company where auto_number = '$companyanum'";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$res6 = mysql_fetch_array($exec6);
	$res6companycode = $res6["companycode"];
	
	$query7 = "select * from master_settings where companycode = '$res6companycode' and modulename = 'SETTINGS' and 
	settingsname = 'CURRENT_FINANCIAL_YEAR'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$financialyear = $res7["settingsvalue"];
	$_SESSION["financialyear"] = $financialyear;
	//echo $_SESSION['financialyear'];


	$query2 = "select * from master_item where itemcode = '$itemcode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$itemcode = $res2["itemcode"];
	$itemname = $res2["itemname"];
	$mrp = $res2["rateperunit"];
	$taxanum = $res2["taxanum"];
	$itemdescription = $res2["description"];
	
	//To Get Price From Previous Bills For Selected Customer.
	//GET PRICE FROM PREVIOUS INVOICE
	$query100 = "select * from master_settings where modulename = 'SETTINGS' and settingsname = 'ITEM_PRICE_SETTING' 
	and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec100 = mysql_query($query100) or die ("Error in Query100".mysql_error());
	$res100 = mysql_fetch_array($exec100);
	$res100settingsvalue = $res100['settingsvalue'];
	if ($res100settingsvalue == 'GET PRICE FROM PREVIOUS INVOICE')
	{
		if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
		//$customercode = $_REQUEST['customercode'];
		$query101 = "select * from master_sales where customercode = '$customercode' and recordstatus <> 'deleted' and companyanum = '$companyanum' and financialyear = '$financialyear' order by billdate desc";
		$exec101 = mysql_query($query101) or die ("Error in Query101".mysql_error());
		$res101 = mysql_fetch_array($exec101);
		$res101billautonumber = $res101['auto_number'];
		
		$query102 = "select * from sales_details where itemcode = '$itemcode' and bill_autonumber = '$res101billautonumber' and companyanum = '$companyanum' and financialyear = '$financialyear' and recordstatus <> 'deleted'";
		$exec102 = mysql_query($query102) or die ("Error in Query102".mysql_error());
		$res102 = mysql_fetch_array($exec102);
		$res102rate = $res102['rate'];
		if ($res102rate != '')
		{
			$mrp = $res102rate;
		}
		//$mrp = '0.00';
	}

	$itemcode = $itemcode;
	include ('autocompletestockcount1include1.php');
	$currentstock = $currentstock;

	$query4 = "select * from master_settings where modulename = 'SALES' and settingsname = 'SALES_ENTRY_STOCK_ALERT' and status <> 'deleted' 
	and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$settingsvalue = $res4["settingsvalue"];
	if ($settingsvalue == 'SHOW ALERT')
	{
		$itemstock = $currentstock;
	
	}
	else
	{
		$itemstock = 'HIDE ALERT';
	}

	
	
	//To get default tax values
	$defaulttax = $_SESSION["defaulttax"];
	if ($defaulttax == '')
	{
		$query3 = "select * from master_tax where auto_number = '$taxanum'";
	}
	else
	{
		$query3 = "select * from master_tax where auto_number = '$defaulttax'";
		$taxanum = $defaulttax;
	}
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$taxparentanum = $res3["auto_number"];
	$taxname = $res3["taxname"];
	$taxpercent = $res3["taxpercent"];
	$taxpercentcalc = $taxpercent;
	
	$taxsubpercenttotal = '';
	$query5 = "select * from master_taxsub where taxparentanum = '$taxparentanum'";
	$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
	while ($res5 = mysql_fetch_array($exec5))
	{
		$taxsubanum = $res5["auto_number"];
		$taxsubname = $res5["taxsubname"];
		$taxsubpercent = $res5["taxsubpercent"];
		
		$taxsubpercenttotal = $taxsubpercenttotal + $taxsubpercent;
	}
	
	if ($taxsubpercenttotal != '')
	{
		//$taxpercentcalc = '10.30';
		$taxsubpercenttotal = $taxsubpercenttotal;
		$taxsubpercenttotal = $taxsubpercenttotal / 10;
		
		$taxpercentcalc = $taxpercentcalc + $taxsubpercenttotal;
	}

	//To calculate reverse tax for the item rate.
	//http://answers.yahoo.com/question/index?qid=20080914103752AAzQ6nk
	//If the item costs 100 including 6.75% tax, then 100 represents 106.75% of the original price. 
	//So you divide 100 by 106.75 and get 93.68 (rounded to the nearest cent).
	//Original Price = Total Price / (1 + Tax Rate)
	//2750 / 2887.5 / 95.24 / 2619.1 / 130.95 / 2750
	//$taxpercent = 10;  //testing value.
	
	$query4 = "select * from master_settings where modulename = 'SALES' and settingsname = 'SALES_TAX_CALCULATE' 
	and status <> 'deleted' and companyanum = '$companyanum' and companycode = '$companycode'";
	$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
	$res4 = mysql_fetch_array($exec4);
	$settingsvalue1 = $res4["settingsvalue"];
	if ($settingsvalue1 == 'REVERSE CALCULATE')
	{
		$taxpercentcalc = $taxpercentcalc;
		$amountwithtax = $taxpercentcalc / 100;
		$amountwithtax = $amountwithtax * $mrp;
		$amountwithtax = $amountwithtax + $mrp;
		$amountwithouttax = $mrp;
		$reversetaxpercent = $amountwithouttax / $amountwithtax;
		$reverseitemamount = $amountwithouttax * $reversetaxpercent;
		$mrp = $reverseitemamount;
	}
	

	if ($searchresult == '')
	{
		$searchresult = ''.$itemcode.'||'.$itemname.'||'.$mrp.'||'.$taxname.'||'.$taxpercent.'||'.$taxanum.'||'.$itemdescription.'||'.$itemstock.'||'.$currentstock.'';
	}
		
	
	if ($searchresult != '')
	{
		echo $searchresult;
	}

?>