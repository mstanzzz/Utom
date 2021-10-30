<?php
require_once("<?php echo SITEROOT; ?>includes/config.php"); 

$blob_image = (isset($_POST['blob_image'])) ? $_POST['blob_image'] : 0;

//$blob_image = "kkkkkkkkkkkkkkkkkkk";


if(1){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "INSERT INTO blob_image
			(blob_image)
			VALUES
			('".$blob_image."')";
	$result = $dbCustom->getResult($db,$sql);

	$blob_image_id = $db->insert_id;
	
	echo "blob_image_id: ".$blob_image_id;	
	
}else{
	
}

//echo $blob_image;

?>