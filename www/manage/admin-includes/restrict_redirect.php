<?php
$currentFile = $_SERVER["PHP_SELF"];

$parts = Explode('/', $currentFile);

$current_page = $parts[count($parts) - 1];	
$current_dir = $parts[count($parts) - 2];	
$current_up_dir = $parts[count($parts) - 3];	

$do_redirect = 0;

if(isset($_SESSION['admin_access'])){
	unset($_SESSION['admin_access']);
}

$admin_access->allowAll();

if(!$admin_access->cms_level){
	if($current_up_dir == "cms"){
		$do_redirect = 1;		
	}
}

if(!$admin_access->product_catalog_level){
	if($current_up_dir == "catalog"){
		$do_redirect = 1;		
	}
}

if(!$admin_access->ecommerce_level){
	if($current_dir == "ecomsettings"){
		$do_redirect = 1;		
	}
}

if(!$admin_access->customers_level){
	if($current_up_dir == "order-management"
		|| $current_dir == "customer"){
		$do_redirect = 1;		
	}
}

if(!$admin_access->design_level){
	if($current_up_dir == "design-services"){
		$do_redirect = 1;		
	}
	if($current_page == "design-email.php" || $current_page == "in-home-consult.php"){
		$do_redirect = 1;
	}
}

if(!$admin_access->administration_level){
	if($current_dir == "administration"){
		$do_redirect = 1;		
	}
}

//echo "master_level  ".$admin_access->master_level;

if(!$admin_access->master_level){
	if($current_dir == "master-admin"){
		$do_redirect = 1;		
	}
}

if(!$module->hasAskModule($_SESSION['profile_account_id'])){ 

	// ?
}



if(!$module->hasShoppingCartModule($_SESSION['profile_account_id'])){ 

	// ?
}

if(!$module->hasDesignServicesModule($_SESSION['profile_account_id'])){ 
	if($current_page == "design-email.php" 	
	|| $current_page == "view-design-email.php" 
	|| $current_page == "in-home-consult.php"
	|| $current_page == "view-in-home-consult.php"
	|| $current_page == "design-email-page.php"//will be added to cms pages	
	|| $current_page == "in-home-consultation.php" // in cms pages
	|| $current_page == "we-design-fax.php"//might be added to cms pages	 
	){
		$do_redirect = 1;
	}
}

if(!$module->hasDesignToolModule($_SESSION['profile_account_id'])){ 
	if($current_page == "design-tool-settings.php"){// something like this 	
		$do_redirect = 1;
	}
}

if($profile_type != "master"){
	if($current_dir == "master" || $current_dir == "master-admin"|| $current_dir == "social"){
		$do_redirect = 1;
	}
}


// tmp disabled
if($do_redirect){
	$header_str =  "Location: ".SITEROOT."/manage/start.php?nl=1";
	header($header_str);			
}



?>