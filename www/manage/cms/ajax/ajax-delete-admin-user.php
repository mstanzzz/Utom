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

$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : 0;   

$db = $dbCustom->getDbConnect(USER_DATABASE);

$sql =  sprintf("DELETE FROM user
		WHERE id = %u", $user_id);
$result = $dbCustom->getResult($db,$sql);

$sql =  sprintf("DELETE FROM customer_data
		WHERE user_id = %u", $user_id);
$result = $dbCustom->getResult($db,$sql);


$sql =  sprintf("DELETE FROM admin_user_to_admin_group
		WHERE user_id = %u", $user_id);
$result = $dbCustom->getResult($db,$sql);


$sql =  sprintf("DELETE FROM user_admin_access_index
		WHERE user_id = %u", $user_id);
$result = $dbCustom->getResult($db,$sql);


/* ?????
user_design_index

user_group_index

user_group_index

user_to_tool_designer
*/


echo $user_id;

?>