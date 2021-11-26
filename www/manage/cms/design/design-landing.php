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
	
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
	//start the HTML
	require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<!-- Page-Specific JS Goes Here -->

<html lang="en">
<head>
<meta charset="utf-8">

<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/manageStyle.css?v=1" media="screen"/>
<link type="text/css" rel="stylesheet" href="<?php echo SITEROOT; ?>/css/forms.css" media="print"/>

</head>
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
			
			<h1>Design</h1>
			<?php
			require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Design Area", SITEROOT."manage/design-tool-landing.php");
			echo $bread_crumb->output();
         	?>			
			<div class="subnav_buttons">
				<ul>
                	
                    <?php if($module->hasDesignServicesModule($_SESSION['profile_account_id'])){ ?>
                   	<li><a class="landingbtn desreq" href="<?php echo SITEROOT;?>/manage/design/design-email.php?ret_page=design-tool-landing"><span>Design Requests</span></a></li>
					<li><a class="landingbtn consultreq" href="<?php echo SITEROOT;?>/manage/design/in-home-consult.php?ret_page=design-tool-landing"><span>Design Consultation</span></a></li>
    				<?php } ?>
					
					<?php if($module->hasDesignToolModule($_SESSION['profile_account_id'])){?> 
                    <li><a class="landingbtn designtools"  href="../tool/tool-landing.php" title="Coming Soon!"><span>Design Tools Settings</span></a></li>			
    				<?php } ?>
					
                     <li><a class="landingbtn designtools"  
                     href="<?php echo SITEROOT;?>/manage/design/design-req-origin-stats.php?ret_page=design-tool-landing" title="Coming Soon!"><span>Design Request Origin Statistics</span></a></li>	

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