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

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$subject_cat_id = (isset($_GET["subject_cat_id"])) ? $_GET["subject_cat_id"] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);			
$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page  
		FROM category, child_cat_to_parent_cat  
		WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
		AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'";
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
	
	/*
	$cat_path_array = getCatPath($row->cat_id);
	$cat_tooltip = '';
	$i = 0;
	$last_index = sizeof($cat_path_array);
	foreach($cat_path_array as $cat_name){
		$cat_tooltip .= $cat_name;
		$i++;
		if($i < $last_index){
			$cat_tooltip .= " -> ";
		}
	}
	*/
	
	$block .= "<li title='' role='treeitem' aria-expanded='false' id='".$row->cat_id."'>";
	$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' onclick='show_children(".$row->cat_id.")' >";
	$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name."'/>".$row->name;
	
	$checked = ($row->cat_id == $_SESSION['temp_cat']['cat_id'])  ? "checked='checked'" : '';

	$block .= "<input class='checkbox' onclick='updateOptions(\"".$row->cat_id."\")' type='radio' id='".$row->cat_id."' name='cat_id' value='".$row->cat_id."' ".$checked." />
	<input type='hidden' value='".$row->name."' name='categoryname' class='categoryname' /></a>";
	$block .= "<ul role='group' class='childrenplaceholder'></ul></li>";
}

echo $block;
//echo $result->num_rows;
//echo $cat_id;

?>