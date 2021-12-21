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
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();
require_once($real_root.'/manage/admin-includes/manage-includes.php');

//require_once($_SERVER['DOCUMENT_ROOT']."/includes/braintree/lib/Braintree.php");

$progress = new SetupProgress;
$module = new Module;
$pages = new Pages;

 
$msg = '';
$page_title = "SAAS Customers & Fees";
$page_group = "sas";


$db = $dbCustom->getDbConnect(USER_DATABASE);

if(isset($_POST['edit_account'])){
	$e_profile_account_id = $_POST["e_profile_account_id"];
	
	$parent_id = ($_POST["parent_id"] > 0) ? $_POST["parent_id"] : $_SESSION['profile_account_id'];
	$company = trim(addslashes($_POST["company"])); 
	SITEROOT_name = trim(addslashes($_POST["domain_name"])); 
	
	SITEROOT_name = str_replace('http://','',SITEROOT_name);
	SITEROOT_name = str_replace('https://','',SITEROOT_name);
	SITEROOT_name = str_replace('www.','',SITEROOT_name);
	
	$recurring_billing_id = trim(addslashes($_POST["recurring_billing_id"])); 
	$email = trim(addslashes($_POST["email"])); 
	$contact_email = trim(addslashes($_POST["contact_email"])); 
	$name_first = trim(addslashes($_POST["name_first"])); 
	$name_last = trim(addslashes($_POST["name_last"])); 
	$phone = trim(addslashes($_POST["phone"])); 
	$address = trim(addslashes($_POST["address"])); 
	$city = trim(addslashes($_POST["city"])); 
	$state = trim(addslashes($_POST["state"])); 
	$zip = trim(addslashes($_POST["zip"])); 
	$is_ssl = (isset($_POST["is_ssl"])) ? $_POST["is_ssl"] : 0; 
 	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 
	$card_auth_code = isset($_POST["card_auth_code"]) ? trim(addslashes($_POST["card_auth_code"])) : ''; 
	$card_num = trim(addslashes($_POST["card_num"])); 
	$exp_month = trim($_POST["exp_month"]); 
	$exp_year = trim($_POST["exp_year"]); 
	$recurring_billing_amount = isset($_POST["recurring_billing_amount"]) ? trim(addslashes($_POST["recurring_billing_amount"])) : 0;	
	$iframes_allowed = $_POST["iframes_allowed"];	$fee_payment_method = $_POST["fee_payment_method"];	$update_billing_name = 0;
	$update_cc_info = 0;
	$update_billing_amount = 0;
	
	$sql = "SELECT billing_name_first, billing_name_last, braintree_cc_token, braintree_subscription_id, braintree_recurring_billing_amount 
			FROM profile_account 
			WHERE id = '".$e_profile_account_id."'"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		$n_obj = $result->fetch_object();
		$cc_token = $n_obj->braintree_cc_token;
		$braintree_subscription_id = $n_obj->braintree_subscription_id;		
		$braintree_recurring_billing_amount = $n_obj->braintree_recurring_billing_amount;
		 
		if($billing_name_first != trim($n_obj->billing_name_first) || $billing_name_last != trim($n_obj->billing_name_last)){
			$update_billing_name = 1;
		}
	
	}else{
		$cc_token = '';
		$braintree_subscription_id = '';
		$braintree_recurring_billing_amount = 0;
	}
	
	if(strlen($card_num) > 12 && is_numeric($card_num)){
		if(strlen($cc_token) > 0){
			$update_cc_info = 1;
		}	
	}
	
	if($recurring_billing_amount > 0 && is_numeric($recurring_billing_amount)){
		if($braintree_recurring_billing_amount != $recurring_billing_amount){
			if($braintree_subscription_id != ''){			
				$update_billing_amount = 1;	
			}
		}	
	}

	$is_shipping_charges = isset($_POST["is_shipping_charges"]) ? $_POST["is_shipping_charges"] : 1;
	$profile_account_type_id = $_POST["profile_account_type_id"];
	$user_type_id  = 7;
	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	if($admin_password != ''){
		$update_pwd = 1;
		$password_salt = $aLgn->generateSalt();
		$password_hash = $aLgn->get_hash($admin_password, $password_salt);	
	}else{
		$update_pwd = 0;	
	}
	
	$sql = "SELECT id 
			FROM user 
			WHERE profile_account_id = '".$e_profile_account_id."'
			AND user_type_id = '".$user_type_id."'"; 
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
			$id_obj = $result->fetch_object();
			$t_user_id = $id_obj->id; 
		
			$sql = sprintf("UPDATE user 
					SET name = '%s'
					,username = '%s'
					,visited = '%s'
					WHERE id = '%u'
					", 
					$admin_name
					,$admin_username
					,date('Y-m-d H:i:s')
					,$t_user_id
					);
		$res = $dbCustom->getResult($db,$sql);
		
		if($update_pwd){		
			$sql = "UPDATE user 
					SET 
					password_hash = '".$password_hash."' 
					,password_salt = '".$password_salt."'
					WHERE id = '".$t_user_id."'
					";
			$res = $dbCustom->getResult($db,$sql);
		}
	}else{
		if(!$update_pwd){

		}else{
		
			$sql = sprintf("INSERT INTO user 
						(name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
						VALUES
						('%s','%s','%s','%s','%u','%s','%s','%u')",
						$admin_name, $admin_username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $e_profile_account_id);
	
			$result = $dbCustom->getResult($db,$sql);
			
			$t_user_id = $db->insert_id;
			
		}
	}
	
	$sql = sprintf("UPDATE profile_account 
				SET company = '%s'
				,profile_account_type_id = '%u'
				,parent_id = '%u'
				,domain_name = '%s'
				,recurring_billing_id = '%s'
				,email = '%s'
				,contact_email = '%s'
				,name_first = '%s'
				,name_last = '%s'
				,phone = '%s'
				,address = '%s'
				,city = '%s'
				,state = '%s'
				,zip = '%s'
				,is_shipping_charges = '%u'
				,billing_name_first = '%s'
				,billing_name_last = '%s'
				,iframes_allowed = '%u'
				,fee_payment_method = '%s'
				,is_ssl = '%u'
				WHERE id = '%u'", 
				$company
				,$profile_account_type_id
				,$parent_id
				,SITEROOT_name
				,$recurring_billing_id
				,$email
				,$contact_email
				,$name_first
				,$name_last
				,$phone
				,$address
				,$city
				,$state
				,$zip
				,$is_shipping_charges
				,$billing_name_first
				,$billing_name_last
				,$iframes_allowed
				,$fee_payment_method
				,$is_ssl
				,$e_profile_account_id				
				);	
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM profile_account_to_module WHERE profile_account_id = '".$e_profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"]; 
		foreach($module_ids as $value){
			$m_fee = (isset($_POST[$value.'_fee'])) ? $_POST[$value.'_fee'] : 0;
			$sql = "INSERT INTO profile_account_to_module 
					(module_id, profile_account_id, fee)
					VALUES('".$value."','".$e_profile_account_id."', '".$m_fee."')";
			$result = $dbCustom->getResult($db,$sql);
		}	
	}
	
	if($module->hasDesignToolModule($e_profile_account_id)){		
		if($module->hasDesignServicesModule($e_profile_account_id)){
			
			//check if already has it
			$sql = "SELECT id 
					FROM profile_account_to_module
					WHERE module_id = '6'
					AND profile_account_id = '".$e_profile_account_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows == 0){
				$ds_fee = (isset($_POST['6_fee'])) ? $_POST['6_fee'] : 0; 
				$sql = "INSERT INTO profile_account_to_module 
						(module_id, profile_account_id, fee)
						VALUES('6','".$e_profile_account_id."', '".$ds_fee."' )";
				$result = $dbCustom->getResult($db,$sql);
			}
		}
	}
	
	// set available_pages
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "UPDATE page_seo 
			SET available = '0' 
			WHERE optional = '1' 
			AND profile_account_id = '".$e_profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if(isset($_POST["available_pages"])){
		$available_page_seo_ids = $_POST["available_pages"]; 
		foreach($available_page_seo_ids as $value){
			$sql = "UPDATE page_seo 
					SET available = '1' 
					WHERE page_seo_id = '".$value."'
					AND profile_account_id = '".$e_profile_account_id."'";
			$result = $dbCustom->getResult($db,$sql);
		}	
	}
	
	$sql = "UPDATE page_seo 
			SET active = '0' 
			WHERE available = '0'";			
	$result = $dbCustom->getResult($db,$sql);
	
	
	
