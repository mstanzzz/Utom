<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 	
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	



$res = (isset($_GET['res'])) ? $_GET['res'] : '';


$res_array = explode('|',$res);

//print_r($res_array);

//echo "<br />---------------------------------------------<br />";

//$prep_array = array();

//$i = 0;

foreach($res_array as $k => $v){
	
	$elmt = str_replace ('m' , '' , $v);
	
	$elmt_array = explode('=',$elmt);
	
	//echo $elmt_array[0]." --- ".$elmt_array[1];
	
	if(isset($elmt_array[0]) && isset($elmt_array[1])){
		
		//$prep_array[$i]['name'] = get_folder_name($elmt_array[0]);		
		
		$id = (is_numeric($elmt_array[0])) ? $elmt_array[0] : 0;
		
		//$prep_array[$i]['id'] = $id;
		
		$parent_id = (is_numeric($elmt_array[1])) ? $elmt_array[1] : 0;
		
		//$prep_array[$i]['parent_id'] = $parent_id;
		
		//$i++;

		$sql = "UPDATE design_folders
			SET parent_id = '".$parent_id."'
			WHERE level_id = '".$id."'";
			
		$result = $dbCustom->getResult($db,$sql);

		
	}
	
}

//print_r($prep_array);

//$user_id = 99999;

//$sql = "DELETE FROM design_folders";		
//$sql .= " WHERE user_id = '".$user_id."'";
//$result = $dbCustom->getResult($db,$sql);

//foreach($prep_array as $v){
	
	
	//echo "  user: ".$user_id."  parent: ".$v['parent_id']."   name: ".$v['name'];
	//echo "\nl";
	
	/*
	$sql = "INSERT INTO design_folders
			(user_id
			,parent_id
			,level_name)
			VALUES
			('".$user_id."', '".$v['parent_id']."', '".$v['name']."')";
	$result = $dbCustom->getResult($db,$sql);
	*/
	
//}

/*
function get_folder_name($level_id){
	
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	
	
	$ret = '';
	
	$sql = "SELECT level_name
			FROM design_folders
			WHERE level_id = '".$level_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret = $object->level_name; 	
	}
	
	$ret = stripslashes($ret);
	
	return $ret;		
			
	
	
}
*/

//echo $res; 


?>

