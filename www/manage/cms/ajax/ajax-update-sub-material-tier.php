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

	$tier_id = isset($_GET['tier_id'])? $_GET['tier_id'] : 0;
	$tier_name = isset($_GET['tier_name'])? addslashes($_GET['tier_name']) : '';
	
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

	$page = 1;
	$data_for = 'mat_tiers';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$stmt = $db->prepare("UPDATE material_tiers
						SET tier_name = ?
						WHERE tier_id = ?"); 
			//print_r($stmt);										
		//echo 'Error1 '.$db->error;						
	
	if(!$stmt->bind_param('si'
						,$tier_name
						,$tier_id)){	
			
				//$stmt->debugDumpParams();
			echo "Error2  ".$stmt->error;
	}else{
		$stmt->execute();
		$stmt->close();
	}




	
	$sql = "SELECT tier_id	
				,tier_name		
			FROM material_tiers
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY tier_name";
	$result = $dbCustom->getResult($db,$sql);
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['tier_id'] = $row->tier_id;
		$long_array[$i]['tier_name'] = $row->tier_name; 
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
		$short_array[$i]['tier_id'] = $long_array[$i]['tier_id']; 
		$short_array[$i]['tier_name'] = $long_array[$i]['tier_name']; 
		$i++;
	}



	$block = '';
	$block .= "<ul id='modify_material_tiers_list'>";
	foreach($short_array as $val){
				$block .= "<li>";
				$block .= "<span id='sub_modify_material_tier_name_".$val['tier_id']."'>".$val['tier_name']."</span>";
				$block .= "<div class='actions'>";
				$block .= "<button>Select</button>";
				$block .= "<button class='edit-collection-btn'
				onclick='open_sub_edit_material_tier(".$val['tier_id'].",\"".$val['tier_name']."\" );'>Edit</button>"; 
				$block .= "<button class='text-red' onclick='delete_sub_material_tier(".$val['tier_id'].");'>Delete</button>";					
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
