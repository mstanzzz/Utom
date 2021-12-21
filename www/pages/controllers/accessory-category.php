<?php

$icons_array = array();;

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT * 
FROM svg
WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i = 0;
while($row = $result->fetch_object()) {
	$icons_array[$i]['svg_id'] = $row->svg_id;
	$icons_array[$i]['name'] = $row->name;
	$icons_array[$i]['svg_code'] = $row->svg_code;
	$i++;
}

$icons_block = '';
foreach($icons_array as $key=>$icon){

	$url_str = '';
	$url_str .= "accessory-products-".$icon['svg_id']."/".$icon['name'].".html";
	$icons_block .= "<div class='clo-12 col-lg-2'>";
	if($key == 0){	
		$icons_block .= "<a href='".$url_str."' title='' class='specification-link first-el-mobile-top-border'>";
	}else{
		$icons_block .= "<a href='".$url_str."' title='' class='specification-link'>";		
	}
	$icons_block .= "<span class='specification-link__img'>";	
	$icons_block .= $icon['svg_code'];		
	$icons_block .= "</span>";	
	$icons_block .= "<span>".$icon['name']."</span>";
	$icons_block .= "</a>";
	$icons_block .= "</div>";
}


?>