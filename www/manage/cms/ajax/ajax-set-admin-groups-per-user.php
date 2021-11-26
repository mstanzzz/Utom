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

if(!is_numeric($user_id)){
	exit;	
}

$group_ids = (isset($_GET['group_ids'])) ? $_GET['group_ids'] : '';

$group_id_array = explode(',',$group_ids);

$db = $dbCustom->getDbConnect(USER_DATABASE);

$sql =  sprintf("DELETE FROM admin_user_to_admin_group		
				WHERE user_id = %u", $user_id);
$result = $dbCustom->getResult($db,$sql);

foreach($group_id_array as $val){
	
	if(is_numeric($val)){		
		$sql =  sprintf("INSERT INTO admin_user_to_admin_group
						(user_id, admin_group_id)
						VALUES
						(%u,%u)",$user_id, $val);						
		$res = $dbCustom->getResult($db,$sql);
	}
	
}








?>