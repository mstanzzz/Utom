<?php

require_once($_SERVER['DOCUMENT_ROOT']."/includes/accessory_cart_functions.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.store_data.php');


function getPDFStepSize($max_count){

	return 10;
}


function getRegion($state = "OR"){
	
	if($state == 'FL'
		|| $state == 'GA'
		|| $state == 'SC'
		|| $state == 'NC'
		|| $state == 'VA'
		|| $state == 'WV'
		|| $state == 'MD'
		|| $state == 'BE'
	){
		return 'sa';	
	}
		
	if($state == 'NY'
		|| $state == 'PA'
		|| $state == 'NJ'
	){
		return 'ma';	
	}
	
	
	if($state == 'CT'
		|| $state == 'RI'		
		|| $state == 'MA'
		|| $state == 'NH'
		|| $state == 'VT'
		|| $state == 'ME'

	){
		return 'ne';	
	}
	
	
		
	if($state == 'AL'
		|| $state == 'MS'
		|| $state == 'TN'
		|| $state == 'KY'
	){
		return 'esc';	
	}
		
	if($state == 'OH'
		|| $state == 'IN'
		|| $state == 'IL'		
		|| $state == 'MI'
		|| $state == 'WI'
	){
		return 'enc';	
	}
		
	if($state == 'LA'
		|| $state == 'AR'
		|| $state == 'OK'		
		|| $state == 'TX'
	){
		return 'wsc';	
	}
	
	if($state == 'MO'
		|| $state == 'IA'
		|| $state == 'MN'
		|| $state == 'KS'		
		|| $state == 'NE'		
		|| $state == 'SD'		
		|| $state == 'ND'
	){
		return 'wnc';	
	}


	if($state == 'NM'
		|| $state == 'AZ'		
		|| $state == 'CO'				
		|| $state == 'UT'
		|| $state == 'NV'						
		|| $state == 'WY'		
		|| $state == 'ID'		
		|| $state == 'MT'								
	){
		return 'mt';	
	}


	if($state == 'CA'
		|| $state == 'OR'
		|| $state == 'WA'		
		|| $state == 'AK'
		|| $state == 'HI'
	){
		return 'pc';	
	}

	return 'none';	
	
}



function cut_name_from_front($name, $limit){	
	
	$fn_array = array();
	$new_name = '';
	$fn_array = explode('-',$name);
	$fn_array_size = count($fn_array);

	$len = strlen($name);

	if($len > $limit){
		if($fn_array_size > 1){
			$i=0;
			foreach($fn_array as $val){
						
				if($i > 1){
					$new_name .= $val;
					if($i < ($fn_array_size -1)){
						$new_name .= '-';
					}										 
				}
				
				$i++;
			}
		}else{	
			if($len > 9){
				$new_name = substr($name,3);
			}
		}
	}


	$len = strlen($new_name);

	if($len > $limit){
		$new_name = cut_name_from_front($new_name, $limit);
	}
	
	if($new_name == ''){
		$new_name = $name;	
	}
	
	
	return $new_name;
	
}







function rename_cart_images_in_dirs($old_file_name, $new_file_name, $tmp='', $domain){
	

	
if($old_file_name != '' && $new_file_name != ''){
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$new_file_name;	
if(file_exists($from)) rename($from,$to);
					
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$new_file_name;	
if(file_exists($from))rename($from , $to);
		
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$new_file_name;	
if(file_exists($from))rename($from , $to);

/* ***  WIDE *** */
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$new_file_name;	
if(file_exists($from)) rename($from,$to);
					
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
		
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/wide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/wide/".$new_file_name;	
if(file_exists($from))rename($from , $to);



/* *** EXWIDE *** */
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$new_file_name;	
if(file_exists($from)) rename($from,$to);
					
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
		
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$new_file_name;	
if(file_exists($from))rename($from , $to);
	
$from 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/exwide/".$old_file_name;
$to 	= $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/exwide/".$new_file_name;	
if(file_exists($from))rename($from , $to);


// /saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$orig_img_fn;





}
	
}


function getOriginalCatName($cat_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name
			FROM category
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->name;			
	}else{
		return '';
	}
	
}



