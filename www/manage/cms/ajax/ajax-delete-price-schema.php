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

	$price_schema_id = isset($_GET['price_schema_id'])? $_GET['price_schema_id'] : 0;
	
	$sql =  sprintf("DELETE FROM price_schema
					WHERE price_schema_id = %u", $price_schema_id);
	$result = $dbCustom->getResult($db,$sql);



?>
