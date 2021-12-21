<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root."/includes/class.shopping_cart.php"); 	
//require_once($real_root.'/includes/class.design_cart.php');

class CustomerLogin {

	function __construct()
	{
		if(!isset($_SESSION['customer_logged_in'])) $_SESSION['customer_logged_in'] = 0;
		if(!isset($_SESSION['user_type'])) $_SESSION['user_type'] = 1;
		if(!isset($_SESSION['username'])) $_SESSION['username'] = '';
		if(!isset($_SESSION['customer_full_name'])) $_SESSION['customer_full_name'] = '';
		if(!isset($_SESSION['social_network_profile_id'])) $_SESSION['social_network_profile_id'] = 0;
		if(!isset($_SESSION['name'])) $_SESSION['name'] = '';
		if(!isset($_SESSION['email'])) $_SESSION['email'] = '';
		if(!isset($_SESSION['is_legacy_cust'])) $_SESSION['is_legacy_cust'] = 0;
		if(!isset($_SESSION['ctg_visitor_id'])) $_SESSION['ctg_visitor_id'] = rand();
	}
			
	function generateSalt()
	{
		//return hash('sha256', uniqid(rand(), true)); 
		return sha1(uniqid(rand()));
	}

	function get_hash($password, $salt)
	{
		//return hash('sha256', $password . $salt);
		return sha1($password.$salt);
	}

