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
	
	
//$cartItem = new ShoppingCartItem;		
//$detect = new Mobile_Detect;
//$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 2 : 1) : 3);
//$item_id = (isset($_GET["item_id"])) ? $_GET["item_id"] : 0;
$top_item_id = (isset($_GET["top_item_id"])) ? $_GET["top_item_id"] : 0;
$attr_opts = (isset($_GET["attr_opts"])) ? $_GET["attr_opts"] : 0;
$the_qty = (isset($_GET["qty"])) ? $_GET["qty"] : 1;


//$qty = (isset($_GET["qty"])) ? $_GET["qty"] : 1;
//echo $item_id; 
//$cartItem = new ShoppingCartItem;		

$ct_out = explode("---",$attr_opts);

if(is_array($ct_out)){
	array_pop($ct_out);
}else{
	$ct_out = array();	
}

$db = $dbCustom->getDbConnect(CART_DATABASE);	
$sql = "SELECT item_id
		FROM item
		WHERE parent_item_id = '".$top_item_id."'";

$res = $dbCustom->getResult($db,$sql);

$j = 0;
$a_item_array[$j] = $top_item_id;
while($a_item_row = $res->fetch_object()){
	$j++;	
	$a_item_array[$j] = $a_item_row->item_id;
}

$included_items_array = array();
$i = 0;
$j = 0;
$has_options = 0;
$attr_count = 0;
foreach($ct_out as $ct_out_v){
	$ct_in = explode("|",$ct_out_v);		
	if($ct_in[1] > 0){
		$attr_count++;
	}
}




//echo $attr_count;

foreach($a_item_array as $a_item_v){

	foreach($ct_out as $ct_out_v){
		
		$ct_in = explode("|",$ct_out_v);		
		
		if($ct_in[1] > 0){
			$sql = "SELECT opt.opt_id 
					FROM  opt, item_to_opt
					WHERE item_to_opt.opt_id = opt.opt_id
					AND item_to_opt.item_id = '".$a_item_v."'					 
					AND opt.opt_id = '".$ct_in[1]."' 
					";
			$res = $dbCustom->getResult($db,$sql);
			
			if($res->num_rows > 0){
				//$opt_obj = $res->fetch_object();
				$j++;
			}
		}
	}
	
	if($j == $attr_count){
		$included_items_array[$i] = $a_item_v;
		$i++;		
	}
	
	$j = 0;
}



if(count($included_items_array) > 1){
	$included_items_array = array_unique($included_items_array);	
}
if(count($included_items_array) > 1 && $attr_count > 0){
	
	echo 'gt';
	
}elseif(count($included_items_array) == 1 || $attr_count == 0){		
	
	if($attr_count > 0){
		$item_id = $included_items_array[0]; 	
	}else{
		$item_id = $top_item_id;
	}
	
	$qty = $the_qty;	
	
	
	
	
	//echo $item_id."-------------------------";
	
	
	$cart->addItem($item_id, $qty);
	
	
	
					$item_count = $design_cart->getItemCount();			
					$item_count += $cart->getItemCount();
					$sbt = 0;
					$j = 0;
					$max_name_len = 12;
					$block = '';
					$cartLink = SITEROOT.'/'.$_SESSION['global_url_word'].'shopping-cart.html';
					$itemDetailsLink = '';
					
					
																   
					if($cart->hasItems()){	
						$block .= $cart->getHeaderBlock();
					}
					
					if($design_cart->hasItems()){
						$block .= $design_cart->getHeaderBlock();
					}


			$ret_sc_block = '';	
	
	          if($item_count > 0){
				  
	            
				$ret_sc_block .= "<a href='".$cartLink."' title='".$_SESSION['profile_company']."  Shopping Cart'>";
	            $ret_sc_block .= "<i class='header-icon-cart'></i> My Cart (".$item_count.")</a>";
				$ret_sc_block .= "<ul class='header_subnav_cart'>";
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
	
	
	/*
	$returnData = json_encode(array(
						'msg'=> stripslashes($item['name']).' was added to your cart',
						'item_count'=>$cart->getItemCount(),
						'qty'=>$qty,
						'line_item'=> $block
						));
	
	
	echo $returnData;
	*/

}else{

	//$returnData = json_encode(array('msg'=>'lt'));	
	echo 'lt';
}


//echo $returnData;






//echo $cart->getItemCount();

//echo 999;

//$cart->saveCart();

?>