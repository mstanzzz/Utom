<?php

	
	
	
	
	if(isset($_GET['name'])) $_SESSION["temp_fields"]['name'] = $_GET['name'];
	if(isset($_GET["parent_vend_man_id"])) $_SESSION["temp_fields"]["parent_vend_man_id"] = $_GET["parent_vend_man_id"];
	if(isset($_GET['is_vendor'])) $_SESSION["temp_fields"]['is_vendor'] = $_GET['is_vendor'];
	if(isset($_GET["is_drop_shipper"])) $_SESSION["temp_fields"]["is_drop_shipper"] = $_GET["is_drop_shipper"];
	if(isset($_GET["is_manufacturer"])) $_SESSION["temp_fields"]["is_manufacturer"] = $_GET["is_manufacturer"];
	if(isset($_GET['description'])) $_SESSION["temp_fields"]['description'] = $_GET['description'];
	if(isset($_GET["web_site"])) $_SESSION["temp_fields"]["web_site"] = $_GET["web_site"];
	if(isset($_GET["contact_name"])) $_SESSION["temp_fields"]["contact_name"] = $_GET["contact_name"];
	if(isset($_GET["contact_email"])) $_SESSION["temp_fields"]["contact_email"] = $_GET["contact_email"];
	if(isset($_GET["contact_phone"])) $_SESSION["temp_fields"]["contact_phone"] = $_GET["contact_phone"];
	if(isset($_GET["contact_fax"])) $_SESSION["temp_fields"]["contact_fax"] = $_GET["contact_fax"];


	if(isset($_GET["brand_list"])){
		$_SESSION['temp_brand_ids'] = explode("|",$_GET["brand_list"]);
	}




?>