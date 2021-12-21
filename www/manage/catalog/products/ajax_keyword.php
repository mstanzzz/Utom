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
$kw_id = (isset($_GET['kw_id'])) ? $_GET['kw_id'] : 0;
$kw = (isset($_GET['kw'])) ? $_GET['kw'] : 0;
$ret_page = $_GET['ret_page'];

if($action == "del"){
	$block = "<form action='".$ret_page.".php' method='post' enctype='multipart/form-data'>";
	$block .=  "Are you sure you want to delete this keyword?<br /><br />"; 
	$block .=  "<input type='hidden' name='key_word' value='".$kw."'>";				
	$block .=  "<input type='hidden' name='key_words_id' value='".$kw_id."'>";
	$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	
	$block .=  "<input name='del_keyword' type='submit' value='DELETE' />";
	$block .=  "</form>";
	echo $block;
}
if($action == "add"){	
	$block = "<form action='".$ret_page.".php' method='post' enctype='multipart/form-data'>";
	if(strrpos($ret_page,"edit")>-1){
	$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	
	}
	$block .=  "<input type='text' name='word' />";
	$block .=  "<input name='add_keyword' type='submit' value='Add' />";
	$block .=  "</form>";
	echo $block;
}
?>


