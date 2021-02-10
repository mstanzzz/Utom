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
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/util_functions.php");


	$unit_id = isset($_GET['unit_id'])? $_GET['unit_id'] : 0;
	
	$unit_name = getUnitName($unit_id);

	$system_hole = isset($_GET['system_hole'])? $_GET['system_hole'] : 0;

	if(!is_numeric($system_hole) || $system_hole < 1) $system_hole = 1;

	$in_arr = 0;	

	if(!isset($_SESSION['unit_array'])){		
		$_SESSION['unit_array'] = array();		
	}

	foreach($_SESSION['unit_array'] as $key => $val){
		if($val['unit_id'] == $unit_id){
			$in_arr = 1;
			//$_SESSION['unit_array'][$key]['qty'] += $qty;
		}
	}

	if(!$in_arr){	
	 
		$i = count($_SESSION['unit_array']);
		$_SESSION['unit_array'][$i]['unit_id'] = $unit_id;
		$_SESSION['unit_array'][$i]['unit_name'] = $unit_name;	
		$_SESSION['unit_array'][$i]['system_hole'] = $system_hole;
	}
foreach($_SESSION['unit_array'] as $key => $v){

echo "<li>".stripslashes($v['unit_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_unit(".$v['unit_id'].")'>delete</span></li>";

}


?>
