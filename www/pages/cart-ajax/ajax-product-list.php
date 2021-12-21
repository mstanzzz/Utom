<?php		
require_once('<?php echo SITEROOT; ?>includes/config.php');
require_once('<?php echo SITEROOT; ?>includes/db_connect.php'); 
require_once('<?php echo SITEROOT; ?>includes/accessory_cart_functions.php');
require_once('<?php echo SITEROOT; ?>includes/class.shopping_cart.php');
require_once('<?php echo SITEROOT; ?>includes/class.price_range_items.php'); 
require_once('<?php echo SITEROOT; ?>includes/class.module.php');
require_once('<?php echo SITEROOT; ?>includes/class.shopping_items_list.php');
$module = new Module;
$shoppingItemsList = new ShoppingItemsList;

$price_range_items = new PriceRangeItems;
$cart = new ShoppingCart;
//www.onlineclosetdesigner.com/pages/cart/ajax-product-list.php?id=39&id_type=category&pagenum=1&sort_type=default&page_rows=6&view_type=list&
//filter_0%5Bname%5D=price&filter_0%5Btitle%5D=Price+Ranges&filter_0%5Btype%5D=range&filter_0%5Btable%5D=item&filter_0%5Bvalues%5D%5B0%5D%5B0%5D=0&filter_0%5Bvalues%5D%5B0%5D%5B1%5D=50
$filter_qstr = (isset($_GET['filter_qstr'])) ? $_GET['filter_qstr'] : '';
//$price_bottom = (isset($_GET['price_bottom'])) ? addslashes($_GET['price_bottom']) : 0;
//$price_top = (isset($_GET['price_top'])) ? addslashes($_GET['price_top']) : 0;

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 1;
$page_rows = (isset($_GET['page_rows'])) ? addslashes($_GET['page_rows']) : 6;
$cat_id = (isset($_GET['cat_id'])) ? addslashes($_GET['cat_id']) : 0;
$brand_id = (isset($_GET['brand_id'])) ? addslashes($_GET['brand_id']) : 0;
$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : '';
$sort_type = (isset($_GET['sort_type'])) ? addslashes($_GET['sort_type']) : "default";
$view_type = (isset($_COOKIE['view_type'])) ? $_COOKIE['view_type'] : "grid";

$itemListData = $shoppingItemsList->getList($cat_id, $brand_id, $search_str, 'default', $pagenum, $page_rows, $view_type, $filter_qstr);

$items = $itemListData['items'];
if($itemListData["items_count"] > 0){
	include('<?php echo SITEROOT; ?>includes/template-product-list.php');
}
else {
	echo "<div class='alert'> No products match your selection. </div>";
}

?>
