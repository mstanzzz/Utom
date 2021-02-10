<?php

		
	$billing_name_first = trim(addslashes($_POST['billing_name_first'])); 
	$billing_name_last = trim(addslashes($_POST['billing_name_last'])); 
	$billing_address_one = trim(addslashes($_POST['billing_address_one'])); 
	$billing_address_two = trim(addslashes($_POST['billing_address_two'])); 
	$billing_city = trim(addslashes($_POST['billing_city'])); 
	$billing_state = trim($_POST['billing_state']); 
	$billing_zip = trim(addslashes($_POST['billing_zip'])); 
	$billing_country = trim(addslashes($_POST['billing_country'])); 
	$billing_phone = trim(addslashes($_POST['billing_phone'])); 
	$email = trim(addslashes($_POST['email'])); 
	$shipping_name_first = trim(addslashes($_POST['shipping_name_first'])); 
	$shipping_name_last = trim(addslashes($_POST['shipping_name_last'])); 
	$shipping_address_one = trim(addslashes($_POST['shipping_address_one'])); 
	$shipping_address_two = trim(addslashes($_POST['shipping_address_two'])); 
	$shipping_city = trim(addslashes($_POST['shipping_city'])); 
	$shipping_state = trim($_POST['shipping_state']); 
	$shipping_zip = trim(addslashes($_POST['shipping_zip'])); 
	$shipping_phone_one = trim(addslashes($_POST['shipping_phone_one']));
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id FROM customer_data WHERE user_id = '".$customer_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
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
			
			/*
			
		$sql = sprintf("UPDATE customer_data 
				   SET
					shipping_name_first = '%s' 
					,shipping_name_last = '%s' 
					,shipping_address_one = '%s'
					,shipping_address_two = '%s'
					,shipping_city = '%s'
					,shipping_state = '%s'
					,shipping_zip = '%s'
					,shipping_phone_one = '%s'
					,billing_name_first = '%s'
					,billing_name_last = '%s'
					,billing_address_one = '%s'
					,billing_address_two = '%s'
					,billing_city = '%s' 
					,billing_state = '%s' 
					,billing_zip = '%s'
					,phone_one = '%s'
					,email = '%s'
					WHERE user_id = '%u'", 
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
					,$customer_id);
				
		$result = $dbCustom->getResult($db,$sql);
		
		*/
		
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
		
		
		
		/*
		$sql = sprintf("INSERT INTO customer_data
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
						VALUES
			('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%u')",
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
						,$customer_id); 
		$result = $dbCustom->getResult($db,$sql);
		*/
		

	}	
	$msg = 'Your address information was successfully updated';
	unset($_SESSION['checkout_info_array']);


?>