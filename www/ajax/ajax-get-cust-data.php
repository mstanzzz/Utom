<?php
if(!isset($real_root)){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$real_root = $_SERVER['DOCUMENT_ROOT']; 	
	}
}
require_once($real_root."/includes/config.php");

$db = $dbCustom->getDbConnect(USER_DATABASE);


$email = (isset($_GET['email'])) ? $_GET['email'] : '';

//echo $email;


/*
$sql = sprintf("SELECT id FROM user WHERE username = '%u'", $email);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$user_id = $object->id;
}else{
	$id = 0;
}
*/

$user_id = 0;
$name = '';

$stmt = $db->prepare("SELECT id, name 
					FROM user
					WHERE username = ?");
if(!$stmt->bind_param("s", $email)){
		//echo 'Error '.$db->error;
}else{
	$stmt->execute();						
	$stmt->bind_result($user_id, $name);	
	$stmt->fetch();	
}
$stmt->close();

	$address_one = '';
	$address_two = '';
	$city = '';
	$state = '';
	$zip = '';
	$phone_one = '';
	$phone_two = '';
	$shipping_name_first = '';
	$shipping_name_last = '';
	$shipping_address_one = '';
	$shipping_address_two = '';
	$shipping_city = '';
	$shipping_state = '';
	$shipping_zip = '';
	$shipping_phone_one = '';
	$billing_name_first = '';
	$billing_name_last = '';
	$billing_address_one = '';
	$billing_address_two = '';
	$billing_city = '';
	$billing_state = '';
	$billing_zip = '';

if($user_id > 0){
	$sql = sprintf("SELECT * FROM customer_data WHERE user_id = '%u'", $user_id);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		
		$object = $result->fetch_object();
		$address_one = $object->address_one;
		$address_two = $object->address_two;
		$city = $object->city;
		$state = $object->state;
		$zip = $object->zip;
		$phone_one = $object->phone_one;
		$phone_two = $object->phone_two;
		$shipping_name_first = $object->shipping_name_first;
		$shipping_name_last = $object->shipping_name_last;
		$shipping_address_one = $object->shipping_address_one;
		$shipping_address_two = $object->shipping_address_two;
		$shipping_city = $object->shipping_city;
		$shipping_state = $object->shipping_state;
		$shipping_zip = $object->shipping_zip;
		$shipping_phone_one = $object->shipping_phone_one;
		$billing_name_first = $object->billing_name_first;
		$billing_name_last = $object->billing_name_last;
		$billing_address_one = $object->billing_address_one;
		$billing_address_two = $object->billing_address_two;
		$billing_city = $object->billing_city;
		$billing_state = $object->billing_state;
		$billing_zip = $object->billing_zip;
		
	}else{
	}

}

/*

						 $name = 'name';
						 $address_one = 'address_one';
						 $address_two = 'address_two';
						 $city = 'city';
						 $shipping_name_first = 'shipping_name_first';
						 $shipping_name_last = 'shipping_name_last';
						 $shipping_address_one = 'shipping_address_one';
						 $shipping_address_two = 'shipping_address_two';
						 $shipping_city = 'shipping_city';
						 $shipping_state = 'shipping_state';
						 $shipping_zip = 'shipping_zip';
						 $shipping_phone_one = 'shipping_phone_one';  	 
						 $billing_name_first = 'billing_name_first';
						 $billing_name_last = 'billing_name_last';
						 $billing_address_one = 'billing_address_one';
						 $billing_address_two = 'billing_address_two';
						 $billing_city = 'billing_city';
						 $billing_state = 'billing_state';
						 $billing_zip = 'billing_zip';
*/

		
	$returnData = json_encode(array(
						 'name'=> $name,
						 'city'=> $city,
						 'shipping_name'=> $shipping_name_first." ".$shipping_name_last,
						 'address_one'=> $address_one,
						 'address_two'=> $address_two,						 
						 'shipping_address_one'=> $shipping_address_one,
						 'shipping_address_two'=> $shipping_address_two,
						 'shipping_city'=> $shipping_city,
						 'shipping_state'=> $shipping_state,
						 'shipping_zip'=> $shipping_zip,
						 'shipping_phone_one'=> $shipping_phone_one,
						 'billing_name'=> $billing_name_first." ".$billing_name_last,
						 'billing_address_one'=> $billing_address_one,
						 'billing_address_two'=> $billing_address_two,
						 'billing_city'=> $billing_city,
						 'billing_state'=> $billing_state,
						 'billing_zip'=> $billing_zip));


	
echo $returnData;


?>

