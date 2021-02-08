<?php

class Module {

	function resetSasFeeAmount($profile_account_id){
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT basic_fee FROM sas_fee";
		$result = $dbCustom->getResult($db,$sql);
		
		$object = $result->fetch_object();
		$fee = $object->basic_fee;
		
		$sql = "SELECT module.id, module.fee  
				FROM profile_account_to_module, module
				WHERE profile_account_to_module.module_id = module.id
				AND hide = '0'
				AND profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		while($row = $result->fetch_object()){
			$fee += $row->fee;
		}
		
		$sql = "UPDATE profile_account
				SET braintree_recurring_billing_amount = '".$fee."'  
				WHERE id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);

		return $fee;
		
	}
	
	
	
	function getSasFeePayType($profile_account_id){
		
		$ret = '';
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT fee_payment_method 
				FROM profile_account
				WHERE id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows){
			$object = $result->fetch_object();
			$ret = $object->fee_payment_method;
		}
		
		return $ret;
		
	}
	
	
	
	
	function hasCustomPaymentProcessorModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT id
				FROM profile_account_to_module
				WHERE module_id = '3'
				AND profile_account_id = '".$profile_account_id."'";
		if($require_active) $sql.= " AND hide = '0'";		
				
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$ret = 1;
		}
	
		return $ret;
	}
	
	
	function hasAskModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT id
				FROM profile_account_to_module
				WHERE module_id = '2'
				AND profile_account_id = '".$profile_account_id."'";
		if($require_active) $sql.= " AND hide = '0'";		
	
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$ret = 1;
		}
	
		return $ret;
	}
	
	
	function hasShoppingCartModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;
		
		
		// temporary
		//if(!$_SESSION['costco']){
			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT id
					FROM profile_account_to_module
					WHERE module_id = '1'
					AND profile_account_id = '".$profile_account_id."'";
			if($require_active) $sql.= " AND hide = '0'";		
		
		
			$result = $dbCustom->getResult($db,$sql);			
			if($result->num_rows > 0){
				$ret = 1;
			}
		//}
		
	
		return $ret;
		
		
	}

	function hasDesignToolModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;	


		// temporary
		//if(!$_SESSION['costco']){
			$dbCustom = new DbCustom();
				
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT id
					FROM profile_account_to_module
					WHERE module_id = '5'
					AND profile_account_id = '".$profile_account_id."'";
			if($require_active) $sql.= " AND hide = '0'";		
			$result = $dbCustom->getResult($db,$sql);			
			
			if($result->num_rows > 0){
				$ret = 1;
			}
		//}
		
		return $ret;
	}


	function hasDesignServicesModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;	
			$dbCustom = new DbCustom();
				
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT id
					FROM profile_account_to_module
					WHERE module_id = '6'
					AND profile_account_id = '".$profile_account_id."'";
			if($require_active) $sql.= " AND hide = '0'";		
			$result = $dbCustom->getResult($db,$sql);			
			
			if($result->num_rows > 0){
				$ret = 1;
			}
		
		return $ret;
	}


	function hasIframeModule($profile_account_id, $require_active = 1)
	{
		$ret = 0;	
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT id
				FROM profile_account_to_module
				WHERE module_id = '4'
				AND profile_account_id = '".$profile_account_id."'";
		if($require_active) $sql.= " AND hide = '0'";		
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$ret = 1;
		}	
		return $ret;
	}



	function hasSeoModule($profile_account_id)
	{
		// This is available to all. Not an addon
		return 1;
	}


}

?>
