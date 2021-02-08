<?php

class DbCustom{

	public function getDbConnect($dbname){
			
		/*	
		if(stripos($dbname, 'site') !== false){
			$db = new mysqli(DB_HOST, "mstanz", "mstanz", $dbname);
		}elseif(stripos($dbname, 'cart') !== false){
			$db = new mysqli(DB_HOST, "mstanz_cart", "mstanz_cart", $dbname);
		}else{
			$db = new mysqli(DB_HOST, "mstanz_users", "mstanz_users", $dbname);
		}
		*/
		
		$db = new mysqli(DB_HOST, DB_USERNAME, DB_PSWD, $dbname);
		
		
		//echo "dbname: ".$dbname;
		//echo "<br />";		
		//echo "DB_HOST: ".DB_HOST;
		//echo "<br />";
		//echo "DB_USERNAME: ".DB_USERNAME;
		//echo "<br />";
		//echo "DB_PSWD: ".DB_PSWD;
		//echo "<br />";
		
		
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