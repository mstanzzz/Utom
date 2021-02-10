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

$page_title = "Product Lead Times";
$page_group = "lead-time";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["add_lead_time"])){

	$lead_time = addslashes($_POST["added_lead_time"]); 
	$description = addslashes($_POST['description']);
	
	$sql = sprintf("SELECT lead_time_id FROM lead_time WHERE lead_time = '%s' AND profile_account_id = '%u'", $lead_time, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO lead_time (lead_time, description, profile_account_id) VALUES ('%s','%s','%u')", $lead_time, $description, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Your change is now live.";

	}else{
		$msg = "The brand name already exists";
	}

//exit;


}


if(isset($_POST["edit_lead_time"])){
	
	
	$lead_time = addslashes($_POST["lead_time"]); 
	$description = addslashes($_POST['description']);
	$lead_time_id = $_POST["lead_time_id"];
	
	//echo $lead_time_id;
	
	$sql = sprintf("UPDATE lead_time SET lead_time = '%s', description = '%s' WHERE lead_time_id = '%u'", 
	$lead_time, $description, $lead_time_id);
	
	//echo $sql;
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";
	
}

if(isset($_POST["del_lead_time_id"])){

	$lead_time_id = $_POST["del_lead_time_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM lead_time WHERE lead_time_id = '%u'", $lead_time_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";


//exit;

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
			$bread_crumb->add("Lead Time", $ste_root."manage/catalog/attributes/lead-time.php");
			echo $bread_crumb->output();
		}		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//attribute section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/attribute-section-tabs.php");
		if($admin_access->product_catalog_level > 1){
		?>
			<div class="page_actions"> 
            	<a class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Lead Time </a>
			</div>
		<?php 
		}
		

$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT * FROM lead_time 
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
	if($sortby == 'lead_time'){
		if($a_d == 'd'){
			$sql .= " ORDER BY lead_time DESC".$limit;
		}else{
			$sql .= " ORDER BY lead_time".$limit;	
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
	$sql .= " ORDER BY lead_time".$limit;					
}
				
$result = $dbCustom->getResult($db,$sql);
			
if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/lead-time.php", $sortby, $a_d);
	echo "<br /><br /><br />";
}
	
if($total_rows < 1){
	echo "No lead times";	
}?>

<div class="data_table">
<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
	<table cellpadding="10" cellspacing="0">
		<thead>
			<tr>
   				<th <?php addSortAttr('lead_time',true); ?>>
                    Lead Time Name
                   <i <?php addSortAttr('lead_time',false); ?>></i>
                </th>

				<th <?php addSortAttr('description',true); ?>>
                    Lead Time Description
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
		$block .= "<td valign='middle'>".$row->lead_time."</td>";
		$block .= "<td>".stripAllSlashes($row->description)."</td>";
		
		$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
		
		$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled." '>
		<i class='icon-cog icon-white'></i> Edit
		<input type='hidden' class='itemId' id='".$row->lead_time_id."' value='".$row->lead_time_id."' />
		<input type='hidden' class='contentToEdit' id='".$row->lead_time_id."' value='".stripslashes(htmlentities($row->lead_time,ENT_QUOTES))."' />
		<input type='hidden' class='descriptionToEdit' id='".$row->lead_time_id."' value='".stripslashes(htmlentities($row->description,ENT_QUOTES))."' /></a></td>";
		
		$block .= "<td valign='middle'>
		<a class='btn btn-danger confirm ".$disabled." '>
		<i class='icon-remove icon-white'></i>
		<input type='hidden' id='".$row->lead_time_id."' class='itemId' value='".$row->lead_time_id."' /></a></td>";
		$block .= "</tr>";
    }
    echo $block;
	?>

</table>
<?php

if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "catalog/attributes/lead-time.php", $sortby, $a_d);
}
	
?>

</div>
</div>
<p class="clear"></p>
    <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    
	$url_str = "lead-time.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

	?>
</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this lead time?</h3>
	<form name="del_lead_time" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_lead_time_id" class="itemId" type="hidden" name="del_lead_time_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_lead_time" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_lead_time" action="<?php echo $url_str; ?>" method="post" target="_top">
			<input id="lead_time_id" type="hidden" class="itemId" name="lead_time_id" value='' />
			<fieldset class="colcontainer">
				<label>Lead Time Name</label>
				<input type="text" class="contentToEdit"  name="lead_time" value=''>
				<label>Lead Time Description</label>
				<textarea class="descriptionToEdit" name="description"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_lead_time" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_lead_time" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Lead Time Name</label>
				<input type="text" class="contentToAdd"  name="added_lead_time">
				<label>Lead Time Description</label>
				<textarea name="description" cols="22" rows="4"></textarea>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_lead_time" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>

