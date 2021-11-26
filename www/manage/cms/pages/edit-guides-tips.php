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



$page_title = "Edit Guides Tips";
$page_group = "edit-guides-tips";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


//profile_account_id = '".$_SESSION['profile_account_id']."'
require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script type="text/javascript" language="javascript">
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
<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } 
		$guide_tip_id = (isset($_GET['guide_tip_id'])) ? $_GET['guide_tip_id'] : 0;
		$sql = sprintf("SELECT * FROM guide_tip WHERE guide_tip_id = '%u'", $guide_tip_id);
$result = $dbCustom->getResult($db,$sql);		$object = $result->fetch_object();
	?>
	<form name="edit_giude_tip_form" action="guides-tips.php" method="post" enctype="multipart/form-data" target="_top">
		<input id="guide_tip_id" type="hidden" name="guide_tip_id" value="<?php echo $guide_tip_id;  ?>" />
		<div class="lightboxcontent">
			<h2>Edit Guide Tip</h2>
			<fieldset class="colcontainer form">
				<div class="twocols">
					<label>Guide Tip Category</label>
				</div>
				<div class="twocols">
					<?php
					$sql = "SELECT * 
					FROM guide_tip_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql); 
					$block = "<select name='guide_tip_cat_id'>";
					while($row = $result->fetch_object()) {
						$sel = ($object->guide_tip_cat_id == $row->guide_tip_cat_id) ? "selected" : '';						
						$block .= "<option ".$sel." value='".$row->guide_tip_cat_id."'>".$row->category_name."</option>";
					}
					$block .= "</select>";			
					echo $block;
					?>
				</div>
			</fieldset>
			<label>Guide/Tip Content</label>
			<textarea  name="content" class="wysiwyg"><?php echo stripslashes($object->content); ?></textarea>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_guide_tip" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>