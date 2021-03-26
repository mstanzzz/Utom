<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
//$module = new Module;
//module is instantiated in included script restrict_redirect.php  
$pages = new Pages;


$page_title = "";
$page_group = "page";

$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



if(isset($_GET['del_idea_rooms_id'])){
	
	$idea_rooms_id = (isset($_POST['idea_rooms_id'])) ? $_POST['idea_rooms_id'] : 0;  
	
	$sql = "DELETE FROM idea_rooms  
			WHERE idea_rooms_id = '".$idea_rooms_id."'";
	$result = $dbCustom->getResult($db,$sql);		
}



if(isset($_POST['add_idea_room'])){

	$name = (isset($_POST['name'])) ? trim(addslashes($_POST['name'])) : '';  

	$sql = "INSERT INTO idea_rooms 
			(name, profile_account_id)
			VALUES
			('".$name."', '".$_SESSION['profile_account_id']."')
			";
	$result = $dbCustom->getResult($db,$sql);

}


if(isset($_POST['update_idea_room'])){
	
	$name = (isset($_POST['name'])) ? trim(addslashes($_POST['name'])) : '';  
	$idea_rooms_id = (isset($_POST['idea_rooms_id'])) ? $_POST['idea_rooms_id'] : 0;  
	
	$sql = "UPDATE idea_rooms 
			SET name = '".$name."' 
			WHERE idea_rooms_id = '".$idea_rooms_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	
}

if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST["active"])) ? $_POST["active"] : array();  
	 	
	//print_r($actives);	
		
	$sql = "UPDATE idea_rooms SET active = '0' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	foreach($actives as $val){
		
		$sql = "UPDATE idea_rooms SET active = '1' WHERE idea_rooms_id = '".$val."'";
		$result = $dbCustom->getResult($db,$sql);
		
		echo $val;
		echo "<br />";
		
	}


	$msg = "Changes Saved.";

}



$room_list_array = array();
$sql = "SELECT idea_rooms_id, name, active
		FROM idea_rooms
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i = 0;
while($row = $result->fetch_object()){
	$room_list_array[$i]['idea_rooms_id'] = $row->idea_rooms_id;
	$room_list_array[$i]['name'] = $row->name;
	$room_list_array[$i]['active'] = $row->active;
	
	//echo $row->active;
	//echo "<hr>";
	
	
	$i++;	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<script>
function regularSubmit() {
  document.form.submit(); 
}	
</script>

</head>

<body>
<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		
		<h2>ROOM TYPES</h2>
<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large">
<i class="icon-ok icon-white"></i> Save Changes </a>



<a style="float:right; margin-right:50px;" class="btn btn-large btn-primary" href="add-idea-room.php">
<i class="icon-plus icon-white"></i> Add a Room </a>

	
		<form name="form" action="idea-folder.php" method="post">
        	<input type="hidden" name="set_active" value="1">

			<div class="data_table">
				<table cellpadding="15" cellspacing="0">
					<thead>
						<tr>
							<th width="30%">Name</th>
                            
							<th>Active</th>
							<th>Edit</th>
							<th></th>
						</tr>
					</thead>
                <?php
					$block = '';				
					foreach($room_list_array as $val){
				?>

					<tr> 
						<td><?php echo $val['name']; ?></td>
						<td>
						<div class='checkboxtoggle on ".$disabled." '> 
						<span class='ontext'>ON</span>
						<a class='switch on' href='#'></a>
						<span class='offtext'>OFF</span>
						<?php
$status = ($val['active'] > 0)? 'checked' : ''; 						
echo "<input type='checkbox' class='checkboxinput' name='active[]' value='".$val['idea_rooms_id']."' $status /></div>";
						
						?>
						</td>
						<td>
 						<?php  
echo "<a class='btn btn-primary'";
echo " href='edit-idea-room.php?idea_rooms_id=".$val['idea_rooms_id']."'> <i class='icon-cog icon-white'></i>Edit</a>";
						?>					
						</td>
						
						<td>
						<?php 
						$url_str = "idea-folder.php";
						$url_str .= "?del_idea_rooms_id=".$val['idea_rooms_id'];						
						?>
						<a style="color:red; font-size:18px;" href="<?php echo $url_str; ?>" >
						delete
						</a>
					
						</td>
							
						
						
						
					</tr>
						
				<?php } ?>
				
                </table>
			</div>
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
	</div>
	<p class="clear"></p>


</body>
</html>
