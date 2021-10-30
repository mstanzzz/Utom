<?php
require_once('<?php echo SITEROOT; ?>includes/config.php');
require_once('<?php echo SITEROOT; ?>includes/db_connect.php'); 
require_once('<?php echo SITEROOT; ?>includes/class.shipping.php');


$shipping = new Shipping;



$action = (isset($_GET['action'])) ? $_GET['action'] : 60007;

$ship_rate_zip = (isset($_GET['ship_rate_zip']))? $_GET['ship_rate_zip'] : '';
	
$ship_rate_state = (isset($_GET['ship_rate_state']))? $_GET['ship_rate_state'] : '';	
	
$ship_rate_weight_stock_items = (isset($_GET['ship_rate_weight_stock_items']))? $_GET['ship_rate_weight_stock_items'] : 0;

$grand_total_without_shipping = (isset($_GET['grand_total_without_shipping']))? $_GET['grand_total_without_shipping'] : 0;


if($action == 'get_single_rate_with_drop_ship'){

	require_once('<?php echo SITEROOT; ?>includes/class.shopping_cart.php');
	$cart = new ShoppingCart;
	
	$drop_ship_array = $cart->getDropShipItems();

	$total_drop_ship_cost = 0;
		
	foreach($drop_ship_array as $v){
		
		$w = $v['weight'] * $v['qty'];

		$total_drop_ship_cost += $shipping->getSingleRateFromFedex($w, $shipping->from_zip, $shipping->from_state, $ship_rate_zip, $ship_rate_state);
	
	}

	//echo $total_drop_ship_cost;
	$stocked_array = $cart->getStockedItems();
	$stocked_weight = 0;
	foreach($stocked_array as $v){
		$stocked_weight += $v['weight'] * $v['qty'];	
	}
	
	$stocked_ship_cost = $shipping->getSingleRateFromFedex($stocked_weight, $shipping->from_zip, $shipping->from_state, $ship_rate_zip, $ship_rate_state);
	
	$_SESSION['shipping_cost'] = $total_drop_ship_cost + $stocked_ship_cost;
	
	$grand_total = $grand_total_without_shipping + $_SESSION['shipping_cost'];
	
	$returnData = json_encode(array(
						"shipping_cost"=> number_format($_SESSION['shipping_cost'],2),
						"grand_total"=>number_format($grand_total,2)
						));
						
	echo $returnData;
	
	
}


if($action == 'verify_shipping_cost'){
	
	$ret = 'y';
	
	$form_shipping_cost = (isset($_GET['form_shipping_cost']))? $_GET['form_shipping_cost'] : 0;
	$ship_rate_weight_stock_items = (isset($_GET['ship_rate_weight_stock_items']))? $_GET['ship_rate_weight_stock_items'] : 0;
	
	
	//if($shipping->getShipType() == 'carrier'){
		
		if($ship_rate_weight_stock_items > 0){
			
			if($form_shipping_cost <= 0){

				//echo "c: ".$form_shipping_cost."    w: ".$ship_rate_weight_stock_items."     ".$shipping->getShipType();
			
				$ret = 'n';
			
			}
		}
		
	//}
	
	echo $ret;
}


if($action == 'get_carrier_shipping_cost'){

	$_SESSION['ship_method_id'] = (isset($_GET['ship_method_id']))? $_GET['ship_method_id'] : 0; 
		
	$_SESSION['shipping_cost'] = $shipping->getShippingCostFromCarrier($_SESSION['ship_method_id']);
	
	$grand_total = $grand_total_without_shipping + $_SESSION['shipping_cost'];
	
	$returnData = json_encode(array(
						"shipping_cost"=> number_format($_SESSION['shipping_cost'],2),
						"grand_total"=>number_format($grand_total,2)
						));
						
	echo $returnData;
	
}

if($action == 'get_carrier_rates_select_box'){

	$_SESSION['ship_rate_zip'] = (isset($_GET['ship_rate_zip']))? $_GET['ship_rate_zip'] : '';
	
	$_SESSION['ship_rate_state'] = (isset($_GET['ship_rate_state']))? $_GET['ship_rate_state'] : '';
	
	$_SESSION['weight'] = (isset($_GET['ship_rate_weight_stock_items']))? $_GET['ship_rate_weight_stock_items'] : 0;

	if(!isset($_SESSION['ship_method_id'])) $_SESSION['ship_method_id'] = 0;
	
	//$rates = $shipping->resetCarrierRates(1,'33141', '');
	
	$rates = $shipping->resetCarrierRates($_SESSION['weight'], $_SESSION['ship_rate_zip'], $_SESSION['ship_rate_state']);
		
	$block = '';
	$block .= "<select id='ship_method_id' name='ship_method_id' onchange='get_single_shipping_cost()' style='float:left;'>";	

	$block .= "<option value='0'> Please Select </option>";		
	
	$err = 0;
						
	foreach($rates as $rate){
		
		// Error
		if($rate['rate'] < 0){
			$err = 1;	
			$block = "An error occured while trying to retrive shipping cost estimates. Please check that your zip code is correct.";
			break;
		}
		
			
		if($_SESSION['ship_method_id'] == $rate['ship_method_id']){
			$sel = 'selected';	
		}else{
			$sel = '';	
		}
		
		//$rate['company']
			
		$block .= "<option value='".$rate['ship_method_id']."' 
		".$sel.">$".$rate['rate']."&nbsp;&nbsp;".$rate['method_name']."</option>";		
	}
	
	if(!$err){		
		$block .= "</select>";
	}
	
	
	
	echo $block;
	
	
	
	
}

	
if($action == 'reset_ship_selector'){	


}
		



?>