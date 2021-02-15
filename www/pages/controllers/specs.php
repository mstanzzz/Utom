<?php 

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM specs_content
		WHERE specs_content_id = (SELECT MAX(specs_content_id) FROM specs_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";		
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
	$sidebar_heading = $object->sidebar_heading;
	$sidebar_content = $object->sidebar_content;
	$img_id = $object->img_id;
	$img_alt_text = $object->img_alt_text;
}else{
	$content = '';
	$sidebar_heading = '';
	$sidebar_content = '';
	$img_id = 0;
	$img_alt_text = '';
}

$block = '';
			
$sql = "SELECT category_name, spec_cat_id 
		FROM spec_category 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
while($cat_row = $result->fetch_object()){
	$block .= stripslashes($cat_row->category_name);	
	$sql = "SELECT name, description, img_id, img_alt_text 
			FROM spec 
			WHERE spec_cat_id = '".$cat_row->spec_cat_id."'";
	$res = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($spec_row = $res->fetch_object()){
						
		$sql = "SELECT file_name 
				FROM image 
				WHERE img_id = '".$spec_row->img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$block .= "<img src='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."' alt='".$spec_row->img_alt_text."'>";
		}
		$block .= '<h5>'.stripslashes($spec_row->name).'</h5>';
		$block .= stripslashes($spec_row->description);
		$i++;
	}
}


?>
