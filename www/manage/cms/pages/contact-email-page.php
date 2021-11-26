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


$page_title = "Email Us";
$page_group = "contact-email-page";
$page = "contact-email-page";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$ts = time();
// add if not exist
$sql = "SELECT contact_email_page_id FROM contact_email_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO contact_email_page 
		(content1, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST["edit_contact_email_page"])){
	
	$content1 = trim(addslashes($_POST["content1"])); 
	$content2 = trim(addslashes($_POST["content2"])); 
	$contact_email_page_id = $_POST["contact_email_page_id"];
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$meta_title = trim(addslashes($_POST["meta_title"]));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST["page_heading"]));

	$ts = time();
	//if(in_array(2,$user_functions_array)){
		// create a backup
		//include("includes/class.backup.php");
		//$backup = new Backup;
		
		//echo $contact_email_page_id; exit;
		
		//$dbu = $backup->doBackup($contact_email_page_id,$user_id,"contact_email_page");	

		$sql = sprintf("UPDATE contact_email_page SET content1 = '%s', content2 = '%s' WHERE contact_email_page_id = '%u'", 
		$content1, $content2, $contact_email_page_id);

		$msg = "Your change is now live.";

	//}else{
		/*
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content2, content_record_id) 
		VALUES ('%s','%u','%u','%s','%s','%s','%u')", 
		"contact_email_page", $ts, $user_id, "email-us", $content1, $content2, $contact_email_page_id);
		*/
		//$msg = "Your change is now pending approval.";
		
	//}

	$result = $dbCustom->getResult($db,$sql);
	

	require_once($real_root."/manage/cms/insert_page_seo.php");

	require_once($real_root."/manage/cms/insert_page_breadcrumb.php");

}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

<script>
$(document).ready(function() {
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});

});


function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}


function previewSubmit() {
  document.form.action = '<?php echo SITEROOT; ?>pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self'; 
  document.form.submit(); 
}	
</script>
</head>


	<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');

?>



<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

    <div class="manage_main">
	<?php 
	$contact_email_page_id = (isset($_REQUEST['contact_email_page_id'])) ? $_REQUEST['contact_email_page_id'] : 0;
 	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT content1, content2 
    FROM contact_email_page";
    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content1 = $object->content1;
		$content2 = $object->content2;
	}else{
		$content1 = '';
		$content2 = '';
	}
	
	require_once($real_root."/manage/cms/get_seo_variables.php");

        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
        
?>


<form name="set_ssl" action="contact-email-page.php" method="post">
	<input type="hidden" name="page_name" value="email-us" />	
	<input type="hidden" name="set_ssl" value="1" />
    <input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="ret_page" value="contact-email-page">
	<input type="hidden" name="ret_dir" value="manage/cms/pages">
	<input type="hidden" name="content_table" value="contact_email_page"> 
    
    
    	

	<?php if($_SESSION['is_ssl']){ 
		 	$sql = "SELECT mssl
		 		FROM page_seo
				WHERE page_name = 'email-us'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
 			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				$mssl_obj = $result->fetch_object();
				$mssl = $mssl_obj->mssl;
			}else{
				
				$mssl = 0;
			}
			
		 ?>        
         <div style="float:right; width:60px;">
         	<input onClick="msslSubmit()" type="checkbox" name="mssl"  <?php if($mssl) echo "checked"; ?>/>
         </div>
         <div style="float:right; padding-right:10px; color:#5A7F8F;">
         	Set page as SSL
         </div>
         <div class="clear"></div>  
         
                  
	<?php } ?>
</form>

<br />


    <div class="edit" style="float:right; padding-right:30px;">
    <?php echo "<a href='edit-contact-email-page.php?contact_email_page_id=".$p_id."&ret_page=contact-email-page' style='color:#3f6e84;'>Edit Page</a>"; ?>
    </div>
    <div class="clear"></div>
    <fieldset>
    <legend>Page Content Top</legend>
        <div style="padding:20px;">
        <?php echo stripslashes($object->content1); ?>
        </div>
    </fieldset>
    <br />	
    <fieldset>
    <legend>Page Content Bottom</legend>
        <div style="padding:20px;">
        <?php echo stripslashes($object->content2); ?>
        </div>
    </fieldset>


<br />


	        <?php require_once("edit_page_seo.php"); ?>
    	    <?php require_once($real_root."/manage/cms/edit_page_breadcrumb.php"); ?>


	
</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
    </div>

    <div style="display:none">
        <div id="edt_page" style="width:860px; height:360px;">
        </div>
    </div>

    <div style="display:none">
        <div id="edit" style="width:660px; height:660px;">
        </div>
    </div>
    
    
        <div style="display:none">
        <div id="delete" style="width:250px; height:100px;">
        	<br />
            Are you sure you want to delete this bread crumb?
            <form name="del_bc" action="edit-contact-email-page.php" method="post">
                <input id="del_bc_id" type="hidden" name="del_bc_id" />
                <input name="del_bc" type="submit" value="DELETE" />
            </form>
        
        
        </div>
    </div>

    
    
    
</body>
</html>


