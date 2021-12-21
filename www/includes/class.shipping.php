<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root."/includes/class.shopping_cart.php"); 	

//require_once($real_root."/includes/class.shopping_cart.php"); 	


class Shipping {
	
	public $from_zip = '';						
	public $from_state = '';						
	public $from_country = '';						
	public $ups_access = '';						
	public $ups_user = '';		
	public $ups_pass = '';		
	public $ups_account = '';		
	public $usps_user = '';		
	public $fedex_account = '';		
	public $fedex_meter = '';		
	
	function __construct() {
		
		if(isset($_SESSION['fedex_account'])){

			$this->from_zip = $_SESSION['from_zip'];						
			$this->from_state = $_SESSION['from_state'];						
			$this->from_country = $_SESSION['from_country'];						
			$this->ups_access = $_SESSION['ups_access'];						
			$this->ups_user = $_SESSION['ups_user'];		
			$this->ups_pass = $_SESSION['ups_pass'];		
			$this->ups_account = $_SESSION['ups_account'];		
			$this->usps_user = $_SESSION['usps_user'];		
			$this->fedex_account = $_SESSION['fedex_account'];		
			$this->fedex_meter = $_SESSION['fedex_meter'];		
			
		}else{
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT *
					FROM ship_credentials 
					WHERE profile_account_id = '1'";
					//".$_SESSION['profile_account_id']."
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				
				$this->from_zip = $_SESSION['from_zip'] = $object->from_zip;						
				$this->from_state = $_SESSION['from_state'] = $object->from_state;						
				$this->from_country = $_SESSION['from_country'] = $object->from_country;						
				$this->ups_access = $_SESSION['ups_access'] = $object->ups_access;						
				$this->ups_user = $_SESSION['ups_user'] = $object->ups_user;		
				$this->ups_pass = $_SESSION['ups_pass'] = $object->ups_pass;		
				$this->ups_account = $_SESSION['ups_account'] = $object->ups_account;		
				$this->usps_user = $_SESSION['usps_user'] = $object->usps_user;		
				$this->fedex_account = $_SESSION['fedex_account'] = $object->fedex_account;		
				$this->fedex_meter = $_SESSION['fedex_meter'] = $object->fedex_meter;		
				
					
			}
		
			
		}
		
		
	}
	

	function getShipType(){
		
		if(!isset($_SESSION['ship_type'])){
			
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT is_shipping_charges  
					FROM profile_account
					WHERE id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			$s_obj = $result->fetch_object();
			if(!$s_obj->is_shipping_charges){

				$_SESSION["ship_type"] = "none";
				
			}else{

				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT type_name  
						FROM ship_type 
						WHERE active = 1
						AND profile_account_id ='".$_SESSION['profile_account_id']."'";
						//".$_SESSION['profile_account_id']."
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){
					$st_obj = $result->fetch_object();
					$_SESSION["ship_type"] = trim($st_obj->type_name);	
				}else{
					$_SESSION["ship_type"] = "carrier";
				}
			}
			
		}
		
		
		
		return $_SESSION['ship_type'];
	}
		
	function getShipCarriers(){
		if(!isset($_SESSION['ship_carrier_ids'])){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT ship_carrier_id  
					FROM ship_carrier
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					AND active = '1'" ;
			$result = $dbCustom->getResult($db,$sql);			
			if(!$result){
				// no shipping carriers active
				$_SESSION["ship_carrier_ids"][0] = 'none';
			}else{
				$i = 0;
				while ($row = $result->fetch_object()){
					$_SESSION['ship_carrier_ids'][$i] = $row->ship_carrier_id;
					$i++;
				}

			}
		}
		return $_SESSION['ship_carrier_ids'];
	}


	
	function getFlatPerItem($item_count)
	{
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT flat_rate 
				FROM ship_type
				WHERE type_name = 'flat_per_item'
				AND profile_account_id ='".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$rate = $object->flat_rate*$item_count;
			return $rate;
		}
		
		return -1;		
		
	}




	function getRateByPercent($total)
	{
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT percent_rate
				FROM ship_type
				WHERE type_name = 'percent'
				AND profile_account_id ='".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$rate = ($object->percent_rate/100)*$total;
			
			return $rate;
		}
		
		return -1;
		
	}
	
	function getFlatPerOrder(){
		
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT flat_rate
				FROM ship_type
				WHERE type_name = 'flat_per_order'
				AND profile_account_id ='".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->flat_rate;	
		}
		
		return -1;
		
	}

	function getUniqueFlatPerItem(){
		
		
		$cart = new ShoppingCart;
		$cart_contents_array = $cart->getContents();
		$rate = 0;
		foreach($cart_contents_array as $val) {
			$rate += $val['shipping_flat_charge'];
			//$rate += 1;
		}
		
		return $rate;
	
	}


	function getFlatPerPriceRange($amount)
	{
		
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);

				
		$sql = "SELECT low, high, charge 
				FROM ship_flat_charge
				WHERE active = '1' 
				AND profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY high";
		$result = $dbCustom->getResult($db,$sql);		
		
		while($row = $result->fetch_object()){
			if(($amount >= $row->low) && ($amount <= $row->high)){
				return $row->charge;
			}
		}
		
		
				
		
		return -1;
		
		
		/* alt
		
							$sql = "SELECT charge 
									FROM ship_flat_charge
									WHERE low < '".$sub_total."'
									AND high >= '".$sub_total."'
									AND active = '1'
									AND profile_account_id = '".$_SESSION['profile_account_id']."'";
							$r_res = $dbCustom->getResult($db,$sql);
							
							
		*/
		
			
	}


	function getNonCarrierRate(){
		
		$shipping_cost = 0;
		$cart = new ShoppingCart;
		
		
		// we never charge shipping for tool designs
		$amount = $cart->total_price;
				
		
		if($this->getThreshold() >= $amount){
			
			if($this->getShipType() == 'percent'){
				// we don't include tool designs
				$shipping_cost = $this->getRateByPercent($amount);	
			}
			
			if($this->getShipType() == "flat_per_order"){											
				$shipping_cost = $this->getFlatPerOrder();							
			}
			
			if($this->getShipType() == 'flat_per_item'){			
				$cart = new ShoppingCart;
				$shipping_cost = $this->getFlatPerItem($cart->getItemCount());
			}		
			
			if($this->getShipType() == 'flat_per_price_range'){			
				$shipping_cost = $this->getFlatPerPriceRange($amount);
			}
							
			if($this->getShipType() == 'unique_flat_per_item'){
				$shipping_cost = $this->getUniqueFlatPerItem();				
			}
			
		}

		return $shipping_cost;
		
	}


	function getShippingCostFromCarrier($ship_method_id = 0){
		
		$ret = 0;
		
		foreach($_SESSION['return_rates_array'] as $return_rates_v){
			
			if($return_rates_v['ship_method_id'] == $ship_method_id){
				$ret = 	$return_rates_v['rate'];
			}
		}
		return $ret;
	}


	function resetCarrierRates($weight = 6, $ship_rate_zip = 97239, $ship_rate_state = "OR"){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(CART_DATABASE);

			$services = array();


			$_SESSION['ship_rate_zip'] = $ship_rate_zip;
			$_SESSION['ship_rate_state'] = $ship_rate_state;
			$_SESSION['return_rates_array'] = array();

			$sql = "SELECT name
					,ship_carrier_id 
					FROM ship_carrier 
					WHERE active = '1'
					AND profile_account_id ='1'";
					//".$_SESSION['profile_account_id']."
			$result = $dbCustom->getResult($db,$sql);
			
			$is_fedex = 0;
			
			while($row = $result->fetch_object()){
				
				$sql = "SELECT name 
							,code
						FROM ship_method 
						WHERE ship_carrier_id = '".$row->ship_carrier_id."'
						AND active = '1'";
				$res = $dbCustom->getResult($db,$sql);
				
				if($row->name == 'fedex') $is_fedex = 1;
				
				while($sm_row = $res->fetch_object()){
					$services[$row->name][$sm_row->code] = $sm_row->name;
				}
			}
	
			$config = array(
			
				'is_fedex' => $is_fedex,
			
				// Services
				'services' => $services,
				// Weight
				'weight' => $weight, // Default = 1
				'weight_units' => 'lb', // lb (default), oz, gram, kg
				// Size
				'size_length' => 5, // Default = 8
				'size_width' => 6, // Default = 4
				'size_height' => 3, // Default = 2
				'size_units' => 'in', // in (default), feet, cm
				// From
				'from_zip' => $this->from_zip, 
				'from_state' => $this->from_state, // Only Required for FedEx
				'from_country' => 'US', //$_SESSION["from_country"],
				// To
				'to_zip' => $_SESSION['ship_rate_zip'],
				'to_state' => $_SESSION['ship_rate_state'], // Only Required for FedEx
				'to_country' => 'US',
				
				// Service Logins
				'ups_access' => $_SESSION['ups_access'], // UPS Access License Key
				'ups_user' => $_SESSION['ups_user'], // UPS Username  
				'ups_pass' => $_SESSION['ups_pass'], // UPS Password  
				'ups_account' => $_SESSION['ups_account'], // UPS Account Number
				'usps_user' => '', // USPS User Name
				'fedex_account' => $_SESSION['fedex_account'], // FedEX Account Number
				'fedex_meter' => $_SESSION['fedex_meter'] // FedEx Meter Number 
		

				/*
				'ups_access' => '4C944D59536E9478', // UPS Access License Key
				'ups_user' => 'Closets2go', // UPS Username  
				'ups_pass' => 'Ctg123456', // UPS Password  
				'ups_account' => '7T93T5', // UPS Account Number
				'usps_user' => '', // USPS User Name
				'fedex_account' => '', // FedEX Account Number
				'fedex_meter' => '' // FedEx Meter Number 
				*/
			);
	
			require_once('ShippingCalculator.php');
			$ship_calculator = new ShippingCalculator($config);
			$rates = $ship_calculator->calculate();		
			
			$i = 0;
			if(count($rates) > 0){
				foreach($rates as $company => $method_names) {
					foreach($method_names as $method_name => $rate){
						if($rate != ''){
							
							$_SESSION['return_rates_array'][$i]['ship_method_id'] = 99;
							$_SESSION['return_rates_array'][$i]['company'] = strtoupper(trim($company));	
							$_SESSION['return_rates_array'][$i]['method_name'] = trim($services[$company][$method_name]);
							$_SESSION['return_rates_array'][$i]['rate'] = $rate;
							$i++;
						}
					}
				}
			}
			
			
			
			$sql = "SELECT ship_method.ship_method_id, ship_method.code, ship_method.name AS method_name  
					FROM ship_method, ship_carrier 
					WHERE ship_method.ship_carrier_id = ship_carrier.ship_carrier_id
					AND ship_carrier.active = '1'
					AND ship_method.active = '1'
					AND ship_carrier.profile_account_id ='1'
					ORDER BY ship_method.ship_carrier_id, ship_method.ship_method_id";
					//".$_SESSION['profile_account_id']."
			$result = $dbCustom->getResult($db,$sql);			
			while($row = $result->fetch_object()) {
					
				foreach($_SESSION['return_rates_array'] as $k=>$return_rates_v){
					if($return_rates_v['method_name'] == $row->method_name){
						$_SESSION['return_rates_array'][$k]['ship_method_id'] = $row->ship_method_id;
					}
				}
			}
	
		
		
		return $_SESSION['return_rates_array'];


	}
	
	
	function getSingleRateFromFedex($weight = 3, $from_zip = 97035, $from_state = 'OR', $to_zip = 33141, $to_state = 'FL'){
		
		$the_code['FEDEX_GROUND'] = 'Ground';  
		$the_service['fedex'] = $the_code;
	
		$config = array(
				'is_fedex' => 1,
				'services' => $the_service,
				'weight' => $weight,
				'weight_units' => 'lb',
				'size_length' => 5,
				'size_width' => 6,
				'size_height' => 3,
				'size_units' => 'in',
				'from_zip' => $from_zip, 
				'from_state' => $from_state,
				'from_country' => 'US',
				'to_zip' => $to_zip,
				'to_state' => $to_state,
				'to_country' => 'US',
				'fedex_account' => $_SESSION['fedex_account'],
				'fedex_meter' => $_SESSION['fedex_meter'] 
		);
	
		require_once('ShippingCalculator.php');
		$ship_calculator = new ShippingCalculator($config);
		$rate = $ship_calculator->calculate();		
		
		return $rate['fedex']['FEDEX_GROUND'];

	}


	function getMethodName($ship_method_id = 0){
				
		if(!isset($_SESSION['ship_method_id'])) $_SESSION['ship_method_id'] = 0;
		if($ship_method_id == 0) $ship_method_id = $_SESSION['ship_method_id'];
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
	
		$sql = "SELECT ship_method.name  
				FROM ship_method 
				WHERE ship_method.ship_method_id = '".$ship_method_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->name;
		}else{
			return '';
		}
	}



	function getThreshold(){
				
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
	
		$sql = "SELECT min_price  
				FROM ship_free_condition 
				WHERE active = '1' 
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			return $object->min_price;
		}else{
			return 9999999;
		}		
	}

	
	function isBelowThreshold(){

		$cart = new ShoppingCart;
		$amount = $cart->total_price;
		
		
		
		return ($amount < $this->getThreshold()) ? 1 : 0;

	}



	function getCarrierRates($weight = 6, $ship_rate_zip = 97239, $ship_rate_state = 'OR'){
		
		
		if(!isset($_SESSION['return_rates_array'])){
		
			$_SESSION['return_rates_array'] = $this->resetCarrierRates($weight, $ship_rate_zip, $ship_rate_state);
		
		}
		
		return $_SESSION['return_rates_array'];
		
	}




}




?>
