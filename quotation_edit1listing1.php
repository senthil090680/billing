<?php

if ($delbillst == 'billedit' && $delbillnumber != '')
{
//echo 'inside if';
$serialnumber = '';

$query43 = "select * from master_quotation where quotationnumber = '$delbillnumber' and companyanum = '$companyanum' and financialyear = '$financialyear' and status <> 'deleted'";
$exec43 = mysql_query($query43) or die ("Error in Query43".mysql_error());
$res43 = mysql_fetch_array($exec43);
$res43quotationanum = $res43["auto_number"];

$query41 = "select * from quotation_details where quotationanum = '$res43quotationanum'";
$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
while ($res41 = mysql_fetch_array($exec41))
{

$serialnumber = $serialnumber + 1;
$itemanum = $res41["itemanum"];

$query44 = "select * from master_item where auto_number = '$itemanum'";
$exec44 = mysql_query($query44) or die ("Error in Query44".mysql_error());
$res44 = mysql_fetch_array($exec44);
$itemcode = $res44["itemcode"];
$unitname = $res44["unitname_abbreviation"];
$categoryname = $res44["categoryname"];

$itemname = $res41["itemname"];
$rateperunit = $res41["rateperunit"];
$quantity = $res41["quantity"];
$varItemQuantity = round($quantity, 4);
$subtotal = $res41["subtotal"];
$discountpercent = '';
if ($discountpercent == '') $discountpercent = '0.00';
$discountamount = '';
if ($discountamount == '') $discountamount = '0.00';

$query42 = "select * from quotation_tax where itemcode = '$itemcode' and quotation_autonumber = '$res43quotationanum' and financialyear = '$financialyear'";
$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
$res42 = mysql_fetch_array($exec42);

$taxpercent = $res42["taxpercent"];
$taxautonum = $res42["tax_autonumber"];
$taxname = $res42["taxname"];

$totalamount = $res41["totalamount"];
$additionaltext = $res41["additionaltext"];

?>
<TR id="idTR<?php echo $serialnumber; ?>">
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $serialnumber; ?>" name="serialnumber<?php echo $serialnumber; ?>" id="serialnumber<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $itemcode; ?>" name="itemcode<?php echo $serialnumber; ?>" id="itemcode<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" size="10" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input type="hidden" name="dummy<?php echo $serialnumber; ?>" size="45" id="dummy<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $itemname; ?>" name="itemname<?php echo $serialnumber; ?>" size="45" id="itemname<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $unitname; ?>" name="unitname<?php echo $serialnumber; ?>" id="unitname<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $rateperunit; ?>" name="rateperunit<?php echo $serialnumber; ?>" id="rateperunit<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $quantity; ?>" name="quantity<?php echo $serialnumber; ?>" id="quantity<?php echo $serialnumber; ?>"  onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input value="<?php echo $subtotal; ?>" name="subtotal<?php echo $serialnumber; ?>" id="subtotal<?php echo $serialnumber; ?>" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $discountpercent; ?>" type="text" name="discountpercent<?php echo $serialnumber; ?>" id="discountpercent<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $discountamount; ?>" type="text" name="discountamount<?php echo $serialnumber; ?>" id="discountamount<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" />
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $taxpercent; ?>" type="text" name="taxpercent<?php echo $serialnumber; ?>" id="taxpercent<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />
<input value="<?php echo $taxautonum; ?>" type="hidden" name="taxautonum<?php echo $serialnumber; ?>" id="taxautonum<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input value="<?php echo $totalamount; ?>" name="totalamount<?php echo $serialnumber; ?>" id="totalamount<?php echo $serialnumber; ?>" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input type="hidden" name="categoryname<?php echo $serialnumber; ?>" value="<?php echo $categoryname; ?>" size="15" id="categoryname<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" />
<input name="btndelete<?php echo $serialnumber; ?>" id="btndelete<?php echo $serialnumber; ?>" onClick="return btnDeleteClick(<?php echo $serialnumber; ?>)" type="button"  value="Del" class="button" style="border: 1px solid #001E6A"/></td>
</tr>
<?php
if ($additionaltext != '')
{
?>
<TR id="idTRaddtxt<?php echo $serialnumber; ?>">
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><strong>Description</strong></td>
<td colspan="11" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<textarea name="additionaltext<?php echo $serialnumber; ?>" cols="75" id="additionaltext<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left">
<?php echo nl2br($additionaltext); ?></textarea></td>
</tr>
<?php
}
}
}
?>
<?php
if ($delbillst == 'importsalesorder' && $delbillnumber != '')
{
//echo 'inside if';
$serialnumber = '';

$query41 = "select * from salesorder_details where billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec41 = mysql_query($query41) or die ("Error in Query41".mysql_error());
while ($res41 = mysql_fetch_array($exec41))
{
$serialnumber = $serialnumber + 1;
$itemcount = $itemcount + 1;

$itemcode = $res41["itemcode"];
$itemname = $res41["itemname"];
$rateperunit = $res41["rate"];
$quantity = $res41["quantity"];
$quantity = round($quantity, 4);
$discountpercent = $res41["itemdiscountpercentage"];
if ($discountpercent == '') $discountpercent = '0.00';
$discountamount = $res41["itemdiscountrupees"];
if ($discountamount == '') $discountamount = '0.00';

$query42 = "select * from salesorder_tax where itemcode = '$varItemCode' and billnumber = '$delbillnumber' and companyanum = '$companyanum' and recordstatus <> 'deleted'";
$exec42 = mysql_query($query42) or die ("Error in Query42".mysql_error());
$res42 = mysql_fetch_array($exec42);

$taxpercent = $res42["taxpercent"];
$taxautonum = $res42["tax_autonumber"];
$taxname = $res42["taxname"];

$totalamount = $res41["totalamount"];
$additionaltext = $res41["itemdescription"];


?>
<TR id="idTR<?php echo $serialnumber; ?>">
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $serialnumber; ?>" name="serialnumber<?php echo $serialnumber; ?>" id="serialnumber<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $itemcode; ?>" name="itemcode<?php echo $serialnumber; ?>" id="itemcode<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" size="10" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input type="hidden" name="dummy<?php echo $serialnumber; ?>" size="45" id="dummy<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $itemname; ?>" name="itemname<?php echo $serialnumber; ?>" size="45" id="itemname<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $unitname; ?>" name="unitname<?php echo $serialnumber; ?>" id="unitname<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:left" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $rateperunit; ?>" name="rateperunit<?php echo $serialnumber; ?>" id="rateperunit<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $quantity; ?>" name="quantity<?php echo $serialnumber; ?>" id="quantity<?php echo $serialnumber; ?>"  onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input value="<?php echo $subtotal; ?>" name="subtotal<?php echo $serialnumber; ?>" id="subtotal<?php echo $serialnumber; ?>" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $discountpercent; ?>" type="text" name="discountpercent<?php echo $serialnumber; ?>" id="discountpercent<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $discountamount; ?>" type="text" name="discountamount<?php echo $serialnumber; ?>" id="discountamount<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" onBlur="return quantityvalidation()" style="border: 1px solid #001E6A; text-align:right" size="2" />
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">
<input value="<?php echo $taxpercent; ?>" type="text" name="taxpercent<?php echo $serialnumber; ?>" id="taxpercent<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" />
<input value="<?php echo $taxautonum; ?>" type="hidden" name="taxautonum<?php echo $serialnumber; ?>" id="taxautonum<?php echo $serialnumber; ?>" onKeyDown="return disableEnterKey()" readonly="readonly" style="border: 1px solid #001E6A; text-align:right" size="2" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input value="<?php echo $totalamount; ?>" name="totalamount<?php echo $serialnumber; ?>" id="totalamount<?php echo $serialnumber; ?>" readonly="readonly" onKeyDown="return disableEnterKey()" style="border: 1px solid #001E6A; text-align:right" size="8" /></td>
<td align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<input type="hidden" name="categoryname<?php echo $serialnumber; ?>" value="<?php echo $categoryname; ?>" size="15" id="categoryname<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left" onKeyDown="return disableEnterKey()" readonly="readonly" />
<input name="btndelete<?php echo $serialnumber; ?>" id="btndelete<?php echo $serialnumber; ?>" onClick="return btnDeleteClick(<?php echo $serialnumber; ?>)" type="button"  value="Del" class="button" style="border: 1px solid #001E6A"/></td>
</tr>
<?php
if ($additionaltext != '')
{
?>
<TR id="idTRaddtxt<?php echo $serialnumber; ?>">
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff">&nbsp;</td>
<td class="bodytext31" valign="center"  align="left" bgcolor="#ffffff"><strong>Description</strong></td>
<td colspan="11" align="left" valign="center"  bgcolor="#ffffff" class="bodytext31">
<textarea name="additionaltext<?php echo $serialnumber; ?>" cols="75" id="additionaltext<?php echo $serialnumber; ?>" style="border: 1px solid #001E6A; text-align:left">
<?php echo nl2br($additionaltext); ?></textarea></td>
</tr>
<?php
}
}
}
?>