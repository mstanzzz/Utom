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

echo "Sub Cats";
echo "<br />";

if($cat_id > 0){
	$sub_cats = $store_data->getSubCatsWithData($cat_id, 'cart', $price_bottom, $price_top);
	$i = 1;
	
	$temp_store = array();
	$i = 0;
	$j = 0;
							
	foreach($sub_cats as $v){
		$temp_store[$j]['destination'] = $v['destination'];
		$temp_store[$j]['seo_url'] = $v['seo_url'];
		$temp_store[$j]['profile_cat_id'] = $v['profile_cat_id'];
		$temp_store[$j]['file_name'] = $v['file_name'];
		$temp_store[$j]['img_alt_text'] = $v['img_alt_text'];
		$temp_store[$j]['name'] = $v['name'];
		$j++;								
	}
	
	$sub_cats = array_merge($temp_showroom, $temp_store);								
	
	foreach($sub_cats as $sub_cat){	
		$url_str = $nav->getCatUrl($sub_cat['name'], $sub_cat['profile_cat_id'], 'shop');

		$block .= "<div style='margin:6px; float:left; padding:6px; border-style:solid; border-color:blue;'>";
		$block .="<a href='".$url_str."'>";	
		
$img = $ste_root."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$sub_cat['file_name'];

		$block .="<img width='200' src='".$img."'"; 
		$block .=" /></a>";
		$block .="<br />";								
		$block .="<h3><a href='".$itemDetailUrl."'>".stripSlashes($sub_cat['name'])."</a></h3>";
	
		$block .= "</div>";								
		
		
		
	}						
	echo $block;
}

echo $num_products." Products</span>".$parent_cat_name."</h1>";		
echo "<br />";

$start_elmt = 0;
$max_elmt = 100;

$items_array = array_slice($long_array, $start_elmt, $max_elmt);

//print_r($items_array);

$block = '';
foreach($items_array as $item){
	$brand_name = getBrandName($item['brand_id']);
	$itemDetailUrl = $nav->getItemUrl($item['seo_url'], $item['name'], $item['profile_item_id'], $brand_name, 'shop');
	
$block .= "<div style='margin:6px; float:left; padding:6px; border-style:solid; border-color:gray;'>";
	$block .="<a href='".$itemDetailUrl."'>";	

$img = $ste_root."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$item['file_name'];
$block .="<img width='200' src='".$img."'"; 
		$block .=" />";
		$block .="<br />";		

		$nm = stripSlashes($item['name']);
		$name = get_shorter($nm, 10);
		$block .="<h3>".$name."</h3>";
		$block .="<br />";									

		if($item['call_for_pricing'] || $item['price'] <= 0){
			$block .="Call For Price";
		}else{
			$block .="$".number_format($item['price'],2);						
		}
		$block .="<br />";									
	
$block .= "<button style='font-size:36px; color:blue;' onClick=\"add_item('".$item['item_id']."')\">Add To Cart</button>";
//$block .="QTY:<input size='5' id='qty".$item['item_id']."' type='text' name='qty'  value='1' />";
	
	$block .= "</a>";
	
	$block .= "</div>";						
	

}

$block .= "<div style='clear: both;'></div>";
echo $block;
?>
