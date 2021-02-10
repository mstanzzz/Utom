<?php

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

$msg = '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(isset($_POST['edit_design_email'])){

	$to_cust_email_body = addslashes($_POST['to_cust_email_body']);

	$stmt = $db->prepare("UPDATE design_email_content
						SET to_cust_email_body = ?
						WHERE profile_account_id = ?");
						
						//print_r($stmt);						
						//echo 'Error '.$db->error;						
	
	if(!$stmt->bind_param('si'
						,$to_cust_email_body
						,$_SESSION['profile_account_id'])){
			
				//echo 'Error-2 '.$db->error;
					
	}else{
		$stmt->execute();
		$stmt->close();

		$msg = 'Design Request Email Content Updated';		
	}

}


if(isset($_POST['edit_in_home_consult_email'])){

	$content = addslashes($_POST['content']);

	$stmt = $db->prepare("UPDATE consult_email_content
						SET content = ?
						WHERE profile_account_id = ?");
						
						//print_r($stmt);						
						//echo 'Error '.$db->error;						
	
	if(!$stmt->bind_param('si'
						,$content
						,$_SESSION['profile_account_id'])){
			
				//echo 'Error-2 '.$db->error;
					
	}else{
		$stmt->execute();
		$stmt->close();

		$msg = 'Design Request Email Content Updated';		
	}

}




	
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
	
$progress = new SetupProgress;
$module = new Module;
	
$page_title = "email content";
$page_group = "email content";
	
	
	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>

</head>
<body>
<?php 
	//the header and top navigation portion of the template
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
		<div class="manage_side_nav">
		<?php 
		//the side navigation portion of the template
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
		</div>
		<div class="manage_main"> 
			<!-- begin main content area -->
            
            <div style="color:#03F; font-size:24px;"><?php echo $msg; ?></div>
			
			<h1>Email Content</h1>
			<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Email Content", '');
        	echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>
					<li><a class="landingbtn designtools" href="<?php echo $ste_root;?>/manage/cms/email-content/design-request-email.php"><span>Design Request Email</span></a></li>
                    
                    <li><a class="landingbtn designtools" href="<?php echo $ste_root;?>/manage/cms/email-content/in-home-consult-email.php"><span>In Home Consult Email</span></a></li>
                    
				</ul>
			</div>
			<!-- end main content area --> 
		</div>
		<p class="clear"></p>
	<?php 
	//the footer portion of the template
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>