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

	$brand_id = isset($_GET['brand_id'])? $_GET['brand_id'] : 8;
	$name = isset($_GET['name'])? addslashes($_GET['name']) : '';
	$short_name = isset($_GET['short_name'])? addslashes($_GET['short_name']) : '';
	$web_site = isset($_GET['web_site'])? addslashes($_GET['web_site']) : '';

	$vendor_ids = array();
	if(isset($_GET['col_parms'])) $vendor_ids = explode("|",$_GET['col_parms']);

	$page = 1;
	$data_for = 'brands';
	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$stmt = $db->prepare("UPDATE brand
						SET name = ?
							,short_name = ?
							,web_site = ? 
						WHERE brand_id = ?"); 
				
			//print_r($stmt);										
			echo 'Error1 '.$db->error;						
	
	if(!$stmt->bind_param('sssi'
						,$name
						,$short_name
						,$web_site
						,$brand_id)){	
			
				//$stmt->debugDumpParams();
			echo "Error2  ".$stmt->error;
	}else{
		$stmt->execute();
		$stmt->close();

		$sql = "DELETE FROM vend_man_brand 
				WHERE brand_id = '".$brand_id."'";
		$result = $dbCustom->getResult($db,$sql);	
		foreach($vendor_ids as $value){
			if(is_numeric($value)){
				$sql = "INSERT INTO vend_man_brand 
						(vend_man_id, brand_id) 
						VALUES( '".$value."', '".$brand_id."')";
				$result = $dbCustom->getResult($db,$sql);			
			}
		}
	}





	$sql = "SELECT brand_id	
				,name		
			FROM brand
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['brand_id'] = $row->brand_id;
		$long_array[$i]['name'] = $row->name; 
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
	while($i <= $end){			
		$short_array[$i]['brand_id'] = $long_array[$i]['brand_id']; 
		$short_array[$i]['name'] = $long_array[$i]['name']; 
		$i++;
	}




$block = '';
$block .= "<ul id='sub_brands_list'>";
foreach($short_array as $val){
	$block .= "<li>";
	$block .= "<span id='sub_brand_name_".$val['brand_id']."'>".$val['name']."</span>";
	$block .= "<div class='actions'>";
	$block .= "<button>Select</button>";
	$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_brand(".$val['brand_id'].");'>Edit</button>";
	$block .= "<button class='text-red' onclick='delete_modify_brand(".$val['brand_id'].",".$rows_per_page.");'>Delete</button>";					
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
		echo "<a onclick='ajax_set_paging_sub_brand(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>




