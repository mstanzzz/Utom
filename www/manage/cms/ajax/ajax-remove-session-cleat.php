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

$cleat_id = isset($_GET['cleat_id'])? $_GET['cleat_id'] : 0;

foreach($_SESSION['cleat_array'] as $key => $v){
	if($cleat_id == $v['cleat_id']){
		unset($_SESSION['cleat_array'][$key]);
		$_SESSION['cleat_array'] = array_values($_SESSION['unit_array']);	
	}
}


foreach($_SESSION['cleat_array'] as $key => $v){
	echo "<li>".stripslashes($v['cleat_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
	echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_cleat(".$v['cleat_id'].")'>delete</span></li>";
}

?>


