<?php
$_SESSION['admin_logged_in'] = 0; 
require_once("../../includes/config.php"); 

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

require_once("../admin-includes/doc_header.php"); 


?>

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
