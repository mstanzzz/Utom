<?php
require_once("../../includes/config.php"); 

//echo "kkkk";
//print_r($_SESSION['temp_cat_ids']);
//$action = $_GET['action'];
//$kw_id = $_GET['kw_id'];
//$kw = $_GET['kw'];
//$ret_page = $_GET['ret_page'];
//echo "kw".$kw_id;
	
	$ct_out = explode(",",$_GET['str_cats']);
	//print_r($ct_out);
	//print_r($_SESSION['temp_cat_ids']);
	
	foreach($ct_out as $ct_out_v){
		$ct_in = explode("|",$ct_out_v);		
		if(count($ct_in) > 1){
			foreach($_SESSION['temp_cat_ids'] as $j => $v){
				if($v['cat_id'] == $ct_in[0]){
					$_SESSION['temp_cat_ids'][$j]["checked"] = $ct_in[1];
				}
			}
		}
	}
	
	//print_r($_SESSION['temp_cat_ids']);
	$_SESSION['temp_item_fields']["date_active"] = $_GET["date_active"];
		
	$_SESSION['temp_item_fields']["date_inactive"] = $_GET["date_inactive"];

	$_SESSION['temp_item_fields']['name'] = $_GET['name'];
	
	$_SESSION['temp_item_fields']["short_description"] = $_GET["short_description"];
	$_SESSION['temp_item_fields']['description'] = $_GET['description']; 
	$_SESSION['temp_item_fields']["is_closet"] = $_GET["is_closet"];
	$_SESSION['temp_item_fields']['show_in_cart'] = $_GET['show_in_cart'];
	$_SESSION['temp_item_fields']['show_in_showroom'] = $_GET['show_in_showroom'];
	
	$_SESSION['temp_item_fields']["price_flat"] = $_GET["price_flat"];
	$_SESSION['temp_item_fields']["price_wholesale"] = $_GET["price_wholesale"];
	$_SESSION['temp_item_fields']["percent_markup"] = $_GET["percent_markup"];
	$_SESSION['temp_item_fields']["percent_off"] = $_GET["percent_off"];
	$_SESSION['temp_item_fields']["amount_off"] = $_GET["amount_off"];
	$_SESSION['temp_item_fields']["is_taxable"] = $_GET["is_taxable"];
	$_SESSION['temp_item_fields']["call_for_pricing"] = $_GET["call_for_pricing"];

?>


