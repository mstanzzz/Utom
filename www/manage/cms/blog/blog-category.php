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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Blog";
$page_group = "blog";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["add_blog_cat"])){

	$added_category = addslashes($_POST["added_category"]); 
	$sql = sprintf("SELECT blog_cat_id FROM blog_category 
				WHERE name = '%s'
				AND profile_account_id = '%u'", $added_category, $_SESSION['profile_account_id']);	
	$c_result = mysql_query ($sql);
	$ts = time();
	if(!mysql_num_rows($c_result)){
		$sql = sprintf("INSERT INTO blog_category (name, profile_account_id) VALUES ('%s','%u')",
		$added_category, $_SESSION['profile_account_id']);
		$msg = '';
		$result = $dbCustom->getResult($db,$sql);
		
	}else{
		$msg = "The category name already exists";	
	}
}

if(isset($_POST["edit_blog_cat"])){
	
	$name = addslashes($_POST['name']); 
	$blog_cat_id = $_POST["blog_cat_id"];
	$ts = time();
	$sql = sprintf("UPDATE blog_category SET name = '%s' WHERE blog_cat_id = '%u'", 
	$name, $blog_cat_id);
	$msg = '';

	$result = $dbCustom->getResult($db,$sql);
	
}

if(isset($_POST["del_blog_cat"])){
		$blog_cat_id = $_POST["del_blog_cat_id"];

		$sql = sprintf("DELETE FROM blog_category WHERE blog_cat_id = '%u'", $blog_cat_id);
		$result = $dbCustom->getResult($db,$sql);
		//
		
		$msg = "Blog category deleted.";
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

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
		$bread_crumb->add("Blog", SITEROOT."/manage/cms/blog/blog.php");
		$bread_crumb->add("Blog Category", '');

        echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//faq section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/blog-section-tabs.php");
	
		if($admin_access->cms_level > 1){
		?>		
        <div class="page_actions">
        	<a class="btn btn-large btn-primary confirm confirm-add"><i class="icon-plus icon-white"></i> Add a New Category </a> 
        </div>
		<?php } ?>
        <div class="data_table">
			<table cellpadding="10" cellspacing="0">
				<thead>
					<tr>
						<th >Category</th>
						<th width="14%">Edit</th>
						<th width="5%">Delete</th>
					</tr>
				</thead>
				<?php
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT * FROM blog_category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				$result = $dbCustom->getResult($db,$sql);						
						 
						while($row = $result->fetch_object()) {
							$block = "<tr>";
							$block .= "<td>".$row->name."</td>";
							
							$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
							
							$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled." '>
							<i class='icon-cog icon-white'></i> Edit
							<input type='hidden' class='itemId' id='".$row->blog_cat_id."' value='".$row->blog_cat_id."' />
							<input type='hidden' class='contentToEdit' id='".$row->blog_cat_id."' value='".$row->name."' /></a></td>";
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->blog_cat_id."' class='itemId' value='".$row->blog_cat_id."' /></a></td>";
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
	<form name="del_blog_form" action="blog.php" method="post" target="_top">
		<input id="del_blog_cat_id" class="itemId" type="hidden" name="del_blog_cat_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_blog_cat" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<!-- New Edit Dialogue -->
<div id="content-edit" class="confirm-content">
	<form name="edit_blog_cat_form" action="blog.php" method="post" target="_top">
		<input id="blog_cat_id" type="hidden" class="itemId" name="blog_cat_id" value='' />
		<fieldset class="colcontainer">
			<label>Edit Category</label>
			<input type="text" class="contentToEdit"  name="name" value=''>
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="edit_blog_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
	</form>
</div>
<!-- New Add Dialogue -->
<div id="content-add" class="confirm-content">
	<form name="add_blog_category_form" action="blog.php" method="post" target="_top">
		<fieldset class="colcontainer">
			<label>Add New Category</label>
			<input type="text" class="contentToAdd"  name="added_category">
		</fieldset>
		<a class="btn btn-large dismiss"> Cancel </a>
		<button name="add_blog_cat" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
	</form>
</div>
</body>
</html>
