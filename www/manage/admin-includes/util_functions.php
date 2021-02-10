<?php
if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}elseif (strpos($_SERVER['REQUEST_URI'], 'designitpro/' )) {
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro/';
}else{
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_account.php");


function get_ship_method($ship_method_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);


	$sql =  sprintf("SELECT name
			FROM ship_method
			WHERE ship_method_id = %u", $ship_method_id);
	
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		return $result->name; 	
	}
	
	return 'Not Available';
}


function my_2d_array_slice($long_array, $start, $end, $data_for = 'orders'){
	
	$ret_array = array();
	//$i = 0;
	$i = $start;
	
	if($end > count($long_array)){
		$end = count($long_array)-1;
	}
	
		
		if($data_for == 'orders'){			
			while($i <= $end){				
				$ret_array[$i]['order_id'] = $long_array[$i]['order_id']; 
				$ret_array[$i]['order_date'] = $long_array[$i]['order_date']; 
				$ret_array[$i]['order_type'] = $long_array[$i]['order_type']; 
				$ret_array[$i]['billing_name'] = $long_array[$i]['billing_name']; 
				$ret_array[$i]['shipping_name'] = $long_array[$i]['shipping_name']; 
				$ret_array[$i]['total'] = $long_array[$i]['total'];
				$i++; 
			}

		}elseif($data_for == 'failed_orders'){			
			while($i <= $end){				
				$ret_array[$i]['failed_order_id'] = $long_array[$i]['failed_order_id']; 
				$ret_array[$i]['order_date'] = $long_array[$i]['order_date']; 
				$ret_array[$i]['order_type'] = $long_array[$i]['order_type']; 
				$ret_array[$i]['billing_name'] = $long_array[$i]['billing_name']; 
				$ret_array[$i]['total'] = $long_array[$i]['total'];
				$i++; 
			}

			
		}elseif($data_for == 'transactions'){	
			while($i <= $end){				
				$ret_array[$i]['trans_id'] = $long_array[$i]['trans_id']; 
				$ret_array[$i]['order_id'] = $long_array[$i]['order_id']; 
				$ret_array[$i]['first_name'] = $long_array[$i]['first_name']; 
				$ret_array[$i]['last_name'] = $long_array[$i]['last_name'];				
				$ret_array[$i]['trans_date'] = $long_array[$i]['trans_date'];
				$ret_array[$i]['amount'] = $long_array[$i]['amount']; 
				$ret_array[$i]['is_success'] = $long_array[$i]['is_success']; 
				$i++;
			}
			
		}elseif($data_for == 'brands'){	
			while($i <= $end){			
				$ret_array[$i]['brand_id'] = $long_array[$i]['brand_id']; 
				$ret_array[$i]['name'] = $long_array[$i]['name']; 
				$i++;
			}
		}elseif($data_for == 'vendors'){
			while($i <= $end){			
				$ret_array[$i]['vend_man_id'] = $long_array[$i]['vend_man_id']; 
				$ret_array[$i]['name'] = $long_array[$i]['name']; 
				$i++;
			}
		}elseif($data_for == 'cores'){
			while($i <= $end){			
				$ret_array[$i]['core_id'] = $long_array[$i]['core_id']; 
				$ret_array[$i]['core_name'] = $long_array[$i]['core_name']; 
				$i++;
			}
		}elseif($data_for == 'material_types'){
			while($i <= $end){			
				$ret_array[$i]['material_type_id'] = $long_array[$i]['material_type_id']; 
				$ret_array[$i]['material_type_name'] = $long_array[$i]['material_type_name']; 
				$i++;
			}
		}elseif($data_for == 'finishes'){
			while($i <= $end){			
				$ret_array[$i]['finish_id'] = $long_array[$i]['finish_id']; 
				$ret_array[$i]['finish_name'] = $long_array[$i]['finish_name']; 
				$i++;
			}
		}elseif($data_for == 'textures'){
			while($i <= $end){			
				$ret_array[$i]['texture_id'] = $long_array[$i]['texture_id']; 
				$ret_array[$i]['texture_name'] = $long_array[$i]['texture_name']; 
				$i++;
			}
		}elseif($data_for == 'mat_tiers'){
			while($i <= $end){			
				$ret_array[$i]['tier_id'] = $long_array[$i]['tier_id']; 
				$ret_array[$i]['tier_name'] = $long_array[$i]['tier_name']; 
				$i++;
			}
			
		}elseif($data_for == 'colors'){
			while($i <= $end){			
				$ret_array[$i]['id'] = $long_array[$i]['id']; 
				$ret_array[$i]['name'] = $long_array[$i]['name']; 
				$i++;
			}
			
		}elseif($data_for == 'qty_calcs'){
			while($i <= $end){			
				$ret_array[$i]['qty_calc_id'] = $long_array[$i]['qty_calc_id']; 
				$ret_array[$i]['qty_calc_name'] = $long_array[$i]['qty_calc_name']; 
				$i++;
			}
			
		}elseif($data_for == 'part_types'){
			while($i <= $end){			
				$ret_array[$i]['part_type_id'] = $long_array[$i]['part_type_id']; 
				$ret_array[$i]['part_type_name_user'] = $long_array[$i]['part_type_name_user']; 
				$i++;
			}
			
		}elseif($data_for == 'materials'){
			while($i <= $end){			
				$ret_array[$i]['material_id'] = $long_array[$i]['material_id']; 
				$ret_array[$i]['material_name'] = $long_array[$i]['material_name']; 
				$i++;
			}
			
		}elseif($data_for == 'price_schemas'){
			while($i <= $end){			
				$ret_array[$i]['price_schema_id'] = $long_array[$i]['price_schema_id']; 
				$ret_array[$i]['price_schema_name'] = $long_array[$i]['price_schema_name']; 
				$i++;
			}
			
		}elseif($data_for == 'qty_schemas'){
			while($i <= $end){			
				$ret_array[$i]['qty_schema_id'] = $long_array[$i]['qty_schema_id']; 
				$ret_array[$i]['qty_schema_name'] = $long_array[$i]['qty_schema_name']; 
				$i++;
			}
			
		}elseif($data_for == 'collections'){
			while($i <= $end){			
				$ret_array[$i]['collection_id'] = $long_array[$i]['collection_id']; 
				$ret_array[$i]['collection_name'] = $long_array[$i]['collection_name']; 
				$i++;
			}

		}elseif($data_for == 'swg'){
			while($i <= $end){			
				$ret_array[$i]['swg_id'] = $long_array[$i]['swg_id']; 
				$ret_array[$i]['swg_name'] = $long_array[$i]['swg_name']; 
				$i++;
			}
		
		}elseif($data_for == 'components'){
			while($i <= $end){			
				$ret_array[$i]['component_id'] = $long_array[$i]['component_id']; 
				$ret_array[$i]['component_name'] = $long_array[$i]['component_name']; 
				$i++;
			}

		}elseif($data_for == 'const_parts'){
			while($i <= $end){			
				$ret_array[$i]['part_id'] = $long_array[$i]['part_id']; 
				$ret_array[$i]['part_name'] = $long_array[$i]['part_name']; 
				$i++;
			}
			
		}elseif($data_for == 'fixed_parts'){
			while($i <= $end){			
				$ret_array[$i]['part_id'] = $long_array[$i]['part_id']; 
				$ret_array[$i]['part_name'] = $long_array[$i]['part_name']; 
				$i++;
			}
		}elseif($data_for == 'units'){
			while($i <= $end){			
				$ret_array[$i]['unit_id'] = $long_array[$i]['unit_id']; 
				$ret_array[$i]['unit_name'] = $long_array[$i]['unit_name']; 
				$i++;
			}
		}elseif($data_for == 'cleats'){
			while($i <= $end){			
				$ret_array[$i]['cleat_id'] = $long_array[$i]['cleat_id']; 
				$ret_array[$i]['cleat_name'] = $long_array[$i]['cleat_name']; 
				$i++;
			}
		}elseif($data_for == 'toe_plates'){
			while($i <= $end){			
				$ret_array[$i]['toe_plate_id'] = $long_array[$i]['toe_plate_id']; 
				$ret_array[$i]['toe_plate_name'] = $long_array[$i]['toe_plate_name']; 
				$i++;
			}
		}elseif($data_for == 'backings'){
			while($i <= $end){			
				$ret_array[$i]['backing_id'] = $long_array[$i]['backing_id']; 
				$ret_array[$i]['backing_name'] = $long_array[$i]['backing_name']; 
				$i++;
			}

		}elseif($data_for == 'edge_bdgs'){
			while($i <= $end){			
				$ret_array[$i]['eb_id'] = $long_array[$i]['eb_id']; 
				$ret_array[$i]['eb_name'] = $long_array[$i]['eb_name']; 
				$i++;
			}
		}elseif($data_for == 'panel'){
			while($i <= $end){			
				$ret_array[$i]['panel_id'] = $long_array[$i]['panel_id']; 
				$ret_array[$i]['panel_name'] = $long_array[$i]['panel_name']; 
				$i++;
			}

			
		}elseif($data_for == 'user'){
			while($i <= $end){
				$ret_array[$i]['username'] = $long_array[$i]['username'];
				$ret_array[$i]['name'] = $long_array[$i]['name'];
				$ret_array[$i]['user_id'] = $long_array[$i]['user_id'];
				$ret_array[$i]['is_locked'] = $long_array[$i]['is_locked'];
				$ret_array[$i]['user_type_label'] = $long_array[$i]['user_type_label'];
				$ret_array[$i]['user_type_leveld'] = $long_array[$i]['user_type_level'];
				$i++;
			}
		}elseif($data_for == 'states'){
			while($i <= $end){
				$ret_array[$i]['state_id'] = $long_array[$i]['state_id'];
				$ret_array[$i]['state'] = $long_array[$i]['state'];
				$ret_array[$i]['hide'] = $long_array[$i]['hide'];
				$i++;
			}

		}elseif($data_for == 'customers'){
			
			$cust_acct = new CustomerAccount();
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			
			while($i <= $end){
							
				$sql = "SELECT name, visited, username
						FROM  user
						WHERE id = '".$long_array[$i]."'";
				$res = $dbCustom->getResult($db,$sql);
				if($res->num_rows > 0){
					$obj = $res->fetch_object();
					$name = $obj->name;
					$visited = $obj->visited;
					$username = $obj->username;
				}else{
					$name = '';
					$visited = 0;
					$username = '';
				}
				
				$last_purchase_date = $cust_acct->getLastPurchaseDate($long_array[$i]);
				$location = $cust_acct->getCustCityAndState($long_array[$i]);	
				
				$ret_array[$i]['user_id'] = $long_array[$i];
				$ret_array[$i]['name'] = $name;
				$ret_array[$i]['username'] = $username;
				$ret_array[$i]['visited'] = $visited;
				$ret_array[$i]['last_purchase_date'] = $last_purchase_date;
				$ret_array[$i]['location'] = $location;
								
				$i++;
			}

		}else{
			
			if(isset($long_array[0]['order_fulfillment_step_id'])){
				while($i <= $end){
					$ret_array[$i]['order_fulfillment_step_id'] = $long_array[$i]['order_fulfillment_step_id']; 
					$ret_array[$i]['step_number'] = $long_array[$i]['step_number']; 
					$ret_array[$i]['step_name'] = $long_array[$i]['step_name']; 
					$ret_array[$i]['description'] = $long_array[$i]['description']; 
					$ret_array[$i]['active'] = $long_array[$i]['active']; 
					$ret_array[$i]['single_action'] = $long_array[$i]['single_action'];
					$ret_array[$i]['is_mini'] = $long_array[$i]['is_mini'];		
					$i++;
				}
			}
		}
	
	return $ret_array;	
}


