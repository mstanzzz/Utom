<?php
if(!isset($real_root)){


if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

}


if(!isset($dbCustom)){
	require_once($real_root.'/includes/class.dbcustom.php');
	$dbCustom = new DbCustom();
}

require_once($real_root."/manage/admin-includes/manage_functions.php");
require_once($real_root."/manage/admin-includes/class.pages.php"); 
require_once($real_root."/manage/admin-includes/class.setup_progress.php");
require_once($real_root."/manage/admin-includes/tool-tip.php"); 
require_once($real_root."/manage/admin-includes/login_timeout.php"); 
require_once($real_root."/includes/class.admin_login.php"); 
require_once($real_root."/manage/admin-includes/class.admin_access.php"); 
require_once($real_root."/includes/class.module.php"); 

$aLgn = new AdminLogin;
$module = new Module;
$admin_access = new AdminAccess($dbCustom);
$profile_type = 7;

if(!$aLgn->isLogedIn()){
	$tt = "";
	header("Location: ".$tt);			
}

if(substr_count($_SERVER['REQUEST_URI'] , 'manage/manage' ) > 0) {
	$find = 'manage/manage';	
	$replace = 'manage';	
	$tt = str_replace($find,$replace,$_SERVER['REQUEST_URI']);
	header("Location: ".$tt);		
}


// remove excess slashes on this url
if(substr_count($_SERVER['REQUEST_URI'] , '//' ) > 0) {	
	$tt = preg_replace('/(\/+)/','/',$_SERVER['REQUEST_URI']);
	header("Location: ".$tt);		
}

?>