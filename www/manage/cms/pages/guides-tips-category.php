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

//profile_account_id = '".$_SESSION['profile_account_id']."'

$page_title = "Guide Tip Category";
$page_group = "guides-tips";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

if(isset($_POST["add_guide_tip_cat"])){

	$added_category = addslashes($_POST["added_category"]); 
	$sql = sprintf("SELECT * 
					FROM guide_tip_category 
					WHERE category_name = '%s'
					AND profile_account_id = '%u'", $added_category, $_SESSION['profile_account_id']);	
	$c_result = mysql_query ($sql);
	
	
	$ts = time();
	if(!mysql_num_rows($c_result)){
		//if(in_array(2,$user_functions_array)){
			$sql = sprintf("INSERT INTO guide_tip_category (category_name, profile_account_id) VALUES ('%s','%u')", $added_category, $_SESSION['profile_account_id']);
	
			$msg = "Your change is live.";
		/*
		}else{
			$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, action) 
			VALUES ('%s','%u','%u','%s','%s','%s')", 
			"guide_tip_category", $ts, $user_id, "guides-tips", $added_category, "add");
			$msg = "Your change is now pending approval.";
		}
		*/
		$result = $dbCustom->getResult($db,$sql);
		
	}else{
		$msg = "The category name already exists";	
	}
}


if(isset($_POST["edit_guide_tip_cat"])){
	
	$category_name = addslashes($_POST["category_name"]); 
	$guide_tip_cat_id = $_POST["guide_tip_cat_id"];
	$ts = time();
	//if(in_array(2,$user_functions_array)){
		// create a backup
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($contact_email_page_id,$user_id,"contact_email_page");	
		
		$sql = sprintf("UPDATE guide_tip_category SET category_name = '%s' WHERE guide_tip_cat_id = '%u'", 
		$category_name, $guide_tip_cat_id);

		$msg = "Your change is live.";
	/*
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u')", 
			"guide_tip_category", $ts, $user_id, "guides-tips", $category_name, $guide_tip_cat_id);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST["del_guide_tip_cat"])){
	
	//if(in_array(2,$user_functions_array)){
		$guide_tip_cat_id = $_POST["del_guide_tip_cat_id"];

		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($guide_tip_cat_id,$user_id,"guide_tip_category","delete");	

		$sql = sprintf("DELETE FROM guide_tip_category WHERE guide_tip_cat_id = '%u'", $guide_tip_cat_id);
		$result = $dbCustom->getResult($db,$sql);
		//
		//$sql = "DELETE FROM review WHERE content_record_id = '".$guide_tip_cat_id."'";
		//$result = $dbCustom->getResult($db,$sql);
		//
		
		$msg = "Your change is live.";

	//}else{
		//$msg = "You are not authorised to delete.";		
	//}
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<script>
$(document).ready(function() {
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900	
	});
	

});

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
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("Guides & Tips", SITEROOT."/manage/cms/pages/guides-tips.php");
		$bread_crumb->add("Guides & Tips category", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/guide-section-tabs.php");
		?>
		<form>
			<div class="page_actions">
				<a class="btn btn-large btn-primary confirm confirm-add"><i class="icon-plus icon-white"></i> Add a New Category </a>
			 	<a href="<?php echo SITEROOT; ?>manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
				<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
                
			</div>
			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Category</th>
							<th width="15%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					    <?php
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT * 
									FROM guide_tip_category
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);							
							
							while($row = $result->fetch_object()) {
								$block = "<tr>";
								$block .= "<td>".stripslashes($row->category_name)."</td>";
								
								
								$block .= "<td><a class='confirm confirm-edit btn btn-primary'><i class='icon-cog icon-white'></i> Edit
								<input class='itemId' id='".$row->guide_tip_cat_id."' type='hidden' value='".$row->guide_tip_cat_id."' />
								<input class='contentToEdit' id='".$row->guide_tip_cat_id."' type='hidden' value='".stripslashes($row->category_name)."' /></a></td>";
									
								$block .= "<td><a class='confirm btn btn-danger'><i class='icon-remove icon-white'></i><input class='itemId' id='".$row->guide_tip_cat_id."' type='hidden' value='".$row->guide_tip_cat_id."' /></a></td>";
								$block .= "</tr>";
								echo $block;
							}
						?>

				</table>
			</div>
		</form>
    </div>
    <p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

    </div>
    
    
	<!-- New Delete Dialogue -->
	<div id="content-delete" class="confirm-content">
		<h3>Are you sure you want to delete this Category?</h3>
		<form name="del_guide_tip_category_form" action="guides-tips.php" method="post" target="_top">
			<input id="del_guide_tip_cat_id" class="itemId" type="hidden" name="del_guide_tip_cat_id" value='' />
			<a class="btn btn-large dismiss">No, Cancel</a>
			<button class="btn btn-danger btn-large" name="del_guide_tip_cat" type="submit" >Yes, Delete</button>
		</form>
	</div>
	<div class="disabledMsg">
		<p>Sorry, this item can't be deleted or inactive.</p>
	</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_guide_tip_cat" action="guides-tips.php" method="post" target="_top">
			<input id="guide_tip_cat_id" type="hidden" class="itemId" name="guide_tip_cat_id" value='' />
			<fieldset class="colcontainer">
				<label>Edit Category hhh</label>
				<input type="text" class="contentToEdit"  name="category_name" value=''>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_guide_tip_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_guide_tip_category_form" action="guides-tips.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Category</label>
				<input type="text" class="contentToAdd"  name="added_category">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_guide_tip_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>

