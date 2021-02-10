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

$backing_id = isset($_GET['backing_id'])? $_GET['backing_id'] : 0;

//echo "backing_id:  ".$backing_id;


foreach($_SESSION['backing_array'] as $key => $v){
	if($backing_id == $v['backing_id']){
		unset($_SESSION['backing_array'][$key]);
		$_SESSION['backing_array'] = array_values($_SESSION['backing_array']);	
	}
}


foreach($_SESSION['backing_array'] as $key => $v){
	echo "<li>".stripslashes($v['backing_name'])."<span style='margin-left:8px;'>Offset:</span>".$v['offset'];
	echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_backing(".$v['backing_id'].")'>delete</span></li>";
}


?>