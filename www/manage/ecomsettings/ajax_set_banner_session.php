<?php
	$title = (isset($_GET['title'])) ? $_GET['title'] : ''; 
	$url = (isset($_GET['url'])) ? $_GET['url'] : '';
	$description = (isset($_GET['description'])) ? $_GET['description'] : '';
	$img_alt_text = (isset($_GET['img_alt_text'])) ? $_GET['img_alt_text'] : '';
	
	$_SESSION["temp_banner_fields"]['title'] = $title;
	$_SESSION["temp_banner_fields"]['url'] = $url;
	$_SESSION["temp_banner_fields"]['description'] = $description;
	$_SESSION["temp_banner_fields"]['img_alt_text'] = $img_alt_text;
?>