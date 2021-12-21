<?php
require_once($real_root.'/includes/class.customer_account.php');
require_once($real_root.'/includes/class.order.php');
$order = new Order;
$cust_id = $lgn->getCustId();
$cust_name = $lgn->getFullName($dbCustom,$cust_id);
$created_rooms = 22;
$saved_items = 33;

$spec_array = array();

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['upload_image'])){
	
	$upload_image = isset($_POST['upload_image'])? $_POST['upload_image'] : array();
	
	echo $upload_image[0];
	echo "<br />";
	
	print_r($_POST['upload_image']);
	
	//exit;
}


if(isset($_POST['add_spec'])){
	$idea_room_id = (isset($_POST['spec_room']))? $_POST['spec_room'] : '';
	$description = (isset($_POST['description']))? $_POST['description'] : '';
	$title = (isset($_POST['title']))? $_POST['title'] : '';
	
	$sql = "INSERT INTO idea_spec
			(idea_room_id,user_id,title,description)
			VALUES
			('".$idea_room_id."','".$cust_id."','".$title."','".$description."')			
			";	
	$result = $dbCustom->getResult($db,$sql);

}

$sql = "SELECT * FROM idea_spec
		WHERE user_id='".$cust_id."'";
$result = $dbCustom->getResult($db,$sql);
echo "idea_spec:   ".$result->num_rows; 
$i = 0;
while($row = $result->fetch_object()){
	$spec_array[$i]['idea_spec_id'] = $row->idea_spec_id;
	$spec_array[$i]['title'] = $row->title;
	$spec_array[$i]['description'] = $row->description;
	$spec_array[$i]['idea_spec_img_array']= array();	
	$sql = "SELECT * 
			FROM idea_spec_img
			WHERE idea_spec_id = '".$row->idea_spec_id."'";
	$res = $dbCustom->getResult($db,$sql);
	$idea_spec_img_array = array();
	$i=0;
	while($r = $res->fetch_object()){
		$idea_spec_img_array[$i]['img_id'] = $r->img_id;
		$i++;
	}
	$spec_array[$i]['idea_spec_img_array'] = $idea_spec_img_array;
	$i++;
}



$sql = "SELECT idea_room_id, room_name
		FROM idea_rooms 
		WHERE active > '0'
		AND profile_account_id  = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$rooms_block = '';
while($row = $result->fetch_object()){

$rooms_block .= "<a class='nav-link folder-nav__link js-hide-folder-nav' 
	id='".$row->idea_room_id."' data-toggle='pill' 
	href='#v-pills-all' role='tab' 
	aria-controls='v-pills-all' aria-selected='false'>
	ALL::: ".$row->room_name." <span>5 <span>items</span></span></a>";


}


?>
