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
<script type="text/javascript" src="js/autosuppliercodesearch1.js"></script>
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
				document.getElementById("suppliercode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("suppliername"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplieraddress1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplierarea"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("suppliercity"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplierpincode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
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
				document.getElementById("suppliercode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("suppliername"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplieraddress1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplierarea"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("suppliercity"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplierpincode"+varUpdateRow).style.backgroundColor="#99FF00";
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
			document.getElementById("suppliercode1").style.backgroundColor="#99FF00";
			document.getElementById("suppliername1").style.backgroundColor="#99FF00";
			document.getElementById("supplieraddress11").style.backgroundColor="#99FF00";
			document.getElementById("supplierarea1").style.backgroundColor="#99FF00";
			document.getElementById("suppliercity1").style.backgroundColor="#99FF00";
			document.getElementById("supplierpincode1").style.backgroundColor="#99FF00";
			
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
				document.getElementById("suppliercode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("suppliername"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplieraddress1"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplierarea"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("suppliercity"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("supplierpincode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
				var varUpdateRow = varSerialNumber - 1;
				//alert (varUpdateRow);
				if (document.getElementById("serialnumber"+varUpdateRow) == null) //to avoid no existing element error.
				{
					document.getElementById("suppliersearch").focus(); //to show the search text box. or it will hide.
					return false;
				}
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("suppliercode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("suppliername"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplieraddress1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplierarea"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("suppliercity"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("supplierpincode"+varUpdateRow).style.backgroundColor="#99FF00";
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
			document.getElementById("suppliercode1").style.backgroundColor="#99FF00";
			document.getElementById("suppliername1").style.backgroundColor="#99FF00";
			document.getElementById("supplieraddress11").style.backgroundColor="#99FF00";
			document.getElementById("supplierarea1").style.backgroundColor="#99FF00";
			document.getElementById("suppliercity1").style.backgroundColor="#99FF00";
			document.getElementById("supplierpincode1").style.backgroundColor="#99FF00";

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
			if ($callfrom == 'purchase')
			{
			?>
			
			var varSupplierCodeCatch =  document.getElementById("suppliercode"+varActiveElementNumber).value;
			//alert (varSupplierCodeCatch);
			var varSupplierNameCatch =  document.getElementById("suppliername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varSupplierAddress1Catch =  document.getElementById("supplieraddress1"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varSupplierAreaCatch =  document.getElementById("supplierarea"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varSupplierCityCatch =  document.getElementById("suppliercity"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varSupplierPincodeCatch =  document.getElementById("supplierpincode"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varvarSupplierTINCatch =  document.getElementById("suppliertin"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			var varvarSupplierCSTCatch =  document.getElementById("suppliercst"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("suppliercode").value = "";
			window.opener.document.getElementById("supplier").value = "";
			window.opener.document.getElementById("suppliercode").value = varSupplierCodeCatch;
			window.opener.document.getElementById("supplier").value = varSupplierNameCatch;
			window.opener.document.getElementById("address1").value = varSupplierAddress1Catch;
			window.opener.document.getElementById("area").value = varSupplierAreaCatch;
			window.opener.document.getElementById("city1").value = varSupplierCityCatch;
			window.opener.document.getElementById("pincode").value = varSupplierPincodeCatch;
			window.opener.document.getElementById("suppliertin").value = varvarSupplierTINCatch;
			window.opener.document.getElementById("suppliercst").value = varvarSupplierCSTCatch;
			window.opener.document.getElementById("itemcode").focus();
			<?php
			}
			else if ($callfrom == 'purchasereport')
			{
			?>
			
			var varSupplierCodeCatch =  document.getElementById("suppliercode"+varActiveElementNumber).value;
			//alert (varSupplierCodeCatch);
			var varSupplierNameCatch =  document.getElementById("suppliername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("suppliercode").value = "";
			window.opener.document.getElementById("supplier").value = "";
			window.opener.document.getElementById("suppliercode").value = varSupplierCodeCatch;
			window.opener.document.getElementById("supplier").value = varSupplierNameCatch;

			<?php
			}
			else if ($callfrom == 'transactionsupplier1')
			{
			?>
			var varSupplierCodeCatch =  document.getElementById("suppliercode"+varActiveElementNumber).value;
			//alert (varCosupplierCodeCatch);
			var varSupplierNameCatch =  document.getElementById("suppliername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("suppliercode").value = "";
			window.opener.document.getElementById("supplier").value = "";
			window.opener.document.getElementById("suppliercode").value = varSupplierCodeCatch;
			window.opener.document.getElementById("supplier").value = varSupplierNameCatch;
			window.opener.document.getElementById("supplierpendingamount").focus();
			<?php
			}
			else if ($callfrom == 'searchsupplier1')
			{
			?>
			var varSupplierCodeCatch =  document.getElementById("suppliercode"+varActiveElementNumber).value;
			//alert (varCosupplierCodeCatch);
			var varSupplierNameCatch =  document.getElementById("suppliername"+varActiveElementNumber).value;
			//alert (varSupplierNameCatch);
			
			window.opener.document.getElementById("suppliercode").value = "";
			window.opener.document.getElementById("supplier").value = "";
			window.opener.document.getElementById("suppliercode").value = varSupplierCodeCatch;
			window.opener.document.getElementById("supplier").value = varSupplierNameCatch;
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
	document.getElementById("suppliersearch").focus();
}

function getsupplier1()
{
	//alert ("GetSupplier1");
	suppliersearch1();
}

function downkeycount1()
{
}


</script>

<body onLoad="bodyonload1()" onkeydown="escapekeypressed(event)">
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
    <tbody>
      <tr bgcolor="#011E6A">
        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Search Supplier </strong></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		<input name="suppliersearch" id="suppliersearch" accesskey="s" onKeyUp="return getsupplier1()" type="text" size="50" value="<?php //echo $suppliersearch; ?>" />
        <input type="submit" name="Submit2" value="Alt+S" onClick="javascript:document.getElementById('suppliersearch').focus();" style="border: 1px solid #001E6A" /></td>
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
      <td width="20%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Supplier Code </strong></td>
      <td width="74%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Supplier Name </strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
