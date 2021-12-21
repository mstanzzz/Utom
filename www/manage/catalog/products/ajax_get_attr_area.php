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
require_once($real_root."/includes/accessory_cart_functions.php");

$last_indx = sizeof($_SESSION['temp_item_cats'])-1;	

function get_main_attr_name($attribute_id, $dbCustom){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT attribute_name
			FROM attribute
			WHERE attribute_id = '".$attribute_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		return $object->attribute_name;	
	}
	
	return '';
	
}


if($last_indx > -1){
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT DISTINCT attribute.attribute_id, attribute.attribute_name
			FROM  attribute, category_to_attr
			WHERE attribute.attribute_id = category_to_attr.attribute_id
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	$i = 0;
	 	$sql .= " AND (";
		foreach($_SESSION['temp_item_cats'] as $cat_v){	
			$sql .= " category_to_attr.cat_id = '".$cat_v['cat_id']."'";
			if($i < $last_indx){
				$sql .= " OR ";
			}
			$i++;	
		}
		$sql .= " )";


	$res = $dbCustom->getResult($db,$sql);
	
	$attr_array = array();
	$i = 0;
	while($attr_row = $res->fetch_object()) {
		$attr_array[$i]['attribute_id'] = $attr_row->attribute_id;
		$attr_array[$i]['attribute_name'] = $attr_row->attribute_name;
		$i++;
	}
	
	
	$block = '';
	
	if($_SESSION['temp_item_fields']['parent_item_id'] == 0){
		if(count($attr_array) > 0){
			$block .= "<div class='colcontainer formcols'>";	
			$block .= "<div class='twocols'><label>Choose Main Dynamic Attribute</label></div>";
			$block .= "<div class='twocols'>";				
			$block .= "<select id='main_attr_id' name='main_attr_id' style='width:230px'>";
			foreach($attr_array as $val){	
				$sel = ($val['attribute_id'] == $_SESSION['temp_item_fields']['main_attr_id'])? 'selected' : '';				
				$block .= "<option value='".$val['attribute_id']."' $sel>".stripslashes($val['attribute_name'])."</option>";
			}
			$block .= "</select>";
			$block .= "</div></div><hr />";
		}
	}else{
		
		$block .= "<div class='colcontainer formcols'>";	
		$block .= "<div class='twocols'><label>Main Dynamic Attribute</label></div>";
		$block .= "<div class='twocols'>";
		$main_attr_name = get_main_attr_name($_SESSION['temp_item_fields']['main_attr_id'], $dbCustom);
		$block .= $main_attr_name;
		$block .= "</div></div><hr />";
		
	}


	if(count($attr_array) > 0){
			
		$block .= "<div class='colcontainer formcols'>";	
		$block .= "<div class='twocols'><label>Choose Dynamic Attribute Options</label></div>";
		$block .= "<div class='twocols'>";				
		
		//while($attr_row = mysql_fetch_object($attr_res)) {
		
		
		foreach($attr_array as $val){	
			
			//echo $val['attribute_name'];
			//echo "<br />";
								
			$sql = "SELECT opt_id, opt_name
					FROM  opt, attribute 
					WHERE opt.attribute_id = attribute.attribute_id
					AND opt.attribute_id = '".$val['attribute_id']."' 
					ORDER BY opt_id";
			$res = $dbCustom->getResult($db,$sql);
			
			if($res->num_rows > 0){
				$block .= "<label>".stripslashes($val['attribute_name'])."</label>";
				//$block .= "<select id='attr_".$attr_row->attribute_id."' class='chosen' multiple='multiple' name='attr_".$attr_row->attribute_id."[]' style='width:230px'>";
				$block .= "<select id='attr_".$val['attribute_id']."' name='attr_".$val['attribute_id']."' style='width:230px'>";
				$block .= "<option value='0'>N/A</option>";
				
				while($opt_row = $res->fetch_object()) {
					
					
					$sel = (in_array($opt_row->opt_id, $_SESSION['temp_attr_opt_ids']))? "selected" : '';
					
					$block .= "<option value='".$opt_row->opt_id."' $sel>".stripslashes($opt_row->opt_name)."</option>";
				}
				
				
			}
			$block .= "</select>";
		}		
		$block .= "</div></div><hr />";
		echo $block;
	}
}

?>


