<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');
$progress = new SetupProgress;
$module = new Module;

$page_title = "Batch Action";
$page_group = "batch";

//	

$msg = '';

function get_product_name($item_id, $dbCustom){
	
	$ret = 'n';

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT name
			FROM item  
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$ret = $object->name;	
	}

	return $ret;	
}



$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$action = (isset($_GET['action'])) ? $_GET['action'] : '';

$cat_array = array();
$item_array = array();

$cat_array[] = $cat_id;

$db = $dbCustom->getDbConnect(CART_DATABASE);

// CLEAN UP
/*
	$sql = "SELECT item_id
			FROM item_to_category";  
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $result->fetch_object()){
		
		$sql = "SELECT item_id
			FROM item  
			WHERE item_id = '".$row->item_id."'";
		$res = $dbCustom->getResult($db,$sql);
		if($res->num_rows == 0){
			$sql = "DELETE FROM item_to_category
					WHERE item_id = '".$row->item_id."'";
			$r = $dbCustom->getResult($db,$sql);
			
			echo "n  ".$row->item_id;
			echo "<br />";		
		}else{
			
			echo " -- ".get_product_name($row->item_id, $dbCustom);
			echo "<br />";
		}
		
	}
	
*/



$sql = "SELECT child_cat_id 
	FROM child_cat_to_parent_cat 
	WHERE parent_cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	
	while($row = $result->fetch_object()){
		
		$cat_array[] = $row->child_cat_id;
		
	}
	
}

foreach($cat_array as $v){

	$sql = "SELECT item_id  
		FROM item_to_category 
		WHERE cat_id = '".$v."'";
	$result = $dbCustom->getResult($db,$sql);
	
	while($row = $result->fetch_object()){
		$item_array[] = $row->item_id;
	}
		
}


if($action == 'set_call_for_price'){


	
	foreach($item_array as $v){
		$sql = "UPDATE item  
				SET call_for_pricing = '1' 
				WHERE item_id = '".$v."'";
		$result = $dbCustom->getResult($db,$sql);
	}

//print_r($item_array);
//echo "uuuu";
//exit;


}

if($action == 'remove_call_for_price'){
	
	foreach($item_array as $v){
		$sql = "UPDATE item  
				SET call_for_pricing = '0' 
				WHERE item_id = '".$v."'";
		$result = $dbCustom->getResult($db,$sql);
	}

}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

</head>
<body class="lightbox">
<div class="lightboxholder">

<?php



if($action == 'set_call_for_price'){
	
	echo "The following products now have \"Call For Pricing\"";
	echo "<br />";
	echo "<br />";
	foreach($item_array as $v){
		echo $v." -- ".get_product_name($v,$dbCustom);
		echo "<br />";
	}

}

if($action == 'remove_call_for_price'){

	echo "The following products now do not have \"Call For Pricing\"";
	echo "<br />";
	echo "<br />";
	foreach($item_array as $v){
		echo get_product_name($v,$dbCustom);
		echo "<br />";
	}

}


?>





</div>
</body>
</html>

