<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Payment Processor";
$page_group = "order";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 


if(isset($_POST['set_active'])){


	// Update the user profile processor only
	
	/*
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "UPDATE payment_processor SET active = '0'";
$result = $dbCustom->getResult($db,$sql);	

	$the_active_processor = 0;

	// only 1 processor can be active
	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE payment_processor SET active = '1' WHERE payment_processor_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
			$the_active_processor = $value;
			break;
		}
	}



			$sql = "SELECT payment_processor_id
					FROM profile_account
					WHERE id = '".$_SESSION['profile_account_id']."'";
			$pp_res = mysql_query ($sql);
			if(!$pp_res)die(mysql_error());
			if(mysql_num_rows($pp_res) > 0){
				$pp_obj = mysql_fetch_object($pp_res);
				$acc_payment_processor_id = $pp_obj->payment_processor_id;
			}else{
				$acc_payment_processor_id = 0;
			}
			
			if($acc_payment_processor_id == )
			


	
	$msg = "The carriers have been selected";

	*/

}



if(isset($_POST["submit_credentials"])){

//echo "This is currently not available";
//exit;


	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$processor = trim($_POST["processor"]);
	if($processor == "braintree"){	

		$environment = trim(addslashes($_POST["environment"])); 
		$merchant_id = trim(addslashes($_POST["merchant_id"])); 
		$public_key = trim(addslashes($_POST["public_key"])); 
		$private_key = trim(addslashes($_POST["private_key"])); 
	
		// check if exists
		$sql = "SELECT braintree_credentials_id
				FROM braintree_credentials
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);        
		if($result->num_rows > 0){

		
			$sql = "UPDATE braintree_credentials
					SET environment = '".$environment."'
						,merchant_id = '".$merchant_id."'
						,public_key = '".$public_key."'
						,private_key = '".$private_key."'
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);			
		}else{
			$sql = "INSERT INTO braintree_credentials
					(environment
					,merchant_id
					,public_key
					,private_key
					,profile_account_id
					)VALUES(
					'".$environment."'
					,'".$merchant_id."'
					,'".$public_key."'
					,'".$private_key."'
					,'".$_SESSION['profile_account_id']."'
					)";
	$result = $dbCustom->getResult($db,$sql);			
			
		}
	}
}


require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/doc_header.php");
?>
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
		$bread_crumb->add("Ecommerce", $ste_root."manage/ecomsettings/ecommerce-landing.php");
		$bread_crumb->add("Payment Processor", '');
		echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		?>
		<form name="form" action="payment-processor.php" method="post" enctype="multipart/form-data">
			<?php if($admin_access->ecommerce_level > 1){ ?>
            <div class="page_actions">
				<button type="submit" name="set_active" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
			</div>
            <?php } ?>
			
            <div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<!--<th>Active</th>-->
							<th>Credentials</th>
							<th>Processor Name</th>
						</tr>
					</thead>
					<?php
						$db = $dbCustom->getDbConnect(CART_DATABASE);	
						$sql = "SELECT *
								FROM payment_processor";
				$result = $dbCustom->getResult($db,$sql);						
						$block = '';
						while($row = $result->fetch_object()) {
						// add radio buttons to choose processor.
							$block = "<tr>";
					
					
							/*					
							$db = $dbCustom->getDbConnect(USER_DATABASE);
							$sql = "SELECT payment_processor_id
									FROM profile_account
									WHERE id = '".$_SESSION['profile_account_id']."'";
							$pp_res = mysql_query ($sql);
							if(!$pp_res)die(mysql_error());
							if(mysql_num_rows($pp_res) > 0){
								$pp_obj = mysql_fetch_object($pp_res);
								$acc_payment_processor_id = $pp_obj->payment_processor_id;
							}else{
								$acc_payment_processor_id = 0;
							}
														
							if($acc_payment_processor_id == $row->payment_processor_id){
								$checked = "checked='checked'";	
							}else{
								$checked = '';	
							}
							
							$block .= "<td><div class='checkboxtoggle on'> <span class='ontext'>ON</span><a class='switch on' href='#'></a><span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='active[]' value='".$row->payment_processor_id."' $checked /></div></td>";	
							*/
					
							$block .= "<td>";
							$block .= "<a class='btn btn-primary fancybox fancybox.iframe' href='payment-processor-credentials.php?payment_processor_id=".$row->name."'>Credentials</a>";
							$block .= "</td>";
					
							$block .= "<td>";
							$block .= $row->name; 
							$block .= "</td>";
					
							$block .= "</tr>";
						}
						echo $block;
					?>
				</table>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/manage-footer.php");
?>
</div>
</body>
</html>