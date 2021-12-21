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


$page_title = "Logo";
$page_group = "logo";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

//$new_img_id = (isset($_GET['new_img_id'])) ? $_GET['new_img_id'] : 0;  

//if($new_img_id > 0){
	//$sql = sprintf("INSERT INTO logo (img_id, profile_account_id) VALUES ('%u', '%u')", 
	//$new_img_id, $_SESSION['profile_account_id']);
	//$result = $dbCustom->getResult($db,$sql);		
	//$progress->completeStep("logo" ,$_SESSION['profile_account_id']);
//}

/*
if(isset($_POST["edit_about_us"])){
	$content = trim(addslashes($_POST["content"])); 
	$about_us_id = $_POST["about_us_id"];
	$img_id = $_POST['img_id'];
	$ts = time();

	if(in_array(2,$user_functions_array)){
		// create a backup
		$backup = new Backup;
		$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
		
		$sql = sprintf("UPDATE about_us SET  content = '%s', img_id = '%u', last_update = '%u' WHERE about_us_id = '%u'", 
		$content, $img_id, time(), $about_us_id);
		$msg = "Your change is now live.";

	}else{

		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
			"about_us", $ts, $user_id, "about-us", $content, $img_id, $about_us_id);
		$msg = "Your change is now pending approval.";
	}
	$result = $dbCustom->getResult($db,$sql);
		
}
*/

if(isset($_POST["del_logo"])){

	//if(in_array(2,$user_functions_array)){
		
		$logo_id = $_POST["del_logo_id"];
		
		//echo $logo_id;
		
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($faq_id,$user_id,"faq","delete");	

		$sql = sprintf("SELECT image.file_name, image.img_id
			FROM logo, image 
			WHERE logo.img_id = image.img_id
			AND logo.logo_id = '%u'", $logo_id);
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows){
			$img_obj = $result->fetch_object();			
			
			$sql ="DELETE FROM image WHERE img_id = '".$img_obj->img_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/ul_cms/".SITEROOT."/logo/".$img_obj->file_name)){
				unlink ($_SERVER['DOCUMENT_ROOT']."/ul_cms/".SITEROOT."/logo/".$img_obj->file_name);
			}
		}
		
		$sql = sprintf("DELETE FROM logo WHERE logo_id = '%u'", $logo_id);
		$result = $dbCustom->getResult($db,$sql);
		//		

		//$sql = "DELETE FROM review WHERE content_record_id = '".$faq_id."'";
		//$result = $dbCustom->getResult($db,$sql);
		//
	//}else{
		//$msg = "You are not authorised to delete.";		
	//}
	
	$msg = 'Logo deleted.';

}

if(isset($_POST['set_active'])){
	
	$logo_id = (isset($_POST['logo_id']))? $_POST['logo_id'] : 0;	
	//echo $logo_id;
	//exit;
	$ts = time();
	
	//if(in_array(2,$user_functions_array)){
		// create a backup
		//$backup = new Backup;
		//$dbu = $backup->doBackup($about_us_id,$user_id,"about_us");	
		
		$sql = "UPDATE logo SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = "UPDATE logo SET active = '1' WHERE logo_id = '".$logo_id."'";		
		$result = $dbCustom->getResult($db,$sql);
			
		$sql = "SELECT file_name
				FROM image, logo
				WHERE image.img_id = logo.img_id
				AND logo.logo_id = '".$logo_id."'";
		$result = $dbCustom->getResult($db,$sql);
		//
		if($result->num_rows > 0){
			$fn_obj =$result->fetch_object();
			$_SESSION['logo_file_name'] = $fn_obj->file_name;
		}

		$msg = 'Your change is now live.';

	//}else{
		/*
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content1, img_id, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u','%u')", 
			"about_us", $ts, $user_id, "about-us", $content, $img_id, $about_us_id);
		$msg = "Your change is now pending approval.";
		
		$result = $dbCustom->getResult($db,$sql);
			
		*/
	//}

	$progress->completeStep('logo"' ,$_SESSION['profile_account_id']);
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>

function previewSubmit() {
  document.form.action = '<?php echo SITEROOT; ?>pages/preview/preview.php';
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
   		<?php
        require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Logo", '');
        echo $bread_crumb->output();
		?>

		<h1>Logo Image</h1>

		<?php if($msg != ''){ ?>
		<div class="alert alert-success">
			<h4><?php echo $msg; ?></h4>
		</div>
		<?php } else {} ?>
		<form name="form" action="logo.php" method="post">

      		<input type="hidden" name="ret_page" value="logo">        
            <input type="hidden" name="ret_dir" value="manage/cms/logo">
            <input type="hidden" name="page_title" value=''>  
			<input type="hidden" name="content_table" value="home"> 
			<input type="hidden" name="set_active" value="1"> 
            
			
            <?php if($admin_access->cms_level > 1){ ?>
			<div class="page_actions"> 
            	<a class="btn btn-large btn-primary fancybox fancybox.iframe" href='<?php echo SITEROOT ?>/manage/cms/upload.php?ret_dir=logo&ret_page=logo&img_height=70'>
            	<i class="icon-plus icon-white"></i> Upload Image</a> 
<!--
<a onClick="previewSubmit();" href="#" class="btn btn-primary btn-large"><i class="icon-eye-open icon-white"></i> Preview </a>
-->            	
<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
            </div>
            <?php } ?>
			
			
			
			
			<div class="data_table">
				<table border="0" cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="30%">Preview</th>
							<th width="50%">File Name</th>
							<th width="10%">Active</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
					<?php

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "SELECT logo.logo_id, logo.active, image.file_name 
    FROM logo, image 
    WHERE logo.img_id = image.img_id
	AND logo.profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$block = '';
	while($img_row = $result->fetch_object()){
		//echo $img_row->logo_id;
    	$block .= "<tr>";
		
		//$block .= "<td valign='middle'><br /><a class='inline' href='#delete'>
			//delete<div class='e_sub' id='".$img_row->logo_id."' style='display:none'></div> </a></td>";
			 
$block .= "<td valign='middle'>";
$block .= "<a class='fancybox' 
href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/logo/".$img_row->file_name."'>
<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/logo/".$img_row->file_name."'>";

			$block .= '</td>';
		
		
		$block .= "<td valign='middle'>".$img_row->file_name."</td>";
  		
		$checked = ($img_row->active)? "checked" : '';
		$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
		$block .= "<td valign='middle' class='center'>
			<div class='radiotoggle on ".$disabled." '> 
			<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='radio' class='radioinput' name='logo_id' value='".$img_row->logo_id."' $checked /></div></td>";		

		$block .= "<td valign='middle' class='center'>
			<a class='btn btn-danger confirm logo-delete ".$disabled." '>
			<input type='hidden' id=".$img_row->logo_id."' class='imgId'  value='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/logo/".$img_row->file_name."'/>
			<i class='icon-remove icon-white'></i></a></td>";
		
		$block .= "</tr>";
		
	}
	echo $block;
    ?>
				</table>
			</div>
		</form>

       	<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

	</div>
	<p class="clear"></p>
	<div id="logo-delete" class="confirm-content">
		<h3>Are you sure you want to delete this logo?</h3>
		<div class="imgPlaceholder"></div>
		<form name="del_logo" action="logo.php" method="post" target="_top">
			<input id="del_logo_id" type="hidden" name="del_logo_id" value='' />
			<a class="btn btn-large dismiss">No, Cancel</a>
			<button class="btn btn-danger btn-large" name="del_logo" type="submit" >Yes, Delete</button>
		</form>
	</div>
	<?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>
</body>
</html>
