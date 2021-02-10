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
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

$_SESSION['ret_modal'] = '';

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$component_id = (isset($_GET['component_id']))? $_GET['component_id'] : 0;
	
	$component_name = (isset($_GET['component_name']))? trim(addslashes($_GET['component_name'])) : 'no name';
	$component_image = (isset($_GET['component_image']))? trim(addslashes($_GET['component_image'])) : 0;
	$component_sku = (isset($_GET['component_sku']))? trim(addslashes($_GET['component_sku'])) : '';
	$component_number = (isset($_GET['component_number']))? trim(addslashes($_GET['component_number'])) : '';
	$description = (isset($_GET['description']))? trim(addslashes($_GET['description'])) : '';	
	$component_weight = (isset($_GET['component_weight']))? $_GET['component_weight'] : 0;
	$price_unit = (isset($_GET['price_unit']))? $_GET['price_unit'] : 0;
	$system_hole_occupancy = (isset($_GET['system_hole_occupancy']))? $_GET['system_hole_occupancy'] : 0;
	$system_hole_increment = (isset($_GET['system_hole_increment']))? $_GET['system_hole_increment'] : 0;
	$system_hole_offset = (isset($_GET['system_hole_offset']))? $_GET['system_hole_offset'] : 0;
	$system_hole_padding_top = (isset($_GET['system_hole_padding_top']))? $_GET['system_hole_padding_top'] : 0;
	$allow_custom_width = (isset($_GET['allow_custom_width']))? $_GET['allow_custom_width'] : 1;
	$qty_unit = (isset($_GET['qty_unit']))? $_GET['qty_unit'] : 1;
	$qty_calc_id = (isset($_GET['qty_calc_id']))? $_GET['qty_calc_id'] : 0;
	$price_schema_id  = (isset($_GET['price_schema_id']))? $_GET['price_schema_id'] : 0;	
	$qty_calc_id   = (isset($_GET['qty_calc_id']))? $_GET['qty_calc_id'] : 0;
	$width_constraints_id   = (isset($_GET['width_constraints_id']))? $_GET['width_constraints_id'] : 0;
	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;
	$qty_schema_id = (isset($_GET['qty_schema_id']))? $_GET['qty_schema_id'] : 0;

	if(!is_numeric($component_weight)) $component_weight = 0;
	if(!is_numeric($price_unit)) $price_unit = 0;
	if(!is_numeric($system_hole_occupancy)) $system_hole_occupancy = 0;
	if(!is_numeric($system_hole_increment)) $system_hole_increment = 0;
	if(!is_numeric($system_hole_offset)) $system_hole_offset = 0;
	if(!is_numeric($system_hole_padding_top)) $system_hole_padding_top = 0;
	if(!is_numeric($allow_custom_width)) $allow_custom_width = 0;
	if(!is_numeric($qty_unit)) $qty_unit = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($price_schema_id)) $price_schema_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($width_constraints_id)) $width_constraints_id = 0;
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	
	$collection_ids = (isset($_GET['collection_ids']))? $_GET['collection_ids'] : array();

	$stmt = $db->prepare("UPDATE cabinetry_components
						SET component_name = ?
							,component_image = ?
							,component_sku = ?
							,component_number = ?
							,description = ?
							,component_weight = ?
							,price_unit = ?
							,system_hole_occupancy = ?
							,system_hole_increment = ?
							,system_hole_offset = ?
							,system_hole_padding_top = ?
							,allow_custom_width = ?
							,qty_unit = ?
							,material_id = ?
							,price_schema_id = ?
							,qty_schema_id = ?
							,qty_calc_id = ?
							,width_constraints_id = ?
							,part_type_id = ?
					WHERE component_id = ?");
						
						//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('sssssddiiiiiiiiiiiii'
						,$component_name
                        ,$component_image
                        ,$component_sku
                        ,$component_number
                        ,$description
                        ,$component_weight
                        ,$price_unit
                        ,$system_hole_occupancy
                        ,$system_hole_increment
                        ,$system_hole_offset
                        ,$system_hole_padding_top
                        ,$allow_custom_width
						,$qty_unit
                        ,$material_id
                        ,$price_schema_id
                        ,$qty_schema_id
                        ,$qty_calc_id
                        ,$width_constraints_id
                        ,$part_type_id																	
						,$component_id)){	
			
				$stmt->debugDumpParams();
				echo $stmt->error;
															
			}else{
				$stmt->execute();
				$stmt->close();
	
				$sql = "DELETE FROM collection_components_assoc
						WHERE component_id = '".$component_id."'";	
				$result = $dbCustom->getResult($db,$sql);		
			
				foreach($collection_ids as $val){
					
					$sql = "INSERT INTO collection_components_assoc
							(collection_id, component_id)
							VALUES
							('".$val."', '".$component_id."')";		
					$result = $dbCustom->getResult($db,$sql);
				}
				
			
				$sql = "DELETE FROM  cabinetry_components_to_parts
						WHERE component_id = '".$component_id."'";	
				$result = $dbCustom->getResult($db,$sql);		
			
			
				foreach($_SESSION['constructed_part_array'] as $v){
											
					$sql = "INSERT INTO cabinetry_components_to_parts
							(part_id, part_qty, component_id, is_fixed_part, part_type_id)
							VALUES
							('".$v['part_id']."', '".$v['qty']."'  ,'".$component_id."', '0', '".$part_type_id."')";
					$result = $dbCustom->getResult($db,$sql);		
				}
	
	
				foreach($_SESSION['fixed_part_array'] as $v){
					
					$sql = "INSERT INTO cabinetry_components_to_parts
							(part_id, part_qty, component_id, is_fixed_part, part_type_id)
							VALUES
							('".$v['part_id']."', '".$v['qty']."'  ,'".$component_id."', '1', '".$part_type_id."')";
					$result = $dbCustom->getResult($db,$sql);	
				}

			
				$msg = 'success';
			
			}
	
			$_SESSION['constructed_part_array'] = array();
			$_SESSION['fixed_part_array'] = array();
	
	
	
	
	
	
	
	
	$sql = "SELECT component_id
				,component_name
			FROM cabinetry_components
			WHERE saas_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['component_id'] = $row->component_id;
		$long_array[$i]['component_name'] = $row->component_name; 
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
		$short_array[$i]['component_id'] = $long_array[$i]['component_id']; 
		$short_array[$i]['component_name'] = $long_array[$i]['component_name']; 
		$i++;
	}
	
	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['component_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_component(".$val['component_id'].");'>Edit</button>";
		$block .= "<button class='text-red'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			

	echo $block;


if($total_rows > 0){
?>
<div class='table-footer pagination with-bottom-shadow'>
	<?php
	for($i=1; $i<=$last; $i++){
		$active = ($i == $page)? 'active': '';
		echo "<a onclick='ajax_set_paging_sub_component(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>
