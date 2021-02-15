<?php
require_once('class.store_data.php');
require_once('accessory_cart_functions.php');
require_once('class.module.php');
require_once('Mobile_Detect.php');

//1 phone
//2 tablet
//3 computer
//require_once("class.module.php");
//$module = new Module;	
class Nav {

	function getHomePageCats($show_in = 'showroom', $limit = 0)
	{
		unset($_SESSION['home_cats_2']);
		
		if(!isset($_SESSION['home_cats_2'])) 
			
			$_SESSION['home_cats_2'] = array();	
	
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
							
			$sql = "SELECT category.cat_id
							,category.profile_cat_id
							,category.name
							,category.short_name
							,category.tool_tip
							,category.seo_url
							,category.seo_list
							,category.show_in_showroom
							,category.show_in_cart
							,category.img_alt_text
							,category.hp1_display_order
							,category.hp2_display_order  
							,image.file_name
			FROM category, image
			WHERE category.img_id = image.img_id
			AND category.profile_account_id = '".$_SESSION['profile_account_id']."' 
			LIMIT ".$limit;		
		$result = $dbCustom->getResult($db,$sql);

		$i = 0;
		while($row = $result->fetch_object()) {
			
			$_SESSION['home_cats_2'][$i]['destination'] = $destination;
			$_SESSION['home_cats_2'][$i]['cat_id'] = $row->cat_id;
			$_SESSION['home_cats_2'][$i]['profile_cat_id'] = $row->profile_cat_id;
			$_SESSION['home_cats_2'][$i]['name'] = $row->name;
			$_SESSION['home_cats_2'][$i]['short_name'] = $row->short_name;
			$_SESSION['home_cats_2'][$i]['seo_url'] = $row->seo_url;
			$_SESSION['home_cats_2'][$i]['seo_list'] = $row->seo_list;
			$_SESSION['home_cats_2'][$i]['img_alt_text'] = $row->img_alt_text;
			$_SESSION['home_cats_2'][$i]['file_name'] = $row->file_name;
			$_SESSION['home_cats_2'][$i]['tool_tip'] = $row->tool_tip;					
			$_SESSION['home_cats_2'][$i]['hp1_display_order'] = $row->hp1_display_order;
			$_SESSION['home_cats_2'][$i]['hp2_display_order'] = $row->hp2_display_order;
			$_SESSION['home_cats_2'][$i]['child_array'] = $this->getChildCats($row->cat_id);
			$_SESSION['home_cats_2'][$i]['child_count'] = count($_SESSION['home_cats_2'][$i]['child_array']);		
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
		return strtolower($t); 
	}


	function getCatUrl($name, $profile_cat_id, $show_in = 'shop'){
		
		$url_str = '';
		if($show_in == 'showroom'){			
			$url_str = '/showroom-category-'.$profile_cat_id.'/'.$this->getUrlText($name).'.html';
		
		
		}else{
			$url_str = '/category-'.$profile_cat_id.'/'.$this->getUrlText($name).'.html';
		}
		
		
		return $url_str;
	}
	
	function getItemUrl($seo_url, $name, $profile_item_id, $brand_name, $show_in = 'shop', $hide_id_from_url = 1, $old_version = 0){
		$url_str = '';
		if($show_in == 'showroom'){
			
			if($hide_id_from_url){
				$url_str = '/'.$_SESSION['global_url_word'].'showroom-'.$profile_item_id.'/'.$this->getUrlText($name).'.html';
			}else{
				$url_str = '/'.$_SESSION['global_url_word'].$seo_url.$this->getUrlText($name).'/showroom-product.html?productId='.$profile_item_id;
			}
			
			
		}else{
			
			if($hide_id_from_url){
				if($old_version){
					$url_str = "/test/product.html?productId=".$profile_item_id;					
				}else{
				
					if($brand_name != ''){
						$the_name = $brand_name.'-'.$name;	
					}else{
						$the_name = $name;
					}
				
					$url_str = '/product-'.$profile_item_id.'/'.$this->getUrlText($the_name).'.html';
				
				}
			}else{
				//$url_str = '/'.$_SESSION['global_url_word'].$this->getUrlText($name).'/product.html?productId='.$profile_item_id;
				$url_str = '/'.$this->getUrlText($name).'/product.html?productId='.$profile_item_id;
			}				
		}
		return $url_str;
	}
	
	
	function getHeaderSupportLabels()
	{

		unset($_SESSION["header_support_menu_labels"]);
		if(!isset($_SESSION['header_support_menu_labels'])){
	
			$_SESSION['header_support_menu_labels'] = array();	
			
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
			$sql = "SELECT label, header_support_menu_label_id, page_seo_id
					FROM header_support_menu_label
					WHERE active = '1'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY display_order";
			$result = $dbCustom->getResult($db,$sql);			
				
				
			$i = 0;
			while($row = $result->fetch_object()){
				foreach($_SESSION['pages'] as $p_val){
					
					//echo $p_val['page_name'];
					
					
					if($p_val['page_seo_id'] == $row->page_seo_id && $p_val['active']){					
						$_SESSION['header_support_menu_labels'][$i]['label'] = stripslashes($row->label); 
						$_SESSION['header_support_menu_labels'][$i]['id'] = $row->header_support_menu_label_id;
						
						if($_SESSION['seo']){
							$url = $p_val['seo_name'];
						}else{
							$url = $p_val['page_name'];
						}
						
						if($p_val['page_name'] == 'showroom'){
							$_SESSION['header_support_menu_labels'][$i]['url'] = $_SESSION['global_url_word'].$url."/showroom.html";
						}elseif($p_val['page_name'] == "app"){
							$_SESSION['header_support_menu_labels'][$i]['url'] = $url.'/';	
						}else{
							
							$_SESSION['header_support_menu_labels'][$i]['url'] = $_SESSION['global_url_word'].$url.".html";
						
						}	
						$i++;
					}							
				}							
			}
		}
		return $_SESSION['header_support_menu_labels'];		
	}
	
	
	function loadPages()
	{
	
		$_SESSION['pages'] = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		$sql = "SELECT page_seo_id, page_name, seo_name, mssl, active  
				FROM page_seo
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY page_name";
							
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		while($row = $result->fetch_object()){			
			$_SESSION['pages'][$i]['page_name'] = $row->page_name;
			$_SESSION['pages'][$i]['seo_name'] = $row->seo_name;
			$_SESSION['pages'][$i]['page_seo_id'] = $row->page_seo_id;
			$_SESSION['pages'][$i]['ssl'] = $row->mssl;
			$_SESSION['pages'][$i]['active'] = $row->active; 
	
			$i++;
		}
		
	}
	
	
	
	function getNavbarLabelCount()
	{
		//unset($_SESSION['navbar_labels']);
		if(isset($_SESSION['navbar_labels'])){
			$ret = count($_SESSION['navbar_labels']);	
		}else{
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT navbar_label_id 
				FROM navbar_label
				WHERE active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			$ret = $result->num_rows;
		}
		
		return $ret;
	}


	
	function getNavbarLabels()
	{
	
		//unset($_SESSION['navbar_labels']);
		if(!isset($_SESSION['navbar_labels'])){
			$_SESSION['navbar_labels'] = array();
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT label
					,navbar_label_id
					,page_seo_id
					,url
					,submenu_content_type
					,cat_id
					,keyword_landing_id 
				FROM navbar_label
				WHERE active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY display_order ";
			$result = $dbCustom->getResult($db,$sql);			
			$i = 0;
			while($row = $result->fetch_object()){
				$_SESSION['navbar_labels'][$i]['url'] =  '';
				$do_increment = 1;
				$_SESSION['navbar_labels'][$i]['label'] = stripslashes($row->label); 
				$_SESSION['navbar_labels'][$i]['id'] = $row->navbar_label_id;
				$_SESSION['navbar_labels'][$i]['submenu_content_type'] = $row->submenu_content_type;
				
				$_SESSION['navbar_labels'][$i]['seo_list'] = '';

				if($row->keyword_landing_id > 0){
				
					$url = $this->getKeywordLandingURL($row->keyword_landing_id);
					
					$_SESSION['navbar_labels'][$i]['url'] = "/".$url.'.html?k='.$row->keyword_landing_id;
				
				}elseif($row->cat_id > 0){
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT show_in_cart
								,show_in_showroom
								,seo_url
								,seo_list
								,profile_cat_id
								,name
							FROM category
							WHERE cat_id = '".$row->cat_id."'";
					
					$res = $dbCustom->getResult($db,$sql);
					
					if($res->num_rows > 0){
						$object = $res->fetch_object();
						$_SESSION['navbar_labels'][$i]['seo_list'] = $object->profile_cat_id;
						if($object->show_in_cart){							
							//$_SESSION['navbar_labels'][$i]['url'] = $object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;
							$_SESSION['navbar_labels'][$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, 'shop');
						
						}else{
							$_SESSION['navbar_labels'][$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, 'showroom');
							
							//$_SESSION['navbar_labels'][$i]['url'] = $object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;														
						}
						
						
					}
				}elseif(trim($row->url) != ''){
					$_SESSION['navbar_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].$row->url;
					
				}elseif($row->submenu_content_type == 1){
					
					$_SESSION['navbar_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].'category.html';
					
				}elseif($row->page_seo_id > 0){
					$do_increment = 0;
					
					if(count($_SESSION['pages']) < 3){
						$this->loadPages();
					}
					
					
					foreach($_SESSION['pages'] as $p_val){
						if($p_val['page_seo_id'] == $row->page_seo_id && $p_val['active']){
							$do_increment = 1;
							$_SESSION['navbar_labels'][$i]['label'] = stripslashes($row->label); 
							$_SESSION['navbar_labels'][$i]['id'] = $row->navbar_label_id;							
							if($_SESSION['seo']){
								$url = $p_val['seo_name'];
							}else{
								$url = $p_val['page_name'];
							}
							if($p_val['page_name'] == 'showroom'){								
								$_SESSION['navbar_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].'showroom.html';															
							}elseif($p_val['page_name'] == 'app'){
								$_SESSION['navbar_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].$url.'/';								
							}else{
								$_SESSION['navbar_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].$url.'.html';
							}
						}								
					}
				}
				

				if($do_increment) $i++;
			}
		}
		return $_SESSION['navbar_labels'];
	}
	


	function getFooterNavLabels()
	{
		
		//unset($_SESSION['footer_nav_labels']);
		if(!isset($_SESSION['footer_nav_labels'])){
			$_SESSION['footer_nav_labels'] = array();	
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT label
					,footer_nav_label_id
					,page_seo_id
					,url
					,submenu_content_type
					,keyword_landing_id
				FROM footer_nav_label
				WHERE active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY display_order ";
			$result = $dbCustom->getResult($db,$sql);			
			
			$i = 0;
			while($row = $result->fetch_object()){
				$_SESSION['footer_nav_labels'][$i]['label'] = stripslashes($row->label); 
				$_SESSION['footer_nav_labels'][$i]['id'] = $row->footer_nav_label_id;
				$_SESSION['footer_nav_labels'][$i]['submenu_content_type'] = $row->submenu_content_type;
				
				
				
				
				if(trim($row->url) != ''){
					$_SESSION['footer_nav_labels'][$i]['url'] = $row->url;
				
				}elseif($row->keyword_landing_id > 0){
					
					$url = $this->getKeywordLandingURL($row->keyword_landing_id);
					
					$_SESSION['footer_nav_labels'][$i]['url'] = "/".$url.'.html?k='.$row->keyword_landing_id;
				
				}elseif($row->page_seo_id > 0){
					
					if(count($_SESSION['pages']) < 3){
						$this->loadPages();
					}
					
					foreach($_SESSION['pages'] as $p_val){
						if($p_val['page_seo_id'] == $row->page_seo_id && $p_val['active']){
							if($_SESSION['seo']){
								$url = $p_val['seo_name'];
							}else{
								$url = $p_val['page_name'];
							}
							if($p_val['page_name'] == 'showroom'){								
								$_SESSION['footer_nav_labels'][$i]['url'] = 'showroom.html';
							}elseif($p_val['page_name'] == 'app'){
								$_SESSION['footer_nav_labels'][$i]['url'] = $url.'/';								
							}else{
								$_SESSION['footer_nav_labels'][$i]['url'] = $url.'.html';
							}
						}								
					}
				}else{
					$_SESSION['footer_nav_labels'][$i]['url'] =  '';
				}
				$i++;
			}
		}
		return $_SESSION['footer_nav_labels'];
	}


	function getNavbarSubmenuLabels($label_id, $is_top = 1)
	{
			//$module = new Module;
			$navbar_submenu_labels = array();
			
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

			$sql = "SELECT navbar_submenu_label.label 
							,navbar_submenu_label.navbar_submenu_label_id
							,navbar_submenu_label.page_seo_id
							,navbar_submenu_label.custom_url
							,navbar_submenu_label.cat_id
							,navbar_submenu_label.keyword_landing_id
					FROM navbar_submenu_label
					WHERE navbar_submenu_label.active = '1'
					AND navbar_submenu_label.profile_account_id = '".$_SESSION['profile_account_id']."'";

			if($is_top){
				$sql .= " AND navbar_submenu_label.navbar_label_id = '".$label_id."'";
			}else{
				$sql .= " AND navbar_submenu_label.parent_submenu_id = '".$label_id."'";				
			}
			$sql .= " ORDER BY display_order";
					
			$result = $dbCustom->getResult($db,$sql);			
			$i = 0;
			while($row = $result->fetch_object()){
				
				$do_increment = 1;	
				$navbar_submenu_labels[$i]['keyword_landing_id'] = 0;
				$navbar_submenu_labels[$i]['cat_id'] = 0;
				$navbar_submenu_labels[$i]['label'] = '';
				$navbar_submenu_labels[$i]['id'] = 0;
				$navbar_submenu_labels[$i]['url'] = '';
				
				if($row->keyword_landing_id){
					$navbar_submenu_labels[$i]['keyword_landing_id'] = $row->keyword_landing_id;
					$navbar_submenu_labels[$i]['label'] = stripslashes($row->label);
					$navbar_submenu_labels[$i]['id'] = $row->navbar_submenu_label_id;
					$navbar_submenu_labels[$i]['url'] = $this->getKeywordLandingURL($row->keyword_landing_id).'.html';
				
				}elseif($row->cat_id > 0){
				
					$navbar_submenu_labels[$i]['label'] = stripslashes($row->label);
					$navbar_submenu_labels[$i]['id'] = $row->navbar_submenu_label_id;
					$navbar_submenu_labels[$i]['cat_id'] = $row->cat_id;
					
					$navbar_submenu_labels[$i]['seo_list'] = '';
										
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT show_in_cart
								,show_in_showroom
								,seo_url
								,seo_list
								,profile_cat_id
								,name
							FROM category
							WHERE cat_id = '".$row->cat_id."'";
					$res = $dbCustom->getResult($db,$sql);
					
					if($res->num_rows > 0){
						
						$object = $res->fetch_object();
						$navbar_submenu_labels[$i]['seo_list'] = $object->seo_list;
						
						if($object->show_in_cart){							
							//$navbar_submenu_labels[$i]['url'] = $object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;
							$navbar_submenu_labels[$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'shop');
						}else{
							$navbar_submenu_labels[$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'showroom');
							//$navbar_submenu_labels[$i]['url'] = $object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;													
						}
					
					}else{
						$navbar_submenu_labels[$i]['url'] = 'category.html';
					}
					
				}elseif(trim($row->custom_url) != ''){
					$navbar_submenu_labels[$i]['label'] = stripslashes($row->label);
					$navbar_submenu_labels[$i]['id'] = $row->navbar_submenu_label_id;
					$navbar_submenu_labels[$i]['url'] = $row->custom_url;
				}else{				
				
					if(count($_SESSION['pages']) < 3){
					//if(1){	
						$this->loadPages();
					}
					
					$do_increment = 0;				
					foreach($_SESSION['pages'] as $p_val){
						if($p_val['page_seo_id'] == $row->page_seo_id && $p_val['active']){
							$do_increment = 1;
							$navbar_submenu_labels[$i]['label'] = stripslashes($row->label); 
							$navbar_submenu_labels[$i]['id'] = $row->navbar_submenu_label_id;
							
							if($_SESSION['seo']){
								$url = $p_val['seo_name'];
							}else{
								$url = $p_val['page_name'];
							}
							if($p_val['page_name'] == 'showroom'){
								$navbar_submenu_labels[$i]['url'] = 'showroom.html';
							}elseif($p_val['page_name'] == 'app'){
								$navbar_submenu_labels[$i]['url'] = $url.'/';								
							}else{
								$navbar_submenu_labels[$i]['url'] = $url.".html";
								
								
							}
						}								
					}
				}
								
				if($do_increment) $i++;
			}
		return $navbar_submenu_labels;

	}


	function catHasAccessories($cat_id = 0)
	{

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT show_in_cart
				FROM category 
				WHERE cat_id = '".$cat_id."'
				AND active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 
			
			if(!isset($store_data)){
				$store_data = new StoreData;
			}				

			$store_count = $store_data->getItemCount(0,0,$cat_id,0,'cart');
	
			if($store_count > 0 && $object->show_in_cart > 0){
				return 1;	
			}
		}


		return 0;

	}


	function getFooterNavSubmenuLabels($footer_nav_label_id, $col = 2)
	{
		//unset($_SESSION['footer_nav_submenu_labels']);	
		//if(!isset($_SESSION['footer_nav_submenu_labels'])){
		
			$_SESSION['footer_nav_submenu_labels'] = array();	
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
			$sql = "SELECT label, footer_nav_submenu_label_id, page_seo_id, cat_id, custom_url, keyword_landing_id
					FROM footer_nav_submenu_label
					WHERE active = '1'
					AND footer_nav_label_id = '".$footer_nav_label_id."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY display_order";
			$result = $dbCustom->getResult($db,$sql);			
			
			
			$limit = 8;
			if(!$_SESSION['costco']){
				if($col == 1){			
					//$limit = 2;	
				}
			}
				
			$i = 0;
			
			while($row = $result->fetch_object()){
				if($i < $limit){
					
					$do_increment = 0;
				
				if($row->keyword_landing_id > 0){	
				
					$url = $this->getKeywordLandingURL($row->keyword_landing_id);
					
					$_SESSION['footer_nav_submenu_labels'][$i]['label'] = stripslashes($row->label);
					$_SESSION['footer_nav_submenu_labels'][$i]['id'] = $row->footer_nav_submenu_label_id;
					//$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "kwlp-".$row->keyword_landing_id."/".$_SESSION['global_url_word'].$url.'.html';
					
					$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "/".$url.'.html?k='.$row->keyword_landing_id;
					
				}elseif($row->cat_id > 0){
					
						$_SESSION['footer_nav_submenu_labels'][$i]['label'] = stripslashes($row->label);
						$_SESSION['footer_nav_submenu_labels'][$i]['id'] = $row->footer_nav_submenu_label_id;
						$dbCustom = new DbCustom();
						$db = $dbCustom->getDbConnect(CART_DATABASE);
						$sql = "SELECT show_in_cart
									,show_in_showroom
									,seo_url
									,seo_list
									,profile_cat_id
									,name
								FROM category
								WHERE cat_id = '".$row->cat_id."'";
						$res = $dbCustom->getResult($db,$sql);
						if($res->num_rows > 0){
							
							$object = $res->fetch_object();

							if($object->show_in_cart){
								//$_SESSION['footer_nav_submenu_labels'][$i]['url'] = $object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;							
								$t = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'shop');
							}else{
								//$_SESSION['footer_nav_submenu_labels'][$i]['url'] = $object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;														
								$t = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'showroom');							
							}
							
							$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "/".$t;
						
						}else{
							$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].'category.html';
						}
					
						$do_increment = 1;
										
					}elseif(trim($row->custom_url) != ''){
						$_SESSION['footer_nav_submenu_labels'][$i]['label'] = stripslashes($row->label);
						$_SESSION['footer_nav_submenu_labels'][$i]['id'] = $row->footer_nav_submenu_label_id;
						$_SESSION['footer_nav_submenu_labels'][$i]['url'] = $row->custom_url;
						
						$do_increment = 1;
					}else{				
		
						if(count($_SESSION['pages']) < 3){
							$this->loadPages();
						}
						
						foreach($_SESSION['pages'] as $p_val){
							if($p_val['page_seo_id'] == $row->page_seo_id && $p_val['active']){
								
								
								
								$_SESSION['footer_nav_submenu_labels'][$i]['label'] = stripslashes($row->label); 
								$_SESSION['footer_nav_submenu_labels'][$i]['id'] = $row->footer_nav_submenu_label_id;
								if($_SESSION['seo']){
									$url = $p_val['seo_name'];
								}else{
									$url = $p_val['page_name'];
								}
								if($p_val['page_name'] == "showroom"){
									$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].'showroom.html';
								}elseif($p_val['page_name'] == "app"){
									$_SESSION['footer_nav_submenu_labels'][$i]['url'] = $url.'/';								
								}else{
									$_SESSION['footer_nav_submenu_labels'][$i]['url'] = "/".$_SESSION['global_url_word'].$url.'.html';
								}
								
								$do_increment = 1;
							}
									
						}
						
					}
					
					
					
					if($do_increment) $i++;
				}
			}
		//}
		return $_SESSION['footer_nav_submenu_labels'];
	}
	


	function getTopShowroomCats()
	{
	
		//unset($_SESSION['top_showroom_cats']);
		if(!isset($_SESSION['top_showroom_cats'])){
			
			$_SESSION['top_showroom_cats'] = array();
			
			if(!isset($store_data)){
				$store_data = new StoreData;
			}
			$dbCustom = new DbCustom();	
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			
			$sql = "SELECT category.cat_id
						,category.profile_cat_id
						,category.name
						,category.short_name
						,category.img_id
						,category.seo_url
						,category.seo_list
						,category.img_alt_text
						,category.tool_tip
						,category.display_order
						,image.file_name
					FROM category, image
					WHERE category.img_id = image.img_id
					AND category.active = '1'
					AND category.show_in_showroom = '1'					
					AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY category.display_order";
			$result = $dbCustom->getResult($db,$sql);					
			$i = 0;
			while($row = $result->fetch_object()) {
							
				$sql = "SELECT child_cat_to_parent_cat_id 
						FROM child_cat_to_parent_cat, category
						WHERE child_cat_to_parent_cat.parent_cat_id = category.cat_id
						AND category.show_in_showroom = '1'
						AND child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";				
				$tgc_res = $dbCustom->getResult($db,$sql);					
				
				if(!$tgc_res->num_rows > 0){

					if($store_data->getItemCount(0,0,$row->cat_id,0,'showroom') > 0){
	
						$_SESSION['top_showroom_cats'][$i]['cat_id'] = $row->cat_id;
						$_SESSION['top_showroom_cats'][$i]['profile_cat_id'] = $row->profile_cat_id;
						$_SESSION['top_showroom_cats'][$i]['name'] = $row->name;
						$_SESSION['top_showroom_cats'][$i]['short_name'] = $row->short_name;
						$_SESSION['top_showroom_cats'][$i]['seo_url'] = $row->seo_url;
						$_SESSION['top_showroom_cats'][$i]['seo_list'] = $row->seo_list;
						$_SESSION['top_showroom_cats'][$i]['img_alt_text'] = $row->img_alt_text;
						$_SESSION['top_showroom_cats'][$i]['file_name'] = $row->file_name;
						$_SESSION['top_showroom_cats'][$i]['tool_tip'] = $row->tool_tip;
						$_SESSION['top_showroom_cats'][$i]['display_order'] = $row->display_order;
								
								
								
								
						$i++;
					}
				}
			}
		}
	
		return $_SESSION['top_showroom_cats'];		
	}
	
	
	
	

	function getTopCats($show_in = '')
	{	
		unset($_SESSION['top_cats']);		
		
		if(!isset($_SESSION['top_cats'])){
			$_SESSION['top_cats'] = array();
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			
			if(!isset($store_data)){
				$store_data = new StoreData;
			}
			
			$sql = "SELECT category.cat_id
						,category.profile_cat_id
						,category.name
						,category.short_name
						,category.img_id
						,category.seo_url
						,category.seo_list
						,category.show_in_cart
						,category.show_in_showroom 
						,category.img_alt_text
						,category.display_order
						,image.file_name
						,category.active
						,category.display_order						
						,category.short_description
						,category.description
					FROM category, image
					WHERE category.img_id = image.img_id
					AND category.active = '1'
					AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY category.display_order";
			$result = $dbCustom->getResult($db,$sql);	

			//echo $result->num_rows;
			//echo "<br />";
			
			$i = 0;

			while($row = $result->fetch_object()) {
							
				$sql = "SELECT child_cat_to_parent_cat_id 
						FROM child_cat_to_parent_cat
						WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
				$tgc_res = $dbCustom->getResult($db,$sql);					
				if($tgc_res->num_rows == 0){

					$_SESSION['top_cats'][$i]['cat_id'] = $row->cat_id;
					$_SESSION['top_cats'][$i]['profile_cat_id'] = $row->profile_cat_id;
					$_SESSION['top_cats'][$i]['name'] = $row->name;
					$_SESSION['top_cats'][$i]['file_name'] = $row->file_name;
					$i++;
				}

			}
		
			return $_SESSION['top_cats'];
			
		}	
		
		return array();
	}

	function getHomeKeywordLandingPages()
	{
		$t = array();
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
		$sql = "SELECT keyword_landing.keyword_landing_id 
					,keyword_landing.heading
					,keyword_landing.url_name
					,image.file_name 
				FROM keyword_landing, image
				WHERE keyword_landing.main_img_id = image.img_id 
				AND keyword_landing.show_on_home_page > '0' 
				AND keyword_landing.profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		$result = $dbCustom->getResult($db,$sql);
		
		$i = 0;
		while($row = $result->fetch_object()) {
		
			$t[$i]['keyword_landing_id'] = $row->keyword_landing_id;
			$t[$i]['name'] = $row->heading;
			$t[$i]['file_name'] = $row->file_name;
			$t[$i]['tool_tip'] = $row->heading;			
			$t[$i]['img_alt_text'] = $row->url_name; 
			$t[$i]['url'] = ($row->url_name != '') ? $row->url_name : 'organizer';
			
			$i++;
		}
		
		return $t;
		
	}


	function get_file_name($img_id)
	{
		
		$ret = "NONE";
		
		$dbCustom = new DbCustom();
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




	function getChildCats($cat_id)
	{
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$child_cats_array = array();
		
		$sql = "SELECT category.cat_id
					,category.profile_cat_id
					,category.name
					,category.img_id					
				FROM category, child_cat_to_parent_cat 
				WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
		$result = $dbCustom->getResult($db,$sql);

//echo $result->num_rows;
//exit;		
		$i = 0;		
		while($row = $result->fetch_object()) {	
	
			$child_cats_array[$i]['file_name'] = $this->get_file_name($row->img_id);	
			$child_cats_array[$i]['cat_id'] = $row->cat_id;
			$child_cats_array[$i]['profile_cat_id'] = $row->profile_cat_id;
			$child_cats_array[$i]['name'] = $row->name;
				
			$i++;
		}
		
		return $child_cats_array;
		
	}


		
	function getNavBarBrands()
	{
		//unset($_SESSION['nav_bar_brands']);
		if(!isset($_SESSION['nav_bar_brands'])){
	
			$t = array();
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT name, short_name ,brand_id 
					FROM brand 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY name LIMIT 10";
			$result = $dbCustom->getResult($db,$sql);			
			$i = 0;
			while($row = $result->fetch_object()) {
				$t[$i]['name'] = $row->name;
				$t[$i]["short_name"] = $row->short_name;
				$t[$i]["brand_id"] = $row->brand_id;
				$i++;
			}
			$_SESSION['nav_bar_brands'] = $t; 
		}
	
		return $_SESSION['nav_bar_brands'];
	}



	function getSideLabels()
	{
		$t = array();
		
		//unset($_SESSION['side_nav_labels']);
		if(!isset($_SESSION['side_nav_labels'])){
		
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT * 
					FROM side_nav_label
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					AND active = '1'
					ORDER BY display_order";
			$result = $dbCustom->getResult($db,$sql);			
			$i = 0;
			while($row = $result->fetch_object()){
				$t[$i]['label']= stripslashes($row->label);	
				if($row->cat_id > 0){
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT show_in_cart
								,show_in_showroom
								,seo_url
								,seo_list
								,profile_cat_id
								,name
							FROM category
							WHERE cat_id = '".$row->cat_id."'";
					$res = $dbCustom->getResult($db,$sql);
					
					if($res->num_rows > 0){
						$object = $res->fetch_object();
					
						$t[$i]['seo_list'] = $object->seo_list;
						
						if($object->show_in_cart){
							//$t[$i]['url'] = $object->seo_url.'/category.html?prodCatId='.$object->profile_cat_id;
							$t[$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'shop');
						}else{
							//$t[$i]['url'] = $object->seo_url.'/showroom.html?prodCatId='.$object->profile_cat_id;	
							$t[$i]['url'] = $this->getCatUrl($object->name, $object->profile_cat_id, $show_in = 'showroom');													
						}
						
					}
				}elseif(trim($row->custom_url) != ''){
					$t[$i]['url'] = $row->custom_url;
				}elseif($row->page_seo_id > 0){
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
					$sql = "SELECT page_name, seo_name
							FROM page_seo
							WHERE page_seo_id = '".$row->page_seo_id."'";
					$d_res = $dbCustom->getResult($db,$sql);					
					if($d_res->num_rows > 0){
						$d_obj = $res->fetch_object();
						if($_SESSION["seo"]){
							$t[$i]['url'] =  $d_obj->seo_name.'.html';
						}else{
							$t[$i]['url'] =  $d_obj->page_name.'.html';
						}
					}
				}else{
					$t[$i]['url'] =  '';
				}
			
				$i++;
			
			}

			$_SESSION['side_nav_labels'] = $t;
		}
		
		return $_SESSION['side_nav_labels'];

	}


	function getSideNavHeading()
	{
		
		//unset($_SESSION['side_nav_heading']);
		
		if(!isset($_SESSION['side_nav_heading'])){
		
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
			$sql = "SELECT heading
					FROM side_nav
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['side_nav_heading'] = stripslashes($object->heading);
			}else{
				$_SESSION['side_nav_heading'] = '';	
			}
		}
		return $_SESSION['side_nav_heading'];
	}

	function getSideNav()
	{
			
		//unset($_SESSION['side_nav']);
		
		if(!isset($_SESSION['side_nav'])){
			
			$t = array();	
			$block = '';
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
			$sql = "SELECT submenu_content_type
					FROM side_nav
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				
				$detect = new Mobile_Detect;
				$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 2 : 1) : 3);
				//$imgdir = ($deviceType == 1 ? ($deviceType == 2 ? 'thumb' : 'tiny') : 'thumb');
				$imgdir = 'tiny';
				
				$submenu_content_type = $object->submenu_content_type;
				
				$char_limit = 28;				
				if($submenu_content_type == 1){
					$t = $this->getTopCats();
					foreach($t as $val){

						if($val['short_name'] != ''){
							$label = $val['short_name'];
						}else{
							$label = $val['name'];
						}	

						$full_label = stripslashes($label);
						$char_length = strlen($full_label);
//						if($char_length > $char_limit){
//							$label = substr($full_label ,0 ,$char_limit);				
//							$label .= '...';
//						}else{
							$label = $full_label;
//						}
			
						if(strpos($val['destination'], "showroom") !== false){
							$url_str = $this->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
						}else{
							$url_str = $this->getCatUrl($val['name'], $val['profile_cat_id'], 'shop');
						}
						
						$block .= "<li><a href='".$url_str."' title='".$full_label."'>";
						$block .= "<img src='"."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$val["file_name"]."' 
						alt='".$val['img_alt_text']."' />";
						$block .= $label."</a></li>";
					}
		
				}elseif($submenu_content_type == 2){
					$t = $this->getNavBarBrands();
					$i++;
					foreach($t as $val){
						if($val['short_name'] != ''){
							$label = $val['short_name'];
						}else{
							$label = $val['name'];
						}	
						$full_label = stripslashes($label);
						$char_length = strlen($full_label);
						if($char_length > $char_limit){
							$label = substr($full_label ,0 ,$char_limit);				
							$label .= '...';
						}else{
							$label = $full_label;
						}
$block .= "<li><a href='"."/".getUrlText($val['name'])."/category.html?brandId=".$val['brand_id']."'
						title='".$full_label."'>";
						$block .= $label."</a></li>";
					}
				}elseif($submenu_content_type == 3){
					$t = $this->getSideLabels();
					foreach($t as $val){
						$full_label = stripslashes($val['label']);
						$char_length = strlen($full_label);
						if($char_length > $char_limit){
							$label = substr($full_label ,0 ,$char_limit);				
							$label .= '...';
						}else{
							$label = $full_label;
						}
						$block .= "<li><a href='"."/".$_SESSION['global_url_word'].$val['url']."' title='".$full_label."'>".$label."</a></li>";
					}
				}else{
					$t = $this->getHomePageCats();
					foreach($t as $val){
						if($val['short_name'] != ''){
							$label = $val['short_name'];
						}else{
							$label = $val['name'];
						}	

						$full_label = stripslashes($label);
						$char_length = strlen($full_label);
//						if($char_length > $char_limit){
//							$label = substr($full_label ,0 ,$char_limit);				
//							$label .= '...';
//						}else{
							$label = $full_label;
//						}
						

						if(strpos($val['destination'], 'showroom') !== false){
							$url_str = $this->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
						}else{
							$url_str = $this->getCatUrl($val['name'], $val['profile_cat_id'], 'shop');
						}
						
						$block .= "<li><a href='".$url_str."' title='".$full_label."'>";
						$block .= "<img src='"."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$val["file_name"]."' 
						alt='".$val['img_alt_text']."' />";
						$block .= $label."</a></li>";
					}
				}
			}
			
