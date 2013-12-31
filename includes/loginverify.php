<?php
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta');

if (!isset($_SESSION["username"])) header ("location:index.php");

if (isset($_SESSION['username'])) { $username1 = $_SESSION['username']; } else { $username1 = ""; }

$query1 = "select * from login_restriction where username = '$username1'";
$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
$res1 = mysql_fetch_array($exec1);
$rowcount1 = mysql_num_rows($exec1);
//$logincount = $res1['rowcount1'];
$res1sessionid = $res1['sessionid'];
//echo '<br>'.session_id();

//$query2 = "select * from master_edition where status = 'ACTIVE'";
//$exec2 = mysql_query($query2) or die ("Error in Query2".mysql_error());
//$res2 = mysql_fetch_array($exec2);
//$res2usercount = $res2['users'];
//if ($logincount > $res2usercount)
//{
if ($res1sessionid != session_id())
{
	//echo 'inside if';
	//header ("location:login1restricted1.php");
	//exit;
}


//echo $_SESSION[companyanum];
if (!isset($_SESSION["companyanum"])) // if the variable is set.
{
	header ("location:setactivecompany1.php"); 
}
$ipaddress = $_SERVER["REMOTE_ADDR"];
$username = $_SESSION["username"];
?>