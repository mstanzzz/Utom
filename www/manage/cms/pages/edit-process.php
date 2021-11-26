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


$page_title = "Add Process";
$page_group = "process";
	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

$process_id = (isset($_GET['process_id'])) ? $_GET['process_id'] : 0;
$sql = sprintf("SELECT * FROM process WHERE process_id = '%u'", $process_id);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();
$cat_id = $object->process_cat_id;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

$(document).ready(function() {

});


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

</script>
</head>

<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="edit_process" action="process.php" method="post" target="_top">
		<input name="process_id" value="<?php echo $process_id;?>" type="hidden" />
		<div class="lightboxcontent">
			<h2>Edit Process </h2>
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Process Category</label>
				</div>
				<div class="twocols">
					<?php
					$sql = "SELECT * FROM process_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);
					$block = '';
					$block .= "<select name='process_cat_id'>";
					while($row = $result->fetch_object()) {
						$selected = '';
						if ($cat_id == $row->process_cat_id) {
							$selected = "selected";
						}
						$block .= "<option value='".$row->process_cat_id."' ".$selected.">".stripslashes($row->category_name)."</option>";
					}
					$block .= "</select>";			
					echo $block;
					?>
				</div>
			</fieldset>
			<fieldset class="colcontainer">
				<label>Process Content</label>
				<textarea  name="content" class="wysiwyg" id="wysiwyg"><?php echo stripslashes($object->content); ?></textarea>        
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_process" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>
