<?php

	if(!isset($added_page_id)) $added_page_id = 0;
	if(!isset($seo_name)) $seo_name = '';
	if(!isset($title)) $title = '';
	if(!isset($keywords)) $keywords = '';
	if(!isset($description)) $description = '';
	if(!isset($mssl)) $mssl = 0;
	if(!isset($page_heading)) $page_heading = '';
	if(!isset($added_page_id)) $added_page_id = 0;
	if(!isset($page)) $page = '';


	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


//echo "seo_name ".$seo_name;

	$sql = "UPDATE page_seo
			SET seo_name = '".$seo_name."'
				,title = '".$title."'
				,keywords = '".$keywords."'
				,description = '".$description."'
				,mssl = '".$mssl."'
				,page_heading = '".$page_heading."'
				,added_page_id = '".$added_page_id."'
			WHERE page_name = '".$page."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
			



?>