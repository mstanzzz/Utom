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


$required = array();


$required["MountingBracketCover"] = 0;
$required["MountingBracket"] = 0;
$required["MountingRailCover"] = 0;
$required["MountingRail"] = 0;

$required["ToePlateScrew"] = 0;

$required["AdjustableShelf"] = 0;


if($parent_piece == 'panel'){
	
	foreach($_SESSION['fixed_part_array'] as $key => $v){
		$tmp_name = stripslashes($v['part_name']);
		if(strpos($tmp_name, 'Mounting Bracket Cover') !== false){
			$required["MountingBracketCover"] = 1;		
		}
		if(strpos($tmp_name, 'Mounting Bracket,') !== false){
			$required["MountingBracket"] = 1;
		}
		if(strpos($tmp_name, 'Mounting Rail Cover') !== false){
			$required["MountingRailCover"] = 1;
		}
		if(strpos($tmp_name, 'Mounting Rail') !== false && strpos($tmp_name, 'Cover') == false){
			$required["MountingRail"] = 1;
		}
	}
	
	$returnData = json_encode(array(
						'MountingBracketCover'=> $required["MountingBracketCover"],
						'MountingBracket'=> $required["MountingBracket"],
						'MountingRailCover'=> $required["MountingRailCover"],
						'MountingRail'=> $required["MountingRail"]
						));

	
}

if($parent_piece == 'toe_plate'){
	//Toe Plate Screw
	foreach($_SESSION['fixed_part_array'] as $key => $v){
		$tmp_name = stripslashes($v['part_name']);
		if(strpos($tmp_name, 'Toe Plate Screw') !== false){
			$required["ToePlateScrew"] = 1;		
		}
	}

	$returnData = json_encode(array('ToePlateScrew'=> $required["ToePlateScrew"]));
}


if($parent_piece == 'component'){

	foreach($_SESSION['fixed_part_array'] as $key => $v){
		$tmp_name = stripslashes($v['part_name']);
		if(strpos($tmp_name, 'Adjustable Shelf') !== false){
			$required["AdjustableShelf"] = 1;		
		}
	}

	$returnData = json_encode(array('AdjustableShelf'=> $required["AdjustableShelf"]));

}

	
echo $returnData;







/*
1 Mounting Bracket Cover part type (Catalog Part)
1 Mounting Bracket part type (Catalog Part)
1 Mounting Rail part type (Catalog Part)
1 Mounting Rail Cover part type (Catalog Part)





	"Mounting Bracket Cover"

	"Mounting Bracket,"
	
	"Mounting Rail Cover"	
	
	"Mounting Rail"



Adjustable Shelf Support, Transparent
Mounting Bracket Cover, Left, White
Mounting Bracket Cover, Right, White
Mounting Bracket, Left
Mounting Bracket, Right
Mounting Rail
Mounting Rail Cover, White
Rafix Connector, Beige
Toe Plate Screw
Toe Plate Vent





Adjustable Shelf Component

 - Constructed Parts

 ---- adjustableShelfPanel, 0

 - Catalog Parts

 ---- adjustableShelfSupports, 1

 - Part Type

 ---- adjustableShelf


*/


?>