	function login($dbCustom, $username,$password) {
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		$password = str_replace("\"","",$password);
		$password = str_replace("'","",$password);

		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$ret = 0;
		$stmt = $db->prepare("SELECT name
					,id 
					,user_type_id
					,password_hash
					,password_salt
					FROM user
					WHERE username = ?
					AND profile_account_id = ? "); 
			
		if(!$stmt->bind_param("si", $username, $_SESSION['profile_account_id'])){
			//echo 'Error '.$db->error;
		}else{
			$stmt->execute();
			$stmt->bind_result($name
						,$user_id
						,$user_type_id
						,$password_hash
						,$password_salt);
	
			if($stmt->fetch()){
				
				if($password_hash == $this->get_hash($password, $password_salt)){
					
					$ret = 1;
		
		
					$_SESSION['user_type'] = $user_type_id;	
					$_SESSION['customer_logged_in'] = 1;
					$_SESSION['ctg_cust_id'] = $user_id;
					$_SESSION['username'] = $username;						
					$_SESSION['customer_full_name'] = stripslashes($name);
					$_SESSION['name'] = $_SESSION['customer_full_name'];
					$_SESSION['email'] = $username;
					$_SESSION['is_legacy_cust'] = 0;
					
					$cart = new ShoppingCart($dbCustom);
					
					$cart->mergeCarts($dbCustom);
								
					if($this->getUserType() == 5){
						$this->setSocialProfileID();
					}
					
					$this->consolidate($username, 1, $user_id);
					
					
				}else{
					
					$_SESSION['customer_logged_in'] = 0;
		
					$_SESSION['ctg_cust_id'] = 0;
					$_SESSION['username'] = '';						
					$_SESSION['customer_full_name'] = '';
					
					$ret = 0;
				}
				
			}
		
			$stmt->close();
		
		}

		/*
		if(!$ret && $_SESSION['profile_account_id'] == 1){			
			$ret = $this->loginLegacyCTG($username,$password);
			if($ret){
				$this->create_user($password, $username, $_SESSION['name']);
			}
		}
		*/
		
		return $ret;
	}

	// Used for legacy CTG login
	function md5x($str) { 
		return strrev(md5(md5(strrev(md5($str)))));
	}


	function loginLegacyCTG($username,$password) {
	
		$ret = 0;
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnectLegacyCTG(BUY_CLOSE_CTG_DATABASE);
	
		
		$stmt = $db->prepare("SELECT customer_num, password, name
					FROM customer_data
					WHERE username = ?
					OR email = ? "); 
		
		if(!$stmt->bind_param("ss", $username, $username)){
			
			//echo 'Error '.$db->error;
			
		}else{
			
			$stmt->execute();
			
			$stmt->bind_result($customer_num, $stored_password, $name);

			if($stmt->fetch()){

				if(trim($stored_password) == $this->md5x(trim($password))){
					
					$_SESSION['user_type'] = 1;	
					$_SESSION['customer_logged_in'] = 1;
					$_SESSION['ctg_cust_id'] = $customer_num;
					$_SESSION['username'] = $username;						
					$_SESSION['customer_full_name'] = '';
					
					$_SESSION['name'] = stripslashes($name);
					$_SESSION['email'] = $username;
					
					$_SESSION['is_legacy_cust'] = 1;
					$ret = 1;
					
					
				}

			}
			
			$stmt->close();
		}
		
		return $ret;
	}


	function setVisitorCookie(){
		$cookie_name = "ctg";
		$cookie_value = "put something here";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		if(!isset($_COOKIE[$cookie_name])) {
		  echo "Cookie named '" . $cookie_name . "' is not set!";
		} else {
		  echo "Cookie '" . $cookie_name . "' is set!<br>";
		  echo "Value is: " . $_COOKIE[$cookie_name];
		}
		exit;
		//return $_SESSION['ctg_visitor_id']
	}

	function getVisitorIDByCookie(){
		return $_SESSION['ctg_visitor_id'];
	}

	function getUserIdByEmail($dbCustom,$username){
		$db = $dbCustom->getDbConnect(USER_DATABASE);	
		$stmt = $db->prepare("SELECT id
							FROM user
							WHERE username = ?
							AND profile_account_id = ?");		
				
		if(!$stmt->bind_param("si", $username, $_SESSION['profile_account_id'])){
			//echo 'Error '.$db->error;
		}else{
			$stmt->execute();
			$stmt->bind_result($id);
			if($stmt->fetch()){
				return $id;
			}
			$stmt->close();
		}
		return 0;		
	}





	function consolidate($dbCustom, $email, $logged_in = 0, $user_id = 0){
		if($logged_in == 1 && $user_id > 0){
			$db = $dbCustom->getDbConnect(USER_DATABASE);

			$sql = "SELECT id		
					FROM user 
					WHERE id != '".$user_id."' 
					AND username = '".$email."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 1){
			
				$sql = "DELETE FROM user 
						WHERE id != '".$user_id."'
						AND username = '".$email."'
						AND profile_account_id = '".$_SESSION['profile_account_id']."'";
				$result = $dbCustom->getResult($db,$sql);			
				
				$sql = "DELETE FROM customer_data 
						WHERE user_id != '".$user_id."'
						AND email = '".$email."'";
				$result = $dbCustom->getResult($db,$sql);			
						
			}
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "UPDATE ctg_order 
					SET customer_id = '".$user_id."'
					WHERE customer_id != '".$user_id."'
					AND billing_email = '".$email."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);

		}
	}


	function autologin($dbCustom, $customer_id, $email) {

		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$ret = 0;

		if(is_numeric($customer_id) && $customer_id > 0){
	
			$sql = "SELECT name
					,username
					FROM user 
					WHERE id = '".$customer_id."'";
			$result = $dbCustom->getResult($db,$sql);			

		}elseif(strlen($email) > 6){
	
			$sql = "SELECT name
					,username
					FROM user 
					WHERE username = '".$email."'";
			$result = $dbCustom->getResult($db,$sql);			
			
		}else{
			return 0;	
		}
		
		
		if($result->num_rows > 0){
			$object = $result->fetch_object();	
			$ret = 1;
		
			$_SESSION['customer_logged_in'] = 1;
			$_SESSION['ctg_cust_id'] = $customer_id;
			$_SESSION['username'] = $object->username;						
			$_SESSION['customer_full_name'] = $object->name;
			
			$_SESSION['name'] = $object->name;
			$_SESSION['email'] = $object->username;
		}else{
			$_SESSION['customer_logged_in'] = 0;
			$_SESSION['ctg_cust_id'] = 0;
			$_SESSION['username'] = '';						
			$_SESSION['customer_full_name'] = '';
			
		}
		
		return $ret;
	}

	
	
	function logOut(){		
		$_SESSION['customer_logged_in'] = 0;
		$_SESSION['ctg_cust_id'] = 0;
		$_SESSION['username'] = '';						
		$_SESSION['customer_full_name'] = '';
		$_SESSION['social_network_profile_id'] = 0;
		$_SESSION['is_legacy_cust'] = 0;

	}
	
	

	function getUserName($dbCustom) {
		$ret = (isset($_SESSION['username'])) ? $_SESSION['username'] : '';	
		
		if($ret == ''){
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT username
				FROM user 
	 			WHERE id = '".$this->getCustId()."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows){
				$object = $result->fetch_object();
				$_SESSION['username'] = $object->username;
				$ret = $object->username;
			}
		}
		
		return $ret;
	}
	
	
	function getFullName($dbCustom, $cust_id = 0) {
		$ret = (isset($_SESSION['customer_full_name'])) ? $_SESSION['customer_full_name'] : '';	
		if(!is_numeric($cust_id))$cust_id=0;
		if(!isset($_SESSION['ctg_cust_id'])) $_SESSION['ctg_cust_id'] = $cust_id;
		if($cust_id > 0){
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT name
				FROM user 
	 			WHERE id = '".$cust_id."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows){
				$object = $result->fetch_object();
				$_SESSION['customer_full_name'] = $object->name;
				$ret = $object->name;
			}
		}else{
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT name
				FROM user 
	 			WHERE id = '".$_SESSION['ctg_cust_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows){
				$object = $result->fetch_object();
				$_SESSION['customer_full_name'] = $object->name;
				$ret = $object->name;
			}
		}

