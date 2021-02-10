<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$pages = new Pages;
 
$msg = '';
$page_title = "SAS Users";
$page_group = "sas";

require_once("../admin-includes/set-page.php");	

$db = $dbCustom->getDbConnect(USER_DATABASE);



function generateSalt()
{
	return sha1(uniqid(rand()));
}

function get_hash($cc_num, $salt)
{
	return sha1($cc_num.$salt);
}



function encryptCard($creditno){    

$key = getKey();

//$key = 'YOURSECRETKEY'; 
//Change the key here    
$td = mcrypt_module_open('tripledes', '', 'cfb', '');    
srand((double) microtime() * 1000000);    
$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);    
$okey = substr(md5($key.rand(0, 9)), 0, 
mcrypt_enc_get_key_size($td));    
mcrypt_generic_init($td, $okey, $iv);    
$encrypted = mcrypt_generic($td, $creditno.chr(194));    
$code = $encrypted.$iv;    
$code = str_replace("'", "\'", $code); 
//Make sure that the code is not escaped already.    
return $code;
}

function decryptCard($code){    
$key = 'YOURSECRETKEY'; 
// use the same key used for encrypting the data    
$td = mcrypt_module_open('tripledes', '', 'cfb', '');    
$iv = substr($code, -8);    
$encrypted = substr($code, 0, -8);    
for ($i = 0; $i < 10; $i++) {        
	$okey = substr(md5($key.$i), 0, mcrypt_enc_get_key_size($td));        
	mcrypt_generic_init($td, $okey, $iv);        
	$decrypted = trim(mdecrypt_generic($td, $encrypted));        
	mcrypt_generic_deinit($td);        
	$txt = substr($decrypted, 0, -1);        
	if (ord(substr($decrypted, -1)) == 194 && is_numeric($txt)) break;    }    
	mcrypt_module_close($td);    
	return $txt;
}






$code = encryptCard("4111111111111111");

echo $code;
echo "<br />";
echo decryptCard($code);


exit;

