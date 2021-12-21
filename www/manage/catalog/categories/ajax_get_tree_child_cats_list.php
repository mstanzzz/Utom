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


function getTreItems($cat_id, $dbCustom){

	$ret ='';
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);			
	$sql = "SELECT item.item_id, item.name  
			FROM item_to_category, item  
			WHERE item_to_category.item_id = item.item_id 
			AND item_to_category.cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	

	if($result->num_rows > 0){
		$ret .= '<ul>'; 
		while($row = $result->fetch_object()){
			$ret .= "<li><a href='".SITEROOT."/manage/catalog/products/edit-item.php?item_id=".$row->item_id."&ret_page=category-tree&firstload=1' >Item: ".$row->item_id.'   '.$row->name."</a></li>";
		}
		$ret .= '</ul>';	
	}
	return $ret;
}


?>

<script>
function callConfirmDelete(the_id){
	$("#content-delete .itemId").val(the_id);
	$("#content-delete").hide().fadeIn("fast");
}
</script>

<?php

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);			
$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page  
		FROM category, child_cat_to_parent_cat  
		WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
		AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
		ORDER BY category.name";
$result = $dbCustom->getResult($db,$sql);	

$block = '';
while($row = $result->fetch_object()) {

	$sql = "SELECT file_name 
	FROM image
	WHERE img_id = '".$row->img_id."'";
	$img_res = $dbCustom->getResult($db,$sql);
	if($img_res->num_rows > 0){
		$img_obj = $img_res->fetch_object();
		$file_name = $img_obj->file_name;
	}else{
		$file_name = '';
	}


	$block .= "<li role='treeitem' aria-expanded='false' id='".$row->cat_id."'>";
	
	//$file_name = "0a47a636ef1e329facee41fab092d912.jpg";
	
	//$block .= $file_name;
	
$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' onclick='show_children(".$row->cat_id.")' 
data-imageurl='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name."' data-catid='".$row->cat_id."'>".$row->name."</a>";	

	$block .= "<ul role='group' class='childrenplaceholder'></ul>";
	$block .= getTreItems($row->cat_id, $dbCustom);
	$block .= "</li>";
	

}

echo $block;

//echo $cat_id;

?>