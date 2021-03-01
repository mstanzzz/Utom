<?php 
$item_id = (isset($_GET['productId']))? $_GET['productId'] : 0;
if(!is_numeric($item_id)) $item_id = 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$item = new ShoppingCartItem;


$item_array = $item->getItem($item_id);

//print_r($item_array);
//exit;

?>
