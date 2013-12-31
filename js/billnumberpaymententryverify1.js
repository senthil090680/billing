
//Function call from billnumber onBlur and Save button click from paymententry1.php
//function to call ajax process
function funcBillNumberPaymentEntryVerify1()
{
	//alert ("Calling Bill Number Validation");
	
	if(isNaN(document.getElementById("billnumber").value))
	{
		alert ("Bill Number Can Only Be Numbers. Please Enter Proper Bill Number.");
		document.getElementById("billnumber").focus();
		return false;
	}
	if(document.getElementById("billnumber").value != "")
	{
		ajaxprocess2();		
	}
	if(document.getElementById("billnumber").value == "")
	{
		document.getElementById("billtotalamount").value = "0.00";
		document.getElementById("billamountpaid").value = "0.00";
		document.getElementById("billamountpending").value = "0.00";
		//document.getElementById("billnumber").value == "";
	}
}

var xmlHttp

function ajaxprocess2()
{

xmlHttp=GetXmlHttpObject2()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  } 
  
  	var billnumber=document.getElementById("billnumber").value;
  	var suppliercode=document.getElementById("suppliercode").value;
	var url = "";
	var url="billnumberpaymententryverify1.php?RandomKey="+Math.random()+"&&suppliercode="+suppliercode+"&&billnumber="+billnumber;
	//alert (url);

xmlHttp.onreadystatechange=stateChanged2 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function stateChanged2() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	 { 
		var t = "";
		t=t+xmlHttp.responseText;
		//alert(t);
		
		if(t == 'BillNumberNotExists')
		{
			alert("Bill Number Does Not Exists In Database. Pleaes Verify Bill Number.")
			document.getElementById("billnumber").value = "";
			document.getElementById("billnumber").focus();

			document.getElementById("billtotalamount").value = "0.00";
			document.getElementById("billamountpaid").value = "0.00";
			document.getElementById("billamountpending").value = "0.00";

			return false;
		}
		else
		{
			//alert ("Bill Number Is Properly Set.");
			
			var brokenstring = t.split("||");
			//alert(brokenstring);
			var varBillTotalAmount = brokenstring[0];
			var varBillAmountPaid = brokenstring[1];
			var varBillAmountPending = brokenstring[2];
			
			document.getElementById("billtotalamount").value = varBillTotalAmount;
			document.getElementById("billamountpaid").value = varBillAmountPaid;
			document.getElementById("billamountpending").value = varBillAmountPending;
			//document.getElementById("billnumber").value == "";
			return false;
		}
	 } 
}

function GetXmlHttpObject2()
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

