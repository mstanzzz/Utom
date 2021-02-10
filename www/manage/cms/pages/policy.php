<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "policies";
$page_group = "policies";
$page = "policies";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
// add if not exist
$sql = "SELECT policy_page_id FROM policy_page WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows == 0){
	$sql = "INSERT INTO policy_page 
		(profile_account_id) 
		VALUES ('".$_SESSION['profile_account_id']."')"; 
	$result = $dbCustom->getResult($db,$sql);
	
	
	$policy_page_id = $db->insert_id;
	
}


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["edit_policy_page"])){

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
	$policy_page_id = $_POST['policy_page_id'];
	
	$sql = sprintf("UPDATE policy_page 
			SET content = '%s'
				,img_id = '%u'
				,img_alt_text = '%s' 
			WHERE policy_page_id = '%u'", 
			$content, $img_id, $img_alt_text, $policy_page_id);
	$result = $dbCustom->getResult($db,$sql);
	

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_seo.php");

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/insert_page_breadcrumb.php");

	unset($_SESSION['temp_page_fields']);
}


if(isset($_POST["add_policy"])){
	
	$content = trim(addslashes($_POST["content"]));
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	 
	$policy_cat_id = (isset($_POST["policy_cat_id"])) ? $_POST["policy_cat_id"] : 0; 
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0; 

	$ts = time();

	//if(in_array(2,$user_functions_array)){
		$sql = sprintf("INSERT INTO policy (content, policy_cat_id, img_id, img_alt_text, profile_account_id) 
		VALUES ('%s','%u','%u', '%s','%u')", $content, $policy_cat_id, $img_id, $img_alt_text, $_SESSION['profile_account_id']);
		
		$msg = "Your change is now live.";

	/*
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, cat_id, img_id, action) 
		VALUES ('%s','%u','%u','%s','%s','%u','%u','%s')", 
		"policy", $ts, $user_id, "policy", $content, $policy_cat_id, $img_id, "add");
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST["edit_policy"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));

	$policy_id = $_POST["policy_id"];
	$policy_cat_id = (isset($_POST["policy_cat_id"])) ? $_POST["policy_cat_id"] : 0; 
	$img_id = (isset($_POST['img_id'])) ? $_POST['img_id'] : 0; 

	$ts = time();
	//if(in_array(2,$user_functions_array)){
		
		// create a backup
		//$backup = new Backup;
		//$dbu = $backup->doBackup($policy_id,$user_id,"policy");	

		$sql = sprintf("UPDATE policy SET content = '%s', img_alt_text = '%s', policy_cat_id = '%u', img_id = '%u' WHERE policy_id = '%u'", 
		$content, $img_alt_text, $policy_cat_id, $img_id, $policy_id);
		
		$msg = "Your change is now live.";



	/*
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, content_record_id, cat_id, img_id) 
		VALUES ('%s','%u','%u','%s','%s','%u','%u','%u')", 
		"policy", $ts, $user_id, "policy", $content, $policy_id, $policy_cat_id, $img_id);
		$msg = "Your change is now pending approval.";
	}
	*/

	$result = $dbCustom->getResult($db,$sql);
	

}

if(isset($_POST["del_policy_id"])){
	//if(in_array(2,$user_functions_array)){
		$policy_id = $_POST["del_policy_id"];

		//$backup = new Backup;
		//$dbu = $backup->doBackup($policy_id,$user_id,"policy","delete");	

		$sql = sprintf("DELETE FROM policy WHERE policy_id = '%u'", $policy_id);
		$result = $dbCustom->getResult($db,$sql);
		
		//$sql = "DELETE FROM review WHERE content_record_id = '".$policy_id."'";
		//$result = $dbCustom->getResult($db,$sql);
		//
	
		//$msg = "Your change is now live.";

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


$policy_page_id = (isset($_GET['policy_page_id'])) ? $_GET['policy_page_id'] : 0;
if(!isset($_SESSION['policy_page_id'])) $_SESSION['policy_page_id'] = $policy_page_id; 

$sql = "SELECT content, img_id, img_alt_text  
		FROM policy_page
		WHERE policy_page_id = '".$_SESSION['policy_page_id']."'";
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
	
	
	$(".fancybox").click(function(e){
		
		var q_str = "?page=policy"+get_query_str();
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_page_session.php'+q_str,
		  success: function(data) {
			//alert(data);
		  }
		});
	});

	
});

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

tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});	

function previewSubmit() {
  document.form.action = '<?php echo $ste_root; ?>/pages/preview/preview.php';
  document.form.target = '_blank'; 
  document.form.submit();
}	

