<?php
$lastupdate = date('Y-m-d H:i:s');
$billtime = date("H:i:s");
$financialyear = $_SESSION["financialyear"];

//echo $companyanum;
if (isset($_REQUEST["frm1submit1"])) { $frm1submit1 = $_REQUEST["frm1submit1"]; } else { $frm1submit1 = ""; }
//$frm1submit1 = $_REQUEST["frm1submit1"];
if ($frm1submit1 == 'frm1submit1')
{
	$billnumber = $_REQUEST['billnumber'];

	//bill number for bill save.
	$query201 = "select * from master_production where billnumber = '$billnumber' and recordstatus <> 'DELETED' and companyanum = '$companyanum'";
	$exec201 = mysql_query($query201) or die ("Error in  Query201".mysql_error());
	$rowcount201 = mysql_fetch_array($exec201);
	if ($rowcount201 != 0) //If bill number already present, go for the latest bill number.
	{
		$query2 = "select max(billnumber) as maxbillnumber from master_production where companyanum = '$companyanum'";// order by auto_number desc limit 0, 1";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_fetch_array($exec2);
		$res2billnumber = $res2['maxbillnumber'];
		if ($res2billnumber == '')
		{
			$billnumber = '1';
		}
		else
		{
			$billnumber = $res2['maxbillnumber'];
			$billnumber = $billnumber + 1;
		}
	}
	
	
	$delbillnumber = $_REQUEST["delbillnumber"];
	if ($delbillnumber != '')
	{
		$billnumber = $delbillnumber; 
	}

	
	$billdate = $_REQUEST['ADate'];
	/*
	$dotarray = explode("-", $billdate);
	//print_r($dotarray);
	$billyear = $dotarray[2];
	$billyear = substr($billyear, 0, 4);
	$billmonth = $dotarray[1];
	$billday = $dotarray[0];
	$billtime = date("H:i:s");
	$billdate = $billyear.'-'.$billmonth.'-'.$billday.' '.$billtime;
	$billdate = $billdate.' '.$billtime;
	*/
	
	
	$totalunitsproduced = $_REQUEST['totalunitsproduced'];
	$costperunit = $_REQUEST['costperunit'];
	$subtotal = $_REQUEST['subtotal'];
	$packaging = $_REQUEST['packaging'];
	$delivery = $_REQUEST['delivery'];
	$totalamount = $_REQUEST['totalamount'];
	$totalquantity = "";
	$remarks = strtoupper($_REQUEST['remarks']);
	$username = $username;
	
	$subtotalaftertax = $_REQUEST['totalaftertax'];
	
	
	$deliverymode = "";
	$totalweight = "";
	$roundoff = $_REQUEST['roundoff'];
	//$lastupdate = $billdate;
	$lastupdateusername = $username;
	$lastupdateipaddress = $ipaddress;
	
	$enditemcode = $_REQUEST['enditemcode'];
	$query311 = "select * from master_item where itemcode = '$enditemcode'"; 
	$exec311 = mysql_query($query311) or die ("Error in Query311".mysql_error());
	$res311 = mysql_fetch_array($exec311);
	$enditemcode = $res311['itemcode'];
	$enditemname = $res311['itemname'];

	
	$query3 = "insert into master_production (companyanum, billnumber, billdate, subtotal, roundoff, totalamount, 
	totalquantity, remarks, totalunitsproduced, costperunit, subtotalaftertax, username, lastupdate, 
	ipaddress, enditemcode, enditemname) 	
	values ('$companyanum', '$billnumber', '$billdate', '$subtotal', '$roundoff', '$totalamount', 
	'$totalquantity', '$remarks', '$totalunitsproduced', '$costperunit', '$subtotalaftertax', '$username', '$lastupdate', 
	'$ipaddress', '$enditemcode', '$enditemname')";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	
	
	$query3 = "select auto_number from master_production  where companyanum = '$companyanum' and lastupdate = '$lastupdate' and 
	billdate = '$billdate' and totalamount = '$totalamount' and billnumber = '$billnumber'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$res3anum = $res3['auto_number'];
	$billautonumber = $res3anum;

	for ($i=1;$i<=1000;$i++)
	{
		if (isset($_REQUEST["serialnumber".$i]))
		{
			$serialnumber = $_REQUEST["serialnumber".$i];
		}
		else
		{
			$serialnumber = "";
		}
		//$serialnumber = $_REQUEST["serialnumber".$i];
		if ($serialnumber != '')
		{
			$itemcode = $_REQUEST['itemcode'.$i];
			
			$query31 = "select * from master_item where itemcode = '$itemcode'"; 
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$itemunitabb = $res31['unitname_abbreviation'];
			
			$itemname = $_REQUEST['itemname'.$i];
			$itemmrp = $_REQUEST['rateperunit'.$i];
			$itemquantity = $_REQUEST['quantity'.$i];
			$itemdiscountpercent = $_REQUEST['discountpercent'.$i];
			$itemdiscountrupees = $_REQUEST['discountrupees'.$i];
			$itemtaxpercent = $_REQUEST['taxpercent'.$i];
			$itemtaxname = $_REQUEST['taxname'.$i];
			$itemtaxautonumber = $_REQUEST['taxautonumber'.$i];
			$itemtotalamount = $_REQUEST['totalamount'.$i];
			if (isset($_REQUEST["itemdescription".$i]))
			{
				$itemdescription = $_REQUEST["itemdescription".$i];
			}
			else
			{
				$itemdescription = "";
			}
			
			$itemsubtotal = $itemmrp * $itemquantity;
			
			$itemtaxamount = $itemsubtotal / 100;
			$itemtaxamount = $itemtaxamount * $itemtaxpercent;
			
			if ($itemdiscountpercent != '0.00')
			{
				$discountamount = $itemsubtotal * $itemdiscountpercent;
				$discountamount = $discountamount / 100;
				
			}
			else
			{
				$discountamount = $itemdiscountrupees;
			}
			
			$query5 = "select * from master_item where itemcode = '$itemcode'";
			$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
			$res5 = mysql_fetch_array($exec5);
			$itemanum = $res5['auto_number'];
			$itemname = $res5['itemname'];
			$itemname = addslashes($itemname);
			
			$free = "";
			$openingstock = "";
			$closingstock = "";
			//$suppliercode = "";
			//$suppliername = "";
			
			$query4 = "insert into production_details (bill_autonumber, companyanum, 
			billnumber, itemanum, itemcode, itemname, itemdescription, rate, quantity, 
			subtotal, free, discountpercentage, discountrupees, openingstock, closingstock, totalamount, 
			discountamount, username, ipaddress, entrydate, itemtaxpercentage, itemtaxamount, unit_abbreviation) 
			values ('$billautonumber', '$companyanum', '$billnumber', '$itemanum', '$itemcode', '$itemname', '$itemdescription', '$itemmrp', '$itemquantity', 
			'$itemsubtotal', '$free', '$itemdiscountpercent', '$itemdiscountrupees', '$openingstock', '$closingstock', 
			'$itemtotalamount', '$discountamount', '$username', '$ipaddress', '$billdate', 
			'$itemtaxpercent', '$itemtaxamount', '$itemunitabb')";
			$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
			
			/*
			$query41 = "insert into master_stock (itemcode, itemname, transactiondate, transactionmodule, 
			transactionparticular, billautonumber, billnumber, quantity, remarks, 
			customercode, customername, suppliercode, suppliername, username, ipaddress, rateperunit, totalrate, 
			companyanum, companyname) 
			values ('$itemcode', '$itemname', '$billdate', 'production', 
			'BY PRODUCTION (BILL NO: $billnumber )', '$billautonumber', '$billnumber', '$itemquantity', '$remarks', 
			'$customercode', '$customername', '$suppliercode', '$suppliername', '$username', '$ipaddress', '$itemmrp', '$itemsubtotal', 
			'$companyanum', '$companyname')";
			$res41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
			*/
			
			$taxtype = 'main';
			$taxamount = $itemtotalamount / 100;
			$taxamount = $taxamount * $itemtaxpercent;
			$taxamount = round($taxamount, 2);
			$amountaftertax = "";
			
			if ($itemcode != '')
			{
				$query7 = "insert into production_tax (bill_autonumber, billnumber, itemanum, itemcode, itemname, 
				itemrate, itemquantity, taxtype, 
				tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
				updatedate, companyanum, companyname) 
				values ('$billautonumber', '$billnumber', '$itemanum', '$itemcode',  '$itemname',  
				'$itemmrp',  '$itemquantity', '$taxtype', 
				'$itemtaxautonumber', '$itemtaxname', '$itemtaxpercent', '$taxamount', 
				'$amountaftertax', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname')";
				$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
			}
	
		$query72 = "select * from master_taxsub where taxparentanum = '$itemtaxautonumber' and status <> 'deleted'";
		$exec72 = mysql_query($query72) or die ("Error in Query72".mysql_error());
		$rowcount72 = mysql_num_rows($exec72);
		while ($res72 = mysql_fetch_array($exec72))
		{
			$taxsubtype = 'sub';
			$taxsub_autonumber = $res72['auto_number'];
			$taxsubname = $res72['taxsubname'];
			$taxsubpercent = $res72['taxsubpercent'];
		
			$taxsubamount = $taxamount / 100;
			$taxsubamount = $taxsubamount * $taxsubpercent;  //with main tax amount.
			$taxsubamount = round($taxsubamount, 2);
			
			//if ($taxsub_autonumber != '')
			if ($rowcount72 != 0)
			{
				if ($itemcode != '')
				{
					$query8 = "insert into production_tax (bill_autonumber, billnumber, itemcode, itemname, itemrate, itemquantity, taxtype, 
					tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
					updatedate, companyanum, companyname) 
					values ('$billautonumber', '$billnumber', '$itemcode',  '$itemname',  '$itemrate',  '$itemquantity', '$taxsubtype', 
					'$taxsub_autonumber', '$taxsubname', '$taxsubpercent', '$taxsubamount', 
					'$amountaftertaxsub', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname')";
					$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
				}
			}
			$taxsubtype = '';
			$taxsub_autonumber = '';
			$taxsubname = '';
			$taxsubpercent = '';
			$taxsubamount = '';
		}
				
		$taxtype = '';
		$itemcode = '';
		$itemname = '';
		$itemrate = '';
		$itemquantity = '';
		$subtotal = '';
		$itemtaxpercent = '';
		$itemtaxamount = '';
		$itemtaxautonum = '';
		$itemtaxname = '';
		$taxamount = '';

		}	
	}
	
	header ("location:productionentry1.php?src=frm1submit1&&st=success&&billnumber=$billnumber&&billautonumber=$billautonumber&&companyanum=$companyanum&&titlestr=PRODUCTION");
	exit;


}


//bill number for bill save.
$query2 = "select max(billnumber) as maxbillnumber from master_production where companyanum = '$companyanum'";// order by auto_number desc limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
$res2billnumber = $res2['maxbillnumber'];
if ($res2billnumber == '')
{
	//$billnumber = 'SBL00000001';
	$billnumber = '1';
}
else
{
	$billnumber = $res2['maxbillnumber'];
	//$billnumber = substr($res2billnumber, 3, 8);
	//$billnumber = intval($billnumber);
	$billnumber = $billnumber + 1;

}





?>