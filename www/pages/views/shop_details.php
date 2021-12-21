<?php
require_once('includes/config.php');
//if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
require_once('includes/accessory_cart_functions.php');
//require_once('includes/class.price_range_items.php');	
require_once('includes/class.customer_login.php');
require_once('includes/class.shopping_cart.php');
require_once('includes/class.shopping_cart_item.php');
//require_once('includes/class.shopping_items_list.php');
require_once('includes/class.like_items.php');
require_once('includes/class.discount.php');
require_once('includes/class.design_cart.php');
require_once('includes/class.nav.php');
require_once('includes/class.seo.php');
require_once('includes/class.custom_code.php');
require_once('includes/class.custom_meta_tags.php');
require_once('includes/class.module.php');
require_once('includes/class.store_data.php');
require_once('includes/Mobile_Detect.php');
require_once('includes/class.shipping.php');

$shipping = new Shipping;

//1 phone
//2 tablet
//3 computer
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 2 : 1) : 3);
//$num = 1;
//echo sprintf('%06d', $num);
$store_data = new StoreData;
$module = new Module;
$custom_meta_tags = new CustomMetaTags;
$custom_code = new CustomCode;
$seo = new Seo;
$nav = new Nav;
$lgn = new CustomerLogin;
$design_cart = new DesignCart;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$discount = new Discount;
$likes = new LikeItems;
//$price_range_items = new PriceRangeItems;
$ts = time();
// activate timed discounts if needed  
$db = $dbCustom->getDbConnect(SITE_DATABASE);
$shop_cart_name = getURLFileName('shopping-cart');


/*
$sql = "UPDATE global_discount 
		SET hide = '0' 
		WHERE when_active <= '".$ts."' 
		AND when_expired > '".$ts."' 
		AND hide = '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);// expire timed  discounts if needed  
$sql = "UPDATE global_discount 
		SET hide = '1' 
		WHERE (when_expired > '0'  AND when_expired <= '".$ts."') OR (when_active > '".$ts."')
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
*/



$profile_item_id =  (isset($_GET['productId'])) ? $_GET['productId'] : 0;

if($profile_item_id == 0){
	$profile_item_id =  (isset($_GET['slug'])) ? $_GET['slug'] : 0;
}


$item_array = $item->getItem($dbCustom,0,$profile_item_id);

$db = $dbCustom->getDbConnect(CART_DATABASE);


if(isset($_POST['send_review'])){
	$headline =  (isset($_POST['headline'])) ? addslashes($_POST['headline']) : '';
	$review =  (isset($_POST['review'])) ? addslashes($_POST['review']) : '';
	$name =  (isset($_POST['name'])) ? addslashes($_POST['name']) : '';
	$city =  (isset($_POST['city'])) ? addslashes($_POST['city']) : '';
	$rating =  (isset($_POST['rating'])) ? addslashes($_POST['rating']) : '';
	
	
	
	
	$stmt = $db->prepare("INSERT INTO item_review
					   (headline
						,review
						,name
						,city
						,item_id
						,rating
						,publish_date
						,profile_account_id)
					VALUES		
					(?,?,?,?,?,?,?,?)"); 
	
	
			if(!$stmt->bind_param("ssssiiii",
				$headline		
				,$review
				,$name
				,$city
				,$item_array['item_id']
				,$rating
				,$ts	
				,$_SESSION['profile_account_id'])){
					
					
			//echo 'Error '.$db->error;
		
		}else{
			$stmt->execute();
			$stmt->close();
		}
	
		
}


function item_has_opt($item_id, $opt_id, $dbCustom){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_to_opt_id
			FROM item_to_opt
			WHERE opt_id = '".$opt_id."'
			AND item_id = '".$item_id."'";
	$res = $dbCustom->getResult($db,$sql);
	return $res->num_rows; 
	
}

function getParentMainAttr($parent_item_id, $dbCustom){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT main_attr_id
			FROM item
			WHERE item_id = '".$parent_item_id."'";
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){
		$obj = $res->fetch_object();
		return $obj->main_attr_id;  
	}
	return 0;
	
}



function getParentUrl($parent_item_id, $nav, $dbCustom){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name, seo_url, brand_id, profile_item_id  
			FROM item
			WHERE item_id = '".$parent_item_id."'";
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){
		$obj = $res->fetch_object();
		$brand_id = $obj->brand_id;
		$seo_url = $obj->seo_url;
		$name = $obj->name;
		$profile_item_id = $obj->profile_item_id;   
	}else{
		$brand_id = 0;
		$seo_url = '';
		$profile_item_id = 0;   		
	}

	$sql = "SELECT name  
			FROM brand
			WHERE brand_id = '".$brand_id."'";
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){
		$obj = $res->fetch_object();
		$brand_name = $obj->name;
	}else{
		$brand_name = '';
	}

	return $nav->getItemUrl($seo_url, $name, $profile_item_id, $brand_name, 'shop');
}

$item_is_child = 0;
$item_has_children = 0;
$main_attr_id = $item_array['main_attr_id'];


//print_r($item_array);


$top_item_id = ($item_array['parent_item_id'] > 0) ? $item_array['parent_item_id'] : $item_array['item_id']; 

if($top_item_id == 0) $top_item_id = -1;


if($item_array['parent_item_id'] > 0){
	$item_is_child = 1;	
	$main_attr_id = getParentMainAttr($item_array['parent_item_id'], $dbCustom);

}

//echo "main_attr_id:  ".$main_attr_id;
//echo "<br />";

//echo $item_array['parent_item_id']."   ".$item_array['name']."   ".$top_item_id;


$parent_url = getParentUrl($top_item_id, $nav, $dbCustom);


$attr_array = array();		
$all_items_array = array();
$opt_array = array();
	
$db = $dbCustom->getDbConnect(CART_DATABASE);
        
$sql = "SELECT item_id
        FROM item
        WHERE parent_item_id = '".$top_item_id."'";

$result = $dbCustom->getResult($db,$sql);
                
				
$i = 0;
$j = 0;
$k = 0;

$attr_block = '';
$all_items_array[$j] = $item_array['item_id'];			
                
if($result->num_rows > 0){	
    
	//echo "rows".$result->num_rows;
	                            
	while($row = $result->fetch_object()){
	                
		$j++;
        $all_items_array[$j] = $row->item_id;				
        $sql = "SELECT attribute.attribute_id
                      ,attribute.attribute_name						
                FROM  attribute, opt, item_to_opt
                WHERE opt.attribute_id = attribute.attribute_id
                AND item_to_opt.opt_id = opt.opt_id
                AND item_to_opt.item_id = '".$row->item_id."'
                ORDER BY attribute_id";
         $res = $dbCustom->getResult($db,$sql);
                    
         while($attr_row = $res->fetch_object()) {                            
			$attr_array[$i]['attr_id'] = $attr_row->attribute_id;
			$attr_array[$i]['attr_name'] = $attr_row->attribute_name;
			
			$i++;

		}
	}
        
	if(count($attr_array) > 1){
		$attr_array = multi_unique($attr_array);
    }
	
	
}

    
        
$remain_array = array();
$new_array = array();
$i = 0;
if(count($attr_array) > 1){
	foreach($attr_array as $attr_v){
    	if($attr_v['attr_id'] == $main_attr_id){
			//break the array and start here in new array 	
            $new_array[$i]['attr_id'] = $attr_v['attr_id'];
            $new_array[$i]['attr_name'] = $attr_v['attr_name'];
		}else{
			$remain_array[$i]['attr_id'] = $attr_v['attr_id'];
            $remain_array[$i]['attr_name'] = $attr_v['attr_name'];
		}
		$i++;
	}
	
	$attr_array = array_merge($new_array, $remain_array);        

}
                



