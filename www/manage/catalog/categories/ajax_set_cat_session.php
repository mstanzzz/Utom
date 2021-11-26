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

require_once($real_root."/includes/config.php"); 

$action = (isset($_GET['action']))?	$_GET['action'] : 1;

//echo $action;

// top cats 
/*
if($action == 1){

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	if(isset($_GET['name'])) $_SESSION["temp_cat_fields"]['name'] = $_GET['name'];
	if(isset($_GET['tool_tip'])) $_SESSION["temp_cat_fields"]['tool_tip'] = $_GET['tool_tip'];
	if(isset($_GET['show_on_home_page'])) $_SESSION["temp_cat_fields"]['show_on_home_page'] = $_GET['show_on_home_page'];

	
	$_SESSION['temp_attr_ids'] = (isset($_GET['attr_str']))? explode("|",$_GET['attr_str']) : array(); 
	
	if(sizeof($_SESSION['temp_attr_ids']) == 1){
		if($_SESSION['temp_attr_ids'][0] == ''){
			$_SESSION['temp_attr_ids'] = array();
		}
	}
}
*/

// sub cats
//if($action == 2){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	if(isset($_GET['name'])) $_SESSION["temp_cat_fields"]['name'] = $_GET['name'];
	if(isset($_GET['short_name'])) $_SESSION["temp_cat_fields"]['short_name'] = $_GET['short_name'];
	
	if(isset($_GET['tool_tip'])) $_SESSION["temp_cat_fields"]['tool_tip'] = $_GET['tool_tip'];
	if(isset($_GET['description'])) $_SESSION["temp_cat_fields"]['description'] = $_GET['description'];

	if(isset($_GET['img_alt_text'])) $_SESSION["temp_cat_fields"]['img_alt_text'] = $_GET['img_alt_text'];
	if(isset($_GET['key_words'])) $_SESSION["temp_cat_fields"]['key_words'] = $_GET['key_words'];

	if(isset($_GET['show_on_home_page'])) $_SESSION["temp_cat_fields"]['show_on_home_page'] = $_GET['show_on_home_page'];
	if(isset($_GET['show_in_cart'])) $_SESSION["temp_cat_fields"]['show_in_cart'] = $_GET['show_in_cart'];
	if(isset($_GET['show_in_showroom'])) $_SESSION["temp_cat_fields"]['show_in_showroom'] = $_GET['show_in_showroom'];
	
	if(isset($_GET['showroom_item_display_priority'])) $_SESSION["temp_cat_fields"]['showroom_item_display_priority'] = $_GET['showroom_item_display_priority'];
	
	
	
	
	$_SESSION['temp_attr_ids'] = (isset($_GET['attr_str']))? explode("|",$_GET['attr_str']) : array(); 
	
	if(sizeof($_SESSION['temp_attr_ids']) == 1){
		if($_SESSION['temp_attr_ids'][0] == ''){
			$_SESSION['temp_attr_ids'] = array();
		}
	}


	$cat_id_array = (isset($_GET['cat_str']))? explode("|",$_GET['cat_str']) : array(); 
	if(sizeof($cat_id_array) > 0){
	
		$_SESSION['temp_cats'] = array();
		
		$i = 0;
		foreach($cat_id_array as $cat_id){
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT name 
					FROM category 
					WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){		
				$object = $result->fetch_object();
				$_SESSION['temp_cats'][$i]['cat_id'] = $cat_id;	
				$_SESSION['temp_cats'][$i]['name'] = $object->name;	
				$i++;
			}		
		}
	}
	
//}


echo "name:  ".$_SESSION["temp_cat_fields"]['name'];



?>


