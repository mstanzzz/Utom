<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


unset($_SESSION['global_url_word']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.store_data.php");

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.nav.php");

$nav = new Nav;


$store_data = new StoreData;

$progress = new SetupProgress;
$module = new Module;

$page_title = "Sitemap Generator";
$page_group = "seo";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$action = (isset($_GET["action"])) ? $_GET["action"] : '';

set_time_limit(0);


function loadBrandsWithPaging($brand_id, $name){

	$store_data = new StoreData;
	$price_range_array = $store_data->getNavPriceRanges();
	
	$t = array();

	$items_array = array_merge($t,$store_data->getItemDataFromBrand($brand_id, 0, 0));	
	foreach($items_array as $item){
		$t[] = '/'.$_SESSION['global_url_word'].'/'.$item['seo_url'].'/product.html?itemId='.$item['item_id'];	
	}

	foreach($price_range_array as $val){
		if($store_data->getItemCount($val['bottom'],$val['top'],0,$brand_id,'cart') > 0){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;prodCatId0&amp;brandId='.$brand_id;
		}
	}

	$num_items = $store_data->getItemCount(0,0,$brand_id, 0, 'cart');
		
	if($num_items > 0){
		$num_pages = getNumPages($num_items,6);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=6&amp;pagenum='.$i;
		}
	}

	if($num_items > 6){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=12&amp;pagenum='.$i;
		}
	}

	if($num_items > 12){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=24&amp;pagenum='.$i;
		}
	}
		
	if($num_items > 24){
		$num_pages = getNumPages($num_items,30);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=30&amp;pagenum='.$i;
		}
	}

	// price range without paging
	foreach($price_range_array as $val){				
		$num_items = $store_data->getItemCount($val['bottom'],$val['top'],0, $brand_id, 'cart');
		if($num_items > 0){
			$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'];
		}
	}



	foreach($price_range_array as $val){
		$num_items = $store_data->getItemCount($val['bottom'],$val['top'],0, $brand_id, 'cart');
		if($num_items > 0){
			$num_pages = getNumPages($num_items,6);				
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=6&amp;pagenum='.$i;
			}
		}
	}
		
	foreach($price_range_array as $val){
		$num_items = $store_data->getItemCount($val['bottom'],$val['top'],0, $brand_id, 'cart');
		if($num_items > 6){
			$num_pages = getNumPages($num_items,12);				
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].getUrlText($name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=12&amp;pagenum='.$i;
			}
		}
	}
		
	foreach($price_range_array as $val){
		$num_items = $store_data->getItemCount($val['bottom'],$val['top'],0, $brand_id, 'cart');
		if($num_items > 12){
			$num_pages = getNumPages($num_items,24);				
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=24&amp;pagenum='.$i;
			}
		}
	}

	foreach($price_range_array as $val){
		$num_items = $store_data->getItemCount($val['bottom'],$val['top'],0, $brand_id, 'cart');
		if($num_items > 24){
			$num_pages = getNumPages($num_items,30);					
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name).'/category.html?prodCatId0&amp;brandId='.$brand_id.'&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=30&amp;pagenum='.$i;
			}
		}
	}
	
	return $t;
	
}

