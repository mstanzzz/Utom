<?php
$cat_id = (isset($_GET['cat_id']))? $_GET['cat_id'] : 0; 

if($cat_id > 0){
	
	$t_array = array();
	$i = 0;
	if(is_array($_SESSION['temp_item_cats'])){
		foreach($_SESSION['temp_item_cats'] as $val){		
			if($val['cat_id'] != $cat_id){			
				$t_array[$i]['cat_id'] = $val['cat_id'];
				$t_array[$i]['name'] = $val['name'];
				$i++;	
			}
		}
	}

	$_SESSION['temp_item_cats'] = $t_array;	
}
?>