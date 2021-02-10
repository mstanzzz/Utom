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

$page_title = "Edit Customer";
$page_group = "customer";

	

$db = $dbCustom->getDbConnect(USER_DATABASE);

$customer_id =  (isset($_GET['customer_id'])) ? $_GET['customer_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$s_profile_account_id = (isset($_GET['s_profile_account_id'])) ? $_GET['s_profile_account_id'] : $_SESSION['profile_account_id'];


$s_customer_id = (isset($_REQUEST['s_customer_id'])) ? trim($_REQUEST['s_customer_id']) : 0;	
		
$search_str = (isset($_REQUEST["search_str"])) ?  trim(addslashes($_REQUEST["search_str"])) : ''; 



$sql = sprintf("SELECT name, username FROM user WHERE id = '%u'", $customer_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$name = $object->name;
	$username = $object->username;
}else{
	$name = '';
	$username = '';
}


$sql = sprintf("SELECT * FROM customer_data WHERE user_id = '%u'", $customer_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	
	$object = $result->fetch_object();

	$address_one = $object->address_one;
	$address_two = $object->address_two;
	$city = $object->city;
	$state = $object->state;
	$zip = $object->zip;
	$phone_one = $object->phone_one;
	$phone_two = $object->phone_two;
	$shipping_name_first = $object->shipping_name_first;
	$shipping_name_last = $object->shipping_name_last;
	$shipping_address_one = $object->shipping_address_one;
	$shipping_address_two = $object->shipping_address_two;
	$shipping_city = $object->shipping_city;
	$shipping_state = $object->shipping_state;
	$shipping_zip = $object->shipping_zip;
	$shipping_phone_one = $object->shipping_phone_one;
	$billing_name_first = $object->billing_name_first;
	$billing_name_last = $object->billing_name_last;
	$billing_address_one = $object->billing_address_one;
	$billing_address_two = $object->billing_address_two;
	$billing_city = $object->billing_city;
	$billing_state = $object->billing_state;
	$billing_zip = $object->billing_zip;
	
}else{
	$address_one = '';
	$address_two = '';
	$city = '';
	$state = '';
	$zip = '';
	$phone_one = '';
	$phone_two = '';
	$shipping_name_first = '';
	$shipping_name_last = '';
	$shipping_address_one = '';
	$shipping_address_two = '';
	$shipping_city = '';
	$shipping_state = '';
	$shipping_zip = '';
	$shipping_phone_one = '';
	$billing_name_first = '';
	$billing_name_last = '';
	$billing_address_one = '';
	$billing_address_two = '';
	$billing_city = '';
	$billing_state = '';
	$billing_zip = '';
	
	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
function validate(theform){	

	return true;
}



function checkNum(elem){
	
	elem = jQuery.trim(elem.value);
		
	if(!IsNumeric(elem.value)){
		alert("Please enter valid numbers only");
	}
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

function get_query_str(){
	var query_str;
	return query_str;
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
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Customers", $ste_root."manage/customer/customer-landing.php");
		$bread_crumb->add("Customer List", $ste_root."manage/customer-list.php");
		$bread_crumb->add("Edit Customer", '');
		echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		
		
		$url_str = "customer-list.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str .= "&s_profile_account_id=".$s_profile_account_id;
		$url_str .= "&s_customer_id=".$s_customer_id;
		$url_str .= "&search_str=".$search_str;
		
	

        ?>
	<form id="edit_customer_form" name="edit_customer_form" action="<?php echo $url_str; ?>" target="_top" method="post"   enctype="multipart/form-data">
		<input id="customer_id" type="hidden" name="customer_id" value="<?php echo $customer_id;  ?>" />
        
        
        
        
			<div class="page_actions edit_page"> 
			<input type="hidden" name="submit_edit_customer" value="1" />
            <?php if($admin_access->customers_level > 1){ ?>
				<button name="edit_customer" class="btn btn-large btn-success" type="submit" ><i class="icon-ok icon-white"></i> Save Changes</button>
            <?php }else{ ?>
            	<div class="alert">
                	<span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit customers.
                </div>            
			<?php } ?>
            
				<hr />
				<a class="btn btn-primary toggleFieldsets" href="#"><i class="icon-minus-sign icon-white icon-white"></i> Collapse All Edit Areas </a><br />
				<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
			<div class="page_content edit_page">
			<fieldset  class="edit_content" >
				<legend> User Name<i class="icon-minus-sign icon-white"></i></legend>
				
                <div class="colcontainer formcols">
					<div class="twocols">
						<label>Customer ID</label>
					</div>
					<div class="twocols">
						<?php echo $customer_id; ?>
					</div>
				</div>
                
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>User Name</label>
					</div>
					<div class="twocols">
						<input type="text" name="username" value="<?php echo $username; ?>" maxlength="100"/>
					</div>
				</div>
			</fieldset>
			<fieldset  class="edit_content" >
				
                <!--
                <legend>Contact Information <i class="icon-minus-sign icon-white"></i></legend>
				
                <div class="colcontainer formcols">
					<div class="twocols">
						<label>Address line 1</label>
					</div>
					<div class="twocols">
						<input type="text" name="address_one" value="<?php echo prepFormInputStr($address_one); ?>" maxlength="100"/>
					</div>
				</div>
				
                <div class="colcontainer formcols">
					<div class="twocols">
						<label>Address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="address_two" value="<?php echo htmlentities($address_two,ENT_QUOTES); ?>" maxlength="100"/>
					</div>
				</div>
                
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>City</label>
					</div>
					<div class="twocols">
						<input type="text" name="city" value="<?php echo prepFormInputStr($city); ?>" maxlength="100"/>
					</div>
				</div>
                
				<div class="colcontainer">
					<div class="twocols">
						<label>State</label>
						<select name="state" class="details_select">
							<?php 
							
							$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
							$sql = "SELECT state, state_abr 
									FROM states 
									WHERE hide = '0' 
									AND profile_account_id = '".$_SESSION['profile_account_id']."'
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							 $block = '';
							 while($row = $result->fetch_object()) {
								$sel =  (strcasecmp($state,$row->state_abr) == 0) ? "selected" : '';	
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							//echo $block;
							
			?>
						</select>
					</div>
				
                	<div class="twocols">
						<label>Zip</label>
						<input type="text" name="zip" value="<?php echo $zip; ?>" maxlength="100"/>
					</div>
				</div>
				
                <div class="colcontainer">
					<div class="twocols">
						<label>Phone 1</label>
						<input type="text" name="phone_one" value="<?php echo prepFormInputStr($phone_one); ?>" maxlength="100"/>
					</div>
					<div class="twocols">
						<label>Phone 2</label>
						<input type="text" name="phone_two" value="<?php echo prepFormInputStr($phone_two); ?>" maxlength="100"/>
					</div>
				</div>
                -->
                
			</fieldset>
			<fieldset  class="edit_content" >
				<legend>Shipping Address <i class="icon-minus-sign icon-white"></i></legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Ship to first name</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_name_first" value="<?php echo prepFormInputStr($shipping_name_first); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Ship to last name</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_name_last" value="<?php echo prepFormInputStr($shipping_name_last); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping address line 1</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_address_one" value="<?php echo prepFormInputStr($shipping_address_one); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_address_two" value="<?php echo prepFormInputStr($shipping_address_two); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping city</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_city" value="<?php echo prepFormInputStr($shipping_city); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer">
					<div class="twocols">
						<label>Shipping State</label>
						<select name="shipping_state" class="details_select">
							<?php 
							$sql = "SELECT state, state_abr 
									FROM states 
									WHERE hide = '0' 
									AND profile_account_id = '".$_SESSION['profile_account_id']."'
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							 $block = '';
							 while($row = $result->fetch_object()) {
								$sel =  (strcasecmp($shipping_state,$row->state_abr) == 0) ? "selected" : '';	
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							echo $block;
			?>
						</select>
					</div>
					<div class="twocols">
						<label>Shipping zip</label>
						<input type="text" name="shipping_zip" value="<?php echo $shipping_zip; ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping phone</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_phone_one" value="<?php echo $shipping_phone_one; ?>" maxlength="100"/>
					</div>
				</div>
			</fieldset>
			<fieldset  class="edit_content" >
				<legend>Billing Address <i class="icon-minus-sign icon-white"></i></legend>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing first name</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_name_first" value="<?php echo prepFormInputStr($billing_name_first); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing last name</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_name_last" value="<?php echo prepFormInputStr($billing_name_last); ?>" maxlength="100"/>
					</div>
				</div>
                
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing address line 1</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_address_one" value="<?php echo prepFormInputStr($billing_address_one); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_address_two" value="<?php echo prepFormInputStr($billing_address_two); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing city</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_city" value="<?php echo prepFormInputStr($billing_city); ?>" maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer">
					<div class="twocols">
						<label>Billing State</label>
						<select name="billing_state" class="details_select">
							<?php 
							$sql = "SELECT state, state_abr 
									FROM states 
									WHERE hide = '0' 
									AND profile_account_id = '".$_SESSION['profile_account_id']."'
									ORDER BY country DESC, state"; 
					$result = $dbCustom->getResult($db,$sql);							 $block = '';
							 while($row = $result->fetch_object()) {
								$sel =  (strcasecmp($billing_state,$row->state_abr) == 0) ? "selected" : '';	
								$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
							 }
							echo $block;
			?>
						</select>
					</div>
					<div class="twocols">
						<label>Billing zip</label>
						<input type="text" name="billing_zip" value="<?php echo $billing_zip; ?>" maxlength="100"/>
					</div>
				</div>
			</fieldset>
		</div>
	</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
