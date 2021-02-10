
<?php

if(isset($_POST['update_ship']) && isset($_POST['order_id'])){

	$order_id = $_POST['order_id'];
	
	$tracking_num = (isset($_POST['tracking_num'])) ? $_POST['tracking_num'] : '';
	
	$actual_ship_carrier = (isset($_POST['actual_ship_carrier'])) ? $_POST['actual_ship_carrier'] : '';

	$actual_ship_method = (isset($_POST['actual_ship_method'])) ? $_POST['actual_ship_method'] : '';

	$actual_ship_cost = (isset($_POST['actual_ship_cost'])) ? $_POST['actual_ship_cost'] : '';
	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
		
	$sql = "SELECT order_to_order_state_id
			FROM order_to_order_state
			WHERE order_state_id = '7'
			AND order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);				
	if($result->num_rows == 0){
	
		$sql = "INSERT INTO order_to_order_state
			(when_complete, order_state_id, order_id)
			VALUES
			('".time()."','7', '".$order_id."')"; 
		$res = $dbCustom->getResult($db,$sql);				
	
		
	}
	
	
	// update order
	$sql = "UPDATE ctg_order
			SET tracking_num = '".$tracking_num."'
				,actual_ship_carrier = '".$actual_ship_carrier."'
				,actual_ship_method = '".$actual_ship_method."'
				,actual_ship_cost = '".$actual_ship_cost."'
				,ship_date = '".time()."'
			WHERE order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);				


}



if(isset($_POST['send_ship_email']) && isset($_POST['order_id'])){
	
	$order_id = $_POST['order_id'];
	
	$tracking_num = (isset($_POST['tracking_num'])) ? $_POST['tracking_num'] : '';
	
	$actual_ship_carrier = (isset($_POST['actual_ship_carrier'])) ? $_POST['actual_ship_carrier'] : '';

	$actual_ship_method = (isset($_POST['actual_ship_method'])) ? $_POST['actual_ship_method'] : '';

	$actual_ship_cost = (isset($_POST['actual_ship_cost'])) ? $_POST['actual_ship_cost'] : '';
	
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	
	
	$sql = "SELECT order_to_order_state_id
			FROM order_to_order_state
			WHERE order_state_id = '7'
			AND order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);				
	if($result->num_rows == 0){
	
		$sql = "INSERT INTO order_to_order_state
			(when_complete, order_state_id, order_id)
			VALUES
			('".time()."','7', '".$order_id."')"; 
		$res = $dbCustom->getResult($db,$sql);				
	
		
	}
	
	
	// update order
	$sql = "UPDATE ctg_order
			SET tracking_num = '".$tracking_num."'
				,actual_ship_carrier = '".$actual_ship_carrier."'
				,actual_ship_method = '".$actual_ship_method."'
				,actual_ship_cost = '".$actual_ship_cost."'
				,ship_date = '".time()."'
			WHERE order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);				
	
	
	$sql = "SELECT 
				shipping_name
				,shipping_name_company  
				,shipping_address_one  
				,shipping_address_two  
				,shipping_city  
				,shipping_state  
				,shipping_zip  
				,shipping_country  
				,shipping_phone
				,shipping_email   
				,billing_name
				,billing_email  
				,billing_address_one  
				,billing_address_two  
				,billing_city  
				,billing_state  
				,billing_zip  
				,billing_country  
				,billing_phone
				,billing_email  
				,card_transaction_id  
				,card_auth_code  
				,card_type_id  
				,card_exp
				,shipping_id  
				,tax_cost 
				,shipping_cost
				,sub_total
				,discount_amount
				,total 
				,order_date
				,coupon_code
				,purchase_order_number
			FROM  ctg_order 
			WHERE order_id = '".$order_id."'";

    $result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows > 0){
	$object = $result->fetch_object();
	
	
	
	$sql = "SELECT cc_last_4
			FROM braintree_transaction
			WHERE order_id = '".$order_id."'";
    $result = $dbCustom->getResult($db,$sql);	
	$cc_last_3 = '';
	if($result->num_rows > 0){
		$obj = $result->fetch_object();
		if(strlen($obj->cc_last_4) > 3){
			$cc_last_3 =  substr($obj->cc_last_4, 1, 3);
		}
	}
			

	
	
			$sql = "SELECT 	
						design_id
						,item_id		  
						,name 
						,qty
						,price
						,sales_tax 
					FROM order_line_item 
					WHERE order_id = '".$order_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			//if(mysql_num_rows($li_res) > 0){
			
			$i = 0;
			$line_items_array = array();
			while($row = $res->fetch_object()){
				
				//echo "...........................................................".$row->design_id;
				
				
				$line_items_array[$i]["design_id"] = $row->design_id;
				$line_items_array[$i]["item_id"] = $row->item_id;
				$line_items_array[$i]['name'] = $row->name;
				$line_items_array[$i]["qty"] = $row->qty;
				$line_items_array[$i]["price"] = $row->price;
				$line_items_array[$i]["sales_tax"] = $row->sales_tax;
				$i++;
			}
			
	
	
	

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);






	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT *
			FROM contact_us
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);			
	if($result->num_rows){
		$company_obj = $result->fetch_object();	
		$company_phone = trim($company_obj->support_phone);
		$company_fax = trim($company_obj->support_fax);
		$support_times = trim($company_obj->support_hours);
		$support_email = trim($company_obj->support_email);
		$_url = trim($company_obj->_url);
	}else{
		$company_obj = '';	
		$company_phone = '';	
		$company_fax = '';	
		$support_times = '';	
		$support_email = '';	
		$_url = '';	
	}
	



	$sql = "SELECT *
			FROM company_info
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);			
	if($result->num_rows){
		$company_obj = $result->fetch_object();	
		$days = $company_obj->days;
		$hours = $company_obj->hours;
	}else{
		$days = '';
		$hours = '';
	}	
	
	
	
	
	//echo $object->total;
	

