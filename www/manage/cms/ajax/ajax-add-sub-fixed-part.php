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

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'fixed_parts';

	$part_name = (isset($_GET['part_name']))? trim(addslashes($_GET['part_name'])) : 'no name';	
	$width = (isset($_GET['width']))? trim(addslashes($_GET['width'])) : 0;
	$height = (isset($_GET['height']))? trim(addslashes($_GET['height'])) : 0;
	$depth = (isset($_GET['depth']))? trim(addslashes($_GET['depth'])) : 0;
	$width_offset = (isset($_GET['width_offset']))? trim(addslashes($_GET['width_offset'])) : 0;
	$height_offset = (isset($_GET['height_offset']))? trim(addslashes($_GET['height_offset'])) : 0;
	$depth_offset = (isset($_GET['depth_offset']))? trim(addslashes($_GET['depth_offset'])) : 0;

	$part_type_id = (isset($_GET['part_type_id']))? $_GET['part_type_id'] : 0;
	$material_id = (isset($_GET['material_id']))? $_GET['material_id'] : 0;
	$cat_id = (isset($_GET['cat_id']))? $_GET['cat_id'] : 0;
	$item_id = (isset($_GET['item_id']))? $_GET['item_id'] : 0;

	if(!is_numeric($part_type_id)) $part_type_id = 0;
	if(!is_numeric($material_id)) $material_id = 0;
	if(!is_numeric($cat_id)) $cat_id = 0;
	if(!is_numeric($item_id)) $item_id = 0;
	
	$part_category = 1;
	
	$stmt = $db->prepare("INSERT INTO parts
						(part_name						
						,width
						,height
						,depth
						,width_offset
						,height_offset
						,depth_offset
                        ,part_category
						,part_type_id
						,material_id
						,saas_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?)");	
						
						//print_r($stmt);						
						//echo 'Error: '.$db->error;						
	
	if(!$stmt->bind_param('sssssssiiii'
						,$part_name
						,$width
						,$height
						,$depth
						,$width_offset
						,$height_offset
						,$depth_offset
                        ,$part_category
						,$part_type_id
						,$material_id
						,$_SESSION['profile_account_id'])){	
			
				$stmt->debugDumpParams();
				echo $stmt->error;
								
			}else{
				$stmt->execute();
				$stmt->close();
				
				$part_id = $db->insert_id;
				$msg = "Item added";
			}






	$sql = "SELECT part_id
				,part_name
			FROM parts
			WHERE part_category='1'
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
			echo "<a onclick='ajax_set_paging_sub_fixed_part(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

?>
