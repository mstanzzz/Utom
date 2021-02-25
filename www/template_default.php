<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart_item.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.store_data.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_login.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.seo.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.company.php');

$lgn = new CustomerLogin;
$store_data = new StoreData;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$nav = new Nav;

$company = new Company;
$company_display_info = $company->getCompanyDisplayInfo();
//print_r($company_display_info);
//echo $company_display_info['company_phone'];

$seo = new Seo;
// needed to prevent checkout refresh
$_SESSION['no_order_refreash'] = 0;

$slug =  (isset($_GET['slug'])) ? addslashes($_GET['slug']) : 'home';
$page = $slug;
//echo "<br />";
//echo "page: ".$page;
//echo "<br />";

$seo->setMeta($slug);
// change this back later
//$page = $seo->page_name;

$ret_page =  (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 'home';

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
}else{
	$ste_root = './';
}
$ste_root = preg_replace('/(\/+)/','/',$ste_root);

if(strpos($_SERVER['DOCUMENT_ROOT'], '/var/www/') !== false) {
	$ste_root = preg_replace('/(\/+)/','/',$ste_root);
}else{
	$ste_root = SITEROOT.'/';
}

//echo "<br />";
//echo $ste_root;
//echo "<br />";
//exit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<title>ClosetsToGo</title>
<meta name="description" content="home description">		
<link href="<?php echo $ste_root."app.css" ?>" rel="stylesheet">

<script>

function getScreenWidth(){
	
	var h = $(window).height();
	var w = $(window).width();
	
	alert("------- width:"+w);
	
}

</script>

</head>
<body>
<!--
<a style="float:right; margin:10px;" href="<?php echo $ste_root; ?>home.html"> HOME </a>
<a style="float:right; margin:10px;" href="<?php echo $ste_root; ?>shopping-cart.html"> CART </a>
<a style="float:right; margin:10px;" href="<?php echo $ste_root; ?>shop.html">Shop</a>
<a style="float:right; margin:10px;" href="<?php echo $ste_root; ?>showroom.html">Showroom</a>
<br />
-->
<?php
echo "<hr />";
echo "page: ".$page;
echo "<hr />";

//echo file_exists($_SERVER['DOCUMENT_ROOT']."/pages/controllers/".$page.".php");
if(file_exists($_SERVER['DOCUMENT_ROOT']."/pages/controllers/".$page.".php")){
	require_once($_SERVER['DOCUMENT_ROOT']."/pages/controllers/".$page.".php"); 											
}

if(file_exists($_SERVER['DOCUMENT_ROOT']."/pages/views/".$page.".php")){
	require_once($_SERVER['DOCUMENT_ROOT']."/pages/views/".$page.".php"); 											
}

?>


<script>
function getScreenWidth(){
	var h = $(window).height();
	var w = $(window).width();
	alert("------- width:"+w);
}
</script>
<script src="app.js"></script>

</body>
</html>

 