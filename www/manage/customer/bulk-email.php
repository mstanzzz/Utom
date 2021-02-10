<?php


echo "UNDER CONSTRUCTION";
exit;



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Edit Customer';
$page_group = 'customer';

	
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.saas_customer.php');





/*
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "INSERT INTO test_time
		(unix, system)
		VALUES
		('".time()."', CURRENT_TIMESTAMP)";
		
$result = $dbCustom->getResult($db,$sql);
*/








$db = $dbCustom->getDbConnect(USER_DATABASE);


$sql = "DELETE FROM user WHERE name = '' OR username = ''";
$result = $dbCustom->getResult($db,$sql);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$saas_cust = new SaasCustomer;






if(isset($_POST['email_subject'])){

echo "Do More Testing";
exit;

	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.saas_customer.php');
	$CustAccnt = new CustomerAccount;
	$saas_cust = new SaasCustomer;

	$cust_ids = (isset($_POST["cust_ids"]))? $_POST["cust_ids"] : array();
		
	$email_subject = trim(addslashes($_POST['email_subject']));
	$email_body = trim(addslashes($_POST['email_body']));
		
		
	
	$CustAccnt->unsetAllDoBulkEmail($_SESSION['profile_account_id']);	
	
	
	$open_body = '';
	$open_body .= '<html>';
	$open_body .= '<head>';
	$open_body .= '<title></title>';
	$open_body .= '</head>';
	$open_body .= '<body>';
	
			
	$close_body = '</div><br /><br />';
	$close_body .= '</body>';
	$close_body .= '</html>';
		
	$company_email = $saas_cust->getCompanyEmail();
	
		
	foreach($cust_ids as $cust_id){

		$CustAccnt->setDoBulkEmail($cust_id);	
		
		$cust_data_array = $CustAccnt->getEmailData($cust_id);

		$message = $open_body;

		$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
		$message .= "<font color='#000000'>Hello ".$cust_data_array['name']."</font>";
		$message .= "</div><br />";

		$message .= "<div style='float:left; width:140px; text-align:right;'></div>";
		$support_issue = str_replace('\r\n', '<br />', $email_body); 
		$message .= "<div style='float:left; padding-left:12px; text-align:left;'>".stripAllSlashes($email_body)."</div>";
		$message .= "<div style='clear:both;'></div>";							
		
		$message .= $close_body;
		
		
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: $company_email";
		$headers .= "\r\n";
		$headers .= "Return-path: help@closetstogo.com";	

		//$to = $cust_data_array['username'];
		$to = 'mark.stanz@gmail.com';		
		error_reporting(0);
		if(!mail($to, $email_subject, $message, $headers)){

		}
	}


	foreach($crm_contact_ids as $crm_contact_id){

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);		
		$sql = "SELECT name, email
				FROM  crm_contact_id
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);	

		while($row = $result->fetch_object()) {

			$message = $open_body;
	
			$message .= "<div style='background:#efefef; width:100%; padding:8px;'>";
			$message .= "<font color='#000000'>Hello ".$row->name."</font>";
			$message .= "</div><br />";
	
			$message .= "<div style='float:left; width:140px; text-align:right;'></div>";
			$support_issue = str_replace('\r\n', '<br />', $email_body); 
			$message .= "<div style='float:left; padding-left:12px; text-align:left;'>".stripAllSlashes($email_body)."</div>";
			$message .= "<div style='clear:both;'></div>";							
			
			$message .= $close_body;
			
			
			$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: $company_email";
			$headers .= "\r\n";
			$headers .= "Return-path: help@closetstogo.com";	
	
			//$to = $row->email;
			$to = 'mark.stanz@gmail.com';		
			error_reporting(0);
			if(!mail($to, $email_subject, $message, $headers)){
	
			}

		}

	}

}

if(isset($_GET['unset_all'])){

	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
	$CustAccnt = new CustomerAccount;
	$CustAccnt->unsetAllDoBulkEmail($_SESSION['profile_account_id']);	

}

if(isset($_GET['set_all'])){

	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
	$CustAccnt = new CustomerAccount;
	$CustAccnt->setAllDoBulkEmail($_SESSION['profile_account_id']);	

}



