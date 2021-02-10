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

$msg = '';

$collection_id = (isset($_GET['collection_id'])) ? $_GET['collection_id'] : 0;   

$collection_name = (isset($_GET['collection_name'])) ? trim(addslashes($_GET['collection_name'])) : '';   
$rows_per_page = (isset($_GET['rows_per_page'])) ? $_GET['rows_per_page'] : 8;   

$page = 1;
$data_for = 'collections';

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
$sql =  sprintf("UPDATE collection
				SET collection_name = '%s' 
				WHERE collection_id = '%u'", $collection_name, $collection_id);
$result = $dbCustom->getResult($db,$sql);






$sql = "SELECT collection_id
			,collection_name
		FROM  collection 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY collection_name";
$result = $dbCustom->getResult($db,$sql);
$long_array = array();
$i=0;
while($row = $result->fetch_object()) {	
	$long_array[$i]['collection_id'] = $row->collection_id;
	$long_array[$i]['collection_name'] = $row->collection_name;
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
		$short_array[$i]['collection_id'] = $long_array[$i]['collection_id']; 
		$short_array[$i]['collection_name'] = $long_array[$i]['collection_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['collection_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_collection(".$val['collection_id'].",\"".$val['collection_name']."\" );'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_collection(".$val['collection_id'].");'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_collection(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}


?>