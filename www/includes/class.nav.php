<?php
require_once('accessory_cart_functions.php');
require_once('class.store_data.php');

class Nav {
	
	function getNavCats($dbCustom, $show_in = 'showroom', $limit = 0)
	{
		unset($_SESSION['nav_cats']);		
		if(!isset($_SESSION['nav_cats'])){ 
			$_SESSION['nav_cats'] = array();	
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT cat_id
						,name
						,short_name
			FROM category
			WHERE active = '1'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'"; 
			if($limit > 0){
				$sql = " LIMIT ".$limit;						
			}			
			$result = $dbCustom->getResult($db,$sql);
			$i = 0;
			while($row = $result->fetch_object()) {
				$_SESSION['nav_cats'][$i]['cat_id'] = $row->cat_id;
				if(strlen($row->name) < 40){
					$name = stripslashes($row->name);
				}else{
					$name = stripslashes($row->short_name);
				}
				$_SESSION['nav_cats'][$i]['name'] = $name;
				$_SESSION['nav_cats'][$i]['url'] = $this->getCatUrl($name, $row->cat_id, $show_in);				
				$i++;								
			}
			return $_SESSION['nav_cats'];
			
		}else{
			return $_SESSION['nav_cats'];
			
		}
	}

	function getHomePageCats($dbCustom,$show_in = 'showroom', $limit = 0)
	{
		unset($_SESSION['home_cats_2']);
		if(!isset($_SESSION['home_cats_2'])) 
			
			$_SESSION['home_cats_2'] = array();	
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT category.cat_id
							,category.profile_cat_id
							,category.name
							,category.short_name
							,category.tool_tip
							,category.show_in_showroom
							,category.show_in_cart
							,category.img_alt_text
							,image.file_name
			FROM category, image
			WHERE category.img_id = image.img_id
			AND category.active = '1'
			AND category.profile_account_id = '".$_SESSION['profile_account_id']."' 
			LIMIT ".$limit;		
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;
		while($row = $result->fetch_object()) {
			$_SESSION['home_cats_2'][$i]['cat_id'] = $row->cat_id;
			$_SESSION['home_cats_2'][$i]['profile_cat_id'] = $row->profile_cat_id;			
			if(strlen($row->name) < 40){
				$name = stripslashes($row->name);
			}else{
				$name = stripslashes($row->short_name);
			}
			$_SESSION['home_cats_2'][$i]['name'] = $name; 
			$_SESSION['home_cats_2'][$i]['img_alt_text'] = $row->img_alt_text;
			$_SESSION['home_cats_2'][$i]['file_name'] = $row->file_name;
			$_SESSION['home_cats_2'][$i]['tool_tip'] = $row->tool_tip;					
			$i++;								
		}
		return $_SESSION['home_cats_2'];
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
		//$t = str_replace (".." ,"." ,$t);		
		//$t = preg_replace('/[.,]/', '', $t);
		
		return strtolower($t); 
	}

	function getCatUrl($name, $cat_id, $show_in = 'showroom'){
		
		$url_str = '';
		
		if($show_in == 'showroom'){			
			$url_str = SITEROOT.'showroom-'.$cat_id.'/'.$this->getUrlText($name).'.html';
		}else{
			$url_str = SITEROOT.'accessories-'.$cat_id.'/'.$this->getUrlText($name).'.html';
		}
		return $url_str;
		
		
	}
	
	function getItemUrl($seo_url, $name, $item_id, $brand_name, $show_in = 'shop', $hide_id_from_url = 1, $old_version = 0){
		$url_str = '';
		if($show_in == 'showroom'){			
			if($hide_id_from_url){
$url_str = '/'.$_SESSION['global_url_word'].'showroom-'.$item_id.'/'.$this->getUrlText($name).'.html';
			}else{
$url_str = '/'.$_SESSION['global_url_word'].$seo_url.$this->getUrlText($name).'/showroom-product.html?productId='.$profile_item_id;
			}
		}else{
			if($hide_id_from_url){
				if($brand_name != ''){
					$the_name = $brand_name.'-'.$name;	
				}else{
					$the_name = $name;
				}
				$url_str = '/product-'.$item_id.'/'.$this->getUrlText($the_name).'.html';
			}else{
				//$url_str = '/'.$_SESSION['global_url_word'].$this->getUrlText($name).'/product.html?productId='.$profile_item_id;
				$url_str = '/'.$this->getUrlText($name).'/product.html?productId='.$item_id;
			}				
		}
		return $url_str;
	}
	
	function get_file_name($dbCustom,$img_id)
	{
		$ret = "NONE";
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT file_name
				FROM image 
				WHERE img_id = '".$img_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$obj = $result->fetch_object();
			return $obj->file_name;
		}
		return $ret;
	}

	function getCatNameFromId($dbCustom,$cat_id){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT name 
				FROM category
				WHERE cat_id = '".$cat_id."'";
					
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->name; 
		}
		return '';
	}
	
}

