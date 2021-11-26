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


$page_title = "Policy Category";
$page_group = "policy";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

if(isset($_POST["add_policy_cat"])){

	$added_category = addslashes($_POST["added_category"]); 
	$sql = sprintf("SELECT * 
					FROM policy_category 
					WHERE category_name = '%s'
					AND profile_account_id = '%u'", $added_category, $_SESSION['profile_account_id']);	
	$c_result = mysql_query ($sql);
	$ts = time();

	if(!mysql_num_rows($c_result)){
		//if(in_array(2,$user_functions_array)){
			$sql = sprintf("INSERT INTO policy_category (category_name, profile_account_id) VALUES ('%s','%u')", $added_category, $_SESSION['profile_account_id']);
			
			$msg = "Your change is now live.";
		/*
		}else{
			$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, action) 
			VALUES ('%s','%u','%u','%s','%s','%s')", 
			"policy_category", $ts, $user_id, "policy", $added_category, "add");
			$msg = "Your change is now pending approval.";
		}
		*/
		$result = $dbCustom->getResult($db,$sql);
		
	}else{
		$msg = "The category name already exists";	
	}
}


if(isset($_POST["edit_policy_cat"])){
	
	$category_name = addslashes($_POST["category_name"]); 
	$policy_cat_id = $_POST["policy_cat_id"];
	$ts = time();


	//if(in_array(2,$user_functions_array)){
		// create a backup
		//$backup = new Backup;
		//$dbu = $backup->doBackup($policy_cat_id,$user_id,"policy_category");	

		$sql = sprintf("UPDATE policy_category SET category_name = '%s' WHERE policy_cat_id = '%u'", 
		$category_name, $policy_cat_id);

			$msg = "Your change is now live.";
	/*	
	}else{
		$sql = sprintf("INSERT INTO review (content_table, when_submitted, submitted_by_login_id, slug, content_short1, content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%u')", 
			"policy_category", $ts, $user_id, "policy", $category_name, $policy_cat_id);
		$msg = "Your change is now pending approval.";
	}
	*/
	$result = $dbCustom->getResult($db,$sql);
		
}

if(isset($_POST["del_policy_cat"])){
	//if(in_array(2,$user_functions_array)){
		$policy_cat_id = $_POST["del_policy_cat_id"];

		//$backup = new Backup;
		//$dbu = $backup->doBackup($policy_cat_id,$user_id,"policy_category","delete");	
	
		$sql = sprintf("DELETE FROM policy_category WHERE policy_cat_id = '%u'", $policy_cat_id);
		$result = $dbCustom->getResult($db,$sql);
		//
		//$sql = "DELETE FROM review WHERE content_record_id = '".$policy_cat_id."'";
		//$result = $dbCustom->getResult($db,$sql);
		//

		$msg = "Your change is now live.";

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
		$bread_crumb->add("Policy", SITEROOT."/manage/cms/pages/policy.php");
		$bread_crumb->add("Policy Category", '');
        echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/policy-section-tabs.php");
		?>
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
							<th width="83%">Category Name</th>
							<th width="12%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
					
						$sql = "SELECT * FROM policy_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				$result = $dbCustom->getResult($db,$sql);						
						while($row = $result->fetch_object()) {
							$block = "<tr>";
							$block .= "<td>".stripslashes($row->category_name)."</td>";
							
							$block .= "<td><a class='btn btn-primary confirm confirm-edit'><i class='icon-cog icon-white'></i> Edit
							<input type='hidden' class='itemId' id='".$row->policy_cat_id."' value='".$row->policy_cat_id."' />
							<input type='hidden' class='contentToEdit' id='".$row->policy_cat_id."' value='".stripslashes($row->category_name)."' /></a></td>";
							
							$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->policy_cat_id."' class='itemId' value='".$row->policy_cat_id."' /></a></td>";
							$block .= "</tr>";
							echo $block;
						}
					?>
				</table>
			</div>
</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this category?</h3>
	<form name="del_policy_category_form" action="policy.php" method="post" target="_top">
		<input id="del_policy_cat_id" class="itemId" type="hidden" name="del_policy_cat_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_policy_cat" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

<div id="content-edit" class="confirm-content">
	<form name="edit_policy_cat" action="policy.php" method="post" target="_top">
		<input id="policy_cat_id" type="hidden" class="itemId" name="policy_cat_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Category</label>
			<input type="text" class="contentToEdit"  name="category_name" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_policy_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>

	<div id="content-add" class="confirm-content">
		<form name="add_policy_category_form" action="policy.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Category</label>
				<input type="text" class="contentToAdd"  name="added_category">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_policy_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>


</body>
</html>

