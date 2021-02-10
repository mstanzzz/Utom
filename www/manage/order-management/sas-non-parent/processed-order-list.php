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

$page_title = "Order List";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	

$page_title = "Processed Order List";
$page_group = "order";

$order_id = (isset($_REQUEST["order_id"]))? $_REQUEST["order_id"] : 0; 
$process = (isset($_REQUEST["process"]))? $_REQUEST["process"] : 0; 

$db = $dbCustom->getDbConnect(CART_DATABASE);
if($process == 1){
	$sql = "UPDATE ctg_order
			SET order_state_id = '2' 
			WHERE order_id = '".$order_id."'";
    $result = $dbCustom->getResult($db,$sql);	
				
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
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

		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		
		if(isset($parts)){
			if(in_array("master", $parts)){
				$bread_crumb->add("Order List", SITEROOT."/manage/order-management/master/order-list.php");				
			}elseif(in_array("sas-parent", $parts)){
				$bread_crumb->add("Order List", SITEROOT."/manage/order-management//sas-parentorder-list.php");				
			}else{
				$bread_crumb->add("Order List", SITEROOT."/manage/order-management/sas-non-parent/order-list.php");				
			}
		}
		
		$bread_crumb->add("Processed Order List", '');
		echo $bread_crumb->output();
		
		
		
		 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

 
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


						$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

						$db = $dbCustom->getDbConnect(CART_DATABASE);
						
						$sql = "SELECT * 
								FROM  ctg_order
								WHERE order_state_id = '1'
								";
								
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


						if(isset($_GET['sortby'])){
							$sortby = trim(mysql_escape_string($_GET['sortby']));
							if($sortby == 'order_id'){
								$sql .= " ORDER BY order_id";		
							}
							if($sortby == 'billing_name'){
								$sql .= " ORDER BY billing_name";		
							}
							if($sortby == 'order_date'){
								$sql .= " ORDER BY order_date";		
							}
							if($sortby == 'total'){
								$sql .= " ORDER BY total";		
							}
						}else{
							$sql .= " ORDER BY order_id";					
						}

						//echo $sql;
				$result = $dbCustom->getResult($db,$sql);						


		?>
	<form id='orders_by_profile_form' name='orders_by_profile_form' action='order-list.php' method='post'>
			<div class="page_actions">
				<h2>Search Orders:</h2>
				<div class="colcontainer">
					<div class="threecols">
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
			
       			<?php echo getPagination($total_rows, $rows_per_page, $pagenum, $last, "order-management/master/order-list.php"); ?>
				<br /><br /><br />
            </div>
			<div class="data_table">
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="10%"><div onClick="sortby('order-list.php', 'order_id')">Order Number</div></th>
							<th><div onClick="sortby('order-list.php', 'billing_name')">Billing Name</div></th>
							<th><div onClick="sortby('order-list.php', 'order_date')">Order Date</div></th>
							<th width="8%"><div onClick="sortby('order-list.php', 'total')">$ Total</div></th>
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
							$block .= "<td><a href='processed-order-list.php?order_id=".$row->order_id."&process=1' class='btn btn-primary btn-small'><i class='icon-check icon-white'></i> Process</a></td></tr>"; 
						}
							echo $block;
						?>
				</table>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
