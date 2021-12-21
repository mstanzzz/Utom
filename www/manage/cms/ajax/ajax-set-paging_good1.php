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
require_once($real_root.'/manage/admin-includes/util_functions.php');

$page = isset($_GET['page'])? $_GET['page'] : 1;

if($page == 0) $page = 1;	
	
$total_rows = isset($_GET['total_rows'])? $_GET['total_rows'] : 5;

$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 7;

$data_for = isset($_GET['data_for'])? $_GET['data_for'] : 7;

$last = ceil($total_rows/$rows_per_page); 

if($last == 0) $last = 1;

$next_page = $page++;

$prev_page = $page--;

$start = ($page - 1) * $rows_per_page;

$end = $start + $rows_per_page;
if($end > $total_rows){
	$end = $total_rows-1;
}


$db = $dbCustom->getDbConnect(CART_DATABASE);
				
$sql = "SELECT brand_id	
			,name		
		FROM brand
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);

$long_array = array();
$short_array = array();

$i = 0;
while($row = $result->fetch_object()){
	$long_array[$i]['brand_id'] = $row->brand_id;
	$long_array[$i]['name'] = $row->name; 
	$i++;
}


			while($i <= $end){			
				$short_array[$i]['brand_id'] = $long_array[$i]['brand_id']; 
				$short_array[$i]['name'] = $long_array[$i]['name']; 
				$i++;
			}


//$short_array = my_2d_array_slice($long_array, $start, $end, $data_for);


				$block = '';
				$block .= "<ul id='sub_brands_list'>";
				foreach($short_array as $val){
					$block .= "<li>";
					$block .= "<span id='sub_brand_name_".$val['brand_id']."'>".$val['name']."</span>";
					$block .= "<div class='actions'>";
					$block .= "<button>Select</button>";
					//$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_brand(".$val['brand_id'].",\"".$val['brand_name']."\");'>Edit</button>";
					$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_brand(".$val['brand_id'].");'>Edit</button>";
					$block .= "<button class='text-red' onclick='delete_brand(".$val['brand_id'].");'>Delete</button>";					
					$block .= "</div>";
					$block .= "</li>";
				
					
				}
				$block .= "</ul>";
				echo $block;
                




?>


<div id="modify_brand_paging" class='table-footer pagination with-bottom-shadow'>

    <span onclick='ajax_set_paging(1)' class='double-prev-arrow ajax-paging-arrow'></span>
 
	<span onclick="ajax_set_paging(<?php echo $prev_page; ?>, <?php echo $total_rows; ?>, <?php echo $rows_per_page; ?>);" class='single-prev-arrow ajax-paging-arrow'></span>

	<?php
	for($i=1; $i<=$last; $i++){
		$active = ($i == $page)? 'active': '';
		echo "<a onclick='ajax_set_paging(".$i.",".$total_rows.",".$rows_per_page.")' class='pagination-number ajax-paging-arrow ".$active."'>".$i."</a>";
	}
	?>

    <span onclick="ajax_set_paging(<?php echo $next_page; ?>, <?php echo $total_rows; ?>, <?php echo $rows_per_page; ?>);" class='single-next-arrow ajax-paging-arrow'></span>
    
    <span onclick="ajax_set_paging(<?php echo $last; ?>, <?php echo $total_rows; ?>, <?php echo $rows_per_page; ?>;)" class='double-next-arrow ajax-paging-arrow'></span>

</div>