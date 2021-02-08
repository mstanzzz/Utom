<?php

if(!isset($customer_id)){
	$customer_id = $lgn->getCustId();
}
	
$billing_name_first = (isset($_POST['billing_name_first']))? trim(addslashes($_POST['billing_name_first'])) : ''; 
$billing_name_last = (isset($_POST['billing_name_last']))? trim(addslashes($_POST['billing_name_last'])) : ''; 
$billing_address_one = (isset($_POST['billing_address_one']))? trim(addslashes($_POST['billing_address_one'])) : ''; 
$billing_address_two = (isset($_POST['billing_address_two']))? trim(addslashes($_POST['billing_address_two'])) : ''; 
$billing_city = (isset($_POST['billing_city']))? trim(addslashes($_POST['billing_city'])) : ''; 
$billing_state = (isset($_POST['billing_state']))? trim($_POST['billing_state']) : ''; 
$billing_zip = (isset($_POST['billing_zip']))? trim(addslashes($_POST['billing_zip'])) : ''; 
$billing_country = (isset($_POST['billing_country']))? trim(addslashes($_POST['billing_country'])) : ''; 
$billing_phone = (isset($_POST['billing_phone']))? trim(addslashes($_POST['billing_phone'])) : ''; 
$email = (isset($_POST['email']))? trim(addslashes($_POST['email'])) : ''; 
$shipping_name_first = (isset($_POST['shipping_name_first']))? trim(addslashes($_POST['shipping_name_first'])) : ''; 
$shipping_name_last = (isset($_POST['billing_name_first']))? trim(addslashes($_POST['shipping_name_last'])) : ''; 
$shipping_address_one = (isset($_POST['shipping_address_one']))? trim(addslashes($_POST['shipping_address_one'])) : ''; 
$shipping_address_two = (isset($_POST['shipping_address_two']))? trim(addslashes($_POST['shipping_address_two'])) : ''; 
$shipping_city = (isset($_POST['shipping_city']))? trim(addslashes($_POST['shipping_city'])) : ''; 
$shipping_state = (isset($_POST['shipping_state']))? trim($_POST['shipping_state']) : ''; 
$shipping_zip = (isset($_POST['shipping_zip']))? trim(addslashes($_POST['shipping_zip'])) : ''; 
$shipping_phone_one = (isset($_POST['shipping_phone_one']))? trim(addslashes($_POST['shipping_phone_one'])) : '';

/*
echo "<br />";
echo "<br />";
echo "billing_phone ".$billing_phone;
echo "<br />";
echo "shipping_phone_one ".$shipping_phone_one;
echo "<br />";
echo "<br />";
*/

$db = $dbCustom->getDbConnect(USER_DATABASE);
	
$sql = "SELECT id 
		FROM customer_data 
		WHERE user_id = '".$customer_id."'";
$result = $dbCustom->getResult($db,$sql);

//echo $result->num_rows;


if($result->num_rows > 0){
			
	$stmt = $db->prepare("UPDATE customer_data 
				   SET
					shipping_name_first = ? 
					,shipping_name_last = ? 
					,shipping_address_one = ?
					,shipping_address_two = ?
					,shipping_city = ?
					,shipping_state = ?
					,shipping_zip = ?
					,shipping_phone_one = ?
					,billing_name_first = ?
					,billing_name_last = ?
					,billing_address_one = ?
					,billing_address_two = ?
					,billing_city = ? 
					,billing_state = ? 
					,billing_zip = ?
					,phone_one = ?
					,email = ?
					WHERE user_id = ?");
					 
	if(!$stmt->bind_param("sssssssssssssssssi", 
				$shipping_name_first
					,$shipping_name_last
					,$shipping_address_one
					,$shipping_address_two
					,$shipping_city
					,$shipping_state
					,$shipping_zip
					,$shipping_phone_one
					,$billing_name_first
					,$billing_name_last
					,$billing_address_one
					,$billing_address_two
					,$billing_city
					,$billing_state
					,$billing_zip
					,$billing_phone
					,$email
					,$customer_id)){			
		//echo 'Error '.$db->error;			
	}else{
		
		$stmt->execute();
		$stmt->close();
	}					
			
}else{
		
	$stmt = $db->prepare("INSERT INTO customer_data 
								(shipping_name_first 
								,shipping_name_last 
								,shipping_address_one
								,shipping_address_two
								,shipping_city
								,shipping_state
								,shipping_zip
								,shipping_phone_one
								,billing_name_first
								,billing_name_last
								,billing_address_one
								,billing_address_two
								,billing_city 
								,billing_state 
								,billing_zip
								,phone_one
								,email
								,user_id)
								VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
					
	if(!$stmt->bind_param("sssssssssssssssssi", 
					$shipping_name_first
						,$shipping_name_last
						,$shipping_address_one
						,$shipping_address_two
						,$shipping_city
						,$shipping_state
						,$shipping_zip
						,$shipping_phone_one
						,$billing_name_first
						,$billing_name_last
						,$billing_address_one
						,$billing_address_two
						,$billing_city
						,$billing_state
						,$billing_zip
						,$billing_phone
						,$billing_email
						,$customer_id)){
				
				//echo 'Error '.$db->error;
				
			}else{
				$stmt->execute();
				
			}

	}	
	
	$msg = 'Your address information was successfully updated';
	unset($_SESSION['checkout_info_array']);

?>