<?php

class Category {


	function getMaxItemCatId($item_id)
	{		
		$ret = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT MAX(cat_id) AS cat_id 
				FROM item_to_category
				WHERE item_id = '".$item_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$ret = $object->cat_id;
		}
		
		return $ret;
	}

	function getCatName($cat_id)
	{		
		$ret = '';
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT name 
				FROM category
				WHERE cat_id = '".$cat_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);				
		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$ret = $object->name;
		}
		
		return $ret;
	}

}

?>
