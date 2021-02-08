<?php
/* MS */

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_login.php');

$lgn = new CustomerLogin;

if(isset($_POST['username'])){

	$username = trim($_POST['username']);
	$password = trim($_POST['password']); 
	
	$name = trim($_POST['name']);
	$get_news_letter = $_POST["get_news_letter"];

	$user_id = $lgn->getUserIDFromEmail($username);
	
	if($user_id > 0){		
		$header_str =  "Location: ".$_SERVER['DOCUMENT_ROOT']."/signup-email-used.html";
		header($header_str);		
	}else{
		
		if($lgn->create_user($password, $username, $name)){			
			$header_str =  "Location: ".$_SERVER['DOCUMENT_ROOT']."/signup-confirm.html";		
			header($header_str);
		}
	}

	echo 'There was a problem. Please try again.';
	
}
?>