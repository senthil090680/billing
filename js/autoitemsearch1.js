// JavaScript Document
//function to call ajax process
function itemsearch1()
{
	

	//to get number of rows in the table before deleting.
	for(var j = document.getElementById("tblrowinsert").rows.length; j > 0;j--)
	{
		document.getElementById("tblrowinsert").deleteRow(j -1);
	}

	
	//alert("Meow...");
	if(document.getElementById("itemsearch").value!="")
	{
		var varItemSearch = document.getElementById("itemsearch").value;
		//alert (varItemSearch);
		var varItemSearchLen = varItemSearch.length;
		//alert (varItemSearchLen);
		//if (varItemSearchLen > 3)
		if (varItemSearchLen > 0)
		{
			ajaxprocess();		
		}
		
		//alert("Meow...");
		//ajaxprocess();		
		//var url = "";
	}
}

var xmlHttp

function ajaxprocess()
{
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
  
  	var itemsearch=document.getElementById("itemsearch").value;
	//alert(itemcode);
	var url = "";
	var url="autoitemsearch1.php?RandomKey="+Math.random()+"&&itemsearch="+itemsearch;
    //alert(url);

	xmlHttp.onreadystatechange=stateChanged 
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
} 

function stateChanged() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
	//document.form4.to1.options.clear;
	//document.getElementById("itemname").innerHTML="";
	//document.getElementById("itemsearch").value="";
	
	//var t="$";
	var t = "";
	t=t+xmlHttp.responseText;
	//alert(t);
	
	//document.getElementById("price").innerHTML=t;
	var varCompleteStringReturned=t;
	//alert (varCompleteStringReturned);
	var varNewLineValue=varCompleteStringReturned.split("||^||");
	//alert(varNewLineValue);
	//alert(varNewLineValue.length);
	var varNewLineLength = varNewLineValue.length;
	//alert(varNewLineLength);
	varNewLineLength = varNewLineLength - 1;
	//alert(varNewLineLength);
	if (varNewLineLength == 0)
	{
		//return false;
	}
	
	for (m=0;m<=varNewLineLength;m++)
	{
		//alert (m);
		var varNewRecordValue=varNewLineValue[m].split("||");
		//alert(varNewRecordValue);
		//alert(varNewRecordValue.length);
		var varNewRecordLength = varNewRecordValue.length;
		//alert(varNewRecordLength);
		varNewRecordLength = varNewRecordLength - 4;
		//alert(varNewRecordLength);
		
		var k = 0;
		for (i=0;i<varNewRecordLength;i++)
		{
			var varItemCode1 = varNewRecordValue[0];
			//alert (varItemCode1);
			var varItemName1 = varNewRecordValue[1];
			//alert (varItemName1);
			var varItemMRP = varNewRecordValue[2];
			var varItemMRP = parseFloat(varItemMRP).toFixed(2);
			//alert (varItemName1);
			var varTaxName = varNewRecordValue[3];
			//alert (varItemName1);
			var varTaxPercent = varNewRecordValue[4];
			//alert (varItemName1);
			var varTaxAnum = varNewRecordValue[5];
			//alert (varTaxAnum);
			var varItemDescription1 = varNewRecordValue[6];
			//var varSupplierPrice1 = parseFloat(varSupplierPrice1).toFixed(2);
			//alert (varItemName1);
		}
			
			var m = parseInt(m);
			var k = m + 1;
			var k = parseInt(k);
			//alert (k);
			//var tr = document.createElement ('<TR id="idTR'+k+'"></TR>');
			var tr = document.createElement ('TR');
			tr.id = "idTR"+k+"";

			//var td1 = document.createElement ('<td id="idTD1'+k+'" align="left" valign="top" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"></td>');
			var td1 = document.createElement ('td');
			td1.id = "idTD1"+k+"";
			td1.align = "left";
			td1.valign = "top";
			td1.style.backgroundColor = "#FFFFFF";
			td1.style.border = "0px solid #F3F3F3";
			//var text1 = document.createElement ('<input value="'+k+'" name="serialnumber'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="1">');
			var text1 = document.createElement ('input');
			text1.id = "serialnumber"+k+"";
			text1.name = "serialnumber"+k+"";
			text1.type = "text";
			text1.size = "1";
			text1.value = k;
			text1.readOnly = "readonly";
			text1.style.backgroundColor = "#FFFFFF";
			text1.style.border = "0px solid #001E6A";
			text1.style.textAlign = "right";
			text1.style.fontSize = "12";
			td1.appendChild (text1);
			tr.appendChild (td1);

			//var td2 = document.createElement ('<td id="idTD2'+k+'" align="left" valign="top" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"></td>');
			var td2 = document.createElement ('td');
			td2.id = "idTD2"+k+"";
			td2.align = "left";
			td2.valign = "top";
			td2.style.backgroundColor = "#FFFFFF";
			td2.style.border = "0px solid #F3F3F3";
			//var text2 = document.createElement ('<input value="'+varItemCode1+'" name="itemcode'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="5">');
			var text2 = document.createElement ('input');
			text2.id = "itemcode"+k+"";
			text2.name = "itemcode"+k+"";
			text2.type = "text";
			text2.size = "5";
			text2.value = varItemCode1;
			text2.readOnly = "readonly";
			text2.style.backgroundColor = "#FFFFFF";
			text2.style.border = "0px solid #001E6A";
			text2.style.textAlign = "left";
			text2.style.fontSize = "12";
			td2.appendChild (text2);
			tr.appendChild (td2);
			

			//var td3 = document.createElement ('<td id="idTD3'+k+'" align="left" valign="top" bordercolor="#F3F3F3" bgcolor="#FFFFFF" class="bodytext3"></td>');
			var td3 = document.createElement ('td');
			td3.id = "idTD3"+k+"";
			td3.align = "left";
			td3.valign = "top";
			td3.style.backgroundColor = "#FFFFFF";
			td3.style.border = "0px solid #F3F3F3";
			
			//var text3 = document.createElement ('<input value="'+varItemName1+'" name="itemname'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="60">');
			var text3 = document.createElement ('input');
			text3.id = "itemname"+k+"";
			text3.name = "itemname"+k+"";
			text3.type = "text";
			text3.size = "40";
			text3.value = varItemName1;
			text3.readOnly = "readonly";
			text3.style.backgroundColor = "#FFFFFF";
			text3.style.border = "0px solid #001E6A";
			text3.style.textAlign = "left";
			text3.style.fontSize = "12";

			//var text4 = document.createElement ('<input value="'+varItemMRP+'" name="itemmrp'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="5">');
			var text4 = document.createElement ('input');
			text4.id = "itemmrp"+k+"";
			text4.name = "itemmrp"+k+"";
			text4.type = "text";
			text4.size = "5";
			text4.value = varItemMRP;
			text4.readOnly = "readonly";
			text4.style.backgroundColor = "#FFFFFF";
			text4.style.border = "0px solid #001E6A";
			text4.style.textAlign = "right";
			text4.style.fontSize = "12";

			//var text41 = document.createElement ('<input value="" name="dummycontrol'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="1">');
			var text41 = document.createElement ('input');
			text41.id = "dummycontrol"+k+"";
			text41.name = "dummycontrol"+k+"";
			text41.type = "text";
			text41.size = "1";
			text41.value = "";
			text41.readOnly = "readonly";
			text41.style.backgroundColor = "#FFFFFF";
			text41.style.border = "0px solid #001E6A";
			text41.style.textAlign = "right";
			text41.style.fontSize = "12";

			//var text5 = document.createElement ('<input value="'+varTaxName+'" name="taxname'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="20">');
			var text5 = document.createElement ('input');
			text5.id = "taxname"+k+"";
			text5.name = "taxname"+k+"";
			text5.type = "text";
			text5.size = "10";
			text5.value = varTaxName;
			text5.readOnly = "readonly";
			text5.style.backgroundColor = "#FFFFFF";
			text5.style.border = "0px solid #001E6A";
			text5.style.textAlign = "left";
			text5.style.fontSize = "12";

			//var text6 = document.createElement ('<input value="" name="dummycontro2'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="1">');
			var text6 = document.createElement ('input');
			text6.id = "dummycontro2"+k+"";
			text6.name = "dummycontro2"+k+"";
			text6.type = "text";
			text6.size = "1";
			text6.value = "";
			text6.readOnly = "readonly";
			text6.style.backgroundColor = "#FFFFFF";
			text6.style.border = "0px solid #001E6A";
			text6.style.textAlign = "right";
			text6.style.fontSize = "12";


			//var text7 = document.createElement ('<input value="'+varTaxPercent+'" name="taxpercent'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="20">');
			var text7 = document.createElement ('input');
			text7.id = "taxpercent"+k+"";
			text7.name = "taxpercent"+k+"";
			text7.type = "text";
			text7.size = "5";
			text7.value = varTaxPercent;
			text7.readOnly = "readonly";
			text7.style.backgroundColor = "#FFFFFF";
			text7.style.border = "0px solid #001E6A";
			text7.style.textAlign = "right";
			text7.style.fontSize = "12";

			//var text8 = document.createElement ('<input value="'+varTaxAnum+'" name="taxautonumber'+k+'" type="hidden" readonly="readonly" style="border: 0px;font-size:8pt" size="20">');
			var text8 = document.createElement ('input');
			text8.id = "taxautonumber"+k+"";
			text8.name = "taxautonumber"+k+"";
			text8.type = "hidden";
			text8.size = "1";
			text8.value = varTaxAnum;
			text8.readOnly = "readonly";
			text8.style.backgroundColor = "#FFFFFF";
			text8.style.border = "0px solid #001E6A";
			text8.style.textAlign = "right";
			text8.style.fontSize = "12";


			//var text9 = document.createElement ('<input value="'+varItemDescription1+'" name="itemdescription'+k+'" type="hidden" readonly="readonly" style="border: 0px;font-size:8pt" size="20">');
			var text9 = document.createElement ('input');
			text9.id = "itemdescription"+k+"";
			text9.name = "itemdescription"+k+"";
			text9.type = "hidden";
			text9.size = "20";
			text9.value = varItemDescription1;
			text9.readOnly = "readonly";
			text9.style.backgroundColor = "#FFFFFF";
			text9.style.border = "0px solid #001E6A";
			text9.style.textAlign = "right";
			text9.style.fontSize = "12";

			td3.appendChild (text3);
			td3.appendChild (text4);
			td3.appendChild (text41);
			td3.appendChild (text5);
			td3.appendChild (text6);
			td3.appendChild (text7);
			td3.appendChild (text8);
			td3.appendChild (text9);

			tr.appendChild (td3);

			document.getElementById ('tblrowinsert').appendChild (tr);
	}
	//alert (k);
	} 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}