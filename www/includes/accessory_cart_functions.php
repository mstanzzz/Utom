<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.store_data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart_item.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.module.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.seo.php');



function get_svg_block($svg_id){
		
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
	$svg = '';
	
	$sql = "SELECT svg_code
			FROM svg 
			WHERE svg_id = '".$svg_id."'";
	$result = $dbCustom->getResult($db,$sql);			
	if($result->num_rows > 0){
		$object = $result->fetch_object();						
		$svg_code = stripcslashes($object->svg_code);
		//echo $svg_code
	}
	
	return $svg_code;	

}



function obj_to_array($obj){
	return json_decode(json_encode((array)$obj),1);	
}

function _xml2array ( $xmlObject, $out = array () ){
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? _xml2array ( $node ) : $node;

    return $out;
}




		
function get_shorter($in, $len = 30){

	$out = strlen($in) > $len ? substr($in,0,$len)."..." : $in;
	
	return $out; 
}	








function has_add_to_cart_btn($has_sc_module, $call_for_pricing, $price, $ship_type, $weight, $is_free_shipping, $show_atc_btn_or_cfp){
	
	if($has_sc_module  
		&& !$call_for_pricing 
		&& $price > 0
		&& ((!($ship_type == 'carrier' && $weight == 0)) || $is_free_shipping)
		&& $show_atc_btn_or_cfp > 0){
							
		$has_add_btn = 1;
	
	}else{
		$has_add_btn = 0;	
	}
		
	return $has_add_btn;
}

function get_details_price_and_btn($item_id, $deviceType){

	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$shipping = new Shipping;
	$module = new Module;
	$seo = new Seo;
	
	$price = 0;
	$call_for_pricing = 0;
	$weight = 0;

	$price_data = "HHHH  ".$item_id;
	$btn_data = "YYYY  ".$deviceType;

	$sql = "SELECT price_flat
					,price_wholesale
					,percent_markup
					,call_for_pricing
					,weight
					,show_atc_btn_or_cfp
					,show_start_design_btn
					,show_design_request_btn			
			FROM item
			WHERE item_id = '".$item_id."'"; 
		
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
	
		$weight = $object->weight;
		
		$show_atc_btn_or_cfp = $object->show_atc_btn_or_cfp;
		$show_start_design_btn = $object->show_start_design_btn;
		$show_design_request_btn = $object->show_design_request_btn;
	
		$call_for_pricing = $object->call_for_pricing;
	
		if($object->price_flat > 0){
			$price = $object->price_flat;	
		}elseif($object->price_wholesale > 0){
			$price = $object->price_wholesale + $object->percent_markup; 
		}else{
			$price = 0;	
		}
	
	}

	if($call_for_pricing > 0){
		$price_data = 'Call For Price';	
	}else{
		if($price > 0){
			$price_data = '<strong>$'.number_format($price,2).'</strong>  per ea.';
		}
	}

	$btn_data = '';
	
	if($module->hasShoppingCartModule($_SESSION['profile_account_id'])  
		&& $call_for_pricing == 0 
		&& $price > 0
		&& (!($shipping->getShipType() == 'carrier' && $weight == 0))
		&& $show_atc_btn_or_cfp > 0){
			
			
							
		$btn_data .= "<div class='qty muted'> QTY:";
		$btn_data .= "<input id='qty' type='text' name='qty' value='1' class='product-qty' />";
		$btn_data .= "</div>";	
		
		if($deviceType == 1){
			$btn_data .= "<a class='btn btn-success' style='width:80px;' id='add_to_cart' onClick='add_item()'>Add To Cart</a>";							
		}elseif($deviceType == 2){
			$btn_data .= "<a class='btn btn-success' style='width:100px;' id='add_to_cart' onClick='add_item()'>Add To Cart</a>";
		}else{
			$btn_data .= "<a class='btn btn-success full-width' id='add_to_cart' onClick='add_item()'>Add To Cart</a>";								
		}				
	}else{
		if($show_start_design_btn || $show_design_request_btn){
			$btn_data .=  "<div style='clear:both; width:100%; margin-top:30px;'>";
			if($show_design_request_btn){
			
				$d = $seo->get_url_from_page_name('email-design');
				$url = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$d.'.html?item_id='.$item_id;
				$btn_data .=  "<div style='float:left; margin-right:10px;'> <a class='btn btn-success' href='".$url."' >Request Design</a> </div>";
			}
	
			if($show_start_design_btn && $module->hasDesignToolModule($_SESSION['profile_account_id'])){
				$tool = $_SERVER['DOCUMENT_ROOT']."/tool-page.html";
				$btn_data .=  "<div style='float:left;'> <a class='btn btn-success' href='".$tool."' >Start Designing</a> </div>";	
			}
			$btn_data .=  "</div>";
		}
	
	}
	
	
	$returnData['price_data'] = $price_data;
	$returnData['btn_data'] = $btn_data;
	
	return $returnData;
	
}



function get_details_heading($item_id){

	$item = new ShoppingCartItem;

	$heading = '';
	$heading1 = "<h1>";

	if($item_id > 0){
		$item_array = $item->getItem($item_id);
		
		if($item_array['brand_name'] != '') $heading1 .= $item_array['brand_name'].' ';
	
		$heading1 .= trim($item_array['name']).' ';	
		
		$heading2 = "<h2>".strip_tags(trim($item_array['short_description']))."</h2>";
		
		$heading = stripslashes($heading1.$heading2);
	
	}
	
	return $heading;

}


function get_details_pic($item_id, $deviceType){

	$ret_str = '';	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT image.file_name
				,item.img_alt_text				
			FROM image, item
			WHERE image.img_id = item.img_id 
			AND item.item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		$ret_str .= "<span class='product-image image-switch-large'>";
		$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'medium' : 'medium') : 'large');
		if($deviceType == 1){
			$style = '';
		}elseif($deviceType == 2){
			$style = '';
		}else{
			$style = "style='width:520px !important;'";											
		}
					
		$ret_str .= "<a class='fancybox' href='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_obj->file_name."'>
					<img $style src='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$img_obj->file_name."' 
					alt='".stripslashes($img_obj->img_alt_text)."' /></a></span>";
										
	}

	return $ret_str;

}



function is_valid_email($email){
	
	$ret = 1;
		
	if(strpos($email, '@') === false){
		$ret = 0;
	}
	
	if(strpos($email, '.') === false){
		$ret = 0;
	}
	
	if(strlen($email) < 8){
		$ret = 0;
	}

	return $ret;

}



function getOS() { 

	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";
	$os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );
						
	foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}




function getBrowser() {

	$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}




function getRealIP() {
        $ipaddress = '';
        if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ipaddress =  $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ipaddress = $_SERVER['HTTP_X_REAL_IP'];
        }
        else if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
}


function getWordFromDigit($digit){
		
	switch ($digit) {
		case 0:
			$ret = 'zero';
			break;
		case 1:
			$ret = 'one';
			break;
		case 2:
			$ret = 'two';
			break;
		case 3:
			$ret = 'three';
			break;
		case 4:
			$ret = 'four';
			break;
		case 5:
			$ret = 'five';
			break;
		case 6:
			$ret = 'six';
			break;
		case 7:
			$ret = 'seven';
			break;
		case 8:
			$ret = 'eight';
			break;
		case 9:
			$ret = 'nine';
			break;
		default:
		   $ret = 'ten';
	}					
	
	return $ret;
}



function getCityStateFromZip($zip) {
	
	
    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zip."&sensor=true";

	$address_info = file_get_contents($url);
    $json = json_decode($address_info);
    $city = '';
    $state = '';
    $country = '';
	$multi_cities = '';
	$formatted_address = '';
    
	if (count($json->results) > 0) {
		
		if(isset($json->results[0]->formatted_address)){
			$formatted_address = $json->results[0]->formatted_address;
		}

        $arrComponents = $json->results[0]->address_components;

        foreach($arrComponents as $index=>$component) {
            
			$type = $component->types[0];
			if ($city == "" && ($type == "locality" || $type == "neighborhood")){
                $city = trim($component->short_name);
				//echo $city;
            }
            if ($state == "" && $type=="administrative_area_level_1") {
                $state = trim($component->short_name);
				//echo $state;
            }
			if ($country == "" && $type=="country") {
                $country = trim($component->short_name);
				//echo $country;
            }
			if ($city != '' && $state != '' && $country != '') {
                break;
            }
        }
		
		if(isset($json->results[0]->postcode_localities)){
		
			$arr_multi_cities = $json->results[0]->postcode_localities;
			
			if(is_array($arr_multi_cities)){
				
				if(count($arr_multi_cities) > 1){
					
					$i = 0;
					foreach($arr_multi_cities as $val){
						
						if($i == 0){
							$multi_cities .= $val.' ';
						}else{
							$multi_cities .= ', '.$val;			
						}
						$i++;
					}
					
				}
				
			}
		
		}
		
    }
	
    $arrReturn = array("city"=>$city."   ".$zip
						,"state"=>$state
						,"country"=>$country
						,"multi_cities"=>$multi_cities
						,"formatted_address"=>$formatted_address);

	return $arrReturn;
}
	



