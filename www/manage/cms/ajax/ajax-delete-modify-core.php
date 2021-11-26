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

	$core_id = isset($_GET['core_id'])? $_GET['core_id'] : 0;
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	if(!is_numeric($rows_per_page)) $rows_per_page = 8;
	
	$page = 1;
	$data_for = 'cores';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);	
	$sql =  sprintf("DELETE FROM core
					WHERE core_id = %u", $core_id);
	$result = $dbCustom->getResult($db,$sql);

	$sql = "SELECT core_id	
				,core_name		
			FROM core
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY core_name";
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['core_id'] = $row->core_id;
		$long_array[$i]['core_name'] = $row->core_name; 
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
	$short_array = array();		
	$i = $start;
	while($i < $end){
		if(isset($long_array[$i]['core_id'])){			
			$short_array[$i]['core_id'] = $long_array[$i]['core_id']; 
			$short_array[$i]['core_name'] = $long_array[$i]['core_name']; 
			$i++;
		}
	}




$block = '';
$block .= "<ul id='sub_cores_list'>";
foreach($short_array as $val){
	$block .= "<li>";
					$block .= "<span id='sub_core_name_".$val['core_id']."'>".$val['core_name']."</span>";
					$block .= "<div class='actions'>";
					$block .= "<button>Select</button>";
					$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_core(".$val['core_id'].",\"".$val['core_name']."\");'>Edit</button>";
					$block .= "<button class='text-red' onclick='delete_modify_core(".$val['core_id'].");'>Delete</button>";					
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
		echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>
