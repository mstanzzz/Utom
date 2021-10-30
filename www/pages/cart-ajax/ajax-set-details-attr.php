<?php
require_once("<?php echo SITEROOT; ?>includes/config.php");
require_once("<?php echo SITEROOT; ?>includes/accessory_cart_functions.php");

// find items that have the selected option. 
// of those items, get all attributes they use.
// return only these attribute boxes while limiting the options to only the ones relavent
// NOTE: all attributes need to be returned but un-used ones need to be hidden so reselecting main attr options can include all select boxes. 

function get_attr_name($attr_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT attribute_name 
			FROM  attribute
			WHERE attribute_id = '".$attr_id."'";			
	$res = $dbCustom->getResult($db,$sql);		
	if($res->num_rows > 0){
		$obj = $res->fetch_object();				
		return $obj->attribute_name;
	}
	return '';
}


$top_item_id = (isset($_GET['top_item_id'])) ? $_GET['top_item_id'] : 0;
$attr_opts = (isset($_GET['attr_opts'])) ? $_GET['attr_opts'] : 0;
$trigger_attr = (isset($_GET['trigger_attr'])) ? $_GET['trigger_attr'] : 0;
$trigger_option = (isset($_GET['trigger_option'])) ? $_GET['trigger_option'] : 0;
$main_attr_id = (isset($_GET['main_attr_id'])) ? $_GET['main_attr_id'] : 0;
$deviceType = (isset($_GET['deviceType'])) ? $_GET['deviceType'] : 3;


$ct_out = explode("---",$attr_opts);
if(is_array($ct_out)){
	array_pop($ct_out);
}else{
	$ct_out = array();	
}

$selector_count = 1;
$reset = 0;
$two_sel = 0;
$all_attr_array = array();

$all_item_array = array();
$return_attributes_array = array();
$return_opt_array = array();
$included_items_array = array();
$possible_items_array = array();

$left_opt = 0;
$left_attr = 0;

$test = '';


$i = 0;
foreach($ct_out as $ct_out_v){	
		
	$ct_in = explode("|",$ct_out_v);
		
	$all_attr_array[$i]['attr_id'] = $ct_in[0];	
	$all_attr_array[$i]['opt_id'] = $ct_in[1]; 
	$all_attr_array[$i]['attr_name'] = get_attr_name($ct_in[0]);
		
	if($ct_in[1] > 0) $selector_count++;		
		
	$i++;
}

$left_pos = $selector_count - 2;

if(isset($all_attr_array[$left_pos])){
	$left_opt = $all_attr_array[$left_pos]['opt_id'];
	$left_attr = $all_attr_array[$left_pos]['attr_id'];

}


$last_offset = count($all_attr_array) - 1;


if($trigger_attr == $main_attr_id){
	$reset = 1;
	$selector_count = 2;

}

// from second attr selector
if(isset($all_attr_array[1])){
	if($trigger_attr == $all_attr_array[1]['attr_id']){
		$two_sel = 1;
	}
}

$db = $dbCustom->getDbConnect(CART_DATABASE);	
// all items
$sql = "SELECT item_id
		FROM item
		WHERE parent_item_id = '".$top_item_id."'";
$res = $dbCustom->getResult($db,$sql);
$j = 0;
$all_item_array[$j] = $top_item_id;
while($row = $res->fetch_object()){
	$j++;	
	$all_item_array[$j] = $row->item_id;
}

