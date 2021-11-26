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

$toe_plate_id = isset($_GET['toe_plate_id'])? $_GET['toe_plate_id'] : 0;

foreach($_SESSION['toe_plate_array'] as $key => $v){
	if($toe_plate_id == $v['toe_plate_id']){
		unset($_SESSION['toe_plate_array'][$key]);
		$_SESSION['toe_plate_array'] = array_values($_SESSION['toe_plate_array']);	
	}
}


foreach($_SESSION['toe_plate_array'] as $key => $v){

echo "<li>".stripslashes($v['toe_plate_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_toe_plate(".$v['toe_plate_id'].")'>delete</span></li>";

}


?>
