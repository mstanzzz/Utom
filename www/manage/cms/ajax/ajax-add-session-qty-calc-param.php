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
require_once($real_root."/manage/admin-includes/util_functions.php");

	$qty_calc_param_id = isset($_GET['qty_calc_param_id'])? $_GET['qty_calc_param_id'] : 0;
	$sort_order = isset($_GET['sort_order'])? $_GET['sort_order'] : 0;
	$list_number = isset($_GET['list_number'])? $_GET['list_number'] : 0;
	$is_sub = isset($_GET['is_sub'])? $_GET['is_sub'] : 0;
	$qty_calc_param_name = getQtyCalcParamName($qty_calc_param_id);
	if(!isset($_SESSION['qty_calc_params'])){		
		$_SESSION['qty_calc_params'] = array();		
	}
	
	if($qty_calc_param_name != ''){

		$in_arr = 0;	
	
		foreach($_SESSION['qty_calc_params'] as $val){
			if($val['qty_calc_param_id'] == $qty_calc_param_id){
				$in_arr = 1;
			}
		}
	
		if($in_arr == 0){
			$i = count($_SESSION['qty_calc_params']);
			$_SESSION['qty_calc_params'][$i]['qty_calc_param_id'] = $qty_calc_param_id;
			$_SESSION['qty_calc_params'][$i]['qty_calc_param_name'] = $qty_calc_param_name;
			$_SESSION['qty_calc_params'][$i]['sort_order'] = $sort_order;
		}
	
	}


if(count($_SESSION['qty_calc_params']) > 0){
	$block = '';
	$block .= "<table>";
	$block .= "<tr><td width='70%'>Param Name</td><td width:15%;>Sort</td><td width:15%;>Delete</td></tr>";
	foreach($_SESSION['qty_calc_params'] as $v){	
		$block .= "<tr>";
		$block .= "<td>".stripslashes($v['qty_calc_param_name'])."</td>";
		$block .= "<td>".$v['sort_order']."</td>";
		$block .= "<td><span style='cursor:pointer;' onClick='delete_param_from_qty_scema(".$list_number.",".$v['qty_calc_param_id'].")'>delete</span></td>";
		if($is_sub){
			$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_param_from_sub_qty_scema(".$list_number.",".$v['qty_calc_param_id'].")'>delete</span></td>";		
		}else{
			$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_param_from_qty_scema(".$list_number.",".$v['qty_calc_param_id'].")'>delete</span></td>";
		}
		$block .= "</tr>";	
	}
	$block .= "</table>";
	echo $block;
}