if(isset($_POST['edit_account'])){
	$profile_account_id = $_POST['profile_account_id'];
	$parent_id = $_POST["parent_id"];
	$company = trim(addslashes($_POST["company"])); 
	$domain_name = trim(addslashes($_POST["domain_name"])); 
	$recurring_billing_id = trim(addslashes($_POST["recurring_billing_id"])); 
	$email = trim(addslashes($_POST["email"])); 
	$contact_email = trim(addslashes($_POST["contact_email"])); 
	$name_first = trim(addslashes($_POST["name_first"])); 
	$name_last = trim(addslashes($_POST["name_last"])); 
	$phone = trim(addslashes($_POST["phone"])); 
	$address = trim(addslashes($_POST["address"])); 
	$city = trim(addslashes($_POST["city"])); 
	$state = trim(addslashes($_POST["state"])); 
	$zip = trim(addslashes($_POST["zip"])); 

	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 
	$billing_address_one = trim(addslashes($_POST["billing_address_one"])); 
	$billing_address_two = trim(addslashes($_POST["billing_address_two"])); 
	$billing_city = trim(addslashes($_POST["billing_city"])); 
	$billing_state = trim($_POST["billing_state"]); 
	$billing_zip = trim(addslashes($_POST["billing_zip"])); 
	$card_num = trim(addslashes($_POST["card_num"])); 
	$card_auth_code = trim(addslashes($_POST["card_auth_code"])); 
	$exp_month = trim($_POST["exp_month"]); 
	$exp_year = trim($_POST["exp_year"]); 
        
 	
	$is_shipping_charges = $_POST["is_shipping_charges"];
	
	$commission_override = (is_numeric($_POST["commission_override"]))? $_POST["commission_override"]: 0;  
	
	$profile_account_type_id = $_POST["profile_account_type_id"];
	
	$user_type_id  = 7;

	
	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	
	if($admin_password != ''){
		$update_pwd = 1;
		$password_salt = $aLgn->generateSalt();
		$password_hash = $aLgn->get_hash($admin_password, $password_salt);
	}else{
		$update_pwd = 0;
	}

	$sql = "SELECT name, username, id 
			FROM user 
			WHERE profile_account_id = '".$profile_account_id."'
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
					,$profile_account_id
					);
		$result = $dbCustom->getResult($db,$sql);
			
		if($update_pwd){		
			$sql = "UPDATE user 
					SET 
					password_hash = '".$password_hash."' 
					,password_salt = '".$password_salt."'
					WHERE id = '".$t_user_id."'
					";
			$result = $dbCustom->getResult($db,$sql);
				
		}
		
	}else{
		
		$sql = sprintf("INSERT INTO user (name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$admin_name, $admin_username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $profile_account_id);

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
				,profile_account_type_id = '%u'
				,parent_id = '%u'
				,domain_name = '%s'
				,recurring_billing_id = '%s'
				,email = '%s'
				,contact_email = '%s'
				,name_first = '%s'
				,name_last = '%s'
				,phone = '%s'
				,address = '%s'
				,city = '%s'
				,state = '%s'
				,zip = '%s'
				,is_shipping_charges = '%u'
				,commission_override = '%f'
				WHERE id = '%u'", 
				$company
				,$profile_account_type_id
				,$parent_id
				,$domain_name
				,$recurring_billing_id
				,$email
				,$contact_email
				,$name_first
				,$name_last
				,$phone
				,$address
				,$city
				,$state
				,$zip
				,$is_shipping_charges
				,$commission_override
				,$profile_account_id);

	$result = $dbCustom->getResult($db,$sql);
	


	// set modules
	$sql = "DELETE FROM profile_account_to_module WHERE profile_account_id = '".$profile_account_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"]; 
		foreach($module_ids as $value){
			$sql = "INSERT INTO profile_account_to_module 
					(value, profile_account_id)
					VALUES('".$value."','".$profile_account_id."' )";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}

	
	// set cc
	
	if(strlen($card_num) > 14){
	
		$cc_salt = generateSalt();
		$cc_hash = get_hash($card_num, $cc_salt);
	
		$cc_last_4 = substr($card_num,strlen($card_num) - 4,strlen($card_num));
	
		$sql = "UPDATE profile_account 
				SET cc_hash = '".$cc_hash."' ,cc_salt = '".$cc_salt."', cc_last_4 = '".$cc_last_4."' 
				WHERE id = '".$profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);		
		
	}
	
	
}



if(isset($_POST['add_account'])){

	$parent_id = $_POST["parent_id"];
	$company = trim(addslashes($_POST["company"])); 
	$domain_name = trim(addslashes($_POST["domain_name"])); 
	$recurring_billing_id = trim(addslashes($_POST["recurring_billing_id"])); 
	$email = trim(addslashes($_POST["email"])); 
	$contact_email = trim(addslashes($_POST["contact_email"])); 
	$name_first = trim(addslashes($_POST["name_first"])); 
	$name_last = trim(addslashes($_POST["name_last"])); 
	$phone = trim(addslashes($_POST["phone"])); 
	$address = trim(addslashes($_POST["address"])); 
	$city = trim(addslashes($_POST["city"])); 
	$state = trim(addslashes($_POST["state"])); 
	$zip = trim(addslashes($_POST["zip"])); 
	$commission_override = (is_numeric($_POST["commission_override"]))? $_POST["commission_override"]: 0;  


	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 
	$billing_address_one = trim(addslashes($_POST["billing_address_one"])); 
	$billing_address_two = trim(addslashes($_POST["billing_address_two"])); 
	$billing_city = trim(addslashes($_POST["billing_city"])); 
	$billing_state = trim($_POST["billing_state"]); 
	$billing_zip = trim(addslashes($_POST["billing_zip"])); 
	$card_num = trim(addslashes($_POST["card_num"])); 
	$card_auth_code = trim(addslashes($_POST["card_auth_code"])); 
	$exp_month = trim($_POST["exp_month"]); 
	$exp_year = trim($_POST["exp_year"]); 



	$is_shipping_charges = $_POST["is_shipping_charges"];

	$profile_account_type_id = 3;
	$user_type_id = 7;
	
			
	$sql = sprintf("INSERT INTO profile_account 
				(company
				,profile_account_type_id
				,parent_id
				,domain_name
				,recurring_billing_id
				,email
				,contact_email
				,name_first
				,name_last
				,phone
				,address
				,city
				,state
				,zip
				,is_shipping_charges
				,created
				,commission_override)
    			 VALUES('%s', '%u','%u','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%u','%s','%f')", 
				$company
				,$profile_account_type_id
				,$parent_id
				,$domain_name
				,$recurring_billing_id
				,$email
				,$contact_email
				,$name_first
				,$name_last
				,$phone
				,$address
				,$city
				,$state
				,$zip
				,$is_shipping_charges
				,date('Y-m-d H:i:s')
				,$commission_override);

	$result = $dbCustom->getResult($db,$sql);
		
	
	$new_profile_account_id = $db->insert_id; 	


	$admin_name = trim(addslashes($_POST["admin_name"]));
	$admin_username = trim(addslashes($_POST["admin_username"]));
	$admin_password = trim(addslashes($_POST["admin_password"]));
	$password_salt = $aLgn->generateSalt();
	$password_hash = $aLgn->get_hash($admin_password, $password_salt);

	$sql = sprintf("INSERT INTO user (name, username, password_hash, password_salt, user_type_id, created, visited, profile_account_id)
    			   VALUES('%s','%s','%s','%s','%u','%s','%s','%u')", 
					$admin_name, $admin_username, $password_hash, $password_salt, $user_type_id, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $new_profile_account_id);

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


	if(isset($_POST["module_ids"])){
		$module_ids = $_POST["module_ids"]; 
		foreach($module_ids as $value){
			$sql = "INSERT INTO profile_account_to_module 
					(value, profile_account_id)
					VALUES('".$value."','".$new_profile_account_id."' )";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}



	// set cc
	if(strlen($card_num) > 14){
	
	
	
		$cc_salt = generateSalt();
		$cc_hash = get_hash($card_num, $cc_salt);
	
		$cc_last_4 = substr($card_num,strlen($card_num) - 4,strlen($card_num));
	
		$sql = "UPDATE profile_account 
				SET cc_hash = '".$cc_hash."' ,cc_salt = '".$cc_salt."', cc_last_4 = '".$cc_last_4."' 
				WHERE id = '".$new_profile_account_id."'";
$result = $dbCustom->getResult($db,$sql);		
	
	}




	$pages->newProfileSetup($new_profile_account_id);

}



if(isset($_POST["deact_profile_account"])){
		$profile_account_id = $_POST['profile_account_id'];
		
		$sql = sprintf("UPDATE profile_account SET active = '%u' WHERE id = '%u'", '0',$profile_account_id);
		$result = $dbCustom->getResult($db,$sql);
			

}


if(isset($_POST["del_profile_account"])){
		
	$profile_account_id = $_POST['profile_account_id'];

	if($profile_account_id > 1){
		$sql = sprintf("DELETE FROM profile_account WHERE id = '%u'", $profile_account_id);
		$result = $dbCustom->getResult($db,$sql);
			
		

		$sql = "DELETE FROM profile_account_to_module 
				WHERE profile_account_id = '".$profile_account_id."'";
		$result = $dbCustom->getResult($db,$sql);
		


		$pages->undoProfileSetup($profile_account_id);
	}

}


//$pages->undoProfileSetup(0);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users</title>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $ste_root; ?>/css/mce.css" />

<script type="text/javascript" src="<?php echo $ste_root; ?>/js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/tiny_mce/tiny_mce.js"></script>

<script>
$(document).ready(function() {

	$(".inline").click(function(){ 

		if(this.href.indexOf("deactivate") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#deact_profile_account_id").val(f_id);
			
		}
		
		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_profile_account_id").val(f_id);
			
		}
		
		
	});






	$("a.inline").fancybox();
	
});

function show_msg(msg){
	alert(msg);
}

</script>
</head>


<?php if($msg != ''){ ?>
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("../admin-includes/manage-header.php");
	require_once("../admin-includes/manage-top-nav.php");

?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("../admin-includes/manage-side-nav.php");
        ?>
    </div>	
  	<div class="top_link">
 		<a href="add-sas-cust.php?ret_page=sas-cust">add profile</a>
    </div>

    <div class="manage_main">
<?php 
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
         
?>    

<table border="0" width="100%" cellpadding="10">
  <tr>
  	<td width="5%">&nbsp;</td>
   	<td width="6%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="18%"><div class="blue">Company</div></td>
    <td width="18%"><div class="blue">Domain</div></td>
    <td><div class="blue">Child domains</div></td>
  </tr>

<?php


 
$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "SELECT id
		,company
		,domain_name
		,active
		FROM  profile_account  
		ORDER BY id";

$result = $dbCustom->getResult($db,$sql);


while($row = $result->fetch_object()) {

	$block = "<tr>";

	$block .= "<td valign='top'><a href='edit-sas-cust.php?profile_account_id=".$row->id ."'>
		edit</a></td>";

	$block .= "<td valign='top'><a href='sas-cust-payment.php?profile_account_id=".$row->id ."'>
		charge</a></td>";


	$block .= "<td valign='top'><a class='inline' href='#deactivate'>
		de-act<div class='e_sub' id='".$row->id."' style='display:none'></div></a></td>";

	$block .= "<td valign='top'><a class='inline' href='#delete'>
		delete<div class='e_sub' id='".$row->id."' style='display:none'></div></a></td>";


	if($row->active){
		$is_active = "active";
	}else{
		$is_active = "dead";
	}

	$block .= "<td valign='top'>".$is_active."</td>";


	$block .= "<td valign='top'>".$row->company."</td>";
	
	$block .= "<td valign='top'>".$row->domain_name."</td>";


	$block .= "<td valign='top'>";
		
	$sql = "SELECT id
			,domain_name
			FROM  profile_account
			WHERE parent_id = '".$row->id."'";  

	$c_res = mysql_query ($sql);
	if(!$c_res)die(mysql_error());
	if(mysql_num_rows($c_res) > 0){
		while($c_row = mysql_fetch_object($c_res)) {
			$block .= $c_row->domain_name."<br />";
		}
	}else{
		$block .= "None";	
	}

	$block .= "</td>";

	$block .= "</tr>";
	
	echo $block;

}
?>

</table>

</div>
<p class="clear"></p>
<?php 
require_once("../admin-includes/manage-footer.php");
?>       

</div>


	 <div style="display:none">
        <div id="deactivate" style="width:380px; height:100px;">    
            Are you sure you want to de-activate this account?
            <form name="del_sas_cust_form" action="sas-cust.php" method="post">
                <input id="deact_profile_account_id" type="hidden" name="profile_account_id" />
                <input name="deact_profile_account" type="submit" value="DE-ACTIVATE" />
            </form>
        </div>
    </div>

	 <div style="display:none">
        <div id="delete" style="width:380px; height:100px;">    
            Are you sure you want to permanently delete this account?
            <form name="deact_sas_cust_form" action="sas-cust.php" method="post">
                <input id="del_profile_account_id" type="hidden" name="profile_account_id" />
                <input name="del_profile_account" type="submit" value="DELETE" />
            </form>
        </div>
    </div>
    
        
</body>
</html>



