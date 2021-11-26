<?php
require_once('includes/config.php');
require_once('includes/class.customer_login.php');
$lgn = new CustomerLogin;

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

$email = (isset($_GET['email']))? trim($_GET['email']) : '';
$pswd = (isset($_GET['pswd']))? trim($_GET['pswd']) : '';
 
if($lgn->login($dbCustom,$email,$pswd)){
	echo 'y';	
}else{
	echo 'n';
}

?>


