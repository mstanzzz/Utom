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

$parent_piece = (isset($_GET['parent_piece'])) ? $_GET['parent_piece'] : 'panel';

$comp_type = (isset($_GET['comp_type'])) ? $_GET['comp_type'] : '';


$ret = 1;

$required_parts_array = array();








 //That leads back to the reason I'm asking:  Under Adjustable Shelf Component, you listed constructed part as "adjustableShelfPanel, 0"


	



if($parent_piece == 'panel'){
	// at least one
	if(count($_SESSION['constructed_part_array']) == 0){
		$ret = 0;
	}
}

if($parent_piece == 'toe_plate'){
	$ret = 1;	
}



if($parent_piece == 'component'){


	//adjustableShelf



}


	$returnData = json_encode(array(
						'eret'=> $ret
						));
	
	
	echo $returnData;
