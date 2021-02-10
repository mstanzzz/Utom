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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

	if(!isset($_SESSION['qty_calc_params'])) $_SESSION['qty_calc_params'] = array();

	$qty_schema_name = (isset($_GET['qty_schema_name']))? trim($_GET['qty_schema_name']) : '';	
	$rounding_value = (isset($_GET['rounding_value']))? trim($_GET['rounding_value']) : 0;
	$schema_calc_method = (isset($_GET['schema_calc_method']))? $_GET['schema_calc_method'] :	0;
	$rounding_method = (isset($_GET['rounding_method']))? $_GET['rounding_method'] :	0;
		
	if(!is_numeric($rounding_value)) $rounding_value = 0.01;
	if(!is_numeric($schema_calc_method)) $schema_calc_method = 0;
	if(!is_numeric($rounding_method)) $rounding_method = 0;
	
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

	$page = 1;
	$data_for = 'qty_schemas';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$stmt = $db->prepare("INSERT INTO qty_schema
						(qty_schema_name
						,rounding_value
						,schema_calc_method
						,rounding_method
						,saas_id)
						VALUES
						(?,?,?,?,?)");	
			
						//echo 'Error main'.$db->error;
						//echo "<br />";						
	
	if(!$stmt->bind_param('sdiii'
						,$qty_schema_name
						,$rounding_value
						,$schema_calc_method
						,$rounding_method
						,$_SESSION['profile_account_id'])){
			
			echo 'Error-2 main'.$db->error;		
			echo "<br />";
						
	}else{
		
		$stmt->execute();
		$stmt->close();
		
		$qty_schema_id = $db->insert_id;	
		
		foreach($_SESSION['qty_calc_params'] as $v){
			$sql = "INSERT INTO qty_sch_param_assoc
					(qty_calc_param_id, sort_order, qty_schema_id)
					VALUES
					('".$v['qty_calc_param_id']."', '".$v['sort_order']."'  ,'".$qty_schema_id."')";
			$result = $dbCustom->getResult($db,$sql);		
		}
	}





	$sql = "SELECT qty_schema_id	
					,qty_schema_name		
			FROM qty_schema 
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY qty_schema_name";				
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	$long_array = array();
	while($row = $result->fetch_object()){		
		$long_array[$i]['qty_schema_id'] = $row->qty_schema_id;
		$long_array[$i]['qty_schema_name'] = $row->qty_schema_name;
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
		$short_array[$i]['qty_schema_id'] = $long_array[$i]['qty_schema_id']; 
		$short_array[$i]['qty_schema_name'] = $long_array[$i]['qty_schema_name']; 
		$i++;
	}


	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['qty_schema_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";				
		$block .= "<button class='edit-collection-btn' onclick='open_edit_sub_qty_schema(".$val['qty_schema_id'].");'>Edit</button>";	
		$block .= "<button class='text-red' onclick='delete_sub_qty_schema(".$val['qty_schema_id'].");'>Delete</button>";					
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
		echo "<a onclick='ajax_set_paging_sub_qs(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>
