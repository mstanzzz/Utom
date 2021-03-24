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


$page_title = "Downloads Page";
$page_group = "downloads-page";
$page = "downloads";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$ts = time();

$downloads_page_id = (isset($_GET['downloads_page_id'])) ? $_GET['downloads_page_id'] : 0;

// add if not exist
$sql = "SELECT downloads_page_id FROM downloads_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO downloads_page 
		(last_update, profile_account_id) 
		VALUES ('".$ts."', '".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$about_us_id = $db->insert_id;
}


if(!isset($_SESSION['downloads_page_id'])) $_SESSION['downloads_page_id'] = $downloads_page_id;




$msg = '';


if(isset($_POST['edit_downloads_page'])){
	
	$content = trim(addslashes($_POST['content'])); 
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id']: 0;	
	
	//echo $_POST['img_id'];
	
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	$downloads_page_id = $_POST['downloads_page_id'];

	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (' ', '-', $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST['page_heading']));

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = sprintf("UPDATE downloads_page 
					SET  content = '%s'
						,img_id = '%u'
						,img_alt_text = '%s'
						,last_update = '%u' 
					WHERE downloads_page_id = '%u'", 
				$content
				,$img_id
				,$img_alt_text
				,time()
				,$downloads_page_id);
	$msg = "Your change is now live.";

	$result = $dbCustom->getResult($db,$sql);
		


	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");
	
	unset($_SESSION['temp_page_fields']);	
}


if(isset($_POST["edit_download"])){
	$title = trim(addslashes($_POST['title']));
	$description = trim(addslashes($_POST['description']));
	$external_url = trim(addslashes($_POST["external_url"]));
	$download_id = $_POST["download_id"];
	$hide = $_POST["hide"];


	//if(in_array(2,$user_functions_array)){
		// create a backup
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
		
		$sql = sprintf("UPDATE download SET title = '%s', description = '%s', external_url = '%s', hide = '%u' WHERE download_id = '%u'", 
		$title, $description, $external_url, $hide, $download_id);
		$msg = "Your change is now live.";

	//}else{
		/*
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
			"about_us", $ts, $user_id, "about-us", $content, $img_id, $about_us_id);
		$msg = "Your change is now pending approval.";
		*/
	//}
	
	$result = $dbCustom->getResult($db,$sql);
		
	
}
	
	

