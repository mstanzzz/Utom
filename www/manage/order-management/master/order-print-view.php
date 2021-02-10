<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/Mobile_Detect.php');
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 2 : 1) : 3);

$shipping = new Shipping;
$module = new Module;

$page_title = "Order";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 

$ret = (isset($_GET["ret"]))? $_GET["ret"] : 'order-list'; 

	


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Order Confirmation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content='' />
<meta name="description" content='' />
<meta name="ROBOTS" content="noodp, index, follow">
<meta name="msnbot" content="noodp, index, follow">
<meta name="googlebot" content="noodp, index, follow">

<link href="<?php echo SITEROOT; ?>/css/base.min.css" rel="stylesheet">

<!--
<link href="<?php echo SITEROOT; ?>/css/base.css" rel="stylesheet">
-->


<link href="<?php echo SITEROOT; ?>/css/responsive.min.css" rel="stylesheet">
<!--
<link href="<?php //echo SITEROOT; ?>/css/responsive.css" rel="stylesheet">
-->

<link href="<?php echo SITEROOT; ?>/js/fancybox2/source/jquery.fancybox.css?v=2.1.4" rel="stylesheet">


<link type="text/css" rel="stylesheet" media="all" href="<?php echo SITEROOT; ?>/css/mmenu.min.css" />
<!--
<link type="text/css" rel="stylesheet" media="all" href="<?php //echo SITEROOT; ?>/css/mmenu.css" />
-->

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- Cross-Browser Adjustments for graceful degradation; remove per version as support drops -->
<!--[if IE 7]>
      <link href="<?php echo $secure_root; ?>/css/ie/ie.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 8]>
      <link href="<?php echo $secure_root; ?>/css/ie/ie8.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 9]>
      <link href="<?php echo $secure_root; ?>/css/ie/ie9.css" rel="stylesheet">
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
<script>

/*
	
	$.confirm({
		text: "Would you like to print this page?",
		confirm: function() {
			window.print();
		},
		cancel: function() {
			// nothing to do
		}
	});
*/

$(document).ready(function(){	
	//alert("p");
	
	window.print();

});

</script>

</head>
<body class="print">


<?php

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



$db = $dbCustom->getDbConnect(CART_DATABASE);
	
$sql = "SELECT *
		FROM  ctg_order 
		WHERE order_id = '".$order_id."'";
   $result = $dbCustom->getResult($db,$sql);	
