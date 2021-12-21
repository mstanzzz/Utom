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

$page_title = "Editing: Spec Content";
$page_group = "specs-content";
$page = "specs-content";
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$ts = time();

$db = $dbCustom->getDbConnect(CART_DATABASE);

// add if not exist
$sql = "SELECT specs_content_id FROM specs_content WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO specs_content 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	$_SESSION['specs_content_id'] = $db->insert_id;
}else{
	$_SESSION['specs_content_id'] = (isset($_REQUEST['specs_content_id'])) ? $_REQUEST['specs_content_id'] : 0;
}

if($_SESSION['specs_content_id'] == 0){
	$_SESSION['specs_content_id'] = get_max_specs_content_id($dbCustom);
}

$sql = "SELECT *
		FROM specs_content
		WHERE specs_content_id = '".$_SESSION['specs_content_id']."'";		
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
	$img_id = $object->img_id;
		
	$_SESSION["temp_page_fields"]["content"] = $content;
	
	
}else{
	$img_id = 0;
	$p_1_text = '';
	$p_2_text = '';

}

if(!isset($_SESSION["temp_page_fields"]["content"])) $_SESSION["temp_page_fields"]["content"] = $content;

if(!isset($_SESSION['img_id']))$_SESSION['img_id']=0;

if($_SESSION['img_id'] > 0){

	$sql = "UPDATE specs_content
			SET img_id = '".$_SESSION['img_id']."' 		 
			WHERE specs_content_id = '".$_SESSION['specs_content_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
}

if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;

require_once($real_root."/manage/cms/get_seo_variables.php");

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});

function ajax_set_page_session(){
	
	/*
	var q_str = "?page=discount"+get_query_str();

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
	*/
}


function get_query_str(){
	
	var query_str = '';
	//query_str += "&content="+tinyMCE.get('content').getContent();
	//query_str += "&sidebar_content="+tinyMCE.get('sidebar_content').getContent();
	//query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26');

	return query_str;
}

function setRegularSubmit() {
  document.form.action = 'specs.php';
  document.form.target = '_self'; 
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
			
        
//specs section tabbed sub-navigation
require_once($real_root."/manage/admin-includes/specs-section-tabs.php");

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT file_name 
		FROM image
		WHERE img_id = '".$_SESSION['img_id']."'";
$img_res = $dbCustom->getResult($db,$sql);
if($img_res->num_rows > 0){
	$img_obj = $img_res->fetch_object();
	$file_name = $img_obj->file_name;
}else{
	$file_name = '';
}

//echo $file_name;

$im = "";
$im .= SITEROOT;
$im .= "/saascustuploads/";
$im .= $_SESSION['profile_account_id'];
$im .= "/cms/";
$im .= $file_name;
$im = preg_replace('/(\/+)/','/',$im);

echo "<h1>Hero Image </h1>";
echo "<img src='".$im."' width='500'>";

//$_SESSION['crop_n'] = 1;
$_SESSION['img_type'] = 'hero';

$url_str= SITEROOT."manage/upload-pre-crop.php"; 
//$url_str = preg_replace('/(\/+)/','/',$url_str);
//echo $url_str;
//exit;

$url_str.= "?ret_page=specs-content";
$url_str.= "&ret_dir=cms/pages";
$url_str.= "&ret_path=cms/pages";
$url_str.= "&upload_new_img=1";
$url_str.= "&specs_content_id=".$_SESSION['specs_content_id'];

//echo ">>>>specs_content_id>>>>  ".$_SESSION['specs_content_id'];
//exit;


?>
	<br />
	<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Hero Image </a>
	<br />
	<form name="form" action="specs.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
	<input type="hidden" name="specs_content_id" value="<?php echo $_SESSION["specs_content_id"]; ?>">
							
	<br />			
	<button onClick="setRegularSubmit();" name="save" id="save" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
	<hr />
	<br />
	<a href="page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				
	<div class="colcontainer">

	<label>content</label>
	<textarea rows="46"
	name="content"><?php echo $_SESSION["temp_page_fields"]["content"]; ?></textarea>
						
						
	</div>



<?php 
$page_heading = 'page_heading';
$seo_name = $_SESSION['temp_page_fields']['seo_name'];
$title = $_SESSION['temp_page_fields']['title'];
$keywords = $_SESSION['temp_page_fields']['keywords'];	
$description = $_SESSION['temp_page_fields']['description'];
require_once("edit_page_seo.php"); 
require_once($real_root."/manage/cms/edit_page_breadcrumb.php");
?>	
</form>
</div>
<p class="clear"></p>
</div>
</body>
</html>
