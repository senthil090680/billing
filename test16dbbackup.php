<?php
session_start();
set_time_limit(0);
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$dateonly = date('Ymd');
$timeonly = date('His');

if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
//$username = $_SESSION["username"];

if (isset($_REQUEST["submit"])) { $submit = $_REQUEST["submit"]; } else { $submit = ""; }

if ($submit == 'Yes. Proceed.')
{

	echo "<br><br>Update Started : ".date('Y-m-d H:i:s');
	
	$originalfoldername = 'billingretail'; //Running Live Folder Name Here.
	
	$backupfoldername = 'simaclebillingretail_'.$dateonly.'_'.$timeonly;
	$backupdatabasename = 'simaclebillingretail'.$dateonly.$timeonly;
	
	//**************************************************************************************************************//
	
	//Create copy of existing running database as sql file and save under zbackupdatabasefiles folder with dbname_date_time.sql name format.
	//Values From db_connect.php file.
	$localhost = $hostname;
	$dbusername = $hostlogin;
	$password = $hostpassword;
	$databasename = $databasename;
	
	///*
	
	backup_tables($localhost, $dbusername, $password, $databasename); //Function will not work inside if condition. Called below.
	
	
	
	//**********************************************************************************************************************//
	
	//Create copy of existing running database inside xampp phpmyadmin with dbname_date_time name format.
	
	
	///*
	$destinationdatabase1 = $backupdatabasename; // destination database
	$destinationdbconnect1 = mysql_connect($localhost, $dbusername, $password);
	$query1createdb = "CREATE DATABASE $destinationdatabase1";
	$exec1createdb = mysql_query($query1createdb) or die ("Error in Query1createdb".mysql_error());
	
	mysql_select_db($destinationdatabase1, $destinationdbconnect1);
	
	$originaldatabase1 = $databasename; //original database
	$orginalconnect1 = mysql_connect($localhost, $dbusername, $password);
	
	mysql_select_db($originaldatabase1, $orginalconnect1);
	
	$tables = mysql_query("SHOW TABLES FROM $originaldatabase1");
	
	while ($line = mysql_fetch_row($tables)) 
	{
		$tab = $line[0];
		mysql_query("DROP TABLE IF EXISTS $destinationdatabase1.$tab");
		mysql_query("CREATE TABLE $destinationdatabase1.$tab LIKE $originaldatabase1.$tab") or die(mysql_error());
		mysql_query("INSERT INTO $destinationdatabase1.$tab SELECT * FROM $originaldatabase1.$tab");
		//echo "Table: <b>" . $line[0] . " </b>Done<br>";
	}
	//*/
	
	
	
	
	
	//*********************************************************************************************************************//
	
	//Create copy of existing running software folder with folder_date_name format.
	
	
	///*
	$source = '../'.$originalfoldername;
	$destination = '../'.$backupfoldername;
	
	copy_directory ( $source, $destination );  //Function Will Not Run Inside If Condition. Running Below.
	


	echo "<br><br>Update Completed : ".date('Y-m-d H:i:s');


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


function backup_tables($host,$user,$pass,$name,$tables = '*')
{

	$dateonly = date('Ymd');
	$timeonly = date('His');
	$backupfoldername = 'simaclehospital_'.$dateonly.'_'.$timeonly;
	$backupdatabasename = 'simaclehospital'.$dateonly.$timeonly;

	$backuptime = date('YMd_His');
	$backupdatabasefiletime = date('Y-m-d H:i:s');
	if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
	//$username = $_SESSION["username"];
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	
	$backupdatabasefilename = $backupdatabasename.'.sql';
	$backupdatabasefiletime =  $backupdatabasefiletime;
	
	$query1db = "insert into master_backupdatabase (backupfilename, backupfiledate, username, ipaddress) 
	values ('$backupdatabasefilename', '$backupdatabasefiletime', '$username', '$ipaddress')";
	$exec1db = mysql_query($query1db) or die ("Error in Query1db".mysql_error());

	$return = '';
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		//$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					
					//Slash after and before double quote is compulsory.
					$patterns = "/\n/";
					$replacements = "/\\n/";
					$string = $row[$j]; 
					
					//$row[$j] = preg_replace("\n","\\n",$row[$j]); 
					$row[$j] = preg_replace($patterns, $replacements, $string);
					
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
		
	}

	//save file
	//$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	
	$handle = fopen('db/'.$backupdatabasename.'.sql','w+'); //z given to list folders at the end.
	fwrite($handle,$return);
	fclose($handle);
	
	
}


function copy_directory( $source, $destination ) 
{
	if ( is_dir( $source ) ) 
	{
		@mkdir( $destination );
		$directory = dir( $source );
		while ( FALSE !== ( $readdirectory = $directory->read() ) ) 
		{
			if ( $readdirectory == '.' || $readdirectory == '..' ) 
			{
				continue;
			}
			$PathDir = $source . '/' . $readdirectory; 
			if ( is_dir( $PathDir ) ) 
			{
				copy_directory( $PathDir, $destination . '/' . $readdirectory );
				continue;
			}
			copy( $PathDir, $destination . '/' . $readdirectory );
		}
		
		$directory->close();
	}
	else 
	{
		copy( $source, $destination );
	}
}



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