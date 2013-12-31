// JavaScript Document
//function to call ajax process
function suppliersearch1()
{
	

	//to get number of rows in the table before deleting.
	for(var j = document.getElementById("tblrowinsert").rows.length; j > 0;j--)
	{
		document.getElementById("tblrowinsert").deleteRow(j -1);
	}

	
	//alert("Meow...");
	if(document.getElementById("suppliersearch").value!="")
	{
		var varSupplierSearch = document.getElementById("suppliersearch").value;
		//alert (varSupplierSearch);
		var varSupplierSearchLen = varSupplierSearch.length;
		//alert (varSupplierSearchLen);
		//if (varSupplierSearchLen > 1)
		//{
			ajaxprocess();		
		//}
		
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
  
  	var suppliersearch=document.getElementById("suppliersearch").value;
	//alert(suppliercode);
	var url = "";
	var url="autosuppliercodesearch1.php?RandomKey="+Math.random()+"&&suppliersearch="+suppliersearch;
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
	//document.getElementById("suppliername").innerHTML="";
	//document.getElementById("suppliersearch").value="";
	
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
	
	var k = 0;
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
		
		var k = k + 1;
		//for (i=0;i<varNewRecordLength;i++)
		//{
			var varSupplierCode1 = varNewRecordValue[0];
			//alert (varSupplierCode1);
			var varSupplierName1 = varNewRecordValue[1];
			//alert (varSupplierName1);
			var varSupplierAddress1 = varNewRecordValue[2];
			//alert (varSupplierName1);
			//var varSupplierAddress2 = varNewRecordValue[3];
			//alert (varSupplierName1);
			var varSupplierArea1 = varNewRecordValue[3];
			//alert (varSupplierName1);
			var varSupplierCity1 = varNewRecordValue[4];
			//alert (varSupplierName1);
			var varSupplierPincode1 = varNewRecordValue[5];
			//alert (varSupplierName1);
			var varSupplierTIN1 = varNewRecordValue[6];
			//alert (varSupplierName1);
			var varSupplierCST1 = varNewRecordValue[7];
			//alert (varSupplierName1);
			
			
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
			//var text1 = document.createElement ('<input value="'+k+'" name="serialnumber'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="3">');
			var text1 = document.createElement ('input');
			text1.id = "serialnumber"+k+"";
			text1.name = "serialnumber"+k+"";
			text1.type = "text";
			text1.size = "3";
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
			//var text2 = document.createElement ('<input value="'+varSupplierCode1+'" name="suppliercode'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="12">');
			var text2 = document.createElement ('input');
			text2.id = "suppliercode"+k+"";
			text2.name = "suppliercode"+k+"";
			text2.type = "text";
			text2.size = "12";
			text2.value = varSupplierCode1;
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
			//var text3 = document.createElement ('<input value="'+varSupplierName1+'" name="suppliername'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="30">');
			var text3 = document.createElement ('input');
			text3.id = "suppliername"+k+"";
			text3.name = "suppliername"+k+"";
			text3.type = "text";
			text3.size = "30";
			text3.value = varSupplierName1;
			text3.readOnly = "readonly";
			text3.style.backgroundColor = "#FFFFFF";
			text3.style.border = "0px solid #001E6A";
			text3.style.textAlign = "left";
			text3.style.fontSize = "12";
			td3.appendChild (text3);

			//var text4 = document.createElement ('<input value="'+varSupplierAddress1+'" name="supplieraddress1'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text4 = document.createElement ('input');
			text4.id = "supplieraddress1"+k+"";
			text4.name = "supplieraddress1"+k+"";
			text4.type = "text";
			text4.size = "15";
			text4.value = varSupplierAddress1;
			text4.readOnly = "readonly";
			text4.style.backgroundColor = "#FFFFFF";
			text4.style.border = "0px solid #001E6A";
			text4.style.textAlign = "left";
			text4.style.fontSize = "12";
			td3.appendChild (text4);

			//var text5 = document.createElement ('<input value="'+varSupplierArea1+'" name="supplierarea'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text5 = document.createElement ('input');
			text5.id = "supplierarea"+k+"";
			text5.name = "supplierarea"+k+"";
			text5.type = "text";
			text5.size = "15";
			text5.value = varSupplierArea1;
			text5.readOnly = "readonly";
			text5.style.backgroundColor = "#FFFFFF";
			text5.style.border = "0px solid #001E6A";
			text5.style.textAlign = "left";
			text5.style.fontSize = "12";
			td3.appendChild (text5);

			//var text6 = document.createElement ('<input value="'+varSupplierCity1+'" name="suppliercity'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text6 = document.createElement ('input');
			text6.id = "suppliercity"+k+"";
			text6.name = "suppliercity"+k+"";
			text6.type = "text";
			text6.size = "15";
			text6.value = varSupplierCity1;
			text6.readOnly = "readonly";
			text6.style.backgroundColor = "#FFFFFF";
			text6.style.border = "0px solid #001E6A";
			text6.style.textAlign = "left";
			text6.style.fontSize = "12";
			td3.appendChild (text6);

			//var text7 = document.createElement ('<input value="'+varSupplierPincode1+'" name="supplierpincode'+k+'" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text7 = document.createElement ('input');
			text7.id = "supplierpincode"+k+"";
			text7.name = "supplierpincode"+k+"";
			text7.type = "text";
			text7.size = "5";
			text7.value = varSupplierPincode1;
			text7.readOnly = "readonly";
			text7.style.backgroundColor = "#FFFFFF";
			text7.style.border = "0px solid #001E6A";
			text7.style.textAlign = "left";
			text7.style.fontSize = "12";
			td3.appendChild (text7);

			//var text8 = document.createElement ('<input value="'+varSupplierTIN1+'" name="suppliertin'+k+'" type="hidden" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text8 = document.createElement ('input');
			text8.id = "suppliertin"+k+"";
			text8.name = "suppliertin"+k+"";
			text8.type = "hidden";
			text8.size = "2";
			text8.value = varSupplierTIN1;
			text8.readOnly = "readonly";
			text8.style.backgroundColor = "#FFFFFF";
			text8.style.border = "0px solid #001E6A";
			text8.style.textAlign = "left";
			text8.style.fontSize = "12";
			td3.appendChild (text8);

			//var text9 = document.createElement ('<input value="'+varSupplierCST1+'" name="suppliercst'+k+'" type="hidden" readonly="readonly" style="border: 0px;font-size:8pt" size="15">');
			var text9 = document.createElement ('input');
			text9.id = "suppliercst"+k+"";
			text9.name = "suppliercst"+k+"";
			text9.type = "hidden";
			text9.size = "2";
			text9.value = varSupplierCST1;
			text9.readOnly = "readonly";
			text9.style.backgroundColor = "#FFFFFF";
			text9.style.border = "0px solid #001E6A";
			text9.style.textAlign = "left";
			text9.style.fontSize = "12";
			td3.appendChild (text9);

			tr.appendChild (td3);

			document.getElementById ('tblrowinsert').appendChild (tr);
		//}
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