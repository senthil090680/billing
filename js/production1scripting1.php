<script language="javascript">

//This file cannot be save as .js, reason, php coding is involved in tax calculation. It needs to be as .php file than .js 

function itemsearch1(varCallFrom)
{
	window.open("popup_itemsearch1purchase.php?callfrom="+varCallFrom,"Window2",'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=750,height=350,left=100,top=100');
	//window.open("message_popup.php?anum="+anum,"Window1",'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=200,height=400,left=312,top=84');
}


function itemcodekeypress1(e)
{
	var data = document.getElementById("itemcode").value;
	//alert(data);
	// var iChars = "!%^&*()+=[];,.{}|\:<>?~"; //All special characters.
	var iChars = "!^+=[];,{}|\<>?~"; 
	for (var i = 0; i < data.length; i++) 
	{
	
		if (iChars.indexOf(data.charAt(i)) != -1) 
		{
			alert ("Item Code Has Special Characters. Like ! ^ + = [ ] ; , { } | \ < > ? ~ These are not allowed.");
			return false;
		}
	}

	
	/*
	//alert ("Key Press");
	if (event.keyCode=='13')
	{
		//function from autoitemsearch2.js
		itemsearch2();
		return false;
	}
	*/
	
	evt = e || window.event; 
	key = evt.keyCode;
	//alert (key);
	if(key == 13) // if enter key press
	{
		//function from autoitemsearch2.js
		//alert ("Inside Event Function.");
		itemsearch2();
		return false;
	}
}

function itemquantitykeypress1(e)
{
	/*
	//alert ("Key Press");
	if (event.keyCode=='13')
	{
		itemtotalamountupdate1();
		//same function call of add button click from purchaseinsertitem1.js
		insertitem1();
		return false;
	}
	*/
	
	evt = e || window.event; 
	key = evt.keyCode;
	//alert (key);
	if(key == 13) // if enter key press
	{
		itemtotalamountupdate1();
		//same function call of add button click from salesinsertitem1.js
		insertitem1();
		return false;
	}
}

function funcAllItemDiscountApply1()
{
	var varDiscountPercent = document.getElementById("allitemdiscountpercent").value;
	var varDiscountPercent = parseFloat(varDiscountPercent);
	if (isNaN(varDiscountPercent))
	{
		alert ("All Item Discount Percent Can Only Be Numbers.");
		document.getElementById("allitemdiscountpercent").value = "0.00";
		document.getElementById("allitemdiscountpercent").focus();
		return false;
	}
	if (varDiscountPercent > 100)
	{
		alert ("All Item Discount Percent Cannot Be Greater Than 100.")
		return false;
	}
	
	for (z=1;z<=1000;z++)
	{
		//alert (z);
		if (document.getElementById('discountpercent'+z) != null) 
		{
			//alert (z);
			//alert (varDiscountPercent);
			//document.getElementById('discountpercent'+z).value = varDiscountPercent.toFixed(2);

			//var varItemTotalAmount = document.getElementById('totalamount'+z).value;
			var varItemRatePerUnit = document.getElementById('rateperunit'+z).value;
			var varItemTotalQuantity = document.getElementById('quantity'+z).value;
			var varItemTotalAmount = parseFloat(varItemRatePerUnit) * parseFloat(varItemTotalQuantity);

			var varDiscountPercentAmount = varDiscountPercent * varItemTotalAmount;
			var varDiscountPercentAmount = parseFloat(varDiscountPercentAmount) / 100;
			var varItemTotalAmount = parseFloat(varItemTotalAmount) - parseFloat(varDiscountPercentAmount);
			document.getElementById('discountpercent'+z).value = parseFloat(varDiscountPercent).toFixed(2);
			document.getElementById('totalamount'+z).value = varItemTotalAmount.toFixed(2);
		}
	}

	funcSubTotalCalc();
}

