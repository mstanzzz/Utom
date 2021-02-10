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


	$cleat_id = isset($_GET['cleat_id'])? $_GET['cleat_id'] : 0;
	
	$cleat_name = getCleatName($cleat_id);

	$system_hole = isset($_GET['system_hole'])? addslashes($_GET['system_hole']) : 0;

	if(!is_numeric($system_hole) || $system_hole < 1) $system_hole = 1;

	$in_arr = 0;	

	if(!isset($_SESSION['cleat_array'])){		
		$_SESSION['cleat_array'] = array();		
	}

	foreach($_SESSION['cleat_array'] as $key => $val){
		if($val['cleat_id'] == $cleat_id){
			$in_arr = 1;
			//$_SESSION['cleat_array'][$key]['qty'] += $qty;
		}
	}

	if(!$in_arr){	
	 
		$i = count($_SESSION['cleat_array']);
		$_SESSION['cleat_array'][$i]['cleat_id'] = $cleat_id;
		$_SESSION['cleat_array'][$i]['cleat_name'] = $cleat_name;	
		$_SESSION['cleat_array'][$i]['system_hole'] = $system_hole;
	}
foreach($_SESSION['cleat_array'] as $key => $v){

echo "<li>".stripslashes($v['cleat_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_cleat(".$v['cleat_id'].")'>delete</span></li>";

}
