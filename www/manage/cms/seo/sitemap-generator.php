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
	$nav = new Nav;
	
	$t = array();

	$items_array = array_merge($t,$store_data->getItemDataFromBrand($brand_id, 0, 0));	
	foreach($items_array as $item){
		
		$brand_name = getBrandName($brand_id);
		$temp = $nav->getItemUrl($item['seo_url'], $item['name'], $item['profile_item_id'], $brand_name, 'shop', $item['hide_id_from_url']);
		
		$t[] = str_replace($ste_root, '', $temp);
		//$t[] = '/'.$_SESSION['global_url_word'].'/'.$item['seo_url'].'/product.html?itemId='.$item['item_id'];	
		
	}

	$num_items = $store_data->getItemCount(0,0,$brand_id, 0, 'cart');
	if($num_items > 0){
		$num_pages = getNumPages($num_items,6);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=6&amp;pagenum='.$i;
		}
	}

	if($num_items > 6){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=12&amp;pagenum='.$i;
		}
	}

	if($num_items > 12){
		$num_pages = getNumPages($num_items,24);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=24&amp;pagenum='.$i;
		}
	}
		
	if($num_items > 24){
		$num_pages = getNumPages($num_items,30);							
		for($i = 0; $i <= $num_pages; $i++){		
			$t[] = '/'.getUrlText($name).'/category.html?prodCatId=0&amp;brandId='.$brand_id.'&amp;pageRows=30&amp;pagenum='.$i;
		}
	}
	
	return $t;
	
}


function loadCatsWithPaging($the_cat_id, $show_in = 'cart'){

		$store_data = new StoreData;
		$nav = new Nav;

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

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
				,name
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
			$name = $object->name;
			
		}else{
			$seo_list = '';
			$seo_url = '';
			$profile_cat_id = 0;
			$show_in_showroom = '';
			$show_in_cart = '';
			$name = '';
		}
	
	
		/* doing all categories below
		if($show_in_showroom){
			
			$t[] = '/showroom-category-'.$profile_cat_id.'/'.$nav->getUrlText($name).'.html';			
			//$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'showroom'));				
			$t = array_merge($t,loadItemsPerCat($the_cat_id, 'showroom'));	
		}
		if($show_in_cart || ($show_in_showroom && $show_in_cart)){

			$t[] = '/category-'.$profile_cat_id.'/'.$nav->getUrlText($name).'.html';			
			//$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'cart'));
			$t = array_merge($t,loadItemsPerCat($the_cat_id, 'cart'));								
		}
		*/
	
	
	
		$num_items = $store_data->getItemCount(0,0,$cat_id, 0, 'cart');	
		if($num_items > 0){
			$num_pages = getNumPages($num_items,6);			
			for($i = 1; $i <= $num_pages; $i++){
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=6&amp;sort=&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=6&amp;sort=price_asc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=6&amp;sort=price_desc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=6&amp;sort=featured&amp;pagenum='.$i;
			}
		}					
		if($num_items > 6){
			$num_pages = getNumPages($num_items,12);									
			for($i = 1; $i <= $num_pages; $i++){		
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=12&amp;sort=&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=12&amp;sort=price_asc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=12&amp;sort=price_desc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=12&amp;sort=featured&amp;pagenum='.$i;
			}
		}		
		if($num_items > 12){
			$num_pages = getNumPages($num_items,24);									
			for($i = 1; $i <= $num_pages; $i++){		
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=24&amp;sort=&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=24&amp;sort=price_asc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=24&amp;sort=price_desc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=24&amp;sort=featured&amp;pagenum='.$i;
			}			
		}		
		if($num_items > 24){
			$num_pages = getNumPages($num_items,30);
			for($i = 1; $i <= $num_pages; $i++){		
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=30&amp;sort=&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=30&amp;sort=price_asc&amp;pagenum='.$i;
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=30&amp;sort=price_desc&amp;pagenum='.$i;				
				$t[] = '/'.$seo_url.'/category.html?prodCatId='.$profile_cat_id.'&amp;brandId=0&amp;pageRows=30&amp;sort=featured&amp;pagenum='.$i;
				
				
			}
		}
		
				
	}

	// /closet-organizer-accessories/category.html?prodCatId=25&brandId=0&pageRows=6&sort=&pagenum=2

	/*
	
	$desc_cat_ids = $store_data->getDescendentCats($the_cat_id, 0, 0, 'showroom');	
	$desc_cat_ids[] = $the_cat_id;
	$bc_profile_cat_id = 0;
	foreach($desc_cat_ids as $cat_id){

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
		
		
				$t[] = '/'.$_SESSION['global_url_word'].$seo_url.'/showroom.html?prodCatId='.$profile_cat_id;
		
		
				//$t = array_merge($t,loadBreadCrumbUrls($seo_list, 'showroom'));				
				$t = array_merge($t,loadItemsPerCat($the_cat_id, 'showroom'));	

	
		}
	

	}
	*/
	
	

	return $t;
	
}

