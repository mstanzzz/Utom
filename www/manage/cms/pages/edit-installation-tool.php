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


$page_title = "Edit Installation Tool";
$page_group = "installation";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


if(isset($_GET['firstload'])){
	unset($_SESSION['installation_tool_id']);
	unset($_SESSION['img_id']);
}

$installation_tool_id = (isset($_GET['installation_tool_id'])) ? $_GET['installation_tool_id'] : 0;
if(!isset($_SESSION["installation_tool_id"])) $_SESSION["installation_tool_id"] = $installation_tool_id; 



$sql = "SELECT name, description, img_alt_text, img_id
	    FROM installation_tool 
 		WHERE installation_tool_id = '".$_SESSION['installation_tool_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$description =  $object->description;
	$img_alt_text =  $object->img_alt_text;
	$img_id =  $object->img_id;

}else{
	$name = '';
	$description = '';
	$img_alt_text = '';
	$img_id = 0;
}


if(!isset($_SESSION['temp_page_fields']['name'])) $_SESSION['temp_page_fields']['name'] = $name;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;

require_once($real_root.'/manage/admin-includes/doc_header.php');


?>
<script>
$(document).ready(function() {
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

});


function goto_isfancybox(url, save_session){
	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}

	if(save_session){
		
		var q_str = "?page=add-installation-step"+get_query_str();
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_page_session.php'+q_str,
		  success: function(data) {
			location.href = url;
		  }
		});
	}else{
		location.href = url;		
	}

}


function get_query_str(){
	
	var query_str = '';
	query_str += "&name="+$("#name").val(); 
	query_str += "&display_order="+$("#display_order").val(); 
	query_str += "&img_alt_text="+$("#img_alt_text").val(); 
	query_str += "&description="+$("#description").val(); 
	
	return query_str;
}

</script>
</head>
<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>
	<form name="form" action="installation-tools.php" method="post" target="_top">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
        <input type="hidden" name="installation_tool_id" value="<?php echo $_SESSION['installation_tool_id']; ?>" />
		<div class="lightboxcontent">
			<h2>Edit Installation Step</h2>
			<fieldset>
				<legend>Step Image</legend>
				<div class="colcontainer">
					<?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);	
					$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
					$img_res = $dbCustom->getResult($db,$sql);
					;
						if($img_res->num_rows > 0){
						$img_obj = $img_res->fetch_object();
						//echo $_SESSION['img_id'];
						echo "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'>";	
					}
					?>
                    
                    <div class="twocols"> 
						<?php 
                        $url_str = SITEROOT."/manage/upload-pre-crop.php";
                        $url_str .= "?ret_page=edit-installation-tool";
                        $url_str .= "&ret_dir=cms/pages";
                        ?>
                        <a onClick="goto_isfancybox('<?php echo $url_str; ?>', '1')" class="btn btn-primary"><i class="icon-plus icon-white"></i>Upload new Image</a>
                    </div>
                </div>

                <div class="colcontainer formcols">
                  	<div class="twocols">
                       	<label>Image Alt Tag Text</label>
                    </div>
                    <div class="twocols">
                       	<input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo stripslashes($_SESSION["temp_page_fields"]['img_alt_text']);; ?>" />
                    </div>
	 			</div>

			</fieldset>
            
			<fieldset>
				<legend>Tool Properties</legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Tool name</label>
					</div>
					<div class="twocols">
						<input type="text" id="name" name="name" value="<?php echo stripslashes($_SESSION['temp_page_fields']['name']); ?>" />
					</div>
				</div>
				<label>Tool Description</label>
				<textarea  cols="88" id="description" name="description"><?php echo stripslashes($_SESSION['temp_page_fields']['description']) ?></textarea>
			</fieldset>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="edit_installation_tool" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
		</div>
	</form>
</div>
</body>
</html>

