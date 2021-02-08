<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
require_once('includes/class.store_data.php');			

$cart = new ShoppingCart;
$nav = new Nav;
$store_data = new StoreData;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


	

$sql = "SELECT *
		FROM process_page
		WHERE process_page.process_page_id = (SELECT MAX(process_page_id) 
				FROM process_page 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){

	$object = $result->fetch_object();

	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	$p_2_head = stripslashes($object->p_2_head);
	$p_2_text = stripslashes($object->p_2_text);


	$p_3_head = stripslashes($object->p_3_head); 
	$p_3_text = stripslashes($object->p_3_text);


	$p_4_head = stripslashes($object->p_4_head); 
	$p_4_text = stripslashes($object->p_4_text);

	
	
}else{
	
	
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$p_1_head = "LOREM IPSUM DOLOR SIT AMET, CONSECTETUR";
	$p_1_text = "LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT.";
	
	
	$p_2_head = "WE OFFER IN-HOME CONSULTATIONS FOR OUR LOCAL CUSTOMERS AND FREE DESIGN SERVICE FOR OUR OUT OF STATE CUSTOMERS.";
	$p_2_text = "Our in-home consultations provide you with assistance measuring your space and determining your needs. 
	From start to finish your designer is with you to answer questions and help maximize your space. Once your order is placed and manufactured, 
	our installation team will call to schedule your professional closet installation.";
	
	
	$p_3_head = ""; 
	$p_3_text = "For our valued customers around the country, we offer online design assistance. Simply start by going to Closets To Go, 
	click on the “Start Designing” link in the orange box in the right hand corner that reads “Get Your Custom Closet In 3 Easy Steps.” 
	Click on the orange “Request Design” box.";
	
	
	
	$p_4_head = ""; 
	
	
	$p_4_text = "This step will provide you with a form to fill in your dimensions and indicate your closet needs, 
	you may also include comments in this section. Submit your request and one of our online designers will be in 
	touch with you in approximately three (3) business days with a preliminary design with which you can approve or request revisions.";
	
	
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


?>


