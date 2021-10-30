<?php
$icons_array = array();;

$db = $dbCustom->getDbConnect(CART_DATABASE);

function get_svg_icon($dbCustom, $svg_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$ret_array['name']='';
	$ret_array['svg_code']='';	
	$ret_array['description']='';	
	
	$sql = "SELECT svg_code, name, description
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		$ret_array['name'] = $object->name;
		$ret_array['svg_code'] = $object->svg_code;		
		$ret_array['description'] = $object->description;		
		
	}
	return  $ret_array;
}
 
$svg_id = (isset($_GET['svg_id'])) ? $_GET['svg_id'] : 0;
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;
if(!is_numeric($cat_id)) $cat_id = 0;

if($svg_id > 0){
	$svg = get_svg_icon($dbCustom, $svg_id);	
	$svg_code = $svg['svg_code'];
	$name = $svg['name'];
	$description = $svg['description'];
}


$items = $store_data->getCartItemsFromSvg($dbCustom,$svg_id);



function get_attr_opts($dbCustom,$attribute_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$opt_array = array();
	
	$sql = "SELECT opt.opt_id, opt.opt_name
			FROM  opt, attribute 
			WHERE opt.attribute_id = attribute.attribute_id
			AND opt.attribute_id = '".$attribute_id."'";
	$res = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($opt_row = $res->fetch_object()) {
		$opt_array[$i]['opt_id'] = $opt_row->opt_id;
		$opt_array[$i]['opt_name'] = $opt_row->opt_name;
		$i++;
	}
	return $opt_array;	

}

function get_item_opts($dbCustom,$item_id){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$opt_ids = array();
	$sql = "SELECT opt_id 
			FROM item_to_opt
			WHERE item_id = '".$item_id."'";		
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;	
	while($row = $result->fetch_object()){
		$opt_ids[$i]['opt_id'] = $row->opt_id; 
		$i++;
	}
	return $opt_ids;	
}



$item_ids = array();
$sql = "SELECT 	item.item_id 
		FROM category, item, item_to_category, image
		WHERE category.cat_id = item_to_category.cat_id
		AND item_to_category.item_id = item.item_id	
		AND item.img_id = image.img_id
		AND item.active > '0'
		AND category.active > '0'
		AND category.svg_id = '".$svg_id."'";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()){

	$item_ids[$i]['item_id'] = $row->item_id; 
	$item_ids[$i]['opt_ids'] = get_item_opts($dbCustom,$row->item_id); 
	$i++;
}


$sql = "SELECT attribute_id, attribute_name
FROM  attribute
WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$attr_array = array();
$i = 0;
while($attr_row = $result->fetch_object()){
	$attr_array[$i]['attribute_id'] = $attr_row->attribute_id;
	$attr_array[$i]['attribute_name'] = $attr_row->attribute_name;
	$attr_array[$i]['opt_ids'] = get_attr_opts($dbCustom,$attr_row->attribute_id);
}



foreach($attr_array as $val){
	
	echo $val['attribute_name'];
	echo "<select name='".$val['attribute_id']."'>";
	echo "<option value='0'>select</option>";
	foreach($val['opt_ids'] as $ops){
		echo "<option value='".$ops['opt_id']."'>".$ops['opt_name']."</option>";			
	}
	echo "</select>";
	echo "<br />";
	echo "<hr />";
	echo "<br />";
}

//print_r($attr_array);


//print_r($item_ids);


//exit;











$filters_1 = '<section class="home-mobile-buttons-block showroom-page accessories-page">
<div class="accordion accordion-organizer-landing-page showroom-details accessories-accordion" id="accordion-organizer-landing">
<div class="card">
<div class="d-flex align-items-center">
<div class="card-header" id="headingOne">
<h2 class="mb-0">
<button class="accordion-organizer-button js-filter-fix-body" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
Filters
</button>
</h2>
</div>
</div>
<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-organizer-landing">
<div class="card-body">
<div class="organizer-filters-block__wrapper js-filters-box">
<div class="my-custom-select-selects-wrapper">
<div class="my-customs-select my-customs-select__features-detail">
<div class="my-customs-select__trigger">
<span>Choose item</span>
<div class="arrows"></div>
</div>
<div class="my-customs-options">
<span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 1</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 1">Item 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 2</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 2">Item 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 3</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 3">Item 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 4</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 4">Item 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 5</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 5">Item 5</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 6</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 6">Item 6</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Item 7</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Item 7">Item 7</span>
<span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
<span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
<span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
<span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
<span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-two">
<div class="my-customs-select my-customs-select__features-detail">
<div class="my-customs-select__trigger">
<span>Item 1</span>
<div class="arrows"></div>
</div>
<div class="my-customs-options">
<span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
</div>
</div>
</div>
</div>
</div>
<div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-three">
<div class="my-customs-select my-customs-select__features-detail">
<div class="my-customs-select__trigger">
<span>Item 2</span>
<div class="arrows"></div>
</div>
<div class="my-customs-options">
<span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
</div>
</div>
</div>
</div>
</div>
<div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-four">
<div class="my-customs-select my-customs-select__features-detail">
<div class="my-customs-select__trigger">
<span>Item 3</span>
<div class="arrows"></div>
</div>
<div class="my-customs-options">
<span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
</div>
</div>
</div>
</div>
</div>
<div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five">
<div class="my-customs-select my-customs-select__features-detail">
<div class="my-customs-select__trigger">
<span>Item 4</span>
<div class="arrows"></div>
</div>
<div class="my-customs-options">
<span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
</div>
</div>
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
</div>
</div>
</div>
</div>
</div>
<form class="w-100 text-center">
<div class="d-flex justify-content-between">
<button type="button" class="btn btn-secondary accordion-organizer-submit">Apply filters</button>
<button type="button" class="btn btn-secondary accordion-organizer-submit clear-filters-accessories js-clear-filter">Clear filters</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
';



