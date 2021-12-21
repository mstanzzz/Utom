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
$_SESSION['ret_modal'] = '';
if(!isset($_SESSION['constructed_part_array'])) $_SESSION['constructed_part_array'] = array();
if(!isset($_SESSION['fixed_part_array'])) $_SESSION['fixed_part_array'] = array();

require_once($real_root."/includes/config.php");

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);


	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'cleats';

	$cleat_name = (isset($_GET['cleat_name']))? trim(addslashes($_GET['cleat_name'])) : 'no name';

	$description = (isset($_GET['description']))? trim(addslashes($_GET['description'])) : '';
	
	$collection_id = (isset($_GET['collection_id']))? $_GET['collection_id'] : 0;
	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;
	$qty_calc_id = (isset($_GET['qty_calc_id']))? $_GET['qty_calc_id'] : 0;
	$qty_schema_id = (isset($_GET['qty_schema_id']))? $_GET['qty_schema_id'] : 0;
	$price_schema_id = (isset($_GET['price_schema_id']))? $_GET['price_schema_id'] : 0;

	if(!is_numeric($collection_id)) $collection_id = 0;
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($price_schema_id)) $price_schema_id = 0;
	
	$stmt = $db->prepare("INSERT INTO cabinetry_cleats
						(cleat_name
						,description
						,collection_id
						,part_type_id						
						,qty_schema_id
						,price_schema_id
						,qty_calc_id
						,saas_id)
						VALUES
						(?,?,?,?,?,?,?,?)");	
						
				//echo 'Error '.$db->error;						
	
	if(!$stmt->bind_param('ssiiiiii'
						,$cleat_name
						,$description
						,$collection_id
						,$part_type_id						
						,$qty_schema_id
						,$price_schema_id
						,$qty_calc_id
						,$_SESSION['profile_account_id'])){
			
			echo 'Error-2 '.$db->error;
					
	}else{		
		
		$stmt->execute();
		$stmt->close();	
		
		$cleat_id = $db->insert_id;
		
		$sql = "SELECT table_name_id 
				FROM table_names
				WHERE table_name = 'cabinetry_cleats'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 
					
			$sql = "INSERT INTO default_design_elements
				(table_name_id, design_element_id, saas_id, active)
				VALUES
				('".$object->table_name_id."', '".$cleat_id."', '".$_SESSION['profile_account_id']."', '1')";
			$res = $dbCustom->getResult($db,$sql);
									
		}
		
		foreach($_SESSION['constructed_part_array'] as $v){
			$sql = "INSERT INTO cabinetry_cleats_to_parts
					(part_id, part_qty, cleat_id, is_fixed_part, part_type_id)
					VALUES
					('".$v['part_id']."', '".$v['qty']."'  ,'".$cleat_id."', '0', '".$part_type_id."')";
			$result = $dbCustom->getResult($db,$sql);		
		}

		foreach($_SESSION['fixed_part_array'] as $v){
			$sql = "INSERT INTO cabinetry_cleats_to_parts
					(part_id, part_qty, cleat_id, is_fixed_part, part_type_id)
					VALUES
					('".$v['part_id']."', '".$v['qty']."'  ,'".$cleat_id."', '1', '".$part_type_id."')";
			$result = $dbCustom->getResult($db,$sql);		
		}
		
		$msg = 'added';

	}






	$sql = "SELECT cleat_id
				,cleat_name		
			FROM cabinetry_cleats
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY cleat_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['cleat_id'] = $row->cleat_id;
		$long_array[$i]['cleat_name'] = $row->cleat_name; 
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
	$i = $start;
	while($i < $end){			
		$short_array[$i]['cleat_id'] = $long_array[$i]['cleat_id']; 
		$short_array[$i]['cleat_name'] = $long_array[$i]['cleat_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['cleat_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_cleat(".$val['cleat_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_unit(".$val['cleat_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_cleat(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

?>