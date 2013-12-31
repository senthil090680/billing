<?php
//Simacle Billing Software - Version 7.0 - Released Jan 2012
//Simacle Billing Software - Version 8.0 - Released 21Nov2012 Wednesday
$titlestr = '';
include ("includes/pagetitle1.php");
?>
<style type="text/css">
<!--
.style4TM1 {font-size: 18px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #000099;}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1%" bgcolor="#8CAAE6">&nbsp;</td>
    <td colspan="5" bgcolor="#8CAAE6">
	<span class="style4TM1">
	<?php if (!isset($titlestr)) { echo $titlestr.' - '; } ?>
	SIMACLE BILLING SOFTWARE 8.0</span></td>
    <td width="13%" bgcolor="#8CAAE6" class="style4TM1">
	<?php if (isset($_SESSION["username"])) { echo strtoupper($_SESSION["username"]); } ?>
	&nbsp;</td>
  </tr>
</table>
