<?php
require_once("accessory_cart_functions.php");

class StoreData {

	function getItemDataFromCat($cat_id, $price_bottom=0, $price_top=0, $show_in = 'showroom', $sort = ''){
	
		$item_array = array();

$item_array = $this->getItemDataFromSingleCat($cat_id,$price_bottom, $price_top, $show_in);		



		
		$cat_array = $this->getDescendentCats($cat_id,$price_bottom, $price_top, $show_in);
		
		foreach($cat_array as $v){					
			$item_array = array_merge($item_array, $this->getItemDataFromSingleCat($v,$price_bottom, $price_top, $show_in));		
		}
		$tmp_array = array();
		$ret_array = array();
		foreach($item_array as $v){
			if(!inArray($v['item_id'], $tmp_array)){
				$ret_array[] = $v;
			}
			$tmp_array[] = $v['item_id'];
		}



		return $ret_array;
	}


	function getItemIdsBrand($brand_id, $price_bottom = 0, $price_top = 0){
		
		$ts = time();
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT DISTINCT item.item_id
					,item.profile_item_id
					,item.price_flat
					,item.price_wholesalef
					,item.percent_markup
					,item.call_for_pricing 
					,item.show_doc_tab
					,item.show_meas_form_tab
					,item.show_atc_btn_or_cfp
					,item.show_start_design_btn
					,item.show_design_request_btn					
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.brand_id = '".$brand_id."'
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.date_inactive > '".$ts."'
				AND item.date_active <= '".$ts."'
				AND item.active = '1'							
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()){
			$go = 1;
			if($price_top > 0){
				
				if($row->call_for_pricing){
					$go = 0;					
				}else{
					if($row->price_flat > 0){
						$price = $row->price_flat;	
					}elseif($row->price_wholesale > 0){
						$price = $row->price_wholesale + $row->percent_markup; 
					}else{
						$price = 0;	
					}
				
					if($price < $price_bottom || $price > $price_top){
						$go = 0;
					}
				}
			}
				
			if($go){
				$t[] = $row->item_id;
			}
		}
		return $t;
		
	}


	function getItemIdsFromSingleCat($cat_id, $price_bottom = 0, $price_top = 0, $show_in = 'cart'){
		
		$ts = time();
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT DISTINCT item.item_id
					,item.profile_item_id 
					,item.price_flat
					,item.price_wholesale
					,item.percent_markup 
					,item.call_for_pricing 
					,item.show_doc_tab
					,item.show_meas_form_tab
					,item.show_atc_btn_or_cfp
					,item.show_start_design_btn
					,item.show_design_request_btn
				FROM item, item_to_category, category, image
				WHERE item.item_id = item_to_category.item_id
				AND item_to_category.cat_id = category.cat_id
				AND item.img_id = image.img_id
				AND category.cat_id = '".$cat_id."'
				AND item.date_inactive > '".$ts."'
				AND item.date_active <= '".$ts."'
				AND item.parent_item_id = '0'
				AND item.active = '1'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";


		if($show_in == "cart"){
			$sql .= "AND item.show_in_cart = '1'";
		}
		if($show_in == "showroom"){
			$sql .= "AND item.show_in_showroom = '1'";
		}

		$result = $dbCustom->getResult($db,$sql);		
		
		while($row = $result->fetch_object()){
			$go = 1;
			if($price_top > 0){
		
				if($row->call_for_pricing){					
					$go = 0;				
				}else{
					if($row->price_flat > 0){
						$price = $row->price_flat;	
					}elseif($row->price_wholesale > 0){
						$price = $row->price_wholesale + $row->percent_markup; 
					}else{
						$price = 0;	
					}
					if($price < $price_bottom || $price > $price_top){
						$go = 0;
					}
				}
			}
			
			if($go){
				$t[] = $row->item_id;
			}
		}
		return $t;
	}


	function getItemDataFromSingleCat($cat_id, $price_bottom = 0, $price_top = 0, $show_in = 'cart'){
	
		if(!is_numeric($cat_id)) $cat_id = 0;
		
		$ts = time();
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT DISTINCT item.item_id 
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
						,item.short_description
						,item.description											
				FROM item, item_to_category, category, image
				WHERE item.item_id = item_to_category.item_id
				AND item_to_category.cat_id = category.cat_id
				AND item.img_id = image.img_id
				AND category.cat_id = '".$cat_id."'
				AND item.date_inactive > '".$ts."'
				AND item.date_active <= '".$ts."'					
				AND item.active = '1'
				AND item.parent_item_id = '0'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";


		if($show_in == "cart"){
			//$sql .= "AND item.show_in_cart = '1'";
		}
		if($show_in == "showroom"){
			//$sql .= "AND item.show_in_showroom = '1'";
		}
	
		$result = $dbCustom->getResult($db,$sql);		
	
	
	
	
	
	
	//echo "num_rows  ".$result->num_rows;
	//exit;
	
	
	
		$i = 0;
		while($row = $result->fetch_object()){
			
			$go = 1;
			
			if($row->price_flat > 0){
				$price = $row->price_flat;	
			}elseif($row->price_wholesale > 0){
				$price = $row->price_wholesale + $row->percent_markup; 
			}else{
				$price = 0;	
			}
			
			if($price_top > 0){
				if($row->call_for_pricing){
					$go = 0;					
				}else{
					if($price < $price_bottom || $price > $price_top){
						$go = 0;
					}
				}
			}
			
			
			if($go){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['profile_item_id'] = $row->profile_item_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['is_closet'] = $row->is_closet;
				$t[$i]['seo_url'] = $row->seo_url;
				$t[$i]['cat_id'] = $cat_id;
				$t[$i]['img_alt_text'] = $row->img_alt_text;
				$t[$i]['call_for_pricing'] = $row->call_for_pricing;
				$t[$i]['prod_number'] = $row->prod_number;	
				$t[$i]['internal_prod_number'] = $row->internal_prod_number;	
				$t[$i]['show_in_cart'] = $row->show_in_cart;
				$t[$i]['show_in_showroom'] = $row->show_in_showroom;
				$t[$i]['price'] = $price;
				$t[$i]['weight'] = $row->weight;
				$t[$i]['hide_id_from_url'] = $row->hide_id_from_url;
				$t[$i]['brand_id'] = $row->brand_id;
				$t[$i]['shipping_flat_charge'] = $row->shipping_flat_charge;
				$t[$i]['show_doc_tab'] = $row->show_doc_tab;
				$t[$i]['show_meas_form_tab'] = $row->show_meas_form_tab;
				$t[$i]['show_atc_btn_or_cfp'] = $row->show_atc_btn_or_cfp;
				$t[$i]['show_start_design_btn'] = $row->show_start_design_btn;
				$t[$i]['show_design_request_btn'] = $row->show_design_request_btn;
				$t[$i]['is_free_shipping'] = $row->is_free_shipping;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
				
				$i++;
			}
		}
	
		return $t;
	}

	function getItemDataFromBrand($brand_id, $price_bottom=0, $price_top=0, $show_in = ''){
	
		if(!is_numeric($brand_id)) $brand_id = 0;
		$ts = time();
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT DISTINCT item.item_id
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
				,item.weight
				,item.hide_id_from_url
				,item.shipping_flat_charge
				,item.show_doc_tab
				,item.show_meas_form_tab
				,item.show_atc_btn_or_cfp
				,item.show_start_design_btn
				,item.show_design_request_btn
				,item.is_free_shipping
				,item.short_description
				,item.description									
			FROM item, image
			WHERE item.img_id = image.img_id
			AND item.brand_id = '".$brand_id."'
			AND item.date_inactive > '".$ts."'
			AND item.date_active <= '".$ts."'
			AND item.active = '1'
			AND item.parent_item_id = '0'			
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
//AND item.parent_item_id = '0'
		if($show_in == "cart"){
			$sql .= "AND item.show_in_cart = '1'";
		}
		if($show_in =="showroom"){
			$sql .= "AND item.show_in_showroom = '1'";
		}

		$result = $dbCustom->getResult($db,$sql);		
	
		$i = 0;
		while($row = $result->fetch_object()){
			$go = 1;
			if($row->price_flat > 0){
				$price = $row->price_flat;	
			}elseif($row->price_wholesale > 0){
				$price = $row->price_wholesale + $row->percent_markup; 
			}else{
				$price = 0;	
			}
			
			if($price_top > 0){
				if($row->call_for_pricing){
					$go = 0;
				}else{
					if($price < $price_bottom || $price > $price_top){
						$go = 0;
					}
				}
			}
			
			if($go){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['profile_item_id'] = $row->profile_item_id;				
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['is_closet'] = $row->is_closet;
				$t[$i]['seo_url'] = $row->seo_url;
				$t[$i]['cat_id'] = 0;			
				$t[$i]['img_alt_text'] = $row->img_alt_text;
				$t[$i]['call_for_pricing'] = $row->call_for_pricing;
				$t[$i]['prod_number'] = $row->prod_number;
				$t[$i]['price'] = $price;				
				$t[$i]['weight'] = $row->weight;
				$t[$i]['hide_id_from_url'] = $row->hide_id_from_url;
				$t[$i]['brand_id'] = $brand_id;
				$t[$i]['shipping_flat_charge'] = $row->shipping_flat_charge;
				$t[$i]['show_doc_tab'] = $row->show_doc_tab;
				$t[$i]['show_meas_form_tab'] = $row->show_meas_form_tab;
				$t[$i]['show_atc_btn_or_cfp'] = $row->show_atc_btn_or_cfp;
				$t[$i]['show_start_design_btn'] = $row->show_start_design_btn;
				$t[$i]['show_design_request_btn'] = $row->show_design_request_btn;
				$t[$i]['is_free_shipping'] = $row->is_free_shipping;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
				
				$i++;
			}
		}
	
		return $t;
	}


	function getSubCats($cat_id, $price_bottom, $price_top, $show_in = 'cart'){
		if(!is_numeric($cat_id)) $cat_id = 0;
		
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
		$sql = "SELECT child_cat_id
				FROM child_cat_to_parent_cat, category 
				WHERE child_cat_to_parent_cat.child_cat_id = category.cat_id
				AND category.active = '1'
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
		
		if($show_in == "cart"){
			$sql .= " AND category.show_in_cart = '1'";
		}
		if($show_in == "showroom"){
			$sql .= " AND category.show_in_showroom = '1'";
		}
		
		$sql .= " ORDER BY display_order";
		
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()){			
				$t[] = $row->child_cat_id; 			
		}
		return $t;
	}
	

	function getDescendentCats($cat_id, $price_bottom, $price_top,  $show_in = 'cart', $the_cat_array = array()){
		
		$sub_cats = array_unique($this->getSubCats($cat_id, $price_bottom, $price_top, $show_in));
		
		if(count($sub_cats) > 0){
			
			$temp_array = array_merge($the_cat_array, $sub_cats);		
			
			foreach($sub_cats as $v){

				$the_cat_array = array_merge($this->getDescendentCats($v, $price_bottom, $price_top, $show_in, $temp_array), $temp_array);

			}

		}
		return $the_cat_array;
	}
	
	function addPriceRange($price_bottom = 0, $price_top = 100)
	{
		
		$indx = 0;
		if(isset($_SESSION["nav_price_range_array"])){
			$indx = count($_SESSION["nav_price_range_array"]);
		}
		$_SESSION["nav_price_range_array"][$indx]["bottom"] = $price_bottom;
		$_SESSION["nav_price_range_array"][$indx]["top"] = $price_top;
	}
	


	function getItemCount($price_bottom,$price_top,$cat_id = 0, $brand_id = 0,$show_in = 'cart')
	{
		
		$item_array = array();

		if($cat_id > 0){
			
			if($show_in == 'showroom'){
				$item_array = $this->getItemIdsFromSingleCat($cat_id, $price_bottom, $price_top, 'showroom');		
				$cat_array = $this->getDescendentCats($cat_id,$price_bottom, $price_top, 'showroom');
				foreach($cat_array as $v){
					$item_array = array_merge($item_array, $this->getItemIdsFromSingleCat($v,$price_bottom, $price_top, 'showroom'));		
				}
				
				//print_r($item_array); 
				//exit;
				
			}else{
				$item_array = $this->getItemIdsFromSingleCat($cat_id, $price_bottom, $price_top, 'cart');		
				$cat_array = $this->getDescendentCats($cat_id,$price_bottom, $price_top, 'cart');
				foreach($cat_array as $v){
					$item_array = array_merge($item_array, $this->getItemIdsFromSingleCat($v,$price_bottom, $price_top, 'cart'));		
				}
			}
			
		}else{
			if($brand_id > 0){
				$item_array = $this->getItemIdsBrand($brand_id, $price_bottom, $price_top);						
			}
		}
	
		$item_array = array_unique($item_array);
		
		return count($item_array);
	}



	function getNavPriceRanges()
	{

		//unset($_SESSION['nav_price_range_array']);
		if(!isset($_SESSION['nav_price_range_array'])){
			$this->addPriceRange(0,50);
			$this->addPriceRange(50,100);
			$this->addPriceRange(100,200);
			$this->addPriceRange(200,500);
			$this->addPriceRange(500,1000);
			$this->addPriceRange(1000,5000);
			$this->addPriceRange(5000,90000);
		}
		
		return $_SESSION['nav_price_range_array'];

	}


	function getNavPriceRangesBlock($cat_id=0,$profile_cat_id=0, $cat_seo_url='', $brand_id=0, $show_in = 'cart')
	{
		
		$block = '';
		$block .= "<ul>";
		$j=0;
		
		$price_range_array = $this->getNavPriceRanges();	
		
		foreach($price_range_array as $val){
					
			$price_btm = $val['bottom'];
			$price_tp = $val['top']; 							
			$item_count = $this->getItemCount($price_btm,$price_tp,$cat_id,$brand_id,$show_in);
			
			if($item_count > 0){
				$block .= "<li><a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$cat_seo_url."category.html";
				$block .= "?prodCatId=".$profile_cat_id."&brandId=".$brand_id."&priceBottom=".$price_btm."&priceTop=".$price_tp."'>";				
				$block .= '$'.$price_btm.' to $'.$price_tp.' ('.$item_count.')</a></li>';
				$j++;
			}		
		}
		$block .= "</ul>";
		if($j > 0){
			return $block;
		}else{
			return '';
		}
	}

	
	
	function getSubCatsWithData($cat_id, $show_in = 'cart', $price_bottom = 0, $price_top = 0)
	{	
		
			
		$t = array();
		
		if(!is_numeric($cat_id)){
			return $t;	
		}
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,category.img_id
					,category.tool_tip
					,category.seo_url
					,category.img_alt_text
					,category.show_in_cart
					,category.show_in_showroom
					,category.short_description
					,category.description					
				FROM category, child_cat_to_parent_cat 
				WHERE child_cat_to_parent_cat.child_cat_id = category.cat_id
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				AND category.active = '1'";
				
		if($show_in == "cart"){
			$sql .= " AND category.show_in_cart = '1'";
		}
		if($show_in == "showroom"){
			$sql .= " AND category.show_in_showroom = '1'";
		}

		
		$sql .= " ORDER BY display_order";

			
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
	
			$go = 0;
			$store_count = 0;
			$showroom_count = 0;
			$destination = 'cart';

			$store_count = $this->getItemCount($price_bottom,$price_top,$row->cat_id,0,'cart');
			$showroom_count = $this->getItemCount($price_bottom,$price_top,$row->cat_id,0,'showroom');					
			$has_accessories = 0;
			
			if($show_in == 'cart'){
				if($row->show_in_cart && $row->show_in_showroom){
					
					if($showroom_count > 0){ 
						$destination = 'showroom';
						$go = 1;
					}else{
						$destination = 'cart';
						if($store_count > 0){
							$go = 1;	
						}
					}
					
				}elseif($row->show_in_showroom){
					if($showroom_count > 0){ 
						$destination = 'showroom';
						$go = 1;
					}else{
						$destination = 'cart';
						if($store_count > 0){
							$go = 1;	
						}
					}
									
				}else{
					
					if($store_count > 0){
						$destination = 'cart'; 
						$go = 1;
					}else{
				
						if($showroom_count > 0){
							$destination = 'showroom';
							$go = 1;	
						}	
					}
				}
				
			}else{
				
				if($show_in == 'showroom'){
					if($showroom_count > 0){
						$destination = 'showroom';
						$go = 1;
						
						if($store_count > 0){
							
							$has_accessories = 1;
						}
						
					}
				}else{
	
					if($showroom_count > 0){ 
						$destination = 'showroom';
						$go = 1;
					}else{
						$destination = 'cart';
						if($store_count > 0){
							$go = 1;	
						}
					}
				}
			}
		
			if($go){
				
				$t[$i]['cat_id'] = $row->cat_id;
				$t[$i]["profile_cat_id"] = $row->profile_cat_id;				
				$t[$i]['name'] = stripslashes($row->name);
				$t[$i]['tool_tip'] = $row->tool_tip;
				$t[$i]["seo_url"] = $row->seo_url;
				$t[$i]['img_alt_text'] = $row->img_alt_text;
				$t[$i]['destination'] = $destination;
				$t[$i]['has_accessories'] = $has_accessories;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
								
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT file_name 
							FROM image
							WHERE img_id = '".$row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				
				if($img_res->num_rows > 0){
					$img_obj = $img_res->fetch_object();
					$t[$i]["img_file_name"] = $img_obj->file_name;
				}else{
					$t[$i]["img_file_name"] = '';
				}
	
				$i++;
			}
		}
		
		return $t;
	}
	

	function getProfileCatFromCat($cat_id){
		
		if(!is_numeric($cat_id)) $cat_id = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT profile_cat_id
				FROM category
				WHERE cat_id = '".$cat_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->profile_cat_id;
		}else{
			return 0;
		}
	}
	
	function getCatFromProfileCat($profile_cat_id = 0){
		
		if(!is_numeric($profile_cat_id)) $profile_cat_id = 0;
		$ret = 0;
		if($profile_cat_id > 0){
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT cat_id
					FROM category
					WHERE profile_cat_id = '".$profile_cat_id."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);					
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$ret = $object->cat_id;
			}
		
		}
		
		return $ret;

	}
	



	function getSubCatsSimple($cat_id)
	{	
		
			
		$t = array();
		
		if(!is_numeric($cat_id)){
			return $t;	
		}
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,category.img_id
					,category.tool_tip
					,category.seo_url
					,category.img_alt_text
					,category.show_in_cart
					,category.show_in_showroom
					,category.short_description
					,category.description					
				FROM category, child_cat_to_parent_cat 
				WHERE child_cat_to_parent_cat.child_cat_id = category.cat_id
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				AND category.active = '1'";
				
			$sql .= " AND category.show_in_cart = '1'";
		
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
	
				$t[$i]['cat_id'] = $row->cat_id;
				$t[$i]['name'] = stripslashes($row->name);
								
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT file_name 
							FROM image
							WHERE img_id = '".$row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				
				if($img_res->num_rows > 0){
					$img_obj = $img_res->fetch_object();
					$t[$i]["img_file_name"] = $img_obj->file_name;
				}else{
					$t[$i]["img_file_name"] = '';
				}
	
				$i++;
		}
		
		return $t;
	}
	



	
}

?>