if($reset){
	
	if($trigger_attr != $main_attr_id){
		$selector_count = 2;
		for($i = 1; $i < count($all_attr_array); $i++){			
			$all_attr_array[$i]['opt_id'] = 0;
		}
	}

	$i = 0;
	foreach($all_item_array as $all_item_v){
		$sql = "SELECT item_to_opt_id 
				FROM  item_to_opt
				WHERE item_id = '".$all_item_v."'				 
				AND opt_id = '".$all_attr_array[0]['opt_id']."'";
		$opt_res = $dbCustom->getResult($db,$sql);				
		if($opt_res->num_rows > 0){
			$included_items_array[$i] = $all_item_v;
			$possible_items_array[$i] = $all_item_v;
			$i++;
		}
	}
	
	//$test = "num_items afetr reset:   ".count($included_items_array)."       all items:".count($all_item_array)."            selectors  ".$selector_count;

}else{
	
	$i = 0;
	foreach($all_item_array as $all_item_v){
	
		$in = 1;
			
		foreach($all_attr_array as $all_attr_v){
			if($all_attr_v['opt_id'] > 0){		
				$sql = "SELECT item_to_opt_id 
					FROM  item_to_opt
					WHERE item_id = '".$all_item_v."'				 
					AND opt_id = '".$all_attr_v['opt_id']."'";
				$opt_res = $dbCustom->getResult($db,$sql);				
				if($opt_res->num_rows == 0){
					$in = 0;
				}
			}
			if(!$in){
				break;	
			}
		}
		
		if($in){
			$included_items_array[$i] = $all_item_v;
			$i++;
		}		
	}


	$i = 0;
	foreach($all_item_array as $all_item_v){
		$in = 1;
		foreach($all_attr_array as $all_attr_v){
			if($all_attr_v['opt_id'] > 0){		
				$sql = "SELECT item_to_opt_id 
					FROM  item_to_opt
					WHERE item_id = '".$all_item_v."'				 
					AND (opt_id = '".$all_attr_v['opt_id']."' OR opt_id = '".$left_opt."')";
				$opt_res = $dbCustom->getResult($db,$sql);				
				if($opt_res->num_rows == 0){
					$in = 0;
				}
			}
			if(!$in){
				break;	
			}
		}
		if($in){
			$possible_items_array[$i] = $all_item_v;
			$i++;
		}
	}
	

}


	$included_items_array = array_unique($included_items_array);
	$possible_items_array = array_unique($possible_items_array);


	//$test = count($included_items_array);

	$i = 0;
	foreach($all_attr_array as $all_attr_v){	
		
		//if($i < $selector_count && $all_attr_v['opt_id'] > 0){
		if($i <= $selector_count){
			$return_attributes_array[$i]['attr_id'] = $all_attr_v['attr_id'];
			$return_attributes_array[$i]['opt_id'] = $all_attr_v['opt_id'];
			$return_attributes_array[$i]['attr_name'] = $all_attr_v['attr_name'];
			
			$i++;  
		}
		
	}
	
	

	// get the options for each return attribute
	$i = 0;
	foreach($return_attributes_array as $return_attributes_v){
		if($i == 0){
			// all items options stay in first selector
			foreach($all_item_array as $all_item_v){
			
				$sql = "SELECT opt.opt_id, opt.opt_name 
						FROM  opt, item_to_opt
						WHERE item_to_opt.opt_id = opt.opt_id
						AND item_to_opt.item_id = '".$all_item_v."'		
						AND opt.attribute_id = '".$main_attr_id."'";
				$res = $dbCustom->getResult($db,$sql);
				if($res->num_rows > 0){
					$obj = $res->fetch_object();
					$return_opt_array[$i]['attr_id'] = $main_attr_id;
					$return_opt_array[$i]['opt_id'] = $obj->opt_id;
					$return_opt_array[$i]['opt_name'] = $obj->opt_name;
					
					$i++; 
				}
			}
		
			
		}else{
			
			
			foreach($included_items_array as $possible_items_v){
			//foreach($possible_items_array as $possible_items_v){
		
				
				$sql = "SELECT opt.opt_id, opt.opt_name 
						FROM  opt, item_to_opt
						WHERE item_to_opt.opt_id = opt.opt_id
						AND item_to_opt.item_id = '".$possible_items_v."'		
						AND opt.attribute_id = '".$return_attributes_v['attr_id']."'";
				$res = $dbCustom->getResult($db,$sql);
				if($res->num_rows > 0){
					$obj = $res->fetch_object();
					$return_opt_array[$i]['attr_id'] = $return_attributes_v['attr_id'];
					$return_opt_array[$i]['opt_id'] = $obj->opt_id;
					$return_opt_array[$i]['opt_name'] = $obj->opt_name;
					$i++; 
				}
			}
		}
	}


