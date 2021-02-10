<?php
// NOTE: add  validate function to check if another child item has the same attributes selected.

require_once("../../includes/config.php"); 
require_once("../../includes/class.admin_login.php");
require_once("../../admin-includes/class.admin_bread_crumb.php");	
require_once("../admin-includes/tool-tip.php"); 

require_once("../admin-includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../../admin-includes/class.module.php");	
$module = new Module;


$page_title = "Add Item";
$page_group = "item";

require_once("../admin-includes/set-page.php");	

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(!isset($_SESSION["top_cat_id"])) $_SESSION["top_cat_id"] = '';
$top_cat_id =  (isset($_REQUEST['top_cat_id'])) ? $_REQUEST['top_cat_id'] : $_SESSION["top_cat_id"];
if($top_cat_id == '') $top_cat_id = 0;

if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = '';
$parent_cat_id =  (isset($_REQUEST['parent_cat_id'])) ? $_REQUEST['parent_cat_id'] : $_SESSION['parent_cat_id'];
if($parent_cat_id == '') $parent_cat_id = 0;


$parent_item_id =  (isset($_GET['parent_item_id'])) ? $_GET['parent_item_id'] : 0;

$_SESSION['temp_item_fields']["parent_item_id"] = $parent_item_id;
	
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = '';
$cat_id =  (isset($_REQUEST['cat_id'])) ? $_REQUEST['cat_id'] : $_SESSION['cat_id'];
if($cat_id == '') $cat_id = 0;


if(!isset($_SESSION["action"])) $_SESSION["action"] = '';
$action =  (isset($_REQUEST['action'])) ? $_REQUEST['action'] : $_SESSION["action"];

if(!isset($_SESSION["item_id"])) $_SESSION["item_id"] = '';
$item_id =  (isset($_REQUEST['item_id'])) ? $_REQUEST['item_id'] : $_SESSION["item_id"];
if($item_id == '') $item_id = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(!isset($_SESSION["copied"])) $_SESSION["copied"] = 0;
if(!isset($_SESSION['new_img_id'])) $_SESSION['new_img_id'] = 0;


if(!$_SESSION['new_img_id']){
	
		$sql = "SELECT max(img_id) AS img_id  
			FROM image
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$img_res = $dbCustom->getResult($db,$sql);
			$img_obj = $img_res->fetch_object();
	
		$_SESSION['img_id'] = $img_obj->img_id;
		 
}else{
	
		$_SESSION['img_id'] = $_SESSION['new_img_id'];	
		
}



if(isset($_POST['del_keyword'])){
	//echo $_POST['key_word'];
	//exit;
	$temp_array = '';
	if(isset($_SESSION["temp_key_words"])){
		$i = 0;
		if(is_array($_SESSION["temp_key_words"])){				
			foreach ($_SESSION["temp_key_words"] as $key_word) {
				//echo $key_word."  ".$_POST['key_word'];
				if($key_word != $_POST['key_word']){
					$temp_array[$i] = $key_word;  	
				}
				$i++;
			}
			$_SESSION["temp_key_words"] = $temp_array;
		}
	}
}


if(isset($_POST["add_keyword"])){
	$word = $_POST["word"];
	//echo $_SESSION['temp_item_fields']['name'];
	if(isset($_SESSION["temp_key_words"])){
		$c = count($_SESSION["temp_key_words"]);
	}else{
		$c = 0;		
	}
	$_SESSION["temp_key_words"][$c] = $word;
	
	
	//echo "----------".$_SESSION['temp_item_fields']["price_flat"];
	
}


if(isset($_POST["add_attribute"])){

	$added_attribute = addslashes($_POST["added_attribute"]); 
	$first_option = addslashes($_POST["first_option"]);
	
	
	
	$sql = sprintf("SELECT attribute_id 
					FROM attribute 
					WHERE attribute_name = '%s'
					AND profile_account_id = '%u'", 
					$added_attribute, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO attribute (attribute_name, profile_account_id) VALUES ('%s', '%u')", $added_attribute, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$attr_id = $db->insert_id;
		
		$sql = sprintf("INSERT INTO opt (opt_name, attribute_id) VALUES ('%s','%u')", $first_option, $attr_id);
		$result = $dbCustom->getResult($db,$sql);
		
		//$msg = "Your change is now live.";
	}else{
		//$msg = "The attribute name already exists";
	}
	
}


//echo $_SESSION["copied"];



