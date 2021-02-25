<?php
session_start();

if(strpos($_SERVER['DOCUMENT_ROOT'], '/var/www/') !== false) {
	$site = 'local';
}else{
	$site = 'live';
}


if($site == "local"){

	define('CART_DATABASE', 'ctgtest_CART');
	define('SITE_N_DATABASE', 'ctgtest_N_SITE');		
	define('USER_DATABASE', 'ctgtest_USERS');	

	define("DB_HOST", "database");
	define("DB_USERNAME", 'mstanzzz');
	define("DB_PSWD", 'mstanzzz');
	define('SITEROOT', 'localhost:80');
	
}else{
	
	define('SITE_N_DATABASE', 'ctgtest_N_SITE');		
	define('CART_DATABASE', 'ctgtest_CART');		
	define('USER_DATABASE', 'ctgtest_USERS');	

	define("DB_HOST", "localhost");
	define('DB_USERNAME', 'ctgtest_ctgtest');
	define('DB_PSWD', 'ctgtest01A');	
	define('SITEROOT', 'http://storittek.com');

}

require_once('class.dbcustom.php');
$dbCustom = new DbCustom();

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


//$_SESSION['ret_path'] = "rrrrrrrrr";

?>