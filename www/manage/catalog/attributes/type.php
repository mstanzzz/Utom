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


$page_title = "Product Types";
$page_group = "type";

	


$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : 0;

if(isset($_POST["add_type"])){

	$added_type = addslashes($_POST["added_type"]); 
	
	$sql = sprintf("SELECT * FROM type WHERE name = '%s' AND profile_account_id = '%u'", $added_type, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	
	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO type (name, profile_account_id) VALUES ('%s','%u')", $added_type, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Your change is now live.";

	}else{
		$msg = "The type name already exists";
	}

}


if(isset($_POST["edit_type"])){
	
	$name = addslashes($_POST['name']); 
	$type_id = $_POST["type_id"];
	$sql = sprintf("UPDATE type SET name = '%s' WHERE type_id = '%u'", 
	$name, $type_id);
	$result = $dbCustom->getResult($db,$sql);
	if(!$result) {
		die(mysql_error());
		$msg = "</div><div class='alert alert-danger'><i class='icon-warning-sign'></i> Sorry, an error occurred and your changes were not saved.";	
	}

	$msg = "Changes saved!";
	
}

if(isset($_POST["del_type_id"])){

	$type_id = $_POST["del_type_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM type WHERE type_id = '%u'", $type_id);
	$result = $dbCustom->getResult($db,$sql);
	if(!$result) {
		die(mysql_error());
		$msg = "</div><div class='alert alert-danger'><i class='icon-warning-sign'></i> Sorry, an error occurred and the item was not deleted.";	
	}

	$msg = "Type deleted successfully.";
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
		if(!$strip){
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 
		if(!$strip){ 
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Type", $ste_root."manage/catalog/attributes/type.php");
			echo $bread_crumb->output();
		}
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//attribute section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/attribute-section-tabs.php");
		
		if($admin_access->product_catalog_level > 1){
		?>
			<div class="page_actions"> 
            	<a class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Type </a>
			</div>
		<?php 
		}
$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT * FROM type
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
	if($sortby == 'name'){
		if($a_d == 'd'){
			$sql .= " ORDER BY name DESC".$limit;
		}else{
			$sql .= " ORDER BY name".$limit;	
		}
	}
}else{
	$sql .= " ORDER BY name".$limit;					
}
				
$result = $dbCustom->getResult($db,$sql);
			
if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/type.php", $sortby, $a_d);
}
	
if($total_rows < 1){
	echo "No types";	
}

?>
<br /><br /><br />
<div class="data_table">
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
	<table cellpadding="10" cellspacing="0">
		<thead>
			<tr>
				<th <?php addSortAttr('name',true); ?>>
                    Type Name
                   <i <?php addSortAttr('name',false); ?>></i>
                </th>
				<th width="13%">Edit</th>
				<th width="5%">Delete</th>
		</tr>
	</thead>
<?php
    $block ='';
	$j=0;
    while($row = $result->fetch_object()) {
		$j =  $j +1;
		$block .= "<tr>"; 
		$block .= "<td valign='middle' width='300px'>".stripslashes($row->name)."</td>";
		
		$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
		
		$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled." '>
		<i class='icon-cog icon-white'></i> Edit<input type='hidden' class='itemId' id='".$row->type_id."' value='".$row->type_id."' />
		<input type='hidden' class='contentToEdit' id='".$row->type_id."' value='".htmlentities($row->name,ENT_QUOTES)."' /></a></td>";
		
		$block .= "<td valign='middle'>
		<a class='btn btn-danger confirm ".$disabled." '>
		<i class='icon-remove icon-white'></i><input type='hidden' id='".$row->type_id."' class='itemId' value='".$row->type_id."' /></a></td>";
		$block .= "</tr>";
    }
     echo $block;
?>


  
</table>
<?php
if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "catalog/attributes/type.php", $sortby, $a_d);
}
?>
    </div>
		</div>
<p class="clear"></p>
    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	$url_str = "type.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

    ?>
    </div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this type?</h3>
	<form name="del_type" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_type_id" class="itemId" type="hidden" name="del_type_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_type" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_type" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Type</label>
				<input type="text" class="contentToAdd"  name="added_type">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_type" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_type" action="<?php echo $url_str; ?>" method="post" target="_top">
			<input id="type_id" type="hidden" class="itemId" name="type_id" value='' />
			<fieldset class="colcontainer">
				<label>Edit Category</label>
				<input type="text" class="contentToEdit"  name="name" value=''>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_type" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>

</body>
</html>

