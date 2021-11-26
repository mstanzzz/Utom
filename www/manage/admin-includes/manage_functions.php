<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root."/includes/accessory_cart_functions.php");
require_once($real_root.'/includes/class.store_data.php');

function getPDFStepSize($max_count){
	return 10;
}


function get_max_specs_content_id($dbCustom){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT specs_content_id
			FROM specs_content
			WHERE specs_content.specs_content_id = (SELECT MAX(specs_content_id) 
										FROM specs_content 
										WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->specs_content_id;			
	}	
	return 0;
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


function getNumChildItems($dbCustom,$item_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id
			FROM  item
			WHERE parent_item_id = '".$item_id."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);		
	return $result->num_rows;
	
}


function getRevewReqEmailText($dbCustom,$type = 'auto'){

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



function setActiveTab($tab){
	if(strpos($_SERVER['REQUEST_URI'],"/".$tab) > 0){
		return "class='active'";	
	}else{
		return '';	
	}
}


function getPagination($total_rows = 0
	,$rows_per_page=1 
	,$pagenum = 1
	,$truncate = 1
	,$last = 1
	,$path=''
	,$sortby = ''
	,$a_d = 'a'
	,$uid1 = 0
	,$uid2 = 0
	,$search_str = ''
	,$cat_id = 0
	,$parent_cat_id = 0
	,$strip = 0){


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


function deleteProfile($dbCustom,$profile_account_id){
	$ret = 1;

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


function getProfileType(){
	
	
}


function isProfileChild($dbCustom,$profile_account_id){
	
	$ret = 0;

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


function getChildProfiles($dbCustom,$profile_account_id){
	
	
	$ret_array = array();
	
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


function getParentProfileId($dbCustom,$profile_account_id){
	
	$ret = 0;
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



function getPaymentProcessorId($dbCustom){

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


function getMaxCatId($dbCustom){
	
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


function categoryHasChildren($dbCustom,$cat_id){
	
	$ret = 0;
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


function getItemCats($dbCustom,$item_id){
	
	
	$ret_array = array();
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


function getItemAttrOptionsArray($dbCustom,$item_id){

	$ret_array = array();
	
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


function getCatAttrArray($dbCustom,$cat_id){

	$ret_array = array();
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


function getFixedPartName($dbCustom,$part_id){
	
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


function getConstructedPartName($dbCustom,$part_id){
	
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

function getConstructedPartTypeID($dbCustom,$part_id){
	
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


function getFixedPartTypeID($dbCustom,$part_id){
	
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




/*  SEO FILE NAMES  */
// ***************************  */


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

function getOriginalItemName($dbCustom,$item_id){

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


function cut_name_from_front($name, $limit=100){	
	$len = strlen($name);
	$new_name = '';
	if($len > $limit){
		$new_name = cut_name_from_front($name, $limit);
	}
	if($new_name == ''){
		$new_name = $name;	
	}
	return $new_name;
}

function update_cart_image_file_name_in_db($img_id, $new_file_name){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "UPDATE image
			SET file_name = '".$new_file_name."'
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);
}



function rename_cart_images_in_dirs($old_file_name, $new_file_name, $real_root, $domain=''){
	
	if($old_file_name != '' && $new_file_name != ''){

		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$new_file_name;	
		if(file_exists($from)) rename($from,$to);
						
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
			
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		/* **** wide **** */
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$new_file_name;	
		if(file_exists($from)) rename($from,$to);
						
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
			
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/wide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);

		/* **** extra wide **** */
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$new_file_name;	
		if(file_exists($from)) rename($from,$to);
						
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
			
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);
		
		$from 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/exwide/".$old_file_name;
		$to 	= $real_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/exwide/".$new_file_name;	
		if(file_exists($from))rename($from , $to);

		return 1;
	}
	return 0;
}

// ***************************  */






?>