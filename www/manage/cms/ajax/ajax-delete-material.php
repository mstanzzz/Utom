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

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$material_id = isset($_GET['material_id'])? $_GET['material_id'] : 0;
	
	$sql =  sprintf("DELETE FROM materials
					WHERE material_id = %u", $material_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE FROM edge_banding_material_assoc
					WHERE material_id = %u", $material_id);
	$result = $dbCustom->getResult($db,$sql);


?>
