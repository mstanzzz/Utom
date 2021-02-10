<?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "SELECT * 
			FROM page_seo
			WHERE page_name = '".$page."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";	
	$res = $dbCustom->getResult($db,$sql);
	
	if($res->num_rows > 0){
		$s_obj = $res->fetch_object();
		$mssl = $s_obj->mssl;	
		$seo_name = $s_obj->seo_name;
		$title = $s_obj->title;
		$keywords = $s_obj->keywords;
		$description = $s_obj->description;			
		$page_heading = $s_obj->page_heading;
		
	}else{
		$mssl = 0;
		$seo_name = "";
		$title = "About Our Company | ".$ste_root;
		$keywords = "comma, separated, keywords, go, here";	
		$description = '';
		$page_heading = '';	
	}
	
$_SESSION['temp_page_fields']['seo_name'] = $seo_name;
$_SESSION['temp_page_fields']['title'] = $title;
$_SESSION['temp_page_fields']['keywords'] = $keywords;
$_SESSION['temp_page_fields']['description'] = $description;
	



?>
