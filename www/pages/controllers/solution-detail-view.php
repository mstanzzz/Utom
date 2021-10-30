<?php

$profile_item_id = isset($_GET['productId'])? $_GET['productId'] : 0;

$item_id = 0;
$main_attr_id = 0;		
$name = ''; 
$price_flat = 0;
$price_wholesale = 0;
$percent_markup = 0;
$price = 0;			
$percent_off = 0;
$amount_off = 0;
$call_for_pricing = 0;
$is_new_product = 0;
$is_promo_product = 0; 
$allow_back_order = 0;
$vend_man_id = 0; 
$weight = 0;
$shipping_flat_charge = 0;
$is_taxable = 0;
$prod_number = 0;
$internal_prod_number = '';			
$skill_level_id = 0;
$sku = '';
$upc = '';			
$short_description = '';
$description = '';
$back_order_message = '';
$in_stock_message = '';
$additional_information = '';
$img_id = 0;
$is_closet = 0;
$date_active = '';
$date_inactive = '';
$show_in_cart = 0;
$show_in_showroom = 0;
$seo_url = ''; 
$img_alt_text = ''; 
$seo_list = '';
$key_words = ''; 				
$brand_id = 0;
$brand_name = '';
$file_name = '';
$canonical_part = $_SERVER['DOCUMENT_ROOT'];
$hide_id_from_url = 0;
$parent_item_id = 0;
$is_kit = 0;
$show_doc_tab = 1;
$show_meas_form_tab = 1;
$show_videos = 0;
$show_associated_kits = 1;
$show_specs_tab = 1;
$additional_information = '';
$is_free_shipping = '';



$profile_item_id =  (isset($_GET['productId'])) ? $_GET['productId'] : 0;
//echo "<br />";

$db = $dbCustom->getDbConnect(CART_DATABASE);


$item_array = $item->getItem($dbCustom,0,$profile_item_id);

//print_r($item_array);


$item_id = $item_array['item_id'];			
$profile_item_id = $item_array['profile_item_id'];		


//echo "item_id: ".$item_id;
//echo "<br />";
//echo "profile_item_id: ".$profile_item_id;
//echo "<br />";
//exit;


$name = stripslashes($item_array['name']); 
$main_attr_id = $item_array['main_attr_id'];
$price_flat = $item_array['price_flat'];
$price_wholesale = $item_array['price_wholesale'];
$percent_markup = $item_array['percent_markup'];
$price = $item_array['price'];			
$percent_off = $item_array['percent_off'];
$amount_off = $item_array['amount_off'];
$call_for_pricing = $item_array['call_for_pricing'];
$is_new_product = $item_array['is_new_product'];
$is_promo_product = $item_array['is_promo_product']; 
$allow_back_order = $item_array['allow_back_order'];
$vend_man_id = $item_array['vend_man_id']; 
$weight = $item_array['weight'];
$shipping_flat_charge = $item_array['item_id'];
$is_taxable = $item_array['is_taxable'];
$prod_number = $item_array['prod_number'];
$internal_prod_number = $item_array['internal_prod_number'];			
$skill_level_id = $item_array['skill_level_id'];
$sku = $item_array['sku'];
$upc = $item_array['upc'];			
$short_description = stripslashes($item_array['short_description']);
$description = stripslashes($item_array['description']);
$back_order_message = stripslashes($item_array['back_order_message']);
$in_stock_message = stripslashes($item_array['in_stock_message']);
$additional_information = stripslashes($item_array['additional_information']);
$img_id = $item_array['img_id'];
$is_closet = $item_array['is_closet'];
$date_active = $item_array['date_active'];
$date_inactive = $item_array['date_inactive'];
$show_in_cart = $item_array['show_in_cart'];
$show_in_showroom = $item_array['show_in_showroom'];
$seo_url = stripslashes($item_array['seo_url']); 
$img_alt_text = stripslashes($item_array['img_alt_text']); 
$seo_list = stripslashes($item_array['seo_list']);
$key_words = stripslashes($item_array['key_words']); 				
$brand_id = $item_array['brand_id'];
$brand_name = stripslashes($item_array['brand_name']);
$file_name = $item_array['file_name'];
$canonical_part = $item_array['canonical_part'];
$hide_id_from_url = $item_array['hide_id_from_url'];
$parent_item_id = $item_array['parent_item_id'];
$is_kit = $item_array['is_kit'];
$show_doc_tab = $item_array['show_doc_tab'];
$show_meas_form_tab = $item_array['show_meas_form_tab'];
$show_videos = $item_array['show_videos'];
$show_associated_kits = $item_array['show_associated_kits'];
$show_specs_tab = $item_array['show_specs_tab'];
$is_free_shipping = $item_array['is_free_shipping'];




//echo "<a href='#' id='add_".$item_array['item_id']."' 
//onClick=\"add_item('".$item_array['item_id']."')\">Add To Cart</a>";
?>



