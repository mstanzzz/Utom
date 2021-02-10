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


$page_title = "Add Process";
$page_group = "process";
	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
		content_css : "../../../css/mce.css"
	});

</script>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="add_process" action="process.php" method="post" target="_top">
		<input type="hidden" name="type_0" value="Process" id="copy_item_type" />
		<div class="lightboxcontent accordion">
			<h2>Add a New Process</h2>
			<fieldset class="colcontainer formcols copy">
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
						$block .= "<option value='".$row->process_cat_id."'>".$row->category_name."</option>";
					}
					$block .= "</select>";			
					echo $block;
					?>
				</div>
			</fieldset>
			<fieldset class="colcontainer copy">
				<label>Process Content</label>
				<textarea  name="content" class="wysiwyg" id="wysiwyg">&nbsp;</textarea>
			</fieldset>
			<hr />
			<a class="btn add-one"><i class="icon-plus"></i> Add 1 New Process Field</a>
			<a class="btn add-five"><i class="icon-plus"></i> Add 5 New Process Fields</a>
			<hr />
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="add_process" type="submit"><i class="icon-ok icon-white"></i> Add Process </button>
		</div>
	</form>
</div>
</body>
</html>