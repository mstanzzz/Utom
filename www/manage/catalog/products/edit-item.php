<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$ts = time();

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Product: ";
$page_group = "item";

$firstload =  (isset($_GET['firstload'])) ? $_GET['firstload'] : 0;
if($firstload){
	unset($_SESSION['cat_id']);
	unset($_SESSION['parent_cat_id']);		
}

$img_id = (isset($_GET['img_id'])) ? $_GET['img_id'] : 0;
if(!is_numeric($img_id)) $img_id = 0;
if($img_id > 0){
	$_SESSION['img_id'] = $img_id;
}

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = $parent_cat_id;

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$this_item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0; 
if(!isset($_SESSION['item_id'])) $_SESSION['item_id'] = $this_item_id*1;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$action = (isset($_GET['action'])) ? $_GET['action'] : '';

if(!isset($_SESSION['temp_item_cats'])) $_SESSION['temp_item_cats'] = getItemCats($_SESSION['item_id']);

if(!isset($_SESSION['temp_attr_opt_ids'])) $_SESSION['temp_attr_opt_ids'] = getItemAttrOptionsArray($_SESSION['item_id']);

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
if(!isset($_SESSION['ret_page'])) $_SESSION['ret_page'] = $ret_page;

if(isset($_GET['sel_img_id'])){
	$_SESSION['img_id'] = $_GET['sel_img_id'];
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(!isset($_SESSION['temp_videos'])){ 
	
	$_SESSION['temp_videos'] = array();
	$sql = "SELECT video.video_id
				,video.youtube_id
				,video.title
				,video.description
			FROM item_to_video, video 
			WHERE item_to_video.video_id = video.video_id 
			AND item_to_video.item_id = '".$_SESSION['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);					
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['temp_videos'][$i]['video_id'] = $row->video_id;
		$_SESSION['temp_videos'][$i]['youtube_id'] = $row->youtube_id;
		$_SESSION['temp_videos'][$i]['title'] = $row->title;
		$_SESSION['temp_videos'][$i]['description'] = $row->description;	
		$i++;
	}
}


if(isset($_POST['selected_video'])){
	
	$video_id = $_POST['video_id'];
	
	$sql = "SELECT youtube_id, title, description
			FROM video
			WHERE video_id = '".$video_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$obj = $result->fetch_object();				
		$indx = count($_SESSION['temp_videos']);
		$_SESSION['temp_videos'][$indx]['video_id'] = $video_id;
		$_SESSION['temp_videos'][$indx]['youtube_id'] = $obj->youtube_id;
		$_SESSION['temp_videos'][$indx]['title'] = $obj->title;
		$_SESSION['temp_videos'][$indx]['description'] = $obj->description;	
	}
}


if(!isset($_SESSION['temp_documents'])){
	
	$_SESSION['temp_documents'] = array();

	$sql = "SELECT document.document_id
				,document.name
				,document.file_name
				,document.vend_man_id
			FROM item_to_document, document
			WHERE item_to_document.document_id = document.document_id
			AND item_id = '".$_SESSION['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);					
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['temp_documents'][$i]['document_id'] = $row->document_id;
		$_SESSION['temp_documents'][$i]['name'] = $row->name;
		$_SESSION['temp_documents'][$i]['file_name'] = $row->file_name;
		$_SESSION['temp_documents'][$i]['vend_man_id'] = $row->vend_man_id;
		$i++;
	}
}

if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = '';
if(!isset($_SESSION['gal_img_id'])) $_SESSION['gal_img_id'] = 0;

if($action == 'remove_children'){
	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE parent_item_id = '".$_SESSION['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);					
}

if($action == 'update_document' && isset($_GET['document_id'])){
	foreach($_SESSION['temp_documents'] as $key => $val){
		if($_GET['document_id'] == $val['document_id']){
			$sql = "SELECT document.name					
				FROM document
				WHERE document_id = '".$_GET['document_id']."'";
			$result = $dbCustom->getResult($db,$sql);							
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['temp_documents'][$key]['name'] = $object->name;
			
			}
		}
	}
}

if(isset($_GET['sel_doc_id']) || ($action == 'upload_document' && isset($_GET['document_id']))){
	
	if(isset($_GET['sel_doc_id'])){ 
		$doc_id = $_GET['sel_doc_id'];
	}elseif(isset($_GET['document_id'])){		
		$doc_id = $_GET['document_id'];
	}else{
		$doc_id = 0;
	}
	
	$go = 1;
	foreach($_SESSION['temp_documents'] as $val){
		if($doc_id == $val['document_id']){
			$go = 0;
		}
	}

	if($go){
		$sql = "SELECT document.name
				,document.file_name
				,document.vend_man_id
			FROM document
			WHERE document_id = '".$doc_id."'";
		$result = $dbCustom->getResult($db,$sql);						
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$indx = count($_SESSION['temp_documents']);
			$_SESSION['temp_documents'][$indx]['document_id'] = $doc_id;
			$_SESSION['temp_documents'][$indx]['name'] = $object->name;
			$_SESSION['temp_documents'][$indx]['file_name'] = $object->file_name;
			$_SESSION['temp_documents'][$indx]['vend_man_id'] = $object->vend_man_id;
		}
	}
}

if(!isset($_SESSION['temp_gallery'])){
	$_SESSION['temp_gallery'] = array();
	$sql = "SELECT img_id
			FROM item_gallery
			WHERE item_id = '".$_SESSION['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	//echo $result->num_rows;
	//echo "<br />";						
	while($row = $result->fetch_object()){
		$_SESSION['temp_gallery'][] = $row->img_id;
	}
}

if($_SESSION['img_type'] == 'gallery' && $_SESSION['gal_img_id'] > 0){		
	if(!in_array($_SESSION['gal_img_id'],$_SESSION['temp_gallery'])){
		$_SESSION['temp_gallery'][count($_SESSION['temp_gallery'])] = $_SESSION['gal_img_id'];
	}
}


if(isset($_GET['delgalleryimgid'])){
	$key = array_search($_GET['delgalleryimgid'],$_SESSION['temp_gallery']);
	if($key!==false){
		unset($_SESSION['temp_gallery'][$key]);
		$_SESSION['temp_gallery'] = array_values($_SESSION['temp_gallery']);
	}
}

if(isset($_GET['deldocid'])){
	foreach($_SESSION['temp_documents'] as $key => $val){
		if($_GET['deldocid'] == $val['document_id']){
			unset($_SESSION['temp_documents'][$key]);
			$_SESSION['temp_documents'] = array_values($_SESSION['temp_documents']);
		}
	}
}

if(isset($_GET['delvidid'])){
	foreach($_SESSION['temp_videos'] as $key => $val){
		if($_GET['delvidid'] == $val['video_id']){
			unset($_SESSION['temp_videos'][$key]);
			$_SESSION['temp_videos'] = array_values($_SESSION['temp_videos']);
		}
	}
}

if(!isset($parent_name)) $parent_name = '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

if($action == 'remove_as_child'){	
	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE item_id = '".$_SESSION['item_id']."'";
	$res = $dbCustom->getResult($db,$sql);	
}


