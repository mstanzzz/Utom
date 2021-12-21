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

$unit_id = isset($_GET['unit_id'])? $_GET['unit_id'] : 0;

foreach($_SESSION['unit_array'] as $key => $v){
	if($unit_id == $v['unit_id']){
		unset($_SESSION['unit_array'][$key]);
		$_SESSION['unit_array'] = array_values($_SESSION['unit_array']);	
	}
}


foreach($_SESSION['unit_array'] as $key => $v){
	echo "<li>".stripslashes($v['unit_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
	echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_unit(".$v['unit_id'].")'>delete</span></li>";
}


?>