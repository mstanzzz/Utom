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

$page = 1;
$data_for = 'qty_schemas';
	
$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	
$qty_schema_id = isset($_GET['qty_schema_id'])? $_GET['qty_schema_id'] : 0;
	
$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql =  sprintf("DELETE FROM qty_schema
				WHERE qty_schema_id = '%u'", $qty_schema_id);
$result = $dbCustom->getResult($db,$sql);
	







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
