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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

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



