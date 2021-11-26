<?php
class Company {
	
	
	function getCompanyBasicInfo($dbCustom)
	{
		unset($_SESSION["company_basic_info"]);
		if(!isset($_SESSION['company_basic_info']))
			$_SESSION['company_basic_info']['company'] = "Closets To Go";
			$_SESSION['company_basic_info']['phone'] = "1-888-312-7424";	
		
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$sql = "SELECT company
						,phone
					FROM profile_account
					WHERE id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$_SESSION['company_basic_info']['company'] = $object->company;
				$_SESSION['company_basic_info']['phone'] = $object->phone;	
				return $_SESSION['company_basic_info'];		
			}
		return '';		
	}	


	function getCompanyDisplayInfo($dbCustom)
	{
		unset($_SESSION["company_display_info"]);
		if(!isset($_SESSION['company_basic_info'])){
			$_SESSION['company_display_info'] = array();	
			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$sql = "SELECT *
					FROM company_info
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);						
			if($result->num_rows){
				$object = $result->fetch_object();	
				$_SESSION['company_display_info']['company_phone'] = $object->phone;
				$_SESSION['company_display_info']['company_fax'] = $object->fax;
				$_SESSION['company_display_info']['days'] = $object->days;
				$_SESSION['company_display_info']['hours'] = $object->hours;
				$_SESSION['company_display_info']['addr_line1'] = $object->addr_line1;
				$_SESSION['company_display_info']['addr_line2'] = $object->addr_line2;
				$_SESSION['company_display_info']['addr_line3'] = $object->addr_line3;
				$_SESSION['company_display_info']['text_block1'] = $object->text_block1;
				$_SESSION['company_display_info']['text_block1_head'] = $object->text_block1_head;	
				$_SESSION['company_display_info']['facebook'] = $object->facebook;	
				$_SESSION['company_display_info']['twitter'] = $object->twitter;	
				$_SESSION['company_display_info']['youtube'] = $object->youtube;
				$_SESSION['company_display_info']['pinterest'] = $object->pinterest;	
				$_SESSION['company_display_info']['houzz'] = $object->houzz;
				$_SESSION['company_display_info']['google_plus'] = $object->google_plus;
				$_SESSION['company_display_info']['facebook_active'] = $object->facebook_active;	
				$_SESSION['company_display_info']['twitter_active'] = $object->twitter_active;	
				$_SESSION['company_display_info']['youtube_active'] = $object->youtube_active;
				$_SESSION['company_display_info']['pinterest_active'] = $object->pinterest_active;	
				$_SESSION['company_display_info']['houzz_active'] = $object->houzz_active;
				$_SESSION['company_display_info']['google_plus_active'] = $object->google_plus_active;
				$_SESSION['company_display_info']['google_analytics'] = $object->google_analytics;
			}else{
				
				$_SESSION['company_display_info']['company_phone'] = '999 999 99 9999';
				$_SESSION['company_display_info']['company_fax'] = '';
				$_SESSION['company_display_info']['days'] = '';
				$_SESSION['company_display_info']['hours'] = '';
				$_SESSION['company_display_info']['addr_line1'] = '';
				$_SESSION['company_display_info']['addr_line2'] = '';
				$_SESSION['company_display_info']['addr_line3'] = '';
				$_SESSION['company_display_info']['text_block1'] = '';
				$_SESSION['company_display_info']['text_block1_head'] = '';	
				$_SESSION['company_display_info']['facebook'] = '';	
				$_SESSION['company_display_info']['twitter'] = '';	
				$_SESSION['company_display_info']['youtube'] = '';
				$_SESSION['company_display_info']['pinterest'] = '';	
				$_SESSION['company_display_info']['houzz'] = '';
				$_SESSION['company_display_info']['google_plus'] = '';
				$_SESSION['company_display_info']['facebook_active'] = '';	
				$_SESSION['company_display_info']['twitter_active'] = '';	
				$_SESSION['company_display_info']['youtube_active'] = '';
				$_SESSION['company_display_info']['pinterest_active'] = '';	
				$_SESSION['company_display_info']['houzz_active'] = '';
				$_SESSION['company_display_info']['google_plus_active'] = '';
				$_SESSION['company_display_info']['google_analytics'] = '';
			}
		}
		return $_SESSION['company_display_info'];
	}
}