// Braintree	
/*	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT *
			FROM braintree_credentials
			WHERE braintree_credentials_id = '1'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$c_obj = $result->fetch_object();
		$environment = $c_obj->environment;
		$merchant_id = $c_obj->merchant_id;
		$public_key = $c_obj->public_key;
		$private_key = $c_obj->private_key;	}else{
	
		$environment = '';
		$merchant_id = "jzy3nhzv2pvdvp78";
		$public_key = "fms727dhnfcnwyb7";
		$private_key = "wqrcz6qgz28kdqtx";
					}
	
	Braintree_Configuration::environment($environment);
	Braintree_Configuration::merchantId($merchant_id);
	Braintree_Configuration::publicKey($public_key);
	Braintree_Configuration::privateKey($private_key);


	if($fee_payment_method == "manual"){

		$cancelResult = Braintree_Subscription::cancel($s_obj->braintree_subscription_id);
		if(!$cancelResult->success){				
			foreach($cancelResult->errors->deepAll() AS $error) {
				$msg .= $error->code." : ".$error->message . "</br>"; 
			}
		}	}else{
			
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$exp_date = $exp_month."/".$exp_year;
	
		if($update_cc_info){
		
			if($update_billing_name){
				$updateResult = Braintree_CreditCard::update(
				  $cc_token,
				  array(
					'number' => $card_num,
					'expirationDate' => $exp_date,
					'billingAddress' => array(
						'firstName' => $billing_name_first,
						'lastName' => $billing_name_last
					)
				  )
				);
				if($updateResult->success){
				
					$sql = "UPDATE profile_account
							SET billing_name_first = '".$billing_name_first."'
							,billing_name_last = '".$billing_name_last."'
							WHERE id = '".$profile_account_id."'"; 
					$upd_res = mysql_query($sql);
					if(!$upd_res)die(mysql_error());
				}else{
					foreach($updateResult->errors->deepAll() AS $error) {
						$msg .= $error->code." : ".$error->message . "</br>"; 
					}				
				}
			}else{
				$updateResult = Braintree_CreditCard::update(
				  $cc_token,
				  array(
					'number' => $card_num,
					'expirationDate' => $exp_date
				  )
				);
				if(!$updateResult->success){
					foreach($updateResult->errors->deepAll() AS $error) {
						$msg .= $error->code." : ".$error->message . "</br>"; 
					}				
				}
			}
		}
	
	
	
		if($update_billing_amount){	
			
			$result = Braintree_Subscription::update($braintree_subscription_id, array('price' => $recurring_billing_amount));
	
			if($result->success){
					$sql = "UPDATE profile_account
						SET braintree_recurring_billing_amount = '".$recurring_billing_amount."'
						WHERE id = '".$profile_account_id."'"; 
				$upd_res = mysql_query($sql);
				if(!$upd_res)die(mysql_error());
					
			}else{	
				foreach($result->errors->deepAll() AS $error) {
					$msg .= $error->code." : ".$error->message . "</br>"; 
				}		
			}	
		}
		
			}
	*/


	//echo "<br />e_profile_account_id  ".$e_profile_account_id;
	//echo "<br />domain_name  ".SITEROOT_name;
	

	// we need this
	unset($_SESSION["pages"]);

  	require_once($real_root."/manage/admin-includes/class.htaccess_writer.php"); 
	$htaccess_writer = new HtaccessWriter;
	$htaccess_writer->writeHtaccess();

}