if(count($return_opt_array) > 1){
	$return_opt_array = multi_unique($return_opt_array);
}

$attr_opt_count_array = array();
$i = 0;
foreach($all_attr_array as $all_attr_v){
	
	$attr_opt_count_array[$i]['attr_id'] = $all_attr_v['attr_id'];
	$attr_opt_count_array[$i]['opt_count'] = 0; 
	foreach($return_opt_array as $return_opt_v){	
		if($all_attr_v['attr_id'] == $return_opt_v['attr_id']){			
			
			$attr_opt_count_array[$i]['opt_count']++;
		
		}
	}
	
	$i++;
	
}



$block = '';
	
$block .= "<form id='add_to_cart_form' name='add_to_cart_form' method='post' enctype='multipart/form-data'>";

$i = 0;
foreach($all_attr_array as $all_attr_v){	

	$selector_hide = 0;

	if($i >= $selector_count){
		$selector_hide = 1;	
				
	}
	
				
	if($i > 1){
		
		if(isset($attr_opt_count_array[$i]['attr_id'])){
			if($attr_opt_count_array[$i]['attr_id'] == $all_attr_v['attr_id']){
				
				if($attr_opt_count_array[$i]['opt_count'] < 1){
					$selector_hide = 1;		
				}	
			}			
		}		
	}
		
		
	if($selector_hide){
		$block .= "<div class='hidden' style='height: 1px;'>";			
	}else{
		$block .= "<div style='margin-bottom: 4px; margin-right: 8px; float:left;'>";	
	}
		
		

	
	
	
	//if($r > 1){
		$block .= "<div class='selector_label'>Select ".$all_attr_v['attr_name']."</div>";
		$block .= "<select class='selector' id='".$all_attr_v['attr_id']."' name='attr_".$all_attr_v['attr_id']."' onchange='change_attrs(".$all_attr_v['attr_id'].");' >";		
		$block .= "<option value='0'>Select</option>";
		foreach($return_opt_array as $return_opt_v){
			if($return_opt_v['attr_id'] == $all_attr_v['attr_id']){
				
				$sel = ($all_attr_v['opt_id'] == $return_opt_v['opt_id']) ? 'selected' : '';
				
				$block .= "<option value='".$return_opt_v['opt_id']."' $sel>".$return_opt_v['opt_name']."</option>";	
					
			}
		}
			
		$block .= "</select>";
	//}
	
	
	$block .= "</div>";

	$i++;

}

	
$block .= "</form>";

$block .= "<div style='clear:both;'></div>";
$block .= "<div style='float:left; margin-top:2.5%; color:red; font-size:14px;'>*To change your selection, please click the reset button.<br />";
$block .= "<a class='btn' href='#' onclick='re_load(0)'>Reset</a>";
$block .= "</div>";
$block .= "<div style='clear:both;'></div>";

$num_items = count($included_items_array);
$price_and_btn_data['price_data'] = '';
$price_and_btn_data['btn_data'] = '';
$heading = '';
$pic_str = '';
$ret_item_id = 0;
if(count($included_items_array) == 1){
	$ret_item_id = $included_items_array[0];	
	$price_and_btn_data = get_details_price_and_btn($ret_item_id, $deviceType);
	$heading = get_details_heading($ret_item_id);
	$pic_str = get_details_pic($ret_item_id, $deviceType);
}

//echo $test;

//$ret_item_id = print_r($included_items_array);


	
	$returnData = json_encode(array(
						"num_items"=>$num_items,
						"ret_item_id"=>$ret_item_id,
						"block"=>$block,
						"price_data"=>$price_and_btn_data['price_data'],
						"btn_data"=>$price_and_btn_data['btn_data'],
						"heading"=>$heading,
						"pic_str"=>$pic_str,
						"test"=>$test
						));	

		
	echo $returnData;

	
	//echo $block;	




?>