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
require_once('includes/class.shipping.php');

$shipping = new Shipping;
$store_data = new StoreData;
$seo = new Seo;
$nav = new Nav;
$lgn = new CustomerLogin;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$likes = new LikeItems;


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM item_details
		WHERE item_details.item_details_id = (SELECT MAX(item_details_id) 
			FROM about_us WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();

	$top_1 = stripslashes($object->top_1);
	$top_2 = stripslashes($object->top_2);
	$top_3 = stripslashes($object->top_3);
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	$p_2_head = stripslashes($object->p_2_head);
	$p_2_text = stripslashes($object->p_2_text);
	
}else{
	$top_1 = '';
	$top_2 = '';
	$top_3 = '';
	$p_1_head = "";
	$p_1_text = "";
	$p_2_head = "";
	$p_2_text = "";
}






$ts = time();

$profile_item_id =  (isset($_GET['productId'])) ? $_GET['productId'] : 0;

if($profile_item_id == 0){
	$profile_item_id =  (isset($_GET['slug'])) ? $_GET['slug'] : 0;
}

$item_array = $item->getItem(0,$profile_item_id);

$cat_id = 0;

$heading1 = "<h1>";
if($item_array['brand_name'] != '') $heading1 .= $item_array['brand_name'].' ';

$heading1 .= "".trim($item_array['name'])."</h1>";	

$heading2 = "<h2>".strip_tags(trim($item_array['short_description']))."</h2>";

$heading = stripAllSlashes($heading1.$heading2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>

function add_item(item_id){
	
	
	var qty = 1;
	//var qty = $("#qty"+item_id).val();
	
	//alert(item_id+"     "+qty);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/pages/cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
		  
		//alert(data);
		
		
		$("#cart_msg").html(data);

			
		}

	});	

}

</script>

</head>
<body>

<br />
<a href="site-map.php">site-map</a>

<div id="cart_msg" style="float:right; margin:20px;"> </div>

<div style="float:right; margin:20px;">
<a  href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/shopping-cart.html">YOUR CART</a>
</div>




<?php 


echo "<br />";
echo "<br />";

echo "<center>";
echo $heading;
echo "<span style='cursor:pointer' onClick='add_item(".$item_array['item_id'].")' > ADD TO CART </span>";
echo "<br />";
echo "</center>";


<br />
<br />

<?php
	
	echo "top_1: ".$top_1;
?>
<br />
<br />
<?php
	echo "top_2: ".$top_2;
?>
<br />
<br />
<?php
	echo "top_3: ".$top_3;
?>
<br />
<br />
<?php
	echo "p_1_head: ".$p_1_head;
?>
<br />
<br />
<?php
	echo "p_1_text: ".$p_1_text;
?>
<br />
<br />
<?php
	echo "p_2_head: ".$p_2_head;
?>
<br />
<br />
<?php
	echo "p_2_text: ".$p_2_text;
?>
<br />
<br />



echo "<br />";
echo "<hr />";
echo "<br />";
		
echo "Like Items";
echo "<br />";

$likes_array = $likes->getLikesItems($item_array['item_id']);
foreach($likes_array as $value){
	if($value['show_in_cart']){
		$brand_name = getBrandName($value['brand_id']);
		$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], $brand_name, 'shop');
	}else{
		$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], '', 'showroom');
	}


	echo "<a href='".$url_str."'>".$value['name']."</a>";
	echo "<br />";
	echo "<span style='cursor:pointer' onClick='add_item(".$value['item_id'].")' > ADD TO CART </span>";
	echo "<br />";
	echo "<br />";
	
}
echo "<br />";
echo "<hr />";
echo "<br />";
		
echo "Related Categories";
echo "<br />";
$sub_cats = $sub_cats = $store_data->getSubCatsWithData($cat_id, 'cart');
foreach($sub_cats as $sub_cat){	
	$url_str = $nav->getCatUrl($sub_cat['name'], $sub_cat['profile_cat_id'], 'shop');
	echo "<a href='".$url_str."'>".$sub_cat['name']."</a>";
	echo "<br />";
}
?>

</body>
</html>
