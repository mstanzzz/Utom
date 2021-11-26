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

require_once($real_root."/includes/config.php");

$material_type_id = isset($_GET['material_type_id'])? $_GET['material_type_id'] : 0;
$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 0;
$page = 1;
$data_for = 'material_types';

if(is_numeric($material_type_id)){
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql =  sprintf("DELETE 
					FROM material_types
					WHERE material_type_id = '%u'", $material_type_id);
	$result = $dbCustom->getResult($db,$sql);
}



$sql = "SELECT material_type_id	
				,material_type_name		
		FROM material_types
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY material_type_name";
$result = $dbCustom->getResult($db,$sql);
$long_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$long_array[$i]['material_type_id'] = $row->material_type_id;
	$long_array[$i]['material_type_name'] = $row->material_type_name; 
	$i++;
}

$total_rows = count($long_array);
$last = ceil($total_rows/$rows_per_page); 
if($last == 0) $last = 1;
$start = ($page - 1) * $rows_per_page;
$end = $start + $rows_per_page;
if($end > $total_rows){
	$end = $total_rows-1;
}
$short_array = array();
$i = $start;
while($i < $end){
	if(isset($long_array[$i]['material_type_id'])){			
		$short_array[$i]['material_type_id'] = $long_array[$i]['material_type_id']; 
		$short_array[$i]['material_type_name'] = $long_array[$i]['material_type_name']; 
		$i++;
	}
}




$block = '';
$block .= "<ul id='sub_material_types_list'>";
foreach($short_array as $val){
	$block .= "<li>";
	$block .= "<span id='sub_material_type_name_".$val['material_type_id']."'>".$val['material_type_name']."</span>";
	$block .= "<div class='actions'>";
	$block .= "<button>Select</button>";
	$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_material_type(".$val['material_type_id'].");'>Edit</button>";
	$block .= "<button class='text-red' onclick='delete_modify_material_type(".$val['material_type_id'].");'>Delete</button>";					
	$block .= "</div>";
	$block .= "</li>";
}
$block .= "</ul>";
echo $block;




if($total_rows > 0){
	
	echo "<div class='table-footer pagination with-bottom-shadow'>";
	for($i=1; $i<=$last; $i++){
		$active = ($i == $page)? 'active': '';	
		echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	echo "</div>";
}



?>