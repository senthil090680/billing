<script language="javascript">

function funcItemCodeEnterKeyPress1(e)
{
	evt = e || window.event; 
	key = evt.keyCode;
	//alert (key);
	if(key == 13) // if enter key press
	{
		//function call from quotation1.php
		//alert ("Inside Event Function.");
		itemcodeentry1();
		return false;
	}

}

function cbcustomername1()
{
	document.cbform1.submit();
}

function customervalidation()
{
//alert("Inside customer valid");
	if (document.form1.customername.value == "")
	{
		alert ("Customer Name Cannot Be Empty.");
		document.form1.customername.focus();
		return false;
	}
/*	else if (document.form1.contactperson1.value == "")
	{
		alert ("Contact Person Name Cannot Be Empty.");
		document.form1.contactperson1.focus();
		return false;
	}
	else if (document.form1.title1.value == "")
	{
		alert ("Title Cannot Be Empty.");
		document.form1.title1.focus();
		return false;
	}
	else if (document.form1.designation1.value == "")
	{
		alert ("Designation Cannot Be Empty.");
		document.form1.designation1.focus();
		return false;
	}
*/	else if (document.form1.city.value == "")
	{
		alert ("City Cannot Be Empty.");
		document.form1.city.focus();
		return false;
	}
	else if (document.form1.state.value == "")
	{
		alert ("State Cannot Be Empty.");
		document.form1.state.focus();
		return false;
	}
	else if (document.form1.quotationnumberprefix.value == "")
	{
		alert ("Quotation Prefix Cannot Be Empty.");
		document.form1.quotationnumberprefix.focus();
		return false;
	}
	else if (document.form1.netamount.value == "0.00")
	{
		alert ("Quotation Total Amount Cannot Be Zero. Please Add Item To Proceed.");
		document.form1.netamount.focus();
		return false;
	}
	if (document.form1.billtype.value == "")
	{
		alert ("Please Select Quotation Type From Select Type Box.");
		document.form1.billtype.focus();
		//document.form1.itemcode.focus();
		return false;
	}
	
	//else if (document.getElementById("lumpsum").value != "")
//	{
//	alert("Inside");
//		if (isNaN(document.getElementById("lumpsum").value))
//		{
//			alert ("Lumpsum Amount Can Only Be Numbers.");
//			document.getElementById("lumpsum").value = "0.00";
//			return false;
//		}
//		else
//		{
//		alert("Inside Else");
//		}
	//}
	//var fRet3; 
//	fRet3 = confirm('Bill Ready To Be Saved. Are You Sure Want To Save?'); 
//	//alert(fRet); 
//	if (fRet3 == false)
//	{
//		alert ("Bill Entry Not Completed.");
//		return false;
//	}
		
}


function process1()
{

}

//function process1rateperunit()
//{
	//servicenameonchange1();
//}




function quantityvalidation()
{
		if (document.getElementById("rateperunit").value == "")
		{
			alert ("Rate Per Unit Cannot Be Empty. If Not Applicable Please Enter 0.00 As Rate.");
			document.getElementById("rateperunit").focus();
			document.getElementById("rateperunit").value = "0.00"
			return false;
		}
		if (isNaN(document.getElementById("rateperunit").value))
		{
			alert ("Rate Per Unit Can Only Be Numbers.");
			document.getElementById("rateperunit").focus();
			return false;
		}
		if (document.getElementById("quantity").value == "")
		{
			alert ("Quantity Cannot Be Empty.");
			document.getElementById("quantity").focus();
			document.getElementById("quantity").value = "1"
			return false;
		}
		if (document.getElementById("quantity").value == "0")
		{
			alert ("Quantity Cannot Be Zero. Minimum Shoule Be 1.");
			document.getElementById("quantity").focus();
			document.getElementById("quantity").value = "1"
			return false;
		}
		if (isNaN(document.getElementById("quantity").value))
		{
			alert ("Quantity Can Only Be Numbers.");
			document.getElementById("quantity").value = "1";
			document.getElementById("quantity").focus();
			return false;
		}
		if (isNaN(document.getElementById("discountpercent").value))
		{
			alert ("Discount Percent Can Only Be Numbers.");
			document.getElementById("discountpercent").focus();
			document.getElementById("discountpercent").value = "0.00";
			return false;
		}
		if (isNaN(document.getElementById("discountamount").value))
		{
			alert ("Discount Amount Can Only Be Numbers.");
			document.getElementById("discountamount").focus();
			document.getElementById("discountamount").value = "0.00";
			return false;
		}
		if (document.getElementById("discountpercent").value != "0.00" && document.getElementById("discountamount").value != "0.00")
		{
			//alert ("1983");
			alert ("Discount Should Be Either Percentage or Rupees. Both Cannot Be Given. Discount Will Be Reset To Zero.");
			document.getElementById("discountpercent").value = "0.00"
			document.getElementById("discountamount").value = "0.00"
			document.form1.discountpercent.focus();
			return false;
		}
		
		var valQuantity = 0;
		valQuantity = document.getElementById("quantity").value;
		var valRatePerUnit = 0;
		valRatePerUnit = document.getElementById("rateperunit").value;
		
		var valTotalAmount = 0;
		var valTotalAmount = valQuantity * valRatePerUnit;
		var valTotalAmount = valTotalAmount.toFixed(2);
		document.getElementById("totalamount").value = valTotalAmount;
		document.getElementById("subtotal").value = valTotalAmount;
		
		var varDiscountAmount = 0;
		if (document.getElementById("discountpercent").value == "")
		{
			document.getElementById("discountpercent").value = "0.00";		
		}
		else
		{
			var varDiscountPercent = document.getElementById("discountpercent").value;
			var varDiscountPercent = varDiscountPercent * 1;
			var varDiscountPercent = varDiscountPercent.toFixed(2);
			document.getElementById("discountpercent").value = varDiscountPercent;
			
			var varDiscountAmount = 0;
			var varDiscountAmount = valTotalAmount / 100;
			var varDiscountAmount = varDiscountAmount * 1;
			var varDiscountPercent = 0;
			var varDiscountPercent = document.getElementById("discountpercent").value;
			var varDiscountPercent = varDiscountPercent * 1;
			var varDiscountAmount = varDiscountAmount * varDiscountPercent;
		}

		if (varDiscountAmount == "0")
		{
			if (document.getElementById("discountamount").value == "")
			{
				document.getElementById("discountamount").value = "0.00";		
			}
			else
			{
				var varDiscountAmount = parseFloat(document.getElementById("discountamount").value);
				var varDiscountAmount = varDiscountAmount.toFixed(2);
				document.getElementById("discountamount").value = varDiscountAmount;
			}
		}

		var valNetTotalAmount = valTotalAmount - varDiscountAmount;
		var valNetTotalAmount = valNetTotalAmount.toFixed(2);
		//document.getElementById("subtotalafterdiscount").value = valNetTotalAmount;
		document.getElementById("totalamount").value = valNetTotalAmount;

		//alert ("Meow.");
		funcSubTotalCalc();

}





