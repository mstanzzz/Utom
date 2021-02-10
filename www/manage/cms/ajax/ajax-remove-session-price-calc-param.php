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
$list_number = isset($_GET['list_number'])? $_GET['list_number'] : 0;
$is_sub = isset($_GET['is_sub'])? $_GET['is_sub'] : 0;

foreach($_SESSION['price_calc_params'] as $key => $v){
	if($price_calc_param_id == $v['price_calc_param_id']){
		unset($_SESSION['price_calc_params'][$key]);
		$_SESSION['price_calc_params'] = array_values($_SESSION['price_calc_params']);	
	}
}


$block = '';
$block .= "<table>";
$block .= "<tr><td width='70%'>Param Name</td><td width:15%;>Sort</td><td width:15%;>Delete</td></tr>";
foreach($_SESSION['price_calc_params'] as $v){	
	$block .= "<tr>";
	$block .= "<td>".stripslashes($v['price_calc_param_name'])."</td>";
	$block .= "<td>".$v['sort_order']."</td>";	
	if($is_sub){
		$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_param_from_sub_price_scema(".$list_number.",".$v['price_calc_param_id'].")'>delete</span></td>";		
	}else{
		$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_param_from_price_scema(".$list_number.",".$v['price_calc_param_id'].")'>delete</span></td>";
	}
	$block .= "</tr>";	
}
$block .= "</table>";
echo $block;

?>