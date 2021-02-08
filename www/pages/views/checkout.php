<?php 
$sub_total = 0;
$total_item_discount = 0;
$total_discount = 0;
$global_discount = 0;
$grand_total = 0;
$total_tax = 0;


$stuff_in_shopping_cart=0;
$total_items = 0;
$cart_html = '';
$hider = '';
$grand_total_without_shipping = 0;


if($cart->hasItems()){
	$stuff_in_shopping_cart=1;
	$cart_contents_array = $cart->getContents();
	$cart_has_items = 1;
	$i = 1;
	$hider = '';
	foreach($cart_contents_array as $cart_array) {
		$total_items++;
		$item_array = $item->getItem($cart_array['item_id']);
		$item_discount = 0;
		$total_item_discount += $item_discount;
		if($item_array['is_taxable']){
			$item_tax = $cart_array['price'] * .07;
		}else{
			$item_tax = 0;
		}
		$hider = ($i > 1) ? 'hide' : '';
		$total_tax += $item_tax; 
		
		
		$brand_name = getBrandName($item_array['brand_id']);
		$details_url = $nav->getItemUrl($item_array['seo_url'], $item_array['name'], $item_array['profile_item_id'], $brand_name, 'shop', $item_array['hide_id_from_url']);		
		
		$cart_html .= "<div class='span8 cart-item ".$hider."' id='".$cart_array['item_id']."'>";
		$cart_html .= "<div class='itembox'>";
		$cart_html .= "<div class='row'>";							
		$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'small') : 'medium'); 
		$cart_html .= "<div class='span1'><span class='product-image'>
						<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$item_array['file_name']."' 
						alt='".$item_array['img_alt_text']."' /></span></div>";
		$cart_html .= "<div class='span4 product-details'>";
		$cart_html .= "<p><strong>".stripAllSlashes($item_array['name'])."</strong><br/>";
		$cart_html .= "Product Id: ".$item_array['profile_item_id']."</p>";
		$cart_html .= "</div>";
		$cart_html .= "<div class='span1'><p>Qty: ".$cart_array['qty']."</p></div>";
		$cart_html .= "<div class='span2'><p class='align-right gutter-right'>";
		$line_total = ($cart_array['price'] - $total_item_discount) * $cart_array['qty'];
		if($line_total < 0) $line_total = 0;
		$cart_html .= "$".number_format($line_total,2); 
		$sub_total += $line_total;
		$cart_html .= "</p></div></div></div></div>";
		$i++;
	 }
	 
}

$cart_html .= "<div class='hider'></div></div>";

?>
<br />
<?php  
echo "Items in Cart: ". $total_items; 
echo "<br />";
$sub_total = round($sub_total,2);
$grand_total = $sub_total; 
echo "$".number_format($grand_total,2);
				
?> 


<form name="pay_form" action="process-order.html" method="post" enctype="multipart/form-data">


<h3>Billing &amp; Payment</h3>

<table>
<tr>
<td>First Name</td>
<td><input type="text" value="Mark" name="billing_name_first" /></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" value="Stanz" name="billing_name_last" /></td>
</tr>

<tr>
<td>Billing Address</td>
<td><input type="text" value="3921 Alton Rd" name="billing_address_one" /></td>
</tr>

<tr>
<td>Billing Address 2</td>
<td><input type="text" value="104" name="billing_address_two" /></td>
</tr>

<tr>
<td>Billing City</td>
<td><input type="text" value="Miami" name="billing_city" /></td>
</tr>

<tr>
<td>State</td>
<td>
<select name="billing_state">
<option value='0' selected>State</option>
<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT state, state_abr 
FROM states 
WHERE hide = '0'
AND profile_account_id = '".$_SESSION['profile_account_id']."'  
ORDER BY state"; 
$result = $dbCustom->getResult($db,$sql);									
$block = "";
while($row = $result->fetch_object()) {
$sel = 'selected';
$block .= "<option value='".$row->state_abr."' ".$sel." >".$row->state_abr."</option>";
}
echo $block;
?>
</select>
</td>
</tr>
<tr>
<td>Billing Zip</td>
<td><input type="text" value="33140" name="billing_zip" /></td>
</tr>
                                
								
								
<tr>
<td>Billing Country</td>								
<td>
<select name="billing_country" >
<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT country, country_abr FROM countries WHERE hide = '0' ORDER BY country"; 
$result = $dbCustom->getResult($db,$sql);									
$block = '';
while($row = $result->fetch_object()) {
$sel =  ('' == $row->country_abr) ? "selected" : '';	
$block .= "<option value='".$row->country_abr."' $sel >$row->country_abr</option>";
}
echo $block;
?>
</select>
</td>
</tr>

<tr>
<td>Email Address</td>
<td><input type="text" value="305-376-2565" name="billing_email" /></td>
</tr>
<tr>
<td>Billing Phone</td>
<td><input type="text" value="" name="billing_phone" /></td>
</tr>
<!-- 4111111111111111 -->
<tr>
<td>Card Number</td>
<td><input type="text" autocomplete="off" value="4111111111111111" name="CARDNUM" /></td>
</tr>
                        
<tr>
<td>Expiration Month</td>
<td>
<select name="EXPMONTH" id="input_EXPMONTH">
<option value="01">01</option>
<option value="02">02</option>
<option value="03" selected>03</option>
<option value="04">04</option> 
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
</td>
</tr>

<tr>
<td>Expiration Year</td>
<td>
<select name="EXPYEAR" id="input_EXPYEAR">
<?php
$year_4digit =  date("Y");
$year_2digit =  date("y");
for($i = 0; $i < 8; $i++){
echo "<option value='".$year_2digit."'>".$year_4digit."</option>";      
$year_2digit++;
$year_4digit++;
}
?>
</select>
</td>
</tr>


<tr>
<td>Security Code</td>
<td><input type="text" value="123" name="CVV2" /></td>
</tr>
             
</table>
<input type="submit">
</form> 