			$_SESSION['side_nav'] = $block;
			
		}	
		return $_SESSION['side_nav'];
	}
							

	function getFooterNavCats($col = 8)
	{
	
		//unset($_SESSION["footer_nav_cats"]);
		
		if(!isset($_SESSION['footer_nav_cats'])){
			if(!isset($store_data)){
				$store_data = new StoreData;
			}
	
			
			$top = array();
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT cat_id
						,profile_cat_id
						,name
						,short_name
						,img_id
						,seo_url
						,seo_list
						,show_in_cart
						,show_in_showroom 
					FROM category
					WHERE active = '1'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY display_order";
					
			$result = $dbCustom->getResult($db,$sql);					
			$i = 0;	
			
			if($col == 1){
				$limit = 2;	
			}else{
				$limit = 7;
			}
	
			while($row = $result->fetch_object()) {
				
				$sql = "SELECT child_cat_to_parent_cat_id 
						FROM child_cat_to_parent_cat
						WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
				$tgc_res = $dbCustom->getResult($db,$sql);
				
				
				if($i < $limit){
					if(!$tgc_res->num_rows > 0){
	
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
					
					
							if($store_count > 0){ 
								$destination = 'cart';
								$go = 1;
							}else{
								$destination == 'showroom';
								if($showroom_count > 0){
									$go = 1;	
								}
							}
					
					/*
							
							if($showroom_count > 0){ 
								$destination = 'showroom';
								$go = 1;
							}else{
								$destination == 'cart';
								if($store_count > 0){
									$go = 1;	
								}
							}
					*/
					
							
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
		
							
							$top[$i]['cat_id'] = $row->cat_id;
							$top[$i]['profile_cat_id'] = $row->profile_cat_id;
							$top[$i]['name'] = $row->name;
							$top[$i]['short_name'] = $row->short_name;
							$top[$i]['seo_url'] = $row->seo_url;
							$top[$i]['seo_list'] = $row->seo_list;											
							$top[$i]['destination'] = $destination;											
			
							$i++;
						}
						
			
						$_SESSION["footer_nav_cats"] = $top;
					}
				}
			}
		}
		return $_SESSION['footer_nav_cats'];
	}
		
	
	
	function getFooterNavBrands($col = 8)
	{
	
		//unset($_SESSION['footer_nav_brands']);	
		if(!isset($_SESSION['footer_nav_brands'])){
			
			$t = array();
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT name, short_name,brand_id 
					FROM brand 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					LIMIT 10";
			$result = $dbCustom->getResult($db,$sql);			
	
			if($col == 1){ 
				$boxclass_ext = '_short';
				$limit = 2;
			}else{
				$boxclass_ext = '';
				$limit = 9;
			}
			
			$i = 0;
			while($row = $result->fetch_object()) {
				if($i < $limit){
					$t[$i]['brand_id'] = $row->brand_id;
					$t[$i]['name'] = $row->name;
					$t[$i]['short_name'] = $row->short_name;
					$i++;
				}
			}
			$_SESSION['footer_nav_brands'] = $t; 
		}
	
		return $_SESSION['footer_nav_brands'];
	}

	
	
	function hasSearchBox()
	{
		//unset($_SESSION['has_search_box']);	
		if(!isset($_SESSION['has_search_box'])){
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT show_search_box
					FROM main_nav_bar
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$show_search_box = $object->show_search_box;
			}else{
				$show_search_box = 1;
			}
			$_SESSION['has_search_box'] = $show_search_box;
		}
		return $_SESSION['has_search_box'];
	}
	
	
	function get_cat_sub_menu($cat_id)
	{

		$ret_array = array('block' => '', 'total_char_len' => 0, 'active' => '');
		$total_char_len = 20;			
		$ret_block = '';
		$active = '';

		$child_cats = $this->getChildCats($cat_id);	
				
		foreach($child_cats as $child_cat_val){
										
			if($child_cat_val['short_name'] != ''){
				$label = $child_cat_val['short_name'];
			}else{
				$label = $child_cat_val['name'];
			}				
			$char_length = strlen($label);
					
			if($char_length > $total_char_len){
				$total_char_len = $char_length;
			}
				
			if(strpos($child_cat_val['destination'], 'showroom') !== false){
				$url_str = $this->getCatUrl($child_cat_val['name'],$child_cat_val['profile_cat_id'],'showroom');
			}else{
				$url_str = $this->getCatUrl($child_cat_val['name'],$child_cat_val['profile_cat_id'],'shop');
			}
			
			$ret_block .= "<li><a href='".$url_str."' $active>".stripslashes($label)."</a></li>";			
			
			
					
		}

		$ret_array['block'] = $ret_block;  
		$ret_array['total_char_len'] = $total_char_len+1;
		$ret_array['active'] = $active;
		
		return $ret_array;

	}
	
	
	function recursive_get_sub_menu($label_id, $is_top = 0, $this_url = '')
	{
		
					
		$ret_array = array('block' => '', 'total_char_len' => 0, 'active' => '', 'multiple_subnavs' => 0);
		$total_char_len = 20;			
		$ret_block = '';
		$active = '';
		$multiple = 0;

		$navbar_submenu_labels = $this->getNavbarSubmenuLabels($label_id, $is_top);
		
		foreach($navbar_submenu_labels as $val){
				
			$active = '';
			
			if($val['label'] != ''){
							
				if($val['url'] != ''){
					if(strpos($this_url,$val['url']) !== false) {
						$active = "class='active'";
					}
				}
							
				$char_length = strlen($val['label']);
				if($char_length > $total_char_len){
					$total_char_len = $char_length;
				}
					
				if($val['cat_id'] > 0 && $is_top == 0){
					$sub_list_data = $this->get_cat_sub_menu($val['cat_id']);
				
				}else{
					$sub_list_data = $this->recursive_get_sub_menu($val['id']);
				
				}
				
				if($sub_list_data['block'] != ''){
					$ret_block .= "<li class='has-subnavs'>";
				}else{
					$ret_block .= "<li>";	
				}
				
				if(strpos($val['url'], 'category') !== false){
					$ret_block .= "<a href='".$val['url']."' $active >";
					
				}elseif($val['keyword_landing_id']> 0){
					
					$ret_block .= "<a href='"."/".$val['url']."?k=".$val['keyword_landing_id']."' $active >";	
								
				}else{
					$ret_block .= "<a href='"."/".$_SESSION['global_url_word'].$val['url']."' $active >";
				}
				
				$ret_block .= stripslashes($val['label'])."</a>";			
					
				$total_char_len = $sub_list_data['total_char_len'];
						
				//$total_char_len = $total_char_len * (7+(7/$total_char_len));		
				if($sub_list_data['block'] != ''){
					$ret_block .= "<ul class='subnav'>";
					$ret_block .= $sub_list_data['block'];
					$ret_block .= "</ul>";
					$multiple = 1;
				}
							
				$ret_block .= "</li>";
										
			}
		}
		
		$ret_array['block'] = $ret_block;  
		$ret_array['total_char_len'] = $total_char_len+1;
		$ret_array['active'] = $active;
		$ret_array['multiple_subnavs'] = $multiple;
				
		return $ret_array;
				
	}
	
	
	function getUrlFromCatId($cat_id){

		$ret = $_SERVER['DOCUMENT_ROOT'];
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT profile_cat_id
					,seo_url
					,show_in_cart
					,show_in_showroom
					,name 
				FROM category
				WHERE cat_id = '".$cat_id."'";
					
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			
			if($object->show_in_showroom){
				//$ret .= '/'.$_SESSION['global_url_word'].$object->seo_url."/showroom.html?prodCatId=".$object->profile_cat_id;
				$ret = '/showroom-category-'.$object->profile_cat_id.'/'.$object->name.'.html';
			}else{
				//$ret .= '/'.$_SESSION['global_url_word'].$object->seo_url."/category.html?prodCatId=".$object->profile_cat_id;				
				$ret = '/category-'.$object->profile_cat_id.'/'.$object->name.'.html';			
			}		
		}
		return $ret;
	}

	function getCatNameFromId($cat_id){

		$dbCustom = new DbCustom();
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
	
	
	function getKeywordLandingURL($keyword_landing_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT url_name 
				FROM keyword_landing
				WHERE keyword_landing_id = '".$keyword_landing_id."'";					
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$url_name = ($object->url_name != '') ? $object->url_name : 'organizer'; 
			return $url_name;			
		}
		
		return '';
		
		
	}
	
}



