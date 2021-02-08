<?php

class CustomCode {

	public $head_block;
	public $body_block;

	public function __construct() {
		
		if(!isset($_SESSION['custom_code_head_block'])){
			
			$dbCustom = new DbCustom();
					
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);			
			$sql = "SELECT head_block, body_block  
						FROM custom_code 
						WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
						
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['custom_code_head_block'] = trim(stripslashes($object->head_block));
				$_SESSION['custom_code_body_block'] = trim(stripslashes($object->body_block)); 
			}else{
				$_SESSION['custom_code_head_block'] = '';
				$_SESSION['custom_code_body_block'] = ''; 				
			}
		}
				
		$this->head_block = $_SESSION['custom_code_head_block'];
		$this->body_block = $_SESSION['custom_code_body_block'];		
	}

}

?>
