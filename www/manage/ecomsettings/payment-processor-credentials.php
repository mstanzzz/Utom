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

$page_title = "Payment Processor Credentials";
$page_group = "order";

$payment_processor_id = (isset($_REQUEST["payment_processor_id"]))? $_REQUEST["payment_processor_id"] : 0; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	


require_once($real_root."/manage/admin-includes/doc_header.php");
?>

<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("view_desc") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'view-item-description.php?item_id='+f_id,
			  success: function(data) {
				$('#view_desc').html(data);
				//alert('Load was performed.');
			  }
			});			
			
		}
		
	})
	
	$("a.inline").fancybox();

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});


function show_msg(msg){
	alert(msg);
}

</script>
</head>
<body>
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php 
		} 
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);        
	?>
	<form name="update_credentials_page" action="payment-processor.php"  method="post" target="_top" enctype="multipart/form-data">
		<input type="hidden" name="processor" value="braintree" />
		<div class="lightboxcontent">
			<h2><?php echo $page_title ?></h2>
			<fieldset>
				<?php	
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					if($payment_processor_id == "braintree"){
						
						$sql = "SELECT *
								FROM braintree_credentials
								WHERE braintree_credentials_id = '".$_SESSION['profile_account_id']."'";
				$result = $dbCustom->getResult($db,$sql);						
						if($result->num_rows > 0){
							$c_obj = $result->fetch_object();
							$environment = $c_obj->environment;
							$merchant_id = $c_obj->merchant_id;
							$public_key = $c_obj->public_key;
							$private_key = $c_obj->private_key;
						}else{
							$environment = '';
							$merchant_id = '';
							$public_key = '';
							$private_key = '';
						}
				?>
				<div class="colcontainer">
					<div class="twocols">
					<label>Environment</label>
					<input type="text" name="environment" value="<?php echo $environment; ?>" />
					</div>
					<div class="twocols">
					<label>Merchant ID</label>
					<input type="text" name="merchant_id" value="<?php echo $merchant_id; ?>" />
					</div>
				</div>
				<div class="colcontainer">
				<div class="twocols">
					<label>Public Key</label>
					<input type="text" name="public_key" value="<?php echo $public_key; ?>" />
					</div>
					<div class="twocols">
					<label>Private Key</label>
					<input type="text" name="private_key" value="<?php echo $private_key; ?>" />
					</div>
				</div>
				</fieldset>
			</div>
            
   		<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='submit_credentials' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
		}else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'payment-processor.php'" >Cancel</button>
		</div>
		</form>
	</div>


	<?php

	}

    ?>
</body>
</html>



