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
$item_id = $_GET['item_id']; 
$action = $_GET['action'];

$ret_page = $_GET['ret_page'];

$media_id  = $_GET['media_id'];

$db = $dbCustom->getDbConnect(CART_DATABASE);

if($action == "del"){


//echo "igi".$item_gallery_id;


			$block = "<form action='".$ret_page.".php?cat_id=".$cat_id."' method='post' enctype='multipart/form-data'>";
			$block .=  "Are you sure you want to delete this media or document?<br /><br />"; 


			$block .=  "<input type='hidden' name='item_id' value='".$item_id."'>";	

			$block .=  "<input type='hidden' name='media_id' value='".$media_id."'>";	
			
    		
			$block .=  "<input name='del_from_media' type='submit' value='DELETE' />";
			$block .=  "</form>";
			echo $block;
	
}
if($action == "add"){
	
	
}
?>

