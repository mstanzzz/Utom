<?php
// paypal  
//mark-facilitator@nazardesigns.com
//Password:  KBL3LHE4TP2VBLGK
//Signature: ACkmuv948uG4hsdfVUskV7bq0aB9AG-FFrmG.aVbzwcFBumX5UNgWlpg
//app = ctg
//mark-facilitator@nazardesigns.com
//Client ID = AZ1C9Zvtc3E_4wgg7f7EAAVunSDbUf5MI2FZmTaOFcfT0X-46LuIC77skSm7qZK-H2Zw8MpviRKI4Sxg
//Secret = ENXKrckkLL7k_ieK2_jYbBWYTVUYrn2FdK0Waql8TyZmzixp6v4j0wMU7wIJ1J7BbEppxePhTv5jMl9_
//mark-buyer@nazardesigns.com


$payment_method_nonce = isset($_POST['payment_method_nonce'])? $_POST['payment_method_nonce'] : '';

// NEW VERSION
require_once("includes/braintree/lib/autoload.php");


$_SESSION['no_order_refreash'] = 1;


//YYYY-MM-DD HH:MM:SS
$db_now = date("Y-m-d h:i:s");
$ts = time();

$shipping_name_first = (isset($_POST['shipping_name_first']))? trim(addslashes($_POST['shipping_name_first'])) : '';
$shipping_name_last = (isset($_POST['shipping_name_last']))? trim(addslashes($_POST['shipping_name_last'])) : '';
$shipping_name = $shipping_name_first.' '.$shipping_name_last;
$shipping_name_company = '';  
$shipping_address_one = (isset($_POST['shipping_address_one']))? trim(addslashes($_POST['shipping_address_one'])) : '';  
$shipping_address_two = (isset($_POST['shipping_address_two']))? trim(addslashes($_POST['shipping_address_two'])) : '';   
$shipping_city = (isset($_POST['shipping_city']))? trim(addslashes($_POST['shipping_city'])) : '';  
$shipping_state = (isset($_POST['shipping_state']))? trim(addslashes($_POST['shipping_state'])) : '';  
$shipping_zip = (isset($_POST['shipping_zip']))? trim(addslashes($_POST['shipping_zip'])) : '';  
$shipping_country = (isset($_POST['shipping_country']))? trim(addslashes($_POST['shipping_country'])) : '';  
$shipping_phone = (isset($_POST['shipping_phone']))? trim(addslashes($_POST['shipping_phone'])) : '';
$shipping_email = (isset($_POST['shipping_email']))? trim($_POST['shipping_email']) : '';
$billing_email = (isset($_POST['billing_email']))? trim($_POST['billing_email']) : '';    

if($billing_email == ''){
	$billing_email = $shipping_email;
}

if($shipping_email == ''){
	$shipping_email = $billing_email;
}

$customer_id = $_POST['CUSTID'];

if($customer_id == 0){
	$customer_id = $lgn->getUserIdByEmail($billing_email);
}

$billing_name_first = (isset($_POST['billing_name_first']))? trim(addslashes($_POST['billing_name_first'])) : '';
$billing_name_last = (isset($_POST['billing_name_last']))? trim(addslashes($_POST['billing_name_last'])) : '';
$billing_name = $billing_name_first.' '.$billing_name_last;
$billing_address_one = (isset($_POST['billing_address_one']))? trim(addslashes($_POST['billing_address_one'])) : '';
$billing_address_two = (isset($_POST['billing_address_two']))? trim(addslashes($_POST['billing_address_two'])) : '';
$billing_city = (isset($_POST['billing_city']))? trim(addslashes($_POST['billing_city'])) : '';
$billing_state = (isset($_POST['billing_state']))? trim(addslashes($_POST['billing_state'])) : '';
$billing_zip = (isset($_POST['billing_zip']))? trim(addslashes($_POST['billing_zip'])) : '';
$billing_country = (isset($_POST['billing_country']))? trim(addslashes($_POST['billing_country'])) : '';
$billing_phone = (isset($_POST['billing_phone']))? trim(addslashes($_POST['billing_phone'])) : '';

echo "<br /> billing_name_first ".$billing_name_first;
echo "<br /> billing_name_last ".$billing_name_last;
echo "<br /> billing_email ".$billing_email;
echo "<br /> billing_address_one ".$billing_address_one;
echo "<br /> billing_address_two ".$billing_address_two;
echo "<br /> billing_city ".$billing_city;
echo "<br /> billing_state ".$billing_state;
echo "<br /> billing_country ".$billing_country;
echo "<br /> billing_zip ".$billing_zip;
echo "<br /> billing_email ".$billing_email;
echo "<br /> billing_phone ".$billing_phone;
echo "<br /> shipping_name_first ".$shipping_name_first;
echo "<br /> shipping_name_last ".$shipping_name_last;
echo "<br /> shipping_address_one ".$shipping_address_one;
echo "<br /> shipping_address_two ".$shipping_address_two;
echo "<br /> shipping_city ".$shipping_city;
echo "<br /> shipping_state ".$shipping_state;
echo "<br /> shipping_zip ".$shipping_zip;
echo "<br /> shipping_country ".$shipping_country;
echo "<br /> shipping_phone ".$shipping_phone;
echo "<br /> shipping_email ".$shipping_email;


$cc_last_4 = '';
$cc_last_3 = '';

$card_auth_code = trim($_POST['CVV2']);  
$card_type_id = 0;  
$card_exp_date = '';   
$tax_cost = 0; 

$sub_total = str_replace(',', '', $_POST['sub_total']);
$coupon_amount = str_replace(',', '', $_POST['coupon_amount']);
$total_discount = str_replace(',', '', $_POST['total_discount']);
$total = str_replace(',', '', $_POST['grand_total']);

$coupon_code = $_POST['coupon_code']; 

$purchase_order_number = ''; 

$tax_cost = 0; 
	


$db = $dbCustom->getDbConnect(CART_DATABASE);
	

?>




