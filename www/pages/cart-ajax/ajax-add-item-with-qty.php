<?php
require_once("../../includes/config.php");
require_once("../../includes/class.shopping_cart.php");
require_once('../../includes/class.design_cart.php');
require_once('../../includes/accessory_cart_functions.php');
require_once('../../includes/class.nav.php');
//require_once("../../includes/class.shopping_cart_item.php");
//require_once('../../includes/Mobile_Detect.php');

//1 phone
//2 tablet
//3 computer

	$nav = new Nav;
	$cart = new ShoppingCart;
	$design_cart = new DesignCart;		


$item_id = (isset($_GET["item_id"])) ? $_GET["item_id"] : 0;
$qty = (isset($_GET["qty"])) ? $_GET["qty"] : 1;


	
	
	$cart->addItem($item_id, $qty);
	
	
	
					$item_count = $design_cart->getItemCount();			
					$item_count += $cart->getItemCount();
					$sbt = 0;
					$j = 0;
					$max_name_len = 12;
					$block = '';
					$cartLink = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['global_url_word'].'shopping-cart.html';
					$itemDetailsLink = '';
					if($cart->hasItems()){
					//if(0){
						$cart_contents_array = $cart->getContents();
						foreach ($cart_contents_array as $cart_array) {

					$brand_name = getBrandName($cart_array['brand_id']);
					$itemDetailsLink = $nav->getItemUrl($cart_array['seo_url'], $cart_array['name'], $cart_array['profile_item_id'], $brand_name, 'shop');
					

							$qty_price = $cart_array['price'] * $cart_array['qty']; 
							$sbt += $qty_price;
							$block .= "<tr id='item_".$cart_array['item_id']."'>";
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$block .= "<img src='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$cart_array["image_file"]."' alt='' /></a>";
							$block .= "</td>";
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$cart_item_name = stripslashes($cart_array['name']); 
							if(strlen($cart_item_name) > $max_name_len){
								$block .=  substr($cart_item_name, 0 , $max_name_len);
								$block .= "...";
							}else{
								$block .= $cart_item_name;	
							}
							$block .= '</a></td>';
							$block .= "<td><a class='cart-header-item-qty' href='".$itemDetailsLink."'>";
							$block .= $cart_array['qty'];
							$block .= "</a></td>";
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$block .= "$".number_format($qty_price,2);
							$block .= '</td>';
							$block .= '</tr>';
						}
					}
					if($design_cart->hasItems()){
						$design_cart_contents_array = $design_cart->getContents();				
						foreach ($design_cart_contents_array as $design_cart_array) {
							$itemDetailsLink = '/app';
							$qty_price = $design_cart_array['price'] * $design_cart_array['qty']; 
							$sbt += $qty_price;
							$block .= '<tr>';
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$block .= "<img src='/images/custom-item-in-cart.jpg' alt='' /></a>";
							$block .= '</td>';
							$block .= "<td><a href='".$itemDetailsLink."'>";
							if(strlen($design_cart_array['name']) > $max_name_len){	
								$block .=  substr($cart_item_name, 0 , $max_name_len);
								$block .= "...";
							}else{
								$block .= stripslashes($design_cart_array['name']);	
							}
							$block .= '</a></td>';
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$block .= $design_cart_array["qty"];
							$block .= '</a></td>';
							$block .= "<td><a href='".$itemDetailsLink."'>";
							$block .= '$'.number_format($qty_price,2);
							$block .= '</td>';
							$block .= '</tr>';
						}								
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

	
	echo $ret_sc_block;


?>