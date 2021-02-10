<?php

// NOTE: add a for validate function to check if another child item has the same attributes selected.


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Item";
$page_group = "item";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(!isset($_SESSION["top_cat_id"])) $_SESSION["top_cat_id"] = '';
$top_cat_id =  (isset($_REQUEST['top_cat_id'])) ? $_REQUEST['top_cat_id'] : $_SESSION["top_cat_id"];
if($top_cat_id == '') $top_cat_id = 0;



if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = 0;
$parent_cat_id =  (isset($_REQUEST['parent_cat_id'])) ? $_REQUEST['parent_cat_id'] : $_SESSION['parent_cat_id'];


if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = 0;

$cat_id =  (isset($_REQUEST['cat_id'])) ? $_REQUEST['cat_id'] : $_SESSION['cat_id'];



//$parent_item_id =  (isset($_GET['parent_item_id'])) ? $_GET['parent_item_id'] : 0;




if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;
if(!isset($_SESSION['new_img_id'])) $_SESSION['new_img_id'] = 0;



if(!isset($_SESSION["action"])) $_SESSION["action"] = '';
$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : $_SESSION["action"];
$_SESSION["action"] = '';



$item_id =  (isset($_REQUEST['item_id'])) ? $_REQUEST['item_id'] : $_SESSION["item_id"];
if($item_id == '') $item_id = 0;


//echo $item_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if($action == "add_media"){		
	$media_id =  (isset($_REQUEST['media_id'])) ? $_REQUEST['media_id'] : 0;
	//echo "media_id ".$media_id;
	if($media_id > 0){
		$sql = "INSERT INTO item_to_media 
				(media_id, item_id) 
				VALUES( '".$media_id."', '".$item_id."')";
$result = $dbCustom->getResult($db,$sql);		
	}
}

if(isset($_POST["del_from_media"])){
	$media_id = $_POST["media_id"];
	//echo "media_id".$media_id;
	$sql = sprintf("DELETE FROM item_to_media WHERE media_id = '%u' AND item_id = '%u'", $media_id, $item_id);
	$result = $dbCustom->getResult($db,$sql);
	
}


//echo "----------  action   ".$action."----".$_SESSION["action"]."<br />";

if($action == "add_gallery_img" && $_SESSION['new_img_id'] > 0){		


	$sql = "INSERT INTO item_gallery 
			(img_id, item_id) 
			VALUES( '".$_SESSION['new_img_id']."', '".$item_id."')";
$result = $dbCustom->getResult($db,$sql);	


}


//echo "item_id:  ".$item_id."<br />";


$sql = sprintf("SELECT * FROM item WHERE item_id = '%u'", $item_id);
$result = $dbCustom->getResult($db,$sql);



