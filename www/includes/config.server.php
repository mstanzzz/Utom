<?php
if(session_id() == ''){
	session_start();
}

date_default_timezone_set('America/Vancouver');

// For the old db
	define("BUY_CLOSE_DB_HOST", "localhost");
	define("BUY_CLOSE_DB_USERNAME", 'buyclose_ctg');
	define("BUY_CLOSE_DB_PSWD", 'toroman1A');
	define('BUY_CLOSE_CTG_DATABASE', 'buyclose_ctg');

$site = 'live';
//$site = 'local';

if($site == "local"){

	define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PSWD", '');
	
	$_SESSION['profile_account_id'] = 1;	
	
}else{

	define('DB_HOST', 'localhost');	
	define('DB_USERNAME', 'ctgtool_ctg_nath');
	define('DB_PSWD', 'nathannn1A@@');

}


	
if($site == "local"){	
	

	define("SITE_N_DATABASE", "otgtotes_SITE");
	define("USER_DATABASE", "otgtotes_USERS");
	define("CART_DATABASE", "otgtotes_CART");
	
	define("SHEETS_DATABASE", "otgtotes_SHEETS");
	
	define('COMPONENTS_DATABASE', 'otgtotes_DESIGN_TOOL');	
	define('CTGCOMPONENTS_DATABASE', 'otgtotes_CTGTOOL');	
	define('DESIGN_DATABASE', 'otgtotes_DESIGN');
	
	define('JOBS_DATABASE', 'otgtotes_JOBS');	
    
}else{

	define('SITE_N_DATABASE', 'ctgtool_SITE');
	define('USER_DATABASE', 'ctgtool_USERS');
	define('CART_DATABASE', 'ctgtool_CART');
	define("SHEETS_DATABASE", "ctgtool_SHEETS");
	//define('DESIGN_DATABASE', 'ctgtool_DESIGN');
	//define('CTGCOMPONENTS_DATABASE', 'ctgtool_CTGTOOL');	
	//define('COMPONENTS_DATABASE', 'ctgtool_DESIGN_TOOL');	
	//define('JOBS_DATABASE', 'ctgtool_JOBS');
	//define('SHOWROOM_DATABASE', 'ctgtool_SHOWROOM');

}


if($site == "local"){	

	$domain = "localhost/designitpro";
	$domain =str_replace('www.' ,'',$domain);

}else{

	$domain = $_SERVER['HTTP_HOST'];
	$domain =str_replace('www.' ,'',$domain);
	
}

//echo $domain;
//exit;

$show_the_no_profile_message = 0;

require_once('class.dbcustom.php');

$dbCustom = new DbCustom();


if(!isset($_SESSION['profile_account_id'])) $_SESSION['profile_account_id'] = 0;

//if($_SESSION['profile_account_id'] == 0){

if(1){

	$db = $dbCustom->getDbConnect(USER_DATABASE);
		
	$sql = "SELECT id, company, is_ssl FROM profile_account WHERE domain_name = '".$domain."'";
		
	$result = $dbCustom->getResult($db,$sql);
		
	//echo $result->num_rows; 	
		
	if($result->num_rows > 0){
			
		$object = $result->fetch_object(); 	
				
				//echo $object->id;
				//echo "<br /><br />";		
				
		$_SESSION['profile_account_id'] = $object->id;
		$_SESSION['profile_company'] = $object->company;			
		$_SESSION['is_ssl'] = $object->is_ssl; 
		
		//$_SESSION['saas_url'] = $object->????; 
		
	}else{			
		$show_the_no_profile_message = 1;
		
	}
}

		//$_SESSION['profile_account_id'] = 1;
		//$_SESSION['profile_company'] = "Closets To Go";			
		//$_SESSION['is_ssl'] = 1; 



if(!isset($_SESSION['profile_company'])) $_SESSION['profile_company'] = '';
if(!isset($_SESSION['seo'])) $_SESSION['seo'] = 1;

if(!isset($_SESSION['has_social_and_blog_module'])){

	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "SELECT id
			FROM profile_account_to_module
			WHERE module_id = '2'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'
			AND hide = '0'";		

	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		$_SESSION['has_social_and_blog_module'] = 1;
	}else{
		$_SESSION['has_social_and_blog_module'] = 0;
	}
}

if(!isset($_SESSION['pages']) || (is_array($_SESSION['pages']) && count($_SESSION['pages']) == 0)){

	

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
				
		$_SESSION['pages'] = array();
		
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
			$_SESSION['pages'][$i]['active'] = $row->active; // these are all 0 right now; where in manage can we set pages as active? 
	
			$i++;
		}
	
}


$this_page = explode("/",$_SERVER['PHP_SELF']);
$this_page = end($this_page);
$this_page = str_replace ('.php', '', $this_page);
//echo $this_page;

$resources_goto_ssl = 0;

$pro = 'http://'; 

$_SESSION['is_ssl'] = 0;

$slug = (isset($_GET['slug'])) ? $_GET['slug'] : '';


/*
if($_SESSION['is_ssl']){


	if(substr_count($_SERVER['REQUEST_URI'], '/manage/') > 0){
		$pro = "https://";
	}		
	if((substr_count($_SERVER['PHP_SELF'], 'send-design') > 0)){
		$pro = "https://";
	}
	if((substr_count($_SERVER['PHP_SELF'], 'reset-password"') > 0)){
		$pro = "https://";
	}
	if((substr_count($_SERVER['PHP_SELF'], 'upload-return') > 0)){
		$pro = "https://";
	}

	if((substr_count($_SERVER['PHP_SELF'], 'resources') > 0)){
		
		foreach($_SESSION['pages'] as $p_val){
			if(($p_val['page_name'] == $slug) || ($p_val['seo_name'] == $slug)){	
				if($p_val["ssl"]){
					$pro = "https://";
					$resources_goto_ssl = 1;				
				}
			}
		}
		
	}else{
		
		foreach($_SESSION['pages'] as $p_val){
			if($p_val['page_name'] == $this_page){	
				if($p_val['ssl']){
					$pro = 'https://';
					$resources_goto_ssl = 1;				
				}
			}
		}	
	}
}


*/



