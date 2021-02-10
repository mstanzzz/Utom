<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.order_fulfillment.php");

$order_fulfillment = new OrderFulfillment;

$employee_id = (isset($_GET['employee_id'])) ? $_GET['employee_id'] : 0;

$db = $dbCustom->getDbConnect(USER_DATABASE);



	$sql = "SELECT admin_group.id
			FROM admin_group, admin_user_to_admin_group, admin_access, admin_section
			WHERE admin_group.id = admin_user_to_admin_group.admin_group_id
			AND admin_group.id = admin_access.admin_group_id
			AND admin_access.admin_section_id = admin_section.id
			AND admin_access.admin_section_level >= '2'
			AND admin_section.section_name = 'production'
			AND admin_user_to_admin_group.user_id = '".$employee_id."'";
	
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		
		echo 1;	
	}else{
		
		echo 0;
	}


								
	//echo $result->num_rows;



/*
                                $sql = "SELECT id, group_name
                                        FROM admin_group
                                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                                 $result = $dbCustom->getResult($db,$sql);
                                while($row = $result->fetch_object()) {
									
									$sql = "SELECT admin_section.section_name
											FROM admin_user_to_admin_group, admin_access, admin_section
											WHERE admin_user_to_admin_group.admin_group_id = admin_access.admin_group_id
											AND admin_access.admin_section_id = admin_section.id
											AND admin_section.section_name = 'production'
											AND admin_user_to_admin_group.user_id = '".$this_user_id."'
											AND admin_user_to_admin_group.admin_group_id = '".$row->id."'";
									
									$res = $dbCustom->getResult($db,$sql);
									
									echo "<br />".$res->num_rows; 

								}
		
*/								
									
		
		




?>