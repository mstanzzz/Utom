<?php
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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Transaction List";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	
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

	$('#submit_order_by_customer_form').click(
		function () {
			document.order_by_customer_form.submit();
		}
	);


});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
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
		$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';		
		
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		if($ret_page == "customer-landing"){	
			$bread_crumb->add("Customers", SITEROOT."//manage/customer/customer-landing.php");
		}
		$bread_crumb->add('Transactions List', '');
		echo $bread_crumb->output();

        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
    
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
	
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		//$payment_processor = "braintree";
		//getPaymentProcessor(); <-- this function was throwing an error so I commented it out to do the page markup.
		//if($payment_processor == "braintree"){}
		$db = $dbCustom->getDbConnect(CART_DATABASE);	
			
		$sql = "SELECT * FROM  braintree_transaction ";
		$nmx_res = $dbCustom->getResult($db,$sql);
		

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 10;
		$last = ceil($total_rows/$rows_per_page); 
			
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
			
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		$sql = "SELECT * FROM  braintree_transaction";
		
		
		if($sortby != ''){

			if($sortby == 'first_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY first_name DESC".$limit;
				}else{
					$sql .= " ORDER BY first_name".$limit;		
				}
			}
			if($sortby == 'trans_date'){
				if($a_d == 'd'){
					$sql .= " ORDER BY trans_date DESC".$limit;
				}else{
					$sql .= " ORDER BY trans_date".$limit;		
				}
			}
			if($sortby == 'amount'){
				if($a_d == 'd'){
					$sql .= " ORDER BY amount DESC".$limit;
				}else{
					$sql .= " ORDER BY amount".$limit;		
				}
			}
			if($sortby == 'order_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY order_id DESC".$limit;
				}else{
					$sql .= " ORDER BY order_id".$limit;		
				}
			}
			
			if($sortby == 'is_success'){
				if($a_d == 'd'){
					$sql .= " ORDER BY is_success DESC".$limit;
				}else{
					$sql .= " ORDER BY is_success".$limit;		
				}
			}
			
			
			
			
		}else{
			$sql .= " ORDER BY  trans_date DESC".$limit;					
		}


		$result = $dbCustom->getResult($db,$sql);
		

		?>
		
			<div class="page_actions">
            ADD SEARCH BOX
			</div>
            <div class="clear"></div>
			<div class="data_table">
				<?php 
				if($total_rows > $rows_per_page){
					echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "order-management/master/transaction-list.php", $sortby, $a_d); 
				}
				?>


        		<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
        		<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
            				<th <?php addSortAttr('first_name',true); ?>>
                            Customer
                            <i <?php addSortAttr('first_name',false); ?>></i>
                            </th>
            				<th width="10%" <?php addSortAttr('trans_date',true); ?>>
                            Transaction Date
                            <i <?php addSortAttr('trans_date',false); ?>></i>
                            </th>
            				<th width="10%" <?php addSortAttr('amount',true); ?>>
                            Order Total
                            <i <?php addSortAttr('amount',false); ?>></i>
                            </th>
            				<th width="10%" <?php addSortAttr('order_id',true); ?>>
                            Order Number
                            <i <?php addSortAttr('order_id',false); ?>></i>
                            </th>


            				<th <?php addSortAttr('is_success',true); ?>>
                            Is Success
                            <i <?php addSortAttr('is_success',false); ?>></i>
                            </th>
                            

							<th>Order Details</th>
							<th>Tranaction Details</th>
						</tr>
					</thead>

<?php
	
	
	
	
    while($row = $result->fetch_object()) {
		 
		$block = '';
		$block .= "<tr>";
		//customer name
		$block .= "<td>";
		$block .= $row->first_name." ".$row->last_name; 
		$block .= "</td>";
		//transaction date
		$block .= "<td>";
		$block .= date("m/d/Y",$row->trans_date); 
		$block .= "</td>";
		
		//order total
		$block .= "<td>";
		$block .= "$".number_format($row->amount,2);
		$block .= "</td>";
		//order number
		$block .= "<td>";
		$block .= $row->order_id;
		$block .= "</td>";
		

		$block .= "<td>";
		if($row->is_success){
			$block .='Transaction Successful';	
		}else{
			$block .='Failed';
		}
		$block .= "</td>";
		

		$block .= "<td>";
		$block .= "<a href='order.php?order_id=".$row->order_id."&ret_page=transaction_list' class='btn btn-small'><i class='icon-eye-open'></i> Order Details</a>";
		$block .= "</td>";

		$block .= "<td>";
		$block .= "<a href='transaction.php?order_id=".$row->order_id."&ret_page=transaction_list' class='btn btn-small btn-primary'><i class='icon-eye-open icon-white'></i> View Tranaction</a>"; 
		$block .= "</td></tr>";

		
		echo $block;

	}
    
    ?>
    </table>
	<?php 
	if($total_rows > $rows_per_page){
		echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "order-management/master/transaction-list.php", $sortby, $a_d); 
	}
	?>

	</div>
	</div>
<p class="clear"></p>
<?php 
require_once("<?php echo SITEROOT; ?>includes/manage-footer.php");
?>    
   
</div>

    <div style="display:none">
        <div id="edit" style="width:900px; height:620px;">
        </div>
    </div>
    
</body>
</html>



