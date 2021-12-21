<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/includes/config.php');
require_once($real_root.'/manage/admin-includes/manage-includes.php');
require_once($real_root.'/includes/class.shopping_cart.php');
require_once($real_root.'/includes/class.shopping_cart_item.php');
require_once($real_root.'/includes/class.customer_account.php');
require_once($real_root.'/includes/class.shipping.php');
$cart = new ShoppingCart($dbCustom);
$_SESSION['no_order_refreash'] = 0;
$acc = new CustomerAccount();
$item = new ShoppingCartItem;
$shipping = new Shipping;
$customer_id = $_SESSION['user_id'];
$acc->setDbAccData($dbCustom,$customer_id);
$email_address = '';
if(!isset($_SESSION['shipping_cost'])) $_SESSION['shipping_cost'] = 0;
if(!isset($_SESSION['checkout_info_array']['billing_name_first'])){ 
	$_SESSION['checkout_info_array']['billing_name_first'] = $acc->billing_name_first;
}
if(!isset($_SESSION['checkout_info_array']['billing_name_last'])){ 
	$_SESSION['checkout_info_array']['billing_name_last'] = $acc->billing_name_last;
}
if(!isset($_SESSION['checkout_info_array']['billing_email'])){
	 $_SESSION['checkout_info_array']['billing_email'] = $email_address;
}
if(!isset($_SESSION['checkout_info_array']['billing_address_one'])){
	$_SESSION['checkout_info_array']['billing_address_one'] = $acc->billing_address_one;
}
if(!isset($_SESSION['checkout_info_array']['billing_address_two'])){
	$_SESSION['checkout_info_array']['billing_address_two'] = $acc->billing_address_two;
}
if(!isset($_SESSION['checkout_info_array']['billing_city'])){
$_SESSION['checkout_info_array']['billing_city'] = $acc->billing_city;
}	
if(!isset($_SESSION['checkout_info_array']['billing_state'])){
$_SESSION['checkout_info_array']['billing_state'] = $acc->billing_state;
}
if(!isset($_SESSION['checkout_info_array']['billing_country'])){
$_SESSION['checkout_info_array']['billing_country'] = $acc->billing_country;
}
if(trim($_SESSION['checkout_info_array']['billing_country']) == ''){
$_SESSION['checkout_info_array']['billing_country'] = 'US';
}
if(!isset($_SESSION['checkout_info_array']['billing_zip'])){
$_SESSION['checkout_info_array']['billing_zip'] = $acc->billing_zip;
}	
if(!isset($_SESSION['checkout_info_array']['billing_phone'])){
$_SESSION['checkout_info_array']['billing_phone'] = $acc->billing_phone;
}
if(!isset($_SESSION['checkout_info_array']['shipping_name_first'])){
$_SESSION['checkout_info_array']['shipping_name_first'] = $acc->shipping_name_first;
}
if(!isset($_SESSION['checkout_info_array']['shipping_name_last'])){
$_SESSION['checkout_info_array']['shipping_name_last'] = $acc->shipping_name_last;
}	
if(!isset($_SESSION['checkout_info_array']['shipping_address_one'])){
$_SESSION['checkout_info_array']['shipping_address_one'] = $acc->shipping_address_one;
}	
if(!isset($_SESSION['checkout_info_array']['shipping_address_two'])){
$_SESSION['checkout_info_array']['shipping_address_two'] = $acc->shipping_address_two;
}	
if(!isset($_SESSION['checkout_info_array']['shipping_city'])){
$_SESSION['checkout_info_array']['shipping_city'] = $acc->shipping_city;
}
if(!isset($_SESSION['checkout_info_array']['shipping_state'])){
$_SESSION['checkout_info_array']['shipping_state'] = $acc->shipping_state;
}
if(isset($_SESSION['ship_rate_zip']) && $_SESSION['ship_rate_zip'] != ''){
	$_SESSION['checkout_info_array']['shipping_zip'] = $_SESSION['ship_rate_zip'];
}else{
	$_SESSION['checkout_info_array']['shipping_zip'] = $acc->shipping_zip;
}	
if(!isset($_SESSION['checkout_info_array']['shipping_country'])){
	$_SESSION['checkout_info_array']['shipping_country'] = $acc->shipping_country;
}
if(trim($_SESSION['checkout_info_array']['shipping_country']) == ''){
	$_SESSION['checkout_info_array']['shipping_country'] = 'US';
}
if(!isset($_SESSION['checkout_info_array']['shipping_phone'])){
$_SESSION['checkout_info_array']['shipping_phone'] = $acc->shipping_phone;
}
if(!isset($_SESSION['checkout_info_array']['shipping_email'])){
	$_SESSION['checkout_info_array']['shipping_email'] = $email_address;
}
$sub_total = 0;
$grand_total = 0;
$total_tax = 0;