if($result->num_rows > 0){
	$object = $result->fetch_object();

	if($_SESSION['new_img_id'] > 0){
		$_SESSION['img_id'] = $_SESSION['new_img_id'];			
	}else{
		$_SESSION['img_id'] = $object->img_id;	
	}

	//echo $_SESSION['new_img_id']."<br />";
	//echo $_SESSION['img_id'];

	$_SESSION['new_img_id'] = 0;
	
	
	$parent_item_id = $object->parent_item_id;

	if($object->date_active == "0000-00-00 00:00:00"){
		$date_active = date("m/d/Y",time());
	}else{
		$date_active = date("m/d/Y",strtotime($object->date_active));
	}
		
	if($object->date_inactive == "3000-12-12 00:00:00"){
		$date_inactive = "never";
	}else{
		$date_inactive = date("m/d/Y",strtotime($object->date_inactive));
	}
	if(!isset($_SESSION['temp_item_fields']["date_active"])) $_SESSION['temp_item_fields']["date_active"] = $date_active;
	if(!isset($_SESSION['temp_item_fields']["date_inactive"])) $_SESSION['temp_item_fields']["date_inactive"] = $date_inactive;	
	if(!isset($_SESSION['temp_item_fields']["parent_item_id"])) $_SESSION['temp_item_fields']["parent_item_id"] = $object->parent_item_id;	


	if(!isset($_SESSION['temp_item_fields']["main_attr_id"])) $_SESSION['temp_item_fields']["main_attr_id"] = $object->main_attr_id;

	if(!isset($_SESSION['temp_item_fields']['name'])) $_SESSION['temp_item_fields']['name'] = $object->name;
	if(!isset($_SESSION['temp_item_fields']["price_flat"])) $_SESSION['temp_item_fields']["price_flat"] = $object->price_flat;	
	if(!isset($_SESSION['temp_item_fields']["price_wholesale"])) $_SESSION['temp_item_fields']["price_wholesale"] = $object->price_wholesale;	
	if(!isset($_SESSION['temp_item_fields']["percent_markup"])) $_SESSION['temp_item_fields']["percent_markup"] = $object->percent_markup;	
	if(!isset($_SESSION['temp_item_fields']["percent_off"])) $_SESSION['temp_item_fields']["percent_off"] = $object->percent_off;	
	if(!isset($_SESSION['temp_item_fields']["amount_off"])) $_SESSION['temp_item_fields']["amount_off"] = $object->amount_off;	
	if(!isset($_SESSION['temp_item_fields']["call_for_pricing"])) $_SESSION['temp_item_fields']["call_for_pricing"] = $object->call_for_pricing;	
	if(!isset($_SESSION['temp_item_fields']["is_new_product"])) $_SESSION['temp_item_fields']["is_new_product"] = $object->is_new_product;	
	if(!isset($_SESSION['temp_item_fields']["is_promo_product"])) $_SESSION['temp_item_fields']["is_promo_product"] = $object->is_promo_product;	
	if(!isset($_SESSION['temp_item_fields']["allow_back_order"])) $_SESSION['temp_item_fields']["allow_back_order"] = $object->allow_back_order;
	//if(!isset($_SESSION['temp_item_fields']["style_id"])) $_SESSION['temp_item_fields']["style_id"] = $object->style_id;	
	if(!isset($_SESSION['temp_item_fields']["is_taxable"])) $_SESSION['temp_item_fields']["is_taxable"] = $object->is_taxable;	
	if(!isset($_SESSION['temp_item_fields']["prod_number"])) $_SESSION['temp_item_fields']["prod_number"] = $object->prod_number;	
	if(!isset($_SESSION['temp_item_fields']["vend_man_id"])) $_SESSION['temp_item_fields']["vend_man_id"] = $object->vend_man_id;
	
	if(!isset($_SESSION['temp_item_fields']["brand_id"])) $_SESSION['temp_item_fields']["brand_id"] = $object->brand_id;
	
	
	if(!isset($_SESSION['temp_item_fields']["sku"])) $_SESSION['temp_item_fields']["sku"] = $object->sku;	
	if(!isset($_SESSION['temp_item_fields']["upc"])) $_SESSION['temp_item_fields']["upc"] = $object->upc;	
	if(!isset($_SESSION['temp_item_fields']["short_description"])) $_SESSION['temp_item_fields']["short_description"] = $object->short_description;	
	if(!isset($_SESSION['temp_item_fields']['description'])) $_SESSION['temp_item_fields']['description'] = $object->description;	
	if(!isset($_SESSION['temp_item_fields']["back_order_message"])) $_SESSION['temp_item_fields']["back_order_message"] = $object->back_order_message;	
	if(!isset($_SESSION['temp_item_fields']["in_stock_message"])) $_SESSION['temp_item_fields']["in_stock_message"] = $object->in_stock_message;	
	if(!isset($_SESSION['temp_item_fields']["additional_information"])) $_SESSION['temp_item_fields']["additional_information"] = $object->additional_information;	
	//if(!isset($_SESSION['temp_item_fields']["type_id"])) $_SESSION['temp_item_fields']["type_id"] = $object->type_id;	
	//if(!isset($_SESSION['temp_item_fields']["lead_time_id"])) $_SESSION['temp_item_fields']["lead_time_id"] = $object->lead_time_id;	
	//if(!isset($_SESSION['temp_item_fields']["skill_level_id"])) $_SESSION['temp_item_fields']["skill_level_id"] = $object->skill_level_id;	
	if(!isset($_SESSION['temp_item_fields']["ship_port_id"])) $_SESSION['temp_item_fields']["ship_port_id"] = $object->ship_port_id;	
	if(!isset($_SESSION['temp_item_fields']["return_to_id"])) $_SESSION['temp_item_fields']["return_to_id"] = $object->return_to_id;	
	if(!isset($_SESSION['temp_item_fields']["is_drop_shipped"])) $_SESSION['temp_item_fields']["is_drop_shipped"] = $object->is_drop_shipped;	

	if(!isset($_SESSION['temp_item_fields']["is_closet"])) $_SESSION['temp_item_fields']["is_closet"] = $object->is_closet;	
	if(!isset($_SESSION['temp_item_fields']['show_in_cart'])) $_SESSION['temp_item_fields']['show_in_cart'] = $object->show_in_cart;	
	if(!isset($_SESSION['temp_item_fields']['show_in_showroom'])) $_SESSION['temp_item_fields']['show_in_showroom'] = $object->show_in_showroom;	
		
	if(!isset($_SESSION['temp_item_fields']["shipping_flat_charge"])) $_SESSION['temp_item_fields']["shipping_flat_charge"] = $object->shipping_flat_charge;	
	if(!isset($_SESSION['temp_item_fields']["weight"])) $_SESSION['temp_item_fields']["weight"] = $object->weight;	







		
	$sql = "SELECT attribute_id, attribute_name
			FROM  attribute
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
    $attr_res = mysql_query ($sql);
	if(!$attr_res)die(mysql_error());
	$is_attributes = 0;
	while($attr_row = mysql_fetch_object($attr_res)) {
		$is_attributes = 1;


		
		if(!isset($_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id])){



			$_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id] = 0;


			
			$sql = "SELECT opt_id, opt_name
					FROM  opt, attribute 
					WHERE opt.attribute_id = attribute.attribute_id
					AND opt.attribute_id = '".$attr_row->attribute_id."' 
					ORDER BY opt_id";
			$res = $dbCustom->getResult($db,$sql);
			
			
			if($res->num_rows > 0){
				while($opt_row = $res->fetch_object()) {
					$sql = "SELECT item_to_opt_id
							FROM  item_to_opt 
							WHERE opt_id = '".$opt_row->opt_id."'
							AND item_id = '".$item_id."'";
					$ch_res = mysql_query ($sql);
					if(!$ch_res)die(mysql_error());
					if(mysql_num_rows($ch_res)){
						$_SESSION['temp_item_fields']["attr_".$attr_row->attribute_id] = $opt_row->opt_id;
					}
				}
			}
		}
	}
		
		
		
		
		
	
}