//echo "<br />";
//echo "count: ".count($attr_array);
    
//echo "<br />";
//echo count($all_items_array);

        
if(count($all_items_array) > 1 && count($attr_array) > 0){
                    
	$i = 0;
                    
	foreach($attr_array as $attr_v) {
                    
		foreach($all_items_array as $all_item_v){		
                    
        	$sql = "SELECT opt.opt_id, opt.opt_name
            		FROM  opt, item_to_opt
                    WHERE item_to_opt.opt_id = opt.opt_id
                    AND item_to_opt.item_id = '".$all_item_v."'						
                    AND opt.attribute_id = '".$attr_v['attr_id']."'";
			$opt_res = $dbCustom->getResult($db,$sql);                    
            
			if($opt_res->num_rows > 0){
				$opt_obj = $opt_res->fetch_object();
                $opt_array[$k]['opt_id'] = $opt_obj->opt_id;
                $opt_array[$k]['opt_name'] = $opt_obj->opt_name;
                $k++;                       
            }
		}
                                    
		if(count($opt_array) > 1){
        	$opt_array = multi_unique($opt_array);
        }
						
		//if($i < 2){
		if($i == 0 || $item_is_child){				
			$attr_block .= "<div style='margin-bottom: 4px;  margin-right:8px; float:left;'>";	
		}else{
			$attr_block .= "<div class='hidden' style='height: 1px;'>";
		}
				
        $attr_block .= "<div class='selector_label'>Select ".$attr_v['attr_name']."</div>";
        $attr_block .= "<select class='selector'  id='".$attr_v['attr_id']."' onchange='change_attrs(".$attr_v['attr_id'].");' name='attr_".$attr_v['attr_id']."' >";		
		
		//$attr_block .= "<option value='0'>Select ".$attr_v['attr_name']."</option>";
		$attr_block .= "<option value='0'>Select </option>";
                        
        foreach($opt_array as $opt){
			
			$sel = '';
			
			if($item_is_child){
				if(item_has_opt($item_array['item_id'], $opt['opt_id'], $dbCustom)){
					$sel = 'selected';	
				}				
			}
			/* this does not work because the second selector can have options that don't go with this selected option 
			if($attr_v['attr_id'] == $item_array['main_attr_id']){
				if(item_has_opt($top_item_id, $opt['opt_id'], $dbCustom)){
					$sel = 'selected';	
				}				
			}
			*/
			
        	$attr_block .= "<option value='".$opt['opt_id']."' $sel>".stripslashes($opt['opt_name'])."</option>";
		}
                    
        $opt_array = array();
                        
        $attr_block .= "</select>";
        
        $attr_block .= "</div>";
		
        
        $i++;
	}
	
	
	if($item_is_child){
	
	
		$attr_block .= "<div style='clear:both;'></div>";
		$attr_block .= "<div style='float:left; margin-top:2.5%; color:red; font-size:14px;'>*To change your selection, please click the reset button.<br />";
		$attr_block .= "<a class='btn' href='#' onclick='re_load(1)'>Reset</a>";
		$attr_block .= "</div>";
		$attr_block .= "<div style='clear:both;'></div>";

	
	}
	
	
}




//echo $shipping->getShipType();
//echo "<br />";
//echo $item_array['weight'];
//echo "<br />";
//echo $item_array['is_free_shipping'];
//exit;


$has_add_btn = has_add_to_cart_btn($module->hasShoppingCartModule($_SESSION['profile_account_id'])
					,$item_array['call_for_pricing']
					,$item_array['price']
					,$shipping->getShipType()
					,$item_array['weight']
					,$item_array['is_free_shipping']
					,$item_array['show_atc_btn_or_cfp']);

/*						
if($module->hasShoppingCartModule($_SESSION['profile_account_id'])  
	&& !$item_array['call_for_pricing'] 
	&& $item_array['price'] > 0
	&& ((!($shipping->getShipType() == 'carrier' && $item_array['weight'] == 0)) || $item_array['is_free_shipping'])
	&& $item_array['show_atc_btn_or_cfp'] > 0){


						
	$has_add_btn = 1;

}else{
	$has_add_btn = 0;	
}
*/


/*
echo "has sc: ".$module->hasShoppingCartModule($_SESSION['profile_account_id']);
echo "<br />";
echo "show_atc_btn_or_cfp ".$item_array['show_atc_btn_or_cfp'];
echo "<br />";
echo "call_for_pricing ".$item_array['call_for_pricing'];
echo "<br />";
echo "price ".$item_array['price'];
echo "<br />";
echo "ShipType ".$shipping->getShipType();
echo "<br />";
echo "weight ".$item_array['weight'];
echo "<br />";
echo "is_free_shipping ".$item_array['is_free_shipping'];
echo "<br />";
*/


require_once('includes/class.bread_crumb.php');	
$bread_crumb = new BreadCrumb;
$title = '';
$cat_id = 0;

$bc_data_out = explode('|',$item_array['seo_list']);
$bread_crumb->reSetToHome();
if(isset($bc_data_out[0])){
	$bc_data_in = explode(',',$bc_data_out[0]);
	if(count($bc_data_in) > 2){
		$bc_profile_cat_id = 0;
		$bc_seo_name = '';
		$bc_seo_url = '';
		if(isset($bc_data_in[0])){
			if(is_numeric($bc_data_in[0])){
				$bc_profile_cat_id = $bc_data_in[0];
			}
		}
		if(isset($bc_data_in[1])){
			if(is_numeric($bc_data_in[1])){
				$bc_cat_id = $bc_data_in[1];
				$cat_id = $bc_cat_id;
			}
		}
		if(isset($bc_data_in[2])){
			$bc_seo_name = strtolower($bc_data_in[2]);
			$bc_seo_name = str_replace('-',' ',$bc_seo_name);			
		}
		
		$title = $bc_seo_name.' '.$title;
		//$title = $title.', '.$bc_seo_name;		
		if(isset($bc_data_in[3])){
			$bc_seo_url = $bc_data_in[3];
		}
		if($bc_seo_url != '') $bc_seo_url.='/';
		if($bc_profile_cat_id > 0){	
		
			$url_str = $nav->getCatUrl($bc_seo_name,$bc_profile_cat_id,'shop');
			$bread_crumb->add(strtolower($bc_seo_name), $url_str);
			//$bread_crumb->add(strtolower($bc_seo_name), SITEROOT.'/'.$_SESSION['global_url_word'].$bc_seo_url.'category.html?prodCatId='.$bc_profile_cat_id);
		}
	}
}
$bc_name = stripAllSlashes($item_array['name']);
$url_str = $nav->getItemUrl($item_array['seo_url'], $bc_name, $profile_item_id, $item_array['brand_name'], 'shop');

$bread_crumb->add(strtolower($bc_name), $url_str);

$canonical_url = $url_str;

//$bread_crumb->add(strtolower($bc_name), SITEROOT.'/'.$_SESSION['global_url_word'].$item_array['seo_url'].'/product.html?productId='.$profile_item_id);