$receipt = "<div style=\"width: 600px; margin: 0 auto; background-color: #ffffff; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.4em; font-weight: lighter; font-weight: 200; color: #000000;\">";
	
$receipt .= "<div style=\"width: 200px; height: 100px; float: left;\"><img src=\"".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/logo/".get_logo()."\" alt=\"".$_SESSION['profile_company']."\"/></div>";
	$receipt .= "<br style=\"clear: left;\" /><h3>Your Order Has Been Shipped</h3>";
	
$receipt .= "<div style=\"width: 550px; padding-left: 25px; padding-right: 25px;\">
		<p>Dear ".$object->billing_name.",</p>";
		
		
$receipt .= "<div style=\"padding: 10px; background-color: #E4F6FD; border: 1px solid #D7F2FC; clear: left;\">
			<h5 style=\"text-align: center;\">Questions about your Order? Need to make a change?</h5>
			<table style=\"width: 500px; border: none;\" cellpadding=\"0\" cellspacing=\"0px\">
				<tr>
					<td><p><img src=\"".SITEROOT."/images/icons/phone.png\" alt=\"Phone:\" /> ".$company_phone."</p></td>
					<td><p>".$days."<br />
							".$hours."</p></td>
				</tr>
				<tr>
					<td><p><img src=\"".SITEROOT."/images/footer_email_icon.jpg\" alt=\"Email:\" /> ".$support_email."</p></td>
				</tr>
			</table>
		</div>";
		
$receipt .= "<div style=\"margin-top: 20px; clear: left;\">
			<table style=\"width: 550px; border: none;\" cellpadding=\"0\" cellspacing=\"10px\">
				<tr>
					<td width=\"120px\">Order Number:</td>
					<td><strong>".$order_id."</strong></td>
				</tr>
				<tr>
					<td>Order Date:</td>
					<td><strong>".date("m/d/Y h:i:s a",$object->order_date)."</strong></td>
				</tr>
				<tr>
					<td>Order Total:</td>
					<td><strong>$".number_format($object->total,2)."</strong></td>
				</tr>
			</table>
		</div>";