function itemtotalamountupdate1()
{
		//to update total amount after quantity update.
		var varItemMRP = document.getElementById("itemmrp").value;
		//alert (varItemMRP);
		if (isNaN(varItemMRP))
		{
			alert ("Rate Can Only Be Numbers.");
			document.getElementById("itemmrp").focus();
			return false;
		}
		var varItemQuantity = document.getElementById("itemquantity").value;
		if (isNaN(varItemQuantity))
		{
			alert ("Quantity Can Only Be Numbers.");
			document.getElementById("itemquantity").value = "1";
			document.getElementById("itemquantity").focus();
			return false;
		}
		var varItemTotalAmount = parseFloat(varItemMRP) * parseFloat(varItemQuantity);
		//alert (varItemTotalAmount);
		document.getElementById("itemtotalamount").value = varItemTotalAmount.toFixed(2);
		//return false;

		//to check whether discount percent and discount amount are given together.
		if (document.getElementById("itemdiscountrupees").value != "0.00" && document.getElementById("itemdiscountpercent").value != "0.00")
		{
			alert ("Either Discount Percent Or Discount Amount Can Be Given. Percent And Amount Together Not Allowed.");
			document.getElementById("itemdiscountrupees").value = "0.00";
			document.getElementById("itemdiscountpercent").value = "0.00";
			return false;
		}
		

		//to update totalamount after discount percent updated.
		var varItemTotalAmount = document.getElementById("itemtotalamount").value;
		var varDiscountPercent = document.getElementById("itemdiscountpercent").value;
		var varItemTotalAmount = parseFloat(varItemTotalAmount);
		var varDiscountPercent = parseFloat(varDiscountPercent);
		if (isNaN(varDiscountPercent))
		{
			alert ("Discount Percent Can Only Be Numbers.");
			document.getElementById("itemdiscountpercent").value = "0.00";
			document.getElementById("itemdiscountpercent").focus();
			return false;
		}
		if (varDiscountPercent > 100)
		{
			alert ("Discount Percent Cannot Be Greater Than 100.")
			return false;
		}
		var varDiscountPercentAmount = varDiscountPercent * varItemTotalAmount;
		var varDiscountPercentAmount = parseFloat(varDiscountPercentAmount) / 100;
		var varItemTotalAmount = parseFloat(varItemTotalAmount) - parseFloat(varDiscountPercentAmount);
		document.getElementById("itemdiscountpercent").value = parseFloat(varDiscountPercent).toFixed(2);
		document.getElementById("itemtotalamount").value = varItemTotalAmount.toFixed(2);
		//return false;


		//to update totalamount after discount rupees updated.
		var varItemTotalAmount = document.getElementById("itemtotalamount").value;
		var varDiscountRupees = document.getElementById("itemdiscountrupees").value;
		var varItemTotalAmount = parseFloat(varItemTotalAmount);
		var varDiscountRupees = parseFloat(varDiscountRupees);
		if (isNaN(varDiscountRupees))
		{
			alert ("Discount Rupees Can Only Be Numbers.");
			document.getElementById("itemdiscountrupees").value = "0.00";
			document.getElementById("itemdiscountrupees").focus();
			return false;
		}
		if (varDiscountRupees > varItemTotalAmount)
		{
			alert ("Discount Amount Cannot Be Greater Than Total Amount.")
			return false;
		}
		var varItemTotalAmount = parseFloat(varItemTotalAmount) - parseFloat(varDiscountRupees);
		document.getElementById("itemdiscountrupees").value = parseFloat(varDiscountRupees).toFixed(2);
		document.getElementById("itemtotalamount").value = varItemTotalAmount.toFixed(2);
		
//Working Perfect. But, tax cannot be applied before giving discount on totalamount.
/*		//To update totalamount after tax percent applied.
		var varItemTotalAmount = document.getElementById("itemtotalamount").value;
		var varTaxPercent = document.getElementById("itemtaxpercent").value;
		var varItemTotalAmount = parseFloat(varItemTotalAmount);
		var varTaxPercent = parseFloat(varTaxPercent);
		var varTaxAmount = varTaxPercent * varItemTotalAmount;
		var varTaxAmount = parseFloat(varTaxAmount) / 100;
		var varItemTotalAmount = parseFloat(varItemTotalAmount) + parseFloat(varTaxAmount);
		document.getElementById("itemtotalamount").value = varItemTotalAmount.toFixed(2);
*/		
		return false;


}

function btnDeleteClick(delID)
{
	var varDeleteID = delID;
	//alert (varDeleteID);
	var fRet3; 
	fRet3 = confirm('Are You Sure Want To Delete This Entry?'); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		//alert ("Item Entry Not Deleted.");
		return false;
	}

	var child = document.getElementById('idTR'+varDeleteID);  //tr name
    var parent = document.getElementById('tblrowinsert'); // tbody name.
	document.getElementById ('tblrowinsert').removeChild(child);
	
	var child = document.getElementById('idTRaddtxt'+varDeleteID);  //tr name
    var parent = document.getElementById('tblrowinsert'); // tbody name.
	//alert (child);
	if (child != null) 
	{
		//alert ("Row Exsits.");
		document.getElementById ('tblrowinsert').removeChild(child);
	}

	funcCumulativeDiscountReset1();
	funcSubTotalCalc();
	
	alert ("Delete Item Entry Completed.");
}

function btnFreeClick(freeID)
{
	var varFreeID = freeID;
	//alert (varDeleteID);
	var fRet3; 
	fRet3 = confirm('This Will Make Rate As 0.00. Are You Sure Want To Make Item No. '+varFreeID+' As FREE Entry? '); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		//alert ("Item Entry Not Deleted.");
		return false;
	}

	document.getElementById('rateperunit'+varFreeID).value = "0.00";
	document.getElementById('discountpercent'+varFreeID).value = "0.00";
	document.getElementById('discountrupees'+varFreeID).value = "0.00";
	document.getElementById('totalamount'+varFreeID).value = "0.00";

	funcCumulativeDiscountReset1();
	funcSubTotalCalc();
}