if(isset($_POST["del_from_gallery"])){
	
	$item_gallery_id = $_POST["item_gallery_id"];

	//echo "item_gallery_id".$item_gallery_id;

	$sql = sprintf("DELETE FROM item_gallery WHERE item_gallery_id = '%u'", $item_gallery_id);
	$result = $dbCustom->getResult($db,$sql);
	


}

if(isset($_POST["del_keyword"])){
	$key_words_id = $_POST["key_words_id"];
	//echo $key_words_id."<br />";
	//exit;
	$sql = "DELETE FROM key_words WHERE key_words_id = '".$key_words_id."'";
	$kw_res = mysql_query ($sql);
	if(!$kw_res)die(mysql_error());
}


if(isset($_POST["add_keyword"])){
	$word = $_POST["word"];
	//echo $item_id."<br />";
	//echo $word;
	$sql = "INSERT INTO key_words 
	(item_id, word)
	VALUES
	('".$item_id."','".$word."')";      
	$kw_res = mysql_query ($sql);
	if(!$kw_res)die(mysql_error());
}



	
if(isset($_POST["add_attribute"])){

	$added_attribute = addslashes($_POST["added_attribute"]); 
	$first_option = addslashes($_POST["first_option"]);
	
	
	
	$sql = sprintf("SELECT attribute_id 
					FROM attribute 
					WHERE attribute_name = '%s'
					AND profile_account_id = '$u'", $added_attribute, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	
	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO attribute (attribute_name, profile_account_id) VALUES ('%s','%u')", $added_attribute, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$attr_id = $db->insert_id;
		
		$sql = sprintf("INSERT INTO opt (opt_name, attribute_id) VALUES ('%s','%u')", $first_option, $attr_id);
		$result = $dbCustom->getResult($db,$sql);
		

		$_SESSION['temp_item_fields']["attr_".$attr_id];
		
		//$msg = "Your change is now live.";
	}else{
		//$msg = "The attribute name already exists";
	}
	
	
	
	
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>




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
	
	if(theform.key_word_count.value < 1){
		alert("Please enter at least 1 key word");
		return false;				
	}	

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
	
	<?php } }?>

	alert("Item Updated");


	//return false;

	return true;

}

function select_img(img_id){	
	document.getElementById("r"+img_id).checked = true;		
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
	
	
	//alert("JJJJJJ");
	
	var query_str = '';
	var str_cats = '';

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
	
	
		for(i = 0; i < document.edit_item.elements.length; i++)
		{
			
			
			if(document.edit_item.elements[i].name == '<?php echo $nn; ?>'){
				is_in_form = 1;
				//alert(i);
					
			}
		}
		if(is_in_form){
			
			if(query_str.indexOf("&<?php echo $nn; ?>="+document.edit_item.<?php echo $nn; ?>.value) < 0){
				query_str += "&<?php echo $nn; ?>="+document.edit_item.<?php echo $nn; ?>.value;
			}
		}
	
		//alert(query_str);

	
	<?php
	}
	?>
	//alert("kkkkkkkkk"+query_str);

	
	<?php if($is_attributes){ ?>
	for(var i = 0; i < document.edit_item.main_attr_id.length; i++  ){
		if(document.edit_item.main_attr_id[i].checked){
			query_str += "&main_attr_id="+document.edit_item.main_attr_id[i].value;
			
			break;
		}
	}
	<?php } ?>



	if(typeof(document.edit_item.cat_ids) == "undefined"){
		alert("Please add a category for this item");
	}else{
		
		//alert(document.edit_item.cat_ids.length);
		
		
		for(var i=0; i < document.edit_item.cat_ids.length; i++){
			
			str_cats = str_cats + document.edit_item.cat_ids[i].value+"|";  
			
			if(document.edit_item.cat_ids[i].checked){
				str_cats = str_cats + 1;
			}else{
				str_cats = str_cats + 0;
			}
			if(i < document.edit_item.cat_ids.length - 1){
				str_cats = str_cats + ",";
			}
			
		}
		
		
	}
		

	//alert(str_cats);

	query_str += "&str_cats="+str_cats;



	query_str += "&item_id="+document.edit_item.item_id.value; 

	query_str += "&date_active="+document.edit_item.date_active.value; 
    query_str += "&date_inactive="+document.edit_item.date_inactive.value; 
    //query_str += "&parent_item_id="+document.edit_item.parent_item_id.value; 
    
	
	//alert(document.edit_item.parent_item_id.value);
	
	
	
	query_str += "&name="+document.edit_item.name.value; 

	query_str += "&price_flat="+document.edit_item.price_flat.value;
    query_str += "&price_wholesale="+document.edit_item.price_wholesale.value;
    query_str += "&percent_markup="+document.edit_item.percent_markup.value;
    query_str += "&percent_off="+document.edit_item.percent_off.value;
    query_str += "&amount_off="+document.edit_item.amount_off.value;
	
	
	
	
	
	for(var i = 0; i < document.edit_item.call_for_pricing.length; i++  ){
		if(document.edit_item.call_for_pricing[i].checked){
			query_str += "&call_for_pricing="+document.edit_item.call_for_pricing[i].value;
			break;
		}
	}

	for(var i = 0; i < document.edit_item.is_new_product.length; i++  ){
		if(document.edit_item.is_new_product[i].checked){
			query_str += "&is_new_product="+document.edit_item.is_new_product[i].value;
			
			break;
		}
	}

	for(var i = 0; i < document.edit_item.is_promo_product.length; i++  ){
		if(document.edit_item.is_promo_product[i].checked){
			query_str += "&is_promo_product="+document.edit_item.is_promo_product[i].value;
			break;
		}
	}

	for(var i = 0; i < document.edit_item.allow_back_order.length; i++  ){
		if(document.edit_item.allow_back_order[i].checked){
			query_str += "&allow_back_order="+document.edit_item.allow_back_order[i].value;
			break;
		}
	}

    query_str += "&brand_id="+document.edit_item.brand_id.value;
	//query_str += "&style_id="+document.edit_item.style_id.value;
    query_str += "&is_taxable="+document.edit_item.is_taxable.value;
	
	for(var i = 0; i < document.edit_item.is_taxable.length; i++  ){
		if(document.edit_item.is_taxable[i].checked){
			query_str += "&is_taxable="+document.edit_item.is_taxable[i].value;
			break;
		}
	}
	
    query_str += "&prod_number="+document.edit_item.prod_number.value;
    query_str += "&sku="+document.edit_item.sku.value;
    query_str += "&upc="+document.edit_item.upc.value;
    query_str += "&short_description="+document.edit_item.short_description.value;
    query_str += "&description="+document.edit_item.description.value; 
    query_str += "&back_order_message="+document.edit_item.back_order_message.value;
    query_str += "&in_stock_message="+document.edit_item.in_stock_message.value;
    query_str += "&additional_information="+document.edit_item.additional_information.value;
		
    query_str += "&shipping_flat_charge="+document.edit_item.shipping_flat_charge.value;
    query_str += "&weight="+document.edit_item.weight.value;

	//query_str += "&type_id="+document.edit_item.type_id.value;
	
    //query_str += "&lead_time_id="+document.edit_item.lead_time_id.value;
	//query_str += "&skill_level_id="+document.edit_item.skill_level_id.value;
	query_str += "&return_to_id="+document.edit_item.return_to_id.value;
	
    query_str += "&ship_port_id="+document.edit_item.ship_port_id.value;



	

	for(var i = 0; i < document.edit_item.is_drop_shipped.length; i++  ){
		if(document.edit_item.is_drop_shipped[i].checked){
			query_str += "&is_drop_shipped="+document.edit_item.is_drop_shipped[i].value;
			break;
		}
	}


	for(var i = 0; i < document.edit_item.is_closet.length; i++  ){
		if(document.edit_item.is_closet[i].checked){
			query_str += "&is_closet="+document.edit_item.is_closet[i].value;
			break;
		}
	}

	for(var i = 0; i < document.edit_item.show_in_cart.length; i++ ){
		if(document.edit_item.show_in_cart[i].checked){
			query_str += "&show_in_cart="+document.edit_item.show_in_cart[i].value;
			break;
		}
	}

	for(var i = 0; i < document.edit_item.show_in_showroom.length; i++  ){
		if(document.edit_item.show_in_showroom[i].checked){
			query_str += "&show_in_showroom="+document.edit_item.show_in_showroom[i].value;
			break;
		}
	}





