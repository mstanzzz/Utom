<?php
require_once('includes/config.php');
require_once('includes/accessory_cart_functions.php');
require_once('includes/class.customer_login.php');
require_once('includes/class.shopping_cart.php');
require_once('includes/class.shopping_cart_item.php');
require_once('includes/class.like_items.php');
require_once('includes/class.nav.php');
require_once('includes/class.seo.php');
require_once('includes/class.store_data.php');

$store_data = new StoreData;

$seo = new Seo;

$nav = new Nav;
$lgn = new CustomerLogin;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$likes = new LikeItems;

$ts = time();


//echo $_SERVER['DOCUMENT_ROOT'];
//echo "<br />";

$profile_item_id =  (isset($_GET['productId'])) ? $_GET['productId'] : 0;

echo "<br />";
echo "profile_item_id: ".$profile_item_id;
echo "<br />";

$db = $dbCustom->getDbConnect(CART_DATABASE);

$item_name = '';


/*
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
echo "<hr />";
echo $absolute_url;
*/

/*
$parts = Explode('/', $absolute_url);

//print_r($parts);
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


$lev = count($parts);
if($lev <= 3){
	SITEROOT = '../';
}elseif($lev == 4){
	SITEROOT = '<?php echo SITEROOT; ?>';
}elseif($lev == 5){
	SITEROOT = '<?php echo SITEROOT; ?>../';	
}elseif($lev == 6){
	SITEROOT = '<?php echo SITEROOT; ?><?php echo SITEROOT; ?>';	
}else{
	SITEROOT = './';
}
SITEROOT = preg_replace('/(\/+)/','/',SITEROOT);
echo "<br />";
echo SITEROOT;
echo "<br />";
*/

?>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>
function add_item(item_id){

	var qty = 1;
	var addMsg = "1 Item Added";
	alert("item_id "+item_id);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
		  
		alert(data);
		
		$( "#add_to_cart_msg" ).css( "color", "red");
		
		$( "#add_to_cart_msg" ).html(data);
			
		}
	});	
}
</script>
</head>
<body>
<br />
<?php
$item_array = $item->getItem($dbCustom,0,$profile_item_id);
$cart_item_count = $cart->getItemCount();

echo "<a href='#' id='add_".$item_array['item_id']."' onClick=\"add_item('".$item_array['item_id']."')\">Add To Cart</a>";
?>
<br />


<a href="../shopping-cart.html" >
	My Cart (<span id="add_to_cart_msg"></span>)
</a>

<br />
<br />
<h1>Showroom Item Details</h1>
<br />

<?php

echo SITEROOT;
echo "<br />";

$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$item_array['file_name'];

echo "<img height='400' src='".$img."' />";
echo "<hr />";
echo "<br />";
echo "name:  ".$item_array['name'];
echo "<br />";
echo "<br />";
echo "<br />";
echo "description:  ".$item_array['description'];
echo "<br />";
echo "<br />";
echo "<br />";
echo "item_id ".$item_array['item_id'];
echo "<br />";
echo "<br />";
echo "<br />";


?>
