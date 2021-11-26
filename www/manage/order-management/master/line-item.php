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

$page_title = "Order Line Item";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order</title>

<link rel="stylesheet" href="<?php echo SITEROOT; ?>js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>css/manageStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>css/mce.css" />

<script type="text/javascript" src="<?php echo SITEROOT; ?>js/jquery-1.4.4.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/tiny_mce/tiny_mce.js"></script>

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
	
	$("#view_desc").click(function(){ $.fancybox.close;  })

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

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
	
	
	
	
	
	
	
	
	
	
	$sql = "SELECT *
			FROM  order_line_item 
			WHERE order_id = '".$order_id."'";

    $result = $dbCustom->getResult($db,$sql);	
	
	$object = $result->fetch_object();
    ?>

    <fieldset>	
	<div class="manage_form_left_label">Order Id</div> 
	<div class="manage_form_right_info"><?php echo $object->order_id; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Order Date & Time</div> 
	<div class="manage_form_right_info"><?php echo date("m/d/Y h:i:s a",strtotime($object->order_date)); ?></div> 
	<div class="clear"></div>

	<?php
    $sql = "SELECT name
				FROM order_state
				WHERE order_state_id = '".$object->order_state_id."'";
    $os_res = mysql_query ($sql);
	if(!$os_res)die(mysql_error());
	if(mysql_num_rows($os_res) > 0){
		$os_res_obj = mysql_fetch_object($os_res);
		$order_state = $os_res_obj->name;
	}else{
		$order_state = "none";
	}
	?>
	<div class="manage_form_left_label">Order State</div> 
	<div class="manage_form_right_info"><?php echo $order_state; ?></div> 
	<div class="clear"></div>

	<?php
    $sql = "SELECT name
				FROM payment_status
				WHERE payment_status_id = '".$object->payment_status_id."'";
    $ps_res = mysql_query ($sql);
	if(!$ps_res)die(mysql_error());
	if(mysql_num_rows($ps_res) > 0){
		$ps_res_obj = mysql_fetch_object($ps_res);
		$payment_status = $ps_res_obj->name;
	}else{
		$payment_status = "none";
	}
	?>
	<div class="manage_form_left_label">Payment Status</div> 
	<div class="manage_form_right_info"><?php echo $payment_status; ?></div> 
	<div class="clear"></div>
    </fieldset>
    <br />
    <fieldset>
	<div class="manage_form_left_label">Line Items</div> 
	<div class="manage_form_right_info">
	<?php
    $sql = "SELECT *
			FROM order_line_item
			WHERE order_id = '".$object->order_id."'";
    $li_res = mysql_query ($sql);
	
	if(mysql_num_rows($ps_res) > 0){

			$block = '';
			$block .= "<div style='float:left; width:200px;'>";
			$block .= "Design Name";
			$block .= "</div>";
			$block .= "<div style='float:left; width:100px;'>";
			$block .= "QTY";
			$block .= "</div>";
			$block .= "<div style='float:left; width:200px;'>";
			$block .= "Price";
			$block .= "</div>";
			$block .= "<div class='clear'></div>";
			echo $block;
		$li_total = 0;
		while($row = mysql_fetch_object($li_res)) {
			
			$li_total += $row->qty * $row->price;  
			
			$block = '';
			$block .= "<div style='float:left; width:200px;'>";
			$block .= "<a href='line-item.php?order_line_item_id=".$row->order_line_item_id."'>".$row->name."</a>";
			$block .= "</div>";
			$block .= "<div style='float:left; width:100px;'>";
			$block .= $row->qty;
			$block .= "</div>";
			$block .= "<div style='float:left; width:200px;'>";
			$block .= "$".number_format($row->price,2);
			$block .= "</div>";
			$block .= "<div class='clear'></div>";
			echo $block;
		}
		
		//echo $li_total;
	
	}else{
		echo "no designs";			
	}
	?>	
    
    </div>
	<div class="clear"></div>
    </fieldset>
    <br />

    <fieldset>
    
    
	<div class="manage_form_left_label">Charge</div> 
	<div class="manage_form_right_info"><?php echo "$".number_format($object->total,2);; ?></div> 
	<div class="clear"></div>
    
    
    </fieldset>
    <br />
    <fieldset>

	<?php
	$db = $dbCustom->getDbConnect(USER_DATABASE);

	if($object->customer_id > 0){
		$sql = "SELECT user.name, user.username, user_type.label
				FROM  user, user_type 
				WHERE user.user_type_id = user_type.id
				AND user.id = '".$object->customer_id."'";
	
		$user_res = mysql_query ($sql);
		if(!$user_res)die(mysql_error());
		$user_obj = mysql_fetch_object($user_res);
		$customer_name = $user_obj->name;
		$customer_email = $user_obj->username;
		$customer_type	= $user_obj->label;


	}else{
		$customer_name = "none";
		$customer_email = "none";
		$customer_type	= "none";
	}
    ?>
	<div class="manage_form_left_label">Customer name</div> 
	<div class="manage_form_right_info"><?php echo $customer_name; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Customer Email</div> 
	<div class="manage_form_right_info"><?php echo $customer_email; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Customer Type</div> 
	<div class="manage_form_right_info"><?php echo $customer_type; ?></div> 
	<div class="clear"></div>
	</fieldset>
	<br />
    <fieldset>
	<div class="manage_form_left_label">Billing Information</div> 
	<div class="manage_form_right_info">
		<?php 
			if(trim($object->billing_name) != '') echo $object->billing_name."<br />"; 
			if(trim($object->billing_address_one) != '' || trim($object->billing_address_two) != ''){
				 echo $object->billing_address_one." ".$object->billing_address_two."<br />";
			}
			if(trim($object->billing_city) != '' || trim($object->billing_state) != ''){ 
				echo $object->billing_city.", ".$object->billing_state." ".$object->billing_zip." ".$object->billing_country."<br />";
			}
			if(trim($object->billing_phone) != '') echo $object->billing_phone;
		?>
    </div> 
	<div class="clear"></div>
	</fieldset>
	<br />
    <fieldset>	
	<div class="manage_form_left_label">Shipping Information</div> 
	<div class="manage_form_right_info">
		<?php 
			if(trim($object->shipping_name) != '') echo $object->shipping_name."<br />"; 
			if(trim($object->shipping_address_one) != '' || trim($object->shipping_address_two) != ''){
				 echo $object->shipping_address_one." ".$object->shipping_address_two."<br />";
			}
			if(trim($object->shipping_city) != '' || trim($object->shipping_state) != ''){ 
				echo $object->shipping_city.", ".$object->shipping_state." ".$object->shipping_zip." ".$object->shipping_country."<br />";
			}
			if(trim($object->shipping_phone) != '') echo $object->shipping_phone;
		?>
    </div> 
	<div class="clear"></div>
	</fieldset>


    
    
</div> 
<p class="clear"></p>
<?php 
require_once("<?php echo SITEROOT; ?>includes/manage-footer.php");
?>    
</div>



    <div style="display:none">
        <div id="edit" style="width:900px; height:620px;">
        </div>
    </div>
    

</body>
</html>



