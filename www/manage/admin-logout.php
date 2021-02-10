<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$aLgn = new AdminLogin;
$aLgn->logOut();

unset($_SESSION['breadcrumb']);

unset($_SESSION['login_attempts']);

$header_str =  "Location: ".$ste_root."manage/index.php?lo";
header($header_str);	


?>