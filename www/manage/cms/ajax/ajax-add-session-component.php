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

	$sub_name  = isset($_GET['sub_name'])? $_GET['sub_name'] : '';
	
	$list_number = isset($_GET['list_number'])? $_GET['list_number'] : 0;

	$component_id = isset($_GET['component_id'])? $_GET['component_id'] : 0;
	
	$qty = isset($_GET['qty'])? $_GET['qty'] : 1;
	
	if(!is_numeric($qty)) $qty = 1;
	
	$component_name = getComponentName($component_id);

	if(!isset($_SESSION['component_array'])){		
		$_SESSION['component_array'] = array();		
	}
	
	if($component_name != ''){

		$in_arr = 0;	
	
		foreach($_SESSION['component_array'] as $val){
			if($val['component_id'] == $component_id){
				$in_arr = 1;
			}
		}
	
		if($in_arr == 0){
			$i = count($_SESSION['component_array']);
			$_SESSION['component_array'][$i]['component_id'] = $component_id;
			$_SESSION['component_array'][$i]['component_name'] = $component_name;
			$_SESSION['component_array'][$i]['qty'] = $qty;
		}	
	}


	
	$block = '';
	$block .= "<table>";
	$block .= "<tr><td width='80%'>Component Name</td><td>QTY</td><td></td></tr>";
	foreach($_SESSION['component_array'] as $v){	
		$block .= "<tr>";
		$block .= "<td>".stripslashes($v['component_name'])."</td>";
		$block .= "<td>".$v['qty']."</td>";		
		if($sub_name == 'unit'){
			$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_component_from_sub_unit(".$list_number.",".$v['component_id'].");'>delete</span></td>";		
		}else{
			$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_component_from_unit(".$list_number.",".$v['component_id'].");'>delete</span></td>";
		}
		$block .= "</tr>";	
	}
	$block .= "</table>";
	echo $block;

