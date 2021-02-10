<?php
	$ret = '';
	
	foreach($_SESSION['temp_item_cats'] as $val){		

		$ret .= $val['cat_id']."|";

	}

	echo $ret;
	
?>