<?php
$lastupdate = date('Y-m-d H:i:s');
$billtime = date("H:i:s");
$financialyear = $_SESSION["financialyear"];

//echo $companyanum;
if (isset($_REQUEST["frm1submit1"])) { $frm1submit1 = $_REQUEST["frm1submit1"]; } else { $frm1submit1 = ""; }
//$frm1submit1 = $_REQUEST["frm1submit1"];
if ($frm1submit1 == 'frm1submit1')
{
	$billnumber = $_REQUEST["billnumber"];

	//bill number for bill save.
	$query201 = "select * from master_sales where billnumber = '$billnumber' and companyanum = '$companyanum' and financialyear = '$financialyear'";
	$exec201 = mysql_query($query201) or die ("Error in  Query201".mysql_error());
	$rowcount201 = mysql_fetch_array($exec201);
	if ($rowcount201 != 0) //If bill number already present, go for the latest bill number.
	{
		$query2 = "select max(billnumber) as maxbillnumber from master_sales where companyanum = '$companyanum' and financialyear = '$financialyear'";// order by auto_number desc limit 0, 1";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_fetch_array($exec2);
		$res2billnumber = $res2["maxbillnumber"];
		if ($res2billnumber == '')
		{
			$billnumber = '1';
		}
		else
		{
			$billnumber = $res2["maxbillnumber"];
			$billnumber = $billnumber + 1;
		}
	}
	
	$delbillnumber = $_REQUEST["delbillnumber"];
	if ($delbillnumber != '')
	{
		$billnumber = $delbillnumber; 
	}

	
	$billnumberprefix = $_REQUEST["billnumberprefix"];
	$billnumberpostfix = $_REQUEST["billnumberpostfix"];
	
	$billdate = $_REQUEST["ADate"];
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
	
	
	if (isset($_REQUEST["customertype"])) { $customertype = $_REQUEST["customertype"]; } else { $customertype = ""; }
	//$customertype = $_REQUEST["customertype"];
	if (isset($_REQUEST["customercode"])) { $customercode = $_REQUEST["customercode"]; } else { $customercode = ""; }
	//$customercode = $_REQUEST["customercode"];
	
	$query101 = "select * from master_customer where customercode = '$customercode'";
	$exec101 = mysql_query($query101) or die ("Error in Query101".mysql_error());
	$res101 = mysql_fetch_array($exec101);
	$customeranum = $res101["auto_number"];
	
	$customername = strtoupper($_REQUEST["customer"]);
	$address = strtoupper($_REQUEST["address1"]);
	$location = strtoupper($_REQUEST["area"]);
	$city = strtoupper($_REQUEST["city1"]);
	$state = strtoupper($res101["state"]);
	$pincode = strtoupper($_REQUEST["pincode"]);
	$phone = "";
	$email = "";
	$tinnumber = strtoupper($_REQUEST["customertin"]);
	$cstnumber = strtoupper($_REQUEST["customercst"]);
	$deliveryaddress = $_REQUEST["deliveryaddress"];
	
	$subtotal = $_REQUEST["subtotal"];
	$packaging = $_REQUEST["packaging"];
	$delivery = $_REQUEST["delivery"];
	$totalamount = $_REQUEST["totalamount"];
	$totalquantity = "";
	$billtype = $_REQUEST["billtype"];
	$cash = $_REQUEST["cashamount"];
	$credit = $_REQUEST["creditamount"];
	$creditcard = $_REQUEST["cardamount"];
	$online = $_REQUEST["onlineamount"];
	$creditcardname = strtoupper($_REQUEST["cardname"]);
	$creditcardnumber = strtoupper($_REQUEST["cardnumber"]);
	//$creditcardbank = strtoupper($_REQUEST["bankname"]);
	$bankanum = $_REQUEST["bankname"];
	$query7 = "select * from master_bank where auto_number = '$bankanum'";
	$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
	$res7 = mysql_fetch_array($exec7);
	$creditcardbank = $res7["bankname"];
	
	//$remarks = strtoupper($_REQUEST["remarks"]);
	$remarks = $_REQUEST["remarks"];
	$username = $username;
	$subtotaldiscountrupees = $_REQUEST["subtotaldiscountrupees"];
	$subtotaldiscountpercent = $_REQUEST["subtotaldiscountpercent"];
	if ($subtotaldiscountpercent != '0.00')
	{
		$subtotaldiscounttotal = $subtotal / 100;
		$subtotaldiscounttotal = $subtotaldiscounttotal * $subtotaldiscountpercent;
	}
	else
	{
		$subtotaldiscounttotal = $subtotaldiscountrupees;
	}
	$subtotalafterdiscount = $_REQUEST["afterdiscountamount"];
	
	$subtotalamountdiscountpercent = $_REQUEST["subtotaldiscountpercentapply1"];
	$subtotalamountdiscountamount = $_REQUEST["subtotaldiscountamountapply1"];
	$subtotalaftercombinediscount = $_REQUEST["subtotalaftercombinediscount"];
	
	$subtotalaftertax = $_REQUEST["totalaftertax"];
	
	$deliverymode = "";
	$totalweight = "";
	$roundoff = $_REQUEST["roundoff"];
	//$lastupdate = $billdate;
	
	$cashgivenbycustomer = $_REQUEST["cashgivenbycustomer"];
	$cashgiventocustomer = $_REQUEST["cashgiventocustomer"];
	
	$lastupdateusername = $username;
	$lastupdateipaddress = $ipaddress;
	
	$footerline1 = $_REQUEST["footerline1"];
	$footerline2 = $_REQUEST["footerline2"];
	$footerline3 = $_REQUEST["footerline3"];
	$footerline4 = $_REQUEST["footerline4"];
	$footerline5 = "";
	$footerline6 = "";
	
	$query2 = "select * from settings_approval where modulename = 'sales' and status <> 'deleted'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$approvalrequired = $res2["approvalrequired"];
	if ($approvalrequired == 'YES')	
	{
		$approvalstatus = 'PENDING';
	}
	else 
	{
		$approvalstatus = 'APPROVED';
	}
	
	$query3 = "insert into master_sales (companyanum, billnumber, billdate, customertype, subtotal, customercode, customername, 
	address, location, city, state, pincode, phone, email, tinnumber, cstnumber, 
	roundoff, delivery, totalamount, totalquantity, billtype, cash, credit, online, creditcard, creditcardname, 
	footerline1, footerline2, footerline3, footerline4, footerline5, footerline6, subtotalafterdiscount, subtotalaftertax, 
	creditcardnumber, creditcardbankname, remarks, username, subtotaldiscountrupees, subtotaldiscountpercent, subtotaldiscounttotal, deliverymode, 
	lastupdate, ipaddress, billnumberprefix, billnumberpostfix, packaging, cashgivenbycustomer, cashgiventocustomer, approvalstatus, 
	deliveryaddress, financialyear, 
	subtotalamountdiscountpercent, subtotalamountdiscountamount, subtotalaftercombinediscount) 
	values ('$companyanum', '$billnumber', '$billdate', '$customertype', '$subtotal', '$customercode', '$customername', 
	'$address', '$location', '$city', '$state', '$pincode', '$phone', '$email', '$tinnumber', '$cstnumber',  
	'$roundoff', '$delivery', 
	'$totalamount', '$totalquantity', '$billtype', '$cash', '$credit', '$online', '$creditcard', '$creditcardname', 
	'$footerline1', '$footerline2', '$footerline3', '$footerline4', '$footerline5', '$footerline6', '$subtotalafterdiscount', '$subtotalaftertax', 
	'$creditcardnumber', '$creditcardbank', '$remarks', '$username', '$subtotaldiscountrupees', '$subtotaldiscountpercent', '$subtotaldiscounttotal', '$deliverymode', 
	'$lastupdate', '$lastupdateipaddress', '$billnumberprefix', '$billnumberpostfix', '$packaging', 
	'$cashgivenbycustomer', '$cashgiventocustomer', '$approvalstatus', 
	'$deliveryaddress', '$financialyear', 
	'$subtotalamountdiscountpercent', '$subtotalamountdiscountamount', '$subtotalaftercombinediscount')";
	$exec3 = mysql_query($query3) or die ("Error in Query4".mysql_error());
	
	
	$query3 = "select auto_number from master_sales where companyanum = '$companyanum' and customercode = '$customercode' and lastupdate = '$lastupdate' and 
	billdate = '$billdate' and totalamount = '$totalamount' and billnumber = '$billnumber' and billtype = '$billtype' and financialyear = '$financialyear'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$res3anum = $res3["auto_number"];
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
			$itemcode = $_REQUEST["itemcode".$i];
			
			$query31 = "select * from master_item where itemcode = '$itemcode'"; 
			$exec31 = mysql_query($query31) or die ("Error in Query31".mysql_error());
			$res31 = mysql_fetch_array($exec31);
			$itemunitabb = $res31["unitname_abbreviation"];
			
			$itemname = $_REQUEST["itemname".$i];
			$itemmrp = $_REQUEST["rateperunit".$i];
			$itemquantity = $_REQUEST["quantity".$i];
			$itemdiscountpercent = $_REQUEST["discountpercent".$i];
			$itemdiscountrupees = $_REQUEST["discountrupees".$i];
			$itemtaxpercent = $_REQUEST["taxpercent".$i];
			$itemtaxname = $_REQUEST["taxname".$i];
			$itemtaxautonumber = $_REQUEST["taxautonumber".$i];
			$itemtotalamount = $_REQUEST["totalamount".$i];
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
			$itemanum = $res5["auto_number"];
			$itemname = $res5["itemname"];
			$itemname = addslashes($itemname);
			
			$free = "";
			$openingstock = "";
			$closingstock = "";
			$suppliercode = "";
			$suppliername = "";
		
			$query4 = "insert into sales_details (bill_autonumber, companyanum, 
			billnumber, itemanum, itemcode, itemname, itemdescription, rate, quantity, 
			subtotal, free, discountpercentage, discountrupees, openingstock, closingstock, totalamount, 
			discountamount, username, ipaddress, entrydate, itemtaxpercentage, itemtaxamount, 
			unit_abbreviation, financialyear) 
			values ('$billautonumber', '$companyanum', '$billnumber', '$itemanum', '$itemcode', '$itemname', '$itemdescription', '$itemmrp', '$itemquantity', 
			'$itemsubtotal', '$free', '$itemdiscountpercent', '$itemdiscountrupees', '$openingstock', '$closingstock', 
			'$itemtotalamount', '$discountamount', '$username', '$ipaddress', '$billdate', 
			'$itemtaxpercent', '$itemtaxamount', 
			'$itemunitabb', '$financialyear')";
			$exec4 = mysql_query($query4) or die ("Error in Query4".mysql_error());
			
			$query41 = "insert into master_stock (itemcode, itemname, transactiondate, transactionmodule, 
			transactionparticular, billautonumber, billnumber, quantity, remarks, 
			customercode, customername, suppliercode, suppliername, username, ipaddress, rateperunit, totalrate, 
			companyanum, companyname, financialyear) 
			values ('$itemcode', '$itemname', '$billdate', 'SALES', 
			'BY SALES (BILL NO: $billnumber )', '$billautonumber', '$billnumber', '$itemquantity', '$remarks', 
			'$customercode', '$customername', '$suppliercode', '$suppliername', '$username', '$ipaddress', '$itemmrp', '$itemsubtotal', 
			'$companyanum', '$companyname', '$financialyear')";
			$res41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
		
			$taxtype = 'main';
			$taxamount = $itemtotalamount / 100;
			$taxamount = $taxamount * $itemtaxpercent;
			$taxamount = round($taxamount, 2);
			$amountaftertax = "";
		
			if ($itemcode != '')
			{
				$query7 = "insert into sales_tax (bill_autonumber, billnumber, itemanum, itemcode, itemname, 
				itemrate, itemquantity, taxtype, 
				tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
				updatedate, companyanum, companyname, financialyear) 
				values ('$billautonumber', '$billnumber', '$itemanum', '$itemcode',  '$itemname',  
				'$itemmrp',  '$itemquantity', '$taxtype', 
				'$itemtaxautonumber', '$itemtaxname', '$itemtaxpercent', '$taxamount', 
				'$amountaftertax', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname', '$financialyear')";
				$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
				
			}
	
		$query72 = "select * from master_taxsub where taxparentanum = '$itemtaxautonumber' and status <> 'deleted'";
		$exec72 = mysql_query($query72) or die ("Error in Query72".mysql_error());
		$rowcount72 = mysql_num_rows($exec72);
		while ($res72 = mysql_fetch_array($exec72))
		{
			$taxsubtype = 'sub';
			$taxsub_autonumber = $res72["auto_number"];
			$taxsubname = $res72["taxsubname"];
			$taxsubpercent = $res72["taxsubpercent"];
		
			$taxsubamount = $taxamount / 100;
			$taxsubamount = $taxsubamount * $taxsubpercent;  //with main tax amount.
			$taxsubamount = round($taxsubamount, 2);
			
			//if ($taxsub_autonumber != '')
			if ($rowcount72 != 0)
			{
				if ($itemcode != '')
				{
					$query8 = "insert into sales_tax (bill_autonumber, billnumber, itemcode, itemname, itemrate, itemquantity, taxtype, 
					tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
					updatedate, companyanum, companyname, financialyear) 
					values ('$billautonumber', '$billnumber', '$itemcode',  '$itemname',  '$itemrate',  '$itemquantity', '$taxsubtype', 
					'$taxsub_autonumber', '$taxsubname', '$taxsubpercent', '$taxsubamount', 
					'$amountaftertaxsub', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname', '$financialyear')";
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
	
	
	$query6 = "select * from master_transaction order by auto_number desc limit 0, 1";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	$rowcount6 = mysql_num_rows($exec6);
	if ($rowcount6 == 0)
	{
		$transactioncode = 'TRS00000001';
	}
	else
	{
		$res6 = mysql_fetch_array($exec6);
		$transactioncode = $res6["transactioncode"];
		$transactioncode = substr($transactioncode, 3, 8);
		$transactioncode = intval($transactioncode);
		$transactioncode = $transactioncode + 1;
	
		$maxanum = $transactioncode;
		if (strlen($maxanum) == 1)
		{
			$maxanum1 = '0000000'.$maxanum;
		}
		else if (strlen($maxanum) == 2)
		{
			$maxanum1 = '000000'.$maxanum;
		}
		else if (strlen($maxanum) == 3)
		{
			$maxanum1 = '00000'.$maxanum;
		}
		else if (strlen($maxanum) == 4)
		{
			$maxanum1 = '0000'.$maxanum;
		}
		else if (strlen($maxanum) == 5)
		{
			$maxanum1 = '000'.$maxanum;
		}
		else if (strlen($maxanum) == 6)
		{
			$maxanum1 = '00'.$maxanum;
		}
		else if (strlen($maxanum) == 7)
		{
			$maxanum1 = '0'.$maxanum;
		}
		else if (strlen($maxanum) == 8)
		{
			$maxanum1 = $maxanum;
		}
		
		$transactioncode = 'TRS'.$maxanum1;
	
		//echo $transactioncode;
	}
	//echo $transactioncode;


	$transactiondate = $updatedatetime;
	$customeranum = $customeranum;
	$customername = $customername;
	$transactionamount = $totalamount;
	$ipaddress = $ipaddress;
	$updatedate = $updatedatetime;
	
	//to update transaction master form transaction report.
	$transactiontype1 = 'SALES';
	$transactionmode1 = 'SALES';
	$transactionmodule1 = 'SALES';
	$particulars1 = 'BY SALES (BILL NO:'.$billnumberprefix.$billnumber.')';	
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount, billnumber, billanum, ipaddress, 
	updatedate, balanceamount, companyanum, companyname, transactionmodule, approvalstatus, financialyear) 
	values ('$transactiondate', '$particulars1', '$customeranum', '$customername', 
	'$transactionmode1', '$transactiontype1', '$transactionamount', '$billnumber',  '$billautonumber', 
	'$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
	'$transactionmodule1', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	
	
	$cashamount = $_REQUEST["cashamount"];
	$onlineamount = $_REQUEST["onlineamount"];
	$creditamount = $_REQUEST["creditamount"];
	$chequeamount = $_REQUEST["chequeamount"];
	$cardamount = $_REQUEST["cardamount"];
	$writeoffamount = $_REQUEST["writeoffamount"];
	$chequenumber = $_REQUEST["chequenumber"];
	$chequedate = $_REQUEST["chequedate"];
	$bankname = $_REQUEST["bankname"];
	$tdsamount = $_REQUEST["tdsamount"];
	
	if ($creditamount != '0.00')
	{
		$balanceamount = $balanceamount + $creditamount;
	}
	
	if ($cashamount != '0.00')
	{
		$transactiontype = 'COLLECTION';
		$transactionmode = 'CASH';
		$particulars = 'BY CASH (BILL NO:'.$billnumberprefix.$billnumber.')';	
		//include ("transactioninsert1.php");
		$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
		transactionmode, transactiontype, transactionamount, cashamount,
		billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, 
		transactionmodule, approvalstatus, financialyear) 
		values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
		'$transactionmode', '$transactiontype', '$transactionamount', '$cashamount', 
		'$billnumber',  '$billautonumber', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
		'$transactionmodule1', '$approvalstatus', '$financialyear')";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}
	
	if ($creditamount != '0.00')
	{
		$transactiontype = 'COLLECTION';
		$transactionmode = 'CREDIT';
		$particulars = 'BY CREDIT (BILL NO:'.$billnumberprefix.$billnumber.')';	
		//include ("transactioninsert1.php");
		$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
		transactionmode, transactiontype, transactionamount, creditamount,
		billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, 
		transactionmodule, approvalstatus, financialyear) 
		values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
		'$transactionmode', '$transactiontype', '$transactionamount', '$creditamount', 
		'$billnumber',  '$billautonumber', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
		'$transactionmodule1', '$approvalstatus', '$financialyear')";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}
	
	if ($onlineamount != '0.00')
	{
		$transactiontype = 'COLLECTION';
		$transactionmode = 'ONLINE';
		$particulars = 'BY ONLINE (BILL NO:'.$billnumberprefix.$billnumber.')';	
		//include ("transactioninsert1.php");
		$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
		transactionmode, transactiontype, transactionamount, onlineamount,
		billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, 
		transactionmodule, approvalstatus, financialyear) 
		values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
		'$transactionmode', '$transactiontype', '$transactionamount', '$onlineamount', 
		'$billnumber',  '$billautonumber', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
		'$transactionmodule1', '$approvalstatus', '$financialyear')";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}
	
	if ($cardamount != '0.00')
	{
		$transactiontype = 'COLLECTION';
		$transactionmode = 'CREDIT CARD';
		$particulars = 'BY CREDIT CARD (BILL NO:'.$billnumberprefix.$billnumber.')';	
		//include ("transactioninsert1.php");
		$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
		transactionmode, transactiontype, transactionamount, cardamount,
		billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, 
		transactionmodule, approvalstatus, financialyear) 
		values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
		'$transactionmode', '$transactiontype', '$transactionamount', '$cardamount', 
		'$billnumber',  '$billautonumber', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
		'$transactionmodule1', '$approvalstatus', '$financialyear')";
		$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}

	if ($chequeamount != '0.00')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'CHEQUE';
	$particulars = 'BY CHEQUE (BILL NO:'.$billnumberprefix.$billnumber.')';		
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount,
	chequeamount,chequenumber, billnumber, billanum, 
	chequedate, bankname, bankbranch, ipaddress, updatedate, balanceamount, companyanum, companyname, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
	'$transactionmode', '$transactiontype', '$transactionamount',
	'$chequeamount','$chequenumber',  '$billnumber',  '$billautonumber', 
	'$chequedate', '$bankname', '$bankbranch','$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
	'$transactionmodule1', '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());

	}
	
