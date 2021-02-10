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

	$panel_id = isset($_GET['panel_id'])? $_GET['panel_id'] : 0;
	
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE FROM cabinetry_panels
					WHERE panel_id = %u", $panel_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql =  sprintf("DELETE FROM collection_panel_assoc
					WHERE panel_id = %u", $panel_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql =  sprintf("DELETE FROM default_design_elements
					WHERE panel_id = %u", $panel_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql =  sprintf("DELETE FROM cabinetry_panels_to_parts
					WHERE panel_id = %u", $panel_id);
	$result = $dbCustom->getResult($db,$sql);
	
	




?>