/*  ***************  OLD WAY *****************
	function getHomePageCats($show_in = 'showroom', $limit = 0)
	{
		
		unset($_SESSION['home_cats_1']);
		unset($_SESSION['home_cats_2']);
		
		if(!isset($_SESSION['home_cats_2'])){
			$_SESSION['home_cats_2'] = array();
		}
		
		if(!isset($_SESSION['home_cats_1'])){
			$_SESSION['home_cats_1'] = array();
		}
		
		
		if($show_in == 'showroom'){
			
			if(count($_SESSION['home_cats_2']) == 0){
				
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				
				
				if(!isset($store_data)){
					$store_data = new StoreData;
				}
				
		
				$sql = "SELECT category.cat_id
							,category.profile_cat_id
							,category.name
							,category.short_name
							,category.tool_tip
							,image.file_name
							,category.seo_url
							,category.seo_list
							,category.show_in_showroom
							,category.show_in_cart
							,category.img_alt_text
							,category.hp1_display_order
							,category.hp2_display_order  
					FROM category, image
					WHERE category.img_id = image.img_id
					AND category.show_on_home_page  = '1'					
					AND category.active  = '1'
					AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
					AND category.show_in_showroom = '1'
					ORDER BY category.hp2_display_order";
					
					
					if($limit > 0){
						$sql .= " limit ".$limit;	
					}
				
				
				
				$result = $dbCustom->getResult($db,$sql);					
				$i = 0;
				while($row = $result->fetch_object()) {
		
					$tool_tip = trim($row->tool_tip);
					$go = 0;
					$store_count = 0;
					$showroom_count = 0;
					$destination = 'showroom';
					$block = '';
	
					$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
						
					$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
		
					if($showroom_count> 0){ 
						$go = 1;
					}else{
						if($store_count > 0){
							$destination = 'cart';
							$go = 1;
						}
					}
					
					if($go){
						$_SESSION['home_cats_2'][$i]['destination'] = $destination;
						$_SESSION['home_cats_2'][$i]['cat_id'] = $row->cat_id;
						$_SESSION['home_cats_2'][$i]['profile_cat_id'] = $row->profile_cat_id;
						$_SESSION['home_cats_2'][$i]['name'] = $row->name;
						$_SESSION['home_cats_2'][$i]['short_name'] = $row->short_name;
						$_SESSION['home_cats_2'][$i]['seo_url'] = $row->seo_url;
						$_SESSION['home_cats_2'][$i]['seo_list'] = $row->seo_list;
						$_SESSION['home_cats_2'][$i]['img_alt_text'] = $row->img_alt_text;
						$_SESSION['home_cats_2'][$i]['file_name'] = $row->file_name;
						$_SESSION['home_cats_2'][$i]['tool_tip'] = $row->tool_tip;					
						$_SESSION['home_cats_2'][$i]['hp1_display_order'] = $row->hp1_display_order;
						$_SESSION['home_cats_2'][$i]['hp2_display_order'] = $row->hp2_display_order;
						$_SESSION['home_cats_2'][$i]['child_array'] = $this->getChildCats($row->cat_id);
						$_SESSION['home_cats_2'][$i]['child_count'] = count($_SESSION['home_cats_2'][$i]['child_array']);
		
						$i++;
					}		
				}
								
			}
			
			return $_SESSION['home_cats_2'];
			

		}else{
		
			if(count($_SESSION['home_cats_1']) == 0){
		
				$dbCustom = new DbCustom();
				$db = $dbCustom->getDbConnect(CART_DATABASE);
					
				if(!isset($store_data)){
					$store_data = new StoreData;
				}
			
	
				$sql = "SELECT category.cat_id
								,category.profile_cat_id
								,category.name
								,category.short_name
								,category.tool_tip
								,image.file_name
								,category.seo_url
								,category.seo_list
								,category.show_in_showroom
								,category.show_in_cart
								,category.img_alt_text
								,category.hp1_display_order
								,category.hp2_display_order  
					FROM category, image
					WHERE category.img_id = image.img_id
					AND category.show_on_home_page  = '1'					
					AND category.active  = '1'
					AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
					AND category.show_in_cart = '1'
					ORDER BY category.hp1_display_order";
			
			
					$result = $dbCustom->getResult($db,$sql);					
					$i = 0;
					while($row = $result->fetch_object()) {
			
						$tool_tip = trim($row->tool_tip);
						$go = 0;
						$store_count = 0;
						$showroom_count = 0;
						$destination = 'cart';
						$block = '';
		
						$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
							
						$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
		
					
						if($store_count > 0){ 
							$go = 1;
						}else{	
							if($showroom_count > 0){
								$destination = 'showroom';
								$go = 1;
							}
						}
					

			
						if($go){
							$_SESSION['home_cats_1'][$i]['destination'] = $destination;
							$_SESSION['home_cats_1'][$i]['cat_id'] = $row->cat_id;
							$_SESSION['home_cats_1'][$i]['profile_cat_id'] = $row->profile_cat_id;
							$_SESSION['home_cats_1'][$i]['name'] = $row->name;
							$_SESSION['home_cats_1'][$i]['short_name'] = $row->short_name;
							$_SESSION['home_cats_1'][$i]['seo_url'] = $row->seo_url;
							$_SESSION['home_cats_1'][$i]['seo_list'] = $row->seo_list;
							$_SESSION['home_cats_1'][$i]['img_alt_text'] = $row->img_alt_text;
							$_SESSION['home_cats_1'][$i]['file_name'] = $row->file_name;
							$_SESSION['home_cats_1'][$i]['tool_tip'] = $row->tool_tip;					
							$_SESSION['home_cats_1'][$i]['hp1_display_order'] = $row->hp1_display_order;
							$_SESSION['home_cats_1'][$i]['hp2_display_order'] = $row->hp2_display_order;
							$_SESSION['home_cats_1'][$i]['child_array'] = $this->getChildCats($row->cat_id);
							$_SESSION['home_cats_1'][$i]['child_count'] = count($_SESSION['home_cats_1'][$i]['child_array']);
			
							$i++;
						}								
					}
				}
			

			return $_SESSION['home_cats_1'];
		}
				
	}
*/


	/*
	function getThreeLevelCats()
	{
		
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
			
		$_SESSION['three_level_cats'] = array();
		$top_cat_array = array();	
		$sub_cat_array = array();
		$sub_sub_cat_array = array();
			
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
		$sql = "SELECT cat_id
				FROM category
				WHERE active = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY category.display_order";
			$result = $dbCustom->getResult($db,$sql);					
			$i = 0;
		while($row = $result->fetch_object()) {
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
			$tgc_res = $dbCustom->getResult($db,$sql);					
			if($tgc_res->num_rows == 0){
				
				$top_cat_array[$i] = $row->cat_id;
				$i++; 
				
			}
		}
		$i = 0;
		foreach($top_cat_array as $v){
			
			$sql = "SELECT cat_id
					FROM category, child_cat_to_parent_cat 
					WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
					AND child_cat_to_parent_cat.parent_cat_id = '".$v."'
					AND category.active = '1'";
			while($row = $result->fetch_object()){
				
				$sub_cat_array[$i]['top_cat_id'] = $v;
				$sub_cat_array[$i]['sub_cat_id'] = $row->cat_id;
				
				$i++;
				 
			}
		}

		
		$j = 0;
		foreach($sub_cat_array as $v){
			
			$sql = "SELECT cat_id
					FROM category, child_cat_to_parent_cat 
					WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
					AND child_cat_to_parent_cat.parent_cat_id = '".$v['sub_cat_id']."'
					AND category.active = '1'";
			while($row = $result->fetch_object()){
				
				foreach($top_cat_array as $tc_id){
					if($tc_id == $v['top_cat_id']){
						$sub_sub_cat_array[$j]['sub_cat_id'] = $row->cat_id;
						$j++;		
					}
				}
				 
			}
			
		}
		
		
		return array_merge($sub_cat_array, $sub_sub_cat_array);
		//return	$_SESSION['three_level_cats'];	
		
	}
	
	
	
	
	
	
	
	function getTopCats($show_in = '')
	{
	
		unset($_SESSION['top_cats']);
		
		if(!isset($_SESSION['top_cats'])){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			
			$_SESSION['top_cats'] = array();
			
			if(!isset($store_data)){
				$store_data = new StoreData;
			}
			
			$sql = "SELECT category.cat_id
						,category.profile_cat_id
						,category.name
						,category.short_name
						,category.img_id
						,category.seo_url
						,category.seo_list
						,category.show_in_cart
						,category.show_in_showroom 
						,category.img_alt_text
						,category.display_order
						,image.file_name
						,category.active
						,category.display_order						
						,category.short_description
						,category.description
					FROM category, image
					WHERE category.img_id = image.img_id
					AND category.active = '1'
					AND category.profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY category.display_order";
			$result = $dbCustom->getResult($db,$sql);					
			$i = 0;
			while($row = $result->fetch_object()) {
							
				$sql = "SELECT child_cat_to_parent_cat_id 
						FROM child_cat_to_parent_cat
						WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
				$tgc_res = $dbCustom->getResult($db,$sql);					
				if($tgc_res->num_rows == 0){
		
					$go = 0;
					$store_count = 0;
					$showroom_count = 0;
					$destination = 'cart';
		
					//if has showroom products, go to showroom
					//if has both type products, go to showroom
					//if has only store products, go to store
					$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
					$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
			
			
					if($show_in == 'showroom'){
					
						if($showroom_count > 0){ 
							$destination = 'showroom';
							$go = 1;	
						}
						
					}else{
				
				
				
						if($row->show_in_cart && $row->show_in_showroom){
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
							
							$destination = 'showroom';
							if($showroom_count > 0){ 
								$go = 1;
							}else{
								
								if($store_count > 0){
									$destination == 'cart';
									$go = 1;
								}
								
							}
						}else{
							$destination = 'cart';
							if($store_count > 0){ 
								$go = 1;
							}else{	
								if($showroom_count > 0){
									$destination = 'showroom';
									$go = 1;
								}
							}
							
						}
		
					}
					
					if($go){

						$_SESSION['top_cats'][$i]['destination'] = $destination;
						$_SESSION['top_cats'][$i]['cat_id'] = $row->cat_id;
						$_SESSION['top_cats'][$i]['profile_cat_id'] = $row->profile_cat_id;
						$_SESSION['top_cats'][$i]['name'] = $row->name;
						$_SESSION['top_cats'][$i]['short_name'] = $row->short_name;
						$_SESSION['top_cats'][$i]['seo_url'] = $row->seo_url;						
						$_SESSION['top_cats'][$i]['seo_list'] = $row->seo_list;
						$_SESSION['top_cats'][$i]['img_alt_text'] = $row->img_alt_text;
						$_SESSION['top_cats'][$i]['file_name'] = $row->file_name;
						$_SESSION['top_cats'][$i]['child_array'] = $this->getChildCats($row->cat_id);
						$_SESSION['top_cats'][$i]['child_count'] = count($_SESSION['top_cats'][$i]['child_array']);
						$_SESSION['top_cats'][$i]['display_order'] = $row->display_order;
						$_SESSION['top_cats'][$i]['short_description'] = $row->short_description;
						$_SESSION['top_cats'][$i]['description'] = $row->description;
						
						$i++;
					}
				}		
			}
		
		
		}
	
		return $_SESSION['top_cats'];
		
	}
	
	








	function getChildCats($cat_id)
	{
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		
		$child_cats_array = array();
		
		if(!isset($store_data)){
			$store_data = new StoreData;
		}
			
		$sql = "SELECT category.cat_id
						,category.profile_cat_id
						,category.name
						,category.short_name
						,category.seo_url
						,category.seo_list
						,category.show_in_cart
						,category.show_in_showroom 
				FROM category, child_cat_to_parent_cat 
				WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
				AND category.active = '1'
				ORDER BY category.display_order";
		$result = $dbCustom->getResult($db,$sql);		
		$i = 0;		
		while($row = $result->fetch_object()) {

			$go = 0;
			$store_count = 0;
			$showroom_count = 0;
			$destination = 'cart';
		
			//if has showroom products, go to showroom
			//if has both type products, go to showroom
			//if has only store products, go to store
			$store_count = $store_data->getItemCount(0,0,$row->cat_id,0,'cart');
			$showroom_count = $store_data->getItemCount(0,0,$row->cat_id,0,'showroom');					
					if($row->show_in_cart && $row->show_in_showroom){
												
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
						
						$destination = 'showroom';
						if($showroom_count > 0){ 
							$go = 1;
						}else{
							
							if($store_count > 0){
								$destination == 'cart';
								$go = 1;
							}
							
						}
					}else{
						$destination = 'cart';
						if($store_count > 0){ 
							$go = 1;
						}else{	
							if($showroom_count > 0){
								$destination = 'showroom';
								$go = 1;
							}
						}
						
						
					}




	
			if($go){
	
				$child_cats_array[$i]['destination'] = $destination;
				$child_cats_array[$i]['cat_id'] = $row->cat_id;
				$child_cats_array[$i]['profile_cat_id'] = $row->profile_cat_id;
				$child_cats_array[$i]['name'] = $row->name;
				$child_cats_array[$i]['short_name'] = $row->short_name;
				$child_cats_array[$i]['seo_url'] = $row->seo_url;
				$child_cats_array[$i]['seo_list'] = $row->seo_list;
				
				
				$i++;
			}

		}
		
		return $child_cats_array;
		
	}


	
	*/

