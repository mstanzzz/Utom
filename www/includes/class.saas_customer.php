<?php
class SaasCustomer{

    public $this_profile_account_id;
	public $company;
	public $phone;
	public $email;
	
	 
	
	
	function __construct($this_profile_account_id = 0){
		
		if(!$this_profile_account_id){
			$this->this_profile_account_id = $_SESSION['profile_account_id'];
		}else{
			$this->this_profile_account_id = $this_profile_account_id;
		}
		
		$dbCustom = new DbCustom();
		
		$db = $dbCustom->getDbConnect(USER_DATABASE); 
		$sql = "SELECT phone, email, company
				FROM profile_account
				WHERE id = '".$this->this_profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
			$this->company = $object->company;
			$this->email = $object->email;
			$this->phone = $object->phone;	
		}
	
	}






	function getCompanyPhone(){
	
		$ret = '';
		$dbCustom = new DbCustom();
		
		return $this->phone;
	}

	function getCompanyEmail(){
	
		return $this->email;
		
	}





}

?>
