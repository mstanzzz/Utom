<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$material_type_id = isset($_GET['material_type_id'])? $_GET['material_type_id'] : 0;
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE FROM material_types
					WHERE material_type_id = %u", $material_type_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql =  sprintf("DELETE FROM collection_mat_type_assoc
					WHERE mat_type_id = %u", $material_type_id);
	$result = $dbCustom->getResult($db,$sql);

?>
