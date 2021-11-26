<?php
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.order_fulfillment.php");

$order_fulfillment = new OrderFulfillment;

$msg = '';
$progress = new SetupProgress;
$module = new Module;

$page_title = 'Admin Users';
$page_group = 'admin-users';

	

$db = $dbCustom->getDbConnect(USER_DATABASE);

if(isset($_POST['add_user'])){

	$name = trim(addslashes($_POST['name'])); 
	$user_name = trim(addslashes($_POST['user_name'])); 
	$password = trim(addslashes($_POST['password'])); 
	
	$admin_group_ids  = (isset($_POST['admin_group_id'])) ? $_POST['admin_group_id'] : array();
	
	$user_type_id  = 3;

	$password_salt = $aLgn->generateSalt();
	$password_hash = $aLgn->get_hash($password, $password_salt);

	$sql = sprintf("INSERT INTO user 
					(name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$name, $user_name, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
		
	$new_user_id = $db->insert_id;
	
	foreach($admin_group_ids as $val){
		$sql = "INSERT INTO admin_user_to_admin_group 
					(user_id, admin_group_id)
    			   VALUES('".$new_user_id."','".$val."')";
		$result = $dbCustom->getResult($db,$sql);
			
	}

}



if(isset($_POST['update_user'])){


	$name = trim(addslashes($_POST['name'])); 
	$user_name = trim(addslashes($_POST['user_name'])); 
	$this_user_id = $_POST["user_id"];

	//$password_salt = $aLgn->generateSalt();
	//$password_hash = $aLgn->get_hash($password, $password_salt);

	$admin_group_ids  = (isset($_POST['admin_group_id'])) ? $_POST['admin_group_id'] : array();

	$order_fulfillment_step_ids  = (isset($_POST['order_fulfillment_step_id'])) ? $_POST['order_fulfillment_step_id'] : array();

	
	foreach($order_fulfillment_step_ids as $val){
				
		$order_fulfillment->autoAssignEmp($this_user_id, $val);
		
	}


//echo "<br />";
//echo $user_name;
//echo "<br />";

	
	$sql = sprintf("UPDATE user 
					SET name = '%s'
					,username = '%s'
					WHERE id  = '%u'", 
					$name
					,$user_name
					,$this_user_id);
					
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM admin_user_to_admin_group 
			WHERE user_id = '".$this_user_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
		
	foreach($admin_group_ids as $val){
		$sql = "INSERT INTO admin_user_to_admin_group 
				(user_id, admin_group_id)
    		   VALUES('".$this_user_id."','".$val."')";
		$result = $dbCustom->getResult($db,$sql);
			
	}	
	
}


if(isset($_POST['del_user'])){
	$this_user_id = $_POST['del_user_id'];
	
	// if super admin, don't delete
	$sql = "SELECT user.id
			FROM user, user_type
			WHERE user.user_type_id = user_type.id			
			AND user_type.level = '4'
			AND user.id = '".$this_user_id."'";
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows == 0){		
		$sql = sprintf("DELETE FROM user WHERE id = '%u'", $this_user_id);
		$result = $dbCustom->getResult($db,$sql);
			
	
		$sql = sprintf("DELETE FROM customer_data WHERE id = '%u'", $this_user_id);
		$result = $dbCustom->getResult($db,$sql);
			
	
		$sql = "DELETE FROM admin_user_to_admin_group WHERE user_id = '".$this_user_id."'";
		$result = $dbCustom->getResult($db,$sql);
			
	}
}


if(isset($_POST["unlock"])){
	//$profile_account_id = $_POST['profile_account_id'];
	$this_user_id = $_POST["user_id"];
	
	$aLgn->unlock('', '', $this_user_id);

}

unset($_SESSION['admin_access']);
unset($_SESSION['paging']);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function() {

	$(".inline").click(function(){ 

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_user_id").val(f_id);
			
		}
		
		
	});

	$("a.inline").fancybox();
	
});

function show_msg(msg){
	alert(msg);
}