if(isset($_POST["del_email"])){

		$crm_contact_id = $_POST['del_email_id'];

//echo $crm_contact_id;

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = sprintf("DELETE FROM crm_contact WHERE crm_contact_id = '%u'", $crm_contact_id);
		$result = $dbCustom->getResult($db,$sql);
		

}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>

<script>
	tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,code",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		forced_root_block : false

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
		
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		$search_str = isset($_REQUEST['search_str']) ? trim(addslashes($_REQUEST['search_str'])) : '';
		
		if(isset($_REQUEST["date_from"])){
			$date_from = strpos($_REQUEST['date_from'], '/') ? strtotime(trim($_REQUEST['date_from'])) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_REQUEST['date_to'])){
			$date_to = strpos($_REQUEST['date_to'], '/') ? strtotime(trim($_REQUEST['date_to'])) : '';
		}else{
			$date_to = ''; 
		}
        ?>
	</div>
	<div class="manage_main">

		<a href="bulk-email.php?unset_all=1">Unset All</a>
		<a href="bulk-email.php?set_all=1">Set All</a>

    	<form name="form" action="bulk-email.php" method="post" enctype="multipart/form-data">
        
        <div class="colcontainer"> 
			<label>Email Subject</label>
            <input type="text" name="email_subject" style="width:80%" />
		</div>
        
        <div class="colcontainer"> 
			<label>Email Body</label>
            <textarea class="wysiwyg" name="email_body" style="width:80%"></textarea>
		</div>
        
        <input type="submit" name="submit" value="Submit" class="btn btn-large btn-primary"> 
		
        <br />        
        Select who gets this email
        <br />
		<table width="100%">
				<tr>
   					<th width="25%">Name</th>
					<th width="25%">Email Address</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>						
				</tr>
			<?php
			$db = $dbCustom->getDbConnect(USER_DATABASE);		
			$sql = "SELECT id, name, created, visited, username, do_bulk_email
					FROM  user
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
			$result = $dbCustom->getResult($db,$sql);			
			
			$email_array = array();		
			$block = '';
			
			while($row = $result->fetch_object()) {
				
				$email_array[] = $row->username;
	
				$block .= '<tr>';
				$block .= '<td>'.stripAllSlashes($row->name).'</td>';

				$block .= '<td>'.$row->username.'</td>';
				

				$checked = ($row->do_bulk_email)? "checked='checked'" : '';
				$block .= "<td><div class='checkboxtoggle on'> 
				<span class='ontext'>ON</span><a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='cust_ids[]' value='".$row->id."' $checked />
				</div></td>";
				
				$block .= '<td>&nbsp;</td>';

				$block .= '</tr>';

			}
			
			echo $block;
			
			$block = '';
			

			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);		
			$sql = "SELECT crm_contact_id, name, email
					FROM  crm_contact
					WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
					ORDER BY crm_contact_id";
			$result = $dbCustom->getResult($db,$sql);	

			while($row = $result->fetch_object()) {
				
				/*
				if(strlen($row->name) > 39){
					
					$sql = sprintf("DELETE FROM crm_contact WHERE crm_contact_id = '%u'", $row->crm_contact_id);
					$res = $dbCustom->getResult($db,$sql);
					
				}
				*/
				
				
				if(!inArray($row->email, $email_array)){

					$block .= '<tr>';
					
					$block .= '<td>'.stripAllSlashes(trim($row->name)).'</td>';
	
					$block .= '<td>'.trim($row->email).'</td>';
	
					$checked =  "checked='checked'";
					$block .= "<td><div class='checkboxtoggle on'> 
					<span class='ontext'>ON</span><a class='switch on' href='#'></a>
					<span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='crm_contact_ids[]' value='".$row->crm_contact_id."' $checked />
					</div></td>";
					
					$block .= "<td valign='middle'>";
					$block .= "<a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->crm_contact_id."' class='itemId' value='".$row->crm_contact_id."' /></a></td>";
	
					$block .= '</tr>';

				}
			}
			
			echo $block;
			
			?>

		</table>
        
        </form>
        
	</div>

	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	
	$url_str = "bulk-email.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
	
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this?</h3>
	<form name="del_email" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_email_id" class="itemId" type="hidden" name="del_email_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_email" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