$receipt .= "<div style=\"margin-top: 20px; clear: left;\">
			<table style=\"width: 550px; border: none;\" cellpadding=\"10px\" cellspacing=\"0\">
				<tr>";
					
		$receipt .= "<td width=\"275px\" style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Shipping Method:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$actual_ship_carrier."   ".$actual_ship_method."</p>
					</td>";
	if($tracking_num != ''){			
		$receipt .= "<td width=\"275px\" style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Tracking Number:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$tracking_num."</p>
					</td>";
	}
	
	if($cc_last_3 != ''){
	
		$receipt .= "<td style=\"border-bottom: 1px solid #C0CDD7;\"><p>Payment Method:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">Credit Card: *************".$cc_last_3."</p>
					</td>
				</tr>";
	}
	
	$receipt .= "<tr>
					<td style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Shipping Address:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">";
						
						$receipt .= "<br />".$object->shipping_name;
						$receipt .= "<br />".$object->shipping_address_one; 
						if($object->shipping_address_two != ''){
							$receipt .= "<br />".$object->shipping_address_two;
						}
						$receipt .= "<br />".$object->shipping_city.", ".$object->shipping_state.", ".$object->shipping_zip." ".$object->shipping_country."</p>
					</td>
					<td style=\"border-bottom: 1px solid #C0CDD7;\"><p>Billing Address:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">";
						$receipt .= "<br />".$object->billing_name."<br />";
						$receipt .= "<br />".$object->billing_address_one."</br>";
						if($object->billing_address_two != ''){ 
							$receipt .= "<br />".$object->billing_address_two."</br>";
						}
						$receipt .= "<br />".$object->billing_city.", ".$object->billing_state.", ".$object->billing_zip." ".$object->billing_country."</p>
					</td>
				</tr>
				<tr>
					<td width=\"275px\" style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Shipping Phone:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$object->shipping_phone."</p>
					</td>
					<td style=\"border-bottom: 1px solid #C0CDD7;\"><p>Billing Phone:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$object->billing_phone."</p>
					</td>
				</tr>
				<tr>
					<td width=\"275px\" style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Shipping Email:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$object->shipping_email."</p>
					</td>
					<td style=\"border-bottom: 1px solid #C0CDD7;\">
						<p>Billing Email:</p>
						<p style=\"margin-left: 20px; font-weight: bold;\">".$object->billing_email."</p>

					</td>
				</tr>
			</table>
		</div>
		<div style=\"margin-top: 20px;\">
			<table style=\"width: 550px; border: none;\" cellpadding=\"8px\" cellspacing=\"0\">
				<thead style=\"background-color: #ECF4F7; border: 1px solid #C0CDD7\">
					<tr>
						<th colspan=\"2\" style=\"border-right: 1px solid #C0CDD7\">Item Details</th>
						<th style=\"text-align: right;border-right: 1px solid #C0CDD7\">Unit Price</th>
						<th style=\"border-right: 1px solid #C0CDD7\">QTY</th>
						<th style=\"text-align: right;\">Price</th>
					</tr>
				</thead>
				<tbody>";
				foreach($line_items_array as $val){	
					$ext = $val["price"] * $val["qty"];
					//$id = ($val["item_id"] > 0) ? $val["item_id"] : $val["design_id"];
					$type = ($val["item_id"] > 0) ? "Product" : "Custom Design";

					$image = ($type == "Product") ? SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".getItemPic($val['item_id']) : SITEROOT."/images/custom-item-in-cart.jpg";
					
					
					
					$receipt .= "
					<tr>
						<td style='border-bottom: 1px solid #C0CDD7;'><img src='".$image."' alt='".$val['name']."'/></td>
						<td style=\"border-bottom: 1px solid #C0CDD7;\">".$val['name']."</td>
						<td style=\"text-align: right;border-bottom: 1px solid #C0CDD7;\">".$val["price"]."</td>
						<td style=\"text-align: center;border-bottom: 1px solid #C0CDD7;\">".$val["qty"]."</td>
						<td style=\"text-align: right;border-bottom: 1px solid #C0CDD7;\">".$ext."</td>
					</tr>";
				}
	
				$receipt .="
					<tr>
						<td colspan=\"2\" style=\"text-align: left;border-top: 2px solid #C0CDD7;\">Discount:</td>
						<td colspan=\"3\" style=\"text-align: right;border-top: 2px solid #C0CDD7;\">($".number_format($object->discount_amount,2).")</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"text-align: left;\">Tax:</td>
						<td colspan=\"3\" style=\"text-align: right;\">0</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"text-align: left;\">Shipping:</td>
						<td colspan=\"3\" style=\"text-align: right;\">".$object->shipping_cost."</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"text-align: left;\"><strong>Total:</strong></td>
						<td colspan=\"3\" style=\"text-align: right;\"><strong>".$object->total."</strong></td>
					</tr>
					
				</tbody>
			</table>
		</div>
		
	</div>
</div>
</div>
</body>";


//echo $receipt;



//<p style=\"text-align: center;\"><a href=\"#\"><img src='' alt='facebook' /></a></p>

	
		// send email to customer
	
		$subject_c = "Order Shipped";		
		$headers = "From: services@closetstogo.com";
		$headers .= "\r\n";
		$headers .= "Content-type: text/html"; 
		$headers .= "\r\n";
		
		$to = $object->billing_email;
		
		//error_reporting(0);
		if(!mail($to, $subject_c, $receipt, $headers)){
			// Log
			/*
			$fh = fopen("ctglog.txt", "a");
			$stringData = "\n\rFailed Email\n\r";
			$stringData .= date('l jS \of F Y h:i:s A')."\n\r";
			$stringData .= $receipt;
			$stringData .= "\n\r-----------------------------\n\r\t\t"; 
			fwrite($fh, $stringData);
			fclose($fh);
			*/
		}
		
		
		if($object->shipping_email != $object->billing_email && $object->shipping_email != ''){
			$to = $object->shipping_email;
		
			if(!mail($to, $subject_c, $receipt, $headers)){
				// Log
				/*
				$fh = fopen("ctglog.txt", "a");
				$stringData = "\n\rFailed Email\n\r";
				$stringData .= date('l jS \of F Y h:i:s A')."\n\r";
				$stringData .= $receipt;
				$stringData .= "\n\r-----------------------------\n\r\t\t"; 
				fwrite($fh, $stringData);
				fclose($fh);
				*/
			}
		
		}

	
	}
}

?>