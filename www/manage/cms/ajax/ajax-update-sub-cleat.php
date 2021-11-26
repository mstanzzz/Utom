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
$_SESSION['ret_modal'] = '';
$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'cleats';

	$cleat_name = (isset($_POST['cleat_name']))? trim(addslashes($_POST['cleat_name'])) : 'no name';


	$descr_1 = (isset($_POST['descr_1']))? trim(addslashes($_POST['descr_1'])) : '';
	$descr_2 = (isset($_POST['descr_2']))? trim(addslashes($_POST['descr_2'])) : '';
	$description = $descr_1." ".$descr_2; 
	$collection_id = (isset($_POST['collection_id']))? $_POST['collection_id'] : 0;
	$part_type_id = (isset($_POST['part_type_id']))? $_POST['part_type_id'] : 0;
	$qty_calc_id = (isset($_POST['qty_calc_id']))? $_POST['qty_calc_id'] : 0;
	$qty_schema_id = (isset($_POST['qty_schema_id']))? $_POST['qty_schema_id'] : 0;
	$price_schema_id = (isset($_POST['price_schema_id']))? $_POST['price_schema_id'] : 0;
	
	$cleat_id = (isset($_POST['cleat_id']))? $_POST['cleat_id'] : 0;

	if(!is_numeric($collection_id)) $collection_id = 0;
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($price_schema_id)) $price_schema_id = 0;


//echo $cleat_name."     ---   ".$cleat_id;	
	
	$stmt = $db->prepare("UPDATE cabinetry_cleats
						SET cleat_name = ?
						,description = ?
						,collection_id = ?
						,part_type_id = ?						
						,qty_calc_id = ?
						,qty_schema_id = ?
						,price_schema_id = ?
						WHERE cleat_id = ?");
						
						//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('ssiiiiii'
						,$cleat_name
						,$description
						,$collection_id
						,$part_type_id						
						,$qty_calc_id
						,$qty_schema_id
						,$price_schema_id
						,$cleat_id)){
					
	}else{
		
		$stmt->execute();
			
		$stmt->close();	
		
		$sql = "DELETE FROM cabinetry_cleats_to_parts
				WHERE cleat_id = '".$cleat_id."'";	
		$result = $dbCustom->getResult($db,$sql);

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
		
		$msg = 'success';

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