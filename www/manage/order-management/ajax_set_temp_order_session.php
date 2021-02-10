<?php

$action = (isset($_GET['action']))?	$_GET['action'] : 'ao';

if($action == 'ao'){	

	if(isset($_GET['order_date'])) $_SESSION['temp_order_fields']['order_date'] = $_GET['order_date'];

	if(isset($_GET['shipping_name'])) $_SESSION['temp_order_fields']['shipping_name'] = $_GET['shipping_name'];
	if(isset($_GET['shipping_name_company'])) $_SESSION['temp_order_fields']['shipping_name_company'] = $_GET['shipping_name_company'];
	if(isset($_GET['shipping_address_one'])) $_SESSION['temp_order_fields']['shipping_address_one'] = $_GET['shipping_address_one'];
	if(isset($_GET['shipping_address_two'])) $_SESSION['temp_order_fields']['shipping_address_two'] = $_GET['shipping_address_two'];
	if(isset($_GET['shipping_city'])) $_SESSION['temp_order_fields']['shipping_city'] = $_GET['shipping_city'];
	if(isset($_GET['shipping_state'])) $_SESSION['temp_order_fields']['shipping_state'] = $_GET['shipping_state'];
	if(isset($_GET['shipping_zip'])) $_SESSION['temp_order_fields']['shipping_zip'] = $_GET['shipping_zip'];
	if(isset($_GET['shipping_country'])) $_SESSION['temp_order_fields']['shipping_country'] = $_GET['shipping_country'];
	if(isset($_GET['shipping_phone'])) $_SESSION['temp_order_fields']['shipping_phone'] = $_GET['shipping_phone'];
	if(isset($_GET['shipping_email'])) $_SESSION['temp_order_fields']['shipping_email'] = $_GET['shipping_email'];
	if(isset($_GET['billing_name'])) $_SESSION['temp_order_fields']['billing_name'] = $_GET['billing_name'];
	if(isset($_GET['billing_email'])) $_SESSION['temp_order_fields']['billing_email'] = $_GET['billing_email'];
	if(isset($_GET['billing_address_one'])) $_SESSION['temp_order_fields']['billing_address_one'] = $_GET['billing_address_one'];
	if(isset($_GET['billing_address_two'])) $_SESSION['temp_order_fields']['billing_address_two'] = $_GET['billing_address_two'];
	if(isset($_GET['billing_city'])) $_SESSION['temp_order_fields']['billing_city'] = $_GET['billing_city'];
	if(isset($_GET['billing_state'])) $_SESSION['temp_order_fields']['billing_state'] = $_GET['billing_state'];
	if(isset($_GET['billing_zip'])) $_SESSION['temp_order_fields']['billing_zip'] = $_GET['billing_zip'];
	if(isset($_GET['billing_country'])) $_SESSION['temp_order_fields']['billing_country'] = $_GET['billing_country'];
	if(isset($_GET['billing_phone'])) $_SESSION['temp_order_fields']['billing_phone'] = $_GET['billing_phone'];
	if(isset($_GET['in_house_product_descr'])) $_SESSION['temp_order_fields']['in_house_product_descr'] = $_GET['in_house_product_descr'];
	
	if(isset($_GET['customer_id'])) $_SESSION['temp_order_fields']['customer_id'] = $_GET['customer_id'];
	
	if(isset($_GET['sub_total'])) $_SESSION['temp_order_fields']['sub_total'] = $_GET['sub_total'];
	
	if(isset($_GET['shipping_cost'])) $_SESSION['temp_order_fields']['shipping_cost'] = $_GET['shipping_cost'];
	if(isset($_GET['tax_cost'])) $_SESSION['temp_order_fields']['tax_cost'] = $_GET['tax_cost'];
	
	echo $_SESSION['temp_order_fields']['customer_id'];
}



?>