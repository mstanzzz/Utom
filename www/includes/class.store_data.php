<?php
require_once("accessory_cart_functions.php");

class StoreData {

	function getAllCats(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$t = array();
		
		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,image.file_name					
				FROM category, image
				WHERE category.img_id = image.img_id
				AND category.profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
				$t[$i]['cat_id'] = $row->cat_id;
				$t[$i]['profile_cat_id'] = $row->profile_cat_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				
				$i++;
		}
		return $t;
				
		
	}

	function getItemsFromCat($cat_id){
	
		if(!is_numeric($cat_id)) $cat_id = 0;
		
		$ts = time();
		$t = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT item.item_id 
						,item.profile_item_id
						,item.name
						,image.file_name
						,item.short_description
						,item.description											
				FROM item, item_to_category, image
				WHERE item.item_id = item_to_category.item_id
				AND item.img_id = image.img_id
				AND item_to_category.cat_id = '".$cat_id."'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
	
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;
		while($row = $result->fetch_object()){
				$t[$i]['item_id'] = $row->item_id;
				$t[$i]['profile_item_id'] = $row->profile_item_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['short_description'] = $row->short_description;
				$t[$i]['description'] = $row->description;
				
				$i++;
		}
		return $t;
	}

}

?>
