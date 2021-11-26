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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
$attr_id = (isset($_GET['attr_id'])) ? $_GET['attr_id'] : 0;
$new_option = (isset($_GET['new_option'])) ? $_GET['new_option'] : 0;
$new_option = addslashes($new_option);
$ret_page = $_GET['ret_page'];
$db = $dbCustom->getDbConnect(CART_DATABASE);

if($action == "del_attr"){
	$block = "<form action='".$ret_page.".php?cat_id=".$cat_id."' method='post' enctype='multipart/form-data'>";
	$block .=  "Are you sure you want to delete this keyword?<br /><br />"; 
	$block .=  "<input type='hidden' name='attr_id' value='".$attr_id."'>";
	$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	
	$block .=  "<input name='del_keyword' type='submit' value='DELETE' />";
	$block .=  "</form>";
	echo $block;
}elseif($action == "add_attr"){
	$block = "<form action='".$ret_page.".php?cat_id=".$cat_id."' method='post' enctype='multipart/form-data'>";
	if(strrpos($ret_page,"edit")>-1){
		$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	
	}
	$block .=  "Attribute Name:<br /><input type='text' name='added_attribute' />";
	$block .=  "<br />First Option Name:<br /><input type='text' name='first_option' />";		
	$block .=  "<br /><input name='add_attribute' type='submit' value='Add' />";
	$block .=  "</form>";
	echo $block;
}else{
	$sql = sprintf("INSERT INTO opt (opt_name, attribute_id) VALUES ('%s','%u')", $new_option, $attr_id);
	$result = $dbCustom->getResult($db,$sql);

}

?>


