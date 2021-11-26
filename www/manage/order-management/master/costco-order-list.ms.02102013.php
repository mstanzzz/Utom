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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Costco Order List";
$page_group = "order";


$num_new_orders = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

// test
//dec_451312641.neworders.gpg
//dec_451317583.neworders.gpg
//451499001
//451499002
//$dec_filename = $_SERVER['DOCUMENT_ROOT']."/costco/decrypted/dec_451499001.neworders.gpg";
//echo $dec_filename;
//$dec_file_contents = "dec_file_contents";
//$en_file_contents = "en_file_contents";
//processXml($dec_filename, $dec_file_contents, $en_file_contents);

/************  Parse the XML and ************/
function processXml($dec_filename, $dec_file_contents, $en_file_contents){
	
	if (file_exists($dec_filename)) {
		$xml = simplexml_load_file($dec_filename);
		//print_r($xml);
		
		foreach($xml as $val){
		
			$transactionID = trim($val["transactionID"]);
			$sendersIdForReceiver = trim($val->sendersIdForReceiver);
			$orderId = trim($val->orderId);
			$lineCount = trim($val->lineCount);
			$poNumber = trim($val->poNumber);
			$orderDate = trim($val->orderDate);
			$shippingCode = trim($val->shippingCode);
			$shipTo_personPlaceID = $val->shipTo["personPlaceID"];
			$billTo_personPlaceID = $val->billTo["personPlaceID"];
			$shipTo_name1 = '';
			$shipTo_address1 = '';
			$shipTo_city = '';
			$shipTo_state = '';
			$shipTo_country = '';
			$shipTo_postalCode = '';
			$shipTo_email = '';
			$shipTo_dayPhone = '';
			$billTo_name1 = '';
			$billTo_address1 = '';
			$billTo_city = '';
			$billTo_state = '';
			$billTo_country = '';
			$billTo_postalCode = '';
			$billTo_email = '';
			$billTo_dayPhone = '';	
			foreach($val->personPlace as $personPlaceVal){
				if(strcmp($personPlaceVal["personPlaceID"],$shipTo_personPlaceID) == 0){
					$shipTo_name1 = trim(addslashes($personPlaceVal->name1));
					$shipTo_address1 = trim(addslashes($personPlaceVal->address1));
					$shipTo_city = trim(addslashes($personPlaceVal->city));
					$shipTo_state = trim(addslashes($personPlaceVal->state));
					$shipTo_country = trim(addslashes($personPlaceVal->country));
					$shipTo_postalCode = trim(addslashes($personPlaceVal->postalCode));
					$shipTo_email = trim(addslashes($personPlaceVal->email));
					$shipTo_dayPhone = trim(addslashes($personPlaceVal->dayPhone));
				}else{				
					$billTo_name1 = trim(addslashes($personPlaceVal->name1));
					$billTo_address1 = trim(addslashes($personPlaceVal->address1));
					$billTo_city = trim(addslashes($personPlaceVal->city));
					$billTo_state = trim(addslashes($personPlaceVal->state));
					$billTo_country = trim(addslashes($personPlaceVal->country));
					$billTo_postalCode = trim(addslashes($personPlaceVal->postalCode));
					$billTo_email = trim(addslashes($personPlaceVal->email));
					$billTo_dayPhone = trim(addslashes($personPlaceVal->dayPhone));	
				}
			}
	
	
			if($transactionID != ''){
	
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT costco_save_data_id
						FROM costco_save_data
						WHERE transactionID = '".$transactionID."'"; 
				$result = $dbCustom->getResult($db,$sql);
				
				if($result->num_rows < 1){					
				
					$sql = "INSERT INTO costco_save_data
						(
						filename
						,transactionID
						,sendersIdForReceiver
						,orderId
						,lineCount
						,poNumber
						,orderDate
						,shipTo_name1
						,shipTo_address1
						,shipTo_city
						,shipTo_state
						,shipTo_country
						,shipTo_postalCode
						,shipTo_email
						,shipTo_dayPhone
						,billTo_name1
						,billTo_address1
						,billTo_city
						,billTo_state
						,billTo_country
						,billTo_postalCode
						,billTo_email
						,billTo_dayPhone	
						,shippingCode
						,decrypted_xml
						,encrypted_xml
						)VALUES(
						'".$dec_filename."'
						,'".$transactionID."'
						,'".$sendersIdForReceiver."'					
						,'".$orderId."'
						,'".$lineCount."'
						,'".$poNumber."'						
						,'".$orderDate."'
						,'".$shipTo_name1."'
						,'".$shipTo_address1."'
						,'".$shipTo_city."'
						,'".$shipTo_state."'
						,'".$shipTo_country."'
						,'".$shipTo_postalCode."'
						,'".$shipTo_email."'
						,'".$shipTo_dayPhone."'
						,'".$billTo_name1."'
						,'".$billTo_address1."'
						,'".$billTo_city."'
						,'".$billTo_state."'
						,'".$billTo_country."'
						,'".$billTo_postalCode."'
						,'".$billTo_email."'
						,'".$billTo_dayPhone."'
						,'".$shippingCode."'
						,'".$dec_file_contents."'
						,'".$en_file_contents."'
						)					
						";
					$result = $dbCustom->getResult($db,$sql);
					
					
					$costco_save_data_id = $db->insert_id;

					$total_cost = 0;

					foreach($val->lineItem as $lineItemVal){
						$lineItemId = trim($lineItemVal->lineItemId);
						$orderLineNumber = trim($lineItemVal->orderLineNumber);
						$orderLineNumber = (is_numeric($orderLineNumber))? $orderLineNumber : 0;
						$merchantLineNumber = trim($lineItemVal->merchantLineNumber);
						$merchantLineNumber = (is_numeric($merchantLineNumber))? $merchantLineNumber : 0;
						$qtyOrdered = trim($lineItemVal->qtyOrdered);
						$qtyOrdered = (is_numeric($qtyOrdered))? $qtyOrdered : 0;
						$unitCost = trim($lineItemVal->unitCost);
						$unitCost = (is_numeric($unitCost))? $unitCost : 0;
						$unitOfMeasure = trim($lineItemVal->unitOfMeasure);
						$description = trim(addslashes($lineItemVal->description));
						$merchantSKU = trim($lineItemVal->merchantSKU);
						$vendorSKU = trim($lineItemVal->vendorSKU);
						$shippingCode = trim($lineItemVal->shippingCode);
						$total_cost += $qtyOrdered * $unitCost; 
	
						$sql = "INSERT INTO costco_line_item
							(lineItemId
							,orderLineNumber
							,merchantLineNumber
							,qtyOrdered
							,unitCost
							,unitOfMeasure
							,description
							,merchantSKU
							,vendorSKU
							,shippingCode
							,costco_save_data_id
							)VALUES(
							'".$lineItemId."'
							,'".$orderLineNumber."'
							,'".$merchantLineNumber."'
							,'".$qtyOrdered."'
							,'".$unitCost."'
							,'".$unitOfMeasure."'
							,'".$description."'
							,'".$merchantSKU."'
							,'".$vendorSKU."'
							,'".$shippingCode."'
							,'".$costco_save_data_id."'
							)					
							";
						$result = $dbCustom->getResult($db,$sql);
						
					}

					$sql = "UPDATE costco_save_data 
							SET total_cost = '".$total_cost."'
							WHERE costco_save_data_id = '".$costco_save_data_id."'";
						
					$result = $dbCustom->getResult($db,$sql);
					
						
				
					$success = 1;
					
				}
			}
		}	
	}
}




