<?php 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
		FROM  features
		WHERE  features. features_id = (SELECT MAX( features_id) FROM  features WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
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

//echo $img_id;
//echo "<br />";
					
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

?>