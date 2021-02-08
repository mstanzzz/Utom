<?php

class Coupon {

	function getCoupon($code,$amount){

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ts = time();
		$gd = 0;

		$type = 'coupon';
		
		//	AND can_use_with_other_discounts = '1'
		// ,can_use_with_other_discounts


		$stmt = $db->prepare("SELECT percent_off
						,amount_off
						,if_greater_than
						,if_less_than
					FROM global_discount				
					WHERE coupon_code = ?
					AND type = ? 
					AND if_greater_than < ?
					AND if_less_than > ?
					AND when_active <= ?
					AND (when_expired > ? OR when_expired = ?)
					AND hide = ?
					AND profile_account_id = ?"); 
			
		if(!$stmt->bind_param("ssddiiiii", $code, $type, $amount, $amount, $ts, $ts, 0, 0, $_SESSION['profile_account_id'])){


		}else{
			$stmt->execute();
			
			$stmt->bind_result($percent_off
						,$amount_off
						,$if_greater_than
						,$if_less_than);

			if($stmt->fetch()){

				if($amount_off > 0){
					$gd = $amount_off;	
				}else{
					$gd = $amount * $percent_off/100;
				}

			}


		}
		
		$stmt->close();

		return $gd;
	}


	function coupon_exists($code){
		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ret = 0;
		
		$stmt = $db->prepare("SELECT global_discount_id
					FROM global_discount									
					WHERE coupon_code = ?
					AND profile_account_id = ?"); 

		if(!$stmt->bind_param("si", $code, $_SESSION['profile_account_id'])){

			//echo $stmt->error;
			echo 'Error '.$db->error;

		}else{

			$stmt->execute();			
			$stmt->bind_result($global_discount_id);
			if($stmt->fetch() != NULL){
				$ret = 1;	
			}

			
		}

		return $ret;
	}

	function getCouponArray($code,$amount){

		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ts = time();
		$z = 0;
		$gd[0] = 0;
		$gd[1] = '';
		$gd[2] = '';

		$type = 'coupon';

		//	AND can_use_with_other_discounts = '1'
		// ,can_use_with_other_discounts

		$stmt = $db->prepare("SELECT percent_off
						,amount_off
						,name
					FROM global_discount				
					WHERE coupon_code = ?
					AND type = ? 
					AND if_greater_than < ?
					AND if_less_than > ?
					AND when_active <= ?
					AND (when_expired > ? OR when_expired = ?)
					AND hide = ?
					AND profile_account_id = ?"); 
			

		if(!$stmt->bind_param("ssddiiiii", $code, $type, $amount, $amount, $ts, $ts, $z, $z, $_SESSION['profile_account_id'])){

			//echo $stmt->error;
			echo 'Error '.$db->error;

		}else{
			$stmt->execute();
			
			$stmt->bind_result($percent_off
						,$amount_off
						,$name);

			
			if($stmt->fetch() == NULL){			
				
				if(!$this->coupon_exists($code)){
					$gd[2] = 'There is no coupon with this code';	
				}else{
				
					$gd[2] = 'This order does not meet the requirements of this coupon code';
				}
			}
			
			
			//if($stmt->fetch()){

			if(isset($name)){
				if($amount_off > 0){
					$gd[0] = $amount_off;
					$gd[1] = $name;	
				}else{
					$gd[0] = $amount * $percent_off/100;
					$gd[1] = $name;
				}
				
				$gd[2] = 'Coupon Applied';

			}
			


		}
		
		$stmt->close();

		
		
		



		return $gd;

	}
	
	/*
	function hasBeenUsed($code, $email){

		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$ts = time();
		$look_back = $ts - 365*24*60*60; 
		
		$sql = "SELECT order_date
					FROM ctg_order				
					WHERE coupon_code = '".$code."'
					AND (billing_email = '".$email."' OR shipping_email = '".$email."')
					AND order_date > '".$look_back."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'"; 

		$res = $dbCustom->getResult($db,$sql);
		
		return $res->num_rows;
		
		
	}
	*/

	function hasBeenUsed($code, $customer_id){

		$dbCustom = new DbCustom();		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$ts = time();
		$look_back = $ts - 365*24*60*60; 
		
		$sql = "SELECT order_date
					FROM ctg_order				
					WHERE coupon_code = '".$code."'
					AND customer_id = '".$customer_id."'
					AND order_date > '".$look_back."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'"; 

		$res = $dbCustom->getResult($db,$sql);
		
		return $res->num_rows;
		
		
	}

	
	
	
	
	
}

?>