function loadCatsWithPaging($the_cat_id){

	$store_data = new StoreData;

	//getProfileCatFromCat($cat_id)

	$price_range_array = $store_data->getNavPriceRanges();
	$t = array();

	$desc_cat_ids = $store_data->getDescendentCats($the_cat_id, 0, 0, 'cart');
	
	$desc_cat_ids[] = $the_cat_id;
	
	foreach($desc_cat_ids as $cat_id){

			
		// get seo_list
		$sql = "SELECT seo_list, seo_url, profile_cat_id
				FROM category
				WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$seo_list = $object->seo_list;
			$seo_url = $object->seo_url;
			$profile_cat_id = $object->seo_url;
		}else{
			$seo_list = '';
			$seo_url = '';
			$profile_cat_id = 0;
		}
	
	
				
		$bc_data_out = explode('|',$object->seo_list);
		foreach($bc_data_out as $bc_out_v){
			$bc_data_in = explode(',',$bc_out_v);
			$bc_cat_id = 0;
			$bc_seo_url = '';
			if(isset($bc_data_in[0])){
				if(is_numeric($bc_data_in[0])){
					$bc_profile_cat_id = $bc_data_in[0];
				}
			}
			if(isset($bc_data_in[3])){
				$bc_seo_url = $bc_data_in[3];
			}
			if($bc_seo_url != '') $bc_seo_url.='/';
			if($bc_cat_id > 0){
			$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'category.html?prodCatId'.$bc_profile_cat_id;
			}				
		}
			
		
		//echo "cat_id:".$cat_id."<br />";
		$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$cat_id;
		
		$t = array_merge($t,loadItemsPerCat($the_cat_id));	
	
		$num_items = $store_data->getItemCount(0,0,$cat_id, 0, 'cart');
	
	
		if($num_items > 0){
			$num_pages = getNumPages($num_items,6);			
			for($i = 0; $i <= $num_pages; $i++){
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=6&amp;pagenum='.$i;
			}
		}
					
		if($num_items > 6){
			$num_pages = getNumPages($num_items,12);									
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=12&amp;pagenum='.$i;
			}
		}
		
		if($num_items > 12){
			$num_pages = getNumPages($num_items,24);									
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=24&amp;pagenum='.$i;
			}			
		}
		
		if($num_items > 24){
			$num_pages = getNumPages($num_items,30);
			for($i = 0; $i <= $num_pages; $i++){		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom=0&amp;priceTop=0&amp;pageRows=30&amp;pagenum='.$i;
			}
		}
	
		// price range without paging
		foreach($price_range_array as $val){				
					
			$num_items = $store_data->getItemCount($val['bottom'],$val['top'],$cat_id, 0, 'cart');
			if($num_items > 0){				
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'];			
			}
		}
			
		foreach($price_range_array as $val){				
			$num_items = $store_data->getItemCount($val['bottom'],$val['top'],$cat_id, 0, 'cart');
			if($num_items > 0){
				$num_pages = getNumPages($num_items,6);				
				for($i = 0; $i <= $num_pages; $i++){		
					$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=6&amp;pagenum='.$i;
				}
			}
		}
		
		
		foreach($price_range_array as $val){
			$num_items = $store_data->getItemCount($val['bottom'],$val['top'],$cat_id, 0, 'cart');
			if($num_items > 6){
				$num_pages = getNumPages($num_items,12);				
				for($i = 0; $i <= $num_pages; $i++){		
					$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=12&amp;pagenum='.$i;
				}
			}				
		}
		
		
		
		foreach($price_range_array as $val){
			$num_items = $store_data->getItemCount($val['bottom'],$val['top'],$cat_id, 0, 'cart');
			if($num_items > 12){
				$num_pages = getNumPages($num_items,24);				
				for($i = 0; $i <= $num_pages; $i++){		
					$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=24&amp;pagenum='.$i;
				}
			}
		}
					
		foreach($price_range_array as $val){
			$num_items = $store_data->getItemCount($val['bottom'],$val['top'],$cat_id, 0, 'cart');
			if($num_items > 24){
				$num_pages = getNumPages($num_items,30);				
				for($i = 0; $i <= $num_pages; $i++){		
					$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/category.html?prodCatId'.$profile_cat_id.'&amp;brandId=0&amp;priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;pageRows=30&amp;pagenum='.$i;
				}
			}
		}		
		
	}

	return $t;



	
}


function loadItemsPerCat($cat_id, $show_in = 'cart', $price_bottom = 0, $price_top = 0){

	$store_data = new StoreData;
	$t = array();
	
	$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'cart');
	foreach($long_array as $val) {
		$t[] = "/".$_SESSION["global_url_word"].$val['seo_url']."/product.html?productId=".$val['profile_item_id'];		
	}

	$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'showroom');
	foreach($long_array as $val) {
		$t[] = "/".$_SESSION["global_url_word"].$val['seo_url']."/showroom-product.html?productId=".$val['profile_item_id'];		
	}

	return $t; 
}


function loadBreadCrumbUrls($seo_list, $show_in = 'cart'){
	$t = array();
	$bc_data_out = explode('|',$seo_list);
	foreach($bc_data_out as $bc_out_v){
	
	
		$bc_data_in = explode(',',$bc_out_v);
		$bc_profile_cat_id = 0;
		$bc_seo_url = '';
		if(isset($bc_data_in[0])){
			if(is_numeric($bc_data_in[0])){
				$bc_profile_cat_id = $bc_data_in[0];
			}
		}
		if(isset($bc_data_in[3])){
			$bc_seo_url = $bc_data_in[3];
		}
		if($bc_seo_url != '') $bc_seo_url.='/';
		if($bc_profile_cat_id > 0){
			
			
			if($show_in == 'cart'){
				$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'category.html?prodCatId'.$bc_profile_cat_id;
				
				$t = array_merge($t,loadCatsWithPaging($bc_cat_id));

			}else{
				$t[] = "/".$_SESSION['global_url_word'].$bc_seo_url.'showroom.html?prodCatId'.$bc_profile_cat_id;
			}
		}
	}
	return $t;
}


