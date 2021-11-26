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

$finish_id = isset($_GET['finish_id'])? $_GET['finish_id'] : 0;

if(is_numeric($finish_id)){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE 
					FROM finishes
					WHERE finish_id = '%u'", $finish_id);
	$result = $dbCustom->getResult($db,$sql);

}





?>