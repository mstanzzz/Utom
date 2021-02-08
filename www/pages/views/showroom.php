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

$_SESSION['global_url_word'] = "global-word/";

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
<a href="<?php echo "/".$_SESSION['global_url_word']."showroom.html"; ?>">Showroom Home</a>
<br />

<?php			

echo ">>> Top Of Page showroom.php<<<";
echo "<br />";	
echo "cat_id: ".$cat_id;
echo "<br />";
echo "<hr />";
echo "<br />";

if($cat_id == 0){
	$top_cat_array = $nav->getTopCats();
	//print_r($top_cat_array);
	echo "Top Catagories";
	echo "<br />";
	foreach($top_cat_array as $val){
					
		$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
$img = "../../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['img_file_name'];
		
		echo "<br />";
		echo "<a href='".$url_str."'>";
		echo $url_str;
		echo "<br />";
		echo "<br />";		
		echo $val['name'];
		echo "<br />";
		echo "<img src='".$img."' />";		
		echo "</a>";
		echo "<br />";
		echo "<br />";	
		
	}
}else{

	echo "<div style='clear:both;'> </div>";	
	echo "<hr />";
	echo "Sub Cats";
	echo "<br />";		
	echo "<br />";		

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT * 
		FROM category
		WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		echo $object->name;
		echo "<br />";	
		echo $object->img_id;
		echo "<br />";

		$sql = "SELECT file_name 
				FROM image
				WHERE img_id = '".$object->img_id."'";
		$res = $dbCustom->getResult($db,$sql);		
		if($res->num_rows > 0){
			$obj = $res->fetch_object();
$img = "../../saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$obj->file_name;

echo "<br />";
echo "<hr />";
echo ">>>><img height='400' src='".$img."' /><<<<<";
echo "<hr />";

		}
	}

	echo "<br />";
	echo "<br />";
}


if($cat_id > 0){ 			
				
	$sub_cats = $store_data->getSubCatsWithData($cat_id, 'showroom');
	if(count($sub_cats) > 0){
		foreach($sub_cats as $val){
$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');
$img = "../../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['img_file_name'];
			echo "<a href='".$url_str."'>";
			echo $val['name'];
			echo "<br />";
			echo "<img src='".$img."' />";		
			echo "</a>";
			echo "<br />";
			echo "<br />";	
		}
	}


	echo "<br />";	
	echo "<br />";
	echo "<hr />";
	echo "<br />";	
	echo "ITEMS";
	echo "<br />";


	$items_array_showroom = $store_data->getItemDataFromCat($cat_id, 0, 0, 'showroom');
		  
	foreach($items_array_showroom as $val){

		$url_str = $nav->getItemUrl($val['seo_url'], $val['name'], $val['profile_item_id'], '', 'showroom');
		$img = "../../saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
		//echo "<br />";
		//echo "file_name ".$val['file_name'];
		//echo "<br />";
		//echo $img;
		echo "<br />";
		
		//$url_str = "";
		
		echo "<a href='".$url_str."'>".$url_str;
		echo "file_name ".$val['file_name'];	
		echo "<br />";
		echo $val['name'];
		echo "<br />";
		echo "<img src='".$img."' />";		
		echo "</a>";
		echo "<br />";	

	}


}



?>

</body>
</html>
