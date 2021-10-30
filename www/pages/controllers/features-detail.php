<?php
$icons_array = array();;

$db = $dbCustom->getDbConnect(CART_DATABASE);

function get_svg_icon($dbCustom, $svg_id){

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$ret_array['name']='';
	$ret_array['svg_code']='';	
	$ret_array['description']='';	
	
	$sql = "SELECT svg_code, name, description
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		$ret_array['name'] = $object->name;
		$ret_array['svg_code'] = $object->svg_code;		
		$ret_array['description'] = $object->description;		
		
	}
	return  $ret_array;
}
 
$svg_id = (isset($_GET['svg_id'])) ? $_GET['svg_id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;

if($svg_id > 0){
	$svg = get_svg_icon($dbCustom, $svg_id);	
	$svg_code = $svg['svg_code'];
	$name = $svg['name'];
	$description = $svg['description'];
}else{
	$svg_code = '<svg xmlns="http://www.w3.org/2000/svg" width="48.679" height="43"
					viewBox="0 0 48.679 43">
					<g id="drawers" transform="translate(0 -29.867)">
					<g id="Group_416" data-name="Group 416" transform="translate(0 29.867)">
					<g id="Group_415" data-name="Group 415" transform="translate(0 0)">
					<path id="Path_222" data-name="Path 222"
					d="M44.623,29.867H4.057A4.061,4.061,0,0,0,0,33.924V65.565A4.063,4.063,0,0,0,3.245,69.54v.893a2.437,2.437,0,0,0,2.434,2.434h4.868a2.437,2.437,0,0,0,2.434-2.434v-.811H35.7v.811a2.437,2.437,0,0,0,2.434,2.434H43a2.437,2.437,0,0,0,2.434-2.434V69.54a4.063,4.063,0,0,0,3.245-3.975V33.924A4.061,4.061,0,0,0,44.623,29.867ZM11.359,70.433a.812.812,0,0,1-.811.811H5.679a.812.812,0,0,1-.811-.811v-.811h6.491v.811Zm32.453,0a.812.812,0,0,1-.811.811H38.132a.812.812,0,0,1-.811-.811v-.811h6.491Zm3.245-4.868A2.437,2.437,0,0,1,44.623,68H4.057a2.437,2.437,0,0,1-2.434-2.434V33.924A2.437,2.437,0,0,1,4.057,31.49H44.623a2.437,2.437,0,0,1,2.434,2.434V65.565Z"
					transform="translate(0 -29.867)"></path>
					<path id="Path_223" data-name="Path 223"
					d="M75.511,64H34.945a.811.811,0,0,0-.811.811V96.453a.811.811,0,0,0,.811.811H75.511a.811.811,0,0,0,.811-.811V64.811A.811.811,0,0,0,75.511,64ZM74.7,95.642H35.757V86.717H74.7Zm0-10.547H35.757V76.17H74.7Zm0-10.547H35.757V65.623H74.7Z"
					transform="translate(-30.889 -60.755)"></path>
					<path id="Path_224" data-name="Path 224"
					d="M232.834,103a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,103Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,99.756Z"
					transform="translate(-208.494 -91.642)"></path>
					<path id="Path_225" data-name="Path 225"
					d="M232.834,213.935A2.434,2.434,0,1,0,230.4,211.5,2.434,2.434,0,0,0,232.834,213.935Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,210.69Z"
					transform="translate(-208.494 -192.029)"></path>
					<path id="Path_226" data-name="Path 226"
					d="M232.834,324.868a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,324.868Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,321.623Z"
					transform="translate(-208.494 -292.415)"></path>
					</g>
					</g>
					</g>
			</svg>';
	$name = 'Some Name';
	$description = 'Some description';
}

$items = $store_data->getCartItemsFromSvg($dbCustom,$svg_id);



?>




