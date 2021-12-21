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
$item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0;
$db = $dbCustom->getDbConnect(CART_DATABASE);	
$top_cats = array();
$sql = "SELECT cat_id, name, img_id, show_on_home_page 
		FROM category 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);			
$i = 0;
while($row = $result->fetch_object()) {
	$top_cats[$i]['cat_id'] = $row->cat_id;
	$top_cats[$i]['name'] = $row->name;
	$top_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
	$sql = "SELECT file_name 
	FROM image
	WHERE img_id = '".$row->img_id."'";
	$img_res = $dbCustom->getResult($db,$sql);
	if($img_res->num_rows > 0){
		$img_obj = $img_res->fetch_object();
		$top_cats[$i]['file_name'] = $img_obj->file_name;
	}else{
		$top_cats[$i]['file_name'] = '';					
	}
	$i++;
}
$block = '';
foreach ($top_cats as $top_cat) {
	$max_depth = 16;
	$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
	$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' onclick='show_children(".$top_cat['cat_id'].")'  data-catid='".$top_cat['cat_id']."' data-cattype='topcat'><img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."' />".stripslashes($top_cat['name']).'';
	
	$checked = inArray($top_cat['cat_id'], $_SESSION['temp_item_cats'], 'cat_id') ? "checked='checked'" : '';
	
	$block .= "<input class='checkbox' onclick='updateOptions(".$top_cat['cat_id'].")' type='checkbox' id='".$top_cat['cat_id']."' value='".$top_cat['cat_id']."' ".$checked." /><input type='hidden' value='".$top_cat['name']."' name='categoryname' class='categoryname' /></a>";
	$block .= "<ul role='group' class='childrenplaceholder'>".getChildren($top_cat['cat_id'], SITEROOT, $item_id, $max_depth)."</ul></li>"; 
}
echo $block;

function getChildren($cat_id, SITEROOT, $item_id, $max_depth){
	$max_depth--;
	
	$dbCustom = new DbCustom();
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
		$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' onclick='show_children(".$row->cat_id.")' >";
		$block .= "<img  src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$file_name."'/>".stripslashes($row->name);
		$checked = inArray($row->cat_id, $_SESSION['temp_item_cats'], "cat_id") ? "checked='checked'" : '';
		$block .= "<input class='checkbox' onclick='updateOptions(".$row->cat_id.")' type='checkbox' id='".$row->cat_id."' value='".$row->cat_id."' ".$checked." />
		<input type='hidden' value='".$row->name."' name='categoryname' class='categoryname' /></a>"	;
		$block .= "<ul role='group' class='childrenplaceholder'>".getChildren($row->cat_id, SITEROOT, $item_id, $max_depth)."</ul></li>";
	}	
	return $block;
}
?>