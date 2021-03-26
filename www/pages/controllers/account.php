<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.order.php');
$order = new Order;

echo "cust_id: ".$cust_id;
echo "<br />";

$cust_name = $lgn->getFullName($cust_id);

if($cust_name == '') $cust_name = "Example Cust Name";

echo "cust_name: ".$cust_name;


//print_r($_POST);


//exit;

//$acc = new CustomerAccount;


//if(!$lgn->isLogedIn()){
	//require_once($_SERVER['DOCUMENT_ROOT'].'/pages/resources/signin-form.php');
//}

//$customer_id = $lgn->getCustId();
//$acc->setDbAccData($customer_id);
		


?>

