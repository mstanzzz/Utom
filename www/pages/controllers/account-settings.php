<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');

$acc = new CustomerAccount;

if(!$lgn->isLogedIn()){
	require_once($_SERVER['DOCUMENT_ROOT'].'/pages/resources/signin-form.php');
}

$customer_id = $lgn->getCustId();	

$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : '';
	
if(isset($_POST['update_address'])){
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/update-address-include.php");
}

$acc = new CustomerAccount();
$acc->setDbAccData($customer_id);
	
?>
