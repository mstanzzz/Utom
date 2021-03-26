<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');


$progress = new SetupProgress;
$module = new Module;


$page_title = "Email Design";
$page_group = "design";
$page = "email_design";



	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();
// add if not exist
$sql = "SELECT design_email_content_id  
		FROM design_email_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO design_email_content 
		(last_update, profile_account_id) 
		VALUES ('".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


$design_email_content_id = (isset($_GET['design_email_content_id'])) ? $_GET['design_email_content_id'] : 0;


$msg = '';

if(isset($_POST["add_option"])){

	$name = addslashes($_POST['name']); 
	
		$sql = sprintf("INSERT INTO design_email_source (name, profile_account_id) VALUES ('%s','%u')", $name, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Option Added Successfully.";

	
}


if(isset($_POST["edit_option"])){
	
	$name = addslashes($_POST["name"]); 
	$design_email_source_id = $_POST['design_email_source_id'];

	$sql = sprintf("UPDATE design_email_source SET name = '%s' WHERE design_email_source_id = '%u'", 
	$name, $design_email_source_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Option successfully edited.";
	
}




if(isset($_POST["del_option"])){

	$design_email_source_id = $_POST["del_option_id"];
	$sql = sprintf("DELETE FROM design_email_source WHERE design_email_source_id = '%u'", $design_email_source_id);
	$result = $dbCustom->getResult($db,$sql);
	//
	$msg = "Option successfully deleted.";

}



$sql = "SELECT design_email_content_id, to_cust_email_body  
		FROM design_email_content
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$to_cust_email_body = $object->to_cust_email_body;
	//$content = $object->content;
}else{
	$to_cust_email_body = '';
	//$content = '';
}


if(!isset($strip)) $strip = 0;

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>



<script>

$(document).ready(function() {


});


	
	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});
	



function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = 'design-email-content.php';
  document.form.target = '_self';
  document.form.submit(); 
}	

</script>


<style>

.confirm-content2{
  display: none;
  width: 250px;
  height: auto;
  background-color: #ffffff;
  padding: 15px;
  border: 2px solid #caeefe;
  position: fixed;
  top: 22%;
  left: 40%;
  -webkit-box-shadow: 0px 4px 8px 1px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 4px 8px 1px rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
  border-radius: 4px;
}

</style>

</head>
<body>
<?php 

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
    
    <div style="color:#03F; font-size:24px;"><?php echo $msg; ?></div>
    
    
	<?php 
	
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Design Email", '');
        echo $bread_crumb->output();
	
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        ?>
	<form name="form" action="design-email-content.php" method="post" enctype="multipart/form-data">
		
        <input type="hidden" name="edit_design_email" value="1">        
        
		<div class="page_actions edit_page"> 
            
            <!--
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            -->
            
            <!--
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            -->
            
            <!--
            <a href="<?php //echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
            -->
            
			<hr />
            <!--
			<?php 
			//if($_SESSION['is_ssl']){ 
				//$checked = ($mssl)? "checked=checked" : ''; 		
			?>
			<label>Set Page as SSL</label>
			<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
				<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
			</div>
			<?php //} ?>
            -->
			<a href="<?php echo $ste_root;?>/manage/cms/design-services/design-services-pages.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
            
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                
        <div style="font-size:24px;">                
        This page is not used. <br /> To edit the email body content sent to customers, 
        <br /><a href="../email-content/design-request-email.php" style='text-decoration:underline;'>click here</a>
		</div>
                
                <!--
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Heading</label>
                            </div>
                            <div class="twocols">
                                <input id="page_heading" type="text" name="page_heading" value="<?php //echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                
                        
                <div class="colcontainer"> 
                    <label>Intro Content</label>
                    <textarea id="intro" class="wysiwyg" name="intro"><?php //echo stripslashes($_SESSION['temp_page_fields']['intro']); ?></textarea>
                </div>
				
                	
                <div class="colcontainer"> 
                	<label>Email Body to Customert</label>
                    <textarea id="input_to_cust_email_body" class="wysiwyg" name="to_cust_email_body"><?php echo stripslashes($to_cust_email_body); ?></textarea>
                </div>
                
                -->
            </fieldset>
            
            
	        <?php 
			/*
			$page_heading = $_SESSION['temp_page_fields']['page_heading'];
			$seo_name = $_SESSION['temp_page_fields']['seo_name'];
			$title = $_SESSION['temp_page_fields']['title'];
			$keywords = $_SESSION['temp_page_fields']['keywords'];	
			$description = $_SESSION['temp_page_fields']['description'];
			require_once("edit_page_seo.php"); 
    	    require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php");
			*/ 
			?>

		</div>
	</form>

<p style="height:100px;" ></p>

</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>


</body>
</html>