function deleteDir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir"){ 
		 	deleteDir($dir."/".$object); 
		 }else{ 
		 	unlink($dir."/".$object);
		 }
	   }
     }
     reset($objects);
     rmdir($dir);
   }
} 


function getDesignDiscountTierLevelName($discTierID){
	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	
	
	$sql = "SELECT discount_tier_name
			FROM discount_tiers
			WHERE discount_tier_id = '".$discTierID."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->discTierName; 	
	}
	return 'not assigned';
	
}



function getURLFileName($name) {
	$ret = $name;
	if($_SESSION['seo']){    
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_name'] == $name){	
				$ret = $p_val['seo_name'];
			}
		}
	}else{
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_name'] == $name){	
				$ret = $p_val['page_name'];
			}
		}		
	}
	return $ret;        
}

function getURLFileNameById($page_seo_id) {
	$ret = '';
	if($_SESSION['seo']){    
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_seo_id'] == $page_seo_id){	
				$ret = $p_val['seo_name'];
			}
		}
	}else{
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_seo_id'] == $page_seo_id){	
				$ret = $p_val['page_name'];
			}
		}		
	}
	return $ret;        
}


function isActivePage($name){
	$ret = 0;
	if($_SESSION['seo']){    
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_name'] == $name){
				if($p_val['active']){	
					$ret = 1;
				}
			}
		}
	}else{
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_name'] == $name){
				if($p_val['active']){	
					$ret = 1;
				}
			}
		}		
	}
	return $ret;        	
}


function arraySortMulti(&$array, $val, $a_d = 'a') {

	//SORT_DESC 
	//SORT_ASC

	foreach ($array as $key => $row)
	{
		$vc_array_name[$key] = $row[$val];
	}
	if($a_d == 'a'){
		array_multisort($vc_array_name, SORT_ASC, $array);			
	}else{
		array_multisort($vc_array_name, SORT_DESC, $array);	
	}
}


function arraySort2d(&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

// for multi dem arrays
function multi_unique($array) {
		
	$new = array();
	$new1 = array();	
	
	if(is_array($array)){
		//if(sizeof($array) > 1){	
		foreach ($array as $k=>$na) $new[$k] = serialize($na);
					
		$uniq = array_unique($new);
				
		foreach($uniq as $k=>$ser) $new1[$k] = unserialize($ser);
				
		return ($new1);
		
	}else{
		return $new;	
	}
}

function inArray($v, $array, $indx_name = ''){
	$ret = 0;
	
	if(is_array($array)){
		foreach($array as $value){
			if($indx_name == ''){
				if($value == $v) $ret = 1;
			}else{
				if(isset($value[$indx_name])){
					if($value[$indx_name] == $v) $ret = 1;
				}
			}
		}
	}
	
	return $ret;
	
}


function getCatImgInfo($cat_id){

	$ret_array['name'] = '';
	$ret_array['file_name'] = '';
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT category.name
				,image.file_name 
			FROM category, image 
			WHERE category.img_id = image.img_id
			AND category.cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);			
	if($result->num_rows > 0){
		$object = $result->fetch_object();						
		$ret_array['name'] = $object->name;
		$ret_array['file_name'] = $object->file_name;
	}
	
	return $ret_array;	
	
}


function getCMSImgFilename($img_id){
	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT file_name
			FROM image
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->file_name; 	
	}
	return '';
	
}


function getProfileCatId($cat_id){
	
	$ret = 0;	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(CART_DATABASE);		
	$sql = "SELECT profile_cat_id 
			FROM category
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$ret = $object->profile_cat_id;	
	}

	return $ret;
}


function getBrandName($brand_id){

	$ret = '';	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(CART_DATABASE);		
	$sql = "SELECT name 
			FROM brand
			WHERE brand_id = '".$brand_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$ret = $object->name;	
	}

	return $ret;
	
}


function getCompanyPhone(){

	$ret = '';

	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "SELECT phone
			FROM profile_account
			WHERE id = '".$_SESSION['profile_account_id']."'";

	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$ret = $object->phone;	
	}

	return $ret;
}



function getPaymentProcessor(){

	$payment_processor = 'braintree';	
	// get processor for OTG as defoult
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	
	$sql = "SELECT payment_processor_id
			FROM profile_account
			WHERE id = '1'";
						
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$payment_processor_id = $object->payment_processor_id;
		if($payment_processor_id < 1) $payment_processor_id = 1;
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);		
		
		$sql = "SELECT name
				FROM payment_processor
				WHERE payment_processor_id = '".$payment_processor_id."'";

		if(!$n_res = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
		}
		$n_res = $dbCustom->getResult($db,$sql);
		if($n_res->num_rows > 0){
			$n_obj = $n_res->fetch_object();
			$payment_processor = $n_obj->name;			
		}	
	}
	
	
	return $payment_processor;

}



function getHomeDataArray(){
	
	//unset($_SESSION["home_data_array"]);
	
	if(!isset($_SESSION['home_data_array'])){
	
		$_SESSION['home_data_array'] = array();
		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		$sql = "SELECT img_1_id
					,content
					,content_short1
					,content_short2
					,content_short3
					,link_1_page_seo_id
					,link_1_label  
                    FROM home
					WHERE home.home_id = (SELECT MAX(home_id) FROM home WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
		
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			
			$_SESSION['home_data_array']['content_short1'] = stripslashes($object->content_short1);
			$_SESSION['home_data_array']['content_short2'] = stripslashes($object->content_short2);	
			$_SESSION['home_data_array']['content_short3'] = stripslashes($object->content_short3);
			$_SESSION['home_data_array']['content'] = stripslashes($object->content);
			$_SESSION['home_data_array']['link_1_page_seo_id'] = $object->link_1_page_seo_id;
			$_SESSION['home_data_array']['link_1_label'] = stripslashes($object->link_1_label);

			$sql = "SELECT file_name
						FROM image
						WHERE img_id = '".$object->img_1_id."'";

			if(!$img_res = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
			}
			$img_res = $dbCustom->getResult($db,$sql);

			if($img_res->num_rows > 0){
				$img_obj = $result->fetch_object();
				$_SESSION['home_data_array']['file_name'] = $img_obj->file_name;
			}else{
				$_SESSION['home_data_array']['file_name'] = '';
			}
		
		}else{
			$_SESSION['home_data_array']['file_name'] = '';	
			$_SESSION['home_data_array']['content_short1'] = '';
			$_SESSION['home_data_array']['content_short2'] = '';	
			$_SESSION['home_data_array']['content_short3'] = '';	
			$_SESSION['home_data_array']['content'] = '';
			$_SESSION['home_data_array']['link_1_page_seo_id'] = 0;
			$_SESSION['home_data_array']['link_1_label'] = '';
		}
	}
	
	return $_SESSION['home_data_array'];	

}

function get_logo() {

	if(!isset($_SESSION["logo_file_name"])){
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		$sql = "SELECT max(logo_id), image.file_name 
			FROM logo, image
			WHERE logo.img_id = image.img_id  
			AND active = '1'
			AND logo.profile_account_id = '".$_SESSION['profile_account_id']."'
			GROUP BY file_name";


		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$_SESSION['logo_file_name'] = $object->file_name;	
		}else{
			$_SESSION['logo_file_name'] = '';	
		}	
	}
	
	//$_SESSION['logo_file_name'] = 'otg_resized_in_photoshop.jpg';
	
	return $_SESSION['logo_file_name'];
	
	//return $result->num_rows;
		
}


