<?php

session_start();

if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; }elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']."/designitpro"; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
}else{
	$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Payment Processor Credentials";
$page_group = "order";

$payment_processor_id = (isset($_REQUEST["payment_processor_id"]))? $_REQUEST["payment_processor_id"] : 0; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	


if(isset($_POST["submit_credentials"])){

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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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

</script>
</head>

<?php if($msg != ''){ ?>
	<body onLoad="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

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

	echo "<div class='manage_main_page_title'>".$page_title."</div>";
    
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 
	

    $payment_processor = getPaymentProcessor();
    $db = $dbCustom->getDbConnect(CART_DATABASE);
    if($payment_processor == "braintree"){
		
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


        <fieldset>
        <form name="update_credentials_page" action="payment-processor-credentials.php" method="post">	
        <input type="hidden" name="processor" value="braintree" />
        
        <div class="manage_form_left_label">Environment</div> 
        <div class="manage_form_right_info">
        <input type="text" name="environment" value="<?php echo $environment; ?>" />
        </div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Merchant Id</div> 
        <div class="manage_form_right_info">
        <input type="text" name="merchant_id" value="<?php echo $merchant_id; ?>" />
        </div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Public Key</div> 
        <div class="manage_form_right_info">
        <input type="text" name="public_key" value="<?php echo $public_key; ?>" />
        </div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Private Key</div> 
        <div class="manage_form_right_info">
        <input type="text" name="private_key" value="<?php echo $private_key; ?>" />
        </div> 
        <div class="clear"></div>

        <div class="manage_form_left_label"></div> 
        <div class="manage_form_right_info">
        <input type="submit" name="submit_credentials" value="Submit" />
        </div> 
        <div class="clear"></div>

		
        </form>
        </fieldset>



	<?php

	}

    ?>




    
	</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>    
   
</div>



    <div style="display:none">
        <div id="edit" style="width:900px; height:620px;">
        </div>
    </div>
    

</body>
</html>



