<?php
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT *
		FROM specs_content
		WHERE specs_content.specs_content_id = (SELECT MAX(specs_content_id) 
				FROM specs_content 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$p_1_text = stripslashes($object->heading);
	$p_2_text = stripslashes($object->content);
}else{
	$img_id = 0;
	$p_1_text = "";
	$p_2_text = "";
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

$spec_array = array();

function get_svg_code_ms($dbCustom,$svg_id){
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT svg_code 
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return trim($object->svg_code);		
	}
	return '';
}

function get_svg_from_cat_ms($dbCustom, $spec_cat_id){

	$ret =0;	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT svg_id
			FROM spec_category
			WHERE spec_cat_id = '".$spec_cat_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows>0){
		$obj = 	$re->fetch_object();
		$ret = $obj->svg_id;	
	}

	return $ret;
}


$svg_id = 999;

$sql = "SELECT spec_cat_id, name, spec_id
		FROM spec
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
$i = 0;
while($row = $result->fetch_object()) {	
	$spec_array[$i]['name'] = $row->name;				
	$svg_id	= get_svg_from_cat_ms($dbCustom, $row->spec_cat_id);
	$svg_code = get_svg_code_ms($dbCustom,$svg_id);
	$spec_array[$i]['svg_code'] = $svg_code;
	$spec_array[$i]['url'] = "specification-".$svg_id."/".$row->name.".html";
	$i++;
}


if(!isset($hero_file_name)) $hero_file_name = '';
if($hero_file_name == ''){	
	$hero = SITEROOT.'images/organizer-landing-pahe-header.png';	
}else{
	$hero .= SITEROOT."saascustuploads/";
	$hero .= $_SESSION['profile_account_id'];
	$hero .= "/cms/";
	$hero .= $hero_file_name;
}


//echo ">>>> in specifications";
//exit;

?>