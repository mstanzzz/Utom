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
require_once($real_root.'/includes/class.shopping_cart.php'); 

$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
$qty = (isset($_GET['qty'])) ? $_GET['qty'] : 1;

$item_count = 0;


if ($item_id > 0){
	$cart = new ShoppingCart($dbCustom);
	
	$test = $cart->addItem($dbCustom,$item_id, $qty);
	$item_count += $cart->getItemCount();
	echo $item_count;	
}else{
	echo 0;
}

?>