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


$page_title = "Add New Installation Step";
$page_group = "installation";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$_SESSION['new_img_id'] = (isset($_SESSION['new_img_id']))? $_SESSION['new_img_id'] : 0;

if(!$_SESSION['new_img_id']){
	$_SESSION['img_id'] = 0;	
}else{
	$_SESSION['img_id'] = $_SESSION['new_img_id'];	
}
  
if(isset($_GET["firstload"])){
	unset($_SESSION['temp_page_fields']);		
}

if(!isset($_SESSION['temp_page_fields']['name'])) $_SESSION['temp_page_fields']['name'] = '';
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = '';
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = '';

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
	query_str += "&description="+escape(tinyMCE.get('wysiwyg').getContent());
	
	return query_str;
}

</script>
</head>
<body>
<?php 

	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php require_once($real_root.'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<form name="add_installation_step" action="installation-steps.php" method="post" target="_top">
		<input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
		
		    <div class="page_actions">
            
			<button class="btn btn-large btn-success" name="edit_installation_step" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
            <a href="<?php echo SITEROOT;?>/manage/cms/pages/installation-steps.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

            </div>
        
        
			<h2>Add Installation Step</h2>
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
                        $url_str .= "?ret_page=add-installation-step";
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
				<legend>Step Properties</legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Step name</label>
					</div>
					<div class="twocols">
						<input type="text" id="name" name="name" value="<?php echo stripslashes($_SESSION['temp_page_fields']['name']) ?>" />
					</div>
				</div>
				<label>Step Description</label>
				<textarea class="wysiwyg small" id="wysiwyg" name="description"><?php echo $_SESSION['temp_page_fields']['description'] ?></textarea>
			</fieldset>
		
		
	</form>
</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