function getUrlText($str)
{
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


function getFooterNavVendMan()
{
	
	if(!isset($_SESSION['footer_nav_vends'])){

		$shop_name = 'shop';
		if($_SESSION['seo']){
			if($_SESSION['seo']){    
				foreach($_SESSION['pages'] as $p_val){
					if($p_val['page_name'] == 'shop'){	
						$shop_name = $p_val['seo_name'];
					}
				}
			}
		}
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT name ,vend_man_id 
				FROM vend_man 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				LIMIT 10";

		$result = $dbCustom->getResult($db,$sql);
		$block = '';
		
		while($row = $result->fetch_object()) {
			$block .= '<li>';
			$block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getUrlText($row->name)."/category.html?vendManId=".$row->vend_man_id."'>";
			$block .= stripslashes($row->name).'</a>';			
			$block .= '</li>';
		}
		$block .= '</ul></div>';

		$_SESSION['footer_nav_vends'] = $block; 
	}


	return $_SESSION['footer_nav_vends'];
}

function getFooterNavHomeCats($col = 2)
{

	unset($_SESSION['footer_nav_home_cats']);
	if(!isset($_SESSION['footer_nav_home_cats'])){
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$t = array();		
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}

		if($col == 1){
			$limit = 2;	
		}else{
			$limit = 7;
		}

		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,category.short_name
					,category.tool_tip
					,image.file_name
					,category.seo_url
					,category.show_in_showroom
					,category.show_in_cart
					,category.img_alt_text  
			FROM category, image
			WHERE category.img_id = image.img_id
			AND category.show_on_home_page  = '1'					
			AND category.active  = '1'
			AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY category.display_order";
		$result = $dbCustom->getResult($db,$sql);		
				
		$i = 0;
		while($row = $result->fetch_object()) {

			//echo $row->name;

			if($i < $limit){
				$tool_tip = trim($row->tool_tip);
				$go = 0;
				$store_count = 0;
				$showroom_count = 0;
				$destination = 'cart';
				$block = '';
	
				if($row->show_in_cart && $row->show_in_showroom){
					$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
					$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
								
					/*
					if($store_count > 0){ 
						$destination = 'cart';
						$go = 1;
					}else{
						$destination == 'showroom';
						if($showroom_count > 0){
							$go = 1;	
						}
					}
					*/
					
					if($showroom_count > 0){ 
						$destination = 'showroom';
						$go = 1;
					}else{
						$destination == 'cart';
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
					$t[$i]['destination'] = $destination;
					$t[$i]['cat_id'] = $row->cat_id;
					$t[$i]['profile_cat_id'] = $row->profile_cat_id;
					$t[$i]['name'] = $row->name;
					$t[$i]['short_name'] = $row->short_name;
					$t[$i]['seo_url'] = $row->seo_url;
					$t[$i]['img_alt_text'] = $row->img_alt_text;
					$t[$i]['file_name'] = $row->file_name;
					$t[$i]['tool_tip'] = $row->tool_tip;
					$i++;
				}		
			}
		}

		$_SESSION['footer_nav_home_cats'] = $t;

	}

	return $_SESSION['footer_nav_home_cats'];
}

function getLowerNavCats()
{
	
	if(!isset($_SESSION['ln_cats'])){
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		
		$top = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT cat_id, profile_cat_id, name, seo_url 
				FROM category
				WHERE show_in_cart = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				AND active = '1'
				ORDER BY display_order";
		$result = $dbCustom->getResult($db,$sql);				
		
		$i = 0;
		while($row = $result->fetch_object()) {
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'
					";
			$tgc_res = $dbCustom->getResult($db,$sql);					
					
				
			if(!$tgc_res->num_rows > 0){
				
				if($store_data->getItemCount(0,0,$row->cat_id,0,'showroom') > 0){				
					$top[$i]['cat_id'] = $row->cat_id;
					$top[$i]['profile_cat_id'] = $row->profile_cat_id;
					$top[$i]['name'] = stripslashes($row->name);
					$top[$i]['seo_url'] = $row->seo_url;					
					$i++;
				}
			}		
		}
		
		$block = '';
		$i = 1;	
		foreach($top as $top_val){
						
			$block .= "<div id='lnlink".$i."' class='lower_nav_box'>";

			$block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$top_val["seo_url"]."/category.html?prodCatId=".$top_val["profile_cat_id"]."'>".$top_val['name']."</a>";
			$block .= "<div class='lnarrow'><img src='".$_SERVER['DOCUMENT_ROOT']."/images/lnarrow.jpg' /></div>";
			$block .= "<div class='ln_slug' id='".$top_val["profile_cat_id"]."' style='display:none'></div></div>";			

			$block .= '</div>';
				
			if(!isset($scr_page)) $scr_page = '';
			if(!isset($slug)) $slug = '';
				
			if($scr_page == $slug){
				echo "<script> set_ln_current(".$i."); </script>"; 
			}
			
		}
		
		$_SESSION['ln_cats'] = $block;

	}
	
	return $_SESSION['ln_cats'];
	
}


function getAllCats()
{
	if(!isset($_SESSION['all_cats'])){
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT cat_id, profile_cat_id, name, seo_url
				FROM category
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				AND active = '1'
				ORDER BY cat_id";
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
			
			if($store_data->getItemCount(0,0,$row->cat_id,0,'showroom') > 0){
			
				$t[$i]['cat_id'] = $row->cat_id;
				$t[$i]['profile_cat_id'] = $row->profile_cat_id;
				$t[$i]['name'] = stripslashes($row->name);
				$t[$i]['seo_url'] = $row->seo_url;
				$i++;
			}
		}
		
		$_SESSION['all_cats'] = $t;
	}
	return $_SESSION['all_cats'];
}

function getCatPic($cat_id)
{	

	$ret = '';
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT image.img_id, image.file_name 
			FROM category, image
			WHERE category.img_id = image.img_id
			AND category.cat_id = '".$cat_id."'";
		
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows> 0){		
		$obj = $result->fetch_object();
		$ret = $obj->file_name;
	}
	return $ret;	
}

function getCatName($cat_id)
{	
	$ret = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name 
			FROM category
			WHERE cat_id = '".$cat_id."'";
		
	$result = $dbCustom->getResult($db,$sql);
			
	if($result->num_rows> 0){		
		$obj = $result->fetch_object();
		$ret = stripslashes($obj->name);
	}
	return $ret;	

}

function isClosetSystem($item_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id 
			FROM item
			WHERE is_closet = '1'
			AND item_id = '".$item_id."'";
		
	$result = $dbCustom->getResult($db,$sql);
			
	if($result->num_rows > 0){
		$ret = 1;
	}else{
		$ret = 0;
	}
	
	return $ret;		
	
}

function getBrandCats($vend_man_id)
{

	$t = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);		
		
	$sql = "SELECT category.cat_id, category.name, category.seo_url
			FROM category, item, vend_man, item_to_category, item_to_vend_man 
			WHERE category.cat_id = item_to_category.cat_id
			AND item.item_id = item_to_category.item_id
			AND item.item_id = item_to_vend_man.item_id
			AND vend_man.vend_man_id = item_to_vend_man.vend_man_id
			AND vend_man.vend_man_id = '".$vend_man_id."'
			AND vend_man.profile_account_id = '".$_SESSION['profile_account_id']."'";
			
	$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {
		$t[$i]['cat_id'] = $row->cat_id;
		$t[$i]['name'] = stripslashes($row->name);
		$t[$i]['seo_url'] = $row->seo_url;
		$i++;
	}
		
	return $t;
}

function getPrevSrItem($item_id, $cat_id = 0){
	$item_array['item_id'] = 0;
	$item_array['seo_url'] = '';
	$item_array['hide_id_from_url'] = 1;
	$item_array['profile_item_id'] = 0;
	$item_array['name'] = '';
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	if($cat_id > 0){
	
		$sql = "SELECT item.item_id, item.seo_url, profile_item_id, hide_id_from_url, name 
				FROM item_to_category, item
				WHERE item_to_category.item_id = item.item_id
				AND item_to_category.cat_id = '".$cat_id."'		
				AND item.item_id < '".$item_id."'
				AND item.show_in_showroom = '1'
				AND item.active = '1'
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY item_id DESC";
	}else{
	
		$sql = "SELECT item_id, seo_url, profile_item_id, hide_id_from_url, name
			FROM item
			WHERE item_id < '".$item_id."'
			AND item.show_in_showroom = '1'
			AND item.active = '1'
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY item_id DESC";
		
	}

	$result = $dbCustom->getResult($db,$sql);
			
	if($result->num_rows > 0){
		$obj = $result->fetch_object();
		$item_array['item_id'] = $obj->item_id;
		$item_array['profile_item_id'] = $obj->profile_item_id;		
		$item_array['seo_url'] = $obj->seo_url;
		$item_array['hide_id_from_url'] = $obj->hide_id_from_url;
		$item_array['name'] = $obj->name;
	}
	
	return $item_array;		
}

function getNextSrItem($item_id, $cat_id = 0){
	
	$item_array['item_id'] = 0;
	$item_array['seo_url'] = '';
	$item_array['hide_id_from_url'] = 1;
	$item_array['profile_item_id'] = 0;
	$item_array['name'] = '';
			
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	if($cat_id > 0){
		
		$sql = "SELECT item.item_id, item.seo_url, profile_item_id, hide_id_from_url, name 
				FROM item_to_category, item
				WHERE item_to_category.item_id = item.item_id
				AND item_to_category.cat_id = '".$cat_id."'
				AND item.item_id > '".$item_id."'
				AND item.show_in_showroom = '1'
				AND item.active = '1'							
				AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY item_id";
	
	}else{
		$sql = "SELECT item_id, seo_url, profile_item_id, hide_id_from_url, name
			FROM item
			WHERE item_id > '".$item_id."'
			AND item.show_in_showroom = '1'
			AND item.active = '1'
			AND item.profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY item_id";
		
	}
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$obj = $result->fetch_object();
		$item_array['item_id'] = $obj->item_id;
		$item_array['profile_item_id'] = $obj->profile_item_id;		
		$item_array['seo_url'] = $obj->seo_url;
		$item_array['hide_id_from_url'] = $obj->hide_id_from_url;
		$item_array['name'] = $obj->name;
	}
	return $item_array; 	

}


function check_email_address($email) {
	if (preg_match("/[\\000-\\037]/",$email)) {
      return false;
   }
   $pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
   if(!preg_match($pattern, $email)){
      return false;
   }
   // Validate the domain exists with a DNS check
   // if the checks cannot be made (soft fail over to true)
   /*
   list($user,$domain) = explode('@',$email);
   if( function_exists('checkdnsrr') ) {
      if( !checkdnsrr($domain,"MX") ) { // Linux: PHP 4.3.0 and higher & Windows: PHP 5.3.0 and higher
         return false;
      }
   }
   else if( function_exists("getmxrr") ) {
      if ( !getmxrr($domain, $mxhosts) ) {
         return false;
      }
   }
   */
   return true;
}

