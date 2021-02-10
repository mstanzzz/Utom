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


$page_title = "Add New Blog Post";
$page_group = "blog";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$is_new_img = (isset($_GET['is_new_img'])) ? 1 : 0;

$new_img_id =  (isset($_SESSION['new_img_id'])) ? $_SESSION['new_img_id'] : 0;

if($is_new_img && $new_img_id > 0){
	$img_id = $new_img_id;
}else{
	$img_id = 0;
}

if(isset($_POST["remove_img"])){
	$img_id = 0;
}


if(!isset($_SESSION["temp_blog_fields"]['title'])) $_SESSION["temp_blog_fields"]['title'] = '';
if(!isset($_SESSION["temp_blog_fields"]["user_id"])) $_SESSION["temp_blog_fields"]["user_id"] = 0;
if(!isset($_SESSION["temp_blog_fields"]["substitute_by"])) $_SESSION["temp_blog_fields"]["substitute_by"] = '';
if(!isset($_SESSION["temp_blog_fields"]["blog_cat_id"])) $_SESSION["temp_blog_fields"]["blog_cat_id"] = 0;
if(!isset($_SESSION["temp_blog_fields"]["type"])) $_SESSION["temp_blog_fields"]["type"] = "blog";
if(!isset($_SESSION["temp_blog_fields"]["content"])) $_SESSION["temp_blog_fields"]["content"] = '';



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script language="javascript" type="text/javascript">




$(document).ready(function() {

	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});
	

	$('#add_img').click(function(){
		ajax_set_blog_session();
	});

	$('#remove_img').click(function(){
		ajax_set_blog_session();
	});

});

function ajax_set_blog_session(){
	
		var q_str = get_query_str();
				
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_blog_session.php'+q_str,
		  success: function(data) {
				//alert(data);
		  }
		});
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
		forced_root_block : false
	});



function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function setRegularSubmit() {
  document.form.action = 'blog.php';
  document.form.target = '_self'; 
}

function get_query_str(){
	
	var query_str = '';
	query_str += "?title="+document.form.title.value; 
	query_str += "&user_id="+document.form.user_id.value; 
	query_str += "&substitute_by="+document.form.substitute_by.value; 
	query_str += "&blog_cat_id="+document.form.blog_cat_id.value; 
	query_str += "&type="+document.form.type.value; 
	query_str += "&content="+tinyMCE.get('wysiwyg').getContent(); 
	
	return query_str;
}

</script>
</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>

<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
                $url_str = $ste_root."manage/upload-pre-crop.php";               				
                $url_str .= "?ret_page=add-blog";
				$url_str .= "&ret_dir=cms/blog";
				$url_str .= "&upload_new_img=1";
        ?>
		<form name="form" action="blog.php" method="post">
			<input type="hidden" name="img_id" value="<?php echo $img_id; ?>" />
            <input type="hidden" name="ret_page" value="add-blog">
            <input type="hidden" name="ret_dir" value="manage/cms/blog">
            <input type="hidden" name="content_table" value="blog_post"> 
 
			<div class="page_actions edit_page"> 
				<a href="<?php echo $url_str; ?>" id="add_img" class="btn btn-large btn-primary fancybox fancybox.iframe" ><i class="icon-plus icon-white"></i> Add Image </a>
				<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
				<button onClick="setRegularSubmit();" href="#" class="btn btn-success btn-large" name="add_blog" ><i class="icon-ok icon-white"></i> Save </button>
				<hr />
				<a href="blog.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back </a>

            </div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Post Content <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Post Title</label>
						</div>
						<div class="twocols">
							<input type="text" name="title" value="<?php echo prepFormInputStr($_SESSION["temp_blog_fields"]['title']); ?>" maxlength="255" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Posted By</label>
						</div>
						<div class="twocols">
							<?php
							$db = $dbCustom->getDbConnect(USER_DATABASE);
							$sql = "SELECT name, id 
									FROM user 
									WHERE user_type_id > '2'
									AND profile_account_id = '".$_SESSION['profile_account_id']."'";
							$result = $dbCustom->getResult($db,$sql);
							
							$block = ''; 
							$block .= "<select name='user_id'>";
							$block .= "<option value='0'></option>";
							while($row = $result->fetch_object()) {
								$sel = ($_SESSION["temp_blog_fields"]["user_id"] == $row->id)? "selected" : '';
								$block .= "<option value='".$row->id."'".$sel.">".$row->name."</option>";
							}
							$block .= "</select>";			
							echo $block;
							?>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Substitute Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="substitute_by" value="<?php echo prepFormInputStr($_SESSION["temp_blog_fields"]["substitute_by"]); ?>" maxlength="80" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Category</label>
						</div>
						<div class="twocols">
							<?php
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "SELECT * FROM blog_category";
								$result = $dbCustom->getResult($db,$sql);
								$block = "<select name='blog_cat_id'>";
								while($row = $result->fetch_object()) {
									$sel = ($_SESSION["temp_blog_fields"]["blog_cat_id"] == $row->blog_cat_id)? "selected" : '';         
									$block .= "<option value='".$row->blog_cat_id."'".$sel.">".$row->name."</option>";
								}
								$block .= "</select>";			
								echo $block;
							?>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
						<label>Type</label>
						</div>
						<div class="twocols">
							<select name='type'>
								<option value="blog" <?php if($_SESSION["temp_blog_fields"]["type"] == "blog") echo "selected"; ?>>blog</option>
								<option value="news" <?php if($_SESSION["temp_blog_fields"]["type"] == "news") echo "selected"; ?>>news</option>
							</select>
						</div>
					</div>
					<div class="colcontainer">
						<textarea id="wysiwyg" class="wysiwyg" name="content"><?php echo stripAllSlashes($_SESSION["temp_blog_fields"]["content"]); ?></textarea>
					</div>
				</fieldset>
				<fieldset class="edit_images">
					<legend>Post Images <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
					 <?php
					 
					
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$img_id."'";
						$img_result = mysql_query($sql);
						;
						if($img_res->num_rows){
							$img_obj = $img_res->fetch_object();
						
							//echo $img_obj->file_name;
							echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'>";
						}
					?>
					</div>
                    <?php if($img_res->num_rows > 0){ ?>
                        <div class="colcontainer">
	                        <a class='btn btn-danger confirm no-item' id="remove_img">Remove Image</a>
                        </div>
                    <?php } ?>


				</fieldset>
			</div>
		</form>
	</div>

                <div id="content-delete" class="confirm-content">
                    <h3>Are you sure you want to delete this image?</h3>
                    <form name="remove_img" action="edit-blog.php" method="post">
                        <a class="btn btn-large dismiss">No, Cancel</a>
                        <button class="btn btn-danger btn-large" name="remove_img" type="submit" >Yes, Delete</button>
                    </form>
                </div>


 <p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>


