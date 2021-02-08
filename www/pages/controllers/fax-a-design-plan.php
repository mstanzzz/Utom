<?php


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



$sql = "SELECT *
		FROM fax_a_design_plan
		WHERE fax_a_design_plan.fax_a_design_plan_id = (SELECT MAX(fax_a_design_plan_id) FROM fax_a_design_plan WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

//echo "num_rows: ".$result->num_rows;
//echo "<br />";
//echo "<br />";

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	$top_1 = stripslashes($object->top_1);
	$top_2 = stripslashes($object->top_2);
	$top_3 = stripslashes($object->top_3);
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	$p_2_head = stripslashes($object->p_2_head);
	$p_2_text = stripslashes($object->p_2_text);
	$p_3_head = stripslashes($object->p_3_head); 
	$p_3_text = stripslashes($object->p_3_text);
	$p_4_head = stripslashes($object->p_4_head);
	$p_4_text = stripslashes($object->p_4_text); 
	$p_5_head = stripslashes($object->p_5_head);  
	$p_5_text = stripslashes($object->p_5_text); 
	$p_6_head = stripslashes($object->p_6_head);  
	$p_6_text = stripslashes($object->p_6_text); 
	$p_7_head = stripslashes($object->p_7_head);  
	$p_7_text = stripslashes($object->p_7_text);
	$p_8_head = stripslashes($object->p_8_head);  
	$p_8_text = stripslashes($object->p_8_text);
	$p_9_head = stripslashes($object->p_9_head);  
	$p_9_text = stripslashes($object->p_9_text);
	$p_10_head = stripslashes($object->p_10_head);  
	$p_10_text = stripslashes($object->p_10_text);

	
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = '';
	$top_2 = '';
	$top_3 = '';
	$p_1_head = "";
	$p_1_text = "";	
	$p_2_head = "";
	$p_2_text = "";
	$p_3_head = ""; 
	$p_3_text = "";	
	$p_4_head = '';
	$p_4_text = ''; 
	
	$p_5_head = '';  
	$p_5_text = ''; 
	
	$p_6_head = '';  
	$p_6_text = ''; 
	$p_7_head = '';  
	$p_7_text = '';

	$p_8_head = '';  
	$p_8_text = '';

	$p_9_head = '';  
	$p_9_text = '';	

	$p_10_head = '';  
	$p_10_text = '';
	
}

					
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_1_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_1_file_name = $img_obj->file_name;
}else{
	$img_1_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_2_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_2_file_name = $img_obj->file_name;
}else{
	$img_2_file_name = '';
}	

$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_3_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_3_file_name = $img_obj->file_name;
}else{
	$img_3_file_name = '';
}	 





/*	
echo "<br />";
echo "HHHHHHHHHHHHHH";
echo "<br />";
echo "num_rows: ".$result->num_rows;
echo "<br />";
exit;
*/

?>






