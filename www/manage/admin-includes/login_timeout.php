<?php


// lgn is initiated in manage-includes.php


if(!$aLgn->isLogedIn()){
	
	
	$_SESSION['user_id'] = 0;
	
	unset($_SESSION['admin_access']);
	$aLgn->logOut();
	
	
	if((strpos($_SERVER['REQUEST_URI'], "admin-login.php" ) === false)&&(strpos($_SERVER['REQUEST_URI'], "index.php" ) === false)){
		
		$header_str =  "Location: ".$ste_root."manage/index.php?nl";
		header($header_str);	

	}
}


?>