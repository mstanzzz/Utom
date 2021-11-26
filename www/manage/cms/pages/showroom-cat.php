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

$page_title = "Editing: Showroom Category";
$page_group = "showroom-cat";
$page = "showroom-cat";

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

// add if not exist
$sql = "SELECT showroom_cat_id FROM showroom_cat WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO showroom_cat 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['showroom_cat_id'] = $db->insert_id;
}else{
	 
	if(isset($_REQUEST['showroom_cat_id'])) $_SESSION['showroom_cat_id'] = $_REQUEST['showroom_cat_id'];
}

if(!is_numeric($_SESSION['showroom_cat_id'])) $_SESSION['showroom_cat_id'] = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['update_showroom'])){
	
	$p_1_head = isset($_POST['p_1_head'])? addslashes(trim($_POST['p_1_head'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';

	if(isset($_POST['img_id'])) $_SESSION['img_id'] = $_POST['img_id']; 

	
	$stmt = $db->prepare("UPDATE showroom_cat
						SET
						p_1_head = ?
						,p_1_text = ?
						,img_id = ?
						WHERE showroom_cat_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
		
	if(!$stmt->bind_param("ssii"
						,$p_1_head
						,$p_1_text
						,$_SESSION['img_id']						
						,$_SESSION['showroom_cat_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}

	require_once($real_root.'/manage/cms/insert_page_seo.php');
}


$sql = "SELECT 
		p_1_head
		,p_1_text
		,img_id		
FROM showroom_cat 
WHERE showroom_cat_id = '".$_SESSION['showroom_cat_id']."'";
$result = $dbCustom->getResult($db,$sql);	

if($result->num_rows > 0){
	$object = $result->fetch_object();

	$p_1_head = $object->p_1_head;
	$p_1_text = $object->p_1_text;
	$img_id = $object->img_id;
		
}else{

	$p_1_head = '';
	$p_1_text = '';
	$img_id = 0;
}

if($_SESSION['img_id'] > 0 && $img_id == 0){

	$sql = "UPDATE showroom_cat
			SET img_id = '".$_SESSION['img_id']."' 		 
			WHERE showroom_cat_id = '".$_SESSION['showroom_cat_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
	$img_id	= $_SESSION['img_id'];		
}

require_once($real_root.'/manage/cms/get_seo_variables.php');

$_SESSION['temp_page_fields']['p_1_head'] = $p_1_head;	
$_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;	


if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});

function validate(theform){
			
	return true;
}

function ajax_set_page_session(){
	
	var q_str = "?page=showroom"+get_query_str();
		
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
	return query_str;
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
	

echo "<a class='btn btn-info' href='page.php' >DONE</a>";

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

$im = "";
$im .= SITEROOT;
$im .= "saascustuploads/";
$im .= $_SESSION['profile_account_id'];
$im .= "/cms/";
$im .= $file_name;

echo "<h1>Hero Image </h1>";

echo "<img src='".$im."'>";

$_SESSION['img_type'] = 'hero';

$url_str = SITEROOT."manage/upload-pre-crop.php"; 
$url_str.= "?ret_page=showroom-cat";
$url_str.= "&ret_dir=cms/pages";
$url_str.= "&ret_path=cms/pages";
$url_str.= "&upload_new_img=1";
	?>

<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Hero Image </a>


	
	<form name="form" action="showroom-cat.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_showroom" value="1">        
		<input type="hidden" name="showroom_cat_id" value="<?php echo $_SESSION['showroom_cat_id']; ?>">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">

			<input type="submit" name="submit" value="Save Changes"> 
			<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				
				

<label>p_1_head</label>
<input type="text" name="p_1_head"  style="width:520px" value="<?php echo stripslashes($_SESSION['temp_page_fields']['p_1_head']); ?>">

<label>p_1_text</label>
<textarea rows="20" id="p_1_text" name="p_1_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>
<div style="height:200px;"></div>	
				
				
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
</div>


<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	


</body>
</html>