if(isset($_POST['add_account'])){	
	SITEROOT_name = trim(addslashes($_POST['domain_name'])); 
	SITEROOT_name = str_replace('http://','',SITEROOT_name);
	SITEROOT_name = str_replace('https://','',SITEROOT_name);
	SITEROOT_name = str_replace('www.','',SITEROOT_name);
	
	$sql = "SELECT id 
			FROM profile_account
			WHERE domain_name = '".SITEROOT_name."'";
	
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		echo "You already have SITEROOT_name";
		echo "<br /><a href='sas-cust.php'>BACK</a>";
		exit;
	}

	$parent_id = ($_POST["parent_id"] > 0) ? $_POST["parent_id"] : $_SESSION['profile_account_id'];
	$company = trim(addslashes($_POST["company"])); 
	$recurring_billing_id = trim(addslashes($_POST["recurring_billing_id"])); 
	$email = trim(addslashes($_POST["email"])); 
	$contact_email = trim(addslashes($_POST["contact_email"])); 
	$name_first = trim(addslashes($_POST["name_first"])); 
	$name_last = trim(addslashes($_POST["name_last"])); 
	$phone = trim(addslashes($_POST["phone"])); 
	$address = trim(addslashes($_POST["address"])); 
	$city = trim(addslashes($_POST["city"])); 
	$state = trim(addslashes($_POST["state"])); 
	$zip = trim(addslashes($_POST["zip"])); 
	$is_ssl = (isset($_POST["is_ssl"])) ? $_POST["is_ssl"] : 0; 	
	$is_shipping_charges = isset($_POST["is_shipping_charges"]) ? $_POST["is_shipping_charges"] : 1;	
	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 	
	$card_auth_code = isset($_POST["card_auth_code"]) ? trim(addslashes($_POST["card_auth_code"])) : ''; 	
	$card_num = trim(addslashes($_POST["card_num"])); 
	$exp_month = trim($_POST["exp_month"]); 
	$exp_year = trim($_POST["exp_year"]); 
	$recurring_billing_amount = trim(addslashes($_POST["recurring_billing_amount"]));	
	$iframes_allowed = $_POST["iframes_allowed"];	
	$fee_payment_method = $_POST["fee_payment_method"];	$profile_account_type_id = 3;
	
		$sql = sprintf("INSERT INTO profile_account 
				(company
				,profile_account_type_id
				,parent_id
				,domain_name
				,recurring_billing_id
				,email
				,contact_email
				,name_first
				,name_last
				,phone
				,address
				,city
				,state
				,zip
				,is_shipping_charges
				,created
				,billing_name_first
				,billing_name_last
				,iframes_allowed
				,fee_payment_method
				,is_ssl
				)
    			 VALUES('%s', '%u','%u','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%u','%s','%s','%s','%u','%s','%u')", 
				$company
				,$profile_account_type_id
				,$parent_id
				,SITEROOT_name
				,$recurring_billing_id
				,$email
				,$contact_email
				,$name_first
				,$name_last
				,$phone
				,$address
				,$city
				,$state
				,$zip
				,$is_shipping_charges
				,date('Y-m-d H:i:s')
				,$billing_name_first
				,$billing_name_last
				,$iframes_allowed
				,$fee_payment_method
				,$is_ssl
				);	
				
	$result = $dbCustom->getResult($db,$sql);
	
	$new_profile_account_id = $db->insert_id; 
	
	$user_type_id = 7;
	$sql = "SELECT id
			FROM user_type 
			WHERE level = '4'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$lobj = $result->fetch_object();
		$user_type_id = $lobj->id;	
	}
	
	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	
	$password_salt = $aLgn->generateSalt();
	$password_hash = $aLgn->get_hash($admin_password, $password_salt);	
	$sql = sprintf("INSERT INTO user (name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$admin_name, $admin_username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $new_profile_account_id);	
	$result = $dbCustom->getResult($db,$sql);
		
	$t_user_id = $db->insert_id;
	
	$sql = sprintf("INSERT INTO admin_group
					(group_name, profile_account_id)
					VALUES
					('%s', '%u')", 
					"Main", $new_profile_account_id);
	$result = $dbCustom->getResult($db,$sql);	
	$new_group_id = $db->insert_id;
		
	$sql = "SELECT id, section_name 
			FROM admin_section";
	$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
			
		if($row->section_name == "cms" || $row->section_name == "product_catalog"){
			$a_section_level = 3;	
		}else{
			$a_section_level = 2;
		}
						
		if($row->section_name != "master"){
			
			$sql = "INSERT INTO admin_access
					(admin_group_id, admin_section_id, admin_section_level)
					VALUES
					('".$new_group_id."', '".$row->id."', '".$a_section_level."')	";
					
			$res = $dbCustom->getResult($db,$sql);
		}
	}
	
	$sql = "INSERT INTO admin_user_to_admin_group 
				(user_id, admin_group_id)
   			   VALUES('".$t_user_id."','".$new_group_id."')";
	$result = $dbCustom->getResult($db,$sql);
	
	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"]; 
		foreach($module_ids as $value){

			$m_fee = (isset($_POST[$value.'_fee'])) ? $_POST[$value.'_fee'] : 0;

			$sql = "INSERT INTO profile_account_to_module 
					(module_id, profile_account_id, fee)
					VALUES('".$value."','".$new_profile_account_id."', '".$m_fee."' )";
			$result = $dbCustom->getResult($db,$sql);
		}
	}


	// if has design tool, they get design services	
	if($module->hasDesignToolModule($new_profile_account_id)){		
		if(!$module->hasDesignServicesModule($new_profile_account_id)){
			$sql = "INSERT INTO profile_account_to_module 
					(module_id, profile_account_id)
					VALUES('6','".$new_profile_account_id."' )";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}


/*
	if($fee_payment_method == "cc" && strlen($card_num) > 12 && is_numeric($card_num)){
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT *
				FROM braintree_credentials
				WHERE braintree_credentials_id = '1'";
				//WHERE braintree_credentials_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$c_obj = $result->fetch_object();
			$environment = $c_obj->environment;
			$merchant_id = $c_obj->merchant_id;
			$public_key = $c_obj->public_key;
			$private_key = $c_obj->private_key;
		}else{
			$environment = '';
			$merchant_id = "jzy3nhzv2pvdvp78";
			$public_key = "fms727dhnfcnwyb7";
			$private_key = "wqrcz6qgz28kdqtx";
		}
		Braintree_Configuration::environment($environment);
		Braintree_Configuration::merchantId($merchant_id);
		Braintree_Configuration::publicKey($public_key);
		Braintree_Configuration::privateKey($private_key);
		$exp_date = $exp_month."/".$exp_year;
		$undo_customer = 0;
		$result = Braintree_Customer::create(array(
			'id' => $new_profile_account_id,
			'firstName' => $billing_name_first,
			'lastName' => $billing_name_last,
			'company' => $company,
			'creditCard' => array(
				'number' => $card_num,
				'expirationDate' => $exp_date,
				'cvv' => $card_auth_code
			)
		));
		if($result->success) {
			//echo($result->customer->id);
			//echo($result->customer->creditCards[0]->token);
			$token = $result->customer->creditCards[0]->token;
			$db = $dbCustom->getDbConnect(USER_DATABASE);

			$sql = "UPDATE profile_account
					SET braintree_cc_token = '".$token."'
					WHERE id = '".$new_profile_account_id."'"; 
			$result = $dbCustom->getResult($db,$sql);
			

			// set up subscription in braintree			
			if(is_numeric($recurring_billing_amount)){
				$subsc_res = Braintree_Subscription::create(array(
				  'paymentMethodToken' => $token,
				  'planId' => 'nc8b',
				  'price' => $recurring_billing_amount
				));
				
			}else{
				$subsc_res = Braintree_Subscription::create(array(
				  'paymentMethodToken' => $token,
				  'planId' => 'nc8b'
				));				
			}
			if($subsc_res->success){
				//$subscription_id = $subsc_res->subscription->transactions[0]->subscriptionId;
				$subscription_id = $subsc_res->subscription->id;
				//echo $subscription_id;
				//print_r($subsc_res->subscription);
				$sql = "UPDATE profile_account
						SET braintree_subscription_id = '".$subscription_id."'
						,braintree_billing_day_of_month = '".date("d")."'
						,braintree_recurring_billing_amount = '".$recurring_billing_amount."'
						WHERE id = '".$new_profile_account_id."'"; 
				$result = $dbCustom->getResult($db,$sql);
				
			}else{
				foreach($subsc_res->errors->deepAll() AS $error) {
					$msg .= $error->code." : ".$error->message . "</br>"; 
				}
				$undo_customer = 1;
			}
		} else {
			foreach($result->errors->deepAll() AS $error) {
				$msg .= $error->code." : ".$error->message . "</br>"; 
			}
			$undo_customer = 1;
		}
	}else{
		$undo_customer = 1;
		// put this back when live
		//$msg .= "The credit card number is either too short, or not numeric"; 
	}
*/
	
	// remove this when live
	$undo_customer = 0;
	if($undo_customer){
		deleteProfile($new_profile_account_id);	
	}else{
		$progress->newProgressSetup($new_profile_account_id);
		$pages->newProfileSetup($new_profile_account_id);
	}

		
	// set available_pages
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "UPDATE page_seo 
			SET available = '0' 
			WHERE optional = '1' 
			AND profile_account_id = '".$new_profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if(isset($_POST["available_pages"])){
		$available_page_names = $_POST["available_pages"]; 
		foreach($available_page_names as $value){
			$sql = "UPDATE page_seo 
					SET available = '1' 
					WHERE page_name = '".$value."'
					AND profile_account_id = '".$new_profile_account_id."'";
			$result = $dbCustom->getResult($db,$sql);
		}	
	}
	
	$sql = "UPDATE page_seo 
			SET active = '0' 
			WHERE available = '0'";			
	$result = $dbCustom->getResult($db,$sql);

	//Create robot.txt
	$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers";
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/".$new_profile_account_id;
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/robots";
	if (!file_exists($path)) {
		mkdir($path);         
	}
	if(file_exists($path.'/robots.txt')){
		unlink($path.'/robots.txt');		
	}
	$fp = fopen($path.'/robots.txt',"w"); 
	
	fwrite($fp, '# robots.txt for '.SITEROOT.PHP_EOL.PHP_EOL);
	fwrite($fp, 'User-agent: *'.PHP_EOL.PHP_EOL);
	fwrite($fp, '# disallow pages/folders'.PHP_EOL.PHP_EOL);
	fwrite($fp, 'Disallow: /blueimp/'.PHP_EOL);
	fwrite($fp, 'Disallow: /cgi-bin/'.PHP_EOL);
	fwrite($fp, 'Disallow: /closet-organizer/'.PHP_EOL);
	fwrite($fp, 'Disallow: /costco/'.PHP_EOL);
	fwrite($fp, 'Disallow: /css/'.PHP_EOL);
	fwrite($fp, 'Disallow: /flash/'.PHP_EOL);
	fwrite($fp, 'Disallow: /js/'.PHP_EOL);
	fwrite($fp, 'Disallow: /images/'.PHP_EOL);
	fwrite($fp, 'Disallow: /includes/'.PHP_EOL);
	fwrite($fp, 'Disallow: /manage/'.PHP_EOL);
	fwrite($fp, 'Disallow: /temp_uploads/'.PHP_EOL);

	fclose($fp);

	// Add sitemap
	$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers";
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/".$new_profile_account_id;
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/sitemap";
	if (!file_exists($path)) {
		mkdir($path);         
	}

	require_once($real_root."/manage/admin-includes/class.xml.sitemap.generator-modified.php");
	$entries[] = new xml_sitemap_entry('/', '1.0', 'daily');
	$file_ext = '.gz';	
	$file_name = 'sitemap'.$file_ext;
	$conf = new xml_sitemap_generator_config;

	if(substr_count(SITEROOT_name,'.') > 1){	
		$conf->setDomain(SITEROOT_name);				
	}else{
		$conf->setDomain('www.'.SITEROOT_name);		
	}

	$conf->setPath($path);
	$conf->setFilename($file_name);
	$conf->setEntries($entries);			
	$generator = new xml_sitemap_generator($conf);
	$generator->write();	

  	require_once($real_root."/manage/admin-includes/class.htaccess_writer.php"); 
	$htaccess_writer = new HtaccessWriter;
	$htaccess_writer->writeHtaccess();

}

