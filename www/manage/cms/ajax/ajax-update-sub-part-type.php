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

$msg = '';

$part_type_id = (isset($_GET['part_type_id'])) ? $_GET['part_type_id'] : 0;   

$name = (isset($_GET['name'])) ? trim(addslashes($_GET['name'])) : '';   

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);


$CPRDCL_id = 0;
$elevation_CGC_collection_id = "";
$elevation_CGC_id = "";
$part_type_id_name = "";


	
$sql =  sprintf("UPDATE part_types
				SET part_type_name_user = '%s'
					,elevation_CGC_collection_id = '%s'
					,elevation_CGC_id = '%s'
					,part_type_id_name = '%s'
					,CPRDCL_id = '%u'
				WHERE part_type_id = '%u'", 
						$name
						,$elevation_CGC_collection_id
						,$elevation_CGC_id
						,$part_type_id_name
						,$CPRDCL_id
						,$part_type_id);
$result = $dbCustom->getResult($db,$sql);







$sql = "SELECT part_type_id
			,part_type_name_user
		FROM  part_types 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY part_type_name_user";
$result = $dbCustom->getResult($db,$sql);
$long_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$long_array[$i]['part_type_id'] = $row->part_type_id;
	$long_array[$i]['part_type_name_user'] = $row->part_type_name_user; 
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
	$short_array[$i]['part_type_id'] = $long_array[$i]['part_type_id']; 
	$short_array[$i]['part_type_name_user'] = $long_array[$i]['part_type_name_user']; 
	$i++;
}


$block = '';
$block .= "<ul id='sub_part_types_list'>";
foreach($short_array as $val){
	$block .= "<li>";
	$block .= "<span id='sub_part_type_name_".$val['part_type_id']."'>".$val['part_type_name_user']."</span>";
	$block .= "<div class='actions'>";
	$block .= "<button>Select</button>";
	$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_part_type(".$val['part_type_id'].");'>Edit</button>";
	$block .= "<button class='text-red' onclick='delete_part_type(".$val['part_type_id'].");'>Delete</button>";	
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
		echo "<a onclick='ajax_set_paging_sub_part_type(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>


?>