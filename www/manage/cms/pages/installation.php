<?php



if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site';
}else{
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Installation: Edit Introduction";
$page_group = "installation";
$page = "installation";

	


$this_installation_id = (isset($_GET['installation_id'])) ? $_GET['installation_id'] : 0;
if(!isset($_SESSION["installation_id"])) $_SESSION["installation_id"] = $this_installation_id; 

//echo $_SESSION["installation_id"];

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$ts = time();
// add if not exist
$sql = "SELECT installation_id FROM installation WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO installation
			(content, profile_account_id)
			VALUES ('Add Content', '".$_SESSION['profile_account_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	
}


/*
$sql = "SELECT installation_video_id FROM installation_video WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO installation_video
	(content, profile_account_id)
	VALUES ('Add Content', '".$_SESSION['profile_account_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	
}
*/

// add if not exist
$sql = "SELECT installation_appearance_id FROM installation_appearance WHERE installation_id = '".$_SESSION['installation_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO installation_appearance
	(installation_id)
	VALUES ('".$_SESSION['installation_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	
}

// add if not exist
$sql = "SELECT installation_step_id FROM installation_step WHERE installation_id = '".$_SESSION['installation_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO installation_step
	(installation_id)
	VALUES ('".$_SESSION['installation_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	
}

// add if not exist
$sql = "SELECT installation_tool_id FROM installation_tool WHERE installation_id = '".$_SESSION['installation_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO installation_tool
	(installation_id)
	VALUES ('".$_SESSION['installation_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	
}



/*
if(isset($_POST["submit_video_page_content"])){	
	$content = trim(addslashes($_POST["content"]));
	
	$ts = time();
	
	// create a backup
	$sql = sprintf("UPDATE installation_video SET content = '%s' profile_account_id = '%u'",
	$content, $_SESSION['profile_account_id']);
	$msg = "Your change is now live.";
	
	$result = $dbCustom->getResult($db,$sql);
	

}
*/



if(isset($_POST['add_installation_link'])){	

	$button_text = trim(addslashes($_POST['button_text']));
	$page_seo_id = $_POST['page_seo_id'];
	$color = $_POST['color'];
	$uploaded_file_id = $_POST['uploaded_file_id'];
	
	$local_url = (isset($_POST['local_url'])) ? trim($_POST['local_url']) : '';
	
	$sql = sprintf("INSERT INTO installation_link
					(button_text, color, page_seo_id, uploaded_file_id, local_url, installation_id)
					VALUES
					('%s','%s','%u','%u','%s','%u')",
				$button_text, $color, $page_seo_id, $uploaded_file_id, $local_url, $_SESSION['installation_id']);
	$result = $dbCustom->getResult($db,$sql);
	
		
}

if(isset($_POST['edit_installation_link'])){	

	$button_text = trim(addslashes($_POST['button_text']));
	$page_seo_id = $_POST['page_seo_id'];
	$color = $_POST['color'];
	$uploaded_file_id = $_POST['uploaded_file_id'];
	$installation_link_id = $_POST['installation_link_id'];
	
	$local_url = (isset($_POST['local_url'])) ? trim($_POST['local_url']) : '';
	
	$sql = sprintf("UPDATE installation_link
					SET button_text = '%s'
					 ,color = '%s'
					 ,page_seo_id = '%u'
					 ,uploaded_file_id = '%u'
					 ,local_url = '%s'
					 WHERE installation_link_id = '%u'",					 
				$button_text, $color, $page_seo_id, $uploaded_file_id, $local_url, $installation_link_id);
	$result = $dbCustom->getResult($db,$sql);
	

		
}


if(isset($_POST["edit_installation"])){	

	$content = trim(addslashes($_POST["content"]));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	
	$img_id = $_POST['img_id'];
	
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	
	
	
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST["page_heading"]));
	
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	//print_r($actives);
	
	$sql = "UPDATE installation_link SET active = '0' WHERE installation_id = '".$_SESSION['installation_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	

	if(is_array($actives)){	
		foreach($actives as $value){
			//echo $value;	
			$sql = "UPDATE installation_link SET active = '1' WHERE installation_link_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			

		}
	}
	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");
	
	$sql = sprintf("UPDATE installation SET content = '%s', img_id = '%u', img_alt_text = '%s' 
				WHERE installation_id = '%u'",
				$content, $img_id, $img_alt_text, $_SESSION["installation_id"]);
	$msg = "Your change is now live.";
	
	$result = $dbCustom->getResult($db,$sql);
	
	
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");

	unset($_SESSION['temp_page_fields']);
}




unset($_SESSION["installation_link_id"]);
unset($_SESSION["uploaded_file_id"]);
unset($_SESSION["temp_istallation_link_fields"]);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');


?>
<script>
$(document).ready(function() {

	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
	
	
	
	
	
	$(".set_session").click(function(){
		set_page_session();
		
	});
	
	
	$(".fancybox").click(function(e){
		e.preventDefault();
		set_page_session();
		
	});


});


function set_page_session(){

	var q_str = "?page=installation"+get_query_str();
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
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
		theme_advanced_resize_horizontal : false,
		forced_root_block : false
	
	});



/*
function msslSubmit(){
document.set_ssl.submit();
}
*/


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

function get_query_str(){
	
	var query_str = '';
	query_str += "&content="+escape(tinyMCE.get('wysiwyg').getContent());
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26'); 
	query_str += "&img_alt_text="+$("#img_alt_text").val().replace('&', '%26'); 
	
	
	
	
	return query_str;
}

</script>
</head>
<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');



$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT content, img_id, img_alt_text 
	    FROM installation 
 		WHERE installation_id = '".$_SESSION["installation_id"]."'";
			
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

if(!isset($_SESSION['img_id'])) $_SESSION['img_id'] = 0;
if($_SESSION['img_id'] == 0) $_SESSION['img_id'] = $img_id;

if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;


require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name


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
		$bread_crumb->add("Installation", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		//installation section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/installation-section-tabs.php");
        ?>
        
        <form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_installation" value="1">        
            <input type="hidden" name="installation_id" value="<?php echo $_SESSION["installation_id"]; ?>">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input type="hidden" name="ret_page" value="installation">
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="content_table" value="installation">
            <input type="hidden" name="img_id" value="<?php echo $_SESSION['img_id']; ?>">
            
            
            
             

			<div class="page_actions edit_page"> <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large">
            <i class="icon-eye-open icon-white"></i> Preview </a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>

                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>


				<hr />

                
                <a class="btn btn-primary toggleFieldsets" href="#">
                <i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a> 
                <a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				<?php if($_SESSION['is_ssl']){
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
                      <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Page Name</label>
                            </div>
                            <div class="twocols">
                                <input type="text" id="page_heading" name="page_heading" 
                                value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']); ?>" />
                            </div>
                        </div>
                
					<legend>Intro Text <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer">
                    <textarea id="wysiwyg" class="wysiwyg small" name="content" style="height:360px;"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['content']); ?></textarea>

					</div>
				</fieldset>
				<fieldset class="edit_content">
					<legend>Intro Link Buttons <i class="icon-minus-sign icon-white"></i></legend>
					
				<a href="<?php echo $ste_root;?>/manage/cms/pages/add-installation-link.php" class="btn btn-large btn-primary fancybox fancybox.iframe">
                <i class="icon-plus icon-white"></i>Add Intro Link Button</a>
                    
                    <div class="data_table">
                        <table cellpadding="10" cellspacing="0">
							<thead>
                                <th>Button Text</th>
                                <th>Page Link</th>
                                <th>Edit</th>
                                <th>Active</th>
							</thead>
							<tbody>
						
											                        
                        <?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT * 
								FROM installation_link 
								WHERE installation_id = '".$_SESSION["installation_id"]."'";
				$result = $dbCustom->getResult($db,$sql);						

						//echo $result->num_rows;

						$block = '';
						while($row = $result->fetch_object()){
							
							$block .= "<tr>"; 
							$block .= "<td>$row->button_text</td>";
							
							
							
							if($row->uploaded_file_id > 0){
								
								
								$sql = "SELECT uploaded_file_name 
										FROM uploaded_file  
										WHERE uploaded_file_id = '".$row->uploaded_file_id."'";
								
								$f_res = $dbCustom->getResult($db,$sql);
								
								if($f_res->num_rows > 0){
									$object = $f_res->fetch_object();
									$uploaded_file_name = $object->uploaded_file_name;
								}else{
									$uploaded_file_name = '';
								}
								$link = $uploaded_file_name;
							}elseif($row->local_url != ''){
								$link = $row->local_url;
							}elseif($row->page_seo_id > 0){
								$link = getURLFileNameById($row->page_seo_id);
							
							}else{
								$link = '';	
							}
							
							
							$block .= "<td>$link</td>";
							
							
							$block .= "<td>
							<a href='edit-installation-link.php?firstload=1&installation_link_id=".$row->installation_link_id."' 
                            class='btn btn-primary btn-tiny fancybox fancybox.iframe'><i class='icon-cog icon-white'></i> Edit</a>
							</td>";

							$checked = ($row->active == 1) ? "checked='checked'" : '';

							$block .= "<td><div class='checkboxtoggle off'>
										<span class='ontext'>ON</span>
										<a class='switch on' href='#'></a>
										<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->installation_link_id."' $checked />
                            </div></td>                                
							";
							
							$block .= "</tr>";

							
						}
						echo $block;
						
						?>
                        
                         
                            </tbody>
						</table>
					</div>
				</fieldset>
				<fieldset>
					<legend>Intro Banner Image <i class="icon-minus-sign icon-white"></i></legend>
					<!-- The dimensions for the banner image to crop to are: 256 x 231 --> 
					<!-- Use the default image if the user does not upload an image. Is it possible to save as transparent png instead of JPG? -->
					<div class="colcontainer">
						<div class="twocols"> 
                        
					<?php			
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT file_name FROM image WHERE img_id = '".$_SESSION['img_id']."'";
						$img_res = $dbCustom->getResult($db,$sql);
						
						if($img_res->num_rows){
							
							$img_obj = $img_res->fetch_object();
							echo "<br /><img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."'><br />";
							
						}
					?>
                        
                        </div>
                        <div class="twocols"> 
                			<!--  fancybox fancybox.iframe -->
                            <a href="<?php echo $ste_root;?>/manage/upload-pre-crop.php?ret_page=installation&ret_dir=cms/pages" 
                            class="btn btn-large btn-primary set_session">
                            <i class="icon-plus icon-white"></i>Add New Banner Image</a>
			                <p>For best results, upload a .png image file with transparent background</p>                      
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
                
                
                
				<?php require_once("edit_page_seo.php"); ?>
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/edit_page_breadcrumb.php"); ?>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
