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
$_SESSION['ret_modal'] = '';

require_once($real_root."/includes/config.php");

	$page = 1;
	$data_for = 'vendors';

	$parent_vend_man_id = $_GET["parent_vend_man_id"];
		
	$name = (isset($_GET['name'])) ? addslashes($_GET['name']) : ''; 
	$web_site = (isset($_GET['web_site'])) ? addslashes($_GET['web_site']) : ''; 
	$description = (isset($_GET['description'])) ? addslashes($_GET['description']) : ''; 
	$contact_name = (isset($_GET['contact_name'])) ? addslashes($_GET['contact_name']) : ''; 
	$contact_email = (isset($_GET['contact_email'])) ? addslashes($_GET['contact_email']) : ''; 
	$contact_phone = (isset($_GET['contact_phone'])) ? addslashes($_GET['contact_phone']) : ''; 
	$contact_fax = (isset($_GET['contact_fax'])) ? addslashes($_GET['contact_fax']) : ''; 
	
	$is_drop_shipper = isset($_GET['is_drop_shipper']) ? $_GET['is_drop_shipper'] : 0; 
	$is_vendor = isset($_GET['is_vendor']) ? $_GET['is_vendor'] : 0; 
	$is_manufacturer = isset($_GET['is_manufacturer']) ? $_GET['is_manufacturer'] : 0; 
	
	$brand_ids = array();
	if(isset($_GET['col_parms'])) $brand_ids = explode("|",$_GET['col_parms']);

	$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;
	
	if(!is_numeric($rows_per_page)) $rows_per_page = 8;

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$stmt = $db->prepare("INSERT INTO vend_man
						(name
						,web_site
						,description 
						,contact_name
						,contact_email
						,contact_phone
						,contact_fax
						,is_drop_shipper
						,is_vendor
						,is_manufacturer
						,parent_vend_man_id
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?)");	
			//print_r($stmt);						
			//echo 'Error1 '.$db->error;						
	
	if(!$stmt->bind_param('sssssssiiiii'
						,$name
						,$web_site
						,$description
						,$contact_name
						,$contact_email
						,$contact_phone
						,$contact_fax
						,$is_drop_shipper
						,$is_vendor
						,$is_manufacturer
						,$parent_vend_man_id
						,$_SESSION['profile_account_id'])){	
			
			//$stmt->debugDumpParams();
			echo "Error2  ".$stmt->error;
	}else{
		$stmt->execute();
		$stmt->close();

		foreach($brand_ids as $value){
			if(is_numeric($value)){
				$sql = "INSERT INTO vend_man_brand 
						(vend_man_id, brand_id) 
						VALUES( '".$vend_man_id."', '".$value."')";
				$result = $dbCustom->getResult($db,$sql);
			}
		}
	}






	$sql = "SELECT vend_man_id	
				,name		
			FROM vend_man
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['vend_man_id'] = $row->vend_man_id;
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
	while($i < $end){			
		$short_array[$i]['vend_man_id'] = $long_array[$i]['vend_man_id']; 
		$short_array[$i]['name'] = $long_array[$i]['name']; 
		$i++;
	}




$block = '';
$block .= "<ul id='sub_vendors_list'>";
foreach($short_array as $val){
	$block .= "<li>";
	$block .= "<span id='sub_vendor_name_".$val['vend_man_id']."'>".$val['name']."</span>";
	$block .= "<div class='actions'>";
	$block .= "<button>Select</button>";
	$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_vendor(".$val['vend_man_id'].");'>Edit</button>";
	$block .= "<button class='text-red' onclick='delete_modify_vendor(".$val['vend_man_id'].",".$rows_per_page.");'>Delete</button>";					
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
		echo "<a onclick='ajax_set_paging_sub_vendor(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
	}
	?>
</div>
<?php
}
?>
