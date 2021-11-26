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

$progress = new SetupProgress;
$module = new Module;

$page_title = "Order Process Definitions";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");	
$lgn = new CustomerLogin;

//echo $_SERVER['DOCUMENT_ROOT'];


$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['order_state_ids'])){
	$order_state_ids = (isset($_POST['order_state_ids']))? $_POST['order_state_ids'] : array();	
	$names = (isset($_POST['names']))? $_POST['names'] : array();
	$descriptions = (isset($_POST['descriptions']))? $_POST['descriptions'] : array();
	foreach($order_state_ids as $key => $value){
		if(isset($names[$key]) && isset($descriptions[$key])){
			$sql = "UPDATE order_state
					SET name = '".$names[$key]."', description = '".$descriptions[$key]."' 
					WHERE order_state_id = '".$value."'";  
			$result = $dbCustom->getResult($db,$sql);
			
		}
		//echo "key: ".$key."   value: ".$value."<br />"; 
	}
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function() {


});
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
		
		$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';

		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		/*
		if($ret_page == "customer-list"){	
			$bread_crumb->add("Customer List", SITEROOT."//manage/customer/customer-list.php");
		}		
		if($ret_page == "customer-landing"){	
			$bread_crumb->add("Customers", SITEROOT."//manage/customer-landing.php");
		}
		*/
		$bread_crumb->add("Process Definitions", '');
		echo $bread_crumb->output();
		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');


		$db = $dbCustom->getDbConnect(CART_DATABASE);
						
		$sql = "SELECT * 
				FROM  order_state
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		


		?>
		<form name='form' action='process-definition.php' method='post'>
			<div class="data_table">

				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="20$">Precess Name</th>
							<th>Precess Description</th>
						</tr>
					</thead>
					<?php
					
						$block = '';
						while($row = $result->fetch_object()) {
							
							$block .= "<input type='hidden' name='order_state_ids[]' value='".$row->order_state_id."'";
							
							$block .= "<tr>";
							
							$block .= "<td><input type='text' name='names[]' value='".$row->name."' /></td>";
							
							$block .= "<td><input style='width:600px;' type='text' name='descriptions[]' value='".$row->description."' /></td>";
						
							$block .= "</tr>";
						}
						
						$block .= "<tr>";
						
						$block .= "<td colspan='2'><input type='submit' name='submit' value='Submit' /></td>";
							
						$block .= "</tr>";
						
						echo $block;
					?>
				</table>
				
			</div>
		</form>
	</div>
    
    
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html><?php  



								

?>
