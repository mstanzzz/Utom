<?php

if(isset($_SESSION['page_bc_array'])){

	if(is_array($_SESSION['page_bc_array'])){
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "DELETE FROM bread_crumb 
				WHERE page = '".$page."' 
				AND profile_account_id = '".$_SESSION['profile_account_id']."'"; 
		$result = $dbCustom->getResult($db,$sql);
		
		$_SESSION['page_bc_array'] = multi_unique($_SESSION['page_bc_array']);	
		$max_display_order = 0;
		
		foreach($_SESSION['page_bc_array'] as $val){ 
			if($max_display_order < $val['display_order']) $max_display_order = $val['display_order'];
			$sql = "INSERT INTO bread_crumb
					(text, page_seo_id, display_order, page, profile_account_id)
					VALUES
					('".$val['text']."', '".$val['page_seo_id']."', '".$val['display_order']."', '".$page."', '".$_SESSION['profile_account_id']."')";
			$res = $dbCustom->getResult($db,$sql);
		}
		
		$max_display_order++;	
		$sql = "INSERT INTO bread_crumb
				(text, display_order, page, is_end_point, profile_account_id)
				VALUES
				('".$_SESSION['bc_page_title']."',  '".$max_display_order."', '".$page."', '1', '".$_SESSION['profile_account_id']."')";
		
		$res = $dbCustom->getResult($db,$sql);			
	}
}
unset($_SESSION['page_bc_array']);
unset($_SESSION['bc_page_title']);
?>