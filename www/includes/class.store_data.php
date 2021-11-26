<?php
require_once("accessory_cart_functions.php");

class StoreData {

	function getCartItemsFromSvg($dbCustom,$svg_id){		
		if(!is_numeric($svg_id)) $svg_id = 0;
		$t = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);


		$sql = "SELECT category.cat_id
					,item.item_id 
					,item.name
					,image.file_name
					,item.short_description
					,item.description
					,item.price_flat
				FROM category, item, item_to_category, image
				WHERE category.cat_id = item_to_category.cat_id
				AND item_to_category.item_id = item.item_id	
				AND item.img_id = image.img_id
				AND item.active > '0'
				AND category.active > '0'
				AND category.svg_id = '".$svg_id."'";
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;
		while($row = $result->fetch_object()){
			$t[$i]['item_id'] = $row->item_id;
			$t[$i]['cat_id'] = $row->cat_id;
			$t[$i]['name'] = stripcslashes($row->name);
			$t[$i]['file_name'] = $row->file_name;
			$t[$i]['short_description'] = stripcslashes($row->short_description);
			$t[$i]['description'] = stripcslashes($row->description);
			$t[$i]['price_flat'] = $row->price_flat;
			$i++;
		}
		return $t;
	}


	function getAllCats($dbCustom){
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$t = array();
		$sql = "SELECT *  
				FROM category  
				LEFT JOIN image  
				ON category.img_id = image.img_id";	
		$sql = "SELECT cat_id,name
				FROM category";
		$sql = "SELECT category.cat_id
					,category.name
					,image.file_name					
				FROM category, image
				WHERE category.img_id = image.img_id
				AND category.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
			$t[$i]['cat_id'] = $row->cat_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			$i++;
		}
		return $t;
	}

	function getItemsFromCat($dbCustom,$cat_id){
		if(!is_numeric($cat_id)) $cat_id = 0;
		$ts = time();
		$t = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT item.item_id 
					,item.name
					,image.file_name
					,item.short_description
					,item.description
					,item.show_in_cart
					,item.show_in_showroom						
				FROM item, item_to_category, image
				WHERE item.item_id = item_to_category.item_id
				AND item.img_id = image.img_id
				AND item_to_category.cat_id = '".$cat_id."'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
				$t[$i]['show_in_cart'] = $row->show_in_cart;
				$t[$i]['show_in_showroom'] = $row->show_in_showroom;				
				$i++;
		}
		return $t;
	}

	function getItems($dbCustom,$show_in = '', $limit = 0){
		$ts = time();
		$t = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		if(!is_numeric($limit)) $limit = 0;
		$sql = "SELECT item.item_id 
					,item.profile_item_id
					,item.name
					,image.file_name
						,item.short_description
						,item.description
						,item.show_in_cart
						,item.show_in_showroom
						,item.img_alt_text
				FROM item, image
				WHERE item.img_id = image.img_id 
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$sql .= " ORDER BY click_count DESC";
				
				
		if($limit > 0){	
			$sql .= " LIMIT ".$limit;
		}
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
			$t[$i]['item_id'] = $row->item_id;
			$t[$i]['profile_item_id'] = $row->profile_item_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			$t[$i]['short_description'] = $row->short_description;
			$t[$i]['description'] = $row->description;
			$t[$i]['show_in_cart'] = $row->show_in_cart;
			$t[$i]['show_in_showroom'] = $row->show_in_showroom;
			$t[$i]['img_alt_text'] = $row->img_alt_text;
			
			$i++;
		}
		return $t;
	}
	
	// I stopped using this. Items nolonger have svg_id
	function get_items_by_svg_id($dbCustom,$svg_id, $limit = 0){
		if(!is_numeric($svg_id)) $svg_id = 0;
		if(!is_numeric($limit)) $limit = 0;
		$t = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT item.item_id 
					,item.name
					,item.short_description
					,item.description
					,item.show_in_cart
					,item.show_in_showroom
				FROM item
				WHERE item.svg_id = '".$svg_id."'"; 
		if($limit > 0){	
			$sql .= " LIMIT ".$limit;
		}
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
				$t[$i]['show_in_cart'] = $row->show_in_cart;
				$t[$i]['show_in_showroom'] = $row->show_in_showroom;				
				$i++;
		}
		return $t;
	}

}

?>