/*
	for(var i = 0; i < document.edit_item.charge_shipping.length; i++  ){
		if(document.edit_item.charge_shipping[i].checked){
			query_str += "&charge_shipping="+document.edit_item.charge_shipping[i].value;
			break;
		}
	}
*/





	
/*
	for(var i = 0; i < document.edit_item.img_id.length; i++){
		if(document.edit_item.img_id[i].checked){
			query_str += "&img_id="+document.edit_item.img_id[i].value;
			break;
		}
	}

*/

	



	
	
	
	
	//alert("Updated");
	
	
	return query_str;
}




function setNewOpt(attribute_id){	
	//alert("kkkk"+attribute_id);
	
			
			var q_str = "?action=1"+get_query_str();
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_set_item_session.php'+q_str,
			  success: function(data) {
				//$('#t').html(data);
				
				//alert(data);
				//alert('Load was performed.');
			  }
			});
		
	
	
	
	
	var optval = '';	
	var input = "document.edit_item.new_opt_"+attribute_id+".value";
	optval = eval(input);	
	//alert(optval);
						
	var q_str = "?action=add_new_opt&new_option="+optval+"&attr_id="+attribute_id+"&ret_page=edit-item";
			
			//alert(q_str);
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_attr_opt.php'+q_str,
			  success: function(data) {
				  
				 //alert(data); 
				//$('#add_new_opt').html(data);
				//alert('Load was performed.');
			  }
			});
		
		
			
	location.reload();



}