if($_SESSION["copied"] == 0){
	

	
	if(!isset($_SESSION['temp_item_fields']["main_attr_id"])) $_SESSION['temp_item_fields']["main_attr_id"] = "0";	
	
	if(!isset($_SESSION['temp_item_fields']["date_inactive"])) $_SESSION['temp_item_fields']["date_inactive"] = '';	
	if(!isset($_SESSION['temp_item_fields']['name'])) $_SESSION['temp_item_fields']['name'] = '';	
	
	if(!isset($_SESSION['temp_item_fields']["price_flat"])) $_SESSION['temp_item_fields']["price_flat"] = 0;	
	if(!isset($_SESSION['temp_item_fields']["price_wholesale"])) $_SESSION['temp_item_fields']["price_wholesale"] = 0;	
	if(!isset($_SESSION['temp_item_fields']["percent_markup"])) $_SESSION['temp_item_fields']["percent_markup"] = 0;	
	if(!isset($_SESSION['temp_item_fields']["percent_off"])) $_SESSION['temp_item_fields']["percent_off"] = 0;	
	if(!isset($_SESSION['temp_item_fields']["amount_off"])) $_SESSION['temp_item_fields']["amount_off"] = 0;	
	if(!isset($_SESSION['temp_item_fields']["is_taxable"])) $_SESSION['temp_item_fields']["is_taxable"] = 0;	
	
	if(!isset($_SESSION['temp_item_fields']["call_for_pricing"])) $_SESSION['temp_item_fields']["call_for_pricing"] = '';	
	if(!isset($_SESSION['temp_item_fields']["is_new_product"])) $_SESSION['temp_item_fields']["is_new_product"] = '';	
	if(!isset($_SESSION['temp_item_fields']["is_promo_product"])) $_SESSION['temp_item_fields']["is_promo_product"] = '';	
	if(!isset($_SESSION['temp_item_fields']["allow_back_order"])) $_SESSION['temp_item_fields']["allow_back_order"] = '';	
	if(!isset($_SESSION['temp_item_fields']["manufacturer_id"])) $_SESSION['temp_item_fields']["manufacturer_id"] = '';	
	//if(!isset($_SESSION['temp_item_fields']["style_id"])) $_SESSION['temp_item_fields']["style_id"] = '';	
	if(!isset($_SESSION['temp_item_fields']["is_taxable"])) $_SESSION['temp_item_fields']["is_taxable"] = '';	
	if(!isset($_SESSION['temp_item_fields']["prod_number"])) $_SESSION['temp_item_fields']["prod_number"] = '';	
	if(!isset($_SESSION['temp_item_fields']["vend_man_id"])) $_SESSION['temp_item_fields']["vend_man_id"] = '';
	if(!isset($_SESSION['temp_item_fields']["brand_id"])) $_SESSION['temp_item_fields']["brand_id"] = '';
	
		
	if(!isset($_SESSION['temp_item_fields']["sku"])) $_SESSION['temp_item_fields']["sku"] = '';	
	if(!isset($_SESSION['temp_item_fields']["upc"])) $_SESSION['temp_item_fields']["upc"] = '';	
	if(!isset($_SESSION['temp_item_fields']["short_description"])) $_SESSION['temp_item_fields']["short_description"] = '';	
	if(!isset($_SESSION['temp_item_fields']['description'])) $_SESSION['temp_item_fields']['description'] = '';	
	if(!isset($_SESSION['temp_item_fields']["back_order_message"])) $_SESSION['temp_item_fields']["back_order_message"] = '';	
	if(!isset($_SESSION['temp_item_fields']["in_stock_message"])) $_SESSION['temp_item_fields']["in_stock_message"] = '';	
	if(!isset($_SESSION['temp_item_fields']["additional_information"])) $_SESSION['temp_item_fields']["additional_information"] = '';	
	//if(!isset($_SESSION['temp_item_fields']["type_id"])) $_SESSION['temp_item_fields']["type_id"] = '';	
	//if(!isset($_SESSION['temp_item_fields']["lead_time_id"])) $_SESSION['temp_item_fields']["lead_time_id"] = '';	
	//if(!isset($_SESSION['temp_item_fields']["skill_level_id"])) $_SESSION['temp_item_fields']["skill_level_id"] = '';	
	if(!isset($_SESSION['temp_item_fields']["ship_port_id"])) $_SESSION['temp_item_fields']["ship_port_id"] = '';	
	if(!isset($_SESSION['temp_item_fields']["return_to_id"])) $_SESSION['temp_item_fields']["return_to_id"] = '';	
	if(!isset($_SESSION['temp_item_fields']["is_drop_shipped"])) $_SESSION['temp_item_fields']["is_drop_shipped"] = '';	
	if(!isset($_SESSION['temp_item_fields']['img_id'])) $_SESSION['temp_item_fields']['img_id'] = '';	

	if(!isset($_SESSION['temp_item_fields']["is_closet"])) $_SESSION['temp_item_fields']["is_closet"] = 0;	
	if(!isset($_SESSION['temp_item_fields']['show_in_cart'])) $_SESSION['temp_item_fields']['show_in_cart'] = 1;	
	if(!isset($_SESSION['temp_item_fields']['show_in_showroom'])) $_SESSION['temp_item_fields']['show_in_showroom'] = 0;
	
	if(!isset($_SESSION['temp_item_fields']["shipping_flat_charge"])) $_SESSION['temp_item_fields']["shipping_flat_charge"] = 0;
	
	if(!isset($_SESSION['temp_item_fields']["weight"])) $_SESSION['temp_item_fields']["weight"] = '';	
			
	$sql = "SELECT attribute_id
			FROM  attribute
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
    $attr_res = mysql_query ($sql);
	if(!$attr_res)die(mysql_error());
	$is_attributes = 0;
	while($attr_row = mysql_fetch_object($attr_res)) {
		if(!isset($_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id])) $_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id] = 0;
		$is_attributes = 1;
	}

}

$_SESSION["copied"] = 0;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add accessory_item</title>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/mce.css" />

<!-- look -->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="<?php echo $ste_root; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/tiny_mce/tiny_mce.js"></script>

<script src="<?php echo $ste_root; ?>/js/ui/jquery.ui.core.js"></script>
<script src="<?php echo $ste_root; ?>/js/ui/jquery.ui.widget.js"></script>
<script src="<?php echo $ste_root; ?>/js/ui/jquery.ui.datepicker.js"></script>

<script>

/*
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",
	content_css : "../css/mce.css"
});
*/

function validate(theform){	

	var price_flat = jQuery.trim(theform.price_flat.value);
	var price_wholesale = jQuery.trim(theform.price_wholesale.value);
	var percent_markup = jQuery.trim(theform.percent_markup.value);
	var percent_off = jQuery.trim(theform.percent_off.value);
	var amount_off = jQuery.trim(theform.amount_off.value);
	
	
	<?php
	if(isset($_SESSION["temp_key_words"])){
		$cnt = count($_SESSION["temp_key_words"]);
	}else{
		$cnt = 0;
	}
	
	if(!$cnt){
	?>

		alert("Please enter at least 1 key word");
		return false;				

	<?php
	}
	?>
	
	if(price_flat != ''){
		if(!IsNumeric(price_flat)){
			alert("Please enter valid numbers only");
			return false;				
		}
	}
	if(price_wholesale != ''){
		if(!IsNumeric(price_wholesale)){
			alert("Please enter valid numbers only");
			return false;				
		}
	}
	
	if(price_flat > 0 && price_wholesale > 0){
			alert("You cannot have a flat price and a wholesale at the same time");
			return false;				
	}

	if(percent_markup != ''){
		if(!IsNumeric(percent_markup)){
			alert("Please enter valid numbers only");
			return false;				
		}
	}
	if(percent_off != ''){
		if(!IsNumeric(percent_off)){
			alert("Please enter valid numbers only");
			return false;				
		}
	}
	if(amount_off != ''){
		if(!IsNumeric(amount_off)){
			alert("Please enter valid numbers only");
			return false;				
		}
	}
	if(percent_off != '' && amount_off != ''){
		if(percent_off > 0 && amount_off > 0){
			alert("You cannot have values for both percent off and amount off \n Please enter only one value.");
			return false;
		}
	}



	<?php 
	if($parent_item_id == 0){ 
		if($is_attributes){		
	?>



	if(typeof(theform.main_attr_id.length) == "undefined"){

		if(!theform.main_attr_id.checked){
			alert("Please choose a main attribute.");
			return false;			
		}
		
	}else{
		
		var checked = 0;
		//alert(theform.main_attr_id.length);
		for(var i = 0; i < theform.main_attr_id.length; i++  ){	
			if(theform.main_attr_id[i].checked){
				checked = 1;
			}
		}
		
		if(!checked){
			alert("Please choose a main attribute.");
			return false;
		}
	
	}

	<?php } } ?>
	
	return true;
	//return false;


}


