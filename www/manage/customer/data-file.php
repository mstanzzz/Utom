<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$page_title = 'Customer List';
$page_group = 'customer';

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
			
		$s_profile_account_id = (isset($_REQUEST['s_profile_account_id'])) ? $_REQUEST['s_profile_account_id'] : $_SESSION['profile_account_id'];	
		
		$s_customer_id = (isset($_REQUEST['s_customer_id'])) ? trim($_REQUEST['s_customer_id']) : 0;	
		
		$search_str = (isset($_REQUEST["search_str"])) ?  trim(addslashes($_REQUEST["search_str"])) : ''; 
		


  // filename for download
  $filename = "customer_data_" . date('Ymd') . ".csv";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/csv");

  $out = fopen("php://output", 'w');


/*
  while(false !== ($row = pg_fetch_assoc($result))) {
    array_walk($row, 'cleanData');
    fputcsv($out, array_values($row), ',', '"');
  }
*/

	$limit = ' ';

		$db = $dbCustom->getDbConnect(USER_DATABASE);		

		$sql = "SELECT id, name, created, visited, username
				FROM  user
				WHERE profile_account_id = '".$s_profile_account_id."'
				AND user_type_id < '7'";
		if($search_str != ''){			
			$sql .= " AND (name like '%".$search_str."%' OR  username like '%".$search_str."%' )" ;
		}
		if($s_customer_id > 0){
			$sql .= " AND id = '".$s_customer_id."'" ;			
		}

		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY name DESC".$limit;
				}else{
					$sql .= " ORDER BY name ".$limit;		
				}
			}
			if($sortby == 'username'){
				if($a_d == 'd'){
					$sql .= " ORDER BY username DESC".$limit;
				}else{
					$sql .= " ORDER BY username ".$limit;		
				}
			}
			if($sortby == 'created'){
				if($a_d == 'd'){
					$sql .= " ORDER BY created DESC".$limit;
				}else{
					$sql .= " ORDER BY created ".$limit;		
				}
			}
			if($sortby == 'visited'){
				if($a_d == 'd'){
					$sql .= " ORDER BY visited DESC".$limit;
				}else{
					$sql .= " ORDER BY visited ".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY id ".$limit;					
		}

					
		$result = $dbCustom->getResult($db,$sql);	

		$t = array();
		$i = 0;


		$t[$i]['name'] = 'Name';
		$t[$i]['username'] = 'Email';
		$t[$i]['visited'] = 'Last Visit';
		$t[$i]['created'] = 'Created';

		while($row = $result->fetch_object()) {
						
			$i++;
			$t[$i]['name'] = stripslashes($row->name);
			$t[$i]['username'] = $row->username;
			$t[$i]['visited'] = date("m/d/Y",strtotime($row->visited));
			$t[$i]['created'] = date("m/d/Y",strtotime($row->created));
						
		}
		
		foreach($t as $v){
			fputcsv($out, array_values($v), ',', '"');
		}

  fclose($out);
  exit;


					?>
	