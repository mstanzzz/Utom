<?php

	$ts = time();
	$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : 0;
	$style_id = $_POST['style_id'];
	$lead_time_id = $_POST['lead_time_id'];
	$skill_level_id = $_POST['skill_level_id'];
	$type_id = $_POST['type_id'];
	$main_attr_id = (isset($_POST['main_attr_id']))? $_POST['main_attr_id'] : 0;
	$parent_item_id = $_POST['parent_item_id'];
	$name = trim(addslashes($_POST['name'])); 
	$price_flat = trim(addslashes($_POST['price_flat']));
	$price_wholesale = trim(addslashes($_POST['price_wholesale']));
	$percent_markup = trim(addslashes($_POST['percent_markup']));
	$percent_off = trim(addslashes($_POST['percent_off']));
	$amount_off = trim(addslashes($_POST['amount_off']));
	$is_taxable = (isset($_POST['is_taxable']))? 1 : 0;
	$call_for_pricing = (isset($_POST['call_for_pricing']))? 1 : 0;
	$is_new_product = (isset($_POST['is_new_product']))? 1 : 0;
	$is_promo_product = (isset($_POST['is_promo_product']))? 1 : 0;
	$allow_back_order = (isset($_POST['allow_back_order']))? 1 : 0;
	$is_drop_shipped = (isset($_POST['is_drop_shipped']))? 1 : 0;	
	$show_in_tool = (isset($_POST['show_in_tool']))? 1 : 0;	
	$is_closet = (isset($_POST['is_closet']))? $_POST['is_closet'] : 0;
	$show_in_cart = (isset($_POST['show_in_cart']))? 1 : 0;	
	$show_in_showroom = (isset($_POST['show_in_showroom']))? 1 : 0;	
	$brand_id = trim(addslashes($_POST['brand_id']));
	$internal_prod_number = trim(addslashes($_POST['internal_prod_number']));
	$sku = trim(addslashes($_POST['sku']));
	$upc = trim(addslashes($_POST['upc']));
	$short_description = trim(addslashes($_POST['short_description']));
	$description = trim(addslashes($_POST['description'])); 
	$back_order_message = trim(addslashes($_POST['back_order_message']));
	$in_stock_message = trim(addslashes($_POST['in_stock_message']));
	$additional_information = trim(addslashes($_POST['additional_information']));
	$return_to_id = trim(addslashes($_POST['return_to_id']));
	$weight = trim(addslashes($_POST['weight']));
	$shipping_flat_charge = trim(addslashes($_POST['shipping_flat_charge']));
	$ship_port_id = trim(addslashes($_POST['ship_port_id']));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	$keywords = trim(addslashes($_POST['keywords']));
	$doc_area_text = trim(addslashes($_POST['doc_area_text']));
	$is_kit = (isset($_POST['is_kit']))? 1 : 0;	
	$is_free_shipping = (isset($_POST['is_free_shipping']))? 1 : 0;	
	$show_doc_tab = (isset($_POST['show_doc_tab']))? 1 : 0;	
	$show_meas_form_tab = (isset($_POST['show_meas_form_tab']))? 1 : 0;	
	$show_atc_btn_or_cfp = (isset($_POST['show_atc_btn_or_cfp']))? 1 : 0;	
	$show_start_design_btn = (isset($_POST['show_start_design_btn']))? 1 : 0;	
	$show_design_request_btn = (isset($_POST['show_design_request_btn']))? 1 : 0;	
	$show_videos = (isset($_POST['show_videos']))? 1 : 0;	
	$show_associated_kits = (isset($_POST['show_associated_kits']))? 1 : 0;	
	$show_specs_tab = (isset($_POST['show_specs_tab']))? 1 : 0;
	$hide_id_from_url = 1;
	$date_active = trim($_POST['date_active']);
	$date_inactive = trim($_POST['date_inactive']);
	if(strlen($date_active) < 10){		
		$date_active = $ts;		
	}else{
		$date_active = strtotime($date_active); 
	}
	if(strlen($date_inactive) < 10){	
		$date_inactive = '2142148196';	
	}else{
		$date_inactive = strtotime($date_active);
	}
	$sql = "SELECT max(profile_item_id) AS profile_item_id 
			FROM item 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result->num_rows){
		$profile_item_id = 1;
	}else{
		$object = $result->fetch_object();
		$profile_item_id = $object->profile_item_id + 1; 	
	}
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$msg = '';
	if(1){
		$stmt = $db->prepare("INSERT INTO item
					(parent_item_id
					,profile_item_id
					,main_attr_id
					,name 
					,price_flat
					,price_wholesale
					,percent_markup
					,percent_off
					,amount_off
					,call_for_pricing
					,is_new_product
					,is_promo_product 
					,allow_back_order 
					,brand_id
					,is_taxable
					,internal_prod_number
					,sku
					,upc					
					,short_description
					,description
					,back_order_message
					,in_stock_message
					,additional_information
					,return_to_id
					,is_drop_shipped
					,ship_port_id
					,img_id
					,date_active
					,date_inactive
					,is_closet
					,show_in_cart 
					,show_in_showroom
					,shipping_flat_charge
					,style_id
					,lead_time_id
					,skill_level_id
					,type_id
					,weight
					,img_alt_text
					,key_words
					,show_in_tool
					,hide_id_from_url
					,doc_area_text
					,is_kit
					,is_free_shipping	
					,show_doc_tab
					,show_meas_form_tab
					,show_atc_btn_or_cfp
					,show_start_design_btn
					,show_design_request_btn
					,show_videos
					,show_associated_kits
					,show_specs_tab
					,profile_account_id)
					VALUES
					(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
		
		//echo "<br />";
		//echo 'Error INSERT   '.$db->error;
		//echo "<br />";
		
			if(!$stmt->bind_param("iiisddiidiiiiiissssssssiiiissiiiidiiiidssiisiiiiiiiiii",
					$parent_item_id
					,$profile_item_id
					,$main_attr_id
					,$name 
					,$price_flat
					,$price_wholesale
					,$percent_markup
					,$percent_off
					,$amount_off
					,$call_for_pricing
					,$is_new_product
					,$is_promo_product 
					,$allow_back_order 
					,$brand_id
					,$is_taxable
					,$internal_prod_number
					,$sku
					,$upc
					,$short_description
					,$description
					,$back_order_message
					,$in_stock_message
					,$additional_information
					,$return_to_id
					,$is_drop_shipped
					,$ship_port_id
					,$img_id
					,$date_active
					,$date_inactive
					,$is_closet
					,$show_in_cart 
					,$show_in_showroom
					,$shipping_flat_charge
					,$style_id
					,$lead_time_id
					,$skill_level_id
					,$type_id
					,$weight
					,$img_alt_text
					,$keywords
					,$show_in_tool
					,$hide_id_from_url
					,$doc_area_text
					,$is_kit	
					,$is_free_shipping
					,$show_doc_tab
					,$show_meas_form_tab
					,$show_atc_btn_or_cfp
					,$show_start_design_btn
					,$show_design_request_btn	
					,$show_videos
					,$show_associated_kits
					,$show_specs_tab
					,$_SESSION['profile_account_id'])){
		
			//echo "<br />";
			//echo 'Error-2 '.$db->error;
			//echo "<br />";
			
			$msg .= "There was a problem this action";
			exit;
		}else{
			$stmt->execute();
			$stmt->close();
			$item_id = $db->insert_id;	
		}

		if(isset($_SESSION['temp_documents'])){
			foreach($_SESSION['temp_documents'] as $val){
				$sql = "INSERT INTO item_to_document
						(item_id
						,document_id)
						VALUES
						('".$item_id."','".$val['document_id']."')"; 
				$res = $dbCustom->getResult($db,$sql);								
			}
		}

		$brand_name = '';
		$sql = "SELECT name 
				FROM brand 
				WHERE brand_id = '".$brand_id."'";
				
		$res = $dbCustom->getResult($db,$sql);
		if($res->num_rows > 0){
			$b_obj = $res->fetch_object();
			$brand_name = $b_obj->name; 	
		}
		if(isset($_SESSION['temp_gallery'])){
			foreach($_SESSION['temp_gallery'] as $val){

				$sql = "INSERT INTO item_gallery
						(item_id
						,img_id)
						VALUES
						('".$item_id."','".$val."')"; 
				$result = $dbCustom->getResult($db,$sql);
								
				
			}
		}
		
		
		/*
		if(count($_SESSION['temp_videos']) > 0){
			
			foreach($_SESSION['temp_videos'] as $val){

				$sql = "INSERT INTO item_to_video
						(item_id
						,video_id)
						VALUES
						('".$item_id."','".$val['video_id']."')"; 
				$res = $dbCustom->getResult($db,$sql);
			
			}			
		}
		*/

		// NOTE: a key_words field varchar 250 is now in the item table. 
		//This is redundant data and the key_words table should eventually be removed 
		//but I'm leaving it for now in case we make changes that will need it. 	
		$keywords = explode(",", $keywords);
		foreach($keywords as $word){
			$sql = "INSERT INTO key_words 
			(item_id, word)
			VALUES
			('".$item_id."','".trim($word)."')";      
			$result = $dbCustom->getResult($db,$sql);			
		}
	
		$cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
		foreach($cat_ids as $cat_v){
			
			$sql = "INSERT INTO item_to_category 
					(cat_id, item_id) 
					VALUES( '".$cat_v."', '".$item_id."')";
			$result = $dbCustom->getResult($db,$sql);				
		}

		//$seo_url = getItemSeoUrl($dbCustom,$item_id);
		//$seo_list = getItemSeoList($item_id,$name);
		$seo_url = "";
		$seo_list = "";
		
		$canonical_part = SITEROOT."/".$_SESSION['global_url_word'].$seo_url;
		
		$sql = "UPDATE item
				SET seo_url = '".$seo_url."', seo_list = '".$seo_list."', canonical_part = '".$canonical_part."'
				WHERE item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);		
	
		/* allows multiple selections
		$sql = "SELECT attribute_id, attribute_name
				FROM  attribute 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY attribute_id";
		$attr_res = mysql_query ($sql);
		if(!$attr_res)die(mysql_error());
		while($attr_row = mysql_fetch_object($attr_res)) {
			if(isset($_POST["attr_".$attr_row->attribute_id])){
				if(is_array($_POST["attr_".$attr_row->attribute_id])){			
					foreach($_POST["attr_".$attr_row->attribute_id] as $opt_val){
						$sql = "INSERT INTO item_to_opt 
								(opt_id ,item_id) 
								VALUES 
								('".$opt_val."','".$item_id."')";
						$result = $dbCustom->getResult($db,$sql);
						
					}
				}
			}
		}
		*/


		$sql = "SELECT attribute_id, attribute_name
				FROM  attribute 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY attribute_id";
		$result = $dbCustom->getResult($db,$sql);
		while($attr_row = $result->fetch_object()) {
			if(isset($_POST["attr_".$attr_row->attribute_id])){
				$sql = "INSERT INTO item_to_opt 
							(opt_id ,item_id) 
							VALUES 
							('".$_POST["attr_".$attr_row->attribute_id]."','".$item_id."')";
				$res = $dbCustom->getResult($db,$sql);
				
			}
		}
		if($shipping->getShipType() == 'carrier' && $weight == 0){	
			$msg .= "<br />WARNING:  This product has no value for weight.<br />Weight is needed for shipping charges.";			
			$msg .= "<br /><br /><a href='edit-item.php?item_id=".$item_id."' >Click Here To Edit</a><br /><br />" ;
		}
		$msg .= "Your change is now live.";
		$progress->completeStep("item" ,$_SESSION['profile_account_id']);
		
	}else{
		
		
	}
	
	
?>