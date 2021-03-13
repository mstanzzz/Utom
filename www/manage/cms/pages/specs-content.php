<?php
/* ms */
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page = "specs";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$ts = time();

// add if not exist
$sql = "SELECT specs_content_id FROM specs_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO specs_content 
		(content, last_update, profile_account_id) 
		VALUES ('Add Content', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	$_SESSION['services_id'] = $db->insert_id;
}else{
	$_SESSION['services_id'] = (isset($_REQUEST['services_id'])) ? $_REQUEST['services_id'] : 0;
}

$_SESSION['img_id'] = (isset($_SESSION['new_img_id'])) ? $_SESSION['new_img_id'] : 0;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
		FROM specs_content
		WHERE specs_content_id = (SELECT MAX(specs_content_id) FROM specs_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";		
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
	$sidebar_heading = $object->sidebar_heading;
	$sidebar_content = $object->sidebar_content;
	$img_id = $object->img_id;
	$specs_content_id = $object->specs_content_id;		
}else{
	$content = '';
	$sidebar_heading = '';
	$sidebar_content = '';
	$img_id = 0;
	$specs_content_id = 0;			
}

if(!$_SESSION['img_id']) $_SESSION['img_id'] = $img_id; 


if(!isset($_SESSION['specs_content_id'])) $_SESSION['specs_content_id'] = $specs_content_id; 
if(!isset($_SESSION["temp_page_fields"]["content"])) $_SESSION["temp_page_fields"]["content"] = $content;
if(!isset($_SESSION["temp_page_fields"]["sidebar_heading"])) $_SESSION["temp_page_fields"]["sidebar_heading"] = $sidebar_heading;
if(!isset($_SESSION["temp_page_fields"]["sidebar_content"])) $_SESSION["temp_page_fields"]["sidebar_content"] = $sidebar_content;
require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");
if(!isset($_SESSION["temp_page_fields"]["page_heading"])) $_SESSION["temp_page_fields"]["page_heading"] = $page_heading;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {

	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});

	$(".fancybox").click(function(){		
		ajax_set_page_session();
	});
	
});

function ajax_set_page_session(){
	
	var q_str = "?page=discount"+get_query_str();

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
	query_str += "&content="+tinyMCE.get('content').getContent();
	query_str += "&sidebar_content="+tinyMCE.get('sidebar_content').getContent();
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26');

	return query_str;
}


tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});


function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function setRegularSubmit() {
  document.form.action = 'specs.php';
  document.form.target = '_self'; 
}	

</script>
</head>

<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        
   		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Specs", $ste_root."manage/cms/pages/specs.php");
		$bread_crumb->add("Edit Specs Intro and Side Content", '');
        echo $bread_crumb->output();
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//specs section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/specs-section-tabs.php");
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
		?>

		<form name="form" action="specs.php" method="post" enctype="multipart/form-data">
        	
			<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
            
   			<input type="hidden" name="specs_content_id" value="<?php echo $_SESSION["specs_content_id"]; ?>">
                        
			<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
			<button onClick="setRegularSubmit();" name="save" id="save" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
			<hr />
                
			<a href="<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=specs-side-content&ret_dir=cms/pages" 
            class="btn btn-primary fancybox fancybox.iframe"><i class="icon-plus icon-white"></i> Add New Banner Image</a> 
                
            <a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a> 
                
            <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
    
            <a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				
			<?php if($_SESSION['is_ssl']){
				$checked = ($mssl)? "checked=checked" : '';
			?>
			<label>Set Page as SSL</label>
			<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
				<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?>/>
			</div>
			<?php } ?>
			
            </div>
			<div class="page_content edit_page">
				<fieldset>
					<legend>Introduction Content<i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Page Name</label>
						</div>
						<div class="twocols">
							<input type="text" id="page_heading" name="page_heading" value="<?php echo prepFormInputStr($_SESSION["temp_page_fields"]["page_heading"]); ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<label>Intro Content</label>
<textarea id="content" class="wysiwyg" name="content"><?php echo $_SESSION["temp_page_fields"]["content"]; ?></textarea>
					</div>
				</fieldset>
				<fieldset>
					<legend>Intro Banner Image <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
						<div class="twocols"> 
	            		<?php			
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						;
						if($img_res->num_rows){
							$img_obj = $img_res->fetch_object();
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'>";
						}
						?>
				                        
                        <div class="twocols"> 
                        <a href="<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=specs-side-content&ret_dir=cms/pages" 
                        class="btn btn-primary fancybox fancybox.iframe"><i class="icon-plus icon-white"></i> Add New Banner Image</a> 
                    </div>
				</fieldset>
				<fieldset>
					<legend>Sidebar Content<i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Heading</label>
						</div>
						<div class="twocols">
							<input type="text" name="sidebar_heading" value="<?php echo stripslashes($_SESSION["temp_page_fields"]["sidebar_heading"]); ?>" />
						</div>
					</div>
					<div class="colcontainer">
							<label>Sidebar Content</label>
							<textarea id="sidebar_content" class="wysiwyg small" name="sidebar_content"><?php echo $_SESSION["temp_page_fields"]["sidebar_content"]; ?></textarea>
					</div>
				</fieldset>
<?php 
$page_heading = $_SESSION['temp_page_fields']['page_heading'];
$seo_name = $_SESSION['temp_page_fields']['seo_name'];
$title = $_SESSION['temp_page_fields']['title'];
$keywords = $_SESSION['temp_page_fields']['keywords'];	
$description = $_SESSION['temp_page_fields']['description'];
require_once("edit_page_seo.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); 
?>	
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