function getNumPages($total_count,$page_rows){	
	$num_pages = ceil($total_count/$page_rows); 
	return $num_pages;	
}



if($action == 'generate'){
		
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.xml.sitemap.generator-modified.php");

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
			$url_array[] = '/'.$_SESSION['global_url_word'].'category.html?priceBottom='.$val['bottom'].'&amp;priceTop='.$val['top'].'&amp;prodCatId0&amp;brandId=0';
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
		
			$sql = "SELECT cat_id, seo_list 
					FROM category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					AND show_in_cart = '1'
					AND active = '1'
					ORDER BY display_order";
	$result = $dbCustom->getResult($db,$sql);					
			while($row = $result->fetch_object()) {
				$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
				$tgc_res = mysql_query($sql);
				if(!$tgc_res)die(mysql_error());
		
				if(mysql_num_rows($tgc_res) == 0){
					if($store_data->getItemCount(0,0,$row->cat_id,0,'cart') > 0){
					
						//$url_array[] = '/'.$_SESSION['global_url_word'].$row->seo_url."/category.html?prodCatId".$row->cat_id;
						$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id));
						$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list));				
						
					}
				}
			}
		
		}elseif($navbar_label_v["submenu_content_type"] == 2){
			$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT name ,brand_id 
				FROM brand 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY name LIMIT 10";
	$result = $dbCustom->getResult($db,$sql);			
			while($row = $result->fetch_object()) {
				$url_array[] = "/".$_SESSION['global_url_word'].getUrlText($row->name)."/category.html?brandId=".$row->brand_id;
				$url_array = array_merge($url_array,loadBrandsWithPaging($row->brand_id, $row->name));
			}
		}else{
   			$navbar_submenu_labels = $nav->getNavbarSubmenuLabels($navbar_label_v["id"]);
			foreach($navbar_submenu_labels as $navbar_submenu_label_v){
				$url_array[] = "/".$navbar_submenu_label_v['url'];
			
				if(strpos($navbar_submenu_label_v['url'], '?prodCatId') > 0){
				
					if(strpos($navbar_submenu_label_v['url'], 'category') > 0){
						$show_in = 'cart';	
					}else{
						$show_in = 'showroom';
					}
					$c = explode('?prodCatId',$navbar_submenu_label_v['url']);
				
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
								$url_array = array_merge($url_array,loadCatsWithPaging($cat_id, $c_obj->seo_url));
								$url_array = array_merge($url_array,loadBreadCrumbUrls($c_obj->seo_list, $show_in));
							}
						}
					}
				}
			}
		}
	}




	// ************ From header *************

	$header_links = $nav->getHeaderSupportLabels();
	foreach($header_links as $v){
		$url_array[] = "/".$v['url'];
	}
	
	// ************ From footer *************
	$footer_nav_labels = $nav->getFooterNavLabels();
	$col = 1;
    foreach($footer_nav_labels as $footer_nav_label_v){

		if($footer_nav_label_v["submenu_content_type"] == 1){			
			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$sql = "SELECT cat_id, seo_list 
					FROM category
					WHERE show_in_cart = '1'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'
					AND active = '1'
					ORDER BY display_order";
	$result = $dbCustom->getResult($db,$sql);					
			$i = 0;
			if($col == 1){
				$limit = 2;	
			}else{
				$limit = 7;
			}

			while($row = $result->fetch_object()) {
				$db = $dbCustom->getDbConnect(CART_DATABASE);

				$sql = "SELECT child_cat_to_parent_cat_id 
						FROM child_cat_to_parent_cat
						WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'
						";
				$tgc_res = mysql_query($sql);
				if(!$tgc_res)die(mysql_error());
				if($i < $limit){
					if(!mysql_num_rows($tgc_res) > 0){
						
						if($store_data->getItemCount(0,0,$row->cat_id,0,'cart') > 0){					
							
							//$url_array[] = "/".$_SESSION['global_url_word'].$row->seo_url."/category.html?prodCatId".$row->cat_id;
							$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id));
							$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list));
						$i++;
						}
					}
				}
			}
		}elseif($footer_nav_label_v["submenu_content_type"] == 2){
			$db = $dbCustom->getDbConnect(CART_DATABASE);
		
			$sql = "SELECT name ,brand_id 
					FROM brand 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					LIMIT 10";
	$result = $dbCustom->getResult($db,$sql);			
			if($col == 1){ 
				$limit = 2;
			}else{
				$limit = 9;
			}
			$i = 0;
			while($row = $result->fetch_object()) {
				if($i < $limit){
					$url_array[] = "/".$_SESSION['global_url_word']."category.html?brandId=".$row->brand_id;
					$url_array = array_merge($url_array,loadBrandsWithPaging($row->brand_id, $row->name));
				}
			}
		}else{
    		$footer_nav_submenu_labels = $nav->getFooterNavSubmenuLabels($footer_nav_label_v["id"], $col);
			foreach($footer_nav_submenu_labels as $footer_nav_submenu_label_v){
				if((substr_count($footer_nav_submenu_label_v['url'], "account") < 1)){			
					$url_array[] = "/".$footer_nav_submenu_label_v['url'];  
				}
			}
		}
		$col++;
	}


	// ************ From top cats *************
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT cat_id, seo_list 
			FROM category
			WHERE show_in_cart = '1'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'
			AND active = '1'";
