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


//SaaS sites portland.Closetstogo.com 89 
//and socal.closetstogo.com 90



//.define("ORGANIZE_SITE_N_DATABASE", "onlinecl_organize_SITE");
//define("ORGANIZE_USER_DATABASE", "onlinecl_organize_USERS");
//define("ORGANIZE_CART_DATABASE", "onlinecl_organize_CART");
//define("ORGANIZE_DESIGN_DATABASE", "onlinecl_organize_DESIGN");



$new_profile_account_id = 102;


//portland.closetstogo.com
$old_profile_account_id = 89;

$db_selected = dbSelect(ORGANIZE_CART_DATABASE);

$sql = "SELECT *
		FROM category
		WHERE profile_account_id = '".$old_profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);

while($row = $res->fetch_object()){
	
	$sql = "SELECT *
		FROM image
		WHERE img_id = '".$row->img_id."'";
	$img_res = $dbCustom->getResult($db,$sql);
	
	$img_obj = $img_res->fetch_object();
	
	
	
	
	echo $row->name.'    '.$img_obj->file_name;
	echo "<br />";	
	
	
	$sql = "INSERT INTO category
		FROM category
		WHERE profile_account_id = '89'";
	//$c_res = mysql_query ($sql);
	//if(!$c_res)die(mysql_error());
	
	
	
	
	
}



$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "DELETE FROM category
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//





//WHERE profile_account_id = '89'






$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "DELETE FROM banner
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//


$sql = "DELETE FROM company_info
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//


$sql = "DELETE FROM footer_nav_label
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//


$sql = "DELETE FROM global_seo_words
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//.$result = $dbCustom->getResult($db,$sql);
//



$sql = "DELETE FROM header_support_menu_label
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//


$sql = "DELETE FROM image
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//


$sql = "DELETE FROM in_home_consult_request
		WHERE profile_account_id > '1'
		AND profile_account_id < '102'";
//$result = $dbCustom->getResult($db,$sql);
//





exit;

$new_profile_account_id = 0;

$old_profile_account_id = 89;

$i=0;

	$db_selected = dbSelect(ORGANIZE_CART_DATABASE);

	$sql = "SELECT file_name, img_id, alt_tag 
			FROM image 
			WHERE profile_account_id = '".$old_profile_account_id."'";
	/*
	$img_res = $dbCustom->getResult($db,$sql);
	
	while($img_row = $img_res->fetch_object()){
		$i++;
	
		$file_name = $img_row->file_name;
		$img_id = $img_row->img_id;
		$alt_tag = $img_row->alt_tag;


		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		
		$sql = "INSERT INTO IMAGE
				(file_name, img_id, alt_tag, profile_account_id	)
				VALUES
				('".$file_name."','".$img_id ."','".$alt_tag."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
	}*/

$i=0;


	$db_selected = dbSelect(ORGANIZE_CART_DATABASE);

	$sql = "SELECT name, web_site 
			FROM brand 
			WHERE profile_account_id = '".$old_profile_account_id."'";
	
	/*
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $res->fetch_object()){
		$i++;
	
		$name = $row->name;
		//$brand_id = $img_row->brand_id;
		$web_site = $row->web_site;

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT MAX(brand_id) AS brand_id FROM brand";
		$new_res = mysql_query ($sql);
		if(!$new_res)die(mysql_error());
		$obj = mysql_fetch_object($new_res);
		
		$sql = "INSERT INTO brand
				(name, web_site, profile_account_id)
				VALUES
				('".$name."','".$web_site."', '".$new_profile_account_id."')"; 
		$result = $dbCustom->getResult($db,$sql);
		
	}
	*/
			
		

		
$i=0;


	$db_selected = dbSelect(ORGANIZE_CART_DATABASE);

	$sql = "SELECT name,short_description, description, show_in_cart, show_in_showroom, show_on_home_page, active, seo_url, key_words	  
			FROM category 
			WHERE profile_account_id = '".$old_profile_account_id."'";
	/*
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
		//$i++;
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT max(profile_cat_id) AS profile_cat_id 
				FROM category 
				WHERE profile_account_id = '".$new_profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if(!$res->num_rows){
			$profile_cat_id = 1;
		}else{
			$object = $res->fetch_object();
			$profile_cat_id = $object->profile_cat_id + 1; 	
		}
		
		
		$sql = "INSERT INTO category
				(profile_cat_id, name, short_description, description, show_in_cart, show_in_showroom, show_on_home_page, active, seo_url, key_words,  profile_account_id)
				VALUES
				('".$profile_cat_id."'
				,'".$row->name."'
				,'".$row->short_description."'
				,'".$row->description."'
				,'".$row->show_in_cart."'
				,'".$row->show_in_showroom."'
				,'".$row->show_on_home_page."'
				,'".$row->active."'
				,'".$row->seo_url."'
				,'".$row->key_words."'
				,'".$new_profile_account_id."'
				
				
				)"; 
		$result = $dbCustom->getResult($db,$sql);
		
	}
		
	*/

$i=0;


	$db_selected = dbSelect(ORGANIZE_CART_DATABASE);

	$sql = "SELECT name
			,short_description
			,description
			,price_flat
			,price_wholesale
			,percent_markup
			,percent_off
			,amount_off
			,prod_number
			,internal_prod_number
			,sku
			,upc
			,vendor_part_num
			,active
			,seo_url
			,key_words	  
			FROM item 
			WHERE profile_account_id = '".$old_profile_account_id."'";
	
	/*
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		$sql = "SELECT max(profile_item_id) AS profile_item_id 
				FROM item 
				WHERE profile_account_id = '".$new_profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if(!$res->num_rows){
			$profile_item_id = 1;
		}else{
			$object = $res->fetch_object();
			$profile_item_id = $object->profile_item_id + 1; 	
		}



		$sql = "INSERT INTO item
				(profile_item_id
				,name
				,short_description
				,description
				,price_flat
				,price_wholesale
				,percent_markup
				,percent_off
				,amount_off
				,prod_number
				,internal_prod_number
				,sku
				,upc
				,vendor_part_num
				,active
				,seo_url
				,seo_list
				,key_words
				)
				VALUES
				('".$profile_item_id."'
				,'".$row->name."'
				,'".$row->short_description."'
				,'".$row->description."'
				,'".$row->price_flat."'
				,'".$row->price_wholesale."'
				,'".$row->percent_markup."'
				,'".$row->percent_off."'		
				,'".$row->amount_off."'
				,'".$row->prod_number."'
				,'".$row->internal_prod_number."'
				,'".$row->sku."'
				,'".$row->upc."'
				,'".$row->vendor_part_num."'
				,'".$row->active."'
				,'".$row->seo_url."'
				,'".$row->key_words."'
				,'".$new_profile_account_id."'
				)"; 
		$result = $dbCustom->getResult($db,$sql);
		
	}

	*/

?>