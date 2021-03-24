<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Add New Spec Item";
$page_group = "specs";


$msg = '';
			
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

		<h2>Add Spec Item</h2>
		<form name="form" action="specs.php" method="post">
		<input type="hidden" name="add_spec" value="">

		<button class="btn btn-large btn-success" name="edit_spec" type="submit">
		<i class="icon-ok icon-white"></i> Save Changes </button>            
		<hr />

		<label>Spec Item Name</label>
		<input type="text" name="name" value="" />
		<br />				
		<label>spec_details</label>
		<input type="text" name="spec_details" value="" />
		<br />
		<label>Spec Item Content</label>
		<textarea class="wysiwyg" name="description"></textarea>
		<br />
		SELECT ICON
		<br />
		<?php
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * 
		FROM svg
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		";
		$result = $dbCustom->getResult($db,$sql);
		$block = "<select name='svg_id'>";
		while($row = $result->fetch_object()) {
			$selected = '';
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