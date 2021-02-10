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
	
	$page_title = "Master Administration";
	$page_group = "admin";
	
		
	
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
			
			<h1>Master Administration</h1>
			<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Master Administration", '');
        echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>					
					<?php if(getProfileType() == "master"){ ?>
					<!-- set li to class="otg-specific" to make it orange -->
   					<li><a class="landingbtn blogposts"  href="<?php echo $ste_root;?>/manage/master-admin/news.php"><span>News</span></a></li>
                    <!--
                    <li> <a class="landingbtn addcost"  href="<?php //echo $ste_root;?>/manage/master-admin/add-on-set-fees.php"><span>SaaS Add-on Fees</span></a></li>
                    -->
					<li><a class="landingbtn saascust"  href="<?php echo $ste_root;?>/manage/master-admin/sas-cust.php"><span>SaaS Customers</span></a></li>
					<li><a class="landingbtn costco"  href="<?php echo $ste_root;?>/manage/order-management/master/costco-order-list.php"><span>Costco</span></a></li>
					<?php } ?>
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