function getOriginalItemName($item_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name
			FROM item
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->name;			
	}else{
		return '';
	}
	
}


function update_cart_image_file_name_in_db($img_id, $new_file_name){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "UPDATE image
			SET file_name = '".$new_file_name."'
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	
}

function getNumChildItems($item_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id
			FROM  item
			WHERE parent_item_id = '".$item_id."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);		
	return $result->num_rows;
	
}



function getCatDestination($cat_id, $show_in_cart, $show_in_showroom){

	$store_data = new StoreData;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	if($show_in_cart && $show_in_showroom){
		$showroom_count = $store_data->getItemCount(0,0,$cat_id,0,'showroom');					
		if($showroom_count > 0){
			$dest = 'showroom';
		}else{
			$dest = 'cart';
		}
	}elseif($show_in_showroom){
		$dest = 'showroom';
	}else{
		$dest = 'cart';
	}

	return $dest;
	
}

function getRevewReqEmailText($type = 'auto'){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		
	$sql = "SELECT *
		FROM review_req_email_text 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content_auto = $object->content_auto;
		$content_manual = $object->content_manual;
			
	}else{
		$content_auto = '';
		$content_manual = '';
	}	
		
		
	if($type == 'auto'){
		return $content_auto;		
	}else{
		return $content_manual;				
	}
	
	
}



function setActiveTab($tab)
{
	if(strpos($_SERVER['REQUEST_URI'],"/".$tab) > 0){
		return "class='active'";	
	}else{
		return '';	
	}
}


function prepFormInputStr($str)
{
	return stripAllSlashes(htmlentities($str,ENT_QUOTES));
}


// this is used for bread crumbs and dynamic html titles
function getParentCatListData($cat_id){
	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT category.cat_id, category.profile_cat_id, category.name, category.seo_url
		FROM child_cat_to_parent_cat, category
		WHERE child_cat_to_parent_cat.parent_cat_id = category.cat_id
		AND child_cat_to_parent_cat.child_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret_array['profile_cat_id'] = $object->profile_cat_id;
		$ret_array['cat_id'] = $object->cat_id;
		$ret_array['name'] = getUrlText($object->name);
		$ret_array['seo_url'] = $object->seo_url;		 	
	}
	return $ret_array;
}
function getItemSeoList($item_id, $name){
	
	$item_seo_list = getUrlText($name);
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT max(cat_id) AS cat_id
			FROM item_to_category
			WHERE item_id = '".$item_id."'";
	$res = $dbCustom->getResult($db,$sql);
	
	if($res->num_rows > 0){
		$object = $res->fetch_object();		
		$list = getCatSeoList($object->cat_id);
		$item_seo_list = $list.'|'.$item_seo_list;			
	}
	return $item_seo_list;		
}

