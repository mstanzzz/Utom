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



$res = (isset($_GET['res'])) ? $_GET['res'] : '';

$res_array = explode('|',$res);

print_r($res_array);

//echo "<br />---------------------------------------------<br />";

$display_order = 0;

foreach($res_array as $k => $v){
	
	$elmt = str_replace ('m' , '' , $v);
	
	$elmt_array = explode('=',$elmt);
	
	echo $elmt_array[0]." --- ".$elmt_array[1];
	
	if(isset($elmt_array[0]) && isset($elmt_array[1])){
	
		$id = (is_numeric($elmt_array[0])) ? $elmt_array[0] : 0;
		
		$parent_id = (is_numeric($elmt_array[1])) ? $elmt_array[1] : 0;

		$sql = "UPDATE design_folders
			SET parent_id = '".$parent_id."', display_order = '".$display_order."'
			WHERE level_id = '".$id."'";
			
		$result = $dbCustom->getResult($db,$sql);
		
		$display_order++;
		
	}
	
}



?>