if(isset($_POST["deact_profile_account"])){	

$d_profile_account_id = $_POST["d_profile_account_id"];	
$db = $dbCustom->getDbConnect(USER_DATABASE);	
$sql = sprintf("UPDATE profile_account SET active = '%u' WHERE id = '%u'", '0',$d_profile_account_id);

	$result = $dbCustom->getResult($db,$sql);
		$sql = "SELECT braintree_subscription_id 
			FROM profile_account 
			WHERE id = '".$d_profile_account_id."'
		"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		
		$s_obj = $result->fetch_object();
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT *
				FROM braintree_credentials
				WHERE braintree_credentials_id = '1'";
				//WHERE braintree_credentials_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$c_obj = $result->fetch_object();
			$environment = $c_obj->environment;
			$merchant_id = $c_obj->merchant_id;
			$public_key = $c_obj->public_key;
			$private_key = $c_obj->private_key;
		}else{
	
			$environment = '';
			$merchant_id = "jzy3nhzv2pvdvp78";
			$public_key = "fms727dhnfcnwyb7";
			$private_key = "wqrcz6qgz28kdqtx";
				
		}
		Braintree_Configuration::environment($environment);
		Braintree_Configuration::merchantId($merchant_id);
		Braintree_Configuration::publicKey($public_key);
		Braintree_Configuration::privateKey($private_key);
		
		$cancelResult = Braintree_Subscription::cancel($s_obj->braintree_subscription_id);
		
		if(!$cancelResult->success){				
			foreach($cancelResult->errors->deepAll() AS $error) {
				$msg .= $error->code." : ".$error->message . "</br>"; 
			}
		}	
	}

  	require_once($real_root."/manage/admin-includes/class.htaccess_writer.php"); 
	$htaccess_writer = new HtaccessWriter;
	$htaccess_writer->writeHtaccess();

}


