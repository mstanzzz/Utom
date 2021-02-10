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

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Costco Order List Recycle";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	


$dec_filename = "/home/organize/public_html/costco/decrypted/dec_391756557.neworders.gpg";


$dec_file_contents = file_get_contents($dec_filename);

$en_file_contents = file_get_contents("/home/organize/public_html/costco/encrypted/391756557.neworders.gpg");

processXml($dec_filename, $dec_file_contents, $en_file_contents);


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
					$shipTo_name1 = trim($personPlaceVal->name1);
					$shipTo_address1 = trim($personPlaceVal->address1);
					$shipTo_city = trim($personPlaceVal->city);
					$shipTo_state = trim($personPlaceVal->state);
					$shipTo_country = trim($personPlaceVal->country);
					$shipTo_postalCode = trim($personPlaceVal->postalCode);
					$shipTo_email = trim($personPlaceVal->email);
					$shipTo_dayPhone = trim($personPlaceVal->dayPhone);
				}else{				
					$billTo_name1 = trim($personPlaceVal->name1);
					$billTo_address1 = trim($personPlaceVal->address1);
					$billTo_city = trim($personPlaceVal->city);
					$billTo_state = trim($personPlaceVal->state);
					$billTo_country = trim($personPlaceVal->country);
					$billTo_postalCode = trim($personPlaceVal->postalCode);
					$billTo_email = trim($personPlaceVal->email);
					$billTo_dayPhone = trim($personPlaceVal->dayPhone);	
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
						$description = trim($lineItemVal->description);
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
	

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>


  


<script>
$(document).ready(function() {


	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();

	
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("view_desc") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'view-item-description.php?item_id='+f_id,
			  success: function(data) {
				$('#view_desc').html(data);
				//alert('Load was performed.');
			  }
			});			
			
		}
		
	})
	
	$("a.inline").fancybox();
	
	$("#view_desc").click(function(){ $.fancybox.close;  })



});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});


</script>
</head>
	<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');


?>




<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    
    <div class="top_link">
	    <a href='costco-all-order-list.php'>Costco Order History</a>
    </div>

    <div class="manage_main">
	<?php 
	
	echo "<div class='manage_main_page_title'>".$page_title."</div>";
	$bc = $bread_crumb->output();
    echo $bc."<br />"; 


	$billing_name = (isset($_POST["billing_name"]))? $_POST["billing_name"] : '';
	$email = (isset($_POST["email"]))? $_POST["email"] : '';
	

	$sql = "SELECT * 
			FROM  costco_save_data
			WHERE is_shipped = '0'
			ORDER BY orderDate ASC";
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$result = $dbCustom->getResult($db,$sql);	
	
	

	$block = '';
	
	
	$block .= "<div class='manage_row_container' style='color:#5a7f8f;'>";

	$block .= "<div style='float:left; width:140px;'>&nbsp;";
	$block .= "</div>";

	$block .= "<div style='float:left; width:60px;'>&nbsp;";
	$block .= "</div>";



	$block .= "<div style='float:left; width:140px;'>&nbsp;";
	$block .= "Billing Name";
	$block .= "</div>";


	$block .= "<div style='float:left; width:100px;'>";
	$block .= "Order Date";
	$block .= "</div>";


	$block .= "<div style='float:right; width:100px;'>";
	$block .= "Total";
	$block .= "</div>";


	$block .= "<div class='clear'></div>";
	$block .= "</div>";
	echo $block;

    while($row = $result->fetch_object()) {
		 
		$block = '';
		$block .= "<div class='manage_row_container'>";

		$block .= "<div style='float:left; width:140px;' class='edit'>";
		$block .= "<a href='costco-upload-shipped.php?costco_save_data_id=".$row->costco_save_data_id."' style='text-decoration:none;'>upload shipped</a>"; 
		$block .= "</div>";
	
		$block .= "<div style='float:left; width:60px;' class='edit'>";
		$block .= "<a href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view</a>"; 
		$block .= "</div>";
		
		/* cust
		$cust_name = "None";
		$db = $dbCustom->getDbConnect(USER_DATABASE);		
				
		if($row->customer_id > 0){
			$sql = "SELECT name 
					FROM  user
					WHERE id = '".$row->customer_id."'";
			$n_res = mysql_query ($sql);
			if(!$n_res)die(mysql_error());
			if(mysql_num_rows($n_res)){
				$n_obj = mysql_fetch_object($n_res);
				$cust_name = $n_obj->name;
			}
		}
		*/
		
		
		$block .= "<div style='float:left; width:140px; padding-top:10px; padding-left:18px;'>";
		//$block .= $cust_name;
		$block .= $row->billTo_name1; 
		$block .= "&nbsp;</div>";


		$block .= "<div style='float:left; width:100px; padding-top:10px;'>";
		$block .= date("m/d/Y",$row->orderDate); 
		$block .= "&nbsp;</div>";
		

		$block .= "<div style='float:right; width:100px; padding-top:10px;'>";
		$block .= "$".number_format($row->total_cost,2);
		$block .= "&nbsp;</div>";


		$block .= "<div class='clear'></div>";
		$block .= "</div>";
		
		echo $block;



	}
    
    ?>
    
	</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>    
    
</div>


</body>
</html>



