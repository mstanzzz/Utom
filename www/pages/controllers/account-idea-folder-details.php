<?php
$idea_folder_id = (isset($_POST['idea_folder_id'])) ? $_POST['idea_folder_id'] : 0;
if(!is_numeric($idea_folder_id)) $idea_folder_id=0;

//print_r($_SERVER);
//echo $idea_folder_id;
//exit;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT idea_folder.name
		,blob_image.blob_image
		FROM idea_folder, blob_image 
		WHERE idea_folder.blob_image_id = blob_image.blob_image_id
		AND idea_folder.idea_folder_id = '".$idea_folder_id."'";
	// AND idea_folder.user_id = '".$cust_id."'
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object(); 
	$main_idea_folder_name = $object->name;
	$main_idea_folder_blob_image = $object->blob_image; 	
	
}else{
	$main_idea_folder_name = "none";
	$main_idea_folder_blob_image = ""; 	
}

$sql = "SELECT idea_folder_to_room_id
		FROM idea_folder_to_room 
		WHERE idea_folder_id = '".$idea_folder_id."'";
$result = $dbCustom->getResult($db,$sql);

$created_rooms = $result->num_rows;

$saved_items = 33;






?>