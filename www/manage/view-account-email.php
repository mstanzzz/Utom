<?php
/*
	Use: 
		Closets To Go CMS 
		Display data from job application for closet installers
	Called from installer-applications.php
	Variables:
		$installer_id -- key to installer_application table
*/
require_once("../includes/config.php"); 
require_once("../admin-includes/db_connect.php");

require_once("includes/class.setup_progress.php"); 
$progress = new SetupProgress;

require_once("../admin-includes/class.module.php");	
$module = new Module;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Account Email</title>
<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

</head>

<body>



<?php include("includes/manage-header.php"); ?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
View Account Email

  	<div class="top_right_link">
  		<a href='account-email.php'>Done</a>
    </div>
</div>

<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">




	
<?php 
	$email_id = $_GET['email_id']; 

	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT * FROM user_email WHERE id = '".$email_id."' ";
$result = $dbCustom->getResult($db,$sql);	
	
	$object = $result->fetch_object();

?>


<table border="0" cellpadding="6" width="100%">
        <tr>
        <td width="20%">Subject</td>
        <td><?php echo $object->Subject; ?></td>
		</tr>        

       <tr>
        <td>Body</td>
        <td><?php echo $object->body; ?></td>
		</tr>        
</table>

<br /><br />
Send Responce

<form action="account-email.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="email_id" value="<?php echo $email_id; ?>" />            
    <br /><br />Subject<br />   
    <input type="text" name="subject" value='' class="form_input" />
    
    <br /><br />Body<br />
    <textarea name="c_body" style="width:800px; height:180px;"></textarea> 
    <br />
    <input type="submit" name="send_responce" value="Send Responce" />
</form>



        
</div>
</body>
</html>


