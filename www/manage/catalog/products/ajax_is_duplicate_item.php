<?php
require_once("../../includes/config.php"); 

$attr_opts = (isset($_GET["attr_opts"]))?	$_GET["attr_opts"] : '';
$parent_item_id = (isset($_GET["parent_item_id"]))?	$_GET["parent_item_id"] : 0;


$ct_out = explode("---",$attr_opts);
array_pop($ct_out);


$db = $dbCustom->getDbConnect(CART_DATABASE);	
$sql = "SELECT item_id
		FROM item
		WHERE parent_item_id = '".$parent_item_id."'";
$res = $dbCustom->getResult($db,$sql);

$j = 0;
$a_item_array[$j] = $parent_item_id;
while($a_item_row = $res->fetch_object){
	$j++;	
	$a_item_array[$j] = $a_item_row->item_id;
}




$included_items_array = array();
$i = 0;
$j = 0;
$has_options = 0;
$attr_count = count($ct_out);

//echo $attr_count;

// WHAT IF an item has some attributes not selected


foreach($a_item_array as $a_item_v){

	foreach($ct_out as $ct_out_v){
		
		$ct_in = explode("|",$ct_out_v);		
	
		$sql = "SELECT opt.opt_id 
				FROM  opt, item_to_opt
				WHERE item_to_opt.opt_id = opt.opt_id
				AND item_to_opt.item_id = '".$a_item_v."'					 
				AND opt.opt_id = '".$ct_in[1]."' 
				";
						
		$res = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows > 0){
			//$opt_obj = $res->fetch_object();
			$j++;
		}
	}
	
	if($j == $attr_count){
		$included_items_array[$i] = $a_item_v;
		$i++;		
	}
	
	$j = 0;
}



if(count($included_items_array) > 1){
	$included_items_array = array_unique($included_items_array);	
}

//print_r($included_items_array);

//exit;

//$included_items_array = array_unique($included_items_array);
 
$ret = "<";
if(count($included_items_array) > 0){
	$ret = ">";			
}

echo $ret;








?>


