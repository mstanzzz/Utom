<?php

/*
DO THIS
--------------------------------------
Generate document by template
User signs document
document is auto approoved and stored
---------------------------------------


API Applications
Test App
Basic Authorization Token
NDI5N2UzNGZiN2Q4MDAzMmUzMzA2YjBiYjI3MDM2OTQ6OTRhMjg4YjUyNDU0NWI4OWViOWRmZGM1N2M5MWZiMWQ=
ctg_signnow
Basic Authorization Token
ZDZhZTI5Y2I5M2Q4ODhmNzI1ZWIyY2NmNjY0MzcyYzI6Y2U1ZDcxMmM2Y2YwN2NlMTdhYjgwZjNkMGY3OGU0N2I=


curl -X POST 'https://api-eval.signnow.com/document/86fd359df51d430a98899e6176835ed22dcc7468/invite' \
-H 'Authorization: Bearer {{bearer_token}}' \
-H 'Content-Type: application/json' \
-H 'Accept: application/json' \
-d '
{
  "document_id": "86fd359df51d430a98899e6176835ed22dcc7468",
  "subject": "mark@nazardesigns.com Needs Your Signature",
  "message": "mark@nazardesigns.com invited you to sign \"Request one signature\"",
  "from": "mark@nazardesigns.com",
  "to": [
    {
      "email": "mark@nazardesigns.com",
      "role_id": "beef2194d4c74268846b490903057f0deafef9aa",
      "role": "Signer 1",
      "order": "1"
    }
  ]
}'
*/


$postRequest = array(
    'firstFieldData' => 'foo',
    'secondFieldData' => 'bar'
);

$cURLConnection = curl_init('http://hostname.tld/api');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

// $apiResponse - available data from the API request
$jsonArrayResponse - json_decode($apiResponse);

$ch = curl_init();
$postRequest = array(
    'firstFieldData' => 'foo',
    'secondFieldData' => 'bar'
);

$url_str = 
$cURLConnection = curl_init("https://api-eval.signnow.com/document/86fd359df51d430a98899e6176835ed22dcc7468/invite");
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);

echo $apiResponse;

curl_close($cURLConnection);

// $apiResponse - available data from the API request
//$jsonArrayResponse - json_decode($apiResponse); set url
//curl_setopt($ch, CURLOPT_URL, "https://api-eval.signnow.com/document/86fd359df51d430a98899e6176835ed22dcc7468/invite");
//return the transfer as a string
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string
//$output = curl_exec($ch);
// close curl resource to free up system resources
//curl_close($ch);  
//echo $output;

/*
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

require_once($real_root.'/includes/config.php');
require_once($real_root.'/manage/admin-includes/manage-includes.php');
*/

//echo phpinfo();

/*
$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'your_merchant_id',
    'publicKey' => 'your_public_key',
    'privateKey' => 'your_private_key'
]);
*/

// pass $clientToken to your front-end
/*
$clientToken = $gateway->clientToken()->generate([
    "customerId" => $aCustomerId
]);
*/

?>

<script>



</script>

<?

