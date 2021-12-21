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
$page_title = "Installation Skill Levels";
$page_group = "skill-level";

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["add_skill_level"])){

	$level_name = addslashes($_POST["added_skill_level"]); 
	$description = addslashes($_POST['description']);

	$sql = sprintf("INSERT INTO skill_level (level_name, description, profile_account_id) VALUES ('%s','%s','%u')", $level_name, $description, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	if(!$result) {
		die(mysql_error());
		$msg = "</div><div class='alert alert-danger'><i class='icon-warning-sign'></i> Sorry, an error occurred and the item could not be added.";	
	}
	else {
	$msg = "New skill level added successfully!";		
	}
	
}


if(isset($_POST["edit_skill_level"])){
	
	
	$level_name = addslashes($_POST["level_name"]); 
	$description = addslashes($_POST['description']);
	$skill_level_id = $_POST["skill_level_id"];
	
	//echo $skill_level_id;
	
	$sql = sprintf("UPDATE skill_level SET level_name = '%s', description = '%s' WHERE skill_level_id = '%u'", 
	$level_name, $description, $skill_level_id);
	
	//echo $sql;
	$result = $dbCustom->getResult($db,$sql);
	if(!$result) {
		die(mysql_error());
		$msg = "</div><div class='alert alert-danger'><i class='icon-warning-sign'></i> Sorry, an error occurred and the changes were not saved.";	
	}

	$msg = "Skill level changes saved.";
	
}

if(isset($_POST["del_skill_level_id"])){

	$skill_level_id = $_POST["del_skill_level_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM skill_level WHERE skill_level_id = '%u'", $skill_level_id);
	$result = $dbCustom->getResult($db,$sql);
	if(!$result) {
		die(mysql_error());
		$msg = "</div><div class='alert alert-danger'><i class='icon-warning-sign'></i> Sorry, an error occurred and the item was not deleted.";	
	}

	$msg = "Skill level deleted successfully.";

}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$("tbody tr").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});	
});
</script>
</head>

<body>
<?php
if(!$strip){
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php
		if(!$strip){ 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php
		if(!$strip){ 
			require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", SITEROOT."/manage/catalog/catalog-landing.php");
			$bread_crumb->add("Skill Level", SITEROOT."/manage/catalog/attributes/lead-time.php");
			echo $bread_crumb->output();
		}		
 		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//attribute section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/attribute-section-tabs.php");
		
		if($admin_access->product_catalog_level > 1){
		?>
			<div class="page_actions"> 
            	<a class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Skill Level </a>
			</div>
		<?php
		}


$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT * FROM skill_level 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$nmx_res = $dbCustom->getResult($db,$sql);


$total_rows = $nmx_res->num_rows;
$rows_per_page = 16;
$last = ceil($total_rows/$rows_per_page); 
			
if ($pagenum < 1){ 
	$pagenum = 1; 
}elseif ($pagenum > $last){ 
	$pagenum = $last; 
} 
			
$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
			
if($sortby != ''){
	if($sortby == 'level_name'){
		if($a_d == 'd'){
			$sql .= " ORDER BY level_name DESC".$limit;
		}else{
			$sql .= " ORDER BY level_name".$limit;	
		}
	}
		
	if($sortby == 'description'){
		if($a_d == 'd'){
			$sql .= " ORDER BY description DESC".$limit;
		}else{
			$sql .= " ORDER BY description".$limit;	
		}
	}
		
}else{
	$sql .= " ORDER BY level_name".$limit;					
}
				
$result = $dbCustom->getResult($db,$sql);
			
if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/skill-level.php", $sortby, $a_d);
}
	
if($total_rows < 1){
	echo "No skill levels";	
}
		?>	
<br /><br /><br />
<div class="data_table">
	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
	<table cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th <?php addSortAttr('level_name',true); ?>>
                    Skill Level Name
                   <i <?php addSortAttr('level_name',false); ?>></i>
                </th>

				<th <?php addSortAttr('description',true); ?>>
                    Skill Level Description
                   <i <?php addSortAttr('description',false); ?>></i>
                </th>
				<th width="13%">Edit</th>
				<th width="5%">Delete</th>
			</tr>
		</thead>
		<?php 
								
				 echo $block ='';
				$j = 0;
				while($row = $result->fetch_object()) {
				$j =  $j +1;
					$block .= "<tr>"; 
					$block .= "<td valign='middle'>".stripslashes($row->level_name)."</td>";
					$block .= "<td valign='middle'>".stripslashes($row->description)."</td>";
					
					$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
					
					$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled." '>
					<i class='icon-cog icon-white'></i> Edit
					<input type='hidden' class='itemId' id='".$row->skill_level_id."' value='".$row->skill_level_id."' />
					<input type='hidden' class='contentToEdit' id='".$row->skill_level_id."' value='".htmlentities($row->level_name,ENT_QUOTES)."' />
					<input type='hidden' class='descriptionToEdit' id='".$row->skill_level_id."' value='".htmlentities($row->description,ENT_QUOTES)."'  /></a></td>";
					
					$block .= "<td valign='middle'>
					<a class='btn btn-danger confirm ".$disabled." '>
					<i class='icon-remove icon-white'></i>
					<input type='hidden' id='".$row->skill_level_id."' class='itemId' value='".$row->skill_level_id."' /></a></td>";
					$block .= "</tr>";
				}
				echo $block;
				?>
			</table>
			<?php
            if($total_rows > $rows_per_page){
                echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "catalog/attributes/skill-level.php", $sortby, $a_d);
            }
            ?>
		</div>
	</div>
	<p class="clear"></p>
    <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
	
	$url_str = "skill-level.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

    ?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this skill level?</h3>
	<form name="del_skill_level" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_skill_level_id" class="itemId" type="hidden" name="del_skill_level_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_skill_level" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_skill_level" action="<?php echo $url_str; ?>" method="post" target="_top">
			<input id="skill_level_id" type="hidden" class="itemId" name="skill_level_id" value='' />
			<fieldset class="colcontainer">
				<label>Skill Level Name</label>
				<input type="text" class="contentToEdit"  name="level_name" value=''>
				<label>Skill Level Description</label>
				<textarea class="descriptionToEdit" name="description"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_skill_level" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_skill_level" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Skill Level Time Name</label>
				<input type="text" class="contentToAdd"  name="added_skill_level">
				<label>Lead Time Description</label>
				<textarea name="description" cols="22" rows="4"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_skill_level" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
    </body>
</html>