/*
if($bread_crumb->getLength() > 100){
	$bread_crumb->removeByIndex(1);		
}
*/
$title = $item_array['name'].' '.$title;
if($item_array['brand_name'] != ''){
	$title = $item_array['brand_name'].' '.$title;	
}
if($title == ''){
	$title = $seo->title;
}
$title = stripAllSlashes($title);
$seo->setMeta('item-details', 1);
if($title == ''){
	$title = $seo->title;
}

$heading1 = "<h1>";
if($item_array['brand_name'] != '') $heading1 .= $item_array['brand_name'].' ';

$heading1 .= "".trim($item_array['name'])."</h1>";	

$heading2 = "<h2>".strip_tags(trim($item_array['short_description']))."</h2>";

$heading = stripAllSlashes($heading1.$heading2);

if($item_array['short_description'] != ''){	
	$meta_description = $item_array['short_description'];
}elseif($item_array['description'] != ''){
	$meta_description = $item_array['description'];
}else{
	$meta_description = $seo->description;	
}

if($item_array['key_words'] != ''){	
	$meta_key_words = $item_array['key_words'];
}else{
	$meta_key_words = $seo->keywords;	
}

/*
echo $item_array['description'];
echo "<br />";
echo $item_array['short_description'];
echo "<br />";
echo $seo->description;
echo "<br />";
echo $item_array['key_words'];
echo "<br />";
echo $seo->keywords;
*/

$meta_description = substr($meta_description, 0 , 160);

$title = str_replace("\"", '', $title);
$title = ucwords($title);

$meta_key_words = strip_tags($meta_key_words);
$meta_key_words = str_replace("\"", '', $meta_key_words);
$meta_description = strip_tags($meta_description);
$meta_description = str_replace("\"", '', $meta_description);

if(!$module->hasSeoModule($_SESSION['profile_account_id'])){
	$title = '';
	$meta_key_words = '';
	$meta_description = '';	
}

//$canonical_url = $c_obj->canonical_part.'/category.html?prodCatId='.$profile_cat_id;

//SITEROOT.'/'.$_SESSION['global_url_word'].$item_array['canonical_part'].'/product.html?productId='.$profile_item_id

//$canonical_url = $item_array['canonical_part'].'/product.html?productId='.$profile_item_id;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo stripAllSlashes($title).' '.$_SESSION['html_title_word']; ?></title>
<meta name="keywords" content="<?php echo stripAllSlashes($meta_key_words); ?>" />
<meta name="description" content="<?php echo stripAllSlashes($meta_description); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if($module->hasSeoModule($_SESSION['profile_account_id'])){
	echo $custom_meta_tags->getCustomMetaTagsBlock(); 
}
?>

<link href="<?php echo $canonical_url; ?>" rel="canonical">


<link href="<?php echo SITEROOT; ?>css/base_comp.css" rel="stylesheet">
<link href="<?php echo SITEROOT; ?>css/responsive_comp.css?v=1.1.2" rel="stylesheet">

<!--
<link href="<?php //echo SITEROOT; ?>/css/base.css" rel="stylesheet">
<link href="<?php //echo SITEROOT; ?>/css/responsive.min.css" rel="stylesheet">
<link href="<?php //echo SITEROOT; ?>/css/responsive.css" rel="stylesheet">
-->
<link href="<?php echo SITEROOT; ?>js/fancybox2/source/jquery.fancybox.css?v=2.1.4" rel="stylesheet">



<link type="text/css" rel="stylesheet" media="all" href="<?php echo SITEROOT; ?>css/mmenu.min.css" />

<link type="text/css" rel="stylesheet" media="all" href="<?php echo SITEROOT; ?>css/forms.css" />
<!--
<link type="text/css" rel="stylesheet" media="all" href="<?php //echo SITEROOT; ?>/css/mmenu.css" />
-->

<!--
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
-->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

<style>


h1 {
    font-size: 29px;
    line-height: 32px !important;
	margn-bottom: 0px !important;
}

h2 {
	font-size: 20px;
    line-height: 23px !important;
	margn-top: 0px !important;
}

.selector{
	border-style:solid; 
	border-width:medium; 
	border-color:#0CC;
	width:auto;
	min-width:100px;
	margin-right:10px;
}

.selector_label{
	margin-top:8px;
	font-size:18px;	
	
}

.assoc_item_box{

	float:left;
			
  height: 380px;	
  width: 240px;
 
  background-color: #f9f9f9;
  
  border-radius: 4px;
  border-bottom: 1px solid #e2e2e2;
  padding: 10px;
  margin-top: 20px;
  margin-bottom:20px;
  margin-right:10px !important;
  margin-left:10px !important;
	  
}


.assoc_item_box .product-image {
  border: 3px solid #ffffff;
  display: block;
  /* overflow: hidden; */
  
  border-radius: 4px;
  -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  -moz-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
}

.assoc_item_box .product-image a {
  display: block;
}

.assoc_item_box .product-image img {
  width: 100%;
  height: auto;
}

.assoc_item_box:hover {
  background-color: #e3ecde;
  border-bottom: 1px solid #c8d9be;
}

.assoc_item_box h3 {
  line-height: 1.2em;
  margin-top: 8px;;
  
  margin-bottom: .8em;
  font-size:18px;
  font-weight: 100;
  color: #494949;
  letter-spacing: .05em;
}

.assoc_item_box h5 {
  line-height: 1.2em;
  margin-bottom: .1em;
  margin-top: 0;  
  font-weight: lighter;
  color: #494949;
  letter-spacing: .05em;
}

.assoc_item_box .btn.add-to-cart {
	float:right;
}

.assoc_item_box .qty input {
  width: 25px;
  float:left;
}



/*
.lower_link_box{
  float:left;			
  height: 280px;	
  width: 240px;
 
  background-color: #f9f9f9;
  
  border-radius: 4px;
  border-bottom: 1px solid #e2e2e2;
  padding: 10px;
  margin-top: 20px;
  margin-bottom:20px;
  margin-right:10px;
  margin-left:10px;
	  
}

.lower_link_box:hover {
  background-color: #e3ecde;
  border-bottom: 1px solid #c8d9be;
}

.btn-lower_link {
	
	width:220px;
	margin-top:16px;	
	
}

*/


/*
@media only screen and (max-width : 480px) {
	.assoc_item_box{
	  height: 340px;	
	  width: 142px;
	}

	.assoc_item_box .btn.add-to-cart {
		float:left;
		margin-top:8px;
	}
}

*/


/*
.assoc_outer_box{
	
	width:500px;
	height:340px;
	margin-bottom:20px;
}
.assoc_img_container{
	
	width:240px;	
	float:left;
	border:thin;
}

.assoc_name{
	
	padding-top:10px;
	padding-right:16px;	
	float:left; 
	font-size:22px;
	line-height:26px;
	width:200px;	
}
				
.add-to-cart-assoc{
	
	width:210px; 
	margin-top:10px;
	
}

*/

.list_head{
	font-size:18px;
	margin-left:0px;
}


@media screen and (max-width: 1240px) {

/*
	.assoc_name{
		
		padding-top:10px;
		padding-right:16px;	
		float:left; 
		font-size:18px;
		line-height:26px;
		width:160px;
		
	}
	
*/	
	
	.list_head{
		font-size:16px;
		margin-left:0px;
	}
	
	
}

@media screen and (max-width: 585px) {
	
/*	
	.assoc_name{
		
		padding-top:10px;
		padding-right:16px;	
		float:left; 
		font-size:18px;
		line-height:26px;
		width:160px;
		
	}
*/
	
	.list_head{
		font-size:16px;
		margin-left:0px;
	}

	
}