$sql = sprintf("SELECT * FROM item WHERE item_id = '%u'", $_SESSION['item_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();

	
	$parent_name = '';
	if($object->parent_item_id > 0){
		$sql = "SELECT name FROM item WHERE item_id = '".$object->parent_item_id."'";
		$res = $dbCustom->getResult($db,$sql);
		if($res->num_rows > 0){
			$p_obj = $res->fetch_object();
			$parent_name = $p_obj->name; 	
		}
	}


	if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $object->img_id;
	

	if($object->date_active < $ts){
		$date_active = date("m/d/Y",$ts);
	}else{
		$date_active = date("m/d/Y",$object->date_active);
	}
		
	if($object->date_inactive >= '2000000000'){
		$date_inactive = "never";
	}else{
		if(strlen($object->date_inactive) < 10){	
			$date_inactive = 'never';	
		}else{					
			$date_inactive = date('m/d/Y',$object->date_inactive);
		}
	}

	// NOTE: a key_words field varchar 250 is now in the item table. 
	//This is redundant data and the key_words table should eventually be removed 
	//but I'm leaving it for now in case we make changes that will need it. 	
	$sql = sprintf("SELECT word FROM key_words WHERE item_id = '%u'", $_SESSION['item_id']);
	$res = $dbCustom->getResult($db,$sql);
	$kw_str = '';
	$i = 0;
	while($kw_row = $res->fetch_object()){
		if($i > 0) $kw_str .= ", ";
		$kw_str .= $kw_row->word;
		$i++;
	}
	//if(strlen($kw_str) > 0){
		//$kw_str = substr($kw_str, 1);
	//}	
	
 
	if(!isset($_SESSION['temp_item_fields']['style_id'])) $_SESSION['temp_item_fields']['style_id'] = $object->style_id;	
	if(!isset($_SESSION['temp_item_fields']['lead_time_id'])) $_SESSION['temp_item_fields']['lead_time_id'] = $object->lead_time_id;	
	if(!isset($_SESSION['temp_item_fields']['skill_level_id'])) $_SESSION['temp_item_fields']['skill_level_id'] = $object->skill_level_id;	
	if(!isset($_SESSION['temp_item_fields']['type_id'])) $_SESSION['temp_item_fields']['type_id'] = $object->type_id;	

   	if(!isset($_SESSION['temp_item_fields']['keywords'])) $_SESSION['temp_item_fields']['keywords'] = $kw_str;	
	
	if(!isset($_SESSION['temp_item_fields']['date_active'])) $_SESSION['temp_item_fields']['date_active'] = $date_active;
	if(!isset($_SESSION['temp_item_fields']['date_inactive'])) $_SESSION['temp_item_fields']['date_inactive'] = $date_inactive;	
	if(!isset($_SESSION['temp_item_fields']['parent_item_id'])) $_SESSION['temp_item_fields']['parent_item_id'] = $object->parent_item_id;	

	if(!isset($_SESSION['temp_item_fields']['main_attr_id'])) $_SESSION['temp_item_fields']['main_attr_id'] = $object->main_attr_id;

	if(!isset($_SESSION['temp_item_fields']['name'])) $_SESSION['temp_item_fields']['name'] = $object->name;
	if(!isset($_SESSION['temp_item_fields']['price_flat'])) $_SESSION['temp_item_fields']['price_flat'] = $object->price_flat;	
	if(!isset($_SESSION['temp_item_fields']['price_wholesale'])) $_SESSION['temp_item_fields']['price_wholesale'] = $object->price_wholesale;	
	if(!isset($_SESSION['temp_item_fields']['percent_markup'])) $_SESSION['temp_item_fields']['percent_markup'] = $object->percent_markup;	
	if(!isset($_SESSION['temp_item_fields']['percent_off'])) $_SESSION['temp_item_fields']['percent_off'] = $object->percent_off;	
	if(!isset($_SESSION['temp_item_fields']['amount_off'])) $_SESSION['temp_item_fields']['amount_off'] = $object->amount_off;	
	if(!isset($_SESSION['temp_item_fields']['call_for_pricing'])) $_SESSION['temp_item_fields']['call_for_pricing'] = $object->call_for_pricing;	
	if(!isset($_SESSION['temp_item_fields']['is_new_product'])) $_SESSION['temp_item_fields']['is_new_product'] = $object->is_new_product;	
	if(!isset($_SESSION['temp_item_fields']['is_promo_product'])) $_SESSION['temp_item_fields']['is_promo_product'] = $object->is_promo_product;	
	if(!isset($_SESSION['temp_item_fields']['allow_back_order'])) $_SESSION['temp_item_fields']['allow_back_order'] = $object->allow_back_order;
	if(!isset($_SESSION['temp_item_fields']['is_taxable'])) $_SESSION['temp_item_fields']['is_taxable'] = $object->is_taxable;	
	if(!isset($_SESSION['temp_item_fields']['prod_number'])) $_SESSION['temp_item_fields']['prod_number'] = $object->prod_number;	
	if(!isset($_SESSION['temp_item_fields']['internal_prod_number'])) $_SESSION['temp_item_fields']['internal_prod_number'] = $object->internal_prod_number;
	if(!isset($_SESSION['temp_item_fields']['vend_man_id'])) $_SESSION['temp_item_fields']['vend_man_id'] = $object->vend_man_id;
	
	if(!isset($_SESSION['temp_item_fields']['brand_id'])) $_SESSION['temp_item_fields']['brand_id'] = $object->brand_id;
	
	if(!isset($_SESSION['temp_item_fields']['sku'])) $_SESSION['temp_item_fields']['sku'] = $object->sku;	
	if(!isset($_SESSION['temp_item_fields']['upc'])) $_SESSION['temp_item_fields']['upc'] = $object->upc;	
	if(!isset($_SESSION['temp_item_fields']['short_description'])) $_SESSION['temp_item_fields']['short_description'] = $object->short_description;	
	if(!isset($_SESSION['temp_item_fields']['description'])) $_SESSION['temp_item_fields']['description'] = $object->description;	
	if(!isset($_SESSION['temp_item_fields']['back_order_message'])) $_SESSION['temp_item_fields']['back_order_message'] = $object->back_order_message;	
	if(!isset($_SESSION['temp_item_fields']['in_stock_message'])) $_SESSION['temp_item_fields']['in_stock_message'] = $object->in_stock_message;	
	if(!isset($_SESSION['temp_item_fields']['additional_information'])) $_SESSION['temp_item_fields']['additional_information'] = $object->additional_information;	
	if(!isset($_SESSION['temp_item_fields']['ship_port_id'])) $_SESSION['temp_item_fields']['ship_port_id'] = $object->ship_port_id;	
	if(!isset($_SESSION['temp_item_fields']['return_to_id'])) $_SESSION['temp_item_fields']['return_to_id'] = $object->return_to_id;	
	if(!isset($_SESSION['temp_item_fields']['is_drop_shipped'])) $_SESSION['temp_item_fields']['is_drop_shipped'] = $object->is_drop_shipped;	

	if(!isset($_SESSION['temp_item_fields']['is_closet'])) $_SESSION['temp_item_fields']['is_closet'] = $object->is_closet;	
	if(!isset($_SESSION['temp_item_fields']['show_in_cart'])) $_SESSION['temp_item_fields']['show_in_cart'] = $object->show_in_cart;	
	if(!isset($_SESSION['temp_item_fields']['show_in_showroom'])) $_SESSION['temp_item_fields']['show_in_showroom'] = $object->show_in_showroom;	
	if(!isset($_SESSION['temp_item_fields']['shipping_flat_charge'])) $_SESSION['temp_item_fields']['shipping_flat_charge'] = $object->shipping_flat_charge;	
	if(!isset($_SESSION['temp_item_fields']['weight'])) $_SESSION['temp_item_fields']['weight'] = $object->weight;	
	if(!isset($_SESSION['temp_item_fields']['img_alt_text'])) $_SESSION['temp_item_fields']['img_alt_text'] = $object->img_alt_text;
	
	if(!isset($_SESSION['temp_item_fields']['show_in_tool'])) $_SESSION['temp_item_fields']['show_in_tool'] = $object->show_in_tool;
	
	if(!isset($_SESSION['temp_item_fields']['hide_id_from_url'])) $_SESSION['temp_item_fields']['hide_id_from_url'] = $object->hide_id_from_url;

	if(!isset($_SESSION['temp_item_fields']['doc_area_text'])) $_SESSION['temp_item_fields']['doc_area_text'] = $object->doc_area_text;	

	if(!isset($_SESSION['temp_item_fields']['is_kit'])) $_SESSION['temp_item_fields']['is_kit'] = $object->is_kit;	
	
	if(!isset($_SESSION['temp_item_fields']['is_free_shipping'])) $_SESSION['temp_item_fields']['is_free_shipping'] = $object->is_free_shipping;	

	if(!isset($_SESSION['temp_item_fields']['show_doc_tab'])) $_SESSION['temp_item_fields']['show_doc_tab'] = $object->show_doc_tab;	
	if(!isset($_SESSION['temp_item_fields']['show_meas_form_tab'])) $_SESSION['temp_item_fields']['show_meas_form_tab'] = $object->show_meas_form_tab;	
	if(!isset($_SESSION['temp_item_fields']['show_atc_btn_or_cfp'])) $_SESSION['temp_item_fields']['show_atc_btn_or_cfp'] = $object->show_atc_btn_or_cfp;	

	if(!isset($_SESSION['temp_item_fields']['show_start_design_btn'])) $_SESSION['temp_item_fields']['show_start_design_btn'] =  $object->show_start_design_btn;
	if(!isset($_SESSION['temp_item_fields']['show_design_request_btn'])) $_SESSION['temp_item_fields']['show_design_request_btn'] =  $object->show_design_request_btn;



	if(!isset($_SESSION['temp_item_fields']['show_videos'])) $_SESSION['temp_item_fields']['show_videos'] =  $object->show_videos;
	if(!isset($_SESSION['temp_item_fields']['show_associated_kits'])) $_SESSION['temp_item_fields']['show_associated_kits'] =  $object->show_associated_kits;

	/*
	if($_SESSION['temp_item_fields']['show_videos'] == 0 && $_SESSION['temp_item_fields']['show_associated_kits'] == 0){
		$_SESSION['temp_item_fields']['show_associated_kits'] =  1;	
	}
	*/

	if(!isset($_SESSION['temp_item_fields']['show_specs_tab'])) $_SESSION['temp_item_fields']['show_specs_tab'] = $object->show_specs_tab;


/*
	

echo "show_in_cart    ".$object->show_in_cart;
echo "<br />";
echo "show_in_showroom    ".$object->show_in_showroom;

echo "<br />";
	
echo "main_attr_id:  ".$_SESSION['temp_item_fields']['main_attr_id'];
	

	$item_cat_array = getItemCats($cat_id);
	$sql = "SELECT attribute_id
			FROM  category_to_attr";
	$i = 0;
	foreach($cat_array as $cat_v){
		if($cat_v != ''){
			if($i == 0){
				$sql .= " WHERE category_to_attr.cat_id = '".$cat_v."'";		
			}elseif($i == 2){
				$sql .= " AND category_to_attr.cat_id = '".$cat_v."'";		
			}else{
				$sql .= " OR category_to_attr.cat_id = '".$cat_v."'";
			}
		$i++;
		}
	}
    $attr_res = mysql_query ($sql);
	if(!$attr_res)die(mysql_error());
	$is_attributes = 0;
	while($attr_row = mysql_fetch_object($attr_res)) {
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
						$_SESSION['temp_attr_opt_ids'] = $opt_row->opt_id;
					}
				}
			}
	}
*/		
		
		
		
		
	
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>


tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});
//=======================================
// DEFINE VALIDATION FUNCTIONS
//=======================================
	
	//var requiredFields = ["product_name", "product_number", "sku", "price_flat", "price_wholesale", "is_taxable", "datepicker1", "show_in_cart", "show_in_showroom", "weight''];
	
	var requiredFields = ["product_name"];
	
	//console.log(requiredFields);
	var invalidFields = [];
	
	
	
	function validate(){
		var theform = document.forms["edit_item"];
		var j = 0;
		var string = "<div class='confirm-content validationNotification'><h3>Please correct the following fields:</h3><ul>";
		var isValid = true;
		for (i=0; i < theform.elements.length; i++){
			var elem = theform.elements[i];
			//we don't need to validate hidden fields, buttons, fieldsets, legends or submit elements...
			if (elem.type != 'hidden' && elem.type != 'button' && elem.type != 'fieldset' && elem.type != 'legend' && elem.type != 'submit'){
				var elementId = elem.id;				
				// if the input field has an ID and it is one of the required fields...
				if(elementId.length > 0 && $.inArray(elementId,requiredFields) != -1){
					//if the input field is a text field, validate that it is not zero, empty, or null
					if (elem.type == "text" && (elem.value == 0 || elem.value == '' || elem.value == null)){
						var elementLabel = $("#"+elementId).closest(".colcontainer").find("label").text();
						string += "<li>"+elementLabel+"</li>";
						invalidFields[j] = elementId;
						j++;
						isValid = false;
					}
					//if the input field is any other type of field, just make sure it has a value
					else if (elem.value == '' || elem.value == null){
						var elementLabel = $("#"+elementId).closest(".colcontainer").find("label").text();
						string += "<li>"+elementLabel+"</li>";
						invalidFields[j] = elementId;
						j++;
						isValid = false;
					}
				}
			}
		}
		string += "</ul><p><a class='btn btn-large dismiss'>Ok, got it.</a></p></div>";
		if (!isValid){
			$(string).appendTo(".manage_main");
			$(".validationNotification .dismiss").click(function(){
				$(".validationNotification").remove();
				$($("input.required").get().reverse()).trigger('focus').trigger('blur');
				$(".manage_main").click();
			});
			$(".validationNotification").fadeIn("fast");
		}
		else if (isValid){
			//alert("isValid");
			theform.submit();	
		}
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

function IsNumeric(values)
{
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;
	for (i = 0; i < values.sText.length && IsNumber == true; i++) 
		{ 
			Char = values.sText.charAt(i); 
			if (ValidChars.indexOf(Char) == -1) 
			{
				IsNumber = false;
			}
		}
	if (IsNumber){
		return {valid:true}	
	}
	else {
		return {valid:false,message:'Please only enter numeric values in this field.'}	
	}
}


function get_query_str(){
	
	var query_str = '';
	//var str_cats = '';

	var is_in_form = 0;
	//var temp_ele_name = "name";
	
	var opt_list = '';
	
	<?php
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT attribute_id
			FROM  attribute
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY attribute_id";
	$res = $dbCustom->getResult($db,$sql);		
	while($attr_row = $res->fetch_object()) {
		//$nn = "attr_".$attr_row->attribute_id."[]"; use for multiple
		$nn = "attr_".$attr_row->attribute_id;
	
	?>

	
		for(i = 0; i < document.edit_item.elements.length; i++)
		{
			if(document.edit_item.elements[i].name == '<?php echo $nn; ?>'){
				is_in_form = 1;
				//alert("FFF");
			}
		}
		if(is_in_form){
			//opt_list += this.value+"|";
			$("#<?php echo $nn; ?>  option:selected").each(
			
				function(){   
					opt_list += this.value+"|"; 
				}
			);	

		}
	
		is_in_form = 0;
	
	<?php
	}
	
	?>
		// remove last char
		opt_list = opt_list.replace(/(\s+)?.$/, '');	
		
		query_str += "&opt_list="+opt_list;
	
		//alert(opt_list);
	
	
	if($('#main_attr_id').length > 0){
		query_str += "&main_attr_id="+$('#main_attr_id').val(); 
	}

	query_str += "&style_id="+document.edit_item.style_id.value; 
	query_str += "&lead_time_id="+document.edit_item.lead_time_id.value; 
	query_str += "&skill_level_id="+document.edit_item.skill_level_id.value; 
	query_str += "&type_id="+document.edit_item.type_id.value; 

	query_str += "&item_id="+document.edit_item.item_id.value; 
	query_str += "&date_active="+document.edit_item.date_active.value; 
    query_str += "&date_inactive="+document.edit_item.date_inactive.value; 
	query_str += "&name="+document.edit_item.name.value.replace('&', '%26');
	query_str += "&price_flat="+document.edit_item.price_flat.value;
    query_str += "&price_wholesale="+document.edit_item.price_wholesale.value;
    query_str += "&percent_markup="+document.edit_item.percent_markup.value;
    query_str += "&percent_off="+document.edit_item.percent_off.value;
    query_str += "&amount_off="+document.edit_item.amount_off.value;
	
	query_str += (document.edit_item.call_for_pricing.checked)? "&call_for_pricing=1" : "&call_for_pricing=0"; 
	query_str += (document.edit_item.is_new_product.checked)? "&is_new_product=1" : "&is_new_product=0"; 
	query_str += (document.edit_item.is_taxable.checked)? "&is_taxable=1" : "&is_taxable=0"; 
	query_str += (document.edit_item.is_promo_product.checked)? "&is_promo_product=1" : "&is_promo_product=0";
	query_str += (document.edit_item.allow_back_order.checked)? "&allow_back_order=1" : "&allow_back_order=0"; 
	query_str += (document.edit_item.is_drop_shipped.checked)? "&is_drop_shipped=1" : "&is_drop_shipped=0"; 
	
	//query_str += ($('#is_closet_yes').attr("checked") == 'checked')? "&is_closet=1" : "&is_closet=0";  
	
	query_str += (document.edit_item.show_in_cart.checked)? "&show_in_cart=1" : "&show_in_cart=0"; 
	query_str += (document.edit_item.show_in_showroom.checked)? "&show_in_showroom=1" : "&show_in_showroom=0"; 

    query_str += "&brand_id="+document.edit_item.brand_id.value;
    //query_str += "&prod_number="+document.edit_item.prod_number.value;
    query_str += "&internal_prod_number="+document.edit_item.internal_prod_number.value;
	
	
	
    query_str += "&sku="+document.edit_item.sku.value;
    query_str += "&upc="+document.edit_item.upc.value;
	
	//query_str += "&short_description="+escape(tinyMCE.get('wysiwyg1').getContent());
	query_str += "&short_description="+document.edit_item.short_description.value;
	
	query_str += "&description="+escape(tinyMCE.get('wysiwyg2').getContent());
	query_str += "&additional_information="+escape(tinyMCE.get('wysiwyg3').getContent());
	query_str += "&back_order_message="+escape(tinyMCE.get('wysiwyg4').getContent());
	query_str += "&in_stock_message="+escape(tinyMCE.get('wysiwyg5').getContent());
	
	query_str += "&doc_area_text="+escape(tinyMCE.get('wysiwyg6').getContent());

    //query_str += "&short_description="+document.edit_item.short_description.value;
    //query_str += "&description="+document.edit_item.description.value; 
    //query_str += "&back_order_message="+document.edit_item.back_order_message.value;
    //query_str += "&in_stock_message="+document.edit_item.in_stock_message.value;
    //query_str += "&additional_information="+document.edit_item.additional_information.value;
	
    query_str += "&shipping_flat_charge="+document.edit_item.shipping_flat_charge.value;
    query_str += "&weight="+document.edit_item.weight.value;
	query_str += "&return_to_id="+document.edit_item.return_to_id.value;
    query_str += "&ship_port_id="+document.edit_item.ship_port_id.value;
	
    query_str += "&keywords="+document.edit_item.keywords.value.replace('&', '%26');

    query_str += "&img_alt_text="+document.edit_item.img_alt_text.value.replace('&', '%26');
	
	query_str += (document.edit_item.show_in_tool.checked)? "&show_in_tool=1" : "&show_in_tool=0"; 
	
	//query_str += (document.edit_item.hide_id_from_url.checked)? "&hide_id_from_url=1" : "&hide_id_from_url=0"; 

	query_str += (document.edit_item.is_kit.checked)? "&is_kit=1" : "&is_kit=0"; 
	
	query_str += (document.edit_item.is_free_shipping.checked)? "&is_free_shipping=1" : "&is_free_shipping=0"; 
	
	query_str += (document.edit_item.show_doc_tab.checked)? "&show_doc_tab=1" : "&show_doc_tab=0"; 
	query_str += (document.edit_item.show_meas_form_tab.checked)? "&show_meas_form_tab=1" : "&show_meas_form_tab=0"; 
	query_str += (document.edit_item.show_atc_btn_or_cfp.checked)? "&show_atc_btn_or_cfp=1" : "&show_atc_btn_or_cfp=0"; 

	query_str += (document.edit_item.show_start_design_btn.checked)? "&show_start_design_btn=1" : "&show_start_design_btn=0"; 
	query_str += (document.edit_item.show_design_request_btn.checked)? "&show_design_request_btn=1" : "&show_design_request_btn=0"; 

	query_str += (document.edit_item.show_videos.checked)? "&show_videos=1" : "&show_videos=0"; 
	query_str += (document.edit_item.show_associated_kits.checked)? "&show_associated_kits=1" : "&show_associated_kits=0"; 

	query_str += (document.edit_item.show_specs_tab.checked)? "&show_specs_tab=1" : "&show_specs_tab=0";
	
	//alert(query_str);
	
	return query_str;
}

function set_item_session(){

	var q_str = "?action=1"+get_query_str();
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_item_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  }
	});	
}