if($cart->hasItems()){
	$stuff_in_shopping_cart=1;
	$cart_contents_array = $cart->getContents();
	$cart_has_items = 1;
	$i = 1;
	$hider = '';
	foreach($cart_contents_array as $cart_array) {
		$total_items++;
		$item_array = $item->getItem($cart_array['item_id']);
		$item_discount = $discount->getItemDiscount($cart_array['item_id']);
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

$cart->saveCart($dbCustom);
if($_SESSION['shipping_cost'] < 0) $_SESSION['shipping_cost'] = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$total_items = 999;
$sub_total = round($sub_total,2);
echo "$".number_format($sub_total,2);						
?>                
                
<form name="pay_form" action="process-order.php" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>shipping_name_first</td>
<td>
<input type="text" name="shipping_name_first" value="<?php echo $_SESSION['checkout_info_array']['shipping_name_first']; ?>" />
</td>
</tr>

<tr>
<td>shipping_name_last</td>
<td>
<input type="text" name="shipping_name_last" value="<?php echo $_SESSION['checkout_info_array']['shipping_name_last']; ?>" />
</td>
</tr>

<tr>
<td>shipping_name_last</td>
<td>
<input type="text" name="shipping_name_last" value="<?php echo $_SESSION['checkout_info_array']['shipping_name_last']; ?>" />
</td>
</tr>

<tr>
<td>shipping_address_one</td>
<td>
<input type="text" name="shipping_address_one" value="<?php echo $_SESSION['checkout_info_array']['shipping_address_one']; ?>" />
</td>
</tr>

<tr>
<td>shipping_address_two</td>
<td>
<input type="text" name="shipping_address_two" value="<?php echo $_SESSION['checkout_info_array']['shipping_address_two']; ?>" />
</td>
</tr>

<tr>
<td>shipping_city</td>
<td>
<input type="text" name="shipping_city" value="<?php echo $_SESSION['checkout_info_array']['shipping_city']; ?>" />
</td>
</tr>

<tr>
<td>shipping_state</td>
<td>
<select name="shipping_state">
<option value='0' selected>State</option>
<?php 
$sql = "SELECT state, state_abr 
FROM states 
WHERE hide = '0'
AND profile_account_id = '".$_SESSION['profile_account_id']."'  
ORDER BY state"; 
$result = $dbCustom->getResult($db,$sql);								
$block = "";
while($row = $result->fetch_object()) {
$sel =  ($_SESSION['checkout_info_array']['shipping_state'] == $row->state_abr) ? "selected" : '';	
$block .= "<option value='".$row->state_abr."' ".$sel." >".$row->state_abr."</option>";
}
echo $block;
?>
</select>
</td>
</tr>

<tr>
<td>shipping_zip</td>
<td>
<input type="text" name="shipping_zip" value="<?php echo $_SESSION['checkout_info_array']['shipping_zip']; ?>" />
</td>
</tr>

<tr>
<td>shipping_country</td>
<td>
<select name="shipping_country" >
<?php 
$sql = "SELECT country, country_abr FROM countries WHERE hide = '0' ORDER BY country"; 
$result = $dbCustom->getResult($db,$sql);									
$block = "<option value='0' selected>Country</option>";
while($row = $result->fetch_object()) {
$sel =  ($_SESSION['checkout_info_array']['shipping_country'] == $row->country_abr) ? "selected" : '';	
$block .= "<option value='".$row->country_abr."' $sel >$row->country_abr</option>";
}
echo $block;
?>
</select>
</td>
</tr>

<tr>
<td>shipping_email</td>
<td>
<input type="text" name="shipping_email" value="<?php echo $_SESSION['checkout_info_array']['shipping_email']; ?>" />
</td>
</tr>

<tr>
<td>shipping_phone</td>
<td>
<input type="text" name="shipping_phone" value="<?php echo $_SESSION['checkout_info_array']['shipping_phone']; ?>" />
</td>
</tr>

<tr>
<td>billing_name_first</td>
<td>
<input type="text" name="billing_name_first" value="<?php echo $_SESSION['checkout_info_array']['billing_name_first']; ?>" />
</td>
</tr>

<tr>
<td>billing_name_last</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_name_last']; ?>" 
name="billing_name_last" />
</td>
</tr>

<tr>
<td>billing_address_one</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_address_one']; ?>" 
name="billing_address_one" />
</td>
</tr>

<tr>
<td>billing_address_two</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_address_two']; ?>" 
name="billing_address_two" />
</td>
</tr>


<tr>
<td>billing_city</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_city']; ?>" 
name="billing_city" />
</td>
</tr>

<tr>
<td>billing_state</td>
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
$sel =  ($_SESSION['checkout_info_array']['billing_state'] == $row->state_abr) ? "selected" : '';	
$block .= "<option value='".$row->state_abr."' ".$sel." >".$row->state_abr."</option>";
}
echo $block;
?>
</select>
</td>
</tr>

<tr>
<td>billing_zip</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_zip']; ?>" 
name="billing_zip" />
</td>
</tr>


<tr>
<td>billing_country</td>
<td>
<select name="billing_country" >
<?php 
$sql = "SELECT country, country_abr FROM countries WHERE hide = '0' ORDER BY country"; 
$result = $dbCustom->getResult($db,$sql);									
$block = '';
while($row = $result->fetch_object()) {
$sel =  ($_SESSION['checkout_info_array']['billing_country'] == $row->country_abr) ? "selected" : '';	
$block .= "<option value='".$row->country_abr."' $sel >$row->country_abr</option>";
}
echo $block;
?>
</select>
</td>
</tr>

<tr>
<td>billing_zip</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_zip']; ?>" 
name="billing_zip" />
</td>
</tr>

<tr>
<td>billing_email</td>
<td>
<input type="email" value="<?php echo $_SESSION['checkout_info_array']['billing_email']; ?>" 
name="billing_email" />
</td>
</tr>

<tr>
<td>billing_phone</td>
<td>
<input type="text" value="<?php echo $_SESSION['checkout_info_array']['billing_phone']; ?>" 
name="billing_phone" />
</td>
</tr>

<tr>
<td>CARDNUM</td>
<td>
<!-- 4111111111111111 -->    
<input type="text" value="4111111111111111" autocomplete="off" name="CARDNUM"/>
</td>
</tr>

<tr>
<td>EXPMONTH</td>
<td>
<select name="EXPMONTH">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option> 
</select>
</td>
</tr>

<tr>
<td>EXPYEAR</td>
<td>
<select name="EXPYEAR">
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
<td>CVV2</td>
<td>
<input type="text" value="" autocomplete="off" name="CVV2"/>
</td>
</tr>

</table>
<input type="submit" >                    
<input type="hidden" name="CUSTID" value="<?php echo $customer_id; ?>"/>
<input name="sub_total" type="hidden" id='' value="<?php echo $sub_total; ?>" />
<input name="coupon_amount" type="hidden" id='' value="<?php echo $_SESSION['coupon_amount']; ?>" />
<input name="total_discount" type="hidden" id='' value="<?php echo $total_discount; ?>" />
<input name="total_tax" type="hidden" value="0" />
<input name="coupon_code" type="hidden" value="0" />
<input id="grand_total_form_input" type="hidden" name="grand_total" value="<?php echo $grand_total; ?>" />
<input name="USER7" type="hidden" id='' value='' />
<input name="USER8" type="hidden" id='' value='' />
<input name="USER9" type="hidden" id='' value='' />
<input name="USER10" type="hidden" id='' value='' />
</form>
</body>
</html>

<script>
	
	

</script>


