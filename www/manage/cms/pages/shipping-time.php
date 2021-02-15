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

$page_title = "Edit: Shipping Time";
$page_group = "shipping-time";
$page = "shipping-time";

	// this entire page is commented out? broke all the JS because it didn't know what $current_dir was.
	// so I copied this bit so that it would know $current_dir.
	//
	$currentFile = $_SERVER['PHP_SELF'];
	
	$parts = Explode('/', $currentFile);
	$current_page = $parts[count($parts) - 1];	
	$current_dir = $parts[count($parts) - 2];	
	$current_up_dir = $parts[count($parts) - 3];	
    

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$ts = time();

// add if not exist
$sql = "SELECT shipping_time_id FROM shipping_time WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO shipping_time 
		(content, description, last_update, profile_account_id) 
		VALUES ('Add Content', 'Add description', '".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST['edit_shipping_time'])){
	
	$content_short1 = trim(addslashes($_POST['content_short1']));
	$content = trim(addslashes($_POST['content'])); 
	$shipping_time_id = $_POST['shipping_time_id'];
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0;
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));
	
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");
	
	//if(in_array(2,$user_functions_array)){
		// create a backup
		//$backup = new Backup;
		//$dbu = $backup->doBackup($shipping_time_id,$user_id,"shipping_time");	
		$sql = sprintf("UPDATE shipping_time SET description = '%s', content = '%s',  img_id = '%u', img_alt_text = '%s' WHERE shipping_time_id = '%u'", 
		$content_short1, $content,  $img_id, $img_alt_text, $shipping_time_id);
				
		$msg = "Your change is now live.";
	/*
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, content1, img_id, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%s','%u','%u')", 
			"shipping_time", $ts, $user_id, "shipping-time", $description, $content, $img_id, $shipping_time_id);
		$msg = "Your change is now pending approval.";
	}
	
	*/
	$result = $dbCustom->getResult($db,$sql);
		
	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");
	
	unset($_SESSION['temp_page_fields']);	

}


if(isset($_POST['del_img_id'])){

	$del_img_id = (isset($_POST['del_img_id']))? $_POST['del_img_id'] : 0;	
	//echo $del_img_id;

	$sql = "SELECT file_name FROM image WHERE img_id = '".$del_img_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();		
		$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$object->file_name;	
		if(file_exists($p)) unlink($p);
	}

	$sql = "DELETE FROM image 
	WHERE img_id = '".$del_img_id."'";
$result = $dbCustom->getResult($db,$sql);	

}


	$this_shipping_time_id = (isset($_GET['shipping_time_id'])) ? $_GET['shipping_time_id'] : 0;
	if(!isset($_SESSION['shipping_time_id'])) $_SESSION['shipping_time_id'] = $this_shipping_time_id; 


	$sql = "SELECT * 
    FROM shipping_time
 	WHERE shipping_time_id = '".$_SESSION['shipping_time_id']."'";
    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content = $object->content;
		$img_id = $object->img_id; 
		$content_short1 = $object->description;
		$img_alt_text = $object->img_alt_text;
	}else{
		$content = '';
		$img_id = 0; 
		$content_short1 = '';
		$img_alt_text = '';

	}
	

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");

	if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
	if(!isset($_SESSION['temp_page_fields']['content_short1'])) $_SESSION['temp_page_fields']['content_short1'] = $content_short1;
	if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;

	if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
	if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;
	
	
	
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

<script>
	
$(document).ready(function() {

	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
	
	$('#add_img').click(function(){	
		ajax_set_page_session();
	});
	
});

function ajax_set_page_session(){
	
		var q_str = "?page=shipping-time"+get_query_str();
		//alert(q_str);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_page_session.php'+q_str,
		  success: function(data) {
				//alert(data);
		  }
		});
}


function get_query_str(){
	
	var query_str = '';
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	query_str += "&content_short1="+escape(tinyMCE.get('content_short1').getContent());
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26');
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26');
	
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
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
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false
	});



function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

function validate(theform){
	
	if(theform.name == "add_shipping_time"){
		
		//alert(theform.name);
		var imgIdFailed = true;
		for(var i=0; i<theform.elements['img_id'].length; i++){			
			var radio = theform.elements['img_id'][i];
			if(radio.checked){
				failed = false;
				imgIdFailed = false;
			}
		}
		
		if(imgIdFailed){
			alert("Please click on the image that goes with this entry");
			return false;				
		}
		
	}
	
	return true;
}