function getItemSeoUrl($item_id, $name = ''){
	$ret = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = sprintf("SELECT category.cat_id,
				category.name	
			FROM item_to_category, category
			WHERE item_to_category.cat_id = category.cat_id 
			AND item_to_category.item_id = '%u'
			ORDER BY cat_id", $item_id);
	
	$cat_2_res = $dbCustom->getResult($db,$sql);
	if($cat_2_res->num_rows > 0){
		
		$cat_2_obj = $cat_2_res->fetch_object();
		$sql = sprintf("SELECT category.name
			FROM child_cat_to_parent_cat, category
			WHERE child_cat_to_parent_cat.parent_cat_id = category.cat_id
			AND child_cat_to_parent_cat.child_cat_id = '%u'", $cat_2_obj->cat_id);
		$cat_1_res = $dbCustom->getResult($db,$sql);
		if($cat_1_res->num_rows > 0){
			$cat_1_obj = $cat_1_res->fetch_object();
			$ret .= getUrlText($cat_1_obj->name).'/';
		}
		$ret .= getUrlText($cat_2_obj->name).'/';
	}
	
	if($name != ''){
		$ret .= getUrlText($name).'/';
	}
	return $ret;
}

function getCatSeoList($cat_id){
	$cat_seo_list = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);	
	$sql = "SELECT cat_id, profile_cat_id, name, seo_url
		FROM category
		WHERE cat_id = '".$cat_id."'";
	$res = $dbCustom->getResult($db,$sql);
	
	if($res->num_rows > 0){
		$object = $res->fetch_object();
		$cat_seo_list =  $object->profile_cat_id.','.$object->cat_id.','.getUrlText($object->name).','.$object->seo_url;
	}
	$is_next_cat = 1;
	$current_cat_id = $cat_id;
	while($is_next_cat){
		$tmp_cat_array = getParentCatListData($current_cat_id);
		if(count($tmp_cat_array) > 0){
			$cat_seo_list =  $tmp_cat_array['profile_cat_id'].','.$tmp_cat_array['cat_id'].','.$tmp_cat_array['name'].','.$tmp_cat_array['seo_url'].'|'.$cat_seo_list;			
			$current_cat_id = $tmp_cat_array['cat_id'];
		}else{
			$is_next_cat = 0;
		}
	}
	return $cat_seo_list;
}

function getCatSeoUrl($cat_id, $name){
	$ret = '';
	
	/*
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = sprintf("SELECT category.name
		FROM child_cat_to_parent_cat, category
		WHERE child_cat_to_parent_cat.parent_cat_id = category.cat_id
		AND child_cat_to_parent_cat.child_cat_id = '%u'", $cat_id);
	
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret .= getUrlText($object->name)."/";
	}
	*/
	
	$ret .= getUrlText($name);
	return $ret;
}


function reSetAllItemSeoUrlAndList(){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id, name
			FROM item
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $result->fetch_object()){
		
		//$seo_url = getItemSeoUrl($row->item_id,$row->name);
		
		$seo_url = getItemSeoUrl($row->item_id);
		
		
		$sql = "UPDATE item
				SET seo_url = '".$seo_url."'
				WHERE item_id = '".$row->item_id."'";
		$res = $dbCustom->getResult($db,$sql);
		
		
		$seo_list = getItemSeoList($row->item_id,$row->name);
		$sql = "UPDATE item
				SET seo_list = '".$seo_list."'
				WHERE item_id = '".$row->item_id."'";
		$res = $dbCustom->getResult($db,$sql);
				
	}
}


function reSetAllCatSeoUrlAndList(){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT cat_id, name
			FROM category
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$item_res = $dbCustom->getResult($db,$sql);
	
	while($row = $item_res->fetch_object()){
		
		$seo_url = getCatSeoUrl($row->cat_id,$row->name);

		$sql = "UPDATE category
				SET seo_url = '".$seo_url."' 
				WHERE cat_id = '".$row->cat_id."'";
		$result = $dbCustom->getResult($db,$sql);
				

		$seo_list = getCatSeoList($row->cat_id);
		$sql = "UPDATE category
				SET seo_list = '".$seo_list."' 
				WHERE cat_id = '".$row->cat_id."'";
		$result = $dbCustom->getResult($db,$sql);

	}
}

