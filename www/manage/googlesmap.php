<?php 


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


unset($_SESSION['global_url_word']);

require_once($real_root."/includes/config.php");
//require_once($real_root."/includes/db_connect.php"); 
require_once($real_root."/includes/accessory_cart_functions.php");
require_once($real_root."/includes/showroom_functions.php");
require_once($real_root."/includes/class.module.php");
require_once($real_root."/manage/admin-includes/class.pages.php"); 
require_once($real_root."/includes/class.store_data.php");

require_once($real_root."/includes/class.nav.php");

$nav = new Nav;

$store_data = new StoreData;

$module = new Module;

$page_title = "Sitemap Generator";
$page_group = "seo";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$action = (isset($_GET["action"])) ? $_GET["action"] : '';

set_time_limit(0);



function loadBreadCrumbUrls($seo_list, $show_in = 'cart'){
	$t = array();
	$bc_data_out = explode('|',$seo_list);
	foreach($bc_data_out as $bc_out_v){
	
	
		$bc_data_in = explode(',',$bc_out_v);
		$bc_profile_cat_id = 0;
		$bc_seo_url = '';
		if(isset($bc_data_in[0])){
			
				//echo $bc_data_in[0];
				//echo "<br />";

			
			if(is_numeric($bc_data_in[0])){
				$bc_profile_cat_id = $bc_data_in[0];
			}
		}
		if(isset($bc_data_in[1])){
			if(is_numeric($bc_data_in[1])){
				$bc_cat_id = $bc_data_in[1];
			}
		}
		
		
		
		if(isset($bc_data_in[3])){
			$bc_seo_url = $bc_data_in[3];
		}
		if($bc_seo_url != '') $bc_seo_url.='/';
		if($bc_profile_cat_id > 0){
			
			
			if($show_in == 'cart'){
		
				$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'category.html?prodCatId='.$bc_profile_cat_id;				
				$t = array_merge($t,loadCatsWithPaging($bc_profile_cat_id));

				$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'showroom.html?prodCatId='.$bc_profile_cat_id;				
			}else{
				$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'showroom.html?prodCatId='.$bc_profile_cat_id;
				$t = array_merge($t,loadCatsWithPaging($bc_profile_cat_id));
			}
		}
	}
	return $t;
}


function loadBrandsWithPaging($brand_id, $name){

	$store_data = new StoreData;
	
	$t = array();

	$items_array = array_merge($t,$store_data->getItemDataFromBrand($brand_id, 0, 0));	
	foreach($items_array as $item){
		$t[] = '/'.$_SESSION['global_url_word'].'/'.$item['seo_url'].'/product.html?itemId='.$item['item_id'];	
	}

	$num_items = $store_data->getItemCount(0,0,$brand_id, 0, 'cart');
	if($num_items > 0){
		$num_pages = getNumPages($num_items,6);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=6&amp;pagenum='.$i;
		}
	}

	if($num_items > 6){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=12&amp;pagenum='.$i;
		}
	}

	if($num_items > 12){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=24&amp;pagenum='.$i;
		}
	}
		
	if($num_items > 24){
		$num_pages = getNumPages($num_items,30);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=30&amp;pagenum='.$i;
		}
	}
	
	return $t;
	
}


function loadCatsWithPaging($the_cat_id, $show_in = 'cart'){

	$store_data = new StoreData;


	//$price_range_array = $store_data->getNavPriceRanges();
	$t = array();

	$desc_cat_ids = $store_data->getDescendentCats($the_cat_id, 0, 0, 'cart');	
	$desc_cat_ids[] = $the_cat_id;
	$bc_profile_cat_id = 0;
	foreach($desc_cat_ids as $cat_id){

		// get seo_list
		$sql = "SELECT 
				seo_list
				,seo_url
				,profile_cat_id
				,show_in_showroom
				,show_in_cart
				FROM category
				WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$seo_list = $object->seo_list;
			$seo_url = $object->seo_url;
			$profile_cat_id = $object->profile_cat_id;
			$show_in_showroom = $object->show_in_showroom;
			$show_in_cart = $object->show_in_cart;
			
		}else{
			$seo_list = '';
			$seo_url = '';
			$profile_cat_id = 0;
			$show_in_showroom = '';
			$show_in_cart = '';

		}
	
	
		if($show_in_showroom){
			$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/showroom.html?prodCatId='.$profile_cat_id;			
			$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'showroom'));				
			$t = array_merge($t,loadItemsPerCat($the_cat_id, 'showroom'));	
		}
		if($show_in_cart || ($show_in_showroom && $show_in_cart)){
			$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId='.$profile_cat_id;
			$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'cart'));
			$t = array_merge($t,loadItemsPerCat($the_cat_id, 'cart'));								
		}
	
		$num_items = $store_data->getItemCount(0,0,$cat_id, 0, 'cart');	
		if($num_items > 0){
			$num_pages = getNumPages($num_items,6);			
			for($i = 0; $i <= $num_pages; $i++){
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=6&amp;pagenum='.$i;
			}
		}					
		if($num_items > 6){
			$num_pages = getNumPages($num_items,12);									
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=12&amp;pagenum='.$i;
			}
		}		
		if($num_items > 12){
			$num_pages = getNumPages($num_items,24);									
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=24&amp;pagenum='.$i;
			}			
		}		
		if($num_items > 24){
			$num_pages = getNumPages($num_items,30);
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=30&amp;pagenum='.$i;
			}
		}
		
				
	}


	$desc_cat_ids = $store_data->getDescendentCats($the_cat_id, 0, 0, 'showroom');	
	$desc_cat_ids[] = $the_cat_id;
	$bc_profile_cat_id = 0;
	foreach($desc_cat_ids as $cat_id){

		// get seo_list
		$sql = "SELECT 
				seo_list
				,seo_url
				,profile_cat_id
				,show_in_showroom
				,show_in_cart
				FROM category
				WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$seo_list = $object->seo_list;
			$seo_url = $object->seo_url;
			$profile_cat_id = $object->profile_cat_id;
			$show_in_showroom = $object->show_in_showroom;
			$show_in_cart = $object->show_in_cart;
			
		}else{
			$seo_list = '';
			$seo_url = '';
			$profile_cat_id = 0;
			$show_in_showroom = '';
			$show_in_cart = '';

		}
	
		$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/showroom.html?prodCatId='.$profile_cat_id;
		$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'showroom'));				
		$t = array_merge($t,loadItemsPerCat($the_cat_id, 'showroom'));	

	}

	return $t;
	
}