@media only screen and (max-width : 480px) {
	
/*
	.assoc_outer_box{
		
		width:380px;
		height:260px;
		margin-bottom:20px;
	}

	.assoc_img_container{
		
		width:160px;	
		float:left;
		border:thin;
	}
	
	.assoc_name{
		
		padding-top:10px;
		padding-right:16px;	
		float:left; 
		font-size:18px;
		line-height:26px;
		width:160px;
		
	}
	
	.add-to-cart-assoc{
		
		width:100px; 
		margin-top:10px;
		
	}
*/
	
	.list_head{
		font-size:16px;
		margin-left:0px;
	}

	
	
}

</style>


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- Cross-Browser Adjustments for graceful degradation; remove per version as support drops -->
<!--[if IE 7]>
      <link href="<?php echo SITEROOT; ?>css/ie.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 8]>
      <link href="<?php echo SITEROOT; ?>css/ie8.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 9]>
      <link href="<?php echo SITEROOT; ?>css/ie9.css" rel="stylesheet">
    <![endif]-->
<?php 
if($module->hasSeoModule($_SESSION['profile_account_id'])){
	echo $custom_code->head_block; 
}
$cartLink = SITEROOT."//".$_SESSION['global_url_word']."/shopping-cart.html";

$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'medium' : 'medium') : 'large');
?>

<!--
<script type="text/javascript" src="<?php //echo SITEROOT;?>/js/ctg_form_validation.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

-->


<!--
<script type="text/javascript" language="javascript" src="<?php echo SITEROOT; ?>js/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!--
<script type="text/javascript" language="javascript" src="<?php echo SITEROOT; ?>js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
-->

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo SITEROOT; ?>js/fancybox2/source/jquery.fancybox.pack.js?v=2.1"></script>

<script type="text/javascript" language="javascript" src="<?php echo SITEROOT; ?>js/components.js"></script> 


<script>

function add_item(){

		var qty = $("#qty").val();

		var addMsg = '';	
		var str = '';
		var elem = document.getElementById('add_to_cart_form').elements;

	    for(var i = 0; i < elem.length; i++)
        {
			str += elem[i].name.replace("attr_", '');
            str += "|" + elem[i].value + "---";
        } 

		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '<?php echo SITEROOT; ?>pages/cart/ajax-add-item-multi-attr.php?attr_opts='+str+'&qty='+qty+'&top_item_id=<?php echo $top_item_id; ?>',
		  success: function(data) {	
		  	if(data == "gt" || data == "lt"){				
				$('#heading').html("There are no products that have the selected options");	
			}else{
				addMsg = "The item was added to your cart";
		  		
				$("#ret_sc_block").html(data);
				
				<?php //if($item_is_child == 0 && $item_has_children == 0){ ?>
				
				$("#add_to_cart").removeClass("btn-success").text("View Cart");
				
				$("#add_to_cart").attr("onclick",'').attr("href","<?php echo $cartLink; ?>");
				
				<?php //} ?>
				
				
			}
			
		  }

		});	

}

/*
function show_pic(item_id){
	$.ajaxSetup({ cache: false}); 
	$.ajax({			
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-pic.php?item_id='+item_id+'&deviceType=<?php echo $deviceType; ?>',
		success: function(data) {
			//alert(data);
			
			$('#show_pic').html($.trim(data));
				
		}
	});
}
*/
function show_gallery(item_id){
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-gallery.php?item_id='+item_id+'&deviceType=<?php echo $deviceType; ?>',
		success: function(data) {
			//alert(data);
			$('#thumbnails_box').html($.trim(data));
			if (data != ''){$("#show_pic").addClass("has-alternate-images");}
			initializeSwitcher();
		}
	});
}




function re_load(parent){
	if(parent){
		window.location = "<?php echo $parent_url; ?>";
	}else{
		window.location.reload();	
	}
}


// for debugging
/*
function change_attrs(trigger_attr){
	
	var msg = '';
	var str = '';
    var elem = document.getElementById('add_to_cart_form').elements;
	var main_attr_id = <?php //echo $main_attr_id; ?>
	
	var trigger_option = $("#"+trigger_attr).val();
	
	alert(trigger_attr);

    for(var i = 0; i < elem.length; i++)
    {
		str += elem[i].name.replace("attr_", "");
        str += "|" + elem[i].value + "---";
    } 
	

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php //echo SITEROOT; ?>/pages/cart/ajax-set-details-attr.php?trigger_option='+trigger_option+'&trigger_attr='+trigger_attr+'&top_item_id=<?php //echo $top_item_id; ?>&main_attr_id='+main_attr_id+'&attr_opts='+str,
		success: function(data) {
			alert(data);
		
			$('#attr_box').html(data);		
		}
	});

}

*/

function change_attrs(trigger_attr){
	
	var msg = '';
	var str = '';
    var elem = document.getElementById('add_to_cart_form').elements;
	var main_attr_id = <?php echo $main_attr_id; ?>
	
	var trigger_option = $("#"+trigger_attr).val();

    for(var i = 0; i < elem.length; i++)
    {
		str += elem[i].name.replace("attr_", "");
        str += "|" + elem[i].value + "---";
    } 

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-attr.php?trigger_option='+trigger_option+'&trigger_attr='+trigger_attr+'&top_item_id=<?php echo $top_item_id; ?>&main_attr_id='+main_attr_id+'&attr_opts='+str+'&deviceType=<?php echo $deviceType; ?>',
		dataType: "json"
	}).done(function(data) {
		$('#attr_box').html(data.block);
	
		if(data.num_items == 0){
			msg = "Please select an option from each list or try a different combination";
			$('#heading').html("There are no products that have the selected options");
		}
	
		if(data.ret_item_id > 0){
			show_tabs_and_review(data.ret_item_id);
			show_gallery(data.ret_item_id);
			set_kit_assoc_area(data.ret_item_id);	
			
			$('#show_pic').html(data.pic_str);		
			$('#heading').html(data.heading);
			$('#main_price').html(data.price_data);	
			$("#main_add_btn").html(data.btn_data);		
			$("#add_to_cart").show();
			$("#add_to_cart").addClass("btn-success");
					
		}else{
			$("#add_to_cart").hide();
		}

		$("#msg").html(msg);
	
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});
}


function show_tabs_and_review(item_id){	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-tabs-and-review.php?item_id='+item_id,
		dataType: "json"
	}).done(function(data) {
		$('#review_overview_box').html(data.overview_block);
		$('#tabbed_content_box').html(data.tabs_block);
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );	});
}


/*
function show_heading(item_id){	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-heading.php?item_id='+item_id,
		success: function(data) {
			$('#heading').html(data);	
		}
	});
}
*/

/*
function show_price(item_id){
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-set-details-price.php?item_id='+item_id+'&deviceType=<?php echo $deviceType; ?>',
		dataType: "json"
	}).done(function(data) {
		
		//alert(data.price_data);
		//alert(data.btn_data);
		
		$('#main_price').html(data.price_data);	

		$("#main_add_btn").html(data.btn_data);
	
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});
	
}
*/

function set_kit_assoc_area(item_id){
	var url_str = "<?php echo SITEROOT; ?>pages/cart/ajax-set-kit-assoc-area.php";
	url_str += "?item_id="+item_id+"&top_is_kit=<?php echo $item_array['is_kit']; ?>&top_item_id=<?php echo $top_item_id; ?>";
	url_str += "&show_associated_kits=<?php echo $item_array['show_associated_kits']; ?>&show_videos=<?php echo $item_array['show_videos']; ?>";
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		success: function(data) {
			
			var d = jQuery.trim(data); 
			
			if(d != ""){
				$('#kit_assoc_area').html(d);	
			}
				
		}
	});
}

