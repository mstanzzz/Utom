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
$page_title = "start";
	
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
if(isset($_GET["nl"])){
	$msg = "You have been redirected from a restricted area.";	
}

/*
$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "UPDATE user
		SET user_type_id = '7'
		WHERE username = 'mark.stanz@gmail.com'";
$result = $dbCustom->getResult($db,$sql);	

$sql = "UPDATE user
		SET user_type_id = '7'
		WHERE username = 'admin'";
$result = $dbCustom->getResult($db,$sql);	
*/


//echo "REQUEST_URI  ".$_SERVER['REQUEST_URI'];
//echo "<br />";
//echo "DOCUMENT_ROOT  ".$_SERVER['DOCUMENT_ROOT'];
//echo "<br />";


/*
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "UPDATE page_seo 
		SET page_name = 'free-in-home-consults'
		WHERE page_name = 'in-home-consultation';"; 
$result = $dbCustom->getResult($db,$sql);
$sql = "SELECT page_name FROM page_seo WHERE page_name LIKE '%in-home%'"; 
$result = $dbCustom->getResult($db,$sql);
echo $result->num_rows;
while($row = $result->fetch_object()){
	echo $row->page_name;
	echo "<br />";	
}
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "UPDATE page_seo 
		SET page_name = 'diy_instructions'
		WHERE page_name = 'installation';"; 
$result = $dbCustom->getResult($db,$sql);

$sql = "SELECT page_name FROM page_seo WHERE page_name LIKE '%inst%'"; 
$result = $dbCustom->getResult($db,$sql);
echo $result->num_rows;
while($row = $result->fetch_object()){
	echo $row->page_name;
	echo "<br />";	
}


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "UPDATE page_seo 
		SET page_name = 'we-design'
		WHERE page_name = 'design';"; 
$result = $dbCustom->getResult($db,$sql);



$sql = "SELECT page_name FROM page_seo WHERE page_name LIKE '%design%'"; 
$result = $dbCustom->getResult($db,$sql);
echo $result->num_rows;
while($row = $result->fetch_object()){
	echo $row->page_name;
	echo "<br />";	
}

*/

