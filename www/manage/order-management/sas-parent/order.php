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

$page_title = "Order";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

$ret = (isset($_GET["ret"]))? $_GET["ret"] : 'order-list'; 

	


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

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
	<body onLoad="show_msg('<?php  echo $msg; ?>')">
<?php }else{ ?>
	<body>
<?php } 

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
	
	$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;
	$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
	$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
	$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
	$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
	
	$url_str = "?order_id=".$order_id;
	$url_str .= '&pagenum='.$pagenum;
	$url_str .= '&sortby='.$sortby;
	$url_str .= '&a_d='.$a_d;
	$url_str .= '&truncate='.$truncate;
?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

    <div class="manage_main">

<a href="<?php echo $ret.'.php'.$url_str; ?>" class='btn btn-small'>Back</a>

	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
	

    

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT *
			FROM  ctg_order 
			WHERE order_id = '".$order_id."'";

    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
	$object = $result->fetch_object();
    ?>

    <fieldset>	
    
	<div class="manage_form_left_label">Order Id</div> 
	<div class="manage_form_right_info"><?php echo $order_id; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Order Date & Time</div> 
	<div class="manage_form_right_info"><?php echo date("m/d/Y h:i:s a",strtotime($object->order_date)); ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Shipping Name</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_name; ?></div> 
	<div class="clear"></div>
    
	<div class="manage_form_left_label">Shipping Name Company</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_name_company; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Shipping Address One</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_address_one; ?></div> 
	<div class="clear"></div>
    
	<div class="manage_form_left_label">Shipping Address Two</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_address_two; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Shipping City</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_city; ?></div> 
	<div class="clear"></div>



	<div class="manage_form_left_label">Shipping State</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_state; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Shipping Zip</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_zip; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Shipping Country</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_country; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Shipping Phone</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_phone; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing Name</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_name; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing Email</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_email; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing Address One</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_address_one; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing Address Two</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_address_two; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing City</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_city; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Billing State</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_state; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Billing Zip</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_zip; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Billing Country</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_country; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Billing Phone</div> 
	<div class="manage_form_right_info"><?php echo $object->billing_phone; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Card Transaction Id</div> 
	<div class="manage_form_right_info"><?php echo $object->card_transaction_id; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Card Auth Code</div> 
	<div class="manage_form_right_info"><?php echo $object->card_auth_code; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Card Type Id</div> 
	<div class="manage_form_right_info"><?php echo $object->card_type_id; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Card Type Id</div> 
	<div class="manage_form_right_info"><?php echo $object->card_type_id; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Card Exp Date</div> 
	<div class="manage_form_right_info"><?php echo $object->card_exp; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Sub Total</div> 
	<div class="manage_form_right_info"><?php echo $object->sub_total; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Tax</div> 
	<div class="manage_form_right_info"><?php echo $object->tax_cost; ?></div> 
	<div class="clear"></div>



	<div class="manage_form_left_label">Shipping Cost</div> 
	<div class="manage_form_right_info"><?php echo $object->shipping_cost; ?></div> 
	<div class="clear"></div>



	<div class="manage_form_left_label">Discount Amount</div> 
	<div class="manage_form_right_info"><?php echo $object->discount_amount; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Total</div> 
	<div class="manage_form_right_info"><?php echo $object->total; ?></div> 
	<div class="clear"></div>


	<div class="manage_form_left_label">Coupon Code</div> 
	<div class="manage_form_right_info"><?php echo $object->coupon_code; ?></div> 
	<div class="clear"></div>

	<div class="manage_form_left_label">Purchase Order Number</div> 
	<div class="manage_form_right_info"><?php echo $object->purchase_order_number; ?></div> 
	<div class="clear"></div>

	<?php
    $sql = "SELECT name
			FROM payment_status
			WHERE payment_status_id = '".$object->payment_status_id."'";

    $result = $dbCustom->getResult($db,$sql);	

	if($result->num_rows > 0){
		$ps_res_obj = $result->fetch_object();
		$payment_status = $ps_res_obj->name;
	}else{
		$payment_status = "none";
	}
	?>
	<div class="manage_form_left_label">Payment Status</div> 
	<div class="manage_form_right_info"><?php echo $payment_status; ?></div> 
	<div class="clear"></div>
    
	<div class="manage_form_left_label"><a class='btn btn-small' href="transaction.php?order_id=<?php echo $order_id; ?>&ret_page=order">View Transaction</a></div> 
	<div class="manage_form_right_info"></div> 
	<div class="clear"></div>
    
    </fieldset>
    <br />
    <fieldset>
	<div class="manage_form_left_label">Designs</div> 
	<div class="manage_form_right_info">
	<?php
    $sql = "SELECT *
			FROM order_line_item
			WHERE order_id = '".$object->order_id."'
			AND design_id > '0'";
    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){

			$block = '';
			$block .= "<div style='float:left; width:180px;'>";
			$block .= "Design Name";
			$block .= "</div>";

			$block .= "<div style='float:left; width:100px;'>";
			$block .= "Unit Price";
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:100px;'>";
			$block .= "QTY";
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:100px;'>";
			$block .= "Price";
			$block .= "</div>";
			
			$block .= "<div class='clear'></div>";
			echo $block;
		$li_total = 0;
		while($row = $result->fetch_object()) {
			
			$li_total += $row->qty * $row->price;  
			
			$block = '';
			$block .= "<div style='float:left; width:180px;'>";
			//$block .= "<a href='line-item.php?order_line_item_id=".$row->order_line_item_id."'>".$row->name."</a>";
			
			$block .= "<a href='".SITEROOT."/app/?id=".$row->design_id."'>".$row->name."</a>";
			
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:100px;'>";
			$block .= "$".number_format($row->price,2);
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:100px;'>";
			$block .= $row->qty;
			$block .= "</div>";

			$block .= "<div style='float:left; width:100px;'>";
			
			$qty_price = $row->price * $row->qty; 
			
			$block .= "$".number_format($qty_price,2);
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
	<div class="clear" ></div>
    </fieldset>
    <br />

    <fieldset>
	Items <br />
	<?php
    $sql = "SELECT *
			FROM order_line_item
			WHERE order_id = '".$object->order_id."'
			AND item_id > '0'";
			
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){

			$block = '';
			$block .= "<div style='float:left; width:45%;'>";
			$block .= "Item Name";
			$block .= "</div>";

			$block .= "<div style='float:left; width:15%;'>";
			$block .= "Unit Price";
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:15%;'>";
			$block .= "QTY";
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:15%;'>";
			$block .= "Price";
			$block .= "</div>";
			
			$block .= "<div class='clear'></div>";
			echo $block;
		$li_total = 0;
		while($row = $result->fetch_object()) {
			
			$li_total += $row->qty * $row->price;  
			
			$block = '';
			$block .= "<div style='float:left; width:45%;'>";
			//$block .= "<a href='line-item.php?order_line_item_id=".$row->order_line_item_id."'>".$row->name."</a>";
			
			$block .= $row->name;
			
			
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:15%;'>";
			$block .= "$".number_format($row->price,2);
			$block .= "</div>";
			
			$block .= "<div style='float:left; width:15%;'>";
			$block .= $row->qty;
			$block .= "</div>";

			$block .= "<div style='float:left; width:15%;'>";
			
			$qty_price = $row->price * $row->qty; 
			
			$block .= '$'.number_format($qty_price,2);
			$block .= "</div>";
			
			$block .= "<div class='clear'></div>";
			echo $block;
		}
		
		//echo $li_total;
	
	}else{
		echo "no items";			
	}
	?>	
    
    </fieldset>
    <br />

    <fieldset>
	<div class="manage_form_left_label">Services</div> 
	<div class="manage_form_right_info">
	<?php
	/*
    $sql = "SELECT order_line_item.service_id, service.name
			FROM order_line_item, service
			WHERE order_line_item.service_id = service.service_id
			AND order_id = '".$object->order_id."'
			AND service_id > '0'";
    $li_res = mysql_query ($sql);
	
	*/
	?>	
    </div>
	<div class="clear"></div>
    </fieldset>
    <br />

    <fieldset>
    
    
	<div class="manage_form_left_label">Charge</div> 
	<div class="manage_form_right_info"><?php echo '$'.number_format($object->total,2);; ?></div> 
	<div class="clear"></div>
    
    
    </fieldset>
    <br />
    <fieldset>

	<?php

	$customer_name = 'none';
	$customer_email = 'none';
	$customer_type	= 'none';


	if($object->customer_id > 0){
		
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$sql = "SELECT user.name, user.username, user_type.label
				FROM  user, user_type 
				WHERE user.user_type_id = user_type.id
				AND user.id = '".$object->customer_id."'";

		$result = $dbCustom->getResult($db,$sql);		
		
		if($result->num_rows > 0){
		
			$user_obj = $result->fetch_object();
			$customer_name = $user_obj->name;
			$customer_email = $user_obj->username;
			$customer_type	= $user_obj->label;
		}
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
			if(trim($object->billing_name) != '') echo $object->billing_name.'<br />'; 
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


	<div class="manage_form_left_label">Shipping Istructions</div> 
	<div class="manage_form_right_info">
		<?php 
			if(trim($object->instructions) != '') echo $object->instructions; 
		?>
    </div> 
	<div class="clear"></div>


	</fieldset>


<?php } ?>    
    
</div> 



<?php

	// this is the sql update			
	require_once($_SERVER['DOCUMENT_ROOT']."/manage/order-management/process-update-include.php"); 
		
	$url_str = 'order-list.php';
	$url_str .= "?order_id=".$order_id;
	$url_str .= '&pagenum='.$pagenum;
	$url_str .= '&sortby='.$sortby;
	$url_str .= '&a_d='.$a_d;
	$url_str .= '&truncate='.$truncate;

?>


	<form action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data" target="_top">
    
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
		<legend>Order Processes Completed</legend>
				<label>Check the boxes that apply </label>
                
          		<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        	<th>Order State</th>
							<th>Complete</th>
                        </tr>
					</thead>
                <?php
				
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT order_state_id, order_state.name 
			FROM order_state";
    $result = $dbCustom->getResult($db,$sql);	
	
	$block = '';
	
	while($row = $result->fetch_object()){						
	
		$sql = "SELECT order_to_order_state_id 
				FROM order_to_order_state
				WHERE order_to_order_state.order_state_id = '".$row->order_state_id."' 
				AND order_to_order_state.order_id = '".$order_id."'
				AND order_to_order_state.when_complete > '0'";
		$res = $dbCustom->getResult($db,$sql);
		
		$block .= "<td valign='top'>".$row->name."</td>";
		
		$checked = ($result->num_rows > 0)? "checked='checked'" : '';			
						
		$block .= "<td valign='top'>
			<div class='checkboxtoggle on' > 
			<span class='ontext'>Done</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>Not</span>
			<input type='checkbox' class='checkboxinput' name='done_states[]' value='".$row->order_state_id."' $checked /></div></td>";
		
		$block .= '</tr>';
	}
						
	$block .= '</table>';	
					
	echo $block;
				
	?>

			<input type="submit" name="process" value="Update Order Status">			
            
	</form>

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


