<?php
require_once("../includes/config.php");
require_once('./admin-includes/manage-includes.php');

//$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "DELETE FROM user
		WHERE user_type_id = '7'
		AND username = 'mark.stanz@gmail.com'";
//$result = $dbCustom->getResult($db,$sql);

/*
	$user_type_id  = 7;
	$name = "admin";
	$user_name = "mark.stanz@gmail.com";
	$password = "nathannn1A@@";
	
	$password_salt = $aLgn->generateSalt();
	$password_hash = $aLgn->get_hash($password, $password_salt);
	
	

	


$_SESSION['profile_account_id'] = 1;



	$sql = sprintf("INSERT INTO user 
					(name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$name, $user_name, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);


*/ 

unset($_SESSION['breadcrumb']);

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