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

$part_id = isset($_GET['part_id'])? $_GET['part_id'] : 0;


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql =  sprintf("DELETE 
				FROM parts
				WHERE part_id = %u", $part_id);
$result = $dbCustom->getResult($db,$sql);


//echo $part_id;




?>