if(isset($_POST["del_profile_account"])){
	$d_profile_account_id = $_POST["d_profile_account_id"];

	$db = $dbCustom->getDbConnect(USER_DATABASE);

	if($d_profile_account_id > 1){

	
	/*
$sql = "SELECT braintree_subscription_id 
			FROM profile_account 
			WHERE id = '".$profile_account_id."'
		"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		
		$s_obj = $result->fetch_object();
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT *
				FROM braintree_credentials
				WHERE braintree_credentials_id = '1'";
				//WHERE braintree_credentials_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$c_obj = $result->fetch_object();
			$environment = $c_obj->environment;
			$merchant_id = $c_obj->merchant_id;
			$public_key = $c_obj->public_key;
			$private_key = $c_obj->private_key;
		}else{
	
			$environment = '';
			$merchant_id = "jzy3nhzv2pvdvp78";
			$public_key = "fms727dhnfcnwyb7";
			$private_key = "wqrcz6qgz28kdqtx";
				
		}
	
		Braintree_Configuration::environment($environment);
		Braintree_Configuration::merchantId($merchant_id);
		Braintree_Configuration::publicKey($public_key);
		Braintree_Configuration::privateKey($private_key);
		
		$cancelResult = Braintree_Subscription::cancel($s_obj->braintree_subscription_id);
		
		if(!$cancelResult->success){				
			foreach($cancelResult->errors->deepAll() AS $error) {
				$msg .= $error->code." : ".$error->message . "</br>"; 
			}
		}	}
	*/
		if(deleteProfile($d_profile_account_id)){
			$pages->undoProfileSetup($d_profile_account_id);
		
		}
	
		$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers"."/".$d_profile_account_id."/sitemap";	
		$files = glob($path."/*"); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) unlink($file); // delete file			
		}
		if(file_exists($path)){		
			rmdir($path);
		}	
		$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers"."/".$d_profile_account_id."/robots";	
		$files = glob($path."/*"); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) unlink($file); // delete file			
		}
		if(file_exists($path)){		
			rmdir($path);
		}
		
		$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers"."/".$d_profile_account_id;
		$files = glob($path."/*"); // get all file names
		foreach($files as $file){ // iterate files
			if(is_file($file)) unlink($file); // delete file			
		}
					
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/saas-customers"."/".$d_profile_account_id)){		
			rmdir($_SERVER['DOCUMENT_ROOT']."/saas-customers"."/".$d_profile_account_id);
		}	
		
		require_once($real_root."/manage/admin-includes/class.htaccess_writer.php"); 
		$htaccess_writer = new HtaccessWriter;
		$htaccess_writer->writeHtaccess();
	
	}

}
if(isset($_POST['unlock'])){
	//$profile_account_id = $_POST['profile_account_id'];
	$super_admin_user_id = $_POST['super_admin_user_id'];
	$aLgn->unlock('', '', $super_admin_user_id);
}