/*
function getCardType($card_num){
	if(preg_match("/^4[0-9]{12}(?:[0-9]{3})?$/", $card_num)) {
		$card_type = 'Visa';
	}elseif(preg_match("/^5[1-5][0-9]{14}$/", $card_num)){
		$card_type = 'MasterCard';
	}elseif(preg_match("/^3[47][0-9]{13}$/", $card_num)){	
		$card_type = 'American Express';
	}elseif(preg_match("/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/", $card_num)){	
		$card_type = "Diners Club";
	}elseif(preg_match("/^6(?:011|5[0-9]{2})[0-9]{12}$/", $card_num)){	
		$card_type = "Discover";
	}elseif(preg_match("/^(?:2131|1800|35\\d{3})\\d{11}$/", $card_num)){	
		$card_type = "JCB";
	}else{
		$card_type = "Not Detected";
	}
	return $card_type;
}
*/
//YYYY-MM-DD HH:MM:SS
/*
$db_now = date("Y-m-d h:i:s");
$ts = time();
$shipping_name_first = trim(addslashes($_POST['shipping_name_first']));
$shipping_name_last = trim(addslashes($_POST['shipping_name_last']));
$shipping_name = $shipping_name_first.' '.$shipping_name_last;
$shipping_name_company = '';  
$shipping_address_one = trim(addslashes($_POST['shipping_address_one']));  
$shipping_address_two = trim(addslashes($_POST['shipping_address_two']));   
$shipping_city = trim(addslashes($_POST['shipping_city']));  
$shipping_state = trim(addslashes($_POST['shipping_state']));  
$shipping_zip = trim(addslashes($_POST['shipping_zip']));  
$shipping_country = trim(addslashes($_POST['shipping_country']));  
$shipping_phone = trim(addslashes($_POST['shipping_phone']));
$shipping_email = trim($_POST['shipping_email']);
$billing_email = trim($_POST['billing_email']);    
$customer_id = $_POST['CUSTID'];
$billing_name_first = trim(addslashes($_POST['billing_name_first']));    
$billing_name_last = trim(addslashes($_POST['billing_name_last']));    
$billing_name = $billing_name_first.' '.$billing_name_last;
$billing_address_one = trim(addslashes($_POST['billing_address_one']));  
$billing_address_two = trim(addslashes($_POST['billing_address_two'])); 
$billing_city = trim(addslashes($_POST['billing_city']));  
$billing_state = trim(addslashes($_POST['billing_state']));  
$billing_zip = trim(addslashes($_POST['billing_zip']));  
$billing_country = trim(addslashes($_POST['billing_country']));  
$billing_phone = trim(addslashes($_POST['billing_phone']));   
$card_num = trim(addslashes($_POST["CARDNUM"]));
//$card_num = '4111111111111111';
$card_num = preg_replace( '/[^a-zA-Z0-9]+/', '', $card_num);
$start = strlen($card_num) - 4;
$cc_last_4 =  substr($card_num, $start, 4);
$cc_last_3 =  substr($cc_last_4, 1, 3);
$card_auth_code = trim($_POST['CVV2']);  
$card_type_id = 0;  
$card_exp_date = trim($_POST['EXPMONTH']).'/'.trim($_POST['EXPYEAR']);   
$tax_cost = 0; 
$sub_total = str_replace(',', '', $_POST['sub_total']);
$coupon_amount = str_replace(',', '', $_POST['coupon_amount']);
$total_discount = str_replace(',', '', $_POST['total_discount']);
$total = str_replace(',', '', $_POST['grand_total']);
$ship_method_id = 0; 	
$t_error = '';
$t_error_code = '';
$t_error_resp = '';
$t_error_msg = '';
$transaction_id = '';
$success = 0;
$order_id = 0;
$card_type = '';	
*/

/*
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT *
		FROM braintree_credentials
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);    
if($result->num_rows > 0){
	$c_obj = $result->fetch_object();
    $environment = $c_obj->environment;
	echo $environment;
	$merchant_id = $c_obj->merchant_id;
    $public_key = $c_obj->public_key;
    $private_key = $c_obj->private_key;
}else{
	$environment = '';
    $merchant_id = "jzy3nhzv2pvdvp78";
    $public_key = "fms727dhnfcnwyb7";
    $private_key = "wqrcz6qgz28kdqtx";
}
*/
	
/* LIVE */
/*
	Braintree_Configuration::environment($environment);
	Braintree_Configuration::merchantId($merchant_id);
	Braintree_Configuration::publicKey($public_key);
	Braintree_Configuration::privateKey($private_key);
*/

/* CTG sandbox 
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('jzy3nhzv2pvdvp78');
	Braintree_Configuration::publicKey('fms727dhnfcnwyb7');
	Braintree_Configuration::privateKey('wqrcz6qgz28kdqtx');
 */

	
	/*
	CTG production
	our user name is     closetstogo
	Password is   Ctg1234!
	$environment = 'production';
	$merchant_id = 'nzmzmz6w8b29qj58';
	$public_key = 'cctcb8cfzwwwtc6s';
	$private_key = '9dt6gtnjg8t3b99h';
	*/
	


?>
