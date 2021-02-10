<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 

$cat_id = (isset($_GET['cat_id']))? $_GET['cat_id'] : 0; 

if($cat_id > 0){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name 
			FROM category 
			WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);			
	$object = $result->fetch_object();
	$indx = sizeof($_SESSION['temp_item_cats']);
	$_SESSION['temp_item_cats'][$indx]['cat_id'] = $cat_id;	
	$_SESSION['temp_item_cats'][$indx]['name'] = $object->name;	
}
?>