/*
function add_assoc_item(item_id){
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php //echo SITEROOT; ?>/pages/cart/ajax-add-item.php?item_id='+item_id,
		dataType: "json"
	}).done(function(data) {
		$('#ret_sc_block').html(data.ret_sc_block);
		$("#add_assoc_"+item_id).removeClass("btn-success").text("Added");

	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});
	
}
*/

/*
function add_assoc_item(item_id){

	var qty = $("#qty"+item_id).val();
	var addMsg = (qty > 1) ? qty+" Items Added" : "1 Item Added";
   
   alert(qty);
   
   alert(item_id);
   
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '<?php echo SITEROOT; ?>pages/cart/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
	  dataType: "json"
		  
	}).done(function(data) {
			
			  alert(data.test);
		$("#ret_sc_block").html(data.ret_sc_block);
		$(".add-to-cart.btn#add_"+item_id).removeClass("btn-success").text("View Cart").attr("onclick",'').attr("href","<?php echo $cartLink; ?>").siblings(".qty").html(addMsg);
		
			  
	}).fail(function(jqXHR, textStatus) {
					
				alert(textStatus);
				
					//console.log( "Request failed: " + textStatus );
	});
	
}

*/


function add_assoc_item(item_id){

	var qty = $("#qty"+item_id).val();
	var addMsg = (qty > 1) ? qty+" Items Added" : "1 Item Added";

	//alert("v"+item_id+"     "+qty);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>pages/cart/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
		  
		//alert(data);
		
		$("#ret_sc_block").html(data);
		  
		$(".add-to-cart.btn#add_"+item_id).removeClass("btn-success").text("View Cart").attr("onclick",'').attr("href","<?php echo $cartLink; ?>").siblings(".qty").html(addMsg);
			
		}

	});	
	
}




function swap_video(youtube_id){
	
	//alert(youtube_id);
	
	var v_url = "https://www.youtube.com/embed/"+youtube_id;
	
	$.fancybox({
        href : v_url,
    	type : 'iframe'
    });
	
	
	
}


function view_walkin_form(){
	
	var str = $('#walkin').val(); 	
	$('#view_form').html(str);
}


function view_reachin_form(){
	
	var str = $('#reachin').val(); 	
	$('#view_form').html(str);
}

function test_this(test){
	
	alert("t");
	
	alert(test);
}



function validate_design_request(){
	
	var first_name = $.trim($("#first_name").val());
	var last_name = $.trim($("#last_name").val());
	var email = $.trim($("#email").val());
	//var phone = $.trim($("#phone").val());
	var zip = $.trim($("#zip").val());
	
	var ret = 1;
	
		
	if(first_name == ""){
		$('#first_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#f_msg').html("<div style='color:#F00; font-size:14px; position:relative; top:-14px;'>Please enter your first name.</div>");

		return 0;
	}else{
		$('#first_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#f_msg').html("");	
	}

	if(last_name == ""){
		$('#last_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#f_msg').html("<div style='color:#F00; font-size:14px; position:relative; top:-14px;'>Please enter your last name.</div>");

		return 0;
	}else{
		$('#last_name').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#f_msg').html("");	
	}
 
			
		
	if(!isValidEmail(email)){
		$('#email').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#f_msg').html("<div style='color:#F00; font-size:14px; position:relative; top:-14px;'>Please enter a valid email address.</div>");
		return 0;
		
	}else{
		$('#email').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
			
		$('#f_msg').html("");	
	}
	

	if(zip.length < 5){
		$('#zip').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
					});
		$('#f_msg').html("<div style='color:#F00; font-size:14px; position:relative; top:-14px;'>Please enter a valid zip code.</div>");
		return 0;
		
	}else{
		$('#zip').css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
					});
		$('#f_msg').html("");	
	}
	
		
	return 1;

}




function design_request_submit(){
	
	if(validate_design_request()){
		document.form.submit();
	}
		
	
}


/*
function setActiveTab(){	
	$(".nav-tabs li").removeClass("active");
	$(".tab-content div").removeClass("active");
	$("#reviews").addClass("active");	
	$(".nav-tabs li.reviews").addClass("active");	
}

*/

</script>


<?php 

echo $custom_code->body_block; 

include('includes/google_analytics.php');

//echo "<a href='#' onClick='test_this(\"ttttttt\");'>TEST</a>";

?>

</head>
<body>
<?php 
require_once('includes/google_tag_manager.php');
require_once('includes/header_interim.php');	
//require_once('includes/header.php');	

require_once('includes/nav_interim.php');

//require_once('includes/nav.php');
//require_once('includes/combo_header.php'); 

?>
<div class="container page-content" >




	<?php   
		echo $bread_crumb->output();
    ?>
	<section class="row">
		
        <div class="span6" >
			<?php
				if($item_array['show_in_showroom']){
					$url_str = $nav->getItemUrl($item_array['seo_url'], $item_array['name'], $item_array['profile_item_id'], '', 'showroom');	
					echo "<div style='float:right; margin-right:1%;'><a href=".$url_str." class='btn btn-success btn-large'>View In Showroom</a></div><br />";
				}
				?>
            <div id="heading" style="padding-bottom:0px; margin-bottom:0px;">
				<?php 
				echo $heading;
				?>
            </div>
        	
            <div id="attr_box" >
                <form id="add_to_cart_form" name="add_to_cart_form" action='' method="post" enctype="multipart/form-data">
                     <?php echo $attr_block; ?>
                     <div style="clear:both;"></div>
                   </form>
            </div>
        
		</div>

        
       
    	<div class="span6 pull-right">
       
            
            <div id="show_pic">           
            <?php
			
			$main_imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'medium' : 'medium') : 'large');
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT image.file_name
						,item.img_alt_text
						,image.img_id				
					FROM image, item
					WHERE image.img_id = item.img_id 
					AND item.item_id = '".$item_array['item_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$img_obj = $result->fetch_object();
				
				
				echo "<span class='product-image image-switch-large'>";
				
				
				
				
				if($deviceType == 1){
					//$style = "style='max-height: 180px;'";							
				}elseif($deviceType == 2){
					//$style = "style='max-height: 260px;'";							
				
				}else{
					/*
					$style = "style='border-style:solid; 
									border-width:medium; 
									border-color:#0CC;'
									";
									
					*/											
				}
				
				$style = '';	
				
				echo "<a class='fancybox' href='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_obj->file_name."'
				onClick='ga(\"send\", \"event\", \"Main Image\", \"click\", \"Main Image Enlarge\");'>
				<img $style src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$main_imgdir."/".$img_obj->file_name."' 
				alt='".stripslashes($img_obj->img_alt_text)."' /></a>";
				
				echo "</span>";			
			}
			
			
			?>
            </div>
            <div style="clear:both;"></div>
            <div id='thumbnails_box'>
            <?php
			
				$thumb_array = array();

				$indx = 0;
				
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				
				/*
				$sql = "SELECT video.youtube_id
						FROM item_to_video, video
						WHERE item_to_video.video_id = video.video_id
						AND item_to_video.item_id = '".$item_array['item_id']."'";
				$result = $dbCustom->getResult($db,$sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_object()){
						$thumb_array[$indx]['gallery_file_name'] = '';
						$thumb_array[$indx]['youtube_id'] = $row->youtube_id;
						$indx++;
					}
				}
				*/

								
				$thumb_array[$indx]['gallery_file_name'] = $item->getFileNameFromItemId($dbCustom,$item_array['item_id']);
				$thumb_array[$indx]['youtube_id'] = '';
				if($thumb_array[$indx]['gallery_file_name'] != ''){
					$indx++;
				}
			
											
				$sql = "SELECT image.file_name
						FROM item_gallery, image
						WHERE item_gallery.img_id = image.img_id
						AND item_gallery.item_id = '".$item_array['item_id']."'";
				$result = $dbCustom->getResult($db,$sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_object()){
						$thumb_array[$indx]['gallery_file_name'] = $row->file_name;
						$thumb_array[$indx]['youtube_id'] = '';
						$indx++;
					}
				}
					 
					
