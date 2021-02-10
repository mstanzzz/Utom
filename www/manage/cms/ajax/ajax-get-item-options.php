<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

$_SESSION['cat_id'] = isset($_GET['cat_id'])? $_GET['cat_id'] : 0;

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT item.item_id
				,item.name
		FROM item, item_to_category
		WHERE item.item_id = item_to_category.item_id
		AND item.active = '1'
		AND item_to_category.cat_id = '".$_SESSION['cat_id']."' 
		AND item.profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

$block = "";
$block  .= "<select name='item_id' class='btn-default btn-small with-small-bottom-shadow with-small-dropdown' style='padding:4px; width:160px; margin-top:2px;'>";              
$block  .= "<option value='0'>Select</option>";    

while($row = $result->fetch_object()){
	$block  .= "<option value='".$row->item_id."'>".$row->name."</option>";    

}
$block  .= "</select>";

echo $block;
					
?>
