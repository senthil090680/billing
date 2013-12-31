<?php
//This file applies updates to database. 
//Run this file after updating php files.

//WARNING : IT IS DECIDED NOT TO GO FOR ONLINE UPDATE BECAUSE OF SECURITY ISSUES.
//WARNING : UNTIL THE REQUIRED SYSTEMS AND PROCESS ARE READY, ONLINE UPDATE IS POSTPONED INFINITELY



if (isset($_REQUEST["submit"])) { $submit = $_REQUEST["submit"]; } else { $submit = ""; }

if ($submit == 'Yes. Proceed.')
{

	include ("db/db_connect.php");
	date_default_timezone_set('Asia/Calcutta'); 
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$updatedatetime = date('Y-m-d H:i:s');
	
	echo "<br><br>Update Started : ".$updatedatetime;
	
	//To check whether the update registry table is available or not.
	$query1 = "select * from master_updatesregistry";
	$exec1 = mysql_query($query1) or die ("Error In Query1".mysql_error());
	echo "<br><br>Master Updates Registry Table Found.";
	echo "<br><br>Updates Status Checking In Progress.";
	
	//Update To Show Phone Number On Sales Printouts. Table master_settings_primaryvalues
	$updateid = "UID00001";
	$releasedate = "2013-01-30";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query3 = "INSERT INTO master_settings_primaryvalues (auto_number, companyanum, companycode, 
		modulename, submodulename, settingsname, settingsvalue, defaultvalue, status, ipaddress, username, updatetime) 
		VALUES (NULL, '1', 'CPY00000001', 'SALES', '', 'PHONE_NUMBER_SALES_PRINT_SETTING', 'HIDE PHONE NUMBER ON SALES PRINTOUT', 
		'', '', '', '', CURRENT_TIMESTAMP)";
		$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
		
		$query4 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
		update_applied_date, update_applied_status, ipaddress) 
		values ('$updateid', '$releasedate', 'master_settings_primaryvalues', 'ALL FIELDS', 
		'$updatedatetime', 'COMPLETED', '$ipaddress')";
		$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		
		echo "<br><br>Update Date : 30-Jan-2013 / Update ID: ".$updateid;
	}
	
	
	
	
	
	//Update To Show Phone Number On Sales Printouts For All The Existing Companies. Table master_settings
	$updateid = "UID00002";
	$releasedate = "2013-01-30";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query5 = "select * from master_company";
		$exec5 = mysql_query($query5) or die ("Error in Query5".$updateid.mysql_error());
		while ($res5 = mysql_fetch_array($exec5))
		{
			$companyanum = $res5['auto_number'];
			$companycode = $res5['companycode'];
			
			$query3 = "INSERT INTO master_settings (auto_number, companyanum, companycode, modulename, 
			submodulename, settingsname, settingsvalue, defaultvalue, status, ipaddress, username, updatetime) 
			VALUES (NULL, '$companyanum', '$companycode', 'SALES', '', 'PHONE_NUMBER_SALES_PRINT_SETTING', 
			'HIDE PHONE NUMBER ON SALES PRINTOUT', '', '', '', '', CURRENT_TIMESTAMP)";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query4 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
			update_applied_date, update_applied_status, ipaddress) 
			values ('$updateid', '$releasedate', 'master_settings_primaryvalues', 'ALL FIELDS', 
			'$updatedatetime', 'COMPLETED', '$ipaddress')";
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		}	
		echo "<br><br>Update Date : 30-Jan-2013 / Update ID: ".$updateid;
	}
	
	
	
	
	
	//Update To Show AMOUNT_IN_WORDS_SALES_PRINT_SETTING On Sales Printouts. Table master_settings_primaryvalues
	$updateid = "UID00003";
	$releasedate = "2013-02-02";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query3 = "INSERT INTO master_settings_primaryvalues (auto_number, companyanum, companycode, 
		modulename, submodulename, settingsname, settingsvalue, defaultvalue, status, ipaddress, username, updatetime) 
		VALUES (NULL, '1', 'CPY00000001', 'SALES', '', 'AMOUNT_IN_WORDS_SALES_PRINT_SETTING', 'SALES AMOUNT IN WORDS AS NORMAL TEXT', 
		'', '', '', '', CURRENT_TIMESTAMP)";
		$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
		
		$query4 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
		update_applied_date, update_applied_status, ipaddress) 
		values ('$updateid', '$releasedate', 'master_settings_primaryvalues', 'ALL FIELDS', 
		'$updatedatetime', 'COMPLETED', '$ipaddress')";
		$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		
		echo "<br><br>Update Date : 02-Feb-2013 / Update ID: ".$updateid;
	}
	
	
	
	
	
	//Update To Show AMOUNT_IN_WORDS_SALES_PRINT_SETTING On Sales Printouts For All The Existing Companies. Table master_settings
	$updateid = "UID00004";
	$releasedate = "2013-02-02";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query5 = "select * from master_company";
		$exec5 = mysql_query($query5) or die ("Error in Query5".$updateid.mysql_error());
		while ($res5 = mysql_fetch_array($exec5))
		{
			$companyanum = $res5['auto_number'];
			$companycode = $res5['companycode'];
			
			$query3 = "INSERT INTO master_settings (auto_number, companyanum, companycode, modulename, 
			submodulename, settingsname, settingsvalue, defaultvalue, status, ipaddress, username, updatetime) 
			VALUES (NULL, '$companyanum', '$companycode', 'SALES', '', 'AMOUNT_IN_WORDS_SALES_PRINT_SETTING', 
			'SALES AMOUNT IN WORDS AS NORMAL TEXT', '', '', '', '', CURRENT_TIMESTAMP)";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query4 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
			update_applied_date, update_applied_status, ipaddress) 
			values ('$updateid', '$releasedate', 'master_settings_primaryvalues', 'ALL FIELDS', 
			'$updatedatetime', 'COMPLETED', '$ipaddress')";
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		}	
		echo "<br><br>Update Date : 30-Jan-2013 / Update ID: ".$updateid;
	}
	
	
	
	
	
	
	$updateid = "UID00005";
	$releasedate = "2013-05-12";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query6 = "select * from master_menusub where submenuid = 'SM134'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$rowcount6 = mysql_num_rows($exec6);
		if ($rowcount6 == 0)
		{
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM134', '134', 'Delivery Challan - Customer (Inward)', 'deliverychallancustomer1inward.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM135', '135', 'Delivery Challan - Supplier (Outward)', 'deliverychallansupplier1outward.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM136', '136', 'DC Customer Inward Report', 'dccustomerreport1inward.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM137', '137', 'DC Supplier Outward Report', 'dcsupplierreport1outward.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM134')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM135')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM136')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM137')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			
			$query5 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
			update_applied_date, update_applied_status, ipaddress) 
			values ('$updateid', '$releasedate', '', 'ALL FIELDS', 
			'$updatedatetime', 'COMPLETED', '$ipaddress')";
			$exec5 = mysql_query($query5) or die ("Error in Query5".$updateid.mysql_error());
		}

		echo "<br><br>Update ID: ".$updateid." - Update Release Date : ".$releasedate;
	}
	
	
	
	
	
	
	
	
	$updateid = "UID00006";
	$releasedate = "2013-05-12";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query6 = "select * from master_menusub where submenuid = 'SM138'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$rowcount6 = mysql_num_rows($exec6);
		if ($rowcount6 == 0)
		{
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM007', 'SM138', '138', 'Customer Data Bulk Import', 'dataimport1customer.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM007', 'SM139', '139', 'Customer Data Bulk Update', 'dataimport1updatecustomer.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM007', 'SM140', '140', 'Supplier Data Bulk Import', 'dataimport1supplier.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM007', 'SM141', '141', 'Supplier Data Bulk Update', 'dataimport1updatesupplier.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM138')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM139')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM140')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM141')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		
			
			$query5 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
			update_applied_date, update_applied_status, ipaddress) 
			values ('$updateid', '$releasedate', '', 'ALL FIELDS', 
			'$updatedatetime', 'COMPLETED', '$ipaddress')";
			$exec5 = mysql_query($query5) or die ("Error in Query5".$updateid.mysql_error());
		}

		echo "<br><br>Update ID: ".$updateid." - Update Release Date : ".$releasedate;
	}
	
	
	
	
	
	
	
	
	
	$updateid = "UID00007";
	$releasedate = "2013-05-23";
	$query2 = "select * from master_updatesregistry where update_id = '$updateid'";
	$exec2 = mysql_query($query2) or die ("Error in Query2".$updateid.mysql_error());
	$rowcount2 = mysql_num_rows($exec2);
	if ($rowcount2 == 0)
	{
		$query6 = "select * from master_menusub where submenuid = 'SM142'";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		$rowcount6 = mysql_num_rows($exec6);
		if ($rowcount6 == 0)
		{
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM006', 'SM142', '142', 'Credit Days Report - Purchase', 'creditdaysreport1purchase.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM006', 'SM143', '143', 'Credit Days Report - Sales', 'creditdaysreport1sales.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM144', '144', 'Print DC - Customer - Outward', 'dccustomeroutwardprintselection1.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM145', '145', 'Print DC - Customer - Inward', 'dccustomerinwardprintselection1.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM146', '146', 'Print DC - Supplier - Outward', 'dcsupplieroutwardprintselection1.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query3 = "INSERT INTO master_menusub (mainmenuid, submenuid, submenuorder, submenutext, submenulink) 
			VALUES ('MM010', 'SM147', '147', 'Print DC - Supplier - Inward', 'dcsupplierinwardprintselection1.php')";		
			$exec3 = mysql_query($query3) or die ("Error in Query3".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM142')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM143')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM144')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM145')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM146')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
			
			$query4 = "INSERT INTO master_employeerights (employeecode, username, mainmenuid, submenuid) 
			VALUES ('EMP00000001', 'admin', '', 'SM147')";		
			$exec4 = mysql_query($query4) or die ("Error in Query4".$updateid.mysql_error());
		
			
			$query5 = "insert into master_updatesregistry (update_id, update_release_date, update_tablename, update_fieldname, 
			update_applied_date, update_applied_status, ipaddress) 
			values ('$updateid', '$releasedate', '', 'ALL FIELDS', 
			'$updatedatetime', 'COMPLETED', '$ipaddress')";
			$exec5 = mysql_query($query5) or die ("Error in Query5".$updateid.mysql_error());
		}

		echo "<br><br>Update ID: ".$updateid." - Update Release Date : ".$releasedate;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	echo "<br><br>Update Completed : ".$updatedatetime;


}
else
{
	if (isset($_REQUEST["submit"])) { $submit = $_REQUEST["submit"]; } else { $submit = ""; }
	
	if ($submit == 'No. Cancel Updates.')
	{
		echo "Updates Apply Cancelled. Not Applied.";
		exit;
	}
}




