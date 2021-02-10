<?php
/* ms */
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart_item.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.store_data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');

$store_data = new StoreData;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$nav = new Nav;

// needed to prevent checkout refresh
$_SESSION['no_order_refreash'] = 0;
$slug =  (isset($_GET['slug'])) ? addslashes($_GET['slug']) : 'home';

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_GET['cat_id'])){
	$cat_id = $_GET['cat_id'];
	$profile_cat_id = $store_data->getProfileCatFromCat($cat_id);	
}

if(isset($_GET['prodCatId'])){
	$profile_cat_id =  (isset($_GET['prodCatId'])) ? addslashes($_GET['prodCatId']) : 0;
	$cat_id = $store_data->getCatFromProfileCat($profile_cat_id);
}

if(!is_numeric($cat_id)) $cat_id = 0;
if(!is_numeric($profile_cat_id)) $profile_cat_id = 0;

echo "cat_id ".$cat_id;
echo "<br />";
echo "profile_cat_id ".$profile_cat_id;
echo "<br />";
echo "<br />";

?>
<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=UTF-8>
<meta name=viewport content="width=device-width,initial-scale=1">
<meta http-equiv=X-UA-Compatible content="ie=edge">

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>

function getScreenWidth(){
	var h = $(window).height();
	var w = $(window).width();
	alert("------- width:"+w);
}

function add_item(item_id){
	
	var qty = 1;
	//var qty = $("#qty"+item_id).val();
	//alert(item_id+"     "+qty);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/pages/cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
			//alert(data);
			$("#cart_msg").html(data);			
		}
	});	
}

</script>
</head>
<body>

<br />
<a href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/site-map.php">site-map</a>

<div id="cart_msg" style="float:right; margin:20px;"> </div>

<div style="float:right; margin:20px;">
<a  href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/shopping-cart.html">YOUR CART</a>
</div>
<br />
<?php

echo 'Top Categories';
echo "<br />";
$char_limit = 26;
$top_cat_array = $nav->getTopCats();
$str = '';				
foreach($top_cat_array as $val){
	$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'shop');	
	$str .= "<a href='".$url_str."'>";		
	$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$val['file_name'];	
	$str .= "<img src='".$img."' />";
	$str .= "<br />";
	$str .= $val['name']."||";			
	$str .= "<br />";
	$str .= "</a>";					
}
echo $str;

echo "<br />";
echo "<br />";
echo "***************************************************************";
echo "<br />";
echo "SUB Categories";
echo "<br />";
echo "<br />";

function get_img_fn($img_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT file_name 
			FROM image
			WHERE img_id = '".$img_id."'";
	$res = $dbCustom->getResult($db,$sql);				
	if($res->num_rows > 0){
		$obj = $res->fetch_object();
		return $obj->file_name;
	}
	
	return '';
	
}

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
//$sql .= " AND category.show_in_cart = '1'";
		
$result = $dbCustom->getResult($db,$sql);				
while($row = $result->fetch_object()) {
	
	$file_name = get_img_fn($row->img_id);

	echo "profile_cat_id ".$row->profile_cat_id;
	echo "<br />";
	$url_str = $nav->getCatUrl($row->name, $row->profile_cat_id, 'shop');
	echo $url_str;
	echo "<br />";
	echo "<a href='".$url_str."'>";	
	$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name;
	echo "<img src='".$img."' />";
	echo "<br />";
	echo $row->name;			
	echo "<br />";
	echo "</a>";					
}


echo "<br />";
echo "<br />";
echo "***************************************************************";
echo "<br />";
echo "Items";
echo "<br />";
echo "<br />";

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
AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		

echo "num_rows".$result->num_rows;
echo "<br />";
while($row = $result->fetch_object()){
				 
	$url_str = $nav->getItemUrl($row->seo_url, $row->name, $row->profile_item_id, '', 'shop');
	echo "<a href='".$url_str."'>";	
	$img = "./saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$row->file_name;
	echo "<img src='".$img."' />";
	echo "<br />";
	echo stripslashes($row->name);			
	echo "<br />";
	echo stripslashes($row->price);			
	echo "<br />";
	echo "</a>";					
	echo "<span style='cursor:pointer' onClick='add_item(".$row->item_id.")' > ADD TO CART </span>";					


}

echo "<br />";
echo "<br />";

						











function MS_getUrlText($str){
		$t = trim($str);
		$t = str_replace (" " ,"-" ,$t);
		
		if(substr($t,0) == '-'){
			$t = substr($t,1);	
		}
		
		$t = str_replace ("/" ,"-" ,$t);
		$t = preg_replace( '/[^a-zA-Z0-9-]+/', '', $t );	
		$t = str_replace ("--" ,"-" ,$t);
		return strtolower($t); 
}


?>