function listingquantityvalidation(controlID)
{
		var conID = controlID;
		
/*		
		if (document.getElementById("quantity" + conID).value == "")
		{
			alert ("Quantity Cannot Be Empty.");
			document.getElementById("quantity" + conID).focus();
			document.getElementById("quantity" + conID).value = "1"
			return false;
		}
		if (document.getElementById("quantity" + conID).value == "0")
		{
			alert ("Quantity Cannot Be Zero. Minimum Shoule Be 1.");
			document.getElementById("quantity" + conID).focus();
			document.getElementById("quantity" + conID).value = "1"
			return false;
		}
		if (isNaN(document.getElementById("quantity" + conID).value))
		{
			alert ("Quantity Can Only Be Numbers.");
			document.getElementById("quantity" + conID).focus();
			return false;
		}
		
		var valQuantity = 0;
		valQuantity = document.getElementById("quantity" + conID).value;
		var valRatePerUnit = 0;
		valRatePerUnit = document.getElementById("rateperunit" + conID).value;
		
		var valTotalAmount = 0;
		var valTotalAmount = valQuantity * valRatePerUnit;
		var valTotalAmount = valTotalAmount.toFixed(2);
		document.getElementById("totalamount" + conID).value = valTotalAmount;
		document.getElementById("subtotal" + conID).value = valTotalAmount;
		
		if (document.getElementById("discountpercent" + conID).value == "")
		{
			document.getElementById("discountpercent" + conID).value = "0.00";		
		}
		else
		{
			var varDiscountPercent = document.getElementById("discountpercent" + conID).value;
			var varDiscountPercent = varDiscountPercent * 1;
			var varDiscountPercent = varDiscountPercent.toFixed(2);
			document.getElementById("discountpercent" + conID).value = varDiscountPercent;
		}
		
		var varDiscountAmount = 0;
		var varDiscountAmount = valTotalAmount / 100;
		var varDiscountAmount = varDiscountAmount * 1;
		var varDiscountPercent = 0;
		var varDiscountPercent = document.getElementById("discountpercent" + conID).value;
		var varDiscountPercent = varDiscountPercent * 1;
		var varDiscountAmount = varDiscountAmount * varDiscountPercent;
		var valNetTotalAmount = valTotalAmount - varDiscountAmount;
		var valNetTotalAmount = valNetTotalAmount.toFixed(2);
		document.getElementById("totalamount" + conID).value = valNetTotalAmount;
		
		//to recalculate everything
		//alert ("Meow.");
*/		

		funcSubTotalCalc();

}


function disableEnterKey(varPassed)
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		event.keyCode=0; 
		return event.keyCode 
		return false;
	}
	
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}

	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		var varGet = varPassed;
		//alert (varGet);
		if (varGet == undefined)
		{
			//alert ("inside if");
			quantityvalidation()
		}
		else
		{
			//alert ("inside else");
			listingquantityvalidation(varGet)
		}
		return false;
	}
	else
	{
		return true;
	}
}


