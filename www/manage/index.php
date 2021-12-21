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

require_once($real_root."/includes/class.dbcustom.php");
require_once($real_root."/includes/config.php");
$dbCustom = new DbCustom();
$db = $dbCustom->getDbConnect(USER_DATABASE);
require_once($real_root."/manage/admin-includes/manage-includes.php");

if(isset($_GET["nl"])){
	$msg = "You have been logged off due to inactivity.";	
}elseif(isset($_GET["lo"])){
	$msg = "You have successfully logged off.";	
}elseif(isset($_GET["il"])){
	$msg = "This account is locked until ".date("m/d/Y g:ia  T",$aLgn->getTimeUnlock($_SESSION['profile_account_id'], $user_name));	
}elseif(isset($_GET["l"])){
	$msg = "This account is locked for $hours_to_lock hours. You have exceded the maximum allowed login attempts.";	
}elseif(isset($_GET["w"])){
	$msg = "The information you entered does not match our records.";	
}else{
	$msg = '';	
}

require_once('./admin-includes/doc_header.php'); 

?>
</head>

<body>
<div class="login_form">
	<div class="manage_head_login">
		<h2><?php echo $_SESSION['profile_company']; ?> Administration Login</h2>
	</div>
	<?php if($msg != ''){ ?>
	<div class="alert alert-success">
		<h4><?php echo $msg; ?></h4>
	</div>
	<?php } else {} ?>
	<form action="admin-login.php" method="post">
		<label>User Name</label>
		<input type="text" name="user_name" style="width:206px;" value='' />
		</td>
		<label>Password</label>
		<input type="password" name="password" style="width:206px;" value='' />
		</td>
		<button class="btn btn-large btn-success" type="submit">Login</button>
	</form>
</div>



</body>
</html>

<!--
45.86.201.101
176.219.193.247
-->