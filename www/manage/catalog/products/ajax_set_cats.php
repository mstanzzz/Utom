<?php
$cat_array = (isset($_GET['cat_list']))? explode("|",$_GET['cat_list']) : array(); 

if(sizeof($cat_array) == 1){
	if($cat_array[0] == ''){
		$cat_array = array();
	}
}

if(sizeof($cat_array) > 0){
	foreach($_SESSION['temp_cats'] as $val){		
	if(!in_array($val['cat_id'] , $cat_array)){
			remove_cat($val['cat_id']);
		}
	}
}else{
	$_SESSION['temp_cats'] = array();
}

function remove_cat($cat_id){
	$t_array = array();
	$i = 0;
	foreach($_SESSION['temp_cats'] as $val){		
		if($val['cat_id'] != $cat_id){			
			$t_array[$i]['cat_id'] = $val['cat_id'];
			$t_array[$i]['name'] = $val['name'];
			$i++;	
		}
	}
	$_SESSION['temp_cats'] = $t_array;	
}

?>