</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">

		<?php
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Administration", SITEROOT."/manage/general-admin/admin-landing.php");
		$bread_crumb->add("Admin Users", '');
        echo $bread_crumb->output();
		
		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        require_once($real_root.'/manage/admin-includes/admin-users-section-tabs.php');
		
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		
        if($admin_access->administration_level > 1){ 
		
			$url_str = 'add-admin-user.php';
			$url_str .= '?pagenum='.$pagenum;
			$url_str .= '&sortby='.$sortby;
			$url_str .= '&a_d='.$a_d;

		?>        
            <div class="page_actions">         
            <a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">
            <i class="icon-plus icon-white"></i> Add a New User </a> 
            </div>        
		<?php
		}


		$db = $dbCustom->getDbConnect(USER_DATABASE);
				
		
		$sql = "SELECT user.name AS name
				,user.username AS username
				,user.id AS user_id 	
				,user_type.label AS user_type_label
				,user_type.level AS user_type_level
				FROM  user, user_type  
				WHERE user.user_type_id = user_type.id
				AND user.profile_account_id = '".$_SESSION['profile_account_id']."'
				AND (user_type.level = '3' OR user_type.level = '4')";
				//AND user_type.label LIKE '%Admin%'			

		$nmx_res = $dbCustom->getResult($db,$sql);
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
						
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
						
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
		



		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY name DESC".$limit;
				}else{
					$sql .= " ORDER BY name".$limit;		
				}
			}
   
			if($sortby == 'username'){
				if($a_d == 'd'){
					$sql .= " ORDER BY username DESC".$limit;
				}else{
					$sql .= " ORDER BY username".$limit;		
				}
			}
			if($sortby == 'user_type_label'){
				if($a_d == 'd'){
					$sql .= " ORDER BY user_type_label DESC".$limit;
				}else{
					$sql .= " ORDER BY user_type_label".$limit;		
				}
			}

		}else{
			$sql .= " ORDER BY user.id".$limit;
		}

		
			$result = $dbCustom->getResult($db,$sql);		


			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "admin-users/admin-users.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}

?>
			<div class="data_table">
            <?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        
           					<th width="20%" <?php addSortAttr('username',true); ?>>
                            User Name
                            <i <?php addSortAttr('username',false); ?>></i>
                            </th>
           					<th width="20%" <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
							<th width="10%">Locked?</th>
           					<th width="15%" <?php addSortAttr('user_type_label',true); ?>>
                            User Type
                            <i <?php addSortAttr('user_type_label',false); ?>></i>
                            </th>
                            <th width="15%">Group Name</th>
							<th width="10%">&nbsp;</th>
							<th>Delete</th>
						</tr>
					</thead>
					<?php 
					while($row = $result->fetch_object()) {
						$block = "<tr>";					
						$block .= "<td valign='middle'>".$row->username."</td>";
						$block .= "<td valign='middle'>".stripslashes($row->name)."</td>";
						if($aLgn->isLocked('', '', $row->user_id)){ 
							$block .= "<td valign='middle'>";
							$block .= "<form action='admin-users.php' method='post'>";
							$block .= "<input type='hidden' name='user_id' value='".$row->user_id."' />";
							//$block .= "<input type='hidden' name='profile_account_id' value='".$row->profile_account_id."' />";
							$block .= "<button class='btn btn-small' type='submit' name='unlock'><i class='icon-lock'></i> Unlock</button>";
							$block .= "</form>";		
							$block .= "</td>";
						}
						else {
							$block .= "<td>No</td>";
						}
						
						//$block .= "<td>".$row->user_type_label."   ".$row->user_type_level."</td>";
						$block .= "<td>".$row->user_type_label."</td>";

						$sql = "SELECT admin_group.group_name  
								FROM admin_group, admin_user_to_admin_group 
								WHERE admin_group.id = admin_user_to_admin_group.admin_group_id
								AND admin_user_to_admin_group.user_id = '".$row->user_id."'";
						
						$res = $dbCustom->getResult($db,$sql);
						
						$block .= "<td>";
						while($g_row = $res->fetch_object()){
							$block .= $g_row->group_name."<br />";;
						}
						$block .= "</td>";
														
						$url_str = "edit-admin-user.php";
						$url_str .= "?user_id=".$row->user_id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;


						$block .= "<td><a class='btn btn-primary btn-small' href='".$url_str."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";
						
						// if super admin, don't allow delete						
						if($user_type_level != 4){
							$disabled = ($admin_access->administration_level < 2)? 'disabled' : '';
							$block .= "<td valign='middle'><a class='btn btn-danger confirm ".$disabled." '><i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->user_id."' class='itemId' value='".$row->user_id."' /></a></td>";
						}
						$block .= "</tr>";
						echo $block;
					
					}
					?>
				</table>
			<?php
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $last, 'admin-users/admin-users.php', $sortby, $a_d);
			}
			?>
			</div>
	</div>
	<p class="clear"></p>
	<?php 
require_once("../admin-includes/manage-footer.php");

	$url_str = "admin-users.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;

?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this user? This cannot be undone.</h3>
	<form name="del_user_form" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_user_id" class="itemId" type="hidden" name="del_user_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_user" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>
