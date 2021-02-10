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

$page_title = "Custom Product Attributes";
$page_group = "attribute";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["add_attribute"])){

	$added_attribute = addslashes($_POST["added_attribute"]); 
	
	$sql = sprintf("SELECT attribute_id 
					FROM attribute 
					WHERE attribute_name = 's'
					AND profile_account_id = '%u'", 
					$added_attribute,$_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO attribute (attribute_name, profile_account_id) VALUES ('%s','%u')", $added_attribute, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Attribute Added Successfully.";

	}else{
		$msg = "The attribute name already exists";
	}

}


if(isset($_POST["edit_attribute"])){
	
	$name = addslashes($_POST["attribute_name"]); 
	$attribute_id = $_POST["attribute_id"];

	$sql = sprintf("UPDATE attribute SET attribute_name = '%s' WHERE attribute_id = '%u'", 
	$name, $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Attribute successfully edited.";
	
}

if(isset($_POST["del_attribute"])){

	$attribute_id = $_POST["del_attribute_id"];

	$sql = "SELECT opt_id 
			FROM attribute, opt 
			WHERE attribute.attribute_id = opt.attribute_id
			AND attribute.attribute_id = '".$attribute_id."'
			";
	$result = $dbCustom->getResult($db,$sql);
	//
	while($opt_row = $result->fetch_object()){
	
			$sql = "DELETE FROM item_to_opt WHERE opt_id = '".$opt_row->opt_id."'";
			$temp_result = mysql_query($sql);
			//if(!$temp_result)die(mysql_error());
	}


	$sql = sprintf("DELETE FROM attribute WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	//

	$sql = sprintf("DELETE FROM opt WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	//
	$msg = "Attribute successfully deleted.";

}

unset($_SESSION['paging']);

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
			$bread_crumb->add("Attributes", '');
			echo $bread_crumb->output();
		}
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//attribute section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/attribute-section-tabs.php");
		
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		
		if($admin_access->product_catalog_level > 1){
		

		?>
			<div class="page_actions"> 
            <a class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Attribute </a>
			</div>		
        <?php 
		}
		
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT * 
				FROM attribute 
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
			if($sortby == 'attribute_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY attribute_name DESC".$limit;
				}else{
					$sql .= " ORDER BY attribute_name".$limit;	
				}
			}
		}else{
			$sql .= " ORDER BY attribute_name".$limit;					
		}
						
		$result = $dbCustom->getResult($db,$sql);		
					
		if($total_rows > $rows_per_page){
			echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/attribute.php", $sortby, $a_d);
			echo "<br /><br /><br />";
		}
			
		if($total_rows < 1){
			echo "No attributes";	
		}
		

		?>

        <div class="data_table">
        <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
            <table cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th <?php addSortAttr('attribute_name',true); ?>>
                            Name
                           <i <?php addSortAttr('attribute_name',false); ?>></i>
                        </th>
                        <th width="16%">Options</th>
                        <th width="13%">Edit</th>
                        <th width="5%">Delete</th>
                    </tr>
                </thead>
				<?php
							$block = '';
							$j = 0;
							while($row = $result->fetch_object()) {
								$j =  $j +1;
								$block .= "<tr>";
								$block .= "<td valign='middle' width='300px'>".stripslashes($row->attribute_name)."</td>";
								
								$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
								$fb = (!$strip) ? "fancybox fancybox.iframe" : '';						
													
													
								$url_str = "option.php";
								$url_str .= "?attribute_id=".$row->attribute_id;
								$url_str .= "&strip=".$strip;							
								//$url_str .= "&pagenum=".$pagenum;
								//$url_str .= "&sortby=".$sortby;
								//$url_str .= "&a_d=".$a_d;
								//$url_str .= "&truncate=".$truncate;					
																		
								$block .= "<td valign='middle'>
								<a class='btn btn-primary ".$fb." ' href='".$url_str."'>
								<i class='icon-list icon-white'></i> Options</a></td>";					

								$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled."' ><i class='icon-cog icon-white'></i> 
								Edit<input type='hidden' class='itemId' id='".$row->attribute_id."' value='".$row->attribute_id."' />
								<input type='hidden' class='contentToEdit' id='".$row->attribute_id."' value=\"".htmlentities($row->attribute_name)."\" /></a></td>";

								
								
								$block .= "<td valign='middle'>
								<a class='btn btn-danger confirm ".$disabled." '>
								<i class='icon-remove icon-white'></i>
								<input type='hidden' id='".$row->attribute_id."' class='itemId' value='".$row->attribute_id."' /></a>
								</td>";
							
								$block .= "</tr>";
							}
							echo $block;
    					?>
				</table>
				<?php
				
				
				
			
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "catalog/attributes/attribute.php", $sortby, $a_d);
			}

			?>	
			</div>
	</div>
	<p class="clear"></p>
    <?php
	if(!$strip){  
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	
	$url_str = "attribute.php";
	$url_str .= "?strip=".$strip;							
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;			
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Attribute?</h3>
	<form name="del_attribute" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_attribute_id" class="itemId" type="hidden" name="del_attribute_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_attribute" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_attribute" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Custom Attribute</label>
				<input type="text" class="contentToAdd"  name="added_attribute">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_attribute" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_attribute" action="attribute.php<?php if($strip) echo "?strip=1"; ?>" method="post" target="_top">
			<input id="attribute_id" type="hidden" class="itemId" name="attribute_id" value='' />
			<fieldset class="colcontainer">
				<label>Edit Attribute</label>
				<input type="text" class="contentToEdit"  name="attribute_name" value=''>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_attribute" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
</body>
</html>
