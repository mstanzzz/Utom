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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<style>
</style>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>

function getScreenWidth(){	
	var h = $(window).height();
	var w = $(window).width();
	alert("------- width:"+w);
}


function add_item(item_id){

	var qty = 1;
	var addMsg = "1 Item Added";

	alert("item_id "+item_id);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '../../pages/cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
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
$item_array = $item->getItem(0,$profile_item_id);
$cart_item_count = $cart->getItemCount();
echo "<a href='#' id='add_".$item_array['item_id']."' onClick=\"add_item('".$item_array['item_id']."')\">Add To Cart</a>";
?>
<br />


<a href="../shopping-cart.html" >
	My Cart (<span id="add_to_cart_msg"></span>)
</a>
<br />
<br />
<a href="../../">Home</a>
<br />
<h1>Item Details</h1>
<br />

<?php

$img = "../../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$item_array['file_name'];

echo ">>>><img height='400' src='".$img."' /><<<<<";
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



</body>
</html>