$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {
						
		$sql = "SELECT child_cat_to_parent_cat_id 
				FROM child_cat_to_parent_cat
				WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
		$tgc_res = mysql_query($sql);
		if(!$tgc_res)die(mysql_error());
				
		if(!mysql_num_rows($tgc_res) > 0){
			if($store_data->getItemCount(0,0,$row->cat_id,0,'cart') > 0){
				//$url_array[] = "/".$_SESSION['global_url_word'].$row->seo_url."/category.html?prodCatId".$row->cat_id;
				$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id));
				$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list));
				$i++;
			}
		}		
	}



	// ************ From home page cats *************
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT category.cat_id
				,category.seo_url
				,category.seo_list
				,category.show_in_showroom
				,category.show_in_cart
				,category.img_alt_text 
				FROM category, image
				WHERE category.img_id = image.img_id
				AND category.show_on_home_page  = '1'					
				AND category.active  = '1'
				AND category.profile_account_id = '".$_SESSION['profile_account_id']."'";
	$cat_result = mysql_query ($sql);
	if(!$cat_result)die(mysql_error());
	$i = 1;
	while($cat_row = mysql_fetch_object($cat_result)) {
		
		if($store_data->getItemCount(0,0,$cat_row->cat_id,0,'') > 0){
			
			if($cat_row->show_in_cart == 1){
				//$url_array[] ="/".$_SESSION['global_url_word'].$cat_row->seo_url."/category.html?prodCatId".$cat_row->cat_id;
				$url_array = array_merge($url_array,loadCatsWithPaging($cat_row->cat_id));
				$url_array = array_merge($url_array,loadBreadCrumbUrls($cat_row->seo_list, 'cart'));
			}else{
				$url_array[] ="/".$_SESSION['global_url_word'].$cat_row->seo_url."/showroom.html?prodCatId".$cat_row->cat_id;	
				$url_array = array_merge($url_array,loadBreadCrumbUrls($cat_row->seo_list, 'showroom'));
			}
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
				$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/blog.html?slug=blog&amp;blogprodCatId".$row->blog_cat_id;
				$sql = "SELECT title, blog_post_id 
						FROM blog_post
						WHERE blog_cat_id = '".$row->blog_cat_id."'
						AND hide = '0'";			
				$bp_res = mysql_query ($sql);
				if(!$bp_res)die(mysql_error());
				while($bp_row = mysql_fetch_object($bp_res)){

$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/".getUrlText($bp_row->title)."/blog.html?slug=blog&amp;blogPostId=".$bp_row->blog_post_id."&amp;blogprodCatId".$row->blog_cat_id;

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

/*
	echo "count:".count($url_array);
	echo "<br />";
	foreach($url_array as $k => $v){
		echo $k."   <a href='".$ste_root.$v."' target='_blank'>".$v."</a>";
		echo "<br />";	
	}
*/

	$entries[] = new xml_sitemap_entry('/', '1.0', 'daily');

	$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers";
	
	if (!file_exists($path)) {
		mkdir($path);         
	}
	
	$path .= "/".$_SESSION['profile_account_id'];
			
	if (!file_exists($path)) {
		mkdir($path);         
	}

	$path .= "/sitemap";

	if (!file_exists($path)) {
		mkdir($path);         
	}
			
	$files = glob($path."/*"); // get all file names
	foreach($files as $file){ // iterate files
		if(is_file($file)) unlink($file); // delete file			
	}
	

	$num_links = count($url_array);;	


	$i = 1;
	$file_num = 1;
	//$file_ext = '.xml';
	$file_ext = '.xml.gz';
	//$file_ext = '.gz';
	
	$file_name = 'sitemap'.$file_num.$file_ext;
	

	
	foreach($url_array as $j => $url){

		$entries[] = new xml_sitemap_entry($url, '0.5', 'daily');
		
		//echo $j."   <a href='".$ste_root.$url."' target='_blank'>".$url."</a>";
		//echo "<br />";
		
		if($i % 1000 == 0){
			//if($i % 50 == 0){
			//echo "<br />";
			//echo $file_num;
			//echo "<br />";
			//echo $file_name;
			//echo "<br />";
			$conf = new xml_sitemap_generator_config;
			$file_name = 'sitemap'.$file_num.$file_ext;

			if(substr_count($domain,'.') > 1){	
				$conf->setDomain($domain);				
			}else{
				$conf->setDomain('www.'.$domain);
			}
			$conf->setPath($path);
			$conf->setFilename($file_name);
			$conf->setEntries($entries);			
			$generator = new xml_sitemap_generator($conf);
			$generator->write();	

			$file_num++;			
			unset($entries);
		}
		$i++;
	}

	if(isset($entries)){
		$file_name = 'sitemap'.$file_num.$file_ext;
		$conf = new xml_sitemap_generator_config;
		if(substr_count($domain,'.') > 1){	
			$conf->setDomain($domain);				
		}else{
			$conf->setDomain('www.'.$domain);
		}
		$conf->setPath($path);
		$conf->setFilename($file_name);
		$conf->setEntries($entries);			
		$generator = new xml_sitemap_generator($conf);
		$generator->write();
		unset($entries);	
	}
	
	//echo $file_num;
	
	$i = 1;
	while($i <= $file_num){		
		
		$file_name = 'sitemap'.$i.$file_ext;		
		$entries[] = new xml_sitemap_entry('/'.$file_name, '9', 'daily');	
		$i++;
						
	}
	

	if(isset($entries)){
		$conf = new xml_sitemap_generator_config;
		$file_name = 'sitemap'.$file_ext;
		if(substr_count($domain,'.') > 1){	
			$conf->setDomain($domain);				
		}else{
			$conf->setDomain('www.'.$domain);
		}
		$conf->setPath($path);
		$conf->setFilename($file_name);
		$conf->setEntries($entries);			
		$generator = new xml_sitemap_generator($conf);
		$generator->write();
	}


	$msg = "Sitemaps Created With ".$num_links." urls";

}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>


<style>
.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-left: -50px; /* half width of the spinner gif */
    margin-top: -50px; /* half height of the spinner gif */
    text-align:center;
    z-index:1234;
    overflow: auto;
    width: 100px; /* width of the spinner gif */
    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
}

</style>

<script>


var submitted = false;
function doSubmit() {
	if (!submitted) {
		submitted = true;
		ProgressImg = document.getElementById('inprogress_img');
		document.getElementById("inprogress").style.visibility = "visible";
		setTimeout("ProgressImg.src = ProgressImg.src",1000);
		return true;
	}else{
		return false;
	}
}


$(document).ready(function() {

		//$('#spinner').show();	

});	

//$(window).load(function(){
	  //$('#spinner').hide();
//});

</script>

</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">



    	<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("SEO", '');
        echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//SEO section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/seo-section-tabs.php");
        $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		


		
		//$string = "Test";
		//$zipped = gzencode($string);
		//echo "<textarea>".$zipped."</textarea>";
		
		
		
		
		//$file = 'sitemap.gz';
		// Open the file to get existing content
		//$current = file_get_contents($file);
		//echo $current;
		
		// Append a new person to the file
		//$current .= "John Smith\n";
		// Write the contents back to the file
		
		
		//file_put_contents($file, $zipped);
		//$filename = "sitemap.gz";
		//echo "|".strtolower(substr($filename,-2))."|";
		
		?>
		<br /><br /><br />
        
        
            <p style="visibility:hidden" id="inprogress"> <img id="inprogress_img" src="<?php echo $ste_root; ?>/images/progress.gif"> Please Wait... </p>

        
        
		
		<?php 

        if($admin_access->cms_level > 1){
            //echo "<button class='btn btn-success btn-large' name='edit_global_word' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        
			//echo "<a class='btn btn-success btn-large' href='sitemap-generator.php?action=generate'>Generate Sitemap</a>";		
		
		
		?>
    
        <form action="sitemap-generator.php" method="get" onSubmit="doSubmit()">
        	<input type="hidden" name="action" value="generate">
        	<button class='btn btn-success btn-large'>Generate Sitemap</button>         
        </form>
     
        
        <?php
		
		
		
		
		}else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
  	</div>
        
    <p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>

