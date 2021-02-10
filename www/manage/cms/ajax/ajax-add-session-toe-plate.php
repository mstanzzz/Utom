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


	$toe_plate_id = isset($_GET['toe_plate_id'])? $_GET['toe_plate_id'] : 0;
	
	$toe_plate_name = getToePlateName($toe_plate_id);

	$system_hole = isset($_GET['system_hole'])? addslashes($_GET['system_hole']) : 0;

	if(!is_numeric($system_hole) || $system_hole < 1) $system_hole = 1;

	$in_arr = 0;	

	if(!isset($_SESSION['toe_plate_array'])){		
		$_SESSION['toe_plate_array'] = array();		
	}

	foreach($_SESSION['toe_plate_array'] as $key => $val){
		if($val['toe_plate_id'] == $toe_plate_id){
			$in_arr = 1;
			//$_SESSION['toe_plate_array'][$key]['qty'] += $qty;
		}
	}

	if(!$in_arr){	
	 
		$i = count($_SESSION['toe_plate_array']);
		$_SESSION['toe_plate_array'][$i]['toe_plate_id'] = $toe_plate_id;
		$_SESSION['toe_plate_array'][$i]['toe_plate_name'] = $toe_plate_name;	
		$_SESSION['toe_plate_array'][$i]['system_hole'] = $system_hole;
	}
foreach($_SESSION['toe_plate_array'] as $key => $v){

echo "<li>".stripslashes($v['toe_plate_name'])."<span style='margin-left:8px;'>Offset:</span>".$v['system_hole'];
echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_toe_plate(".$v['toe_plate_id'].")'>delete</span></li>";

}