// FOR ALL CUSTOMERS
function reSetAllItemSeoUrlAndListGlobal(){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id, name
			FROM item";
	$item_res = $dbCustom->getResult($db,$sql);
	
	while($row = $item_res->fetch_object()){
		
		//$seo_url = getItemSeoUrl($row->item_id,$row->name);
		
		$seo_url = getItemSeoUrl($row->item_id);
		
		
		$sql = "UPDATE item
				SET seo_url = '".$seo_url."'
				WHERE item_id = '".$row->item_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		
		$seo_list = getItemSeoList($row->item_id,$row->name);
		$sql = "UPDATE item
				SET seo_list = '".$seo_list."'
				WHERE item_id = '".$row->item_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}
}


// FOR ALL CUSTOMERS
function reSetAllCatSeoUrlAndListGlobal(){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT cat_id, name
			FROM category";
	$item_res = $dbCustom->getResult($db,$sql);
	
	while($row = $item_res->fetch_object()){
		$seo_url = getCatSeoUrl($row->cat_id,$row->name);

		$sql = "UPDATE category
				SET seo_url = '".$seo_url."' 
				WHERE cat_id = '".$row->cat_id."'";
		$result = $dbCustom->getResult($db,$sql);
				

		$seo_list = getCatSeoList($row->cat_id);

		$sql = "UPDATE category
				SET seo_list = '".$seo_list."' 
				WHERE cat_id = '".$row->cat_id."'";
		$result = $dbCustom->getResult($db,$sql);
				

	}
}



function getPagination($total_rows = 0
	,$rows_per_page 
	,$pagenum = 1
	,$truncate = 1
	,$last = 1
	,$path
	,$sortby = ''
	,$a_d = 'a'
	,$uid1 = 0
	,$uid2 = 0
	,$search_str = ''
	,$cat_id = 0
	,$parent_cat_id = 0
	,$strip = 0){

	// uid1 and uid2 can be used for anything you want to pass on the url
	// truncate is nolonger used. 

	$previous = $pagenum-1;
	$next = $pagenum+1;
	if ($next > $last) $next = $last; 

	if(($pagenum - 5) > 0){
		$start = $pagenum - 5;
		$end = $pagenum + 5;
	}else{
		$start = 1;
		$end = 10;		
	}

/*
echo "<br />";
echo "<br />";
echo "path ".$path;
echo "<br />";
echo "<br />";
echo $ste_root."manage/".$path;
exit;
*/

	if($end > $last) $end = $last; 
	
	$block = '';
	$block .= "<div class='pagination'>";
	$block .= "<span>Displaying Page ".$pagenum."/<a href='".$path;
	$block .= "?pagenum=".$last."&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
	$block .= $last."</a> of ".$total_rows." results</span>"; 
	$block .= "<ul>";

	$block .= "<li class='back_arrow'><a href='".$path;
	$block .= "?pagenum=1&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
	$block .= "<i class='icon-chevron-left-double'></i></li>";
	$block .= "<li class='back_arrow'><a href='".$path;
	$block .= "?pagenum=".$previous."&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
	$block .= "<i class='icon-chevron-left'></i></a></li>";
	
	for($i = $start; $i <= $end; $i++){
		if($i == $pagenum){
			$block .= "<li class='current_page'>$i</li>";
		}else{
			$block .= "<li><a href='".$path;
			$block .= "?pagenum=".$i."&truncate=0&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
			$block .= $i."</a></li>";
		}
	}
	
	if($end < $last){
		$this_next_page = $end + 1;
		$block .= "<li><a href='".$path;
		$block .= "?pagenum=".$this_next_page."&truncate=0&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
		$block .= "...</a></li>";
	}		
	
	$block .= "<li class='next_arrow'><a href='".$path;
	$block .= "?pagenum=".$next."&truncate=0&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
	$block .= "<i class='icon-chevron-right'></i></a></li>";
	$block .= "<li class='next_arrow'><a href='".$path;
	$block .= "?pagenum=".$last."&truncate=0&sortby=".$sortby."&a_d=".$a_d."&uid1=".$uid1."&uid2=".$uid2."&search_str=".$search_str."&cat_id=".$cat_id."&parent_cat_id=".$parent_cat_id."&strip=".$strip."'>";
	$block .= "<i class='icon-chevron-right-double'></i></a></li>";
	$block .= "</ul>";
	$block .= "</div>";
	
	return $block;
		
}

function deleteProfile($profile_account_id){

	$ret = 1;

	$dbCustom = new DbCustom();

	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id 
			FROM admin_group 
			WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){ 
		$ret = 0;
		//die(mysql_error());
	}
	while($row = $result->fetch_object()){
		$sql = "DELETE FROM admin_access 
				WHERE admin_group_id = '".$row->id."'";
		$res = $dbCustom->getResult($db,$sql);
		if(!$res){
			$ret = 0;
			//die(mysql_error());
		}

		$sql = "DELETE FROM admin_user_to_admin_group 
				WHERE admin_group_id = '".$row->id."'";
		$res = $dbCustom->getResult($db,$sql);
		if(!$res){
			$ret = 0;
			//die(mysql_error());
		}
	}

	$sql = "DELETE FROM admin_group 
			WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){
		$ret = 0;
		//die(mysql_error());
	}

	$sql = "DELETE FROM user 
			WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){
		$ret = 0;
		//die(mysql_error());
	}
		
	$sql = "DELETE FROM profile_account 
			WHERE id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){
		$ret = 0;
		//die(mysql_error());
	}
		
	$sql = "DELETE FROM profile_account_to_module 
			WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){
		$ret = 0;
		//die(mysql_error());
	}
	
	$sql = "DELETE FROM setup_steps
			WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	

	return $ret;
	
}