$(document).ready(function() {
	
	
		
	
	
	$("#edit_item_form").submit(function(){ 
		

			var q_str = "?action=1"+get_query_str();
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_set_item_session.php'+q_str,
			  success: function(data) {
				//$('#t').html(data);
				
				//alert(data);
				//alert('Load was performed.');
			  }
			});
			
			//setTimeout( arguments.callee, 100 );
			
			
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
			
			//alert(data);
			//$('#t').html(data);
			//alert('Load was performed.');
		  	
			window.location=f_id;
		  }
		});
	
	})
	
	
	
	$(".inline").click(function(){ 

		//alert("UUU");
		
			
			var q_str = "?action=1"+get_query_str();
			//alert(q_str);						
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_set_item_session.php'+q_str,
			  success: function(data) {
				
				alert(data);
				//$('#t').html(data);
				//alert('Load was performed.');
			  }
			});
			
		
		
		

		
		
		if(this.href.indexOf("add_attribute") > 1){
			//alert("kkkk");
			
			var q_str = "?action=add_attr&ret_page=edit-item";
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


		

		if(this.href.indexOf("add_keyword") > 1){
			var q_str = "?action=add&ret_page=edit-item&item_id=<?php echo $item_id; ?>";
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
			var q_str = "?action=del&ret_page=edit-item&item_id=<?php echo $item_id; ?>";
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			   url: 'ajax_keyword.php'+q_str+'&kw_id='+f_id+'&',
			  success: function(data) {
				$('#del_keyword').html(data);
				//alert('Load was performed.');
			  }
			});			
		}
		
		
		
		if(this.href.indexOf("del_gal_img") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("del_gal_img"));
			//alert(f_id);		
			var q_str = "?action=del&ret_page=edit-item&item_id=<?php echo $item_id; ?>";
			//alert('ajax_gallery.php'+q_str+'&item_gallery_id='+f_id+'&');
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			   url: 'ajax_gallery.php'+q_str+'&item_gallery_id='+f_id+'&',
			  success: function(data) {
				$('#del_gal_img').html(data);
				//alert('Load was performed gal img.');
			  }
			});			
		}





		if(this.href.indexOf("del_media") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("del_gal_img"));
			//alert(f_id);		
			var q_str = "?action=del&ret_page=edit-item&item_id=<?php echo $item_id; ?>";
			
			//alert('ajax_gallery.php'+q_str+'&item_gallery_id='+f_id+'&');
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			 
			   url: 'ajax_media.php'+q_str+'&media_id='+f_id+'&',
			  
			  success: function(data) {
				$('#del_media').html(data);
				//alert('Load was performed gal img.');
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
  	document.edit_item.is_closet[0].checked = true;
}

function setNotCloset(){	
  	document.edit_item.is_closet[1].checked = true;
}











</script>
</head>

