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

if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 

$progress = new SetupProgress;
$module = new Module;


$page_title = "Order Transaction";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

require_once("<?php echo SITEROOT; ?>includes/set-page.php");	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';



require_once($real_root.'/manage/admin-includes/doc_header.php'); 

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
	<body onload="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once("<?php echo SITEROOT; ?>includes/manage-header.php");
	require_once("<?php echo SITEROOT; ?>includes/manage-top-nav.php");


?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once("<?php echo SITEROOT; ?>includes/manage-side-nav.php");
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
				FROM  braintree_transaction 
				WHERE order_id = '".$order_id."'";
	
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows){
			$object = $result->fetch_object();
		?>

        <fieldset>	
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
require_once("<?php echo SITEROOT; ?>includes/manage-footer.php");
?>    
   
</div>


    

</body>
</html>



