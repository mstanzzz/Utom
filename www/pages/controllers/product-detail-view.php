<?php 

$ts = time();

$item_id = (isset($_GET['productId']))? $_GET['productId'] : 0;
if(!is_numeric($item_id)) $item_id = 0;

$item = new ShoppingCartItem;
$item_array = $item->getItem($dbCustom,$item_id, 0);

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
$prod_basic_info = "Product Id: ".$item_id." / SKU #: ".$sku." / Brand: ".$brand_name;


$gallery_imgs = array();
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT image.img_id
			,image.file_name
		FROM item_gallery, image
		WHERE item_gallery.img_id = image.img_id
		AND item_gallery.item_id >0";
//AND item_id = '".$item_id."'";		
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()){
	$gallery_imgs[$i]['img_id'] = $row->img_id;
	$gallery_imgs[$i]['file_name'] = $row->file_name;
	$i++;
}


/*
foreach($gallery_imgs as $val){
echo "<div>";
echo "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$val['file_name']."' alt='' class='img-fluid prod-detail__nav-img'>";
echo "</div>";
}

exit;
*/



?>