function getProfileType()
{
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT profile_account_type.name
			FROM profile_account_type, profile_account
			WHERE profile_account_type.id = profile_account.profile_account_type_id
			AND profile_account.id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$account_type = $object->name;	
	}else{
		$account_type = "non_parent";
	}
	
	
	return $account_type;
		
}



function isProfileChild($profile_account_id)
{
	$ret = 0;
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			FROM profile_account
			WHERE parent_id = '".$_SESSION['profile_account_id']."'
			AND profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$ret = 1;
	}
	return $ret;
}


function getChildProfiles($profile_account_id){
	
	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id, domain_name
			FROM profile_account
			WHERE parent_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	$i = 0;
	while($row = $result->fetch_object()){
		$ret_array[$i]['id'] = $row->id;
		$ret_array[$i]['domain_name'] = $row->domain_name; 
		$i++;
	}
	
	return $ret_array;
	
}


function getParentProfileId($profile_account_id){

	$ret = 0;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			FROM profile_account
			WHERE parent_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret = $object->id;	
	}
	return $ret;
}



function getPaymentProcessorId()
{
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT payment_processor_id
			FROM profile_account
			WHERE id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$payment_processor_id = $object->payment_processor_id;	
	}else{
		$payment_processor_id = 0;
	}
	
	return $payment_processor_id;
		
}


function getMaxCatId()
{
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT MAX(cat_id) as maxcat
			FROM category 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$maxcat = $object->maxcat;	
	}else{
		$maxcat = 0;
	}
	
	return $maxcat;
		
}

function categoryHasChildren($cat_id){

	$ret = 0;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT child_cat_to_parent_cat_id  
			FROM child_cat_to_parent_cat  
			WHERE child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows){
		$ret = 1;
	}
	
	return $ret;
}


function getItemCats($item_id){

	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT category.cat_id, category.name 
			FROM item_to_category, category 
			WHERE category.cat_id = item_to_category.cat_id
			AND item_to_category.item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {			
		$ret_array[$i]['cat_id'] = $row->cat_id;
		$ret_array[$i]['name'] = $row->name;
		$i++;
	}
	
	return $ret_array;
	
}





function getCatParentCats($cat_id){

	$ret_array = array();
	
	if($cat_id > 0){

		//echo $cat_id;
		$dbCustom = new DbCustom();	
		$db = $dbCustom->getDbConnect(CART_DATABASE);


		
		$sql = "SELECT category.cat_id, category.name 
				FROM child_cat_to_parent_cat, category 
				WHERE category.cat_id = child_cat_to_parent_cat.parent_cat_id
				AND child_cat_to_parent_cat.child_cat_id = '".$cat_id."'";
				
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {			
							
			$ret_array[$i]['cat_id'] = $row->cat_id;
			$ret_array[$i]['name'] = $row->name;
			$i++;
		}
	
	
	}
	
	
	return $ret_array;
	
}



function getItemAttrOptionsArray($item_id){

	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT opt_id
			FROM  item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	$i = 0;
	while($row = $result->fetch_object()) {			
		$ret_array[$i] = $row->opt_id;
		$i++;
	}
	return $ret_array;
}


function getCatAttrArray($cat_id){

	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	
	$sql = "SELECT attribute_id
			FROM  category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	$i = 0;
	while($row = $result->fetch_object()) {			
		$ret_array[$i] = $row->attribute_id;
		$i++;
	}
	
	return $ret_array;
}


function getFixedPartName($part_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	
	$sql = "SELECT part_name		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_name;	
	}
	
	return "";

}


function getConstructedPartName($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_name		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_name;	
	}
	
	return "";

}

function getConstructedPartTypeID($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_type_id		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_type_id;	
	}
	
	return "";

}


function getFixedPartTypeID($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_type_id		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_type_id;	
	}
	
	return "";

}



?>