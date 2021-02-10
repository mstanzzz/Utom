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

	$cleat_id = isset($_GET['cleat_id'])? $_GET['cleat_id'] : 0;
	
	$sql =  sprintf("DELETE 
					FROM cabinetry_cleats
					WHERE cleat_id = %u", $cleat_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM default_design_elements
					WHERE design_element_id = %u", $cleat_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM cabinetry_cleats_to_parts
					WHERE cleat_id = %u", $cleat_id);
	$result = $dbCustom->getResult($db,$sql);



?>
