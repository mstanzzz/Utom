<?php
require_once($real_root.'/includes/class.customer_account.php');
require_once($real_root.'/includes/class.order.php');
$order = new Order;
$cust_id = $lgn->getCustId();
$cust_name = $lgn->getFullName($dbCustom,$cust_id);


$db = $dbCustom->getDbConnect(CART_DATABASE);
if(isset($_POST['add_house'])){

	$blob_image = (isset($_POST['house_blob_image'])) ? trim($_POST['house_blob_image']) : '';
	$house_name = (isset($_POST['house_name'])) ? trim(addslashes($_POST['house_name'])) : '';
	$house_custom_room = (isset($_POST['house_custom_room'])) ? trim(addslashes($_POST['house_custom_room'])) : '';

	$sql = "INSERT INTO idea_house
			(house_name, blob_image, user_id)
			VALUES('".$house_name."'
			,'".$blob_image."'
			,'".$cust_id."')";		
	$result = $dbCustom->getResult($db,$sql);

	$idea_house_id = $db->insert_id;

	$sql = "DELETE FROM idea_house_to_room
			WHERE idea_house_id = '".$idea_house_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$room_type=array();
	foreach($room_type as $val){

		$sql = "INSERT INTO idea_house_to_room
				(user_id
				,idea_house_id
				,idea_room_id)
				VALUES
				('".$cust_id."'
				,'".$idea_house_id."'
				,'".$val."')";
		$res = $dbCustom->getResult($db,$sql);
	}
	
}

function get_num_rooms($idea_house_id = 0){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT idea_house_to_room_id
			FROM  idea_house_to_room 
			WHERE idea_house_id = '".$idea_house_id."'";
	$result = $dbCustom->getResult($db,$sql);

	return $result->num_rows; 	
	
}
	
// get houses	
$sql = "SELECT idea_house.house_name
		,idea_house.blob_image
		,idea_house.idea_house_id
		FROM idea_house
		WHERE idea_house.user_id = '".$cust_id."'
	";
	// AND idea_folder.user_id = '".$cust_id."'
$result = $dbCustom->getResult($db,$sql);

$houses_array = array();
$i =1;
while($row = $result->fetch_object()){
	$houses_array[$i]['idea_house_id'] = $row->idea_house_id;
	$houses_array[$i]['house_name'] = $row->house_name;
	$houses_array[$i]['blob_image'] = $row->blob_image;
	$houses_array[$i]['num_rooms'] = get_num_rooms($row->idea_house_id);
	
	$i++;
}


//print_r($houses_array);
// all active rooms for select area 	
$sql = "SELECT idea_room_id, room_name
		FROM idea_rooms 
		WHERE active > '0'
		AND profile_account_id  = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$rooms_block = '';
while($row = $result->fetch_object()){

$rooms_block .= "<div class='checkbox'>";
$rooms_block .= "<input type='checkbox' name='room_type[]' class='check custom-checkbox' "; 
$rooms_block .= " id='checkbox-".$row->idea_room_id."' value='".$row->idea_room_id."'>";
$rooms_block .= "<label for='checkbox-1'>".$row->room_name."</label>";
$rooms_block .= "</div>";

}


$svg_idea_folder = '								
<svg id="Component_18_1" data-name="Component 18 – 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="88.333" height="70.265" viewBox="0 0 88.333 70.265">
<defs>
<linearGradient id="linear-gradient" x1="-3.495" y1="-5.332" x2="-3.556" y2="-9.089" gradientUnits="objectBoundingBox">
<stop offset="0" stop-color="#009ede"></stop>
<stop offset="1" stop-color="#00aeec"></stop>
</linearGradient>
</defs>
<g id="Group_447" data-name="Group 447" transform="translate(0 0)">
<g id="Group_446" data-name="Group 446" transform="translate(0 0)">
<image id="Rectangle_54" data-name="Rectangle 54" width="88.333" height="70.265" opacity="0.25" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply;isolation: isolate"></image>
<g id="Group_445" data-name="Group 445" transform="translate(2.133 2.133)">
<g id="Group_444" data-name="Group 444">
<path id="Path_349" data-name="Path 349" d="M149.031,136.228H189.4a7.854,7.854,0,0,1,2.2.321l7.6,0A5.715,5.715,0,0,0,193.51,131H148.315a5.044,5.044,0,0,1,.716,2.589Z" transform="translate(-117.663 -127.863)" fill="#e3bc00"></path>
<path id="Path_350" data-name="Path 350" d="M195.208,182.137h-1.046v1.044a6.448,6.448,0,0,1-3.713,5.523c4.682-1.148,6.709-4.475,6.833-9.7h-2.074Z" transform="translate(-115.741 -125.674)" fill="#e3bc00"></path>
<path id="Path_351" data-name="Path 351" d="M197.6,136h-.3l-7.6.137a5.678,5.678,0,0,1,3.072,1.954h2.95l-.015,42.87h1.871Z" transform="translate(-115.775 -127.635)" fill="#fff"></path>
<path id="Path_352" data-name="Path 352" d="M194.062,184.007h1.046V180.9L195.6,138h-2.95a5.3,5.3,0,0,1,1.412,3.491Z" transform="translate(-115.641 -127.544)" fill="#b8b8bd"></path>
<path id="Path_353" data-name="Path 353" d="M197.421,185.507V141.947a4.937,4.937,0,0,0-1.412-3.446,6.87,6.87,0,0,0-3.072-1.815,7.854,7.854,0,0,0-2.2-.321H150.368v-2.639a5.044,5.044,0,0,0-.716-2.589,6.892,6.892,0,0,0-5.9-3.137H124.859A5.577,5.577,0,0,0,119,133.726v51.781a6.04,6.04,0,0,0,5.859,6.276h65.877a6.6,6.6,0,0,0,2.973-.74A6.467,6.467,0,0,0,197.421,185.507Zm-68.451-54.37h15.125v5.228H125.274v-5.228Z" transform="translate(-119 -128)" fill="#ffd226"></path>
<path id="Path_354" data-name="Path 354" d="M125,136.228h18.821V131H125Z" transform="translate(-118.726 -127.863)" fill="#fff"></path>
</g>
</g>
</g>
</g>
<g id="Group_448" data-name="Group 448" transform="translate(31 25.249)">
<path id="Path_355" data-name="Path 355" d="M461.985,272.5l-3.668-.011c-.767-8.147-7.629-13.754-15.985-13.754a16.035,16.035,0,0,0-5.689,1.039c5.062,2.477,8.627,6.762,8.978,12.68l-3.65-.009c-1.222-.005-1.5.687-.62,1.533l8.961,8.626a2.357,2.357,0,0,0,3.214.014l9.066-8.586C463.481,273.192,463.207,272.5,461.985,272.5Z" transform="translate(-436.644 -258.733)" fill="url(#linear-gradient)"></path>
<path id="Path_356" data-name="Path 356" d="M478.242,322.6l-9.066,8.585a1.792,1.792,0,0,1-2.447-.009l-8.963-8.627c-.025-.024-.046-.046-.067-.069a.665.665,0,0,0-.271.086,1.1,1.1,0,0,0,.338.473l8.963,8.625a1.79,1.79,0,0,0,2.447.011l9.066-8.585a1.084,1.084,0,0,0,.342-.469.708.708,0,0,0-.276-.085C478.287,322.553,478.265,322.573,478.242,322.6Z" transform="translate(-452.675 -307.897)" fill="#7bd2f6"></path>
</g>
</svg>
';

?>