//1 phone
//2 tablet
//3 computer
					
				$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'thumb' : 'thumb') : 'small');
				/*
				if($deviceType == 1){
					$imgdir = 'thumb';
					//$video_placeholder_size = "width='80' height='80'";
				}
				if($deviceType == 2){
					$imgdir = 'thumb';
					//$video_placeholder_size = "width='80' height='80'";
				}
				if($desviceType == 3){
					$imgdir = 'small';
					//$video_placeholder_size = "style='width:100%!important; height:100%!important;'";
				}
				*/
				
				
				$block = '';
				$block .= "<ul class='product-image-thumbnails'>";
					
					
				foreach($thumb_array as $val){
						
					if($val['gallery_file_name'] != ''){
						
						$block .= "<li><a href='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$main_imgdir."/".$val['gallery_file_name']."' 
						onClick='ga(\"send\", \"event\", \"Thumbnail\", \"click\", \"Image Swap\");' class='thumbnail-link image-switch-thumb'>
						<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$val['gallery_file_name']."' 
						alt='".$val['gallery_file_name']."' /></a></li>";
						
					}
					
					
					/*
					
					if($val['youtube_id'] != ''){
						
						
						
						$block .= "<li><a onClick='swap_video(\"".$val['youtube_id']."\")'"; 
						$block .= "onClick='ga(\"send\", \"event\", \"Thumbnail Video Placeholder\", \"click\", \"Video Play\");'>";
						$block .= "<img ".$video_placeholder_size." src='http://img.youtube.com/vi/".$val['youtube_id']."/0.jpg'>";
						$block .= "</a></li>";
						
						
						
						
						
					}
					
					*/
					
						
				}
				$block .= "</ul>";
					
					
				$block .= "<div style='clear:both;'></div>";
				
				echo $block;
			?>
            </div>
		</div>
        
		<div class="span6 product-details"> 
            
            <?php
            
			if($deviceType == 3){
				$style = "style='margin-top:30px;'";	
			}else{
				$style = "";	
			}
			
			echo "<div class='row' $style>"; 
			
            ?>
            
				<div class="span3">                 	
                    <span class="product-price" id="main_price"> 
                    <?php
						if($item_array['call_for_pricing'] && $item_array['show_atc_btn_or_cfp'] > 0){
							echo 'Call For Price';	
						}else{
							if($item_array['price'] > 0){
								echo '<strong>$'.number_format($item_array['price'],2).'</strong>  per ea.';
							}
						}
					?>
                    </span>                    
            
            	</div>
				<div class="span3 align-right">
                	
                    <span class="stock-msg">
						<!-- the stock message goes here, either in stock or out of stock; out of stock should add the class 'out-of-stock' to the span element.-->
						IN STOCK
					</span>
                    
                    
                    <span id="main_add_btn">
                    <?php 						
					if($has_add_btn){  
						?>
                        <div class="qty muted"> QTY:
                            <input id="qty" type="text" name="qty" value="1" class="product-qty" />
                        </div>
                        
						<?php 
						
						if($deviceType == 1){
							echo "<a class='btn btn-success' style='width:80px;' id='add_to_cart' 
							onClick='add_item(); ga(\"send\", \"event\", \"Add To Cart Button\", \"click\", \"Add To Cart\");'>Add To Cart</a>";							
						}elseif($deviceType == 2){
							echo "<a class='btn btn-success' style='width:100px;' id='add_to_cart' 
							onClick='add_item(); ga(\"send\", \"event\", \"Add To Cart Button\", \"click\", \"Add To Cart\");'>Add To Cart</a>";
						}else{
							echo "<a class='btn btn-success full-width' id='add_to_cart' 
							onClick='add_item(); ga(\"send\", \"event\", \"Add To Cart Button\", \"click\", \"Add To Cart\");'>Add To Cart</a>";								
						}
					 
					}else{
						
						if($item_array['show_start_design_btn'] || $item_array['show_design_request_btn']){
						
							echo "<div style='clear:both; width:100%; margin-top:30px;'>";
							
							if($item_array['show_design_request_btn']){
								
								$d = $seo->get_url_from_page_name('email-design');
								
								$url = SITEROOT."//".$_SESSION['global_url_word'].$d.'.html?item_id='.$item_array['item_id'];
								
								echo "<div style='float:left; margin-right:10px;'> <a class='btn btn-success' href='".$url."' 
								onClick='ga(\"send\", \"event\", \"Request Design Button\", \"click\", \"Request Design\");' >Request Design</a> </div>";
								
							}

						
							if($item_array['show_start_design_btn'] && $module->hasDesignToolModule($_SESSION['profile_account_id'])){
								
								$tool = SITEROOT."//tool-page.html";
								
								echo "<div style='float:left;'> <a class='btn btn-success' href='".$tool."' 
								onClick='ga(\"send\", \"event\", \"Start Designing Button\", \"click\", \"Start Designing\");'>Start Designing</a> </div>";	
							}


							echo "</div>";
							
						}

						
					}
					?>
            		</span>
                    
                    <div id="msg"></div>        
				</div>
			</div>         
            <?php 
			$rev_tabs_array = get_details_tabs_and_review($item_array['item_id']);
			?>  
            <hr />
            
            
            <div id='review_overview_box'><?php echo $rev_tabs_array['overview_block']; ?></div>
			
            
            <div class="row">
			
            
            	<div class="span6" id='tabbed_content_box'><?php echo $rev_tabs_array['tabs_block']; ?></div>
			
            
            </div>
 		</div>
	</section>

   
    
	<section class="row related-items related-items-horizontal">
		<div class="span12">
        <hr />
        
        
        
        <?php
		
		// assoc area
		echo "<div id='kit_assoc_area'>";
		
		
		
		//$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'thumb') : 'small');    

		$imgdir = 'small';

		$show_kit_assoc_items = 0;
		
		$show_videos = 0;
		
		
		
		
		
		//if($item_array['is_kit']){
			
			if($item_array['show_associated_kits']){
				$assoc_items_array = $cart->getKitAssocItems($dbCustom,$item_array['item_id']);
				if(count($assoc_items_array) > 0){
					$show_kit_assoc_items = 1;
					$show_videos = 0;
				}
			}

			
			if($item_array['show_videos']){
				$videos_array = $cart->getVideos($item_array['item_id']);
				if(count($videos_array) > 0){
					$show_videos = 1;
					$show_kit_assoc_items = 0;
				}
			}
			
		//}


		if($show_videos){

			$video_placeholder_size = '';
			
			$block = '';

			foreach($videos_array as $value){
			
				$block .= "<div class='assoc_item_box'>";
				$block .= "<a onClick='swap_video(\"".$value['youtube_id']."\")'"; 
				$block .= "onClick='ga(\"send\", \"event\", \"Thumbnail Video Placeholder\", \"click\", \"Video Play\");'>";
				$block .= "<img ".$video_placeholder_size." src='http://img.youtube.com/vi/".$value['youtube_id']."/0.jpg'>";
				
				
				$block .= "<strong>".stripslashes($value['title'])."<strong>";
				$block .= "<br /><br />";
				$block .= "<div style='font-size:12px;'>".stripslashes($value['description'])."</div>";
				
				$block .= "</a>";
				$block .="</div>";
			}
			
			$block .= "<div style='clear:both;'></div>";
			echo $block;	

		}
		
		if($show_kit_assoc_items){
			
			$block = '';
			
			
			if($item_array['show_atc_btn_or_cfp'] > 0){
				$block .= "<div class='list_head'>Select your custom closet kit options:</div>";	
			}else{
				$block .= "<div class='list_head'>See what we can do for you by viewing some of our showroom closets samples:</div>";
			}

			$i = 0;
			
			foreach($assoc_items_array as $value){
			
				//$block .= "<div class='span3'><div class='assoc_item_box'>";
				
				$block .= "<div class='assoc_item_box'>";
				
		
				if($value['show_in_cart']){
					$brand_name = getBrandName($value['brand_id']);
					$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], $brand_name, 'shop');
				}else{
					$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], '', 'showroom');
				}

				$details_link = "<a href='".$url_str."'>";
							
				
				$block .="<span class='product-image'>".$details_link;				
				$block .= "<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$value["img_file_name"]."' 
					 alt='".stripAllSlashes($value['img_alt_text'])."'/></a></span>";
								


				$block .="<span class='product_name'>"; 
				$block .="<h3>".$details_link.stripAllSlashes($value['name'])."</a></h3>";
				$block .="</span>";


				$block .="<h5>".$details_link."(Product Id: ".sprintf('%06d',$value['profile_item_id']).")</a></h5>";

				
				
				
				if($value['call_for_pricing'] || $value['price'] <= 0){
				
					if($value['show_atc_btn_or_cfp']){	
						$block .="<div class='product-price'>Call For Price</div>";
					}
				
				}else{
					$block .="<div class='product-price'><strong>$".number_format($value['price'],2)."</strong> per ea.</div>";						
				}
				
				
				if(has_add_to_cart_btn($module->hasShoppingCartModule($_SESSION['profile_account_id'])
					,$value['call_for_pricing']
					,$value['price']
					,$shipping->getShipType()
					,$value['weight']
					,$value['is_free_shipping']
					,$value['show_atc_btn_or_cfp'])){


						$block .="<span class='qty'>QTY:</span><span><input id='qty".$value['item_id']."' type='text' name='qty'  value='1' class='product-qty' /></span>";										
						$block .= "<span><a class='btn btn-success add-to-cart' id='add_".$value['item_id']."' 
								onClick=\"add_assoc_item('".$value['item_id']."');  ga('send', 'event', 'Add To Cart Button Associate', 'click', 'Add To Cart'); \">Add To Cart</a></span>";
					}
				
				/*
				if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
					if((!($shipping->getShipType() == 'carrier' && $value['weight'] == 0)) || $value['is_free_shipping']) {
						if(!$value['call_for_pricing'] && $value['price'] > 0){
							if($value['show_atc_btn_or_cfp']){
								$block .="<span class='qty'>QTY:</span><span><input id='qty".$value['item_id']."' type='text' name='qty'  value='1' class='product-qty' /></span>";										
								$block .= "<span><a class='btn btn-success add-to-cart' id='add_".$value['item_id']."' 
								onClick=\"add_assoc_item('".$value['item_id']."');  ga('send', 'event', 'Add To Cart Button Associate', 'click', 'Add To Cart'); \">Add To Cart</a></span>";
							}
							$block .="<div style='clear:both;'></div>";
						}
					}						
				}
				*/
				
				
				
				$block .="</div>";
			}
			
			
			echo $block;			

			echo '</div>';
		
		}
		
		
		
