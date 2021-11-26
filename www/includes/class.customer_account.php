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
	
	public function setDbAccData($dbCustom,$customer_id) {
    
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT name, username
				FROM user 
	 			WHERE id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$name_object = $result->fetch_object();
			$this->username = $name_object->username;
			$this->name = $name_object->name;
		}
		$sql = "SELECT *
				FROM customer_data 
	 			WHERE user_id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
			$this->shipping_name_first = $object->shipping_name_first;
			$this->shipping_name_last = $object->shipping_name_last;
			$this->shipping_address_one = $object->shipping_address_one;
			$this->shipping_address_two = $object->shipping_address_two;
			$this->shipping_city = $object->shipping_city;
			$this->shipping_state = $object->shipping_state;
			$this->shipping_zip = $object->shipping_zip;
			$this->shipping_phone = $object->shipping_phone_one;
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

	function setAllDoBulkEmail($dbCustom,$profile_account_id = 1){
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE user
				SET do_bulk_email = '1'
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
	}

	function setDoBulkEmail($dbCustom,$cust_id = 0){
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE user
				SET do_bulk_email = '1'
				WHERE id = '".$cust_id."'";
		$result = $dbCustom->getResult($db,$sql);		
	}

	function unsetAllDoBulkEmail($dbCustom,$profile_account_id = 1){
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE user
				SET do_bulk_email = '0'
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
	}

	function getEmailData($dbCustom,$customer_id){
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

	function hasAccount($dbCustom, $customer_id){
		$ret = 0;
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
	
	function updateEmail($dbCustom,$customer_id,$email){
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "UPDATE customer_data
				SET email = '".$email."'
				WHERE user_id = '".$customer_id."'";
		$result = $dbCustom->getResult($db,$sql);		
	}
	
}

?>