<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'aws/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/aws';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 

	if(isset($_GET['material_id'])) $_SESSION["temp_fields"]['material_id'] = $_GET['material_id'];
	if(isset($_GET['material_name'])) $_SESSION["temp_fields"]['material_name'] = $_GET['material_name'];
	if(isset($_GET['tier_id'])) $_SESSION["temp_fields"]['tier_id'] = $_GET['tier_id'];
	if(isset($_GET['material_type_id'])) $_SESSION["temp_fields"]['material_type_id'] = $_GET['material_type_id'];
	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_color'] = $_GET['mat_color'];

	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_alpha'] = $_GET['mat_alpha'];
	if(isset($_GET['mat_color'])) $_SESSION["temp_fields"]['mat_image'] = $_GET['mat_image'];
	if(isset($_GET['saas_id'])) $_SESSION["temp_fields"]['saas_id'] = $_GET['saas_id'];



?>

