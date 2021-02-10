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
	
	$progress = new SetupProgress;
	$module = new Module;
	
	$page_title = "Customers &amp; Orders";
	$page_group = "content-management";
	
		
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
	//start the HTML
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<!-- Page-Specific JS Goes Here -->

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
			
			<h1>Customers &amp; Orders</h1>
			<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Customers", $ste_root."manage/customer-landing.php");
			echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>
					<li><a class="landingbtn customers" href="<?php echo $ste_root;?>/manage/customer/customer-list.php?ret_page=customer-landing"><span>Customers</span></a></li>
                    

	                <li><a class="landingbtn" href="<?php echo $ste_root;?>/manage/general-admin/contact-email.php?ret_page=customer-landing"><span>Contact Emails</span></a></li>

	                <li><a class="landingbtn" href="<?php echo $ste_root;?>/manage/customer/bulk-email.php?ret_page=customer-landing"><span>Bulk Emails</span></a></li>
                    
                    <!--
                    <li><a class="landingbtn" href="<?php echo $ste_root;?>/manage/customer/site-user-data.php?ret_page=customer-landing"><span>Site User Data</span></a></li>
                    -->
                    
                    <li><a class="landingbtn" href="<?php echo $ste_root;?>/manage/general-admin/testimonial-list.php?ret_page=testimonial"><span>Testimonials</span></a></li>
                    
                     <li><a class="landingbtn" href="<?php echo $ste_root;?>/manage/general-admin/feedback.php?ret_page=feedback"><span>Feedback</span></a></li>
                    
                    
                     
                    
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