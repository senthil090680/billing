<script language="javascript">

//This file cannot be save as .js, reason, php coding is involved. It needs to be as .php file than .js 

function funcCustomerDropDownSearch1() 
{
	//alert("simple");
	var oTextbox = new AutoSuggestControl(document.getElementById("customer"), new StateSuggestions()); 
	//alert(oTextbox);       
	
	var oTextbox1 = new AutoSuggestControl1(document.getElementById("itemname"), new StateSuggestions1());
	//alert(oTextbox1);       
     
}


</script>