if(isset($_POST["show_paid"])){
	
	$costco_save_data_id = $_POST["costco_save_data_id"];
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "UPDATE costco_save_data
			SET paid_date = '".time()."' 
			WHERE costco_save_data_id = '".$costco_save_data_id."'";
$result = $dbCustom->getResult($db,$sql);	
	
}

if(isset($_POST["trackingNumber"])){
	
	//$shipping_method = trim(addslashes($_POST["shipping_method"])); 
	$shipDate = trim(addslashes($_POST["shipDate"]));
	$trackingNumber = trim(addslashes($_POST["trackingNumber"]));
	if($trackingNumber == '') $trackingNumber = "1Z9999999999999999";
	
	$shippingCode = $_POST["shippingCode"];
	
	//$ship_code = "YFSY";
	 
	$costco_save_data_id = $_POST["costco_save_data_id"];
	
	//echo  $costco_save_data_id;
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT * 
			FROM costco_save_data
			WHERE costco_save_data_id = '".$costco_save_data_id."'";
$result = $dbCustom->getResult($db,$sql);	
	
	if($result->num_rows > 0){
		 
		$object = $result->fetch_object();	

		$today = date("Ymd",time());
		// create hubAction per line item

		$sql = "SELECT * 
				FROM costco_line_item
				WHERE costco_save_data_id = '".$costco_save_data_id."'";
		$li_res = mysql_query ($sql);
		if(!$li_res)die(mysql_error($li_res));
		$hubAction = '';
		while($row = mysql_fetch_object($li_res)){
			
			$hubAction .= "<hubAction>";			
			$hubAction .= "<action>v_ship</action>";
			$hubAction .= "<merchantLineNumber>".$row->merchantLineNumber."</merchantLineNumber>";
			$hubAction .= "<trxVendorSKU>".$row->vendorSKU."</trxVendorSKU>";
			$hubAction .= "<trxMerchantSKU>".$row->merchantSKU."</trxMerchantSKU>";
			$hubAction .= "<trxQty>".$row->qtyOrdered."</trxQty>";
			$hubAction .= "<packageDetailLink packageDetailID='A_000021A' />";
			$hubAction .= "</hubAction>";
		}

/*
		<hubAction>
			<action>v_ship</action>
			<merchantLineNumber>1</merchantLineNumber>
			<trxVendorSKU>$object->vendorSKU</trxVendorSKU>
			<trxMerchantSKU>$object->merchantSKU</trxMerchantSKU>
			<trxQty>1</trxQty>
			<packageDetailLink packageDetailID="A_000021A" />
		</hubAction>
*/
		


$msg = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<ConfirmMessageBatch xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="S:\VENDOR~1\XSD's\Costco\Costco_confirm.xsd">
	<partnerID roleType="vendor">merchant</partnerID>
	<hubConfirm>
		<participatingParty roleType="merchant" participationCode="To:">costco</participatingParty>
		<partnerTrxID>0</partnerTrxID>
		<partnerTrxDate>$today</partnerTrxDate>
		<poNumber>$object->poNumber</poNumber>
		<trxData>
			<vendorsInvoiceNumber>0</vendorsInvoiceNumber>
		</trxData>
        $hubAction
		<packageDetail packageDetailID="A_000021A">
			<shipDate>$shipDate</shipDate>
			<serviceLevel1>$shippingCode</serviceLevel1>
			<trackingNumber>$trackingNumber</trackingNumber>
			<shippingWeight weightUnit="LB">1.0</shippingWeight>
		</packageDetail>
	</hubConfirm>
<messageCount>1</messageCount>
</ConfirmMessageBatch>
EOD;
							
							
							
	?>
	
	<?php



//echo $msg;
//exit;				
	
		$gpgkeydir = "/home/organize/.gnupg"; 
		$gpg = '/usr/bin/gpg'; 
		//$uid = "mike@closetstogo.com";
		$uid = "customersupport@commercehub.com";	 
		//$passphrase = "Ctg18765Ghblk8%gh"; 
		putenv("GNUPGHOME=$gpg"); 
	
		$upload_file_name = "encrypted_confirm_".$costco_save_data_id.".gpg";
		$file = "/home/organize/public_html/costco/".$upload_file_name; 
		$file2 = "/home/organize/public_html/costco/confirms/".$costco_save_data_id."enc_this.txt"; 

		
		if(file_exists ($file2)){
			unlink($file2);
		}
		
		$df = fopen($file2, "w") or die ("Couldn't open $file");
		fwrite($df,$msg); 
		fclose($df); 
		
	
		//--recipient 70BD27AF
		//C:\gnupg\gpg –-encrypt –-armor --recipient 70BD27AF --output encryptedfilename unencryptedfilename
		
	
		
		$encrypted = shell_exec("$gpg --batch --no-secmem-warning --no-tty --yes -ea --always-trust --homedir $gpgkeydir -r $uid -o - $file2"); 
	
		$df = fopen($file, "w") or die ("Couldn't open $file");
		fwrite($df,$encrypted); 
		fclose($df); 
	
		
		// test
		//$ftp_server = "ihub1.commercehub.com";
		
		//LIVE
		$ftp_server = "ftp1.commercehub.com";
	
		
		$ftp_user_name = "closetstogo";
		$ftp_user_pass = "DxW1246mn";
		$remote_path = "/costco/incoming/confirms/";
		
		//LIVE ftp1.commercehub.com 
		
		
		//$ftp_server = "02f8e35.netsolhost.com";
		//$ftp_user_name = "bertwaxman1a";
		//$ftp_user_pass = "gyxQozg1tf";
		//$remote_path = "/htdocs/";
							
							
		$conn_id = ftp_connect($ftp_server); 
		$login_result = ftp_login($dbCustom,$conn_id, $ftp_user_name, $ftp_user_pass); 
		
		ftp_pasv($conn_id, true);
		
		// check connection
		if ((!$conn_id) || (!$login_result)) { 
			//echo "FTP connection has failed!";
			//echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
			
			$msg = "Connection Error";
			
			exit; 
		} else {
			
			$success = 0;


			
			if (ftp_put($conn_id, $remote_path.$upload_file_name, $file, FTP_BINARY)) {
				$success = 1;
				$msg = "The confirm file was successfully uploaded";
						
				$sql = "UPDATE costco_save_data 
						SET is_shipped = '1' 
							,shipDate = '".$shipDate."'
							,trackingNumber = '".$trackingNumber."'
							,final_ship_code = '".$shippingCode."'
						WHERE costco_save_data_id = '".$costco_save_data_id."'";
		$result = $dbCustom->getResult($db,$sql);				
								
				if(file_exists($file)){
					unlink($file);
				}
				
			}else{
				$msg = "There was a problem while uploading ";
			}
			
			
		}
						
	
	}else{
		$msg = "This order was either already shipped or not found in the database";	
	}







}else{

	
	
	
	
	//************ decription vars **************/
	$gpgkeydir = "/home/organize/.gnupg"; 
	$uid = "mike@closetstogo.com"; 
	$passphrase = "Ctg18765Ghblk8%gh"; 
	$gpg = '/usr/bin/gpg'; 
	putenv("GNUPGHOME=$gpg"); 
	global $gnupghome; 
	global $path_to_gpg; 
	
	/************  ftp get the files ************/
	
	// test
	//$ftp_server = "ihub1.commercehub.com";
	
	//LIVE
	$ftp_server = "ftp1.commercehub.com";	
	$ftp_user_name = "closetstogo";
	$ftp_user_pass = "DxW1246mn";
	
	//$ftp_server = "ftp.organizetogo.com";
	//$ftp_user_name = "organize@organizetogo.com";
	//$ftp_user_pass = "Org876G54$5t@";
	
	//$ftp_server = "02f8e35.netsolhost.com";
	//$ftp_user_name = "bertwaxman1a";
	//$ftp_user_pass = "gyxQozg1tf";
	
	
	//$remote_path = "/htdocs/images/turkey/";
	//$remote_path = "/public_html/";
	
	// this is where we put files back
	//$remote_path = "/costco/incoming/confirms/";
	
	//$remote_path = "closetstogo\costco\outgoing\orders";
	$remote_path = "/costco/outgoing/orders/";
	
	// this is the encrypted files we download. Once they are downloaded, they are removed.
	//$remote_path = "/closetstogo/costco/outgoing/orders";
	
	$local_path = "<?php echo SITEROOT; ?>/../costco/encrypted/";
	//$local_path = "<?php echo SITEROOT; ?>/../test/";
	
	// set up basic connection
	$conn_id = ftp_connect($ftp_server); 
	// login with username and password
	$login_result = ftp_login($dbCustom,$conn_id, $ftp_user_name, $ftp_user_pass); 
	
	//ftp_pasv($conn_id, true);
	
	// check connection
	
	$success = 0;
	
	if ((!$conn_id) || (!$login_result)) { 
		
		$msg.= "Connection Error";
	} else {
	
		$msg.= "Connected";
	
		//echo "<br />".$remote_path;
		$contents = ftp_nlist($conn_id, $remote_path);
		//print_r($contents);
		foreach($contents as $val){
			//if(substr($val, strlen($val)-3) == "?????????"){
				//create the local file
				
				//echo $local_path.$val;
				//echo $local_path;
				//echo $val;
				
				$rp_array = explode("/",$val);
				
				$indx = count($rp_array)-1;
				$fn = $rp_array[$indx];
				
				
				//echo $remote_path.$fn;
				//echo "<br />";
				//echo $val;
				//echo "<br />";
				//echo "<br />";		
				//echo "<br />";
				
					//$msg.= $remote_path.$fn."<br />";
	
/**************  toggle down load on/off *********************/
				//if(0){
				if(ftp_get($conn_id, $local_path.$fn, $remote_path.$fn, FTP_BINARY)){					


					//echo $fn;
					//echo "<br />";	
					
					$msg.= $fn."<br />";
					
					
					$enc_filename = $local_path.$fn;
					
					$dec_filename = "/home/organize/public_html/costco/decrypted/dec_".$fn;
					
					$decrypted = shell_exec("echo $passphrase| $gpg --passphrase-fd 0 --batch --no-secmem-warning --no-tty --yes --homedir $gpgkeydir -d $enc_filename");
		
					$fh = fopen($dec_filename, 'w') or die("can't open file");
					fwrite($fh, $decrypted);
					fclose($fh);
					
					$fh = fopen($dec_filename, 'r') or die("can't open file");
					$dec_file_contents = fread($fh, filesize($dec_filename));
					fclose($fh);
					
					$fh = fopen($enc_filename, 'r') or die("can't open file");
					$en_file_contents = fread($fh, filesize($enc_filename));
					fclose($fh);				
					
					$dec_file_contents = addslashes($dec_file_contents);

					$en_file_contents = addslashes($en_file_contents);

					processXml($dec_filename, $dec_file_contents, $en_file_contents);
					
					$num_new_orders++;
	
				}
			//}
		}
	
	
	
	
	
	}
	
	ftp_close($conn_id); 
	
	$msg .= " - $num_new_orders orders added";
	
	


}








