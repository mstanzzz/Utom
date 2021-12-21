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

$page_title = "Order List";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");	
$lgn = new CustomerLogin;

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$order_customer_id = (isset($_REQUEST["order_customer_id"]))? $_REQUEST['order_customer_id'] : 0;

if($order_customer_id > 0){
	$cust_name = $lgn->getFullName($order_customer_id);
}else{
	$cust_name = '';	
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

$ts = time();

if(isset($_POST['edit_order'])){

	$order_id = (isset($_POST['order_id']))? $_POST['order_id'] : 0;

	$shipping_name = (isset($_POST['shipping_name']))? trim(addslashes($_POST['shipping_name'])) : '';
	$shipping_name_company = (isset($_POST['shipping_name_company']))? trim(addslashes($_POST['shipping_name_company'])) : '';
	$shipping_address_one = (isset($_POST['shipping_address_one']))? trim(addslashes($_POST['shipping_address_one'])) : '';
	$shipping_address_two = (isset($_POST['shipping_address_two']))? trim(addslashes($_POST['shipping_address_two'])) : '';	
	$shipping_city = (isset($_POST['shipping_city']))? trim(addslashes($_POST['shipping_city'])) : '';	
	$shipping_state = (isset($_POST['shipping_state']))? trim(addslashes($_POST['shipping_state'])) : '';	
	$shipping_zip = (isset($_POST['shipping_zip']))? trim($_POST['shipping_zip']) : '';	
	$shipping_country = (isset($_POST['shipping_country']))? trim($_POST['shipping_country']) : '';	
	$shipping_phone = (isset($_POST['shipping_phone']))? trim(addslashes($_POST['shipping_phone'])) : '';	
	$shipping_email = (isset($_POST['shipping_email']))? trim(addslashes($_POST['shipping_email'])) : '';
	$billing_name = (isset($_POST['billing_name']))? trim(addslashes($_POST['billing_name'])) : '';
	$billing_email = (isset($_POST['billing_email']))? trim(addslashes($_POST['billing_email'])) : '';
	$billing_address_one = (isset($_POST['billing_address_one']))? trim(addslashes($_POST['billing_address_one'])) : '';
	$billing_address_two = (isset($_POST['billing_address_two']))? trim(addslashes($_POST['billing_address_two'])) : '';
	$billing_city = (isset($_POST['billing_city']))? trim(addslashes($_POST['billing_city'])) : '';
	$billing_state = (isset($_POST['billing_state']))? trim(addslashes($_POST['billing_state'])) : '';
	$billing_zip = (isset($_POST['billing_zip']))? trim(addslashes($_POST['billing_zip'])) : '';
	$billing_country = (isset($_POST['billing_country']))? trim(addslashes($_POST['billing_country'])) : '';
	$billing_phone = (isset($_POST['billing_phone']))? trim(addslashes($_POST['billing_phone'])) : '';
	$customer_id = (isset($_POST['customer_id']))? $_POST['customer_id'] : 0;

	$in_house_product_descr = (isset($_POST['in_house_product_descr']))? trim(addslashes($_POST['in_house_product_descr'])) : '';
	
	$sub_total = (isset($_POST['sub_total']))? $_POST['sub_total'] : 0;
	
	$shipping_cost = (isset($_POST['shipping_cost']))? $_POST['shipping_cost'] : 0;
	$tax_cost = (isset($_POST['tax_cost']))? $_POST['tax_cost'] : 0;
	
	$total = $sub_total + $shipping_cost + $tax_cost;
	
	$order_date = (isset($_POST['order_date']))? trim($_POST['order_date']) : 0;
	$order_date = strtotime($order_date);
	if($order_date < ($ts-(60*60*24*30*12))) $order_date = $ts;
	
	$order_type = "manual";

	$stmt = $db->prepare("UPDATE ctg_order
						SET 
						shipping_name = ?
						,shipping_name_company = ?  
						,shipping_address_one = ?  
						,shipping_address_two = ?  
						,shipping_city = ?  
						,shipping_state = ?  
						,shipping_zip = ?  
						,shipping_country = ?  
						,shipping_phone = ? 
						,shipping_email = ?   
						,billing_name = ?
						,billing_email = ?  
						,billing_address_one = ?  
						,billing_address_two = ?  
						,billing_city = ?  
						,billing_state = ?  
						,billing_zip = ?  
						,billing_country = ?  
						,billing_phone = ?
						,in_house_product_descr = ?
						,order_type = ?
						,sub_total = ?
						,shipping_cost = ?
						,tax_cost = ?
						,total = ?
						,customer_id = ?
						,order_date = ?																	
						,profile_account_id = ?						
						WHERE order_id = ?");
						//echo 'Error '.$db->error;	
						// d for double / decimal 
						
	if(!$stmt->bind_param('sssssssssssssssssssssddddiiii'
						,$shipping_name
						,$shipping_name_company  
						,$shipping_address_one  
						,$shipping_address_two  
						,$shipping_city  
						,$shipping_state  
						,$shipping_zip  
						,$shipping_country  
						,$shipping_phone 
						,$shipping_email   
						,$billing_name
						,$billing_email  
						,$billing_address_one  
						,$billing_address_two  
						,$billing_city  
						,$billing_state  
						,$billing_zip  
						,$billing_country  
						,$billing_phone
						,$in_house_product_descr
						,$order_type
						,$sub_total
						,$shipping_cost
						,$tax_cost
						,$total
						,$customer_id
						,$order_date																		
						,$_SESSION['profile_account_id']
						,$order_id)){
						
						
				//echo 'Error '.$db->error;
			
	}else{
				$stmt->execute();
				$stmt->close();
	}

	if(count($_SESSION['temp_order_fields']['line_item_array']) > 0){
		
		$sql = "DELETE FROM order_line_item
				WHERE orderid = '".$order_id."'";
		
		foreach($_SESSION['temp_order_fields']['line_item_array'] as $v){
			
			$price = get_item_price($v['item_id']);
									
			$sql = "INSERT INTO order_line_item
						(order_id
						  ,trans_date
						  ,item_id
						  ,name 
						  ,qty
						  ,price)
						VALUES
						('".$order_id."'
						 ,'".$ts."'
						 ,'".$v['item_id']."'
						 ,'".$v['name']."'
						 ,'".$v['qty']."'
						 ,'".$price."')";
			$res = $dbCustom->getResult($db,$sql);		
		}
	}


}


if(isset($_POST['add_order'])){
	
	
	$shipping_name = (isset($_POST['shipping_name']))? trim(addslashes($_POST['shipping_name'])) : '';
	$shipping_name_company = (isset($_POST['shipping_name_company']))? trim(addslashes($_POST['shipping_name_company'])) : '';
	$shipping_address_one = (isset($_POST['shipping_address_one']))? trim(addslashes($_POST['shipping_address_one'])) : '';
	$shipping_address_two = (isset($_POST['shipping_address_two']))? trim(addslashes($_POST['shipping_address_two'])) : '';	
	$shipping_city = (isset($_POST['shipping_city']))? trim(addslashes($_POST['shipping_city'])) : '';	
	$shipping_state = (isset($_POST['shipping_state']))? trim(addslashes($_POST['shipping_state'])) : '';	
	$shipping_zip = (isset($_POST['shipping_zip']))? trim($_POST['shipping_zip']) : '';	
	$shipping_country = (isset($_POST['shipping_country']))? trim($_POST['shipping_country']) : '';	
	$shipping_phone = (isset($_POST['shipping_phone']))? trim(addslashes($_POST['shipping_phone'])) : '';	
	$shipping_email = (isset($_POST['shipping_email']))? trim(addslashes($_POST['shipping_email'])) : '';
	$billing_name = (isset($_POST['billing_name']))? trim(addslashes($_POST['billing_name'])) : '';
	$billing_email = (isset($_POST['billing_email']))? trim(addslashes($_POST['billing_email'])) : '';
	$billing_address_one = (isset($_POST['billing_address_one']))? trim(addslashes($_POST['billing_address_one'])) : '';
	$billing_address_two = (isset($_POST['billing_address_two']))? trim(addslashes($_POST['billing_address_two'])) : '';
	$billing_city = (isset($_POST['billing_city']))? trim(addslashes($_POST['billing_city'])) : '';
	$billing_state = (isset($_POST['billing_state']))? trim(addslashes($_POST['billing_state'])) : '';
	$billing_zip = (isset($_POST['billing_zip']))? trim(addslashes($_POST['billing_zip'])) : '';
	$billing_country = (isset($_POST['billing_country']))? trim(addslashes($_POST['billing_country'])) : '';
	$billing_phone = (isset($_POST['billing_phone']))? trim(addslashes($_POST['billing_phone'])) : '';
	$customer_id = (isset($_POST['customer_id']))? $_POST['customer_id'] : 0;
	
	$in_house_product_descr = (isset($_POST['in_house_product_descr']))? trim(addslashes($_POST['in_house_product_descr'])) : '';
	
	$sub_total = (isset($_POST['sub_total']))? $_POST['sub_total'] : 0;
	
	$shipping_cost = (isset($_POST['shipping_cost']))? $_POST['shipping_cost'] : 0;
	$tax_cost = (isset($_POST['tax_cost']))? $_POST['tax_cost'] : 0;
	
	$total = $sub_total + $shipping_cost + $tax_cost;
	
	$order_date = (isset($_POST['order_date']))? trim($_POST['order_date']) : 0;
	$order_date = strtotime($order_date);
	if($order_date < ($ts-(60*60*24*30*12))) $order_date = $ts;
	
	$order_type = "manual";
	
	$stmt = $db->prepare("INSERT INTO ctg_order
						(shipping_name
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
						,in_house_product_descr
						,order_type
						,sub_total
						,shipping_cost
						,tax_cost
						,total
						,customer_id
						,order_date																	
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");	
						
						//print_r($stmt);						
						//echo 'Error '.$db->error;						
	
	if(!$stmt->bind_param('sssssssssssssssssssssddddiii'
						,$shipping_name
						,$shipping_name_company  
						,$shipping_address_one  
						,$shipping_address_two  
						,$shipping_city  
						,$shipping_state  
						,$shipping_zip  
						,$shipping_country  
						,$shipping_phone 
						,$shipping_email   
						,$billing_name
						,$billing_email  
						,$billing_address_one  
						,$billing_address_two  
						,$billing_city  
						,$billing_state  
						,$billing_zip  
						,$billing_country  
						,$billing_phone
						,$in_house_product_descr
						,$order_type
						,$sub_total
						,$shipping_cost
						,$tax_cost
						,$total
						,$customer_id
						,$order_date																		
						,$_SESSION['profile_account_id'])){
						
						
				//echo 'Error '.$db->error;
			
			}else{
				$stmt->execute();
				$stmt->close();
			}
						
					
	
	$order_id = $db->insert_id;
	
	
	if(count($_SESSION['temp_order_fields']['line_item_array']) > 0){
		foreach($_SESSION['temp_order_fields']['line_item_array'] as $v){
			
			$price = get_item_price($v['item_id']);
			
			//echo $price;
			//echo "<br />";
						
			$sql = "INSERT INTO order_line_item
						(order_id
						  ,trans_date
						  ,item_id
						  ,name 
						  ,qty
						  ,price)
						VALUES
						('".$order_id."'
						 ,'".$ts."'
						 ,'".$v['item_id']."'
						 ,'".$v['name']."'
						 ,'".$v['qty']."'
						 ,'".$price."')";
			$res = $dbCustom->getResult($db,$sql);		
		}
	}
	
	/*
	$sql = "SELECT *
			FROM order_line_item
			WHERE order_id = '".$order_id."'
			AND item_id > '0'";
			
	$result = $dbCustom->getResult($db,$sql);		
	echo $result->num_rows;
	*/	
	

	$msg = 'success';

	
	
}


function get_item_price($item_id){
	
	$dbCustom = new DbCustom();
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$price = 0;
	
	$sql = "SELECT price_flat, price_wholesale, percent_markup 
			FROM item
			WHERE item_id = '".$item_id."'";
			
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		
		if($object->price_flat > 0){
			$price = $object->price_flat;	
		}elseif($object->price_wholesale > 0){
			$price = $object->price_wholesale + $object->percent_markup; 
		}else{
			$price = 0;	
		}
	}
	
	return $price;
	
}


if(isset($_POST['del_order_id'])){
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "DELETE FROM ctg_order WHERE order_id = '".$_POST['del_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "DELETE FROM braintree_transaction WHERE order_id = '".$_POST['del_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM order_line_item WHERE order_id = '".$_POST['del_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM order_to_order_state WHERE order_id = '".$_POST['del_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	
}

unset($_SESSION['temp_order_fields']);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function() {

	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
	
	/*
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
	*/
	
	$("a.inline").fancybox();
	
	$("#view_desc").click(function(){ $.fancybox.close;  })

	$(".fancybox").click(function(e){
		e.preventDefault();
		var q_str = "?action=1"+get_query_str();
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_set_item_session.php'+q_str,
		  success: function(data) {
			//$('#t').html(data);
			//alert(data);
			//alert('Load was performed.');
		  	//window.location=f_id;
		  }
		});
		
	});

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
		$actual_link = "";
		$bread_crumb->reSet();
		if($ret_page == 'customer-list'){	
			$bread_crumb->add('Customer List', SITEROOT."//manage/customer/customer-list.php");
		}		
		if($ret_page == 'customer-landing'){	
			$bread_crumb->add("Customers", SITEROOT."//manage/customer/customer-landing.php");
		}
		
		$bread_crumb->add('Order List', $actual_link);

		echo $bread_crumb->output();
		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		
		$s_profile_account_id = $_SESSION['profile_account_id'];
		if(isset($_REQUEST['s_profile_account_id'])){			
			$s_profile_account_id = $_REQUEST['s_profile_account_id'];
		}else{		
			if(isset($_GET['uid1'])){			
				if($_GET['uid1'] > 0){
					$s_profile_account_id = $_REQUEST['uid1'];
					
				}
			}
		}
				
		$order_billing_name = (isset($_POST['order_billing_name']))? $_POST['order_billing_name'] : '';
		$order_billing_email = (isset($_POST['order_billing_email']))? $_POST['order_billing_email'] : '';
		if(isset($_POST["date_from"])){
			$date_from = strpos($_POST['date_from'], '/') ? strtotime(trim($_POST['date_from'])) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_POST['date_to'])){
			$date_to = strpos($_POST['date_to'], '/') ? strtotime(trim($_POST['date_to'])) : '';
		}else{
			$date_to = ''; 
		}
		
		$s_customer_id = (isset($_POST['s_customer_id'])) ? $_POST['s_customer_id'] : 0;

		$s_order_id = (isset($_POST['s_order_id'])) ? $_POST['s_order_id'] : 0;


		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
		
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
						
		$sql = "SELECT * 
				FROM  ctg_order
				WHERE profile_account_id = '".$s_profile_account_id."'";
												
		if($order_customer_id > 0){		
			$sql .= " AND customer_id = '".$order_customer_id."'";
		}
		
		if($s_order_id > 0){
			$sql .= " AND order_id = '".$s_order_id."'";
		}
		
		if($s_customer_id > 0){
			$sql .= " AND customer_id = '".$s_customer_id."'";
		}
		
		if($order_billing_name != ''){		
			$sql .= " AND billing_name LIKE '".$order_billing_name."'";
		}
		if($order_billing_email != ''){		
			$sql .= " AND billing_email LIKE '".$order_billing_email."'";
		}
		if($date_from != ''){		
			$sql .= " AND order_date >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND order_date <= '".$date_to."'";
		}
		$nmx_res = $dbCustom->getResult($db,$sql);
		
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 20;
		$last = ceil($total_rows/$rows_per_page); 
							 
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
							
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		if($sortby != ''){

			if($sortby == 'order_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY order_id DESC".$limit;
				}else{
					$sql .= " ORDER BY order_id".$limit;		
				}
			}
			if($sortby == 'billing_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY billing_name DESC".$limit;
				}else{
					$sql .= " ORDER BY billing_name".$limit;		
				}
			}
			if($sortby == 'order_date'){
				if($a_d == 'd'){
					$sql .= " ORDER BY order_date DESC".$limit;
				}else{
					$sql .= " ORDER BY order_date".$limit;		
				}
			}
			if($sortby == 'total'){
				if($a_d == 'd'){
					$sql .= " ORDER BY total DESC".$limit;
				}else{
					$sql .= " ORDER BY total".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY order_id DESC".$limit;					
		}

		//$sql = "SELECT * FROM ctg_order ORDER BY order_id DESC";
		
		$result = $dbCustom->getResult($db,$sql);

		$url_str = 'order-list.php';
		?>
		<form id='orders_by_profile_form' name='orders_by_profile_form' action='<?php echo $url_str; ?>' method='post'>
			<div class="page_actions">
				<h2>Search Orders:</h2>
				<div class="colcontainer">
					<div class="threecols">
					<?php
					if($_SESSION['profile_account_id'] == 1){
						
						$block = '';
						
						$block .= '<label>Profile</label>';
						
						$block .= "<select name='s_profile_account_id'>";
						
						//$block .= "<option value='0'>All</option>";
						$db = $dbCustom->getDbConnect(USER_DATABASE);
						$sql = "SELECT id, domain_name, payment_processor_id 
						FROM profile_account";
						
						$res = $dbCustom->getResult($db,$sql);
						
						while($row = $res->fetch_object()){						
							$selected = ($row->id == $s_profile_account_id) ? "selected='selected'" : '';							
							$block .= "<option value='".$row->id."' $selected>".$row->domain_name."</option>";
						}					
						$block .= '</select>';
						
						echo $block;
						
					}
					?>
						<label>Billing Name</label>
						<input type="text" name="order_billing_name" value="<?php echo $cust_name; ?>"/>
                        
                        <label>Customer ID</label>
						<input type="text" name="s_customer_id" value=""/>
                        
					</div>
					<div class="threecols">
						<label>Email Address</label>
						<input type="text" name="order_billing_email" />
                        
                        <label>Order ID</label>
						<input type="text" name="s_order_id" />
                        
						<div class="colcontainer">
							<div class="twocols">
								<label>Date From</label>
								<input id="datepicker1" type="text" name="date_from" value="none" style='width:80px;'/>

							</div>
							<div class="twocols">
								<label>Date To</label>
								<input id="datepicker2" type="text" name="date_to" value="today" style='width:100px;'/>
							</div>
						</div>
                        
                        
					</div>
					<div class="threecols">
						<button class="btn btn-primary center-block btn-large" type="submit" name="submit" ><i class="icon-search icon-white"></i> Search Orders </button>
					
                    </div>
                        
                        <?php
                        
                        $url_str = "add-order.php";
                        $url_str .= "?pagenum=".$pagenum;
                        $url_str .= "&sortby=".$sortby;
                        $url_str .= "&a_d=".$a_d;
                        $url_str .= "&truncate=".$truncate;
                        
                        ?>
                        <div style="float:right;">   
                        <a href="<?php echo $url_str; ?>" class="btn btn-primary btn-small" >
                        <i class="icon-plus icon-white"></i> Add Order </a>
                        </div>
				</div>
            </div>
            </form>
            
			<div class="data_table">
                <?php
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "order-list.php", $sortby, $a_d, $s_profile_account_id);
					echo "<br /><br /><br />";
				}
				?>


            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
            				<th width="5%" <?php addSortAttr('order_id',true); ?>>
                            Order Id
                            <i <?php addSortAttr('order_id',false); ?>></i>
                            </th>
            				<th <?php addSortAttr('billing_name',true); ?>>
                            Billing Name
                            <i <?php addSortAttr('billing_name',false); ?>></i>
                            </th>
            				<th <?php addSortAttr('order_date',true); ?>>
                            Order Date
                            <i <?php addSortAttr('order_date',false); ?>></i>
                            </th>
                            <th <?php addSortAttr('total',true); ?>>
                            $ Total
                            <i <?php addSortAttr('total',false); ?>></i>
                            </th>
 							<th width="8%">Type</th>
							<th width="8%">State</th>
							<th width="8%">Process</th>
							<th width="8%">Ship</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            
						</tr>
					</thead>
					<?php
					
					require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					
						$block = '';
						while($row = $result->fetch_object()) {
							
							
							//Order Number
							$block .= "<tr><td>";
							$block .= "<a href='order.php?order_id=".$row->order_id."'>$row->order_id</a>"; 
							
							$block .= "</td>";

							//customer name
							//$db = $dbCustom->getDbConnect(USER_DATABASE);		
							//$cust_name = "None";
							/* cust
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
							$block .= "<td>";
							//$block .= $cust_name;
							$block .= $row->billing_name; 
							$block .= "</td>";
							//Order Date
							$block .= "<td>";
							$block .= date("m/d/Y",$row->order_date); 
							$block .= "</td>";
							
							/*
							$profile_account_domain = '';
							if($s_profile_account_id > 0){
								$db = $dbCustom->getDbConnect(USER_DATABASE);
								$sql = "SELECT domain_name 
										FROM  profile_account
										WHERE id = '".$s_profile_account_id."'";
								
								$res = $dbCustom->getResult($db,$sql);		
								if($res->num_rows){
									$n_obj = $res->fetch_object();
									$profile_account_domain = $n_obj->domain_name;
								}
							}else{
								$db = $dbCustom->getDbConnect(CART_DATABASE);		
								$sql = "SELECT profile_account_id 
										FROM  ctg_order
										WHERE order_id = '".$row->order_id."'";
								
								$res = $dbCustom->getResult($db,$sql);
								if($res->num_rows){
									$p_obj = mysql_fetch_object($p_res);
									$db = $dbCustom->getDbConnect(USER_DATABASE);
									$sql = "SELECT domain_name 
											FROM  profile_account
											WHERE id = '".$p_obj->profile_account_id."'";
									$sub_res = $dbCustom->getResult($db,$sql);		
									if($sub_res->num_rows){
										$n_obj = $sub_res->fetch_object();
										$profile_account_domain = $n_obj->domain_name;
									}
								}
							}
							*/
							
							

							//Total Price
							$block .= "<td>";
							$block .= "$".number_format($row->total,2);
							$block .= "&nbsp;</td>";
																	
							//Type
							$block .= "<td>".$row->order_type."</td>";																	
														
							//Order State
							$db = $dbCustom->getDbConnect(CART_DATABASE);				
							$sql = "SELECT order_state.name   
									FROM order_to_order_state, order_state																		 
									WHERE when_complete > '0' 
									AND order_state.order_state_id = (SELECT MAX(order_state_id)
																	FROM order_to_order_state 
																	WHERE order_id = '".$row->order_id."')";
							$res = $dbCustom->getResult($db,$sql);
							if($res->num_rows > 0){
								$os_res_obj = $res->fetch_object();
								$order_state = $os_res_obj->name;
							}else{							
								$order_state = 'pending';
							}
							
							
							$disabled = ($admin_access->customers_level < 2)? "disabled" : '';
							$disabled = '';

							$block .= "<td>";
							$block .= $order_state;
							$block .= "</td>";
							
							$url_str = "order.php";
							$url_str .= "?order_id=".$row->order_id;
							$url_str .= "&pagenum=".$pagenum;
							$url_str .= "&sortby=".$sortby;
							$url_str .= "&a_d=".$a_d;
							$url_str .= "&truncate=".$truncate;
							
							$block .= "<td><a href='".$url_str."' class='btn btn-small'> View / Process</a></td>"; 

							$url_str = "ship-order.php";
							$url_str .= "?order_id=".$row->order_id;
							$url_str .= "&pagenum=".$pagenum;
							$url_str .= "&sortby=".$sortby;
							$url_str .= "&a_d=".$a_d;
							$url_str .= "&truncate=".$truncate;
							
							$block .= "<td><a href='".$url_str."' class='btn btn-small'> Ship </a></td>"; 
							
							$url_str = "edit-order.php";
							$url_str .= "?order_id=".$row->order_id;
							$url_str .= "&pagenum=".$pagenum;
							$url_str .= "&sortby=".$sortby;
							$url_str .= "&a_d=".$a_d;
							$url_str .= "&truncate=".$truncate;
							
							$block .= "<td valign='top'><a class='btn btn-small".$disabled."'' 
							href='".$url_str."'><i class='icon-eye-open'></i> Edit </a></td>";
								
							
							// Delete
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm btn-small ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->order_id."' class='itemId' value='".$row->order_id."' /></a></td>";

							//<i class='icon-eye-open'></i>
							
							//process
							/*							
							if($admin_access->customers_level > 1){
								
								
								$url_str = "process-order.php";
								$url_str .= "?order_id=".$row->order_id;
								$url_str .= "&pagenum=".$pagenum;
								$url_str .= "&sortby=".$sortby;
								$url_str .= "&a_d=".$a_d;
								$url_str .= "&truncate=".$truncate;
								
								$block .= "<td>";
								$block .= "<a href='".$url_str."' class='btn btn-primary btn-small  fancybox fancybox.iframe'>";
								$block .= "<i class='icon-check icon-white'></i> Process</a>";
								$block .= "</td>"; 
							
							
							}else{
								$block .= "<td></td>";
								$block .= "<td></td>";
								
							}
							*/
							
							$block .= '</tr>';
						}
							echo $block;
						?>
				</table>
				<?php
                if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "order-list.php", $sortby, $a_d, $s_profile_account_id);
				}
				?>
			</div>
		
	</div>
    
    <?php
	$url_str = "order-list.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
    ?>
    
    <div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this order and transaction?</h3>
	<form name="del_category" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_order_id" class="itemId" type="hidden" name="del_order_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_order" type="submit" >Yes, Delete</button>
	</form>
	</div>
    
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
<?php  



								

?>