function my_pagination_ajax($pagenum=1, $end=1){

	$block = "<div class='table-footer pagination with-bottom-shadow'>";
	$block .= "<a href='#' onclick='ajax_set_paging(1)' class='pagination-text double-prev-arrow'>first page</a>";
	if($pagenum > 1){
		$prev_page = $pagenum - 1;
		
		$block .= "<a href='".$path."?pagenum=".$prev_page."' class='pagination-text single-prev-arrow'>previous page</a>";
	
	}
	if($end > 5){
		for($i = 1; $i <= 5; $i++){
			if($i == $pagenum){
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number active'>$i</a>";
			}else{
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number'>$i</a>";	
			}
		}
		$block .= "<span class='pagination-dots'>...</span>";
		if($end == $pagenum){
			$block .= "<a href='".$path."?pagenum=".$end."' class='pagination-number active'>$end</a>";
		}else{
			$block .= "<a href='".$path."?pagenum=".$end."' class='pagination-number'>$end</a>";	
		}
	}else{
		
		for($i = 1; $i <= $end; $i++){
			if($i == $pagenum){
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number active'>$i</a>";
			}else{
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number'>$i</a>";	
			}
		}
	}
	
	if($pagenum < $end){	
		
		$next_page = $pagenum + 1;
		$block .= "<a href='".$path."?pagenum=".$next_page."' class='pagination-text single-next-arrow'>next page</a>";
		$block .= "<a href='".$path."?pagenum=".$end."' class='pagination-text double-next-arrow'>last page</a>";
	
	}
	$block .= "</div>";

	return $block;
	
	
}



