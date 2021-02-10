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


$page_title = "In Home Consult";
$page_group = "design";
$page = "email_in_home";



	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();
// add if not exist
$sql = "SELECT consult_email_content_id  
		FROM consult_email_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO consult_email_content 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


$sql = "SELECT consult_email_content_id, content
		FROM consult_email_content 
		WHERE consult_email_content_id = (SELECT MAX(consult_email_content_id) 
											FROM consult_email_content 
											WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
						
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
	$consult_email_content_id = $object->consult_email_content_id;
	

}else{
	$content = '';
	$consult_email_content_id = 0;

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
  document.form.action = 'email-content-landing.php';
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
	<form name="form" action="email-content-landing.php" method="post" enctype="multipart/form-data">
		
        <input type="hidden" name="edit_in_home_consult_email" value="1">  
        
        <input type="hidden" name="consult_email_content_id" value="<?php echo $consult_email_content_id; ?>">
        
		<div class="page_actions edit_page"> 
            
            <!--
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            -->
            
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            
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
			<a href="<?php echo $ste_root;?>/manage/cms/email-content/email-content-landing.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
            
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                <!--
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Heading</label>
                            </div>
                            <div class="twocols">
                                <input id="page_heading" type="text" name="page_heading" value="<?php //echo prepFormInputStr($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                
                        
                <div class="colcontainer"> 
                    <label>Intro Content</label>
                    <textarea id="intro" class="wysiwyg" name="intro"><?php //echo stripAllSlashes($_SESSION['temp_page_fields']['intro']); ?></textarea>
                </div>
				-->
                	
                <div class="colcontainer"> 
                	<label>Email Body to Customer</label>
                    <textarea id="input_content" class="wysiwyg" name="content"><?php echo stripAllSlashes($content); ?></textarea>
                </div>
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
