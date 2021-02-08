<?php

class PriceRangeItems {
	
	
	function __construct() {
	
		if(!isset($_SESSION["nav_price_range_array"])){
		
			$this->addPriceRange(0,100);
			$this->addPriceRange(101,500);
			$this->addPriceRange(501,1000);
			$this->addPriceRange(1001,2000);
			$this->addPriceRange(2001,5000);
			$this->addPriceRange(5001,90000);
		
			
		}

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
	
	function getNavPriceRanges()
	{
		
		
		
		$shop_name = "shop";

		if($_SESSION['seo']){
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
			$sql = "SELECT seo_name 
					FROM page_seo
					WHERE page_name = 'shop'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);					
			if($result->num_rows){
				$object = $result->fetch_object();	
				$shop_name = $object->seo_name;	
			}
			
		}

		
		$block = '';
			
		foreach($_SESSION["nav_price_range_array"] as $i => $val){
					
				$price_btm = $_SESSION["nav_price_range_array"][$i]["bottom"];
				$price_tp = $_SESSION["nav_price_range_array"][$i]["top"]; 							
				$block .= "<li><a href='".$_SERVER['DOCUMENT_ROOT']."/".$shop_name."/range/".$price_btm."/".$price_tp."'>";
				$block .= "$price_btm to $price_tp (".$this->getPriceRangeItemsCount($price_btm,$price_tp).")</a></li>";
					
		}
		
		return $block;
	}



	function getPriceRangeItemsArray($price_bottom,$price_top)
	{
		$t = '';
		 
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		$sql = "SELECT item.item_id 
					,item.name
                    ,image.file_name
					,item.is_closet
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.price_flat > '".$price_bottom."'	
				AND item.price_flat <=  '".$price_top."'
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.profile_account_id ='".$_SESSION['profile_account_id']."'";
				
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		while($row = $res->fetch_object()){			
			$t[$i]["item_id"] = $row->item_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			$t[$i]["is_closet"] = $row->is_closet;

			$i++;
		}
		
		$sql = "SELECT item.item_id 
					,item.name
                    ,image.file_name
					,item.is_closet   
				FROM item, image
				WHERE item.img_id = image.img_id 
				AND price_flat = '0'
				AND (price_wholesale + percent_off) > '".$price_bottom."'
				AND (price_wholesale + percent_off) <= '".$price_top."'
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.profile_account_id ='".$_SESSION['profile_account_id']."'";
								
		$wsres = mysql_query ($sql);
		if(!$wsres)die(mysql_error());
		while($row = mysql_fetch_object($wsres)){					
			$t[$i]["item_id"] = $row->item_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			$t[$i]["is_closet"] = $row->is_closet;
			
			$i++;
		
		}
		return $t;
	}
   	 

/*
	function getPriceRangeItemsArrayWithPaging($price_bottom,$price_top,$limit = '')
	{

		$t = '';
		 
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		$sql = "SELECT item.item_id 
					,item.name
                    ,image.file_name
					,item.is_closet
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.price_flat > '".$price_bottom."'	
				AND item.price_flat <=  '".$price_top."'".$limit;		
		
		$result = $dbCustom->getResult($db,$sql);
		
		
		$i = 0;
		while($row = $res->fetch_object()){			
			$t[$i]["item_id"] = $row->item_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			
			$i++;
		}
		
		$sql = "SELECT item.item_id 
					,item.name
                    ,image.file_name
					,item.is_closet   
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.parent_item_id = '0' 
				AND price_flat = '0'
				AND item.show_in_cart = '1'
				AND (price_wholesale + percent_off) > '".$price_bottom."'
				AND (price_wholesale + percent_off) <= '".$price_top."'".$limit;
								
		$wsres = mysql_query ($sql);
		if(!$wsres)die(mysql_error());
		while($row = mysql_fetch_object($wsres)){					
			$t[$i]["item_id"] = $row->item_id;
			$t[$i]['name'] = $row->name;
			$t[$i]['file_name'] = $row->file_name;
			$i++;
		
		}

		return $t;
	
	}
*/
	
	function getPriceRangeItemsCount($price_bottom,$price_top)
	{
		$fp = 0; 
		$wp = 0;
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT count(item_id) as items_in_range 
				FROM item
				WHERE price_flat > '".$price_bottom."'	
				AND price_flat <=  '".$price_top."'
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND profile_account_id ='".$_SESSION['profile_account_id']."'";
				
		$result = $dbCustom->getResult($db,$sql);
		
		$obj = $res->fetch_object();
		$fp = $obj->items_in_range;
			
		$sql = "SELECT count(item_id) as items_in_range   
				FROM item
				WHERE price_flat = '0'
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND (price_wholesale + percent_off) > '".$price_bottom."'
				AND (price_wholesale + percent_off) <= '".$price_top."'
				AND profile_account_id ='".$_SESSION['profile_account_id']."'";
		$wsres = mysql_query ($sql);
		if(!$wsres)die(mysql_error());
		$obj = mysql_fetch_object($wsres);	
		$wp = $obj->items_in_range;
	
		return	$fp + $wp;
	
	}
   	 
    
	function multi_unique($array) {
		
		if(count($array) > 0){
		
			foreach ($array as $k=>$na) $new[$k] = serialize($na);
					
			$uniq = array_unique($new);
				
			foreach($uniq as $k=>$ser) $new1[$k] = unserialize($ser);
				
			return ($new1);
		
		}else{
			return '';	
		}
	}
	
	
}

?>