function regularSubmit() {
  document.form.action = 'policy.php';
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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');

	require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/get_seo_variables.php");
	if(!isset($_SESSION['temp_page_fields']['page_heading'])) $_SESSION['temp_page_fields']['page_heading'] = $page_heading;
	if(!isset($_SESSION["temp_page_fields"]['seo_name'])) $_SESSION["temp_page_fields"]['seo_name'] = $seo_name;
	if(!isset($_SESSION["temp_page_fields"]['title'])) $_SESSION["temp_page_fields"]['title'] = $title;
	if(!isset($_SESSION["temp_page_fields"]['keywords'])) $_SESSION["temp_page_fields"]['keywords'] = $keywords;
	if(!isset($_SESSION["temp_page_fields"]['description'])) $_SESSION["temp_page_fields"]['description'] = $description;
	
	
	
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
		$bread_crumb->add("Policy", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		//policy section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/policy-section-tabs.php");
		
		
		
		//$_SESSION["temp_page_fields"]["page_heading"]
		
		?>
		<form name="form" action="policy.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="page_title" value="<?php echo $_SESSION['temp_page_fields']['page_heading']; ?>"> 
            <input type="hidden" name="policy_page" value="1">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <input type="hidden" name="ret_dir" value="manage/cms/pages">
            <input type="hidden" name="content_table" value="policy">
            <input type="hidden" name="edit_policy_page" value="1">
            <input type="hidden" name="policy_page_id" value="<?php echo $_SESSION['policy_page_id']; ?>">


			<div class="page_actions">
				<a class="btn btn-large btn-primary fancybox fancybox.iframe" href="add-policy.php?ret_page=policy"><i class="icon-plus icon-white"></i> Add New Policy </a>
            <!--<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>-->

                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>

				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel </a>
            
				<?php if($_SESSION['is_ssl']){ 
					$checked = ($mssl)? "checked=checked" : ''; 
				?>
				<div class="checkboxtoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span>
                <input type="checkbox" class="checkboxinput" name="mssl" value="1" <?php echo $checked; ?> />
                </div>
				<?php } 
				
				
				
				
				
				?>
			</div>


			<fieldset class="edit_content">
				<legend>Page Content <i class="icon-minus-sign icon-white"></i></legend>
                       <div class="colcontainer formcols">
                           <div class="twocols">
                               <label>Page Name</label>
                           </div>
                           <div class="twocols">
                               <input id="page_heading" type="text" name="page_heading" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['page_heading']);; ?>" />
                           </div>
                       </div>
				<div class="colcontainer">
				<legend>Intro Content</legend>
				<textarea id="content" class="wysiwyg" name="content"><?php echo stripAllSlashes($_SESSION['temp_page_fields']['content']); ?></textarea>
				</div>
			</fieldset>

				<fieldset class="edit_images">
					<legend>Page Images <i class="icon-minus-sign icon-white"></i></legend>
                    <div class="colcontainer">
                    <?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

                    $sql = "SELECT * 
                            FROM image 
                            WHERE slug = 'policy'
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
                            href="<?php echo $ste_root;?>/manage/cms/upload.php?ret_page=policy&ret_dir=pages&img_max_width=450">
                            <i class="icon-plus icon-white"></i> Add New Image</a> 
                    </div>



                        <div class="colcontainer formcols">
                            <div class="twocols">
                                <label>Image Alt Tag Text</label>
                            </div>
                            <div class="twocols">
                                <input id="img_alt_text" type="text" name="img_alt_text" value="<?php echo prepFormInputStr($_SESSION['temp_page_fields']['img_alt_text']);; ?>" />
                            </div>
                        </div>


				</fieldset>


			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="15%">Image</th>
							<th width="25%">Category</th>
							<th width="43%">Content</th>
							<th width="12%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					    <?php
					
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT policy_id, img_id, policy_cat_id, content 
						FROM policy 
						WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
						ORDER BY policy.policy_id";
				$result = $dbCustom->getResult($db,$sql);						
						while($row = $result->fetch_object()) {
							$block = "<tr>";
							
							$sql = "SELECT image.file_name 
							FROM image 
							WHERE img_id = '".$row->img_id."'";
							$img_res = $dbCustom->getResult($db,$sql);
							
							if($img_res->num_rows > 0){
								$img_obj = $img_res->fetch_object();
								$block .= "<td valign='middle'><img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$img_obj->file_name."' 
								width='80px' />".$img_obj->file_name."</td>";
							}else{
								$block .= "<td valign='middle'></td>";	
							}
							
							//category
							$sql = "SELECT category_name FROM policy_category WHERE policy_cat_id = '".$row->policy_cat_id."'";
							$cat_res = $dbCustom->getResult($db,$sql);
							if($cat_res->num_rows > 0){
								$object = $cat_res->fetch_object();
								$block .= "<td valign='middle'><br />".stripslashes($object->category_name)."</td>";
							}else{
								$block .= "<td valign='middle'><br />Please add a category</td>";
							}
							//content
							//$shc = stripslashes($row->content);
							//$contentStr = (string)$shc;
							$contentPreview = substr(stripslashes($row->content),0,100);
							$block .= "<td valign='middle'>".$contentPreview."...</td>";
							//edit		
							$block .= "<td valign='middle'><a class='btn btn-primary fancybox fancybox.iframe' 
							href='edit-policy.php?policy_id=".$row->policy_id."&ret_page=policy' ><i class='icon-cog icon-white'></i> Edit</a></td>";
							//delete
							$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->policy_id."' class='itemId' value='".$row->policy_id."' /></a></td>";
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
    
</div>

<!-- New Delete Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this policy?</h3>
	<form name="del_policy_form" action="policy.php" method="post" target="_top">
		<input id="del_policy_id" class="itemId" type="hidden" name="del_policy_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_policy" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<!-- End New Delete Dialogue -->

    
<div id="content-delete2" class="confirm-content2" style="display:none;">
	<h3>Are you sure you want to delete this image?</h3>
	<form name="del_img_form" action="policy.php" method="post" target="_top">
		<input id="del_img_id" class="itemId" type="hidden" name="del_img_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_img" type="submit" >Yes, Delete</button>
	</form>
</div>
    
    

</body>
</html>