//**********************************************************************************************//

//WARNING : IT IS DECIDED NOT TO GO FOR ONLINE UPDATE BECAUSE OF SECURITY ISSUES.
//WARNING : UNTIL THE REQUIRED SYSTEMS AND PROCESS ARE READY, ONLINE UPDATE IS POSTPONED INFINITELY

/*
//Download Updated zipped folder containg latest files under xampp/simacle_billing_updates folder and 
//rename as date_time_stamp name.

// folder to save downloaded files to. must end with slash
$download_url = 'http://www.simpleindia.com/softwareupdates/simacle_billingretail_update.zip';

$destination_folder_name = 'updates_download';
$destination_folder_path = $destination_folder_name.'/';
@mkdir( '../'.$destination_folder_name );

$file = fopen ($newfname, "rb");
$newfname = '../'.$destination_folder_path . basename($download_url);

$file = fopen ($download_url, "rb");
if ($file) 
{
	$newf = fopen ($newfname, "wb");
	
	if ($newf)
	while(!feof($file)) 
	{
		fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
	}
}

if ($file) 
{
	fclose($file);
}

if ($newf) 
{
	fclose($newf);
}
*/

//******************************************************************************************************//

//Unzipp downloaded file to specific location. To get db and other files.
//Code working on xampp 1.7 and above.
/*
$zip = new ZipArchive;
//$zip->open('../downloads/hospital-live-09Apr2013-0658PM.zip');
$zip->open('updates_download/hospital-live-09Apr2013-0658PM.zip');
//$zip->extractTo('../downloads/');
$zip->extractTo('updates_download/');
$zip->close();
*/

/*******************************************************************************************************/







?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Please Take Database Manual Backup Before  Proceeding. Please Follow Backup Procedure Always.</strong>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Yes I have Taken Backup. Please Proceed To Apply Updates.</p>
<p></p>
<form id="updatesapply1" name="updatesapply1" method="post" action="">
<input type="hidden" name="updatesapply1" id="updatesapply1" value="updatesapply1" />
<input type="submit" name="submit" value="Yes. Proceed." style="border: 1px solid #001E6A"/>
<input type="submit" name="submit" value="No. Cancel Updates." style="border: 1px solid #001E6A"/>
</form>
<p></p>