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

$page_title = "Add-on Settings";
$page_group = "admin";
$msg = '';

	

if(isset($_POST['set_addons'])){

	$db = $dbCustom->getDbConnect(USER_DATABASE);
		
	$sql = "UPDATE profile_account_to_module 
			SET hide = '1'
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	

	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"];
		 
		foreach($module_ids as $value){
			$sql = "UPDATE profile_account_to_module
			 		SET hide = '0'
					WHERE module_id = '".$value."'
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	
	
	//$module->resetSasFeeAmount($_SESSION['profile_account_id']);

	/*
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT *
			FROM braintree_credentials
			WHERE braintree_credentials_id = '1'";
$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
		$c_obj = $result->fetch_object();
		$environment = $c_obj->environment;
		$merchant_id = $c_obj->merchant_id;
		$public_key = $c_obj->public_key;
		$private_key = $c_obj->private_key;
	}else{
	
		$environment = '';
		$merchant_id = "jzy3nhzv2pvdvp78";
		$public_key = "fms727dhnfcnwyb7";
		$private_key = "wqrcz6qgz28kdqtx";
				
	}
	
	Braintree_Configuration::environment($environment);
	Braintree_Configuration::merchantId($merchant_id);
	Braintree_Configuration::publicKey($public_key);
	Braintree_Configuration::privateKey($private_key);
			
	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT braintree_subscription_id, braintree_recurring_billing_amount 
			FROM profile_account 
			WHERE id = '".$_SESSION['profile_account_id']."'
		"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		
		$s_obj = $result->fetch_object();

		$result = Braintree_Subscription::update($s_obj->braintree_subscription_id, array('price' => $s_obj->braintree_recurring_billing_amount));

		if(!$result->success){
			foreach($result->errors->deepAll() AS $error) {
				$msg .= $error->code." : ".$error->message . "</br>"; 
			}		
		}	

	}
		
	*/
	
	
}



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>


function validate(theform){	

	
	return true;

}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}

function checkPercent(str){
	
	var ret = 1;
	
	if(!IsNumeric(str)){
		alert("Please enter valid numbers only");
		ret = 0;	
	}else{	
		if(str != 0 && str <= 1){
			alert("Please enter 0 or a number greater than 1");
			ret = 0;
		}
		
		if(str >= 100){
			alert("Please enter a number less than 100");
			ret = 0;
		}
	}
	
	return ret;
}

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
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
        require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Administration", SITEROOT."/manage/general-admin/admin-landing.php");
		$bread_crumb->add("Add-on Settings", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		
    	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		?>
        <form name="edit_addons_form" action="add-ons.php " method="post" onSubmit="return validate(this);">

            <div class="page_actions edit_page">
				<?php if($admin_access->administration_level > 1){ ?>
                    <button type="submit" name="set_addons" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes</button>
                    <hr />
                 <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to make this change.
                    </div>            
                <?php } ?>
			</div>


			<div class="page_content edit_page">
			<div class='alert alert-info'><span class='fltlft'><i class='icon-info-sign icon-white'></i></span>Select the add-on options you wish to enable.</div>
				<fieldset>
				<?php
				
				$db = $dbCustom->getDbConnect(USER_DATABASE);
				
				$sql = "SELECT module.id, module.name   
					FROM profile_account_to_module, module
					WHERE profile_account_to_module.module_id = module.id 
					AND profile_account_id = '".$_SESSION['profile_account_id']."'";
					$result = $dbCustom->getResult($db,$sql);					
					$block = '';
					while($row = $result->fetch_object()) {
						
						$sql = "SELECT id 
						FROM profile_account_to_module
						WHERE module_id = '".$row->id."'
						AND hide = '0' 
						AND profile_account_id = '".$_SESSION['profile_account_id']."'";
						
						$res = $dbCustom->getResult($db,$sql);

						if($res->num_rows > 0){
							$checked = "checked='checked'"; 
						}else{
							$checked = '';
						}
						$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
						$block .= "<h3><div class='checkboxtoggle on fltlft mR15 ".$disabled." '> 
						<span class='ontext'>ON</span><a class='switch on' href='#'></a>
						<span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='module_ids[]' value='".$row->id."' ".$checked." /></div>".$row->name."</h3><hr />";
					}
					echo $block;
				?>
        </fieldset>
		</div>
        </form>

</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>       

</div>
</body>
</html>



