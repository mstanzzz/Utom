<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.order.php');
$order = new Order;
$acc = new CustomerAccount;
$acc->setDbAccData($customer_id);
$customer_id = $lgn->getCustId();	

if(!$lgn->isLogedIn()){
	require_once($_SERVER['DOCUMENT_ROOT']."/pages/resources/signin-form.php");
}

$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : '';

$search_order_num = (isset($_REQUEST['search_order_num'])) ?  trim(addslashes($_REQUEST['search_order_num'])) : ''; 

if(isset($_POST['date_from'])){
	$date_from = strpos($_REQUEST['date_from'], '/') ? strtotime(trim($_REQUEST['date_from'])) : '';
}else{
	$date_from = ''; 
}
if(isset($_POST['date_to'])){
	$date_to = strpos($_REQUEST['date_to'], '/') ? strtotime(trim($_REQUEST['date_to'])) : '';
}else{
	$date_to = ''; 
}
					
$sort =  (isset($_REQUEST['sort'])) ? addslashes($_REQUEST['sort']) : 'date_asc';
$page_rows =  (isset($_REQUEST['pageRows'])) ? addslashes($_REQUEST['pageRows']) : 6;
$pagenum = (isset($_REQUEST['pagenum'])) ? addslashes($_REQUEST['pagenum']) : 1;
$orders_block = '';


// temp
$search_order_num = '';
$date_from = '';
$date_to = '';
							
$order_array = $order->getOrderArray($customer_id, 0, $search_order_num,  $date_from, $date_to);	
							
if(count($order_array) > 0){ 	
							
	foreach($order_array as $v) {
							
		$status_text = '';
		$status_text = $v['order_state_name'];
		if($v['when_complete'] > 0){
			$status_text .= '   '.date('m/d/Y',$v['when_complete']);
		}
		$orders_block .= "Order: <strong>".$v['order_id']."</strong>";
		$orders_block .= "<br />";
		$orders_block .= $status_text;
		$orders_block .= "<br />";							
		$orders_block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/order-receipt.html?orderId=".$v['order_id']."'>View Order Receipt</a>";
		$orders_block .= "<br />";
								
	}
							
}else{
	$orders_block = "No Orders Yet.";	
}

							
?>							