function my_pagination($path="orders.php", $pagenum=1, $end=1){

	$block = "<div class='table-footer pagination with-bottom-shadow'>";
	$block .= "<a href='".$path."?pagenum=1' class='pagination-text double-prev-arrow'>first page</a>";
	if($pagenum > 1){
		$prev_page = $pagenum - 1;
		$block .= "<a href='".$path."?pagenum=".$prev_page."' class='pagination-text single-prev-arrow'>previous page</a>";
	}
	if($end > 5){
		for($i = 1; $i <= 5; $i++){
			if($i == $pagenum){
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number active'>$i</a>";
			}else{
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number'>$i</a>";	
			}
		}
		$block .= "<span class='pagination-dots'>...</span>";
		if($end == $pagenum){
			$block .= "<a href='".$path."?pagenum=".$end."' class='pagination-number active'>$end</a>";
		}else{
			
			$this_end = ($end > $pagenum+10)? $pagenum+10 : $end;
			
			$block .= "<a href='".$path."?pagenum=".$this_end."' class='pagination-number'>$this_end</a>";	
		}
	}else{
		
		for($i = 1; $i <= $end; $i++){
			if($i == $pagenum){
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number active'>$i</a>";
			}else{
				$block .= "<a href='".$path."?pagenum=".$i."' class='pagination-number'>$i</a>";	
			}
		}
	}
	
	if($pagenum < $end){	
		
		$next_page = $pagenum + 1;
		$block .= "<a href='".$path."?pagenum=".$next_page."' class='pagination-text single-next-arrow'>next page</a>";
		$block .= "<a href='".$path."?pagenum=".$end."' class='pagination-text double-next-arrow'>last page</a>";
	
	}
	$block .= "</div>";

	return $block;

}





