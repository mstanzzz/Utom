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

$page_title = "Fax Us";
$page_group = "fax";
$page = "we-design-fax";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

$we_design_fax_id = (isset($_REQUEST['we_design_fax_id'])) ? $_REQUEST['we_design_fax_id'] : 0;

// add if not exist
$sql = "SELECT we_design_fax_id FROM we_design_fax WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO we_design_fax 
		(last_update, profile_account_id) 
		VALUES ('".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$we_design_fax_id = $db->insert_id;
}

if(!isset($_SESSION['we_design_fax_id'])) $_SESSION['we_design_fax_id'] = $we_design_fax_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$new_uploaded_file_id = (isset($_GET["new_uploaded_file_id"])) ? $_GET["new_uploaded_file_id"] : 0;



if($new_uploaded_file_id > 0){
	$_SESSION['temp_page_fields']['download_form_file_id'] = $new_uploaded_file_id; 
}
$new_img_id = (isset($_GET['new_img_id'])) ? $_GET['new_img_id'] : 0;
if($new_img_id > 0){
	$_SESSION['temp_page_fields']['form_img_id'] = $new_img_id; 
}


if(isset($_POST['edit_we_design_fax'])){
	$content = trim(addslashes($_POST['content'])); 
	$we_design_fax_id = $_POST['we_design_fax_id'];
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (' ', '-' , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));

	$design_fax_number = trim(addslashes($_POST['design_fax_number']));
	$download_form_file_id = $_POST['download_form_file_id'];
	$form_img_id = $_POST['form_img_id'];
	$img_id = $_POST['img_id'];

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/cms/insert_page_seo.php');

	
//echo $sql;
	
//echo "<br />";
//echo $_SESSION['profile_account_id'];
	

//if(in_array(2,$user_functions_array)){
	// create a backup
	//$backup = new Backup;
	//$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = sprintf("UPDATE we_design_fax 
						SET  content = '%s'
							,design_fax_number = '%s'
							,download_form_file_id = '%u'
							,form_img_id = '%u'
							,img_id = '%u'
							,last_update = '%u'
						WHERE we_design_fax_id = '%u'", 
						$content
						,$design_fax_number
						,$download_form_file_id
						,$form_img_id
						,$img_id
						,time()
						,$we_design_fax_id);
		$msg = "Your change is now live.";
	/*
	}else{

		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id, profile_account_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u','%u' )", 
			"about_us", $ts, $user_id, "about-us", $content, $img_id, $about_us_id, $_SESSION['profile_account_id']);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
		

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");
	
	unset($_SESSION['temp_page_fields']);

}


	
 	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT content
				,design_fax_number
				,download_form_file_id
				,form_img_id 
    FROM we_design_fax 
 	WHERE we_design_fax_id = '".$_SESSION['we_design_fax_id']."'";

    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$content = $object->content;
		$design_fax_number = $object->design_fax_number;		
		$download_form_file_id = $object->download_form_file_id;
		$form_img_id = $object->form_img_id;
		$img_id = $object->form_img_id;		
	}else{
		$content = '';
		$design_fax_number = '';
		$download_form_file_id = 0;
		$form_img_id = 0;
		$img_id = 0;
	}


	if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;
	
	if(!isset($_SESSION['temp_page_fields']['download_form_file_id'])) $_SESSION['temp_page_fields']['download_form_file_id'] = $download_form_file_id;
	
	
	
	if(!isset($_SESSION['temp_page_fields']['form_img_id'])) $_SESSION['temp_page_fields']['form_img_id'] = $form_img_id;
	if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
	if(!isset($_SESSION['temp_page_fields']['design_fax_number'])) $_SESSION['temp_page_fields']['design_fax_number'] = $design_fax_number;

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/cms/get_seo_variables.php');

	if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
	if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
	if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
	if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
	if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

function validate(theform){
			
	return true;
}


/*
function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}
*/


$(document).ready(function() {
	
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 920	
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
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

	});
	


	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});


});