require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>


<script>
$(document).ready(function() {




	$('.fancybox').fancybox({
		autoSize : false,
		height : 400	
	});

	//$.fancybox.close;



});


</script>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        

		?>
		
		<div class="page_actions">
	    	<a class="btn btn-large btn-primary" target="_blank" href='https://dsm.commercehub.com/dsm/gotoLogin.do'>Commerce Hub Login</a>
		</div>
		<h3>Unshipped Orders</h3>
		<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Billing Name</th>
							<th>Order Date</th>
							<th># Line Items</th>
							<th>Total</th>
							<th>Mark as Shipped</th>
							<th>View Order</th>
							<th>View XML</th>
						</tr>
					</thead>
		
	<?php 

	$sql = "SELECT * 
			FROM  costco_save_data
			WHERE is_shipped = '0'
			ORDER BY orderDate ASC";
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$result = $dbCustom->getResult($db,$sql);	
	
	$num_orders_unshipped = $result->num_rows;
	$total_amount_unshipped = 0;

	$block = '';
    while($row = $result->fetch_object()) {
		
		$total_amount_unshipped += $row->total_cost;
		
		$block .= "<tr><td>";
		$block .= $row->billTo_name1; 
		$block .= "&nbsp;</td>";

		
		$year = substr($row->orderDate, 0 , 4);
		$month = substr($row->orderDate, 4 , 2);
		$day = substr($row->orderDate, 6 , 2);

		$block .= "<td>";
		$block .= 	$month."/".$day."/".$year;
		$block .= "&nbsp;</td>";

		$block .= "<td>";
		$block .= $row->lineCount;
		$block .= "&nbsp;</td>";

		$block .= "<td>";
		$block .= "$".number_format($row->total_cost,2);
		$block .= "&nbsp;</td>";
		$block .= "<td>";
		$block .= "<a class='fancybox fancybox.iframe btn btn-small' href='costco-upload-shipped.php?costco_save_data_id=".$row->costco_save_data_id."'>
		<i class='icon-arrow-up'></i> Order Shipped</a>"; 
		$block .= "</td>";
	
		$block .= "<td>";
		$block .= "<a href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' class='btn btn-primary'>
		<i class='icon-eye-open icon-white'></i> View </a>"; 
		$block .= "</td>";

		$dec_fn_array = explode("/",$row->filename);
		$dec_fn = $dec_fn_array[sizeof($dec_fn_array)-1];

		$block .= "<td>";
		//$block .= "<a href='costco-view-xml.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view XML</a>"; 
		
		$block .= "<a target='_blank' href='".SITEROOT."\/costco/decrypted/".$dec_fn."' class='btn btn-small btn-primary'>
		<i class='icon-eye-open icon-white'></i> View XML</a>";
		
		$block .= "</td>";
	}

	$block .= "<tr><td colspan='3'>";
	$block .= "<div style='float:left;'>Num Orders:  ".$num_orders_unshipped."</div>";
	$block .= "<div style='float:right; padding-left:205px;'>Total:</div>";
	$block .= "<div class='clear'></div>";
	$block .= "<td colspan='4'><b>$".number_format($total_amount_unshipped, 2)."</b></td>";
	
	$block .= "</tr>";
	echo $block;

	?>
		</table>

				<br />
				<hr />
				<h3>Shipped Orders</h3>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Billing Name</th>
							<th>Order Date</th>
							<th>Ship Date</th>
                            <th># Line Items</th>
							<th>Total</th>
                            
							<!--<th>Mark as Shipped</th>-->
                            <th>Mark as Paid</th>
							<th>View Order</th>
							<th>View XML</th>
						</tr>
					</thead>

