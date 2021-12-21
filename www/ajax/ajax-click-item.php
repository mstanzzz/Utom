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

$item_id = isset($_GET['item_id'])? $_GET['item_id'] : 0;
$c=0;
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT click_count
		FROM item
		WHERE item_id = '".$item_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows>0){
	$object = $result->fetch_object();
	$c = $object->click_count+1;

	$sql = "UPDATE item
		SET click_count = '".$c."'
		WHERE item_id = '".$item_id."'";
	$res = $dbCustom->getResult($db,$sql);

}


echo $c;

					
?>
