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

	$unit_id = isset($_GET['unit_id'])? $_GET['unit_id'] : 0;
	
	
	$sql =  sprintf("DELETE FROM cabinetry_units
					WHERE unit_id = %u", $unit_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql =  sprintf("DELETE FROM collection_units_assoc
					WHERE unit_id = %u", $unit_id);
	$result = $dbCustom->getResult($db,$sql);


	$sql =  sprintf("DELETE FROM cabinetry_units_to_cabinetry_components
					WHERE unit_id = %u", $unit_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql = "SELECT table_name_id 
			FROM table_names
			WHERE table_name = 'cabinetry_units'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();  	

		$sql = "DELETE FROM default_design_elements
				WHERE table_name_id = '".$object->table_name_id."'
				AND design_element_id = '".$unit_id."'
				AND saas_id = '".$_SESSION['profile_account_id']."'";
		$res = $dbCustom->getResult($db,$sql);		 
	}




?>

