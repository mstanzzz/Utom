<?php

if(isset($_GET['cat_id'])){
	$cat_id = $_GET['cat_id'];
	$profile_cat_id = $store_data->getProfileCatFromCat($cat_id);	
}else{
	$profile_cat_id =  (isset($_GET['prodCatId'])) ? addslashes($_GET['prodCatId']) : 0;
	$cat_id = $store_data->getCatFromProfileCat($profile_cat_id);
}

$num_sub_cats = 0;

$lgn = new CustomerLogin;
$brand_id =  (isset($_GET['brandId'])) ? $_GET['brandId'] : 0;
$price_bottom = (isset($_GET['priceBottom'])) ? $_GET['priceBottom'] : 0;
$price_top = (isset($_GET['priceTop'])) ? $_GET['priceTop'] : 0;
$alpha = (isset($_GET['alpha'])) ? $_GET['alpha'] : 'A';
$slug =  (isset($_GET['slug'])) ? $_GET['slug'] : 'category';
$sort =  (isset($_GET['sort'])) ? $_GET['sort'] : '';
$page_rows =  (isset($_GET['pageRows'])) ? $_GET['pageRows'] : 6;
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 1;
$view_type = (isset($_COOKIE['view_type'])) ? $_COOKIE['view_type'] : 'list';

$db = $dbCustom->getDbConnect(CART_DATABASE);


$parent_cat_name = '';
$brand_name = '';

if(!is_numeric($cat_id)) $cat_id = 0;
if(!is_numeric($brand_id)) $brand_id = 0;


//$the_page_label = str_replace('-',' ',$the_page_name);
if($parent_cat_name != ''){
	$title = $parent_cat_name;	
}elseif($brand_name != ''){
	$title = $brand_name;	
}else{
	$title = $seo->title;		
}
if($title == ''){
	$title = $_SESSION['profile_company'];
}
$title = str_replace("\"", '', $title);
$title = ucwords($title);

if($cat_id > 0){
	$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'cart');			
}else{
	$long_array = $store_data->getItemDataFromBrand($brand_id, $price_bottom, $price_top);		
}

$num_products = count($long_array);				


if($cat_id > 0){
	echo $num_products." Products</span>".$parent_cat_name."</h1>";		
	$sub_cats = $store_data->getSubCatsWithData($cat_id, 'cart', $price_bottom, $price_top);
	$i = 1;
	
	$temp_store = array();
	$i = 0;
	$j = 0;
							
	foreach($sub_cats as $v){
		$temp_store[$j]['destination'] = $v['destination'];
		$temp_store[$j]['seo_url'] = $v['seo_url'];
		$temp_store[$j]['profile_cat_id'] = $v['profile_cat_id'];
		$temp_store[$j]['img_file_name'] = $v['img_file_name'];
		$temp_store[$j]['img_alt_text'] = $v['img_alt_text'];
		$temp_store[$j]['name'] = $v['name'];
		$j++;								
	}
	
	$sub_cats = array_merge($temp_showroom, $temp_store);								
	foreach($sub_cats as $sub_cat){	
		$url_str = $nav->getCatUrl($sub_cat['name'], $sub_cat['profile_cat_id'], 'shop');
		echo "<a href='".$url_str."'>";								
		echo "<img src='../../saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$sub_cat['img_file_name']."'/>"; 
		echo $sub_cat['name'];
		echo "</a>";
		echo $block;
	}						

}

echo "<br />";
echo "<hr />";
echo "<br />";

$items_array = array_slice($long_array, $start_elmt, $max_elmt);

$block = '';
foreach($items_array as $item){
	$brand_name = getBrandName($item['brand_id']);
	$itemDetailUrl = $nav->getItemUrl($item['seo_url'], $item['name'], $item['profile_item_id'], $brand_name, 'shop');
	$block .="<a href='".$itemDetailUrl."'>";
	$block .="<img src='../../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$item['file_name']."'"; 
	$block .=" /></a>";
	$block .="<h3><a href='".$itemDetailUrl."'>".stripSlashes($item['name'])."</a></h3>";
	$block .="<h5><a href='".$itemDetailUrl."'>(Product Id: ".sprintf('%06d',$item['profile_item_id']).")</a></h5>";
	if($item['call_for_pricing'] || $item['price'] <= 0){
		$block .="Call For Price";
	}else{
		$block .="<strong>$".number_format($item['price'],2)."</strong> per ea.";						
	}
	$block .="QTY:<input id='qty".$item['item_id']."' type='text' name='qty'  value='1' />";										
	$block .="<a id='add_".$item['item_id']."' onClick=\"add_item('".$item['item_id']."')\">Add To Cart</a>";
							
}
echo $block;
?>
