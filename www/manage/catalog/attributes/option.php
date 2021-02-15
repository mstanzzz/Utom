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

$page_title = "options";
$page_group = "attribute";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$attribute_id =  (isset($_REQUEST['attribute_id'])) ? $_REQUEST['attribute_id'] : 0;

$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'attribute';

// passed through sorting 
$uid1 =  (isset($_REQUEST['uid1'])) ? $_REQUEST['uid1'] : 0;
if(!$attribute_id) $attribute_id = $uid1;

$msg = '';

if(isset($_POST['add_opt'])){

	$added_opt = addslashes($_POST['added_opt']); 
	
	$sql = sprintf("SELECT opt_id 
					FROM opt, attribute 
					WHERE opt.attribute_id = attribute.attribute_id
					AND opt_name = '%s' 
					AND opt.attribute_id = '%u' 
					AND attribute.profile_account_id = '%u'",
	$added_opt, $attribute_id, $_SESSION['profile_account_id']);	
	$result = $dbCustom->getResult($db,$sql);	
	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO opt (opt_name, attribute_id) VALUES ('%s','%u')", $added_opt, $attribute_id);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = 'Option added.';

	}else{
		$msg = 'The option name already exists';
	}

}


if(isset($_POST['edit_opt'])){
	
	$name = addslashes($_POST['opt_name']); 
	$opt_id = $_POST['opt_id'];

	$sql = sprintf("UPDATE opt SET opt_name = '%s' WHERE opt_id = '%u'", 
	$name, $opt_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = 'Changes saved.';
	
}

if(isset($_POST['del_opt'])){

	$opt_id = $_POST['del_opt_id'];
	
	
	// delete all item to option with this opt_id

	$sql = sprintf("DELETE FROM opt WHERE opt_id = '%u'", $opt_id);
	$result = $dbCustom->getResult($db,$sql);
	//

	$sql = sprintf("DELETE FROM item_to_opt WHERE opt_id = '%u'", $opt_id);
	$result = $dbCustom->getResult($db,$sql);
	//


	$msg = 'Option Successfully Deleted.';

}




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 


		if(this.href.indexOf("edit") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'edit-option.php?opt_id='+f_id+'&attribute_id=<?php echo $attribute_id;  ?>',
			  success: function(data) {
				$('#edit').html(data);
				//alert('Load was performed.');
			  }
			});			
		}

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_opt_id").val(f_id);
			
		}		
		
	})


	$("a.inline").fancybox();
	
});


</script>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert alert-success">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
 	?>
		<div class="lightboxcontent">
 
	<?php 
		
	$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
	$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

	$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
	
	$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT * FROM opt
			WHERE attribute_id = '".$attribute_id."'";
	$nmx_res = $dbCustom->getResult($db,$sql);
	
	
	$total_rows = $nmx_res->num_rows;
	$rows_per_page = 10;
	$last = ceil($total_rows/$rows_per_page); 


	if ($pagenum < 1){ 
		$pagenum = 1; 
	}elseif ($pagenum > $last){ 
		$pagenum = $last; 
	} 
	
	$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
	
	if($sortby != ''){
		if($sortby == 'opt_name'){
			if($a_d == 'd'){
				$sql .= " ORDER BY opt_name DESC".$limit;
			}else{
				$sql .= " ORDER BY opt_name".$limit;	
			}
		}
		
	}else{
		$sql .= " ORDER BY opt_name".$limit;					
	}
		
	//echo $sql;				
	$result = $dbCustom->getResult($db,$sql);	
		
	$sql = "SELECT attribute_name FROM attribute
			WHERE attribute_id = '".$attribute_id."'";
	
	$res = $dbCustom->getResult($db,$sql);
		
	if($res->num_rows > 0){
	$name_obj = $res->fetch_object();
		echo "<h2>Edit ".$name_obj->attribute_name." Options</h2>";		
	}
		
	if($admin_access->product_catalog_level > 1){
	?>
            <div class="page_actions">
                <a class='btn btn-primary btn-large confirm confirm-add'><i class="icon-plus icon-white"></i> Add New Option </a>
                <a class="btn btn-large" href="<?php echo $ret_page.".php"; ?>" target="_top">Done Editing</a>
            </div>
	<?php
	}else{
			echo "<div class='alert'>
					<span class='fltlft'>
					<i class='icon-warning-sign'></i></span> Sorry, you don't have the permissions to edit this item.</div>	";	
	}
	?>
				
		
		
		
		<?php
		if($total_rows > $rows_per_page){			
			$uid1 = $attribute_id;
			echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/option.php", $sortby, $a_d, $uid1);
			echo "<br /><br />";
		}
		?>

		<div class="data_table">
        	
        	<?php 
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); 
			?>
			<table border="0" cellspacing="0" cellpadding="10">
				<thead>
					<tr>
                        <th <?php addSortAttr('opt_name',true); ?>>
                            Option Name
                           <i <?php addSortAttr('opt_name',false); ?>></i>
                        </th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<?php
				$block = "<tr>"; 
				while($row = $result->fetch_object()) {
					$block .= "<td valign='top'>".stripslashes($row->opt_name)."</td>";
					$block .= "<td><a class='btn btn-primary confirm confirm-edit'>
					<i class='icon-cog icon-white'></i> Edit<input type='hidden' class='itemId' id='".$row->opt_id."' value='".$row->opt_id."' />
					<input type='hidden' class='contentToEdit' id='".$row->opt_id."' value=\"".prepFormInputStr($row->opt_name)."\" /></a></td>";
					$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->opt_id."' class='itemId' value='".$row->opt_id."' /></a></td>";
					$block .= "</tr>";
				}
				echo $block;
				?>
    		</table>
		<?php
		if($total_rows > $rows_per_page){			
			$uid1 = $attribute_id;
			echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/attributes/option.php", $sortby, $a_d, $uid1);
			echo "<br /><br />";
		}		
		?>

		</div>
<br /><br />
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this option?</h3>
	<form name="del_opt" action="option.php?attribute_id=<?php echo $attribute_id; ?>" method="post" target="_self">
		<input id="del_opt_id" class="itemId" type="hidden" name="del_opt_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_opt" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_opt" action="option.php?attribute_id=<?php echo $attribute_id;  ?>" method="post" target="_self">
			<input id="opt_id" type="hidden" class="itemId" name="opt_id" value='' />
			<fieldset class="colcontainer">
				<label>Edit Option</label>
				<input type="text" class="contentToEdit"  name="opt_name" value=''>
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_opt" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>
	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_opt" action="option.php?attribute_id=<?php echo $attribute_id; ?>" method="post" target="_self">
			<fieldset class="colcontainer">
				<label>Add New Option</label>
				<input type="text" class="contentToAdd"  name="added_opt">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_opt" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
</body>
</html>

