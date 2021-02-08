<?php

class Discount {

	function getItemDiscount($item_id) {

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$it = new ShoppingCart;
		$price = $it->getItemPrice($item_id);	
		
		$sql = "SELECT amount_off, percent_off 
				FROM item
				WHERE item_id = '".$item_id."'
				";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$item_discount = 0;
			if($object->amount_off > $object->percent_off){
				$item_discount = $object->amount_off;			
			}else{
				$item_discount = $price * ($object->percent_off/100);
			}
		}else{
			$item_discount = 0;
		}
		return $item_discount;		
	
	} 
	

	function getGlobalDiscount($amount) {

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$ts = time();
		$gd = 0;

		$sql = "SELECT percent_off
					,amount_off
					,if_greater_than
					,if_less_than
					,can_use_with_other_discounts
				FROM global_discount 
				WHERE type = 'discount'
				AND can_use_with_other_discounts = '1'
				AND if_greater_than < '".$amount."'
				AND if_less_than > '".$amount."'
				AND when_active <= '".$ts."' 
				AND (when_expired > '".$ts."' OR when_expired = '0')
				AND profile_account_id ='".$_SESSION['profile_account_id']."' 
				AND hide = '0'";
		$result = $dbCustom->getResult($db,$sql);		
		$object = $result->fetch_object();
		
		if($result->num_rows){
				
			if($object->amount_off > 0){
				$gd = $object->amount_off;	
			}else{
				$gd = $amount * $object->percent_off/100;
			}
		}
		
		return $gd;

	} 
	
	
	
}

?>
