<?php
require_once('<?php echo SITEROOT; ?>includes/config.php');
require_once('<?php echo SITEROOT; ?>includes/db_connect.php'); 
require_once('<?php echo SITEROOT; ?>includes/accessory_cart_functions.php');
require_once('<?php echo SITEROOT; ?>includes/class.shopping_cart_item.php');

$item = new ShoppingCartItem;

$item_id = (isset($_GET["item_id"])) ? $_GET["item_id"] : 0;

$deviceType = (isset($_GET["deviceType"])) ? $_GET["deviceType"] : 3;

$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'thumb' : 'thumb') : 'small');

$block = '';

if($item_id > 0){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$gallery_img_array = array();
					
	$sql = "SELECT image.file_name
			FROM item_gallery, image
			WHERE item_gallery.img_id = image.img_id
			AND item_gallery.item_id = '".$item_id."'";
$result = $dbCustom->getResult($db,$sql);					
	if($result->num_rows > 0){
		$gallery_img_array[] = $item->getFileNameFromItemId($dbCustom,$item_id);		
		while($row = $result->fetch_object()){
			$gallery_img_array[] = $row->file_name;
		}
		$block .= "<ul class='product-image-thumbnails'>";
		foreach($gallery_img_array as $gallery_file_name){	
			
			
			$block .= "<li><a href='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$gallery_file_name."' 
						class='thumbnail-link image-switch-thumb'>
						<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$gallery_file_name."' 
						alt='".stripslashes($gallery_file_name)."' /></a></li>";


			
			
		}
		$block .= "</u>";
		$block .= "<div style='clear:both;'></div>";
	}
}

echo $block;



?>