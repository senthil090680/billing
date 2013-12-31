<?php
$alertmessage = "";
if (isset($_SESSION['financialyear'])) { $financialyear = $_SESSION['financialyear']; } else { $financialyear = ""; }
if (isset($_SESSION["companyname"]))
{
	$alertmessage = 'FY'.$financialyear.' - '.$_SESSION["companyname"];
}
else
{
	$allertmessage = '&nbsp;';
}
?>
<style type="text/css">
<!--
.style1AM1 {color: #FFFFFF}
.style2AM2 {font-size: 13px}
-->
</style>
<div align="left">
<span class="style1AM1">
<span class="style2AM2">
<?php echo $alertmessage; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span>
</span>
</div>