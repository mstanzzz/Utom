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
$msg = '';
$progress = new SetupProgress;
$module = new Module;

$page_title = "Admin Groups";
$page_group = "admin";

	

$msg = '';
$db = $dbCustom->getDbConnect(USER_DATABASE);

if(isset($_POST['add_admin_group'])){
	 
	$group_name = trim(addslashes($_POST["group_name"]));
	
	$sql = sprintf("INSERT INTO admin_group
					(group_name, profile_account_id)
					VALUES
					('%s', '%u')", 
					$group_name, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);	
	$new_group_id = $db->insert_id;


	$sql = "SELECT id 
			FROM admin_section";
	if(getProfileType() != "master"){
		$sql .= " WHERE section_name != 'master'";	
	}
	$result = $dbCustom->getResult($db,$sql);	
	
	while($row = $result->fetch_object()){
		
		$val = (isset($_POST[$row->id])) ? $_POST[$row->id] : 0;
		$sql = "INSERT INTO admin_access
				(admin_group_id, admin_section_id, admin_section_level)
				VALUES
				('".$new_group_id."', '".$row->id."', '".$val."')	";
		$res = $dbCustom->getResult($db,$sql);

	}

}

if(isset($_POST['edit_admin_group'])){

	$group_name = trim(addslashes($_POST["group_name"]));
	
	$admin_group_id = $_POST["admin_group_id"];
	
	$sql = sprintf("UPDATE admin_group
					SET group_name = '%s'
					WHERE id = '%u'", 
					$group_name, $admin_group_id);
	$result = $dbCustom->getResult($db,$sql);	

	$sql = "DELETE FROM admin_access WHERE admin_group_id = '".$admin_group_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "SELECT id 
			FROM admin_section";
	$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
		
		$val = (isset($_POST[$row->id])) ? $_POST[$row->id] : 0;
		
		$sql = "INSERT INTO admin_access
				(admin_group_id, admin_section_id, admin_section_level)
				VALUES
				('".$admin_group_id."', '".$row->id."', '".$val."')	";
		$res = $dbCustom->getResult($db,$sql);

	}

}

if(isset($_POST["del_group"])){

	$admin_group_id = $_POST["del_group_id"];
	
	// don't delete if only 1 group
	$sql = "SELECT id 
			FROM admin_group
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 1){			

		$sql = "DELETE FROM admin_group WHERE id = '".$admin_group_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
	
		$sql = "DELETE FROM admin_user_to_admin_group WHERE admin_group_id = '".$admin_group_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
	
		$sql = "DELETE FROM admin_access WHERE admin_group_id = '".$admin_group_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
	}

}

unset($_SESSION['admin_access']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>

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
		<?php 
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Administration", $ste_root."manage/general-admin/admin-landing.php");
		$bread_crumb->add("Admin Groups", '');
        echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/admin-users-section-tabs.php");
		
		
		if($admin_access->administration_level > 1){ ?>        
            <div class="page_actions">         
            <a class="btn btn-large btn-primary" href="add-admin-group.php">
            <i class="icon-plus icon-white"></i> Add a Group </a> 
            </div>        
		<?php } ?>        
			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Group Name</th>
							<th>&nbsp;</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<?php 
					$db = $dbCustom->getDbConnect(USER_DATABASE);
					$sql = "SELECT group_name, id
							FROM  admin_group
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							ORDER BY id";
					$result = $dbCustom->getResult($db,$sql);					
					$num_groups = $result->num_rows;
					while($row = $result->fetch_object()) {
						$block = "<tr>";
						$block .= "<td valign='top'>$row->group_name</td>";
						$block .= "<td><a class='btn btn-primary btn-small' href='edit-admin-group.php?admin_group_id=".$row->id."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";
						// if only one group, don't allow delete
						if($num_groups > 1){
							$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
							$block .= "<td valign='middle'><a class='btn btn-danger confirm ".$disabled." '><i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->id."' class='itemId' value='".$row->id."' /></a></td>";
						}
						$block .= "</tr>";
						
						echo $block;
					}
					?>
				</table>
			</div>
	</div>
	<p class="clear"></p>
	<?php 
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
</div>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this group?</h3>
	<form name="del_group_form" action="admin-groups.php" method="post" target="_top">
		<input id="del_group_id" class="itemId" type="hidden" name="del_group_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_group" type="submit" >Yes, Delete</button>
	</form>
</div>



</body>
</html>



