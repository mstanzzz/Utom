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

//profile_account_id = '".$_SESSION['profile_account_id']."'

$page_title = "Specs Categories";
$page_group = "specs";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

if(isset($_POST["add_spec_cat"])){

	$added_category = addslashes($_POST["added_category"]); 
	$sql = sprintf("SELECT * 
					FROM spec_category 
					WHERE category_name = '%s'
					AND profile_account_id = '%u'", $added_category, $_SESSION['profile_account_id']);	
	$c_result = mysql_query ($sql);
	
	if(!mysql_num_rows($c_result)){
		$sql = sprintf("INSERT INTO spec_category 
						(category_name, profile_account_id) 
						VALUES ('%s','%u')", $added_category, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		

		$msg = "Your change is live.";
	
	}

}


if(isset($_POST["edit_spec_cat"])){
	
	$category_name = addslashes($_POST["category_name"]); 
	$spec_cat_id = $_POST["spec_cat_id"];
	$sql = sprintf("UPDATE spec_category 
					SET category_name = '%s' 
					WHERE spec_cat_id = '%u'", 
	$category_name, $spec_cat_id);

	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is live.";

}

if(isset($_POST["del_spec_category"])){

	$spec_cat_id = $_POST["del_spec_cat_id"];

	$sql = sprintf("DELETE FROM spec_category 
			WHERE spec_cat_id = '%u'", $spec_cat_id);
	$result = $dbCustom->getResult($db,$sql);
		
	$msg = "Your change is live.";
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


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
		$bread_crumb->add("Specs", $ste_root."manage/cms/pages/specs.php");
		$bread_crumb->add("Specs Categories", '');
        echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//specs section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/specs-section-tabs.php");
		?>








		<form>
			<div class="page_actions">
				<a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" class="btn btn-large"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
				<a class="btn btn-large btn-primary confirm confirm-add"><i class="icon-plus icon-white"></i> Add a New Category </a>
                <a href="<?php echo $ste_root; ?>/manage/cms/navigation/navbar.php?strip=1" class="btn btn-primary btn-large fancybox fancybox.iframe">
                <i class="icon-eye-open icon-white"></i> Edit Navigation </a>

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
					<tbody>
					<?php
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
					$sql = "SELECT * 
							FROM spec_category
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);					
							
					while($row = $result->fetch_object()) {
						$block = "<tr>";
						$block .= "<td>".stripslashes($row->category_name)."</td>";
						
						$block .= "<td><a class='confirm confirm-edit btn btn-primary'>
						<i class='icon-cog icon-white'></i> Edit
						<input class='itemId' id='".$row->spec_cat_id."' type='hidden' value='".$row->spec_cat_id."' />
						<input class='contentToEdit' id='".$row->spec_cat_id."' type='hidden' value='".stripslashes($row->category_name)."' /></a></td>";
							
						$block .= "<td><a class='confirm btn btn-danger'>
						<i class='icon-remove icon-white'></i>
						<input class='itemId' id='".$row->spec_cat_id."' type='hidden' value='".$row->spec_cat_id."' /></a></td>";
						$block .= "</tr>";
						echo $block;
					}
					?>
					</tbody>
				</table>
			</div>
		</form>
    </div>
    <p class="clear"></p>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>

    </div>

	<div id="content-delete" class="confirm-content">
		<h3>Are you sure you want to delete this Category?</h3>
		<form name="del_spec_category_form" action="specs-category.php" method="post" target="_top">
			<input id="del_spec_cat_id" class="itemId" type="hidden" name="del_spec_cat_id" value='' />
			<a class="btn btn-large dismiss">No, Cancel</a>
			<button class="btn btn-danger btn-large" name="del_spec_category" type="submit" >Yes, Delete</button>
		</form>
	</div>
	<div class="disabledMsg">
		<p>Sorry, this item can't be deleted or inactive.</p>
	</div>
    
    
	<div id="content-edit" class="confirm-content">
		<form name="edit_spec_cat" action="specs-category.php" method="post" target="_top">
			<input id="spec_cat_id" type="hidden" class="itemId" name="spec_cat_id" value='' />
			<fieldset class="colcontainer">
				<label>Edit Category</label>
				<input type="text" class="contentToEdit"  name="category_name" value=''>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_spec_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
    
	<div id="content-add" class="confirm-content">
		<form name="add_spec_category_form" action="specs-category.php" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Category</label>
				<input type="text" class="contentToAdd"  name="added_category">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_spec_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>

