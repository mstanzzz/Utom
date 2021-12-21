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


$page_title = "Edit FAQ";
$page_group = "edit-faq";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


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

</script>
</head>
<body>

<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
		$faq_id = (isset($_GET['faq_id'])) ? $_GET['faq_id'] : 0;
		 
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = sprintf("SELECT * FROM faq WHERE faq_id = '%u'", $faq_id);
$result = $dbCustom->getResult($db,$sql);		$object = $result->fetch_object();
	?>
	<form name="edit_faq" action="faq.php" method="post" target="_top">
        <input id="faq_id" type="hidden" name="faq_id" value="<?php echo $faq_id;  ?>" />
		<div class="lightboxcontent">
			<h2>Edit FAQ</h2>
			<fieldset class="colcontainer">
				<label>Select FAQ Category:</label>
				<?php
					$sql = "SELECT * FROM faq_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);
					$block = "<select name='faq_cat_id'>";
					while($row = $result->fetch_object()) {
						$sel = '';
						
						if($object->faq_cat_id == $row->faq_cat_id) $sel = "selected";
						
						$block .= "<option value='".$row->faq_cat_id."'".$sel.">".$row->category_name."</option>";
					}
					$block .= "</select>";			
					echo $block;
				?>
			</fieldset>
			<fieldset class="colcontainer">
				<label>Question</label>
				<textarea class="wysiwyg small" name="question"><?php echo stripslashes($object->question); ?></textarea>
			</fieldset>
			<fieldset class="colcontainer">
				<label>Answer</label>
				<textarea class="wysiwyg small" name="answere"><?php echo stripslashes($object->answere); ?></textarea>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_faq" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body> 
</html>



