
<script type="text/javascript">
// Management Navigation Script

$(document).ready(function() {
	$("#manage_navigation > li > a").click(function(e){
		if(!$(this).hasClass("active") && ! $(this).hasClass('dashlink')){
			var currentNav = $(this).find("ul");
			$("#manage_navigation li ul").not(currentNav).slideUp('fast');
			$(this).parent("li").find("ul").slideDown('fast');
			$(this).find("ul").slideDown('fast');
			$("#manage_navigation > li > a.active").removeClass("active");
			$(this).addClass("active");
		}
	});
	$("#manage_navigation .circle").click(function () {
    var icon = $(this).find("i");
    if ($(icon).hasClass("icon-plus-sign")) {
        $(icon).removeClass("icon-plus-sign").addClass("icon-minus-sign");
        $(this).parent("li").find("ul").slideDown('fast');
    } else {
        $(icon).removeClass("icon-minus-sign").addClass("icon-plus-sign");
        $(this).parent("li").find("ul").slideUp('fast');
    }
	});
	$("#manage_navigation a").tooltip({placement: 'right',delay: { show: 700, hide: 100 }});
});
</script>
<?php 
/*
echo "profile_account_id  ".$_SESSION['profile_account_id'];
echo "<br />";
echo "PaymentProcessorModule ".$module->hasCustomPaymentProcessorModule($_SESSION['profile_account_id']);
echo "<br />";
echo "ShoppingCartModule ".$module->hasShoppingCartModule($_SESSION['profile_account_id']);
echo "<br />";
echo "getProfileType   ".getProfileType();
	
*/	
	
	if(!isset($current_page)){
		$parts = Explode('/', $_SERVER["PHP_SELF"]);
		$current_page = $parts[count($parts) - 1];	
		$current_dir = $parts[count($parts) - 2];	
		$current_up_dir = $parts[count($parts) - 3];			
	}
	
	
	function setActive($href) 
	{
		global $current_page;
		if($current_page === $href){
			return " class='active'";	
		}else {
			return '';	
		}
	}

/*
	function setActive($href) 
	{
		//get current page URI
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos($uri,$href) > 0){
			return " class='active'";	
		}
		else {
			return '';	
		}
	}
*/
	//echo _setActive("navbar");
	//echo "<br />";
	//echo setActive("navbar");
	//echo "<br />";
	
	
	// Some Parent Navigation items contain children links in multiple directories.
	function multipleDirectories($arr,$class){
		foreach($arr as $href){
			if(strpos($_SERVER['REQUEST_URI'],$href) !== false){	
				if ($class){
					return " class='active'";
					break;
				}
				else {
					return "<i class='icon-minus-sign icon-white'></i>";
					break;
				}
			}
			else if (!$class){
				return "<i class='icon-plus-sign icon-white'></i>";	
			}
		}
	}
	
	
	$cms_open = array("/cms/");

	$catalog_open = array("/catalog/");

	$ecom_open = array("/ecomsettings/");
	
	$custord_open = array("/customer/"
					,"/customer-list.php"
					,"/order-list.php"
					,"/transaction-list.php"
					,"/failed-order-list.php"
					,"/contact-email.php"
					,"/feedback.php"
					,"/process-definition.php"
					,"/edit-review-email.php"
					,"/transaction-list.php");

	$social_open = array("/social/");

	$admin_open = array("/edit-company-profile.php"
					,"/add-ons.php"
					,"/admin-users.php"
					,"/states.php"				
					,"/add-on-change-request.php");


	$master_admin_open = array('/master-admin/','costco');

	$design_open = array('/design');
	
	$tool_open = array('/tool');
	
	/*
	echo "<br />";
	echo "cms_level: ".$admin_access->cms_level;

	echo "<br />";
	echo "product_catalog_level: ".$admin_access->product_catalog_level;
	*/
	
	
