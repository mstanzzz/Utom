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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$aLgn = new AdminLogin;
$aLgn->logOut();

unset($_SESSION['breadcrumb']);

unset($_SESSION['login_attempts']);

$header_str =  "Location: ".SITEROOT."/manage/index.php?lo";
header($header_str);	


?>