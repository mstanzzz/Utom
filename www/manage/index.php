<?php
require_once("../includes/config.php");
//require_once('./admin-includes/manage-includes.php');

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

//echo "profile_company".$_SESSION['profile_company'];

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