function loadItemsPerCat($cat_id, $show_in = 'cart', $price_bottom = 0, $price_top = 0){

	$store_data = new StoreData;
	$t = array();
	
	if($show_in == 'cart'){
		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'cart');
		foreach($long_array as $val) {
			$t[] = "/".$_SESSION["global_url_word"].$val['seo_url']."/product.html?productId=".$val['profile_item_id'];		
		}
		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'showroom');
		foreach($long_array as $val) {
			$t[] = "/".$_SESSION["global_url_word"].$val['seo_url']."/showroom-product.html?productId=".$val['profile_item_id'];		
		}
		
	}else{
	

		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'showroom');
		foreach($long_array as $val) {
			$t[] = "/".$_SESSION["global_url_word"].$val['seo_url']."/showroom-product.html?productId=".$val['profile_item_id'];		
		}
	}
	return $t; 
}




function getNumPages($total_count,$page_rows){	
	$num_pages = ceil($total_count/$page_rows); 
	return $num_pages;	
}



	require_once($real_root."/manage/admin-includes/class.xml.sitemap.generator-modified.php");

	$url_array = array();

	//if($module->hasDesignToolModule($_SESSION['profile_account_id'])){
		$url_array[] = '/app/'; 
	//}

	if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
		$url_array[] = '/'.$_SESSION['global_url_word'].'shopping-cart.html';
		$url_array[] = '/'.$_SESSION['global_url_word'].'checkout.html';
		$url_array[] = '/'.$_SESSION['global_url_word'].'category.html';
		$url_array[] = '/'.$_SESSION['global_url_word'].'showroom.html';
	}


	$url_array[] = '/'.$_SESSION['global_url_word'].'category.html';

	/* These don't happen on the site
	foreach($price_range_array as $val){
		if($store_data->getItemCount($val['bottom'],$val['top'],0,0,'cart') > 0){
			$url_array[] = '/'.$_SESSION['global_url_word'].'category.html?priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;prodCatId=0&amp;brandId=0';
		}
	}
	*/

	// old version only 
	$url_array[] = '/'.$_SESSION['global_url_word'].'quick-installation.html';
	$url_array[] = '/'.$_SESSION['global_url_word'].'email-us.html';
	$url_array[] = '/'.$_SESSION['global_url_word'].'discounts-how.html';
	$url_array[] = '/tutorial/paint.html';
	$url_array[] = '/custom-closet-signup.html';
	$url_array[] ='/'.$_SESSION['global_url_word'].getURLFileName('closet-us').'.html';
	$url_array[] ='/'.$_SESSION['global_url_word'].getURLFileName('faq').'.html';




	$db = $dbCustom->getDbConnect(CART_DATABASE);

	// ************ From nav bar *************
    $navbar_labels = $nav->getNavbarLabels();
    foreach($navbar_labels as $navbar_label_v){

		$url_array[] = "/".$_SESSION['global_url_word'].$navbar_label_v['url'];
		if($navbar_label_v["submenu_content_type"] == 1){			
		
			$top_cats =  $nav->getTopCats($dbCustom,);
			foreach($top_cats as $val){				
				if(strpos($val['destination'], "showroom") !== false){		
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'showroom'));
				}else{
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val['profile_cat_id'];					
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'cart'));
				}
			}
		}elseif($navbar_label_v["submenu_content_type"] == 2){
			$brands =  $nav->getNavBarBrands();
			foreach($brands as $val){
				$url_array[] = $_SESSION['global_url_word'].getUrlText($val['name'])."/category.html?brandId=".$val['brand_id'];
				$url_array = array_merge($url_array,loadBrandsWithPaging($val['brand_id'], 'cart'));
				$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'cart'));
			}
		}elseif($navbar_label_v["submenu_content_type"] == 3){
			$navbar_submenu_labels = $nav->getNavbarSubmenuLabels($navbar_label_v["id"]);
			foreach($navbar_submenu_labels as $val){
				$url_array[] = $val['url'];
				
				
				if(strpos($val['url'], '?prodCatId=') > 0){
				
					if(strpos($val['url'], 'category') > 0){
						$show_in = 'cart';	
					}else{
						$show_in = 'showroom';
					}
					$c = explode('?prodCatId=',$val['url']);
				
					if(isset($c[1])){
						if(is_numeric($c[1])){
							
							$cat_id = $store_data->getCatFromProfileCat($c[1]);
							$db = $dbCustom->getDbConnect(CART_DATABASE);
								
							$sql = "SELECT seo_list, seo_url
								FROM category
								WHERE cat_id = '".$c[1]."'";
							$c_res = mysql_query($sql);
							if(mysql_num_rows($c_res) > 0){
								$c_obj = mysql_fetch_object($c_res);
								$url_array = array_merge($url_array,loadCatsWithPaging($cat_id, $show_in));
								$url_array = array_merge($url_array,loadBreadCrumbUrls($c_obj->seo_list, $show_in));
							}
						}
					}
				}
			}
		}else{
			$hp_cats = $nav->getHomePageCats($dbCustom,);
			foreach($hp_cats as $val){				
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT seo_list
						FROM category
						WHERE profile_cat_id = '".$val['cat_id']."'";
		$result = $dbCustom->getResult($db,$sql);						
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					$seo_list = $object->seo_list;
				}else{
					$seo_list = '';
				}
				if(strpos($val['destination'], "showroom") !== false){		
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'showroom'));
				}else{
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'cart'));
				}
			}
		}
		
	}


	// ************ From header *************

	$header_links = $nav->getHeaderSupportLabels($dbCustom);
	foreach($header_links as $v){
		$url_array[] = "/".$v['url'];
	}

	// ************ From footer *************
	$footer_nav_labels = $nav->getFooterNavLabels();
	$i = 1;
    foreach($footer_nav_labels as $footer_nav_label_v){

		if($footer_nav_label_v["submenu_content_type"] == 1){			
		
			$cats = getFooterNavCats($i);
			foreach($cats as $val){
				
				if($val['destination'] == "showroom"){
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'showroom'));
				}else{
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'cart'));
				}
			}
			
		}elseif($footer_nav_label_v["submenu_content_type"] == 2){
			
			$brands = getFooterNavBrands($i);
			foreach($brands as $val){
				$url_array[] = $_SESSION['global_url_word']."category.html?brandId=".$val['brand_id'];
				$url_array = array_merge($url_array,loadBrandsWithPaging($val['brand_id'], 'cart'));
				$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'cart'));
			}
			
		}elseif($footer_nav_label_v["submenu_content_type"] == 3){

    		$footer_nav_submenu_labels = $nav->getFooterNavSubmenuLabels($dbCustom,$footer_nav_label_v["id"], $i);
			foreach($footer_nav_submenu_labels as $val){
				if((substr_count($val['url'], "account") < 1)){			
					$url_array[] = $val['url'];
				}
			}	
		}else{
			
			$cats = getFooterNavHomeCats($i);			
			foreach($cats as $val){

				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT seo_list
							FROM category
							WHERE profile_cat_id = '".$val['cat_id']."'";
		$result = $dbCustom->getResult($db,$sql);						
				if($result->num_rows > 0){
					$object = $result->fetch_object();
					$seo_list = $object->seo_list;
				}else{
					$seo_list = '';
				}

				if($val['destination'] == "showroom"){
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'showroom'));					
				}else{
					$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val['profile_cat_id'];
					$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'cart'));
				}
			}
		}


		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
		$sql = "SELECT submenu_content_type
					FROM side_nav
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
				
			$submenu_content_type = $object->submenu_content_type;
			if($submenu_content_type == 1){
				$t = $nav->getTopCats($dbCustom,);

				foreach($t as $val){

					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT seo_list
							FROM category
							WHERE profile_cat_id = '".$val['cat_id']."'";
			$result = $dbCustom->getResult($db,$sql);							
					if($result->num_rows > 0){
						$object = $result->fetch_object();
						$seo_list = $object->seo_list;
					}else{
						$seo_list = '';
					}

					if(strpos($val['destination'], "showroom") !== false){		
						$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val["profile_cat_id"];
						$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
						$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'showroom'));
					}else{
						$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val["profile_cat_id"];
						$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
						$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'cart'));
					}
				}
			}elseif($submenu_content_type == 2){
				$t = $nav->getNavBarBrands();
				foreach($t as $val){
					$url_array[] = $_SESSION['global_url_word'].getUrlText($val['name'])."/category.html?brandId=".$val['brand_id'];
					$url_array = array_merge($url_array,loadBrandsWithPaging($val['brand_id'], 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'cart'));
				}
			}elseif($submenu_content_type == 3){
				$t = $nav->getSideLabels();
				foreach($t as $val){
					$url_array[] = $_SESSION['global_url_word'].$val['url'];
				}
			}else{
				$t = $nav->getHomePageCats($dbCustom,);
				foreach($t as $val){

					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT seo_list
							FROM category
							WHERE profile_cat_id = '".$val['cat_id']."'";
			$result = $dbCustom->getResult($db,$sql);							
					if($result->num_rows > 0){
						$object = $result->fetch_object();
						$seo_list = $object->seo_list;
					}else{
						$seo_list = '';
					}

					if(strpos($val['destination'], "showroom") !== false){		
						$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/showroom.html?prodCatId=".$val["profile_cat_id"];
						$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'showroom'));
						$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'showroom'));
					}else{
						$url_array[] = $_SESSION['global_url_word'].$val['seo_url']."/category.html?prodCatId=".$val["profile_cat_id"];
						$url_array = array_merge($url_array,loadCatsWithPaging($val['cat_id'], 'cart'));
						$url_array = array_merge($url_array,loadBreadCrumbUrls($seo_list, 'cart'));
					}
				}
			}
		}
	}


	// ************ From all cats *************
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT 
			cat_id
			,seo_list
			,seo_url
			,seo_list
			,show_in_cart
			,show_in_showroom
			,profile_cat_id 
			FROM category
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND active = '1'";
$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {
		
		$go = 0;
		$store_count = 0;
		$showroom_count = 0;
		$destination = 'cart';	
	
		if($row->show_in_cart && $row->show_in_showroom){
			$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
			$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
					
			if($showroom_count > 0){ 
				$destination = 'showroom';
				$go = 1;
			}else{
				$destination = 'cart';
				if($store_count > 0){
					$go = 1;	
				}
			}
			
					
		}elseif($row->show_in_showroom){
			$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
			$destination = 'showroom';
			if($showroom_count > 0){ 
				$go = 1;
			}				
		}else{
			$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');					
			$destination = 'cart';
			if($store_count > 0){ 
				$go = 1;
			}
		}				

		if($go){
			
			if($destination == 'cart'){
				if($store_data->getItemCount(0,0,$row->cat_id,0,'cart') > 0){
					$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id, 'cart'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list, 'cart'));
				}
		
		
				if($row->show_in_cart && $row->show_in_showroom){
					$t[] = '/'.$_SESSION['global_url_word'].$row->seo_url.'/category.html?prodCatId='.$row->profile_cat_id;
					$t = array_merge($t,loadBreadCrumbUrls($row->seo_list, 'cart'));
					$t = array_merge($t,loadItemsPerCat($row->cat_id, 'cart'));								
				}else{
					$t[] = '/'.$_SESSION['global_url_word'].$row->seo_url.'/showroom.html?prodCatId='.$row->profile_cat_id;			
					$t = array_merge($t,loadBreadCrumbUrls($row->seo_list, 'showroom'));				
					$t = array_merge($t,loadItemsPerCat($row->cat_id, 'showroom'));	
					
				}
		
		
		
			}else{
				if($store_data->getItemCount(0,0,$row->cat_id,0,'showroom') > 0){
					$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id, 'showroom'));
					$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list, 'showroom'));
					$i++;
				}
			}
		}	
	}




	// ************ From all items *************
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id 
			,seo_list
			,seo_url
			,show_in_cart
			,show_in_showroom
			,profile_item_id 
			FROM item
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND active = '1'";
$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {

		if($row->show_in_cart){
			$t[] = '/'.$_SESSION['global_url_word'].$row->seo_url.'/product.html?productId=?productId='.$row->profile_item_id;
		}else{
			$t[] = '/'.$_SESSION['global_url_word'].$row->seo_url.'/showroom-product.html?productId=?productId='.$row->profile_item_id;		
		}
	}



	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	// is blog page active?
	$sql = "SELECT active 
			FROM page_seo
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND page_name = 'blog'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		if($object->active){
			$sql = "SELECT name, blog_cat_id 
					FROM blog_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$bc_res = mysql_query ($sql);
			if(!$bc_res)die(mysql_error());
			while($row = mysql_fetch_object($bc_res)){
				$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/blog.html?slug=blog&amp;blogCatId=".$row->blog_cat_id;
				$sql = "SELECT title, blog_post_id 
						FROM blog_post
						WHERE blog_cat_id = '".$row->blog_cat_id."'
						AND hide = '0'";			
				$bp_res = mysql_query ($sql);
				if(!$bp_res)die(mysql_error());
				while($bp_row = mysql_fetch_object($bp_res)){

$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/".getUrlText($bp_row->title)."/blog.html?slug=blog&amp;blogPostId=".$bp_row->blog_post_id."&amp;blogCatId".$row->blog_cat_id;

				}
			}	
		}
	}


	// Lower nav bar
	$char_length = 0;
	foreach($_SESSION['pages'] as $p_val){
		if($char_length < 90
			&& $p_val['active'] == 1 
			&& $p_val['page_name'] != 'app'
			&& $p_val['page_name'] != 'checkout'
			&& $p_val['page_name'] != 'default'
			&& $p_val['page_name'] != 'blog-more'
			&& $p_val['page_name'] != 'item-details'
			&& $p_val['page_name'] != 'account'
			&& $p_val['page_name'] != 'order-history'
			&& $p_val['page_name'] != 'order-receipt'
			&& $p_val['page_name'] != 'account-designs'
			&& $p_val['page_name'] != 'news'
			&& $p_val['page_name'] != 'news-more'
			&& $p_val['page_name'] != 'signup-form'
			&& $p_val['page_name'] != 'signin-form'
			&& $p_val['page_name'] != 'social-network-about'
			&& $p_val['page_name'] != 'social-network-answer'
			&& $p_val['page_name'] != 'social-network-answers'
			&& $p_val['page_name'] != 'social-network-before-after'
			&& $p_val['page_name'] != 'social-network-blog'
			&& $p_val['page_name'] != 'social-network-blog-article'
			&& $p_val['page_name'] != 'social-network-gallery'
			&& $p_val['page_name'] != 'social-network-members'
			&& $p_val['page_name'] != 'social-network-profile'
			&& $p_val['page_name'] != 'social-network-results'
			&& $p_val['page_name'] != 'shop'
			&& $p_val['page_name'] != 'store'
			&& $p_val['page_name'] != 'showroom-details'
			&& $p_val['page_name'] != 'give-testimonial'
			&& $p_val['page_name'] != 'search-results'
			&& $p_val['page_name'] != 'discounts-how'
			){
					
			if($_SESSION["seo"]){ 
				$the_page_name = $p_val['seo_name'];	
			}else{
				$the_page_name = $p_val['page_name'];
			}
			
			$url_array[] = "/".$_SESSION['global_url_word'].$the_page_name.".html";
			
			$char_length += strlen($the_page_name);
		}
	}

	$url_array = array_unique($url_array);

