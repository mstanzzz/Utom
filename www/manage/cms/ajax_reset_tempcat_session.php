<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0; 

if($cat_id > 0){

	$_SESSION['temp_cats'] = array();

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name 
			FROM category 
			WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$_SESSION['temp_cat']['cat_id'] = $cat_id;	
		$_SESSION['temp_cat']['name'] = $object->name;	
	}
}

//print_r($_SESSION['temp_cats']);

?>