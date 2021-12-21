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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

function get_file_name($dbCustom,$img_id){
		
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT file_name
			FROM image
			WHERE img_id = '".$img_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		
			//echo $object->file_name;
	
			//exit;
		
		return  $object->file_name;
	}
	return  '';
}


function get_is_assign($item_id, $cat_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT item_to_cat_id
			FROM item_to_category
			WHERE item_id = '".$item_id."'
			AND cat_id = '".$cat_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		return  1;
	}
	return  0;
}

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$sortby = (isset($_GET['sortby'])) ? trim(addslashes($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? addslashes($_GET['a_d']) : 'a';
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : ''; 
$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	$sql = "DELETE FROM item_to_category WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	
	foreach($actives as $item_id){
		$sql = "INSERT INTO item_to_category 
				(item_id, cat_id)
				VALUES
				('".$item_id."','".$cat_id."')";				
		$res = $dbCustom->getResult($db,$sql);
	}
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function(){
	

});

function regularSubmit() {
  document.form1.submit(); 
}	

</script>
</head>
<body>
<div class="manage_page_container">
	<a class="btn btn-primary btn-large" 
	href="top-category.php?cat_id=<?php echo $cat_id; ?>" > BACK to Category List </a>
	<a class="btn btn-primary btn-large" 
	href="../products/item.php?cat_id=<?php echo $cat_id; ?>" > BACK to Product List </a>
	<?php 
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name, item_id, img_id
			FROM item 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$nmx_res = $dbCustom->getResult($db,$sql);
	$total_rows = $nmx_res->num_rows;
	$rows_per_page = 300;
	$last = ceil($total_rows/$rows_per_page); 
	if($last == 0) $last = 1;
	if ($pagenum > $last){ 
		$pagenum = $last; 
	}
	if ($pagenum < 1){ 
		$pagenum = 1; 
	}
	$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
	$sql .= " ORDER BY item.item_id".$limit;
	$result = $dbCustom->getResult($db,$sql);		
	?>
	<div class="page_actions">
		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
	</div>
	<?php
	$url_str= 'select-item-to-cat.php';
	$url_str.= "?cat_id=".$cat_id;
	$url_str.= "&pagenum=".$pagenum;
	$url_str.= "&sortby=".$sortby;
	$url_str.= "&a_d=".$a_d;
	$url_str.= "&truncate=".$truncate;
	$url_str.= "&search_str=".$search_str;
	?>
	<form name="form1" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="set_active" value="1">
	<div class="pagination">
	<?php
	if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "select-item-to-cat.php", $sortby, $a_d,0,0, $search_str, $cat_id, $parent_cat_id);
	}
	?>
	</div>
	<table cellpadding="10" cellspacing="0" style="width:100%;">
	<tr>
	<td width="7%">Image</td>
	<td>SELECT</td>	
	<td width="80%">
	Name
	</td>
	</tr>
	<?php 
	$items_from_this_page = '';
	$block = '';
	while($row = $result->fetch_object()) {
		$items_from_this_page .= $row->item_id.",";	
		$block .= "<tr>";
		$file_name = get_file_name($dbCustom,$row->img_id);
		$t_img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name;
		$block .= "<td>";
		$block .= "<img style='width:40px; height:40px;' src='".$t_img."'>";
		$block .= "</td>";		
		
		$checked = (get_is_assign($row->item_id, $cat_id))? "checked='checked'" : ''; 
		$block	.= "<td align='center' valign='middle' >
					<div class='checkboxtoggle on '> 
					<span class='ontext'>ON</span>
					<a class='switch on' href='#'></a>
					<span class='offtext'>OFF</span>
					<input type='checkbox' class='checkboxinput' name='active[]' 
					value='".$row->item_id."' ".$checked." /></div>";
		$block .= "</td>";	
		
		$block .= "<td>".stripSlashes($row->name)."</td>";							
		$block .= "</tr>";	
	}
	echo  $block;
	?>
	</table>
	<?php
	if($total_rows > $rows_per_page){
	echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "select-item-to-cat.php", $sortby, $a_d,0,0, $search_str, $cat_id, $parent_cat_id);
	}
	?>
	<input type="hidden" name="items_from_this_page" value="<?php echo $items_from_this_page; ?>">                 
	</form>

</div>
</body>
</html>
