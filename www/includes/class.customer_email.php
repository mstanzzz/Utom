<?php

// add function to merge carts if cust ids are different at loggin
// ... mergeCart(old_cust_id, new_cust_id) 


// store arrays in session
//store objects in the $_SESSION

class CustomerEmail {

	public $customer_id;
	public $profile_company;
	//public $company_phone;
	
	function __construct() {
	   $this->customer_id = (isset($_SESSION['ctg_cust_id']))? $_SESSION['ctg_cust_id'] : 0;
	   $this->profile_company = (isset($_SESSION['profile_company']))? $_SESSION['profile_company'] : 'us';
	}
	
	function getDesignRequestCustEmailBody($dbCustom){
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT to_cust_email_body
				FROM design_email_content 
				WHERE design_email_content_id = (SELECT MAX(design_email_content_id) 
												FROM design_email_content 
												WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
		$result = $dbCustom->getResult($db,$sql); 
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$to_cust_email_body = $object->to_cust_email_body;
		}else{
			$to_cust_email_body = '';
		}
		if(trim($to_cust_email_body) == ''){
			$to_cust_email_body = "Thank you for your design request with ".$this->profile_company.". 
				Your designer is Pam. If you have any questions you may contact her at pam@closetstogo.com or call her toll free at ".$this->getCompanyPhone().".";
			$to_cust_email_body .= "<br /><br />You will receive a design in 3-4 business days.";	
			$to_cust_email_body .= "<br /><br />Sincerely,";
			$to_cust_email_body .= "<br /><br />Closets To Go";
		}
		
		return $to_cust_email_body;
		
	}
	
	function getInHomeConsultCustEmailBody($dbCustom){
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT content
				FROM consult_email_content 
				WHERE consult_email_content_id = (SELECT MAX(consult_email_content_id) 
													FROM consult_email_content 
													WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
						
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$content = $object->content;
		}else{
			$content = '';
		}
		if(trim($content) == ''){
			$content = "Thank you for your in-home consultation request with ".$this->profile_company; 			
			$content .= "Your request will be reviewed and a representative from Closets To Go will contact you shortly.";
			$content .= "If you have any questions, you may call us toll free at ".$this->getCompanyPhone().".";
			$content .= "<br /><br />You will receive a response within 2-3 business days.";	
			$content .= "<br /><br />Sincerely,";
			$content .= "<br /><br />Closets To Go";
			
		}
		return $content;
	}

	function getCompanyPhone($dbCustom){
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = sprintf("SELECT phone
						FROM company_info 
						WHERE profile_account_id = '%u'", $_SESSION['profile_account_id']);
						
		$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			//$this->company_phone = $phone;
			return	$object->phone;	
		}
		return '';
		
	}



}

?>
