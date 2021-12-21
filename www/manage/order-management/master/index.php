<?php
$_SESSION['admin_logged_in'] = 0; 
require_once("<?php echo SITEROOT; ?>includes/config.php"); 

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>

<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

</head>

<body>


<br />



<div align="center">
<a href="../">EXIT</a>
<br /><br /><br />
<div style="font-size:16px; color:#3f6e84;">
	Login For Content Management System Closets to Go 
    <?php echo "<span style='font-size:14px'>".$add_to_title."</span>"; ?>
</div>


<br />
<div style="font-size:14px; color:#3f6e84;">
<?php
$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : '';
echo $msg;  
?>
</div>                    
<br />
<!--
<div style="width:300px;">
<fieldset style="padding:10px;">
<form action="admin-login.php" method="post">
<br />
<div style="color:#666666;">User Name</div>
<input type="text" name="user_name" style="width:206px;" value="user" />
<br />
<div style="color:#666666;">Password</div>
<input type="password" name="password" style="width:206px;" value="user" />
<br /><br />
<input type="submit" value="Submit" />
<br /><br />
</form>				
</fieldset>
</div>
-->
<br /><br />

<div style="width:300px;">
<fieldset style="padding:10px;">
<form action="../admin-login.php" method="post">
<br />
<div style="color:#666666;">User Name</div>
<input type="text" name="user_name" style="width:206px;" value="admin" />
<br />
<div style="color:#666666;">Password</div>
<input type="password" name="password" style="width:206px;" value="admin" />
<br /><br />
<input type="submit" value="Submit" />
<br /><br />
</form>				
</fieldset>
</div>

</div>


<br /><br />






</body>
</html>
