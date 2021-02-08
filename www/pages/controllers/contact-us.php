<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
require_once('includes/class.store_data.php');			

$cart = new ShoppingCart;
$nav = new Nav;
$store_data = new StoreData;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM contact_us
		WHERE contact_us.contact_us_id = (SELECT MAX(contact_us_id) FROM contact_us WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

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
	
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = '';
	$top_2 = '';
	$top_3 = '';
	$p_1_head = "We manufacture all our closet organizers with top quality materials right here in the USA.";
	$p_1_text = "And we've been doing it for nearly three decades. Learn more about our company below or contact us for more information about placing an order or our custom closet systems.";
	$p_2_head = "WHO WE ARE";
	$p_2_text = "
Closets To Go is the industry leader in custom closet design and customer satisfaction. 
January 2015, marks our 30th year serving the greater Portland metropolitan area. 
We are also pleased to announce our 8th year serving customers in all 50 states and Canada through our internet department. 
We at Closets To Go pride ourselves on providing quality products at a competitive price while demonstrating outstanding 
customer service and attention to detail. Please let us know how we can assist in making your space an oasis.";
	$p_3_head = "PRODUCTS"; 
	$p_3_text = "We design every organizer based on your exact measurements and specifications; nothing is pre-made. 
	We use only the finest wood panel products from Roseburg Forest Products, 
	Panolam, Flakeboard and other high quality products made in America with the top of the line American and European hardware.
	All systems have steel fasteners and are wall mounting to insure structural stability. 
	Our systems are engineered to be wall-attached (reach-in closets, walk-in closets, 
	pantries) or free-standing (garage storage organizers and armoires, office systems and more).";
	
	$p_4_head = 'not used';
	$p_4_text = 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit'; 
	
	$p_5_head = 'not used';  
	$p_5_text = 'not used'; 
	
	$p_6_head = 'not used';  
	$p_6_text = 'not used'; 
	$p_7_head = 'not used';  
	$p_7_text = 'not used';

	$p_8_head = 'not used';  
	$p_8_text = 'not used';
	
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



