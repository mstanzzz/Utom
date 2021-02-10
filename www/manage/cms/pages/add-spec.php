<?php



if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site';
}else{
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

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

$_SESSION['img_id'] = (isset($_SESSION['new_img_id'])) ? $_SESSION['new_img_id'] : 0;	

if(!isset($_SESSION['temp_page_fields']['name'])) $_SESSION['temp_page_fields']['name'] = '';
if(!isset($_SESSION['temp_page_fields']['spec_cat_id'])) $_SESSION['temp_page_fields']['spec_cat_id'] = '';
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = '';
if(!isset($_SESSION['temp_page_fields']['category_name'])) $_SESSION['temp_page_fields']['category_name'] = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');


?>
<script>
tinyMCE.init({
// General options
mode : "specific_textareas",
editor_selector : "wysiwyg",
theme : "advanced",
skin : "o2k7",
plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
// Theme options
theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,
theme_advanced_resize_horizontal : false,
		forced_root_block : false

});



function get_query_str(){
	
	var query_str = '';
	query_str += "?name="+document.form.name.value; 
	query_str += "&spec_cat_id="+document.form.spec_cat_id.value; 
	query_str += "&description="+tinyMCE.get('wysiwyg').getContent();


//alert(query_str);

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
                    <a onClick="goto_isfancybox('<?php echo $ste_root; ?>/manage/upload-pre-crop.php?ret_page=add-spec&ret_dir=cms/pages')" class="btn btn-primary">
                    <i class="icon-plus icon-white"></i> Add Image</a> </div>
				</div>
			</fieldset>
			<fieldset>
				<legend>Spec Item Properties</legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Spec Item Title</label>
					</div>
					<div class="twocols">
						<input type="text" name="name" value="<?php echo prepFormInputStr($_SESSION["temp_page_fields"]['name']); ?>" />
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
								$block .= "<option value='".$row->spec_cat_id."' $selected>".stripslashes($row->category_name)."</option>";
							}
							$block .= "</select>";			
							echo $block;
						?>
					</div>
				</div>
				<label>Spec Item Content</label>
				<textarea id="wysiwyg" class="wysiwyg small" name="description"><?php echo $_SESSION["temp_page_fields"]['description']; ?></textarea>
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