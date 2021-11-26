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


$page_title = "Guides &amp; Tips";
$page_group = "guides-tips";
$page = "guides-and-tips";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
// add if not exist
$sql = "SELECT guides_tips_page_id FROM guides_tips_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO guides_tips_page 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$guides_tips_page_id = $db->insert_id;
	
}

$guides_tips_page_id = (isset($_GET['guides_tips_page_id'])) ? $_GET['guides_tips_page_id'] : 0;
if(!isset($_SESSION['guides_tips_page_id'])) $_SESSION['guides_tips_page_id'] = $guides_tips_page_id; 



if(isset($_POST["add_guide_tip"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$guide_tip_cat_id = (isset($_POST["guide_tip_cat_id"])) ? $_POST["guide_tip_cat_id"] : 0;
	
	

	//if(in_array(2,$user_functions_array)){
		$sql = sprintf("INSERT INTO guide_tip (content, guide_tip_cat_id, last_update, profile_account_id) VALUES ('%s','%u','%u','%u')", 
		$content, $guide_tip_cat_id, time(), $_SESSION['profile_account_id']);

		$msg = "Your change is live.";
/*
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, cat_id, action) 
		VALUES ('%s','%u','%u','%s','%s','%u','%s')", 
		"guide_tip", $ts, $user_id, "guides-tips", $content, $guide_tip_cat_id, "add");
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
	

}


if(isset($_POST["edit_guide_tip_page"])){
	$mssl = (isset($_POST['mssl']))? 1 : 0;
	$seo_name = trim(addslashes($_POST['seo_name']));
	$seo_name = str_replace (" ", "-" , $seo_name);
	$title = trim(addslashes($_POST['title']));
	$keywords = trim(addslashes($_POST['keywords']));
	$description = trim(addslashes($_POST['description']));
	$page_heading = trim(addslashes($_POST["page_heading"]));

	$content = trim(addslashes($_POST["content"]));
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0;
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));		
	$guides_tips_page_id = $_POST['guides_tips_page_id'];
	
	$sql = sprintf("UPDATE guides_tips_page 
				SET content = '%s'
					,img_id = '%u'
					,img_alt_text = '%s' 
				WHERE guides_tips_page_id = '%u'", 
				$content, $img_id, $img_alt_text, $guides_tips_page_id);
	$result = $dbCustom->getResult($db,$sql);
	


	require_once($real_root."/manage/cms/insert_page_seo.php");
	require_once($real_root."/manage/cms/insert_page_breadcrumb.php");

	unset($_SESSION['temp_page_fields']);	
}

if(isset($_POST["edit_guide_tip"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$guide_tip_cat_id = (isset($_POST["guide_tip_cat_id"])) ? $_POST["guide_tip_cat_id"] : 0;
	$guide_tip_id = $_POST["guide_tip_id"];
	
	
	//if(in_array(2,$user_functions_array)){
		// create a backup
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($guide_tip_id,$user_id,"guide_tip");	

		$sql = sprintf("UPDATE guide_tip SET content = '%s', guide_tip_cat_id = '%u', last_update = '%u' WHERE guide_tip_id = '%u'", 
		$content, $guide_tip_cat_id, time(), $guide_tip_id);

		$msg = "Your change is live.";
	/*	
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content_record_id, cat_id) 
		VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
		"guide_tip", $ts, $user_id, "guides-tips", $content, $guide_tip_id, $guide_tip_cat_id);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
	
	
}

if(isset($_POST["del_guide_tip_id"])){
	
	//if(in_array(2,$user_functions_array)){
		$guide_tip_id = $_POST["del_guide_tip_id"];

		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($guide_tip_id,$user_id,"guide_tip","delete");	


		$sql = sprintf("DELETE FROM guide_tip WHERE guide_tip_id = '%u'", $guide_tip_id);
		$result = $dbCustom->getResult($db,$sql);
		//
		//$sql = "DELETE FROM review WHERE content_record_id = '".$guide_tip_id."'";
		//$result = $dbCustom->getResult($db,$sql);
		//

		$msg = "Item Deleted.";

	//}else{
		//$msg = "You are not authorised to delete.";		
	//}
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

$sql = "SELECT content, img_id, img_alt_text  
		FROM guides_tips_page
		WHERE guides_tips_page_id = '".$_SESSION['guides_tips_page_id']."'";
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

if(!isset($_SESSION['temp_page_fields']['content'])) $_SESSION['temp_page_fields']['content'] = $content;
if(!isset($_SESSION['temp_page_fields']['img_alt_text'])) $_SESSION['temp_page_fields']['img_alt_text'] = $img_alt_text;

require_once($real_root."/manage/cms/get_seo_variables.php");

if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
if(!isset($_SESSION['temp_page_fields']['seo_name'])) $_SESSION['temp_page_fields']['seo_name'] = $seo_name;
if(!isset($_SESSION['temp_page_fields']['title'])) $_SESSION['temp_page_fields']['title'] = $title;
if(!isset($_SESSION['temp_page_fields']['keywords'])) $_SESSION['temp_page_fields']['keywords'] = $keywords;
if(!isset($_SESSION['temp_page_fields']['description'])) $_SESSION['temp_page_fields']['description'] = $description;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

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



$(document).ready(function() {

	$('.fancybox').click(function(){		

		ajax_set_page_session();
	
	});

});

function ajax_set_page_session(){
	
	var q_str = "?page=guides-tips"+get_query_str();
		
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

function previewSubmit() {
  document.form.action = '<?php echo SITEROOT; ?>pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = 'guides-tips.php';
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


</style>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
	require_once($real_root."/manage/cms/get_seo_variables.php");
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("Guides & Tips", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/guide-section-tabs.php");
		?>
		<form name="form" action="<?php echo $current_page; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="edit_guide_tip_page" value="1"> 
             <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input type="hidden" name="ret_page" value="guides-tips">
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="content_table" value="guide_tip"> 
            <input type="hidden" name="guides_tips_page_id" value="<?php echo $_SESSION['guides_tips_page_id']; ?>">
        
            
                 
			<div class="page_actions">
				<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="add-guide-tip.php?ret_page=guides-tips"><i class="icon-plus icon-white"></i> Add a New Guide/Tip </a>
                <!-- No content to show
                <a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
                -->
                <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>

                  <a href="<?php echo SITEROOT; ?>manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

				<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

            	<?php if($_SESSION['is_ssl']){ 
					$checked = ($mssl)? "checked=checked" : ''; 		
				?>	
                <label>Set Page as SSL</label>
				<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
					<input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
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
                               <input id="page_heading" type="text" name="page_heading" value="<?php echo stripslashes($_SESSION['temp_page_fields']['page_heading']);; ?>" />
                           </div>
                       </div>
				<div class="colcontainer">
				<legend>Intro Content</legend>
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
                            WHERE slug = 'guides-tips'
                            AND profile_account_id = '".$_SESSION['profile_account_id']."'
                            ORDER BY img_id";
                    $img_res = $dbCustom->getResult($db,$sql);
                    ;
                    $i = 1;
                    while($img_row = $img_res->fetch_object()) {
                        
						?>

						<div style="float:left; padding:10px;">
							<?php   	
                            echo "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_row->file_name."' width='120px' />"; 
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
                            href="<?php echo SITEROOT;?>/manage/cms/upload.php?ret_page=guides-tips&ret_dir=pages&img_max_width=450">
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
							<th width="25%">Category</th>
							<th width="55%">Content Preview</th>
							<th width="15%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);    
					$sql = "SELECT * FROM guide_tip 
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY guide_tip_cat_id ";
					$result = $dbCustom->getResult($db,$sql);				
	
					while($row = $result->fetch_object()) {
						$block = "<tr>"; 				
						//category
						$sql = "SELECT category_name FROM guide_tip_category 
								WHERE guide_tip_cat_id = '".$row->guide_tip_cat_id."'";
						$cat_res = $dbCustom->getResult($db,$sql);
						
						if($cat_res->num_rows > 0){
							$object = $cat_res->fetch_object();
							$category_name = $object->category_name;
						}else{
							$category_name = '';
						}
						$block .= "<td valign='top'>".$category_name."</td>";
						//content snippet
						$content = stripslashes($row->content);
						$contentstr = (string)$content;
						$contentsnippet = substr($contentstr,0,100);
						$block .= "<td valign='top'>".$contentsnippet."...</td>";
						//edit
						$block .= "<td valign='top'><a class='btn btn-primary fancybox fancybox.iframe' href='edit-guides-tips.php?guide_tip_id=".$row->guide_tip_id."&ret_page=guides-tips'><i class='icon-cog icon-white'></i> Edit</a></td>";
						//delete
						$block .= "<td valign='top'><a class='btn btn-danger confirm' href='#delete'><i class='icon-remove icon-white'></i><input class='itemId' id='".$row->guide_tip_id."' value='".$row->guide_tip_id."' type='hidden' /></a></td>";
						$block .= "</tr>";
						echo $block;
					}
					?>
				</table>
			</div>










			<div class="page_content seo_bc_content">
	        <?php 
			$page_heading = $_SESSION['temp_page_fields']['page_heading'];
			$seo_name = $_SESSION['temp_page_fields']['seo_name'];
			$title = $_SESSION['temp_page_fields']['title'];
			$keywords = $_SESSION['temp_page_fields']['keywords'];	
			$description = $_SESSION['temp_page_fields']['description'];
			require_once("edit_page_seo.php"); 
    	    require_once($real_root."/manage/cms/edit_page_breadcrumb.php"); 
			?>
			</div>
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>


</div>
 <p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</div>

 

<div id="content-delete2" class="confirm-content2" style="display:none;">
	<h3>Are you sure you want to delete this image?</h3>
	<form name="del_img_form" action="guides-tips.php" method="post" target="_top">
		<input id="del_img_id" class="itemId" type="hidden" name="del_img_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_img" type="submit" >Yes, Delete</button>
	</form>
</div>
    
    </body>
</html>


