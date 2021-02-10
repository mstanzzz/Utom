<?php
require_once("../../includes/config.php"); 
require_once("../../includes/class.admin_login.php");
require_once("../../admin-includes/class.admin_bread_crumb.php");	

require_once("../admin-includes/tool-tip.php"); 
require_once("../admin-includes/class.backup.php"); 
require_once("../admin-includes/class.pages.php"); 

require_once("../admin-includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../../admin-includes/class.module.php");	
$module = new Module;

$pages = new Pages;
 
$msg = '';
$page_title = 'Edit Top Admin Login';
$page_group = 'admin';

require_once('../admin-includes/set-page.php');	

if(isset($_POST['edit_login'])){
		
	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	
	$user_type_id = 7;
	
	if($admin_password != ''){
		$update_pwd = 1;
		$password_salt = $aLgn->generateSalt();
		$password_hash = $aLgn->get_hash($admin_password, $password_salt);
	}else{
		$update_pwd = 0;
	}

	$db = $dbCustom->getDbConnect(USER_DATABASE);
	
	$sql = "SELECT id 
			FROM user 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND user_type_id = '".$user_type_id."'"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		
		$id_obj = $result->fetch_object();
		$t_user_id = $id_obj->id; 
		
		$sql = sprintf("UPDATE user 
					SET name = '%s'
					,username = '%s'
					,visited = '%s'
					WHERE id = '%u'
					", 
					$admin_name
					,$admin_username
					,date('Y-m-d H:i:s')
					,$t_user_id
					);
		$res = $dbCustom->getResult($db,$sql);
					
		if($update_pwd){		
			$sql = "UPDATE user 
					SET 
					password_hash = '".$password_hash."' 
					,password_salt = '".$password_salt."'
					WHERE id = '".$t_user_id."'
					";
			$res = $dbCustom->getResult($db,$sql);			
		}		
	}
	
	$progress->addStep("password" ,$_SESSION['profile_account_id']);
	
	header('Location: start.php');
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/mce.css" />

<script type="text/javascript" src="<?php echo $ste_root; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/tiny_mce/tiny_mce.js"></script>

<script>
$(document).ready(function() {
	
});

function show_msg(msg){
	alert(msg);
}

</script>
</head>


<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("../admin-includes/manage-header.php");
	require_once("../admin-includes/manage-top-nav.php");

?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("../admin-includes/manage-side-nav.php");
        ?>
    </div>	
 
    <div class="manage_main">
<?php 
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
         
	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$sql = "SELECT name, username 
			FROM user 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND user_type_id = '7'"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		$u_obj = $result->fetch_object();	
		$admin_name = $u_obj->name;
		$admin_username = $u_obj->username;
	}else{
		$admin_name = '';
		$admin_username = '';	
	}

?>        
        
        
      <br /><br />  
        
        
	<form name="edit_admin-password_form" action="set-admin-password.php " method="post" onsubmit="return validate(this)">     
    <table cellpadding="10">    
        <tr>
        	<td><div class="head">Administrator name</div></td>
	        <td><input type="text" name="admin_name"  maxlength="160" size="30" value="<?php echo $admin_name;  ?>"/></td>
        </tr> 

        <tr>
        	<td><div class="head">Administrator username</div></td>
	        <td><input type="text" name="admin_username"  maxlength="160" size="30" value="<?php echo $admin_username;  ?>"/></td>
        </tr>

        <tr>
        	<td><div class="head">Administrator password</div>
            <div style="font-size:12px">Leave blank unless you want it changed</div></td>
	        <td><input type="text" name="admin_password"  maxlength="160" size="30" value=''/></td>
        </tr>
    
    
     <td colspan="2">
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="edit_login" type="submit" value="Save" />
        </div>
       
        </td>
        </tr>
        
	</table>

</form>


</div>
<p class="clear"></p>
<?php 
require_once("../admin-includes/manage-footer.php");
?>       

</div>
    
        
</body>
</html>



