<?php
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.admin_login.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/accessory_cart_functions.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.module.php");
require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.category.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_access.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/manage_functions.php");
$aLgn = new AdminLogin;
$module = new Module;
$admin_access = new AdminAccess;
$profile_type = getProfileType();

require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.pages.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.setup_progress.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tool-tip.php"); 
//require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.backup.php"); 
//require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/restrict_redirect.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/login_timeout.php"); 

// remove excess slashes on this url
if(substr_count($_SERVER['REQUEST_URI'] , '//' ) > 0) {	
	$tt = preg_replace('/(\/+)/','/',$_SERVER['REQUEST_URI']);
	header("Location: ".$tt);		
}


function url_origin($s, $use_forwarded_host = false )
{
    $ssl      = (!empty($s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}
function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}
$absolute_url = full_url($_SERVER);
//echo "<hr />";
//echo $absolute_url;
$parts = Explode('/', $absolute_url);

//print_r($parts);
/*
echo "<br />";
echo "<br />";
echo "<br />";
echo "0 ".$parts[0];
echo "<br />";
echo "1 ".$parts[1];
echo "<br />";
echo "2 ".$parts[2];
echo "<br />";
echo "3 ".$parts[3];
echo "<br />";
echo "4 ".$parts[4];
echo "<br />";
echo "5 ".$parts[5];
*/

$lev = count($parts);
if($lev <= 3){
	$ste_root = '../';
}elseif($lev == 4){
	$ste_root = '../../';
}elseif($lev == 5){
	$ste_root = '../../../';	
}elseif($lev == 6){
	$ste_root = '../../../../';	
}elseif($lev == 7){
	$ste_root = '../../../../../';	
}else{
	$ste_root = './';
}

if(strpos($_SERVER['DOCUMENT_ROOT'], '/var/www/') !== false) {
	$ste_root = preg_replace('/(\/+)/','/',$ste_root);
}else{
	$ste_root = SITEROOT.'/';
}


//echo "<br />";
//echo "ste_root:  ".$ste_root;
//echo "<br />";

?>
