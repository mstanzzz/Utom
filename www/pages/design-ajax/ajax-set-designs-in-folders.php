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


$res_array = array();
$elmt_array = array();
$d_array = array();

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	

$df_str = (isset($_GET['df_str'])) ? $_GET['df_str'] : '';

$res_array = explode('|',$df_str);

print_r($res_array);

echo "<br />---------------------------------------------<br />";


foreach($res_array as $k => $v){
	
	$elmt_array = explode('=',$v);
   
   if(isset($elmt_array[0]) && isset($elmt_array[1])){
   
      echo $elmt_array[0]."    ";
      
      $d_array = explode('-', $elmt_array[1]);
      
      foreach($d_array as $d_v){
   
         if(is_numeric($d_v)){
 
            $sql = "UPDATE designs
                  SET folder_id = '".$elmt_array[0]."'
                  WHERE file_id = '".$d_v."'";       
            $result = $dbCustom->getResult($db,$sql);  
         
         } 
      
      }
   
   }
   
	
}



?>

