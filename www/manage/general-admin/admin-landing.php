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
	
	$page_title = "Administration";
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
			
			<h1>Administration</h1>
			<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Administration", '');
        echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>					
					<li><a class="landingbtn password"  href="<?php echo $ste_root;?>/manage/general-admin/edit-company-profile.php"><span>Basic Settings</span></a></li>
					<li><a class="landingbtn add"  href="<?php echo $ste_root;?>/manage/general-admin/add-on-change-request.php"><span>Add-on Change Request</span></a></li>
   					<li><a class="landingbtn addtoggle"  href="<?php echo $ste_root;?>/manage/general-admin/add-ons.php"><span>Add-ons Toggle</span></a></li>
					<li><a class="landingbtn customers"  href="<?php echo $ste_root;?>/manage/admin-users/admin-users.php"><span>Manage Users</span></a></li>
					<li><a class="landingbtn location"  href="<?php echo $ste_root;?>/manage/general-admin/states.php"><span>Location Settings</span></a></li>

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