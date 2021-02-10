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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.admin_login.php");

$aLgn = new AdminLogin();

$user_id = $aLgn->getUserId();

$user_division = (isset($_GET['user_division'])) ? $_GET['user_division'] : '';   
$user_position = (isset($_GET['user_position'])) ? $_GET['user_position'] : '';
$email = (isset($_GET['email'])) ? $_GET['email'] : '';
$name = (isset($_GET['name'])) ? $_GET['name'] : '';

$name_array = explode(' ',$name);
$name_first = (isset($name_array[0]))? $name_array[0] : ''; 
$last = count($name_array) - 1;
$name_last = (isset($name_array[$last]))? $name_array[$last] : ''; 

$db = $dbCustom->getDbConnect(USER_DATABASE);

if(!$aLgn->has_cust_data_record($user_id)){
	
	$stmt = $db->prepare("INSERT INTO customer_data
						(name_first
						,name_last
						,user_division
						,user_position
						,email
						,user_id)	
						VALUES
						(?,?,?,?,?,?)");
		echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('sssssi'
						,$name_first
						,$name_last
						,$user_division
						,$user_position
						,$email
						,$user_id)){
			
		echo 'Error-2 '.$db->error;					
	}else{
		$stmt->execute();
		$stmt->close();		
		$msg = 'success';
	}
		
	
}else{

	$stmt = $db->prepare("UPDATE customer_data
						SET name_first = ?
							,name_last = ?
							,user_division = ?
							,user_position = ?
							,email = ?	
						WHERE user_id = ?");
		echo 'Error '.$db->error;	

	if(!$stmt->bind_param('sssssi'
						,$name_first
						,$name_last
						,$user_division
						,$user_position
						,$email
						,$user_id)){
			
		echo 'Error-2 '.$db->error;					
	}else{
		$stmt->execute();
		$stmt->close();		
		$msg = 'success';
	}
	
}

	$stmt = $db->prepare("UPDATE user
						SET name = ?
						WHERE id = ?");
		echo 'Error '.$db->error;	

	if(!$stmt->bind_param('si'
						,$name
						,$user_id)){
			
		echo 'Error-2 '.$db->error;					
	}else{
		$stmt->execute();
		$stmt->close();		
		$msg = 'success';
	}



?>