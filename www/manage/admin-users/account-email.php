<?php
/*
	Use: 
		Closets To Go CMS 
		List all closet systems
	Called from 
	Variables:
		
*/
require_once("<?php echo SITEROOT; ?>includes/config.php"); 
require_once("<?php echo SITEROOT; ?>includes/class.admin_login.php");
$aLgn = new AdminLogin;
if(!$aLgn->isLogedIn()){
	$aLgn->redirect("index.php", "Please Log In");	
}
$user_level = $aLgn->getUserLevel();
$user_id = $aLgn->getUserId();

$db = $dbCustom->getDbConnect(USER_DATABASE);

$page = "closets";

if(isset($_POST["del_email"])){
		
		$email_id = $_POST["del_email_id"];
		
		$sql = sprintf("DELETE FROM user_email WHERE id = '%u'", $email_id);
		$result = $dbCustom->getResult($db,$sql);

}

if(isset($_POST["send_responce"])){

		$subject = trim(addslashes($_POST["subject"])); 
		$c_body = trim(addslashes($_POST["c_body"])); 
		$email_id = trim(addslashes($_POST["email_id"])); 
		
		
		
		//YYYY-MM-DD HH:MM:SS
		$db_now = date("Y-m-d h:i:s");

		$sql = sprintf("INSERT INTO user_email
					   (subject 
						,body
						,date_sent
						,admin_user_id
						,profile_account_id 
						) 
				VALUES ('%s','%s','%s','%u','%u')"
					    ,$subject 
						,$c_body 
						,$db_now 
						,$user_id
						,$_SESSION['profile_account_id']
						);
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "SELECT user.name
			,user.username
			FROM user, user_email
			WHERE user.id = user_email.customer_id
			AND user.id = '".$user_id."'";
		
	$result = $dbCustom->getResult($db,$sql);
	
	$obj = $result->fetch_object();	
	
	$to  = $obj->username;
	$headers = "From: ".$aLgn ->getUserName();
	$body = stripslashes($c_body);

	error_reporting(0);
	if(!mail($to, $subject, $body, $headers)){
		// Log
		$fh = fopen("ctglog.txt", "a");
		$stringData = "\n\rFailed Email\n\r";
		$stringData .= date('l jS \of F Y h:i:s A')."\n\r";
		$stringData .= $body;
		$stringData .= "\n\r-----------------------------\n\r\t\t"; 
		fwrite($fh, $stringData);
		fclose($fh);
	}


}


//profile_account_id = '".$_SESSION['profile_account_id']."'
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>


<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>

<script>
$(document).ready(function() {

	$(".inline").click(function(){ 

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_email_id").val(f_id);
			
		}
		
		
	});

	$("a.inline").fancybox();
	
});

</script>
</head>

<body>



<?php 
include("../admin-includes/manage-header.php"); 
include("../admin-includes/manage-nav.php"); 
?>
<div class="page_title_top_spacer"></div>
<div class="page_title">
Users
    <div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div> 
 
</div>

<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">

<table border="0" width="100%" cellpadding="10">
  <tr>
  	<td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="20%"><div class="blue">Name</div></td>
    <td width="20%"><div class="blue">Email Address</div></td>
    <td width="20%"><div class="blue">Subject</div></td>
    <td><div class="blue">Date Sent</div></td>    
   </tr>

<?php 
		
$sql = "SELECT user.name
		,user.username
		,user_email.subject
		,user_email.date_sent
		,user_email.id AS email_id 
		FROM  user, user_email  
		WHERE user.id = user_email.customer_id
		AND profile_account_id = '".$_SESSION['profile_account_id']."'
		";
		

$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {
	
	//echo $row->email_id;
	
	$block = "<tr>";

	$block .= "<td valign='top'><a href='view-account-email.php?email_id=".$row->email_id."&ret_page=account-email'>
		<img src='../images/button_edit.jpg' /></a></td>";

	$block .= "<td valign='top'><a class='inline' href='#delete'>
		<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->email_id."' style='display:none'></div> </a></td>";


	$block .= "<td valign='top'>".$row->name."</td>";
	
	$block .= "<td valign='top'>".$row->username."</td>";

	$block .= "<td valign='top'>".$row->subject."</td>";
	$fdt=date("F j, Y, g:i a", strtotime($row->date_sent));
	$block .= "<td valign='top'>".$fdt."</td>";

	$block .= "</tr>";
	
	echo $block;

	}
?>


</table>



	 <div style="display:none">
        <div id="delete" style="width:380px; height:100px;">    
            Are you sure you want to delete this email?
            <form name="del_email_form" action="account-email.php" method="post">
                <input id="del_email_id" type="hidden" name="del_email_id" />
                <input name="del_email" type="submit" value="DELETE" />
            </form>
        </div>
    </div>
    
   <p class="clear"></p>
<?php 
require_once("../admin-includes/manage-footer.php");
?>       
     
</div>
</body>
</html>



