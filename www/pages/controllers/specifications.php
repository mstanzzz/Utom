<?php
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
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

function get_svg_code_ms($svg_id){
	$dbCustom = new DbCustom();
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

$sql = "SELECT *
		FROM spec
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
$i = 0;
while($row = $result->fetch_object()) {	
	$svg_code = get_svg_code_ms($row->spec_id);
	if($svg_code !=""){
		$spec_array[$i]['name'] = $row->name;
		$spec_array[$i]['spec_id'] = $row->spec_id;
		$spec_array[$i]['svg_code'] = get_svg_code_ms($row->svg_id);
		$spec_array[$i]['url'] = "specification-".$row->svg_id."/".$row->name.".html";
		
		$i++;
	}
}
if(!isset($hero_file_name)) $hero_file_name = '';
if($hero_file_name == ''){	
	$hero = '<?php echo SITEROOT; ?>images/organizer-landing-pahe-header.png';	
}else{
	$hero .= SITEROOT."saascustuploads/";
	$hero .= $_SESSION['profile_account_id'];
	$hero .= "/cms/";
	$hero .= $hero_file_name;
}
?>