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

	$qty_calc_param_id = isset($_GET['qty_calc_param_id'])? $_GET['qty_calc_param_id'] : 0;
	
	$sql =  sprintf("DELETE FROM qty_calc_param
					WHERE qty_calc_param_id = %u", $qty_calc_param_id);
	$result = $dbCustom->getResult($db,$sql);


	
?>
