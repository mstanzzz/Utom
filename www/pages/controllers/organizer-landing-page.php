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

$cat_id = (isset($_GET['CatId']))? $_GET['CatId'] : 0;
if(!is_numeric($cat_id)) $cat_id = 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$items_array = array();

if($cat_id > 0){

	$items_array = $store_data->getItemsFromCat($cat_id);
	//print_r($items_array);

}	

//echo $cat_id;
//exit;

$cat_block = '';
$i = 0;
foreach($items_array as $val){

	if($i == 6) $i = 0;

	$i++;			
	//$url_str = $nav->getCatUrl($val['name'], $val['profile_cat_id'], 'showroom');		
	//$url_str = "showroom-detail-view-category.html";				
	$url_str = "organizer-landing-page.html";		
	$nm = stripSlashes($val['name']);
	$name = get_shorter($nm, 30);

	if($i % 5 == 1){
			
		$img = $ste_root."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
		//$img = "../../images/showroom-1.png";

		$cat_block .= "<div class='col-12 col-lg-6 hidden-box open'>";
		$cat_block .= "<figure class='showroom-block__item'>";
		$cat_block .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
		$cat_block .= "<figcaption class='showroom-block__item--wrapper'>";
		$cat_block .= "<div class='showroom-block__item--content'>";
		$cat_block .= "<h2>Showroom product preview</h2>";
		$cat_block .= "<a href='#' title='' class='link-button'>";
		$cat_block .= "Explore now";
		$cat_block .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
		$cat_block .= "<path id='left-arrow_3_' data-name='left-arrow(3)'"; 
		$cat_block .= " d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z'";
		$cat_block .= " transform='translate(0.001 -4.676)'></path>";
		$cat_block .= "</svg>";
		$cat_block .= "</a>";
		$cat_block .= "<div class='showroom-block__item--images'>";
		$cat_block .= "<img src='../../images/Group174.svg' alt=''>";
		$cat_block .= "<p>/ 275 views</p>";
		$cat_block .= "</div>";
		$cat_block .= "<button class='save-for-idea' data-img-path='images/showroom-1.png' tabindex='0'>";
		$cat_block .= "</button>";
		$cat_block .= "</div>";
		$cat_block .= "</figcaption>";
		$cat_block .= "</figure>";
		$cat_block .= "</div>";
		
	}else{
		$img = $ste_root."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
		//$img = "../../images/showroom-2.png";			

		$cat_block .= "<div class='col-6 col-lg-3 hidden-box open'>";
		$cat_block .= "<figure class='showroom-block__item'>";
		$cat_block .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
		$cat_block .= "<figcaption class='showroom-block__item--wrapper'>";
		$cat_block .= "<div class='showroom-block__item--content'>";
		$cat_block .= "<h2>Showroom product preview</h2>";
		$cat_block .= "<a href='#' title='' class='link-button'>";
		$cat_block .= "Explore now";
		$cat_block .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
		$cat_block .= "<path id='left-arrow_3_' data-name='left-arrow(3)'";
		$cat_block .= " d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z'"; 
		$cat_block .= " transform='translate(0.001 -4.676)'></path>";
		$cat_block .= "</svg>";
		$cat_block .= "</a>";
		$cat_block .= "<div class='showroom-block__item--images'>";
		$cat_block .= "<img src='../../images/Group174.svg' alt=''>";
		$cat_block .= "<p>/ 275 views</p>";
		$cat_block .= "</div>";
		$cat_block .= "<button class='save-for-idea' data-img-path='images/showroom-2.png' tabindex='0'>";
		//<!-- <img src="../../images/icon-save-white.svg" alt="" class="img-fluid"> -->
		$cat_block .= "</button>";
		$cat_block .= "</div>";
		$cat_block .= "</figcaption>";
		$cat_block .= "</figure>";
		$cat_block .= "</div>";

	}
}

//echo $cat_block;

//exit;

?>
