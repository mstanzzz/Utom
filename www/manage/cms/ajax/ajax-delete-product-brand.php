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

	$panel_brand_id = isset($_GET['panel_brand_id'])? $_GET['panel_brand_id'] : 0;
	
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE FROM panel_brands
					WHERE panel_brand_id = %u", $panel_brand_id);
	$result = $dbCustom->getResult($db,$sql);
	
	
	echo $panel_brand_id;
	




?>
