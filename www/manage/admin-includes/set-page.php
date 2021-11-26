<?php 

// Note: $page_title is set in page script

//echo $parts[count($parts) - 1];
//echo in_array("manage",$parts); 
//echo substr(SITEROOT,strrpos(SITEROOT,SITEROOT)+1);
//int strrpos ( string $haystack , string $needle [, int $offset = 0 ] )
//echo $_SERVER["SCRIPT_NAME"];
//echo $_SERVER["HTTP_HOST"];
//echo substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
//print_r($_SERVER);




//$currentFile = $_SERVER["PHP_SELF"];

//echo $currentFile;

//$parts = Explode('/', $currentFile);
//$current_page = $parts[count($parts) - 1];	
//$current_dir = $parts[count($parts) - 2];	

//$admin_section = "manage";
//$manage_dir = "manage";

/*
foreach($parts as $part){
	echo $part."<br />";
}
*/

//echo $current_page;

/*
foreach($parts as $part){

	
	if($part == "cms"){
		$manage_dir .= "/cms";
		$admin_section = "cms";
		break;		
	}
	
	
	
	
	if($part == "showroom"){
		$manage_dir .= "/showroom";
		$admin_section = "showroom";
		break;		
	}
	
		
	
	
	if($part == "crm"){
		$manage_dir .= "/crm";
		$admin_section = "crm";
		break;		
	}


	if($part == "order-management"){
		$manage_dir .= "/order-management";
		$admin_section = "order-management";
		break;		
	}
	
	
	
	
	
	if($part == "customer"){
		$manage_dir .= "/customer";
		$admin_section = "customer";
		break;		
	}


	if($part == "social"){
		$manage_dir .= "/social";
		$admin_section = "social";
		break;		
	}



	if($part == "general-admin"){
		$manage_dir .= "/general-admin";
		$admin_section = "general-admin";
		break;		
	}

	
	if($part == "admin-users"){
		$manage_dir .= "/admin-users";
		$admin_section = "admin-users";
		break;		
	}


	
	if($part == "master-admin"){
		$manage_dir .= "/master-admin";
		$admin_section = "master-admin";
		break;		
	}

}


if(!isset($bread_crumb)) $bread_crumb = new AdminBreadCrumb;


$bc_top_cat_id =  (isset($_GET['top_cat_id'])) ? $_GET['top_cat_id'] : 0;
$bc_parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$bc_cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$bc_item_id =  (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
$bc_order_id =  (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;
$bc_banner_id =  (isset($_GET['banner_id'])) ? $_GET['banner_id'] : 0;
$bc_navbar_submenu_label_id =  (isset($_GET['navbar_submenu_label_id'])) ? $_GET['navbar_submenu_label_id'] : 0;
$bc_navbar_label_id = (isset($_GET['navbar_label_id'])) ? $_GET['navbar_label_id'] : 0;
$bc_footer_nav-label_id = (isset($_GET['footer_nav-label_id'])) ? $_GET['footer_nav-label_id'] : 0;
$bc_footer_nav_submenu_label_id = (isset($_GET['footer_nav_submenu_label_id'])) ? $_GET['footer_nav_submenu_label_id'] : 0;
$bc_header_support_menu_label_id = (isset($_GET['header_support_menu_label_id'])) ? $_GET['header_support_menu_label_id'] : 0;
$bc_shipping_time_id = (isset($_GET['shipping_time_id'])) ? $_GET['shipping_time_id'] : 0;
$bc_shipping_term_id = (isset($_GET['shipping_term_id'])) ? $_GET['shipping_term_id'] : 0;
$bc_discount_id = (isset($_GET['discount_id'])) ? $_GET['discount_id'] : 0;
$bc_discount_how_id = (isset($_GET['discount_how_id'])) ? $_GET['discount_how_id'] : 0;
$bc_process_id = (isset($_GET['process_id'])) ? $_GET['process_id'] : 0;
$bc_policy_id = (isset($_GET['policy_id'])) ? $_GET['policy_id'] : 0;
$bc_terms_of_use_id = (isset($_GET['terms_of_use_id'])) ? $_GET['terms_of_use_id'] : 0;
$bc_privacy_statement_id = (isset($_GET['privacy_statement_id'])) ? $_GET['privacy_statement_id'] : 0;
$bc_testimonial_page_id = (isset($_GET['testimonial_page_id'])) ? $_GET['testimonial_page_id'] : 0;
$bc_about_us_id = (isset($_GET['about_us_id'])) ? $_GET['about_us_id'] : 0;
$bc_contact_email_page_id = (isset($_GET['contact_email_page_id'])) ? $_GET['contact_email_page_id'] : 0;
$bc_in_home_consultation_id = (isset($_GET['in_home_consultation_id'])) ? $_GET['in_home_consultation_id'] : 0;
$bc_guide_tip_id = (isset($_GET['guide_tip_id'])) ? $_GET['guide_tip_id'] : 0;
$bc_guide_tip_cat_id = (isset($_GET['guide_tip_cat_id'])) ? $_GET['guide_tip_cat_id'] : 0;
$bc_faq_id = (isset($_GET['faq_id'])) ? $_GET['faq_id'] : 0;
$bc_faq_cat_id = (isset($_GET['faq_cat_id'])) ? $_GET['faq_cat_id'] : 0;
$bc_download_id = (isset($_GET['download_id'])) ? $_GET['download_id'] : 0;
$bc_page_seo_id = (isset($_GET['page_seo_id'])) ? $_GET['page_seo_id'] : 0;
$bc_added_page_id = (isset($_GET['added_page_id'])) ? $_GET['added_page_id'] : 0;
$bc_ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 0;
if($bread_crumb->crumb_count() > 8) $bread_crumb->reSet("start", SITEROOT."/manage/start.php");	
if($page_title == "start"){
	$bread_crumb->reSet($page_title, SITEROOT."/manage/start.php");	
}elseif($admin_section == "cart"){
	$cart_url = SITEROOT."/".$manage_dir."/".$current_page;
	$cart_url .= "?parent_cat_id=".$bc_parent_cat_id."&cat_id=".$bc_cat_id;
	$cart_url .= "&item_id=".$bc_item_id."&cat_id=".$bc_cat_id;
	$cart_url .= "&top_cat_id=".$bc_top_cat_id."&banner_id=".$bc_banner_id;
	$bread_crumb->add($page_title, $cart_url);
	$bread_crumb->prune($page_title);
}elseif($admin_section == "order-management"){
	if(getProfileType($dbCustom) == "master"){
		$bread_crumb->add($page_title, SITEROOT."/".$manage_dir."/master/".$current_page."?order_id=".$bc_order_id);
	}elseif(getProfileType($dbCustom) == "sas-parent"){
		$bread_crumb->add($page_title, SITEROOT."/".$manage_dir."/sas-parent/".$current_page."?order_id=".$bc_order_id);		
	}else{
		$bread_crumb->add($page_title, SITEROOT."/".$manage_dir."/sas-non-parent/".$current_page."?order_id=".$bc_order_id);				
	}
	$bread_crumb->prune($page_title);
}elseif($admin_section == "cms"){
	$cms_url = SITEROOT."/".$manage_dir."/".$current_page;
	$cms_url .= "?navbar_label_id=".$bc_navbar_label_id."&navbar_submenu_label_id=".$bc_navbar_submenu_label_id;
	$cms_url .= "&footer_nav-label_id=".$bc_footer_nav-label_id."&footer_nav_submenu_label_id=".$bc_footer_nav_submenu_label_id;
	$cms_url .= "&shipping_time_id=".$bc_shipping_time_id."&shipping_term_id=".$bc_shipping_term_id;
	$cms_url .= "&discount_id=".$bc_discount_id."&discount_how_id=".$bc_discount_how_id;
	$cms_url .= "&process_id=".$bc_process_id."&policy_id=".$bc_policy_id;
	$cms_url .= "&terms_of_use_id=".$bc_terms_of_use_id."&privacy_statement_id=".$bc_privacy_statement_id;
	$cms_url .= "&testimonial_page_id=".$bc_testimonial_page_id."&about_us_id=".$bc_about_us_id;
	$cms_url .= "&contact_email_page_id=".$bc_contact_email_page_id."&in_home_consultation_id=".$bc_in_home_consultation_id;
	$cms_url .= "&faq_id=".$bc_faq_id."&faq_cat_id=".$bc_faq_cat_id;
	$cms_url .= "&guide_tip_id=".$bc_guide_tip_id."&guide_tip_cat_id=".$bc_guide_tip_cat_id;
	$cms_url .= "&download_id=".$bc_download_id."&page_seo_id=".$bc_page_seo_id;
	$cms_url .= "&added_page_id=".$bc_added_page_id."&page_seo_id=".$bc_page_seo_id;
	$bread_crumb->add($page_title, $cms_url);
	$bread_crumb->prune($page_title);
}else{
	$bread_crumb->add($page_title, SITEROOT."/".$manage_dir."/".$current_page);
	$bread_crumb->prune($page_title);
}

	echo $page_title;
		echo "<br />";
		echo $manage_dir;
		echo "<br />";
		echo $current_page;
		echo "<br />";
		echo $order_id;
		exit;
*/


/*user levels:
	Customer = 1
	Anonymous = 2
	Administrator = 3
	Super Administrator = 4

admin access (user function)
 	1 	content management
	2 	order management
	3 	customer management
	4 	cart management
	5 	discount management
	6 	admin user management
	7 	saas customer management

ProfileType
	master
	parent
	non_parent
*/

// lgn is initiated in manage-includes.php


// withou shopping cart, 
//items can only be is_show_in_showroom = '1' is_closet = 1 (is showroom)
// items and cats have no interaction with attributes

/*
if(!$module->hasShoppingCartModule($_SESSION['profile_account_id'])){
	if($current_dir == "catalog" || $current_dir == "ecomsettings"){
		$msg = "You are not currently setup for the shopping cart module. to request a module, <a href='general-admin/add-on-change-request.php'>click here</a> ";
		$header_str =  "Location: ".SITEROOT."/manage/start.php?msg=".$msg;
		header($header_str);		
	}
}

*/

	//$msg = "You are not currently setup for the shopping cart module";




//$user_id = $aLgn->getUserId();


//$user_functions_array = $aLgn->getUserFunctions();

//$user_level = $aLgn->getUserLevel();


?>