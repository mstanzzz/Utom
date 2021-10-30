<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$ts = time();
$sql = "SELECT img_id, p_1_head, p_1_text
		FROM showroom_cat
		WHERE showroom_cat.showroom_cat_id = (SELECT MAX(showroom_cat_id) 
											FROM showroom_cat 
											WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$p_1_head = $object->p_1_head;
	$p_1_text = $object->p_1_text;
}else{
	$img_id = 0;
	$p_1_head = '';
	$p_1_text = '';

}

//HERO
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$file_name = $object->file_name;
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT name, short_description, description
		FROM category
		WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name; 
	$short_description = $object->short_description; 
	$description = $object->description; 
	
}else{
	$name = '';
	$short_description = ''; 
	$description = ''; 
	
}

$opt_id_array = array();
$item_images = '';
$show_in = 'cart';
$limit = 0;
$i = 1;

$items = $store_data->getItemsFromCat($dbCustom,$cat_id);
foreach($items as $val){
		
	// get attribute options
	$sql = "SELECT opt_id
	FROM item_to_opt
	WHERE item_id = '".$val['item_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$opt_id_array[] = $object->opt_id;
	}		
	
	if($i % 6 == 0 || $i == 1){
		$item_images .= "<div class='col-12 col-lg-6 hidden-box open'>";
		$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
	}else{
		$item_images .= "<div class='col-6 col-lg-3 hidden-box open'>";
		$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	}
	
	if($i % 6 == 0){
		$i=0;
	}
	
	$nm = stripSlashes($val['name']);	
	$nm = $nav->getUrlText($nm);
	$nm = substr($nm,0,60);

	
	$url_str = SITEROOT."showroom-product-".$val['item_id']."/".$nm.".html";
		
	$item_images .= "<figure class='showroom-block__item'>";
	$item_images .= "<img src='".$img."' alt='' class='showroom-block__item--img'>";
	$item_images .= "<figcaption class='showroom-block__item--wrapper'>";
	$item_images .= "<div class='showroom-block__item--content'>";
	$item_images .= "<h2>Showroom product preview</h2>";
	$item_images .= "<a href='".$url_str."' title='' class='link-button'>";
	$item_images .= "Shop now  ".$i;
	$item_images .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
	$item_images .= "<path id='left-arrow_3_' data-name='left-arrow(3)' d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z' transform='translate(0.001 -4.676)'>";
	$item_images .= "</path>";
	$item_images .= "</svg>";
	$item_images .= "</a>";
	
	$item_images .= "<div class='showroom-block__item--images'>";
	$item_images .= "<img src='".SITEROOT."images/Group174.svg' alt=''>";
	$item_images .= "<p>/ 275 views</p>";
	$item_images .= "</div>";
	$item_images .= "<button class='save-for-idea' data-img-path='".SITEROOT."images/showroom-".$i.".png' tabindex='0'>";
	$item_images .= "</button>";
	
	$item_images .= "<span style='font-size:0.8em; padding:10px;'>Lorem Ipsum passages of Lorem Ipsum available, but the majority have humour but the majority have humour, 
	or randomised words which don't look even slightly of Lorem Ipsum</span>";
	
	$item_images .= "</div>";
	$item_images .= "</figcaption>";
	$item_images .= "</figure>";
	$item_images .= "</div>";	


	$i++;	


}		

/*
$attr_array = array();
$sql = "SELECT attribute_id, attribute_name
		FROM  attribute
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i = 0;							
while($attr_row = $result->fetch_object()) {	
	$sql = "SELECT opt_id
			FROM  opt
			WHERE attribute_id = '".$attr_row->attribute_id."'";	
	$res = $dbCustom->getResult($db,$sql);
	if($res->num_rows > 0){
		$obj = $res->fetch_object();
		if(in_array($obj->opt_id, $opt_id_array)){
			$attr_array[$i]['attribute_id'] = $attr_row->attribute_id;
			$attr_array[$i]['attribute_name'] = $attr_row->attribute_name;
			$sql = "SELECT opt_id, opt_name
					FROM opt
					WHERE attribute_id = '".$attr_row->attribute_id."'";
			$r = $dbCustom->getResult($db,$sql);
			$tmp_array = array();
			$j = 0;
			while($opt_row = $r->fetch_object()){
				$tmp_array[$j]['opt_id'] = $opt_row->opt_id;
				$tmp_array[$j]['opt_name'] = $opt_row->opt_name;
				$j++;
			}
			$attr_array[$i]['opt_array'] = $tmp_array;
			$i++;
		}
	}
}
$filters_block = '';
foreach($attr_array as $val){

	$filters_block.="<div class='my-custom-select-wrapper'>";
	$filters_block.="<div class='my-custom-select'>";
	$filters_block.="<div class='my-custom-select__trigger'><span>".$val['attribute_name']."</span>";
	$filters_block.="<div class='arrow'></div>";
	$filters_block.="</div>";
	$filters_block.="<div class='my-custom-options'>";
	$filters_block.="<span class='my-custom-option selected' data-value='".$val['attribute_name']."'>".$val['attribute_name']."</span>";
	$filters_block.="<span class='my-custom-option' data-value='All'>All</span>";
	$filters_block.="<span class='my-custom-option' data-value='All'>bbbb</span>";	
	foreach($val['opt_array'] as $v){
		$filters_block.="<span class='my-custom-option' data-value='".$v['opt_id']."'>".$v['opt_name']."</span>";
	}
	$filters_block.="</div>";
	$filters_block.="</div>";
	$filters_block.="</div>";
	
	
}
*/

// ******************** better way filters *********************** 

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
	
	
	$i++;
}


/*
foreach($attr_array as $val){
	
	echo $val['attribute_name'];
	echo "<br />";
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



exit;
*/





?>
