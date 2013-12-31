<?php
session_start();
//Called from sales1.php - autoitemsearch2.js
include ("db/db_connect.php");
$companyanum = $_SESSION['companyanum'];
$companyname = $_SESSION['companyname'];
$itemcode=$_REQUEST['itemcode'];
$searchresult = "";

	$query2 = "select * from master_item where itemcode = '$itemcode'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$itemcode = $res2['itemcode'];
	$itemname = $res2['itemname'];
	//$mrp = $res2['rateperunit'];
	$mrp = $res2['purchaseprice'];
	$taxanum = $res2['taxanum'];
	$itemdescription = $res2['description'];
	
	//To get default tax values
	$defaulttax = $_SESSION['defaulttax'];
	if ($defaulttax == '')
	{
		$query3 = "select * from master_tax where auto_number = '$taxanum'";
	}
	else
	{
		$query3 = "select * from master_tax where auto_number = '$defaulttax'";
		$taxanum = $defaulttax;
	}

	$itemcode = $itemcode;
	include ('autocompletestockcount1include1.php');
	$currentstock = $currentstock;

	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$taxname = $res3['taxname'];
	$taxpercent = $res3['taxpercent'];
	
	
	//To calculate reverse tax for the item rate.
	//http://answers.yahoo.com/question/index?qid=20080914103752AAzQ6nk
	//If the item costs 100 including 6.75% tax, then 100 represents 106.75% of the original price. 
	//So you divide 100 by 106.75 and get 93.68 (rounded to the nearest cent).
	//Original Price = Total Price / (1 + Tax Rate)
	//2750 / 2887.5 / 95.24 / 2619.1 / 130.95 / 2750
	//$taxpercent = 10;  //testing value.
	
	//To avoid conflict with existing customer installations
	$tables = mysql_list_tables ($databasename);
	while (list ($temp) = mysql_fetch_array ($tables)) 
	{
		if ($temp == 'master_settings') 
		{
			//return TRUE;
			//echo "Table Found";
			$query4 = "select * from master_settings where modulename = 'PURCHASE' and settingsname = 'PURCHASE_TAX_CALCULATE' and status <> 'deleted'";
			$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
			$res4 = mysql_fetch_array($exec4);
			$settingsvalue1 = $res4['settingsvalue'];
			if ($settingsvalue1 == 'REVERSE CALCULATE')
			{
				$amountwithtax = $taxpercent / 100;
				$amountwithtax = $amountwithtax * $mrp;
				$amountwithtax = $amountwithtax + $mrp;
				$amountwithouttax = $mrp;
				$reversetaxpercent = $amountwithouttax / $amountwithtax;
				$reverseitemamount = $amountwithouttax * $reversetaxpercent;
				$mrp = $reverseitemamount;
			}
		}
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