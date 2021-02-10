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


// tables not used

// nothing about collections or design types in comps or the tool admin on storittek

//cabinetry_sections_to_design_element_collections

//cabinetry_sections_to_design_types 


require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

$section_id = isset($_GET['section_id'])? $_GET['section_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "DELETE FROM cabinetry_sections
			WHERE section_id = '".$section_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	
		

	$sql = "DELETE FROM cabinetry_sections_to_cabinetry_panels
			WHERE section_id = '".$section_id."'";	
	$result = $dbCustom->getResult($db,$sql);		
		
	$sql = "DELETE FROM cabinetry_sections_to_cabinetry_units
			WHERE section_id= '".$section_id."'";	
	$result = $dbCustom->getResult($db,$sql);		
	
	$sql = "DELETE FROM cabinetry_sections_to_cabinetry_cleats
			WHERE section_id = '".$section_id."'";	
	$result = $dbCustom->getResult($db,$sql);		
	
	$sql = "DELETE FROM cabinetry_sections_to_cabinetry_toe_plates
			WHERE section_id = '".$section_id."'";	
	$result = $dbCustom->getResult($db,$sql);		

	$sql = "DELETE FROM cabinetry_sections_to_cabinetry_backing
			WHERE section_id = '".$section_id."'";	
	$result = $dbCustom->getResult($db,$sql);		


	$sql = "SELECT table_name_id 
			FROM table_names
			WHERE table_name = 'cabinetry_sections'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 

		$sql = "DELETE FROM default_design_elements
				WHERE table_name_id = '".$object->table_name_id."'
				AND design_element_id = '".$section_id."'
				AND saas_id = '".$_SESSION['profile_account_id']."'";
		$res = $dbCustom->getResult($db,$sql);		 

	}

?>