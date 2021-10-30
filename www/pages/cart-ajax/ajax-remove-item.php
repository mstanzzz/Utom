<?php
require_once("<?php echo SITEROOT; ?>includes/config.php");
require_once("<?php echo SITEROOT; ?>includes/db_connect.php"); 
//require_once("<?php echo SITEROOT; ?>includes/accessory_cart_functions.php");
require_once("<?php echo SITEROOT; ?>includes/class.shopping_cart.php");
//require_once("<?php echo SITEROOT; ?>includes/class.shopping_cart_item.php");
//require_once("<?php echo SITEROOT; ?>includes/class.shipping.php");


$item_id = $_GET["item_id"];

//echo $item_id; 

$cart = new ShoppingCart;		

$cart->removeItem($dbCustom,$item_id);

/*
$shipping = new Shipping;
if($shipping->getShipType() == 'carrier'){
	$weight = $cart->getCartTotalWeight();
	$tmp = $shipping->resetCarrierRates($weight);
}
*/

//$cart->saveCart($dbCustom);

//echo "111";

?>