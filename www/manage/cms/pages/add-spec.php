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

$page_title = "Add New Spec Item";
$page_group = "specs";

function get_file_name($dbCustom,$img_id){
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT file_name		
			FROM image
			WHERE img_id = '".$img_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->file_name;	
	}
	return "";
}

if(!isset($_SESSION["temp_page_fields"]['name'])) $_SESSION["temp_page_fields"]['name'] = '';
if(!isset($_SESSION["temp_page_fields"]["spec_cat_id"])) $_SESSION["temp_page_fields"]["spec_cat_id"] = 0;
if(!isset($_SESSION["temp_page_fields"]['description'])) $_SESSION["temp_page_fields"]['description'] = '';
if(!isset($_SESSION["temp_page_fields"]['spec_details'])) $_SESSION["temp_page_fields"]['spec_details'] = '';


$db = $dbCustom->getDbConnect(CART_DATABASE);
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
	<a href="specs.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
	<h2>Update Spec</h2>
	<form name="form" action="specs.php" method="post">
	<input type="hidden" name="add_spec" value="">
	<button class="btn btn-large btn-success" name="edit_spec" type="submit">
	Save Changes 
	</button>            
	<br />
	<hr />
	<br />
<?php       
$_SESSION['crop_n'] = 1;
$url_str= SITEROOT."manage/upload-pre-crop.php";               								
$url_str.= "?ret_page=add-spec";
$url_str.= "&ret_dir=cms/pages";
$url_str.= "&ret_path=cms/pages";
$url_str.= "&img_type=spec_gal";
$url_str.= "&crop_n=1";						
?>
<a class="btn btn-primary upload" href="<?php echo $url_str; ?>">
Upload New Gallery Image
</a>
	<br />
	<hr />

<br />
SELECT CAT
<br />
<?php
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT * 
		FROM spec_category
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$block = "<select name='spec_cat_id'>";
while($row = $result->fetch_object()) {
	$selected = ($_SESSION["temp_page_fields"]["spec_cat_id"] == $row->spec_cat_id) ? "selected" : '';
	$block .= "<option value='".$row->spec_cat_id ."' $selected>".$row->category_name."</option>";
}
$block .= "</select>";			
echo $block;
?>
	<hr />
<br />
<label>Spec Item Name</label>
<input type="text" name="name" value="<?php echo stripslashes($_SESSION["temp_page_fields"]['name']); ?>" />
<br />				
<label>spec_details</label>
<input type="text" name="spec_details" 
value="<?php echo stripslashes($_SESSION["temp_page_fields"]['spec_details']); ?>" />
<br />
<label>Spec Item description</label>
<textarea  style="width:100%; height:120px;" name="description"><?php echo stripslashes($_SESSION["temp_page_fields"]['description']); ?></textarea>
</form>
<br /><br />
<br /><br />
</div>
</div>
</body>
</html>