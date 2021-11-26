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
	
$page_title = "Content Management";
$page_group = "content-management";
	
unset($_SESSION['img_id']);	

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<!-- Page-Specific JS Goes Here -->

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
			<h1>Content Management</h1>
			<?php
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT.$_SERVER['REQUEST_URI']);
        echo $bread_crumb->output();
		
				
//$man_root."start.php";

//echo "SITEROOT ".SITEROOT;

			
		
         	?>			
			<div class="subnav_buttons">
	<ul>

<li><a href="<?php echo SITEROOT;?>/manage/svg/svg.php"  class="landingbtn logoimg"><span>SVG Icons</span></a></li>

<li><a href="<?php echo SITEROOT;?>/manage/cms/logo/logo.php"  class="landingbtn logoimg"><span>Logo Image</span></a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/navigation/navbar.php" class="landingbtn logoimg"><span>Navigation</span></a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" class="landingbtn pages"><span>Pages</span></a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/blog/blog.php" class="landingbtn blogposts"><span>Blog Posts</span></a></li>
<?php if($module->hasSeoModule($_SESSION['profile_account_id'])){ ?>
<li><a href="<?php echo SITEROOT;?>/manage/cms/seo/seo.php" class="landingbtn seo"><span>SEO Settings</span></a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/custom-code/custom-code.php?firstload=1"class="landingbtn"><span>Custome Code and Meta Tags</span></a></li>   
<?php } ?>
<li><a class="landingbtn" href="<?php echo SITEROOT;?>/manage/cms/video/video-list.php"><span>Videos</span></a></li>
<li><a class="landingbtn" href="<?php echo SITEROOT;?>/manage/cms/footer/edit-footer.php"><span>Footer</span></a></li>
<li><a class="landingbtn" href="<?php echo SITEROOT;?>/manage/cms/social-media/edit-social-media-links.php"><span>Social Media Links</span></a></li>                
<?php if($module->hasDesignServicesModule($_SESSION['profile_account_id'])){ ?>			
<li><a class="landingbtn" href="<?php echo SITEROOT;?>/manage/cms/design-services/design-services-pages.php"><span>Design Services</span></a></li>
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