<?php
$before = time();

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										
$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT * FROM customer_data";
echo $result->num_rows;
$after = time();
echo ($after-$before);


$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "DELETE FROM item WHERE name LIKE '%Add-on%'";
//$res = $db->query($sql);


/*
$ts = time();
$db_now = date('Y-m-d h:i:s');

$db = $dbCustom->getDbConnect(USER_DATABASE);

$sql = "SELECT * FROM customer_data";
echo $result->num_rows;


while($row = $result->fetch_object()){
	
	$sql = "SELECT id FROM user 
			WHERE username = '".$row->email."'
			AND profile_account_id = '1'";
			
	$res = $db->query($sql);

	echo $res->num_rows; 	
	echo "<br />";
	
}

*/


?>