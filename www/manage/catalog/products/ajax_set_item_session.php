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

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT attribute_id
		FROM  attribute
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
		ORDER BY attribute_id";	
$res = $dbCustom->getResult($db,$sql);
while($attr_row = $res->fetch_object()) {
	if(isset($_GET["attr_".$attr_row->attribute_id])){
		$_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id] = $_GET["attr_".$attr_row->attribute_id];
	}
}
$opt_array = (isset($_GET['opt_list']))? explode("|",$_GET['opt_list']) : array(); 
	
if(sizeof($opt_array) == 1){
	if($opt_array[0] == ''){
		$opt_array = array();
	}
}

$i = 0;
$_SESSION['temp_attr_opt_ids'] = array();
foreach($opt_array as $opt_v){
	$_SESSION['temp_attr_opt_ids'][$i] = $opt_v;
	$i++;
}

	if(isset($_GET['style_id'])) $_SESSION['temp_item_fields']['style_id'] = $_GET['style_id'];
	if(isset($_GET['lead_time_id'])) $_SESSION['temp_item_fields']['lead_time_id'] = $_GET['lead_time_id'];
	if(isset($_GET['skill_level_id'])) $_SESSION['temp_item_fields']['skill_level_id'] = $_GET['skill_level_id'];
	if(isset($_GET['type_id'])) $_SESSION['temp_item_fields']['type_id'] = $_GET['type_id'];
	if(isset($_GET['date_active'])) $_SESSION['temp_item_fields']['date_active'] = $_GET['date_active'];
	if(isset($_GET['date_inactive'])) $_SESSION['temp_item_fields']['date_inactive'] = $_GET['date_inactive'];
	if(isset($_GET['name'])) $_SESSION['temp_item_fields']['name'] = $_GET['name'];
	if(isset($_GET['main_attr_id'])) $_SESSION['temp_item_fields']['main_attr_id'] = $_GET['main_attr_id'];
	if(isset($_GET['price_flat'])) $_SESSION['temp_item_fields']['price_flat'] = $_GET['price_flat'];
	if(isset($_GET['price_wholesale'])) $_SESSION['temp_item_fields']['price_wholesale'] = $_GET['price_wholesale'];
	if(isset($_GET['percent_markup'])) $_SESSION['temp_item_fields']['percent_markup'] = $_GET['percent_markup'];
	if(isset($_GET['percent_off'])) $_SESSION['temp_item_fields']['percent_off'] = $_GET['percent_off'];
	if(isset($_GET['amount_off'])) $_SESSION['temp_item_fields']['amount_off'] = $_GET['amount_off'];
	if(isset($_GET['prod_number'])) $_SESSION['temp_item_fields']['prod_number'] = $_GET['prod_number'];
	if(isset($_GET['internal_prod_number'])) $_SESSION['temp_item_fields']['internal_prod_number'] = $_GET['internal_prod_number'];
	if(isset($_GET['brand_id'])) $_SESSION['temp_item_fields']['brand_id'] = $_GET['brand_id'];
	if(isset($_GET['sku'])) $_SESSION['temp_item_fields']['sku'] = $_GET['sku'];
	if(isset($_GET['upc'])) $_SESSION['temp_item_fields']['upc'] = $_GET['upc'];
	if(isset($_GET['short_description'])) $_SESSION['temp_item_fields']['short_description'] = $_GET['short_description'];
	if(isset($_GET['description'])) $_SESSION['temp_item_fields']['description'] = $_GET['description'];
	if(isset($_GET['back_order_message'])) $_SESSION['temp_item_fields']['back_order_message'] = $_GET['back_order_message'];
	if(isset($_GET['in_stock_message'])) $_SESSION['temp_item_fields']['in_stock_message'] = $_GET['in_stock_message'];
	if(isset($_GET['additional_information'])) $_SESSION['temp_item_fields']['additional_information'] = $_GET['additional_information'];
	if(isset($_GET['ship_port_id'])) $_SESSION['temp_item_fields']['ship_port_id'] = $_GET['ship_port_id'];
	if(isset($_GET['return_to_id'])) $_SESSION['temp_item_fields']['return_to_id'] = $_GET['return_to_id'];
	if(isset($_GET['is_taxable'])) $_SESSION['temp_item_fields']['is_taxable'] = $_GET['is_taxable'];
	if(isset($_GET['call_for_pricing'])) $_SESSION['temp_item_fields']['call_for_pricing'] = $_GET['call_for_pricing'];
	if(isset($_GET['is_new_product'])) $_SESSION['temp_item_fields']['is_new_product'] = $_GET['is_new_product'];
	if(isset($_GET['is_promo_product'])) $_SESSION['temp_item_fields']['is_promo_product'] = $_GET['is_promo_product'];
	if(isset($_GET['allow_back_order'])) $_SESSION['temp_item_fields']['allow_back_order'] = $_GET['allow_back_order'];	
	if(isset($_GET['is_drop_shipped'])) $_SESSION['temp_item_fields']['is_drop_shipped'] = $_GET['is_drop_shipped'];
	if(isset($_GET['is_closet'])) $_SESSION['temp_item_fields']['is_closet'] = $_GET['is_closet'];
	if(isset($_GET['show_in_cart'])) $_SESSION['temp_item_fields']['show_in_cart'] = $_GET['show_in_cart'];
	if(isset($_GET['show_in_showroom'])) $_SESSION['temp_item_fields']['show_in_showroom'] = $_GET['show_in_showroom'];
	if(isset($_GET['shipping_flat_charge'])) $_SESSION['temp_item_fields']['shipping_flat_charge'] = $_GET['shipping_flat_charge'];
	if(isset($_GET['weight'])) $_SESSION['temp_item_fields']['weight'] = $_GET['weight'];
	if(isset($_GET['keywords'])) $_SESSION['temp_item_fields']['keywords'] = $_GET['keywords'];
	if(isset($_GET['img_alt_text'])) $_SESSION['temp_item_fields']['img_alt_text'] = $_GET['img_alt_text'];
	if(isset($_GET['show_in_tool'])) $_SESSION['temp_item_fields']['show_in_tool'] = $_GET['show_in_tool'];
	if(isset($_GET['hide_id_from_url'])) $_SESSION['temp_item_fields']['hide_id_from_url'] = $_GET['hide_id_from_url'];
	if(isset($_GET['doc_area_text'])) $_SESSION['temp_item_fields']['doc_area_text'] = $_GET['doc_area_text'];
	if(isset($_GET['is_kit'])) $_SESSION['temp_item_fields']['is_kit'] = $_GET['is_kit'];
	if(isset($_GET['is_free_shipping'])) $_SESSION['temp_item_fields']['is_free_shipping'] = $_GET['is_free_shipping'];
	if(isset($_GET['show_doc_tab'])) $_SESSION['temp_item_fields']['show_doc_tab'] = $_GET['show_doc_tab'];
	if(isset($_GET['show_meas_form_tab'])) $_SESSION['temp_item_fields']['show_meas_form_tab'] = $_GET['show_meas_form_tab'];
	if(isset($_GET['show_atc_btn_or_cfp'])) $_SESSION['temp_item_fields']['show_atc_btn_or_cfp'] = $_GET['show_atc_btn_or_cfp'];
	if(isset($_GET['show_start_design_btn'])) $_SESSION['temp_item_fields']['show_start_design_btn'] = $_GET['show_start_design_btn'];
	if(isset($_GET['show_design_request_btn'])) $_SESSION['temp_item_fields']['show_design_request_btn'] = $_GET['show_design_request_btn'];
	if(isset($_GET['show_videos'])) $_SESSION['temp_item_fields']['show_videos'] = $_GET['show_videos'];
	if(isset($_GET['show_associated_kits'])) $_SESSION['temp_item_fields']['show_associated_kits'] = $_GET['show_associated_kits'];
	if(isset($_GET['show_specs_tab'])) $_SESSION['temp_item_fields']['show_specs_tab'] = $_GET['show_specs_tab'];
		
	

?>


