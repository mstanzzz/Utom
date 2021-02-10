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

$price_calc_param_id = isset($_GET['price_calc_param_id'])? $_GET['price_calc_param_id'] : 0;

if(is_numeric($price_calc_param_id)){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE FROM price_calc_params
					WHERE price_calc_param_id = '%u'", $price_calc_param_id);
	$result = $dbCustom->getResult($db,$sql);

}





?>