function stripAllSlashes($str){
	while(!(strpos($str, "\\")  === false)){
		$str = stripslashes($str);
	}
	return $str;
}

function getItemRating($item_id){
	$ret = 5;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT rating
			FROM item_review 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
			
	$rating_count = 0;
	$sum_rating = 0;
	while($row = $result->fetch_object()) {
		$rating_count++;
		$sum_rating += $row->rating; 
	}
	//$ret = 	ceil($sum_rating/$rating_count);
	$ret = 	round($sum_rating/$rating_count,1);			
	return $ret;
}


function getHomePageBlogArray($limit = 0){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$ret_array = array();
	$sql = "SELECT blog_post.blog_post_id 
				,blog_post.title
				,blog_post.content
				,blog_post.img_id
				,blog_post.substitute_by
				,blog_post.when_posted
				,blog_category.name 
			FROM blog_category, blog_post 
			WHERE blog_category.blog_cat_id = blog_post.blog_cat_id
			AND blog_post.hide = '0'
			AND blog_post.profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY blog_post.display_order";
	if($limit > 0){
		$sql .= " limit ".$limit;
	}
				
	$result = $dbCustom->getResult($db,$sql);		
	$i = 0;
	while($row = $result->fetch_object()) {
		
		$ret_array[$i]['blog_post_id'] = $row->blog_post_id;
		$ret_array[$i]['substitute_by'] = $row->substitute_by;
		$ret_array[$i]['title'] = $row->title;
		$ret_array[$i]['content'] = $row->content;
		$ret_array[$i]['when_posted'] = $row->when_posted;
		$ret_array[$i]['cat_name'] = $row->name;
		
		$sql = "SELECT file_name 
				FROM image
				WHERE img_id = '".$row->img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$ret_array[$i]['file_name'] = $img_obj->file_name;
		}else{
			$ret_array[$i]['file_name'] = '';
		}
		
		$i++;
	}
		
	return $ret_array;
	
}

function getAvgTestimonialsRating(){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
	$sql = "SELECT rating 
			FROM testimonial 
			WHERE hide = '0'
			AND rating > '0'
			AND type = 'testimonial'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
				
	$result = $dbCustom->getResult($db,$sql);		
	$rating_count = 0;
	$sum_rating = 0;
	while($row = $result->fetch_object()) {
		$rating_count++;
		$sum_rating += $row->rating; 
	}
		
	//return ceil($sum_rating/$rating_count);
	return round($sum_rating/$rating_count,1);
	
}


function getHomePageTestimonialsArray($limit = 0, $sort_by = '', $star_gt = 0, $localation = 2){

	if(!is_numeric($star_gt)){
		$star_gt = 2;
	}
	if($star_gt == 5){
		$star_gt = 4;
	}

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$ret_array = array();
	$sql = "SELECT * 
			FROM testimonial 
			WHERE hide = '0'
			AND rating > '".$star_gt."'
			AND type = 'testimonial'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	
	if($localation == 0){
		$sql .= " AND is_local = '0'";
	}
	if($localation == 1){
		$sql .= " AND is_local = '1'";
	}				
	
	if($sort_by == 'n'){
		$sql .= " ORDER BY last_update DESC";
	}elseif($sort_by == 'o'){
		$sql .= " ORDER BY last_update ASC";
	}elseif($sort_by == 'hr'){
		$sql .= " ORDER BY rating DESC";
	}elseif($sort_by == 'hr'){
		$sql .= " ORDER BY rating ASC";
	}elseif($sort_by == 'lr'){
		$sql .= " ORDER BY rating ASC";
	}else{
		$sql .= " ORDER BY list_order";	
	}
				
	
	
	if($limit > 0){
		$sql .= " limit ".$limit;
	}
				
	$result = $dbCustom->getResult($db,$sql);		
	$i = 0;
	while($row = $result->fetch_object()) {
		$ret_array[$i]['name'] = $row->name;
		$ret_array[$i]['city_state'] = $row->city_state;
		$ret_array[$i]['content'] = $row->content;
		$ret_array[$i]['rating'] = $row->rating;
		$ret_array[$i]['last_update'] = $row->last_update;
		$i++;
	}
		
	return $ret_array;
	
}

function getAvgTestimonialsRatingClass(){

	$ret = 5;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT rating
			FROM testimonial 
			WHERE rating > '0'
			AND type != 'feedback'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);			
	$rating_count = 0;
	$sum_rating = 0;
	while($row = $result->fetch_object()) {
		$rating_count++;
		$sum_rating += $row->rating; 
	}
	//$numeric_rating = 	ceil($sum_rating/$rating_count);
	$numeric_rating = 	round($sum_rating/$rating_count,1);			
	
	
	return getRatingClass($numeric_rating);

}



function getNumItemReviews($item_id){
	$ret = 0;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT count(item_review_id) as num_reviews
			FROM item_review 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
			
	if($result->num_rows > 0){			
		$object = $result->fetch_object();
		$ret = 	$object->num_reviews;			
	}
	return $ret;
}

function getCatPath($cat_id){
	
	$ret_array = array();	
	//$proceed = 1;
	$tmp_cat_id = $cat_id;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$i = 0;
	while(1){
		$sql = "SELECT category.name, category.cat_id 
				FROM category, child_cat_to_parent_cat
				WHERE category.cat_id = child_cat_to_parent_cat.parent_cat_id
				AND child_cat_to_parent_cat.child_cat_id = '".$tmp_cat_id."'";
				
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object	= $result->fetch_object();
			$tmp_cat_id = $object->cat_id;
			$ret_array[$i] = $object->name;
			$i++;
		}else{
			//$proceed = 0;
			break;
		}
	}
	
	$sql = "SELECT name 
			FROM category
			WHERE category.cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object	= $result->fetch_object();
		$ret_array[$i] = $object->name;
	}
	
		
	return $ret_array;	
	
}


function getSrTopCats(){
	
	$t = array();
	
	//unset($_SESSION['sr_top_cats']);
	
	if(!isset($_SESSION['sr_top_cats'])){

		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT cat_id, profile_cat_id, name, short_name, seo_url
				FROM category  
				WHERE show_in_showroom = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY display_order"; 
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
						
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
			$tgc_res = $dbCustom->getResult($db,$sql);
					
			if(!$tgc_res->num_rows > 0){
	
				if($store_data->getItemCount(0,0,$row->cat_id,0,'showroom') > 0){
	
					$t[$i]['cat_id'] = $row->cat_id;
					$t[$i]['sr_cat_id'] = $row->cat_id;
					$t[$i]['profile_cat_id'] = $row->profile_cat_id;
					$t[$i]['name'] = $row->name;
					$t[$i]['short_name'] = $row->short_name;					
					$t[$i]['seo_url'] = $row->seo_url;
					$t[$i]['num_items'] = getNumItems($row->cat_id);
						
					$i++;
				}
			}		
		}
		$_SESSION['sr_top_cats'] = $t;
	}

	return $_SESSION['sr_top_cats'];
	
}


function getNumItems($cat_id){

	$dbCustom = new DbCustom();
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
	

function getCompanyChatLink(){

	$ret = array();
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT chat_url, chat_account, chat_show
			FROM contact_us
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows){
		$object = $result->fetch_object();
		$ret['chat_url'] = $object->chat_url;
		$ret['chat_account'] = $object->chat_account;
		$ret['chat_show'] = $object->chat_show;	
	}else{
		$ret['chat_url'] = '';
		$ret['chat_account'] = '';
		$ret['chat_show'] = 0;			
	}

	return $ret;
}


function getShortNavLabel($name, $short_name, $char_limit = 26){
	if($short_name != ''){
		$label = $short_name;
	}else{
		$label = $name;
	}				

	$full_label = stripslashes($label);
	$char_length = strlen($full_label);
	if($char_length > $char_limit){
		$label = substr($full_label ,0 ,$char_limit);				
		$label .= '...';
	}else{
		$label = $full_label;
	}
		
	return $label;
}


function getBrandsByAlpha($q = ''){
	$brandList = array();
	if ($q != ''){
		if($q == "1-9"){ 
			$search_str = "[0-9]";
		}else{
			$search_str = $q;
		}
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT name, short_name ,brand_id  
				FROM brand 
				WHERE name REGEXP '^".$search_str."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY brand_id";
		$result = $dbCustom->getResult($db,$sql);		
		$num_items = $result->num_rows;
		$i = 0;
		while($row = $result->fetch_object()){
			//$ret[$i]['url'] = $_SERVER['DOCUMENT_ROOT']."/".getUrlFileName('shop')."/brand/".getUrlText($row->name)."/".$row->brand_id;
			$brandList[$i]['name'] = $row->name;
			$brandList[$i]['short_name'] = $row->short_name;			
			$brandList[$i]["brand_id"] = $row->brand_id;
			$i++;
		}
	}
	return $brandList;
}