function checkPercent(elem){
	
	elem = jQuery.trim(elem.value);
	
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}else{	
		if(elem.value != 0 && elem.value <= 1){
			alert("Please enter 0 or an integer greater than 1");
		}
		
		if(elem.value >= 100){
			alert("Please enter a number less than 100");
		}
	}
}

function checkNum(elem){
	
	elem = jQuery.trim(elem.value);
		
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}
}
function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}

function get_query_str(){

	//alert("999kkkk");
	var query_str = '';
	

	var is_in_form = 0;
	var temp_ele_name = "name";
	<?php
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT attribute.attribute_id
			FROM  attribute, opt
			WHERE attribute.attribute_id = opt.attribute_id
			AND attribute.profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
    $attr_res = mysql_query ($sql);
	if(!$attr_res)die(mysql_error());
	while($attr_row = mysql_fetch_object($attr_res)) {
	$nn = "attr_".$attr_row->attribute_id;
	?>
		for(i = 0; i < document.add_item.elements.length; i++)
		{
			if(document.add_item.elements[i].name == '<?php echo $nn; ?>'){
				is_in_form = 1;	
			}
		}
		if(is_in_form){
			if(query_str.indexOf("&<?php echo $nn; ?>="+document.add_item.<?php echo $nn; ?>.value) < 0){
				query_str += "&<?php echo $nn; ?>="+document.add_item.<?php echo $nn; ?>.value;
			}
		}
	<?php
	}
	?>
	//alert(query_str);

	<?php if($is_attributes){ ?>
	for(var i = 0; i < document.add_item.main_attr_id.length; i++  ){
		if(document.add_item.main_attr_id[i].checked){
			query_str += "&main_attr_id="+document.add_item.main_attr_id[i].value;
			
			break;
		}
	}
	<?php } ?>

//alert(query_str);


	var str_cats = '';	
	if(typeof(document.add_item.cat_ids) == "undefined"){
		alert("Please add a category for this item");
	}else{
		if(document.add_item.cat_ids.value > 0){
			str_cats = document.add_item.cat_ids.value + "|" + 1;	
		}else{
			for(var i=0; i < document.add_item.cat_ids.length; i++){
				str_cats = str_cats + document.add_item.cat_ids[i].value+"|";  
				if(document.add_item.cat_ids[i].checked){
					str_cats = str_cats + 1;
				}else{
					str_cats = str_cats + 0;
				}
				str_cats = str_cats + ",";
			}	
		}
	}

	//alert(str_cats);

	query_str += "&cat_id="+document.add_item.cat_id.value;

	query_str += "&str_cats="+str_cats;

//alert(query_str);


	query_str += "&date_active="+document.add_item.date_active.value; 
    query_str += "&date_inactive="+document.add_item.date_inactive.value; 
	
    query_str += "&parent_item_id="+document.add_item.parent_item_id.value; 
	
    query_str += "&name="+document.add_item.name.value; 
	
	query_str += "&price_flat="+document.add_item.price_flat.value;
    query_str += "&price_wholesale="+document.add_item.price_wholesale.value;
    query_str += "&percent_markup="+document.add_item.percent_markup.value;
    query_str += "&percent_off="+document.add_item.percent_off.value;
    query_str += "&amount_off="+document.add_item.amount_off.value;
	
	for(var i = 0; i < document.add_item.call_for_pricing.length; i++  ){
		if(document.add_item.call_for_pricing[i].checked){
			query_str += "&call_for_pricing="+document.add_item.call_for_pricing[i].value;
			break;
		}
	}

	for(var i = 0; i < document.add_item.is_new_product.length; i++  ){
		if(document.add_item.is_new_product[i].checked){
			query_str += "&is_new_product="+document.add_item.is_new_product[i].value;
			
			break;
		}
	}

	for(var i = 0; i < document.add_item.is_promo_product.length; i++  ){
		if(document.add_item.is_promo_product[i].checked){
			query_str += "&is_promo_product="+document.add_item.is_promo_product[i].value;
			break;
		}
	}

	for(var i = 0; i < document.add_item.allow_back_order.length; i++  ){
		if(document.add_item.allow_back_order[i].checked){
			query_str += "&allow_back_order="+document.add_item.allow_back_order[i].value;
			break;
		}
	}

    query_str += "&brand_id="+document.add_item.brand_id.value;
	//query_str += "&style_id="+document.add_item.style_id.value;
    query_str += "&is_taxable="+document.add_item.is_taxable.value;
	
	for(var i = 0; i < document.add_item.is_taxable.length; i++  ){
		if(document.add_item.is_taxable[i].checked){
			query_str += "&is_taxable="+document.add_item.is_taxable[i].value;
			break;
		}
	}
	
	
	//alert(query_str);
	
    query_str += "&prod_number="+document.add_item.prod_number.value;
    query_str += "&sku="+document.add_item.sku.value;
    query_str += "&upc="+document.add_item.upc.value;

    query_str += "&short_description="+document.add_item.short_description.value;
    query_str += "&description="+document.add_item.description.value; 
    query_str += "&back_order_message="+document.add_item.back_order_message.value;
    query_str += "&in_stock_message="+document.add_item.in_stock_message.value;
    query_str += "&additional_information="+document.add_item.additional_information.value;
    query_str += "&shipping_flat_charge="+document.add_item.shipping_flat_charge.value;
    query_str += "&weight="+document.add_item.weight.value;

	//alert(query_str);

    //query_str += "&type_id="+document.add_item.type_id.value;
	
    //query_str += "&lead_time_id="+document.add_item.lead_time_id.value;
	
	
	
    //query_str += "&skill_level_id="+document.add_item.skill_level_id.value;
	
	query_str += "&return_to_id="+document.add_item.return_to_id.value;	
    query_str += "&ship_port_id="+document.add_item.ship_port_id.value;

	for(var i = 0; i < document.add_item.is_drop_shipped.length; i++  ){
		if(document.add_item.is_drop_shipped[i].checked){
			query_str += "&is_drop_shipped="+document.add_item.is_drop_shipped[i].value;
			break;
		}
	}







	for(var i = 0; i < document.add_item.is_closet.length; i++  ){
		if(document.add_item.is_closet[i].checked){
			query_str += "&is_closet="+document.add_item.is_closet[i].value;
			break;
		}
	}

	for(var i = 0; i < document.add_item.show_in_cart.length; i++  ){
		if(document.add_item.show_in_cart[i].checked){
			query_str += "&show_in_cart="+document.add_item.show_in_cart[i].value;
			break;
		}
	}

	for(var i = 0; i < document.add_item.show_in_showroom.length; i++  ){
		if(document.add_item.show_in_showroom[i].checked){
			query_str += "&show_in_showroom="+document.add_item.show_in_showroom[i].value;
			break;
		}
	}


	/*
	for(var i = 0; i < document.add_item.img_id.length; i++){
		if(document.add_item.img_id[i].checked){
			query_str += "&img_id="+document.add_item.img_id[i].value;
			break;
		}
	}
	*/



	//alert(query_str);

	return query_str;
}



