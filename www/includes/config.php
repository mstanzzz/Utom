<?php
session_start();
if(strpos($_SERVER['DOCUMENT_ROOT'], 'xampp')>0){
	$site = 'local';	
}else{
	$site = 'live';
}

if($site == "local"){

	define('CART_DATABASE', 'ctgtest_CART');
	
	define('SITE_DATABASE', 'ctgtest_N_SITE');		

	define('SITE_N_DATABASE', 'ctgtest_N_SITE');		
	define('USER_DATABASE', 'ctgtest_USERS');		
	define("DB_HOST", "127.0.0.1");
	define("DB_USERNAME", 'root');
	define("DB_PSWD", '');
	define("SITEROOT", '/storittek/');
}else{


	define('SITE_DATABASE', 'ctgtest_N_SITE');		

	define('SITE_N_DATABASE', 'ctgtest_N_SITE');		
	define('CART_DATABASE', 'ctgtest_CART');		
	define('USER_DATABASE', 'ctgtest_USERS');	
	define("DB_HOST", "localhost");
	define('DB_USERNAME', 'ctgtest_ctgtest');
	define('DB_PSWD', 'nathannn1A@@');	
	define("SITEROOT", 'https://storittek.com/');
}

$_SESSION['seo'] = 1;
$this_page = explode("/",$_SERVER['PHP_SELF']);
$this_page = end($this_page);
$this_page = str_replace ('.php', '', $this_page);
$resources_goto_ssl = 0;
$pro = 'http://'; 
$_SESSION['is_ssl'] = 0;
$_SESSION['profile_account_id'] = 1; 
$_SESSION['global_url_word'] = '';
$_SESSION['profile_company'] = '';
$_SESSION['pages'] = array();
?>