function btnClick() 
{
	if (document.form1.customername.value == "")
	{
		//alert ("Customer Name Cannot Be Empty.");
		//document.getElementById("searchcustomername").focus();
		//return false;
	}
	if (document.getElementById("discountpercent").value == "")
	{
		alert ("Discount Percent Cannot Be Blank.");
		document.getElementById("discountpercent").focus();
		document.getElementById("discountpercent").value = "0.00"
		return false;
	}
	if (document.getElementById("discountpercent").value == "0")
	{
		//alert ("Quantity Cannot Be Zero. Minimum Shoule Be 1.");
		//document.getElementById("quantity").focus();
		document.getElementById("discountpercent").value = "0.00"
		//return false;
	}
	if (isNaN(document.getElementById("discountpercent").value))
	{
		alert ("Discount Percent Can Only Be Numbers.");
		document.getElementById("discountpercent").focus();
		return false;
	}
	
	if (document.getElementById("discountamount").value == "")
	{
		alert ("Discount Amount Cannot Be Blank.");
		document.getElementById("discountamount").focus();
		document.getElementById("discountamount").value = "0.00"
		return false;
	}
	if (document.getElementById("discountamount").value == "0")
	{
		document.getElementById("discountamount").value = "0.00"
		//return false;
	}
	if (isNaN(document.getElementById("discountamount").value))
	{
		alert ("Discount Amount Can Only Be Numbers.");
		document.getElementById("discountamount").focus();
		return false;
	}
	if (document.getElementById("discountpercent").value != "0.00" && document.getElementById("discountamount").value != "0.00")
	{
		//alert (document.getElementById("discountpercent").value);
		//alert (document.getElementById("discountamount").value);
		alert ("Discount Should Be Either Percentage or Rupees. Both Cannot Be Given. Discount Will Be Reset To Zero.");
		document.form1.discountpercent.focus();
		return false;
	}
	
	


	
	var varLoopCount = 0;
	
	for (i=1;i<=1000;i++)
	{
		var varitemcode = document.getElementById('itemcode').value;
		var varcategoryname = document.getElementById('categoryname').value;
		//var varitemname = document.getElementById('itemname').value;
		var varitemname = document.getElementById('itemname').value;
		//alert (varitemname);
		var varunitname = document.getElementById('unitname').value;
		var varrateperunit = document.getElementById('rateperunit').value;
		var varquantity = document.getElementById('quantity').value;
		var vartotalamount = document.getElementById('totalamount').value;
		var varsubtotal = document.getElementById('subtotal').value;
		var vartaxpercent = document.getElementById('taxpercent').value;
		var vardiscountpercent = document.getElementById('discountpercent').value;
		var vardiscountamount = document.getElementById('discountamount').value;
		var varadditionaltext = document.getElementById('additionaltext').value;
		var vartaxautonum = document.getElementById('taxautonum').value;
				
		if (document.getElementById('serialnumber'+i) == null) 
		{
			//alert('serialnumber ' + i + ' is missing!');
			if (varitemcode == "")
			{
				if (varadditionaltext == "")
				{
					alert ("Please Select Item To Add To Bill. If This Item Is Not In Master, You May Add Only Additional Text.");
					return false;
				}
			}
						
			var i = parseInt(i);// + 1;
			//var tr = document.createElement ('<TR id="idTR'+i+'"></TR>');
			var tr = document.createElement ('TR');
			tr.id = "idTR"+i+"";
			
			//var td1 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td1 = document.createElement ('td');
			td1.id = "idTD1"+i+"";
			td1.align = "left";
			td1.valign = "top";
			td1.style.backgroundColor = "#FFFFFF";
			td1.style.border = "0px solid #001E6A";
			//var text1 = document.createElement ('<input name="serialnumber'+i+'" value="'+i+'" id="serialnumber'+i+'" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="1" />');
			var text1 = document.createElement ('input');
			text1.id = "serialnumber"+i+"";
			text1.name = "serialnumber"+i+"";
			text1.type = "text";
			text1.size = "1";
			text1.value = i;
			text1.readOnly = "readonly";
			text1.style.backgroundColor = "#FFFFFF";
			text1.style.border = "1px solid #001E6A";
			text1.style.textAlign = "left";
			td1.appendChild (text1);
			tr.appendChild (td1);
			
			//var td2 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td2 = document.createElement ('td');
			td2.id = "idTD1"+i+"";
			td2.align = "left";
			td2.valign = "top";
			td2.style.backgroundColor = "#FFFFFF";
			td2.style.border = "0px solid #001E6A";
			//var text2 = document.createElement ('<input name="itemcode'+i+'" value="'+varitemcode+'" id="itemcode'+i+'" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" size="7" readonly="readonly" />');
			var text2 = document.createElement ('input');
			text2.id = "itemcode"+i+"";
			text2.name = "itemcode"+i+"";
			text2.type = "text";
			text2.size = "7";
			text2.value = varitemcode;
			text2.readOnly = "readonly";
			text2.style.backgroundColor = "#FFFFFF";
			text2.style.border = "1px solid #001E6A";
			text2.style.textAlign = "left";
			td2.appendChild (text2);
			tr.appendChild (td2);
			
			//var td3 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td3 = document.createElement ('td');
			td3.id = "idTD1"+i+"";
			td3.align = "left";
			td3.valign = "top";
			td3.style.backgroundColor = "#FFFFFF";
			td3.style.border = "0px solid #001E6A";
			//var text3 = document.createElement ('<input type="hidden" name="categoryname'+i+'" value="'+varcategoryname+'" size="15" id="categoryname'+i+'" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" />');
			var text3 = document.createElement ('input');
			text3.id = "categoryname"+i+"";
			text3.name = "categoryname"+i+"";
			text3.type = "hidden";
			text3.size = "15";
			text3.value = varcategoryname;
			text3.readOnly = "readonly";
			text3.style.backgroundColor = "#FFFFFF";
			text3.style.border = "1px solid #001E6A";
			text3.style.textAlign = "left";
			td3.appendChild (text3);
			tr.appendChild (td3);

			//var td4 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td4 = document.createElement ('td');
			td4.id = "idTD1"+i+"";
			td4.align = "left";
			td4.valign = "top";
			td4.style.backgroundColor = "#FFFFFF";
			td4.style.border = "0px solid #001E6A";
			//var text4 = document.createElement ('<input name="itemname'+i+'" value="'+varitemname+'" size="30" id="itemname'+i+'" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" />');
			var text4 = document.createElement ('input');
			text4.id = "itemname"+i+"";
			text4.name = "itemname"+i+"";
			text4.type = "text";
			text4.size = "30";
			text4.value = varitemname;
			text4.readOnly = "readonly";
			text4.style.backgroundColor = "#FFFFFF";
			text4.style.border = "1px solid #001E6A";
			text4.style.textAlign = "left";
			td4.appendChild (text4);
			tr.appendChild (td4);
			
			//var td5 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td5 = document.createElement ('td');
			td5.id = "idTD1"+i+"";
			td5.align = "left";
			td5.valign = "top";
			td5.style.backgroundColor = "#FFFFFF";
			td5.style.border = "0px solid #001E6A";
			//var text5 = document.createElement ('<input name="unitname'+i+'" value="'+varunitname+'" id="unitname'+i+'" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" />');
			var text5 = document.createElement ('input');
			text5.id = "unitname"+i+"";
			text5.name = "unitname"+i+"";
			text5.type = "text";
			text5.size = "2";
			text5.value = varunitname;
			text5.readOnly = "readonly";
			text5.style.backgroundColor = "#FFFFFF";
			text5.style.border = "1px solid #001E6A";
			text5.style.textAlign = "left";
			td5.appendChild (text5);
			tr.appendChild (td5);
			
			//var td6 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td6 = document.createElement ('td');
			td6.id = "idTD1"+i+"";
			td6.align = "left";
			td6.valign = "top";
			td6.style.backgroundColor = "#FFFFFF";
			td6.style.border = "0px solid #001E6A";
			//var text6 = document.createElement ('<input name="rateperunit'+i+'" value="'+varrateperunit+'" id="rateperunit'+i+'" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="5" />');
			var text6 = document.createElement ('input');
			text6.id = "rateperunit"+i+"";
			text6.name = "rateperunit"+i+"";
			text6.type = "text";
			text6.size = "5";
			text6.value = varrateperunit;
			text6.readOnly = "readonly";
			text6.style.backgroundColor = "#FFFFFF";
			text6.style.border = "1px solid #001E6A";
			text6.style.textAlign = "left";
			td6.appendChild (text6);
			tr.appendChild (td6);
			
			//var td7 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td7 = document.createElement ('td');
			td7.id = "idTD1"+i+"";
			td7.align = "left";
			td7.valign = "top";
			td7.style.backgroundColor = "#FFFFFF";
			td7.style.border = "0px solid #001E6A";
			//var text7 = document.createElement ('<input name="quantity'+i+'" value="'+varquantity+'" id="quantity'+i+'" onBlur="return listingquantityvalidation('+i+')" readonly="readonly" onKeyDown="return disableEnterKey('+i+')" style="border: 1px solid #001E6A; text-align:right" size="2" />');
			var text7 = document.createElement ('input');
			text7.id = "quantity"+i+"";
			text7.name = "quantity"+i+"";
			text7.type = "text";
			text7.size = "2";
			text7.value = varquantity;
			text7.readOnly = "readonly";
			text7.style.backgroundColor = "#FFFFFF";
			text7.style.border = "1px solid #001E6A";
			text7.style.textAlign = "left";
			td7.appendChild (text7);
			tr.appendChild (td7);

			//var td11 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td11 = document.createElement ('td');
			td11.id = "idTD1"+i+"";
			td11.align = "left";
			td11.valign = "top";
			td11.style.backgroundColor = "#FFFFFF";
			td11.style.border = "0px solid #001E6A";
			//var text11 = document.createElement ('<input name="subtotal'+i+'" value="'+varsubtotal+'" id="quantity'+i+'"  onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="8" />');
			var text11 = document.createElement ('input');
			text11.id = "subtotal"+i+"";
			text11.name = "subtotal"+i+"";
			text11.type = "text";
			text11.size = "8";
			text11.value = varsubtotal;
			text11.readOnly = "readonly";
			text11.style.backgroundColor = "#FFFFFF";
			text11.style.border = "1px solid #001E6A";
			text11.style.textAlign = "left";
			td11.appendChild (text11);
			tr.appendChild (td11);

			//var td71 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td71 = document.createElement ('td');
			td71.id = "idTD1"+i+"";
			td71.align = "left";
			td71.valign = "top";
			td71.style.backgroundColor = "#FFFFFF";
			td71.style.border = "0px solid #001E6A";
			//var text71 = document.createElement ('<input name="discountpercent'+i+'" value="'+vardiscountpercent+'" id="discountpercent'+i+'" onKeyDown="return disableEnterKey('+i+')" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />');
			var text71 = document.createElement ('input');
			text71.id = "subtotal"+i+"";
			text71.name = "subtotal"+i+"";
			text71.type = "text";
			text71.size = "8";
			text71.value = varsubtotal;
			text71.readOnly = "readonly";
			text71.style.backgroundColor = "#FFFFFF";
			text71.style.border = "1px solid #001E6A";
			text71.style.textAlign = "left";
			td71.appendChild (text71);
			tr.appendChild (td71);
			
			//var td72 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td72 = document.createElement ('td');
			td72.id = "idTD1"+i+"";
			td72.align = "left";
			td72.valign = "top";
			td72.style.backgroundColor = "#FFFFFF";
			td72.style.border = "0px solid #001E6A";
			//var text72 = document.createElement ('<input name="discountamount'+i+'" value="'+vardiscountamount+'" id="discountamount'+i+'" onKeyDown="return disableEnterKey('+i+')" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />');
			var text72 = document.createElement ('input');
			text72.id = "discountamount"+i+"";
			text72.name = "discountamount"+i+"";
			text72.type = "text";
			text72.size = "2";
			text72.value = vardiscountamount;
			text72.readOnly = "readonly";
			text72.style.backgroundColor = "#FFFFFF";
			text72.style.border = "1px solid #001E6A";
			text72.style.textAlign = "left";
			td72.appendChild (text72);
			tr.appendChild (td72);
			
			//var td9 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td9 = document.createElement ('td');
			td9.id = "idTD1"+i+"";
			td9.align = "left";
			td9.valign = "top";
			td9.style.backgroundColor = "#FFFFFF";
			td9.style.border = "0px solid #001E6A";
			//var text9 = document.createElement ('<input name="taxpercent'+i+'" value="'+vartaxpercent+'" id="taxpercent'+i+'" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />');
			var text9 = document.createElement ('input');
			text9.id = "taxpercent"+i+"";
			text9.name = "taxpercent"+i+"";
			text9.type = "text";
			text9.size = "2";
			text9.value = vartaxpercent;
			text9.readOnly = "readonly";
			text9.style.backgroundColor = "#FFFFFF";
			text9.style.border = "1px solid #001E6A";
			text9.style.textAlign = "left";
			//var text91 = document.createElement ('<input type="hidden" name="taxautonum'+i+'" value="'+vartaxautonum+'" id="taxautonum'+i+'" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />');
			var text91 = document.createElement ('input');
			text91.id = "taxautonum"+i+"";
			text91.name = "taxautonum"+i+"";
			text91.type = "hidden";
			text91.size = "2";
			text91.value = vartaxautonum;
			text91.readOnly = "readonly";
			text91.style.backgroundColor = "#FFFFFF";
			text91.style.border = "1px solid #001E6A";
			text91.style.textAlign = "left";
			td9.appendChild (text9);
			td9.appendChild (text91);
			tr.appendChild (td9);	
			
			//var td8 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td8 = document.createElement ('td');
			td8.id = "idTD1"+i+"";
			td8.align = "left";
			td8.valign = "top";
			td8.style.backgroundColor = "#FFFFFF";
			td8.style.border = "0px solid #001E6A";
			//var text8 = document.createElement ('<input name="totalamount'+i+'" value="'+vartotalamount+'" id="totalamount'+i+'" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" />');
			var text8 = document.createElement ('input');
			text8.id = "totalamount"+i+"";
			text8.name = "totalamount"+i+"";
			text8.type = "text";
			text8.size = "8";
			text8.value = vartotalamount;
			text8.readOnly = "readonly";
			text8.style.backgroundColor = "#FFFFFF";
			text8.style.border = "1px solid #001E6A";
			text8.style.textAlign = "left";
			td8.appendChild (text8);
			tr.appendChild (td8);			
			
			//var td10 = document.createElement ('<TD class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></TD>');
			var td10 = document.createElement ('td');
			td10.id = "idTD1"+i+"";
			td10.align = "left";
			td10.valign = "top";
			td10.style.backgroundColor = "#FFFFFF";
			td10.style.border = "0px solid #001E6A";
			//var text10 = document.createElement ('<input name="btndelete'+i+'" id="btndelete'+i+'" onClick="return btnDeleteClick('+i+')" type="button"  value="Del" class="button" style="border: 1px solid #001E6A"/>');
			var text10 = document.createElement ('input');
			text10.id = "btndelete"+i+"";
			text10.name = "btndelete"+i+"";
			text10.type = "button";
			text10.value = "Del";
			//text10.readOnly = "readonly";
			//text10.style.backgroundColor = "#FFFFFF";
			text10.style.border = "1px solid #001E6A";
			//text10.style.textAlign = "left";
			td10.appendChild (text10);
			tr.appendChild (td10);

			document.getElementById ('foo').appendChild (tr);
			
			// if additional text this tr will be inserted.
			if (varadditionaltext != "")
			{
				var i = parseInt(i);// + 1;
				//var traddtxt = document.createElement ('<TR id="idTRaddtxt'+i+'"></TR>');
				var traddtxt = document.createElement ('TR');
				traddtxt.id = "idTRaddtxt"+i+"";
				
				//var td1addtxt = document.createElement ('<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff">&nbsp;</td>');
				var td1addtxt = document.createElement ('td');
				td1addtxt.id = "idTD1"+i+"";
				td1addtxt.align = "left";
				td1addtxt.valign = "top";
				td1addtxt.style.backgroundColor = "#FFFFFF";
				td1addtxt.style.border = "0px solid #001E6A";
				traddtxt.appendChild (td1addtxt);
				
				//var td2addtxt = document.createElement ('<td class="bodytext31" valign="center" bordercolor="#f3f3f3" align="left" bgcolor="#ffffff"></td>');
				var td2addtxt = document.createElement ('td');
				td2addtxt.id = "idTD1"+i+"";
				td2addtxt.align = "left";
				td2addtxt.valign = "top";
				td2addtxt.style.backgroundColor = "#FFFFFF";
				td2addtxt.style.border = "1px solid #001E6A";
				traddtxt.appendChild (td2addtxt);

				//var td3addtxt = document.createElement ('<td colspan="9" align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31"></td>');
				var td3addtxt = document.createElement ('td');
				td3addtxt.id = "idTD1"+i+"";
				td3addtxt.align = "left";
				td3addtxt.valign = "top";
				td3addtxt.style.backgroundColor = "#FFFFFF";
				td3addtxt.style.border = "0px solid #001E6A";
				//var text3addtxt = document.createElement ('<textarea name="additionaltext'+i+'" cols="75" id="additionaltext'+i+'" style="border: 1px solid #001E6A; text-align:left"></textarea>');
				var text3addtxt = document.createElement ('input');
				text3addtxt.id = "additionaltext"+i+"";
				text3addtxt.name = "additionaltext"+i+"";
				text3addtxt.cols = "75";
				text3addtxt.rows = "3";
				text3addtxt.value = varadditionaltext;
				text3addtxt.readOnly = "readonly";
				text3addtxt.style.backgroundColor = "#FFFFFF";
				text3addtxt.style.border = "1px solid #001E6A";
				text3addtxt.style.textAlign = "left";
				//text3addtxt.setAttribute('value', varadditionaltext);
				td3addtxt.appendChild (text3addtxt);
				traddtxt.appendChild (td3addtxt);

				//var td4addtxt = document.createElement ('<td align="left" valign="center" bordercolor="#f3f3f3" bgcolor="#ffffff" class="bodytext31">&nbsp;</td>');
				var td4addtxt = document.createElement ('td');
				td4addtxt.id = "idTD1"+i+"";
				td4addtxt.align = "left";
				td4addtxt.valign = "top";
				td4addtxt.style.backgroundColor = "#FFFFFF";
				td4addtxt.style.border = "0px solid #001E6A";
				traddtxt.appendChild (td4addtxt);
				
				document.getElementById ('foo').appendChild (traddtxt);
			}



			document.getElementById("itemname").selectedIndex = "";
			document.getElementById("quantity").value = "1";
			document.getElementById("rateperunit").value = "0.00";
			document.getElementById("totalamount").value = "0.00";
			document.getElementById("unitname").value = "";
			document.getElementById("itemcode").value = "";
			document.getElementById("taxpercent").value = "0.00";
			document.getElementById("discountpercent").value = "0.00";
			document.getElementById("additionaltext").value = "";
			document.getElementById("subtotal").value = "0.00";
			
			varLoopCount = varLoopCount + 1;
			document.getElementById('serialnumber').value = i + 1;
			break;		
		}
		else
		{
			if (varitemcode == document.getElementById('itemcode'+i).value)
			{
				alert ("Item / Service Already Selected. Duplicates Are Not Allowed.");
				return false;
			}
			varLoopCount = varLoopCount + 1;
			
		}
		
	}

	funcSubTotalCalc();
	
	document.getElementById('itemname').value = "";
	document.getElementById('service1').value = "";
	//document.getElementById('itemname').options.length=null; 
	//document.getElementById("itemname").add(new Option("Select Item / Service",""));

}