function getCatAttrArray($cat_id){

	$ret_array = array();
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT attribute_id
			FROM  category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	$i = 0;
	while($row = $result->fetch_object()) {			
		$ret_array[$i] = $row->attribute_id;
		$i++;
	}
	
	return $ret_array;
}


function getComponentName($component_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT component_name	
			FROM cabinetry_components 
			WHERE component_id = '".$component_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->component_name;	
	}
	
	return "";		
	
}


function getQtyCalcParamName($qty_calc_param_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT qty_calc_param_name		
		FROM qty_calc_param 
		WHERE qty_calc_param_id = '".$qty_calc_param_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->qty_calc_param_name;	
	}
	
	return "";		
	
}



function getPriceCalcParamName($price_calc_param_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT price_calc_param_name		
			FROM price_calc_params
			WHERE price_calc_param_id = '".$price_calc_param_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->price_calc_param_name;	
	}
	
	return "";		
	
	
}


function getBackingName($backing_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT backing_name		
			FROM cabinetry_backing
			WHERE backing_id = '".$backing_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->backing_name;	
	}
	
	return "";		
	
}




function getToePlateName($toe_plate_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT toe_plate_name		
			FROM cabinetry_toe_plates
			WHERE toe_plate_id = '".$toe_plate_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->toe_plate_name;	
	}
	
	return "";		
	
}



function getCleatName($cleat_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT cleat_name		
			FROM cabinetry_cleats
			WHERE cleat_id = '".$cleat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->cleat_name;	
	}
	
	return "";	
}

function getUnitName($unit_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	
	$sql = "SELECT unit_name		
			FROM cabinetry_units
			WHERE unit_id = '".$unit_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->unit_name;	
	}
	
	return "";	
}

function getFixedPartName($part_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	
	$sql = "SELECT part_name		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_name;	
	}
	
	return "";

}


function getConstructedPartName($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_name		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_name;	
	}
	
	return "";

}

function getConstructedPartTypeID($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_type_id		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_type_id;	
	}
	
	return "";

}


function getFixedPartTypeID($part_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT part_type_id		
			FROM parts
			WHERE part_id = '".$part_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object(); 
		return $object->part_type_id;	
	}
	
	return "";

}












?>