require_once('admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function(){
	
	$("#vvv").hide();
	
	$("#vvvv").click(function () {
		$("#vvv").show();
	});
	
	
	$(".show_more").click(function (e) {
		e.preventDefault();
		$(this).closest("ul").find(".hidden_dash").fadeIn("fast");
		$(this).closest("li").hide();
		var om = parseFloat($(".dashboard_buttons > li").css("margin-bottom").replace(/[^0-9\.]+/g, ''));
		var sm = 150;
		$(this).closest("ul").find(".hidden_dash").each(function(){
			sm = sm + 23;
		});
		if (om > sm){
			sm = om;	
		}
		$(".dashboard_buttons > li").css("margin-bottom",sm+"px");
	});
	
/*	
	$('#tabs div').hide(); // Hide all divs
	$('#tabs div:first').show(); // Show the first div
	$('#tabs ul li:first').addClass('active'); // Set the class of the first link to active
	$('#tabs ul li a').click(function(){ //When any link is clicked
		$('#tabs ul li').removeClass('active'); // Remove active class from all links
		$(this).parent().addClass('active'); //Set clicked link class to active
		var currentTab = $(this).attr('href'); // Set variable currentTab to value of href attribute of clicked link
		$('#tabs div').hide(); // Hide all divs
		$(currentTab).show(); // Show div with id equal to variable currentTab
		return false;
	});
	
*/	
	
	
});
</script>
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
		<br />
		<br />
		<a href="cms/pages/static/">Atom Solutions Pages</a>
		<br />
		<a href="<?php echo SITEROOT; ?>manage/svg/">SVG</a>
		<br />
		<a href="<?php echo SITEROOT; ?>manage/manage-images.php">Images</a>
		<br />
		<br />
		<a href="<?php echo SITEROOT; ?>manage/transactions/">transactions</a>
		<br />

		<!--
		
		<br />
		<a href="test/img-test.php">Image Test</a>

		<br />
		<br />
		<a href="test/speed.php">Speed Test</a>
		<br />
		<br />
		-->
	
        <?php if($msg != ''){ ?>  
		<div class="alert">
           	<span class="fltlft"><i class="icon-warning-sign"></i></span><?php  echo $msg; ?>
        </div>  
        <?php } ?>
        
        <ul class="dashboard_buttons clearfix">
			<?php if($admin_access->cms_level > 0){?>
			<li><a class="dashbtn cms" href="cms/cms-landing.php"><span>Content Management</span></a>
				<ul>
<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/cms/logo/logo.php" title="<?php echo $tool_tip_logo; ?>">Logo Image</a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/navigation/navbar.php" title="<?php echo $tool_tip_navigation; ?>">Navigation</a></li>
<li><a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" title="<?php echo $tool_tip_pages; ?>">Pages</a></li>
					<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/cms/blog/blog.php" title="<?php echo $tool_tip_blog; ?>">Blog Posts</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/cms/seo/seo.php" title="<?php echo $tool_tip_seo; ?>">SEO/Breadcrumbs</a></li>
					<li><a class="show_more" href="#">More...</a></li>
		
				</ul>
			</li>
			<?php } 
			if($admin_access->product_catalog_level > 0){?>
			<li><a class="dashbtn catalog" href="catalog/catalog-landing.php"><span>Product Catalog</span></a>
				<ul>
					<li><a href="<?php echo SITEROOT;?>/manage/catalog/categories/category-tree.php" title="<?php echo $tool_tip_cart_cat; ?>">Manage Categories</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/catalog/products/item.php" title="<?php echo $tool_tip_cart_item; ?>">Products</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/catalog/attributes/attribute.php" title="<?php echo $tool_tip_attributes; ?>">Product Attributes</a></li>
					<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/catalog/reviews/item-review.php" title="<?php echo $tool_tip_reviews; ?>">Product Reviews</a></li>
					<li><a class="show_more" href="#">More...</a></li>
				</ul>

			</li>
			<?php } 
			if($admin_access->ecommerce_level > 0){
			?>
            <li><a class="dashbtn ecommerce" href="ecomsettings/ecommerce-landing.php"><span>Ecommerce Settings </span></a>
				<ul>
					<li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/global-discount.php" title="<?php echo $tool_tip_discounts; ?>">Discount Settings</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/showroom-banner.php" title="<?php echo $tool_tip_banners; ?>">Showroom Page Banners</a></li>
					<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/ecomsettings/shop-banner.php" title="<?php echo $tool_tip_banners; ?>">Shopping Page Banners</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/ship-carrier.php" title="<?php echo $tool_tip_shipping; ?>" >Shipping Options</a></li>			
					
					<?php if($module->hasCustomPaymentProcessorModule($_SESSION['profile_account_id'])){ ?>
                    <li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/ecomsettings/payment-processor.php" 
                    title="<?php echo $tool_tip_payment_processor; ?>">Payment Processor</a></li>
					<?php } ?>
					
                    <li><a class="show_more" href="#">More...</a></li>
				</ul>
			</li>
			<?php } 
			if($admin_access->customers_orders_level > 0){?>
			<li><a class="dashbtn custord" href="customer-landing.php"><span>Customers &amp; Orders</span></a>
				<ul id="crm_subnavigation" <?php echo multipleDirectories($custord_open,1); ?>>
					<li><a href="<?php echo SITEROOT;?>/manage/customer/customer-list.php" title="<?php echo $tool_tip_customers; ?>">Customers</a></li>
					<?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>
						<?php if(getProfileType($dbCustom) == "master"){ ?>
						<li><a href="<?php echo SITEROOT;?>/manage/order-management/master/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>
						<li><a href="<?php echo SITEROOT;?>/manage/order-management/master/transaction-list.php" title="<?php echo $tool_tip_transactions; ?>" >Transaction List</a></li>
						<?php }elseif(getProfileType($dbCustom) == "parent"){ ?>
						<li><a href="<?php echo SITEROOT;?>/manage/order-management/sas-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>
						<?php }else{ ?>        
						<li><a href="<?php echo SITEROOT;?>/manage/order-management/sas-non-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>            
						<?php } ?>
					<?php } ?>
				</ul>

			</li>
			
			
			<?php } 
			
			//if($module->hasAskModule($_SESSION['profile_account_id'])){
				if(0){
				if(1){?>
					<li><a class="dashbtn designers" href="social/social-landing.php"><span>Social Network</span></a>
						<ul>
							<li><a href="<?php echo SITEROOT;?>/manage/social/member-profiles.php" title="<?php echo $tool_tip_designers; ?>">Member Profiles</a></li>
							<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/social/member-skills.php" title="<?php echo $tool_tip_attributes; ?>">Member Attributes</a></li>
							<li><a href="<?php echo SITEROOT;?>/manage/social/social-categories.php" title="<?php echo $tool_tip_organizerblog; ?>">Social Blog Categories</a></li>
							<li><a href="<?php echo SITEROOT;?>/manage/social/social-carousel.php" title="<?php echo $tool_tip_featured; ?>">Featured Content</a></li>
							<li><a class="show_more" href="#">More...</a></li>
						</ul>
					</li>
			<?php 
				} 
			}
			
			if($admin_access->administration_level > 0){ ?>
            <li><a class="dashbtn admin" href="admin-landing.php"><span>Administration &amp; Settings</span></a>
				<ul id="admin_subnavigation" <?php echo multipleDirectories($admin_open,1); ?>>
					<li><a href="<?php echo SITEROOT;?>/manage/general-admin/edit-company-profile.php" title="<?php echo $tool_tip_basicsettings; ?>" >Basic Settings</a></li>
					<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/general-admin/add-on-change-request.php" title="<?php echo $tool_tip_addon; ?>">Add-ons Change Request</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/general-admin/add-ons.php" title="<?php echo $tool_tip_addontoggle; ?>">Add-ons Toggle</a></li>
					<li><a href="<?php echo SITEROOT;?>/manage/admin-users/admin-users.php" title="<?php echo $tool_tip_users; ?>">Manage Users</a></li>
					<li class="hidden_dash"><a href="<?php echo SITEROOT;?>/manage/general-admin/states.php" title="<?php echo $tool_tip_locationsettings; ?>">Location Settings</a></li>			
					<li><a class="show_more" href="#">More...</a></li>
				</ul>

			</li>
			<?php }?>
		</ul>
		
	</div>


	<p class="clear"></p>
	
</div>

<?php



?>






<br />
<br />

</div>
</body>
</html>


