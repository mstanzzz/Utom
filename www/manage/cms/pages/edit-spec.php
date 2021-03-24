<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add New Spec Item";
$page_group = "specs";

	

if(isset($_GET['firstload'])){
	unset($_SESSION['img_id']);
	unset($_SESSION['new_img_id']);
	unset($_SESSION['temp_page_fields']);
	unset($_SESSION['spec_id']);
}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$spec_id = (isset($_GET['spec_id'])) ? $_GET['spec_id'] : 0;	

if(!isset($_SESSION['spec_id'])) $_SESSION['spec_id'] =  $spec_id;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT *
		FROM spec
		WHERE spec_id = '".$_SESSION['spec_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$spec_cat_id = $object->spec_cat_id;	
	$description = $object->description;
	$spec_details = $object->spec_details;	
	$svg_id = $object->svg_id;
	$_SESSION['svg_id'] = $svg_id;
}else{
	$this_name = '';
	$spec_cat_id = '';
	$svg_id = 0;
	$description = '';
	$spec_details = '';
	$this_img_id = 0;			
}


if(!isset($_SESSION['svg_id'])) $_SESSION['svg_id'] = $svg_id; 

if(!isset($_SESSION["temp_page_fields"]['name'])) $_SESSION["temp_page_fields"]['name'] = $name;
if(!isset($_SESSION["temp_page_fields"]["spec_cat_id"])) $_SESSION["temp_page_fields"]["spec_cat_id"] = $spec_cat_id;
if(!isset($_SESSION["temp_page_fields"]['description'])) $_SESSION["temp_page_fields"]['description'] = $description;
if(!isset($_SESSION["temp_page_fields"]['spec_details'])) $_SESSION["temp_page_fields"]['spec_details'] = $spec_details;

$sql = "SELECT svg_code FROM svg WHERE svg_id = '".$_SESSION['svg_id']."'";
$img_res = $dbCustom->getResult($db,$sql);
if($img_res->num_rows){
	$img_obj = $img_res->fetch_object();							
	$svg_code = stripslashes($img_obj->svg_code);
}else{
	$svg_code = '';
}
			

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');


?>
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

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	
		<a href="specs.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

		<h2>Update Spec Item</h2>
		<form name="form" action="specs.php" method="post" target="_top">
		<input type="hidden" name="spec_id" value="<?php echo $_SESSION['spec_id']; ?>">
		<input type="hidden" name="update_spec" value="1">

		<button class="btn btn-large btn-success" name="edit_spec" type="submit">
		<i class="icon-ok icon-white"></i> Save Changes </button>            
		<hr />

		<label>Spec Item Name</label>
		<input type="text" name="name" value="<?php echo stripslashes($_SESSION["temp_page_fields"]['name']); ?>" />
		<br />				
		<label>spec_details</label>
		<input type="text" name="spec_details" 
		value="<?php echo stripslashes($_SESSION["temp_page_fields"]['spec_details']); ?>" />
		<br />
		<label>Spec Item Content</label>
		<textarea id="textarea" class="wysiwyg" name="description"><?php echo stripslashes($_SESSION["temp_page_fields"]['description']); ?></textarea>
		<br />
		SELECT ICON
		<br />
		<?php
		$sql = "SELECT * 
		FROM svg
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		";
		$result = $dbCustom->getResult($db,$sql);
		$block = "<select name='svg_id'>";
		while($row = $result->fetch_object()) {
			$selected = ($_SESSION["temp_page_fields"]["svg_id"] == $row->svg_id) ? "selected" : '';
			$block .= "<option value='".$row->svg_id."' $selected>".$row->name."</option>";

		}
		$block .= "</select>";			
		echo $block;

		?>
		<br />
		

		<legend>Spec SVG Icon</legend>
		<br />
		<?php
		echo $svg_code;
		?>
		<br />	
		
	</form>

	<br /><br />
	<br /><br />

	</div>
</div>

</body>
</html>