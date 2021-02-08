<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 	
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	



$id = (isset($_GET['id'])) ? $_GET['id'] : '';



//echo $id;

// delete folder and it's children


$sql = "SELECT level_id
		FROM design_folders
		WHERE parent_id = '".$id ."'";
		
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()){
	
	$sql = "DELETE FROM design_folders
			WHERE level_id = '".$row->level_id."'";	
	$res = $dbCustom->getResult($db,$sql);		

}

$sql = "DELETE FROM design_folders
			WHERE level_id = '".$id."'";	
		
$result = $dbCustom->getResult($db,$sql);





?>