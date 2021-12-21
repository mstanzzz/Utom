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


$page_title = "Edit Privacy Statement";
$page_group = "privacy-statement";
$page = "privacy-statement";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$ts = time();
// add if not exist
$sql = "SELECT privacy_statement_id FROM privacy_statement WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO privacy_statement 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST["edit_privacy_statement"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$privacy_statement_id = $_POST["privacy_statement_id"];
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$page_heading = trim(addslashes($_POST["page_heading"]));
	$description = trim(addslashes($_POST['description']));


	require_once($real_root."/manage/cms/insert_page_seo.php");

	//if(in_array(2,$user_functions_array)){
		// create a backup
		//$backup = new Backup;
		//$dbu = $backup->doBackup($privacy_statement_id,$user_id,"privacy_statement");	
		//echo $dbu;
		//exit;

		$sql = sprintf("UPDATE privacy_statement SET content = '%s' WHERE privacy_statement_id = '%u'", 
		$content, $privacy_statement_id);

		$msg = "Your change is now live.";
	/*	
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content_record_id) 
		VALUES ('%s','%u','%u','%s','%s','%u')", 
		"privacy_statement", $ts, $user_id, "privacy-statement", $content, $privacy_statement_id);
		$msg = "Your change is now pending approval.";
	}
	*/

	$result = $dbCustom->getResult($db,$sql);
	


	require_once($real_root."/manage/cms/insert_page_breadcrumb.php");


}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<script>

	

	$("a.inline").fancybox();
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
	


$(document).ready(function() {

	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
	
	$('.fancybox').click(function(){		

		ajax_set_page_session();
	
	});


});


function ajax_set_page_session(){
	
	var q_str = "?action=2"+get_query_str();
		
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
	$privacy_statement_id = (isset($_REQUEST['privacy_statement_id'])) ? $_REQUEST['privacy_statement_id'] : 0; 
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = sprintf("SELECT * 
 				FROM privacy_statement 
    			WHERE privacy_statement_id = '%u'", $privacy_statement_id);
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

	
	require_once($real_root."/manage/cms/get_seo_variables.php");

?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("Pricacy Statement", '');
        echo $bread_crumb->output();
		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        ?>
		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="edit_privacy_statement" value="1">
       		<input type="hidden" name="privacy_statement_id" value="<?php echo $privacy_statement_id ?>">
            <input type="hidden" name="ret_page" value="privacy-statement">        
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
    		<input type="hidden" name="content_table" value="privacy_statement">    
            
			<div class="page_actions edit_page"> 
				<!-- all page button/submit actions should be in one place that scrolls with the user so that they don't miss the 'save' button.--> 
				<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>

                <a href="<?php echo SITEROOT; ?>manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>                
                
				<hr />
				<!-- I'm not sure if this was being used or not, but I left it in. You can just hide it or get rid of it if this feature isn't going to be released.-->
				<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				<?php if($_SESSION['is_ssl']){ 
					$checked = ($mssl)? "checked=checked" : ''; 		
				?>
				<label>Set Page as SSL</label>
				<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
					<input type="checkbox" class="checkboxinput" name="set_ssl" value="1" <?php echo $checked; ?> />
				</div>
				<?php } ?>
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input type="text" id="page_heading" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
					<div class="colcontainer">
					<textarea id="content" class="wysiwyg" name="content"><?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?></textarea>
					</div>
				</fieldset>

	        <?php require_once("edit_page_seo.php"); ?>
    	    <?php require_once($real_root."/manage/cms/edit_page_breadcrumb.php"); ?>


			</div>
		</form>
    
        
	</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</div>

  <div style="display:none">
        <div id="delete" style="width:250px; height:100px;">
        	<br />
            Are you sure you want to delete this bread crumb?
            <form name="del_bc" action="edit-privacy-statement.php" method="post">
                <input id="del_bc_id" type="hidden" name="del_bc_id" />
                <input name="del_bc" type="submit" value="DELETE" />
            </form>
        </div>
    </div>


</body>
</html>



