<?php

class ShoppingCartItem {


	function getItem($item_id, $profile_item_id = 0) {
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		if(!is_numeric($item_id)) $item_id = 0;
		if(!is_numeric($profile_item_id)) $profile_item_id = 0;
		
		if($profile_item_id > 0){
		
			$sql = "SELECT *
				FROM item
				WHERE profile_item_id = '".$profile_item_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";		
		
		}else{
			$sql = "SELECT *
				FROM item
				WHERE item_id = '".$item_id."'";
		
		}
		
		$result = $dbCustom->getResult($db,$sql);		
		
		if($result->num_rows > 0){
				
			$object = $result->fetch_object();
		
			$ret['item_id'] = $object->item_id;
			$ret['main_attr_id'] = $object->main_attr_id;
			$ret['profile_item_id'] = $object->profile_item_id;
		
			$ret['name'] = $object->name; 
			$ret['price_flat'] = $object->price_flat;
			$ret['price_wholesale'] = $object->price_wholesale;
			$ret['percent_markup'] = $object->percent_markup;
			
			if($object->price_flat > 0){
				$price = $object->price_flat;	
			}elseif($object->price_wholesale > 0){
				$price = $object->price_wholesale + $object->percent_markup; 
			}else{
				$price = 0;	
			}
			
			$ret['price'] = $price;

					
			$ret['percent_off'] = $object->percent_off;
			$ret['amount_off'] = $object->amount_off;
			$ret['call_for_pricing'] = $object->call_for_pricing;
			$ret['is_new_product'] = $object->is_new_product;
			$ret['is_promo_product'] = $object->is_promo_product; 
			$ret['allow_back_order'] = $object->allow_back_order;
			$ret['vend_man_id'] = $object->vend_man_id; 
			$ret['weight'] = $object->weight;
			$ret['shipping_flat_charge'] = $object->shipping_flat_charge;
			
			//$ret['finish'] = $object->finish;
			//$ret['height'] = $object->height;
			//$ret['width'] = $object->width;
			$ret['is_taxable'] = $object->is_taxable;
			$ret['prod_number'] = $object->prod_number;
			$ret['internal_prod_number'] = ($object->internal_prod_number != '') ? $object->internal_prod_number : '';
			
			
			
			$ret['sku'] = $object->sku;
			$ret['upc'] = $object->upc;
			$ret['type_id'] = $object->type_id;
			$ret['style_id'] = $object->style_id;
			$ret['lead_time_id'] = $object->lead_time_id;
			$ret['skill_level_id'] = $object->skill_level_id;
			
			
			
			$ret['short_description'] = $object->short_description;
			$ret['description'] = $object->description;
			$ret['back_order_message'] = $object->back_order_message;
			$ret['in_stock_message'] = $object->in_stock_message;
			$ret['additional_information'] = $object->additional_information;
			$ret['img_id'] = $object->img_id;
			$ret['is_closet'] = $object->is_closet;
					
			$ret['date_active'] = $object->date_active;
			$ret['date_inactive'] = $object->date_inactive;
		
			$ret['show_in_cart'] = $object->show_in_cart;
			$ret['show_in_showroom'] = $object->show_in_showroom;

			$ret['seo_url'] = $object->seo_url; 
			$ret['img_alt_text'] = $object->img_alt_text; 
			
			$ret['seo_list'] = $object->seo_list;

			$ret['key_words'] = $object->key_words; 
			
			$ret['brand_name'] = $this->getBrandNameFromBrandId($object->brand_id);

			$ret['file_name'] = $this->getFileNameFromImgId($object->img_id);
			
			$ret['canonical_part'] = $object->canonical_part; 
			
			$ret['hide_id_from_url'] = $object->hide_id_from_url;
			
			$ret['parent_item_id'] = $object->parent_item_id;
			
			$ret['brand_id'] = $object->brand_id;
			
			$ret['doc_area_text'] = $object->doc_area_text;
			
			$ret['is_kit'] = $object->is_kit;

			$ret['show_doc_tab'] = $object->show_doc_tab;
			$ret['show_meas_form_tab'] = $object->show_meas_form_tab;
			$ret['show_atc_btn_or_cfp'] = $object->show_atc_btn_or_cfp;

			$ret['show_start_design_btn'] = $object->show_start_design_btn;
			$ret['show_design_request_btn'] = $object->show_design_request_btn;
			
			$ret['show_videos'] = $object->show_videos;
			$ret['show_associated_kits'] = $object->show_associated_kits;
			
			$ret['show_specs_tab'] = $object->show_specs_tab;
			$ret['additional_information'] = $object->additional_information;
			
			$ret['is_free_shipping'] = $object->is_free_shipping;			

		}else{
			$ret['item_id'] = 0;
			
			$ret['main_attr_id'] =0;
			$ret['profile_item_id'] = 0;
		
			$ret['name'] = ''; 
			$ret['price_flat'] = 0;
			$ret['price_wholesale'] = 0;
			$ret['percent_markup'] = 0;
			$ret['price'] = 0;			
			$ret['percent_off'] = 0;
			$ret['amount_off'] = 0;
			$ret['call_for_pricing'] = 0;
			$ret['is_new_product'] = 0;
			$ret['is_promo_product'] = 0; 
			$ret['allow_back_order'] = 0;
			$ret['vend_man_id'] = 0; 
			$ret['weight'] = 0;
			$ret['shipping_flat_charge'] = 0;
			

			$ret['is_taxable'] = 0;
			$ret['prod_number'] = 0;
			$ret['internal_prod_number'] = '';
			
			$ret['style_id'] = 0;
			$ret['lead_time_id'] = 0;
			$ret['skill_level_id'] = 0;
			
			$ret['sku'] = '';
			$ret['upc'] = '';
			$ret['type_id'] = 0;
			$ret['short_description'] = '';
			$ret['description'] = '';
			$ret['back_order_message'] = '';
			$ret['in_stock_message'] = '';
			$ret['additional_information'] = '';
			$ret['img_id'] = 0;
			$ret['is_closet'] = 0;
					
			$ret['date_active'] = '';
			$ret['date_inactive'] = '';
		
			$ret['show_in_cart'] = 0;
			$ret['show_in_showroom'] = 0;

			$ret['seo_url'] = ''; 
			$ret['img_alt_text'] = ''; 
			$ret['seo_list'] = '';
			$ret['key_words'] = ''; 	
			
			$ret['brand_id'] = 0;
			
			$ret['brand_name'] = '';
			
		
			$ret['file_name'] = '';
			
			$ret['canonical_part'] = $_SERVER['DOCUMENT_ROOT'];
			
			$ret['hide_id_from_url'] = 0;
			
			$ret['parent_item_id'] = 0;
			
			$ret['brand_id'] = 0;
			
			$ret['doc_area_text'] = '';
			
			$ret['is_kit'] = 0;

			$ret['show_doc_tab'] = 1;
			$ret['show_meas_form_tab'] = 1;
			$ret['show_atc_btn_or_cfp'] = 1;

			$ret['show_start_design_btn'] = 0;
			$ret['show_design_request_btn'] = 0;

			$ret['show_videos'] = 0;
			$ret['show_associated_kits'] = 1;
			
			$ret['show_specs_tab'] = 1;
			$ret['additional_information'] = '';

			$ret['is_free_shipping'] = '';

			
		}
		
		return $ret;
		
	} 
	
