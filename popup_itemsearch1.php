<?php
session_start();
//include ("includes/loginverify.php");
include ("db/db_connect.php");

if (isset($_REQUEST["callfrom"])) { $callfrom = $_REQUEST["callfrom"]; } else { $callfrom = ""; }
//$callfrom = $_REQUEST[callfrom];

?>
<?php include ("includes/pagetitle1.php"); ?>
<style type="text/css">
<!--
.bodytext3 {FONT-WEIGHT: normal; FONT-SIZE: 11px; COLOR: #3B3B3C; FONT-FAMILY: Tahoma
}
-->
</style>
<script type="text/javascript" src="js/autoitemsearch1.js"></script>
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
	//alert (key);
	
	//alert(event.keyCode);
	
	//if(event.keyCode=='27'){alert('you pressed escape');}
	
	//if(event.keyCode=='27'){ window.close(); }
	if(key == '27'){ window.close(); }
	
	//if(event.keyCode=='38'){ alert("Up Arrow Key Press."); }
	//if(event.keyCode=='40'){ alert("Down Arrow Key Press."); }	
	//alert ("Func Call From Escape Key");
	var varDownKeyCount = 0;

	//if(event.keyCode=='40') //down arrow key press
	if(key == 40) 
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
				document.getElementById("itemcode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("itemname"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("itemmrp"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("taxname"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("dummycontrol"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("dummycontro2"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("taxpercent"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
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
				document.getElementById("itemcode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("itemname"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("itemmrp"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("taxname"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("dummycontrol"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("dummycontro2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("taxpercent"+varUpdateRow).style.backgroundColor="#99FF00";
				//alert (document.activeElement.name);
				
			}
			
		}
		else
		{
			//alert ("Down Arrow Press");
			document.getElementById("itemsearch").focus();
			document.getElementById("serialnumber1").focus();
			document.getElementById("idTD11").style.backgroundColor="#99FF00";
			document.getElementById("idTD21").style.backgroundColor="#99FF00";
			document.getElementById("idTD31").style.backgroundColor="#99FF00";
			document.getElementById("serialnumber1").style.backgroundColor="#99FF00";
			document.getElementById("itemcode1").style.backgroundColor="#99FF00";
			document.getElementById("itemname1").style.backgroundColor="#99FF00";
			document.getElementById("itemmrp1").style.backgroundColor="#99FF00";
			document.getElementById("taxname1").style.backgroundColor="#99FF00";
			document.getElementById("dummycontrol1").style.backgroundColor="#99FF00";
			document.getElementById("dummycontro21").style.backgroundColor="#99FF00";
			document.getElementById("taxpercent1").style.backgroundColor="#99FF00";
			
		}
		//alert (document.activeElement.name);
	
		return false;
	}
		
		
	//if(event.keyCode=='38') //up arrow key press
	if(key == 38) 
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
				document.getElementById("itemcode"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("itemname"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("itemmrp"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("taxname"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("dummycontrol"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("dummycontro2"+varUpdateRow).style.backgroundColor="#FFFFFF";
				document.getElementById("taxpercent"+varUpdateRow).style.backgroundColor="#FFFFFF";
				
				var varUpdateRow = varSerialNumber - 1;
				//alert (varUpdateRow);
				if (document.getElementById("serialnumber"+varUpdateRow) == null) //to avoid no existing element error.
				{
					document.getElementById("itemsearch").focus(); //to show the search text box. or it will hide.
					return false;
				}
				document.getElementById("serialnumber"+varUpdateRow).focus();
				document.getElementById("idTD1"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("idTD3"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("serialnumber"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("itemcode"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("itemname"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("itemmrp"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("taxname"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("dummycontrol"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("dummycontro2"+varUpdateRow).style.backgroundColor="#99FF00";
				document.getElementById("taxpercent"+varUpdateRow).style.backgroundColor="#99FF00";
				//alert (document.activeElement.name);

			}
			
		}
		else
		{
			document.getElementById("Submit2").focus();
			document.getElementById("serialnumber1").focus();
			document.getElementById("idTD11").style.backgroundColor="#99FF00";
			document.getElementById("idTD21").style.backgroundColor="#99FF00";
			document.getElementById("idTD31").style.backgroundColor="#99FF00";
			document.getElementById("serialnumber1").style.backgroundColor="#99FF00";
			document.getElementById("itemcode1").style.backgroundColor="#99FF00";
			document.getElementById("itemname1").style.backgroundColor="#99FF00";
			document.getElementById("itemmrp1").style.backgroundColor="#99FF00";
			document.getElementById("taxname1").style.backgroundColor="#99FF00";
			document.getElementById("dummycontrol1").style.backgroundColor="#99FF00";
			document.getElementById("dummycontro21").style.backgroundColor="#99FF00";
			document.getElementById("taxpercent1").style.backgroundColor="#99FF00";

		}

		//alert (document.activeElement.name);
		return false;
	}
	
	//if (event.keyCode=='13')
	if(key == 13) 
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
			var varItemCodeCatch =  document.getElementById("itemcode"+varActiveElementNumber).value;
			//alert (varItemCodeCatch);
			var varItemNameCatch =  document.getElementById("itemname"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			var varItemMRPCatch =  document.getElementById("itemmrp"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			var varItemTaxNameCatch =  document.getElementById("taxname"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			var varItemTaxPercentCatch =  document.getElementById("taxpercent"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			var varItemTaxAnumCatch =  document.getElementById("taxautonumber"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			var varItemDescriptionCatch =  document.getElementById("itemdescription"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			
			window.opener.document.getElementById("itemcode").value = "";
			window.opener.document.getElementById("itemname").value = "";
			window.opener.document.getElementById("itemcode").value = varItemCodeCatch;
			window.opener.document.getElementById("itemname").value = varItemNameCatch;
			window.opener.document.getElementById("itemmrp").value = varItemMRPCatch;
			window.opener.document.getElementById("itemtaxpercent").value = varItemTaxPercentCatch;
			window.opener.document.getElementById("itemtaxname").value = varItemTaxNameCatch;
			window.opener.document.getElementById("itemtaxautonumber").value = varItemTaxAnumCatch;
			window.opener.document.getElementById("itemdescription").value = varItemDescriptionCatch;
			window.opener.document.getElementById("itemquantity").focus();
			window.opener.document.getElementById("itemquantity").select();
			
			<?php
			}
			else if ($callfrom == 'searchitem1')
			{
			?>
			var varItemCodeCatch =  document.getElementById("itemcode"+varActiveElementNumber).value;
			//alert (varItemCodeCatch);
			var varItemNameCatch =  document.getElementById("itemname"+varActiveElementNumber).value;
			//alert (varItemNameCatch);
			
			window.opener.document.getElementById("itemcode").value = "";
			window.opener.document.getElementById("itemname").value = "";
			window.opener.document.getElementById("itemcode").value = varItemCodeCatch;
			window.opener.document.getElementById("itemname").value = varItemNameCatch;
			
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
	document.getElementById("itemsearch").focus();
}

function getitem1()
{
	//alert ("GetItem1");
	itemsearch1();
}

function downkeycount1()
{
}


</script>
<body onLoad="bodyonload1()" onkeydown="escapekeypressed(event)">
<table width="100%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#666666" id="AutoNumber3" style="border-collapse: collapse">
    <tbody>
      <tr bgcolor="#011E6A">
        <td colspan="2" bgcolor="#CCCCCC" class="bodytext3"><strong>Search Item </strong></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">
		<input name="itemsearch" id="itemsearch" accesskey="s" onKeyUp="return getitem1()" type="text" size="50" value="<?php //echo $itemsearch; ?>" />
        <input type="submit" name="Submit2" value="Alt+S" onClick="javascript:document.getElementById('itemsearch').focus();" style="border: 1px solid #001E6A" /></td>
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
      <td width="20%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Item Code </strong></td>
      <td width="74%" align="left" valign="top"  bgcolor="#CCCCCC" class="bodytext3"><strong>Item Name </strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"  bgcolor="#FFFFFF" class="bodytext3">&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
      <td align="left" valign="top" >&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
