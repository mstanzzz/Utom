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


$page_title = "Costco Order List";
$page_group = "order";


$num_new_orders = 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	



// uncomment to make live
//require_once("costco-get-ship-orders.php"); 

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/costco-section-tabs.php");

		?>
		
		<div class="page_actions">
	    	<a class="btn btn-large btn-primary" target="_blank" href='https://dsm.commercehub.com/dsm/gotoLogin.do'>Commerce Hub Login</a>
		</div>
		<h3>Unshipped Orders</h3>
		<div class="data_table">
        	<?php 
				$sortby = (isset($_GET['sortby'])) ? trim(addslashes($_GET['sortby'])) : '';
				$a_d = (isset($_GET['a_d'])) ? addslashes($_GET['a_d']) : 'a';
				require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); 
			?>	
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="10%" <?php addSortAttr('billTo_name1',true); ?>>
                            Billing Name
                            <i <?php addSortAttr('billTo_name1',false); ?>></i>
                            </th>
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
			WHERE is_shipped = '0'";
			
			
	if($sortby != ''){
			if($sortby == 'billTo_name1'){
				if($a_d == 'd'){
					$sql .= " ORDER BY billTo_name1 DESC";
				}else{
					$sql .= " ORDER BY billTo_name1";		
				}
			}
	}else{
		$sql .=	" ORDER BY paid_date ASC";
	}

			
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
		
		$block .= "<a target='_blank' href='".SITEROOT."/costco/decrypted/".$dec_fn."' class='btn btn-small btn-primary'>
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






	</div>
	</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>    
    
</div>


</body>
</html>