function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = '<?php echo $current_page; ?>';
  document.form.target = '_self';
  document.form.submit(); 
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
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Shipping Time", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        ?>
		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_shipping_time" value="1">        
		<input type="hidden" name="shipping_time_id" value="<?php echo $_SESSION['shipping_time_id']; ?>">
		<input type="hidden" name="ret_page" value="shipping-time">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="page" value="<?php echo $page; ?>"> 
		<input type="hidden" name="content_table" value="shipping_time"> 
    
			<div class="page_actions edit_page"> 
	           <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
                
                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>


				<hr />
				<!-- I'm not sure if this was being used or not, but I left it in. You can just hide it or get rid of it if this feature isn't going to be released.-->
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				<?php 
                if($_SESSION['is_ssl']){ 
                    $checked = ($mssl)? "checked=checked" : ''; 		
                ?>
                <label>Set Page as SSL</label>
                <div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                    <input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
                </div>
                <?php } ?>
            </div>

			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Page Name</label>
						</div>
						<div class="twocols">
							<input id="page_heading" type="text" name="page_heading" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['page_heading']); ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<textarea id="content" class="wysiwyg" name="content"><?php echo stripslashes($_SESSION['temp_page_fields']['content']); ?></textarea>
					</div>
				</fieldset>
				<fieldset class="edit_images">
					<legend>Page Images <i class="icon-minus-sign icon-white"></i></legend>
                    <div class="colcontainer">
						<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                        $sql = "SELECT * 
                                FROM image 
                                WHERE slug = 'shipping-time'
                                AND profile_account_id = '".$_SESSION['profile_account_id']."'
                                ORDER BY img_id";
                        $img_res = $dbCustom->getResult($db,$sql);
                        ;
                        $i = 1;
                        while($img_row = $img_res->fetch_object()) {
					?>
							
						<div style="float:left; padding:10px;">
							<?php   	
                            echo "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_row->file_name."' width='120px' />"; 
                            $checked = ($img_id == $img_row->img_id) ? "checked=checked" : '';  
                            ?>
                        </div>
						<div style="float:left; padding:10px;">                            
                            <div class='radiotoggle on'>
                                <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                                <input type="radio" class="radioinput" name="img_id" value="<?php echo $img_row->img_id; ?>" <?php echo $checked ?>/>
                            </div>
                        </div>
						<div style="float:left; padding:10px;">                        
                            <a class='btn btn-danger confirm' href='#'> 
                                <i class='icon-remove icon-white'></i>
                                <input type='hidden' class='itemId' value="<?php echo $img_row->img_id; ?>" id="<?php echo $img_row->img_id; ?>" />
                            </a>
                        </div>
                        <div style="clear:both;"></div>
                        <hr />
                        <?php					
                        }
                        ?>
                            <a id="add_img" class="btn btn-large btn-primary fancybox fancybox.iframe" 
                            href="<?php echo $ste_root;?>/manage/cms/upload.php?ret_page=shipping-time&ret_dir=<?php echo $current_dir; ?>"><i class="icon-plus icon-white"></i> Add New Image</a> 
                    </div>
                   <div class="colcontainer formcols">
                        <div class="twocols">
                            <label>Image Alt Tag Text</label>
                        </div>
                        <div class="twocols">
                            <input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION["temp_page_fields"]['img_alt_text']); ?>" />
                        </div>
                    </div>
                    
                    
					<div class="colcontainer">
						<label>Text to appear under the images:</label>
						<textarea id="content_short1" class="wysiwyg small" name="content_short1" ><?php echo $_SESSION['temp_page_fields']['content_short1']; ?></textarea>
					</div>

				</fieldset>
			
	        <?php 
			$page_heading = $_SESSION['temp_page_fields']['page_heading'];
			$seo_name = $_SESSION['temp_page_fields']['seo_name'];
			$title = $_SESSION['temp_page_fields']['title'];
			$keywords = $_SESSION['temp_page_fields']['keywords'];	
			$description = $_SESSION['temp_page_fields']['description'];
			require_once("edit_page_seo.php"); 
    	    require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); 
			?>
			</div>
		</form>
</div>

<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
    
</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this image?</h3>
	<form name="del_img_form" action="shipping-time.php" method="post" target="_top">
		<input id="del_img_id" class="itemId" type="hidden" name="del_img_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_img" type="submit" >Yes, Delete</button>
	</form>
</div>
</body>
</html>