	function getProfileItemIdFromName($name){

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$name = addslashes($name);

		$stmt = $db->prepare("SELECT profile_item_id
							FROM item
							WHERE name = ?
							AND profile_account_id = ? ");

		$stmt->bind_param("si", $name, $_SESSION['profile_account_id']);
			
		//echo 'Error '.$db->error;
		$stmt->execute();
			
		$stmt->bind_result($profile_item_id);
		$stmt->fetch();
		return $profile_item_id;
				
	}


	function getBrandNameFromBrandId($brand_id){

		if(!is_numeric($brand_id)) $brand_id = 0;
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT name
				FROM brand
				WHERE brand_id = '".$brand_id."'";
		$result = $dbCustom->getResult($db,$sql);			
		if($result->num_rows > 0){
			$bn_obj = $result->fetch_object();
			return $bn_obj->name; 	
		}	
		return '';
		
	}


	function getFileNameFromImgId($img_id){
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT file_name
				FROM image
				WHERE img_id = '".$img_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$img_obj = $result->fetch_object();
			return $img_obj->file_name;
		}
		return '';
			
	}

	function getFileNameFromItemId($item_id){
		
		if(!is_numeric($item_id)) $item_id = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT image.file_name
				FROM item, image
				WHERE item.img_id = image.img_id 
				AND item.item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$img_obj = $result->fetch_object();
			return $img_obj->file_name;
		}
			
		return '';
				
	}


	function getStyleNameFromId($style_id){
		if(!is_numeric($style_id)) $style_id = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT name 
				FROM style
				WHERE style_id = '".$style_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->name;					
		}
		return '';
			
	}
	
	
}

?>
