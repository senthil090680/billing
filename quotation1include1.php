<?php

if (isset($_REQUEST["cbfrmflag1"])) { $cbfrmflag1 = $_REQUEST["cbfrmflag1"]; } else { $cbfrmflag1 = ""; }
//$cbfrmflag1 = $_POST["cbfrmflag1"];
if ($cbfrmflag1 == 'cbfrmflag1')
{

	//$cbcustomername = $_REQUEST["cbcustomername"];
	$cbcustomeranum = $_REQUEST["cbcustomername"];
	$query1 = "select * from master_customer where auto_number = '$cbcustomeranum'";
	$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
	$res1 = mysql_fetch_array($exec1);
	
	$cbcustomername = $res1["customername"];
	$cbres1customeranum = $res1["auto_number"];
	$customername = $res1["customername"];
	$contactperson1 = $res1["contactperson1"];
	$title1 = $res1["title1"];
	$designation1 = $res1["designation1"];
	$department1 = $res1["department1"];
	$address = $res1["address"];
	$location = $res1["location"];
	$city = $res1["city"];
	$pincode1 = $res1["pincode"];
	$state = $res1["state"];
	$phonenumber1 = $res1["phonenumber1"];
	$emailid1 = $res1["emailid1"];
	
	$cbtax = $_REQUEST["cbtax"];
	
}

