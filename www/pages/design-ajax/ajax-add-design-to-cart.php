<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}else/* MS */}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.shopping_cart.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.design_cart.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');

$cart = new ShoppingCart;
$design_cart = new DesignCart;		
$nav = new Nav;

$design_id = (isset($_GET['design_id'])) ? $_GET['design_id'] : 0;
$customer_id = (isset($_GET['customer_id'])) ? $_GET['customer_id'] : 0;


$api_test = 'test';


if ($design_id > 0){

	$url = $_SERVER['DOCUMENT_ROOT']."/API_me/data.php?xmlRequest=sendToCart&userID=".$customer_id."&fileID=".$design_id;
	$ch = curl_init($url);
	if(curl_exec($ch) === false)
	{
		$api_test = '<br /><br />Curl error: ' . curl_error($ch);
	}
	else
	{
		$api_test = '<br /><br />Operation completed without any errors';
	}
	curl_close($ch);
	
}else {

}


?>