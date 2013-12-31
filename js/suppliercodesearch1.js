// JavaScript Document


//function to call ajax process
function suppliercodesearch1()
{
	if(document.getElementById("searchsuppliercode").value!="")
	{

		//alert("Meow...");
		ajaxprocess();		
		//var url = "";
	}
	/*
	else if(document.form1.hairtype.value=="Select" || document.form1.hairsize.value=="Select")
	{
		document.getElementById("price").innerHTML='';
		
	}
	*/
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
  
  	var suppliercode=document.getElementById("searchsuppliercode").value;
	//alert(suppliercode);
	//var hairsize=document.form1.hairsize.value;
	//var type=document.form1.type.value;
	//alert(suppliercode);
	var url = "";
	var url="autocompletesupplierdata1.php?RandomKey="+Math.random()+"&&suppliercode="+suppliercode;
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
	document.getElementById("suppliername").value="";
	
	//var t="$";
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
	//alert(arraylength);
	arraylength = arraylength - 1;
	//alert(arraylength);
	if (arraylength == 0)
	{
		alert ("Supplier Code Does Not Exist. Enter Proper Code.");
		document.getElementById("searchsuppliercode").value = "";	//this will avoid msgbox loop.	
		document.getElementById("suppliercode").value = "";
		document.getElementById("suppliername").value = "";
		document.getElementById("address").value = "";
		document.getElementById("location").value = "";
		document.getElementById("city").value = "";
		document.getElementById("state").value = "";
		document.getElementById("pincode1").value = "";
		//document.getElementById("title1").value = "";
		//document.getElementById("contactperson1").value = "";
		//document.getElementById("designation1").value = "";
		//document.getElementById("department1").value = "";
		//document.getElementById("supplieranum").value = "";
		//document.getElementById("tinnumber").value = "";
		//document.getElementById("cstnumber").value = "";
		//document.getElementById("searchsuppliercode").focus;
		return false;
	}
	else
	{
		for (i=0;i<arraylength;i++)
		{
			//alert(brokenstring[i]);
			var longstring2 = t;
			var brokenstring2 = longstring2.split("||");
			//alert(brokenstring2);
			//var newOption = document.createElement('<option value="'+brokenstring2[1]+'">');
			//document.getElementById("to1").options.add(newOption);
			//newOption.innerText = brokenstring2[0];
			document.getElementById("suppliercode").value = brokenstring2[0];
			document.getElementById("suppliername").value = brokenstring2[1];
			document.getElementById("address").value = brokenstring2[2];
			document.getElementById("location").value = brokenstring2[3];
			document.getElementById("city").value = brokenstring2[4];
			document.getElementById("state").value = brokenstring2[5];
			document.getElementById("pincode1").value = brokenstring2[6];
			//document.getElementById("title1").value = brokenstring2[7];
			//document.getElementById("contactperson1").value = brokenstring2[8];
			//document.getElementById("designation1").value = brokenstring2[9];
			//document.getElementById("department1").value = brokenstring2[10];
			//document.getElementById("supplieranum").value = brokenstring2[11];
			//document.getElementById("tinnumber").value = brokenstring2[12];
			//document.getElementById("cstnumber").value = brokenstring2[13];
			//document.getElementById("searchsuppliername").value = "";
		}
	}
	/*
	var newOption = document.createElement('<option value="TOYOTA">');
	document.form4.to1.options.add(newOption);
    newOption.innerText = "Toyota";
	*/
	
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

/*
//function to create ajax connection and to get data from web server
function ajaxprocess()
{

	alert("hello");
	try
	{
		alert("a");
		var xmlhttp;
		xmlhttp=new XMLHttpRequest(); // ajax connection for mozilla firefox
		
	}
	catch(e)
	{
		try
		{
			xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");			
		}
			
	}
	
	
	if(xmlhttp==null)
	{
		alert("Browser is outdated");	
	}
	else
	{
		alert(xmlhttp);
		alert("b");
		
		var hairstyle=document.form1.hairtype.value;
		var hairsize=document.form1.hairsize.value;

		if(hairsize.length>3)

		var url="getprice.php?style="+hairstyle+"&size="+hairsize;
		
		try
		{
			xmlhttp.onreadystatechange = getdata;
			xmlhttp.open("GET", url, true);
			xmlhttp.send(null);
		
			function getdata()
			{
			
				if(xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
				{
					var t=xmlhttp.responseText;
					alert(t);
					
				}
			
		
			}
		}
		catch(e)
		{
			alert(e.description);	
		}
		
		
		
		
	}
	
}

*/