		return $ret;
		
		
	}


	function getZip($dbCustom) {
		$ret = '';	
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT zip
				FROM customer_data 
	 			WHERE id = '".$_SESSION['ctg_cust_id']."'";
		$result = $dbCustom->getResult($db,$sql);		//
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->zip;
		}

		return $ret;
	}



	function getCustId() {
		$ret = (isset($_SESSION['ctg_cust_id'])) ? $_SESSION['ctg_cust_id'] : 0;	
		return $ret;		
	}
	
	

	function isLogedIn() {
		return $_SESSION['customer_logged_in'];
	}
	
	function varifyPassword($dbCustom,$password, $username){
		$ret = 0;
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT 
				password_hash
				,password_salt
				FROM user 
	 			WHERE username = '".$username."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			if($object->password_hash == $this->get_hash($password, $object->password_salt)){
				$ret = 1;
			}
		}
		return $ret;
	}
	
	function resetPassword($dbCustom,$password_new, $username){		
		$password_salt = $this->generateSalt();
		$password_hash = $this->get_hash($password_new, $password_salt);
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE user 
				SET password_hash = '".$password_hash."' ,password_salt = '".$password_salt."' 
	 			WHERE username = '".$username."'";
		$result = $dbCustom->getResult($db,$sql);		
		return 1;
	}
	
	function getUserType() {
		return $_SESSION['user_type'];
	}


	function isActiveSocialAccount($dbCstom) {
		$ret = 0;
		
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT profile_id 
				FROM profile
				WHERE active = '1' 
				AND user_id = '".$this->getCustId()."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$ret = 1;
		}
		return $ret;
	}
	
	function create_user($dbCustom, $password, $username, $name = ''){
		
		$redo_cust_data = 0;
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		$password = str_replace("\"","",$password);
		$password = str_replace("'","",$password);
		$name = trim(addslashes($name));
		$user_id = 0;
		$db = $dbCustom->getDbConnect(USER_DATABASE);	
		$db_now = date('Y-m-d h:i:s');
		$user_type = 1;
		$stmt = $db->prepare("INSERT INTO user 
							(name, username, user_type_id, created, visited)
					   		VALUES(?,?,?,?,?)");		
			//echo 'Error1 '.$db->error;
		if(!$stmt->bind_param("sssss", $name, $username, $user_type, $db_now, $db_now)){
			echo 'Error2 '.$db->error;
		}else{
			$stmt->execute();
			$user_id = $db->insert_id;
			
			$this->resetPassword($dbCustom, $password, $username);
			$this->login($dbCustom,$username,$password);
						
			$redo_cust_data = 1;
			
		}
		
		if($redo_cust_data){
			
			$sql = "DELETE FROM customer_data WHERE user_id = '".$user_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			$stmt = $db->prepare("INSERT INTO customer_data 
								(user_id, email)
								VALUES(?,?)");	
			if(!$stmt->bind_param("is",$user_id, $username)){
				//echo 'Error '.$db->error;
			}else{
				$stmt->execute();
			}
			
			
			$stmt->close();
		}
		
		
		
		return $user_id;	
				
	}

	function userNameExisis($dbCustom,$username){
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		$username_exists = 0;
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$stmt = $db->prepare("SELECT id
						FROM user
						WHERE username = ?
						AND profile_account_id = ?"); 
		if(!$stmt->bind_param("si", $username, $_SESSION['profile_account_id'])){			
			//echo 'Error '.$db->error;			
		}else{
			$stmt->execute();
			if($stmt->fetch()){
				$username_exists = 1;
			}
		}
		return $username_exists;
	}

	function getUserIDFromEmail($dbCustom,$username){	
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		$username_exists = 0;
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$stmt = $db->prepare("SELECT id
						FROM user
						WHERE username = ?
						AND profile_account_id = ?"); 
		if(!$stmt->bind_param("si", $username, $_SESSION['profile_account_id'])){			
			//echo 'Error '.$db->error;			
		}else{
			
			$stmt->execute();
			$stmt->bind_result($id);	
			$stmt->fetch();
		}
		return $id;
	}
	
}

?>