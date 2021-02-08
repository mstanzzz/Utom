<?php

class CustomerAccount {
	
	public $name;
	
	
	public $username;
	public $address_one;
	public $address_two;
	public $city;
	public $state;
	public $zip;
	public $phone_one;
	public $phone_two;
	//public $shipping_name;
	public $shipping_name_first;
	public $shipping_name_last;
	public $shipping_address_one;
	public $shipping_address_two;
	public $shipping_city;
	public $shipping_state;
	public $shipping_zip;
	public $shipping_phone;
	public $email;
	public $shipping_country;
	public $billing_name;
	
	public $billing_name_first;
	public $billing_name_last;
	
	public $billing_address_one;
	public $billing_address_two;
	public $billing_city;
	public $billing_state;
	public $billing_zip;
	public $billing_country;
	public $billing_phone;
	
	
	
	
	
	
	public function setDbAccData($customer_id) {
    
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		   
		$sql = "SELECT name, username
				FROM user 
	 			WHERE id = '".$customer_id."'
				";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$name_object = $result->fetch_object();
			$this->username = $name_object->username;
			$this->name = $name_object->name;

		}
		  
		$sql = "SELECT *
				FROM customer_data 
	 			WHERE user_id = '".$customer_id."'
				";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
			
			/*
			$this->address_one = $object->address_one;
			$this->address_two = $object->address_two;
			$this->city = $object->city;
			$this->state = $object->state;
			$this->zip = $object->zip;
			$this->phone_one = $object->phone_one;
			$this->phone_two = $object->phone_two;
			*/
			
			$this->shipping_name_first = $object->shipping_name_first;
			$this->shipping_name_last = $object->shipping_name_last;
			$this->shipping_address_one = $object->shipping_address_one;
			$this->shipping_address_two = $object->shipping_address_two;
			$this->shipping_city = $object->shipping_city;
			$this->shipping_state = $object->shipping_state;
			$this->shipping_zip = $object->shipping_zip;
			$this->shipping_phone = $object->shipping_phone_one;
			
			//$this->shipping_country = $object->shipping_country;
			//$this->billing_name = $object->billing_name;

			$this->billing_name_first = $object->billing_name_first;
			$this->billing_name_last = $object->billing_name_last;

			$this->billing_address_one = $object->billing_address_one;
			$this->billing_address_two = $object->billing_address_two;
			$this->billing_city = $object->billing_city;
			$this->billing_state = $object->billing_state;
			$this->billing_zip = $object->billing_zip;
			//$this->billing_country = $object->billing_country;
			$this->billing_phone = $object->phone_one;
			$this->email = $object->email;

		}
	}



/*
	public function saveDbFromSession($customer_id) {

		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = sprintf("UPDATE customer_data 
				   SET
				   	,name = '%s'
					,address_one = '%s'
					,address_two = '%s'
					,city = '%s'
					,state = '%s'
					,zip = '%s'
					,phone_one = '%s'
					,phone_two = '%s'
					,shipping_name = '%s' 
					,shipping_address_one = '%s'
					,shipping_address_two = '%s'
					,shipping_city = '%s'
					,shipping_state = '%s'
					,shipping_zip = '%s'
					,shipping_phone_one = '%s'
					,billing_name = '%s'
					,billing_address_one = '%s'
					,billing_address_two = '%s'
					,billing_city = '%s' 
					,billing_state = '%s' 
					,billing_zip = '%s'
					WHERE user_id = '%u'", 
					$_SESSION['name']
					,$_SESSION["address_one"]
					,$_SESSION["address_two"]
					,$_SESSION["city"]
					,$_SESSION["state"]
					,$_SESSION["zip"]
					,$_SESSION["phone_one"]
					,$_SESSION["phone_two"]
					,$_SESSION["shipping_name"]
					,$_SESSION["shipping_address_one"]
					,$_SESSION["shipping_address_two"]
					,$_SESSION["shipping_city"]
					,$_SESSION["shipping_state"]
					,$_SESSION["shipping_zip"]
					,$_SESSION["shipping_phone_one"]
					,$_SESSION["billing_name"]
					,$_SESSION["billing_address_one"]
					,$_SESSION["billing_address_two"]
					,$_SESSION["billing_city"]
					,$_SESSION["billing_state"]
					,$_SESSION["billing_zip"]
					,$customer_id);
			
				$result = $dbCustom->getResult($db,$sql);
				//
		
		

	}
*/

	function setAllDoBulkEmail($profile_account_id = 1){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = "UPDATE user
				SET do_bulk_email = '1'
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		
		
	}

	function setDoBulkEmail($cust_id = 0){
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = "UPDATE user
				SET do_bulk_email = '1'
				WHERE id = '".$cust_id."'";
		$result = $dbCustom->getResult($db,$sql);		
				
	}

	function unsetAllDoBulkEmail($profile_account_id = 1){
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "UPDATE user
				SET do_bulk_email = '0'
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		
	}


	function getEmailData($customer_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT name, username
				FROM user 
	 			WHERE id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$ret['name'] = $object->name;
			$ret['username'] = $object->username; 
			return $ret; 
		}
		$ret['name'] = '';
		$ret['username'] = ''; 
		return $ret; 
	}


	function hasAccount($customer_id){
		
		$ret = 0;

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT password_hash, username
				FROM user 
	 			WHERE id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			
			if(trim($object->password_hash) != '' && trim($object->username) != ''){
				$ret = 1;
			}
		
		}
		return $ret;
	}
	
	function updateEmail($customer_id,$email){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "UPDATE customer_data
				SET email = '".$email."'
				WHERE user_id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		
		
	}

	
}

?>