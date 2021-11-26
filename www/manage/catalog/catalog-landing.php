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
	
	$page_title = "Product Catalog";
	$page_group = "cat";
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		
	require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
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
        <?php
		require_once($real_root.'/manage/admin-includes/class.admin_bread_crumb.php');	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();		
		$bread_crumb->add($page_title, SITEROOT.$_SERVER['REQUEST_URI']);
        echo $bread_crumb->output();
		?>
			<h1>Product Catalog</h1>
			<div class="subnav_buttons">
				<ul>
					<li><a class="landingbtn categories" href="categories/top-category.php"><span>Manage Categories</span></a></li>
					<li><a class="landingbtn products" href="products/item.php"><span>Products</span></a></li>
					<li><a class="landingbtn attributes" href="attributes/attribute.php"><span>Product Attributes</span></a></li>
                    <li><a class="landingbtn attributes" href="attributes/set-custom-attributes.php"><span>Set Custom Attributes</span></a></li>
					<li><a class="landingbtn reviews" href="reviews/item-review.php"><span>Product Reviews</span></a></li>
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