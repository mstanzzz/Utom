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

	$finish_id = isset($_GET['finish_id'])? $_GET['finish_id'] : 0;
	$finish_name = isset($_GET['finish_name'])? addslashes($_GET['finish_name']) : '';
	$tool_color = isset($_GET['tool_color'])? "#".$_GET['tool_color'] : '';
	$type_id = isset($_GET['type_id'])? $_GET['type_id'] : 0;
	$tool_alpha = isset($_GET['tool_alpha'])? addslashes($_GET['tool_alpha']) : '';
	$tool_image = isset($_GET['tool_image'])? addslashes($_GET['tool_image']) : '';
	
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	

	if(!is_numeric($tool_alpha)) $tool_alpha = 0;


	$page = 1;
	$data_for = 'brands';

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$stmt = $db->prepare("UPDATE finishes
						SET finish_name = ?
						,tool_color = ?						
						,tool_image = ?
						,tool_alpha = ?
						,type_id = ? 
						WHERE finish_id = ?"); 
			//print_r($stmt);										
		//echo 'Error1 '.$db->error;						
	
	if(!$stmt->bind_param('sssdii'
						,$finish_name
						,$tool_color
						,$tool_image
						,$tool_alpha
						,$type_id
						,$finish_id)){	
			
				//$stmt->debugDumpParams();
			echo "Error2  ".$stmt->error;
	}else{
		$stmt->execute();
		$stmt->close();
	}



	$sql = "SELECT finish_id	
				,finish_name		
			FROM finishes
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY finish_name";
	$result = $dbCustom->getResult($db,$sql);
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['finish_id'] = $row->finish_id;
		$long_array[$i]['finish_name'] = $row->finish_name; 
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
		$short_array[$i]['finish_id'] = $long_array[$i]['finish_id']; 
		$short_array[$i]['finish_name'] = $long_array[$i]['finish_name']; 
		$i++;
	}




$block = '';
$block .= "<ul id='sub_finish_list'>";
foreach($short_array as $val){
	$block .= "<li>";
	$block .= "<span id='sub_finish_name_".$val['finish_id']."'>".$val['finish_name']."</span>";
	$block .= "<div class='actions'>";
	$block .= "<button>Select</button>";
	$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_finish(".$val['finish_id'].");'>Edit</button>";
	$block .= "<button class='text-red' onclick='delete_modify_finish(".$val['finish_id'].",".$rows_per_page.");'>Delete</button>";					
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