function getNavBarBrands2()
{

	//unset($_SESSION["nav_bar_brands"]);
	
	if(!isset($_SESSION["nav_bar_brands"])){
		$shop_name = getURLFileName('shop');
		$block = '';
		$block .= "<ul class=\"subnav\">";
		$block .= "<li class=\"drop-heading\">";
		$block .= "<ul class=\"brand-list-alpha\">";
		$abc = array("1-9", "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		foreach($abc as $i => $v){
			$block .= "<li><a onclick=\"loadBrandsAJAX('".$_SERVER['DOCUMENT_ROOT']."/pages/cart/ajax-load-brand-list.php?q=".$v."','#navBrandList')\">".$v."</a></li>";
		}
		$block .= "</ul>";
		$block .= "</li>";
		$block .= "<li class=\"drop-table\"><span class=\"nav-brand-list-contents\" id=\"navBrandList\">";
		$brands = getBrandsByAlpha("b");
		$num_brands = count($brands);
		if($num_brands> 0){
			$i = 0;
			 foreach($brands as $val){
				 if ($i % 5 == 0){
					 $block .= "<ul class='brand-list'>";
				 }
				$label = getShortNavLabel($val['name'], $val['short_name']);
				$block .= "<li><a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getUrlText($val['name'])."/category.html?brandId=".$val['brand_id']."'>".$label."</a></li>";
				 $i++;
				 if ($i % 5 == 0 || $i == $num_brands) {
					$block.= "</ul>";
				 }
			 }
		}else{
			$block .= "<div class='alert'>No Brands in 'b', try another letter. </div>";
		}
		$block .= "</span></li>";			
		$block .= "</ul>";
		$_SESSION["nav_bar_brands"] = $block; 
	}

	return $_SESSION["nav_bar_brands"];
}


// a newer version has been aded to class.nav
//$url = $nav->getUrlFromCatId($cat_id);
function getUrlByCatId($cat_id){
	$url = "category.html";
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT show_in_cart
				,show_in_showroom
				,seo_url
				,profile_cat_id
			FROM category
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		if($object->show_in_cart){
			$url = $object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;
		}else{
			$url = $object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;														
		}
	}
	return $url;
}


function getItemPic($item_id)
{	

	$ret = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT image.img_id, image.file_name 
			FROM item, image
			WHERE item.img_id = image.img_id
			AND item.item_id = '".$item_id."'";
		
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows> 0){		
		$obj = $result->fetch_object();
		$ret = $obj->file_name;
	}
	return $ret;	
}


function get_details_measurements_form(){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT state, state_abr 
			FROM states 
			WHERE hide = '0' 
			AND profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY country DESC, state"; 
    $result = $dbCustom->getResult($db,$sql);            
	$states = '';
    while($row = $result->fetch_object()) {
		$sel =  (strcasecmp($_SESSION['state'],$row->state_abr) == 0) ? "selected" : '';	
		$states .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
	}
	
	$block = "";	
	
	$block .= "<div style='font-size:36px;'>";
	$block .= "Custom Walk In Closet Kit Upgrade Form";
	$block .= "</div>";
	
	$block .= "<div style='font-size:14px;'>";
	$block .= "We have made it easy for you to customize your starter kit, by providing you with some options for your base unit; as well as the option to upgrade to our shelving package. "; 
	$block .= "Filling out this form will enable you to make the most out of your standard closet kit. Our simple two-step process is quick and easy. We do all the hard work for you!";
	$block .= "</div>";

	$block .= "<form>";
    
    $block .= "<div style='font-size:24px; background:#CCC;'>";
    $block .= "Step 1: Preparing for Customization";
    $block .= "</div>";
    $block .= "<div style='font-size:14px;'>";
	$block .= "Let us help you prepare to customize your closet. "; 
    $block .= "By answering these simple questions and submitting this form, one of our designers will one-on-one assist you with making the right choice for your closet organization needs.";     
    $block .= "</div>";    
 
	$block .= "<div class='frm_input_area'>";
    $block .= "<label> Name:</label>";
    $block .= "<input id='name' type='text' name='name' />";
	$block .= "</div>";
	
	$block .= "<div class='frm_input_area'>";
    $block .= "<label id='label_email'> <span class='star'>*</span>Email:</label>";
    $block .= "<input id='email' type='text' name='email' />";
    $block .= "<span id='redx_email' style='padding-left:8px;'>&nbsp;</span>";	
	$block .= "<div id='msg_email' class='frm_vmsg'>&nbsp;</div>";
	$block .= "</div>";
	
	$block .= "<div class='frm_input_area'>";
	$block .= "<label> City: </label>";
	$block .= "<input id='city' type='text' name='city' />";
	$block .= "</div>";
	
    
	$block .= "<div class='frm_input_area'>";
	$block .= "<label> State: </label>";
	$block .= "<select name='state' style='width:216px;'>";
	$block .= $states;
	$block .= "</select>";
	$block .= "</div>";
    
	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Phone: </label>";
	$block .= "<input id='phone' type='text' name='phone' />";
	$block .= "</div>";
 
 	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Which wall will you be installing your closet on? </label>";
	
    $block .= "<input type='radio' id='i_wall' name='i_wall' value='Back' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Back Wall</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
        
    $block .= "<input type='radio' id='i_wall' name='i_wall' value='Left' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Left Wall</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
        
    $block .= "<input type='radio' id='i_wall' name='i_wall' value='Right' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Right Wall</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
        
    $block .= "<input type='radio' id='i_wall' name='i_wall' value='Return' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Return Wall</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
        
	$block .= "</div>";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Optional: please describe briefly the purpose for this closet: </label>";
	$block .= "</div>";

    $block .= "<div style='font-size:24px; background:#CCC;'>";
    $block .= "Step 2: Measuring Your Closet";
    $block .= "</div>";
	
    $block .= "<div style='font-size:14px;'>";
	$block .= "Using a tape measure and the closet diagram below, measure and record the requested dimensions. "; 
    $block .= "To do this, match the number on the diagram with the numbered question below. Please list all measurements in inches. "; 
    $block .= "Walls #7 and #8 should be measured from the corner up to the door trim. Do not include the trim.";    
    $block .= "</div>";   
    
    $block .= "<img src='".$_SERVER['DOCUMENT_ROOT']."'/images/closet_diagram_small.jpg' />";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>1. Top Rear: </label>";
	$block .= "<input id='top_rear' type='text' name='top_rear' />";
	$block .= "</div>";
    
	$block .= "<div class='frm_input_area'>";
	$block .= "<label>2. Center Rear: </label>";
	$block .= "<input id='center_rear' type='text' name='center_rear' />";
	$block .= "</div>";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>3. Top Side Wall (Left): </label>";
	$block .= "<input id='top_left' type='text' name='top_left' />";
	$block .= "</div>";    
     
	$block .= "<div class='frm_input_area'>";
	$block .= "<label>4. Center Side Wall (Left): </label>";
	$block .= "<input id='center_left' type='text' name='center_left' />";
	$block .= "</div>";    

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>5. Top Side Wall (Right): </label>";
	$block .= "<input id='top_right' type='text' name='top_right' />";
	$block .= "</div>";    

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>6. Center Side Wall (Right): </label>";
	$block .= "<input id='center_right' type='text' name='center_right' />";
	$block .= "</div>";    

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>7. Front Left (Return Wall): </label>";
	$block .= "<input id='return_left' type='text' name='return_left' />";
	$block .= "</div>";    

	$block .= "<div class='frm_input_area'>";
	$block .= "<label>8. Front Right (Return Wall): </label>";
	$block .= "<input id='return_right' type='text' name='return_right' />";
	$block .= "</div>";  
    
    $block .= "<div style='font-size:24px; background:#CCC;'>";
    $block .= "Step 3: Measure Your Door";
    $block .= "</div>";
    $block .= "<div style='font-size:14px;'>";
	$block .= "When measuring your door, again refer to the diagram from Step 2 above. "; 
    $block .= "Make sure to measure the width of the door opening beginning from the base mold of the wall itself instead of the edge of the door or doors.";    
    $block .= "</div>";      
    
	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Door Type: </label>";
        
    $block .= "<input type='radio' id='door_type' name='door_type' value='Sliding Inward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Sliding Inward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";

    $block .= "<input type='radio' id='door_type' name='door_type' value='Sliding Outward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Sliding Outward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";

    $block .= "<input type='radio' id='door_type' name='door_type' value='Swing Inward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Swing Inward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
		
    $block .= "<input type='radio' id='door_type' name='door_type' value='Swing Outward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Swing Outward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";

    $block .= "<input type='radio' id='door_type' name='door_type' value='Bifold Inward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Bifold Inward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";

    $block .= "<input type='radio' id='door_type' name='door_type' value='Bifold Outward' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Bifold Outward</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
        
	$block .= "</div>";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Door Hinge: </label>";
        
    $block .= "<input type='radio' id='hinge' name='hinge' value='Hinged Left' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Hinged Left</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";

    $block .= "<input type='radio' id='hinge' name='hinge' value='Hinged Right' style='float:left;'/>";
    $block .= "<div style='float:left; margin-left:10px;'>Hinged Right</div>";            
    $block .= "<div style='clear:both; margin-bottom:8px;'></div>";
	$block .= "</div>";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Ceiling Height: </label>";
    $block .= "<input id='ceil_height' type='text' name='ceil_height' value='' />";
	$block .= "</div>";

	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Base Mold Height: </label>";
    $block .= "<input id='base_mold_height' type='text' name='base_mold_height' value='' />";
	$block .= "</div>";
   
	$block .= "<div class='frm_input_area'>";
	$block .= "<label> Base Mold Thickness: </label>";
    $block .= "<input id='base_mold_thickness' type='text' name='base_mold_thickness' value='' />";
	$block .= "</div>";

	$block .= "</form>";


	return $block;
	
	
}



