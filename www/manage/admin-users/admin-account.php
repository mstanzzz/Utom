<?php

require_once("<?php echo SITEROOT; ?>includes/config.php"); 
require_once("<?php echo SITEROOT; ?>includes/class.admin_login.php");
$aLgn = new AdminLogin;
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("index.php", "Please Log In");	
}
$user_level = $aLgn->getUserLevel();

$page = "admin_account"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Admin Account</title>
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />
<body>

















</body>
</html>
