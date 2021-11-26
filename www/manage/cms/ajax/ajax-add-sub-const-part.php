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

	$part_name = (isset($_GET['part_name']))? trim(addslashes($_GET['part_name'])) : '';
	$part_image = (isset($_GET['part_image']))? trim($_GET['part_image']) : '';
	$thumb_image = (isset($_GET['thumb_image']))? trim($_GET['thumb_image']) : '';
	$part_sku = (isset($_GET['part_sku']))? trim(addslashes($_GET['part_sku'])) : '';
	$part_number = (isset($_GET['part_number']))? trim(addslashes($_GET['part_number'])) : '';
	$part_weight = (isset($_GET['part_weight']))? trim(addslashes($_GET['part_weight'])) : 0;

	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;

	$material_id = (isset($_GET['material_id']))? $_GET['material_id'] : 0;
	$price_schema_id = (isset($_GET['price_schema_id']))? $_GET['price_schema_id'] : 0;
	$qty_calc_id   = (isset($_GET['qty_calc_id']))? $_GET['qty_calc_id'] : 0;
	$qty_schema_id   = (isset($_GET['qty_schema_id']))? $_GET['qty_schema_id'] : 0;
	$description = (isset($_GET['description']))? trim(addslashes($_GET['description'])) : '';
	$width = (isset($_GET['width']))? trim(addslashes($_GET['width'])) : '';
	$height = (isset($_GET['height']))? trim(addslashes($_GET['height'])) : '';
	$depth = (isset($_GET['depth']))? trim(addslashes($_GET['depth'])) : '';
	$width_offset = (isset($_GET['width_offset']))? trim(addslashes($_GET['width_offset'])) : '';
	$height_offset = (isset($_GET['height_offset']))? trim(addslashes($_GET['height_offset'])) : '';
	$depth_offset = (isset($_GET['depth_offset']))? trim(addslashes($_GET['depth_offset'])) : '';
	
	
	if(!is_numeric($part_weight)) $part_weight = 0;
	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($material_id)) $material_id = 0;
	if(!is_numeric($price_schema_id)) $price_schema_id = 0;
	if(!is_numeric($qty_calc_id)) $qty_calc_id = 0;
	if(!is_numeric($qty_schema_id)) $qty_schema_id = 0;
	

	$part_category = 0;
	
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'const_parts';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

		$stmt = $db->prepare("INSERT INTO parts
					(part_name
						,part_image
						,thumb_image
						,part_sku
						,part_number
						,part_weight
						,part_type_id
						,material_id
						,price_schema_id
						,qty_calc_id
						,qty_schema_id
						,description
						,width
						,height
						,depth
						,width_offset
						,height_offset
						,depth_offset
						,saas_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
						
						//print_r($stmt);						
				//echo 'Error '.$db->error;						
	
		if(!$stmt->bind_param('ssssssiiiiisssssssi'
					,$part_name
					,$part_image
					,$thumb_image
					,$part_sku
					,$part_number
					,$part_weight
					,$part_type_id
					,$material_id
					,$price_schema_id
					,$qty_calc_id
					,$qty_schema_id
					,$description
					,$width
					,$height
					,$depth
					,$width_offset
					,$height_offset
					,$depth_offset						
					,$_SESSION['profile_account_id'])){	
			
				echo $stmt->error;
								
			}else{
						
				$stmt->execute();
				//$stmt->debugDumpParams();
				$stmt->close();		
				$part_id = $db->insert_id;
			
				$msg = 'success';

			}








	
	$sql = "SELECT part_id
				,part_name
			FROM parts
			WHERE part_category='0'
			AND saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY part_name";
	$result = $dbCustom->getResult($db,$sql);

	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['part_id'] = $row->part_id;
		$long_array[$i]['part_name'] = $row->part_name; 
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
		$short_array[$i]['part_id'] = $long_array[$i]['part_id']; 
		$short_array[$i]['part_name'] = $long_array[$i]['part_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['part_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_constructed_part(".$val['part_id'].",1);'>Edit</button>";
		$block .= "<button class='text-red'onclick='delete_sub_constructed_part(".$val['part_id'].");'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_const_part(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

?>