if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_POST["frmflag1"];
if ($frmflag1 == 'frmflag1')
{

	$quotationnumber  = $_REQUEST["quotationnumber"];
	
	//bill number for bill save.
	$query201 = "select * from master_quotation where quotationnumber = '$quotationnumber' and status <> 'DELETED' and companyanum = '$companyanum'";
	$exec201 = mysql_query($query201) or die ("Error in  Query201".mysql_error());
	$rowcount201 = mysql_fetch_array($exec201);
	if ($rowcount201 != 0) //If bill number already present, go for the latest bill number.
	{
		$query2 = "select max(quotationnumber) as maxbillnumber from master_quotation where companyanum = '$companyanum'";// order by auto_number desc limit 0, 1";
		$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
		$res2 = mysql_fetch_array($exec2);
		$res2billnumber = $res2["maxbillnumber"];
		if ($res2billnumber == '')
		{
			$quotationnumber = '1';
		}
		else
		{
			$quotationnumber = $res2["maxbillnumber"];
			$quotationnumber = $quotationnumber + 1;
		}
	}
	
	if (isset($_REQUEST["delbillnumber"])) { $delbillnumber = $_REQUEST["delbillnumber"]; } else { $delbillnumber = ""; }
	//$delbillnumber = $_REQUEST["delbillnumber"];
	if ($delbillnumber != '')
	{
		$quotationnumber = $delbillnumber; 
	}



	$customernameprefix1 = $res1["customernameprefix1"];
	$quotationdate1 = $_REQUEST["ADate1"];
	
	$customercode = $_REQUEST["customercode"];
	$query45 = "select * from master_customer where customercode = '$customercode'";
	$exec45 = mysql_query($query45) or die ("Error in Query45".mysql_error());
	$res45 = mysql_fetch_array($exec45);
	$customeranum = $res45["auto_number"];
	
	$customername = $_REQUEST["customername"];
	$contactperson1 = $_REQUEST["contactperson1"];
	$title1 = $_REQUEST["title1"];
	$designation1 = $_REQUEST["designation1"];
	$department1 = $_REQUEST["department1"];
	$contactperson2 = $_REQUEST["contactperson2"];
	$title2 = $_REQUEST["title2"];
	$designation2 = $_REQUEST["designation2"];
	$department2 = $_REQUEST["department2"];
	$contactperson3 = $_REQUEST["contactperson3"];
	$title3 = $_REQUEST["title3"];
	$designation3 = $_REQUEST["designation3"];
	$department3 = $_REQUEST["department3"];
	
	$address = $_REQUEST["address"];
	$location = $_REQUEST["location"];
	$city = $_REQUEST["city"];
	$state = $_REQUEST["state"];
	$pincode1 = $_REQUEST["pincode1"];
	
	//$phonenumber1 = $_REQUEST["phonenumber1"];
	//$emailid1 = $_REQUEST["emailid1"];
	$phonenumber1 = "";
	$emailid1 = "";

	$quotationnumberprefix = $_REQUEST["quotationnumberprefix"];
	$quotationnumberprefix = strtoupper($quotationnumberprefix);
	$quotationnumberprefix = trim($quotationnumberprefix);
	
	
	$deartext  = $_REQUEST["deartext"];
	$subtext = $_REQUEST["subtext"];
	$reftext = $_REQUEST["reftext"];
	$quotationstarttext  = $_REQUEST["quotationstarttext"];
	$tcline1 = $_REQUEST["tcline1"];
	$tcline2 = $_REQUEST["tcline2"];
	$tcline3 = $_REQUEST["tcline3"];
	$tcline4 = $_REQUEST["tcline4"];
	$tcline5 = $_REQUEST["tcline5"];
	$tcline6 = $_REQUEST["tcline6"];
	$tcline7 = $_REQUEST["tcline7"];
	$tcline8 = $_REQUEST["tcline8"];
	$quotationendtext = $_REQUEST["quotationendtext"];
	$footerline1 = $_REQUEST["footerline1"];
	$footerline2 = $_REQUEST["footerline2"];
	$footerline3 = $_REQUEST["footerline3"];
	$footerline4 = $_REQUEST["footerline4"];
	$footerline5 = $_REQUEST["footerline5"];
	$footerline6 = $_REQUEST["footerline6"];
	
	$subtotalamount = $_REQUEST["subtotalamount"];
	
	//$totaldiscountpercent = $_REQUEST["totaldiscountpercent"];
	//$totaldiscountamount = $_REQUEST["totaldiscountamount"];
	//$totalafterdiscount = $_REQUEST["totalafterdiscount"];	
	$totaldiscountpercent = "";
	$totaldiscountamount = "";
	$totalafterdiscount = "";
	
	$totalaftertax = $_REQUEST["totalaftertax"];
	//$totalaftertax = $subtotalamount + $taxamount;
	$transportation = $_REQUEST["transportation"];
	$packaging = $_REQUEST["packaging"];
	$roundoff = $_REQUEST["roundoff"];
	$totalamount = $_REQUEST["netamount"];
	
	//$remarks = $_REQUEST["remarks"];	
	$remarks = "";
	$lumpsum = $_REQUEST["lumpsum"];	

	$taxamount = "";
	$custid = "";
	$custname = "";
	
	$query2 = "insert into master_quotation (customeranum, customernameprefix1, customername, 
	contactperson1, title1, designation1, department1, 
	contactperson2, title2, designation2, department2,
	contactperson3, title3, designation3, department3,
	address, location, 
	city, state, pincode, phone, email, lumpsum, subtotal, totaldiscountpercent, totaldiscountamount, totalafterdiscount, 
	totaltax, totalaftertax, transportation, totalamount, remarks, 
	quotationnumberprefix, quotationnumber, deartext, subtext, reftext, quotationstarttext, 
	tcline1, tcline2, tcline3, tcline4, tcline5, tcline6, tcline7, tcline8, 
	quotationendtext, footerline1, footerline2, footerline3, 
	footerline4, footerline5, footerline6, 
	updatedate, ipaddress, companyanum, companyname,cstid,cstname, packaging, roundoff, quotationdate, financialyear) 
	values ('$customeranum', '$customernameprefix1', '$customername', 
	'$contactperson1', '$title1', '$designation1', '$department1', 
	'$contactperson2', '$title2', '$designation2', '$department2', 
	'$contactperson3', '$title3', '$designation3', '$department3', 
	'$address', '$location', '$city', '$state', '$pincode1', '$phonenumber1', '$emailid1', '$lumpsum', 
	'$subtotalamount', '$totaldiscountpercent', '$totaldiscountamount', '$totalafterdiscount', 
	'$taxamount', '$totalaftertax', '$transportation', '$totalamount', '$remarks', 
	'$quotationnumberprefix', '$quotationnumber', '$deartext', '$subtext', '$reftext', '$quotationstarttext', 
	'$tcline1', '$tcline2', '$tcline3', '$tcline4', '$tcline5', '$tcline6', '$tcline7', '$tcline8', 
	'$quotationendtext', '$footerline1', '$footerline2', '$footerline3', 
	'$footerline4', '$footerline5', '$footerline6',  
	'$updatedatetime', '$ipaddress', '$companyanum', '$companyname','$custid','$custname', '$packaging', '$roundoff', 
	'$quotationdate1', '$financialyear')";
	$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
	//echo "<br><br>";
	
	//$query3 = "select auto_number from master_quotation where customername = '$customername' and updatedate = '$updatedatetime'";
	$query3 = "select auto_number from master_quotation where quotationnumber = '$quotationnumber' and status <> 'DELETED' and updatedate = '$updatedatetime'";
	$exec3 = mysql_query($query3) or die ("Error in Query3".mysql_error());
	$res3 = mysql_fetch_array($exec3);
	$res3anum = $res3["auto_number"];
	//exit;
	
	for ($i=1;$i<=$totalnumberofitem;$i++)
	{
		if (isset($_REQUEST["categoryname".$i])) { $cbcategoryname = $_REQUEST["categoryname".$i]; } else { $cbcategoryname = ""; }
		//$cbcategoryname = $_REQUEST["categoryname".$i];
		if ($cbcategoryname != '')
		{
			//$cbcategoryname = $_REQUEST["categoryname".$i];
			
			$cbitemcode = $_REQUEST["itemcode".$i];
			$cbitemname = $_REQUEST["itemname".$i];
			$cbunitname = $_REQUEST["unitname".$i];
			$cbrateperunit = $_REQUEST["rateperunit".$i];
			$cbquantity = $_REQUEST["quantity".$i];
			$cbsubtotal = $_REQUEST["subtotal".$i];
			
			if (isset($_REQUEST["discountpercent".$i])) { $cbdiscountpercent = $_REQUEST["discountpercent".$i]; } else { $cbdiscountpercent = ""; }
			//$cbdiscountpercent = $_REQUEST["discountpercent".$i];
			
			if ($cbdiscountpercent != '0.00')
			{
				//$cbtaxamount = $_REQUEST["taxamount".$i];
				$cbdiscountamount = $cbsubtotal / 100;
				$cbdiscountamount = $cbdiscountamount * $cbdiscountpercent;
				$cbdiscountamount = round($cbdiscountamount, 2);
			}
			//else
			//{
				$cbdiscountamount = $_REQUEST["discountamount".$i];
				$cbdiscountamount = round($cbdiscountamount, 2);
			//}
		
			$cbtotalamount = $_REQUEST["totalamount".$i];
			
			$cbtaxpercent = $_REQUEST["taxpercent".$i];
			//$cbtaxamount = $_REQUEST["taxamount".$i];
			$cbtaxamount = $cbtotalamount / 100;
			$cbtaxamount = $cbtaxamount * $cbtaxpercent;
			$cbtaxamount = round($cbtaxamount, 2);
			
			if (isset($_REQUEST["additionaltext".$i])) { $additionaltext = $_REQUEST["additionaltext".$i]; } else { $additionaltext = ""; }
			//$additionaltext = $_REQUEST["additionaltext".$i];
			
			$query7 = "select * from master_category where categoryname = '$cbcategoryname'";
			$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
			$res7 = mysql_fetch_array($exec7);
			$res7categoryanum = $res7["auto_number"];
			
			$query8 = "select * from master_item where itemcode = '$cbitemcode'";
			$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
			$res8 = mysql_fetch_array($exec8);
			$res8itemname = $res8["itemname"];
			$res8itemname = addslashes($res8itemname);
			$res8itemanum = $res8["auto_number"];
		
			$res8itemname = ereg_replace("'", "\'", $res8itemname);
			$res8itemname = ereg_replace('"', '\"', $res8itemname);
			
			$query9 = "insert into quotation_details (quotationanum, categoryanum, categoryname, 
			itemanum, itemname, additionaltext, unit_abbreviation, rateperunit, quantity, subtotal, 
			taxpercent, taxamount, totalamount, discountpercent, discountamount, 
			ipaddress, updatedate,cstid,cstname, financialyear) value ('$res3anum', 
			'$res7categoryanum','$cbcategoryname','$res8itemanum','$res8itemname','$additionaltext','$cbunitname', 
			'$cbrateperunit','$cbquantity','$cbsubtotal','$cbtaxpercent','$cbtaxamount', 
			'$cbtotalamount','$cbdiscountpercent','$cbdiscountamount','$ipaddress','$updatedatetime','$custid',
			'$custname', '$financialyear')";
			$exec9 = mysql_query($query9) or die ("Error in Query9".mysql_error());
			
			
		$taxtype = 'main';
		$cbtotalamount = $_REQUEST["totalamount".$i];
		$itemcode = $_REQUEST["itemcode".$i];
		$itemname = $_REQUEST["itemname".$i];
		//$itemrate = $_REQUEST["rateperunit".$i];
		$itemrate = $cbtotalamount;
		$itemquantity = $_REQUEST["quantity".$i];
		$subtotal = $_REQUEST["subtotal".$i];
		$taxautonum = $_REQUEST["taxautonum".$i];
		
		$query71 = "select * from master_tax where auto_number = '$taxautonum'";
		$exec71 = mysql_query($query71) or die ("Error in Query71".mysql_error());
		$res71 = mysql_fetch_array($exec71);
		$taxname = $res71["taxname"];
		$taxpercent = $res71["taxpercent"];
		
		$taxamount = $cbtotalamount / 100;
		$taxamount = $taxamount * $taxpercent;
		$taxamount = round($taxamount, 2);
		
		//$amountaftertax = $subtotal * $itemquantity;
		//$taxamount = $amountaftertax - $subtotal;

		if ($itemcode != '')
		{
			$query7 = "insert into quotation_tax (quotation_autonumber, itemcode, itemname, itemrate, itemquantity, taxtype, 
			tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
			updatedate, companyanum, companyname,cstid,cstname, financialyear) 
			values ('$res3anum', '$itemcode',  '$itemname',  '$itemrate',  '$itemquantity', '$taxtype', 
			'$taxautonum', '$taxname', '$taxpercent', '$taxamount', 
			'$amountaftertax', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname','$custid',
			'$custname', '$financialyear')";
			$exec7 = mysql_query($query7) or die ("Error in Query7".mysql_error());
		}
	
		//$amountbeforetaxsub = $amountaftertax;	
		//for ($taxsubloop=1;$taxsubloop<=100;$taxsubloop++)
		//{
		$query72 = "select * from master_taxsub where taxparentanum = '$taxautonum' and status = ''";
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
					$query8 = "insert into quotation_tax (quotation_autonumber, itemcode, itemname, itemrate, itemquantity, taxtype, 
					tax_autonumber, taxname, taxpercent, taxamount, amountaftertax, ipaddress, 
					updatedate, companyanum, companyname,cstid,cstname, financialyear) 
					values ('$res3anum', '$itemcode',  '$itemname',  '$itemrate',  '$itemquantity', '$taxsubtype', 
					'$taxsub_autonumber', '$taxsubname', '$taxsubpercent', '$taxsubamount', 
					'$amountaftertaxsub', '$ipaddress', '$updatedatetime', '$companyanum', '$companyname','$custid',
					'$custname', '$financialyear')";
					$exec8 = mysql_query($query8) or die ("Error in Query8".mysql_error());
				}
			}
			$taxsubtype = '';
			$taxsub_autonumber = '';
			$taxsubname = '';
			$taxsubpercent = '';
			$taxsubamount = '';
		}
				
		//}
		$taxtype = '';
		$itemcode = '';
		$itemname = '';
		$itemrate = '';
		$itemquantity = '';
		$subtotal = '';
		$taxautonum = '';
		$taxamount = '';

			
			
			//echo "<br><br>";
		}

	}
	
	
	header ("location:quotation1.php?st=1&&qanum=$res3anum");
	exit;

}




?>