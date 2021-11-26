<?php

class LikeItems {

	
	function getLikesItemsFromDesign($array = array())
	{
		$ts = time();
		$it = new ShoppingCart;	
		$i = 0;
		$t = '';

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
			
		$sql = "SELECT item.item_id, item.name, item.img_id, image.file_name 
					FROM key_words, item, image 
					WHERE key_words.item_id = item.item_id 
					AND item.img_id = image.img_id
					AND key_words.word LIKE 'closet'
					AND item.profile_account_id ='".$_SESSION['profile_account_id']."'
					AND item.date_inactive > '".$ts."'
					AND item.date_active <= '".$ts."'
					AND item.active = '1'
					LIMIT 4
					";
		$result = $dbCustom->getResult($db,$sql);

		while($row = $result->fetch_object()){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['cat_id'] = $it->getCat($dbCustom,$row->item_id);
		}

		$clean_likes_array = array();
		//print_r($t);
		if($t != ''){
			$clean_likes_array = $this->multi_unique($t);
		}
		
		return $clean_likes_array; 
		
	}
	
	
	
	function getLikesItems($item_id)
	{
		$ts = time();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
	
		$sql = "SELECT word 
				FROM key_words 
				WHERE item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);
	
		$i = 0;
		$t = '';
		while($row = $result->fetch_object()){
	
			$word = $row->word;
	
			$sql = "SELECT item.item_id
						,item.profile_item_id
						,item.name
						,item.img_id
						,item.seo_url
						,image.file_name
						,item.img_alt_text
						,item.price_flat
						,item.price_wholesale 
						,item.percent_markup
						,item.call_for_pricing
						,item.hide_id_from_url
						,item.brand_id
						,item.show_in_cart
						,item.show_atc_btn_or_cfp
						,item.show_start_design_btn
						,item.show_design_request_btn						
					FROM key_words, item, image 
					WHERE key_words.item_id = item.item_id
					AND item.img_id = image.img_id
					AND item.profile_account_id ='".$_SESSION['profile_account_id']."' 
					AND item.item_id != '".$item_id."'
					AND key_words.word LIKE '".$word."'
					AND item.date_inactive > '".$ts."'
					AND item.date_active <= '".$ts."'					
					AND item.active = '1'
					";
			$res = $dbCustom->getResult($db,$sql);		
			while($wl_kw_row = $res->fetch_object()){
				if($wl_kw_row->item_id != $item_id){					
					if($i < 6){
						$t[$i]['item_id'] = $wl_kw_row->item_id;
						
						
						$t[$i]['profile_item_id'] = $wl_kw_row->profile_item_id;
						$t[$i]['name'] = $wl_kw_row->name;
						$t[$i]['file_name'] = $wl_kw_row->file_name;
						//$t[$i]['cat_id'] = getCatFromItem($item_id);
						$t[$i]['cat_id'] = 0;
						$t[$i]['seo_url'] = $wl_kw_row->seo_url;
						$t[$i]['img_alt_text'] = $wl_kw_row->img_alt_text;
						if($wl_kw_row->price_flat > 0){
							$t[$i]['price'] = $wl_kw_row->price_flat;
						}elseif($wl_kw_row->price_wholesale > 0){
							$t[$i]['price'] = $wl_kw_row->price_wholesale + $wl_kw_row->percent_markup; 
						}else{
							$t[$i]['price'] = 0;
						}
						$t[$i]['call_for_pricing'] = $wl_kw_row->call_for_pricing;
						$t[$i]['hide_id_from_url'] = $wl_kw_row->hide_id_from_url;
						$t[$i]['brand_id'] = $wl_kw_row->brand_id;
						$t[$i]['show_in_cart'] = $wl_kw_row->show_in_cart;
						
						$t[$i]['show_atc_btn_or_cfp'] = $wl_kw_row->show_atc_btn_or_cfp;
						$t[$i]['show_start_design_btn'] = $wl_kw_row->show_start_design_btn;
						$t[$i]['show_design_request_btn'] = $wl_kw_row->show_design_request_btn;
						 
						$i++;
					}
				}
				 
			}
		}
		
		$clean_likes_array = array();
		//print_r($t);
		if($t != ''){
			$clean_likes_array = $this->multi_unique($t);
		}
		
		return $clean_likes_array; 
			
	}
	
	function getLikesItemsFromArray($array = array()){
		
		$t = array();
		
		if(count($array) > 0){
			foreach($array as $value){
				$t = array_merge($t,$this->getLikesItems($value['item_id']));
			}
		}
		if($t != ''){
			$t = $this->multi_unique($t);
		}
		
		return $t; 
	}
	
	
	
	function like_items_remove($array, $item_id) {
		$t = '';	
		$i = 0;
		foreach($array as $val){
			if($val['item_id'] != $item_id){
				if(is_numeric($val['item_id'])){
					$t[$i]['item_id'] = $val['item_id'];
					$t[$i]['name'] = $val['name'];
					$t[$i]['file_name'] = $val['file_name'];
					$i++;
				}
			}
		}
		
		return $t;
	}

	
	
	
	function multi_unique($array) {
		
		if(count($array) > 0){
		
			foreach ($array as $k=>$na) $new[$k] = serialize($na);
					
			$uniq = array_unique($new);
				
			foreach($uniq as $k=>$ser) $new1[$k] = unserialize($ser);
				
			return ($new1);
		
		}else{
			return $array;	
		}
	}
	
	
}

?>
