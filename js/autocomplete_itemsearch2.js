// JavaScript Document

var sd = 0;
//function to call ajax process
function categoryitemsearch(x)
{
	//if(document.getElementById("categoryname").value!="")
	//{
		var x= x;
		sd=x;
		//alert("Meow...");
		ajaxprocess5(x);		
		//var url = "";
	//}
	/*
	else if(document.form1.hairtype.value=="Select" || document.form1.hairsize.value=="Select")
	{
		document.getElementById("price").innerHTML='';
		
	}
	*/
}

var xmlHttp

function ajaxprocess5(sd)
{

xmlHttp=GetXmlHttpObject5()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  } 
  	var y = sd;
  	//var catservice=document.getElementById("itemname"+y).value;
  	var catservice=document.getElementById("service1").value;
	var csarr = catservice.split("||");
	var varItemCode = csarr[0];
	//alert(serviceanum);
	//var hairsize=document.form1.hairsize.value;
	//var type=document.form1.type.value;
	var url = "";
	var url="autocompleteitemdata1.php?RandomKey="+Math.random()+"&&itemcode="+varItemCode;
 	//alert(url);
  

xmlHttp.onreadystatechange=stateChanged5
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function stateChanged5() 
{ 
//alert("Simple");
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 	//alert("Simple");
	//document.form4.to1.options.clear;
	//document.getElementById("customername").innerHTML="";
	//document.getElementById("customername").value="";
	//document.getElementById('servicename').options.length=null; 

	
	//var t="$";
	var z=sd;
	var t = "";
	t=t+xmlHttp.responseText;
	//alert(t);
	
	//document.getElementById("price").innerHTML=t;
	var longstring=t;
	//alert (longstring);
	var brokenstring=longstring.split("||");
	//alert(brokenstring);
	//alert(brokenstring.length);
	var arraylength = brokenstring.length;

	arraylength = arraylength - 1;
	//alert(arraylength);
	if (arraylength == 0)
	{
			alert ("Item Does Not Exist. Enter Proper Item.");
			//document.getElementById("itemserialnumber").value = "";
			document.getElementById("itemcode").value = "";
			document.getElementById("itemname").value="";			
			document.getElementById("itemname").focus();
			document.getElementById("itemmrp").value = "0.00";
			document.getElementById("itemquantity").value = "1";
			document.getElementById("itemdiscountpercent").value = "0.00";
			document.getElementById("itemdiscountrupees").value = "0.00";
			document.getElementById("itemtaxpercent").value = "0.00";
			document.getElementById("itemtaxname").value="";	
			document.getElementById("itemtaxautonumber").value="";	
			document.getElementById("itemtotalamount").value = "0.00";
			//document.getElementById("unitname").value = "";
			//document.getElementById("subtotal").value = "0.00";
			return false;
	}
	else
	{
		for (i=0;i<9;i++)
		{
				//alert(Simple);
				//alert(brokenstring[i]);
				var longstring2 = t;
				var brokenstring2 = longstring2.split("||");
				//alert(brokenstring2[0]);
				//document.getElementById("itemserialnumber").value = "1";
				document.getElementById("itemcode").value = brokenstring2[2];
				document.getElementById("itemname").value = "";			
				document.getElementById("rateperunit").value = brokenstring2[0];
				
				document.getElementById("quantity").value = "1";
				document.getElementById("rateperunit").value = brokenstring2[0];
				document.getElementById("unitname").value = brokenstring2[1];
				document.getElementById("itemcode").value = brokenstring2[2];
				document.getElementById("taxpercent").value = brokenstring2[3];
				document.getElementById("subtotal").value = brokenstring2[4];
				document.getElementById("discountpercent").value = "0.00";
				document.getElementById("discountamount").value = "0.00";
				document.getElementById("totalamount").value = brokenstring2[5];
				document.getElementById("additionaltext").value = brokenstring2[8];
				document.getElementById("taxautonum").value = brokenstring2[9];
				var varItemCode6 = brokenstring2[2];
				var varItemName6 = brokenstring2[6];
				var varCategoryName6 = brokenstring2[7];
				document.getElementById("categoryname").value = varCategoryName6;
				document.getElementById("itemname").value = varItemName6;
				document.getElementById("service1").value = "";
				document.getElementById("quantity").focus();
			
				
/*				document.getElementById("itemmrp").value = brokenstring2[0];
				document.getElementById("itemquantity").value = "1";
				document.getElementById("itemdiscountpercent").value = "0.00";
				document.getElementById("itemdiscountrupees").value = "0.00";
				document.getElementById("itemtaxpercent").value = brokenstring2[3];
				document.getElementById("itemtotalamount").value = brokenstring2[0];
				alert (brokenstring2[0]);
*/				//document.getElementById("unitname").value = brokenstring2[1];
				//document.getElementById("subtotal").value = brokenstring2[4];
				
				//document.getElementById("itemcode").focus();
				
				//funcSubTotalCalc(z);
		}
	}
 } 
}

function GetXmlHttpObject5()
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

