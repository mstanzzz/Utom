<?php

// SEO is no longer an addon. It will work for all saas customers.

class Order {



	public function getMaxOrderState($order_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT order_state.name    
		FROM order_to_order_state, order_state																		 
		WHERE when_complete > '0' 
		AND order_state.order_state_id = (SELECT MAX(order_state_id)
										FROM order_to_order_state 
										WHERE order_id = '".$order_id."')";
	
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 
			return trim($object->name);	
		}
		
		return 'pending';
		
	}
	
	
	public function getOrderArray($customer_id, $return_count = 0, $search_order_num = '', $date_from = '', $date_to = ''){
		
		$ret_array = array();
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT order_id, order_date
				FROM ctg_order
				WHERE customer_id = '".$customer_id."'";
		
		
		//echo $date_from;
		//exit;
		
		
		if($date_from != ''){		
			$sql .= " AND order_date >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND order_date <= '".$date_to."'";
		}		
		
		if(is_numeric($search_order_num)){				
			$sql .= " AND order_id = '".$search_order_num."'";
		}
		
				
		$sql .= " ORDER BY order_id DESC";
				
		if($return_count > 0){		
			$sql .= " LIMIT 0, $return_count";
		}
		$result = $dbCustom->getResult($db,$sql);
		$i = 0;		
		while($row = $result->fetch_object()){
			$ret_array[$i]['order_id'] = $row->order_id;
			$ret_array[$i]['order_date'] = $row->order_date;
			
			$sql = "SELECT order_state.name, order_state.order_state_id, when_complete    
			FROM order_to_order_state, order_state																		 
			WHERE when_complete > '0' 
			AND order_state.order_state_id = (SELECT MAX(order_state_id)
											FROM order_to_order_state 
											WHERE order_id = '".$row->order_id."')";		
			$res = $dbCustom->getResult($db,$sql);
			if($res->num_rows > 0){
				$obj = $res->fetch_object(); 
				$order_state_name = $obj->name;
				$order_state_id = $obj->order_state_id;
				$when_complete = $obj->when_complete;
			}else{
				$order_state_name = 'pending';
				$order_state_id = 0;
				$when_complete = 0;
				
			}
			$ret_array[$i]['order_state_name'] = $order_state_name;
			$ret_array[$i]['order_state_id'] = $order_state_id;
			$ret_array[$i]['when_complete'] = $when_complete;
			
			$i++;			
		}		
		return $ret_array;
	}


	/*
	public function get____() {
		
			
			if($stmt = $db->prepare("SELECT title
										,keywords
										,description
										,costco_title
										,costco_keywords
										,costco_description
										,page_name
										,page_heading
										,added_page_id
										,template
										,canonical
						FROM page_seo 
						WHERE seo_name = ? 
						AND profile_account_id = ?")){
			
			$stmt->bind_param('si', $slug, $_SESSION['profile_account_id']);
						
			$stmt->execute();
			$stmt->bind_result($title
							,$keywords
							,$description
							,$costco_title
							,$costco_keywords
							,$costco_description
							,$page_name
							,$page_heading
							,$added_page_id
							,$template
							,$canonical);
							
				$fetch = 1;			
		}
	}
	*/
		
}

?>
