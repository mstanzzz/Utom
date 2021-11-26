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
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();
require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>

<div class="page_title_top_spacer"></div>
<div class="page_title">
Edit Contact Email

</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>



	
<?php 
$contact_email_id = $_GET['contact_email_id']; 
//echo $contact_email_id;
$sql = sprintf("SELECT * 
				FROM contact_email 
				WHERE contact_email_id = '%u'
				AND profile_account_id = '%u'", $contact_email_id, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>


	<div style="padding-left:40px;">
    
        <form name="edit_contact_email" action="contact-email.php" method="post">
       	<input id="contact_email_id" type="hidden" name="contact_email_id" value="<?php echo $contact_email_id;  ?>" />
        	
		<table border="0" cellpadding="8">
        <tr>
        <td align="left" height="40px;">
        <div class="head">Name</div>
        </td>
        <td align="left">
        <?php echo $object->name; ?>
        </td>
        </tr>
        <tr>
        <td align="left" height="40px;">
        <div class="head">Email Address</div>
        </td>
        <td align="left">
        <?php echo $object->email; ?>
        </td>
        </tr>
        <tr>
        <td align="left" height="40px;">
        <div class="head">City State</div>
        </td>
        <td align="left">
        <?php echo $object->city."  ".$object->state; ?>
        </td>
        </tr>
        
        <tr>
        <td align="left" height="40px;">
        <div class="head">Email Body</div>
        </td>
        <td align="left">
       <?php echo $object->content; ?>
        </td>
        </tr>
        <tr>
        <td colspan="2">
           <div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
           		<span class="head">Hide</span> &nbsp;<input type="radio" name="hide" value="1" />
           </div>
           <div style="float:left; padding-right:60px; padding-top:33px;">
           		<span class="head">Show</span> &nbsp;<input type="radio" name="hide" value="0" />
           </div>
        </td>
        </tr>
        <tr>
        <td colspan="2">
            <div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="edit_contact_email" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onclick="location.href = 'contact-email.php'; " />
            </div>
        </td>
        </tr>
        </table>
        </form>

	</div>
</body>
</html>


