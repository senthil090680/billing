<title>
<?php 
if (isset($_REQUEST["titlestr"])) { $titlestr = $_REQUEST["titlestr"]; } else { $titlestr = ""; }
if ($titlestr == '')
{
	echo 'SIMACLE BILLING SOFTWARE';
}
else
{
	echo $titlestr.' - SIMACLE BILLING SOFTWARE';
}
?>
</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">