if(isset($_POST['pay'])){
	
	$profile_account_id = $_POST['profile_account_id"'];
	$billing_name_first = trim(addslashes($_POST['billing_name_first'])); 
	$billing_name_last = trim(addslashes($_POST['billing_name_last'])); 
	
	$msg = 'Cust payment hasn\'t been developed';	
}

if(isset($_POST['update_fees'])){
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			,name
			,fee
			FROM  module";	
	$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()) {
		$fee = (isset($_POST[$row->id])) ? $_POST[$row->id] : 0;
	
		$sql = "UPDATE module id
				SET fee = '".$fee."'
				WHERE id = '".$row->id."'
				";	
		$res = $dbCustom->getResult($db,$sql);	
		
	}
}

if(isset($_GET['write_htaccess'])){
	require_once($real_root."/manage/admin-includes/class.htaccess_writer.php"); 
	$htaccess_writer = new HtaccessWriter;
	$htaccess_writer->writeHtaccess();
}

unset($_SESSION['paging']);

//$pages->undoProfileSetup(0);
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function() {
	
	/*
	
	$(".inline").click(function(){ 
		if(this.href.indexOf("deactivate") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#deact_profile_account_id").val(f_id);
			
		}
		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			
			
			$("#del_profile_account_id").val(f_id);
			
		}
	});
	*/
	
	
	$("a.inline").fancybox();
});

