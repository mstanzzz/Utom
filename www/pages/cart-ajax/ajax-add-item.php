<?php
require_once("../../includes/config.php"); 
require_once("../../includes/class.shopping_cart.php"); 


$cart = new ShoppingCart;

$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
$qty = (isset($_GET['qty'])) ? $_GET['qty'] : 1;

$item_count = 0;

if ($item_id > 0){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$cart = new ShoppingCart;

	$test = $cart->addItem($item_id, $qty);

	$item_count += $cart->getItemCount();
	
	echo $item_count;	
}else{
	
	echo 0;
}

?>