<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/manage/admin-includes/manage-includes.php');
	
$db = $dbCustom->getDbConnect(SITE_DATABASE);


if(isset($_POST['export'])){

	$delimiter = ","; 
	$filename = "data_" . date('Y-m-d') . ".csv"; 
	// Create a file pointer 
	$f = fopen('php://memory', 'w'); 
		 
	// Set column headers 
	$fields = array('NAME', 'EMAIL', 'CITY', 'STATE', 'ZIP', 'PHONE', 'DATE_SUBMITTED'); 
	fputcsv($f, $fields, $delimiter); 

	
	$design_email_ids = (isset($_POST['design_email_ids']))? $_POST['design_email_ids'] : array();	

	
	if(is_array($design_email_ids)){	
		foreach($design_email_ids as $key => $val){
			
			$sql = "SELECT name, email, city, state, zip, phone, date_submitted 
					FROM design_email 
					WHERE design_email_id = '".$val."'";
			$res = $dbCustom->getResult($db,$sql);		
			
			

			if($res->num_rows > 0){
				$obj = $res->fetch_object();
				$lineData = array($obj->name, $obj->email, $obj->city, $obj->state, $obj->zip, $obj->phone, date("F j, Y, g:i a", $obj->date_submitted)); 
				fputcsv($f, $lineData, $delimiter); 
			}

		}


		fseek($f, 0);

		header('Content-Type: text/csv'); 
		header('Content-Disposition: attachment; filename="' . $filename . '";'); 

		fpassthru($f); 

		exit;
	
	}
}
	



?>
