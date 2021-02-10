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

$page_title = 'Eddit Description In Tab';
$page_group = "keyword-landing";
$page = "keyword-landing";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 'add-keyword-landing';


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');

$keyword_landing_id = (isset($_GET['keyword_landing_id'])) ? $_GET['keyword_landing_id'] : 0;

$description = '';
		
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT description
		FROM keyword_landing 
		WHERE keyword_landing_id = '".$keyword_landing_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$description = $object->description;
}

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
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
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
	<form name="form" action="<?php echo $ret_page.'.php'; ?>" method="post" enctype="multipart/form-data" target='_top'>
    	<input type="hidden" name="edit_description" value="1" />
        
		<div class="lightboxcontent">
		
		<fieldset>
        	
				<label>Description</label>
				<textarea class="wysiwyg" id="wysiwyg" name="description" style="width:800px!important; height:800px!important;"><?php echo stripslashes($description); ?></textarea>
			
       	</fieldset>

	</div>
		<br /><br />
	<div class="savebar">
		<button class="btn btn-large btn-success" name="edit_description_btn" type="submit"><i class="icon-ok icon-white"></i> Submit </button>
        <a class="btn btn-large" style="width:100px;" href="<?php echo $ret_page.'.php'; ?>" target='_top'>Cancel</a>
	</div>
	</form>
</div>
</body>
</html>


