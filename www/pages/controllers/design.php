<?php

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM design
		WHERE design.design_id = (SELECT MAX(design_id) FROM design WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

echo $result->num_rows; 
echo "<br />";
echo "<br />";

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$top_1 = stripslashes($object->top_1);
	$top_2 = stripslashes($object->top_2);
	$p_1_text = stripslashes($object->p_1_text);
}else{
	$top_1 = '';
	$top_2 = '';
	$p_1_text = "closet systems.";
}


$_SESSION['from_design_options_page'] = 0;
$origin = (isset($_REQUEST['origin'])) ? $_REQUEST['origin'] : 'Design Options Page'; 

$width = 820;
$height = 486; 			

?>

  
