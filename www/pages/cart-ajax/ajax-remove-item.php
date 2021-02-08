<?php
require_once("../../includes/config.php");
require_once("../../includes/db_connect.php"); 
//require_once("../../includes/accessory_cart_functions.php");
require_once("../../includes/class.shopping_cart.php");
//require_once("../../includes/class.shopping_cart_item.php");
//require_once("../../includes/class.shipping.php");


$item_id = $_GET["item_id"];

//echo $item_id; 

$cart = new ShoppingCart;		

$cart->removeItem($item_id);

/*
$shipping = new Shipping;
if($shipping->getShipType() == 'carrier'){
	$weight = $cart->getCartTotalWeight();
	$tmp = $shipping->resetCarrierRates($weight);
}
*/

//$cart->saveCart();

//echo "111";

?>