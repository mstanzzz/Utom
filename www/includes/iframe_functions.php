<?php
require_once("config.php"); 
require_once("db_connect.php");
require_once("class.encryption.php");


function verifyIframeSite($idstr,SITEROOT){

	$converter = new Encryption;
		
	$ret = 0;

	if($fp = fopen("http://www.".$_SESSION['saas_uploads_dir']."/verifysite.htm", 'r')){
	   
	   
	   
	   
		$content = '';
		while($line = fgets($fp, 1024)){
			$content .= $line;
	    }

		$strArray = explode("-", $content);
		
		//echo $strArray[0];	

		$iframe_id = $converter->decode($strArray[0]);

		//echo $iframe_id;
		
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = "SELECT * FROM iframe WHERE id = '".$iframe_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
		if($result->num_rows > 0){
			
			$object = $result->fetch_object();


					/*
					echo $object->id;
					echo "<br />";
					echo $object->domain_name;
					echo "<br />";
					echo SITEROOT;
					*/

			
			if($object->active){
		
				if($object->id == $iframe_id){
					if($object->domain_name == SITEROOT){
						$ret = 1;		
					}
	
				}			

			}

		}

	}
	
	return $ret;

}



function hasIframeModule($profile_account_id){
	
	$ret = 0;	
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			FROM profile_account_to_module
			WHERE module_id = '4'
			AND profile_account_id = '".$profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$ret = 1;
	}

	return $ret;
		
}


function getUsedIframeCount($profile_account_id){
	
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			FROM iframe
			WHERE profile_account_id = '".$profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);	
	$ret = $result->num_rows;

	return $ret;
	
}

function getIframeCount($profile_account_id){
	
	$ret = 0;
	
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT iframes_allowed
			FROM profile_account
			WHERE id = '".$profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret = $object->iframes_allowed;	
	}
	return $ret;
	
}



?>