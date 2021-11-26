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

$page_title = "Feedback";
$page_group = "feedback";
$page = "feedback";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();
$feedback_page_id = (isset($_GET['feedback_page_id'])) ? $_GET['feedback_page_id'] : 0;

// add if not exist
$sql = "SELECT feedback_page_id FROM feedback_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO feedback_page 
		(last_update, profile_account_id) 
		VALUES ('".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$feedback_page_id = $db->insert_id;
}


if(!isset($_SESSION['feedback_page_id'])) $_SESSION['feedback_page_id'] = $feedback_page_id;


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


if(isset($_POST['edit_feedback_page'])){

	$content = trim(addslashes($_POST['content'])); 
	
	
	//echo $content;
	
	$feedback_page_id = $_POST['feedback_page_id'];
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (' ', '-' , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));


	require_once($real_root.'/manage/cms/insert_page_seo.php');


//echo $about_us_id;

	
//echo $sql;
	
//echo "<br />";
//echo $_SESSION['profile_account_id'];
	

//if(in_array(2,$user_functions_array)){
	// create a backup
	//$backup = new Backup;
	//$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = sprintf("UPDATE feedback_page 
						SET  content = '%s'
							,last_update = '%u' 
						WHERE feedback_page_id = '%u'", 
					$content
					,time()
					,$feedback_page_id);
		$msg = "Your change is now live.";
	/*
	}else{

		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id, profile_account_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u','%u' )", 
			"about_us", $ts, $user_id, "about-us", $content, $img_id, $about_us_id, $_SESSION['profile_account_id']);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
		

	require_once($real_root."/manage/cms/insert_page_breadcrumb.php");

	unset($_SESSION['temp_page_fields']);
}

//echo $_SESSION['img_id'];
	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT content
FROM feedback_page 
WHERE feedback_page_id = '".$_SESSION['feedback_page_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
}else{
	$content = '';
}

if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;

require_once($real_root."/manage/cms/get_seo_variables.php");

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>

function validate(theform){
			
	return true;
}





/*
function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}
*/

$(document).ready(function() {

	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});


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
	



function ajax_set_page_session(){
	
	var q_str = "?page=feedback_page"+get_query_str();
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
}

function get_query_str(){
	
	var query_str = '';
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	return query_str;
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
		<?php require_once($real_root.'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<?php 
	
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("About Us", '');
        echo $bread_crumb->output();
	
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        ?>
	<form name="form" action="feedback-page" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_feedback_page" value="1">        
		<input type="hidden" name="feedback_page_id" value="<?php echo $_SESSION['feedback_page_id']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="hidden" name="ret_page" value="feedback-page">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="content_table" value="feedback_page"> 
        
		<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            
            <a href="<?php echo SITEROOT; ?>manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
            
			<hr />
			<?php 
			if($_SESSION['is_ssl']){ 
				$checked = ($mssl)? "checked=checked" : ''; 		
			?>
			<label>Set Page as SSL</label>
			<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
				<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
			</div>
			<?php } ?>
			<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
            
            
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input id="page_heading" type="text" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                        
                <div class="colcontainer"> 
                	<label>Intro Content</label>
                    <textarea id="content" class="wysiwyg" name="content"><?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?></textarea>
                </div>
            </fieldset>
            
            
	        <?php 
			$page_heading = $_SESSION['temp_page_fields']['page_heading'];
			$seo_name = $_SESSION['temp_page_fields']['seo_name'];
			$title = $_SESSION['temp_page_fields']['title'];
			$keywords = $_SESSION['temp_page_fields']['keywords'];	
			$description = $_SESSION['temp_page_fields']['description'];
			require_once("edit_page_seo.php"); 
    	    require_once($real_root."/manage/cms/edit_page_breadcrumb.php"); 
			?>

		</div>
	</form>
</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this breadcrumb?</h3>
	<form name="del_bc_form" action="feedback_page.php" method="post" target="_top">
		<input id="del_bc_id" class="itemId" type="hidden" name="del_bc_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_bc" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
