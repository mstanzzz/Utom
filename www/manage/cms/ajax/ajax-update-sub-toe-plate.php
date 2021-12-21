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
	$data_for = 'toe_plates';
	
	
	$toe_plate_id = (isset($_GET['toe_plate_id']))? $_GET['toe_plate_id'] : 0;
	

	$toe_plate_name = (isset($_GET['toe_plate_name']))? trim(addslashes($_GET['toe_plate_name'])) : 'no name';
	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;
	$qty_schema_id = (isset($_GET['qty_schema_id']))? $_GET['qty_schema_id'] : 0;
	$qty_calc_id = (isset($_GET['qty_calc_id']))? $_GET['qty_calc_id'] : 0;
	$price_schema_id = (isset($_GET['price_schema_id']))? $_GET['price_schema_id'] : 0;
	$allow_custom_width = (isset($_GET['allow_custom_width']))? $_GET['allow_custom_width'] : 0;
	$system_hole_occupancy = (isset($_GET['system_hole_occupancy']))? $_GET['system_hole_occupancy'] : 0;
	$system_hole_increment = (isset($_GET['system_hole_increment']))? $_GET['system_hole_increment'] : 0;
	$collection_id = (isset($_GET['collection_id']))? $_GET['collection_id'] : 0;
	
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($price_schema_id)) $price_schema_id = 0;
	if(!is_numeric($allow_custom_width)) $allow_custom_width = 0;
	if(!is_numeric($system_hole_occupancy)) $system_hole_occupancy = 0;
	if(!is_numeric($system_hole_increment)) $system_hole_increment = 0;
	if(!is_numeric($collection_id)) $collection_id = 0;
	
	$stmt = $db->prepare("UPDATE cabinetry_toe_plates
						SET toe_plate_name = ?
						,collection_id = ?
						,qty_schema_id = ?
						,qty_calc_id = ?
						,price_schema_id = ?
						,part_type_id = ?
						,system_hole_occupancy = ?
						,system_hole_increment = ?
						,allow_custom_width = ?
						WHERE toe_plate_id = ?");
						
						//echo 'Error '.$db->error;	 
													
	if(!$stmt->bind_param('siiiiiiiii'
						,$toe_plate_name
						,$collection_id
						,$qty_schema_id						
						,$qty_calc_id
						,$price_schema_id
						,$part_type_id
						,$system_hole_occupancy
						,$system_hole_increment
						,$allow_custom_width
						,$toe_plate_id)){	
			
				echo $stmt->error;
								
			}else{
						
				
				$stmt->execute();
				$stmt->close();		
				
				$sql = "DELETE FROM cabinetry_toe_plates_to_parts
						WHERE toe_plate_id = '".$toe_plate_id."'";	
				$result = $dbCustom->getResult($db,$sql);		
			
				foreach($_SESSION['constructed_part_array'] as $v){
					$sql = "INSERT INTO cabinetry_toe_plates_to_parts
							(part_id, part_qty, toe_plate_id, is_fixed_part, part_type_id)
							VALUES
							('".$v['part_id']."', '".$v['qty']."'  ,'".$toe_plate_id."', '0', '".$part_type_id."')";
					$result = $dbCustom->getResult($db,$sql);		
				}
		
				foreach($_SESSION['fixed_part_array'] as $v){
					$sql = "INSERT INTO cabinetry_toe_plates_to_parts
							(part_id, part_qty, toe_plate_id, is_fixed_part, part_type_id)
							VALUES
							('".$v['part_id']."', '".$v['qty']."'  ,'".$toe_plate_id."', '1', '".$part_type_id."')";
					$result = $dbCustom->getResult($db,$sql);		
				}
			
				$msg = 'success';
	
			}
	

	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
			
			
			
			
			
			
			
	$sql = "SELECT toe_plate_id
			,toe_plate_name		
		FROM cabinetry_toe_plates
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY toe_plate_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['toe_plate_id'] = $row->toe_plate_id;
		$long_array[$i]['toe_plate_name'] = $row->toe_plate_name; 
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
		$short_array[$i]['toe_plate_id'] = $long_array[$i]['toe_plate_id']; 
		$short_array[$i]['toe_plate_name'] = $long_array[$i]['toe_plate_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['toe_plate_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_toe_plate(".$val['toe_plate_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_toe_plate(".$val['toe_plate_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_toe_plate(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}


?>			
			
			
			
			
			
			
