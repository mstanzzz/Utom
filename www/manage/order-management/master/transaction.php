<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Order Transaction";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 
$failed_order_id = (isset($_REQUEST["failed_order_id"]))? $_REQUEST["failed_order_id"] : 0; 
$ret_page = (isset($_REQUEST["ret_page"]))? $_REQUEST["ret_page"] : 'order'; 


//echo $order_id;

require_once("../../includes/set-page.php");	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 

		
	})
	
	$("a.inline").fancybox();
	
});


function show_msg(msg){
	alert(msg);
}

</script>
</head>

<?php if($msg != ''){ ?>
	<body onLoad="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("../../includes/manage-header.php");
	require_once("../../includes/manage-top-nav.php");

?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("../../includes/manage-side-nav.php");
        ?>
    </div>	

    <div class="manage_main">

	<?php 
	
	
	
	
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if($ret_page == 'transaction_list'){	
			$bread_crumb->add('Transaction List', SITEROOT."/manage/order-management/transaction-list.php");
		}
		
		$bread_crumb->add('Transaction', $actual_link);

		echo $bread_crumb->output();
	
	
    $payment_processor = getPaymentProcessor();
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

/*

	$sql = "DELETE FROM braintree_transaction
	WHERE amount != '1'";
	$result = $dbCustom->getResult($db,$sql); 
	
	$sql = "DELETE FROM ctg_order WHERE order_id < '104'";
	$result = $dbCustom->getResult($db,$sql);


$sql = "DELETE FROM order_line_item WHERE order_id < '104'";
	$result = $dbCustom->getResult($db,$sql);



$sql = "DELETE FROM order_to_order_state WHERE order_id < '104'";
	$result = $dbCustom->getResult($db,$sql);

*/



	if($payment_processor == "braintree"){	
		
		
		if($order_id > 0){
		
		$sql = "SELECT *
				FROM  braintree_transaction 
				WHERE order_id = '".$order_id."'";
		}else{
			
			$sql = "SELECT *
				FROM  braintree_transaction 
				WHERE failed_order_id = '".$failed_order_id."'";
			
		}
	
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
		?>

        <fieldset>	
        
        <div class="manage_form_left_label">Is Success</div> 
        <div class="manage_form_right_info"><?php 
		
		if($object->is_success){
			echo 'Transaction Successful';	
		}else{
			echo 'Transaction Failed';
			
			
			echo "<br /><br />";
			echo $object->t_error_msg;
			
			
		}
		
		?></div> 
        <div class="clear"></div>
        
        <div class="manage_form_left_label">Order Id</div> 
        <div class="manage_form_right_info"><?php echo $object->order_id; ?></div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Transaction Id</div> 
        <div class="manage_form_right_info"><?php echo $object->trans_id; ?></div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Transaction Amount</div> 
        <div class="manage_form_right_info"><?php echo "$".number_format($object->amount,2); ?></div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Transaction Date & Time</div> 
        <div class="manage_form_right_info"><?php echo date("m/d/Y h:i:s a",$object->trans_date); ?></div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Billing Name</div> 
        <div class="manage_form_right_info"><?php echo $object->first_name." ".$object->last_name; ?></div> 
        <div class="clear"></div>
    
        <div class="manage_form_left_label">Email</div> 
        <div class="manage_form_right_info"><?php echo $object->email; ?></div> 
        <div class="clear"></div>
        
        <div class="manage_form_left_label">Card Type</div> 
        <div class="manage_form_right_info"><?php echo $object->card_type; ?></div> 
        <div class="clear"></div>

        <div class="manage_form_left_label">Card Type Last 4</div> 
        <div class="manage_form_right_info"><?php echo $object->cc_last_4; ?></div> 
        <div class="clear"></div>
        
        
        
        
        
        
        
        
        </fieldset>


	<?php }else{ ?>
        
           <div class="manage_form_left_label">No transaction for this order</div> 
        
    <?php 
		} 
	
	}
	?>
    
</div> 
<p class="clear"></p>
<?php 
require_once("../../includes/manage-footer.php");
?>    
   
</div>


    

</body>
</html>



