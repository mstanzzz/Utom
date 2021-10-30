<?php
require_once($real_root.'/includes/class.customer_account.php');

require_once($real_root.'/includes/class.order.php');
$order = new Order;


$cust_id = $lgn->getCustId();
$cust_name = $lgn->getFullName($dbCustom,$cust_id);

$acc = new CustomerAccount();

$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : '';
	

if(isset($_POST['update_address'])){
	require_once($real_root."/includes/update-address-include.php");
}


if(isset($_POST["new_password"])){	

	$current_password = (isset($_POST['current_password']))? trim(addslashes($_POST['current_password'])) : ''; 
	$new_password = (isset($_POST['new_password']))? trim(addslashes($_POST['new_password'])) : ''; 
	$username = $lgn->getUserName();
	if($lgn->varifyPassword($password_old, $username)){
		
		$lgn->resetPassword($dbCustom,$current_password, $username);				
		
		$headers = "From: services@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Content-type: text/html"; 
		$headers .= "\r\n";	
		$subject = "Your Account at Closets to Go";

	$db = $dbCustom->getDbConnect(SITE_DATABASE);
	$sql = "SELECT *
			FROM company_info
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);			
	if($result->num_rows){
		$company_obj = $result->fetch_object();	
		$company_phone = $company_obj->phone;
		$company_email = $company_obj->contact_email;
		$company_fax = $company_obj->fax;
		$days = $company_obj->days;
		$hours = $company_obj->hours;
		$addr_line1 = $company_obj->addr_line1;
		$addr_line2 = $company_obj->addr_line2;
		$addr_line3 = $company_obj->addr_line3;
		$text_block1 = $company_obj->text_block1;
		$text_block1_head = $company_obj->text_block1_head;	
		$facebook = $company_obj->facebook;	
		$twitter = $company_obj->twitter;	
		$youtube = $company_obj->youtube;
		$pinterest = $company_obj->pinterest;
		$houzz = $company_obj->houzz;	
	}else{
		$company_phone = '';
		$company_fax = '';
		$company_email = '';
		$days = '';
		$hours = '';
		$addr_line1 = '';
		$addr_line2 = '';
		$addr_line3 = '';
		$text_block1 = '';
		$text_block1_head = '';	
		$facebook = '';	
		$twitter = '';	
		$youtube = '';
		$pinterest = '';
		$houzz = '';	
	}
	$message = "
		<h2>Your password has been updated at ".SITEROOT.".</h2>
		<p>If this was not you, or your did not mean to reset your password, please contact us at:<br />
		<strong>Phone:</strong> ".$company_phone."
		<br />
		<strong>Email:</strong> ".$company_email."</p>";	
		
		if(!mail($username, $subject, $message, $headers)){
		}
		$msg = "Your password has been successfully re-set.";	
	}else{
		$msg = "The original password was not recognized with this account";
	}
}




?>
