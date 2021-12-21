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
$item_id = (isset($_GET['item_id']))? $_GET['item_id'] : 0; 
$parent_item_id = (isset($_GET['parent_item_id']))? $_GET['parent_item_id'] : 0; 
$action = $_GET['action'];
$item_gallery_id  = $_GET['item_gallery_id'];
$ret_page = $_GET['ret_page'];

if($action == "del"){
	$block = "<form action='".$ret_page.".php?cat_id=".$cat_id."' method='post' enctype='multipart/form-data'>";
	$block .=  "Are you sure you want to delete this gallery image?<br /><br />"; 
	$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	
	$block .=  "<input type='hidden' name='parent_item_id' value='".$parent_item_id."'>";	
	$block .=  "<input type='hidden' name='item_gallery_id' value='".$item_gallery_id."'>";	
	$block .=  "<input name='del_from_gallery' type='submit' value='DELETE' />";
	$block .=  "</form>";
	echo $block;	
}
if($action == "add"){
	
	
}
?>

