<?php
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM showroom
		WHERE showroom.showroom_id = (SELECT MAX(showroom_id) FROM showroom WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$img_id = $object->img_id;
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
}else{
	$img_id = 0;
	$p_1_head = "We manufacture all our closet organizers with top quality materials right here in the USA.";
	$p_1_text = "And we've been doing it for nearly three decades. Learn more about our company below or contact us for more information about placing an order or our custom closet systems.";
}

					
$sql = "SELECT file_name
		FROM image
		WHERE img_id = '".$img_id."'";				
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();

	$hero_file_name = $object->file_name;
}else{
	$hero_file_name = '';
}	


$sql = "SELECT content 
		FROM specs_content 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
$result = $dbCustom->getResult($db,$sql);

echo "num_rows ".$result->num_rows;

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$content = $object->content;
}else{
	$content = "No Content";
}

$spec_cat_array = array();
$spec_array = array();


/* May not use
$sql = "SELECT category_name, spec_cat_id 
		FROM spec_category
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
$i = 0;
while($row = $result->fetch_object()) {
	$spec_cat_array[$i]['spec_cat_id'] = $row->category_name;
	$spec_cat_array[$i]['category_name'] = $row->category_name;
	$i++;
}
*/


$sql = "SELECT name, spec_id 
		FROM spec
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
$i = 0;
while($row = $result->fetch_object()) {
	$spec_array[$i]['name'] = $row->name;
	$spec_array[$i]['spec_id'] = $row->spec_id;
	$i++;
}




//echo "<br />";
//echo $content; 
//print_r($spec_cat_array);
//exit;

if(!isset($hero_file_name)) $hero_file_name = '';

if($hero_file_name == ''){	
	$hero = '../../images/organizer-landing-pahe-header.png';	
}else{

	$hero = '';

	$hero .= "../../saascustuploads/";
	$hero .= $_SESSION['profile_account_id'];
	$hero .= "/cms/";
	$hero .= $hero_file_name;
	//$hero = preg_replace('/(\/+)/','/',$im);

}

//echo "hero ".$hero;
//exit;

//$hero = '../../images/organizer-landing-pahe-header.png';

?>