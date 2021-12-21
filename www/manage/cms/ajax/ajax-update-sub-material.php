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

		$material_name=(isset($_GET['material_name']))? trim($_GET['material_name']) : '';	
		$product_num=(isset($_GET['product_num']))? trim($_GET['product_num']) :	'';
		$material_weight_unit=(isset($_GET['material_weight_unit']))? trim($_GET['material_weight_unit']) : 0;	
		$material_thickness=(isset($_GET['material_thickness']))? trim($_GET['material_thickness']) : 0;	
		$material_length=(isset($_GET['material_length']))? trim($_GET['material_length']) : 0;	
		$material_width=(isset($_GET['material_width']))? trim($_GET['material_width']) : 0;	
		$brand_id=(isset($_GET['brand_id']))? trim($_GET['brand_id']) : 0;	
		$vendor_id=(isset($_GET['vendor_id']))? trim($_GET['vendor_id']) : 0;	
		$core_id=(isset($_GET['core_id']))? trim($_GET['core_id']) : 0;	
		$type_id=(isset($_GET['type_id']))? trim($_GET['type_id']) : 0;	
		$finish_id=(isset($_GET['finish_id']))? trim($_GET['finish_id']) : 0;	
		$tier_id=(isset($_GET['tier_id']))? trim($_GET['tier_id']) : 0;	
		$hanging_bracket_cover_color_id=(isset($_GET['hanging_bracket_cover_color_id']))? trim($_GET['hanging_bracket_cover_color_id']) : 0;	
		$rail_cover_color_id=(isset($_GET['rail_cover_color_id']))? trim($_GET['rail_cover_color_id']) : 0;	
		$kd_fitting_color_id=(isset($_GET['kd_fitting_color_id']))? trim($_GET['kd_fitting_color_id']) : 0;	
		$qty_calc_id=(isset($_GET['qty_calc_id']))? trim($_GET['qty_calc_id']) : 0;	

		$texture_id=(isset($_GET['texture_id']))? $_GET['texture_id'] : 0;	

		$material_stocked=(isset($_GET['material_stocked']))? trim($_GET['material_stocked']) : 0;	
		$green_id=(isset($_GET['green_id']))? trim($_GET['green_id']) : 0;	
		
		$eb_ids = array();
		if(isset($_GET['col_parms'])) $eb_ids = explode("|",$_GET['col_parms']);

	$material_id = isset($_GET['material_id'])? $_GET['material_id'] : 0;
	
	$stain_id = 0;


	if(!is_numeric($material_width)) $material_width = 0;
	if(!is_numeric($material_weight_unit)) $material_weight_unit = 0;
	if(!is_numeric($material_length)) $material_length = 0;
	if(!is_numeric($material_thickness)) $material_thickness = 0;
	
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

	$page = 1;
	$data_for = 'materials';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	
$sql = "UPDATE materials	
		SET material_name = '".$material_name."'
		WHERE material_id = '".$material_id."'";	
//$result = $dbCustom->getResult($db,$sql);


	$stmt = $db->prepare("UPDATE materials
						SET material_name = ?
						,product_num = ?
						,material_weight_unit = ?
						,material_width = ?
						,material_length = ?
						,material_thickness = ?
						,green_id = ?
						,brand_id = ?
						,vendor_id = ?
						,core_id = ?
						,type_id = ?
						,finish_id = ?
						,texture_id = ?
						,tier_id = ?
						,hanging_bracket_cover_color_id = ?
						,rail_cover_color_id = ?
						,kd_fitting_color_id = ?
						,qty_calc_id = ?
						,material_stocked = ?
						,stain_id = ?
						WHERE material_id = ?");
						
						//echo 'Error '.$db->error;	
													
		if(!$stmt->bind_param('ssddddiiiiiiiiiiiiiii'
						,$material_name
						,$product_num
						,$material_weight_unit
						,$material_width
						,$material_length
						,$material_thickness						
						,$green_id
						,$brand_id
						,$vendor_id
						,$core_id
						,$type_id
						,$finish_id
						,$texture_id
						,$tier_id
						,$hanging_bracket_cover_color_id
						,$rail_cover_color_id
						,$kd_fitting_color_id
						,$qty_calc_id
						,$material_stocked
						,$stain_id
						,$material_id)){
			
			echo 'Error-2 '.$db->error;					
	}else{
		
		$stmt->execute();
		$stmt->close();		
		
		$sql = "DELETE FROM edge_banding_material_assoc
				WHERE material_id = '".$material_id."'"; 	
		$result = $dbCustom->getResult($db,$sql);
	
		foreach($eb_ids as $v){
			if(is_numeric($v)){						
				$sql = "INSERT INTO edge_banding_material_assoc
						(material_id, banding_id)
						VALUES
						('".$material_id."','".$v."')";
				$result = $dbCustom->getResult($db,$sql);
			}
		}
	}
	
	
	
	
	
	$sql = "SELECT material_id	
				,material_name		
			FROM materials
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY material_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['material_id'] = $row->material_id;
		$long_array[$i]['material_name'] = $row->material_name; 
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
		$short_array[$i]['material_id'] = $long_array[$i]['material_id']; 
		$short_array[$i]['material_name'] = $long_array[$i]['material_name']; 
		$i++;
	}
	
	$block = '';
	$block .= "<ul id='sub_materials_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['material_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_material(".$val['material_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_material(".$val['material_id'].");'>Delete</button>";	
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
		echo "<a onclick='ajax_set_paging_sub_material(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>
