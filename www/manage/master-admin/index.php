<?php
$_SESSION['admin_logged_in'] = 0; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
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
