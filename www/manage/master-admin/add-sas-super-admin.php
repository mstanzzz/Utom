<?php

echo "Not Currently Used";
exit;


require_once("../../includes/config.php"); 
require_once("../../includes/class.admin_login.php");
require_once("../../admin-includes/class.admin_bread_crumb.php");	
require_once("../admin-includes/tool-tip.php"); 
require_once("../admin-includes/class.backup.php"); 

$page_title = "Add SAS Super Admin";
$page_group = "admin";

require_once("includes/set-page.php");	

$msg = '';

$db = $dbCustom->getDbConnect(USER_DATABASE);

if(isset($_POST['add_sas_super_admin_user'])){

	$name = trim(addslashes($_POST['name'])); 
	$username = trim(addslashes($_POST["username"])); 
	$password = trim(addslashes($_POST["password"])); 
	$user_type_id  = 3;
	
	$profile_account_id = $_POST['profile_account_id'];

	$password_salt = $aLgn->generateSalt();
	$password_hash = $aLgn->get_hash($password, $password_salt);
/*
echo "<br />name:".$name;
echo "<br />username:".$username;
echo "<br />password:".$password;
echo "<br />user_type_id:".$user_type_id;
echo "<br />password_salt:".$password_salt;
echo "<br />password_hash:".$password_hash;
*/
//exit;
	$sql = sprintf("INSERT INTO user (name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$name, $username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $profile_account_id);

	$result = $dbCustom->getResult($db,$sql);
		
	
	$msg = "Added";

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/mce.css" />

<script type="text/javascript" src="<?php echo $ste_root; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/tiny_mce/tiny_mce.js"></script>


<script>

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});

function show_msg(msg){
	alert(msg);
}

</script>

<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("../admin-includes/manage-header.php");
	require_once("../admin-includes/manage-top-nav.php");
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">

	<div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div> 
</div>


<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("includes/manage-side-nav.php");
        ?>
    </div>	


	<div class="top_link">
       	<a href=''></a>
    </div>

	<div class="manage_main">
	
    
        <form name="add_sas_super_admin_form" action="add-sas-super-admin.php " method="post">
        	
		<table border="0" cellpadding="8">
	    <tr>
        	<td><div class="head">sas profile account</div></td>
	        <td>
            	<select name="profile_account_id">
                	<option value="0">--- select ---</option>
                	<?php
                		$sql = "SELECT id
						,domain_name
						FROM  profile_account  
						ORDER BY id";
						$db = $dbCustom->getDbConnect(USER_DATABASE);		
				$result = $dbCustom->getResult($db,$sql);						
						while($row = $result->fetch_object()) {
							echo "<option value='".$row->id."'>".$row->domain_name."</option>";						
						}
					?>
                </select>
            
            </td>
        </tr> 
        <tr>
        	<td><div class="head">name</div></td>
	        <td><input type="text" name="name"  maxlength="160" size="30" /></td>
        </tr> 
        
        <tr>
        	<td><div class="head">user name</div></td>
	        <td><input type="text" name="username"  maxlength="160" size="30" /></td>
        </tr> 

        <tr>
        	<td><div class="head">password</div></td>
	        <td><input type="text" name="password"  maxlength="160" size="30" /></td>
        </tr> 
        
        <tr>
        <td colspan="2">
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="add_sas_super_admin_user" type="submit" value="Submit" />
        </div>
        <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onclick="location.href = 'sas-cust.php'; " />
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