function getChildItemData($item_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT DISTINCT item.item_id 
						,item.profile_item_id
						,item.name
						,item.seo_url
						,item.brand_id
						,item.hide_id_from_url
					FROM item
					WHERE parent_item_id = '".$item_id."'
					AND item.date_inactive > NOW()
					AND item.date_active <= NOW()";
	$result = $dbCustom->getResult($db,$sql);		
	$t = array();
	$i = 0;
	while($row = $result->fetch_object()){
	
		$t[$i]['item_id'] = $row->item_id;
		$t[$i]['profile_item_id'] = $row->profile_item_id;
		$t[$i]['name'] = $row->name;
		$t[$i]['seo_url'] = $row->seo_url;
		$t[$i]['brand_id'] = $row->brand_id;
		$t[$i]['hide_id_from_url'] = $row->hide_id_from_url;
		$i++;
	}

	return $t; 	
	
}

function loadItemsPerCat($cat_id, $show_in = 'cart', $price_bottom = 0, $price_top = 0){


	$nav = new Nav;
	$store_data = new StoreData;
	$t = array();
	
	if($show_in == 'cart'){
		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'cart');
		foreach($long_array as $val) {

			$brand_name = getBrandName($val['brand_id']);
			$temp = $nav->getItemUrl($val['seo_url'], $val['name'], $val['profile_item_id'], $brand_name, 'shop', $val['hide_id_from_url']);
			$t[] = str_replace($ste_root, '', $temp);

			$ch_tmp_array = getChildItemData($val['item_id']);
			foreach($ch_tmp_array as $ch_tmp_v){
				
				
							
				$brand_name = getBrandName($ch_tmp_v['brand_id']);
				$temp = $nav->getItemUrl($ch_tmp_v['seo_url'], $ch_tmp_v['name'], $ch_tmp_v['profile_item_id'], $brand_name, 'shop', $ch_tmp_v['hide_id_from_url']);
				$t[] = str_replace($ste_root, '', $temp);
				
				//echo "<br />";
				//echo "<br />";				
				//echo $temp;
				//echo "<br />";
				//echo "<br />";
								
			}

		}
		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'showroom');
		foreach($long_array as $val) {
			$temp = $nav->getItemUrl($val['seo_url'], $val['name'], $val['profile_item_id'], '', 'showroom', $val['hide_id_from_url']);
			$t[] = str_replace($ste_root, '', $temp);
		
		}
		
	}else{

		$long_array = $store_data->getItemDataFromCat($cat_id, $price_bottom, $price_top, 'showroom');
		foreach($long_array as $val) {
			$temp = $nav->getItemUrl($val['seo_url'], $val['name'], $val['profile_item_id'], '', 'showroom', $val['hide_id_from_url']);
			$t[] = str_replace($ste_root, '', $temp);			
					
		}
	}
	return $t; 
}




function getNumPages($total_count,$page_rows){	
	$num_pages = ceil($total_count/$page_rows); 
	return $num_pages;	
}