function btnDeleteClick(delID)
{
	var varDeleteID = delID;
	//alert (varDeleteID);
	var child = document.getElementById('idTR'+varDeleteID);  //tr name
    var parent = document.getElementById('foo'); // tbody name.
	document.getElementById ('foo').removeChild(child);

	var child = document.getElementById('idTRaddtxt'+varDeleteID);  //tr name
    var parent = document.getElementById('foo'); // tbody name.
	//alert (child);
	if (child != null) 
	{
		//alert ("Row Exsits.");
		document.getElementById ('foo').removeChild(child);
	}

	funcSubTotalCalc();
}
function subform1()
{
alert("Form Submitiing");
return true;
}

function funcSubTotalCalc()
{

	//alert ("Function Sub Total Calc.");
	//to update subtotal
	var varSubTotalAmountUpdate = 0;
	var varMaxSerialNumber = document.getElementById('serialnumber').value;
	for (k=1;k<1000;k++)
	{
		//if (k != varDeleteID)
		//{
			if (document.getElementById('totalamount'+k) != null) 
			{
				var varTotalAmount2 = document.getElementById('totalamount'+k).value;
				var varTotalAmount2 = varTotalAmount2 * 1;
				if (varTotalAmount2 != "")
				{
					//alert (varTotalAmount2);
					var varSubTotalAmountUpdate = varSubTotalAmountUpdate * 1;
					var varTotalAmount2 = varTotalAmount2 * 1;
					var varSubTotalAmountUpdate = varSubTotalAmountUpdate + varTotalAmount2;
					var varSubTotalAmountUpdate = varSubTotalAmountUpdate.toFixed(2);
					document.getElementById('subtotalamount').value = varSubTotalAmountUpdate;
				}
			}
		//}
	}
	
	var varCheckNoRecords = 0;
	for (m=1;m<=1000;m++)
	{
		if (document.getElementById('totalamount'+m) != null) 
		{
			varCheckNoRecords = varCheckNoRecords + 1;
		}
	}
	//alert (varCheckNoRecords);
	if (varCheckNoRecords == 0)
	{
		document.getElementById('subtotalamount').value = "0.00";
	}
	
	
/*	//if lumpsumamount given, replace subtotalamount with lumpsum amount. and alert
	if (document.getElementById('lumpsum').value != "0.00")
	{
		if (isNaN(document.getElementById("lumpsum").value))
		{
			alert ("Lumpsum Amount Can Only Be Numbers or 0.00");
			document.getElementById("lumpsum").value = "0.00";
			return false;
		}
		else
		{
			document.getElementById('subtotalamount').value = document.getElementById('lumpsum').value
		}
	}
*/	
	
	
/*	//This is required as there are hidden controls with previous version. Do not try to modify. Prem Kumar. 22Jul2011
	
		if (document.getElementById("totaldiscountpercent").value == "")
		{
			alert ("Discount Cannot Be Blank.");
			document.getElementById("totaldiscountpercent").focus();
			document.getElementById("totaldiscountpercent").value = "0.00"
			return false;
		}
		if (document.getElementById("totaldiscountpercent").value == "0")
		{
			//alert ("Quantity Cannot Be Zero. Minimum Shoule Be 1.");
			//document.getElementById("quantity").focus();
			document.getElementById("totaldiscountpercent").value = "0.00"
			//return false;
		}
		if (isNaN(document.getElementById("totaldiscountpercent").value))
		{
			alert ("Discount Can Only Be Numbers.");
			document.getElementById("totaldiscountpercent").focus();
			return false;
		}
		
		if (document.getElementById("totaldiscountamountrupees1").value == "")
		{
			alert ("Discount Amount Cannot Be Blank.");
			document.getElementById("totaldiscountamountrupees1").focus();
			document.getElementById("totaldiscountamountrupees1").value = "0.00"
			return false;
		}
		if (document.getElementById("totaldiscountamountrupees1").value == "0")
		{
			document.getElementById("totaldiscountamountrupees1").value = "0.00"
			//return false;
		}
		if (isNaN(document.getElementById("totaldiscountamountrupees1").value))
		{
			alert ("Discount Amount Can Only Be Numbers.");
			document.getElementById("totaldiscountamountrupees1").focus();
			return false;
		}
		
		if (document.getElementById("totaldiscountpercent").value != "0.00" && document.getElementById("totaldiscountamountrupees1").value != "0.00")
		{
			//alert ("1983");
			alert ("Discount Should Be Either Percentage or Rupees. Both Cannot Be Given. Discount Will Be Reset To Zero.");
			document.getElementById("totaldiscountpercent").value = "0.00"
			document.getElementById("totaldiscountamount").value = "0.00"
			document.getElementById("totaldiscountamountrupees1").value = "0.00"
			document.getElementById("totaldiscountamountrupees2").value = "0.00"
			document.form1.totaldiscountpercent.focus();
			return false;
		}
		
		var varTotalDiscountAmount = "0.00";
		if (document.getElementById("totaldiscountpercent").value != "0.00")
		{
			var varTotalDiscountPercentage = document.getElementById('totaldiscountpercent').value;
			var varTotalDiscountPercentage = varTotalDiscountPercentage * 1;
			var varSubTotalAmount = document.getElementById('subtotalamount').value;
			var varSubTotalAmount = varSubTotalAmount * 1;
			var varTotalDiscountAmount = varSubTotalAmount / 100;
			var varTotalDiscountAmount = varTotalDiscountAmount * varTotalDiscountPercentage;
			var varTotalDiscountAmount = varTotalDiscountAmount.toFixed(2);
			document.getElementById('totaldiscountamount').value = varTotalDiscountAmount;
			
			var varTotalDiscountAmount = document.getElementById('totaldiscountamount').value;
		}
		
		if (varTotalDiscountAmount == "0.00")
		{
			var varTotalDiscountAmount = document.getElementById('totaldiscountamountrupees1').value;
			var varTotalDiscountAmount = varTotalDiscountAmount * 1;
			var varTotalDiscountAmount = varTotalDiscountAmount.toFixed(2);
			document.getElementById('totaldiscountamountrupees2').value = varTotalDiscountAmount;
			
			var varTotalDiscountAmount = document.getElementById('totaldiscountamountrupees2').value;
		}

		
		var varTotalDiscountAmount = varTotalDiscountAmount * 1;
		var varSubTotalAmount = document.getElementById('subtotalamount').value;
		var varSubTotalAmount = varSubTotalAmount * 1;
		var varTotalAfterDiscount = varSubTotalAmount - varTotalDiscountAmount;
		var varTotalAfterDiscount = varTotalAfterDiscount.toFixed(2);
		document.getElementById('totalafterdiscount').value = varTotalAfterDiscount;
		
		var varTotalAfterTax = 0;
		var varTotalAfterTax = varTotalAfterTax * 1;
		var varTotalAfterDiscount = varTotalAfterDiscount * 1;
		var varTotalAfterTax = varTotalAfterTax + varTotalAfterDiscount;
*/	
	
	<?php
		$query5 = "select * from master_tax where status = ''";
		$exec5 = mysql_query($query5) or die ("Error in Query5".mysql_error());
		while ($res5 = mysql_fetch_array($exec5))
		{
		$res5anum = $res5["auto_number"];
		$res5taxname = $res5["taxname"];
		$res5taxpercent = $res5["taxpercent"];
	?>

	//To avoid adding up existing amount, it needs to be reset to zero.
	document.getElementById('totaltaxamount<?php echo $res5anum; ?>').value = "0.00";	
	
	//alert (document.getElementById('taxpercent1').value);
	//alert (document.getElementById('taxpercent2').value);
	//alert (document.getElementById('taxpercent3').value);
	
	for (z=1;z<=100;z++)
	{
		
		if (document.getElementById('taxpercent'+z) != null) 
		{
			//alert ('<?php echo $res5taxname; ?>');
			//alert (z);
			var varTaxPercentageTextBox = document.getElementById('taxpercent'+z).value;
			//alert (varTaxPercentageTextBox);
			var varTaxPercentage = <?php echo $res5taxpercent; ?>;
			//alert (varTaxPercentage);
			
			var varTaxPercentage = varTaxPercentage * 1;
			//alert ("Text Box "+varTaxPercentageTextBox);
			var varTaxPercentageTextBox = varTaxPercentageTextBox * 1;
			//alert ("D B "+varTaxPercentage);

			if (varTaxPercentage == varTaxPercentageTextBox)
			{
				//alert (z);
				//alert ('Inside <?php echo $res5taxname; ?>');
				//alert (varTaxPercentage);
				//alert (varTaxPercentageTextBox);
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
				
				//var varTotalAfterTax = varTotalAfterTax * 1;
				//var varTaxTotalAmount = varTaxTotalAmount * 1;
				//var varTotalAfterTax = varTotalAfterTax + varTaxTotalAmount;
			}
		}
	}
	
	<?php
	
	//to calculate sub taxes if any.
	$query6 = "select * from master_taxsub where taxparentanum = '$res5anum' and status = ''";
	$exec6 = mysql_query($query6) or die ("Error in Query6".mysql_error());
	while ($res6 = mysql_fetch_array($exec6))
	{
		$tslct = $tslct + 1;
		$res6anum = $res6["auto_number"];
		$res6taxsubname = $res6["taxsubname"];
		$res6taxsubpercent = $res6["taxsubpercent"];
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
	//alert (varNetTotalMainTax2);
	//alert (varNetTotalSubTax2);
	
	var varNetTotalMainTax2 = varNetTotalMainTax2 * 1;
	var varNetTotalSubTax2 = varNetTotalSubTax2 * 1;
	var varNetTotalTaxAmount = 0;
	var varNetTotalTaxAmount = varNetTotalMainTax2 + varNetTotalSubTax2;
	//alert (varNetTotalTaxAmount);
	
/*	var varTotalDiscountAmount = varTotalDiscountAmount * 1;
	var varSubTotalAmount = document.getElementById('subtotalamount').value;
	var varSubTotalAmount = varSubTotalAmount * 1;
	var varTotalAfterDiscount = varSubTotalAmount - varTotalDiscountAmount;
	var varTotalAfterDiscount = varTotalAfterDiscount.toFixed(2);
	document.getElementById('totalafterdiscount').value = varTotalAfterDiscount;
*/	
	
	
	var varSubTotalAmount1 = 0;
	var varSubTotalAmount1 = varSubTotalAmount1 * 1;
	var varSubTotalAmount1 = document.getElementById('subtotalamount').value;
	var varSubTotalAmount1 = varSubTotalAmount1 * 1;
	
	var varTotalAfterTax = 0;
	var varTotalAfterTax = varTotalAfterTax * 1;
	var varTotalAfterTax = varNetTotalTaxAmount + varSubTotalAmount1;

	var varTotalAfterTax = varTotalAfterTax.toFixed(2);
	//alert (varTotalAfterTax);
	document.getElementById('totalaftertax').value = varTotalAfterTax;

	//var varTotalAfterTax = varTotalAfterTax.toFixed(2);
	//document.getElementById('totalaftertax').value = varTotalAfterTax;

	if (document.getElementById('transportation').value == "")
	{
		document.getElementById('transportation').value = "0.00";
	}
	else if (isNaN(document.getElementById('transportation').value))
	{
		alert ("Transportation / Packing / Forwarding Can Only Be Numbers.");
		document.getElementById('transportation').value == "0.00";
	}
	var varTransportation = document.getElementById('transportation').value;
	var varTransportation = varTransportation * 1;
	var varTransportation = varTransportation.toFixed(2);
	document.getElementById('transportation').value = varTransportation;
	var varTransportation = varTransportation * 1;
	var varTotalAfterTax = varTotalAfterTax * 1;
	//var varTaxTotalAmount = varTaxTotalAmount * 1;
	//var varNetAmount = varSubTotalAmount + varTaxTotalAmount + varTransportation;
	var varNetAmount = varTotalAfterTax + varTransportation;
	var varNetAmount = varNetAmount * 1;
	var varNetAmount = varNetAmount.toFixed(2);
	

	if (document.getElementById('packaging').value == "")
	{
		document.getElementById('packaging').value = "0.00";
	}
	else if (isNaN(document.getElementById('packaging').value))
	{
		alert ("Transportation / Packing / Forwarding Can Only Be Numbers.");
		document.getElementById('packaging').value == "0.00";
	}
	var varPackaging = document.getElementById('packaging').value;
	var varPackaging = varPackaging * 1;
	var varPackaging = varPackaging.toFixed(2);
	document.getElementById('packaging').value = varPackaging;
	var varPackaging = varPackaging * 1;
	var varNetAmount = varNetAmount * 1;
	//var varTaxTotalAmount = varTaxTotalAmount * 1;
	//var varNetAmount = varSubTotalAmount + varTaxTotalAmount + varPackaging;
	var varNetAmount2 = varNetAmount + varPackaging;
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmoun2t = varNetAmount2.toFixed(2);

	var varNetAmountBeforeRoundOff = varNetAmount2;


/*	//to round off to nearest ten paise.
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(1);
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	document.getElementById('netamount').value = varNetAmount2;
*/	
	
	//to round off to nearest rupee.
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(0);
	var varNetAmount2 = varNetAmount2 * 1;
	var varNetAmount2 = varNetAmount2.toFixed(2);
	document.getElementById('netamount').value = varNetAmount2;
	
	//to print round off amount
	var varRoundOff1 = 0;
	var varRoundOff1 = varRoundOff1 * 1;
	var varRoundOff1 = varNetAmount2 - varNetAmountBeforeRoundOff;
	var varRoundOff1 = varRoundOff1.toFixed(2);
	
	document.getElementById('roundoff').value = varRoundOff1;
	document.getElementById('netamount').value = varNetAmount2;
	

}

function itemcodeentry2()
{
	var key;
	if(window.event)
	{
		key = window.event.keyCode;     //IE
	}
	else
	{
		key = e.which;     //firefox
	}
	
	if(key == 13) // if enter key press
	{
		//alert ("Enter Key Press2");
		itemcodeentry1();
		return false;
	}
	else
	{
		return true;
	}
}




</script>