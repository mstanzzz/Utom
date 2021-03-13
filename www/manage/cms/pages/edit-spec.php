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
	$this_name = $object->name;
	$spec_cat_id = $object->spec_cat_id;
	$description = $object->description;
	$spec_details = $object->spec_details;
	
	
	
	$this_img_id = $object->img_id;		

}else{
	$this_name = '';
	$spec_cat_id = '';
	$description = '';
	$spec_details = '';
	$this_img_id = 0;			
}


if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $this_img_id; 

if(!isset($_SESSION["temp_page_fields"]['name'])) $_SESSION["temp_page_fields"]['name'] = $this_name;
if(!isset($_SESSION["temp_page_fields"]["spec_cat_id"])) $_SESSION["temp_page_fields"]["spec_cat_id"] = $spec_cat_id;
if(!isset($_SESSION["temp_page_fields"]['description'])) $_SESSION["temp_page_fields"]['description'] = $description;
if(!isset($_SESSION["temp_page_fields"]['spec_details'])) $_SESSION["temp_page_fields"]['spec_details'] = $spec_details;





require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');


?>
<script>

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});



function get_query_str(){
	
	var query_str = '';
	query_str += "?name="+document.form.name.value; 
	query_str += "&spec_cat_id="+document.form.spec_cat_id.value; 
	query_str += "&description="+tinyMCE.get('wysiwyg').getContent();

	return query_str;
}



function goto_isfancybox(url){

	var q_str = get_query_str();

	if(window.top.location != window.location) {
		url+="&fromfancybox=1";
	}
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  	location.href = url;
	  }
	});

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
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<form name="form" action="specs.php" method="post" target="_top">
    <input type="hidden" name="spec_id" value="<?php echo $_SESSION['spec_id']; ?>">
    <input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">

		<div class="page_actions edit_page"> 

			<button class="btn btn-large btn-success" name="edit_spec" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
            
            <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
            
			<hr />


			<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>

		<div class="edit_page">
			<h2>Add Spec Item</h2>
			<fieldset>
				<legend>Spec Item Image</legend>
				<div class="colcontainer">
					<div class="twocols"> 
            		<?php			

						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						
						$img_res = $dbCustom->getResult($db,$sql);
						;
						if($img_res->num_rows){
							$img_obj = $img_res->fetch_object();
							echo "<br /><img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'><br />";
						}
					?>
                    </div>
                    
                    
					<div class="twocols"> 
                    <a onClick="goto_isfancybox('<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=edit-spec&ret_dir=cms/pages')" class="btn btn-primary">
                    <i class="icon-plus icon-white"></i> Upload Image</a> </div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Spec Item Properties</legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Spec Item Title</label>
					</div>
					<div class="twocols">
						<input type="text" name="name" value="<?php echo stripslashes($_SESSION["temp_page_fields"]['name']); ?>" />
					</div>
				</div>
				
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>spec_details</label>
					</div>
					<div class="twocols">
						<input type="text" name="spec_details" 
						value="<?php echo stripslashes($_SESSION["temp_page_fields"]['spec_details']); ?>" />
					</div>
				</div>
				
				
				
				
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Spec Item Category</label>
                        Additional categories can be added <a href="specs-category.php" target="_top" >here</a>
					</div>
					<div class="twocols">
        				<?php
							$sql = "SELECT * 
							FROM spec_category
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							";
							$result = $dbCustom->getResult($db,$sql);
							$block = "<select name='spec_cat_id'>";
							while($row = $result->fetch_object()) {
								$selected = ($_SESSION["temp_page_fields"]["spec_cat_id"] == $row->spec_cat_id) ? "selected" : '';
								$block .= "<option value='".$row->spec_cat_id."' $selected>".$row->category_name."</option>";
							}
							$block .= "</select>";			
							echo $block;
						?>
					</div>
				</div>
				<label>Spec Item Content</label>
<textarea id="wysiwyg" class="wysiwyg" name="description"><?php echo stripslashes($_SESSION["temp_page_fields"]['description']); ?></textarea>
			</fieldset>
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