function get_keyword_landing_tabs($dbCustom, $keyword_landing_id, $description_tab_content = '', $doc_area_content = ''){
	
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
	$sql = "SELECT *   
			FROM keyword_landing_tab
			WHERE active = '1' 
			AND keyword_landing_id = '".$keyword_landing_id."'
			ORDER BY display_order";
	$result = $dbCustom->getResult($db,$sql);
	$custom_tabs_array = array();
	$i = 0;
	while($row = $result->fetch_object()) {
		
		$custom_tabs_array[$i]['tab_num'] = $i;
		$custom_tabs_array[$i]['tab_text'] = $row->tab_text;
		$custom_tabs_array[$i]['content'] = $row->content;
		$i++;
	}
	
	
	$sql = "SELECT document.name
					,document.file_name
					,document.doc_id   
			FROM keyword_landing_to_doc, document
			WHERE keyword_landing_to_doc.doc_id = document.doc_id 
			AND keyword_landing_id = '".$keyword_landing_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$docs_block = $doc_area_content;
	while($row = $result->fetch_object()) {
		
		$path_fn = "/saascustuploads/".$_SESSION['profile_account_id']."/cms/doc/".$row->file_name;
		
		if (file_exists($_SERVER['DOCUMENT_ROOT'].$path_fn)) {
			
			$docs_block .= "<a href='".$_SERVER['DOCUMENT_ROOT'].$path_fn."' target='_blank'>
				<i class='icon-document icon-blue'></i></a>";
			$docs_block .= "<h4><a href='".$_SERVER['DOCUMENT_ROOT'].$path_fn."' target='_blank'>".$row->name."</a></h4>";
		
		}
	}

	$overview_block = ''; 
	$reviews_block = '';

	$rev_array = getHomePageTestimonialsArray(3);
	
	$total_ratings = 0;
	$rating_sum = 0;
	
	if(count($rev_array) > 0){
		foreach($rev_array as $v){
						
			$reviews_block .= $v['name'];
			if(strlen($v['city_state']) > 1){
				$reviews_block .= ' '.$v['city_state'];
			}
			if($v['rating'] > 0){
				$rating_class = getRatingClass($v['rating'],'small');
				//$rating_class = getRatingClass($v['rating']);
				$reviews_block .= "<div style='margin-top:6px; margin-bottom:6px;' class='".$rating_class."'></div>";							
			}
			//$reviews_block .= "<br /><br />";
						
			$tc = stripslashes(strip_tags($v['content']));
			
			$reviews_block .= $tc;
			
			$reviews_block .= "<br /><hr />";
			
			$total_ratings++;
			$rating_sum += $v['rating'];
		}
		
		$reviews_block .= "<br /><a class='fancybox fancybox.iframe' href='".$_SERVER['DOCUMENT_ROOT']."/pages/resources/iframe-reviews.php'>View More Reviews</a>";
	}
	
	$avg_rating = ($total_ratings>0)? round($rating_sum/$total_ratings, 1) : 1;
		
	if($total_ratings > 1){ 
		$overview_block .= "<div class='review-overview'>";			    
		$overview_block .= "<a class='pull-right fancybox fancybox.iframe' href='".$_SERVER['DOCUMENT_ROOT']."/pages/resources/iframe-reviews.php'>Read all Reviews</a>"; 
		
		$overview_block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/pages/resources/iframe-reviews.php' class='pull-left fancybox fancybox.inline' data-toggle='tab'><i class='star_rating ".getRatingClass($avg_rating)."'></i></a>";
		$overview_block .= "<p class='muted small'>$avg_rating Star Average Rating</p>";
		$overview_block .= "</div><hr />";
	}

	
	$tabs_block = '';

	$tabs_block .= "<ul class='nav nav-tabs' id='productTabs'>";
	
	if($description_tab_content != ''){
		$tabs_block .=  "<li class='active'><h2><a href='#description' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Description\");' >Description</a></h2></li>";	
	}

	$active = ($description_tab_content == '') ? 'active' : ''; 
	$tabs_block .= "<li class='reviews ".$active."'  ><h2><a href='#reviews' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Reviews\");' >Reviews</a></h2></li>";	

	if($docs_block != ''){
		$active = ($description_tab_content == '' && $reviews_block == '') ? "class='active'" : ''; 
		$tabs_block .= "<li $active><h2><a href='#documents' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Documents\");' >Documents</a></h2></li>";	
	}
	
	foreach($custom_tabs_array as $val){
		$active = ($description_tab_content == '' && $reviews_block == '' && $docs_block == '') ? "class='active'" : ''; 
		$tabs_block .= "<li $active><h2><a href='#custom_tabs_".$val['tab_num']."' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Documents\");' >".$val['tab_text']."</a></h2></li>";	
	}
		
	$tabs_block .= "</ul>";
		
	$tabs_block .= "<div style='clear:both;'></div>";

	$tabs_block .= "<div class='tab-content'>";

	if($description_tab_content != ''){
		$tabs_block .= "<div class='tab-pane active' id='description' style='margin-left:10px;'>";
		$tabs_block .= trim(stripslashes($description_tab_content));
		$tabs_block .= "</div>";	
	}

	if($reviews_block != ''){
		$active = ($description_tab_content == '') ? 'active': ''; 
		$tabs_block .= "<div class='tab-pane ".$active."' id='reviews'  style='margin-left:10px;'>".stripslashes($reviews_block)."</div>";						
	}
		
	if($docs_block != ''){
		$active = ($description_tab_content == '' && $reviews_block == '') ? 'active' : ''; 
		$tabs_block .= "<div class='tab-pane ".$active."' id='documents'  style='margin-left:10px;'>".stripslashes($docs_block)."</div>";						
	}

	foreach($custom_tabs_array as $val){
		$active = ($description_tab_content == '' && $reviews_block == '' && $docs_block == '') ? "class='active'" : ''; 
		$tabs_block .= "<div class='tab-pane ".$active."' id='custom_tabs_".$val['tab_num']."'  style='margin-left:10px;'>".stripslashes($val['content'])."</div>";						
	}

	$tabs_block .= "</div>";

	
	return array('overview_block'=>$overview_block, 'tabs_block'=>$tabs_block);
	
	
	
}








