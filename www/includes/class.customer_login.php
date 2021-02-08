<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.design_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');

class CustomerLogin {

	function __construct()
	{

		if(!isset($_SESSION['customer_logged_in'])) $_SESSION['customer_logged_in'] = 0;
		if(!isset($_SESSION['user_type'])) $_SESSION['user_type'] = 1;
		if(!isset($_SESSION['username'])) $_SESSION['username'] = '';
		if(!isset($_SESSION['ctg_cust_id'])) $_SESSION['ctg_cust_id'] = 0;
		if(!isset($_SESSION['customer_full_name'])) $_SESSION['customer_full_name'] = '';
		if(!isset($_SESSION['social_network_profile_id'])) $_SESSION['social_network_profile_id'] = 0;
		if(!isset($_SESSION['name'])) $_SESSION['name'] = '';
		if(!isset($_SESSION['email'])) $_SESSION['email'] = '';
		if(!isset($_SESSION['is_legacy_cust'])) $_SESSION['is_legacy_cust'] = 0;
		
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

	function login($username,$password) {
		
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
			
		$password = str_replace("\"","",$password);
		$password = str_replace("'","",$password);

		$dbCustom = new DbCustom();
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
					
					// merge cart
					/* 
					$old_cust_id = $_SESSION['ctg_cust_id'];
					$new_cust_id = $user_id;
					if($old_cust_id != $new_cust_id){
						$design_cart = new DesignCart;
						$design_cart->mergeCart($old_cust_id,$new_cust_id);				
					}
					*/
					
					
					$ret = 1;
		
		
					$_SESSION['user_type'] = $user_type_id;	
					$_SESSION['customer_logged_in'] = 1;
					$_SESSION['ctg_cust_id'] = $user_id;
					$_SESSION['username'] = $username;						
					$_SESSION['customer_full_name'] = stripslashes($name);
					$_SESSION['name'] = $_SESSION['customer_full_name'];
					$_SESSION['email'] = $username;
					$_SESSION['is_legacy_cust'] = 0;
					
					//setcookie('ctg_cust_id',$user_id,time() + (86400 * 360), '/');
					//setcookie("customer_logged_in", 1, time()+(86400 * 360), '/');;  
					
					$cart = new ShoppingCart;
					$cart->mergeCarts();
								
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



	function getUserIdByEmail($username){

		$dbCustom = new DbCustom();		
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





	function consolidate($email, $logged_in = 0, $user_id = 0){
		if($logged_in == 1 && $user_id > 0){

			$dbCustom = new DbCustom();
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


	function autoLogin($customer_id, $email) {
		$dbCustom = new DbCustom();
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
	
	function getAskProfileId(){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT profile_id 
				FROM profile
				WHERE user_id = '".$this->getCustId()."'";
		$result = $dbCustom->getResult($db,$sql);
		  		
		if($result->num_rows > 0){
			$obj = $result->fetch_object();
			$ret = $obj->profile_id;	
		}else{
			$ret = 0;
		}
		
		return $ret;
	}
	

	function getUserName() {
		$ret = (isset($_SESSION['username'])) ? $_SESSION['username'] : '';	
		
		if($ret == ''){
			$dbCustom = new DbCustom();
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
	
	
	function getFullName($cust_id = 0) {
		
		$ret = (isset($_SESSION['customer_full_name'])) ? $_SESSION['customer_full_name'] : '';	


		if(!isset($_SESSION['ctg_cust_id'])) $_SESSION['ctg_cust_id'] = 0;

		if($cust_id > 0){

			$dbCustom = new DbCustom();
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
			$dbCustom = new DbCustom();
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


	function getZip() {
		$ret = '';	
		$dbCustom = new DbCustom();
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
	
	function varifyPassword($password, $username){
		$ret = 0;
		$dbCustom = new DbCustom();
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
	
	function resetPassword($password_new, $username){		
		$password_salt = $this->generateSalt();
		$password_hash = $this->get_hash($password_new, $password_salt);

		$dbCustom = new DbCustom();
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


	function isActiveSocialAccount() {
		$ret = 0;
		$dbCustom = new DbCustom();
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
	
	function getSocialProfileID() {
		
		if($_SESSION['social_network_profile_id'] == 0){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT profile_id 
					FROM profile
					WHERE user_id = '".$this->getCustId()."'";
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['social_network_profile_id'] = $object->profile_id;;
			}
		}
		
		return $_SESSION['social_network_profile_id'];
	}
	
	function setSocialProfileID() {
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT profile_id 
				FROM profile
				WHERE user_id = '".$this->getCustId()."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$_SESSION['social_network_profile_id'] = $object->profile_id;;
		}
		return $_SESSION['social_network_profile_id'];
	
	}
	
	
	function create_user($password, $username, $name = ''){
		
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		$password = str_replace("\"","",$password);
		$password = str_replace("'","",$password);
		$name = trim(addslashes($name));
		$user_id = 0;

		$dbCustom = new DbCustom();		
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
			$stmt->close();
			
			$this->resetPassword($password, $username);
			$this->login($username,$password);

			$customer_id = $this->getCustId();
			$sql = "DELETE FROM customer_data WHERE user_id = '".$customer_id."'";
			$result = $dbCustom->getResult($db,$sql);
	
			$stmt = $db->prepare("INSERT INTO customer_data 
								(user_id, email)
								VALUES(?,?)");	
					
			if(!$stmt->bind_param("is", $customer_id, $username)){
				
				//echo 'Error '.$db->error;
				
			}else{
				$stmt->execute();
				
			}

		}
			
		return $user_id;							
	}

	function userNameExisis($username){
		
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		
		$username_exists = 0;
		
		$dbCustom = new DbCustom();		
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


	function getUserIDFromEmail($username){
		
		$username = str_replace("\"","",$username);
		$username = str_replace("'","",$username);
		
		$username_exists = 0;
		
		$dbCustom = new DbCustom();		
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