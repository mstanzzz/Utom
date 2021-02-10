<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Add Guide Tip";
$page_group = "guides";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>
	<form name="add_guide_tip" action="guides-tips.php" method="post" target="_top">
		<input type="hidden" name="type_0" value="Guide-Tip" id="copy_item_type" />
		<div class="lightboxcontent accordion">
			<h2>Add New Guide/Tip</h2>
			<fieldset class="colcontainer copy">
				<div class="twocols">
					<label>Guide Tip Category</label>
				</div>
				<div class="twocols">
					<?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);    
					$sql = "SELECT * 
					FROM guide_tip_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql); 
					$block = "<select name='guide_tip_cat_id'>";
					while($row = $result->fetch_object()) {
						$block .= "<option value='".$row->guide_tip_cat_id."'>".$row->category_name."</option>";
					}
					$block .= "</select>";			
					echo $block;
				?>
				</div>
			</fieldset>
			<fieldset class="colcontainer copy">
				<label>Guide/Tip Content</label>
				<textarea  name="content" class="wysiwyg small"></textarea>
			</fieldset>
			<hr />
			<a class="btn add-one"><i class="icon-plus"></i> Add 1 New Guide/Tip Field</a>
			<a class="btn add-five"><i class="icon-plus"></i> Add 5 New Guide/Tip Fields</a>
			<hr />
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="add_guide_tip" type="submit" ><i class="icon-ok icon-white"></i> Add New Guide/Tip </button>
		</div>
	</form>
</div>
</body></html>
