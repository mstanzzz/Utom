<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
	
	$progress = new SetupProgress;
	$module = new Module;
	
	$page_title = "Ecommerce Settings";
	$page_group = "ecommerce-settings";
	
		
	
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
			
			<h1>Ecommerce Settings</h1>
			<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Ecommerce", '');
        	echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>
					<li><a class="landingbtn discounts" href="<?php echo $ste_root;?>/manage/ecomsettings/global-discount.php"><span>Manage Discounts</span></a></li>
					<li><a class="landingbtn banners" href="<?php echo $ste_root;?>/manage/ecomsettings/showroom-banner.php"><span>Showroom Banners</span></a></li>
					<li><a class="landingbtn banners" href="<?php echo $ste_root;?>/manage/ecomsettings/shop-banner.php"><span>Shop Banners</span></a></li>
					<li><a class="landingbtn shipping" href="<?php echo $ste_root;?>/manage/ecomsettings/ship-carrier.php"><span>Shipping Options</span></a></li>
					<li><a class="landingbtn payment" href="<?php echo $ste_root;?>/manage/ecomsettings/payment-processor.php"><span>Payment Processor</span></a></li>
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