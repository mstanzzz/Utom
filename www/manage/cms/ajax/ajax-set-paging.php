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
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/util_functions.php');

$page = isset($_GET['page'])? $_GET['page'] : 1;

if($page <= 1) $page = 1;

$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 8;

$data_for = isset($_GET['data_for'])? $_GET['data_for'] : '';

$total_rows = 0;
$end = 0;
$long_array = array();
$short_array = array();


if($data_for == "brands"){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
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
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_brand(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "vendors"){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);		
	$sql = "SELECT vend_man_id	
				,name		
			FROM vend_man
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
	$result = $dbCustom->getResult($db,$sql);
	
	$long_array = array();
	$short_array = array();
	
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
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_vendor(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "cores"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT core_id	
				,core_name		
			FROM core
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY core_name";
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['core_id'] = $row->core_id;
		$long_array[$i]['core_name'] = $row->core_name; 
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
		$short_array[$i]['core_id'] = $long_array[$i]['core_id']; 
		$short_array[$i]['core_name'] = $long_array[$i]['core_name']; 
		$i++;
	}


	$block = '';
	$block .= "<ul id='sub_cores_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
						$block .= "<span id='sub_core_name_".$val['core_id']."'>".$val['core_name']."</span>";
						$block .= "<div class='actions'>";
						$block .= "<button>Select</button>";
						$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_core(".$val['core_id'].",\"".$val['core_name']."\");'>Edit</button>";
						$block .= "<button class='text-red' onclick='delete_modify_core(".$val['core_id'].");'>Delete</button>";					
						$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;

	if($total_rows > 0){
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "material_types"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT material_type_id	
				,material_type_name		
			FROM material_types
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY material_type_name";
	$result = $dbCustom->getResult($db,$sql);
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['material_type_id'] = $row->material_type_id;
		$long_array[$i]['material_type_name'] = $row->material_type_name; 
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
		$short_array[$i]['material_type_id'] = $long_array[$i]['material_type_id']; 
		$short_array[$i]['material_type_name'] = $long_array[$i]['material_type_name']; 
		$i++;
	}


                
	$block = '';
	$block .= "<ul id='sub_material_types_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span id='sub_material_type_name_".$val['material_type_id']."'>".$val['material_type_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_material_type(".$val['material_type_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_modify_material_type(".$val['material_type_id'].");'>Delete</button>";					
		$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;
				
	if($total_rows > 0){
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
}


if($data_for == "finishes"){
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);				
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
	$block .= "<ul id='sub_finishs_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span id='sub_finish_name_".$val['finish_id']."'>".$val['finish_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_finish(".$val['finish_id'].",\"".$val['finish_name']."\");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_modify_finish(".$val['finish_id'].");'>Delete</button>";					
		$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;

	if($total_rows > 0){
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "textures"){

	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);				
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
	$i = $start;
	while($i < $end){			
		$short_array[$i]['texture_id'] = $long_array[$i]['texture_id']; 
		$short_array[$i]['texture_name'] = $long_array[$i]['texture_name']; 
		$i++;
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
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "mat_tiers"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
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
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_material_tier(".$val['tier_id'].",\"".$val['tier_name']."\" );'>Edit</button>"; 
		$block .= "<button class='text-red' onclick='delete_sub_material_tier(".$val['tier_id'].");'>Delete</button>";					
		$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;
	
	if($total_rows > 0){
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
}


if($data_for == "colors"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT id	
				,name
			FROM color
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
	$result = $dbCustom->getResult($db,$sql);
	$color_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$color_array[$i]['id'] = $row->id;
		$color_array[$i]['name'] = $row->name; 
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
		$short_array[$i]['id'] = $long_array[$i]['id']; 
		$short_array[$i]['name'] = $long_array[$i]['name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul id='sub_modify_colors_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span id='sub_modify_color_name_".$val['id']."'>".$val['name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_color(".$val['id'].");'>Edit</button>"; 
		$block .= "<button class='text-red' onclick='delete_sub_color(".$val['id'].");'>Delete</button>";					
		$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_color(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "qty_calcs"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT qty_calc_id 
				,qty_calc_name	
			FROM qty_calc_equations
			ORDER BY qty_calc_name";
	$result = $dbCustom->getResult($db,$sql);	
	
	$i = 0;
	$long_array = array();
	while($row = $result->fetch_object()){		
		$long_array[$i]['qty_calc_id'] = $row->qty_calc_id;
		$long_array[$i]['qty_calc_name'] = $row->qty_calc_name;
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
		$short_array[$i]['qty_calc_id'] = $long_array[$i]['qty_calc_id']; 
		$short_array[$i]['qty_calc_name'] = $long_array[$i]['qty_calc_name']; 
		$i++;
	}
		

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['qty_calc_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_qty_calc(".$val['qty_calc_id'].");'>Edit</button>"; 
		$block .= "<button class='text-red' onclick='delete_sub_qty_calc(".$val['qty_calc_id'].");'>Delete</button>";					
		$block .= "</div>";
		$block .= "</li>";
	}
	$block .= "</ul>";
	echo $block;

	if($total_rows > 0){
		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_qty_cal(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "part_types"){
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT part_type_id	
				,part_type_name_user		
			FROM part_types 
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY part_type_name_user";				
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	$long_array = array();
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
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_part_type(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "materials"){
	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT material_id	
				,material_name		
			FROM materials
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY material_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['material_id'] = $row->material_id;
		$long_array[$i]['material_name'] = $row->material_name; 
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
		$short_array[$i]['material_id'] = $long_array[$i]['material_id']; 
		$short_array[$i]['material_name'] = $long_array[$i]['material_name']; 
		$i++;
	}
	
	$block = '';
	$block .= "<ul id='sub_materials_list'>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['material_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_material(".$val['material_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_material(".$val['material_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;


	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_material(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
}
	

if($data_for == "price_schemas"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT price_schema_id	
				,price_schema_name		
			FROM price_schema 
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY price_schema_name";				
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	$long_array = array();
	while($row = $result->fetch_object()){		
		$long_array[$i]['price_schema_id'] = $row->price_schema_id;
		$long_array[$i]['price_schema_name'] = $row->price_schema_name;
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
		$short_array[$i]['price_schema_id'] = $long_array[$i]['price_schema_id']; 
		$short_array[$i]['price_schema_name'] = $long_array[$i]['price_schema_name']; 
		$i++;
	}
	
	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['price_schema_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";				
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_price_schema(".$val['price_schema_id'].");'>Edit</button>";	
		$block .= "<button class='text-red' onclick='delete_sub_price_schema(".$val['price_schema_id'].");'>Delete</button>";					
		$block .= "<button class='text-red'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;


	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_price_schema(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}

if($data_for == "qty_schemas"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT qty_schema_id	
					,qty_schema_name		
			FROM qty_schema 
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY qty_schema_name";				
	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	$long_array = array();
	while($row = $result->fetch_object()){		
		$long_array[$i]['qty_schema_id'] = $row->qty_schema_id;
		$long_array[$i]['qty_schema_name'] = $row->qty_schema_name;
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
		$short_array[$i]['qty_schema_id'] = $long_array[$i]['qty_schema_id']; 
		$short_array[$i]['qty_schema_name'] = $long_array[$i]['qty_schema_name']; 
		$i++;
	}


	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['price_schema_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";				
		$block .= "<button class='edit-collection-btn' onclick='open_edit_sub_qty_schema(".$val['price_schema_id'].");'>Edit</button>";	
		$block .= "<button class='text-red' onclick='delete_sub_qty_schema(".$val['price_schema_id'].");'>Delete</button>";					
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;
	

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_qs(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
}



if($data_for == "collections"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
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

}

if($data_for == "swg"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT swg_id 
				,swg_name	
			FROM cabinetry_section_width_groups
			ORDER BY swg_name";
	$result = $dbCustom->getResult($db,$sql);	
	
	$i = 0;
	$long_array = array();
	while($row = $result->fetch_object()){		
		$long_array[$i]['swg_id'] = $row->swg_id;
		$long_array[$i]['swg_name'] = $row->swg_name;
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
		$short_array[$i]['swg_id'] = $long_array[$i]['swg_id']; 
		$short_array[$i]['swg_name'] = $long_array[$i]['swg_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['swg_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_swg(".$val['swg_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_swg(".$val['swg_id'].");'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_swg(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "components"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT component_id
				,component_name
			FROM cabinetry_components
			WHERE saas_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['component_id'] = $row->component_id;
		$long_array[$i]['component_name'] = $row->component_name; 
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
		$short_array[$i]['component_id'] = $long_array[$i]['component_id']; 
		$short_array[$i]['component_name'] = $long_array[$i]['component_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['component_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_component(".$val['component_id'].");'>Edit</button>";
		$block .= "<button class='text-red'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_component(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
}


if($data_for == "const_parts"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT part_id
				,part_name
			FROM parts
			WHERE part_category='0'
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
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_constructed_part(".$val['part_id'].",1);'>Edit</button>";
		$block .= "<button class='text-red'onclick='delete_sub_constructed_part(".$val['part_id'].");'>Delete</button>";
		$block .= "</div>";					
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_const_part(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}


if($data_for == "fixed_parts"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
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
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_constructed_part(".$val['part_id'].",1);'>Edit</button>";
		$block .= "<button class='text-red'onclick='delete_sub_constructed_part(".$val['part_id'].");'>Delete</button>";
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

}


if($data_for == "units"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT unit_id
			,unit_name		
		FROM cabinetry_units
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY unit_name";
	$result = $dbCustom->getResult($db,$sql);

	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['unit_id'] = $row->unit_id;
		$long_array[$i]['unit_name'] = $row->unit_name; 
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
		$short_array[$i]['unit_id'] = $long_array[$i]['unit_id']; 
		$short_array[$i]['unit_name'] = $long_array[$i]['unit_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
    $block .= "<li>";
    $block .= "<span>".$val['unit_name']."</span>";
    $block .= "<div class='actions'>";
    $block .= "<button>Select</button>";
    $block .= "<button class='edit-collection-btn' onclick='open_sub_edit_unit(".$val['unit_id'].");'>Edit</button>";
	$block .= "<button class='text-red'onclick='delete_sub_unit(".$val['unit_id'].");'>Delete</button>";
    $block .= "</div>";				
    $block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_unit(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "cleats"){
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT cleat_id
				,cleat_name		
			FROM cabinetry_cleats
			WHERE saas_id = '".$_SESSION['profile_account_id']."'
			ORDER BY cleat_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['cleat_id'] = $row->cleat_id;
		$long_array[$i]['cleat_name'] = $row->cleat_name; 
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
		$short_array[$i]['cleat_id'] = $long_array[$i]['cleat_id']; 
		$short_array[$i]['cleat_name'] = $long_array[$i]['cleat_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['cleat_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_cleat(".$val['cleat_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_cleat".$val['cleat_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_cleat(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}
	
	
}


if($data_for == "toe_plates"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT toe_plate_id
			,toe_plate_name		
		FROM cabinetry_toe_plates
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY toe_plate_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['toe_plate_id'] = $row->toe_plate_id;
		$long_array[$i]['toe_plate_name'] = $row->toe_plate_name; 
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
		$short_array[$i]['toe_plate_id'] = $long_array[$i]['toe_plate_id']; 
		$short_array[$i]['toe_plate_name'] = $long_array[$i]['toe_plate_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['toe_plate_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_toe_plate(".$val['toe_plate_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_toe_plate(".$val['toe_plate_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_toe_plate(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}





if($data_for == "backings"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT backing_id
			,backing_name		
		FROM cabinetry_backing
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY backing_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['backing_id'] = $row->backing_id;
		$long_array[$i]['backing_name'] = $row->backing_name; 
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
		$short_array[$i]['backing_id'] = $long_array[$i]['backing_id']; 
		$short_array[$i]['backing_name'] = $long_array[$i]['backing_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['backing_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_backing(".$val['backing_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_backing(".$val['backing_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_backing(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}



if($data_for == "edge_bdgs"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
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

}


if($data_for == "panel"){

	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	$sql = "SELECT panel_id	
			,panel_name		
		FROM cabinetry_panels
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY panel_name";
	$result = $dbCustom->getResult($db,$sql);
	
	$short_array = array();
	$long_array = array();
	$i = 0;
	while($row = $result->fetch_object()){
		$long_array[$i]['panel_id'] = $row->panel_id;
		$long_array[$i]['panel_name'] = $row->panel_name; 
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
		$short_array[$i]['panel_id'] = $long_array[$i]['panel_id']; 
		$short_array[$i]['panel_name'] = $long_array[$i]['panel_name']; 
		$i++;
	}

	$block = '';
	$block .= "<ul>";
	foreach($short_array as $val){
		$block .= "<li>";
		$block .= "<span>".$val['panel_name']."</span>";
		$block .= "<div class='actions'>";
		$block .= "<button>Select</button>";
		$block .= "<button class='edit-collection-btn' onclick='open_sub_edit_panel(".$val['panel_id'].");'>Edit</button>";
		$block .= "<button class='text-red' onclick='delete_sub_panel(".$val['panel_id'].");'>Delete</button>";	
		$block .= "</div>";				
		$block .= "</li>";
	}	
	$block .= "</ul>";			
	echo $block;

	if($total_rows > 0){		
		echo "<div class='table-footer pagination with-bottom-shadow'>";
		for($i=1; $i<=$last; $i++){
			$active = ($i == $page)? 'active': '';	
			echo "<a onclick='ajax_set_paging_sub_panel(".$i.",".$rows_per_page.",\"".$data_for."\")' class='pagination-number ".$active."'>".$i."</a>";
		}
		echo "</div>";
	}

}




?>