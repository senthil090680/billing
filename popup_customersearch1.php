<?php
session_start();
//include ("includes/loginverify.php");
include ("db/db_connect.php");

if (isset($_REQUEST["callfrom"])) { $callfrom = $_REQUEST["callfrom"]; } else { $callfrom = ""; }
//$callfrom = $_REQUEST[callfrom];

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
-->
</style>
<script type="text/javascript" src="js/autocustomercodesearch1.js"></script>
<script language="javascript">

function captureEscapeKey1()
{
	//alert ("Back Key Press");
	if (event.keyCode==8) 
	{
		//alert ("Escape Key Press.");
		//event.keyCode=0; 
		//return event.keyCode 
		//return false;
	}
}

function escapekeypressed(e)
{

	evt = e || window.event; 
	key = evt.keyCode;
	//alert(event.keyCode);
	
	//if(event.keyCode=='27'){alert('you pressed escape');}
	//if(event.keyCode=='27'){ window.close(); } //Working only in IE and Chrome
	if(key == '27'){ window.close(); }
	//if(event.keyCode=='38'){ alert("Up Arrow Key Press."); }
	//if(event.keyCode=='40'){ alert("Down Arrow Key Press."); }	
	//alert ("Func Call From Escape Key");
	var varDownKeyCount = 0;

	//if(event.keyCode=='40') //down arrow key press //Working only in IE and Chrome
	if(key == '40') 
	{ 
		//alert("Down Arrow Key Press."); 
		//alert (document.activeElement.name);
		var varActiveElementName = document.activeElement.name;
		//alert (varActiveElementName);
		var varSubString = varActiveElementName.substring(0,12);
		//alert (varSubString);
		
		if (varSubString == "serialnumber") //focus is already on serial number.
		{
			//document.getElementById("Submit2").focus();
			var varSerialNumber = varActiveElementName.substring(12,20);
			var varSerialNumber = parseInt(varSerialNumber);
			//alert (varSerialNumber);
			if (varSerialNumber >= 1)
			{
				var varUpdateRow = varSerialNumber; 
				//alert (varUpdateRow);
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customercode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customername"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customeraddress1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customerarea"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customercity"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customerpincode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
				var varUpdateRow = varSerialNumber + 1;
				//alert (varUpdateRow);
				if (document.getElementById("serialnumber"+varUpdateRow) == null)//to avoid no existing element error.
				{
					return false;
				}
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customercode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customername"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customeraddress1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customerarea"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customercity"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customerpincode"+varUpdateRow).style.backgroundColor="#99FF00";
				//alert (document.activeElement.name);
				
			}
			
		}
		else
		{
			//document.getElementById("Submit2").focus();
			document.getElementById("serialnumber1").focus();
			document.getElementById("idTD11").style.backgroundColor="#99FF00";
			document.getElementById("idTD21").style.backgroundColor="#99FF00";
			document.getElementById("idTD31").style.backgroundColor="#99FF00";
			document.getElementById("serialnumber1").style.backgroundColor="#99FF00";
			document.getElementById("customercode1").style.backgroundColor="#99FF00";
			document.getElementById("customername1").style.backgroundColor="#99FF00";
			document.getElementById("customeraddress11").style.backgroundColor="#99FF00";
			document.getElementById("customerarea1").style.backgroundColor="#99FF00";
			document.getElementById("customercity1").style.backgroundColor="#99FF00";
			document.getElementById("customerpincode1").style.backgroundColor="#99FF00";
			
		}
		//alert (document.activeElement.name);
	
	return false;
	}
		
		
	//if(event.keyCode=='38') //up arrow key press //Working only in IE and Chrome.
	if(key == '38') //up arrow key press
	{ 
		//alert("Down Arrow Key Press."); 
		//alert (document.activeElement.name);
		var varActiveElementName = document.activeElement.name;
		//alert (varActiveElementName);
		var varSubString = varActiveElementName.substring(0,12);
		//alert (varSubString);
		
		if (varSubString == "serialnumber") //focus is already on serial number.
		{
			//document.getElementById("Submit2").focus();
			var varSerialNumber = varActiveElementName.substring(12,20);
			var varSerialNumber = parseInt(varSerialNumber);
			//alert (varSerialNumber);
			if (varSerialNumber >= 1)
			{
				var varUpdateRow = varSerialNumber; 
				//alert (varUpdateRow);
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customercode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customername"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customeraddress1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customerarea"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customercity"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("customerpincode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
				var varUpdateRow = varSerialNumber - 1;
				//alert (varUpdateRow);
				if (document.getElementById("serialnumber"+varUpdateRow) == null) //to avoid no existing element error.
				{
					document.getElementById("customersearch").focus(); //to show the search text box. or it will hide.
					return false;
				}
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customercode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customername"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customeraddress1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customerarea"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customercity"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("customerpincode"+varUpdateRow).style.backgroundColor="#99FF00";
				//alert (document.activeElement.name);

			}
			
		}
		else
		{
			//document.getElementById("Submit2").focus();
			document.getElementById("serialnumber1").focus();
			document.getElementById("idTD11").style.backgroundColor="#99FF00";
			document.getElementById("idTD21").style.backgroundColor="#99FF00";
			document.getElementById("idTD31").style.backgroundColor="#99FF00";
			document.getElementById("serialnumber1").style.backgroundColor="#99FF00";
			document.getElementById("customercode1").style.backgroundColor="#99FF00";
			document.getElementById("customername1").style.backgroundColor="#99FF00";
			document.getElementById("customeraddress11").style.backgroundColor="#99FF00";
			document.getElementById("customerarea1").style.backgroundColor="#99FF00";
			document.getElementById("customercity1").style.backgroundColor="#99FF00";
			document.getElementById("customerpincode1").style.backgroundColor="#99FF00";

		}

		//alert (document.activeElement.name);
		return false;
	}
	
	//if (event.keyCode=='13') //Working only in IE and Chrome
	if(key == '13') //up arrow key press
	{
		//alert ("Enter Key Press.");
		//alert (document.activeElement.name);
		var varActiveElementName = document.activeElement.name;
		var varActiveElementNumber = varActiveElementName.substring(12,20);
		var varActiveElementNumber = parseInt(varActiveElementNumber);
		//alert (varActiveElementNumber);
		if (!isNaN(varActiveElementNumber)) //to prevent losing focus to submit2.
		{
			
			<?php
			//To catch and pass values to the respective parent forms.
			if ($callfrom == 'sales')
			{
			?>
			
			var varCustomerCodeCatch =  document.getElementById("customercode"+varActiveElementNumber).value;
			//alert (varCustomerCodeCatch);
			var varCustomerNameCatch =  document.getElementById("customername"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varCustomerAddress1Catch =  document.getElementById("customeraddress1"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varCustomerAreaCatch =  document.getElementById("customerarea"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varCustomerCityCatch =  document.getElementById("customercity"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varCustomerPincodeCatch =  document.getElementById("customerpincode"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varvarCustomerTINCatch =  document.getElementById("customertin"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			var varvarCustomerCSTCatch =  document.getElementById("customercst"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			
			window.opener.document.getElementById("customercode").value = "";
			window.opener.document.getElementById("customer").value = "";
			window.opener.document.getElementById("customercode").value = varCustomerCodeCatch;
			window.opener.document.getElementById("customer").value = varCustomerNameCatch;
			window.opener.document.getElementById("address1").value = varCustomerAddress1Catch;
			window.opener.document.getElementById("area").value = varCustomerAreaCatch;
			window.opener.document.getElementById("city1").value = varCustomerCityCatch;
			window.opener.document.getElementById("pincode").value = varCustomerPincodeCatch;
			window.opener.document.getElementById("customertin").value = varvarCustomerTINCatch;
			window.opener.document.getElementById("customercst").value = varvarCustomerCSTCatch;
			window.opener.document.getElementById("itemcode").focus();
			<?php
			}
			else if ($callfrom == 'salesreport')
			{
			?>
			
			var varCustomerCodeCatch =  document.getElementById("customercode"+varActiveElementNumber).value;
			//alert (varCustomerCodeCatch);
			var varCustomerNameCatch =  document.getElementById("customername"+varActiveElementNumber).value;
			//alert (varCustomerNameCatch);
			
			window.opener.document.getElementById("customercode").value = "";
			window.opener.document.getElementById("customer").value = "";
			window.opener.document.getElementById("customercode").value = varCustomerCodeCatch;
			window.opener.document.getElementById("customer").value = varCustomerNameCatch;

			<?php
			}
			else if ($callfrom == 'transactioncustomer1')
			{
			?>
			var varSupplierCodeCatch =  document.getElementById("customercode"+varActiveElementNumber).value;
			//alert (varCosupplierCodeCatch);
			var varSupplierNameCatch =  document.getElementById("customername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("customercode").value = "";
			window.opener.document.getElementById("customer").value = "";
			window.opener.document.getElementById("customercode").value = varSupplierCodeCatch;
			window.opener.document.getElementById("customer").value = varSupplierNameCatch;
			window.opener.document.getElementById("customerpendingamount").focus();
			<?php
			}
			else if ($callfrom == 'searchcustomer1')
			{
			?>
			var varCustomerCodeCatch =  document.getElementById("customercode"+varActiveElementNumber).value;
			//alert (varCosupplierCodeCatch);
			var varCustomerNameCatch =  document.getElementById("customername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("customercode").value = "";
			window.opener.document.getElementById("customer").value = "";
			window.opener.document.getElementById("customercode").value = varCustomerCodeCatch;
			window.opener.document.getElementById("customer").value = varCustomerNameCatch;
			<?php
			}
			?>
			window.close();
		}
		
	}

	return false;
}


function bodyonload1()
{
	document.body.focus();
	document.getElementById("customersearch").focus();
}

function getcustomer1()
{
	//alert ("GetCustomer1");
	customersearch1();
}

function downkeycount1()
{
}


</script>

<body onLoad="bodyonload1()" onkeydown="escapekeypressed(event)">
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
    <tbody>
      <tr bgcolor="#011E6A">
        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Search Customer </strong></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		<input name="customersearch" id="customersearch" accesskey="s" onKeyUp="return getcustomer1()" type="text" size="50" value="<?php //echo $customersearch; ?>" />
        <input type="submit" name="Submit2" value="Alt+S" onClick="javascript:document.getElementById('customersearch').focus();" style="border: 1px solid #001E6A" /></td>
      </tr>
    </tbody>
</table>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
  <tbody id="tblrowinsert">
    <tr bgcolor="#011E6A">
      <td colspan="3" bgcolor="#CCCCCC" class="bodytext3"><strong>Press Down &amp; Up Arrow To Scroll. Press Space Bar To Select. </strong></td>
    </tr>
    <tr>
      <td width="6%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>S.No.</strong></td>
      <td width="20%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Customer Code </strong></td>
      <td width="74%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Customer Name </strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
