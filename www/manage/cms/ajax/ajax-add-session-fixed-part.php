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

	$sub_name = isset($_GET['sub_name'])? trim($_GET['sub_name']) : 'cleat';
	$list_number = isset($_GET['list_number'])? trim($_GET['list_number']) : 0;	

	$part_id = isset($_GET['part_id'])? $_GET['part_id'] : 0;
	$part_name = getConstructedPartName($part_id);
	
	$qty = trim($_GET['qty']);
	if(!is_numeric($qty) || $qty < 1) $qty = 1;

	$in_arr = 0;	

	if(!isset($_SESSION['fixed_part_array'])){		
		$_SESSION['fixed_part_array'] = array();		
	}

	foreach($_SESSION['fixed_part_array'] as $key => $val){
		if($val['part_id'] == $part_id){
			$in_arr = 1;
			$_SESSION['fixed_part_array'][$key]['qty'] += $qty;
		}
	}

	if(!$in_arr){	
	 
		$i = count($_SESSION['fixed_part_array']);
		$_SESSION['fixed_part_array'][$i]['part_id'] = $part_id;
		$_SESSION['fixed_part_array'][$i]['part_name'] = $part_name;	
		$_SESSION['fixed_part_array'][$i]['qty'] = $qty;
	}
foreach($_SESSION['fixed_part_array'] as $key => $v){
	echo "<li>".stripslashes($v['part_name'])."<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
	if(strpos($sub_name, 'cleat') !== false){		
		echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='delete_fixed_part_from_sub_cleat(".$v['part_id'].",".$list_number.")'>delete</span></li>";	
	}elseif(strpos($sub_name, 'toe_plate') !== false){  
		echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='delete_fixed_part_from_sub_toe_plate(".$v['part_id'].",".$list_number.")'>delete</span></li>";
	}elseif(strpos($sub_name, 'backing') !== false){  
		echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='delete_fixed_part_from_sub_backing(".$v['part_id'].",".$list_number.")'>delete</span></li>";
	}else{
		echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_fixed_part(".$v['part_id'].")'>delete</span></li>";
	}
}
