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

//ini_set("memory_limit","256M");

$subject_cat_id = (isset($_GET['subject_cat_id']))? $_GET['subject_cat_id'] : 0; 

$db = $dbCustom->getDbConnect(CART_DATABASE);	
	// Build an array of the top categories from DB
	$top_cats = array();
	$sql = "SELECT cat_id, name, img_id, show_on_home_page 
			FROM category 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
	$result = $dbCustom->getResult($db,$sql);			
	$i = 0;
	while($row = $result->fetch_object()) {
		$sql = "SELECT child_cat_to_parent_cat_id 
				FROM child_cat_to_parent_cat
				WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
		
		$res = $dbCustom->getResult($db,$sql);
		if(!$res->num_rows > 0){
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
		
	}





$block = '';
foreach ($top_cats as $top_cat) {
	
	$max_depth = 5;
	
		$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
		$block .= "<a tabindex='-1' class='tree-parent' onclick='show_children(".$top_cat['cat_id'].")'  data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>
		<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."' />".stripAllSlashes($top_cat['name'])."</a>";
		
		$checked = ($top_cat['cat_id'] == $_SESSION['temp_cat']['cat_id'])  ? "checked='checked'" : '';
		
		$block .= "<input class='checkbox' onclick='updateOptions(\"".$top_cat['cat_id']."\")' type='radio' id='".$top_cat['cat_id']."' name='cat_id' value='".$top_cat['cat_id']."' ".$checked." />
		<input type='hidden' value='".$top_cat['name']."' name='categoryname' class='categoryname' />";
		$block .= "<ul role='group' class='childrenplaceholder'>".getChildren($top_cat['cat_id'], $domain, $subject_cat_id, $max_depth)."</ul></li>";
}
echo $block;

//echo $cat_id;

function getChildren($cat_id, $domain, $subject_cat_id, $max_depth){

	$max_depth--;

	$block = '';

	if($max_depth > 0){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page  
				FROM category, child_cat_to_parent_cat  
				WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
				AND child_cat_to_parent_cat.parent_cat_id = '".$cat_id."'
				ORDER BY category.name";
		$result = $dbCustom->getResult($db,$sql);			
	
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
	
			$block .= "<li role='treeitem' aria-expanded='true' id='".$row->cat_id."'>";
			$block .= "<a tabindex='-1' class='tree-parent' onclick='show_children(".$row->cat_id.")' >";
			
			$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/list/".$file_name."'/>".stripAllSlashes($row->name)."</a>";
			$checked = ($row->cat_id == $_SESSION['temp_cat']['cat_id'])  ? "checked='checked'" : '';
			$block .= "<input class='checkbox' onclick='updateOptions(\"".$row->cat_id."\")' type='radio' id='".$row->cat_id."' name='cat_id' value='".$row->cat_id."' ".$checked." />
			<input type='hidden' value='".$row->name."' name='categoryname' class='categoryname' />";
			$block .= "<ul role='group' class='childrenplaceholder'>";
			$block .= getChildren($row->cat_id, $domain, $subject_cat_id, $max_depth);
			$block .= "</ul></li>";
		}	
	}


	return $block;
	
}







?>