</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
			 
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT id
				,company
				,domain_name
				,active
				FROM  profile_account";
		$nmx_res = $dbCustom->getResult($db,$sql);

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
			
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
			
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		if($sortby != ''){
			if($sortby == 'active'){
				if($a_d == 'd'){
					$sql .= " ORDER BY active DESC".$limit;
				}else{
					$sql .= " ORDER BY active".$limit;		
				}
			}
			if($sortby == 'domain_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY domain_name DESC".$limit;
				}else{
					$sql .= " ORDER BY domain_name".$limit;		
				}
			}
			if($sortby == 'id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY id DESC".$limit;
				}else{
					$sql .= " ORDER BY id".$limit;		
				}
			}

		}else{
			$sql .= " ORDER BY id".$limit;
		}
			
	$result = $dbCustom->getResult($db,$sql);		

	if($admin_access->master_level > 1){
	?>
		<div class="page_actions"> 
        <a class="btn btn-large btn-primary" href="add-sas-cust.php?ret_page=sas-cust"><i class="icon-plus icon-white"></i> Add New Profile </a> 
        <a class="btn btn-large btn-primary" href="sas-cust.php?write_htaccess=1"><i class="icon-plus icon-white"></i> Re-write htaccess </a>
        </div>
		<div class="accordion">
			<h2><a href="#fees" class="accordion-label"><i class='icon-plus-sign icon-white right'></i>Fees</a></h2>
			<div class="accordion-content" id="fees">
            
            <?php
			$url_str = 'sas-cust.php';
			$url_str .= '?pagenum='.$pagenum;
			$url_str .= '&sortby='.$sortby;
			$url_str .= '&a_d='.$a_d;
			$url_str .= '&truncate='.$truncate;
			
			?>
            
            
				<form name="update_fees_form" action="<?php echo $url_str; ?>" method="post">
					<h3>Enter the fee for each add-on.</h3>
					<fieldset>
						<?php
						$db = $dbCustom->getDbConnect(USER_DATABASE);
						$sql = "SELECT id
								,name
								,fee
								FROM  module";
						$res = $dbCustom->getResult($db,$sql);		
						$block = '';
						while($fee_row = $res->fetch_object()) {
							$block .= "<div class='colcontainer formcols'>";
							$block .= "<div class='twocols'><label>";
							$block .= $fee_row->name;
							$block .= "</label></div>";
							$block .= "<div class='twocols'>";
							$block .= "<span class='prepend-input'>$</span><input type='text' name='".$fee_row->id."' class='prepended' value='".$fee_row->fee."'> ";
							$block .= "</div>";
							$block .= "</div>";
						}
						echo $block;
					?>
					</fieldset>
					<button type="submit" name="update_fees" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Update Fees </button>
				</form>
			</div>
			<h2><a href="#customers" class="accordion-label"><i class='icon-minus-sign icon-white right'></i>Customers</a></h2>
			<div class="accordion-content accordion-visible" id="customers">
				<?php
	}

		if($total_rows > $rows_per_page){
            echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "master-admin/sas-cust.php", $sortby, $a_d);
			echo "<br /><br /><br />";
		}

		$url_str = "sas-cust.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		?>
				<div class="data_table">
					<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
					<table border="0" cellpadding="10">
						<thead>
							<tr>
								<th width="5%" <?php addSortAttr('active',true); ?>> Active <i <?php addSortAttr('active',false); ?>></i> </th>
								<th width="30%" align="center" <?php addSortAttr('domain_name',true); ?>> Domain <i <?php addSortAttr('domain_name',false); ?>></i> </th>
								<th width="5%" <?php addSortAttr('id',true); ?>> Acct ID <i <?php addSortAttr('id',false); ?>></i> </th>
								<th width="30%" align="center">Child Domains</th>
								<th width="10%">Processor</th>
								<th width="5%">Charge</th>
								<th width="5%">Edit</th>
								<th width="5%">Disable</th>
								<th width="5%">Delete</th>
							</tr>
						</thead>
						<?php
			
	
			$block = '';
			while($row = $result->fetch_object()) {	
				$block .= "<tr>";
				//active
				if($row->active){
					$is_active = "active";	
				}else{
					$is_active = "dead";	
				}	
				$block .= "<td valign='middle'>".$is_active."</td>";
				//Domain Name
				$block .= "<td><span class='restrict-width'>".$row->domain_name."</span></td>";
				//Account ID
				$block .= "<td>".$row->id."</td>";
				//Children Domains
				$block .= "<td><span class='restrict-width'>";
				
				$children_array = getChildProfiles($row->id);
				if(sizeof($children_array) > 0){				
					foreach($children_array as $value) {
						$block .= $value['domain_name']."<br />";
					}
				}else{
					$block .= "None";		
				}	
				$block .= "</span></td>";
				//processor
				$block .= "<td><a href='sas-payment-processor.php?profile_account_id=".$row->id."'>Processor</a></td>";
				
				//Charge
				$block .= "<td><a class='btn btn-small' href='sas-cust-payment.php?profile_account_id=".$row->id."'><strong>$</strong></a></td>";
				//Edit
				
				$url_str = "edit-sas-cust.php";
				$url_str .= "?e_profile_account_id=".$row->id;
				$url_str .= "&pagenum=".$pagenum;
				$url_str .= "&sortby=".$sortby;
				$url_str .= "&a_d=".$a_d;
				$url_str .= "&truncate=".$truncate;

				$block .= "<td><a class='btn btn-small btn-primary' href='".$url_str."' title='Edit'><i class='icon-cog icon-white'></i></a></td>";
				//Deactivate
					$block .= "<td valign='middle'>
					<a class='btn btn-warning confirm confirm-deactivate'>
					<i class='icon-off icon-white'></i>
					<input type='hidden' id='".$row->id."' class='itemId' value='".$row->id."' /></a></td>";
				//delete
				if($row->id > 1){
					//Delete
					$block .= "<td valign='middle'>
					<a class='btn btn-danger confirm '>
					<i class='icon-remove icon-white'></i>
					<input type='hidden' id='".$row->id."' class='itemId' value='".$row->id."' /></a></td>";
				}else{
					$block .= "<td></td>";
				}
				//Super Admin
				$super_admin_user_id = $aLgn->getSuperAdminId($row->id); 
					//echo $super_admin_user_id;	
					//echo $row->profile_account_id;
					//echo "<br />";
					//echo $aLgn->isLocked($row->profile_account_id, '', $super_admin_user_id);
				if($aLgn->isLocked($row->id, '', $super_admin_user_id)){ 
					$block .= "<td><form action='sas-cust.php' method='post'>";
					$block .= "<input type='hidden' name='super_admin_user_id' value='".$super_admin_user_id."' />";
					//$block .= "<input type='hidden' name='profile_account_id' value='".$row->profile_account_id."' />";
					$block .= "<button type='submit' name='unlock' class='btn btn-small'><i class='icon-lock'></i></button>";
					$block .= "</form></td>";
				}
				$block .= "</tr>";
		}
		echo $block;
		?>
					</table>
					<?php 
		if($total_rows > $rows_per_page){
            echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "master-admin/sas-cust.php", $sortby, $a_d);
		}
		?>
				</div>
			</div>
		</div>
	</div>
	<p class="clear"></p>
	<?php

require_once($real_root.'/manage/admin-includes/manage-footer.php');

$url_str = "sas-cust.php";
$url_str .= "?pagenum=".$pagenum;
$url_str .= "&sortby=".$sortby;
$url_str .= "&a_d=".$a_d;
$url_str .= "&truncate=".$truncate;

?>
</div>
<!-- New Delete Confirmation Dialogue -->
<div id="content-deactivate" class="confirm-content">
	<h3>Are you sure you want to deactivate this account?</h3>
		<form name="deact_sas_cust_form" action="<?php echo $url_str; ?>" method="post">
			<input class="itemId" type="hidden" name="d_profile_account_id" />
			<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="deact_profile_account" type="submit" >Yes, Deactivate</button>
	</form>
</div>
<!-- New Delete Confirmation Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to <em>PERMANENTLY</em> delete this account?</h3>
	<p>There will be <em>NO WAY</em> to get it back if it is deleted.</p>
	<form name="del_sas_cust_form" action="<?php echo $url_str; ?>" method="post">
		<input class="itemId" type="hidden" name="d_profile_account_id" />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_profile_account" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>
