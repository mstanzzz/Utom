<?php
require_once("../../includes/config.php");
require_once("../../includes/db_connect.php"); 
require_once("../../includes/accessory_cart_functions.php");
require_once('../../includes/class.shopping_cart.php');
require_once('../../includes/class.shipping.php');
require_once('../../includes/class.module.php');
require_once('../../includes/class.nav.php');

$shipping = new Shipping;
$module = new Module;
$cart = new ShoppingCart;
$nav = new Nav;

$price = 0;
$call_for_pricing = 0;
$weight = 0;

$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;

$top_is_kit = (isset($_GET['top_is_kit'])) ? $_GET['top_is_kit'] : 0;

$top_item_id = (isset($_GET['top_item_id'])) ? $_GET['top_item_id'] : 0;

$show_associated_kits = (isset($_GET['show_associated_kits'])) ? $_GET['show_associated_kits'] : 0;
$show_videos = (isset($_GET['show_videos'])) ? $_GET['show_videos'] : 0;

//$deviceType = (isset($_GET['deviceType'])) ? $_GET['deviceType'] : 3;

//echo $item_id;

if($show_associated_kits){
	$assoc_items_array = $cart->getKitAssocItems($item_id);
	if(count($assoc_items_array) > 0){
		$show_kit_assoc_items = 1;
		$show_videos = 0;
	}
}

if($show_videos){
	$videos_array = $cart->getVideos($item_id);
	
	
	
	
	if(count($videos_array) > 0){
		$show_videos = 1;
		$show_kit_assoc_items = 0;
	}
}	

if($show_videos > 0){
	
	$video_placeholder_size = '';
			
			$block = '';

			foreach($videos_array as $value){
			
				$block .= "<div class='assoc_item_box'>";
				$block .= "<a onClick='swap_video(\"".$value['youtube_id']."\")'"; 
				$block .= "onClick='ga(\"send\", \"event\", \"Thumbnail Video Placeholder\", \"click\", \"Video Play\");'>";
				$block .= "<img ".$video_placeholder_size." src='http://img.youtube.com/vi/".$value['youtube_id']."/0.jpg'>";
				
				
				$block .= "<strong>".stripslashes($value['title'])."<strng>";
				$block .= "<br /><br />";
				$block .= "<div style='font-size:12px;'>".stripslashes($value['description'])."</div>";
				
				$block .= "</a>";
				$block .="</div>";
			}
			
			$block .= "<div style='clear:both;'></div>";
			echo $block;		
	
}

	
		
if($show_kit_assoc_items > 0){

	$imgdir = 'small';	

	$block = '';
			
	$block .= "<div class='list_head'>Select your custom closet kit options:</div>";
			
	$i = 0;
			
	foreach($assoc_items_array as $value){
			
				
		$block .= "<div class='assoc_item_box'>";
				
		
		if($value['show_in_cart']){
			$brand_name = getBrandName($value['brand_id']);
			$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], $brand_name, 'shop');
		}else{
			$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], '', 'showroom');
		}

		$details_link = "<a href='".$url_str."'>";
							
				
		$block .="<span class='product-image'>".$details_link;				
		$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$value["file_name"]."' 
					 alt='".stripslashes($value['img_alt_text'])."'/></a></span>";
								


		$block .="<span class='product_name'>"; //add this to css. Make font smaller and break text into multiple lines to prevent it intruding on price
		$block .="<h3>".$details_link.stripslashes($value['name'])."</a></h3>";
		$block .="</span>";


		$block .="<h5>".$details_link."(Product Id: ".sprintf('%06d',$value['profile_item_id']).")</a></h5>";

				
				
				
		if($value['call_for_pricing'] || $value['price'] <= 0){
			$block .="<div class='product-price'>Call For Price</div>";
		}else{
			$block .="<div class='product-price'><strong>$".number_format($value['price'],2)."</strong> per ea.</div>";						
		}

		if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
			if(!($shipping->getShipType() == 'carrier' && $value['weight'] == 0)) {
				if(!$value['call_for_pricing'] && $value['price'] > 0){
					$block .="<span class='qty'>QTY:</span><span><input id='qty".$value['item_id']."' type='text' name='qtys'  value='1' class='product-qty' /></span>";										
					$block .="<span><a class='btn btn-success add-to-cart' id='add_".$value['item_id']."' onClick=\"add_assoc_item('".$value['item_id']."')\">Add To Cart</a></span>";
					$block .="<div style='clear:both;'></div>";
				}
			}						
		}
				
				
				
		$block .="</div>";
	}
			
	echo $block;	
	
	
}
	
	
			
?>		
