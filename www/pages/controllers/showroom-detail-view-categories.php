<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM showroom
		WHERE showroom.showroom_id = (SELECT MAX(showroom_id) FROM showroom WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
}else{
	$img_id = 0;
	$p_1_head = "We manufacture all our closet organizers with top quality materials right here in the USA.";
	$p_1_text = "And we've been doing it for nearly three decades. Learn more about our company below or contact us for more information about placing an order or our custom closet systems.";
}

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$hero_file_name = $object->file_name;
}else{
	$hero_file_name = '';
}	

$cat_block = '';
$top_cat_array = $store_data->getAllCats($dbCustom);

foreach($top_cat_array as $val){
	$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$val['file_name'];
	$nm = stripSlashes($val['name']);
	$name = $str = str_replace(' ', '-', $nm);
	
	//$t = "showroom-product-".$val['cat_id']."/".$name.".html";
	$t = "showroom-".$val['cat_id']."/".$name.".html";
	
	$url_str = $t;
	
$cat_block .= "<div class='col-12 col-lg-6'>";
$cat_block .= "<figure class='showroom-detail-block__wrapper-with-border'>";
$cat_block .= "<figcaption class='showroom-detail-block__images'>";
$cat_block .= "<img stle='width600px;' src='".$img."' alt='' class='img-fluid'>";
$cat_block .= "<div class='showroom-detail-block__images--actions'>";
$cat_block .= "<a href='".$url_str."' title='' class='image-button-open'>";
$cat_block .= "<button class='image-button-share'>";
$cat_block .= "<svg id='share' xmlns='http://www.w3.org/2000/svg' width='42.5' height='42.5' viewBox='0 0 42.5 42.5'>";
$cat_block .= "<path id='Path_226' data-name='Path 226'"; 
$cat_block .= " d='M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z' transform='translate(10 19)' fill='#384765'/>";
$cat_block .= "<path id='Path_225' data-name='Path 225'"; 
$cat_block .= " d='M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z' transform='translate(25 26)' fill='#384765'/>";
$cat_block .= "<path id='Path_224' data-name='Path 224'"; 
$cat_block .= " d='M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z' transform='translate(25 11)' fill='#384765'/>";
$cat_block .= "<path id='Path_209' data-name='Path 209'"; 
$cat_block .= " d='M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z' fill='#384765'/>";
$cat_block .= "</svg>";
$cat_block .= "</button>";
$cat_block .= "</a>";
$cat_block .= "</div>";

$cat_block .= "<div class='mobile-show'>";
$cat_block .= "<a href='showroom-detail-view.html' class='link-button'>";
$cat_block .= "explore now";
$cat_block .= "<svg xmlns='http://www.w3.org/2000/svg' width='20.8' height='14.623' viewBox='0 0 20.8 14.623'>";
$cat_block .= "<path id='left-arrow_3_' data-name='left-arrow(3)'"; 
$cat_block .= " d='M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z' transform='translate(0.001 -4.676)'></path>";
$cat_block .= "</svg>";
$cat_block .= "</a>";
$cat_block .= "</div>";
$cat_block .= "</figcaption>";
$cat_block .= "<a href='showroom-detail-view.html' title='' class='showroom-detail-block__heading'>";
$cat_block .= $name;
$cat_block .= "</a>";
$cat_block .= "</figure>";
$cat_block .= "</div>";

}