// ************************************

		

			$likes_array = $likes->getLikesItems($item_array['item_id']);
			if(count($likes_array) > 0){			
				$block = '';
				
				$block .= "<div style='clear:both;'></div>";
				
				$block .= "<div class='list_head'>You May Also Like:</div>";
				$block .= "<div class='row'>";
				$i = 0;
				foreach($likes_array as $value){
			//style='background:#0CF;'
					$block .= "<div class='span4'><div class='itembox'  >";
	
					if($value['show_in_cart']){
						$brand_name = getBrandName($value['brand_id']);
						$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], $brand_name, 'shop');
					}else{
						$url_str = $nav->getItemUrl($value['seo_url'], $value['name'], $value['profile_item_id'], '', 'showroom');
					}
	
					$details_link = "<a href='".$url_str."' onClick='ga(\"send\", \"event\", \"Like Items Image Link\", \"click\", \"Image Link\");' >";
								
					$block .= "<span class='product-image'>".$details_link;
					
					$block .= "<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$value["img_file_name"]."' 
						  alt='".stripAllSlashes($value['img_alt_text'])."'/></a></span>";
					
					$block .= "<h4>".$details_link.stripAllSlashes($value['name'])."</a></h4>";
					
					$block .= "<div style='font-size:22px;'>Product Id: ".$value['profile_item_id']."</div>";							
					
					if($value['call_for_pricing']){
						
						if($value['show_atc_btn_or_cfp'] > 0){
							$block .= "<span class='product-price'>Call for pricing</span>";								
						}					
					
					}else{
						if($value['price'] > 0){
							$block .= "<span class='product-price'><strong>$".$value['price']."</strong> per ea.</span>";
						}
					}
					
					$block .= "</div></div>";
					$i++;
					if ($i == 3){
						$block .= "</div><div class='row'>";
						$i = 0;
					}
				}
				
				$block .= "</div>";
				echo $block;
			}
		
		?>
                    
		</div>
	</section>
	<section class="row categories related-categories">
		<hr />
		<?php	
			$sub_cats = $store_data->getSubCatsWithData($cat_id, 'showroom');
			$i = 1;
			if(count($sub_cats) > 0){
		?>

		<div class='list_head'>Related Showroom</div>

		<div class="span4">
					<ul style="list-style:none; float:left; margin-left:0px;">

			<?php
					$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'small') : 'medium');
					foreach($sub_cats as $sub_cat){	
						$block = ''; 
						$block .= "<div class='span2 category' style='margin-left:0px;'>";
					
						$url_str = $nav->getCatUrl($sub_cat['name'], $sub_cat['profile_cat_id'], 'showroom');
						
						$block .= "<a href='".$url_str."'>";
							
						$block .= "<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir ."/".$sub_cat["img_file_name"]."' 
						alt='".stripAllSlashes($sub_cat['img_alt_text'])."' onClick='ga(\"send\", \"event\", \"Related Showrooms Image Link\", \"click\", \"Image Link\");' />";
						$block .= "<span class='caption'>".stripAllSlashes($sub_cat['name'])."</span>";
						$block .= "</a>";
						$block .= "</div>";
						echo $block;
						//break;
					}
			?>
            		</ul>
		</div>
		<div class="span8">
		<?php } else {?>
		<div class="span12">
		<?php } 
			$sub_cats = $sub_cats = $store_data->getSubCatsWithData($cat_id, 'cart');
			$i = 1;
			if(count($sub_cats) > 0){
		?>
        	<div class='list_head'>Related Categories</div>
        	<div class="span4">
			
			<div class="row slider-container" id="slider-container">
				<div class="slider">
					<ul class="slider-content">
					<?php
							
							$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'small') : 'medium');
							foreach($sub_cats as $sub_cat){	
								$block = ''; 
								$block .= "<li class='span2 category'>";
								
								$url_str = $nav->getCatUrl($sub_cat['name'], $sub_cat['profile_cat_id'], 'shop');
						
								$block .= "<a href='".$url_str."'>";
									
								$block .= "<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$sub_cat["img_file_name"]."'
								alt='".stripAllSlashes($sub_cat['img_alt_text'])."' onClick='ga(\"send\", \"event\", \"Related Categories Image Link\", \"click\", \"Image Link\");' />";
								
								$block .= "<span class='caption'>".$sub_cat['name']."</span>";
								$block .= "</a>";
								$block .= "</li>";
								echo $block;							
							}
							
					?>
					</ul>
				</div>
                
				<a id="left" class="disabled" href="#slider-container"><i class="slider-arrow-left"></i></a> <a id="right" href="#slider-container"><i class="slider-arrow-right"></i></a> </div>
		<?php } ?>
		</div>
	</section>
