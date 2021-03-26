<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Editing: fax-a-design-plan";
$page_group = "fax-a-design-plan";
$page = "we-design-fax";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

//$sql = "DELETE FROM page_seo WHERE page_name = 'fax-a-design-plan'"; 
//$result = $dbCustom->getResult($db,$sql);

$ts = time();

// add if not exist
$sql = "SELECT we_design_fax_id FROM we_design_fax WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO we_design_fax 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['we_design_fax_id'] = $db->insert_id;
}else{
	$_SESSION['we_design_fax_id'] = (isset($_REQUEST['we_design_fax_id'])) ? $_REQUEST['we_design_fax_id'] : 0;
}
if(!is_numeric($_SESSION['we_design_fax_id'])) $_SESSION['we_design_fax_id'] = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$new_uploaded_file_id = (isset($_GET["new_uploaded_file_id"])) ? $_GET["new_uploaded_file_id"] : 0;

if($new_uploaded_file_id > 0){
	$_SESSION['temp_page_fields']['download_form_file_id'] = $new_uploaded_file_id; 
}
$new_img_id = (isset($_GET['new_img_id'])) ? $_GET['new_img_id'] : 0;
if($new_img_id > 0){
	$_SESSION['temp_page_fields']['form_img_id'] = $new_img_id; 
}

if(isset($_POST['update_we_design_fax'])){

	$content = (isset($_POST['content']))? trim(addslashes($_POST['content'])) : ''; 
	$design_fax_number = (isset($_POST['design_fax_number']))? trim(addslashes($_POST['design_fax_number'])) : ''; 
	$download_form_file_id = (isset($_POST['download_form_file_id']))? $_POST['download_form_file_id'] : 0;
	$form_img_id = (isset($_POST['form_img_id']))? $_POST['form_img_id'] : 0;
	$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : 0;

	if(!is_numeric($download_form_file_id)) $download_form_file_id = 0;
	if(!is_numeric($form_img_id)) $form_img_id = 0;
	if(!is_numeric($img_id)) $img_id = 0;
						
	
	$stmt = $db->prepare("UPDATE we_design_fax
						SET
						content = ?
						,design_fax_number = ?
						,download_form_file_id = ?
						,form_img_id = ?
						,img_id = ?
						WHERE we_design_fax_id = ?");
						
		echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("ssiiii"
						,$content
						,$design_fax_number
						,$download_form_file_id
						,$form_img_id
						,$img_id
						,$_SESSION['we_design_fax_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}


	$mssl = (isset($_POST['mssl']))? 1 : 0;	
	$seo_name = (isset($_POST['seo_name']))? trim($_POST['seo_name']) : '';
	$seo_name = str_replace ('\'', '' , $seo_name);
	$seo_name = str_replace ('\"', '' , $seo_name);
	$seo_name = str_replace (' ', '-' , $seo_name);
	$title = (isset($_POST['title']))? trim(addslashes($_POST['title'])) : '';
	$keywords = (isset($_POST['keywords']))? trim(addslashes($_POST['keywords'])) : '';
	$description = (isset($_POST['description']))? trim(addslashes($_POST['description'])) : '';
	$page_heading = (isset($_POST['page_heading']))? trim(addslashes($_POST['page_heading'])) : '';

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/cms/insert_page_seo.php');
	
	unset($_SESSION['temp_page_fields']);
}


if(isset($_POST['del_img_id'])){

	$del_img_id = (isset($_POST['del_img_id']))? $_POST['del_img_id'] : 0;	
	if(!is_numeric($del_img_id)) $del_img_id = 0;

	$sql = "SELECT file_name FROM image WHERE img_id = '".$del_img_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;		
		if(file_exists($p)) unlink($p);
	}

	$sql = "DELETE FROM image 
	WHERE img_id = '".$del_img_id."'";
	$result = $dbCustom->getResult($db,$sql);	

}

$sql = "SELECT *
		FROM we_design_fax 
		WHERE we_design_fax_id = '".$_SESSION['we_design_fax_id']."'";
$result = $dbCustom->getResult($db,$sql);	

if($result->num_rows > 0){
	$object = $result->fetch_object();

	$content = $object->content;
	$design_fax_number = $object->design_fax_number;
	$download_form_file_id = $object->download_form_file_id;
	$form_img_id = $object->form_img_id;
	$img_id = $object->img_id;
		
}else{
	
	$content = '';
	$design_fax_number = '';
	$download_form_file_id = 0;
	$form_img_id = 0;
	$img_id = 0;
	
}

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;	
if(!isset($_SESSION['temp_page_fields']['download_form_file_id'])) $_SESSION['temp_page_fields']['download_form_file_id'] = $download_form_file_id;
if(!isset($_SESSION['temp_page_fields']['form_img_id'])) $_SESSION['temp_page_fields']['form_img_id'] = $form_img_id;
if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
if(!isset($_SESSION['temp_page_fields']['design_fax_number'])) $_SESSION['temp_page_fields']['design_fax_number'] = $design_fax_number;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/cms/get_seo_variables.php');

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>

function validate(theform){
			
	return true;
}

$(document).ready(function() {
	$('.fancybox').click(function(){		
		ajax_set_page_session();
	});
});
	
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});
	

function ajax_set_page_session(){
	
	var q_str = "?page=about-us"+get_query_str();
		
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
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26'); 
	query_str += "&intro="+escape(tinyMCE.get('intro').getContent());
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	return query_str;
}

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
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
		<h1>Fax a Design Page</h1>
	
		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_we_design_fax" value="1">        
		<input type="hidden" name="we_design_fax_id" value="<?php echo $_SESSION['we_design_fax_id']; ?>">

     	<div class="page_actions edit_page">
           	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
			<hr />
			<a href="<?php echo $ste_root;?>/manage/cms/design-services/design-services-pages.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
				
		<div class="colcontainer">                


<label>design_fax_number</label>
<input type="text" name="design_fax_number"  style="width:520px" value="<?php echo stripslashes($_SESSION['temp_page_fields']['design_fax_number']); ?>">
                    
<label>content</label>
<textarea id="content" class="wysiwyg" name="content">
<?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?>
</textarea>


</div>
<?php 
$page_heading = $_SESSION['temp_page_fields']['page_heading'];
$seo_name = $_SESSION['temp_page_fields']['seo_name'];
$title = $_SESSION['temp_page_fields']['title'];
$keywords = $_SESSION['temp_page_fields']['keywords'];	
$description = $_SESSION['temp_page_fields']['description'];
require_once("edit_page_seo.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); 
?>	
			


	</form>
	</div>
	<p class="clear"></p>
</div>


</body>
</html>
