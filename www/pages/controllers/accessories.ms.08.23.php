<?php
$n=0;
function get_all_items_per_svg($svg_id){
	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_id
			FROM item
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	while($row = $object = $re->fetch_object()){
		$ret_array[] = $object->item_id;
	}
	return  $ret_array;
} 

function get_svg_data($svg_id){
	$ret_data['name'] = '';
	$ret_data['svg_code'] = '';
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT *
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		$ret_data['name'] = $object->name;
		$ret_data['svg_code'] = $object->svg_code;
	}
	return  $ret_data;
}


function opt_in_items($opt_id, $itm_ids){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	foreach($itm_ids as $v){
		$sql = "SELECT item_to_opt_id 
				FROM item_to_opt
				WHERE item_id = '".$v."'
				AND opt_id ='".$opt_id."'";
		$re = $dbCustom->getResult($db,$sql);	
		if($re->num_rows>0){
			return 1;
		}
	}
	return 0;
}

function get_sub_array($attribute_id, $itm_ids){
	$ret_array = array();
	$i = 0;
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT opt.opt_id, opt.opt_name 
			FROM opt
			WHERE attribute_id = '".$attribute_id."'";
	$re = $dbCustom->getResult($db,$sql);	
	while($row = $re->fetch_object()){			
		if(opt_in_items($row->opt_id, $itm_ids)){
			$ret_array[$i]['opt_id'] = $row->opt_id;
			$ret_array[$i]['opt_name'] = $row->opt_name;
			$ret_array[$i]['attribute_id'] = $attribute_id;				
			$i++;
		}			
	}
	return  $ret_array;
}

function get_attr_id_from_opt_id($opt_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT attribute_id
			FROM opt
			WHERE opt_id = '".$opt_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$obj = $re->fetch_object(); 		
		return $obj->attribute_id; 		
	}
	return 8888;
}

function get_attr_name_from_attr_id($attribute_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT attribute_name
			FROM attribute
			WHERE attribute_id = '".$attribute_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$obj = $re->fetch_object(); 		
		return $obj->attribute_name; 		
	}
	return '?????';
}	

