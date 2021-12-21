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

require_once($real_root."/includes/config.php");

$backing_id = isset($_GET['backing_id'])? $_GET['backing_id'] : 0;


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql =  sprintf("DELETE FROM cabinetry_backing
				WHERE backing_id = %u", $backing_id);
$result = $dbCustom->getResult($db,$sql);


$sql =  sprintf("DELETE FROM cabinetry_backing_to_parts
				WHERE backing_id = %u", $backing_id);
$result = $dbCustom->getResult($db,$sql);


$sql =  sprintf("DELETE FROM default_design_elements
				WHERE design_element_id = %u", $backing_id);
$result = $dbCustom->getResult($db,$sql);








?>