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

$page_title = 'Create Customer';
$page_group = 'customer';

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>

function copy_from_billing(){
	
	document.form.shipping_name_first.value = document.form.billing_name_first.value; 
	document.form.shipping_name_last.value = document.form.billing_name_last.value; 
						
	document.form.shipping_address_one.value = document.form.billing_address_one.value;					
	document.form.shipping_address_two.value = document.form.billing_address_two.value;					
	document.form.shipping_city.value = document.form.billing_city.value;					
	document.form.shipping_state.value = document.form.billing_state.value;					
	document.form.shipping_zip.value = document.form.billing_zip.value;
	document.form.shipping_phone_one.value = document.form.billing_phone.value;
	document.form.shipping_email.value = document.form.billing_email.value;

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
		
		$url_str = "customer-list.php";
		//$url_str .= "?pagenum=".$pagenum;
		//$url_str .= "&sortby=".$sortby;
		//$url_str .= "&a_d=".$a_d;
		//$url_str .= "&truncate=".$truncate;
		
        ?>
	</div>
	<div class="manage_main">

	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
    
    
    <button type="submit" class="btn btn-primary btn-large" name="create_cust" value="Submit">Create Customer</button>

		<div class="colcontainer">
			<label>Email</label>
			<input id="username" name="username" type="text" value="" />
		</div> 
        <!--        
		<div class="colcontainer">
			<label>Full Name</label>
			<input name="name" type="text" value="" />
		</div>
        --> 
        
        <div class="colcontainer">
			<label>Password</label>
			<input id="password" name="password" type="text" value="" />
		</div> 
        
        
        
        
		<div class="colcontainer">
			<label>Billing First Name</label>
			<input id="billing_name_first" name="billing_name_first" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Billing Last Name</label>
			<input id="billing_name_last" name="billing_name_last" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Billing Phone</label>
			<input id="billing_phone" name="billing_phone" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Billing Adress Line 1</label>
			<input id="billing_address_one" name="billing_address_one" type="text" value="" />
		</div>     
        
		<div class="colcontainer">
			<label>Billing Adress Line 1</label>
			<input id="billing_address_two" name="billing_address_two" type="text" value="" />
		</div> 
        
		<div class="colcontainer">
			<label>Billing City</label>
			<input id="billing_city" name="billing_city" type="text" value="" />
		</div> 
        
        
		<div class="colcontainer">
			<label>Billing State</label>
			
            <select name="billing_state" id="billing_state">
						<?php 
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT state, state_abr 
								FROM states 
								WHERE hide = '0'
								AND profile_account_id = '".$_SESSION['profile_account_id']."' 
								ORDER BY state"; 
				$result = $dbCustom->getResult($db,$sql);						$block = '';
						while($row = $result->fetch_object()) {
							$sel =  (strcasecmp($acc->shipping_state,$row->state_abr) == 0) ? "selected" : '';	
							$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
						}
						echo $block;
						?>
						</select>
            
		</div> 
        
        
		<div class="colcontainer">
			<label>Billing Zip</label>
			<input id="billing_zip" name="billing_zip" type="text" value="" />
		</div> 
        
        
		<br /><br />
		<div onclick="copy_from_billing()" style="cursor:pointer; color:blue;">Make Shipping Data Same as Billing</div>
		<br /><br />

		
		<div class="colcontainer">
			<label>Shipping First Name</label>
			<input id="shipping_name_first" name="shipping_name_first" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Shipping Last Name</label>
			<input id="shipping_name_last" name="shipping_name_last" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Shipping Phone</label>
			<input id="shipping_phone_one" name="shipping_phone_one" type="text" value="" />
		</div> 

		<div class="colcontainer">
			<label>Shipping Adress Line 1</label>
			<input id="shipping_address_one" name="shipping_address_one" type="text" value="" />
		</div>     
        
		<div class="colcontainer">
			<label>Shipping Adress Line 1</label>
			<input id="shipping_address_two" name="shipping_address_two" type="text" value="" />
		</div> 
        
		<div class="colcontainer">
			<label>Shipping City</label>
			<input id="shipping_city" name="shipping_city" type="text" value="" />
		</div> 
        
        
		<div class="colcontainer">
			<label>Shipping State</label>
			
            <select name="shipping_state" id="shipping_state">
						<?php 
						$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$sql = "SELECT state, state_abr 
								FROM states 
								WHERE hide = '0'
								AND profile_account_id = '".$_SESSION['profile_account_id']."' 
								ORDER BY state"; 
				$result = $dbCustom->getResult($db,$sql);						$block = '';
						while($row = $result->fetch_object()) {
							$sel =  (strcasecmp($acc->shipping_state,$row->state_abr) == 0) ? "selected" : '';	
							$block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
						}
						echo $block;
						?>
						</select>
            
		</div> 
        
        
		<div class="colcontainer">
			<label>Shipping Zip</label>
			<input id="shipping_zip" name="shipping_zip" type="text" value="" />
		</div> 
        
        



        <!--
        <div class="colcontainer">
			<label>Subscribe to newsletter</label>
					<label class="pull-left"><input type="radio" name="get_news_letter" value="1" />
					Yes </label>
					<label class="pull-left offsethalf"><input type="radio" name="get_news_letter" value="0"/>
					No </label>
		</div> 
        -->
        
        
    </form>

	</div>



<p class="clear"></p>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>

</body>
</html>
