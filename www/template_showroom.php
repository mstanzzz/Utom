<?php 
require_once('includes/config.php');
require_once('includes/accessory_cart_functions.php');
require_once('includes/class.shopping_cart.php');
require_once('includes/class.shopping_cart_item.php');
require_once("includes/class.store_data.php");
require_once('includes/class.nav.php');
require_once('includes/class.customer_login.php');

$store_data = new StoreData;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$nav = new Nav;
$lgn = new CustomerLogin;

$cat_id = (isset($_GET['cat_id']))? $_GET['cat_id'] : 0;

$profile_cat_id = (isset($_GET['prodCatId']))? $_GET['prodCatId'] : 0;

if($cat_id > 0){
	$profile_cat_id = $store_data->getProfileCatFromCat($cat_id);	
}
if($profile_cat_id > 0){
	$cat_id = $store_data->getCatFromProfileCat($profile_cat_id);	
}
if(!is_numeric($cat_id)) $cat_id = 0;
if(!is_numeric($profile_cat_id)) $profile_cat_id = 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$title = '';
$parent_cat_name = '';

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

</script>
</head>
<body>
<br />
<a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."showroom.html"; ?>">Showroom Home</a>
<br />
<br />
Showrooms
<br />
<br />

<?php			
$imgdir = 'medium';

echo "Top";
echo "<br />";		

if($cat_id == 0){
	$top_cat_array = $nav->getTopCats();
	
	print_r($top_cat_array);
	
	foreach($top_cat_array as $val){
					
		$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
		$img = SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];

		echo "<div style='float:left;'>";	
		echo "<a href='".$url_str."'>";
		echo "<img src='".$img."' />";
		echo "<br />";
		echo $val['name'];
		echo "</div>";
		echo "<br />";
		echo "<br />";	
	}
}

echo "<div style='clear:both;'> </div>";	
echo "<hr />";
echo "Sub";
echo "<br />";		

			
if($cat_id > 0){ 			
				
	$sub_cats = $store_data->getSubCatsWithData($cat_id, "showroom");
	foreach($sub_cats as $val){
					
		$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
		$img = SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];

		echo "<div style='float:left;'>";	
		echo "<a href='".$url_str."'>";
		echo "<img src='".$img."' />";
		echo "<br />";
		echo $val['name'];
		echo "</div>";
		echo "<br />";
		echo "<br />";	

	}
	
	$items_array_showroom = $store_data->getItemDataFromCat($cat_id, 0, 0, 'showroom');
      
	foreach($items_array_showroom as $val){
		$url_str = $nav->getItemUrl($val['seo_url'], $val['name'], $val['profile_item_id'], '', 'showroom');
		
		$img = SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];

		echo "<div style='float:left;'>";	
		echo "<a href='".$url_str."'>";
		echo "<img src='".$img."' />";
		echo "<br />";
		echo $val['name'];
		echo "</div>";
		echo "<br />";
		echo "<br />";	

	}


}
?>

</body>
</html>