$db = $dbCustom->getDbConnect(CART_DATABASE);
$svg_id = (isset($_GET['Id']))? $_GET['Id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;
$items_array = $store_data->getCartItemsFromSvg($dbCustom,$svg_id);

$svg_data = get_svg_data($svg_id);
$name = $svg_data['name'];
$svg_code = $svg_data['svg_code'];

if(!isset($_SESSION['selected_opt_0'])) $_SESSION['selected_opt_0'] = 0;
if(!isset($_SESSION['selected_opt_1'])) $_SESSION['selected_opt_1'] = 0;
if(!isset($_SESSION['selected_opt_2'])) $_SESSION['selected_opt_2'] = 0;
if(!isset($_SESSION['selected_opt_3'])) $_SESSION['selected_opt_3'] = 0;

if(isset($_POST['opt_0'])){
	
	$opt_0=(isset($_POST['opt_0']))?$_POST['opt_0']:0; 
	$opt_1=(isset($_POST['opt_1']))?$_POST['opt_1']:0; 
	$opt_2=(isset($_POST['opt_2']))?$_POST['opt_2']:0; 
	$opt_3=(isset($_POST['opt_3']))?$_POST['opt_3']:0; 
	
	if(!is_numeric($opt_0))$opt_0=0;
	if(!is_numeric($opt_1))$opt_1=0;
	if(!is_numeric($opt_2))$opt_2=0;
	if(!is_numeric($opt_3))$opt_3=0;
	
	if($opt_0>0)$_SESSION['selected_opt_0']=$opt_0;
	if($opt_1>0)$_SESSION['selected_opt_1']=$opt_1;
	if($opt_2>0)$_SESSION['selected_opt_2']=$opt_2;
	if($opt_3>0)$_SESSION['selected_opt_3']=$opt_3;
	
	// sort items and make unique
	$keys = array_column($items_array, 'item_id');
	array_multisort($keys, SORT_ASC, $items_array);
	
	$tmp_item_id = 0;
	$tmp_array=array();
	$i=0;
	foreach($items_array as $val){
		if($tmp_item_id<$val['item_id']){
			$tmp_item_id = $val['item_id'];
			$sql = "SELECT opt_id, item_id
					FROM item_to_opt
					WHERE item_id = '".$val['item_id']."'";
			if($opt_0 > 0){
				$sql .="AND opt_id = '".$opt_0."' ";
			}
			if($opt_1 > 0){
				$sql .="AND opt_id = '".$opt_1."' ";
			}
			if($opt_2 > 0){
				$sql .="AND opt_id = '".$opt_2."' ";
			}
			if($opt_3 > 0){
				$sql .="AND opt_id = '".$opt_3."' ";	
			}
			$re = $dbCustom->getResult($db,$sql);		
			if($re->num_rows > 0){						
				$obj = $re->fetch_object(); 					
				$tmp_array[$i]['item_id']=$obj->item_id;
				$tmp_array[$i]['name']=$val['name'];
				$tmp_array[$i]['file_name']=$val['file_name'];
				$tmp_array[$i]['short_description']=$val['short_description'];
				$tmp_array[$i]['description']=$val['description'];
				$tmp_array[$i]['price_flat']=$val['price_flat'];
				$i++;
			}
			
		}
	}
	$items_array = $tmp_array;
}

$mobile_buttons_section = ';
<section class="home-mobile-buttons-block covid-block ">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="home-mobile-buttons-block__wrapper accessories">
<a href="accessory.html" title="" class="back-link">
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
<path d="M0 0h24v24H0V0z" fill="none"/>
<path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
</svg>
</a>
<h2>
<span>
<svg xmlns="http://www.w3.org/2000/svg" width="48.679" height="43"
viewBox="0 0 48.679 43">
<g id="drawers" transform="translate(0 -29.867)">
<g id="Group_416" data-name="Group 416" transform="translate(0 29.867)">
<g id="Group_415" data-name="Group 415" transform="translate(0 0)">
<path id="Path_222" data-name="Path 222"
d="M44.623,29.867H4.057A4.061,4.061,0,0,0,0,33.924V65.565A4.063,4.063,0,0,0,3.245,69.54v.893a2.437,2.437,0,0,0,2.434,2.434h4.868a2.437,2.437,0,0,0,2.434-2.434v-.811H35.7v.811a2.437,2.437,0,0,0,2.434,2.434H43a2.437,2.437,0,0,0,2.434-2.434V69.54a4.063,4.063,0,0,0,3.245-3.975V33.924A4.061,4.061,0,0,0,44.623,29.867ZM11.359,70.433a.812.812,0,0,1-.811.811H5.679a.812.812,0,0,1-.811-.811v-.811h6.491v.811Zm32.453,0a.812.812,0,0,1-.811.811H38.132a.812.812,0,0,1-.811-.811v-.811h6.491Zm3.245-4.868A2.437,2.437,0,0,1,44.623,68H4.057a2.437,2.437,0,0,1-2.434-2.434V33.924A2.437,2.437,0,0,1,4.057,31.49H44.623a2.437,2.437,0,0,1,2.434,2.434V65.565Z"
transform="translate(0 -29.867)"></path>
<path id="Path_223" data-name="Path 223"
d="M75.511,64H34.945a.811.811,0,0,0-.811.811V96.453a.811.811,0,0,0,.811.811H75.511a.811.811,0,0,0,.811-.811V64.811A.811.811,0,0,0,75.511,64ZM74.7,95.642H35.757V86.717H74.7Zm0-10.547H35.757V76.17H74.7Zm0-10.547H35.757V65.623H74.7Z"
transform="translate(-30.889 -60.755)"></path>
<path id="Path_224" data-name="Path 224"
d="M232.834,103a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,103Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,99.756Z"
transform="translate(-208.494 -91.642)"></path>
<path id="Path_225" data-name="Path 225"
d="M232.834,213.935A2.434,2.434,0,1,0,230.4,211.5,2.434,2.434,0,0,0,232.834,213.935Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,210.69Z"
transform="translate(-208.494 -192.029)"></path>
<path id="Path_226" data-name="Path 226"
d="M232.834,324.868a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,324.868Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,321.623Z"
transform="translate(-208.494 -292.415)"></path>
</g>
</g>
</g>
</svg>
</span>
Wardrobe Tubes Specification
</h2>
</div>
</div>
</div>
</div>
</div>
</section>
';

$mobil_filters_section = ' ';
$mf="<section class='home-mobile-buttons-block showroom-page accessories-page'>";
$mf.="<div class='accordion accordion-organizer-landing-page showroom-details accessories-accordion' id='accordion-organizer-landing'>";
$mf.="<div class='card'>";
$mf.="<div class='d-flex align-items-center'>";
$mf.="<div class='card-header' id='headingOne'>";
$mf.="<h2 class='mb-0'>";
$mf.="<button class='accordion-organizer-button js-filter-fix-body' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>";
$mf.="Filters";
$mf.="</button>";
$mf.="</h2>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordion-organizer-landing'>";
$mf.="<div class='card-body'>";
$mf.="<div class='organizer-filters-block__wrapper js-filters-box'>";
$mf.="<div class='my-custom-select-selects-wrapper'>";
$mf.="<div class='my-customs-select my-customs-select__features-detail'>";
$mf.="<div class='my-customs-select__trigger'>";
$mf.="<span>Choose item</span>";
$mf.="<div class='arrows'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-options'>";
$mf.="<span class='my-customs-option selected d-n_nd' data-value='Closets'>";
$mf.="Choose item";
$mf.="</span>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>";
$mf.="Item 1";
$mf.="</span>";
$mf.="<div class='arrow-second'>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 1'>Item 1</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? 2</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem? 3</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? 4</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? 5</span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrow-second'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 2'>Item </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrow-second'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 3'>Item </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrow-second'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 4'>Item </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrow-second'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 5'>Item </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>??????????</span>";
$mf.="<div class='arrow-second'>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 6'></span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<div class='my-customs-select-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrow-second'>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-select-select-options'>";
$mf.="<span class='my-customs-select-select-option js-default-value' data-value='Item 7'>Item </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 1'>'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 2'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 3'>SubItem?</span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 4'>SubItem? </span>";
$mf.="<span class='my-customs-select-select-option' data-value='SubItem 5'>SubItem? </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-two'>";
$mf.="<div class='my-customs-select my-customs-select__features-detail'>";
$mf.="<div class='my-customs-select__trigger'>";
$mf.="<span>Item 1</span>";
$mf.="<div class='arrows'>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-options'>";
$mf.="<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 2'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 3'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 4'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 5'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 6'></span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 7'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-three'>";
$mf.="<div class='my-customs-select my-customs-select__features-detail'>";
$mf.="<div class='my-customs-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrows'></div>";
$mf.="</div>";
$mf.="<div class='my-customs-options'>";
$mf.="<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 2'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 3'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 4'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 5'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 6'></span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 7'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-four'>";
$mf.="<div class='my-customs-select my-customs-select__features-detail'>";
$mf.="<div class='my-customs-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrows'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-options'>";
$mf.="<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 2'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 3'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 4'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 5'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 6'></span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 7'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five'>";
$mf.="<div class='my-customs-select my-customs-select__features-detail'>";
$mf.="<div class='my-customs-select__trigger'>";
$mf.="<span>Item </span>";
$mf.="<div class='arrows'>";$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-customs-options'>";
$mf.="<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 2'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 3'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 4'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 5'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 6'></span>";
$mf.="</div>";
$mf.="</div>";
$mf.="<div class='my-custom-select-select-wrapper'>";
$mf.="<div class='my-customs-select-select'>";
$mf.="<span class='my-customs-select-select-option ' data-value='Item 7'>Item </span>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="<form class='w-100 text-center'>";
$mf.="<div class='d-flex justify-content-between'>";
$mf.="<button type='button' class='btn btn-secondary accordion-organizer-submit'>";
$mf.="Apply filters";
$mf.="</button>";
$mf.="<button type='button' 
	class='btn btn-secondary 
	accordion-organizer-submit 
	clear-filters-accessories 
	js-clear-filter'>
	Clear filters
</button>";
$mf.="</div>";
$mf.="</form>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</div>";
$mf.="</section>";
$mobil_filters_section = $mf;

$main = '
<main class="main clearfix accessories">
<section class="specification-detial-header desktop-show">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-12 col-lg-9">
<div class="specification-detial-header__wrap">
<span class="specification-detial-header__img">
'.$svg_code.'
</span>
<div class="specification-detial-header__content">
<h2 class="specification-detial-header__heading">'.$name.'</h2>
<p class="specification-detial-header__text">Lorem ipsum dolor sit amet,
consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
labore
</p>
</div>
</div>
</div>
<div class="col-12 col-lg-3">
<div class="specification-detial-header__link-wrap">
<a href="accessory.html" title="" class="specification-detial-header__link">back to categories</a>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
';

$filters_sort_by_section = '';
$filters_sort_by_section = '';
$fs.="<section class='search-filters-sort_by-view'>";
$fs.="<div class='wrapper'>";
$fs.="<div class='container-fluid'>";
$fs.="<div class='row'>";


$itm_ids = array();

$i = 0;
$j = 0;
$k = 0;
$attr_array = array();
$opts_array = array();
$tmp_opt_id=0;

foreach($items_array as $val){
	$itm_ids[]=$val['item_id'];
	$sql = "SELECT opt_id, item_id
			FROM item_to_opt
			WHERE item_id = '".$val['item_id']."'
			ORDER BY opt_id";
	$re = $dbCustom->getResult($db,$sql);	
	$i=0;
	while($r = $re->fetch_object()){	
		if($tmp_opt_id < $r->opt_id){
			$tmp_opt_id = $r->opt_id;
			$opts_array[$i]['opt_id'] = $r->opt_id;
			$opts_array[$i]['item_id'] = $r->item_id;
			$i++;
		}
	}
}

$i=0;
foreach($opts_array as $v){	
	$attrid = get_attr_id_from_opt_id($v['opt_id']);
	$attr_array[$i]['attribute_id'] = $attrid; 
	$attr_array[$i]['attribute_name'] = get_attr_name_from_attr_id($attrid);		
	$attr_array[$i]['sub_array'] = get_sub_array($attrid,$itm_ids);	
	$i++;
}

$keys = array_column($attr_array, 'attribute_id');
array_multisort($keys, SORT_ASC, $attr_array);

$fs.="<form action='".$_SERVER['REQUEST_URI']."' method='post'>";
$fs.="<span style='margin:20px;'><input type='submit' name='submit' value='GO' /></span>";

if(isset($attr_array[0])){
	$fs.="<div style='float:left;margin:10px;'>0:: ";
	$fs.=$attr_array[0]['attribute_name'];
	$fs.="<select id='s_attr_0' name='s_attr_0' onChange='accessories_select_option(0)'>";
	$fs.="<option value='0'>Select</option>";
	foreach($attr_array[0]['sub_array'] as $op){		
		$sel = ($op['opt_id']== $_SESSION['selected_opt_0']) ? "selected" : '';	
		$fs.="<option value='".$op['opt_id']."' ".$sel.">".$op['opt_name']."</option>";
	}
	$fs.="</select>";
	$fs.="</div>";
}
if(isset($attr_array[1])){
	$fs.="<div style='float:left;margin:10px;'>1:: ";
	$fs.=$attr_array[1]['attribute_name'];	
	$fs.="<select id='s_attr_1' name='s_attr_1' onChange='accessories_select_option(1)'>";
	$fs.="<option value='0'>Select</option>";
	foreach($attr_array[1]['sub_array'] as $op){
		$sel = ($op['opt_id']== $_SESSION['selected_opt_1']) ? "selected" : '';	
		$fs.="<option value='".$op['opt_id']."' ".$sel.">".$op['opt_name']."</option>";
	}
	$fs.="</select>";
	$fs.="</div>";
}
if(isset($attr_array[2])){
	$fs.="<div style='float:left;margin:10px;'>2:: ";
	$fs.=$attr_array[2]['attribute_name'];	
	$fs.="<select id='s_attr_2' name='s_attr_2' onChange='accessories_select_option(2)'>";
	$fs.="<option value='0'>Select</option>";
	foreach($attr_array[2]['sub_array'] as $op){
		$sel = ($op['opt_id']== $_SESSION['selected_opt_2']) ? "selected" : '';	
		$fs.="<option value='".$op['opt_id']."' ".$sel.">".$op['opt_name']."</option>";
	}
	$fs.="</select>";
	$fs.="</div>";
}
if(isset($attr_array[3])){
	$fs.="<div style='float:left;margin:10px;'>3:: ";
	$fs.=$attr_array[3]['attribute_name'];	
	$fs.="<select id='s_attr_3' name='s_attr_3' onChange='accessories_select_option(3)'>";
	$fs.="<option value='0'>Select</option>";
	foreach($attr_array[3]['sub_array'] as $op){		
		$sel = ($op['opt_id']== $_SESSION['selected_opt_3']) ? "selected" : '';	
		$fs.="<option value='".$op['opt_id']."' ".$sel.">".$op['opt_name']."</option>";
	}
	$fs.="</select>";
	$fs.="</div>";
}

$fs.="<input type='hidden' id='opt_0' name='opt_0' value='0' />";
$fs.="<input type='hidden' id='opt_1' name='opt_1' value='0' />";
$fs.="<input type='hidden' id='opt_2' name='opt_2' value='0' />";
$fs.="<input type='hidden' id='opt_3' name='opt_3' value='0' />";

$fs.="</form>";				
$fs.="</div>";
$fs.="</div>";
$fs.="</div>";
$fs.="</section>";
$filters_sort_by_section = $fs;


$items_block=$s='';
$s.="<div class='wrapper accessories-page'>";
$s.="<div class='js-list category-block__thumb accessories-product-box' id='list-view'>";
$s.="<div class='container-fluid'>";

$s.="<ul id='html5-videos' class='accessories-products' style='border-style:solid; border-color:yellow;'>";

foreach($items_array as $val){
$s.="<li data-sub-html='>Product description 1'>";
	$s.="<div>";
		$s.="<div class='product-image'>";
			$img = SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$val['file_name'];
			$s.="<img src='".$img."' alt='' class=''>";
		$s.="</div>";
		$s.="<p class='product-title'>".stripslashes($val['name'])."</p>";
		$s.="<p class='product-description__text'>";
		$s.= stripslashes($val['short_description']); 
		$s.="</p>";
		$s.="<div class='share-product-accessories'>";
			$s.="<a href='#'>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
				<defs>
				<style>.share-no-background{fill:#384765;}</style>
				</defs>
				<g transform='translate(0)'>
				<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
				<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
				<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
				<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
				<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
				<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
				<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
				<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
				</g>
				</svg>";
				$s.="</a>";
				$s.="<span class='trash-icon'>";
				$s.="<a href='#'>";
				$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
				<defs>
				<style>.a{fill:#18c4c7;}</style>
				</defs>
				<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
				<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
				</svg>";
				$s.="</a>";
				$s.="</span>";
			$s.="</div>";
			$s.="<div class='see-detail-product-accessories'>";
				$nm = $nav->getUrlText($val['name']);
				//http://localhost/product-97/tie-scarf-rack.html
				$url_str .= SITEROOT."/product-".$val['item_id']."/".$nm."html";
				$s.="<p><a href='".$url_str."'>See details</a></p>";
			$s.="</div>";
		$s.="<div class='stars-review-price-btn'>";
	$s.="<div class='stars-product-accessories'>";
$s.="<div class='stars-container'>";
if($n==3){
	$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
	$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
}
if($n==4){
	$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
}
$s.="</div>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
	$price = number_format($val['price_flat']);
	$s.="<p>Price: $".$price."</p>";
$s.="</div>";
$s.="<div class='btn-add-to-cart'>";
$s.="<span class='card-el__hide-on-md' onClick='add_item(".$val['item_id'].");'>Q*Q*Q quick add to cart</span>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</li>";
}
$s.="</ul>";
//***************************************
$s.="<ul id='html5-videos' class='accessories-products landscape-accessories-products'
style='border-style:solid; border-color:blue;'>";
$s.="<li data-sub-html='Product description 1' data-html='#video1'>";
$s.="<div>";
$s.="<div>";
$s.="<img class='landscape-images' src='".SITEROOT."/images/accessories-product-6.png' alt=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet...</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elit,invid ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</p>";
$s.="</div>";
$s.="<div class='stars-review-counter-accessories'>";
$s.="<div class='stars-container'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
<defs>
<style>.share-no-background{fill:#384765;}</style>
</defs>
<g transform='translate(0)'>
<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
</g>
</svg>";
$s.="</a>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
<defs>
<style>.a{fill:#18c4c7;}</style>
</defs>
<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="<span class='card-el__hide-on-md'>quick add to cart</span>";
$s.="</div>";
$s.="</li>";
$s.="<li data-sub-html='Product description 1' data-html='#video1'>";
$s.="<div>";
$s.="<div>";
$s.="<img class='landscape-images' src='".SITEROOT."/images/accessories-product-7.png' alt=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet...</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elit,invid ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</p>";
$s.="</div>";
$s.="<div class='stars-review-counter-accessories'>";
$s.="<div class='stars-container'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
<defs>
<style>.share-no-background{fill:#384765;}</style>
</defs>
<g transform='translate(0)'>
<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
</g>
</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
<defs>
<style>.a{fill:#18c4c7;}</style>
</defs>
<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="<span class='card-el__hide-on-md'>quick add to cart</span>";
$s.="</div>";
$s.="</li>";
$s.="</ul>";
//***************************************
$s.="<ul id='html5-videos' class='accessories-products' 
			style='border-style:solid; border-color:red;'>";
$s.="<li data-sub-html='Product description 1'>";
$s.="<div>";
$s.="<div class='product-image'>";
$s.="<img src='".SITEROOT."/images/accessories-product-1.png' alt='' class=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet, consetetur sadipscing</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>";
$s.="<div class='share-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
<defs>
<style>.share-no-background{fill:#384765;}</style>
</defs>
<g transform='translate(0)'>
<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
</g>
</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
<defs>
<style>.a{fill:#18c4c7;}</style>
</defs>
<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="</div>";
$s.="<div class='stars-review-price-btn'>";
$s.="<div class=' stars-product-accessories'>";
$s.="<div class='stars-container'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
$s.="</div>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="<div class='btn-add-to-cart'>";
$s.="<span class='card-el__hide-on-md'>quick add to cart</span>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</li>";
$s.="<li data-sub-html='Product description 1'>";
$s.="<div>";
$s.="<div class='product-image'>";
$s.="<img src='".SITEROOT."/images/accessories-product-2.png' alt='' class=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet, consetetur sadipscing</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>";
$s.="<div class='share-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
<defs>
<style>.share-no-background{fill:#384765;}</style>
</defs>
<g transform='translate(0)'>
<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
</g>
</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
<defs>
<style>.a{fill:#18c4c7;}</style>
</defs>
<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="</div>";
$s.="<div class='stars-review-price-btn'>";
$s.="<div class=' stars-product-accessories'>";
$s.="<div class='stars-container'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
$s.="</div>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="<div class='btn-add-to-cart'>";
$s.="<span class='card-el__hide-on-md'>quick add to cart</span>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</li>";
$s.="<li data-sub-html='Product description 1'>";
$s.="<div>";
$s.="<div class='product-image'>";
$s.="<img src='".SITEROOT."/images/accessories-product-3.png' alt='' class=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet, consetetur sadipscing</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>";
$s.="<div class='share-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
	<defs>
	<style>.share-no-background{fill:#384765;}</style>
	</defs>
	<g transform='translate(0)'>
	<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
	<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
	<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
	<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
	<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
	<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
	<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
	<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
	</g>
</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
	<defs>
	<style>.a{fill:#18c4c7;}</style>
	</defs>
	<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
	<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="</div>";
$s.="<div class='stars-review-price-btn'>";
	$s.="<div class=' stars-product-accessories'>";
		$s.="<div class='stars-container'>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
		$s.="</div>";
	$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="<div class='btn-add-to-cart'>";
$s.="<span class='card-el__hide-on-md'>quick add to cart</span>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</li>";
$s.="<li data-sub-html='Product description 1'>";
$s.="<div>";
$s.="<div class='product-image'>";
$s.="<img src='".SITEROOT."/images/accessories-product-4.png' alt='' class=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet, consetetur sadipscing</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>";
$s.="<div class='share-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
	<defs>
	<style>.share-no-background{fill:#384765;}</style>
	</defs>
	<g transform='translate(0)'>
	<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
	<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
	<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
	<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
	<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
	<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
	<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
	<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
	</g>
	</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
	<defs>
	<style>.a{fill:#18c4c7;}</style>
	</defs>
	<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
	<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="</div>";
$s.="<div class='stars-review-price-btn'>";
$s.="<div class=' stars-product-accessories'>";
$s.="<div class='stars-container'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
	<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
	<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
	<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
	<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
</svg>";
$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
$s.="</div>";
$s.="</div>";
$s.="<div class='reviews-counter-product-accessories'>";
	$s.="<p>115 reviews</p>";
$s.="</div>";
$s.="<div class='price'>";
	$s.="<p>Price: $10</p>";
$s.="</div>";
$s.="<div class='btn-add-to-cart'>";
$s.="<span class='card-el__hide-on-md'>quick add to cart </span>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</li>";
$s.="<li data-sub-html='Product description 1'>";
$s.="<div>";
$s.="<div class='product-image'>";
$s.="<img src='".SITEROOT."/images/accessories-product-5.png' alt='' class=''>";
$s.="</div>";
$s.="<p class='product-title'>Lorem ipsum dolor sit amet, consetetur sadipscing</p>";
$s.="<p class='product-description__text'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>";
$s.="<div class='share-product-accessories'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='23.547' height='25.688' viewBox='0 0 23.547 25.688'>
	<defs>
	<style>.share-no-background{fill:#384765;}</style>
	</defs>
	<g transform='translate(0)'>
	<path class='share-no-background' d='M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0' transform='translate(-298.881 -15.197)'/>
	<path class='share-no-background' d='M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(-283.683 0)'/>
	<path class='share-no-background' d='M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0' transform='translate(-298.881 -339.404)'/>
	<path class='share-no-background' d='M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0' transform='translate(-283.683 -324.207)'/>
	<path class='share-no-background' d='M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0' transform='translate(-15.197 -177.303)'/>
	<path class='share-no-background' d='M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0' transform='translate(0 -162.105)'/>
	<path class='share-no-background' d='M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0' transform='translate(-108.611 -85.688)'/>
	<path class='share-no-background' d='M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0' transform='translate(-108.633 -252.862)'/>
	</g>
</svg>";
$s.="</a>";
$s.="<span class='trash-icon'>";
$s.="<a href='#'>";
$s.="<svg xmlns='http://www.w3.org/2000/svg' width='22.783' height='20.49' viewBox='0 0 22.783 20.49'>
	<defs>
	<style>.a{fill:#18c4c7;}</style>
	</defs>
	<path class='a' d='M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z' transform='translate(0 -0.963)'/>
	<path class='a' d='M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z' transform='translate(11.402 22.514)'/>
</svg>";
$s.="</a>";
$s.="</span>";
$s.="</div>";
$s.="<div class='see-detail-product-accessories'>";
	$s.="<p><a href='/ClosetsToGo-website/product-detail-view.html'>See details</a></p>";
$s.="</div>";
$s.="<div class='stars-review-price-btn'>";
	$s.="<div class=' stars-product-accessories'>";
		$s.="<div class='stars-container'>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
			$s.="<svg xmlns='http://www.w3.org/2000/svg' width='17.513' height='16.706' viewBox='0 0 17.513 16.706'>
			<path id='Path_522' data-name='Path 522' d='M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z' transform='translate(0 -11.796)' fill='#ededed'/>
			</svg>";
		$s.="<img src='".SITEROOT."/images/stars.svg' alt=''>";
		$s.="</div>";
	$s.="</div>";
	$s.="<div class='reviews-counter-product-accessories'>";
		$s.="<p>115 reviews</p>";
	$s.="</div>";
	$s.="<div class='price'>";
	$s.="<p>Price: $10</p>";
	$s.="</div>";
		$s.="<div class='btn-add-to-cart'>";
			$s.="<span class='card-el__hide-on-md'>";
			$s.="quick add to cart";
			$s.="</span>";
		$s.="</div>";
	$s.="</div>";
$s.="</div>";
$s.="</li>";
$s.="</ul>";
//***************************************
$s.="<div id='infinite-block'>";
$s.="</div>";              
$s.="<div class='loading'>";
$s.="<div class='ball'></div>";
$s.="<div class='ball'></div>";
$s.="<div class='ball'></div>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$s.="</div>";
$items_block = $s;


?>