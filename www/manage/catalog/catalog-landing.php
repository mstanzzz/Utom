<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
	
	$progress = new SetupProgress;
	$module = new Module;
	
	$page_title = "Product Catalog";
	$page_group = "cat";
	
		
	
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
        <?php
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/class.admin_bread_crumb.php');	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();		
		$bread_crumb->add($page_title, $ste_root.$_SERVER['REQUEST_URI']);
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
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>