function ajax_set_page_session(){
	
	var q_str = "?page=we-design-fax"+get_query_str();
		
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
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	//query_str += "&img_alt_text="+$("#img_alt_text").val(); 
	query_str += "&content="+escape(tinyMCE.get('wysiwyg').getContent());
	
	query_str += "&design_fax_number="+$("#design_fax_number").val(); 
		
	query_str += "&seo_name="+document.form.seo_name.value; 
	query_str += "&title="+document.form.title.value.replace('&', '%26'); 
	query_str += "&keywords="+document.form.keywords.value.replace('&', '%26'); 
	query_str += "&description="+document.form.description.value.replace('&', '%26'); 
	
	
	
	
	return query_str;
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




/*

	echo	"content".$content."<br />";
	echo	"design_fax_number".$design_fax_number."<br />";
	echo	"download_form_file_id".$download_form_file_id."<br />";
	echo	"form_img_id".$form_img_id."<br />";
	echo	"img_id".$img_id."<br />";

*/

?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php'); ?>
	</div>
	<div class="manage_main">
	<?php 
	
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root."manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", $ste_root."manage/cms/pages/page.php");
		$bread_crumb->add("Fax", '');
        echo $bread_crumb->output();

	
	
	
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        ?>
	<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_we_design_fax" value="1">        
		<input type="hidden" name="we_design_fax_id" value="<?php echo $_SESSION['we_design_fax_id']; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="hidden" name="ret_page" value="we-design-fax">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="content_table" value="we_design_fax">
		<input type="hidden" name="download_form_file_id" value="<?php echo $_SESSION['temp_page_fields']['download_form_file_id']; ?>">        
		<input type="hidden" name="form_img_id" value="<?php echo $_SESSION['temp_page_fields']['form_img_id']; ?>">
        <input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
        
		<div class="page_actions edit_page"> 
            <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
            <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
            
            <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
            <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
			<hr />
			<?php 
			if($_SESSION['is_ssl']){ 
				$checked = ($mssl)? "checked=checked" : ''; 		
			?>
			<label>Set Page as SSL</label>
			<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
				<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
			</div>
			<?php } ?>
			<a href="<?php echo $ste_root;?>/manage/cms/design-services/design-services-pages.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>
		<div class="page_content edit_page">
            
            
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input id='page_heading' type="text" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                        


                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Downloadable File</label>
                            </div>
                            <div class="twocols">
                               <?php 
							   
							   
							   //echo $_SESSION['temp_page_fields']['download_form_file_id'];
							   
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "SELECT uploaded_file_name
								FROM uploaded_file 
								WHERE uploaded_file_id = '".$_SESSION['temp_page_fields']['download_form_file_id']."'";							
						$result = $dbCustom->getResult($db,$sql);								
								if($result->num_rows > 0){
									$object = $result->fetch_object();
									$file_name = $object->uploaded_file_name;
								}else{
									$file_name = '';
								}
								
								//echo $file_name;
								
							   
							   echo "<a href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$file_name."' target='_blank'>".$file_name."</a>";
					echo "<br />";
			echo "<a href='../upload.php?ret_page=we-design-fax&ret_dir=pages&action=download' class='btn btn-primary btn-large fancybox fancybox.iframe'>
			<i class='icon-plus icon-white'></i> Add New Downloadable File </a>";


							   ?>
                            </div>
                        </div>



                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Banner Image</label>
                            </div>
                            <div class="twocols">
                               <?php 
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "SELECT file_name
								FROM image 
								WHERE img_id = '".$_SESSION['img_id']."'";							
						$result = $dbCustom->getResult($db,$sql);								
								if($result->num_rows > 0){
									$object = $result->fetch_object();
									$file_name = $object->file_name;
								}else{
									$file_name = '';
								}
							   echo "<img src='".$ste_root."/saascustuploads/".$$_SESSION['profile_account_id']."/cms/".$file_name."' alt='displayed banner image'>"; 
							   
					echo "<br />";
			
			
			echo "<a href='".$ste_root."manage/upload-pre-crop.php?ret_page=we-design-fax&ret_dir=cms/pages' class='btn btn-primary btn-large fancybox fancybox.iframe'>
			<i class='icon-plus icon-white'></i> Add New Banner Image </a>";


							   ?>
                            </div>
                        </div>



                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Displayed Form Image</label>
                            </div>
                            <div class="twocols">
                               <?php 
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "SELECT file_name
								FROM image 
								WHERE img_id = '".$_SESSION['temp_page_fields']['form_img_id']."'";							
						$result = $dbCustom->getResult($db,$sql);								
								if($result->num_rows > 0){
									$object = $result->fetch_object();
									$file_name = $object->file_name;
								}else{
									$file_name = '';
								}
								
								//echo $file_name; 
								
							   echo "<img src='".$ste_root."/ul_cms/".$domain."/".$file_name."' alt='displayed form image'>"; 
					echo "<br />";
			echo "<a href='../upload.php?ret_page=we-design-fax&ret_dir=pages&slug=we-design-fax' class='btn btn-primary btn-large fancybox fancybox.iframe'>
			<i class='icon-plus icon-white'></i> Add New Displayed Sample File </a>";


							   ?>
                            </div>
                        </div>


                <div class="colcontainer"> 
                    <textarea id="wysiwyg" class="wysiwyg" name="content"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['content']); ?></textarea>
                </div>
                
                <div class="colcontainer formcols">
                    <div class="twocols">
	                    <label>Design Fax Number</label>
                    </div>
                    <div class="twocols">
    	                <input id='design_fax_number' type="text" name="design_fax_number"  value="<?php echo stripslashes($_SESSION['temp_page_fields']['design_fax_number']); ?>">            
                    </div>
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
	<h3>Are you sure you want to delete this breadcrumb?</h3>
	<form name="del_bc_form" action="we-design=fax.php" method="post" target="_top">
		<input id="del_bc_id" class="itemId" type="hidden" name="del_bc_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_bc" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
