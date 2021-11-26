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

$page_title = "Failed Order List";
$page_group = "order";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

	

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");	
$lgn = new CustomerLogin;

//echo $_SERVER['DOCUMENT_ROOT'];

$order_customer_id = (isset($_REQUEST["order_customer_id"]))? $_REQUEST['order_customer_id'] : 0;

if($order_customer_id > 0){
	$cust_name = $lgn->getFullName($order_customer_id);
}else{
	$cust_name = '';	
}

$db = $dbCustom->getDbConnect(CART_DATABASE);

$ts = time();

if(isset($_POST['del_order_id'])){
	$sql = "DELETE FROM ctg_failed_order WHERE failed_order_id = '".$_POST['del_failed_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM braintree_transaction WHERE failed_order_id = '".$_POST['del_failed_order_id']."'";
	$result = $dbCustom->getResult($db,$sql);
}

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
		
		$billing_name = (isset($_POST['billing_name']))? $_POST['billing_name'] : '';
		$email = (isset($_POST['email']))? $_POST['email'] : '';
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
				FROM  ctg_failed_order
				WHERE profile_account_id = '".$s_profile_account_id."'";
				
		
		//$sql .= " AND order_state_code = '1'";		
												
		if($order_customer_id > 0){		
			$sql .= " AND customer_id = '".$order_customer_id."'";
		}
		
		if($s_order_id > 0){
			$sql .= " AND order_id = '".$s_order_id."'";
		}
		
		
		if($s_customer_id > 0){
			$sql .= " AND customer_id = '".$s_customer_id."'";
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
							 
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
							
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		if($sortby != ''){

			if($sortby == 'failed_order_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY failed_order_id DESC".$limit;
				}else{
					$sql .= " ORDER BY failed_order_id".$limit;		
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
			$sql .= " ORDER BY failed_order_id".$limit;;					
		}
		
		$result = $dbCustom->getResult($db,$sql);
		?>
		<form id='orders_by_profile_form' name='orders_by_profile_form' action='failed-order-list.php' method='post'>
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
						<input type="text" name="billing_name" value="<?php echo $cust_name; ?>"/>
                        
                        <label>Customer ID</label>
						<input type="text" name="s_customer_id" value=""/>
                        
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
            </div>
            </form>
            
			<div class="data_table">
                <?php
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "failed-order-list.php", $sortby, $a_d, $s_profile_account_id);
					echo "<br /><br /><br />";
				}
				?>


            	<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
            				<th width="5%" <?php addSortAttr('failed_order_id',true); ?>>
                            Failed Order Id
                            <i <?php addSortAttr('failed_order_id',false); ?>></i>
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
                            Total
                            <i <?php addSortAttr('total',false); ?>></i>
                            </th>
 							<!--<th>Domain</th>-->
							<th width="10%">View/Process</th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<?php
					
					require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					
					$block = '';
					while($row = $result->fetch_object()) {
							
							
							//Order Number
							$block .= "<tr><td>";
							$block .= "<a href='failed_order.php?order_id=".$row->failed_order_id."'>$row->failed_order_id</a>"; 
							
							$block .= "</td>";

							$block .= "<td>";
							//$block .= $cust_name;
							$block .= $row->billing_name; 
							$block .= "</td>";
							//Order Date
							$block .= "<td>";
							$block .= date("m/d/Y",$row->order_date); 
							$block .= "</td>";
							$profile_account_domain = '';

/*								

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

							
							
							$url_str = "failed-order.php";
							$url_str .= "?failed_order_id=".$row->failed_order_id;
							$url_str .= "&pagenum=".$pagenum;
							$url_str .= "&sortby=".$sortby;
							$url_str .= "&a_d=".$a_d;
							$url_str .= "&truncate=".$truncate;
							
							
							$block .= "<td><a href='".$url_str."' class='btn btn-small'> View </a></td>"; 
							//<i class='icon-eye-open'></i>

							$block .= '</tr>';
						}
							echo $block;
						?>
				</table>
				<?php
                if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "failed-order-list.php", $sortby, $a_d, $s_profile_account_id);
				}
				?>
			</div>
		
	</div>
    
    <?php
	$url_str = "failed-order-list.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
    ?>
    
    <div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this order and transaction?</h3>
	<form name="del_failed_order" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_failed_order_id" class="itemId" type="hidden" name="del_failed_order_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_failed_order" type="submit" >Yes, Delete</button>
	</form>
	</div>
    
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	
	
	
	?>
</div>
</body>
</html>