if($site == "local"){	

	$pro = 'http://';
	define('$_SERVER['DOCUMENT_ROOT']', $pro.$domain);

}else{
	$pro = 'https://';
	define('$_SERVER['DOCUMENT_ROOT']', $pro.'www.'.$domain);	
	
}


/*

if(substr_count($domain, '.') > 1){
	define('$_SERVER['DOCUMENT_ROOT']', $pro.$domain);
}else{
	define('$_SERVER['DOCUMENT_ROOT']', $pro.'www.'.$domain);	
}

*/


			

/*
$uri = $_SERVER["REQUEST_URI"];
$uri_array = explode("/",$uri);
print_r($uri_array);
foreach($_SERVER as $val){
	echo $val;
	echo "<br />";
}
echo $_SERVER["PHP_SELF"];
*/




if(!isset($_SESSION['global_url_word']) || !isset($_SESSION['html_title_word'])){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			
	$_SESSION['pages'] = array();
	
	$sql = "SELECT url_word, html_title_word 
			FROM global_seo_words 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
						
	$result = $dbCustom->getResult($db,$sql);
	
	$i = 0;
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$_SESSION['global_url_word'] = $object->url_word;
		$_SESSION['html_title_word'] = $object->html_title_word;	
		if($_SESSION['global_url_word'] != ''){
			$_SESSION['global_url_word'] = $_SESSION['global_url_word']."/";		
		}
	}else{
		$_SESSION['global_url_word'] = ''; 
		$_SESSION['html_title_word'] = '';	
	}
}


if(isset($_GET["costco"])){
	$_SESSION['costco'] = 1;
	setcookie('costco',$_SESSION['costco'],time() + (86400 * 2160), '/');
}
if(!isset($_SESSION['costco'])){
	 $_SESSION['costco'] = 0;
}
if(isset($_COOKIE['costco'])){
	$_SESSION['costco'] = 1;
}

 
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);



if(!isset($_SESSION['anonymous_shopper_id'])){
	if(isset($_COOKIE['anonymous_shopper_id'])){	
		$_SESSION['anonymous_shopper_id'] = $_COOKIE['anonymous_shopper_id'];
	}else{
		$_SESSION['anonymous_shopper_id'] = rand() + rand();
		setcookie('anonymous_shopper_id',$_SESSION['anonymous_shopper_id'],time() + (86400 * 360), '/');
	}
}


if(!isset($_SESSION['ctg_cust_id'])){
	$_SESSION['ctg_cust_id'] = 0;
	
	if(isset($_COOKIE['ctg_cust_id'])){ 
		if(is_numeric($_COOKIE['ctg_cust_id'])){
			$_SESSION['ctg_cust_id'] = $_COOKIE['ctg_cust_id'];	
		}
	}
	
}


if(!isset($_SESSION['customer_logged_in'])){
	$_SESSION['customer_logged_in'] = 0;

	/*
	if(isset($_COOKIE['customer_logged_in'])){ 
		if(is_numeric($_COOKIE['customer_logged_in'])){
			$_SESSION['customer_logged_in'] = $_COOKIE['customer_logged_in'];
		}
	}
	*/
}


//setcookie("customer_logged_in", $_SESSION['customer_logged_in'], time()+(60*60*24), '/');
//setcookie("ctg_cust_id", $_SESSION['ctg_cust_id'], time()+(60*60*24*6), '/');

//if($show_the_no_profile_message){
	//include('no_profile.php');
	//exit;	
	//header('Location: '.$_SERVER['DOCUMENT_ROOT']);
	
//}




if(!isset($_SESSION['user_os']) || !isset($_SESSION['user_browser']) || (!isset($_SESSION['user_ip']))){


   $_SESSION['user_os'] = '';
	$_SESSION['user_browser']  =  '';
	$_SESSION['user_ip'] = '';

/*
	require_once("accessory_cart_functions.php");

	$_SESSION['user_os'] = getOS();
	$_SESSION['user_browser']  =  getBrowser();
	$_SESSION['user_ip'] = getRealIP();


	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "INSERT INTO snif_user
		(os, browser, ip)
		VALUES
		('".$_SESSION['user_os']."','".$_SESSION['user_browser']."','".$_SESSION['user_ip']."' )";
	$result = $dbCustom->getResult($db,$sql);
*/
	
}


$_SESSION['enable_tool'] = 0;
$_SESSION['tool_url'] = $_SERVER['DOCUMENT_ROOT']."/tool-page.html";



/*

unset($_SESSION['logo_file_name']);
unset($_SESSION['header_support_menu_labels']);
unset($_SESSION['navbar_labels']);

unset($_SESSION['footer_nav_labels']);
unset($_SESSION['footer_nav_submenu_labels']);
unset($_SESSION['top_showroom_cats']);
unset($_SESSION['top_cats']);
unset($_SESSION['home_cats_1']);
unset($_SESSION['home_cats_2']);
unset($_SESSION['nav_bar_brands']);
unset($_SESSION['side_nav_labels']);
unset($_SESSION['side_nav_heading']);
unset($_SESSION['side_nav']);
unset($_SESSION['footer_nav_cats']);
unset($_SESSION['footer_nav_brands']);
unset($_SESSION['has_search_box']);

*/

?>