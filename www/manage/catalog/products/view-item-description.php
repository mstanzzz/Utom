<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$db = $dbCustom->getDbConnect(CART_DATABASE);


$item_id = $_GET['item_id']; 
$sql = sprintf("SELECT description FROM item WHERE item_id = '%u'", $item_id);
$result = $dbCustom->getResult($db,$sql);
$object = $result->fetch_object();

?>

<div style="margin:auto; text-align:left;">

<?php
 
 	if(trim($object->description) == ''){
		echo "There is no description for this item.";	
	}else{
		echo stripslashes($object->description); 
	}

?> 

</div>



