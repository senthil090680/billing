<?php

//conversion function written on Sunday, 26 April 2009. Prem Kumar. 
//written for Service Tracking System - Dass & Thomas. Aminjikarai.

function singlenumber_convert($number)
{
$stramount = "";

	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	if ($strlen <= 2 && $number <= 19)
	{
		for ($i=1;$i<=19;$i++)
		{
			if ($number == $i)
			{
				$stramount = $ones[$i];
			}
		}
		//echo $stramount;
	}
return $stramount;
}

function doublenumber_convert($number)
{
$stramount1 = "";
$stramount2 = "";

	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	if ($strlen == 2 && $number >19)
	{
		for ($i=1;$i<=9;$i++)
		{
			$floornumber = floor($number / 10);  
			if ($floornumber == $i)
			{
				$stramount2 = $tens[$i];
				$onesnumber = substr($number, 1, 1);
				if ($onesnumber <= 9)
				{
					for ($i=1;$i<=9;$i++)
					{
						if ($onesnumber == $i)
						{
							$stramount1 = $ones[$i];
						}
					}
				}
			}
		}
		//echo $stramount2.' '.$stramount1;
	}
$stramount1 = $stramount2.' '.$stramount1;
return $stramount1;
}

function hundredsnumber_convert($number)
{
	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	$hundredsnumber = substr($number, 0, 1);
	$hundredsword = singlenumber_convert($hundredsnumber);
	if ($hundredsword != '')	$hundredsword = $hundredsword.' Hundred';
	$balancenumber = substr($number, 1, 2);
	if ($balancenumber <= 19)
	{
		$balancewords = singlenumber_convert($balancenumber);
	}
	else
	{
		$balancewords = doublenumber_convert($balancenumber);
	}
	if ($balancewords != '')
	{
		$hundredsword = $hundredsword.' And '.$balancewords;
	}
	else
	{
		$hundredsword = $hundredsword;
	}
	//echo $hundredsword;
	
return $hundredsword;
}

function thousandsnumber_convert($number)
{
	$hundredsword = '';
	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	$thousandsnumber = substr($number, 0, 1);
	$thousandsword = singlenumber_convert($thousandsnumber);
	$thousandsword = $thousandsword.' Thousand';
	$hundredsnumber = substr($number, 1, 3);
	if ($hundredsnumber > 0)
	{
		$hundredsword = hundredsnumber_convert($hundredsnumber);
	}
	if ($hundredsword != '')
	{
		$thousandsword = $thousandsword.' '.$hundredsword;
	}
	
return $thousandsword;
}

function tenthousandsnumber_convert($number)
{
	$hundredsword = '';
	$tenthousandsword = '';
	
	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	$tenthousandsnumber = substr($number, 0, 2);
	if ($tenthousandsnumber <= 19)
	{
		$tenthousandsword = singlenumber_convert($tenthousandsnumber);
	}
	else
	{
		$tenthousandsword = doublenumber_convert($tenthousandsnumber);
	}
	$tenthousandsword = $tenthousandsword.' Thousand';
	$hundredsnumber = substr($number, 2, 3);
	if ($hundredsnumber > 0)
	{
		$hundredsword = hundredsnumber_convert($hundredsnumber);
	}
	if ($hundredsword != '')
	{
		$tenthousandsword = $tenthousandsword.' '.$hundredsword;
	}
	//echo $tenthousandsword;

return 	$tenthousandsword;
}

function lakhsnumber_convert($number)
{
	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	$lakhsnumber = substr($number, 0, 1);
	$lakhsword = singlenumber_convert($lakhsnumber);
	$lakhsword = $lakhsword.' Lakh';
	$tenthousandsnumber = substr($number, 1, 5);
	if ($tenthousandsnumber > 0)
	{
		$tenthousandsword = tenthousandsnumber_convert($tenthousandsnumber);
	}
	if ($tenthousandsword != '')
	{
		$lakhsword = $lakhsword.' '.$tenthousandsword;
	}
	
//echo $lakhsword;
return 	$lakhsword;
}