if(isset($_POST["del_file_id"])){
	
	
	$download_id = $_POST['del_file_id'];
	
	//echo $download_id; exit;
	// get the file name
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = sprintf("SELECT file_name FROM download 
					WHERE download_id = '%u' ", $download_id);

	$fn_res = mysql_query($sql);	
	if(!$fn_res)die(mysql_error($fn_res));
	if(mysql_num_rows($fn_res) > 0){
		$fn_obj = mysql_fetch_object($fn_res);	
		$file_name = $fn_obj->file_name;
	//echo $file_name; 
		
		$sql = sprintf("DELETE FROM download 
						WHERE download_id = '%u'", $download_id);

		$result = $dbCustom->getResult($db,$sql);	
		
	
		// remove from dir
		$myFile = $ste_root."/ul_cms/".$domain."/$file_name";
		if(file_exists($myFile)) unlink($myFile);
	}
	else {
		$msg = "An error occurred, and the file was not deleted.";	
	}
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


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT content, img_id, img_alt_text
FROM downloads_page 
WHERE downloads_page_id = '".$_SESSION['downloads_page_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
	$img_id = $object->img_id;
	$img_alt_text = $object->img_alt_text;
}else{
	$content = '';
	$img_id = 0;
	$img_alt_text = '';
}

//echo $img_id;

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = $img_id;
if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;

require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>


$(document).ready(function() {

	$('.fancybox').click(function(){		
		
		ajax_set_page_session();
	
	});

});

function ajax_set_page_session(){
	
	var q_str = "?page=downloads-page"+get_query_str();
		
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
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26'); 
	query_str += "&content="+escape(tinyMCE.get('content').getContent());
	
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


<style>

.confirm-content2{
  display: none;
  width: 250px;
  height: auto;
  background-color: #ffffff;
  padding: 15px;
  border: 2px solid #caeefe;
  position: fixed;
  top: 22%;
  left: 40%;
  -webkit-box-shadow: 0px 4px 8px 1px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 4px 8px 1px rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
  border-radius: 4px;
}
.confirm-content .dismiss{
  float: left;
  margin: 0px 15px;
}

</style>

</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");
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
		$bread_crumb->add("Downloads Page", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

        ?>

		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="edit_downloads_page" value="1"> 
      	<input type="hidden" name="page" value="<?php echo $page; ?>">
		<input type="hidden" name="ret_page" value="download">
		<input type="hidden" name="ret_dir" value="manage/cms/pages">
		<input type="hidden" name="content_table" value="downloads-page"> 
   		<input type="hidden" name="downloads_page_id" value="<?php echo $_SESSION['downloads_page_id']; ?>">

             
			<div class="page_actions">
				<a href="<?php echo $ste_root;?>/manage/cms/upload.php?ret_page=downloads-page&ret_dir=pages&action=download" 
                class="btn btn-primary btn-large fancybox fancybox.iframe"><i class="icon-plus icon-white"></i> Add New Download </a>

                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

                <!--<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>-->
                <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>


				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

				<?php if($_SESSION['is_ssl']){ ?>
				<label>Set Page as SSL</label>
				<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
					<input type="checkbox" class="checkboxinput" name="mssl" value="1" checked="checked" />
				</div>
				<?php } ?>
			</div>
            
            <fieldset class="edit_content">
                <legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                
                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input id="page_heading" type="text" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                <div class="colcontainer"> 
                	<label>Intro Content</label>
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
                            WHERE slug = 'downloads-page'
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
                            <a class='btn btn-danger confirm2' href='#'> 
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
                            href="<?php echo $ste_root;?>/manage/cms/upload.php?ret_page=downloads-page&ret_dir=pages&img_max_width=450">
                            <i class="icon-plus icon-white"></i> Add New Image</a> 
                    </div>

                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Image Alt Tag Text</label>
                            </div>
                            <div class="twocols">
                                <input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo stripslashes($_SESSION['temp_page_fields']['img_alt_text']);; ?>" />
                            </div>
                        </div>


				</fieldset>

            
            
			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="25%">Label</th>
							<th width="40%">File Name</th>
							<th width="15%">Active</th>
							<th width="15%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
					$sql = "SELECT * FROM download
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);					
					while($row = $result->fetch_object()) {
						$block = "<tr>";
						//label
						$block .= "<td valign='middle'>$row->title</td>";
						//file name
						$block .= "<td valign='middle'><a href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$row->file_name."' target='_blank' style='text-decoration:none'>$row->file_name</a></td>";
						//active	
						if($row->hide){
							$show_hide = "Hidden";
						}else{
							$show_hide = "<span style='color:red'>Live</span>";	
						}
						$block .= "<td valign='middle'>$show_hide</td>";
						//edit btn
						$block .= "<td valign='middle'><a class='btn btn-primary fancybox fancybox.iframe' 
						href='edit-download.php?download_id=".$row->download_id."&ret_page=downloads-page'><i class='icon-cog icon-white'></i> Edit</a></td>";
						//delete btn	
						$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->download_id."' 
						class='itemId' value='".$row->download_id."' /></a></td>";
						$block .= "</tr>";
						
						echo $block;
				
					}
					
					
					?>
			</table>
			</div>
			<div class="page_content edit_page">
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
		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
</div>  
<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>  


<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this download?</h3>
	<form name="del_file_form" action="downloads-page.php" method="post" target="_top">
		<input id="del_file_id" class="itemId" type="hidden" name="del_file_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_page" type="submit" >Yes, Delete</button>
	</form>
</div>



<div id="content-delete2" class="confirm-content2" style="display:none;">
	<h3>Are you sure you want to delete this image?</h3>
	<form name="del_img_form" action="downloads-page.php" method="post" target="_top">
		<input id="del_img_id" class="itemId" type="hidden" name="del_img_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_img" type="submit" >Yes, Delete</button>
	</form>
</div>



<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

   
</body>
</html>



