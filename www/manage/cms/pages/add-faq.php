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


$page_title = "Process";
$page_group = "process";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

<script type="text/javascript" language="javascript">
	//var c = 2;
	//var type = "FAQ";
	
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
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="add_faq" action="faq.php" method="post" target="_top">
		<input type="hidden" name="type_0" value="FAQ" id="copy_item_type" />
		<div class="lightboxcontent accordion">
			<h2>Add a New FAQ</h2>
			<fieldset class="colcontainer copy">
				<label>Select FAQ Category:</label>
				<?php
					$sql = "SELECT * 
					FROM faq_category
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					";
					$result = $dbCustom->getResult($db,$sql);
					$block = "<select name='faq_cat_id'>";
					while($row = $result->fetch_object()) {
						$block .= "<option value='".$row->faq_cat_id."'>".$row->category_name."</option>";
					}
					$block .= "</select>";			
					echo $block;
            	?>
			</fieldset>
			<fieldset class="colcontainer copy">
				<label>Question</label>
                <textarea class="wysiwyg small" name="question"></textarea>
			</fieldset>
			<fieldset class="colcontainer copy">
				<label>Answer</label>
				<textarea  name="answere" class="wysiwyg small"></textarea>
			</fieldset>
			<hr />
			<a class="btn add-one"><i class="icon-plus"></i> Add 1 New FAQ Field</a>
			<a class="btn add-five"><i class="icon-plus"></i> Add 5 New FAQ Fields</a>
			<hr />
		</div>
		<div class="savebar">
            <button class="btn btn-large btn-success" name="add_faq" type="submit" ><i class="icon-ok icon-white"></i> Save &amp; Add New FAQ </button>
		</div>
	</form>
</div>
</body>
</html> 


