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
	
	$page_title = "Customers &amp; Orders";
	$page_group = "content-management";
	
		
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
	//start the HTML
	require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<!-- Page-Specific JS Goes Here -->

</head>
<body>
<?php 
	//the header and top navigation portion of the template
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
		<div class="manage_side_nav">
			<?php 
		//the side navigation portion of the template
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
		</div>
		<div class="manage_main"> 
			<!-- begin main content area -->
			
			<h1>Customers &amp; Orders</h1>
			<?php
			require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Customers", SITEROOT."//manage/customer-landing.php");
			echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>
                    
					<?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>

                        <?php if(getProfileType($dbCustom) == "master"){ ?>
                        <li><a class="landingbtn orders" 
                        href="<?php echo SITEROOT;?>/manage/order-management/master/order-list.php?ret_page=customer-landing"><span>Orders</span></a></li>
                        <li><a class="landingbtn transactions" 
                        href="<?php echo SITEROOT;?>/manage/order-management/master/transaction-list.php?ret_page=customer-landing"><span>Transactions</span></a></li>
                        
                        
                            <li><a class="landingbtn orders" 
                            href="<?php echo SITEROOT;?>/manage/order-management/master/failed-order-list.php?ret_page=customer-landing"><span>Failed Orders</span></a></li>

                        
						<?php }elseif(getProfileType($dbCustom) == "parent"){ ?>
                        
                        <li><a class="landingbtn orders" href="<?php echo SITEROOT;?>/manage/order-management/sas-parent/order-list.php?ret_page=customer-landing"><span>Orders</span></a></li>
                        
						<?php }else{ ?>        

                            <li><a class="landingbtn orders" 
                            href="<?php echo SITEROOT;?>/manage/order-management/sas-non-parent/order-list.php?ret_page=customer-landing"><span>Orders</span></a></li>


                        <?php } ?>

                    <?php } ?>

                    
 				</ul>
			</div>
			<!-- end main content area --> 
		</div>
		<p class="clear"></p>
	<?php 
	//the footer portion of the template
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
		
	
	
?>
</div>
</body>
</html>