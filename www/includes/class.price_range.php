<?php
require_once("accessory_cart_functions.php");

class PriceRange {
	
	
	function __construct() {
		//unset($_SESSION["nav_price_range_array"]);
		if(!isset($_SESSION["nav_price_range_array"])){
		
			$this->addPriceRange(0,50);
			$this->addPriceRange(50,100);
			$this->addPriceRange(100,200);
			$this->addPriceRange(200,500);
			$this->addPriceRange(500,1000);
			$this->addPriceRange(1000,5000);
			$this->addPriceRange(5000,90000);
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
	
	function getNavPriceRangeBlock($cat_id=0, $cat_seo_url='', $brand_id=0)
	{
		
		$block = '';
		$block .= "<ul>";
		$j=0;	
		foreach($_SESSION['nav_price_range_array'] as $i => $val){
					
			$price_btm = $_SESSION['nav_price_range_array'][$i]['bottom'];
			$price_tp = $_SESSION['nav_price_range_array'][$i]['top']; 							

			$item_count = $this->getPriceRangeItemsCount($price_btm,$price_tp,$cat_id,$brand_id);
			if($item_count > 0){				

$block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$cat_seo_url."category.html?priceBottom=".$price_btm."&priceTop=".$price_tp."&catId=".$cat_id."&brandId=".$brand_id."'>";
$block .= '<li>$'.$price_btm.' to $'.$price_tp.' ('.$item_count.')</li></a>';


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

	
	function getPriceRangeItemsCount($price_bottom,$price_top,$cat_id=0, $brand_id=0)
	{
		$ts = time();	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		if($cat_id > 0){


			$sql = "SELECT count(child_cat_to_parent_cat_id) as n
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$cat_id."'
					OR child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			
			$n = $result->fetch_array();
			
			if($n['n'] > 0){

				$sql = "SELECT DISTINCT item.item_id 
						,item.name
						,image.file_name
						,item.is_closet
						,item.seo_url
						,item.img_alt_text
						,price_flat
						,price_wholesale
						,percent_markup 
					FROM item, item_to_category, category, child_cat_to_parent_cat, image
					WHERE item.item_id = item_to_category.item_id
					AND item_to_category.cat_id = category.cat_id
					AND child_cat_to_parent_cat.child_cat_id = category.cat_id
					AND item.img_id = image.img_id
					AND (child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
						OR category.cat_id = '".$cat_id."')
					AND date_inactive > '".$ts."'
					AND date_active <= '".$ts."'
					AND category.show_in_cart = '1'
					AND item.parent_item_id = '0'				
					AND item.show_in_cart = '1'
					AND item.active = '1'
					AND item.call_for_pricing = '0'				
					AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";

			}else{

				$sql = "SELECT DISTINCT item.item_id 
						,item.name
						,image.file_name
						,item.is_closet
						,item.seo_url
						,item.img_alt_text
						,price_flat
						,price_wholesale
						,percent_markup 
					FROM item, item_to_category, category, image
					WHERE item.item_id = item_to_category.item_id
					AND item_to_category.cat_id = category.cat_id
					AND item.img_id = image.img_id
					AND category.cat_id = '".$cat_id."'
					AND item.date_inactive > '".$ts."'
					AND item.date_active <= '".$ts."'
					AND item.parent_item_id = '0'
					AND item.show_in_cart = '1'
					AND item.active = '1'
					AND item.call_for_pricing = '0'				
					AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";

			}
			
		}elseif($brand_id > 0){

			$sql = "SELECT DISTINCT item.item_id
						,item.name
						,image.file_name
						,item.is_closet
						,item.seo_url
						,item.img_alt_text
						,price_flat
						,price_wholesale
						,percent_markup 						
			FROM item, image
			WHERE item.img_id = image.img_id
			AND item.brand_id = '".$brand_id."'
			AND item.parent_item_id = '0'
			AND item.show_in_cart = '1'
			AND item.date_inactive > '".$ts."'
			AND item.date_active <= '".$ts."'
			AND item.active = '1'
			AND item.call_for_pricing = '0'			
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";

		}else{
			$sql = "SELECT item.item_id 
					,item.name
                    ,image.file_name
					,item.is_closet
					,item.seo_url
					,item.img_alt_text
					,price_flat
					,price_wholesale
					,percent_markup 					
				FROM item, image
				WHERE item.img_id = image.img_id
				AND item.parent_item_id = '0'
				AND item.show_in_cart = '1'
				AND item.date_inactive > '".$ts."'
				AND item.date_active <= '".$ts."'
				AND item.active = '1'
				AND item.call_for_pricing = '0'				
				AND item.profile_account_id ='".$_SESSION['profile_account_id']."'";
		}

		//echo $sql;
		//exit;
				
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		while($row = $res->fetch_object()){			
			
			if($row->price_flat > 0){
				$price = $row->price_flat;	
			}elseif($row->price_wholesale > 0){
				$price = $row->price_wholesale + $row->percent_markup; 
			}else{
				$price = 0;	
			}

			if($price >= $price_bottom && $price <= $price_top){
				
				$i++;
			}
		}
		
		//return multi_unique($t);
		return	$i;
	
	}
   	 
    
	
}

?>