<?php

	$sql = "SELECT * 
			FROM  costco_save_data
			WHERE is_shipped = '1'
			AND paid_date = '0'
			ORDER BY orderDate ASC";
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$result = $dbCustom->getResult($db,$sql);	
	$num_orders_shipped = $result->num_rows;
	$total_amount_shipped = 0;

	$block = '';
    while($row = $result->fetch_object()) {
		
		$total_amount_shipped += $row->total_cost;
		 
		$block .= "<tr>";
		$block .= "<td>";
		$block .= $row->billTo_name1; 
		$block .= "&nbsp;</td>";

		
		$year = substr($row->orderDate, 0 , 4);
		$month = substr($row->orderDate, 4 , 2);
		$day = substr($row->orderDate, 6 , 2);


		$block .= "<td>";
		$block .= 	$month."/".$day."/".$year;
		$block .= "&nbsp;</td>";


		$year = substr($row->shipDate, 0 , 4);
		$month = substr($row->shipDate, 4 , 2);
		$day = substr($row->shipDate, 6 , 2);


		$block .= "<td>";
		$block .= 	$month."/".$day."/".$year;
		$block .= "&nbsp;</td>";

		$block .= "<td>";
		$block .= $row->lineCount;
		$block .= "&nbsp;</td>";

		

		$block .= "<td>";
		$block .= "$".number_format($row->total_cost,2);
		$block .= "&nbsp;</td>";

		//$block .= "<td><a class='fancybox fancybox.iframe btn btn-small' href='costco-upload-shipped.php?costco_save_data_id=".$row->costco_save_data_id."'>Re-upload Shipped</a></td>"; 

		$block .= "<td>";
		$block .= "<form action='costco-order-list.php' method='post' enctype='multipart/form-data'>";
		$block .= "<input type='hidden' name='costco_save_data_id' value='".$row->costco_save_data_id."'>";
		$block .= "<input class='btn btn-small btn-primary' type='submit' name='show_paid' value='Order Paid'>";
		$block .= "</form>";
		$block .= "</td>"; 


		$block .= "<td>";
		$block .= "<a class='btn btn-small btn-primary' href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list'>
		<i class='icon-eye-open icon-white'></i> View</a>"; 
		$block .= "</td>";

		$dec_fn_array = explode("/",$row->filename);
		$dec_fn = $dec_fn_array[sizeof($dec_fn_array)-1];
		

		$block .= "<td>";
		//$block .= "<a href='costco-view-xml.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view XML</a>"; 
		
		$block .= "<a target='_blank' href='".SITEROOT."\/costco/decrypted/".$dec_fn."' class='btn btn-small btn-primary'>
		<i class='icon-eye-open icon-white'></i> View XML</a>";
		
		$block .= "</td></tr>";
	}
	$block .= "<tr><td colspan='4'>";
	$block .= "<div style='float:left;'>Num Orders:  ".$num_orders_shipped."</div>";
	$block .= "<div style='float:right; padding-left:205px;'>Total:</div>";
	$block .= "<div class='clear'></div>";
	$block .= "<td colspan='4'><b>$".number_format($total_amount_shipped, 2)."</b></td>";
		
	echo $block;
    ?>
    
	</table>


				<br />
				<hr />
				<h3>Paid Orders</h3>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>Billing Name</th>
							<th>Order Date</th>
							<th>Ship Date</th>
                            <th>Paid Date</th>
                            <th># Line Items</th>
							<th>Total</th>                            
							<th>View Order</th>
							<th>View XML</th>
						</tr>
					</thead>

