<?
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root."/includes/config.php"); 

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