<?php if($msg != ''){ ?>
	<body onLoad="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	// require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

	//print_r($_SESSION['temp_cat_ids']);

?>



<div class="manage_page_container">

<!--
<div id="t">TTTTTTTTTTT</div>
-->

    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	


    	<?php 
		/*
		$url_str = "upload.php";
		$url_str .= "?ret_page=edit-item";
		$url_str .= "&item_id=".$item_id;
		$url_str .= "&parent_cat_id=".$parent_cat_id;
		$url_str .= "&ret_cat_id=".$cat_id;
		$url_str .= "&cat_id=".$cat_id;
		*/
		?>
	<!--
    <div class="top_link">    
        <a class="inline" href="<?php//echo $url_str; ?>">Upload new Image</a>
    </div>
    -->


    	
    <div class="top_link">
        <a href='item.php?parent_cat_id=<?php echo $parent_cat_id; ?>'>Back</a>
    </div>




    <div class="manage_main">

	<?php
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
        
$db = $dbCustom->getDbConnect(CART_DATABASE);

//echo "bb<br />";
//print_r($_SESSION['temp_cat_ids']);
//print_r($_SESSION['temp_attribute_ids']);

?>


 
<form id="edit_item_form" name="edit_item" action="item.php?cat_id=<?php echo $cat_id; ?>&parent_cat_id=<?php echo $parent_cat_id; ?>" 
        	method="post"   enctype="multipart/form-data">
       	
   	<input id="item_id" type="hidden" name="item_id" value="<?php echo $item_id;  ?>" />
	<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
 	<input type="hidden" name="parent_cat_id" value="<?php echo $parent_cat_id; ?>" />
	<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
 	
    <!--
    <input type="hidden" name="parent_item_id" value="<?php//echo $_SESSION['temp_item_fields']["parent_item_id"]; ?>" />
    -->
    
    
    
    
        <table border="0" cellpadding="10" width="100%">
        <tr>
        	<td colspan="2">           
            <div class="form_label">Parent Item Id</div>	           
            
            <?php echo $_SESSION['temp_item_fields']["parent_item_id"]; ?>
            </td>
		</tr>
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
					<a class='inline' href='".$ste_root."/ul_cart/".$domain."/cart/".$file_name."'>
					<img src='".$ste_root."/ul_cart/".$domain."/cart/list/".$file_name."'>			
            		</a>";
			
                //$url_str = "upload.php";
                $url_str = $ste_root."manage/upload-pre-crop.php";               				
				$url_str .= "?ret_page=edit-item";
				$url_str .= "&ret_dir=cart";
                $url_str .= "&item_id=".$item_id;
                $url_str .= "&parent_cat_id=".$parent_cat_id;
				$url_str .= "&upload_new_img=1";
                $url_str .= "&cat_id=".$cat_id;
                ?>
                <div>    
                    <a id="upload_pre_crop" style="cursor:pointer; text-decoration:underline;" >Upload new Image
                    <div class="e_sub" id="<?php echo $url_str; ?>"></div>
                    </a>
                </div>
    	
        		<br />
                
                <?php 
				
				
				
				$url_str = $ste_root."manage/cart/select-image.php";
                $url_str .= "?ret_page=edit-item";
				$url_str .= "&item_id=".$item_id;
				$url_str .= "&top_cat_id=".$parent_cat_id;
				$url_str .= "&top_cat_id=".$parent_cat_id;                
				$url_str .= "&parent_cat_id=".$parent_cat_id;
                $url_str .= "&cat_id=".$cat_id;
        		$url_str .= "&src=inline";			       
        		$url_str .= "&action=selectexisting";       

				
				
				
                ?>
                
                <div>
                     <a class="inline" href="<?php echo $url_str; ?>">Select Image From Existing Images</a>
                </div>
                
    			
            </div>
         
         
 
         
         	
			<div style='float:left;'>
            
            <div style="float:left; width:100px; padding-bottom:30px;"><span class="form_label">Date Active</span></div>
            <div style="float:left; padding-bottom:30px;">    
                <input type="text" name="date_active" id="datepicker1" value="<?php echo $_SESSION['temp_item_fields']["date_active"]; ?>"  style="width:80px;"/>
                &nbsp;<span style="font-size:10px;">12:00am</span> 
            </div>
            
            
            <div class="clear"></div>
            
            
            
            <div style="float:left;  width:100px;"> <span class="form_label">Date Inactive</span></div>
            <div style="float:left;">   
            
                <input type="text" name="date_inactive" id="datepicker2" value="<?php echo $_SESSION['temp_item_fields']["date_inactive"]; ?>"  style="width:80px;"/>
                &nbsp;<span style="font-size:10px;">11:59pm</span>
            </div>
            
            
            
            <div class="clear"></div>
            
            
            <div style="padding-top:4px;">
            <a href="#" id="clear_dates"><span style="font-size:12px;color:blue;">clear dates</span></a>
            </div>
            
            
            
            
            </div>
         
         
     
            
		</td>            
       </tr>



        <tr>
            <td colspan="2" align="left">
              <div class="form_label">Gallery Images</div>

<?php
			
    $sql = sprintf("SELECT item_gallery.item_gallery_id
				   ,image.file_name
				   FROM item_gallery, image 
				   WHERE item_gallery.img_id = image.img_id 
				   AND item_gallery.item_id = '%u'", $item_id);
	
    $img_res = $dbCustom->getResult($db,$sql);
	;

		//echo $img_res->num_rows;
	
    $i = 1;
    while($img_row = $img_res->fetch_object()) {
		
		
    	$block = ''; 
        $block .= "<div class='img_box'>";
        $block .= "<img src='".$ste_root."/ul_cart/".$domain."/cart/list/".$img_row->file_name."'   />";
    	
		if(in_array(2,$user_functions_array)){	
			$block .= "<br /><a class='inline' href='#del_gal_img'>
			delete<div class='e_sub' id='".$img_row->item_gallery_id."' style='display:none'></div> </a>";
		}
		
        $block .= "</div>";
        if($i % 8 == 0) $block .= "<div class='clear'></div>";
        $i++;
		echo $block;


    }
    
	?>


	<div class="clear"></div>
    
    	<?php 
			
		
		//$url_str = "upload.php";
        $url_str = "../upload-pre-crop.php";               				
		$url_str .= "?ret_page=edit-item";
		$url_str .= "&ret_dir=cart";
		$url_str .= "&item_id=".$item_id;
		$url_str .= "&parent_cat_id=".$parent_cat_id;
		$url_str .= "&cat_id=".$cat_id;
		$url_str .= "&upload_new_img=1";
		$url_str .= "&action=add_gallery_img";

		?>

    <div> 
       
        <a href="<?php echo $url_str; ?>">Upload gallary image</a>
    </div>



        
	    </td>
    </tr>     
    
    
    
    
            <tr>
            <td colspan="2" align="left">
              <div class="form_label">Documents or Media</div>

<?php
			
    $sql = sprintf("SELECT media.name, media.media_id 
				   FROM item_to_media, media 
				   WHERE item_to_media.media_id = media.media_id 
				   AND item_to_media.item_id = '%u' ", $item_id);
	
    $doc_result = mysql_query ($sql);
	if(!$doc_result)die(mysql_error());
	//echo mysql_num_rows($doc_result);
	
    while($doc_row = mysql_fetch_object($doc_result)) {
    	$block = ''; 
        $block .= "<div>";
        $block .= "<a href='".$ste_root."/ul_cart/".$domain."/media/".$doc_row->name."' >$doc_row->name</a>";
    	
		$block .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		if(in_array(2,$user_functions_array)){	
			$block .= "<a class='inline' href='#del_media'>
			delete<div class='e_sub' id='".$doc_row->media_id."' style='display:none'></div> </a>";
		}
		
        $block .= "</div>";
        $block .= "<div class='clear'></div>";
		echo $block;


    }
    
	?>


	<div class="clear"></div>
    
    	<?php $url_str = "upload.php";
		$url_str .= "?ret_page=edit-item";
		$url_str .= "&item_id=".$item_id;
		$url_str .= "&parent_cat_id=".$parent_cat_id;
		$url_str .= "&ret_cat_id=".$cat_id;
		$url_str .= "&cat_id=".$cat_id;
		$url_str .= "&action=add_media";

		?>

    <div>    
        <a class="inline" href="<?php echo $url_str; ?>">Upload document or media</a>
    </div>
        
	    </td>
    </tr>        
    </table>

	<br />
    
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
            <input type="radio" onChange="setIsCloset()" name="show_in_showroom" value="1" <?php if($_SESSION['temp_item_fields']['show_in_showroom'] == 1) echo "checked";?>/> <span>yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" onChange="setNotCloset()" name="show_in_showroom" value="0" <?php if($_SESSION['temp_item_fields']['show_in_showroom'] == 0) echo "checked";?>/> <span>no</span>
			</div>            
            </td>
		</tr>

  		<tr>
        	<td>
            <span class="form_label">Is closet</span>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_closet" value="1" <?php if($_SESSION['temp_item_fields']["is_closet"] == 1) echo "checked";?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_closet" value="0" <?php if($_SESSION['temp_item_fields']["is_closet"] == 0) echo "checked";?>/> <span class="form_label">no</span>
			</div>            
            </td>
		</tr>




        
            
</table>

	</fieldset>
	
    <br />
    
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
			$block .= "<div style='float:left; padding:15px;'>";
			
			
			$checked = ($_SESSION['temp_item_fields']["main_attr_id"] == $attr_row->attribute_id) ? "checked" : '' ;
			
			$block .= "Set as main <input type='radio' name='main_attr_id' value='".$attr_row->attribute_id."' $checked>";
			$block .= "<div class='form_label'>".stripslashes($attr_row->attribute_name)."</div>";
			$block .= "<select name='attr_".$attr_row->attribute_id."' style='width:130px;'>";		
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
	<br />

    <fieldset>
    
    <table border="0" cellpadding="10" width="100%">
 
 	<?php //if(in_array(4,$user_functions_array)){ ?>      	

  		<tr>
        	<td>
            <span class="form_label">Flat Price</span> <br />
            </td>
			<td>	            
            $<input type="text" name="price_flat" value="<?php echo $_SESSION['temp_item_fields']["price_flat"]; ?>" maxlength="10" style="width:50px" onBlur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">Wholesale Price</span><br />
            </td>
			<td>	            
            $<input type="text" name="price_wholesale" value="<?php echo $_SESSION['temp_item_fields']["price_wholesale"]; ?>" maxlength="10" style="width:50px" onBlur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">Percent Markup</span><br />
            </td>
			<td>	            
            %<input type="text" name="percent_markup" value="<?php echo $_SESSION['temp_item_fields']["percent_markup"]; ?>" maxlength="10" style="width:50px" onBlur="checkPercent(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">Percent off</span><br />
            </td>
			<td>	            
            %<input type="text" name="percent_off" value="<?php echo $_SESSION['temp_item_fields']["percent_off"]; ?>" maxlength="10" style="width:40px" onBlur="checkPercent(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">Amount off</span><br />
            </td>
			<td>	            
            $<input type="text" name="amount_off" value="<?php echo $_SESSION['temp_item_fields']["amount_off"]; ?>" maxlength="10" style="width:40px" onBlur="checkNum(this)" />
            (<i>numbers only</i>)
            </td>
		</tr>

  		<tr>
        	<td>
            <span class="form_label">Taxable?</span><br />
            </td>
			<td>
            <div style="float:left;">	            
            <input type="radio" name="is_taxable" value="1" <?php if($_SESSION['temp_item_fields']["is_taxable"]) echo "checked"; ?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_taxable" value="0" <?php if(!$_SESSION['temp_item_fields']["is_taxable"]) echo "checked"; ?>/> <span class="form_label">no</span>
			</div>            
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">Call for pricing?</span><br />
            </td>
			<td>
            <div style="float:left;">	            
            <input type="radio" name="call_for_pricing" value="1" <?php if($_SESSION['temp_item_fields']["call_for_pricing"]) echo "checked"; ?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="call_for_pricing" value="0"  <?php if(!$_SESSION['temp_item_fields']["call_for_pricing"]) echo "checked"; ?>/> <span class="form_label">no</span>
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
            <span class="form_label">Is this a new product?</span><br />
            </td>
			<td>
            <div style="float:left;">	            
            <input type="radio" name="is_new_product" value="1" <?php if($_SESSION['temp_item_fields']["is_new_product"]) echo "checked"; ?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_new_product" value="0" <?php if(!$_SESSION['temp_item_fields']["is_new_product"]) echo "checked"; ?>/> <span class="form_label">no</span>
			</div>            
            </td>
		</tr>
        
  		<tr>
        	<td>
            <span class="form_label">Is this a promotional product?</span><br />
            </td>
			<td>
            <div style="float:left;">	            
            <input type="radio" name="is_promo_product" value="1" <?php if($_SESSION['temp_item_fields']["is_promo_product"]) echo "checked"; ?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_promo_product" value="0" <?php if(!$_SESSION['temp_item_fields']["is_promo_product"]) echo "checked"; ?>/> <span class="form_label">no</span>
			</div>            
            </td>
		</tr>
        
        
        
        
        
  		<tr>
        	<td>
            <span class="form_label">Allow back order?</span><br />
            </td>
			<td>
            <div style="float:left;;">	            
            <input type="radio" name="allow_back_order" value="1" <?php if($_SESSION['temp_item_fields']["allow_back_order"]) echo "checked"; ?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="allow_back_order" value="0" <?php if(!$_SESSION['temp_item_fields']["allow_back_order"]) echo "checked"; ?>/> <span class="form_label">no</span>
			</div>            
            </td>
		</tr>







  		<tr>
        	<td>
            <span class="form_label">Product number</span>
            </td>
			<td>	            
            <input type="text" name="prod_number" value="<?php echo $_SESSION['temp_item_fields']["prod_number"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">SKU</span>
            </td>
			<td>	            
            <input type="text" name="sku" value="<?php echo $_SESSION['temp_item_fields']["sku"]; ?>" maxlength="100" style="width:300px" />
            </td>
		</tr>
  		<tr>
        	<td>
            <span class="form_label">UPC</span>
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
				$sql = "SELECT name, brand_id FROM brand
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
            <input type="text" name="weight" value="<?php echo $_SESSION['temp_item_fields']["weight"]; ?>" style="width:40px" onBlur="checkNum(this)" />
            </td>
		</tr>  
        
        <tr>
        	<td>
           
            <div class="form_label">Shipping flat charge</div>
            </td>
			<td>	            
            <input type="text" name="shipping_flat_charge" value="<?php echo $_SESSION['temp_item_fields']["shipping_flat_charge"]; ?>" style="width:40px" onBlur="checkNum(this)" />
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
            <span class="form_label">Lead time</span>
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
            <span class="form_label">Is drop shipped</span>
            </td>
			<td>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_drop_shipped" value="1" <?php if($_SESSION['temp_item_fields']["is_drop_shipped"] == 1) echo "checked";?>/> <span class="form_label">yes</span>
            </div>
            <div style="float:left; padding-left:46px;">	            
            <input type="radio" name="is_drop_shipped" value="0" <?php if($_SESSION['temp_item_fields']["is_drop_shipped"] == 0) echo "checked";?>/> <span class="form_label">no</span>
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
					
					if($s_row->item_id != $item_id){
						$sel = ($s_row->item_id == $_SESSION['temp_item_fields']["parent_item_id"])? "selected": ''; 					
						$block .= "<option value='".$s_row->item_id."' $sel>$s_row->item_id --> $s_row->name</option>";
					}
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
			if(!isset($_SESSION['temp_cat_ids'])){
				$sql = "SELECT DISTINCT name, cat_id 
				FROM category, child_cat_to_parent_cat 
				WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY name";
				$cat_res = mysql_query ($sql);
				if(!$cat_res)die(mysql_error());
				$i = 0;
				while($cat_row = $cat_res->fetch_object()) {
					$sql = "SELECT cat_id
						FROM item_to_category
						WHERE item_id = '".$item_id."'
						AND cat_id = '".$cat_row->cat_id."' 
						";		
					$f_res = mysql_query ($sql);
					$checked = (mysql_num_rows($f_res))? 1: 0;

					$_SESSION['temp_cat_ids'][$i]['cat_id'] = $cat_row->cat_id;
					$_SESSION['temp_cat_ids'][$i]['name'] = $cat_row->name;
					$_SESSION['temp_cat_ids'][$i]["checked"] = $checked;
					$i++;
				}
			}
			
			$block = '';
			if(count($_SESSION['temp_cat_ids']) > 0){
				foreach($_SESSION['temp_cat_ids'] as $val){
					$checked = ($val["checked"] > 0) ? "checked" : '';
					$block .= "<input name='cat_ids' type='checkbox' value='".$val['cat_id']."' $checked>";
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
            echo "<a class='inline' href='#add_keyword'>Add keyword</a><br />";
            echo "<br />";
				$sql = "SELECT word, key_words_id 
						FROM key_words 
						WHERE item_id = '".$item_id."'";
				$kw_res = mysql_query ($sql);
				if(!$kw_res)die(mysql_error());
				
				$i = 0;
				
				while($kw_row = mysql_fetch_object($kw_res)) {
					$i++;
//echo $kw_row->word." &nbsp;&nbsp;&nbsp;&nbsp; <a class='inline' href='#del_keyword'>delete<div class='e_sub' id='".$kw_row->key_words_id."' style='display:none'></div></a><br />";
					
					$block = '';
					$block .= "<div style='float:left; width:80px;'>";
					$block .= $kw_row->word;
					$block .= "</div>";
					$block .= "<div style='float:left;'>";
					$block .= "<a class='inline' href='#del_keyword'>delete<div class='e_sub' id='".$kw_row->key_words_id."' style='display:none'></div></a>";	
					$block .= "</div>";
					$block .= "<div class='clear'></div>";
					echo $block;
					
				
				}

				echo "<input type='hidden' name='key_word_count' value='".$i."' />";

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
	        <textarea class="selector_1" name="short_description" rows="4" cols="80" style="width: 650px" ><?php echo $_SESSION['temp_item_fields']["short_description"]; ?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2">
             <div class="form_label">Description (used as detailed description)</div>
	        <textarea class="selector_2" name="description" rows="6" cols="80" style="width: 650px" ><?php echo $_SESSION['temp_item_fields']['description']; ?></textarea>
            </td>
        </tr>        
        <tr>
			<td colspan="2">
            <div class="form_label">Back order message</div>
	        <textarea  name="back_order_message" rows="2" cols="80" style="width: 650px" ><?php echo $_SESSION['temp_item_fields']["back_order_message"]; ?></textarea>
            </td>
        </tr>     
        <tr>
			<td colspan="2">
            <div class="form_label">In stock message</div>
	        <textarea  name="in_stock_message" rows="2" cols="80" style="width: 650px" ><?php echo $_SESSION['temp_item_fields']["in_stock_message"]; ?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2">
            <div class="form_label">Additional information</div>
	        <textarea  name="additional_information" rows="2" cols="80" style="width: 650px"><?php echo $_SESSION['temp_item_fields']["additional_information"]; ?></textarea>
            </td>
        </tr>
   		<tr>
            <td colspan="2">
            <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input name="edit_item" type="submit" value="Save" />
            </div>
            
            
            <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onClick="location.href = 'item.php?cat_id=<?php echo $cat_id; ?>'; " />
            </div>
          
            </td>        
        </tr>     
        </table>
        </form>


</div>

 <p class="clear"></p>
    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</div>



	<div style="display:none">
        <div id="add_new_opt" style="width:300px; height:140px;">
      
        </div>
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
    
    
	<div style="display:none">
        <div id="del_gal_img" style="width:200px; height:100px;">
        
        
        </div>
    </div>

	<div style="display:none">
        <div id="del_media" style="width:200px; height:100px;">
        
        
        </div>
    </div>



</body>
</html>


