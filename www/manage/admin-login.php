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

require_once($real_root.'/includes/config.php');
require_once($real_root.'/manage/admin-includes/manage-includes.php');


$user_name = (isset($_POST["user_name"])) ? trim(addslashes($_POST["user_name"])) : '';
$password = (isset($_POST["password"])) ? trim(addslashes($_POST["password"])) : '';
$aLgn = new AdminLogin;

/*
if(!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0; 
$hours_to_lock = 24; 
$aLgn->unlockIfTime($_SESSION['profile_account_id'], $user_name);
if($aLgn->isLocked($_SESSION['profile_account_id'], $user_name)){
	//$aLgn->redirect("manage/index.php","This account is locked until ".date("m/d/Y g:ia  T",$aLgn->getTimeUnlock($_SESSION['profile_account_id'], $user_name)));			
	$header_str =  "Location: ".SITEROOT."/manage/index.php?il=1";
	header($header_str);			
}
*/


if($aLgn->login($dbCustom,$user_name,$password)){		
	$header_str =  "Location: start.php";
	header($header_str);
}else{
	$_SESSION["login_attempts"]++;
	if($_SESSION["login_attempts"] > 10){
		
		$aLgn->lock($_SESSION['profile_account_id'],$user_name, $hours_to_lock);
		$header_str =  "Location: index.php?l=1";
		header($header_str);			
	}

	$header_str =  "Location: index.php?w=1";
	header($header_str);			

}

?>