$(document).ready(function() {




	$("#copy_from_parent").click(function(){ 
		//$("#t").click(function(){ 
		//alert("kkkkkk");
				
		var q_str = "?action=copy_from_parent&parent_item_id="+<?php echo $parent_item_id; ?>;
		
		//alert(q_str);
		
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			  //alert("data:"+data);
			  
		  }
		});
		
		//alert("this:");
		
		location.reload();
	})


	$("#copy_from_sibling").click(function(){ 
		//$("#t").click(function(){ 
		//alert("kkkkkk");
				
		var q_str = "?action=copy_from_sibling&parent_item_id="+<?php echo $parent_item_id; ?>;
		
		//alert(q_str);
		
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			  //alert("data:"+data);
			  
		  }
		});
		
		//alert("this:");
		
		location.reload();
	})
	
	


	$("#add_item").submit(function(){ 
		//$("#t").click(function(){ 
		var q_str = "?action=1"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			//$('#t').html(data);
			//alert('Load was performed.');
		  }
		});
		return validate(this);
	})



	$("#upload_pre_crop").click(function(){ 

		var f_id = $(this).find(".e_sub").attr('id');
		//alert(f_id); 
		var q_str = "?action=1"+get_query_str();
		//alert(q_str);						
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			//$('#t').html(data);
			//alert('Load was performed.');
		  	window.location=f_id;
		  }
		});
	
	})


	$(".inline").click(function(){ 
		
		//alert("kkkk:"+this.href.indexOf("add_keyword"));
		
		
		//alert("kkkk");
		
		var q_str = "?action=1"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			
			//alert(data);
			//$('#t').html(data);
			//alert('Load was performed.');
		  }
		});

		
		
		if(this.href.indexOf("add_attribute") > 1){
			//alert("kkkk");
			
			var q_str = "?action=add_attr&ret_page=add-item";
			//alert(q_str);
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_attr_opt.php'+q_str,
			  success: function(data) {
				$('#add_attribute').html(data);
				//alert('Load was performed.');
			  }
			});
		}

		
		
		
		/*
		if(this.href.indexOf("add_attribute") > 1){
			
			var q_str = "?action=add_attr&ret_page=add-item";
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_attr_opt.php'+q_str,
			  success: function(data) {
				$('#add_attribute').html(data);
			  }
			});
		}
		*/
			

		if(this.href.indexOf("add_keyword") > 1){
			
			var q_str = "?action=add&ret_page=add-item";
			//alert(q_str);
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_keyword.php'+q_str,
			  success: function(data) {
				  
				  
				$('#add_keyword').html(data);
				//alert('Load was performed.');
			  }
			});
		}
		

		if(this.href.indexOf("del_keyword") > 1){
			
			
			var f_id = $(this).find(".e_sub").attr('id');
			var q_str = "?action=del&ret_page=add-item";
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			   url: 'ajax_keyword.php'+q_str+'&kw='+f_id+'&',
			  success: function(data) {
				$('#del_keyword').html(data);
				//alert('Load was performed.');
			  }
			});			
		}



	})
	
	
	
	$("a.inline").fancybox();	
	
	
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();	
	$('#clear_dates').click(function() {
		$('#datepicker1').val('');
		$('#datepicker2').val('');
	});


});

		
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			editor_selector : "selector_1",
			plugins : "safari",
			content_css : "../../css/mce.css"
	});
	
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			editor_selector : "selector_2",
			plugins : "safari",
			content_css : "../../css/mce.css"
	});



function show_msg(msg){
	alert(msg);
}


function setIsCloset(){	
  	document.add_item.is_closet[0].checked = true;
}


function setNotCloset(){	
  	document.add_item.is_closet[1].checked = true;
}

function setNewOpt(attribute_id){	
	//alert("kkkk"+attribute_id);
	
	var q_str = "?action=1"+get_query_str();
		//alert(q_str);
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_item_session.php'+q_str,
	  success: function(data) {
		//$('#t').html(data);
		//alert('Load was performed.');
	  }
	});
	
		
	var optval = '';	
	var input = "document.add_item.new_opt_"+attribute_id+".value";
	optval = eval(input);

	//alert(optval);
						
	var q_str = "?action=add_new_opt&new_option="+optval+"&attr_id="+attribute_id+"&ret_page=add-item";
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_attr_opt.php'+q_str,
			  success: function(data) {
				//$('#add_new_opt').html(data);
				//alert('Load was performed.');
			  }
			});
			
	location.reload();

}

$(document).ready(function(){    
		$("div.accord_body3").toggle("fast",function(){
			
		});
	});