if($result->num_rows > 0){
	$object = $result->fetch_object();
?>

<!--
<a href="<?php //echo 'order.php'.$url_str; ?>" class='btn btn-small'>Back</a>
-->
<br /><br /><br />
<div class="container page-content">
	<section class="row confirmation">
		<div class="span12">
        
        	<img src="<?php echo SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/logo/".get_logo(); ?>">
            
            
        <span style="font-size:18px;">Questions? Problem? Call Us: <?php echo getCompanyPhone(); ?></span><span style="float:right; margin-top:16px; font-size:18px; clear:both;"><?php echo SITEROOT; ?></span> 
        
        
        
			<div class="itembox order-review">
				<div class="row">
					<div class="span6">
						<div class="row">
							<div class="span3"><h3>Order Number:</h3></div>
							<div class="span3"><h3 class="align-right"><strong><?php echo $object->order_id; ?></strong></h3></div>
						</div>
						<div class="row">
							<div class="span3"><h3>Total:</h3></div>
							<div class="span3"><h3 class="align-right"><strong><?php echo "$".number_format($object->total,2); ?></strong></h3></div>
						</div>
						<hr />
						
                        <?php
							$ship_method = '';
							if($object->shipping_id > 0){							
								$ship_method = $shipping->getMethodName($object->shipping_id);									
							}else{
								if($object->actual_ship_method != ''){
									$ship_method = $object->actual_ship_method;
								}
							}
						
						 if($ship_method != ''){ ?>
                        <div class="row">
							<div class="span2">Shipping Method:</div>
							<!-- I can't see where we're storing shipping method with the order? Please add that and then display here. -->
							<div class="span4"><strong><?php echo $ship_method; ?></strong></div>
						</div>
						<hr />
                        <?php } ?>
                        
						<div class="row">
							<div class="span2">Shipping Address:</div>
							<div class="span4"><strong>            
								<?php 
								if(trim($object->shipping_name) != ''){ 
									echo $object->shipping_name.'<br />'; 
								}
								if(trim($object->shipping_address_one) != '' || trim($object->shipping_address_two) != ''){
									 echo $object->shipping_address_one." ".$object->shipping_address_two."<br />";
								}
								if(trim($object->shipping_city) != '' && trim($object->shipping_state) != ''){ 
									echo $object->shipping_city.", ".$object->shipping_state." ".$object->shipping_zip." ".$object->shipping_country;
								}
								?>
								</strong></div>
						</div>
						<hr />
                        
						<?php 
						if(trim($object->shipping_email) != ''){
                        echo "<div class='row'>
							<div class='span2'>Shipping Email:</div>
							<div class='span4'><strong> $object->shipping_email</strong></div>
						</div>";
                        } 
						if(trim($object->shipping_phone) != ''){
                        echo "<div class='row'>
							<div class='span2'>Shipping Phone:</div>
							<div class='span4'><strong> $object->shipping_phone</strong></div>
						</div>";
                        } 
						?>
					</div>
					<div class="span6">
						<div class="row">
							<div class="span2"><h3>Order Date:</h3></div>
							<div class="span4"><h3 class="align-right"><strong><?php echo date("m/d/Y",$object->order_date); ?></strong></h3></div>
						</div>
                        <?php
						
						if($object->discount_amount > 0){
							echo "<div class='row'>
								<div class='span2'><h3>You Saved:</h3></div>
								<div class='span4'><h3 class='align-right'>
								<strong>$".number_format($object->discount_amount,2)."</strong></h3></div></div>";
						}						
						?>
						<hr />
                        <!--
						<div class="row">
							<div class="span2">Payment Method:</div>
							<div class="span4"><strong></strong></div>
						</div>
						<hr />
                        -->
						<div class="row">
							<div class="span2">Billing Address:</div>
							<div class="span4"><strong><?php 			
								if(trim($object->billing_name) != ''){ 
									echo $object->billing_name."<br />";
								}
								if(trim($object->billing_address_one) != '' || trim($object->billing_address_two) != ''){
									 echo $object->billing_address_one." ".$object->billing_address_two."<br />";
								}
								
								if(trim($object->billing_city) != '' && trim($object->billing_state) != ''){ 
									echo $object->billing_city.", ".$object->billing_state." ".$object->billing_zip." ".$object->billing_country;
								}
						?>
                        </strong></div>
						</div>
						<hr />
						<?php 
						if(trim($object->billing_email) != ''){
                        echo "<div class='row'>
							<div class='span2'>Billing Email:</div>
							<div class='span4'><strong> $object->billing_email</strong></div>
						</div>";
                        } 
						if(trim($object->billing_phone) != ''){
                        echo "<div class='row'>
							<div class='span2'>Billing Phone:</div>
							<div class='span4'><strong> $object->billing_phone</strong></div>
						</div>";
                        } 
						?>
					</div>
				</div>
			</div>
		</div>
			<?php
			
			$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'thumb') : 'medium');
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT *
				FROM order_line_item
				WHERE order_id = '".$object->order_id."'";
				
			$result = $dbCustom->getResult($db,$sql);
			$block = '';
			if($result->num_rows > 0){
				$block .= "<div class='span12 heading-bar cart hide-mobile'>";
				$block .= "<div class='row'>";
					$block .= "<div class='span6'><h4>Item Details</h4></div>";
					$block .= "<div class='span2'><h4 class='align-center'>Unit Price</h4></div>";
					$block .= "<div class='span2'><h4 class='align-center'>Quantity</h4></div>";
					$block .= "<div class='span2'><h4 class='align-center'>Price</h4></div>";
				$block .= "</div>";
				$block .= "</div>";
			}
			
			$i = 0;
			while($row = $result->fetch_object()){

				$id = ($row->item_id > 0) ? $row->item_id : $row->design_id;
				$type = ($row->item_id > 0) ? 'Product' : 'Custom Design';
				
				$image = ($type == "Product") ? SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".getItemPic($id) : SITEROOT."/images/custom-item-in-cart.jpg";
				
				$block .= "<div class='span12 cart-item'>";
					$block .= "<div class='itembox'>";
						$block .= "<div class='row'>";
							$block .= "<div class='span2'><span class='product-image'><img src='".$image."' alt='".$row->name."' /></span></div>";
							$block .= "<div class='span4 product-details'>";
								$block .= "<h3><a href='#'>".$row->name."</a></h3>";
								$block .= "<h5><a href='#'>".$type." Id: ".$id."</a></h5>";
							$block .= "</div>";
							$block .= "<div class='span2 product-unit-price'><p class='align-right'>".$row->qty."</p></div>";
							$block .= "<div class='span2 product-price'><p class='align-right'>$".number_format($row->qty*$row->price,2)."</p></div>";
						$block .= "</div>";
					$block .= "</div>";
				$block .= "</div>";
				$i++;
			}
			
			echo $block;
		?>	
			
        <div class="span12">
			<div class="totals-box itembox">
				<div class="row">
					<div class="span2 totals-left">
						<h5>Discount:</h5>
						<h5>Tax:</h5>
						<h5>Shipping:</h5>
					</div>
					<div class="span3 offset7 totals-right">
						<h5><?php echo "$".number_format($object->discount_amount,2); ?></h5>
						<h5><?php echo "$".number_format($object->tax_cost,2); ?></h5>
						<h5><?php echo "$".number_format($object->shipping_cost,2); ?></h5>
					</div>
				</div>
			</div>
			<div class="grand-totals-box itembox">
				<div class="row">
					<div class="span2 totals-left">
						<h3>Total:</h3>
					</div>
					<div class="span3 offset7 totals-right">
						<h3><?php echo "$".number_format($object->total,2); ?></h3>
					</div>
				</div>
			</div>
		
       
        
        </div>
	</section>
</div>

<?php
}

?>


</body>
</html>
