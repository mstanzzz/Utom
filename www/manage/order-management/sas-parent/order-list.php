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

if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 

$progress = new SetupProgress;
$module = new Module;

$page_title = "Order List";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

$order_customer= (isset($_REQUEST["order_customer"]))? trim($_REQUEST["order_customer"]) : ''; 
$order_customer_id = (isset($_REQUEST["order_customer_id"]))? $_REQUEST["order_customer_id"] : 0;


$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 
$unprocess = (isset($_REQUEST["unprocess"]))? $_REQUEST["unprocess"] : 0; 

$db = $dbCustom->getDbConnect(CART_DATABASE);
if($unprocess == 1){
	$sql = "UPDATE ctg_order
			SET order_state_id = '1' 
			WHERE order_id = '".$order_id."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
    $result = $dbCustom->getResult($db,$sql);	
				
}
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
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
		if($ret_page == "customer-list"){	
			$bread_crumb->add("Customer List", SITEROOT."//manage/customer/customer-list.php");
		}		
		if($ret_page == "customer-landing"){	
			$bread_crumb->add("Customers", SITEROOT."//manage/customer-landing.php");
		}
		
		$bread_crumb->add("Order List", '');
		echo $bread_crumb->output();
		
		
		
		 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$p_account_id = (isset($_POST["p_account_id"]))? $_POST["p_account_id"] : 0;
		$billing_name = (isset($_POST["billing_name"]))? $_POST["billing_name"] : '';
		$email = (isset($_POST["email"]))? $_POST["email"] : '';
		if(isset($_POST["date_from"])){
			$date_from = strpos($_POST["date_from"], "/") ? strtotime(trim(addslashes($_POST["date_from"]))) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_POST["date_to"])){
			$date_to = strpos($_POST["date_to"], "/") ? strtotime(trim(addslashes($_POST["date_to"]))) : '';
		}else{
			$date_to = ''; 
		}

		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

		$db = $dbCustom->getDbConnect(CART_DATABASE);
						
		$sql = "SELECT * 
				FROM  ctg_order
				WHERE order_state_id = '1'
				";
								
		if($order_customer_id > 0){		
			$sql .= " AND customer_id = '".$order_customer_id."'";
		}
								
		if($p_account_id > 0){		
			$sql .= " AND profile_account_id = '".$p_account_id."'";
		}
		if($billing_name != ''){		
			$sql .= " AND billing_name LIKE '".$billing_name."'";
		}
		if($email != ''){		
			$sql .= " AND billing_email LIKE '".$email."'";
		}
		if($date_from != ''){		
			$sql .= " AND order_date >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND order_date <= '".$date_to."'";
		}
	
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

		$sql = "SELECT * 
				FROM  ctg_order
				WHERE order_state_id = '1'
				";
								
		if($order_customer_id > 0){		
			$sql .= " AND customer_id = '".$order_customer_id."'";
		}
								
		if($p_account_id > 0){		
			$sql .= " AND profile_account_id = '".$p_account_id."'";
		}
		if($billing_name != ''){		
			$sql .= " AND billing_name LIKE '".$billing_name."'";
		}
		if($email != ''){		
			$sql .= " AND billing_email LIKE '".$email."'";
		}
		if($date_from != ''){		
			$sql .= " AND order_date >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND order_date <= '".$date_to."'";
		}


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
			$sql .= " ORDER BY order_id".$limit;;					
		}

