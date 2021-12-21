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


$page_title = "Add Home Banner";
$page_group = '';

	

	

if(isset($_GET['firstload'])){
	$_SESSION['img_id'] =  0;
}

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
//echo $new_img_id;

if(!isset($_SESSION['temp_banner_fields']['title'])) $_SESSION['temp_banner_fields']['title'] = '';
if(!isset($_SESSION['temp_banner_fields']['url'])) $_SESSION['temp_banner_fields']['url'] = '';
if(!isset($_SESSION['temp_banner_fields']['description'])) $_SESSION['temp_banner_fields']['description'] = '';
if(!isset($_SESSION['temp_banner_fields']['img_alt_text'])) $_SESSION['temp_banner_fields']['img_alt_text'] = '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

?>
<script>

$(document).ready(function() {


});

function validate(theform){	
/*
	var title = jQuery.trim(theform.title.value);
	if(title == ''){
		alert("Please enter a title");
		return false;				
	}
*/
	return true;
}

function get_query_str(){
	
	var query_str = '';
	query_str += "?title="+document.form.title.value; 
	query_str += "&url="+document.form.url.value; 
	query_str += "&description="+tinyMCE.get('wysiwyg').getContent();
	query_str += "&img_alt_text="+document.form.img_alt_text.value; 


	return query_str;
}




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


function goto_isfancybox(url){

	var q_str = get_query_str();

	//alert(q_str);

	if (window.top.location != window.location) {
		url+="&fromfancybox=1";
	}
	

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_banner_session.php'+q_str,
	  success: function(data) {
		//alert(data);
	  	location.href = url;
		  
	  }
	});

	//location.href = url;
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
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
	
    
    <form name="form" action="home.php" method="post" onSubmit="return validate(this)" target="_parent"  enctype="multipart/form-data">
        <input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>" />
        
     		<div class="page_actions edit_page">
				
			<button class="btn btn-large btn-success" name="add_banner" type="submit" ><i class="icon-ok icon-white"></i> Save Changes </button>

            <a style="width:118px;" class="btn btn-large" href="home.php" target="_parent">Cancel</a>			
            </div>
			
            <h2>Add New Home Page Image Banner</h2>
			<fieldset>
            	<div class="colcontainer">
					<legend>Image</legend>
				
                <!--   
		          
                <a id="add_img">SITEROOT</a>
                
      				<a id="add_img" class="btn btn-primary" href='<?php echo SITEROOT; ?>manage/upload-pre-crop.php?ret_page=add-home-banner&ret_dir=cms/pages'> Upload a New Image </a>
					
                -->    
                    
                    
                	<!--<div class="twocols">
						<a class="btn btn-primary" href='select-image.php?ret_page=add-home-banner'> Select Existing Image </a>
					</div>-->
					<?php			
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						;
						if($img_res->num_rows){
						$img_obj = $img_res->fetch_object();
							echo "<br /><img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/large/".$img_obj->file_name."'><br />";
						}
					?>
                    <br />
                    
                    <a onClick="goto_isfancybox('<?php echo SITEROOT; ?>manage/upload-pre-crop.php?ret_page=add-home-banner&ret_dir=cms/pages')" class="btn btn-primary">
                    <i class="icon-plus icon-white"></i>Upload new Image</a>
                        
                    </div>
			</fieldset>
            
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Image Alt Tag Text</label>
				</div>
				<div class="twocols">
					<input type="text"  name="img_alt_text" value="<?php echo stripslashes($_SESSION['temp_banner_fields']['img_alt_text']); ?>" />
				</div>
			</fieldset>
            
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Title</label>
				</div>
				<div class="twocols">
					<input type="text"  name="title" value="<?php echo stripslashes($_SESSION['temp_banner_fields']['title']); ?>" />
				</div>
			</fieldset>
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>URL</label>
				</div>
				<div class="twocols">
					<input type="text"  name="url" value="<?php echo $_SESSION['temp_banner_fields']['url'] ?>" />
					<p><em>(type http:// for outside URLs, otherwise do not include the domain)</em></p>
				</div>
			</fieldset>
            
                <div class="colcontainer">
                    If there is a category url, selectable page and custom url will be ignored.<br />
                    <label>Category URL</label>
                    <?php require_once($real_root."/manage/cms/radio-tree-snippet.php");  ?>
                </div>

            
			<fieldset class="colcontainer formcols">
				<div class="twocols">
					<label>Description</label>
				</div>
				<div class="twocols">
                   	<textarea name="description" class="wysiwyg" id="wysiwyg"><?php echo stripslashes($_SESSION['temp_banner_fields']['description']); ?></textarea>
				</div>
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



