<?php


/*
function getSearchShowroomItemBar($num_res)
{

	$block ='';
	$block .="<div class='clear'></div><div class='accessories_item_container_top'>";
	$block .="<div style='padding-left:30px; padding-top:3px; float:left;'>".$num_res."  Products Found</div>";
	$block .="<div style='padding-left:40px;  padding-top:3px; float:left;'>View as:</div>";
	$block .="<a style='cursor:pointer;' onclick='get_search_showroom_item_list();'>";
	$block .="<div style='padding-left:8px;  padding-top:5px; float:left;'><img src='".SITEROOT."/images/icons/list.gif' /></div>";
	$block .="<div style='padding-left:8px;  padding-top:3px; float:left;'>List</div>";
	$block .="</a>";
	$block .="<a style='cursor:pointer;' onclick='get_search_showroom_item_grid();'>";
	$block .="<div style='padding-left:20px;  padding-top:5px; float:left;'><img src='".SITEROOT."/images/icons/grid.gif' /></div>";
	$block .="<div style='padding-left:8px;  padding-top:3px; float:left;'>Grid</div>";
	$block .="</a>";	
	$block .="</div><div class='clear'></div>";
	return $block;

}
*/

function getSrTopCats()
{
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	if(!isset($_SESSION["sr_top_cats"])){
		$sql = "SELECT cat_id, name
				FROM category 
				WHERE show_in_showroom = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY cat_id"; 
$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
			$t[$i]["sr_cat_id"] = $row->cat_id;
			$t[$i]['name'] = $row->name;
			$t[$i]["num_items"] = getNumItems($row->cat_id);
			$i++;
		}		
		$_SESSION["sr_top_cats"] = $t;
	}

	return $_SESSION["sr_top_cats"];
}


/*
function getPrevItem($item_id, $cat_id){
	$sql = "SELECT showroom_item.showroom_item_id
			FROM showroom_category, showroom_item
			WHERE showroom_category.showroom_cat_id = showroom_item.showroom_cat_id
			AND showroom_category.showroom_cat_id = '".$cat_id."'
			AND showroom_item.showroom_item_id < '".$item_id."'";
		
$result = $dbCustom->getResult($db,$sql);			
	$obj = $result->fetch_object();		
	return $obj->showroom_item_id;		
}

function getNextItem($item_id, $sr_cat_id = 0){
	if($sr_cat_id > 0)
		$sql = "SELECT showroom_item.showroom_item_id
			FROM showroom_category, showroom_item
			WHERE showroom_category.showroom_cat_id = showroom_item.showroom_cat_id
			AND showroom_category.showroom_cat_id = '".$sr_cat_id."'
			AND showroom_item.showroom_item_id > '".$item_id."'";
	else{
		$sql = "SELECT showroom_item.showroom_item_id
			FROM showroom_item
			WHERE showroom_item.showroom_item_id > '".$item_id."'";
		
	}
$result = $dbCustom->getResult($db,$sql);			
	$obj = $result->fetch_object();	
	$ret = ($result->num_rows > 0)? $obj->showroom_item_id : 0; 
	return $ret; 	

}

*/
	
function getNumItems($cat_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT DISTINCT item.item_id
				FROM category, item, item_to_category 
				WHERE category.cat_id = item_to_category.cat_id
				AND item_to_category.item_id = item.item_id
				AND item.show_in_showroom = '1' 
				AND category.cat_id = '".$cat_id."'"; 
$result = $dbCustom->getResult($db,$sql);			
	return $result->num_rows;
}
	
	

function getSrSubCats()
{
	if(!isset($_SESSION["all_sr_cats"])){
		$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);

		$sql = "SELECT showroom_sub_category.showroom_cat_id, showroom_sub_category.name
				FROM showroom_sub_category
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
			$t[$i]["sr_cat_id"] = $row->cat_id;
			$t[$i]['name'] = $row->name;
			$i++;
		}
		
		$_SESSION["all_cats"] = $t;
	}
	return $_SESSION["all_cats"];
}




?>
