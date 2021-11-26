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

$page_title = "Basic Settings";
$page_group = "admin-users";
$msg = '';

	

if(isset($_POST['edit_account'])){

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$days = trim(addslashes($_POST["days"])); 
	$hours = trim(addslashes($_POST["hours"])); 
	$sql = sprintf("UPDATE company_info 
				SET days = '%s'
				,hours = '%s'
				WHERE profile_account_id = '%u'", 
				$days
				,$hours
				,$_SESSION['profile_account_id']
				);

	$result = $dbCustom->getResult($db,$sql);
	


	$db = $dbCustom->getDbConnect(USER_DATABASE);
		
	$company = trim(addslashes($_POST["company"])); 
	//SITEROOT_name = trim(addslashes($_POST["domain_name"])); 
	$email = trim(addslashes($_POST["email"])); 
	$contact_email = trim(addslashes($_POST["contact_email"])); 
	$name_first = trim(addslashes($_POST["name_first"])); 
	$name_last = trim(addslashes($_POST["name_last"])); 
	$phone = trim(addslashes($_POST["phone"])); 
	$address = trim(addslashes($_POST["address"])); 
	$city = trim(addslashes($_POST["city"])); 
	$state = trim(addslashes($_POST["state"])); 
	$zip = trim(addslashes($_POST["zip"])); 
	//$is_shipping_charges = isset($_POST["is_shipping_charges"]) ? $_POST["is_shipping_charges"] : 0;
	
	$user_type_id  = 7;
		
	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	
	if($admin_password != ''){
		$update_pwd = 1;
		$password_salt = $aLgn->generateSalt();
		$password_hash = $aLgn->get_hash($admin_password, $password_salt);
	
		$progress->completeStep("password" ,$_SESSION['profile_account_id']);
	
	
	}else{
		$update_pwd = 0;
	}
	
	$sql = "SELECT id 
			FROM user 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			AND user_type_id = '".$user_type_id."'"; 
	$result = $dbCustom->getResult($db,$sql);
		
	if($result->num_rows > 0){
		
		$id_obj = $result->fetch_object();
		$t_user_id = $id_obj->id; 
		
		$sql = sprintf("UPDATE user 
					SET name = '%s'
					,username = '%s'
					,visited = '%s'
					WHERE id = '%u'
					", 
					$admin_name
					,$admin_username
					,date('Y-m-d H:i:s')
					,$t_user_id
					);
		$res = $dbCustom->getResult($db,$sql);
			
		
		
		if($update_pwd){		
			$sql = "UPDATE user 
					SET 
					password_hash = '".$password_hash."' 
					,password_salt = '".$password_salt."'
					WHERE id = '".$t_user_id."'
					";
					
			
		$pw_res = $dbCustom->getResult($db,$sql);
					
		}
		
	}else{
		
		$sql = sprintf("INSERT INTO user (name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$admin_name, $admin_username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $_SESSION['profile_account_id']);

		$result = $dbCustom->getResult($db,$sql);
			

		$t_user_id = $db->insert_id;
		
		$sql = "SELECT id
				FROM admin_access
				ORDER BY id";
		$result = $dbCustom->getResult($db,$sql);
			
		while($row = $result->fetch_object()){
			$sql = "INSERT INTO user_admin_access_index 
					(admin_access_id, user_id) 
					VALUES( '".$row->id."', '".$t_user_id."')";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	
	$sql = sprintf("UPDATE profile_account 
				SET company = '%s'
				,email = '%s'
				,contact_email = '%s'
				,name_first = '%s'
				,name_last = '%s'
				,phone = '%s'
				,address = '%s'
				,city = '%s'
				,state = '%s'
				,zip = '%s'
				WHERE id = '%u'", 
				$company
				,$email
				,$contact_email
				,$name_first
				,$name_last
				,$phone
				,$address
				,$city
				,$state
				,$zip
				,$_SESSION['profile_account_id']
				);

	$result = $dbCustom->getResult($db,$sql);

	
	$progress->completeStep("profile" ,$_SESSION['profile_account_id']);

	//header('Location: start.php');
	
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
		$bread_crumb->add("Administration", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		
		
		$db = $dbCustom->getDbConnect(USER_DATABASE); 
		$sql = sprintf("SELECT * FROM profile_account WHERE id = '%u'", $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();	
			$company = $object->company; 
			$email = $object->email;
			$contact_email = $object->contact_email;
			$name_first = $object->name_first;
			$name_last = $object->name_last;
			$phone = $object->phone;
			$address = $object->address;
			$city = $object->city;
			$state = $object->state;
			$zip = $object->zip;
			
		}else{
			$company = ''; 
			$email = '';
			$contact_email = '';
			$name_first = '';
			$name_last = '';
			$phone = '';
			$address = '';
			$city = '';
			$state = '';
			$zip = '';
			
		}



		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT *
				FROM company_info
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);				
		if($result->num_rows){
			$company_obj = $result->fetch_object();	
			$days = $company_obj->days;
			$hours = $company_obj->hours;
		}else{
			$days = '';
			$hours = '';
		}



		
        ?>
		<form name="edit_company_profile_form" action="edit-company-profile.php " method="post" onSubmit="return validate(this);">
            <div class="page_actions edit_page">
			<?php if($admin_access->administration_level > 1){ ?>
				<button name="edit_account" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
				<hr />
             <?php }else{ ?>
            	<div class="alert">
                	<i class="icon-warning-sign"></i>         
                    Sorry, you don't have the permissions to edit this information.
                </div>            
			<?php } ?>
			</div>

			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<div class="colcontainer">
						<div class="twocols">
							<label>company</label>
						</div>
						<div class="twocols">
							<input type="text" name="company"  maxlength="160" size="30" value="<?php echo stripslashes($company);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>Domain Name</label>
						</div>
						<div class="twocols">
                        	<?php echo $object->domain_name;  ?>
                        </div>
					</div>
					<div class="colcontainer">
						<?php
						$db = $dbCustom->getDbConnect(USER_DATABASE);

						$sql = "SELECT name, username 
								FROM user 
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
								AND user_type_id = '7'"; 
						$result = $dbCustom->getResult($db,$sql);
							
						if($result->num_rows > 0){
							$u_obj = $result->fetch_object();	
							$admin_name = $u_obj->name;
							$admin_username = $u_obj->username;
						}else{
							$admin_name = '';
							$admin_username = '';	
						}

					// if super admin
					if($aLgn->getUserLevel() == 4 ){
					
					?>
						<div class="twocols">
							<label>Administrator name</label>
						</div>
						<div class="twocols">
							<input type="text" name="admin_name"  maxlength="160" size="30" value="<?php echo stripslashes($admin_name);  ?>"/>
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>Administrator username</label>
						</div>
						<div class="twocols">
							<input type="text" name="admin_username"  maxlength="160" size="30" value="<?php echo $admin_username;  ?>"/>
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label> Administrator password </label>
							<span>leave blank unless you want to change the password</span> </div>
						<div class="twocols">
							<input type="password" name="admin_password"  maxlength="160" size="30" value=''/>
						</div>
					</div>

					<?php }else{ ?>
                    <input type="hidden" name="admin_name" value="<?php echo $admin_name;  ?>"/>
                    <input type="hidden" name="admin_username" value="<?php echo $admin_username;  ?>"/>					
                    <input type="hidden" name="admin_password" value=''/>
					<?php } ?>



					<div class="colcontainer">
						<div class="twocols">
							<label>Default Days</label>
						</div>
						<div class="twocols">
							<input type="text" name="days"  maxlength="160" size="30" value="<?php echo $days;  ?>" />
						</div>
					</div>


					<div class="colcontainer">
						<div class="twocols">
							<label>Default Hours</label>
						</div>
						<div class="twocols">
							<input type="text" name="hours"  maxlength="160" size="30" value="<?php echo $hours;  ?>" />
						</div>
					</div>


					<div class="colcontainer">
						<div class="twocols">
							<label>email</label>
						</div>
						<div class="twocols">
							<input type="text" name="email"  maxlength="160" size="30" value="<?php echo $email;  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>contact email</label>
						</div>
						<div class="twocols">
							<input type="text" name="contact_email"  maxlength="160" size="30" value="<?php echo $contact_email;  ?>" />
						</div>
					</div>
                    
                    
                    
                    
					<div class="colcontainer">
						<div class="twocols">
							<label>first name</label>
						</div>
						<div class="twocols">
							<input type="text" name="name_first"  maxlength="160" size="30" value="<?php echo stripslashes($name_first);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>last name</label>
						</div>
						<div class="twocols">
							<input type="text" name="name_last"  maxlength="160" size="30" value="<?php echo stripslashes($name_last);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>phone</label>
						</div>
						<div class="twocols">
							<input type="text" name="phone"  maxlength="160" size="30" value="<?php echo $phone;  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>address</label>
						</div>
						<div class="twocols">
							<input type="text" name="address"  maxlength="160" size="30" value="<?php echo stripslashes($address);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>city</label>
						</div>
						<div class="twocols">
							<input type="text" name="city"  maxlength="160" size="30" value="<?php echo stripslashes($city);  ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>state</label>
						</div>
						<div class="twocols">
							<select name="state" style="width:120px;">
								<?php 
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT state, state_abr 
						FROM states 
						WHERE hide = '0'
						AND profile_account_id = '1' 
						ORDER BY country DESC, state"; 
                $result = $dbCustom->getResult($db,$sql);                //
                 $block = '';
	             $block .= "<option value=''>----select----</option>";			 
                 while($row = $result->fetch_object()) {
                    $sel =  ($state == $row->state_abr) ? "selected" : '';	
                    $block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
                 }
                echo $block;
            ?>
							</select>
						</div>
					</div>
					<div class="colcontainer">
						<div class="twocols">
							<label>zip</label>
						</div>
						<div class="twocols">
							<input type="text" name="zip"  maxlength="160" size="30" value="<?php echo $zip;  ?>" />
						</div>
					</div>
                    
                    <!--
                    
                    <div class="colcontainer">
						<div class="twocols">
							<label> URL</label>
						</div>
						<div class="twocols">
							<input type="text" name="_url"  size="160" value="<?php //echo $_url;  ?>" />
						</div>
					</div>
                    -->
                    
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear" style="height:300px; width:200px;">&nbsp;</p>
	<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
