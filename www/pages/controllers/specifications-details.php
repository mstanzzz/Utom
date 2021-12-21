<?php	

if(!isset($id)){ 
	$id = 777;
}

function get_img_fn_ms($dbCustom,$img_id){	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT file_name 
			FROM images
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->file_name;		
	}
	return '';
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT 
			name
			,description
			,svg_id	
			,img_id	
			,img_alt_text
			,spec_cat_id
			,spec_details
		FROM spec
		WHERE spec_id = '".$id."'";
$result = $dbCustom->getResult($db,$sql);	

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = stripslashes($object->name);
	$description = $object->description;
	$svg_id = $object->svg_id;
	$img_id = $object->img_id;
	$img_alt_text = $object->img_alt_text;
	$spec_cat_id = $object->spec_cat_id;
	$spec_details = $object->spec_details;
}else{
	$name = "No Name";
	$description = "No description";
	$svg_id = 0;
	$img_id = 0;
	$img_alt_text = '';
	$spec_cat_id = 0;
	$spec_details = '';
}


$sql = "SELECT * 
		FROM specs_content";
$result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = stripslashes($object->content);
}else{
	$content = "No Content Found";
}

$sql = "SELECT spec_to_img_id, img_id 
		FROM spec_to_img
		WHERE spec_id = '".$id."'";
$result = $dbCustom->getResult($db,$sql);	
$i=0;
$spec_to_img = array();
while($row = $result->fetch_object()){
	$spec_to_img[$i]['img_id'] = $row->img_id;
	$spec_to_img[$i]['file_name'] = get_img_fn_ms($dbCustom,$row->img_id);	
	$i++;
}


?>	