function tenlakhsnumber_convert($number)
{
	$strlen = strlen($number);
	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
			"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
			"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
			"Nineteen"); //empty begining is to avoid zero of array.
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety"); 

	$tenlakhsnumber = substr($number, 0, 2);
	if ($tenlakhsnumber <= 19)
	{
		$tenlakhsword = singlenumber_convert($tenlakhsnumber);
	}
	else
	{
		$tenlakhsword = doublenumber_convert($tenlakhsnumber);
	}
	$tenlakhsword = $tenlakhsword.' Lakhs';
	$tenthousandsnumber = substr($number, 2, 5);
	if ($tenthousandsnumber > 0)
	{
		$tenthousandsword = tenthousandsnumber_convert($tenthousandsnumber);
	}
	if ($tenthousandsword != '')
	{
		$tenlakhsword = $tenlakhsword.' '.$tenthousandsword;
	}
	//echo $tenlakhsword;
return $tenlakhsword;
}


function covert_currency_to_words($varnumber)
{
	$query1curr_companyanum = $_SESSION["companyanum"];
	$query1curr = "select * from master_company where auto_number = '$query1curr_companyanum'";
	$exec1curr = mysql_query($query1curr) or die ("Error in Query1curr".mysql_error());
	$res1curr = mysql_fetch_array($exec1curr);
	$res1currencyname = $res1curr["currencyname"];
	$res1currencydecimalname = $res1curr["currencydecimalname"];
	$res1currencycode = $res1curr["currencycode"];
	
	$strwords1 = "";
	$strwords2 = "";
	$strwords3 = "";
	$strwords4 = "";
	$strwords5 = "";
	$strwords6 = "";
	$strwords7 = "";

	$varnumber = $varnumber;
	$numberarray = explode('.',$varnumber);
	//print_r($numberarray);
	$number = $numberarray[0];
	$decimal = $numberarray[1];
	
	if ($number > 9999999)
	{
		//echo "Number Not Supported.";
	}
	$convertowords = $number;
	$strlen = strlen($number);
	
	if ($strlen <= 2 && $number <= 19)
	{
		$strwords1 = singlenumber_convert($convertowords);
	}
	if ($strlen == 2 && $number > 19)
	{
		$strwords2 = doublenumber_convert($convertowords);
	}
	if ($strlen == 3)
	{
		$strwords3 = hundredsnumber_convert($convertowords);
	}
	if ($strlen == 4)
	{
		$strwords4 = thousandsnumber_convert($convertowords);
	}
	if ($strlen == 5)
	{
		$strwords5 = tenthousandsnumber_convert($convertowords);
	}
	if ($strlen == 6)
	{
		$strwords6 = lakhsnumber_convert($convertowords);
	}
	if ($strlen == 7)
	{
		$strwords7 = tenlakhsnumber_convert($convertowords);
	}
	if ($decimal <= 19)
	{
		$strdecimal1 = singlenumber_convert($decimal);
	}
	if ($decimal > 19)
	{
		$strdecimal1 = doublenumber_convert($decimal);
	}
	if ($strdecimal1 != '')
	{
		//$strdecimal1 = ' - Paise '.$strdecimal1;
		$strdecimal1 = ' - '.$res1currencydecimalname.' '.$strdecimal1;
	}
	
	$convertedstring = $strwords1.$strwords2.$strwords3.$strwords4.$strwords5.$strwords6.$strwords7.$strdecimal1.' Only';
	//if ($convertedstring != '') $convertedstring = 'Rupees '.$convertedstring;
	if ($convertedstring != '') $convertedstring = $res1currencyname.' '.$convertedstring;
	
	//echo $convertedstring;
return $convertedstring;
}

//$varnumber = $_REQUEST[number];
//echo covert_currency_to_words($varnumber); //function call


?>