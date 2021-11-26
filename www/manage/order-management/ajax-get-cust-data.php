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
require_once("<?php echo SITEROOT; ?>includes/class.customer_account.php"); 

$custAcc = new CustomerAccount();

$customer_id = (isset($_GET['customer_id'])) ? $_GET['customer_id'] : 0;


$custAcc->setDbAccData($dbCustom,$customer_id);
	
	$returnData = json_encode(array(
						'shipping_name_first'=>$custAcc->shipping_name_first,
						'shipping_name_last'=>$custAcc->shipping_name_last,
						'billing_name_first'=>$custAcc->shipping_name_last,
						'billing_name_last'=>$custAcc->shipping_name_last,					
						'shipping_address_one'=>$custAcc->shipping_address_one,
						'shipping_address_two'=>$custAcc->shipping_address_two,
						'shipping_city'=>$custAcc->shipping_city,
						'shipping_state'=>$custAcc->shipping_state,
						'shipping_zip'=>$custAcc->shipping_zip,
						'shipping_phone'=>$custAcc->shipping_phone,
						'shipping_country'=>$custAcc->shipping_country,
						'billing_address_one'=>$custAcc->billing_address_one,
						'billing_address_two'=>$custAcc->billing_address_two,
						'billing_city'=>$custAcc->billing_city,
						'billing_state'=>$custAcc->billing_state,
						'billing_zip'=>$custAcc->billing_zip,
						'billing_country'=>$custAcc->billing_country,
						'billing_phone'=>$custAcc->billing_phone,
						'username'=>$custAcc->username,

						));	



		
	echo $returnData;





?>