?>


<!--

CISCO Maintaining State HTTP is a stateless protocol, 
which means that once a web server completes a client's request for a web page, 
the connection between the two goes away. 
In other words, there is no way for a server to recognize that a sequence of requests 
all originate from the same client. State is useful, though. 
You can't build a shopping-cart application, for example, 
if you can't keep track of a sequence of requests from a single user. 
You need to know when a user puts a item in his cart, when he adds items, 
when he removes them, and what's in the cart when he decides to check out. 
To get around the Web's lack of state, programmers have come up with many tricks to 
keep track of state information between requests (also known as session tracking ). 
One such technique is to use hidden form fields to pass around information. 
PHP treats hidden form fields just like normal form fields, so the values are available 
in the $_GET and $_POST arrays. Using hidden form fields, you can pass around the entire 
contents of a shopping cart. However, a more common technique is to assign each user a unique 
identifier and pass the ID around using a single hidden form field. 
While hidden form fields work in all browsers, they work only for a sequence of dynamically 
generated forms, so they aren't as generally useful as some other techniques. 
Another technique is URL rewriting, where every local URL on which the user might click is 
dynamically modified to include extra information. 
This extra information is often specified as a parameter in the URL. 
For example, if you assign every user a unique ID, you might include that ID in all URLs, 
as follows: http://www.example.com/catalog.php?userid=123 
If you make sure to dynamically modify all local links to include a user ID, you 
can now keep track of individual users in your application. 
URL rewriting works for all dynamically generated documents, not just forms, but actually 
performing the rewriting can be tedious. A third technique for maintaining 
state is to use cookies. 

