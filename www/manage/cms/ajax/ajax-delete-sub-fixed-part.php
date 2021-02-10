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

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'fixed_parts';


	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$part_id = isset($_GET['part_id'])? $_GET['part_id'] : 0;
	
	$sql =  sprintf("DELETE FROM parts
					WHERE part_id = %u", $part_id);
	$result = $dbCustom->getResult($db,$sql);







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
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_fixed_part(".$val['part_id'].",1);'>Edit</button>";
		$block .= "<button class='text-red'onclick='delete_sub_fixed_part(".$val['part_id'].");'>Delete</button>";
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
