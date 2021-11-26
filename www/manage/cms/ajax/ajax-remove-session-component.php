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

$component_id = isset($_GET['component_id'])? $_GET['component_id'] : 0;
$list_number = isset($_GET['list_number'])? $_GET['list_number'] : 0;
$sub_name = isset($_GET['sub_name'])? $_GET['sub_name'] : 0;

foreach($_SESSION['component_array'] as $key => $v){
	if($component_id == $v['component_id']){
		unset($_SESSION['component_array'][$key]);
		$_SESSION['component_array'] = array_values($_SESSION['component_array']);	
	}
}

if(count($_SESSION['component_array']) > 0){
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
}

?>