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
	$data_for = 'units';

	$unit_name = (isset($_GET['unit_name']))? trim(addslashes($_GET['unit_name'])) : 'no name';
	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;	
	$unit_image = (isset($_GET['unit_image']))? trim(addslashes($_GET['unit_image'])) : '';
	$unit_sku = (isset($_GET['unit_sku']))? trim(addslashes($_GET['unit_sku'])) : '';
	$unit_number = (isset($_GET['unit_number']))? trim(addslashes($_GET['unit_number'])) : '';	
	$price_schema_id = (isset($_GET['price_schema_id']))? $_GET['price_schema_id'] : 0;
	$unit_weight = (isset($_GET['unit_weight']))? $_GET['unit_weight'] : 0;
	$price_unit  = (isset($_GET['price_unit']))? round(trim($_GET['price_unit']),2) : 0;	
	$qty_unit   = (isset($_GET['qty_unit']))? round(trim($_GET['qty_unit']),0) : 0;
	$qty_schema_id   = (isset($_GET['qty_schema_id']))? $_GET['qty_schema_id'] : 0;
	$description = (isset($_GET['description']))? trim(addslashes($_GET['description'])) : '';
	$qtyCalcID   = (isset($_GET['qtyCalcID']))? $_GET['qtyCalcID'] : 0;
	$material_id   = (isset($_GET['material_id']))? $_GET['material_id'] : 0;
		
	$collection_ids = (isset($_GET['collection_ids']))? $_GET['collection_ids'] : array();
	
	$unit_id = (isset($_GET['unit_id']))? $_GET['unit_id'] : 0;

	if(!is_numeric($price_schema_id)) $price_schema_id = 0;
	if(!is_numeric($unit_weight)) $unit_weight = 0;
	if(!is_numeric($price_unit)) $qty_unit = 0;
	if(!is_numeric($qty_unit)) $qty_unit = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($qtyCalcID)) $qtyCalcID = 0;



/*
						echo "<br />unit_id:  ".$unit_id;
						echo "<br /><br />unit_name:  ".$unit_name;
						echo "<br />unit_image:  ".$unit_image;
						echo "<br />description:  ".$description;
						echo "<br />unit_sku:  ".$unit_sku;
						echo "<br />unit_number:  ".$unit_number;
						echo "<br />part_type_id:  ".$part_type_id;
						echo "<br />price_schema_id:  ".$price_schema_id;
						echo "<br />unit_weight:  ".$unit_weight;
						echo "<br />price_unit:  ".$price_unit;
						echo "<br />qty_unit:  ".$qty_unit;
						echo "<br />qty_schema_id:  ".$qty_schema_id;
						echo "<br />qtyCalcID:  ".$qtyCalcID;



	$stmt = $db->prepare("UPDATE cabinetry_units
						SET unit_name = ?
						WHERE unit_id = ?");
				
				echo "<br />";		
				echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('si'
						,$unit_name
						,$unit_id)){	
			
				$stmt->debugDumpParams();
				echo $stmt->error;
															
			}else{
				$stmt->execute();
				$stmt->close();
	
			}


*/


	$stmt = $db->prepare("UPDATE cabinetry_units
						SET unit_name = ?
						,unit_image = ?
						,description = ?
						,unit_sku = ?
						,unit_number = ?
						,part_type_id = ?
						,price_schema_id = ?
						,unit_weight = ?
						,price_unit = ?
						,qty_unit = ?
						,qty_schema_id = ?
						,qtyCalcID = ?
						,material_id = ?
						WHERE unit_id = ?");
				
				//echo "<br />";		
				//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('sssssiidiiiiii'
						,$unit_name
						,$unit_image
						,$description
						,$unit_sku
						,$unit_number
						,$part_type_id
						,$price_schema_id
						,$unit_weight
						,$price_unit
						,$qty_unit
						,$qty_schema_id
						,$qtyCalcID
						,$material_id
						,$unit_id)){	
			
				$stmt->debugDumpParams();
				echo $stmt->error;
															
			}else{
				$stmt->execute();
				$stmt->close();
	
				$sql = "DELETE FROM collection_units_assoc
						WHERE unit_id = '".$unit_id."'";	
				$result = $dbCustom->getResult($db,$sql);		
			
				foreach($collection_ids as $val){
					$sql = "INSERT INTO collection_units_assoc
							(collection_id, unit_id)
							VALUES
							('".$val."', '".$unit_id."')";		
					$result = $dbCustom->getResult($db,$sql);
				}
			
			
				$sql = "DELETE FROM cabinetry_units_to_cabinetry_components
						WHERE unit_id = '".$unit_id."'";	
				$result = $dbCustom->getResult($db,$sql);		
			
				foreach($_SESSION['component_array'] as $v){
											
					$sql = "INSERT INTO cabinetry_units_to_cabinetry_components
							(component_id, component_qty, unit_id)
							VALUES
							('".$v['component_id']."', '".$v['qty']."'  ,'".$unit_id."')";
					$result = $dbCustom->getResult($db,$sql);		
											
				}
			
				$msg = 'success';
			}


	









	$sql = "SELECT unit_id
			,unit_name		
		FROM cabinetry_units
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY unit_name";
	$result = $dbCustom->getResult($db,$sql);

	$long_array = array();
	$short_array = array();
	
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['unit_id'] = $row->unit_id;
		$long_array[$i]['unit_name'] = $row->unit_name; 
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
		$short_array[$i]['unit_id'] = $long_array[$i]['unit_id']; 
		$short_array[$i]['unit_name'] = $long_array[$i]['unit_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
    $block .= "<li>";
    $block .= "<span>".$val['unit_name']."</span>";
    $block .= "<div class='actions'>";
    $block .= "<button>Select</button>";
    $block .= "<button class='edit-collection-btn' onclick='open_sub_edit_unit(".$val['unit_id'].");'>Edit</button>";
	$block .= "<button class='text-red'onclick='delete_sub_unit(".$val['unit_id'].");'>Delete</button>";
    $block .= "</div>";				
    $block .= "</li>";
	}	
	$block .= "</ul>";			
	
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_unit(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

?>

