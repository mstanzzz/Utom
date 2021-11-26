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

$page_title = 'Edit Customer';
$page_group = 'customer';

	
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.saas_customer.php');

$saas_cust = new SaasCustomer;

$db = $dbCustom->getDbConnect(USER_DATABASE);

$customer_id =  (isset($_REQUEST['customer_id'])) ? $_REQUEST['customer_id'] : $_SESSION['customer_id'];

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';




$sql = sprintf("SELECT name, username FROM user WHERE id = '%u'", $customer_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();

	$name = $object->name;
	$username = $object->username;


}


$sql = sprintf("SELECT * FROM customer_data WHERE user_id = '%u'", $customer_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	
	$object = $result->fetch_object();

	$name_first = $object->name_first;
	$name_last = $object->name_last;
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
	
	$name_first = '';
	$name_last = '';

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



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<script>
$(document).ready(function() {
	
	$('#email_form').hide();
	
	$('#open_email_form').click(function(){

		$('#email_form').show();
		$(this).hide();
		
	});

});

</script>



</head>

<body>
<div class='lightboxholder'>
	<?php if($msg != ''){ ?>
	<div class='alert'>
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
         
	?>
		<div class='lightboxcontent'>
        
        
        
        <div id='open_email_form' class='btn btn-primary btn-large'>Send Email to <?php echo $name; ?></div>
			<div id='email_form'>     
        
        
                    
                <form action='customer-list.php' method='post' name='sendto' enctype='multipart/form-data' target='_top'>
                
                <input type='hidden' name='email_customer' value='1' />
                <input type='hidden' name='customer_id' value='<?php echo $customer_id; ?>' />
                <input type='hidden' name='username' value='<?php echo $username; ?>' />
                
                <input type='hidden' name='name_first' value='<?php echo $name_first; ?>' />
                <input type='hidden' name='name_last' value='<?php echo $name_last; ?>' />
                
                
                <div class='frm_input_area'>
                    <input type='text' name='company_email' value='<?php echo $saas_cust->getCompanyEmail(); ?>' class='frm_input_text' />
                    <span id='redx_email' style='padding-left:8px;'>&nbsp;</span>
                    <div id='msg_email' class='frm_vmsg'>&nbsp;</div>
                </div>
                <div class='clear'></div>
            
                <div class='frm_label'> Subject: </div>
                <div class='frm_input_area'>
                    <input id='email_subject' type='text' name='email_subject' value='' class='frm_input_text' />
                </div>
                <div class='clear'></div>
                <div id='label_issue' class='frm_label'> <span class='star'>*</span>Issue/Message: </div>
                <div class='frm_input_area'>
                    <textarea id='email_body' class='support_textarea' name='email_body' style='width:500px; height:140px;' /></textarea>
                    <span id='redx_issue' style='padding-left:8px;'>&nbsp;</span>
                    <div id='msg_issue' class='frm_vmsg'>&nbsp;</div>
                </div>
                <div class='clear'></div>
       
       			<input type="submit" name="submit" value="Send" />
                
            </form>
                    
        	</div>
        
        
        
        
			<h2>Viewing Details for Customer <?php echo $name; ?></h2>
				<div class='colcontainer formcols'>
					<div class='twocols'>
						<label>Name</label>
					</div>
					<div class='twocols'>
						<?php echo stripslashes($name); ?>
					</div>
				</div>
				<div class='colcontainer formcols'>
					<div class='twocols'>
						<label>User Name</label>
					</div>
					<div class='twocols'>
						<?php echo $username; ?>
					</div>
				</div>
				<div class='colcontainer formcols'>
					<div class='twocols'>
						<label>Customer ID</label>
					</div>
					<div class='twocols'>
						<?php echo $customer_id; ?>
					</div>
				</div>
				<div class='colcontainer formcols'>
					<div class='twocols'>
						<label>Address</label>
					</div>
					<div class='twocols'>
						<p><?php echo stripslashes($address_one); ?><br />
						<?php echo stripslashes($address_two); ?><br />
						<?php echo stripslashes($city); ?>, <?php echo $state; ?> <?php echo $zip; ?></p>
					</div>
				</div>
				<div class='colcontainer formcols'>
					<div class='twocols'>
						<label>Phone 1<br />Phone 2</label>
					</div>
					<div class='twocols'>
						<p>	<?php echo $phone_one; ?><br />
							<?php echo $phone_two; ?></p>
					</div>
				</div>
				<div class='colcontainer'>
					<div class='twocols'>
						<label>Shipping Address</label>
						<p><?php echo stripslashes($shipping_name_first).' '.stripslashes($shipping_name_last); ?><br />
						<?php echo $shipping_address_one; ?><br />
						<?php echo $shipping_address_two; ?><br />
						<?php echo stripslashes($shipping_city).', '.$shipping_state.' '.$shipping_zip; ?></p>
						<p><?php echo $shipping_phone_one; ?></p>
					</div>
					<div class='twocols'>
						<label>Billing Address</label>
						<p><?php echo stripslashes($billing_name_first).' '.stripslashes($billing_name_last); ?><br />
						<?php echo stripslashes($billing_address_one); ?><br />
						<?php echo stripslashes($billing_address_two); ?><br />
						<?php echo stripslashes($billing_city).', '.$billing_state.' '.$billing_zip; ?></p>
					</div>
				</div>
</body>
</html>


