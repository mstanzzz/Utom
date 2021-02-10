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

	$toe_plate_id = isset($_GET['toe_plate_id'])? $_GET['toe_plate_id'] : 0;
	
	$sql =  sprintf("DELETE 
					FROM cabinetry_toe_plates
					WHERE toe_plate_id = %u", $toe_plate_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM default_design_elements
					WHERE design_element_id = %u", $toe_plate_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE 
					FROM cabinetry_toe_plates_to_parts
					WHERE toe_plate_id = %u", $toe_plate_id);
	$result = $dbCustom->getResult($db,$sql);



?>