?>
<ul id="manage_navigation">
	<li><a href="<?php echo SITEROOT;?>/manage/start.php" class='dashlink' title="Back to Dashboard">Home</a></li>
	
    
    <?php if($admin_access->cms_level > 0){ ?>
        <li><span class="circle">
			<?php echo multipleDirectories($cms_open,0); ?></span>
            <a href="<?php echo SITEROOT;?>/manage/cms/cms-landing.php" title="Content Management" <?php echo multipleDirectories($cms_open,1); ?>> Content Management</a>
            <ul <?php echo multipleDirectories($cms_open,1); ?>>			
                <li><a href="<?php echo SITEROOT;?>/manage/cms/navigation/navbar.php" title="<?php echo $tool_tip_navigation; ?>" 
				<?php echo setActive('navigation.php'); ?>>Navigation</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/cms/pages/page.php" title="<?php echo $tool_tip_pages; ?>" 
				<?php echo setActive('pages.php'); ?>>Pages</a></li>
<!--
                <li><a href="<?php echo SITEROOT;?>/manage/cms/custom-pages/add-page-landing.php" title="<?php echo $tool_tip_pages; ?>" 
				<?php echo setActive('custom-page-landing.php'); ?>>Custom Added Pages</a></li>                
-->               
                <li><a href="<?php echo SITEROOT;?>/manage/cms/blog/blog.php" title="<?php echo $tool_tip_blog; ?>" 
				<?php echo setActive('blog.php'); ?>>Blog Posts</a></li>
                <?php
                if($module->hasSeoModule($_SESSION['profile_account_id'])){
				?>
                <li><a href="<?php echo SITEROOT;?>/manage/cms/seo/seo.php" title="<?php echo $tool_tip_seo; ?>" 
				<?php echo setActive('seo.php'); ?>>SEO/Breadcrumbs</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/cms/custom-code/custom-code.php?firstload=1" title="<?php echo $tool_tip_custom_code; ?>" 
				<?php echo setActive('custom-code.php'); ?>>Custom Code / Meta tags</a></li>                
			<?php
			}
			?>
                
                
                <li><a href="<?php echo SITEROOT;?>/manage/cms/logo/logo.php" title="<?php echo $tool_tip_logo; ?>" 
				<?php echo setActive('logo.php'); ?>>Logo Image</a></li>
				
				<!--
                <li><a href="<?php echo SITEROOT;?>/manage/cms/video/video-list.php" title="<?php echo $tool_tip_video; ?>" 
				<?php echo setActive('video-list.php'); ?>>Videos</a></li> 
				-->
				
                <li><a href="<?php echo SITEROOT;?>/manage/cms/footer/edit-footer.php" title="<?php echo $tool_tip_footer; ?>" 
				<?php echo setActive('edit-footer.php'); ?>>Edit Footer</a></li>                
                <li><a href="<?php echo SITEROOT;?>/manage/cms/social-media/edit-social-media-links.php" title="<?php echo $tool_tip_social_media; ?>" 
				<?php echo setActive('edit-social-media-links.php'); ?>>Edit Social Media Links</a></li>                

                <li><a href="<?php echo SITEROOT;?>/manage/cms/keyword-landing/keyword-landing-page-list.php" title="<?php echo $tool_tip_social_media; ?>" 
				<?php echo setActive('keyword-landing-page-list.php'); ?>>Keyword Landing Pages</a></li>                

            
			<?php if($module->hasDesignServicesModule($_SESSION['profile_account_id'])){ ?>
                <li><a href="<?php echo SITEROOT;?>/manage/cms/design-services/design-services-pages.php" 
                    title="<?php echo $tool_tip_seo; ?>" <?php echo setActive('design-services-pages'); ?>>Design Services</a></li>
            <?php } ?>
           
            
           <li><a href="<?php echo SITEROOT;?>/manage/cms/email-content/email-content-landing.php" title="<?php echo $tool_tip_social_media; ?>" 
				<?php echo setActive('email-content-landing.php'); ?>>Email Content</a></li>   
                            

            </ul>
        </li>
	<?php } ?>
	
    <?php if($admin_access->product_catalog_level > 0){ ?>
        <li><span class="circle">
            <?php echo multipleDirectories($catalog_open,0); ?></span>
            <a href="<?php echo SITEROOT;?>/manage/catalog/catalog-landing.php" title="Product Catalog Management" <?php echo multipleDirectories($catalog_open,1); ?>> Product Catalog</a>
            <ul <?php echo multipleDirectories($catalog_open,1); ?>>
                <li><a href="<?php echo SITEROOT;?>/manage/catalog/categories/category-tree.php" title="<?php echo $tool_tip_cart_cat; ?>" 
				<?php echo setActive('catalog/categories.php'); ?>>Manage Categories</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/catalog/products/item.php" title="<?php echo $tool_tip_cart_item; ?>" 
				<?php echo setActive('catalog/products.php'); ?>>Products</a></li>
                
                <!--
                <li><a href="<?php //echo SITEROOT;?>/manage/catalog/attributes/attribute.php" title="<?php //echo $tool_tip_attributes; ?>" 
				<?php //echo setActive('attributes.php'); ?>>Product Attributes</a></li>
				-->

                <li><a href="<?php echo SITEROOT;?>/manage/catalog/attributes/set-custom-attributes.php" title="<?php echo $tool_tip_attributes; ?>" 
				<?php echo setActive('set-custom-attributes.php'); ?>>Product Attributes</a></li>
                
                <li><a href="<?php echo SITEROOT;?>/manage/catalog/reviews/item-review.php" title="<?php echo $tool_tip_reviews; ?>" 
				<?php echo setActive('catalog/reviews.php'); ?>>Product Reviews</a></li>

                <li><a href="<?php echo SITEROOT;?>/manage/catalog/products/custom-measurements.php" title="<?php echo $tool_tip_reviews; ?>" 
				<?php echo setActive('catalog/custom-measurements.php'); ?>>Custom Measurements</a></li>
            
            
            </ul>
        </li>
	<?php } ?>

    <?php if($admin_access->ecommerce_level > 0){ ?>
        <li><span class="circle">
            <?php echo multipleDirectories($ecom_open,0); ?></span>
            <a href="<?php echo SITEROOT;?>/manage/ecomsettings/ecommerce-landing.php" title="Ecommerce Settings and Options" <?php echo multipleDirectories($ecom_open,1); ?>> Ecommerce Settings</a>
            <ul <?php echo multipleDirectories($ecom_open,1); ?>>
                <li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/global-discount.php" title="<?php echo $tool_tip_discounts; ?>" 
				<?php echo setActive('global-discount.php'); ?>>Discount Settings</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/showroom-banner.php" title="<?php echo $tool_tip_banners; ?>" 
				<?php echo setActive('showroom-banner.php'); ?>>Showroom Page Banners</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/shop-banner.php" title="<?php echo $tool_tip_banners; ?>" 
				<?php echo setActive('shop-banner.php'); ?>>Shopping Page Banners</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/ship-carrier.php" title="<?php echo $tool_tip_shipping; ?>" 
				<?php echo setActive('ship-carrier.php'); ?>>Shipping Options</a></li>			
                <?php if($module->hasCustomPaymentProcessorModule($_SESSION['profile_account_id'])){ ?>
                <li><a href="<?php echo SITEROOT;?>/manage/ecomsettings/payment-processor.php" title="<?php echo $tool_tip_payment_processor; ?>" 
				<?php echo setActive('payment-processor.php'); ?>>Payment Processor</a></li>
                <?php } ?>
            </ul>
        </li>
	<?php } ?>

    <?php if($admin_access->customers_orders_level > 0){ ?>
        <li><span class="circle"><?php echo multipleDirectories($custord_open,0); ?></span>
            <a href="<?php echo SITEROOT;?>/manage/customer/customer-landing.php" 
            title="Manage Customers &amp; Orders" 
			<?php echo multipleDirectories($custord_open,1); ?>> Customers &amp; Orders</a>
            <ul <?php echo multipleDirectories($custord_open,1); ?>>
                <li><a href="<?php echo SITEROOT;?>/manage/customer/customer-list.php" 
                title="<?php echo $tool_tip_customers; ?>" <?php echo setActive('customer-list.php'); ?>>Customers</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/contact-email.php" 
                title="<?php echo $tool_tip_customers; ?>" <?php echo setActive('contact-email.php'); ?>>Contact Emails</a></li>
                
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/testimonial-list.php" 
                title="<?php echo $tool_tip_customers; ?>" <?php echo setActive('testimonial-list.php'); ?>>Testimonials</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/feedback.php" 
                title="<?php echo $tool_tip_customers; ?>" <?php echo setActive('feedback.php'); ?>>Feedback</a></li>
 
                
                <?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>
                    
					<?php if(getProfileType() == "master"){ ?>
                    
                    	<li><a href="<?php echo SITEROOT;?>/manage/order-management/master/order-list.php" title="<?php echo $tool_tip_orders; ?>" 
						<?php echo setActive('order-list.php'); ?>>Orders</a></li>
                    	<li><a href="<?php echo SITEROOT;?>/manage/order-management/master/transaction-list.php" title="<?php echo $tool_tip_transactions; ?>" 					
						<?php echo setActive('transaction-list.php'); ?>>Transaction List</a></li>


                    
                    	<li><a href="<?php echo SITEROOT;?>/manage/order-management/master/failed-order-list.php" title="<?php echo $tool_tip_orders; ?>" 
						<?php echo setActive('failed-order-list.php'); ?>>Failed Orders</a></li>
                    	
					
					<?php }elseif(getProfileType() == "parent"){ ?>
                    <li><a href="<?php echo SITEROOT;?>/manage/order-management/sas-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>" 
					<?php echo setActive('order-list.php'); ?>>Orders</a></li>
                    <?php }else{ ?>        
                    <li><a href="<?php echo SITEROOT;?>/manage/order-management/sas-non-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>" 
					<?php echo setActive('order-list.php'); ?>>Orders</a></li>            
                    <?php } ?>

                <?php } ?>

              <li><a href="<?php echo SITEROOT;?>/manage/order-management/process-definition.php" title="<?php echo $tool_tip_orders; ?>" 
			  <?php echo setActive('process-definition'); ?>>Processes Definitions</a></li>            
                    
                    
              <li><a href="<?php echo SITEROOT;?>/manage/customer/edit-review-email.php" title="<?php echo $tool_tip_orders; ?>" 
			  <?php echo setActive('edit-review-email'); ?>>Edit Review Email Text</a></li>            
                    
                    
                    
              <li><a href="<?php echo SITEROOT;?>/manage/customer/bulk-email.php" title="<?php echo $tool_tip_orders; ?>" 
			  <?php echo setActive('bulk-email'); ?>>Bulk Email</a></li>            
                    
                    
                    
                
            </ul>
        </li>
    <?php } ?>
	
    
   <?php //if($module->hasAskModule($_SESSION['profile_account_id'])){ 
   		if(0){
   ?> 
    <li><span class="circle"><?php echo multipleDirectories($social_open,0); ?></span>
    	<a href="<?php echo SITEROOT;?>/manage/social/social-landing.php" 
        title="Add and Edit Organizers" 
		<?php echo multipleDirectories($social_open,1); ?>>Social Network</a>
		<ul <?php echo multipleDirectories($social_open,1); ?>>
			<li><a href="<?php echo SITEROOT;?>/manage/social/member-profiles.php" title="<?php echo $tool_tip_designers; ?>" 
			<?php echo setActive("member-profiles.php"); ?>>Member Profiles</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/social/member-skills.php" title="<?php echo $tool_tip_attributes; ?>" 
			<?php echo setActive("member-skills.php"); ?><?php echo setActive("member-jobtitles.php"); ?><?php echo setActive("social-approve-skills.php"); ?>>Member Attributes</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/social/social-categories.php" title="<?php echo $tool_tip_organizerblog; ?>" 
			<?php echo setActive("social-categories.php"); ?><?php echo setActive("social-approve-categories.php"); ?>>Social Blog Categories</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/social/social-carousel.php" title="<?php echo $tool_tip_featured; ?>" 
			<?php echo setActive("social-carousel.php"); ?><?php echo setActive("social-featured-articles.php"); ?><?php echo setActive("askorganizer-introtext.php"); ?>>Featured Content</a></li>
		</ul>
	</li>
	<?php } ?>
    
    
    <?php if($admin_access->administration_level > 0){ ?>
        <li><span class="circle"><?php echo multipleDirectories($admin_open,0); ?></span>
            <a href="<?php echo SITEROOT;?>/manage/general-admin/admin-landing.php" 
            title="Administration of Management Section and Global Settings" <?php echo multipleDirectories($admin_open,1); ?>> Administration</a>
            <ul <?php echo multipleDirectories($admin_open,1); ?>>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/edit-company-profile.php" title="<?php echo $tool_tip_basicsettings; ?>" 
				<?php echo setActive("edit-company-profile.php"); ?>>Basic Settings</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/add-on-change-request.php" title="<?php echo $tool_tip_addon; ?>" 
				<?php echo setActive("add-on-change-request.php"); ?>>Add-ons Change Request</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/add-ons.php" title="<?php echo $tool_tip_addontoggle; ?>" 
				<?php echo setActive("add-ons.php"); ?>>Add-ons Toggle</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/admin-users/admin-users.php" title="<?php echo $tool_tip_users; ?>" 
				<?php echo setActive("admin-users.php"); ?>>Manage Users</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/general-admin/states.php" title="<?php echo $tool_tip_locationsettings; ?>" 
				<?php echo setActive("states.php"); ?>>Location Settings</a></li>			
            </ul>
        </li>
	<?php } ?>
    
	<?php 
	if($admin_access->master_level > 0){
		if(getProfileType() == "master"){ ?>
            <li><span class="circle"><?php echo multipleDirectories($master_admin_open,0); ?></span>
			<a href="<?php echo SITEROOT;?>/manage/master-admin/master-admin-landing.php" 
			title="Administration of Management Section and Global Settings" <?php echo multipleDirectories($master_admin_open,1); ?> >OTG Administration</a>
                <ul <?php echo multipleDirectories($master_admin_open,1); ?>>   
                    <!-- set li to class="otg-specific" to make it orange -->
                    <li><a href="<?php echo SITEROOT;?>/manage/master-admin/sas-cust.php" title="<?php echo $tool_tip_saas; ?>" <?php echo setActive("sas-cust.php"); ?>>SaaS Customers</a></li>
                    <li><a href="<?php echo SITEROOT;?>/manage/order-management/master/costco-order-list.php" title="<?php echo $tool_tip_costco; ?>" <?php echo setActive("costco-order-list.php"); ?>>Costco</a></li>			
                    <li><a href="<?php echo SITEROOT;?>/manage/master-admin/news.php" title="<?php echo $tool_tip_news; ?>" <?php echo setActive("news.php"); ?>>News</a></li>      
                </ul>
            </li>
	<?php } 
			} 
	?>
    
  


	
    
	<?php 
	
	//echo $module->hasDesignServicesModule($_SESSION['profile_account_id']);
	
	if($admin_access->design_level > 0){
		if($module->hasDesignServicesModule($_SESSION['profile_account_id']) || $module->hasDesignToolModule($_SESSION['profile_account_id']) ){ ?>
            
            <li><span class="circle"><?php echo multipleDirectories($design_open,0); ?></span>
                
<a href="<?php echo SITEROOT;?>/manage/design/design-landing.php" 
title="Manage Customers &amp; Orders" 
<?php echo multipleDirectories($design_open,1); ?>> Design</a>
                
                <ul <?php echo multipleDirectories($design_open,1); ?>>
                
                <!--
                <li><a href="<?php echo SITEROOT;?>/manage/master-admin/news.php" title="<?php echo $tool_tip_news; ?>"  <?php echo setActive("news.php"); ?>><span>News</span></a></li>
				-->
                
				<?php if($module->hasDesignServicesModule($_SESSION['profile_account_id'])){ ?>
        
                <li><a href="<?php echo SITEROOT;?>/manage/design/design-email.php" title="<?php echo $tool_tip_designrequests; ?>" <?php echo setActive("design-email.php"); ?>>Design Requests</a></li>
                <li><a href="<?php echo SITEROOT;?>/manage/design/in-home-consult.php" title="<?php echo $tool_tip_consultationrequests; ?>" <?php echo setActive("in-home-consult.php"); ?>>Design Consultation</a></li>
               	
                <li><a href="<?php echo SITEROOT;?>/manage/design/design-req-origin-stats.php" 
                title="<?php echo ''; ?>" <?php echo setActive("design-req-origin-stats.php"); ?>>Design Request Origin Statistics</a></li>
                
				<?php } ?>
				
               
                
                
                
                </ul>
            </li>
    <?php }
		}

    if($admin_access->tool_level > 0){
     if($module->hasDesignToolModule($_SESSION['profile_account_id'])){?> 
     	
        <li><span class="circle"><?php echo multipleDirectories($tool_open,0); ?></span>
         <a href="<?php echo SITEROOT;?>/manage/tool/tool-landing.php" title="Manage Customers &amp; Orders" <?php echo multipleDirectories($tool_open,1); ?>> Design Tool</a>
			<ul <?php echo multipleDirectories($tool_open,1); ?>>
            	
                
            <li><a href="<?php echo SITEROOT;?>/manage/tool/general-setup.php">General Setup</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/tool/material-setup.php">Material Setup</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/tool/pricing-schemas.php">Pricing</a></li>
			<li><a href="<?php echo SITEROOT;?>/manage/tool/pieces.php">Pieces</a></li>
                
                
                
                
                
                
                
                
                
                
                
                
                   		
            </ul>
		</li>
        
        
     <?php }
		}
		?>
    
    
    
    
    
</ul>
<!-- SJC : End new Navigation -->
