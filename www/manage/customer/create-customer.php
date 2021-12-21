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

$page_title = "Add Customer";
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


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
<script>


function copy_from_shipping(){
	
	 document.form.billing_name_first.value = document.form.shipping_name_first.value; 
	 document.form.billing_name_last.value = document.form.shipping_name_last.value; 
						
	 document.form.billing_address_one.value = document.form.shipping_address_one.value;					
	 document.form.billing_address_two.value = document.form.shipping_address_two.value;					
	 document.form.billing_city.value = document.form.shipping_city.value;					
	 document.form.billing_state.value = document.form.shipping_state.value;					
	 document.form.billing_zip.value = document.form.shipping_zip.value;
	 document.form.billing_phone.value = document.form.shipping_phone_one.value;
	 document.form.billing_email.value = document.form.shipping_email.value;

}

 
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
		$bread_crumb->add("Customers", SITEROOT."manage/customer/customer-landing.php");
		$bread_crumb->add("Customer List", SITEROOT."manage/customer-list.php");
		$bread_crumb->add("Edit Customer", '');
		echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		
		
		$url_str = "customer-list.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str .= "&s_profile_account_id=".$s_profile_account_id;
		$url_str .= "&s_customer_id=".$s_customer_id;
		$url_str .= "&search_str=".$search_str;		
		
	

        ?>
	<form name="form" action="<?php echo $url_str; ?>" target="_top" method="post"   enctype="multipart/form-data">
		 
        
			<div class="page_actions edit_page"> 
			<input type="hidden" name="submit_add_customer" value="1" />
            <?php if($admin_access->customers_level > 1){ ?>
				<button name="add_customer" class="btn btn-large btn-success" type="submit" ><i class="icon-ok icon-white"></i> Save Changes</button>
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
				<legend>Name <i class="icon-minus-sign icon-white"></i></legend>
				
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>User Name</label>
					</div>
					<div class="twocols">
						<input type="text" name="username"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Password</label>
					</div>
					<div class="twocols">
						<input type="text" name="password"  maxlength="100"/>
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
						<input type="text" name="address_one"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="address_two"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>City</label>
					</div>
					<div class="twocols">
						<input type="text" name="city"  maxlength="100"/>
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
						<input type="text" name="zip" maxlength="100"/>
					</div>
				</div>
                
				<div class="colcontainer">
					<div class="twocols">
						<label>Phone 1</label>
						<input type="text" name="phone_one" maxlength="100"/>
					</div>
					<div class="twocols">
						<label>Phone 2</label>
						<input type="text" name="phone_two"  maxlength="100"/>
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
						<input type="text" name="shipping_name_first"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Ship to last name</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_name_last"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping address line 1</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_address_one"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_address_two"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping city</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_city"  maxlength="100"/>
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
								
								$block .= "<option value='".$row->state_abr."' >$row->state</option>";
							 }
							echo $block;
			?>
						</select>
					</div>
					<div class="twocols">
						<label>Shipping zip</label>
						<input type="text" name="shipping_zip"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Shipping phone</label>
					</div>
					<div class="twocols">
						<input type="text" name="shipping_phone_one"  maxlength="100"/>
					</div>
				</div>
			</fieldset>
			<fieldset  class="edit_content" >
				<legend>Billing Address <i class="icon-minus-sign icon-white"></i></legend>
                
                <div class="colcontainer formcols">
                	<div onClick="copy_from_shipping()" style="cursor:pointer; color:blue;">Make Billing Data Same as Shiping</div>
                </div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing first name</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_name_first"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing last name</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_name_last"  maxlength="100"/>
					</div>
				</div>
				
                
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing address line 1</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_address_one"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing address line 2</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_address_two"  maxlength="100"/>
					</div>
				</div>
				<div class="colcontainer formcols">
					<div class="twocols">
						<label>Billing city</label>
					</div>
					<div class="twocols">
						<input type="text" name="billing_city"  maxlength="100"/>
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
								$block .= "<option value='".$row->state_abr."' >$row->state</option>";
							 }
							echo $block;
			?>
						</select>
					</div>
					<div class="twocols">
						<label>Billing zip</label>
						<input type="text" name="billing_zip"  maxlength="100"/>
					</div>
				</div>
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
