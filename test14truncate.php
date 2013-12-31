<?php
session_start();
include ("db/db_connect.php");
$errmsg1 = '';
$errmsg2 = '';
$errmsg3 = '';


if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
//$frmflag1 = $_REQUEST['frmflag1'];
if ($frmflag1 == 'frmflag1')
{
	$query1 = "truncate table settings_quotation";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_quotation";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table quotation_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table quotation_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_salesorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salesorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesorder_print_dump";
	$exec1 = mysql_query($query1);

	$query1 = "truncate table settings_proforma";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_proforma";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proforma_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proforma_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_proformainvoice";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_proformainvoice";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table proformainvoice_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_sales";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table sales_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table sales_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table sales_print_dump";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_salesreturn";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesreturn_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table salesreturn_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchaserequest";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaserequest_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaserequest_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchase_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchase_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchasereturn";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchasereturn_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchasereturn_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table purchaseorder_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_dccustomer";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_deliverychallan";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_deliverychallanout";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dccustomer_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dccustomer_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_dcsupplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dcsupplier_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table dcsupplier_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_production";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table production_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table production_tax";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_transaction";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_stock";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_renewal";
	$exec1 = mysql_query($query1);

	$query1 = "truncate table details_login";
	$exec1 = mysql_query($query1);

	$query1 = "truncate table login_restriction";
	$exec1 = mysql_query($query1);

	$errmsg1 = "Table First Batch Truncate Completed.";
}


if (isset($_REQUEST["frmflag2"])) { $frmflag2 = $_REQUEST["frmflag2"]; } else { $frmflag2 = ""; }
//$frmflag2 = $_REQUEST['frmflag2'];
if ($frmflag2 == 'frmflag2')
{
	$query1 = "truncate table settings_bill";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_deliverychallan";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_proforma";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_proformainvoice";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchase";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_purchaseorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_quotation";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table settings_salesorder";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_customer";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_contact";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_supplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_contact_supplier";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_category";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_item";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_renewal";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expense";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table expense_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expensemain";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table expensemain_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_expensesub";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table expensesub_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_bank";
	$exec1 = mysql_query($query1);
	
	$errmsg2 = "Table Second Batch Truncate Completed.";
}



if (isset($_REQUEST["frmflag3"])) { $frmflag3 = $_REQUEST["frmflag3"]; } else { $frmflag3 = ""; }
//$frmflag3 = $_REQUEST['frmflag3'];
if ($frmflag3 == 'frmflag3')
{
	$query1 = "truncate table master_company";
	$exec1 = mysql_query($query1);

	$query1 = "truncate table master_settings";
	$exec1 = mysql_query($query1);
	
	$query1 = "update master_edition set productcode = '', users = '2', status = ''";
	$exec1 = mysql_query($query1);
	
	$query1 = "update master_edition set status = 'ACTIVE' where edition = 'FREE'";
	$exec1 = mysql_query($query1);

	/*
	$query1 = "truncate table master_endproduct";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table endproduct_details";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table master_productionentry";
	$exec1 = mysql_query($query1);
	
	$query1 = "truncate table productionentry_details";
	$exec1 = mysql_query($query1);
	*/
	
	$errmsg3 = "Table Third Batch Truncate Completed.";
}



?>
<script language="javascript">
function btnClick1()
{
	var fRet3; 
	fRet3 = confirm('Are You Sure Want To Delete All Data In Table First Batch And Reset To Original State?'); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		alert ("Data In Table First Batch Not Deleted.");
		return false;
	}
}

function btnClick2()
{
	var fRet3; 
	fRet3 = confirm('Are You Sure Want To Delete All Data In Table Second Batch And Reset To Original State?'); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		alert ("Data In Table Second Batch Not Deleted.");
		return false;
	}
}

function btnClick3()
{
	var fRet3; 
	fRet3 = confirm('Are You Sure Want To Delete All Data In Table Third Batch And Reset To Original State?'); 
	//alert(fRet); 
	if (fRet3 == false)
	{
		alert ("Data In Table Third Batch Not Deleted.");
		return false;
	}
}

</script>
<form id="form1" name="form1" method="post" action="" onsubmit="return btnClick1()">
  <p>Batch One : To Delete - Quotation, Sales Order, Sales, Sales Return, Purchase Request, Purchase Order, Purchase, Purchase Return, DC Supplier, DC Customer, Transaction, Stock. </p>
  <p>
    <input type="submit" name="Submit" value="Truncate All Data" />
    <input type="hidden" name="frmflag1" id="frmflag1" value="frmflag1" />
    </p>
</form>
<?php echo $errmsg1; ?>
<br />
<br />
<br />
<br />
<form id="form2" name="form2" method="post" action="" onsubmit="return btnClick2()">
  <p>Batch Two : To Delete - Customer, Supplier, Contact, Category, Items, Renewal, Expenses, Bank. </p>
  <p>
    <input type="submit" name="Submit" value="Truncate All Data" />
    <input type="hidden" name="frmflag2" id="frmflag2" value="frmflag2" />
  </p>
</form>
<?php echo $errmsg2; ?>
<br />
<br />
<br />
<br />
<form id="form3" name="form3" method="post" action="" onsubmit="return btnClick3()">
  <p>Batch Three : To Delete - Company, Settings Master, </p>
  <p>
    <input type="submit" name="Submit" value="Truncate All Data" />
    <input type="hidden" name="frmflag3" id="frmflag3" value="frmflag3" />
    </p>
</form>
<?php echo $errmsg3; ?>
<br />
<br />
<br />
<br />



