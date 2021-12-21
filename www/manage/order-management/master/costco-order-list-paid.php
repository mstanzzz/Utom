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

	

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>


<script>
$(document).ready(function() {
	
	
	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();	
	$('#clear_dates').click(function() {
		$('#datepicker1').val('');
		$('#datepicker2').val('');
	});
	
	/*
	$('.fancybox').fancybox({
		autoSize : false,
		height : 400	
	});
	*/
});
</script>
</head>
<body>
<div class="no-print">
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
</div>
<div class="manage_page_container">
    <div class="manage_side_nav no-print">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
    
    	<div class="no-print">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
        require_once($real_root."/manage/admin-includes/costco-section-tabs.php");


		$date_start = (isset($_POST['date_start'])) ? trim(addslashes($_POST['date_start'])) : '';
		$date_end = (isset($_POST['date_end'])) ? trim(addslashes($_POST['date_end'])) : '';
		
		//YYYY-MM-DD HH:MM:SS
		if(strlen($date_start) == 10){
			$ux_date_start = strtotime($date_start);
		}else{
			$ux_date_start = 0;
		}
		
		if(strlen($date_end) == 10){
			$ux_date_end = strtotime($date_end);
		}else{
			$ux_date_end = 0;
		}
		
				$sortby = (isset($_GET['sortby'])) ? trim(addslashes($_GET['sortby'])) : '';
				$a_d = (isset($_GET['a_d'])) ? addslashes($_GET['a_d']) : 'a';
				require_once($real_root."/manage/admin-includes/tablesort.php"); 
						
				$url_str = 'costco-order-list-paid.php';
				$url_str .= '?sortby='.$sortby;
				$url_str .= "&a_d=".$a_d;

		?>
		
		<div class="page_actions">
	    	<a class="btn btn-large btn-primary" target="_blank" href='https://dsm.commercehub.com/dsm/gotoLogin.do'>Commerce Hub Login</a>
         
         	<a class="btn btn-large btn-primary" href="#" onClick=" window.print(); return false">Print this page</a>   
            
		</div>
        <form name="form" action="<?php echo $url_str; ?>" method="post">
			<div style="float:right;">            
				<label>Paid Date To</label>
				<input type="text" name="date_end" id="datepicker2" value='' />
			</div>

        	<div style="float:right;">
				<label>Paid Date From</label>
				<input type="text" name="date_start" id="datepicker1" value='' />
			</div>
             <div style="clear:both;"></div>
			<div style="float:right;">                
            <input type="submit" name="submit" value="Submit Date Range">
			</div> 
            <div style="clear:both;"></div>
           
        </form>
        
        
        </div>
        
        
		<h3>Paid Orders</h3>
		<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        	<th width="10%" <?php addSortAttr('billTo_name1',true); ?>>
                            Billing Name
                            <i <?php addSortAttr('billTo_name1',false); ?>></i>
                            </th>
                        
                        
							<th>Order Date</th>
							<th>Ship Date</th>
                            <th>Paid Date</th>
                            <th># Line Items</th>
							<th>Total</th>                            
							<th class="no-print">View Order</th>
							<th class="no-print">View XML</th>
                            <th class="no-print">&nbsp;</th>
						</tr>
					</thead>

<?php
	

	$sql = "SELECT * 
			FROM  costco_save_data
			WHERE paid_date > '0'";
			
	if($ux_date_start > 0){
		$sql .= " AND paid_date >= '".$ux_date_start."'";	
	}
	
	if($ux_date_end > 0){
		$sql .= " AND paid_date <= '".$ux_date_end."'";	
	}
			
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
			
	// dates range		
			
			
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

		$block .= "<td class='no-print'>";
		$block .= "<a class='btn btn-small btn-primary' href='costco-order.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list'>
		<i class='icon-eye-open icon-white'></i> View</a>"; 
		$block .= "</td>";

		$dec_fn_array = explode('/',$row->filename);
		$dec_fn = $dec_fn_array[sizeof($dec_fn_array)-1];
		

		$block .= "<td class='no-print'>";
		//$block .= "<a href='costco-view-xml.php?costco_save_data_id=".$row->costco_save_data_id."&ret=costco-order-list' style='text-decoration:none;'>view XML</a>"; 
		
		$block .= "<a target='_blank' href='".SITEROOT."\/costco/decrypted/".$dec_fn."' class='btn btn-small btn-primary'>
		<i class='icon-eye-open icon-white'></i> View XML</a>";
		
		
		
		
		
					
						
		
		
		$block .= "<td class='no-print'><a class='btn btn-danger confirm btn-small'>Unpay<input type='hidden' id='".$row->costco_save_data_id."' class='itemId' value='".$row->costco_save_data_id."' /></a></td>";
		
		
		
		
		
		$block .= "</td></tr>";
	}
		$block .= "<tr><td colspan='6'>";
		$block .= "<div style='float:left;'>Num Orders:  ".$num_orders_paid."</div>";
		$block .= "<div style='float:right; padding-left:205px;'>Total:</div>";
		$block .= "<div class='clear'></div>";
		$block .= "<td colspan='6'><b>$".number_format($total_amount_paid, 2)."</b></td>";
		
		
		
		
		
		
		
		echo $block;
    ?>
    
	</table>



	</div>
	</div>
<p class="clear"></p>

<div class="no-print">

<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>    

</div>

    
</div>

<?php

	$url_str = 'costco-order-list-shipped.php';
	$url_str .= '?sortby='.$sortby;
	$url_str .= "&a_d=".$a_d;

?>

<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to Show this order as UnPaid?</h3>
	<form name="unpay_costco_save_data_id" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="unpay_costco_save_data_id" class="itemId" type="hidden" name="unpay_costco_save_data_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="unpay" type="submit" >Yes, Show UnPaid</button>
	</form>
</div>

</body>
</html>



