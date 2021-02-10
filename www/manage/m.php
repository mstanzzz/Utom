<?php




require_once('../includes/config.php');
require_once('../admin-includes/class.customer_login.php');


$user = 'mark.e.stanz@gmail.com';
$password = 'toroman';


$lgn = new CustomerLogin;

$salt = $lgn->generateSalt();


$hash = $lgn->get_hash($password, $salt);


echo $salt;
echo "<br />";
echo $hash;
echo "<br />";
//$ret = $lgn->login($user,$password);

if($lgn->login($user,$password)){
	echo 'y';	
}else{
	echo 'n';
}


exit;

$message = "TEST";

$to  = $sas_profile_email;	
		$subject_c = "Test";			
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: help@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Return-path: help@closetstogo.com";	
		//$headers .= "\r\n";
		//$headers .= "CC: mark.stanz@gmail.com";		
		//$headers .= "\r\n";
		//$headers .= "Bcc: mike@closetstogo.com";
		//$to = "services@closetstogo.com";
		$to = "mark.stanz@gmail.com";
		
		//if(!mail($to, $subject_c, $message, $headers)){
		
			echo "Failed";
		
		//}

//exit;

//$pdo = new PDO("mysql:host=localhost;dbname=database", 'username', 'password');

// now

exit;

/*
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}


define("DB_HOST", "localhost");
	define("DB_USERNAME", "onlinecl");
	define("DB_PSWD", "J.kt]m9CW@k[");
	
	

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PSWD, 'onlinecl_SITE');
			if($db->connect_errno > 0){
				die('Unable to connect to database [' . $db->connect_error . ']');
			}



phpinfo();


*/

?>