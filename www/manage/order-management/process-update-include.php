<?php




function get_when($order_state_id, $order_id){

	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT when_complete 
			FROM order_to_order_state
			WHERE order_id	= '".$order_id."'
			AND order_state_id = '".$order_state_id."'";					
	$result = $dbCustom->getResult($db,$sql);	
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->when_complete + 1;	
	}else{
		return 0;	
	}
	
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['done_state'])){

	$order_id = (isset($_POST['order_id']))? $_POST['order_id'] : 0; 
	$done_states = (isset($_POST['done_state']))? $_POST['done_state'] : array();
	$ts = time();
	$sql = "SELECT order_state_id 
			FROM order_state
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";					
	$result = $dbCustom->getResult($db,$sql);	
	
	$i = 0;
	$tmp_array[$i]['order_state_id'] = 0;
	$tmp_array[$i]['when_complete'] = 0;
	while($row = $result->fetch_object()){
		$tmp_array[$i]['order_state_id'] = $row->order_state_id;
		$tmp_array[$i]['when_complete'] = 0;
		if(in_array($row->order_state_id, $done_states)){
			$when = get_when($row->order_state_id, $order_id);
			//$tmp_array[$i]['order_state_id'] = $row->order_state_id;

			if($when > 0){
				$tmp_array[$i]['when_complete'] = $when;
			}else{
				$tmp_array[$i]['when_complete'] = 2;
			}
		}
		$i++;
	}


	$sql = "DELETE FROM order_to_order_state
			WHERE order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);
	

	foreach($tmp_array as $v){
		
		
		//echo 'order_state_id'.$v['order_state_id'];
		
		if($v['when_complete'] > 0){
			
			$when = ($v['when_complete'] > 2) ? $v['when_complete'] : $ts;
			
			$sql = "INSERT INTO order_to_order_state
					(order_id, order_state_id, when_complete)
					VALUES
					('".$order_id."', '".$v['order_state_id']."', '".$when."')";

			$res = $dbCustom->getResult($db,$sql);

		}
		
	}
	
}

?>