A cookie is a bit of information that the server can give to a client. 
On every subsequent request the client will give that information back to the server, 
thus identifying itself. 
Cookies are useful for retaining information through repeated visits by a browser, 
but they're not without their own problems. The main problem is that some browsers 
don't support cookies, and even with browsers that do, the user can disable cookies. 
So any application that uses cookies for state maintenance needs to use another technique 
as a fallback mechanism. We'll discuss cookies in more detail shortly. 
The best way to maintain state with PHP is to use the built-in session-tracking system. 
This system lets you create persistent variables that are accessible from different 
pages of your application, as well as in different visits to the site by the same user. 
Behind the scenes, PHP's session-tracking mechanism uses cookies (or URLs) to elegantly solve 
most problems that require state, taking care of all the details for you. We'll cover PHP's 
session-tracking system in detail later in this chapter. 7.6.1. 
Cookies A cookie is basically a string that contains several fields. 
A server can send one or more cookies to a browser in the headers of a response. 
Some of the cookie's fields indicate the pages for which the browser should send the cookie 
as part of the request. The value field of the cookie is the payload—servers can store any 
data they like there (within limits), such as a unique code identifying the user, preferences, 
etc. Use the setcookie( ) function to send a cookie to the browser: 
setcookie(name [, value [, expire [, path [, domain [, secure ]]]]]); 
This function creates the cookie string from the given arguments and creates a 
Cookie header with that string as its value. Because cookies are sent as 
headers in the response, setcookie( ) must be called before any of the body of the 
document is sent. The parameters of setcookie( ) are: name A unique name for a 
particular cookie. You can have multiple cookies with different names and attributes. 
The name must not contain whitespace or semicolons. value The arbitrary string value 
attached to this cookie. The original Netscape specification limited the total size of a 
cookie (including name, expiration date, and other information) to 4 KB, so while 
there's no specific limit on the size of a cookie value, 
it probably can't be much larger than 3.5 KB. expire The expiration date for this cookie. 
If no expiration date is specified, the browser saves the cookie in memory and not on disk. 
When the browser exits, the cookie disappears. 
The expiration date is specified as the number of seconds since midnight, 
January 1, 1970, GMT. For example, pass time( )+60*60*2 to expire the cookie in two hours' 
time. path The browser will return the cookie only for URLs below this path. 
The default is the directory in which the current page resides. For example, 
if /store/front/cart.php sets a cookie and doesn't specify a path, the cookie will be sent b
ack to the server for all pages whose URL path starts with /store/front/. domain The browser 
will return the cookie only for URLs within this domain. The default is the server hostname. 
secure The browser will transmit the cookie only over https connections. T
he default is false, meaning that it's okay to send the cookie over insecure connections. W
hen a browser sends a cookie back to the server, you can access that cookie through the 
$_COOKIE array. The key is the cookie name, and the value is the cookie's value field. 
For instance, the following code at the top of a page keeps track of the number of 
times the page has been accessed by this client: When decoding cookies, any periods (.) i
n a cookie's name are turned into underscores. For instance, a cookie named tip.top is 
accessible as $_COOKIE['tip_top']. Example 7-10 shows an HTML page that gives a range of 
options for background and foreground colors. Example 7-10. Preference selection

-->