<?php

	$sql = "SELECT * 
			FROM  costco_save_data
			WHERE paid_date > '0'
			ORDER BY paid_date ASC";
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$result = $dbCustom->getResult($db,$sql);	
	$num_orders_paid = $result->num_rows;
	$total_amount_paid = 0;

	$block = '';
    while($row = $result->fetch_object()) {
		
		$total_amount_paid += $row->total_cost;
		 
		$block .= "<tr>";
		$block .= "<td>";
		$block .= $row->billTo_name1; 
		$block .= "&nbsp;</td>";

		
		$year = substr($row->orderDate, 0 , 4);
		$month = substr($row->orderDate, 4 , 2);
		$day = substr($row->orderDate, 6 , 2);


		$block .= "<td>";
		$block .= 	$month."/".$day."/".$year;
		$block .= "&nbsp;</td>";


		$year = substr($row->shipDate, 0 , 4);
		$month = substr($row->shipDate, 4 , 2);
		$day = substr($row->shipDate, 6 , 2);


		$block .= "<td>";
		$block .= 	$month."/".$day."/".$year;
		$block .= "&nbsp;</td>";


		$block .= "<td>";
		$block .= 	date('m/d/Y', $row->paid_date);
		$block .= "&nbsp;</td>";




		$block .= "<td>";
		$block .= $row->lineCount;
		$block .= "&nbsp;</td>";

		

		$block .= "<td>";
		$block .= "$".number_format($row->total_cost,2);
		$block .= "&nbsp;</td>";

		$block .= "<td>";
		$block .= "<a class='btn btn-small btn-primary' href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list'>
		<i class='icon-eye-open icon-white'></i> View</a>"; 
		$block .= "</td>";

		$dec_fn_array = explode("/",$row->filename);
		$dec_fn = $dec_fn_array[sizeof($dec_fn_array)-1];
		

		$block .= "<td>";
		//$block .= "<a href='costco-view-xml.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view XML</a>"; 
		
		$block .= "<a target='_blank' href='".SITEROOT."\/costco/decrypted/".$dec_fn."' class='btn btn-small btn-primary'>
		<i class='icon-eye-open icon-white'></i> View XML</a>";
		
		$block .= "</td></tr>";
	}
		$block .= "<tr><td colspan='5'>";
		$block .= "<div style='float:left;'>Num Orders:  ".$num_orders_paid."</div>";
		$block .= "<div style='float:right; padding-left:205px;'>Total:</div>";
		$block .= "<div class='clear'></div>";
		$block .= "<td colspan='4'><b>$".number_format($total_amount_paid, 2)."</b></td>";
		
		echo $block;
    ?>
    
	</table>




	</div>
	</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>    
    
</div>


</body>
</html>



