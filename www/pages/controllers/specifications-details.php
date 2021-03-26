<?php	


//echo "###########################>>>>>id:  ".$id;
//echo "<br />";


//$id = 1;

if(!isset($id)){ 
	$id = 777;
}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT 
			name
			,description 
		FROM spec
		WHERE spec_id = '".$id."'";
$result = $dbCustom->getResult($db,$sql);	

//echo "num_rows ".$result->num_rows;
//exit;


if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = stripslashes($object->name);
	$description = $object->description;
}else{
	$name = "No Name";
	$description = "No description";
}
		


		
?>	


