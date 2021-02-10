<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$db = $dbCustom->getDbConnect(CART_DATABASE);



exit;



	$sql = "DELETE FROM image WHERE profile_account_id > '1'";
	$ires = mysql_query($sql);
	if(!$ires)die(mysql_error());
	



$sql = "DELETE FROM attribute WHERE profile_account_id > '1'";
$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT * FROM attribute WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {

	$sql = "INSERT INTO attribute 
			(profile_account_id, attribute_name)
			VALUES
			('100', '".$row->attribute_name."')";

	$result = $dbCustom->getResult($db,$sql);
	

}

$sql = "DELETE FROM banner WHERE profile_account_id > '1'";
$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT * FROM banner WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {

	
	$sql = "SELECT * FROM image WHERE img_id = '".$row->img_id."'";
	$ires = mysql_query($sql);
	if(!$ires)die(mysql_error());
	$object = mysql_fetch_object($ires);

	$sql = "INSERT INTO image (profile_account_id, file_name) VALUES ('100', '".$object->file_name."') ";
	$iires = mysql_query($sql);
	if(!$iires)die(mysql_error());

	$img_id = $db->insert_id; 	
	

	$sql = "INSERT INTO banner 
			(profile_account_id, img_id)
			VALUES
			('100'
			,'".$img_id."')";

	$result = $dbCustom->getResult($db,$sql);
	

}


$sql = "DELETE FROM brand WHERE profile_account_id > '1'";
$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT * FROM brand WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {

	$sql = "INSERT INTO brand
			(name
			,short_name
			,profile_account_id
			,web_site
			,active
			)
			VALUES
			('".$row->name."'
			,'".$row->short_name."'
			,'100'
			,'".$row->web_site."'
			,'".$row->active."'
			)";	
	$result = $dbCustom->getResult($db,$sql);
	
	
}


$sql = "DELETE FROM category WHERE profile_account_id > '1'";
$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT * FROM category WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {
	
	
	
	$sql = "SELECT max(profile_cat_id) AS profile_cat_id 
			FROM category";
	$cres = mysql_query ($sql);
	if(!$cres)die(mysql_error());
	if(!mysql_num_rows($cres)){
			$profile_cat_id = 1;
	}else{
		$object = mysql_fetch_object($cres);
		$profile_cat_id = $object->profile_cat_id + 1; 	
	}


	$sql = "SELECT * FROM image WHERE img_id = '".$row->img_id."'";
	$ires = mysql_query($sql);
	if(!$ires)die(mysql_error());
	$object = mysql_fetch_object($ires);

	$sql = "INSERT INTO image (profile_account_id, file_name) VALUES ('100', '".$object->file_name."') ";
	$iires = mysql_query($sql);
	if(!$iires)die(mysql_error());

	$img_id = $db->insert_id; 	


	$sql = "INSERT INTO category
			(name
			,short_name
			,tool_tip
			,description
			,img_id
			,img_alt_text
			,key_words
			,show_on_home_page
			,show_in_cart
			,show_in_showroom
			,profile_cat_id
			,profile_account_id
			)
			VALUES
			('".$row->name."'
			,'".$row->short_name."'
			,'".$row->tool_tip."'
			,'".$row->description."'
			,'".$img_id."'
			,'".$row->img_alt_text."'
			,'".$row->key_words."'
			,'".$row->show_on_home_page."'
			,'".$row->show_in_cart."'
			,'".$row->show_in_showroom."'
			,'".$profile_cat_id."'
			,'100')";	
	$result = $dbCustom->getResult($db,$sql);
	


}





$sql = "DELETE FROM item WHERE profile_account_id > '1'";
$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT * FROM item WHERE profile_account_id = '1'";
$result = $dbCustom->getResult($db,$sql);

while($row = $result->fetch_object()) {




	$sql = "SELECT max(profile_item_id) AS profile_item_id 
				FROM item";
	$cres = mysql_query ($sql);
	if(!$cres)die(mysql_error());
	if(!mysql_num_rows($cres)){
			$profile_item_id = 1;
	}else{
		$object = mysql_fetch_object($cres);
		$profile_item_id = $object->profile_item_id + 1; 	
	}


	$sql = "SELECT * FROM image WHERE img_id = '".$row->img_id."'";
	$ires = mysql_query($sql);
	if(!$ires)die(mysql_error());
	if(!mysql_num_rows($ires)){
			$file_name = '';
	}else{
		$object = mysql_fetch_object($ires);
		$file_name = $object->file_name; 	
	}

	$sql = "INSERT INTO image (profile_account_id, file_name) VALUES ('100', '".$file_name."') ";
	$iires = mysql_query($sql);
	if(!$iires)die(mysql_error());

	$img_id = $db->insert_id; 	


	$sql = "INSERT INTO item
			(name
			,profile_item_id
			,profile_account_id
			,img_id
			,img_alt_text
			,main_attr_id
			,date_active
			,date_inactive
			,short_description
			,description
			,prod_number
			,internal_prod_number
			,is_closet
			,show_in_cart
			,show_in_showroom
			,active
			,seo_url
			,seo_list
			,key_words
			)
			VALUES
			('".$row->name."'
			,'".$profile_item_id."'
			,'100'
			,'".$img_id."'
			,'".$row->img_alt_text."'
			,'".$row->main_attr_id."'
			,'".$row->date_active."'
			,'".$row->date_inactive."'
			,'".$row->short_description."'
			,'".$row->description."'
			,'".$row->prod_number."'
			,'".$row->internal_prod_number."'
			,'".$row->is_closet."'
			,'".$row->show_in_cart."'
			,'".$row->show_in_showroom."'
			,'".$row->active."'
			,'".$row->seo_url."'
			,'".$row->seo_list."'
			,'".$row->key_words."')";	
	$result = $dbCustom->getResult($db,$sql);
	

}




?>