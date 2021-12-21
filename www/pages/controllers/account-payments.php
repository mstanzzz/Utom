<?php
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.order.php');
$order = new Order;
$acc = new CustomerAccount;
$acc->setDbAccData($dbCustom,$customer_id);
$customer_id = $lgn->getCustId();	

if(!$lgn->isLogedIn()){
	require_once($_SERVER['DOCUMENT_ROOT']."/pages/resources/signin-form.php");
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT order_id, card_auth_code, card_exp
		FROM ctg_order";
$result = $dbCustom->getResult($db,$sql);
while($row = $result->fetch_object()){

	$sql = "UPDATE braintree_transaction
			SET card_auth_code = '".$row->card_auth_code."'
			,card_exp = '".$row->card_exp."' 
			WHERE order_id = '".$row->order_id."'";
	$res = $dbCustom->getResult($db,$sql);

}

$sql = "DELETE
		FROM braintree_transaction
		WHERE order_id = '0'";
//$result = $dbCustom->getResult($db,$sql);


$sql = "SELECT *
		FROM braintree_transaction";
$result = $dbCustom->getResult($db,$sql);
	
$i = 0;		
while($row = $result->fetch_object()){
	$transaction_array[$i]['order_id'] = $row->order_id;
	$transaction_array[$i]['customer_id'] = $row->customer_id;
	$transaction_array[$i]['amount'] = $row->amount;
	$transaction_array[$i]['trans_date'] = $row->trans_date;
	$transaction_array[$i]['first_name'] = $row->first_name;
	$transaction_array[$i]['last_name'] = $row->last_name;
	$transaction_array[$i]['card_type'] = $row->card_type;
	$transaction_array[$i]['cc_last_4'] = $row->cc_last_4;
	$transaction_array[$i]['card_auth_code'] = $row->card_auth_code;
	$transaction_array[$i]['card_exp'] = $row->card_exp;
	$transaction_array[$i]['is_success'] = $row->is_success;
	$i++;
}	
	
$transaction_block = '';

$transaction_block .= "<table border='1' cellpadding='10'>";
$transaction_block .= "<tr>";
$transaction_block .= "<td>order_id</td>";
$transaction_block .= "<td>customer_id</td>";
$transaction_block .= "<td>amount</td>";
$transaction_block .= "<td>trans_date</td>";
$transaction_block .= "<td>first_name</td>";
$transaction_block .= "<td>last_name</td>";
$transaction_block .= "<td>card_type</td>";
$transaction_block .= "<td>cc_last_4</td>";
$transaction_block .= "<td>card_auth_code</td>";
$transaction_block .= "<td>card_exp</td>";
$transaction_block .= "<td>is_success</td>";
$transaction_block .= "</tr>";

foreach($transaction_array as $val){
	$transaction_block .= "<tr>";
	$transaction_block .= "<td>".$val['order_id']."</td>";
	$transaction_block .= "<td>".$val['customer_id']."</td>";
	$transaction_block .= "<td>".$val['amount']."</td>";
	$transaction_block .= "<td>".date("Y-m-d h:i:sa", $val['trans_date'])."</td>";
	$transaction_block .= "<td>".$val['first_name']."</td>";
	$transaction_block .= "<td>".$val['last_name']."</td>";
	$transaction_block .= "<td>".$val['card_type']."</td>";
	$transaction_block .= "<td>".$val['cc_last_4']."</td>";
	$transaction_block .= "<td>".$val['card_auth_code']."</td>";
	$transaction_block .= "<td>".$val['card_exp']."</td>";
	$transaction_block .= "<td>".$val['is_success']."</td>";
	$transaction_block .= "</tr>";
	
}
$transaction_block .= "</table>";

*/

//echo $transaction_block;


//
//order_id
//customer_id
//amount
//trans_date
//first_name
//last_name
//card_type
//cc_last_4
//is_success


//ctg_order
//customer_id
//order_state_code
//card_auth_code
//card_type_id
//card_exp
//total
//order_date

?>