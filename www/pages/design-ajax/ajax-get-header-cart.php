<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}else/* MS */}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shopping_cart.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.design_cart.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'includes/class.order_fulfillment.php');

//require_once($_SERVER['DOCUMENT_ROOT'].'/includes/accessory_cart_functions.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');

$cart = new ShoppingCart;
$design_cart = new DesignCart;		
//$order_fulfillment = new OrderFulfillment;

//$nav = new Nav;

// use this to get status (was it added to cart .....)
$design_id = (isset($_GET['design_id'])) ? $_GET['design_id'] : 0;

$item_count = $design_cart->getItemCount();			
$item_count += $cart->getItemCount();

$sbt = 0;
$j = 0;
$max_name_len = 12;
$block = '';
$cartLink = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['global_url_word'].'shopping-cart.html';


if($cart->hasItems()){	
	$block .= $cart->getHeaderBlock();
	$sbt += $cart->total_price;
}


if($design_cart->hasItems()){
	$block .= $design_cart->getHeaderBlock();
}

			$ret_sc_block = '';	
	
	          if($item_count > 0){
	            
				$ret_sc_block .= "<a href='".$cartLink."' title='".$_SESSION['profile_company']."  Shopping Cart'>";
	            $ret_sc_block .= "<i class='header-icon-cart'></i> My Cart (".$item_count.")</a>";
				$ret_sc_block .= "<ul class='subnav'>";
				$ret_sc_block .= "<li class='drop-heading'><a href='".$cartLink."'><strong class='pull-right'>".number_format($sbt,2)."</strong>";
	            $ret_sc_block .= "<strong>Subtotal:</strong></a></li>";
				$ret_sc_block .= "<li class='drop-table'>";
				$ret_sc_block .= "<table class='drop-table cart'>";
				$ret_sc_block .= "<thead>";
				$ret_sc_block .= "<tr>";
				$ret_sc_block .= "<th colspan='2'>Item</th>";
				$ret_sc_block .= "<th>QTY</th>";
				$ret_sc_block .= "<th>Price</th>";
				$ret_sc_block .= "</tr>";
				$ret_sc_block .= "</thead>";
				$ret_sc_block .= "<tbody>";							
				$ret_sc_block .= $block;							
				$ret_sc_block .= "</tbody>";
				$ret_sc_block .= "</table>";
				$ret_sc_block .= "</li>";
				$ret_sc_block .= "<li class='button'><a href='".$cartLink."' class='btn btn-success'>Go to Checkout <i class='icon-triangle-right icon-white'></i></a></li>";
				$ret_sc_block .= "</ul>";
                
			 } 

//$item_count = 99;

if($design_cart->inCart($design_id) > 0){
	$status = "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."shopping-cart.html' >In Shopping Cart </a>";	
}elseif($order_fulfillment->getMaxStartedStepNumber($row->file_id) == 0){
	$status = "<a href='#' onClick='add_to_cart(".$row->file_id.",".$customer_id.");'>Add To Cart</a>";
}
	
			$returnData = json_encode(array(
						'mobile_qty'=>$item_count
						,'ret_sc_block'=>$ret_sc_block
						,'status'=>$status
						));
			

			echo $returnData;





?>