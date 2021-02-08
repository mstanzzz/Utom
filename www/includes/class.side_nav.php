<?php

class SideNav {

	function __construct() {
	   
	   $t = '';
	   
	   if(!isset($_SESSION['side_nav_showroom_cats'])){

			$dbCustom = new DbCustom();
			$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);

			$sql = "SELECT name, showroom_cat_id 
					FROM showroom_category
					AND profile_account_id ='".$_SESSION['profile_account_id']."' 
					ORDER BY showroom_cat_id";
			$sr_c_res = mysql_query ($sql);
			
			$i = 0;
			while($sr_c_row = mysql_fetch_object($sr_c_res)) {
				
				/*
				$sql = "SELECT count(showroom_item_id) AS num_items 
						FROM showroom_item
						WHERE showroom_cat_id = '".$sr_c_row->showroom_cat_id."'";
				$sr_c_item_count_res = mysql_query ($sql);
				$sr_c_item_count = mysql_fetch_object($sr_c_item_count_res);
				*/
				
				$sql = "SELECT count(showroom_item_id) AS num_items 
						FROM showroom_item, showroom_category, showroom_sub_category 
						WHERE showroom_item.showroom_sub_cat_id = showroom_sub_category.showroom_sub_cat_id 
						AND showroom_sub_category.showroom_cat_id = showroom_category.showroom_cat_id 
						AND showroom_cat_id = '".$sr_c_row->showroom_cat_id."'";
				$sr_c_item_count_res = mysql_query ($sql);
				$sr_c_item_count = mysql_fetch_object($sr_c_item_count_res);
				
				
				//$item_count = $sr_c_row->showroom_cat_id;
				
				$t[$i]["showroom_cat_id"] = $sr_c_row->showroom_cat_id;
				$t[$i]['name'] = $sr_c_row->name;
				$t[$i]["num_items"] = $sr_c_item_count->num_items;
				
				$i++;
			}
			$_SESSION["side_nav_showroom_cats"] = $t;
			
	   }
	   
	}
	

	function getShowroomCatArray()
	{ 
		return $_SESSION["side_nav_showroom_cats"];
	} 


}

?>