function get_details_tabs_and_review($item_id){
	
	$item = new ShoppingCartItem;
	$item_array = $item->getItem($item_id);

	$overview_block = '';
	$reviews_block = '';
	$docs_block = '';
	$attr_block = '';
	$google_survey_block = '';
	
	$specs_block = '';
	
	$tabs_block = '';
	
	if(count($item_array) > 0){
		
		

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT headline
				,review
				,name
				,city
				,rating
			FROM item_review
			WHERE item_id = '".$item_array['item_id']."'
			AND hide = '0' 
			ORDER BY item_review_id";	
		$result = $dbCustom->getResult($db,$sql);       
		$reviews_block .= "<h3 class='align-center'>Do you own this product? Write a review! <a href='#writeReview' class='btn fancybox fancybox.inline'> Review This Product </a></h3><hr />";
		$total_ratings = 0;
		$rating_sum = 0;
		
		$reviews_array = array();
		$i = 0;
		
		while($row = $result->fetch_object()){
			$reviews_array[$i]['headline'] = stripslashes(trim($row->headline));
			$reviews_array[$i]['city'] = stripslashes(trim($row->city));
			$reviews_array[$i]['name'] = stripslashes(trim($row->name));
			$reviews_array[$i]['review'] = stripslashes(trim($row->review));
			$reviews_array[$i]['rating'] = $row->rating;
			$i++;
			$total_ratings++;
			$rating_sum += $row->rating;
		}
		
		foreach($reviews_array as $key => $val){
			
			$reviews_block .= "<div class='row'><div class='span3'>";
			$reviews_block .= "<h4 class='blue'>".$val['headline']."</h4>";
			$reviews_block .= '<h5>'.$val['name'].'<br />'.$val['city'].'</h5>';
			$reviews_block .= "<p><i class='star_rating ".getRatingClass($val['rating'])."'></i></p>";
			$reviews_block .= "</div><div class='span8'>";
			$reviews_block .= $val['review'].'&nbsp;&nbsp;';
			$reviews_block .= '</div>';
			$reviews_block .= '</div>';
			$reviews_block .= '<hr />';
			if($key == 2){				
				$reviews_block .= "<a href='#allReviews' class='fancybox fancybox.inline'> View All Reviews </a>";
				break;
			}
		}
		
		$avg_rating = ($total_ratings>0)? round($rating_sum/$total_ratings, 1) : 1;
		
		if($total_ratings > 1){ 
			$overview_block .= "<div class='review-overview'>";			    
			$overview_block .= "<a href='#allReviews' class='pull-right fancybox fancybox.inline' data-toggle='tab'>Read all Reviews</a>"; 
			$overview_block .= "<a href='#allReviews' class='pull-left fancybox fancybox.inline' data-toggle='tab'><i class='star_rating ".getRatingClass($avg_rating)."'></i></a>";
			$overview_block .= "<p class='muted small'>$avg_rating Star Average Rating</p>";
			$overview_block .= "</div><hr />";
		}

		/*
		if($total_ratings > 1){ 
			$overview_block .= "<div class='review-overview'>";			    
			$overview_block .= "<a href='#reviews' class='pull-right' data-toggle='tab' onClick='setActiveTab()'>Read all Reviews</a>"; 
			$overview_block .= "<a href='#reviews' class='pull-left'  data-toggle='tab' onClick='setActiveTab()'><i class='star_rating ".getRatingClass($avg_rating)."'></i></a>";
			$overview_block .= "<p class='muted small'>$avg_rating Star Average Rating</p>";
			$overview_block .= "</div><hr />";
		}
		*/
		

		$attr_block .= '<ul>';
		if($item_array['brand_name'] != ''){
			$attr_block .= '<li>Brand:  '.$item_array['brand_name'].'</li>';	
		}
		$style = $item->getStyleNameFromId($item_array['style_id']); 
		if($style != ''){
			$attr_block .= '<li>Style:  '.$style.'</li>';
		}
		$sql = "SELECT lead_time 
				FROM lead_time
				WHERE lead_time_id = '".$item_array['lead_time_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$attr_block .= '<li>Lead Time:  '.$object->lead_time.'</li>';					
		}
		$sql = "SELECT level_name 
				FROM skill_level
				WHERE skill_level_id = '".$item_array['skill_level_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$attr_block .= '<li>Skill Level:  '.$object->level_name.'</li>';					
		}
		$sql = "SELECT name 
				FROM type
				WHERE type_id = '".$item_array['type_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$attr_block .= '<li>Skill Level:  '.$object->name.'</li>';					
		}
		$sql = "SELECT opt.attribute_id
					,attribute.attribute_name
					,opt.opt_name 
					FROM  opt, item_to_opt, attribute
					WHERE item_to_opt.opt_id = opt.opt_id
					AND opt.attribute_id = attribute.attribute_id
					AND item_to_opt.item_id = '".$item_array['item_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		while($row = $result->fetch_object()){
			$attr_block .= "<li>".$row->attribute_name.':  '.$row->opt_name.'</li>';
		}

			
		if($item_array['show_doc_tab'] > 0){
			$sql = "SELECT document.document_id
						,document.file_name
						,document.name
						,document.vend_man_id							 
					FROM document, item_to_document
					WHERE document.document_id = item_to_document.document_id
					AND item_to_document.item_id = '".$item_array['item_id']."'";
			$result = $dbCustom->getResult($db,$sql);		
			$docs_block .= $item_array['doc_area_text'];
			while($row = $result->fetch_object()) {
				$vm_name = '';
				if($row->vend_man_id > 0){
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT name FROM vend_man 
							WHERE vend_man_id = '".$row->vend_man_id."'";											
					$res = $dbCustom->getResult($db,$sql);				
					if($res->num_rows > 0){
						$object = $res->fetch_object();
						$vm_name = getUrlText($object->name).'/';
					}
				}
				
				$docs_block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs/".$vm_name.$row->file_name."' target='_blank'>
				<i class='icon-document icon-blue'></i></a>";
				$docs_block .= "<h4><a href='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs/".$vm_name.$row->file_name."' target='_blank'>".$row->name."</a></h4>";
				
			}
		}


		if($item_array['show_specs_tab']){

			$specs_block .= $item_array['additional_information'];

			//$additional_information


		}



		if($item_array['show_meas_form_tab'] > 0){
			$google_survey_block .= "<a style='float:left; margin-right:6px;' class='btn btn-success' onclick='view_walkin_form()'> Walk In Closets Measurements Form</a>";
			$google_survey_block .= "<a style='float:left;' class='btn btn-success' onclick='view_reachin_form()'> Reach In Closets Measurements Form</a>";
			$google_survey_block .= "<div style='clear:both;'></div>";
			$google_survey_block .= "<div id='view_form'></div>";
			// *****************************
			// new form with our database
			// get_details_measurements_form()
			// *****************************
		}
	
	
		$tabs_block .= "<ul class='nav nav-tabs' id='productTabs'>";
		if($item_array['description'] != ''){
			$tabs_block .=  "<li class='active'><h2><a href='#description' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Description\");' >Description</a></h2></li>";	
		}

		if($reviews_block != ''){
			$active = ($item_array['description'] == '' && $specs_block == '' && $attr_block == '') ? 'active' : ''; 
			$tabs_block .= "<li class='reviews ".$active."'  ><h2><a href='#reviews' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Reviews\");' >Reviews</a></h2></li>";	
		}

		if($specs_block != ''){
			$active = ($item_array['description'] == '' && $attr_block == ''  && $reviews_block == '') ? 'active' : ''; 
			$tabs_block .= "<li class='reviews ".$active."'  ><h2><a href='#specifications' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Specifications\");' >Specifications</a></h2></li>";	
		}

		if($docs_block != ''){
			$active = ($item_array['description'] == '' && $attr_block == '' && $reviews_block == '' && $specs_block == '') ? "class='active'" : ''; 
			$tabs_block .= "<li $active><h2><a href='#documents' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Documents\");' >Documents</a></h2></li>";	
		}

		if($item_array['is_kit'] && $item_array['show_meas_form_tab'] > 0){
			$active = ($item_array['description'] == '' && $attr_block == '' && $reviews_block == '' && $specs_block && $docs_block == '') ? "class='active'" : ''; 
			$tabs_block .= "<li $active><h2><a href='#google_survey' data-toggle='tab' onClick='ga(\"send\", \"event\", \"Tab\", \"click\", \"Measurements Form\");' > Measurements Form </a></h2></li>";	
		}
		


		
		$tabs_block .= "</ul>";
		
		$tabs_block .= "<div style='clear:both;'></div>";
		
        $tabs_block .= "<div class='tab-content'>";

		if($item_array['description'] != ''){
			$tabs_block .= "<div class='tab-pane active' id='description'>";
			$tabs_block .="<h5 class='muted'> Product Id: ".sprintf('%06d',$item_array['profile_item_id'])."</h5>";
            if($item_array['sku'] != ''){
				$tabs_block .="<h5 class='muted'> SKU #: ".$item_array['sku']."</h5>";
			}
			
			//$tabs_block .= $item_array['description'].$item_array['description'].$item_array['description'].$item_array['description'].trim(stripslashes($item_array['description']));
			$tabs_block .= trim(stripslashes($item_array['description']));
			if($attr_block != ''){
				$tabs_block .= stripslashes($attr_block);	
			}
			$tabs_block .= "</div>";	
		}

		if($reviews_block != ''){
			$active = ($item_array['description'] == '' && $attr_block == '') ? 'active': ''; 
			$tabs_block .= "<div class='tab-pane ".$active."' id='reviews'>".stripslashes($reviews_block)."</div>";						
		}
		
		if($specs_block != ''){
			$active = ($item_array['description'] == '' && $reviews_block == '' && $attr_block == '') ? 'active': '';
			$tabs_block .= "<div class='tab-pane ".$active."' id='specifications'>".stripslashes($specs_block)."</div>";
		}

		if($docs_block != ''){
			$active = ($item_array['description'] == '' && $attr_block == '' && $reviews_block == '' && $specs_block == '') ? 'active' : ''; 
			$tabs_block .= "<div class='tab-pane ".$active."' id='documents'>".stripslashes($docs_block)."</div>";						
		}
		
		if($item_array['is_kit'] && $item_array['show_meas_form_tab'] > 0){
			$active = ($item_array['description'] == '' && $attr_block == '' && $reviews_block == '' && $specs_block == '' && $docs_block == '') ? "class='active'" : ''; 
			$tabs_block .= "<div class='tab-pane ".$active."' id='google_survey'>".stripslashes($google_survey_block)."</div>";
		}
		
		$tabs_block .= "</div>";

	}

	if(!isset($tabs_block)) $tabs_block = '';

	$ret_array = array('overview_block'=>$overview_block, 'tabs_block'=>$tabs_block);

	return $ret_array;

}




function get_details_gallery($item_id){
	
	$item = new ShoppingCartItem;
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$gallery_img_array = array();
					
	$sql = "SELECT image.file_name
			FROM item_gallery, image
			WHERE item_gallery.img_id = image.img_id
			AND item_gallery.item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);					
	$block = '';
	if($result->num_rows > 0){
		$gallery_img_array[] = $item->getFileNameFromItemId($item_id);		
		while($row = $result->fetch_object()){
			$gallery_img_array[] = $row->file_name;
		}
		$block .= "<ul class='product-image-thumbnails'>";
		foreach($gallery_img_array as $gallery_file_name){	
			$block .= "<li><a href='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/".$gallery_file_name."' 
			class='thumbnail-link image-switch-thumb'>
			<img src='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/list/".$gallery_file_name."' alt='".$gallery_file_name."' /></a></li>";
		}
		$block .= "</ul>";
		
	}
	
	return $block;
}

