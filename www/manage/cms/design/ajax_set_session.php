<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

	if(isset($_GET['material_id'])) $_SESSION["temp_fields"]['material_id'] = $_GET['material_id'];
	if(isset($_GET['material_name'])) $_SESSION["temp_fields"]['material_name'] = $_GET['material_name'];
	if(isset($_GET['tier_id'])) $_SESSION["temp_fields"]['tier_id'] = $_GET['tier_id'];
	if(isset($_GET['material_type_id'])) $_SESSION["temp_fields"]['material_type_id'] = $_GET['material_type_id'];
	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_color'] = $_GET['mat_color'];

	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_alpha'] = $_GET['mat_alpha'];
	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_image'] = $_GET['mat_image'];
	if(isset($_GET['saas_id'])) $_SESSION["temp_fields"]['saas_id'] = $_GET['saas_id'];



?>

