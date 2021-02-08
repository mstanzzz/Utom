<?php
require_once("../../includes/config.php");
require_once("../../includes/db_connect.php"); 
require_once("../../includes/accessory_cart_functions.php");
require_once("../../includes/class.shopping_cart.php");
require_once("../../includes/class.shopping_cart_item.php");

$item_id = $_GET["item_id"];
$qty = $_GET["qty"];

//echo $qty;
//exit;

$db = $dbCustom->getDbConnect(CART_DATABASE);
$cart = new ShoppingCart;		

$cart->updateQty($item_id, $qty);

$cart->saveCart();

?>