/*	if ($writeoffamount != '0.00')
	{
	$transactiontype = 'COLLECTION';
	$transactionmode = 'WRITEOFF';
	$particulars = 'BY WRITEOFF (BILL NO:'.$billnumberprefix.$billnumber.')';		
	//include ("transactioninsert1.php");
	$query9 = "insert into master_transaction (transactiondate, particulars, customeranum, customername, 
	transactionmode, transactiontype, transactionamount, writeoffamount,
	billnumber, billanum, ipaddress, updatedate, balanceamount, companyanum, companyname, 
	transactionmodule, approvalstatus, financialyear) 
	values ('$transactiondate', '$particulars', '$customeranum', '$customername', 
	'$transactionmode', '$transactiontype', '$transactionamount', '$writeoffamount', 
	'$billnumber',  '$billautonumber', '$ipaddress', '$updatedate', '$balanceamount', '$companyanum', '$companyname', 
	'$transactionmodule1, '$approvalstatus', '$financialyear')";
	$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
	}
*/	

	header ("location:sales1.php?src=frm1submit1&&st=success&&billnumber=$billnumber&&billautonumber=$billautonumber&&companyanum=$companyanum&&titlestr=SALES BILL");
	exit;


}


//bill number for bill save.
$query2 = "select max(billnumber) as maxbillnumber from master_sales where companyanum = '$companyanum' and financialyear = '$financialyear'";// order by auto_number desc limit 0, 1";
$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
$res2 = mysql_fetch_array($exec2);
//$res2billnumber = $res2["billnumber"];
$res2billnumber = $res2["maxbillnumber"];
if ($res2billnumber == '')
{
	//$billnumber = 'SBL00000001';
	$billnumber = '1';
}
else
{
	$billnumber = $res2["maxbillnumber"];
	//$billnumber = substr($res2billnumber, 3, 8);
	//$billnumber = intval($billnumber);
	$billnumber = $billnumber + 1;

}
//echo $billnumber;



	$query2 = "select * from settings_bill where companyanum = '$companyanum'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	$res2 = mysql_fetch_array($exec2);
	$f18=$res2["f18"];
	$f19=$res2["f19"];
	$f21=$res2["f21"];
	$f22=$res2["f22"];
	
	$billnumberprefix = $res2["billnumberprefix"];
	$billnumberprefix = strtoupper($billnumberprefix);
	$billnumberprefix = trim($billnumberprefix);

	$billnumberpostfix = $res2["billnumberpostfix"];
	$billnumberpostfix = strtoupper($billnumberpostfix);
	$billnumberpostfix = trim($billnumberpostfix);
	
	//$reftext = $res2["reftext"];
	//$billstarttext  = $res2["billstarttext"];
	//$billendtext = $res2["billendtext"];
	$f29 = $res2["f29"];
	$f30 = $res2["f30"];
	$footerline1 = $res2["f18"];
	$footerline2 = $res2["f19"];
	$footerline3 = $res2["f21"];
	$footerline4 = $res2["22"];
	$footerline5 = $res2["f25"];
	$footerline6 = $res2["f26"];



?>