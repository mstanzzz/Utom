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

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	$page = 1;
	$data_for = 'edge_bdgs';

	$eb_name = (isset($_GET['eb_name']))? trim(addslashes($_GET['eb_name'])) : 'no name';
	$finish_id = (isset($_GET['finish_id']))? $_GET['finish_id'] : 0;
	$texture_id = (isset($_GET['texture_id']))? $_GET['texture_id'] : 0;
	$brand_id = (isset($_GET['brand_id']))? $_GET['brand_id'] : 0;
	$vendor_id = (isset($_GET['vendor_id']))? $_GET['vendor_id'] : 0;
	$vend_prod_num = (isset($_GET['vend_prod_num']))? trim(addslashes($_GET['vend_prod_num'])) : '';
	$is_stocked = (isset($_GET['is_stocked']))? $_GET['is_stocked'] : 0;
	$eb_roll_length = (isset($_GET['eb_roll_length']))? $_GET['eb_roll_length'] : 0;
	$eb_thickness = (isset($_GET['eb_thickness']))? $_GET['eb_thickness'] : 0;
	$eb_width = (isset($_GET['eb_width']))? $_GET['eb_width'] : 0;
	$cost_per_roll = (isset($_GET['cost_per_roll']))? $_GET['cost_per_roll'] : 0;
	$glue_cost = (isset($_GET['glue_cost']))? $_GET['glue_cost'] : 0;
	$waste_allowance = (isset($_GET['waste_allowance']))? $_GET['waste_allowance'] : 0;
	$markup = (isset($_GET['markup']))? $_GET['markup'] : 0;
	
	$collection_ids = (isset($_GET['collection_ids']))? $_GET['collection_ids'] : array();
	
	$eb_id = (isset($_GET['eb_id']))? $_GET['eb_id'] : 0;

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$stmt = $db->prepare("UPDATE edge_banding
						SET 
						eb_name = ?
						,finish_id = ?
						,texture_id = ?
						,brand_id = ?
						,vendor_id = ?
						,vend_prod_num = ?
						,is_stocked = ?
						,eb_roll_length = ?
						,eb_thickness = ?
						,eb_width = ?
						,cost_per_roll = ?
						,glue_cost = ?
						,waste_allowance = ?
						,markup = ?
						WHERE eb_id = ?");
						
						//echo 'Error '.$db->error;	
													
	if(!$stmt->bind_param('siiiisiididdiii'
						,$eb_name
						,$finish_id
						,$texture_id
						,$brand_id
						,$vendor_id
						,$vend_prod_num
						,$is_stocked
						,$eb_roll_length
						,$eb_thickness
						,$eb_width
						,$cost_per_roll
						,$glue_cost
						,$waste_allowance
						,$markup
						,$eb_id)){
			
				echo 'Error-2 '.$db->error;					
	}else{

		$stmt->execute();
		$stmt->close();		
		
		$msg = 'success';
		
	}





	$sql = "SELECT eb_id	
			,eb_name		
		FROM edge_banding
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY eb_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['eb_id'] = $row->eb_id;
		$long_array[$i]['eb_name'] = $row->eb_name; 
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
		$short_array[$i]['eb_id'] = $long_array[$i]['eb_id']; 
		$short_array[$i]['eb_name'] = $long_array[$i]['eb_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['eb_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_eb(".$val['eb_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_eb(".$val['eb_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_eb(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

?>