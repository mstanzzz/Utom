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

$page_title = "Edit Spec Category";
$page_group = "specs";

$msg = '';

$spec_cat_id= isset($_GET['spec_cat_id'])?$_GET['spec_cat_id'] : 0;
if(!is_numeric($spec_cat_id))$spec_cat_id=0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT * FROM spec_category WHERE spec_cat_id = '".$spec_cat_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows>0){
	$object = $result->fetch_object();
	$svg_id = $object->svg_id;
	$category_name = $object->category_name;
}else{
	$svg_id = 0;
	$category_name = '';
}
			
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

		<h2>Update Spec Category</h2>
		<form name="form" action="specs-category.php" method="post">
		<input type="hidden" name="update_spec_cat" value="1">
		
		<input type="hidden" name="spec_cat_id" value="<?php echo $spec_cat_id ?>">
		
		 

		<button class="btn btn-large btn-success" name="edit_spec_cat" type="submit">
		<i class="icon-ok icon-white"></i> Save Changes </button>            
		<hr />

		<label>Spec Cat Name</label>
		<input type="text" name="category_name" value="<?php echo stripslashes($category_name); ?>" />
		<br />				
		<br />
		<br />
		SELECT ICON
		<br />
		<?php
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT * 
		FROM svg
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		";
		$result = $dbCustom->getResult($db,$sql);
		$block = "<select name='svg_id'>";
		while($row = $result->fetch_object()) {
			$selected = ($row->svg_id == $svg_id)?'selected':'';
			$block .= "<option value='".$row->svg_id."' $selected>".$row->name."</option>";

		}
		$block .= "</select>";			
		echo $block;

		?>
		<br />
		

	</form>

	<br /><br />
	<br /><br />

	</div>
</div>

</body>
</html>