</div>
<?php 
include("includes/footer.php"); 
?>
<script>

$(document).ready(function(){
	
	$(".fancybox").fancybox({
		
		/*
        autoDimensions: false,
        height: 525,
        width: 720
		*/
		
    });	

	$("#add_to_cart").show();
	
	//alert($(window).width());
	
});
</script>


<div id="writeReview">
	<div class="lightbox-content">
		<form name="send_review_form" action="<?php echo  SITEROOT.$_SERVER['REQUEST_URI']; ?>" method="post">            
            <div class="row">
				<p><em>Fields marked with an asterisk (*) are required. In our rating scale, 5 stars is Excellent, 1 star is Poor.</em></p>
				<div class="span2">
					<label>Star Rating:*</label>
				</div>
				<div class="span3">
					<select name="rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5" selected>5</option>
					</select>
				</div>
			</div>
            <!--
			<div class="row gutter-top">
				<div class="span2">
					<label> Review Headline:*</label>
				</div>
				<div class="span3">
					<input type="text" name="headline" value="Headline">
				</div>
			</div>
            -->
			<div class="row gutter-top">
				<div class="span2">
					<label>Review Text:*</label>
				</div>
				<div class="span3">
					<textarea name="review" cols="50" rows="4">Review</textarea>
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label>Your Name: </label>
				</div>
				<div class="span3">
					<input type="text" name="name" value="Name" />
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label>Your City:</label>
				</div>
				<div class="span3">
					<input type="text" name="city" value="City" />
				</div>
			</div>
				<button type="submit" name="send_review" class="btn btn-success" onClick="ga('send', 'event', 'Submit Review', 'click', 'Submit Review');">Submit Review!</button>
		</form>
	</div>
</div>

<input type="hidden" name="walkin" id="walkin" 
value="<iframe src='https://docs.google.com/forms/d/16uSGrutjuJEyns2GP8FWW7rw0iie2oiGGvBhJpYeHgc/viewform?embedded=true' width='560' height='500' frameborder='0' marginheight='0' marginwidth='0'>Loading...</iframe>">

<input type="hidden" name="reachin" id="reachin" 
value="<iframe src='https://docs.google.com/forms/d/1jd6fqSjokMop1ZHjm5VbVX7Ixo1_nBcxEPG_jlgTNHA/viewform?embedded=true' width='560' height='500' frameborder='0' marginheight='0' marginwidth='0'>Loading...</iframe>">


</div>
</div>


<!--


http://cloudinary.com/blog/generating_video_thumbnails_from_youtube_and_other_video_sites

echo cl_image_tag("eOA5vpeLgVQ", array("type" => "youtube", "angle => 5", "transformation" => array("width" => 200, "height" => 120, "crop" => "fill")))


<img src='http://img.youtube.com/vi/eOA5vpeLgVQ/0.jpg'>

-->





</body>
</html>

<?php

/*
echo $item_array['show_associated_kits']."       ".$show_kit_assoc_items;

echo "<br /><br />";

echo $profile_item_id;

echo "<br /><br />";

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT show_associated_kits, show_videos
		FROM item
		WHERE profile_item_id = '".$profile_item_id."'";
$result = $dbCustom->getResult($db,$sql);

$obj = $result->fetch_object();
echo $obj->show_associated_kits."       ".$obj->show_videos;				

*/

//echo cl_image_tag("eOA5vpeLgVQ", array("type" => "youtube", "angle => 5", "transformation" => array("width" => 200, "height" => 120, "crop" => "fill")))



               /* use for media
				    $sql = sprintf('SELECT media.name, media.media_id 
					   FROM item_to_media, media 
					   WHERE item_to_media.media_id = media.media_id 
					   AND item_to_media.item_id = '%u' ', $item_id);
								
					$doc_result = mysql_query($sql);
					if(!$doc_result)die(mysql_error());
					if(mysql_num_rows($doc_result) > 0){
						echo "<div>Documents:</div>";
					}
					while($doc_row = mysql_fetch_object($doc_result)) {

						$block = ''; 
						$block .= "<div>";
						$block .= "<a href='".SITEROOT."//uploads/".$doc_row->name."' target='_blank'>$doc_row->name</a>";
						$block .= "</div>";
						echo $block;
					}
                */
				/* USE THIS LATER FOR DYNAMIC OPTIONS			
				$sub_sql = "AND (item_to_opt.item_id = '".$item_id."'";
				$sql = "SELECT item_id
						FROM  item 
						WHERE parent_item_id = '".$item_id."'";
				$si_res = mysql_query ($sql);
				if(!$si_res)die(mysql_error());
				if(mysql_num_rows($si_res)> 0){
					while($si_row = mysql_fetch_object($si_res)){
						$sub_sql .= " OR item_to_opt.item_id = '".$si_row->item_id."'";
					}
				}
				$sub_sql .= ")";
				$sql = "SELECT attribute_id, attribute_name
						FROM  attribute 
						ORDER BY attribute_id";
				$res = $dbCustom->getResult($db,$sql);
				if(!$attr_res)die(mysql_error());
				while($attr_row = mysql_fetch_object($attr_res)) {
					$sql = "SELECT opt.opt_id, opt.opt_name, item_to_opt.item_id 
							FROM  opt, attribute, item_to_opt 
							WHERE opt.attribute_id = attribute.attribute_id
							AND opt.attribute_id = '".$attr_row->attribute_id."'
							AND item_to_opt.opt_id = opt.opt_id
							".$sub_sql."
							ORDER BY opt_id";
					$res = $dbCustom->getResult($db,$sql);
						
					if($res->num_rows > 0){									
							$block = '';
							$block .= $attr_row->attribute_name;
							$block .= "  <select name='".$attr_row->attribute_id."' >";		
							$block .= "<option value='0'>none</option>";
							while($opt_row = $res->fetch_object()) {
								
								$block .= "<option value='".$opt_row->opt_id."' >$opt_row->opt_name</option>";
							}
							$block .= "</select>";
							$block .= "<br /><br />";
							echo $block;
					}
				}
	
	*/
?>