function funcSubTotalCalc()
{
	funcCumulativeDiscountReset1();

	var varSerialNumberUpdate = 0;
	var varTotalAmount = 0;
	var varTotalAmountLoop = 0;
	for (m=1;m<1000;m++)
	{
		
		if (document.getElementById('serialnumber'+m) != null) 
		{
			var varSerialNumberUpdate = varSerialNumberUpdate + 1;
			document.getElementById('serialnumber'+m).value = varSerialNumberUpdate;
			
			var varTotalAmountLoop = document.getElementById('totalamount'+m).value;
			if (varTotalAmountLoop != null) 
			{
				//alert (varTotalAmountLoop);
				var varTotalAmount = parseFloat(varTotalAmount) + parseFloat(varTotalAmountLoop);
			}
		}
	}
	//var varSerialNumberUpdate = varSerialNumberUpdate + 1;
	//document.getElementById('itemserialnumber').value = varSerialNumberUpdate;
	document.getElementById('subtotal').value = varTotalAmount.toFixed(2);
	
	var varSubTotalAmount = document.getElementById("subtotal").value;
	
	var varTotalAfterDiscount = document.getElementById("subtotal").value;
	var varTotalAfterDiscount = parseFloat(varTotalAfterDiscount);
	//alert (varTotalAfterDiscount);
	
	
	
	
	//Calculation of TAX.
	
	//To Reset Cumulative Discount Options
	document.getElementById("subtotaldiscountrupees").value = "0.00"
	document.getElementById("subtotaldiscountpercent").value = "0.00"
	


	if (document.getElementById("totaldiscountamount").value != "0.00")
	{
		//alert ("1");
		var varTotalDiscountAmount = document.getElementById("totaldiscountamount").value;
		var varAfterDiscountAmount = parseFloat(varSubTotalAmount) - parseFloat(varTotalDiscountAmount);
		//alert (varTotalAfterDiscount);
		document.getElementById("subtotalaftercombinediscount").value = varAfterDiscountAmount.toFixed(2);	
		document.getElementById('afterdiscountamount').value = varAfterDiscountAmount.toFixed(2);
	}
	else if (document.getElementById("subtotaldiscountpercentapply1").value != "0.00")
	{
		//alert ("2");
		var varSubTotalAfterDiscountPercent = document.getElementById("subtotaldiscountpercentapply1").value;
		var varSubTotalAfterDiscountPercent = parseFloat(varSubTotalAfterDiscountPercent);
		//alert (varSubTotalAfterDiscountPercent);
		var varTotalAfterDiscount = parseFloat(varTotalAfterDiscount);
		var varSubTotalAfterDiscountPercent = varTotalAfterDiscount * varSubTotalAfterDiscountPercent;
		var varSubTotalAfterDiscountPercent = parseFloat(varSubTotalAfterDiscountPercent) / 100;
		//alert (varSubTotalAfterDiscountPercent);
		document.getElementById("subtotaldiscountamountapply1").value = parseFloat(varSubTotalAfterDiscountPercent).toFixed(2);
		var varSubTotalAfterDiscountPercent = parseFloat(varTotalAfterDiscount) - parseFloat(varSubTotalAfterDiscountPercent);
		//alert (varSubTotalAfterDiscountPercent);
		document.getElementById("subtotalaftercombinediscount").value = varSubTotalAfterDiscountPercent.toFixed(2);	
		//var varTotalAfterTax = varNetTotalTaxAmount + varTotalAfterDiscount;
		//alert (varTotalAfterTax);
		document.getElementById('afterdiscountamount').value = varSubTotalAfterDiscountPercent.toFixed(2);
	}
	else if (document.getElementById("subtotaldiscountamountonlyapply1").value != "0.00")
	{
		//alert ("3");
		var varSubTotalDiscountAmount = document.getElementById("subtotaldiscountamountonlyapply1").value;
		var varSubTotalDiscountAmount = parseFloat(varSubTotalDiscountAmount);
		//alert (varSubTotalDiscountAmount);
		
		var varSubTotalAmount = document.getElementById("subtotal").value;
		var varSubTotalAmount = parseFloat(varSubTotalAmount);
		//alert (varSubTotalAmount);
	
		var varDiscountPercentDerived = varSubTotalDiscountAmount * 100;
		var varDiscountPercentDerived = parseFloat(varDiscountPercentDerived);
		//alert (varDiscountPercentDerived);
		
		var varDiscountPercentDerived = varDiscountPercentDerived / varSubTotalAmount; 
		var varDiscountPercentDerived = parseFloat(varDiscountPercentDerived);
		//alert (varDiscountPercentDerived);
		
		//document.getElementById("subtotaldiscountamountonlyapply2").value = parseFloat(varDiscountPercentDerived).toFixed(2);
		document.getElementById("subtotaldiscountamountonlyapply2").value = parseFloat(varDiscountPercentDerived);//.toFixed(2);

		var varSubTotalDiscountAmount = varSubTotalAmount - varSubTotalDiscountAmount;
		var varSubTotalDiscountAmount = parseFloat(varSubTotalDiscountAmount);
		//alert (varSubTotalDiscountAmount);

		//var varSubTotalAfterDiscountAmount = parseFloat(varTotalAfterDiscount) - parseFloat(varSubTotalDiscountAmount);
		//alert (varSubTotalAfterDiscountAmount);
		//document.getElementById("subtotalaftercombinediscount").value = varSubTotalAfterDiscountAmount.toFixed(2);	

		document.getElementById("subtotalaftercombinediscount").value = varSubTotalDiscountAmount.toFixed(2);	
		
		//var varTotalAfterTax = varNetTotalTaxAmount + varTotalAfterDiscount;
		//alert (varTotalAfterTax);
		document.getElementById('afterdiscountamount').value = varSubTotalDiscountAmount.toFixed(2);
	}
	else
	{
		//alert ("4");
		var varTotalAfterDiscount = parseFloat(varTotalAfterDiscount);
		//alert (varTotalAfterDiscount);
		document.getElementById("subtotalaftercombinediscount").value = varTotalAfterDiscount.toFixed(2);	

		document.getElementById('afterdiscountamount').value = varTotalAfterDiscount.toFixed(2);
	}


		//var varTotalDiscountAmount = varTotalDiscountAmount * 1;
		var varTotalAfterDiscount = document.getElementById('afterdiscountamount').value;
		var varTotalAfterDiscount = varTotalAfterDiscount * 1;
		//var varTotalAfterDiscount = varSubTotalAmount - varTotalDiscountAmount;
		var varTotalAfterDiscount = varTotalAfterDiscount.toFixed(2);
		//document.getElementById('totalafterdiscount').value = varTotalAfterDiscount;
		//alert (varTotalAfterDiscount);
		
	
		
	if (document.getElementById("subtotaldiscountpercentapply1").value == "0.00" && document.getElementById("subtotaldiscountamountonlyapply1").value == "0.00")
	{
	//alert ("Normal Tax Calucaltion");
	<?php
		//To get default tax values
		if (isset($_SESSION["defaulttax"])) { $defaulttax = $_SESSION["defaulttax"]; } else { $defaulttax = ""; }
		//$defaulttax = $_SESSION[defaulttax];
		
		if ($defaulttax == '')
		{
			$query5 = "select * from master_tax where status = ''";
		}
		else
		{
			$query5 = "select * from master_tax where status = '' and auto_number = '$defaulttax'";
		}
		
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		while ($res5 = mysql_fetch_array($exec5))
		{
		$res5anum = $res5['auto_number'];
		$res5taxname = $res5['taxname'];
		$res5taxpercent = $res5['taxpercent'];
	?>

	//To avoid adding up existing amount, it needs to be reset to zero.
	document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value = "0.00";	
	
	for (z=1;z<=1000;z++)
	{
		//alert (z);
		if (document.getElementById('taxpercent'+z) != null) 
		{
			//alert ('<?php echo $res5taxname; ?>');
			//alert (i);
			var varTaxPercentageTextBox = document.getElementById('taxpercent'+z).value;
			//alert (varTaxPercentageTextBox);
			var varTaxAutoNumberTextBox = document.getElementById('taxautonumber'+z).value;
			//alert (varTaxPercentageTextBox);
	
			var varTaxPercentage = <?php echo $res5taxpercent; ?>;
			//alert (varTaxPercentage);
			var varTaxAutoNumber = <?php echo $res5anum; ?>;
			//alert (varTaxAutoNumber);

			if (varTaxPercentage == varTaxPercentageTextBox)
			{
				if (varTaxAutoNumber == varTaxAutoNumberTextBox)
				{
					//alert ('Inside <?php echo $res5taxname; ?>');
					var varTaxPercentage = varTaxPercentage * 1;
					//var varTaxTotalAmount = document.getElementById('totalafterdiscount').value;
					var varTaxTotalAmount<?php echo $res5anum; ?> = document.getElementById('totalamount'+z).value; //total amount of individual item.
					//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
					var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> * 1;
					var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> / 100;
					var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> * varTaxPercentage;
					//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
					
					var varCurrentTaxTotalAmount = document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value;
					//alert (varCurrentTaxTotalAmount);
					var varCurrentTaxTotalAmount = varCurrentTaxTotalAmount * 1;
					var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> + varCurrentTaxTotalAmount;
					//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
					var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?>.toFixed(2);
					//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
					
					document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value = varTaxTotalAmount<?php echo $res5anum; ?>;
					
					var varTotalAfterTax = varTotalAfterTax * 1;
					var varTaxTotalAmount = varTaxTotalAmount * 1;
					var varTotalAfterTax = varTotalAfterTax + varTaxTotalAmount;
				}
			}
		}
	}
	
	<?php
	$tslct = '';
	//to calculate sub taxes if any.
	$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	while ($res6 = mysql_fetch_array($exec6))
	{
		$tslct = $tslct + 1;
		$res6anum = $res6['auto_number'];
		$res6taxsubname = $res6['taxsubname'];
		$res6taxsubpercent = $res6['taxsubpercent'];
		?>
		//alert("Subtax <?php echo $tslct; ?>");
		var varTaxSubPercentage<?php echo $tslct; ?> = <?php echo $res6taxsubpercent; ?>;
		var varTaxSubPercentage<?php echo $tslct; ?> = varTaxSubPercentage<?php echo $tslct; ?> * 1;
		var varTaxTotalAmount<?php echo $tslct; ?> = document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value;
		var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * 1;
		var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> / 100;
		var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * varTaxSubPercentage<?php echo $tslct; ?>;
		var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?>.toFixed(2);
		//To avoid duplicates, parent taxanum is joined.
		document.getElementById('totaltaxsubamount<?php echo $res5anum; ?><?php echo $tslct; ?>').value = varTaxTotalAmount<?php echo $tslct; ?>;

		var varTotalAfterTax = varTotalAfterTax * 1;
		var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * 1;
		var varTotalAfterTax = varTotalAfterTax + varTaxTotalAmount<?php echo $tslct; ?>;

		<?php
	}

	} //end of master tax while.

	?>
	var varNetTotalMainTax1 = 0;
	var varNetTotalMainTax2 = 0;
	var varNetTotalSubTax1 = 0;
	var varNetTotalSubTax2 = 0;
	for (x=1;x<=100;x++)
	{
		if (document.getElementById('totaltaxamount'+x) != null) 
		{
			//alert (document.getElementById('totaltaxamount'+x).value);
			var varNetTotalMainTax1 = document.getElementById('totaltaxamount'+x).value;
			var varNetTotalMainTax1 = varNetTotalMainTax1 * 1;
			var varNetTotalMainTax2 = varNetTotalMainTax2 * 1;
			var varNetTotalMainTax2 = varNetTotalMainTax2 + varNetTotalMainTax1;
		}
		for (y=1;y<=5;y++)
		{
			if (document.getElementById('totaltaxsubamount'+x+y) != null) 
			{
				//alert (document.getElementById('totaltaxsubamount'+x+y).value);
				var varNetTotalSubTax1 = document.getElementById('totaltaxsubamount'+x+y).value;
				var varNetTotalSubTax1 = varNetTotalSubTax1 * 1;
				var varNetTotalSubTax2 = varNetTotalSubTax2 * 1;
				var varNetTotalSubTax2 = varNetTotalSubTax2 + varNetTotalSubTax1;
			}
		}
	}
	
	} // Normal Tax calculation if condition end.
	else
	{
		//alert ("Tax Calculated From Sub Total");
		var varTaxPercentageTextBox = "";
		var varTaxAutoNumberTextBox = "";
		var varNetTotalMainTax2 = "0";
		var varNetTotalSubTax2 = "0";

		<?php
			//To get default tax values
			if (isset($_SESSION["defaulttax"])) { $defaulttax = $_SESSION["defaulttax"]; } else { $defaulttax = ""; }
			//$defaulttax = $_SESSION[defaulttax];
			
			if ($defaulttax == '')
			{
				$query5 = "select * from master_tax where status = ''";
			}
			else
			{
				$query5 = "select * from master_tax where status = '' and auto_number = '$defaulttax'";
			}
			
			$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
			while ($res5 = mysql_fetch_array($exec5))
			{
			$res5anum = $res5['auto_number'];
			$res5taxname = $res5['taxname'];
			$res5taxpercent = $res5['taxpercent'];
		?>
	
			if (document.getElementById('taxpercent1') != null) 
			{
				var varTaxPercentageTextBox = document.getElementById('taxpercent1').value;
				//alert (varTaxPercentageTextBox);
				var varTaxAutoNumberTextBox = document.getElementById('taxautonumber1').value;
				//alert (varTaxPercentageTextBox);
		
			}
				var varTaxPercentage = <?php echo $res5taxpercent; ?>;
				//alert (varTaxPercentage);
				var varTaxAutoNumber = <?php echo $res5anum; ?>;
				//alert (varTaxAutoNumber);
						
			if (varTaxAutoNumberTextBox == varTaxAutoNumber)
			{
				//alert ('Inside <?php echo $res5taxname; ?>');
				var varTaxPercentage = varTaxPercentage * 1;
				//var varTaxTotalAmount = document.getElementById('totalafterdiscount').value;
				var varTaxTotalAmount<?php echo $res5anum; ?> = document.getElementById("subtotalaftercombinediscount").value; //sub total after discount apply.
				//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
				var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> * 1;
				var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> / 100;
				var varTaxTotalAmount<?php echo $res5anum; ?> = varTaxTotalAmount<?php echo $res5anum; ?> * varTaxPercentage;
				//alert (varTaxTotalAmount<?php echo $res5anum; ?>);
				
				document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value = varTaxTotalAmount<?php echo $res5anum; ?>.toFixed(2);;
				
				var varNetTotalMainTax2 = varTaxTotalAmount<?php echo $res5anum; ?>;
				//alert (varNetTotalMainTax2);
		
		<?php
		//to calculate sub taxes if any.
		$tslct = '';
		$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
		$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
		while ($res6 = mysql_fetch_array($exec6))
		{
			$tslct = $tslct + 1;
			$res6anum = $res6['auto_number'];
			$res6taxsubname = $res6['taxsubname'];
			$res6taxsubpercent = $res6['taxsubpercent'];
			?>
			//alert("Subtax <?php echo $tslct; ?>");
			var varTaxSubPercentage<?php echo $tslct; ?> = <?php echo $res6taxsubpercent; ?>;
			var varTaxSubPercentage<?php echo $tslct; ?> = varTaxSubPercentage<?php echo $tslct; ?> * 1;
			var varTaxTotalAmount<?php echo $tslct; ?> = document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value;
			var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * 1;
			var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> / 100;
			var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * varTaxSubPercentage<?php echo $tslct; ?>;
			var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?>.toFixed(2);
			//To avoid duplicates, parent taxanum is joined.
			document.getElementById('totaltaxsubamount<?php echo $res5anum; ?><?php echo $tslct; ?>').value = varTaxTotalAmount<?php echo $tslct; ?>.toFixed(2);;
			//alert (varTaxTotalAmount<?php echo $tslct; ?>);
			var varNetTotalSubTax2 = varNetTotalSubTax2 * 1;
			var varTaxTotalAmount<?php echo $tslct; ?> = varTaxTotalAmount<?php echo $tslct; ?> * 1;
			var varNetTotalSubTax2 = varNetTotalSubTax2 + varTaxTotalAmount<?php echo $tslct; ?>;
				
			<?php
			}
			?>

			}
	
			<?php
		//}
	
		} //end of master tax while.
		?>
	
	}
	
	//alert (varNetTotalMainTax2);
	//alert (varNetTotalSubTax2);
	var varNetTotalTaxAmount = varNetTotalMainTax2 + varNetTotalSubTax2;
	var varNetTotalTaxAmount = varNetTotalTaxAmount * 1;
	//alert (varNetTotalTaxAmount);
	var varTotalAfterDiscount = varTotalAfterDiscount * 1;
	//alert (varTotalAfterDiscount);
	
	var varTotalAfterTax = varNetTotalTaxAmount + varTotalAfterDiscount;
	//alert (varTotalAfterTax);
	var varTotalAfterTax = varTotalAfterTax.toFixed(2);
	document.getElementById('totalaftertax').value = varTotalAfterTax;
	
	funcNetAmountCalc1();

}

