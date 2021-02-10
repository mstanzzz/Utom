<?php

	

	$title = (isset($_GET['title'])) ? $_GET['title'] : ''; 
	$user_id = (isset($_GET["user_id"])) ? $_GET["user_id"] : 0;
	$substitute_by = (isset($_GET["substitute_by"])) ? $_GET["substitute_by"] : '';
	$blog_cat_id = (isset($_GET["blog_cat_id"])) ? $_GET["blog_cat_id"] : 0;
	$type = (isset($_GET["type"])) ? $_GET["type"] : '';
	$content = (isset($_GET["content"])) ? $_GET["content"] : '';
	
	
	$_SESSION["temp_blog_fields"]['title'] = $title;
	$_SESSION["temp_blog_fields"]["user_id"] = $user_id;
	$_SESSION["temp_blog_fields"]["substitute_by"] = $substitute_by;
	$_SESSION["temp_blog_fields"]["blog_cat_id"] = $blog_cat_id;
	$_SESSION["temp_blog_fields"]["type"] = $type;
	$_SESSION["temp_blog_fields"]["content"] = $content;

//echo $title;

?>