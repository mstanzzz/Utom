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


$page_title = "Costco Order";
$page_group = "order";


$num_new_orders = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

$costco_save_data_id = (isset($_REQUEST["costco_save_data_id"]))? $_REQUEST["costco_save_data_id"] : 0; 

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {
	
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

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

function show_msg(msg){
	alert(msg);
}

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
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
		$sql = "SELECT * 
				FROM costco_save_data
				WHERE costco_save_data_id = '".$costco_save_data_id."'";
		 $result = $dbCustom->getResult($db,$sql);		 
		 
		 if($result->num_rows > 0){
		 
			$object = $result->fetch_object();
			
			$block = "<table width='100%' cellspacing='0' cellpadding='5'>";
			$block .= "<tr>";
			$block .= "<td width='50%'><h2>Order ID: ".$object->orderId."</h2></td>";
			$block .= "<td width='50%'><h2>Order Date: ".$object->orderDate."</h2></td>";
			$block .= "</tr>";
			$block .= "<tr>";
			$block .= "<td width='50%'><strong>Transaction ID:</strong> ".$object->transactionID."</td>";
			$block .= "<td width='50%'><strong>Sender ID for Receiver:</strong> ".$object->sendersIdForReceiver."</td>";
			$block .= "</tr>";
			$block .= "<tr>";
			$block .= "<td width='50%'><strong>PO Number:</strong> ".$object->poNumber."</td>";
			$block .= "<td width='50%'><strong>Line Count:</strong> ".$object->lineCount."</td>";
			$block .= "</tr>";
			$block .= "<tr>";
			$block .= "<td width='50%'><strong>Shipping Code:</strong> ".$object->shippingCode."</td>";
			$block .= "</tr>";
			$block .= "<tr>";
			$block .= "<td colspan='2'><strong>File Name:</strong> ".$object->filename."</td>";
			$block .= "</tr>";
			$block .= "</table>";
			$block .= "<hr />";
			$block .= "<h2>Order Details</h2>";
			$block .= "<table class='transaction_table'>
						<thead>
							<tr>
								<th>Description</th>
								<th>Shipping Code</th>
								<th>QTY</th>
								<th class='currency'>Item Cost</th>
								<th class='currency'>Item Total</th>
							</tr>
						</thead>
						<tbody>";

		 
			$sql = "SELECT * 
					FROM costco_line_item
					WHERE costco_save_data_id = '".$costco_save_data_id."'";
			$res = $dbCustom->getResult($db,$sql);
				
			$hubAction = '';
			$item_total = 0;
			$grand_total = 0;
			setlocale(LC_MONETARY, 'en_US');
			while($row = $res->fetch_object){
				
				$item_total = $row->qtyOrdered * $row->unitCost;
				$grand_total += $item_total;
				
				$block .= "<tr>";
				$block .= "<td>".$row->description."</td>";	 
				$block .= "<td>".$row->shippingCode."</td>";
				$block .= "<td>".$row->qtyOrdered."</td>";
				$block .= "<td class='currency'>".money_format('%n',$row->unitCost)."</td>";	
				$block .= "<td class='currency'>".money_format('%n',$item_total)."</td>";	
				$block .= "</tr>";
			
			}
		 
			$block .= "<tr class='currency'><td colspan='4'>Total:</td>";
			$block .= "<td class='currency'>".money_format('%n',$grand_total)."</td></tr>";
			$block .= "</tbody></table>";
			echo $block;
			$block = "<hr />";
			$block .= "<h2>Shipping &amp; Billing</h2>";
			$block .= "<div class='colcontainer'>";
			$block .= "<div class='twocols'><h3>Shipping Details</h3>";
			$block .= "<p class='mL15'><em>Name:</em> ".$object->shipTo_name1."</p>";
			$block .= "<h4>Shipping Address:</h4>";
			$block .= "<p class='mL15'>".$object->shipTo_address1."<br />";
			//$block .= $object->shipTo_address2."<br />";
			$block .= $object->shipTo_city.", ".$object->shipTo_state." ".$object->shipTo_postalCode;
			$block .= ", ".$object->shipTo_country."</p>";
			$block .= "<h4>Contact Information:</h4>";
			$block .= "<p class='mL15'><em>Email: </em>".$object->shipTo_email."</p>";
			$block .= "<p class='mL15'><em>Daytime Phone: </em>".$object->shipTo_dayPhone."</p>";
			$block .= "</div><div class='twocols'><h3>Billing Details</h3>";
			$block .= "<p class='mL15'><em>Name:</em> ".$object->billTo_name1."</p>";
			$block .= "<h4>Billing Address:</h4>";
			$block .= "<p class='mL15'>".$object->billTo_address1."<br />";
			//$block .= $object->billTo_address2."<br />";
			$block .= $object->billTo_city.", ".$object->billTo_state." ".$object->billTo_postalCode;
			$block .= ", ".$object->billTo_country."</p>";
			$block .= "<h4>Contact Information:</h4>";
			$block .= "<p class='mL15'><em>Email: </em>".$object->billTo_email."</p>";
			$block .= "<p class='mL15'><em>Daytime Phone: </em>".$object->billTo_dayPhone."</p>";
			$block .= "</div></div>";
		 echo $block;

	 
	 }
	 
    ?>




</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>    
    
</div>




    <div style="display:none">
        <div id="edit" style="width:900px; height:620px;">
        </div>
    </div>
    

</body>
</html>



