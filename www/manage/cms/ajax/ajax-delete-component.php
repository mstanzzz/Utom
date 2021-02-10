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

	$component_id = isset($_GET['component_id'])? $_GET['component_id'] : 0;
	
	$sql =  sprintf("DELETE 
					FROM cabinetry_components
					WHERE component_id = %u", $component_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM collection_components_assoc
					WHERE component_id = %u", $component_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM cabinetry_components_to_parts
					WHERE component_id = %u", $component_id);
	$result = $dbCustom->getResult($db,$sql);



?>
