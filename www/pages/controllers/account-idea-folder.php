<?php

//$cust_id
$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['del_idea_folder_id'])){

	$idea_folder_id = (isset($_POST['del_idea_folder_id'])) ? $_POST['del_idea_folder_id'] : 0;
	$blob_image_id = (isset($_POST['blob_image_id'])) ? $_POST['blob_image_id'] : 0;
	
	//echo "idea_folder_id ".$idea_folder_id;
	//echo "<br />";
	//echo "blob_image_id ".$blob_image_id;
	//exit;

	$sql = "DELETE FROM blob_image
			WHERE blob_image_id = '".$blob_image_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM  idea_folder
			WHERE idea_folder_id = '".$idea_folder_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM idea_folder_to_room
			WHERE idea_folder_id = '".$idea_folder_id."'";
	$result = $dbCustom->getResult($db,$sql);
}

if(isset($_POST['add_house'])){

	$house_blob_image = (isset($_POST['house_blob_image'])) ? trim($_POST['house_blob_image']) : '';
	//echo $house_blob_image;	
	//exit;
	$sql = "INSERT INTO blob_image
			(blob_image)
			VALUES
			('".$house_blob_image."')";
	$result = $dbCustom->getResult($db,$sql);

	$blob_image_id = $db->insert_id;
	
	$house_name = (isset($_POST['house_name'])) ? trim(addslashes($_POST['house_name'])) : '';
	$house_custom_room = (isset($_POST['house_custom_room'])) ? trim(addslashes($_POST['house_custom_room'])) : '';

	$sql = "INSERT INTO idea_folder
			(name
			,type 
			,blob_image_id
			,user_id
			,profile_account_id)
			VALUES
			('".$house_name."'
			,'house'
			,'".$blob_image_id."'
			,'".$cust_id."'
			,'".$_SESSION['profile_account_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	$idea_folder_id = $db->insert_id;

	$sql = "DELETE FROM idea_folder_to_room
			WHERE idea_folder_id = '".$idea_folder_id."'";
	$result = $dbCustom->getResult($db,$sql);
			
	$room_type = (isset($_POST['room_type'])) ? $_POST['room_type'] : array();
	
	foreach($room_type as $val){

		$sql = "INSERT INTO idea_folder_to_room
				(idea_folder_id
				,room_id)
				VALUES
				('".$idea_folder_id."'
				,'".$val."')";
		$res = $dbCustom->getResult($db,$sql);
	}
}


function get_num_rooms($idea_folder_id = 0){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT idea_folder_to_room_id
			FROM idea_folder_to_room 
			WHERE idea_folder_id = '".$idea_folder_id."'";
	$result = $dbCustom->getResult($db,$sql);

	return $result->num_rows; 	
	
}

	

// get houses	
$sql = "SELECT idea_folder.name
		,idea_folder.idea_folder_id
		,idea_folder.blob_image_id
		,blob_image.blob_image
		FROM idea_folder, blob_image 
		WHERE idea_folder.blob_image_id = blob_image.blob_image_id
		
	";
	// AND idea_folder.user_id = '".$cust_id."'
$result = $dbCustom->getResult($db,$sql);

$houses_array = array();
$i = 1;
while($row = $result->fetch_object()){

	$houses_array[$i]['name'] = $row->name;
	$houses_array[$i]['idea_folder_id'] = $row->idea_folder_id;
	$houses_array[$i]['blob_image'] = $row->blob_image;
	$houses_array[$i]['blob_image_id'] = $row->blob_image_id;
	$houses_array[$i]['num_rooms'] = get_num_rooms($row->idea_folder_id);
	$houses_array[$i]['saves_items'] = 111;
	
	$i++;
}
//$houses_array = array();


// all active rooms for select area 	
$sql = "SELECT idea_rooms_id, name
		FROM idea_rooms
		WHERE active > '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$rooms_block = '';
$i = 1;
while($row = $result->fetch_object()){

														
	$rooms_block .= "<div class='checkbox'>
	<input  name='room_type[]' class='check custom-checkbox' id='checkbox-".$i."' type='checkbox' value='".$row->idea_rooms_id."'>
	<label for='checkbox-".$i."'>".$row->name."</label>
	</div>";

	$i++;	
}


?>

<!--
<div class="checkbox">
	<input type="checkbox" class="check custom-checkbox" id="checkbox-1" value="value1">
	<label for="checkbox-1">Living Room</label>
</div>
														
<div class="checkbox">
	<input class="check custom-checkbox" id="checkbox-2" type="checkbox" value="value2">
	<label for="checkbox-2">Bedroom</label>
</div>
														
<div class="checkbox">
	<input class="check custom-checkbox" id="checkbox-3" type="checkbox" value="value3">
	<label for="checkbox-3">Kitchen</label>
</div>
														
<div class="checkbox">
	<input class="check custom-checkbox" id="checkbox-3" type="checkbox" value="value3">
	<label for="checkbox-3">Kitchen</label>
</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-4" type="checkbox" value="value4">
															<label for="checkbox-4">Dining Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-5" type="checkbox" value="value5">
															<label for="checkbox-5">Family Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-6" type="checkbox" value="value6">
															<label for="checkbox-6">Guest Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-7" type="checkbox" value="value7">
															<label for="checkbox-7">Bathroom</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-8" type="checkbox" value="value8">
															<label for="checkbox-8">Game Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-9" type="checkbox" value="value9">
															<label for="checkbox-9">Basement</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-10" type="checkbox" value="value10">
															<label for="checkbox-10">Home Office</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-11" type="checkbox" value="value11">
															<label for="checkbox-11">Nursery</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-12" type="checkbox" value="value12">
															<label for="checkbox-12">Playroom</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-13" type="checkbox" value="value13">
															<label for="checkbox-13">Library</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-14" type="checkbox" value="value14">
															<label for="checkbox-14">Storage Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-15" type="checkbox" value="value15">
															<label for="checkbox-15">Gym Room</label>
														</div>
														
														<div class="checkbox">
															<input class="check custom-checkbox" id="checkbox-16" type="checkbox" value="value16">
															<label for="checkbox-16">Garage</label>
														</div>
-->