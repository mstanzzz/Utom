<?php


/*

-	Title Match: 100 points
-	Keyword Match: 50 points
-	Description match: 20 points
Then basically what u do is rank based on points. 
So if an item has a title, keyword, and description match then that's 170 points. 
So all items with 170 points would be first in list. 
Make  sense? 
Then of course for showroom and blog/news you would look for the same things as those also have titles, keywords and their descriptions is their body content.



*/


class Search {

	
	function GetSearchResultsItems($search_string, $show_in = '')
	{
		$ts = time();
		$search_string = strtolower($search_string);
		$search_string = preg_replace('/\s\s+/', ' ', $search_string);
		$search_word_array = explode(" " ,$search_string);
		$items_array = array();
		$i = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		foreach($search_word_array as $word){

			$word = trim(addslashes($word));
			if(strlen($word) > 0){
				$last_char = $word[strlen($word)-1];
			}else{
				$last_char = '';
			}
			
			if($last_char == "s"){
				if(strlen($word) > 1){
					$word = substr($word, 0, -1);
				}
			}
			
			if(is_numeric($word)){
				$numeric_word = $word;
				
				$stmt = $db->prepare("SELECT DISTINCT item.item_id
							,item.profile_item_id
							,item.name
							,image.file_name
							,item.is_closet
							,item.seo_url
							,item.img_alt_text
							,item.call_for_pricing
							,item.price_flat
							,item.price_wholesale
							,item.percent_markup
							,item.prod_number 
							,item.internal_prod_number
							,item.show_in_cart
							,item.show_in_showroom
							,item.weight
							,item.hide_id_from_url
							,item.brand_id
							,item.shipping_flat_charge
							,item.show_doc_tab
							,item.show_meas_form_tab
							,item.show_atc_btn_or_cfp
							,item.show_start_design_btn
							,item.show_design_request_btn	
							,item.is_free_shipping												
						FROM item, image
						WHERE item.img_id = image.img_id
						AND item.active = '1'
						AND item.date_inactive > ?
						AND item.date_active <= ?
					    AND (item.internal_prod_number = ? OR item.profile_item_id = ?)
					    AND item.profile_account_id = ?");
						
				if(!$stmt->bind_param("iiiii",
					$ts, $ts, $numeric_word, $numeric_word, $_SESSION['profile_account_id'])){
					
						//echo 'Error '.$db->error;
					
				}else{
					$stmt->execute();
						
					$stmt->bind_result($item_id
									,$profile_item_id
									,$name 
									,$file_name
									,$is_closet
									,$seo_url
									,$img_alt_text
									,$call_for_pricing
									,$price_flat
									,$price_wholesale
									,$percent_markup
									,$prod_number 
									,$internal_prod_number
									,$show_in_cart
									,$show_in_showroom
									,$weight
									,$hide_id_from_url
									,$brand_id
									,$shipping_flat_charge
									,$show_doc_tab
									,$show_meas_form_tab
									,$show_atc_btn_or_cfp
									,$show_start_design_btn
									,$show_design_request_btn
									,$is_free_shipping);
							
					
					while($stmt->fetch()) {
						if(!in_array($item_id,$items_array)){
								
			
							if($price_flat > 0){
								$price = $price_flat;	
							}elseif($price_wholesale > 0){
								$price = $price_wholesale + $percent_markup; 
							}else{
								$price = 0;	
							}
			
			
							$items_array[$i]['item_id'] = $item_id;
								
							$items_array[$i]['profile_item_id'] = $profile_item_id;
							$items_array[$i]['name'] = $name;
							$items_array[$i]['file_name'] = $file_name;
							$items_array[$i]['is_closet'] = $is_closet;
							$items_array[$i]['seo_url'] = $seo_url;
							$items_array[$i]['cat_id'] = 0;
							$items_array[$i]['img_alt_text'] = $img_alt_text;
							$items_array[$i]['call_for_pricing'] = $call_for_pricing;
							$items_array[$i]['prod_number'] = $prod_number;	
							$items_array[$i]['internal_prod_number'] = $internal_prod_number;	
							$items_array[$i]['show_in_cart'] = $show_in_cart;
							$items_array[$i]['show_in_showroom'] = $show_in_showroom;
							$items_array[$i]['price'] = $price;
							$items_array[$i]['weight'] = $weight;
							$items_array[$i]['hide_id_from_url'] = $hide_id_from_url;	
							$items_array[$i]['brand_id'] = $brand_id;	
							$items_array[$i]['shipping_flat_charge'] = $shipping_flat_charge;
							$items_array[$i]['show_doc_tab'] = $show_doc_tab;
							$items_array[$i]['show_meas_form_tab'] = $show_meas_form_tab;
							$items_array[$i]['show_atc_btn_or_cfp'] = $show_atc_btn_or_cfp;
							$items_array[$i]['show_start_design_btn'] = $show_start_design_btn;
							$items_array[$i]['show_design_request_btn'] = $show_design_request_btn;
							$items_array[$i]['is_free_shipping'] = $is_free_shipping;
							
							$i++;
						}
					}
						
				}	
						
				$stmt->close();
			}

			
			if(!is_numeric($word)){

				$stmt = $db->prepare("SELECT DISTINCT item.item_id
							,item.profile_item_id
							,item.name
							,image.file_name
							,item.is_closet
							,item.seo_url
							,item.img_alt_text
							,item.call_for_pricing
							,item.price_flat
							,item.price_wholesale
							,item.percent_markup
							,item.prod_number 
							,item.internal_prod_number
							,item.show_in_cart
							,item.show_in_showroom
							,item.weight
							,item.hide_id_from_url
							,item.brand_id
							,item.shipping_flat_charge
							,item.show_doc_tab
							,item.show_meas_form_tab
							,item.show_atc_btn_or_cfp
							,item.show_start_design_btn
							,item.show_design_request_btn	
							,item.is_free_shipping																			
						FROM item, image
						WHERE item.img_id = image.img_id
						AND item.active = '1'
						AND item.date_inactive > ?
						AND item.date_active <= ?
					    AND (item.name LIKE ? OR item.description LIKE ? OR short_description LIKE ?)
					    AND item.profile_account_id = ?");
				
				$param = "%{$word}%";
						
				if(!$stmt->bind_param("iisssi",
					$ts, $ts, $param, $param, $param, $_SESSION['profile_account_id'])){
					
						//echo 'Error '.$db->error;

				}else{
					$stmt->execute();
						
					$stmt->bind_result($item_id
									,$profile_item_id
									,$name 
									,$file_name
									,$is_closet
									,$seo_url
									,$img_alt_text
									,$call_for_pricing
									,$price_flat
									,$price_wholesale
									,$percent_markup
									,$prod_number 
									,$internal_prod_number
									,$show_in_cart
									,$show_in_showroom
									,$weight
									,$hide_id_from_url
									,$brand_id
									,$shipping_flat_charge
								,$show_doc_tab
								,$show_meas_form_tab
								,$show_atc_btn_or_cfp
								,$show_start_design_btn
								,$show_design_request_btn
								,$is_free_shipping);
							
					
					while($stmt->fetch()) {
						if(!in_array($item_id,$items_array)){
			
							if($price_flat > 0){
								$price = $price_flat;	
							}elseif($price_wholesale > 0){
								$price = $price_wholesale + $percent_markup; 
							}else{
								$price = 0;	
							}
			
							$items_array[$i]['item_id'] = $item_id;
							$items_array[$i]['profile_item_id'] = $profile_item_id;
							$items_array[$i]['name'] = $name;
							$items_array[$i]['file_name'] = $file_name;
							$items_array[$i]['is_closet'] = $is_closet;
							$items_array[$i]['seo_url'] = $seo_url;
							$items_array[$i]['cat_id'] = 0;
							$items_array[$i]['img_alt_text'] = $img_alt_text;
							$items_array[$i]['call_for_pricing'] = $call_for_pricing;
							$items_array[$i]['prod_number'] = $prod_number;	
							$items_array[$i]['internal_prod_number'] = $internal_prod_number;	
							$items_array[$i]['show_in_cart'] = $show_in_cart;
							$items_array[$i]['show_in_showroom'] = $show_in_showroom;
							$items_array[$i]['price'] = $price;
							$items_array[$i]['weight'] = $weight;
							$items_array[$i]['hide_id_from_url'] = $hide_id_from_url;	
							$items_array[$i]['brand_id'] = $brand_id;	
							$items_array[$i]['shipping_flat_charge'] = $shipping_flat_charge;
							$items_array[$i]['show_doc_tab'] = $show_doc_tab;
							$items_array[$i]['show_meas_form_tab'] = $show_meas_form_tab;
							$items_array[$i]['show_atc_btn_or_cfp'] = $show_atc_btn_or_cfp;
							$items_array[$i]['show_start_design_btn'] = $show_start_design_btn;
							$items_array[$i]['show_design_request_btn'] = $show_design_request_btn;
							$items_array[$i]['is_free_shipping'] = $is_free_shipping;
							$i++;
						}
					}
						
				}	
						
				$stmt->close();
			}

				$stmt = $db->prepare("SELECT DISTINCT item.item_id
							,item.profile_item_id
							,item.name
							,image.file_name
							,item.is_closet
							,item.seo_url
							,item.img_alt_text
							,item.call_for_pricing
							,item.price_flat
							,item.price_wholesale
							,item.percent_markup
							,item.prod_number 
							,item.internal_prod_number
							,item.show_in_cart
							,item.show_in_showroom
							,item.weight
							,item.hide_id_from_url
							,item.brand_id
							,item.shipping_flat_charge
							,item.show_doc_tab
							,item.show_meas_form_tab
							,item.show_atc_btn_or_cfp
							,item.show_start_design_btn
							,item.show_design_request_btn
							,item.is_free_shipping																				
						FROM item, image
						WHERE item.img_id = image.img_id
						AND item.active = '1'
						AND item.date_inactive > ?
						AND item.date_active <= ?
					    AND (item.sku = ? OR item.upc = ?)
					    AND item.profile_account_id = ?");

				if(!$stmt->bind_param("iissi",
					$ts, $ts, $word, $word, $_SESSION['profile_account_id'])){
						
						//echo 'Error '.$db->error;

				}else{
					$stmt->execute();
						
					$stmt->bind_result($item_id
									,$profile_item_id
									,$name 
									,$file_name
									,$is_closet
									,$seo_url
									,$img_alt_text
									,$call_for_pricing
									,$price_flat
									,$price_wholesale
									,$percent_markup
									,$prod_number 
									,$internal_prod_number
									,$show_in_cart
									,$show_in_showroom
									,$weight
									,$hide_id_from_url
									,$brand_id
									,$shipping_flat_charge
								,$show_doc_tab
								,$show_meas_form_tab
								,$show_atc_btn_or_cfp
								,$show_start_design_btn
								,$show_design_request_btn
								,$is_free_shipping);

					while($stmt->fetch()) {
						if(!in_array($item_id,$items_array)){
			
							if($price_flat > 0){
								$price = $price_flat;	
							}elseif($price_wholesale > 0){
								$price = $price_wholesale + $percent_markup; 
							}else{
								$price = 0;	
							}
			
							$items_array[$i]['item_id'] = $item_id;
							$items_array[$i]['profile_item_id'] = $profile_item_id;
							$items_array[$i]['name'] = $name;
							$items_array[$i]['file_name'] = $file_name;
							$items_array[$i]['is_closet'] = $is_closet;
							$items_array[$i]['seo_url'] = $seo_url;
							$items_array[$i]['cat_id'] = 0;
							$items_array[$i]['img_alt_text'] = $img_alt_text;
							$items_array[$i]['call_for_pricing'] = $call_for_pricing;
							$items_array[$i]['prod_number'] = $prod_number;	
							$items_array[$i]['internal_prod_number'] = $internal_prod_number;	
							$items_array[$i]['show_in_cart'] = $show_in_cart;
							$items_array[$i]['show_in_showroom'] = $show_in_showroom;
							$items_array[$i]['price'] = $price;
							$items_array[$i]['weight'] = $weight;
							$items_array[$i]['hide_id_from_url'] = $hide_id_from_url;	
							$items_array[$i]['brand_id'] = $brand_id;	
							$items_array[$i]['shipping_flat_charge'] = $shipping_flat_charge;
							$items_array[$i]['show_doc_tab'] = $show_doc_tab;
							$items_array[$i]['show_meas_form_tab'] = $show_meas_form_tab;
							$items_array[$i]['show_atc_btn_or_cfp'] = $show_atc_btn_or_cfp;
							$items_array[$i]['show_start_design_btn'] = $show_start_design_btn;
							$items_array[$i]['show_design_request_btn'] = $show_design_request_btn;
							$items_array[$i]['is_free_shipping'] = $is_free_shipping;
							$i++;
						}
					}
						
				}	
						
				$stmt->close();


	
			//if(count($items_array) > 2) $items_array = multi_unique($items_array);  
			
			
			return multi_unique($items_array);
			
			//return $items_array;
			//return array_unique($items_array);
				
		}
	
	}
	
	function GetSearchResultsDesigns($search_string, $is_closet = 1)
	{
	
		return 0;
	
	}


	
	function GetSearchResultsBlogArticles($search_string)
	{
	
		$search_string = preg_replace('/\s\s+/', ' ', $search_string);
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$items_array = array();
		$i = -1;

		$stmt = $db->prepare("SELECT blog_post_id 
					FROM blog_post
					WHERE hide = '0'
					AND (title LIKE ?
					OR content LIKE ?)
					AND profile_account_id =?");
			
		$param = "%{$search_string}%";
					
		if(!$stmt->bind_param("ssi",
			$param, $param, $_SESSION['profile_account_id'])){

		}else{
			$stmt->execute();
						
			$stmt->bind_result($blog_post_id);
			while($stmt->fetch()) {
				$items_array[++$i] = $blog_post_id;
			}
		}	
						
		$stmt->close();
	
		return multi_unique($items_array);  
		
						
	}
	
	
	
	
	function GetSearchResultsNewsArticles($search_string)
	{
	
		$search_string = preg_replace('/\s\s+/', ' ', $search_string);
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$items_array = array();
		$i = -1;

		$stmt = $db->prepare("SELECT news_id 
					FROM news
					WHERE hide = '0' 
					AND type != 'admin'
					AND content LIKE ?
					AND profile_account_id = ?");
			
		$param = "%{$search_string}%";
					
		if(!$stmt->bind_param("si",
			$param, $_SESSION['profile_account_id'])){

		}else{
			$stmt->execute();
						
			$stmt->bind_result($news_id);
			while($stmt->fetch()) {
				$items_array[++$i] = $news_id;
			}
		}	
						
		$stmt->close();

		return multi_unique($items_array);				
	}
	
	function GetSearchResultsAskOrganizerProfiles($search_string) {
		// add new code to search organizer profiles database!
		return false;
	}
	
	function GetSearchResultsPageContent($search_string) {
		// add new code to search added and optional pages' content
		$search_string = preg_replace('/\s\s+/', ' ', $search_string);
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$items_array = array();
		$i = -1;

		$stmt = $db->prepare("SELECT page_seo_id 
					FROM page_seo
					WHERE profile_account_id = ? 
					AND (
						title LIKE ?
						OR keywords LIKE ?
						OR description LIKE ?
						OR page_heading LIKE ?
					)");

		$param = "%{$search_string}%";
					
		if(!$stmt->bind_param("issss",
			$_SESSION['profile_account_id'], $param, $param, $param, $param)){
		}else{
			$stmt->execute();
						
			$stmt->bind_result($page_seo_id);
			while($stmt->fetch()) {
				$items_array[++$i] = $page_seo_id;
			}
		}	
						
		$stmt->close();

		return multi_unique($items_array);				
	}
	
}


?>