if(isset($_GET['action'])){


	require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.xml.sitemap.generator-modified.php");

	$url_array = array();



	$url_array[] = '/'.$_SESSION['global_url_word'].'category.html';
	$url_array[] = '/'.$_SESSION['global_url_word'].'showroom.html';




	// ************ From nav bar *************
	$navbar_labels = $nav->getNavbarLabels();
    foreach($navbar_labels as $navbar_label_v){

		$t = $navbar_label_v['url'];
		$url_array[] = str_replace($ste_root,'',$t);
		
	}


/*
		$brands =  $nav->getNavBarBrands();
		if(is_array($brands)){
			foreach($brands as $val){
				$url_array[] = '/'.getUrlText($val['name'])."/category.html?brandId=".$val['brand_id'];
				$url_array = array_merge($url_array,loadBrandsWithPaging($val['brand_id'], 'cart'));
				//$url_array = array_merge($url_array,loadBreadCrumbUrls($val['seo_list'], 'cart'));
			}
		}
*/

		$top_cats =  $nav->getTopCats();
			
		foreach($top_cats as $top_cat_val){	

			if($top_cat_val['destination'] == 'showroom'){		
				$temp = $nav->getCatUrl($top_cat_val['name'], $top_cat_val['profile_cat_id'], 'showroom');
			}else{
				$temp = $nav->getCatUrl($top_cat_val['name'], $top_cat_val['profile_cat_id'], 'shop');
			}

			$url_array[] = str_replace($ste_root, '', $temp);
				
			if(count($top_cat_val['child_array']) > 0){
				
				foreach($top_cat_val['child_array'] as $child_cat_val){
						
						
						
					if($child_cat_val['destination'] == 'showroom'){		
						$temp = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'showroom');
					}else{
						$temp = $nav->getCatUrl($child_cat_val['name'], $child_cat_val['profile_cat_id'], 'shop');
					}
						
					$url_array[] = str_replace($ste_root, '', $temp);
				}	
			}				

		}





	$t = array();


	// ************ All cats *************
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT 
			cat_id
			,seo_list
			,seo_url
			,seo_list
			,show_in_cart
			,show_in_showroom
			,profile_cat_id
			,name 
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
			
			
			// New 09/04/2015
			if($store_count > 0 && $showroom_count > 0){
		
				$destination = 'both';
				$go = 1;
			
			
			}elseif($showroom_count > 0){ 
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
			if($row->show_in_cart){
				$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');					
				$destination = 'cart';
				if($store_count > 0){ 
					$go = 1;
				}
			}
		}				

		if($go){
			
			
			if($destination == 'both'){

				$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id, 'cart'));
					//$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list, 'cart'));
								
				
				$temp = $nav->getCatUrl($row->name, $row->profile_cat_id, 'shop');
				$t[] = str_replace($ste_root, '', $temp);
				
				
				$t = array_merge($t,loadItemsPerCat($row->cat_id, 'cart'));

				$temp = $nav->getCatUrl($row->name, $row->profile_cat_id, 'showroom');
				$t[] = str_replace($ste_root, '', $temp);
				$t = array_merge($t,loadItemsPerCat($row->cat_id, 'showroom'));
			
			}elseif($destination == 'cart'){
				$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id, 'cart'));
					//$url_array = array_merge($url_array,loadBreadCrumbUrls($row->seo_list, 'cart'));
				$temp = $nav->getCatUrl($row->name, $row->profile_cat_id, 'shop');
				$t[] = str_replace($ste_root, '', $temp);
		
				$t = array_merge($t,loadItemsPerCat($row->cat_id, 'cart'));

			}else{
				
				$url_array = array_merge($url_array,loadCatsWithPaging($row->cat_id, 'showroom'));
				
				$temp = $nav->getCatUrl($row->name, $row->profile_cat_id, 'showroom');
				$t[] = str_replace($ste_root, '', $temp);
				$t = array_merge($t,loadItemsPerCat($row->cat_id, 'showroom'));
				
			}
			
			
			
		
			
		}
		
			
	}
	
	
$url_array = array_merge($url_array,$t);	





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
			
			$res = $dbCustom->getResult($db,$sql);
			
			
			
			while($row = $res->fetch_object()){
				$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/blog.html?slug=blog&amp;blogCatId=".$row->blog_cat_id;
				$sql = "SELECT title, blog_post_id 
						FROM blog_post
						WHERE blog_cat_id = '".$row->blog_cat_id."'
						AND hide = '0'";			
				
				$res2 = $dbCustom->getResult($db,$sql);
				
				while($bp_row = $res2->fetch_object()){

$url_array[] = '/'.$_SESSION['global_url_word'].getUrlText($row->name)."/".getUrlText($bp_row->title)."/blog.html?slug=blog&amp;blogPostId=".$bp_row->blog_post_id."&amp;blogCatId".$row->blog_cat_id;

				}
			}	
		}
	}





if(!isset($_SESSION['seo'])) $_SESSION['seo'] = 1;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT seo_name , page_name 
		FROM page_seo
		WHERE active = '1' 
		AND profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY page_name";
							
$result = $dbCustom->getResult($db,$sql);
		

while($row = $result->fetch_object()){			
	if($_SESSION['seo']){
		$url_array[] = '/'.$_SESSION['global_url_word'].$row->seo_name.'.html';
	}else{
		$url_array[] = '/'.$_SESSION['global_url_word'].$row->page_name.'.html';
	}		
}
		
		
	


$url_array = array_unique($url_array);


$final_array = array(); 
foreach($url_array as $url){
	$final_array[] = str_replace ("//" ,"/" ,$url);
}





/*
foreach($final_array as $url){
	echo $url;
	echo "<br />";
}
*/

echo "count:".count($url_array);
echo "<br />";
foreach($url_array as $k => $v){
	echo $k."   <a href='".$ste_root.$v."' target='_blank'>".$v."</a>";
	echo "<br />";	
}




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
	

	$num_links = count($final_array);;	


	$i = 1;
	$file_num = 1;
	//$file_ext = '.xml';
	$file_ext = '.xml.gz';
	//$file_ext = '.gz';
	
	$file_name = 'sitemap'.$file_num.$file_ext;
	

	
	foreach($final_array as $j => $url){

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
		$bread_crumb->add("Site Map Generator", '');
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

