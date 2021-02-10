<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$temp_attr_ids = getCatAttrArray($cat_id);

$block = '';

$block .= "Restrict which product attributes are available in this category. Leave blank to allow all attributes for products in this category.";

$block .= "<select id='r_attr' multiple='multiple' name='restricted_attributes[]' data-placeholder='Type or Select Attributes' style='width: 220px;' >";
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT attribute_id, attribute_name
		FROM  attribute
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."' 
		ORDER BY attribute_id";
$res = $dbCustom->getResult($db,$sql);
while($attr_row = $res->fetch_object()) {
				
	if(in_array($attr_row->attribute_id , $temp_attr_ids)){
		$sel = "selected";	
	}else{
		$sel = '';
	}
	
	$block .= "<option value='".$attr_row->attribute_id."' $sel>".stripslashes($attr_row->attribute_name)."</option>";
}
$block .= "</select>";

echo $block;