function usort_sorter($a, $b){
	if ($a['child_count'] == $b['child_count']) {
		return 0;
	}
	return ($a['child_count'] < $b['child_count']) ? 1 : -1;
}



function getRatingClass($numeric_rating = 5, $star_size = ''){
	
	if($star_size == 'small'){
		$size_part = '_small';
	}else{
		$size_part = '';
	}
	
	if(floor($numeric_rating) - $numeric_rating < 0){	
		$half_part = '_half';
	}else{
		$half_part = '';
	}

	$rating_class = 'star_rating'.$size_part.$half_part;
	
	if($numeric_rating <= 1){
		$rating_class = 'star_rating'.$size_part.' one-star';
	}elseif($numeric_rating >= 1 &&  $numeric_rating < 2){
		$rating_class .= ' one-star';
	}elseif($numeric_rating >= 2 &&  $numeric_rating < 3){
		$rating_class .= ' two-star';
	}elseif($numeric_rating >= 3 &&  $numeric_rating < 4){
		$rating_class .= ' three-star';
	}elseif($numeric_rating >= 4 &&  $numeric_rating < 5){
		$rating_class .= ' four-star';
	}else{
		$rating_class .= ' five-star';
	}
	
	
	
	return $rating_class;
}

function get_customer_name($user_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	
	$ret = '';
					
	$sql = "SELECT name
			FROM user
			WHERE id = '".$user_id."'";
	$result = $dbCustom->getResult($db,$sql);					

	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret = $object->name;
	}
	
	return $ret;
}



function isSPAM($string, $max = 0) {
	$words = array(	
		"http", "www", ".com", ".mx", ".org", ".net", ".co.uk", ".jp", ".ch", ".info", ".me", ".mobi", ".us", ".biz", ".ca", ".ws", ".ag", 
		".com.co", ".net.co", ".com.ag", ".net.ag", ".it", ".fr", ".tv", ".am", ".asia", ".at", ".be", ".cc", ".de", ".es", ".com.es", ".eu", 
		".fm", ".in", ".tk", ".com.mx", ".nl", ".nu", ".tw", ".vg", "sex", "porn", "fuck", "buy", "free", "dating", "viagra", "money", "dollars", 
		"payment", "website", "poker", "cheap", "cialis", "pills", "infected", "clearance", "meet singles", "babes", "cash","и","ч","я","б ","л",
		"э","ф", "д", "й", "amoxicillin", "prescription", "drugs", "russia", "slovenia", "moldova", "vietnam", "gusta el"
		
	);
	$count = 0;    
    $string = strtolower($string);	
	if(is_array($words)) {
		foreach($words as $word) {
			$count += substr_count($string, $word);
		}
    }		
    return ($count > $max) ? 1 : 0;
}





	
	
/*
function getFooterNavCats($col)
{
	
	if(!isset($_SESSION["footer_nav_cats"])){
		$top = array();
		$shop_name = "shop";

		if($_SESSION['seo']){
			foreach($_SESSION["pages"] as $p_val){
				if($p_val['page_name'] == "shop"){	
					$shop_name = $p_val['seo_name'];
				}
			}
		}


		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT cat_id, name 
				FROM category
				WHERE show_in_cart = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				AND active = '1'
				ORDER BY display_order";
$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'
					";
			$tgc_res = mysql_query($sql);
			if(!$tgc_res)die(mysql_error());
				
			if(!mysql_num_rows($tgc_res) > 0){
				$top[$i]['cat_id'] = $row->cat_id;
				$top[$i]['name'] = stripslashes($row->name);					
				$i++;
			}		
		}

			
		if($col == 1){ 
			$boxclass_ext = "_short";
			$limit = 3;
		}else{
			$boxclass_ext = '';
			$limit = 7;
		}
		
		$block = '';
		$block .= "<div id='footer_nav_cats".$boxclass_ext."' class='foot_lower_container".$boxclass_ext."'><ul>";
		
		//$block .= "<ul>";
		foreach($top as $top_val){

			$block .= "<li class='nav_li_out'>";
			$block .= "<div class='n_sub' id='".getUrlText($top_val['name'])."'></div>";
			$block .= "<div class='c_sub' id='".$top_val['cat_id']."'></div>";
			$block .= "<div class='r_sub' id='".$_SERVER['DOCUMENT_ROOT']."'></div>";
			$block .= "<div class='s_sub' id='".$shop_name."'></div>";
			$block .= $top_val['name'];
			$block .= "</li>";
			$i++;
			
		}
			
		$block .= "</ul></div>";
		//$block .= "</ul>";
	
		if(sizeof($top) > $limit){
			$block .= "<div id='footer_nav_cats_more".$boxclass_ext."' style='padding-top:4px;'><a onclick='make_scroll(\"footer_nav_cats".$boxclass_ext."\")' style='text-decoration:underline; cursor:pointer;'><b>more</b></a></div>";			
		}
		
		
		$_SESSION["footer_nav_cats"] = $block;

	}

	
	
	
		
	
	return $_SESSION["footer_nav_cats"];
	//return $_SERVER['DOCUMENT_ROOT'];
	
}


function getUrlText($str)
{
	$t = preg_replace('/([0-9]+)/', '', $str);
	$t = str_replace (" ",'',$t);
	$t = str_replace ("#","number",$t);
	$t = str_replace ("/","-",$t);
	
	return strtolower($t); 
}

function getTopCats()
{
	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$t = array();

	unset($_SESSION['top_cats']);
	if(!isset($_SESSION['top_cats'])){
		
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		
		$sql = "SELECT cat_id
					,profile_cat_id
					,name
					,img_id
					,seo_url
					,show_in_cart
					,show_in_showroom 
					,img_alt_text
				FROM category
				WHERE active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY display_order";
$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
						
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
			$tgc_res = mysql_query($sql);
			if(!$tgc_res)die(mysql_error());
				
			if(!mysql_num_rows($tgc_res) > 0){
	
				$go = 0;
				$store_count = 0;
				$showroom_count = 0;
				$destination = 'cart';
	
				//if has showroom products, go to showroom
				//if has both type products, go to showroom
				//if has only store products, go to store
		
				if($row->show_in_cart && $row->show_in_showroom){
					$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
					$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
					
					
					if($showroom_count > 0){
						
						 
						$destination = 'showroom';
						$go = 1;
					}else{
						$destination == 'cart';
						if($store_count > 0){
							$go = 1;	
						}
					}
					
				}elseif($row->show_in_showroom){
					
					
					$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');				
					$destination = 'showroom';
					if($showroom_count > 0){ 
						$go = 0;
					}				
				}else{
					$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');					
					$destination = 'cart';
					if($store_count > 0){ 
						$go = 1;
					}				
				}

				if($go){

					$t[$i]["destination"] = $destination;
					$t[$i]['cat_id'] = $row->cat_id;
					$t[$i]["profile_cat_id"] = $row->profile_cat_id;
					$t[$i]['name'] = $row->name;
					$t[$i]["seo_url"] = $row->seo_url;
					$t[$i]['img_alt_text'] = $row->img_alt_text;
					
					
						
					$sql = "SELECT file_name 
							FROM image
							WHERE img_id = '".$row->img_id."'";
					$img_res = $dbCustom->getResult($db,$sql);
					if($img_res->num_rows > 0){
						$img_obj = $img_res->fetch_object();
						$file_name = $img_obj->file_name; 
					}else{
						$file_name = '';
					}
					$t[$i]["file_name"] = $file_name;
						
					$i++;
				}
			}		
		}

		$_SESSION['top_cats'] = $t;

	}

	return $_SESSION['top_cats'];
	
	
	
}


function getHomePageCats()
{
	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$t = array();

	

	unset($_SESSION['home_cats']);
	if(!isset($_SESSION['home_cats'])){
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		

		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,category.tool_tip
					,image.file_name
					,category.seo_url
					,category.show_in_showroom
					,category.show_in_cart
					,category.img_alt_text  
			FROM category, image
			WHERE category.img_id = image.img_id
			AND category.show_on_home_page  = '1'					
			AND category.active  = '1'
			AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY category.display_order";
$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {

			$tool_tip = trim($row->tool_tip);
			$go = 0;
			$store_count = 0;
			$showroom_count = 0;
			$destination = 'cart';
			$block = '';

			if($row->show_in_cart && $row->show_in_showroom){
				$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
				$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
							
				if($showroom_count > 0){ 
					$destination = 'showroom';
					$go = 1;
				}else{
					$destination == 'cart';
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
				$t[$i]['destination'] = $destination;
				$t[$i]['cat_id'] = $row->cat_id;
				$t[$i]['profile_cat_id'] = $row->profile_cat_id;
				$t[$i]['name'] = $row->name;
				$t[$i]['seo_url'] = $row->seo_url;
				$t[$i]['img_alt_text'] = $row->img_alt_text;
				$t[$i]['file_name'] = $row->file_name;
				$t[$i]['tool_tip'] = $row->tool_tip;

				$i++;
			}		
		}

		$_SESSION['home_cats'] = $t;

	}

	return $_SESSION['home_cats'];
	
}
		
function deleteDir($dirPath) {
    if (is_dir($dirPath)) {    
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}
}
*/
	

?>
