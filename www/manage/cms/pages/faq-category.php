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

require_once($real_root."/manage/admin-includes/manage-includes.php");

$progress = new SetupProgress;
$module = new Module;

$page_title = "FAQ Category";
$page_group = "faq";

require_once($real_root."/manage/admin-includes/set-page.php");	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = "";


if(isset($_POST["add_faq_cat"])){

	$added_category = mysql_real_escape_string($_POST["added_category"]); 
	$sql = sprintf("SELECT * FROM faq_category WHERE category_name = '%s' AND profile_account_id = '%u'", 
	$added_category, $_SESSION['profile_account_id']);	

	$result = $dbCustom->getResult($db,$sql);


	$ts = time();

	if($result->num_rows == 0){
		//if(in_array(2,$user_functions_array)){
			$sql = sprintf("INSERT INTO faq_category (category_name, profile_account_id) VALUES ('%s','%u')", 
			$added_category, $_SESSION['profile_account_id']);
		
			$msg = "Your change is live.";
		/*
		}else{
			$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, action) 
			VALUES ('%s','%u','%u','%s','%s','%s')", 
			"faq_category", $ts, $user_id, "faq", $added_category, "add");
			$msg = "Your change is now pending approval.";
		}
		*/
		$result = $dbCustom->getResult($db,$sql);
	}else{
		$msg = "The category name already exists";	
	}

}


if(isset($_POST["edit_faq_cat"])){
	
	$category_name = mysql_real_escape_string($_POST["category_name"]); 
	$faq_cat_id = $_POST["faq_cat_id"];
	$ts = time();

	//if(in_array(2,$user_functions_array)){
		// create a backup
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($faq_cat_id,$user_id,"faq_category");	

		$sql = sprintf("UPDATE faq_category SET category_name = '%s' WHERE faq_cat_id = '%u'", 
		$category_name, $faq_cat_id);

		$msg = "Your change is live.";
	/*
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u')", 
			"faq_category", $ts, $user_id, "faq", $category_name, $faq_cat_id);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST["del_faq_cat"])){

	//if(in_array(2,$user_functions_array)){
		$faq_cat_id = $_POST["del_faq_cat_id"];
	
		//include("includes/class.backup.php");
		//$backup = new Backup;
		//$dbu = $backup->doBackup($faq_cat_id,$user_id,"faq_category","delete");	

		$sql = sprintf("DELETE FROM faq_category WHERE faq_cat_id = '%u'", $faq_cat_id);
		$result = $dbCustom->getResult($db,$sql);
		//$sql = "DELETE FROM review WHERE content_record_id = '".$faq_cat_id."'";
		//$result = mysql_query($sql);
		//if(!$result)die(mysql_error());

		$msg = "This item has been deleted.";		

	//}else{
		//$msg = "You are not authorised to delete.";		
	//}
}


require_once($real_root."/manage/admin-includes/doc_header.php"); 


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
	require_once($real_root."/manage/admin-includes/manage-header.php");
	require_once($real_root."/manage/admin-includes/manage-top-nav.php");
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($real_root."/manage/admin-includes/manage-side-nav.php");
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("FAQ", SITEROOT."/manage/cms/pages/faq.php");
		$bread_crumb->add("FAQ Category", "");
		echo $bread_crumb->output();

        require_once($real_root."/manage/admin-includes/manage-content-top-category.php");
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/faq-section-tabs.php");
		?>
		<form>
			<div class="page_actions">
				<a class="btn btn-large btn-primary confirm confirm-add"><i class="icon-plus icon-white"></i> Add a New FAQ Category </a>
			 	<a href="<?php echo SITEROOT; ?>manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>
                
				<button href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
				<a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>

			</div>
			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="80%">Category</th>
							<th width="15%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					$sql = "SELECT * FROM faq_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);
					
					$block = "<tr>"; 
					while($row = $result->fetch_object()) {				
						$block .= "<td>".stripslashes($row->category_name)."</td>";
						$block .= "<td><a class='btn btn-primary confirm confirm-edit'><i class='icon-cog icon-white'></i> Edit<input type='hidden' class='itemId' id='".$row->faq_cat_id."' value='".$row->faq_cat_id."' /><input type='hidden' class='contentToEdit' id='".$row->faq_cat_id."' value='".stripslashes($row->category_name)."' /></a></td>";
						$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->faq_cat_id."' class='itemId' value='".$row->faq_cat_id."' /></a></td>";
						$block .= "</tr>";
					}
					echo $block;
					?>
    			</table>
			</div>
		</form>
	</div>
	<p class="clear"></p>
<?php 
require_once($real_root."/manage/admin-includes/manage-footer.php");
?>

	<!-- New Delete Dialogue -->
	<div id="content-delete" class="confirm-content">
		<h3>Are you sure you want to delete this category?</h3>
		<form name="del_faq_category" action="faq.php" method="post" target="_top">
			<input id="del_faq_cat_id" class="itemId" type="hidden" name="del_faq_cat_id" value="" />
			<a class="btn btn-large dismiss">No, Cancel</a>
			<button class="btn btn-danger btn-large" name="del_faq_cat" type="submit" >Yes, Delete</button>
		</form>
	</div>
	<div class="disabledMsg">
		<p>Sorry, this item can't be deleted or inactive.</p>
	</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_faq_cat" action="faq.php" method="post" target="_top">
			<input id="faq_cat_id" type="hidden" class="itemId" name="faq_cat_id" value="" />
			<fieldset class="colcontainer">
				<label>Edit Category</label>
				<input type="text" class="contentToEdit"  name="category_name" value="">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_faq_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_faq_category" action="faq.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Category</label>
				<input type="text" class="contentToAdd"  name="added_category">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_faq_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</div>
</body> 
</html>
<?php $db_dis = dbDisconnect(); ?>
