<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
		FROM features
		WHERE features. features_id = (SELECT MAX( features_id) FROM  features WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$top_1 = $object->top_1;
	$p_1_text = stripslashes($object->p_1_text);
}else{
	$img_id = 0;
	$top_1 = '';
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


$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT *
		FROM svg
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$svg_block = '';
while($row = $result->fetch_object()){
	$svg_block .= "<div class='clo-12 col-lg-2'>";	
	//com/feature-6/300-ipod-iphone.html
	$url_str = SITEROOT."feature-".$row->svg_id."/".$row->name.".html";
	
	$svg_block .= "<a href='".$url_str."' title='' class='specification-link first-el-mobile-top-border'>";
	$svg_block .= "<span class='specification-link__img'>";				
	$svg_block .= $row->svg_code;						
	$svg_block .= "</span>";
	$svg_block .= "<span>".$row->name."</span>";
	$svg_block .= "</a>";
	$svg_block .= "</div>";

}


?>
