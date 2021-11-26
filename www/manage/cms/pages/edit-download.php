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

$page_title = "Edit Download";
$page_group = "download";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

<script type="text/javascript" language="javascript">
	
$(document).ready(function() {	

	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,styleselect,formatselect,fontsizeselect,",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,help,|,insertdate,inserttime,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,media,advhr,",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
		forced_root_block : false

	});
});


function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}


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
		$download_id = (isset($_GET['download_id'])) ? $_GET['download_id'] : 0;
		$sql = sprintf("SELECT * FROM download WHERE download_id = '%u'", $download_id);
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$title = $object->title;
			$external_url = $object->external_url;
			$downloadFileName = $object->file_name;
			$description = $object->description;
			
		}else{
			$title = '';
			$external_url = '';
			$downloadFileName = '';
			$description = '';
			
		}
		
		
		
		
	?>
	<form name="edit_download" action="downloads-page.php" method="post" target="_top">
		<input id="download_id" type="hidden" name="download_id" value="<?php echo $download_id;  ?>" />
		<div class="lightboxcontent">
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>Download Link Text</label>
					<input type="text" name="title" value="<?php echo $title; ?>"/>
				</div>
				<div class="twocols">
					<label>Download Link URL If It's Outside The Site</label>
					<input type="text" name="external_url" value="<?php echo $external_url; ?>" />
				</div>
			</fieldset> 
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>File name</label>
					<div><?php echo "<a href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$downloadFileName."' 
					target='_blank'>".(string)$downloadFileName."</a>"; ?></div>
				</div>
				<div class="twocols">
					<label>Active?</label>
					<div class="radiotoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                    <input type="radio" class="radioinput" name="hide" value='' <?php if(!$object->hide) echo "checked"; ?> /></div>
				</div>
			</fieldset> 
			<fieldset class="colcontainer">
				<label>Description</label>
				<textarea class="wysiwyg small" name="description"><?php echo $description; ?></textarea>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_download" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>



