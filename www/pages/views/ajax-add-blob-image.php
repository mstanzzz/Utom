<?php


require_once("../../includes/config.php"); 

$blob_image = (isset($_GET['blob_image'])) ? $_GET['blob_image'] : 0;

/*


if(1){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "INSERT INTO blob_image
			(blob_image)
			VALUES
			(".blob_image.")";
	$result = $dbCustom->getResult($db,$sql);

	$blob_image_id = $db->insert_id;
	
	echo "blob_image_id: ".$blob_image_id;	
	
}else{
	
}

*/

echo $blob_image;

?>