$(document).ready(function() {
	$("a.fancybox").tooltip({placement: 'right',delay: { show: 400, hide: 100 }});


/*

	$("#is_closet_no").click(function(){
		$("#show_in_showroom_toggle").addClass("disabled");
		$("#show_in_showroom").val(1);
		
	});
	$("#is_closet_yes").click(function(){
		$("#show_in_showroom_toggle").removeClass("disabled");
	
	});


	var dirty = false;
	$("form#edit_item_form :input").change(function() {
		dirty = true;
		console.log(dirty);
	});
	
	window.onbeforeunload = function() {
		if (dirty) {
			return 'You have unsaved changes! If you leave this page, your changes will be lost.';
		}
	};
	console.log(dirty);

*/		
	
	
	$(".fancybox").click(function(e){
		e.preventDefault();		
		set_item_session();		
	});
	
	$(".upload").click(function(){
		set_item_session();		
	});

	
	$("#add_child").click(function(){
		set_item_session();		
	});
	
	$("#make_child_of").click(function(){		
		set_item_session();
	});
	
	$("#remove_as_child").click(function(){		
		set_item_session();
	});

	$("#remove_children").click(function(){		
		set_item_session();
	});
	
	
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();	
	$('#clear_dates').click(function() {
		$('#datepicker1').val('');
		$('#datepicker2').val('');
	});

	$("#show_start_design_toggle").click(function(e){
		if($(this).hasClass("on")){
			//alert("was on");
		}else{

			if($("#show_atc_btn_or_cfp_toggle").hasClass("on")){
				$("#show_atc_btn_or_cfp_toggle").switchClass("on", "off", 200);
				$("#show_atc_btn_or_cfp_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_atc_btn_or_cfp_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			//alert("was off");
		}
	});

	$("#show_design_request_toggle").click(function(e){
		if($(this).hasClass("on")){
			//alert("was on");
		}else{

			if($("#show_atc_btn_or_cfp_toggle").hasClass("on")){
				$("#show_atc_btn_or_cfp_toggle").switchClass("on", "off", 200);
				$("#show_atc_btn_or_cfp_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_atc_btn_or_cfp_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			//alert("was off");
		}
	});
	
	$("#show_atc_btn_or_cfp_toggle").click(function(e){
		if($(this).hasClass("on")){
			//alert("was on");
		}else{

			if($("#show_start_design_toggle").hasClass("on")){
				$("#show_start_design_toggle").switchClass("on", "off", 200);
				$("#show_start_design_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_start_design_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			
			if($("#show_design_request_toggle").hasClass("on")){
				$("#show_design_request_toggle").switchClass("on", "off", 200);
				$("#show_design_request_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_design_request_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			//alert("was off");
		}
	});
	
	
	
	$("#show_videos_toggle").click(function(e){
		if($(this).hasClass("on")){
			//alert("was on");
		}else{

			if($("#show_associated_kits_toggle").hasClass("on")){
				$("#show_associated_kits_toggle").switchClass("on", "off", 200);
				$("#show_associated_kits_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_associated_kits_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			//alert("was off");
		}
	});


	
	$("#show_associated_kits_toggle").click(function(e){
		if($(this).hasClass("on")){
			//alert("was on");
		}else{

			if($("#show_videos_toggle").hasClass("on")){
				$("#show_videos_toggle").switchClass("on", "off", 200);
				$("#show_videos_toggle").find(".switch").animate({right: "38px"},300).css("left","auto");
				$("#show_videos_toggle").find("input.checkboxinput").removeAttr("checked");
			}
			//alert("was off");
		}
	});
	
	
	set_attr_section();

});


</script>
</head>

<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<!--
<a onClick="test();">TEST</a>
-->
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">

<?php
$_SESSION['crop_n'] = 1;
$_SESSION['img_type'] = 'cart';

$url_str= "../../upload-pre-crop.php"; 
//$url_str = preg_replace('/(\/+)/','/',$url_str);
//echo $url_str;
//exit;

$url_str.= "?ret_page=edit-item";
$url_str.= "&ret_dir=products";
$url_str.= "&ret_path=catalog/products";
$url_str.= "&item_id=".$_SESSION['item_id'];
$url_str.= "&upload_new_img=1";
$url_str.= "&parent_item_id=".$_SESSION['item_id'];
$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
$url_str.= "&cat_id=".$_SESSION['cat_id'];		
?>
<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Image </a>

	<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->add("Edit Product", $ste_root."manage/catalog/products/edit-item.php");
		//echo $bread_crumb->output();
	 
		$page_title .= $_SESSION['temp_item_fields']['name'];

		if($parent_name != ''){		
			$page_title .=  '<br />Child of: '.$parent_name;
		}
		
		 $page_title = stripslashes($page_title);

		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		
		if($_SESSION['ret_page'] == 'category-tree'){
			$url_str= $ste_root.'manage/catalog/categories/category-tree.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);

		}else{

			$url_str= 'item.php';
			//$url_str = preg_replace('/(\/+)/','/',$url_str);
			
			$url_str.= '?parent_item_id='.$_SESSION['item_id'];
			$url_str.= '&parent_cat_id='.$_SESSION['parent_cat_id'];
			$url_str.= '&cat_id='.$_SESSION['cat_id'];		
			$url_str.= '&pagenum='.$_SESSION['paging']['pagenum'];
			$url_str.= '&sortby='.$_SESSION['paging']['sortby'];
			$url_str.= '&a_d='.$_SESSION['paging']['a_d'];
			$url_str.= '&truncate='.$_SESSION['paging']['truncate'];
			$url_str.= '&search_str='.$_SESSION['search_str'];
		}
		
		
						
$sql = "SELECT file_name FROM image
WHERE img_id = '".$_SESSION['img_id']."'";
$img_res = $dbCustom->getResult($db,$sql);
if($img_res->num_rows > 0){
	$img_obj = $img_res->fetch_object();
	$file_name = $img_obj->file_name;
}else{
	$file_name = '';
}

echo "file_name: ".$file_name;
echo "<br />";
echo "<br />";
echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name."'>";

		
		
		?>      
		<form id="edit_item_form" name="edit_item" action="<?php echo $url_str; ?>" method="post"   enctype="multipart/form-data">
			<input id="item_id" type="hidden" name="item_id" value="<?php echo $_SESSION['item_id'];  ?>" />
			<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
			<input type="hidden" name="parent_cat_id" value="<?php echo $_SESSION['parent_cat_id']; ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $_SESSION['cat_id']; ?>" />
			<input type="hidden" name="edit_item" value="1" />
            <div class="page_actions edit_page"> 
				<?php 

				$url_str= 'add-item.php';
				//$url_str = preg_replace('/(\/+)/','/',$url_str);

				$url_str.= "?parent_item_id=".$_SESSION['item_id'];
				$url_str.= "&ret_page=edit-item";				
				$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
				$url_str.= "&cat_id=".$_SESSION['cat_id'];						
				$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
				$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
				$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
				$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
				$url_str.= '&search_str='.$_SESSION['search_str'];
		
				if($admin_access->product_catalog_level > 1){ 
                    
					echo "<a onClick='validate()' class='btn btn-success btn-large'><i class='icon-ok icon-white'></i> Save Product </a>";
					
					if($_SESSION['temp_item_fields']['parent_item_id'] == 0){
					
						echo "<hr /><a id='add_child' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Add New Child</a>";	
						
						if(getNumChildItems($_SESSION['item_id']) > 0){
						
					
							$url_str= 'edit-item.php';
							//$url_str = preg_replace('/(\/+)/','/',$url_str);

							$url_str.= "?action=remove_children";
							$url_str.= "&parent_item_id=".$_SESSION['item_id'];
							$url_str.= "&ret_page=edit-item";				
							$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
							$url_str.= "&cat_id=".$_SESSION['cat_id'];						
							$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
							$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
							$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
							$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
							$url_str.= '&search_str='.$_SESSION['search_str'];
								
							echo "<hr /><a id='remove_children' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Remove All Child Products </a>";	
						}
							
								
						$url_str= 'become-child-item.php';
						//$url_str = preg_replace('/(\/+)/','/',$url_str);
			
						$url_str.= "?parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];						
						$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
						$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
						$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
						$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
						$url_str.= '&search_str='.$_SESSION['search_str'];
						
						echo "<hr /><a id='make_child_of' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Make this child of another product</a>";
						
					}else{
						
						$url_str= 'edit-item.php';
						//$url_str = preg_replace('/(\/+)/','/',$url_str);									
						$url_str.= "?action=remove_as_child";												
						echo "<hr /><a id='remove_as_child' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Make this NOT a child of another product</a>";
						
					}
				
				
				}else{ ?>
                	<div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
                <?php } ?>
                
               <select class="jumpMenu">
					<option value="#" selected>Jump to Section...</option>
					<option value="#product_basics">Product Basics</option>
					<option value="#product_pricing">Pricing &amp; Discounts</option>
					<option value="#product_stock">Stock &amp Visibility</option>
					<option value="#product_attributes">Product Attributes</option>
					<option value="#product_images">Product Images</option>
					<option value="#product_shipping">Shipping Options</option>
					<option value="#product_categories">Categories &amp; Keywords</option>
				</select>
                 <a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a>
				<hr />


				<?php
				if($_SESSION['ret_page'] == 'category-tree'){
					$url_str= $ste_root.'manage/catalog/categories/category-tree.php';
					$url_str = preg_replace('/(\/+)/','/',$url_str);

				}else{					               				
					$url_str= 'item.php';
					//$url_str = preg_replace('/(\/+)/','/',$url_str);
					$url_str.= "?parent_item_id=".$_SESSION['item_id'];
					$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
					$url_str.= "&cat_id=".$_SESSION['cat_id'];		
					$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
					$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
					$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
					$url_str.= "&truncate=".$_SESSION['paging']['truncate'];					
					$url_str.= '&search_str='.$_SESSION['search_str'];
				}
				
				?>
				<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
			<div class="page_content edit_page">
 				<fieldset class="edit_content" id="product_basics">
					<legend>Product Basics <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Product Name</label>
						</div>
						<div class="twocols">
							<input id="product_name" type="text" name="name" value="<?php echo prepFormInputStr($_SESSION['temp_item_fields']['name']); ?>" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Product Number</label>
						</div>
						<div class="twocols" style="padding-top:12px;">
							<strong>
							<?php
							if(isset($object->profile_item_id)) echo $object->profile_item_id;

							echo "<br />";
							echo "<br />";
							echo "item id  ".$_SESSION['item_id'];
							echo "<br />";
							echo "<br />";
							
							?>
                            </strong>							
                        </div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Internal Product Number</label>
						</div>
						<div class="twocols">
							<input type="text" id="internal_prod_number" name="internal_prod_number" value="<?php echo $_SESSION['temp_item_fields']["internal_prod_number"]; ?>" maxlength="100"/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>SKU</label>
						</div>
						<div class="twocols">
							<input type="text" id="sku" name="sku" value="<?php echo $_SESSION['temp_item_fields']["sku"]; ?>" maxlength="100"/>

						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>UPC</label>
						</div>
						<div class="twocols">
							<input type="text" id="upc" name="upc" value="<?php echo $_SESSION['temp_item_fields']["upc"]; ?>" maxlength="100"/>
						
                        </div>
					</div>
					<div class="colcontainer">
						<label>Short Description</label>
						<textarea cols="80"  name="short_description"><?php echo stripslashes($_SESSION['temp_item_fields']["short_description"]); ?></textarea>
					<!-- class="wysiwyg small" id="wysiwyg1"  -->
                    
                    </div>
					<div class="colcontainer">
						<label>Full Description</label>
						<textarea class="wysiwyg" id="wysiwyg2"  name="description"><?php echo stripslashes($_SESSION['temp_item_fields']['description']); ?></textarea>
					</div>
					<div class="colcontainer">
						<label>Specifications (additional information)</label>
						<textarea class="wysiwyg small" id="wysiwyg3"  name="additional_information"><?php echo stripslashes($_SESSION['temp_item_fields']["additional_information"]); ?></textarea>
					</div>
                    
				</fieldset>
				<fieldset class="edit_content" id="product_pricing">
					<legend>Pricing &amp Discounts <i class="icon-minus-sign icon-white"></i></legend>
					<div class="alert alert-info"><strong>Note:</strong> Input numbers only in this section!</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Flat Price</label>
						</div>
						<div class="twocols">
							<span class="prepend-input">$</span><input type="text" class="prepended" id="price_flat" name="price_flat" 
                            value="<?php echo $_SESSION['temp_item_fields']["price_flat"]; ?>" maxlength="10" />
                    	</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Wholesale Price</label>
						</div>
						<div class="twocols">
							<span class="prepend-input">$</span>
                            <input type="text" class="prepended" id="price_wholesale" name="price_wholesale" 
                            value="<?php echo $_SESSION['temp_item_fields']["price_wholesale"]; ?>" maxlength="10"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Percent Markup</label>
						</div>
						<div class="twocols">
							<input type="text" class="appended" name="percent_markup" 
                            value="<?php echo $_SESSION['temp_item_fields']["percent_markup"]; ?>" maxlength="10"  /><span class="append-input">%</span>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Percent Off</label>
						</div>
						<div class="twocols">
							<input type="text" class="appended" name="percent_off" 
                            value="<?php echo $_SESSION['temp_item_fields']["percent_off"]; ?>" maxlength="10" /><span class="append-input">%</span>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Amount Off</label>
						</div>
						<div class="twocols">
							<span class="prepend-input">$</span><input type="text" class="prepended" name="amount_off" 
                            value="<?php echo $_SESSION['temp_item_fields']["amount_off"]; ?>" maxlength="10"  />
						</div>
					</div>

					<div class="colcontainer checkboxcols">
						<div class="twocols">
							<label>Taxable?</label>
							<div class="checkboxtoggle on"> 
                                <span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" name="is_taxable" value="1" 
                                <?php if($_SESSION['temp_item_fields']["is_taxable"] == 1) echo "checked='checked'";?> />
                            </div>
						</div>
						<div class="twocols">
							<label>Call for pricing?</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" name="call_for_pricing" value="1" 
								<?php if($_SESSION['temp_item_fields']["call_for_pricing"] == 1) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
				</fieldset>
                
				<fieldset class="edit_content" id="product_pricing">
					<legend>Tabbed Section &amp Cart Button <i class="icon-minus-sign icon-white"></i></legend>
				
					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Documents Tab</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_doc_tab" 
                                    value="1" 
									id="show_doc_tab"
									<?php if($_SESSION['temp_item_fields']['show_doc_tab']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
                    
					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Measurements Form Tab</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_meas_form_tab" 
                                    value="1" 
									id="show_meas_form_tab"
									<?php if($_SESSION['temp_item_fields']['show_meas_form_tab']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
                    

					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Specifications Tab</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_specs_tab" 
                                    value="1" 
									id="show_specs_tab"
									<?php if($_SESSION['temp_item_fields']['show_specs_tab']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
                    
                    
 					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Add-to-Cart Button or Call-for-Price</label>
							<div class="checkboxtoggle on" id="show_atc_btn_or_cfp_toggle"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_atc_btn_or_cfp" 
                                    value="1" 
									id="show_atc_btn_or_cfp"
									<?php if($_SESSION['temp_item_fields']['show_atc_btn_or_cfp']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>


					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Start Design Button</label>
							<div class="checkboxtoggle on" id="show_start_design_toggle"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_start_design_btn" 
                                    value="1" 
									id="show_start_design_btn"
									<?php if($_SESSION['temp_item_fields']['show_start_design_btn']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Design Request Button</label>
							<div class="checkboxtoggle on" id="show_design_request_toggle"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_design_request_btn" 
                                    value="1" 
									id="show_design_request_btn"
									<?php if($_SESSION['temp_item_fields']['show_design_request_btn']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
                    
                    

					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Videos</label>
							<div class="checkboxtoggle on" id="show_videos_toggle"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_videos" 
                                    value="1" 
									id="show_videos"
									<?php if($_SESSION['temp_item_fields']['show_videos']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>
                    
                    <?php
					
						//echo $_SESSION['temp_item_fields']['show_associated_kits'];
						
/*						
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT show_associated_kits, show_videos
		FROM item
		WHERE profile_item_id = '".$object->profile_item_id."'";
$result = $dbCustom->getResult($db,$sql);

$obj = $result->fetch_object();
echo $obj->show_associated_kits."       ".$obj->show_videos;			
*/					
					?>
                    


					<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Show Associated Kit Products</label>
							<div class="checkboxtoggle on" id="show_associated_kits_toggle"> 
                            	<span class="ontext">YES</span>
                            	<a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                	class="checkboxinput" 
                                    name="show_associated_kits" 
                                    value="1" 
									id="show_associated_kits"
									<?php if($_SESSION['temp_item_fields']['show_associated_kits']) echo "checked='checked'";?> />
                           </div>
						</div>
                    </div>                    
				</fieldset>
                
                
				<a id="img"></a>
				<fieldset class="edit_images" id="product_images">
					<legend>Main Product Image <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
						<?php
						
							echo "<br />";
							echo "<br />";
							echo "img_id id  ".$_SESSION['img_id'];
							echo "<br />";
							echo "<br />";
						
						
							$sql = "SELECT file_name FROM image
							WHERE img_id = '".$_SESSION['img_id']."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$file_name = $img_obj->file_name;
							}else{
								$file_name = '';
							}
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$file_name."'>";
							//echo "img_id".$_SESSION['img_id']."   ";
							//echo "file_name:".$file_name;
							//echo "<br />";
							
							//<a href='#' class='btn btn-small btn-danger confirm'><i class='icon-remove icon-white'></i></a>";			
				$_SESSION['crop_n'] = 1;
				$_SESSION['img_type'] = 'cart';
							
						
						$url_str= "../../upload-pre-crop.php"; 
						//$url_str = preg_replace('/(\/+)/','/',$url_str);
						
						$url_str.= "?ret_page=edit-item";
						
						$url_str.= "&ret_dir=products";
						$url_str.= "&ret_path=catalog/products";
						
						$url_str.= "&item_id=".$_SESSION['item_id'];
						$url_str.= "&upload_new_img=1";
						$url_str.= "&parent_item_id=".$_SESSION['item_id'];
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];		

						?>
					<!--
					<input type="text" name="file_name" value="<?php //echo $file_name; ?>" style="width:600px;">
                    -->
					</div>
                    <div class="colcontainer">
						<div class="twocols">
                        <!-- fancybox fancybox.iframe -->       
                            <a class="btn btn-primary upload" 
                            href="<?php echo $url_str; ?>"  
                            title=""><i class="icon-plus icon-white"></i> Upload New Main Image </a>
						</div>
                        
                     <?php
						$url_str= $ste_root."manage/catalog/select-image.php";               				
				$url_str = preg_replace('/(\/+)/','/',$url_str);
						
						$url_str.= "?ret_page=edit-item";
						$url_str.= "&ret_dir=products";
						$url_str.= "&ret_path=catalog/products";
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];		

					?>                    
						
                        <div class="twocols">
                        	<!-- fancybox fancybox.iframe -->
                            <a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                            <i class="icon-plus icon-white"></i> Select New Main Image </a>

						</div>

                        
                        
					</div>

                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Main Image Alt Text</label>
						</div>
						<div class="twocols">
							<input type="text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_item_fields']['img_alt_text']); ?>" />
						</div>
					</div>



                    <br />
                   
					<?php       
					foreach($_SESSION['temp_gallery'] as $val){
						$sql = "SELECT file_name FROM image
								WHERE img_id = '".$val."'";
						$img_res = $dbCustom->getResult($db,$sql);
						
						if($img_res->num_rows > 0){
							$img_obj = $img_res->fetch_object();
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$img_obj->file_name."'>";			
							echo "<a href='edit-item.php?delgalleryimgid=".$val."#img' class='btn btn-small btn-danger'><i class='icon-remove icon-white'></i></a>";
							echo "<br />";
						}
					}

						$url_str= $ste_root."manage/upload-pre-crop.php";               				
				$url_str = preg_replace('/(\/+)/','/',$url_str);
						
						$url_str.= "?ret_page=edit-item";
						$url_str.= "&ret_dir=products";
						$url_str.= "&ret_path=catalog/products";
						$url_str.= "&img_type=gallery";
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];		
						
						?>
                    <div class="colcontainer">
                    	<div class="twocols">
                        	<!-- fancybox fancybox.iframe --> 
                        	<a class="btn btn-primary upload" href="<?php echo $url_str; ?>">
                        	<i class="icon-plus icon-white"></i> Upload New Gallery Image </a>
						</div>
						<?php
							$url_str= $ste_root."manage/catalog/select-image.php";               				
				$url_str = preg_replace('/(\/+)/','/',$url_str);
							$url_str.= "?ret_page=edit-item";
                            $url_str.= "&ret_dir=products";
							$url_str.= "&ret_path=catalog/products";
                            $url_str.= "&img_type=gallery";
                            $url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
                            $url_str.= "&cat_id=".$_SESSION['cat_id'];		
    
                        ?>                    
                        <div class="twocols"> 
                        	<!-- fancybox fancybox.iframe -->
                            <a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                            <i class="icon-plus icon-white"></i> Select New Gallery Image </a>
                        </div>
					</div>


				</fieldset>
                
                
                
				<a id="vid"></a>
				<fieldset class="edit_videos" id="product_videos">
					<legend>Product Videos <i class="icon-minus-sign icon-white"></i></legend>
                    <table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="30%">Title and Placeholder</th>							
							<th width="30%">Description</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$block = '';       
					foreach($_SESSION['temp_videos'] as $val){						
						$block .= "<tr>";

						$block .= "<td>".stripslashes($val['title'])."<br /><img width='200' height='200' src='http://img.youtube.com/vi/".$val['youtube_id']."/0.jpg' /></td>";
						
						$block .= "<td>".stripslashes($val['description'])."</td>";
						
						$url_str= $ste_root.'manage/catalog/products/edit-item-video.php';
				$url_str = preg_replace('/(\/+)/','/',$url_str);

						
						$url_str.= "?ret_page=edit-item";
						$url_str.= "&video_id=".$val['video_id'];
						
						
						$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
						
						$block .= "<td><a href='edit-item.php?delvidid=".$val['video_id']."#vid' class='btn btn-small btn-danger'><i class='icon-remove icon-white'></i></a></td>";
						$block .= "</tr>";
					}

					echo $block;						
					?>
					</tbody>
				</table>
					<?php        
						$url_str= $ste_root.'manage/catalog/products/add-item-video.php';
				$url_str = preg_replace('/(\/+)/','/',$url_str);
						
						$url_str.= "?ret_page=edit-item";
							
						
					?>
                    <div class="colcontainer">
                    	<div class="twocols"> 
                         	<!-- fancybox fancybox.iframe -->
                        	<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                        	<i class="icon-plus icon-white"></i> Add Video </a>
						</div>
						<?php
						$url_str= $ste_root.'manage/catalog/products/select-item-video.php';
				$url_str = preg_replace('/(\/+)/','/',$url_str);

               				
                            $url_str.= "?ret_page=edit-item";
    
                        ?>                    
                        <div class="twocols"> 
                            <a class="btn btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                            <i class="icon-plus icon-white"></i> Select Video </a>
                        </div>
					</div>
                    
				</fieldset>

              
				<fieldset class="edit_page" id="product_categories">
					<legend>Categories &amp; Keywords<i class="icon-minus-sign icon-white"></i></legend>
					<div class="alert alert-info"><strong>Note:</strong> You can manage and add new categories from the 
                    <a class='fancybox fancybox.iframe'  title="Opens in a Lightbox Window" 
                    href="<?php echo $ste_root; ?>/manage/catalog/categories/top-category.php?strip=1">Category <i class="icon-share"></i></a> section.</div>
					
							
                    
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Enter Keywords, Separated by Commas</label>
						</div>
						<div class="twocols">
                        
                        
							<input type="text" name="keywords" value="<?php echo prepFormInputStr($_SESSION['temp_item_fields']['keywords']); ?>" />
						</div>
					</div>
					<div class="colcontainer">

<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/catalog/products/item-category-tree-snippet.php"); ?>

					</div>
				</fieldset>


				<fieldset class="edit_page" id="product_stock">
					<legend>Stock &amp; Store Visibility Settings <i class="icon-minus-sign icon-white"></i></legend>

					<div class="colcontainer">
						<div class="twocols">
							<label>Date Active</label>
							<input type="text" name="date_active" id="datepicker1" value="<?php echo $_SESSION['temp_item_fields']['date_active']; ?>" />
						</div>
						<div class="twocols">
							<label>Date Inactive</label>
							<input type="text" name="date_inactive" id="datepicker2" value="<?php echo $_SESSION['temp_item_fields']['date_inactive']; ?>" />
						</div>
					</div>

					<div class="colcontainer checkboxcols">
                    
   						<div class="fourcols">
							<label>Show in Tool?*</label>
                            <div class="checkboxtoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input type="checkbox" class="checkboxinput" name="show_in_tool" value="1"
							<?php if($_SESSION['temp_item_fields']['show_in_tool']) echo "checked='checked'";?> /></div>
						</div>
                        
                        

                    
                    <!--
						<div class="fourcols">
							<label>Show in store section?*</label>
                            <div class="radiotoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input id='is_closet_no' type="radio" class="radioinput" name="is_closet" value="0"
							<?php //if(!$_SESSION['temp_item_fields']["is_closet"]) echo "checked='checked'";?> /></div>
						</div>
						<div class="fourcols">
							<label>Show in showroom?*</label>
                            <div class="radiotoggle on"> 
                            <span class="ontext">YES</span>
                            <a class="switch on" href="#"></a>
                            <span class="offtext">NO</span>
                            <input id='is_closet_yes' type="radio" class="radioinput" name="is_closet" value="1" 
							<?php //if($_SESSION['temp_item_fields']["is_closet"]) echo "checked='checked'";?> /></div>
						</div>
                        -->
                        
                        
                        
                        <div class="fourcols">
							<label>Show in store section?*</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" id="show_in_cart" name="show_in_cart" value="1" 
								<?php if($_SESSION['temp_item_fields']["show_in_cart"]) echo "checked='checked'";?> />
                            </div>
						</div> 
                        
                       
                       
                        <div class="fourcols">
							<label>Show in showroom?*</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" id="show_in_showroom" name="show_in_showroom" value="1" 
								<?php if($_SESSION['temp_item_fields']["show_in_showroom"]) echo "checked='checked'";?> />
                            </div>
						</div> 
                        
                        
                        
                        <div class="fourcols">
							<label>Allow back order?</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" id="allow_back_order" name="allow_back_order" value="1" 
								<?php if($_SESSION['temp_item_fields']["allow_back_order"]) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
					<div class="colcontainer">
						<label>Back Order Message</label>
						<textarea  name="back_order_message" class="wysiwyg small" id="wysiwyg4" ><?php echo stripslashes($_SESSION['temp_item_fields']["back_order_message"]); ?></textarea>
					</div>
					<div class="colcontainer">
						<label>In stock message</label>
						<textarea  name="in_stock_message" class="wysiwyg small" id="wysiwyg5" ><?php echo stripslashes($_SESSION['temp_item_fields']["in_stock_message"]); ?></textarea>
					</div>
				</fieldset>
                
				<fieldset class="edit_page" id="product_attributes">
					<legend>Product Attributes <i class="icon-minus-sign icon-white"></i></legend>
					<div class="alert alert-info"><strong>Note:</strong> 
                    You can also manage and add new attributes in the 
                    <a class='fancybox fancybox.iframe'
                    href="<?php echo $ste_root; ?>/manage/catalog/attributes/attribute.php?strip=1" title="Opens in a Lightbox Window">
                    Product Attributes <i class="icon-share"></i></a> section, and restrict product attributes by 
                    <a class='fancybox fancybox.iframe' 
                    href="<?php echo $ste_root; ?>/manage/catalog/categories/top-category.php?strip=1" title="Opens in a Lightbox Window">Category <i class="icon-share"></i></a>.</div>
                    
                    
                    <div id="attr_section">
                    
							<?php 
							
							/*							
							
							$block = '';
									
							$sql = "SELECT attribute_id, attribute_name
									FROM  attribute
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
									ORDER BY attribute_id";
							$attr_res = mysql_query ($sql);
							if(!$attr_res)die(mysql_error());
							
							
							
							while($attr_row = mysql_fetch_object($attr_res)) {
								$block .= "<label>".stripslashes($attr_row->attribute_name)."</label>";
								$block .= "<select class='chosen' multiple='multiple' name='attr_".stripslashes($attr_row->attribute_id)."[]' data-placeholder='Type or Select Attributes'>";
								
								$sql = "SELECT opt_id, opt_name
										FROM  opt, attribute 
										WHERE opt.attribute_id = attribute.attribute_id
										AND opt.attribute_id = '".$attr_row->attribute_id."' 
										ORDER BY opt_id";
								$res = $dbCustom->getResult($db,$sql);
								
								if($res->num_rows > 0){
									
									$block .= "<option value='0'>N/A</option>";
									while($opt_row = $res->fetch_object()) {
										
										
										$block .= "<option value='".$opt_row->opt_id."'>".stripslashes($opt_row->opt_name)."</option>";
									}
								}
								$block .= "</select>";
							}
							$block .= '';
							echo $block;
							
							*/
							
							?>
					</div>
                    

					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Select Brand</label>
						</div>
						<div class="twocols">
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
						</div>
					</div>
			
                                <div class="colcontainer formcols">
						<div class="twocols">
							<label>Select Style</label>
						</div>
						<div class="twocols">
							<?php
							   $block = "<select name='style_id'>";
								$db = $dbCustom->getDbConnect(CART_DATABASE);
								$sql = "SELECT name, style_id 
								FROM style
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								$res = $dbCustom->getResult($db,$sql);
								
								$block .= "<option value='0'>none</option>";
								while($b_row = $res->fetch_object()) {
									$sel = ($b_row->style_id == $_SESSION['temp_item_fields']["style_id"])? "selected": ''; 
									$block .= "<option value='".$b_row->style_id."' $sel>$b_row->name</option>";
								}
								$block .= "</select>";
								echo $block;
							?>
						</div>
					</div>

                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Select Lead Time</label>
						</div>
						<div class="twocols">
							<?php
							   $block = "<select name='lead_time_id'>";
								$db = $dbCustom->getDbConnect(CART_DATABASE);
								$sql = "SELECT lead_time, lead_time_id 
								FROM lead_time
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								$res = $dbCustom->getResult($db,$sql);
								
								$block .= "<option value='0'>none</option>";
								while($b_row = $res->fetch_object()) {
									$sel = ($b_row->lead_time_id == $_SESSION['temp_item_fields']["lead_time_id"])? "selected": ''; 
									$block .= "<option value='".$b_row->lead_time_id."' $sel>$b_row->lead_time</option>";
								}
								$block .= "</select>";
								echo $block;
							?>
						</div>
					</div>
                    
                    
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Select Skill Level</label>
						</div>
						<div class="twocols">
							<?php
							   $block = "<select name='skill_level_id'>";
								$db = $dbCustom->getDbConnect(CART_DATABASE);
								$sql = "SELECT level_name, skill_level_id 
								FROM skill_level
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								$res = $dbCustom->getResult($db,$sql);
								
								$block .= "<option value='0'>none</option>";
								while($b_row = $res->fetch_object()) {
									$sel = ($b_row->skill_level_id == $_SESSION['temp_item_fields']["skill_level_id"])? "selected": ''; 
									$block .= "<option value='".$b_row->skill_level_id."' $sel>$b_row->level_name</option>";
								}
								$block .= "</select>";
								echo $block;
							?>
						</div>
					</div>
      
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Select Type</label>
						</div>
						<div class="twocols">
							<?php
							   $block = "<select name='type_id'>";
								$db = $dbCustom->getDbConnect(CART_DATABASE);
								$sql = "SELECT name, type_id 
								FROM type
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								$res = $dbCustom->getResult($db,$sql);
								
								$block .= "<option value='0'>none</option>";
								while($b_row = $res->fetch_object()) {
									$sel = ($b_row->type_id == $_SESSION['temp_item_fields']["type_id"])? "selected": ''; 
									$block .= "<option value='".$b_row->type_id."' $sel>$b_row->name</option>";
								}
								$block .= "</select>";
								echo $block;
							?>
						</div>
					</div>

            
            		<div class="colcontainer radiocols">
						<div class="twocols">
							<label>Is this a new product?</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" name="is_new_product" value="1" 
								<?php if($_SESSION['temp_item_fields']["is_new_product"]) echo "checked='checked'";?> />
                            </div>
						</div>
						<div class="twocols">
							<label>Is this a promotional product?</label>
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" class="checkboxinput" name="is_promo_product" value="1" 
								<?php if($_SESSION['temp_item_fields']["is_promo_product"]) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
				</fieldset>

				<fieldset class="edit_page" id="product_shipping">
					<legend>Shipping Settings <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Weight</label>
						</div>
						<div class="twocols">
                       
							<input type="text" id="weight" name="weight" class="appended" value="<?php echo prepFormInputStr($_SESSION['temp_item_fields']["weight"]); ?>" />
                            <span class="append-input">lbs</span>
						</div>
					</div>

					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Shipping Flat Charge</label>
						</div>
						<div class="twocols">
							<span class="prepend-input">$</span><input type="text" id="shipping_flat_charge" name="shipping_flat_charge" value="<?php echo $_SESSION['temp_item_fields']["shipping_flat_charge"]; ?>" class="prepended" />

						</div>
					</div>


					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Return To:</label>
						</div>
						<div class="twocols">
							<?php
								$block = "<select name='return_to_id' class='form_select_small'>";
								$sql = "SELECT return_to_id, name 
										FROM return_to
										WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								
								$res = $dbCustom->getResult($db,$sql);
								
								$block .= "<option value='0'>none</option>";
								while($s_row = $res->fetch_object()) {
									$sel = ($s_row->return_to_id == $_SESSION['temp_item_fields']["return_to_id"])? "selected": ''; 					
									$block .= "<option value='".$s_row->return_to_id."' $sel>$s_row->name</option>";
								}
								$block .= "</select>";
								echo $block;
							?>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Ship Portal:</label>
						</div>
						<div class="twocols">
							<?php
									$block = "<select name='ship_port_id' class='form_select_small'>";
									$sql = "SELECT ship_port_id, name 
											FROM ship_port
											WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
									$res = $dbCustom->getResult($db,$sql);
									
									$block .= "<option value='0'>none</option>";
									while($s_row = $res->fetch_object()) {
										$sel = ($s_row->ship_port_id == $_SESSION['temp_item_fields']["ship_port_id"])? "selected": ''; 					
										$block .= "<option value='".$s_row->ship_port_id."' $sel>$s_row->name</option>";
									}
									$block .= "</select>";
									echo $block;
							?>
						</div>
					</div>

					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Is drop shipped?</label>
						</div>
						<div class="twocols">
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                class="checkboxinput" 
                                name="is_drop_shipped" 
                                id="is_drop_shipped" 
                                value="1" 
								<?php if($_SESSION['temp_item_fields']['is_drop_shipped']) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>

					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Is this a kit?</label>
						</div>
						<div class="twocols">
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                class="checkboxinput" 
                                name="is_kit" 
                                id="is_kit" 
                                value="1" 
								<?php if($_SESSION['temp_item_fields']['is_kit']) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
                    
                    
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Free shipping</label>
						</div>
						<div class="twocols">
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                class="checkboxinput" 
                                name="is_free_shipping" 
                                id="is_free_shipping" 
                                value="1" 
								<?php if($_SESSION['temp_item_fields']['is_free_shipping']) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
                    
                    
                    
                    

<?php


					echo "<label>Kit products this product is associated with:</label>";
					echo "<table>";
					$sql = "SELECT item_to_kit.kit_item_id
								,item.name
							FROM item_to_kit, item
							WHERE item_to_kit.kit_item_id = item.item_id 
							AND item_to_kit.item_id = '".$_SESSION['item_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					while($row = $result->fetch_object()){
						echo "<tr><td>".$row->name."</td></tr>";
					}
					echo "</table>";
					
					echo "<br />";

				$url_str= $ste_root.'manage/catalog/products/become-associated-kit-item.php';
				$url_str = preg_replace('/(\/+)/','/',$url_str);
												
						$url_str.= "?parent_item_id=".$_SESSION['item_id'];
						$url_str.= "&ret_page=edit-item";				
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];						
						$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
						$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
						$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
						$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
						$url_str.= '&search_str='.$_SESSION['search_str'];
						
						echo "<a id='make_child_of' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Select kits to associate with</a>";




						echo "<br /><hr /><br />";

					
					
					echo "<label>Kits products associated with this product:</label>";
					echo "<table>";
					$sql = "SELECT item_to_kit.item_id
								,item.name
							FROM item_to_kit, item
							WHERE item_to_kit.item_id = item.item_id 
							AND item_to_kit.kit_item_id = '".$_SESSION['item_id']."'";
					$result = $dbCustom->getResult($db,$sql);			
					while($row = $result->fetch_object()){
						echo "<tr><td>".$row->name."</td></tr>";
					}
					echo "</table>";
					echo "<br />";
					
				$url_str= $ste_root.'manage/catalog/products/select-associated-kit-items.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);
												
						$url_str.= "?parent_item_id=".$_SESSION['item_id'];
						$url_str.= "&ret_page=edit-item";				
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];						
						$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
						$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
						$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
						$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
						$url_str.= '&search_str='.$_SESSION['search_str'];
						
						echo "<hr /><a id='make_child_of' class='btn btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Select associate kit items</a>";



?>
					



                    
                    <!--
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Hide ID From URL?</label>
						</div>
						<div class="twocols">
							<div class="checkboxtoggle on"> 
                            	<span class="ontext">YES</span>
                                <a class="switch on" href="#"></a>
                                <span class="offtext">NO</span>
                                <input type="checkbox" 
                                class="checkboxinput" 
                                name="hide_id_from_url" 
                                id="hide_id_from_url" 
                                value="1" 
								<?php //if($_SESSION['temp_item_fields']['hide_id_from_url']) echo "checked='checked'";?> />
                            </div>
						</div>
					</div>
                    -->
                    
                    
                    
                    

				</fieldset>
<a id="doc"></a>                
   				<fieldset class="edit_page">
					<label>Documents</label>
					            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Document Name</th>
							<th>File Name</th>
							<th></th>							
							<th></th>							

						</tr>
					</thead>
					<tbody>
					<?php
					
					$block = '';       
					foreach($_SESSION['temp_documents'] as $key => $val){						
						
						
						
						
						$block .= "<tr>";
						$block .= "<td>".$val['name']."</td>";
						$block .= "<td>".$val['file_name']."</td>";

						$url_str= $ste_root."manage/catalog/edit-document.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
						
						$url_str.= "?document_id=".$val['document_id'];
                        $url_str.= "&ret_page=edit-item";
                        $url_str.= "&ret_dir=products";
                        $url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
                        $url_str.= "&cat_id=".$_SESSION['cat_id'];		  

						$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' 
						href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
			
						
						$block .= "<td><a href='edit-item.php?deldocid=".$val['document_id']."#doc' class='btn btn-small btn-danger'><i class='icon-remove icon-white'></i></a></td>";
						$block .= "</tr>";
					}

					echo $block;						
					?>
					</tbody>
				</table>

                    <div class="colcontainer">
                    	<?php
						$url_str= $ste_root."manage/catalog/doc-upload.php"; 
	$url_str = preg_replace('/(\/+)/','/',$url_str);

						$url_str.= "?ret_page=edit-item";
						$url_str.= "&ret_dir=products";
						$url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
						$url_str.= "&cat_id=".$_SESSION['cat_id'];
						?>
                        
                        <div class="twocols"> 
                        	<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                        	<i class="icon-plus icon-white"></i> Upload Document </a>
						</div>
						<?php
						$url_str= $ste_root."manage/catalog/select-document.php";               				
						$url_str = preg_replace('/(\/+)/','/',$url_str);

                            $url_str.= "?ret_page=edit-item";
                            $url_str.= "&ret_dir=products";
                            $url_str.= "&parent_cat_id=".$_SESSION['parent_cat_id'];
                            $url_str.= "&cat_id=".$_SESSION['cat_id'];		  
                        ?>                    
                        <div class="twocols"> 
                            <a class="btn btn-large btn-primary fancybox fancybox.iframe" href="<?php echo $url_str; ?>">
                            <i class="icon-plus icon-white"></i> Select Document </a>
                        </div>
					</div>
                    <br /><br />
                    <div class="colcontainer">
						<label>Text in document tabbed area</label>
						<textarea  name="doc_area_text" class="wysiwyg small" id="wysiwyg6" ><?php echo stripslashes($_SESSION['temp_item_fields']["doc_area_text"]); ?></textarea>
					</div>
				</fieldset>                
			</div>
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

<div class="disabledMsg">
	<p>Sorry, this item can't be modified.</p>
</div>

</body>
</html>


