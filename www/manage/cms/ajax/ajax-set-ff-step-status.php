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
require_once($real_root."/manage/admin-includes/class.order_fulfillment.php");

$ff = new OrderFulfillment;

$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;   
$status = (isset($_GET['status'])) ? $_GET['status'] : 0;   
$step_id = (isset($_GET['step_id'])) ? $_GET['step_id'] : 0;   

$test = 0;

if($status == 1){

	$ff->clearStepStatus($order_id, $step_id);
	
	$ff->setStepStart($order_id, $step_id);

$test = 1;

}

if($status == 2){

	$ff->parkStepCheck($order_id, $step_id);

$test = 2;	

}
if($status == 3){

	$ff->completeStep($order_id, $step_id);

	$test = 3;

}


echo $test;


?>