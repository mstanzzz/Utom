<?php

class DbCustom{

	public function getDbConnect($dbname){
			
		$db = new mysqli(DB_HOST, DB_USERNAME, DB_PSWD, $dbname);
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
			exit;
		}	
		
		return $db;	
		
	}
	
	public function getDbConnectLegacyCTG($dbname){
	
		$db = new mysqli(BUY_CLOSE_DB_HOST, BUY_CLOSE_DB_USERNAME, BUY_CLOSE_DB_PSWD, $dbname);
		
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
			exit;
		}	
		return $db;	
		
	}


	public function getResult($db,$sql){
	
		if(is_object($db)){
			if(!$result = $db->query($sql)){
				die('There was an error running the query [' . $db->error . ']');
				return 0;
			}
			
			return	$result;
		}
		
		return 0;
	
	}
	
}

?>