</script>
</head>

<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 




//if(!isset($_SESSION["test"])) $_SESSION["test"] = 0;
//echo $_SESSION["test"];



//echo $_SESSION["copied"];

//print_r($_SESSION["temp_key_words"]);





//if($src != "inline"){

	require_once("../admin-includes/manage-header.php");
	//require_once("../admin-includes/manage-top-nav.php");
//}	
?>

<div class="manage_page_container">


<!--<div id="t">TTTTTTTTTTT</div>-->


    <div class="manage_side_nav">
        <?php 
        require_once("../admin-includes/manage-side-nav.php");
        ?>
    </div>	

	<?php
                //$url_str = "upload.php";
                $url_str = "../upload-pre-crop.php";               				
                $url_str .= "?ret_page=add-item";
				$url_str .= "&ret_dir=cart";
                $url_str .= "&item_id=".$item_id;
                $url_str .= "&parent_cat_id=".$parent_cat_id;
				$url_str .= "&upload_new_img=1";
                $url_str .= "&cat_id=".$cat_id;

    ?>
    <div class="top_link"> 
    <a id="upload_pre_crop" >Upload new Image
    <div class="e_sub" id="<?php echo $url_str; ?>"></div>
    </a>
    </div>


	<?php 
				$url_str = "select-image.php";
                $url_str .= "?ret_page=add-item";
				$url_str .= "&top_cat_id=".$parent_cat_id;                
				$url_str .= "&parent_cat_id=".$parent_cat_id;
                $url_str .= "&cat_id=".$cat_id;
        		$url_str .= "&src=inline";
				$url_str .= "&parent_item_id=".$parent_item_id;				       
        		$url_str .= "&action=selectexisting";       
	?>
    
    <div class="top_link">
     <a href="<?php echo $url_str; ?>">Select Existing Image</a>
    </div>







	<?php if($parent_item_id > 0){ ?>
    <div class="top_link">
       <span id="copy_from_parent" style="text-decoration:underline; cursor:pointer;"><a>Copy from parent</a></span>
    </div>

    <div class="top_link">
        <span id="copy_from_sibling" style="text-decoration:underline; cursor:pointer;"><a>Copy from sibling</a></span>
    </div>
	<?php } ?>

    
    <div class="manage_main">

	<?php
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
       
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	
	
	?>


<?php //echo "cat_id  ".$cat_id; ?>
	
    <form name="add_item" action="item.php?cat_id=<?php echo $cat_id; ?>" method="post"  
        	onsubmit="return validate(this)"  enctype="multipart/form-data">
        
      	<input id="item_id" type="hidden" name="item_id" value="<?php echo $item_id;  ?>" />
        <input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
        <input type="hidden" name="parent_cat_id" value="<?php echo $parent_cat_id; ?>" />
        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
         <input type="hidden" name="parent_item_id" value="<?php echo $parent_item_id; ?>" />
            
		<table border="0" cellpadding="10" width="100%">
		<!--
   		<tr>
        	<td colspan="2">           
            <div class="form_label">Parent Item Id</div>	           
            
            <?php //echo $parent_item_id; ?>
            </td>
		</tr>
        -->
   		<tr>
        	<td colspan="2">           
            <div class="form_label">Item Name</div>	            
            <input type="text" name="name" value="<?php echo $_SESSION['temp_item_fields']['name']; ?>" maxlength="100" style="width:300px" />
            
            </td>
		</tr>

		<tr>
            <td colspan="2" align="left">
            <div class="form_label">Main Image</div>
            
			<div style='float:left;  width:400px;'>	
   				<?php
				
				

					$sql = "SELECT file_name FROM image
					WHERE img_id = '".$_SESSION['img_id']."'";
					$img_res = $dbCustom->getResult($db,$sql);
					;
					if($img_res->num_rows > 0){
						$img_obj = $img_res->fetch_object();
						$file_name = $img_obj->file_name;
					}else{
						$file_name = '';
					}
					
					echo "
					<div>If this is not the image you want, upoload another one.</div>
					<img src='".$ste_root."/ul_cart/".$domain."/cart/list/".$file_name."'>";			
            
			?>	
			
			
                
            </div>




            	<?php
				$s_date = date("m/d/Y",time()); 
				if(!isset($_SESSION['temp_item_fields']["date_inactive"])){	
					$v_date = "never";
				}else{
					$v_date = $_SESSION['temp_item_fields']["date_inactive"]; 
				}
				?>

			<div style='float:left;'>
            
            <div style="float:left; width:100px; padding-bottom:30px;"><span class="form_label">Date Active</span></div>
            <div style="float:left; padding-bottom:30px;">    
                <input type="text" name="date_active" id="datepicker1" value="<?php echo $s_date; ?>"  style="width:80px;"/>
                &nbsp;<span style="font-size:10px;">12:00am</span> 
            </div>
            
            
            <div class="clear"></div>
            
            
            
            <div style="float:left;  width:100px;"> <span class="form_label">Date Inactive</span></div>
            <div style="float:left;">   
            
                <input type="text" name="date_inactive" id="datepicker2" value="<?php echo $v_date; ?>"  style="width:80px;"/>
                &nbsp;<span style="font-size:10px;">11:59pm</span>
            </div>
            
            <div class="clear"></div>
            
            <div style="padding-top:4px;">
            <a href="#" id="clear_dates"><span style="font-size:12px;color:blue;">clear dates</span></a>
            </div>
            </div>
            
		</td>            
       </tr>
	</table>
 	
    
