


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


	$backing_id = isset($_GET['backing_id'])? $_GET['backing_id'] : 0;
	
	$offset = isset($_GET['offset'])? $_GET['offset'] : 0;

	if(!is_numeric($offset)) $offset = 1;

	$backing_name = getBackingName($backing_id);

	$in_arr = 0;	

	if(!isset($_SESSION['backing_array'])){		
		$_SESSION['backing_array'] = array();		
	}

	foreach($_SESSION['backing_array'] as $key => $val){
		if($val['backing_id'] == $backing_id){
			$in_arr = 1;
			//$_SESSION['backing_array'][$key]['qty'] += $qty;
		}
	}

	if(!$in_arr){	
	 
		$i = count($_SESSION['backing_array']);
		$_SESSION['backing_array'][$i]['backing_id'] = $backing_id;
		$_SESSION['backing_array'][$i]['backing_name'] = $backing_name;	
		$_SESSION['backing_array'][$i]['offset'] = $offset;
	}
	
foreach($_SESSION['backing_array'] as $key => $v){

echo "<li>".stripslashes($v['backing_name'])."<span style='margin-left:8px;'>Offset:</span>".$v['offset'];
echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_backing(".$v['backing_id'].")'>delete</span></li>";

}

?>



    
    
    
    

