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


function get_orders(){

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);


			$sql = "SELECT order_id
						,order_date
						,order_type
						,billing_name
						,shipping_name
						,total 
					FROM ctg_order
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";

			$result = $dbCustom->getResult($db,$sql);
			$i = 0;
			while($row = $result->fetch_object()){
				$long_array[$i]['order_id'] = $row->order_id;
				$long_array[$i]['order_date'] = $row->order_date;
				$long_array[$i]['order_type'] = $row->order_type;
				$long_array[$i]['billing_name'] = $row->billing_name;
				$long_array[$i]['shipping_name'] = $row->shipping_name;
				$long_array[$i]['total'] = $row->total;
				$i++;
				
				if($i > 500){
					break;	
				}
			}


	//echo json_encode($long_array);


	return $long_array; 

}


$ret_array = get_orders();

$block = '';
foreach($ret_array as $val){

	$block .= $val['order_id'].",";	
	$block .= $val['order_date'].",";	
	$block .= $val['order_type'].",";	
	$block .= $val['billing_name'].",";	
	$block .= $val['shipping_name'].",";	
	$block .= $val['total'].",";	
	
}

echo $block;

//echo json_encode($ret_array);







?>