function funcNetAmountCalc1()
{
	
	var varTotalAfterTax = document.getElementById("totalaftertax").value;
	var varPackagingAmount = document.getElementById("packaging").value;
	var varDeliveryAmount = document.getElementById("delivery").value;
	//var varNetAmount = parseFloat(varAfterDiscountAmount) + parseFloat(varDeliveryAmount);
	var varNetAmount = parseFloat(varTotalAfterTax) + parseFloat(varPackagingAmount) + parseFloat(varDeliveryAmount);
	
<?php
$query1roundoff = "select * from master_roundoff where defaultstatus = 'default'";
$exec1roundoff = mysql_query($query1roundoff) or die ("Error in Query1roundoff".mysql_error());
$res1roundoff = mysql_fetch_array($exec1roundoff);
$roundoffvalue = $res1roundoff['roundoff'];

if ($roundoffvalue == 'NO ROUND OFF')
{
?>
	//no round off apply.
	//alert ("NO ROUND OFF");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
if ($roundoffvalue == 'NEAREST TEN PAISE')
{
?>
	//to round off to nearest ten paise.
	//alert ("NEAREST TEN PAISE");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(1);
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
if ($roundoffvalue == 'NEAREST FIFTY PAISE')
{
?>
	//to round off to nearest fifty paise.
	//alert ("NEAREST FIFTY PAISE");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = roundToHalf(varNetAmount2); //function given below 
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
if ($roundoffvalue == 'NEAREST ONE RUPEE')
{
?>
	//to round off to nearest rupee.
	//alert ("NEAREST ONE RUPEE");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(0);
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
if ($roundoffvalue == 'NEAREST FIVE RUPEES')
{
?>
	//to round off to nearest five rupees.
	//alert ("NEAREST FIVE RUPEES");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = round5(varNetAmount2); //function given below 
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
if ($roundoffvalue == 'NEAREST TEN RUPEES')
{
?>
	//to round off to nearest ten rupees.
	//alert ("NEAREST TEN RUPEES");
	var varNetAmount2 = varNetAmount;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = round10(varNetAmount2); //function given below 
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	//document.getElementById('netamount').value = varNetAmount2;
<?php
}
?>


	var varBeforeRoundOff = varNetAmount;
	var varBeforeRoundOff = parseFloat(varBeforeRoundOff);
	//var varAfterRoundOff = Math.round(varBeforeRoundOff);
	var varAfterRoundOff = varNetAmount2;
	var varAfterRoundOff = parseFloat(varAfterRoundOff);
	var varRoundOffAmount = parseFloat(varAfterRoundOff) - parseFloat(varBeforeRoundOff);
	//alert (varRoundOffAmount);
	
	//document.getElementById("totalamount").value = varNetAmount.toFixed(2);
	document.getElementById("roundoff").value = varRoundOffAmount.toFixed(2);
	document.getElementById("totalamount").value = varAfterRoundOff.toFixed(2);
	
	var varTDShowTotalAmount1 = document.getElementById("totalamount").value;
	//var varTDShowTotalAmount1 = "Total: "+varTDShowTotalAmount1;
	
	//document.getElementById("tdShowTotalAmount1").innerHTML = varTDShowTotalAmount1;
	
}


function round5(x) 
{     
	return (x % 5) >= 2.5 ? parseInt(x / 5) * 5 + 5 : parseInt(x / 5) * 5; 
}  
function round10(x) 
{     
	return (x % 10) >= 5 ? parseInt(x / 10) * 10 + 10 : parseInt(x / 10) * 10; 
}  
function roundToHalf(value) 
{ 
   var converted = parseFloat(value); // Make sure we have a number 
   var decimal = (converted - parseInt(converted, 10)); 
   decimal = Math.round(decimal * 10); 
   if (decimal == 5) 
   { 
	   return (parseInt(converted, 10)+0.5); 
   } 
   if ( (decimal < 3) || (decimal > 7) ) 
   { 
      return Math.round(converted); 
   } 
   else 
   {
      return (parseInt(converted, 10)+0.5); 
   } 
} 




function funcCumulativeDiscountReset1()
{
	document.getElementById("subtotaldiscountrupees").value = "0.00"
	document.getElementById("subtotaldiscountpercent").value = "0.00"
	document.getElementById("totaldiscountamount").value = "0.00"
	document.getElementById("afterdiscountamount").value = "0.00"
}



function funcBodyOnLoad()
{
	document.getElementById("itemcode").focus();	
}	
	
function funcSaveBill1()
{

	if (document.getElementById("enditemcode").value == "")
	{
		alert ("Please Select End Item To Proceed.");
		document.getElementById("enditemcode").focus();
		return false;
	}
	if (document.getElementById("subtotal").value == "0.00" || document.getElementById("subtotal").value == "0.0" || document.getElementById("subtotal").value == "")
	{
		alert ("No Items Selected. Please Add Items To Proceed.");
		document.getElementById("itemcode").focus();
		return false;
	}
	if (document.getElementById("totalunitsproduced").value == "0.00" || document.getElementById("totalunitsproduced").value == "0.0" || document.getElementById("totalunitsproduced").value == "0" || document.getElementById("totalunitsproduced").value == "")
	{
		alert ("Please Enter Total Units Produced To Proceed.");
		document.getElementById("totalunitsproduced").focus();
		return false;
	}
	if (isNaN(document.getElementById("totalunitsproduced").value))
	{
		alert ("Total Units Produced Can Only Be Numbers.");
		document.getElementById("totalunitsproduced").value = "0.00"
		document.getElementById("totalunitsproduced").focus();
		funcSubTotalCalc();
		return false;
	}
	
	var varUserChoice; 
	varUserChoice = confirm('Are You Sure Want To Save This Entry?'); 
	//alert(fRet); 
	if (varUserChoice == false)
	{
		alert ("Entry Not Saved.");
		return false;
	}
	
	//return false;
}

function funcTotalUnitsProducedLostFocus1()
{
	if (document.getElementById("totalunitsproduced").value == "0.00" || document.getElementById("totalunitsproduced").value == "0.0" || document.getElementById("totalunitsproduced").value == "0" || document.getElementById("totalunitsproduced").value == "")
	{
		alert ("Please Enter Total Units Produced To Proceed.");
		document.getElementById("totalunitsproduced").value = "0.00"
		document.getElementById("costperunit").value = "0.00";
		//document.getElementById("totalunitsproduced").focus();
		return false;
	}
	if (isNaN(document.getElementById("totalunitsproduced").value))
	{
		alert ("Total Units Produced Can Only Be Numbers.");
		document.getElementById("totalunitsproduced").value = "0.00"
		document.getElementById("costperunit").value = "0.00";
		document.getElementById("totalunitsproduced").focus();
		funcSubTotalCalc();
		return false;
	}
	
	var varTotalUnitsProduced = document.getElementById("totalunitsproduced").value;
	if (varTotalUnitsProduced != 0)
	{
		var varTotalAmount = document.getElementById("totalamount").value;
		
		var varTotalUnitsProduced = parseFloat(varTotalUnitsProduced);
		var varTotalAmount = parseFloat(varTotalAmount);
		var varCostPerUnit = varTotalAmount / varTotalUnitsProduced;
		var varCostPerUnit = parseFloat(varCostPerUnit);
		
		var varCostPerUnit = parseFloat(varCostPerUnit).toFixed(2);
		document.getElementById("costperunit").value = varCostPerUnit;
	}
	else
	{
		document.getElementById("costperunit").value = "0.00";
	}
	
}

function funcbillamountcalc1()
{
	/*
	if (document.getElementById("cashgivenbysupplier").value == "")
	{
		document.getElementById("cashgivenbysupplier").value = "0.00"
		return false;
	}
	*/
	if (document.getElementById("subtotaldiscountrupees").value == 0 && document.getElementById("subtotaldiscountpercent").value == 0)
	{
			//To reset all the values to zero if already given discount is reversed.
			funcSubTotalCalc();
			//return false;
	}
	if (document.getElementById("subtotaldiscountrupees").value != "0.00" && document.getElementById("subtotaldiscountpercent").value != "0.00")
	{
			alert ("Either Discount Percent Or Discount Amount Can Be Given. Percent And Amount Together Not Allowed.");
			document.getElementById("subtotaldiscountrupees").value = "0.00";
			document.getElementById("subtotaldiscountpercent").value = "0.00";
			document.getElementById("totaldiscountamount").value = "0.00";
			document.getElementById("afterdiscountamount").value = "0.00";
			return false;
	}

	if (isNaN(document.getElementById("subtotaldiscountpercent").value))
	{
		alert ("Sub Total Discount Percent Can Only Be Numbers.");
		document.getElementById("subtotaldiscountpercent").value = "0.00"
		document.getElementById("subtotaldiscountpercent").focus();
		return false;
	}
	if (document.getElementById("subtotaldiscountpercent").value != "0.00")
	{
		document.getElementById("subtotaldiscountpercent").value = parseFloat(document.getElementById("subtotaldiscountpercent").value).toFixed(2);
		var varSubTotalDiscountPercent = parseFloat(document.getElementById("subtotaldiscountpercent").value).toFixed(2);
		var varSubTotalAmount = parseFloat(document.getElementById("subtotal").value).toFixed(2);

		if (parseFloat(varSubTotalDiscountPercent) > 100)
		{
			alert ("Sub Total Discount Percent Cannot Be Greater Than 100.")
			document.getElementById("subtotaldiscountpercent").value = "0.00";
			return false;
		}
		var varDiscountPercentAmount = parseFloat(varSubTotalDiscountPercent) * parseFloat(varSubTotalAmount);
		var varDiscountPercentAmount = parseFloat(varDiscountPercentAmount) / 100;
		var varAfterDiscountAmount = parseFloat(varSubTotalAmount) - parseFloat(varDiscountPercentAmount);
		document.getElementById("totaldiscountamount").value = parseFloat(varDiscountPercentAmount).toFixed(2);
		document.getElementById("afterdiscountamount").value = parseFloat(varAfterDiscountAmount).toFixed(2);

		//funcSubTotalCalc();
	}
	if (isNaN(document.getElementById("subtotaldiscountrupees").value))
	{
		alert ("Sub Total Discount Rupees Can Only Be Numbers.");
		document.getElementById("subtotaldiscountrupees").value = "0.00"
		document.getElementById("subtotaldiscountrupees").focus();
		return false;
	}
	if (document.getElementById("subtotaldiscountrupees").value != "0.00")
	{
		document.getElementById("subtotaldiscountrupees").value = parseFloat(document.getElementById("subtotaldiscountrupees").value).toFixed(2);
		var varSubTotalDiscountRupees = parseFloat(document.getElementById("subtotaldiscountrupees").value).toFixed(2);
		var varSubTotalAmount2 = parseFloat(document.getElementById("subtotal").value).toFixed(2);
		if (parseFloat(varSubTotalDiscountRupees) > parseFloat(varSubTotalAmount2))
		{
			alert ("Sub Total Discount Rupees Cannot Be Greater Than Sub Total Amount.")
			document.getElementById("subtotaldiscountrupees").value = "0.00"
			document.getElementById("subtotaldiscountrupees").focus();
			return false;
		}
		var varAfterDiscountAmount = parseFloat(varSubTotalAmount2) - parseFloat(varSubTotalDiscountRupees);
		document.getElementById("totaldiscountamount").value = parseFloat(varSubTotalDiscountRupees).toFixed(2);
		document.getElementById("afterdiscountamount").value = parseFloat(varAfterDiscountAmount).toFixed(2);

		//funcSubTotalCalc();
	}
	
	//To check and apply discount for over all bill total only if tax percent are same.
	if (document.getElementById("subtotaldiscountrupees").value != "0.00" || document.getElementById("subtotaldiscountpercent").value != "0.00")
	{
			var varTaxPercentCheck1 = 0;
			for (z=1;z<=100;z++)
			{
				//alert (z);
				if (document.getElementById('taxpercent'+z) != null) 
				{
					//alert (z);
					var varTaxPercentageTextBox = document.getElementById('taxpercent'+z).value;
					//alert (varTaxPercentageTextBox);
					if (varTaxPercentCheck1 == "")
					{
						//alert ("Empty"); //To assign value of first tax percent to check all the tax percent are equal.
						varTaxPercentCheck1 = varTaxPercentageTextBox;
						funcCumulativeDiscCalc1();
					}
					else
					{
						//alert ("Full"); //To compare if the following tax percent boxes are equal. if not no discount allowed.
						if (varTaxPercentCheck1 != varTaxPercentageTextBox)
						{
							//alert ("Differenct Taxes.");
							alert ("Sorry. Cumulative Discount Cannot Be Applied. Tax Percentage Is Different For More Than One Item.");
							alert ("Discount Apply Not Completed.");
							document.getElementById("subtotaldiscountrupees").value = "0.00"
							document.getElementById("subtotaldiscountpercent").value = "0.00"
							document.getElementById("totaldiscountamount").value = "0.00"
							document.getElementById("afterdiscountamount").value = "0.00"
							funcSubTotalCalc();
							return false;
						}
						else
						{
							funcCumulativeDiscCalc1();
						}
					}
				}
			}
			//return false;
	}
	


	if (isNaN(document.getElementById("delivery").value))
	{
		alert ("Delivery Amount Can Only Be Numbers.");
		document.getElementById("delivery").value = "0.00"
		document.getElementById("delivery").focus();
		funcSubTotalCalc();
		return false;
	}
	else
	{
		document.getElementById("delivery").value = parseFloat(document.getElementById("delivery").value).toFixed(2);
		
		var varSubTotalAmount1 = document.getElementById("subtotal").value;
		var varTotalAfterDiscount1 = document.getElementById("afterdiscountamount").value;
		if (varTotalAfterDiscount1 == varSubTotalAmount1)
		{
			//calling item wise calculation.
			funcSubTotalCalc();
			//return false;
		}
	}
	funcPaymentInfoCalculation1()
}



</script>