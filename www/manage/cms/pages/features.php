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

$page_title = "Editing: features";
$page_group = "features";
$page = "features";
$ts = time();

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

// add if not exist
$sql = "SELECT features_id FROM features WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO features 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);	
	$_SESSION['features_id'] = $db->insert_id;
}else{
	if(isset($_REQUEST['features_id'])) $_SESSION['features_id'] = $_REQUEST['features_id'];
	if(!is_numeric($_SESSION['features_id'])) $_SESSION['features_id'] = 0;

}



$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['update_features'])){

	$top_1 = isset($_POST['top_1'])? addslashes(trim($_POST['top_1'])) : '';
	$p_1_text = isset($_POST['p_1_text'])? addslashes(trim($_POST['p_1_text'])) : '';
	$sql = "UPDATE features 
			SET img_id = '".$_SESSION['img_id']."'																					
			WHERE features_id = '".$_SESSION['features_id']."'"; 
			
	//$result = $dbCustom->getResult($db,$sql);	


	$stmt = $db->prepare("UPDATE features
						SET
						top_1 = ?
						,p_1_text = ? 												
						,img_id = ?												
						WHERE features_id = ?");
						
		//echo 'Error-1 UPDATE   '.$db->error;
		//echo "<br />";
	
	if(!$stmt->bind_param("ssii"
						,$top_1
						,$p_1_text									
						,$_SESSION['img_id']
						,$_SESSION['features_id'])){
							
		echo 'Error-2 UPDATE   '.$db->error;
		echo "<br />";
	}else{
		$stmt->execute();
		$stmt->close();				
		$msg = "Updated";
	}

	require_once($real_root.'/manage/cms/insert_page_seo.php');
	
}

$sql = "SELECT *
FROM features 
WHERE features_id = '".$_SESSION['features_id']."'";
$result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$top_1 = $object->top_1;
	$p_1_text = $object->p_1_text;

}else{
	$img_id = 0;
	$top_1 = '';
	$p_1_text = '';
}

if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;


if($_SESSION['img_id'] > 0){

	$sql = "UPDATE features
			SET img_id = '".$_SESSION['img_id']."' 		 
			WHERE features_id = '".$_SESSION['features_id']."'";
	$result = $dbCustom->getResult($db,$sql);	
}


require_once($real_root.'/manage/cms/get_seo_variables.php');

if(!isset($_SESSION['temp_page_fields']['top_1'])) $_SESSION['temp_page_fields']['top_1'] = $top_1;
if(!isset($_SESSION['temp_page_fields']['p_1_text'])) $_SESSION['temp_page_fields']['p_1_text'] = $p_1_text;


require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});

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

	echo "<a href='page.php' >Back</a>";

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
	echo "<img src='".$im."' width='500'>";

	//$_SESSION['crop_n'] = 1;
	$_SESSION['img_type'] = 'hero';

	$url_str = SITEROOT."manage/upload-pre-crop.php"; 

	$url_str.= "?ret_page=features";
	$url_str.= "&ret_dir=cms/pages";
	$url_str.= "&ret_path=cms/pages";
	$url_str.= "&upload_new_img=1";
	?>

	<a class="btn btn-info" href="<?php echo $url_str; ?>">Upload Hero Image </a>

	
	<form name="form" action="features.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="features_id" value="<?php echo $_SESSION['features_id']; ?>">
		<input type="hidden" name="update_features" value="1">        
		
 		<input class="btn btn-info" style="float:right; margin-right:20px; width:200px;" type="submit" name="submit" value="Save Changes">
		<div style="clear:both;"></div>
						
		<label>top_1</label>
		<input style="width:80%;" type="text" name="top_1" value="<?php echo stripslashes($_SESSION['temp_page_fields']['top_1']); ?>"/>
		
		<label>p_1_text</label>
		<textarea name="p_1_text"><?php echo stripslashes($_SESSION['temp_page_fields']['p_1_text']); ?></textarea>
		
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

</body>
</html>