$filters_2 = '      <section class="search-filters-sort_by-view">
         <div class="wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-lg-2">
                     <form action="#">
                        <input type="text" placeholder="Search item">
                        <button>
                        <img src="<?php echo SITEROOT; ?>images/search(1).svg" alt="">
                        </button>
                     </form>
                  </div>
                  <div class="col-12 col-lg-8">
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__one ">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Choose item</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 1</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 1">Item 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 2</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 2">Item 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 3</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 3">Item 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 4</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 4">Item 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 5</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 5">Item 5</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 6</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 6">Item 6</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 7</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 7">Item 7</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
					 
					 
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-two">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 1</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-three">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 2</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-four">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 3</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 4</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper clear-filters clear-filters-accessories">
                        <div class="covid-header">
                           <button class="js-clear-all-accessories-filters">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                 <g transform="translate(0 -0.001)">
                                    <g transform="translate(0 0.001)">
                                       <path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"/>
                                    </g>
                                 </g>
                              </svg>
                           </button>
                           <span>Clear filters</span>
                        </div>
                     </div>
                  </div>
				  
                  <div class="col-12 col-lg-2 latest-box">
                     <div class="select-custom accessories-select" data-select="select-option__sort-by">
                        <div class="my-custom-select-selects-wrapper show-select my-custom-select-selects-wrapper-six">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Sort By</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
					 
                     <div class="category-block__filters--right-wrapper">
                        <div class="category-block__filters--right-content">
                           <span>View:</span>
                           <button data-type="js-thumb"
                              class="category-block__filters--button js-switch-list-view-sm active">
                              <svg id="thumb-menu-gray" data-name="thumb-menu-gray"
                                 xmlns="http://www.w3.org/2000/svg" width="18.146"
                                 height="18.146" viewBox="0 0 18.146 18.146">
                                 <g id="Group_343" data-name="Group 343">
                                    <g id="Group_342" data-name="Group 342">
                                       <path id="Path_182" data-name="Path 182"
                                          d="M6.266,0H2.1A2.1,2.1,0,0,0,0,2.1V6.266a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V2.1A2.1,2.1,0,0,0,6.266,0Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V2.1A.682.682,0,0,1,2.1,1.418H6.266a.682.682,0,0,1,.681.681Z"
                                          fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_345" data-name="Group 345"
                                    transform="translate(9.782)">
                                    <g id="Group_344" data-name="Group 344">
                                       <path id="Path_183" data-name="Path 183"
                                          d="M282.238,0h-4.111A2.129,2.129,0,0,0,276,2.126V6.238a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126V2.126A2.129,2.129,0,0,0,282.238,0Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709V2.126a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z"
                                          transform="translate(-276)" fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_347" data-name="Group 347"
                                    transform="translate(0 9.782)">
                                    <g id="Group_346" data-name="Group 346">
                                       <path id="Path_184" data-name="Path 184"
                                          d="M6.266,276H2.1A2.1,2.1,0,0,0,0,278.1v4.167a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V278.1A2.1,2.1,0,0,0,6.266,276Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V278.1a.682.682,0,0,1,.681-.681H6.266a.682.682,0,0,1,.681.681Z"
                                          transform="translate(0 -276)" fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_349" data-name="Group 349"
                                    transform="translate(9.782 9.782)">
                                    <g id="Group_348" data-name="Group 348">
                                       <path id="Path_185" data-name="Path 185"
                                          d="M282.238,276h-4.111A2.129,2.129,0,0,0,276,278.126v4.111a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126v-4.111A2.129,2.129,0,0,0,282.238,276Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709v-4.111a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z"
                                          transform="translate(-276 -276)"
                                          fill="#949dae"/>
                                    </g>
                                 </g>
                              </svg>
                           </button>
                           <button data-type="js-list"
                              class="category-block__filters--button js-switch-list-view-sm ">
                              <svg id="hamburger-menu-gray" data-name="hamburger-menu-gray"
                                 xmlns="http://www.w3.org/2000/svg" width="17.941"
                                 height="18.146" viewBox="0 0 17.941 18.146">
                                 <path id="Path_186" data-name="Path 186"
                                    d="M17.194,124.608H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0"
                                    transform="translate(0 -114.565)" fill="#949dae"/>
                                 <path id="Path_187" data-name="Path 187"
                                    d="M17.194,1.94H.748A.881.881,0,0,1,0,.97.881.881,0,0,1,.748,0H17.194a.881.881,0,0,1,.748.97A.881.881,0,0,1,17.194,1.94Zm0,0"
                                    fill="#949dae"/>
                                 <path id="Path_188" data-name="Path 188"
                                    d="M17.194,247.272H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0"
                                    transform="translate(0 -229.126)" fill="#949dae"/>
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
	  
';


?>