$result = $dbCustom->getResult($db,$sql);		

		?>
		<form id='orders_by_profile_form' name='orders_by_profile_form' action='order-list.php' method='post'>
			<div class="page_actions">
				<h2>Search Orders:</h2>
				<div class="colcontainer">
					<div class="threecols">
						<label>Profile</label>
						<select name='p_account_id'>
							<?php
					$block = '';
					$block .= "<option value='0'>All</option>";
					$db = $dbCustom->getDbConnect(USER_DATABASE);
					$sql = "SELECT id, domain_name, payment_processor_id
							FROM profile_account
							";
					$profile_res = mysql_query ($sql);
					if(!$profile_res)die(mysql_error());
					
					while($row = mysql_fetch_object($profile_res)){
						
						$own_proc = ($row->id > 1 && $row->payment_processor_id > 0)? "Own Payment Processor" : '';	
						
						$block .= "<option value='".$row->id."'>".$row->domain_name." ".$own_proc."</option>";
					}
					
					echo $block;
					?>
						</select>
						<label>Billing Name</label>
						<input type="text" name="billing_name" />
					</div>
					<div class="threecols">
						<label>Email Address</label>
						<input type="text" name="email" />
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
				</div>
			
                <?php 
				if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "order-management/master/order-list.php", $sortby, $a_d);
					echo "<br /><br /><br />";
				}
				?>

            </div>
			<div class="data_table">
            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
            				<th <?php addSortAttr('order_id',true); ?>>
                            Name
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
 							<th>Domain</th>
							<th width="10%">State</th>
							<th width="12%">View</th>
							<th width="12%">Process</th>
						</tr>
					</thead>
					<?php
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
							$profile_account_domain = '';
							if($p_account_id > 0){
								$sql = "SELECT domain_name 
										FROM  profile_account
										WHERE id = '".$p_account_id."'";
								$n_res = mysql_query ($sql);
								if(!$n_res)die(mysql_error());
								if(mysql_num_rows($n_res)){
									$n_obj = mysql_fetch_object($n_res);
									$profile_account_domain = $n_obj->domain_name;
								}
							}else{
								$db = $dbCustom->getDbConnect(CART_DATABASE);		
								$sql = "SELECT profile_account_id 
										FROM  ctg_order
										WHERE order_id = '".$row->order_id."'";
								$p_res = mysql_query ($sql);
								if(!$p_res)die(mysql_error());
								if(mysql_num_rows($p_res)){
									$p_obj = mysql_fetch_object($p_res);
									$db = $dbCustom->getDbConnect(USER_DATABASE);
									$sql = "SELECT domain_name 
											FROM  profile_account
											WHERE id = '".$p_obj->profile_account_id."'";
									$n_res = mysql_query ($sql);
									if(!$n_res)die(mysql_error());
									if(mysql_num_rows($n_res)){
										$n_obj = mysql_fetch_object($n_res);
										$profile_account_domain = $n_obj->domain_name;
									}
								}
							}
							//Order State
							$db = $dbCustom->getDbConnect(CART_DATABASE);				
							$sql = "SELECT name
									FROM order_state
									WHERE order_state_id = '".$row->order_state_id."'";
							$os_res = mysql_query ($sql);
							if(!$os_res)die(mysql_error());
							if(mysql_num_rows($os_res) > 0){
								$os_res_obj = mysql_fetch_object($os_res);
								$order_state = $os_res_obj->name;
							}

							//Total Price
							$block .= "<td>";
							$block .= "$".number_format($row->total,2);
							$block .= "&nbsp;</td>";


							//Profile Account Domain
							$block .= "<td>";
							$block .= $profile_account_domain; 
							$block .= "</td>";
							$block .= "<td>";
							$block .= $order_state;
							$block .= "</td>";
							//View
							$block .= "<td><a href='order.php?order_id=".$row->order_id."&ret=order-list' class='btn btn-small'><i class='icon-eye-open'></i> View</a>"; 
							//process
							if($admin_access->customers_level > 1){
								$block .= "<td><a href='processed-order-list.php?order_id=".$row->order_id."&process=1' class='btn btn-primary btn-small'>
								<i class='icon-check icon-white'></i> Process</a></td></tr>"; 
							}else{
								$block .= "<td></td>";
							}
						}
							echo $block;
						?>
				</table>

                <?php 
				if($total_rows > $rows_per_page){
						echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "order-management/master/order-list.php", $sortby, $a_d);
				}
				?>

			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
