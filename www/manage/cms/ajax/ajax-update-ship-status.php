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

$msg = '';

$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;   
$actual_ship_carrier = (isset($_GET['actual_ship_carrier'])) ? $_GET['actual_ship_carrier'] : 'actual_ship_carrier';
$tracking_num = (isset($_GET['tracking_num'])) ? $_GET['tracking_num'] : 'tracking_num';
$actual_ship_method = (isset($_GET['actual_ship_method'])) ? $_GET['actual_ship_method'] : 'actual_ship_method';
$ship_status = (isset($_GET['ship_status'])) ? $_GET['ship_status'] : 'ship_status';
$actual_ship_cost = (isset($_GET['actual_ship_cost'])) ? $_GET['actual_ship_cost'] : 'actual_ship_cost';
$ship_date = (isset($_GET['ship_date'])) ? $_GET['ship_date'] : 'ship_date';

$db = $dbCustom->getDbConnect(CART_DATABASE);

	$stmt = $db->prepare("UPDATE ctg_order
						SET 
						actual_ship_carrier = ?
						,tracking_num = ?
						,actual_ship_method = ?
						,actual_ship_cost = ?
						WHERE order_id = ?");
						
		//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('sssdi'
						,$actual_ship_carrier
						,$tracking_num
						,$actual_ship_method
						,$actual_ship_cost
						,$order_id)){
			
		echo 'Error-2 '.$db->error;					
	}else{
	
		$stmt->execute();
		$stmt->close();		

		$msg = 'success';
	}

	echo $msg;

?>