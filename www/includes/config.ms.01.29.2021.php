<?php
//$site = 'local';
$site = 'live';

if($site == "local"){
	define("DB_HOST", "database");
	//define("DB_USERNAME", "docker");
	//define("DB_PSWD", 'docker');	

	define("DB_USERNAME", "mstanz");
	define("DB_PSWD", 'mstanz');

	define('SITEROOT', 'localhost:80');
	
}else{

	define("DB_HOST", "localhost");
	define('DB_USERNAME', 'ctgtest_ctgtest');
	define('DB_PSWD', 'ctgtest01A');	

	//define('DB_HOST', 'localhost');	
	//define('DB_USERNAME', 'bridgepo');
	//define('DB_PSWD', 'bridgep01A');
	
	define('SITEROOT', 'http://storittek.com/');

}

define('SITE_N_DATABASE', 'ctgtest_N_SITE');		
define('CART_DATABASE', 'ctgtest_CART');		
define('USER_DATABASE', 'ctgtest_USERS');	


require_once('class.dbcustom.php');
$dbCustom = new DbCustom();
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

//exit;

$_SESSION['profile_account_id'] = 1;	

//$domain = $_SERVER['HTTP_HOST'];
//$domain = str_replace('www.' ,'',$domain);
//$pro = 'https://';
//define('$_SERVER['DOCUMENT_ROOT']', $pro.'www.'.$domain);	

$_SESSION['profile_company'] = '';
$_SESSION['seo'] = 1;
$this_page = explode("/",$_SERVER['PHP_SELF']);
$this_page = end($this_page);
$this_page = str_replace ('.php', '', $this_page);

$resources_goto_ssl = 0;

$pro = 'http://'; 

$_SESSION['is_ssl'] = 0;
$_SESSION['profile_account_id'] = 1; 
$_SESSION['global_url_word'] = '';
$_SESSION['pages'] = array();


?>