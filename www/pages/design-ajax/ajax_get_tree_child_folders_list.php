<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										


function getTreeItems($level_id, $dbCustom){

	$ret ='';
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
				
	$sql = "SELECT *			
			FROM design_folders
			WHERE parent_id = '".$level_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		
		$ret .= '<ul>'; 
				
		while($row = $result->fetch_object()){
			
			$ret .= "<li>".$row->level_name."</li>";
		}
		
		$ret .= '</ul>';	
	}
	
	return $ret;
}


$level_id = (isset($_GET['level_id'])) ? $_GET['level_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
			
$sql = "SELECT *			
		FROM design_folders
		WHERE parent_id = '".$level_id."'";

$result = $dbCustom->getResult($db,$sql);	

$block = '';

$block .= "<ul role='tree' class='tree'>";

while($row = $result->fetch_object()) {

	$folder_name = stripslashes($row->level_name);

	$block .= "<li role='treeitem' aria-expanded='false' id='".$row->level_id."'>";
	
	$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed'onclick='show_children(".$row->level_id."); show_folder_options(".$row->level_id.",\"".$folder_name."\");' 
	data-imageurl='' data-level-id='".$row->level_id."'>".$row->level_name."</a>";	
	//subcategory name
	$block .= "<ul role='group' class='childrenplaceholder'></ul>";
	
	$block .= getTreeItems($row->level_id, $dbCustom);
	
	$block .= "</li>";

}

$block .= "</ul>";

echo $block;

?>