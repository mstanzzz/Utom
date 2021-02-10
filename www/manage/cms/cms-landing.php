<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
	
$page_title = "Content Management";
$page_group = "content-management";
	
	

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
<!-- Page-Specific JS Goes Here -->

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
        ?>
		</div>
		<div class="manage_main"> 
			<h1>Content Management</h1>
			<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", $ste_root.$_SERVER['REQUEST_URI']);
        echo $bread_crumb->output();
		
				
//$man_root."start.php";

//echo "$ste_root ".$ste_root;

			
		
         	?>			
			<div class="subnav_buttons">

subnav_buttons
				<ul>

<li><a href="<?php echo $ste_root;?>manage/cms/logo/logo.php"  class="landingbtn logoimg"><span>Logo Image</span></a></li>
<li><a href="<?php echo $ste_root;?>manage/cms/navigation/navbar.php" class="landingbtn logoimg"><span>Navigation</span></a></li>
<li><a href="<?php echo $ste_root;?>manage/cms/pages/page.php" class="landingbtn pages"><span>Pages</span></a></li>
<li><a href="<?php echo $ste_root;?>manage/cms/blog/blog.php" class="landingbtn blogposts"><span>Blog Posts</span></a></li>
<?php if($module->hasSeoModule($_SESSION['profile_account_id'])){ ?>
<li><a href="<?php echo $ste_root;?>manage/cms/seo/seo.php" class="landingbtn seo"><span>SEO Settings</span></a></li>
<li><a href="<?php echo $ste_root;?>manage/cms/custom-code/custom-code.php?firstload=1"class="landingbtn"><span>Custome Code and Meta Tags</span></a></li>   
<?php } ?>
<li><a class="landingbtn" href="<?php echo $ste_root;?>manage/cms/video/video-list.php"><span>Videos</span></a></li>
<li><a class="landingbtn" href="<?php echo $ste_root;?>manage/cms/footer/edit-footer.php"><span>Footer</span></a></li>
<li><a class="landingbtn" href="<?php echo $ste_root;?>manage/cms/social-media/edit-social-media-links.php"><span>Social Media Links</span></a></li>                
<?php if($module->hasDesignServicesModule($_SESSION['profile_account_id'])){ ?>			
<li><a class="landingbtn" href="<?php echo $ste_root;?>manage/cms/design-services/design-services-pages.php"><span>Design Services</span></a></li>
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