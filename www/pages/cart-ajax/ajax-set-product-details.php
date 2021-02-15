<?php
require_once('../../includes/config.php');
require_once('../../includes/db_connect.php'); 
require_once('../../includes/accessory_cart_functions.php');
require_once('../../includes/class.shopping_cart_item.php');

$item = new ShoppingCartItem;

$item_id = (isset($_GET["item_id"])) ? $_GET["item_id"] : 0;

$item_array = $item->getItem($item_id);

$heading = '';

if($item_array['brand_name'] != '') $heading .= $item_array['brand_name'].' ';
$heading .= trim($item_array['name']);	
//$heading .= trim($item_array['short_description']).' ';	
$heading = stripslashes($heading);


$pic = get_details_pic($item_id);

$gallery = get_details_gallery($item_id);

$rev_array = get_details_tabs_and_review($item_id);

$returnData = json_encode(array(
			'overview_block'=>$rev_array['overview_block']
			,'tabs_block'=>$rev_array['tabs_block']
			,'heading'=>$heading
			,'pic'=>$pic
			,'gallery'=>$gallery
			));






echo $returnData;



?>