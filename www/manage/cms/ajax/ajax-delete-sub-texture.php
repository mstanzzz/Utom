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

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$texture_id = isset($_GET['texture_id'])? $_GET['texture_id'] : 0;

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

	$page = 1;
	$data_for = 'textures';
	
	$sql =  sprintf("DELETE FROM textures
					WHERE texture_id = %u", $texture_id);
	$result = $dbCustom->getResult($db,$sql);





	$sql = "SELECT texture_id	
			,texture_name		
		FROM textures
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY texture_name";
	$result = $dbCustom->getResult($db,$sql);
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['texture_id'] = $row->texture_id;
		$long_array[$i]['texture_name'] = $row->texture_name; 
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
		if(isset($long_array[$i]['texture_id'])){			
			$short_array[$i]['texture_id'] = $long_array[$i]['texture_id']; 
			$short_array[$i]['texture_name'] = $long_array[$i]['texture_name']; 
			$i++;
		}
	}


	$block = '';
	$block .= "<ul id='sub_textures_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span id='sub_texture_name_".$val['texture_id']."'>".$val['texture_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_texture(".$val['texture_id'].",\"".$val['texture_name']."\");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_modify_texture(".$val['texture_id'].");'>Delete</button>";					
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



?>
