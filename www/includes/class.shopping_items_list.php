<?php
class ShoppingItemsList {
	function getList(
		$id
		,$id_type 
		,$sort_type 
		,$pagenum
		,$page_rows
		,$view_type
		,$filter_array
		) {
			
		// set default, empty item to return in case we don't have any results for our query
		$listobj = array(
			"current_page" => $pagenum,
			"items_count"  => 0,
			"page_rows"  => $page_rows,
			"page_count" => 0,
			"id" => $id,
			"cat_id" => 0,
			"id_type" => $id_type,
			"view_type" => $view_type,
			"sort_type" => $sort_type,
			"filter_array" => $filter_array,
			"filter_qstr" => '',
			"items" => 0
		);
		$ret = array(); //will hold the multidimensional array of items with their properties		
		//filtering results...
		$new_filter_qstr = array("filter_qstr"=>$filter_array);
		$filter_qstr = is_array($filter_array) ? "&".http_build_query($new_filter_qstr,"filter_") : '';
		$sql_filter = (is_array($filter_array)) ? $this->createFilterQuery($filter_array) : '';
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		if ($id > 0){
			$cat_id = $id;
			if($id_type == "category"){
				$sql = "SELECT child_cat_to_parent_cat_id
						FROM child_cat_to_parent_cat
						WHERE child_cat_to_parent_cat.parent_cat_id = '".$id."'";
		$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					//TODO: Add 'table' from filter array (if filter array is not empty) to sql query
					$sql = "SELECT DISTINCT item.item_id 
								,item.name
								,image.file_name
								,item.is_closet
								,item.price_flat 
							FROM item, item_to_category, category, child_cat_to_parent_cat, image
							WHERE item.item_id = item_to_category.item_id
							AND item_to_category.cat_id = category.cat_id
							AND child_cat_to_parent_cat.child_cat_id = category.cat_id
							AND item.img_id = image.img_id
							AND (child_cat_to_parent_cat.parent_cat_id = '".$id."'
								OR category.cat_id = '".$id."')
							AND date_inactive > NOW()
							AND date_active <= NOW()
							AND category.show_in_cart = '1'
							AND item.parent_item_id = '0'				
							AND item.show_in_cart = '1'
							AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
				}else{
					$sql = "SELECT DISTINCT item.item_id 
									,item.name
									,image.file_name
									,item.is_closet
									,item.price_flat
							FROM item, item_to_category, category, image
							WHERE item.item_id = item_to_category.item_id
							AND item_to_category.cat_id = category.cat_id
							AND item.img_id = image.img_id
							AND category.cat_id = '".$id."'
							AND date_inactive > NOW()
							AND date_active <= NOW()
							AND item.parent_item_id = '0'
							AND item.show_in_cart = '1'
							AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
				}
			}
			elseif($id_type == "brand"){
				$sql = "SELECT DISTINCT item.item_id
							,item.name
							,image.file_name
							,item.is_closet
							,item.price_flat 
						FROM item, image
						WHERE item.img_id = image.img_id
						AND item.brand_id = '".$id."'
						AND item.parent_item_id = '0'
						AND item.show_in_cart = '1'
						AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
			}
			elseif($id_type == "vendor"){
				$sql = "SELECT DISTINCT item.item_id
								,item.name
								,image.file_name
								,item.is_closet
								,item.price_flat 
						FROM item, image
						WHERE item.img_id = image.img_id
						AND item.vend_man_id = '".$id."'
						AND item.parent_item_id = '0'
						AND item.show_in_cart = '1'
						AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
			}
		}
		elseif($id != '' && $id_type == "searchstr"){
			$search_string = $id;
			$cat_id = 0;
			$sql = "SELECT DISTINCT item.item_id
					,item.name
					,image.file_name
					,item.is_closet
					,item.price_flat 
			FROM item, image, key_words
			WHERE item.img_id = image.img_id
			AND key_words.item_id = item.item_id  
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
			AND (item.name LIKE '%".$search_string."%'
			OR key_words.word = '".$search_string."'
			OR item.description LIKE '%".$search_string."%'
			OR item.color = '".$search_string."'
			OR item.finish = '".$search_string."')";
			}
		if ($id != '' || $id > 0){	
			// add filters...
			if ($sql_filter != ''){
				$sql .= $sql_filter;	
			}
			
			$nmx_res = $dbCustom->getResult($db,$sql);
			
			if ($nmx_res && mysql_num_rows($nmx_res) > 0)
			{
				$rows = $nmx_res->num_rows;
				$last = ceil($rows/$page_rows); 
				
				if ($pagenum < 1){ 
					$pagenum = 1; 
				}elseif ($pagenum > $last){ 
					$pagenum = $last; 
				} 
				
				
				$limit = ' limit '.$page_rows.' OFFSET '.($pagenum - 1) * $page_rows;
				
				// TODO: Change ORDER BY based on $sort_type value
				
				$sql2 = $sql."ORDER BY item.item_id".$limit;
				$result = mysql_query($sql2);
				
				$num_res = $result->num_rows;
				$i = 0;
				while($row = $result->fetch_object()) {
		
					// TODO: set new class settings for what type of product ID to display
					// then pull the correct product number to display to users
					
					// TODO: set new class settings for what type of price to display
					// then pull the correct prices to display to users; for now, flat price
					
					// TODO: set new class settings for whether or not to display a discount
					
					// TODO: set 'new' items markup/classes and pull data
					
					$ret[$i]["image_file_name"] = $row->file_name;
					$ret[$i]["item_is_closet"] = $row->is_closet;
					$ret[$i]["item_name"] = $row->name;
					$ret[$i]["item_id"] = $row->item_id;
					$ret[$i]["item_price"] = $row->price_flat;
					$ret[$i]["item_cat_id"] = $id;
					$i++;
					
				}
				$listobj = array(
					"current_page" => $pagenum,
					"items_count"  => $rows,
					"page_rows"  => $page_rows,
					"page_count" => $last,
					"id" => $id,
					"cat_id" => $cat_id,
					"id_type" => $id_type,
					"view_type" => $view_type,
					"sort_type" => $sort_type,
					"filter_array" => $filter_array,
					"filter_qstr" => $filter_qstr,
					"items" => $ret
				);
			}
		}
		return $listobj;

	}
	function createFilterQuery($filter_array) {
		//TODO: Add 'table' from filter array to sql query
		$sql_filter = '';
		$i = 0;
		foreach($filter_array as $filter){
			if ($filter[$i]['name'] != "none"){
				if ($filter[$i]['name'] == "price" && $filter[$i]["type"] == "range"){
					$price_bottom = $filter[$i]['values'][0][0];
					$price_top = $filter[$i]['values'][0][1];
					$sql_filter .=" AND item.price_flat >= '".$price_bottom."' AND item.price_flat <=  '".$price_top."'";
				}
				else if($filter[$i]['type']=='single'){
					$sql_filter .=" AND item.".$filter[$i]['name']." = '".$filter[$i]['values'][0][0]."'";
				}
				else {
					
				}
			}
			$i++;
		}
		return $sql_filter;

	}
	
	
	function getBrandsByAlpha($q){
		
		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$brandList = array("items_count"=>0);
		if ($q != NULL && $q != ''){
			if($q == "1-9"){ 
				$search_str = "[0-9]";
			}else{
				$search_str = $q;
			}
			$sql = "SELECT name, brand_id 
					FROM brand 
					WHERE name REGEXP '^".$search_str."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY brand_id";
	$result = $dbCustom->getResult($db,$sql);			
			$num_items = $result->num_rows;
			if($num_items > 0){
				$i = 0;
				$ret;
				while($row = $result->fetch_object()){
					$ret[$i]['url'] = $_SERVER['DOCUMENT_ROOT']."/".getUrlFileName('shop')."/brand/".getUrlText($row->name)."/".$row->brand_id;
					$ret[$i]['name'] = $row->name;
					$ret[$i]["id"] = $row->brand_id;
					$i++;
				}
				$brandList = array("items_count" => $num_items,
									"brands_array" => $ret);
			}
		}
		return $brandList;
	}
}
?>