<br /><br />
    
     <fieldset>

     <table border="0" cellpadding="10" width="100%">
        
  		<tr>
        	<td>
        
            <div class="form_label">Show in store section?</div>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="show_in_cart" value="1" <?php if($_SESSION['temp_item_fields']['show_in_cart'] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="show_in_cart" value="0" <?php if($_SESSION['temp_item_fields']['show_in_cart'] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
  		<tr>
        	<td>
            <div class="form_label">Show in showroom?</div>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input id="in_shrm" onchange="setIsCloset()" type="radio" name="show_in_showroom" value="1" <?php if($_SESSION['temp_item_fields']['show_in_showroom'] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input id="not_in_shrm" onchange="setNotCloset()" type="radio" name="show_in_showroom" value="0" <?php if($_SESSION['temp_item_fields']['show_in_showroom'] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
        
        
  		<tr>
        	<td>
            <div class="form_label">Is closet?</div>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input id="is_clst" type="radio" name="is_closet" value="1" <?php if($_SESSION['temp_item_fields']["is_closet"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input id="is_not_clst" type="radio" name="is_closet" value="0" <?php if($_SESSION['temp_item_fields']["is_closet"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
        </table>

    </fieldset>
        
<br /><br />

    
    
    
    
    
    <fieldset>
    
    
    
    <div style="margin-left:15px;">
    	<a class="inline" href="#add_attribute">Add Attribute</a>
    </div>
	<?php 
	
	
	$sql = "SELECT attribute_id, attribute_name
			FROM  attribute
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
    $attr_res = mysql_query ($sql);
	if(!$attr_res)die(mysql_error());
	while($attr_row = mysql_fetch_object($attr_res)) {
		
		$sql = "SELECT opt_id, opt_name
				FROM  opt, attribute 
				WHERE opt.attribute_id = attribute.attribute_id
				AND opt.attribute_id = '".$attr_row->attribute_id."' 
				ORDER BY opt_id";
		$res = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows > 0){
			
			
			$block = '';
			
			
			//$block .= $_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id];
			
			$block .= "<div style='float:left; padding:15px;'>";
			$block .= "Set as main <input type='radio' name='main_attr_id' value='".$attr_row->attribute_id."'>";

			$block .= "<div class='form_label'>".stripslashes($attr_row->attribute_name)."</div>";
			$block .= "<select name='attr_".$attr_row->attribute_id."' >";		
			$block .= "<option value='0'>N/A</option>";
			while($opt_row = $res->fetch_object()) {
				
				
				if($_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id] == $opt_row->opt_id){
					$sel = "selected";	
				}else{
					$sel = '';	
				}
				
				$block .= "<option value='".$opt_row->opt_id."' $sel>".stripslashes($opt_row->opt_name)."</option>";
			}
			$block .= "</select>";
			$block .= "<br /><div class='form_label'>New Option</div>";
			$block .= "<input type='text' name='new_opt_".$attr_row->attribute_id."' style='width:85px;'>";
			$block .= "<input onclick='setNewOpt(".$attr_row->attribute_id.");' type='button' name='add_new_opt' value='Add' style='width:40px;'>";

			$block .= "</div>";
			echo $block;
		}
	}
	
	?>

       
       
</fieldset>
        
<br /><br />
       
    
    
    
    
    
    
    
    <fieldset>
    
    <table border="0" cellpadding="10" width="100%">
  		<tr>
        	<td>
           
            <div class="form_label">Flat Price</div>

            </td>
			<td>	            
            $<input type="text" name="price_flat" value="<?php echo $_SESSION['temp_item_fields']["price_flat"]; ?>" maxlength="10" style="width:50px" onblur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>
  
            <div class="form_label">Wholesale Price</div>

            </td>
			<td>	            
            $<input type="text" name="price_wholesale" value="<?php echo $_SESSION['temp_item_fields']["price_wholesale"]; ?>" maxlength="10" style="width:50px" onblur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>

            <div class="form_label">Percent Markup</div>

            </td>
			<td>	            
            %<input type="text" name="percent_markup" value="<?php echo $_SESSION['temp_item_fields']["percent_markup"]; ?>" maxlength="10" style="width:50px" onblur="checkPercent(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>

            <div class="form_label">Percent off</div>

            </td>
			<td>	            
            %<input type="text" name="percent_off" value="<?php echo $_SESSION['temp_item_fields']["percent_off"]; ?>" maxlength="10" style="width:40px" onblur="checkPercent(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>

            <div class="form_label">Amount off</div>

            </td>
			<td>	            
            $<input type="text" name="amount_off" value="<?php echo $_SESSION['temp_item_fields']["amount_off"]; ?>" maxlength="10" style="width:40px" onblur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>

  		<tr>
        	<td>

            <div class="form_label">Taxable?</div>

            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_taxable" value="1" <?php if($_SESSION['temp_item_fields']["is_taxable"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_taxable" value="0" <?php if($_SESSION['temp_item_fields']["is_taxable"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
  		<tr>
        	<td>

            <div class="form_label">Call for pricing?</div>

            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="call_for_pricing" value="1" <?php if($_SESSION['temp_item_fields']["call_for_pricing"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="call_for_pricing" value="0" <?php if($_SESSION['temp_item_fields']["call_for_pricing"] == 0) echo "checked";?> /> <span>no</span>
			</div>            
            </td>
		</tr>
        
        
      	</table>       
    
    
    </fieldset>
        
        
      <br /><br />  
        
        
        
        
        
    <fieldset>

     <table border="0" cellpadding="10" width="100%">
      
        
  		<tr>
        	<td>
 
            <div class="form_label">Is this a new product?</div>

            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_new_product" value="1" <?php if($_SESSION['temp_item_fields']["is_new_product"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_new_product" value="0" <?php if($_SESSION['temp_item_fields']["is_new_product"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
  		<tr>
        	<td>

            <div class="form_label">Is this a promotional product?</div>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_promo_product" value="1" <?php if($_SESSION['temp_item_fields']["is_promo_product"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_promo_product" value="0" <?php if($_SESSION['temp_item_fields']["is_promo_product"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
  		<tr>
        	<td>
        
            <div class="form_label">Allow back order?</div>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="allow_back_order" value="1" <?php if($_SESSION['temp_item_fields']["is_promo_product"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="allow_back_order" value="0" <?php if($_SESSION['temp_item_fields']["is_promo_product"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
        <!--
        
  		<tr>
        	<td>
        
            <div class="form_label">Finish</div>
            </td>
			<td>	            
            <input type="text" name="finish" value="<?php//echo $_SESSION['temp_item_fields']["finish"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
        <tr>
        	<td>
            
            <div class="form_label">Color</div>
            </td>
			<td>	            
            <input type="text" name="color" value="<?php//echo $_SESSION['temp_item_fields']["color"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>

  		
  		<tr>
        	<td>
            
            <div class="form_label">Height</div>
            </td>
			<td>	            
            <input type="text" name="height" value="<?php//echo $_SESSION['temp_item_fields']["height"]; ?>" style="width:40px" onblur="checkNum(this)" />
            </td>
		</tr>
  		<tr>
        	<td>
            <div class="form_label">Width</div>
            </td>
			<td>	            
            <input type="text" name="width" value="<?php//echo $_SESSION['temp_item_fields']["width"]; ?>" style="width:40px" onblur="checkNum(this)" />
            </td>
		</tr>
        -->
        
  		<tr>
        	<td>
           
            <div class="form_label">Product number</div>
            </td>
			<td>	            
            <input type="text" name="prod_number" value="<?php echo $_SESSION['temp_item_fields']["prod_number"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
  		<tr>
        	<td>
           
            <div class="form_label">SKU</div>
            </td>
			<td>	            
            <input type="text" name="sku" value="<?php echo $_SESSION['temp_item_fields']["sku"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
  		<tr>
        	<td>
            
            <div class="form_label">UPC</div>
            </td>
			<td>	            
            <input type="text" name="upc" value="<?php echo $_SESSION['temp_item_fields']["upc"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
        
        
        <tr>
        <td>
        	
          <div class="form_label">Brand</div>

        </td>
        <td>
		<?php
               $block = "<select name='brand_id' class='form_select_small'>";
				$sql = "SELECT name, brand_id 
				FROM brand
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				
				$res = $dbCustom->getResult($db,$sql);
				
				
				$block .= "<option value='0'>none</option>";
				while($b_row = $res->fetch_object()) {
					$sel = ($b_row->brand_id == $_SESSION['temp_item_fields']["brand_id"])? "selected": ''; 
					$block .= "<option value='".$b_row->brand_id."' $sel>$b_row->name</option>";
                }
				$block .= "</select>";
                echo $block;
				
		?>
        </td>
        </tr> 
        
        
        <tr>
        	<td>
           
            <div class="form_label">Weight</div>
            </td>
			<td>	            
            <input type="text" name="weight" value="<?php echo $_SESSION['temp_item_fields']["weight"]; ?>" style="width:40px" onblur="checkNum(this)" />
            </td>
		</tr>
        
        
        
        <tr>
        	<td>
           
            <div class="form_label">Shipping flat charge</div>
            </td>
			<td>	            
            <input type="text" name="shipping_flat_charge" value="<?php echo $_SESSION['temp_item_fields']["shipping_flat_charge"]; ?>" style="width:40px" onblur="checkNum(this)" />
            </td>
		</tr>
        
        
        
        
        
        <!--
        <tr>
        <td>
        	
                    	<div class="form_label">Style</div>

        </td>
        <td>
		<?php
				/*
                $block = "<select name='style_id' class='form_select_small'>";
				$sql = "SELECT name, style_id FROM style";
				$s_res = $dbCustom->getResult($db,$sql);
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->style_id == $_SESSION['temp_item_fields']["style_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->style_id."' $sel>$s_row->name</option>";
                }
				$block .= "</select>";
                echo $block;
				*/
		?>
        </td>
        </tr>             

        
        
  		<tr>
        	<td>
            <div class="form_label">Type</div>

            </td>
			<td>	            
            
			<?php
			/*
                $block = "<select name='type_id' class='form_select_small'>";
				$sql = "SELECT type_id, name FROM type";
				$s_res = $dbCustom->getResult($db,$sql);
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->type_id == $_SESSION['temp_item_fields']["type_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->type_id."' $sel>$s_row->name</option>";
                }
				$block .= "</select>";
				echo $block;
			*/			
			?>
            
            
            
            </td>
		</tr>
        

  		<tr>
        	<td>
 
            <div class="form_label">Lead time</div>

            </td>
			<td>
			<?php
			/*
                $block = "<select name='lead_time_id' class='form_select_small'>";
				$sql = "SELECT lead_time_id, lead_time FROM lead_time";
				$s_res = $dbCustom->getResult($db,$sql);
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->lead_time_id == $_SESSION['temp_item_fields']["lead_time_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->lead_time_id."' $sel>$s_row->lead_time</option>";
                }
				$block .= "</select>";
                echo $block;
			*/
			?>
            </td>
		</tr>
        
        
        <tr>
        <td>
      
            <div class="form_label">Skill level</div>

        </td>
        <td>
        
		<?php
        /*
		        $block = "<select name='skill_level_id' class='form_select_small'>";
				$sql = "SELECT skill_level_id, level_name FROM skill_level ORDER BY skill_level_id";
				$s_res = $dbCustom->getResult($db,$sql);
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->skill_level_id == $_SESSION['temp_item_fields']["skill_level_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->skill_level_id."' $sel>$s_row->level_name</option>";
                }
				$block .= "</select>";
                echo $block;
			*/	
		?>
        </td>
        </tr>             
        
        -->
        
        <tr>
        <td>
 
            <div class="form_label">Return to</div>

        </td>
        <td>
		<?php
                $block = "<select name='return_to_id' class='form_select_small'>";
				$sql = "SELECT return_to_id, name 
						FROM return_to
						WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				$s_res = $dbCustom->getResult($db,$sql);
				
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->return_to_id == $_SESSION['temp_item_fields']["return_to_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->return_to_id."' $sel>$s_row->name</option>";
                }
				$block .= "</select>";
                echo $block;
				
		?>
        </td>
        </tr>         
        
        
        <tr>
        <td>

            <div class="form_label">Ship portal</div>

        </td>
        <td>
		<?php
                $block = "<select name='ship_port_id' class='form_select_small'>";
				$sql = "SELECT ship_port_id, name 
						FROM ship_port
						WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				$s_res = $dbCustom->getResult($db,$sql);
				
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->ship_port_id == $_SESSION['temp_item_fields']["ship_port_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->ship_port_id."' $sel>$s_row->name</option>";
                }
				$block .= "</select>";
                echo $block;
				
		?>
        </td>
        </tr>             
        
        
        
        
        
  		<tr>
        	<td>

            <div class="form_label">Is drop shipped?</div>

            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_drop_shipped" value="1" <?php if($_SESSION['temp_item_fields']["is_drop_shipped"] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_drop_shipped" value="0" <?php if($_SESSION['temp_item_fields']["is_drop_shipped"] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>
        
        </table>

    </fieldset>
        
<br /><br />


   <fieldset>
        
     <table border="0" cellpadding="10" width="100%">


        <tr>
        <td>
        <!--
		<div style="float:left; width:280px;">
            <div class="form_label">Parent Item</div>
			<?php
			/*
                $block = "<select name='parent_item_id'>";
				$sql = "SELECT item_id, name FROM item";
				$s_res = $dbCustom->getResult($db,$sql);
				$block .= "<option value='0'>none</option>";
				while($s_row = mysql_fetch_object($s_res)) {
					$sel = ($s_row->item_id == $_SESSION['temp_item_fields']["parent_item_id"])? "selected": ''; 					
					$block .= "<option value='".$s_row->item_id."' $sel>$s_row->item_id --> $s_row->name</option>";
				}
				$block .= "</select>";
                echo $block;
				*/
			?>
        </div>
		-->
        			

        
        
   		<div style="float:left; width:280px;">
            <div class="form_label">Categories</div>
			<?php
			//print_r($_SESSION['temp_cat_ids']);
			
			//unset($_SESSION['temp_cat_ids']);
			if(!isset($_SESSION['temp_cat_ids'])){
				
				$_SESSION['temp_cat_ids'] = array();
				
				$sql = "SELECT DISTINCT name, cat_id 
				FROM category, child_cat_to_parent_cat 
				WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
				AND category.profile_account_id = '".$_SESSION['profile_account_id']."' 
				ORDER BY name";
				$cat_res = mysql_query ($sql);
				$i = 0;
				while($cat_row = $cat_res->fetch_object()) {
					$_SESSION['temp_cat_ids'][$i]['cat_id'] = $cat_row->cat_id;
					$_SESSION['temp_cat_ids'][$i]['name'] = $cat_row->name;
					if($cat_id == $cat_row->cat_id){
						$_SESSION['temp_cat_ids'][$i]["checked"] = 1;
					}else{
						$_SESSION['temp_cat_ids'][$i]["checked"] = 0;						
					}
					$i++;
				}
			}
			if(count($_SESSION['temp_cat_ids']) > 0){
				$block = '';
				foreach($_SESSION['temp_cat_ids'] as $val){
					$checked = ($val["checked"]) ? "checked" : '';
					$block .= "<input name='cat_ids' type='checkbox' value='".$val['cat_id']."' $checked>";
					//$block .= "<input name='cat_ids' type='checkbox' value='99'>";
					$block .= "<span class='form_label'>".$val['name']."</span><br /><br />";
				}
			echo $block;
			}
			
			//print_r($_SESSION['temp_cat_ids']);
			
			?>
        </div>
    
        
        
		<div style="float:left;">
        
            
            <div class="form_label">Key words</div>
                        <?php
						
						$i = 0;
						
            if(isset($_SESSION["temp_key_words"])){
				
				
				if(is_array($_SESSION["temp_key_words"])){
				
					foreach ($_SESSION["temp_key_words"] as $key_word) {
						$i++;
						$block = '';
						$block .= "<div style='float:left; width:80px;'>";
						$block .= $key_word;
						$block .= "</div>";
						$block .= "<div style='float:left;'>";
						$block .= "<a class='inline' href='#del_keyword'>delete<div class='e_sub' id='".$key_word."' style='display:none'></div></a>";	
						$block .= "</div>";
						$block .= "<div class='clear'></div>";
						echo $block;
						
					}
					
					
//echo $key_word." &nbsp;&nbsp;&nbsp;&nbsp; <a class='inline' href='#del_keyword'>delete<div class='e_sub' id='".$key_word."' style='display:none'></div></a><br />";
				
				
				
				}				
			}
			

			echo "<input type='hidden' name='key_word_count' value='".$i."' />";

			
			  echo "<a class='inline' href='#add_keyword'>Add keyword<br />";
            
			
			
			//print_r($_SESSION["temp_key_words"]);
			
			?>

		</div>            
            		        
                            

            </td>
        </tr>
        
        </table>
    </fieldset>

<br /><br />        
        
     <table border="0" cellpadding="10" width="100%">
        <tr>
			<td colspan="2">
   
            <div class="form_label">Short Description (used as primary description)</div>

	        <textarea class="selector_1"  name="short_description" rows="2" cols="80" style="width: 450px" ><?php echo $_SESSION['temp_item_fields']["short_description"]; ?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2">

            <div class="form_label">Description (used as detailed description)</div>

	        <textarea class="selector_2"  name="description" rows="4" cols="80" style="width: 450px"><?php echo $_SESSION['temp_item_fields']['description']; ?></textarea>
            </td>
        </tr>        
        <tr>
			<td colspan="2">

            <div class="form_label">Back order message</div>

	        <textarea  name="back_order_message" rows="2" cols="80" style="width: 450px" ><?php echo $_SESSION['temp_item_fields']["back_order_message"]; ?></textarea>
            </td>
        </tr>     
        <tr>
			<td colspan="2">

            <div class="form_label">In stock message</div>

	        <textarea  name="in_stock_message" rows="2" cols="80" style="width: 450px" ><?php echo $_SESSION['temp_item_fields']["in_stock_message"]; ?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2">
            <div class="form_label">Additional information</div>

	        <textarea  name="additional_information" rows="2" cols="80" style="width: 450px"><?php echo $_SESSION['temp_item_fields']["additional_information"]; ?></textarea>
            </td>
        </tr>









   		<tr>
            <td colspan="2">
            <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input name="add_item" type="submit" value="add" />
            </div>
            
            
            
            <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onclick="location.href = 'item.php?cat_id=<?php echo $cat_id; ?>'; " />
            </div>
            <div class="clear"></div>
            </td>        
        </tr>     
        </table>
        </form>
		<br /><br /><br />
       
   
</div>


 <p class="clear"></p>
    <?php 
    require_once("../admin-includes/manage-footer.php");
    ?>




<p class="clear"></p>
</div>



	<div style="display:none">
        <div id="add_attribute" style="width:300px; height:140px;">
      
        </div>
	</div>

<div style="display:none">
        <div id="add_keyword" style="width:200px; height:80px;">
      
        </div>
</div>

<div style="display:none">
        <div id="del_keyword" style="width:200px; height:180px;">
   
        </div>
</div> 



</body>
</html>




