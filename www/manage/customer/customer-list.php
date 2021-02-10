<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_login.php');

if(!isset($lgn)){
	$lgn = new CustomerLogin;
}

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Customer List';
$page_group = 'customer';

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST['submit_add_customer'])){
	
	//print_r($_POST);
	$billing_name_first = trim(addslashes($_POST["billing_name_first"])); 
	$billing_name_last = trim(addslashes($_POST["billing_name_last"])); 
	$billing_address_one = trim(addslashes($_POST["billing_address_one"])); 
	$billing_address_two = trim(addslashes($_POST["billing_address_two"])); 
	$billing_city = trim(addslashes($_POST["billing_city"])); 
	$billing_state = trim($_POST["billing_state"]); 
	$billing_zip = trim(addslashes($_POST["billing_zip"])); 
	
	//$billing_country = trim(addslashes($_POST["billing_country"])); 
	 
	$username = trim(addslashes($_POST["username"])); 

	$shipping_name_first = trim(addslashes($_POST["shipping_name_first"])); 
	$shipping_name_last = trim(addslashes($_POST["shipping_name_last"])); 
	$shipping_address_one = trim(addslashes($_POST["shipping_address_one"])); 
	$shipping_address_two = trim(addslashes($_POST["shipping_address_two"])); 
	$shipping_city = trim(addslashes($_POST["shipping_city"])); 
	$shipping_state = trim($_POST["shipping_state"]); 
	$shipping_zip = trim(addslashes($_POST["shipping_zip"])); 
	$shipping_phone_one = trim(addslashes($_POST["shipping_phone_one"]));

	$username = trim(addslashes($_POST["username"]));
	$password = trim(addslashes($_POST["password"])); 
	
	
	if($billing_name_first != ''){
		$name = $billing_name_first.' '.$billing_name_last;
	}else{
		$name = $shipping_name_first.' '.$shipping_name_last;
	}
	

	$db_now = date('Y-m-d h:i:s');

	$username_exists = 0;

	$db = $dbCustom->getDbConnect(USER_DATABASE);

	$stmt = $db->prepare("SELECT id
						FROM user
						WHERE username = ?
						AND profile_account_id = ?"); 
	if(!$stmt->bind_param("si", $username, $_SESSION['profile_account_id'])){			
		//echo 'Error '.$db->error;			
	}else{
		
		$stmt->execute();
		
		if($stmt->fetch()){
			$username_exists = 1;
		}
	}					

	if($username_exists){
		$msg = "The supplied email address has already been used.";
	}

	if(!$username_exists){
	
		if($lgn->create_user($password, $username, $name)){
			$customer_id = $lgn->getCustId();
			
						
			$sql = "DELETE FROM customer_data WHERE user_id = '".$customer_id."'";
			$result = $dbCustom->getResult($db,$sql);
	
			$db = $dbCustom->getDbConnect(USER_DATABASE);
			$stmt = $db->prepare("INSERT INTO customer_data 
								(user_id
								,shipping_name_first 
								,shipping_name_last  
								,shipping_address_one
								,shipping_address_two
								,shipping_city
								,shipping_state
								,shipping_zip
								,shipping_phone_one
								,billing_name_first
								,billing_name_last
								,billing_address_one
								,billing_address_two
								,billing_city 
								,billing_state 
								,billing_zip
								,email
								)
								VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			//var_dump($stmt);
			//echo 'Error '.$db->error;						
					
			if(!$stmt->bind_param("issssssssssssssss"
							,$customer_id
							,$shipping_name_first 
							,$shipping_name_last  
							,$shipping_address_one
							,$shipping_address_two
							,$shipping_city
							,$shipping_state
							,$shipping_zip
							,$shipping_phone_one
							,$billing_name_first
							,$billing_name_last
							,$billing_address_one
							,$billing_address_two
							,$billing_city 
							,$billing_state 
							,$billing_zip
							,$username)){
				
				echo 'Error '.$db->error;
				
			}else{
				$stmt->execute();
				
			}
	
		}
	}

}

if(isset($_POST['email_customer'])){
	
	$block = 0;
	
	$email_body = trim(addslashes($_POST['email_body']));
	$customer_id = trim(addslashes($_POST['customer_id']));
	$email_subject = trim(addslashes($_POST['email_subject']));
	$company_email = trim(addslashes($_POST['company_email']));
	
	$name_first = trim(addslashes($_POST['name_first']));
	$name_last = trim(addslashes($_POST['name_last']));

	$username = trim(addslashes($_POST['username']));
	
	if(1){
		
		$db = $dbCustom->getDbConnect(SITE_DATABASE);
		
		$message = '';
		$message .= '<html>';
		$message .= '<head>';
		$message .= '<title>Customer Contact</title>';
		$message .= '</head>';
		$message .= '<body>';
	
			//$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
			//$message .= "<font color='#000000'></font>";
			//$message .= "</div><br />";
			
		if($email_body != ''){
			$message .= "<div style='float:left; width:140px; text-align:right;'></div>";
			$support_issue = str_replace('\r\n', '<br />', $email_body); 
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'>".stripAllSlashes($email_body)."</div>";
			$message .= "<div style='clear:both;'></div>";							
		}	
		
		$message .= '</div><br /><br />';
		$message .= '</body>';
		$message .= '</html>';
		
		$to  = $username;	
		
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: $company_email";
		$headers .= "\r\n";
		$headers .= "Return-path: help@closetstogo.com";	
		//$headers .= "\r\n";
		//$headers .= "CC: mark.stanz@gmail.com";		
		//$headers .= "\r\n";
		//$headers .= "Bcc: mike@closetstogo.com";
		//$to = "services@closetstogo.com";
		//$to = "mark.stanz@gmail.com";
		error_reporting(0);
		if(!mail($to, $email_subject, $message, $headers)){
		}
		$smsg = 'Your message has been submitted';
	}else{
		if($spam_result != ''){		
			$smsg = 'This action was aborted because spam was detected in the content';
		}else{
			//$smsg = 'This action was aborted';	
		}
	}
}





if(isset($_POST['submit_edit_customer'])){


	$db = $dbCustom->getDbConnect(USER_DATABASE);		
	
	$customer_id = trim(addslashes($_POST['customer_id']));
/*	
	$name = trim(addslashes($_POST['name'])); 
	$username = trim(addslashes($_POST['username'])); 
	
	$address_one = trim(addslashes($_POST['address_one'])); 
	$address_two = trim(addslashes($_POST['address_two'])); 
	$city = trim(addslashes($_POST['city'])); 
	$state = trim($_POST['state']); 
	$zip = trim(addslashes($_POST['zip'])); 
	$phone_one = trim(addslashes($_POST['phone_one'])); 
	$phone_two = trim(addslashes($_POST['phone_two'])); 
	*/
	
	$username = trim(addslashes($_POST['username']));
	
	$shipping_name_first = trim(addslashes($_POST['shipping_name_first']));
	$shipping_name_last = trim(addslashes($_POST['shipping_name_last'])); 
	$shipping_address_one = trim(addslashes($_POST['shipping_address_one'])); 
	$shipping_address_two = trim(addslashes($_POST['shipping_address_two'])); 
	$shipping_city = trim(addslashes($_POST['shipping_city'])); 
	$shipping_state = trim($_POST['shipping_state']); 
	$shipping_zip = trim(addslashes($_POST['shipping_zip'])); 
	$shipping_phone_one = trim(addslashes($_POST['shipping_phone_one'])); 
	$billing_name_first = trim(addslashes($_POST['billing_name_first']));
	$billing_name_last = trim(addslashes($_POST['billing_name_last'])); 
	$billing_address_one = trim(addslashes($_POST['billing_address_one'])); 
	$billing_address_two = trim(addslashes($_POST['billing_address_two'])); 
	$billing_city = trim(addslashes($_POST['billing_city'])); 
	$billing_state = trim($_POST['billing_state']); 
	$billing_zip = trim(addslashes($_POST['billing_zip'])); 
	
	if($billing_name_first != ''){
		$name = $billing_name_first.' '.$billing_name_last;
	}else{
		$name = $shipping_name_first.' '.$shipping_name_last;
	}
	
	if(trim($name) != ''){	
		$sql = sprintf("UPDATE user SET name = '%s', username = '%s' WHERE id = '%u'", $name, $username, $customer_id);  
	}else{
		$sql = sprintf("UPDATE user SET username = '%s' WHERE id = '%u'", $username, $customer_id);  		
	}
	
	
	$result = $dbCustom->getResult($db,$sql);
	
	
	
	$sql = "SELECT id FROM customer_data WHERE user_id = '".$customer_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
			
		$sql = sprintf("UPDATE customer_data 
				   SET shipping_name_first = '%s'
					,shipping_name_last = '%s' 
					,shipping_address_one = '%s'
					,shipping_address_two = '%s'
					,shipping_city = '%s'
					,shipping_state = '%s'
					,shipping_zip = '%s'
					,shipping_phone_one = '%s'
					,billing_name_first = '%s'
					,billing_name_last = '%s'
					,billing_address_one = '%s'
					,billing_address_two = '%s'
					,billing_city = '%s' 
					,billing_state = '%s' 
					,billing_zip = '%s'
					WHERE user_id = '%u'", 
					$shipping_name_first
					,$shipping_name_last
					,$shipping_address_one
					,$shipping_address_two
					,$shipping_city
					,$shipping_state
					,$shipping_zip
					,$shipping_phone_one
					,$billing_name_first
					,$billing_name_last
					,$billing_address_one
					,$billing_address_two
					,$billing_city
					,$billing_state
					,$billing_zip
					,$customer_id);
		
		
			
		$result = $dbCustom->getResult($db,$sql);
		
	
	}else{

		$sql = sprintf("INSERT INTO customer_data 
					(user_id
					,shipping_name_first
					,shipping_name_last
					,shipping_address_one
					,shipping_address_two
					,shipping_city
					,shipping_state
					,shipping_zip
					,shipping_phone_one
					,billing_name_first
					,billing_name_last
					,billing_address_one
					,billing_address_two
					,billing_city
					,billing_state
					,billing_zip) 
					VALUES 
	('%u','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
					$customer_id
					,$shipping_name_first
					,$shipping_name_last
					,$shipping_address_one
					,$shipping_address_two
					,$shipping_city
					,$shipping_state
					,$shipping_zip
					,$shipping_phone_one
					,$billing_name_first
					,$billing_name_last
					,$billing_address_one
					,$billing_address_two
					,$billing_city
					,$billing_state
					,$billing_zip);

		$result = $dbCustom->getResult($db,$sql);
		

	}
	
}



if(isset($_POST['del_cust_id'])){

	
	
	$db = $dbCustom->getDbConnect(USER_DATABASE);


	$sql = "DELETE FROM user WHERE id = '".$_POST['del_cust_id']."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM customer_data WHERE user_id = '".$_POST['del_cust_id']."'";
	$result = $dbCustom->getResult($db,$sql);

}

//$objPHPExcel = new PHPExcel(); 
unset($_SESSION['paging']);
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
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

</script>
</head>
<body>



<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
		$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
$s_profile_account_id = (isset($_REQUEST['s_profile_account_id'])) ? $_REQUEST['s_profile_account_id'] : $_SESSION['profile_account_id'];	
$s_customer_id = (isset($_REQUEST['s_customer_id'])) ? trim($_REQUEST['s_customer_id']) : 0;	
$search_str = (isset($_REQUEST["search_string"])) ?  trim(addslashes($_REQUEST["search_string"])) : ''; 
	
		$db = $dbCustom->getDbConnect(USER_DATABASE);		

/*
		$sql = "SELECT id
				FROM user
				WHERE profile_account_id = '0'";
		$res = $dbCustom->getResult($db,$sql);
		while($r = $res->fetch_object()){
			$sql = "DELETE 
					FROM  customer_data
					WHERE user_id = '".$r->id."'";
			$ttres = $dbCustom->getResult($db,$sql);
		}

		$sql = "DELETE 
				FROM  user
				WHERE profile_account_id = '0'";

		$res = $dbCustom->getResult($db,$sql);
*/		



		$sql = "SELECT id, name, created, visited, username
				FROM  user
				WHERE profile_account_id = '".$s_profile_account_id."'
				AND user_type_id < '7'";


		if($search_str != ''){			
			$sql .= " AND (name like '%".$search_str."%' OR  username like '%".$search_str."%' )" ;
		}
		if($s_customer_id > 0){
			$sql .= " AND id = '".$s_customer_id."'" ;			
		}
		
		$nmx_res = $dbCustom->getResult($db,$sql);
	
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
		
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
						
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;


		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY name DESC".$limit;
				}else{
					$sql .= " ORDER BY name ".$limit;		
				}
			}
			if($sortby == 'username'){
				if($a_d == 'd'){
					$sql .= " ORDER BY username DESC".$limit;
				}else{
					$sql .= " ORDER BY username ".$limit;		
				}
			}
			if($sortby == 'created'){
				if($a_d == 'd'){
					$sql .= " ORDER BY created DESC".$limit;
				}else{
					$sql .= " ORDER BY created ".$limit;		
				}
			}
			if($sortby == 'visited'){
				if($a_d == 'd'){
					$sql .= " ORDER BY visited DESC".$limit;
				}else{
					$sql .= " ORDER BY visited ".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY id ".$limit;					
		}
					
		$result = $dbCustom->getResult($db,$sql);	
		
		
		?>
		<form name="search_form" action="customer-list.php" method="post" enctype="multipart/form-data">

			<div class="page_actions">
				<div class="search_bar">
                	Search by email or name<br />
<input type="text" name="search_string" class="searchbox" placeholder="Find a Customer" />
				</div>
                
                <div class="search_bar">
                	Search by Customer ID<br />
					<input type="text" name="s_customer_id" class="searchbox" placeholder="Find a Customer" />
				</div>
                
                    
			<?php
			if($admin_access->master_level > 0){
				echo "<div class='search_bar'><select name='s_profile_account_id'>";
						$sql = "SELECT id
								,company
								,domain_name
								,active
								FROM  profile_account";
								
						$res = $dbCustom->getResult($db,$sql);
								
						while($row = $res->fetch_object()){							
							$selected = ($s_profile_account_id == $row->id) ? 'selected' : '';
							echo "<option value='".$row->id."' $selected>".$row->domain_name."</option>"; 
						}
						echo "</select></div>";
			}
			?>
                    <button type="submit" class="btn btn-primary btn-large" value="Search"><i class="icon-search icon-white"></i></button>
                </form>
			
           	<div class="threecols">
                <a href="create-customer.php" class="btn btn-primary center-block btn-large" style="width:100px;" name="create" >Create Customer</a>
                
                
                <?php
				
				$url_str = "data-file.php";
				$url_str .= "?sortby=".$sortby;
				$url_str .= "&a_d=".$a_d;
				$url_str .= "&s_profile_account_id=".$s_profile_account_id;
				$url_str .= "&s_customer_id=".$s_customer_id;
				$url_str .= "&search_str=".$search_str;
				
				echo "<a href=".$url_str.">Download</a>";
				
				?>
                
                
                
                 
			</div>
            	
                
			</div>
            <div class="clear"></div>
            <?php 
			if($total_rows > $rows_per_page){
				$uid1 = $s_customer_id;		
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "customer/customer-list.php", $sortby, $a_d, $uid1, 0, $search_str); 
				echo "<br /><br /><br />";
			}
		


		?>
   		<div class="data_table">
                <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>

           					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
           					<th <?php addSortAttr('username',true); ?>>
                            User Name
                            <i <?php addSortAttr('username',false); ?>></i>
                            </th>
           					<th <?php addSortAttr('created',true); ?>>
                            Created
                            <i <?php addSortAttr('created',false); ?>></i>
                            </th>
           					<th <?php addSortAttr('visited',true); ?>>
                            Last Visited
                            <i <?php addSortAttr('visited',false); ?>></i>
                            </th>

							<th width="9%">View /<br />Email</th>
							<th width="10%">Edit</th>
							<?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>	
                            <th width="11%">Orders</th>
                            <?php } ?>
                            <th>&nbsp;</th>
                            
						
                        </tr>
					</thead>
					<?php
					
					$block = '';
					while($row = $result->fetch_object()) {
						$block .= "<tr><td>".stripAllSlashes($row->name)."</td>";
						$block .= "<td>".$row->username."</td>";
						//$block .= "<td>".$row->id."</td>";
						$block .= "<td>".date("m/d/Y",strtotime($row->created))."</td>"; 
						$block .= "<td>".date("m/d/Y",strtotime($row->visited))."</td>"; 
						$block .= "<td><a class='btn btn-small fancybox fancybox.iframe' href='view-email-customer.php?customer_id=".$row->id."' 
						style='text-decoration:none;'><i class='icon-eye-open'></i> View</a></td>"; 
						
						$disabled = ($admin_access->customers_orders_level < 2)? "disabled" : '';
					
						$url_str = "edit-customer.php";
						$url_str .= "?customer_id=".$row->id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&s_profile_account_id=".$s_profile_account_id;
						$url_str .= "&s_customer_id=".$s_customer_id;
						$url_str .= "&search_str=".$search_str;
						

						
						$block .= "<td><a class='btn btn-primary btn-small ".$disabled." ' 
						href='".$url_str."' style='text-decoration:none;'>
						<i class='icon-cog icon-white'></i> Edit</a></td>"; 

						if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){					
							if(getProfileType() == 'master'){
								$url_dir = 'master';
							}elseif(getProfileType() == 'parent'){
								$url_dir = 'sas-parent';
							}else{
								$url_dir = 'sas-non-parent';
							}
							$block .= "<td><a class='btn btn-primary btn-small' 
							href='".SITEROOT."/manage/order-management/".$url_dir."/order-list.php?order_customer_id=".$row->id."&ret_page=customer-list&s_profile_account_id=".$s_profile_account_id."'>
							<i class='icon-shopping-cart icon-white'></i> Orders</a></td>";
						}
						
						
						
						// Delete
						$disabled = '';
						$block .= "<td valign='middle'>
						<a class='btn btn-danger confirm btn-small ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$row->id."' class='itemId' value='".$row->id."' /></a></td>";
						
						
						$block .= '</tr>';
					
					}
					echo $block;
					?>
				</table>
            <?php 
			if($total_rows > $rows_per_page){
				$uid1 = $s_customer_id;		
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "customer/customer-list.php", $sortby, $a_d, $uid1, 0, $search_str); 
			}

			?>

			</div>
	</div>
    
    <?php
	$url_str = "customer-list.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
    ?>
    
    <div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this customer?</h3>
	<form name="del_category" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_cust_id" class="itemId" type="hidden" name="del_cust_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_cust" type="submit" >Yes, Delete</button>
	</form>
	</div>

    
    
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/includes/manage-footer.php');
?>
</div>
<div style="display:none">
	<div id="edit" style="width:900px; height:620px;"> </div>
</div>
</body>
</html>