echo "<br />";
echo "<br />";

echo "Unique";
echo "<br />";


$i = 1;
foreach($url_array as $v){
	echo $i."   ".$v."<br />";
	$i++;	
}


echo "<br />";
echo "<br />";


//$g_array[] = '/custom-organizing-solutions/accessory-options/valet-rods/upgraded-oil-rubbed-bronze-valet-rod/product.html?itemId=613&amp;catId=526';

echo "<br />------------------------------------------------<br />";



/*
echo "<br /><br />";
echo "Is otg in google";
echo "<br /><br />";

foreach($url_array as $url){
	if(in_array($url, $g_array)){	
		echo "IN: ".$url;		
	}else{
		echo "OUT: ".$url;
	}	
	echo "<br />";	
}

*/
$g_array[] = "/custom-organizing-solutions/closet-system-faq.html";
$g_array[] = "/app/";
$g_array[] = "/custom-organizing-solutions/category.html";
$g_array[] = "/custom-organizing-solutions/custom-pull-down-wall-bed-office-systems/showroom.html?prodCatId=23";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/category.html?prodCatId=26";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/category.html?prodCatId=28";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/category.html?prodCatId=33";
$g_array[] = "/custom-organizing-solutions/drawer-options/category.html?prodCatId=51";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/category.html?prodCatId=63";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/showroom.html?prodCatId=69";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/category.html?prodCatId=18";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/category.html?prodCatId=19";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/office-organizers-accessories/showroom.html?prodCatId=20";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/custom-craft-laundry-organizers-accessories/showroom.html?prodCatId=22";
$g_array[] = "/custom-organizing-solutions/custom-closets-showroom/showroom.html";
$g_array[] = "/custom-organizing-solutions/showroom.html";
$g_array[] = "/custom-organizing-solutions/design-closet-online.html";
$g_array[] = "/custom-organizing-solutions/email-design-online.html";
$g_array[] = "/custom-organizing-solutions/we-design-fax.html";
$g_array[] = "/custom-organizing-solutions/closet-organizers-in-home-consultation.html";
$g_array[] = "/custom-organizing-solutions/custom-closet-specs.html";
$g_array[] = "/custom-organizing-solutions/closet-system-testimonials.html";
$g_array[] = "/custom-organizing-solutions/feedback.html";
$g_array[] = "/custom-organizing-solutions/about-closet-organizer.html";
$g_array[] = "/custom-organizing-solutions/closet-system-contact.html";
$g_array[] = "/custom-organizing-solutions/custom-closet-policies.html";
$g_array[] = "/custom-organizing-solutions/closet-organizer-promotions.html";
$g_array[] = "/custom-organizing-solutions/closet-organizer-downloads.html";
$g_array[] = "/custom-organizing-solutions/blog.html";
$g_array[] = "/custom-organizing-solutions/hardware/category.html?catId=300";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55";
$g_array[] = "/custom-organizing-solutions/hardware/knobs/category.html?catId=540";
$g_array[] = "/custom-organizing-solutions/hardware/wardrobe-tubes/category.html?catId=541";
$g_array[] = "/custom-organizing-solutions/materials/category.html?catId=511";
$g_array[] = "/custom-organizing-solutions/materials/stock-finishes/category.html?catId=515";
$g_array[] = "/custom-organizing-solutions/accessory-options/category.html?catId=299";
$g_array[] = "/custom-organizing-solutions/accessory-options/ironing-boards/category.html?catId=53";
$g_array[] = "/custom-organizing-solutions/accessory-options/baskets/category.html?catId=301";
$g_array[] = "/custom-organizing-solutions/accessory-options/tie-racks/category.html?catId=518";
$g_array[] = "/custom-organizing-solutions/accessory-options/belt-racks/category.html?catId=521";
$g_array[] = "/custom-organizing-solutions/accessory-options/valet-rods/category.html?catId=524";
$g_array[] = "/custom-organizing-solutions/accessory-options/jewelry-trays/category.html?catId=527";
$g_array[] = "/custom-organizing-solutions/accessory-options/mirrors/category.html?catId=528";
$g_array[] = "/custom-organizing-solutions/accessory-options/pants-racks/category.html?catId=529";
$g_array[] = "/custom-organizing-solutions/accessory-options/shoe-storage/category.html?catId=530";
$g_array[] = "/custom-organizing-solutions/accessory-options/pull-down-wardrobe-tubes/category.html?catId=531";
$g_array[] = "/custom-organizing-solutions/accessory-options/slat-wall/category.html?catId=532";
$g_array[] = "/custom-organizing-solutions/accessory-options/acrylic-dividers/category.html?catId=533";
$g_array[] = "/custom-organizing-solutions/accessory-options/hampers/category.html?catId=534";
$g_array[] = "/custom-organizing-solutions/mirror/category.html?prodCatId=12";
$g_array[] = "/custom-organizing-solutions/hanger-rack/category.html?prodCatId=11";
$g_array[] = "/custom-organizing-solutions/pull-down-hanger-rail/category.html?prodCatId=9";
$g_array[] = "/custom-organizing-solutions/hamper/category.html?prodCatId=7";
$g_array[] = "/pantry-organizers/showroom.html?catId=119";
$g_array[] = "/walk-in-closet-organizers/showroom.html?catId=39";
$g_array[] = "/garage-organizers/showroom.html?catId=120";
$g_array[] = "/custom-organizing-solutions/quick-installation.html";
$g_array[] = "/custom-organizing-solutions/email-us.html";
$g_array[] = "/custom-organizing-solutions//showroom.html";
$g_array[] = "/custom-organizing-solutions/privacy-statement.html";
$g_array[] = "/custom-organizing-solutions/custom-closets-shipping.html";
$g_array[] = "/custom-organizing-solutions/closet-design-online.html";
$g_array[] = "/custom-organizing-solutions/shoe-rack/category.html?prodCatId=6";
$g_array[] = "/custom-organizing-solutions/custom-pull-down-wall-bed-office-systems/maple-wall-bed-office/showroom-product.html?productId=78";
$g_array[] = "/custom-organizing-solutions/custom-pull-down-wall-bed-office-systems/black-wall-bed-desk-system/showroom-product.html?productId=77";
$g_array[] = "/custom-organizing-solutions/custom-pull-down-wall-bed-office-systems/custom-wall-bed-home-office/showroom-product.html?productId=6";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/category.html?prodCatId=57";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/category.html?prodCatId=26&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/category.html?prodCatId=26&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/category.html?prodCatId=26&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/oval-chrome-tube/product.html?productId=176";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/oval-oil-rubbed-bronze-tube/product.html?productId=177";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/oval-satin-nickel-tube/product.html?productId=178";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/round-oil-rubbed-bronze-wardrobe-tube/product.html?productId=179";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/round-satin-nickel-wardrobe-tube/product.html?productId=180";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/round-chrome-wardrobe-tube/product.html?productId=181";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/category.html?prodCatId=32";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/category.html?prodCatId=28&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/category.html?prodCatId=28&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/category.html?prodCatId=28&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/almond/product.html?productId=81";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/natural-maple/product.html?productId=98";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/caramel-apple/product.html?productId=83";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/chocolate-apple/product.html?productId=85";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/antique-white/product.html?productId=80";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/wild-apple/product.html?productId=84";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/category.html?prodCatId=33&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/frontier-square-shaker-front/product.html?productId=99";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/riviera-square-shaker-front/product.html?productId=101";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/millenia-square-raised-panel-front/product.html?productId=100";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/escalade-slab-front/product.html?productId=183";
$g_array[] = "/custom-organizing-solutions/raised-panel-frontsdoor-options/espana-slab-square-front/product.html?productId=184";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-boxes/category.html?prodCatId=52";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-bottoms/category.html?prodCatId=53";
$g_array[] = "/custom-organizing-solutions/drawer-options/slides/category.html?prodCatId=54";
$g_array[] = "/custom-organizing-solutions/drawer-options/category.html?prodCatId=51&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/drawer-options/category.html?prodCatId=51&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/drawer-options/category.html?prodCatId=51&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-boxes/standard-melamine-box/product.html?productId=142";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-boxes/upgraded-dove-tail-boxes/product.html?productId=143";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-bottoms/upgraded-cedar-drawer-bottoms/product.html?productId=144";
$g_array[] = "/custom-organizing-solutions/drawer-options/drawer-bottoms/standard-14-melamine-drawer-bottoms/product.html?productId=145";
$g_array[] = "/custom-organizing-solutions/drawer-options/slides/upgraded-soft-close-undermounted-slides/product.html?productId=146";
$g_array[] = "/custom-organizing-solutions/drawer-options/slides/upgraded-soft-close-side-mounted-slides/product.html?productId=147";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/category.html?prodCatId=63&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/battery-powered-loox-led-9004/product.html?productId=202";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/loox-led-9005-battery-powered-light/product.html?productId=203";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/loox-led-2015-wardrobe-tube/product.html?productId=204";
$g_array[] = "/custom-organizing-solutions/led-cabinetry-lighting/loox-led-gooseneck-reading-light/product.html?productId=205";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/knobs/category.html?prodCatId=56";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64&amp;brandId=0&amp;pageRows=6&amp;pagenum=5";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/category.html?prodCatId=64&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/florence-oil-rubbed-bronze-cup-handle/product.html?productId=152";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/florence-satin-nickel-cup-handle/product.html?productId=153";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/bremen-dark-antique-copper-cabinet-pull/product.html?productId=158";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/bremen-satin-nickel-pull/product.html?productId=159";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/satin-nickel-swirl-z-handle/product.html?productId=160";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/wrought-dark-iron-swirl-z-handle/product.html?productId=161";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/showroom.html?prodCatId=1";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/showroom.html?prodCatId=17";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/kid-closet-organizers/showroom.html?prodCatId=21";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/sunset-cherry-closet-organizer/showroom-product.html?productId=66";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/almond-closet-organizer/showroom-product.html?productId=97";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/real-wood-closet-organizer/showroom-product.html?productId=67";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/luxurious-glass-closet-organizer/showroom-product.html?productId=68";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/master-walk-in-closet-organizers/10ft-tall-contemporary-closet/showroom-product.html?productId=62";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/shoe-storage-organizer/showroom-product.html?productId=64";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/teen-reach-in-closet/showroom-product.html?productId=75";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/kids-reach-in-closet/showroom-product.html?productId=74";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/his-reach-in-closet/showroom-product.html?productId=4";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/mud-room-closet/showroom-product.html?productId=63";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/reach-in-closet-organizers/white-reach-in-closet/showroom-product.html?productId=65";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/office-organizers-accessories/custom-office-organizer-for-two/showroom-product.html?productId=14";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/office-organizers-accessories/corner-office-organizer/showroom-product.html?productId=73";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/custom-craft-laundry-organizers-accessories/craft-closet-organizer/showroom-product.html?productId=76";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/category.html?prodCatId=67";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/custom-pantry-organizes/category.html?prodCatId=72";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/category.html?prodCatId=18&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/category.html?prodCatId=18&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/category.html?prodCatId=18&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/ultimate-pantry-organizer/product.html?productId=69";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/54-hard-maple-butcher-block/product.html?productId=217";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/36-hard-maple-butcher-block/product.html?productId=220";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/48-hard-maple-butcher-block/product.html?productId=219";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/64-hard-maple-butcher-block/product.html?productId=218";
$g_array[] = "/custom-organizing-solutions/kitchenpantry-organizers-accessories/decorative-kitchen-islands-butcher-blocks/antique-white-kitchen-island-/product.html?productId=210";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/category.html?prodCatId=19&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/category.html?prodCatId=19&amp;brandId=0&amp;priceBottom=100&amp;priceTop=200";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/category.html?prodCatId=19&amp;brandId=0&amp;priceBottom=200&amp;priceTop=500";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/custom-garage-organizers/showroom.html?prodCatId=70";
$g_array[] = "/custom-organizing-solutions/garage-organizers-accessories/garage-organizer-accessories/category.html?prodCatId=65";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/storage-bins/omni-track-storage-bin/product.html?productId=59";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/storage-bins/omni-track-storage-bin/product.html?productId=58";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/storage-bins/omni-track-storage-bin/product.html?productId=57";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/garage-organizer-racks/omni-track-gardenlawn-rack/product.html?productId=206";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/garage-organizer-racks/omni-track-workcraft-bench-kit/product.html?productId=207";
$g_array[] = "/custom-organizing-solutions/garage-organizer-accessories/garage-organizer-racks/omni-track-sports-rack/product.html?productId=208";
$g_array[] = "/quick-installation.html";
$g_array[] = "/tutorial/paint.html";
$g_array[] = "/custom-organizing-solutions/closet-organization/blog.html?slug=blog&amp;blogCatId=3";
$g_array[] = "/custom-organizing-solutions/blog.html?slug=blog&amp;blogCatId=0";
$g_array[] = "/custom-organizing-solutions/blog.html?slug=blog";
$g_array[] = "/custom-organizing-solutions/closet-organization/welcome-to-organize-to-go/blog.html?slug=blog&amp;blogPostId=15&amp;blogCatId=3";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/handles/upgraded-handles/category.html?prodCatId=59";
$g_array[] = "/custom-organizing-solutions/handles/standard-handles/category.html?prodCatId=58";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55&amp;brandId=0&amp;pageRows=6&amp;pagenum=3";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/handles/category.html?prodCatId=55&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/knobs/category.html?prodCatId=56&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/category.html?prodCatId=61";
$g_array[] = "/custom-organizing-solutions/knobs/standard-knobs/category.html?prodCatId=60";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/knobs/category.html?prodCatId=56&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/knobs/category.html?prodCatId=56&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/decorative-hardware-handlesknobs-and-hooks/knobs/category.html?prodCatId=56&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/satin-nickel-swirl-z-knob/product.html?productId=170";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/oil-rubbed-bronze-swirl-z-knob/product.html?productId=171";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/milan-satin-nickel-knob/product.html?productId=172";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/milan-dark-antique-copper-knob/product.html?productId=173";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/bremen-satin-nickel-button-knob/product.html?productId=174";
$g_array[] = "/custom-organizing-solutions/knobs/upgraded-knobs/bremen-dark-antique-copper-knob/product.html?productId=175";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/category.html?prodCatId=57&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/category.html?prodCatId=57&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/closet-organizer-hardware/wardrobe-tubes/category.html?prodCatId=57&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/category.html?prodCatId=32&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/category.html?prodCatId=32&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/colorsfinishes/stock-finishes/category.html?prodCatId=32&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;priceBottom=50&amp;priceTop=100";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;priceBottom=100&amp;priceTop=200";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;priceBottom=200&amp;priceTop=500";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/category.html?prodCatId=69";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/valet-rods-tie-belt-racks/category.html?prodCatId=71";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/ironing-boards/category.html?prodCatId=2";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/category.html?prodCatId=46";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/mirrors/category.html?prodCatId=44";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/jewelry-trays/category.html?prodCatId=43";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/category.html?prodCatId=45";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/clothes-rack/category.html?prodCatId=68";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/baskets/category.html?prodCatId=27";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/category.html?prodCatId=47";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/slat-wall/category.html?prodCatId=48";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/acrylic-dividers/category.html?prodCatId=49";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/hampers/category.html?prodCatId=50";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/closet-organizers-wardrobe-hook-selections/category.html?prodCatId=62";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;pageRows=6&amp;pagenum=1";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;pageRows=6&amp;pagenum=0";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;pageRows=6&amp;pagenum=9";
$g_array[] = "/custom-organizing-solutions/wardrobecustom-closet-organizers-accessories/closet-organizer-accessories/category.html?prodCatId=25&amp;brandId=0&amp;pageRows=6&amp;pagenum=2";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/jewelry-trays/closet-drawer-insert-jewelry-tray-1/product.html?productId=185";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/jewelry-trays/closet-drawer-insert-jewelry-tray-2/product.html?productId=186";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/jewelry-trays/jewelry-tray-custom-colors/product.html?productId=187";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/wire-fan-pant-rack/product.html?productId=209";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/30-pull-out-pant-tie-scarf-rack/product.html?productId=2";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/30-pull-out-pant-organizer/product.html?productId=119";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/ironing-boards/pressing-perfection-ironing-board/product.html?productId=189";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/ironing-boards/press-fix-ironing-board/product.html?productId=188";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/ironing-boards/ironfix-shelf-mounted-ironing-board/product.html?productId=33";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/baskets/18-wide-wire-baskets/product.html?productId=120";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/baskets/30-wide-wire-baskets/product.html?productId=122";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/baskets/24-wide-wire-baskets/product.html?productId=121";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/category.html?prodCatId=34&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/category.html?prodCatId=34&amp;brandId=0&amp;priceBottom=50&amp;priceTop=100";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/category.html?prodCatId=34&amp;brandId=0&amp;priceBottom=100&amp;priceTop=200";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/category.html?prodCatId=34";
$g_array[] = "/custom-organizing-solutions/tie-racks/standard-tie-racks/category.html?prodCatId=35";
$g_array[] = "/custom-organizing-solutions/tie-racks/upgraded-tie-rack/category.html?prodCatId=36";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/standard-oil-rubbed-bronze-closet-tie-rack/product.html?productId=103";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/upgraded-satin-nickel-closet-tie-rack/product.html?productId=104";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/upgraded-chrome-closet-tie-rack/product.html?productId=105";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/upgraded-oil-rubbed-bronze-closet-tie-rack/product.html?productId=106";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/tie-racks/standard-satin-nickel-closet-tie-rack/product.html?productId=102";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/category.html?prodCatId=37&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/category.html?prodCatId=37&amp;brandId=0&amp;priceBottom=50&amp;priceTop=100";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/category.html?prodCatId=37";
$g_array[] = "/custom-organizing-solutions/belt-racks/upgraded-belt-racks/category.html?prodCatId=39";
$g_array[] = "/custom-organizing-solutions/belt-racks/standard-belt-racks/category.html?prodCatId=38";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/standard-oil-rubbed-bronze-closet-belt-rack/product.html?productId=107";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/standard-satin-nickel-closet-belt-rack/product.html?productId=108";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/upgraded-oil-rubbed-bronze-closet-belt-rack/product.html?productId=109";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/upgraded-chrome-closet-belt-rack/product.html?productId=110";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/belt-racks/upgraded-satin-nickel-closet-belt-rack/product.html?productId=111";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/category.html?prodCatId=40&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/category.html?prodCatId=40";
$g_array[] = "/custom-organizing-solutions/valet-rods/standard-valet-rods/category.html?prodCatId=41";
$g_array[] = "/custom-organizing-solutions/valet-rods/upgraded-valet-rods/category.html?prodCatId=42";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/standard-oil-rubbed-bronze-valet-rod/product.html?productId=201";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/upgraded-chrome-valet-rod/product.html?productId=114";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/standard-satin-nickel-valet-rod/product.html?productId=12";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/upgraded-satin-nickel-valet-rod/product.html?productId=113";
$g_array[] = "/custom-organizing-solutions/valet-rods-tie-belt-racks/valet-rods/upgraded-oil-rubbed-bronze-valet-rod/product.html?productId=112";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/mirrors/category.html?prodCatId=44&amp;brandId=0&amp;priceBottom=200&amp;priceTop=500";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/mirrors/pull-out-closet-organizer-mirror/product.html?productId=116";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/category.html?prodCatId=45&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/category.html?prodCatId=45&amp;brandId=0&amp;priceBottom=100&amp;priceTop=200";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/24-pull-out-pant-organizer/product.html?productId=118";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/24-wood-pant-rack/product.html?productId=8";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pant-racks/18-pull-out-pant-organizer/product.html?productId=117";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/pull-out-closet-organizer-shoe-rack/product.html?productId=190";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/deluxe-closet-shoe-fences/product.html?productId=191";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/5-shelf-womens-lazy-shoe-zen-with-shaft-closet/product.html?productId=123";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/3-shelf-womens-lazy-shoe-zen-with-shaft-closet/product.html?productId=125";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/3-shelf-mens-lazy-shoe-zen-with-shaft-closet/product.html?productId=126";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/shoe-storage/5-shelf-mens-lazy-shoe-zen-with-shaft-closet/product.html?productId=124";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/category.html?prodCatId=47&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/category.html?prodCatId=47&amp;brandId=0&amp;priceBottom=200&amp;priceTop=500";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/medium-pull-down-closet-wardrobe-tube/product.html?productId=128";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/small-pull-down-closet-organizer-wardrobe-tube/product.html?productId=127";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/telescoping-closet-hanger-retriever-pole/product.html?productId=131";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/closet-hanger-retriever-pole/product.html?productId=130";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/pull-down-wardrobe-tubes/large-pull-down-closet-wardrobe-tube/product.html?productId=129";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/slat-wall/crystal-gray-slat-wall/product.html?productId=134";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/slat-wall/wild-cherry-slat-wall/product.html?productId=133";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/slat-wall/alum-rock-maple-slat-wall/product.html?productId=132";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/slat-wall/white-slat-wall/product.html?productId=135";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/acrylic-dividers/category.html?prodCatId=49&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/acrylic-dividers/closet-organizer-acrylic-dividers/product.html?productId=136";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/acrylic-dividers/acrylic-closet-shoe-dividers/product.html?productId=137";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/hampers/18-wide-tilt-out-hamper/product.html?productId=138";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/hampers/24-wide-cloth-hamper-liner/product.html?productId=140";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/hampers/24-wide-tilt-out-hamper/product.html?productId=139";
$g_array[] = "/custom-organizing-solutions/closet-organizer-accessories/hampers/18-wide-cloth-hamper-liner/product.html?productId=141";
$g_array[] = "/custom-organizing-solutions/mirror/category.html?prodCatId=12&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/mirror/pullout-closet-mirror/product.html?productId=11";
$g_array[] = "/custom-organizing-solutions/hanger-rack/category.html?prodCatId=11&amp;brandId=0&amp;priceBottom=0&amp;priceTop=50";
$g_array[] = "/custom-organizing-solutions/hanger-rack/category.html?prodCatId=11&amp;brandId=0&amp;priceBottom=100&amp;priceTop=200";
$g_array[] = "/custom-organizing-solutions/hanger-rack/valet-rod/product.html?productId=13";
$g_array[] = "/custom-organizing-solutions/pull-down-hanger-rail/pull-down-hanger-rail/produ