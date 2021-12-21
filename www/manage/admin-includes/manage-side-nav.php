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
	
if(!isset($current_page)){
	$parts = Explode('/', $_SERVER["PHP_SELF"]);
	$current_page = $parts[count($parts) - 1];	
	$current_dir = $parts[count($parts) - 2];	
	$current_up_dir = $parts[count($parts) - 3];			
}
	
function setActive($href){
	global $current_page;
	if($current_page === $href){
		return " class='active'";	
	}else {
		return '';	
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

echo "<ul id='manage_navigation'>";

$cms_block = '';
$cms_block .= "<li><a href='".SITEROOT."/manage/start.php' class='dashlink' title=''>Home</a></li>";
$cms_block .= "<li><span class='circle'>".multipleDirectories($cms_open,0)."</span>";
$cms_block .= "<a href='".SITEROOT."/manage/cms/cms-landing.php'> Content Management</a>";
$cms_block .= "<ul>".multipleDirectories($cms_open,1).">";
$cms_block .= "<li><a href='".SITEROOT."/manage/svg/svg.php'>SVG Icons</a></li>";
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/navigation/navbar.php'>Navigation</a></li>";
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/pages/page.php'>Pages</a></li>";
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/blog/blog.php'>Blog Posts</a></li>";
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/seo/seo.php'>SEO/Breadcrumbs</a></li>";
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/custom-code/custom-code.php?firstload=1'>Custom Code / Meta tags</a></li>";                
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/logo/logo.php'>Logo</a></li>";                
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/footer/edit-footer.php'>Footer</a></li>";                
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/social-media/edit-social-media-links.php?firstload=1'>Social Media</a></li>";                
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/keyword-landing/keyword-landing-page-list.php'>keyword-landing</a></li>";                
$cms_block .= "<li><a href='".SITEROOT."/manage/cms/design-services/design-services-pages.php'>Design Services</a></li>";                



$cms_block .= "<li><a href='".SITEROOT."/manage/cms/design-services/idea-folder.php'>Idea Folder</a></li>";

$cms_block .= "<li><a href='".SITEROOT."/manage/cms/email-content/email-content-landing.php'>Design Request Page</a></li>";                
$cms_block .= "</ul>";
$cms_block .= "</li>";

echo $cms_block;



$cat_block = '';
$cat_block .= "<li><span class='circle'>".multipleDirectories($catalog_open,0)."</span>";	
$cat_block .= "<a href='".SITEROOT."/manage/catalog/catalog-landing.php'"; 
$cat_block .= multipleDirectories($catalog_open,1)."'>Catalog</a>";
$cat_block .= "<ul ".multipleDirectories($catalog_open,1).">";
$cat_block .= "<li><a href='".SITEROOT."/manage/catalog/categories/top-category.php' >Manage Categories</a></li>";
$cat_block .= "<li><a href='".SITEROOT."/manage/catalog/products/item.php'>Products</a></li>";
$cat_block .= "<li><a href='".SITEROOT."/manage/catalog/attributes/set-custom-attributes.php'>Product Attributes</a></li>";
$cat_block .= "<li><a href='".SITEROOT."/manage/catalog/reviews/item-review.php'>Product Reviews</a></li>";
$cat_block .= "<li><a href='".SITEROOT."/manage/catalog/products/custom-measurements.php'>Custom Measurements</a></li>";     
$cat_block .= "</ul>";
$cat_block .= "</li>";

echo $cat_block;

	
$ecom_block = '';
$ecom_block .= "<li><span class='circle'>";
$ecom_block .= multipleDirectories($ecom_open,0);
$ecom_block .= "</span>";
$ecom_block .= "<a href='".SITEROOT."/manage/ecomsettings/ecommerce-landing.php' "; 
$ecom_block .= multipleDirectories($ecom_open,1);
$ecom_block .= "> Ecommerce Settings</a>";
$ecom_block .= "<ul ";            
$ecom_block .=multipleDirectories($ecom_open,1);
$ecom_block .=">";
$ecom_block .="<li><a href='".SITEROOT."/manage/ecomsettings/global-discount.php'>Discount Settings</a></li>";
$ecom_block .="<li><a href='".SITEROOT."/manage/ecomsettings/showroom-banner.php'>Showroom Page Banners</a></li>";
$ecom_block .="<li><a href='".SITEROOT."/manage/ecomsettings/shop-banner.php'>Shopping Page Banners</a></li>";
$ecom_block .="<li><a href='".SITEROOT."/manage/ecomsettings/ship-carrier.php'>Shipping Options</a></li>";				
$ecom_block .="<li><a href='".SITEROOT."/manage/ecomsettings/payment-processor.php'>Payment Processor</a></li>";
$ecom_block .="</ul>";
$ecom_block .="</li>";

echo $ecom_block; 


$cust_block = '';
$cust_block .= "<li><span class='circle'> ";
$cust_block .= multipleDirectories($custord_open,0);
$cust_block .= "</span>";
$cust_block .= "<a href='".SITEROOT."/manage/customer/customer-landing.php' "; 
$cust_block .= multipleDirectories($custord_open,1);
$cust_block .= "> Customers &amp; Orders</a>";
$cust_block .= "<ul "; 
$cust_block .= multipleDirectories($custord_open,1);
$cust_block .= ">";
$cust_block .= "<li><a href='".SITEROOT."/manage/customer/customer-list.php'>Customers</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/general-admin/contact-email.php'>Contact Emails</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/general-admin/testimonial-list.php'>Testimonials</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/general-admin/feedback.php'>Feedback</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/order-management/master/order-list.php'>Orders</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/order-management/master/transaction-list.php'>Transaction List</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/order-management/master/failed-order-list.php'>Failed Orders</a></li>";
$cust_block .= "<li><a href='".SITEROOT."/manage/order-management/process-definition.php'>Processes Definitions</a></li>";            
$cust_block .= "<li><a href='".SITEROOT."/manage/customer/edit-review-email.php'>Edit Review Email Text</a></li>";            
$cust_block .= "<li><a href='".SITEROOT."/manage/customer/bulk-email.php'>Bulk Email</a></li>";           
$cust_block .= "</ul>";
$cust_block .= "</li>";

echo $cust_block;



$adm_block = '';
$adm_block .= "<li><span class='circle'>";
$adm_block .= multipleDirectories($admin_open,0);
$adm_block .= "</span>";
$adm_block .= "<a href='".SITEROOT."/manage/general-admin/admin-landing.php'> Administration</a>";
$adm_block .= " <ul ";
$adm_block .= multipleDirectories($admin_open,1);
$adm_block .= " >";
$adm_block .= "<li><a href='".SITEROOT."/manage/general-admin/edit-company-profile.php'>Basic Settings</a></li>";
$adm_block .= "<li><a href='".SITEROOT."/manage/general-admin/add-on-change-request.php'>Add-ons Change Request</a></li>";
$adm_block .= "<li><a href='".SITEROOT."/manage/general-admin/add-ons.php'>Add-ons Toggle</a></li>";
$adm_block .= "<li><a href='".SITEROOT."/manage/admin-users/admin-users.php'>Manage Users</a></li>";
$adm_block .= "<li><a href='".SITEROOT."/manage/general-admin/states.php'>Location Settings</a></li>";			
$adm_block .= "</ul>";
$adm_block .= "</li>";

echo $adm_block;

$mast_block = '';
$mast_block .= "<li><span class='circle'>";
$mast_block .= multipleDirectories($master_admin_open,0);
$mast_block .= "</span>";
$mast_block .= "<a href='".SITEROOT."/manage/master-admin/master-admin-landing.php' ";
$mast_block .= multipleDirectories($master_admin_open,1);
$mast_block .= ">OTG Administration</a>";
$mast_block .= "<ul ";
$mast_block .= multipleDirectories($master_admin_open,1);
$mast_block .= ">";   
$mast_block .= "<li><a href='".SITEROOT."/manage/master-admin/sas-cust.php'>SaaS Customers</a></li>";
$mast_block .= "<li><a href='".SITEROOT."/manage/order-management/master/costco-order-list.php'>Costco</a></li>";			
$mast_block .= "<li><a href='".SITEROOT."/manage/master-admin/news.php'>News</a></li>";      
$mast_block .= "</ul>";
$mast_block .= "</li>";

echo $mast_block;


$des_block = '';
$des_block .= "<li><span class='circle'>";
//$des_block .= multipleDirectories($design_open,1);
$des_block .= "</span>";
$des_block .= "<a href='".SITEROOT."/manage/design/design-landing.php' ";
$des_block .= multipleDirectories($design_open,1);
$des_block .= ">Design</a>";
$des_block .= "<ul ";
$des_block .= multipleDirectories($design_open,1);
$des_block .= ">";   
$des_block .= "<li><a href='".SITEROOT."/manage/design/design-email.php'>Design Requests</a></li>";
$des_block .= "<li><a href='".SITEROOT."/manage/design/in-home-consult.php'>Design Consultation</a></li>";
$des_block .= "<li><a href='".SITEROOT."/manage/design/design-req-origin-stats.php'>Design Request Origin Statistics</a></li>";
$des_block .= "</ul>";
$des_block .= "</li>";

echo $des_block;

echo "</ul>";

?>


<!--
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/order-management/master/transaction-list.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Transactions</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/fulfillment/fulfillment-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Fulfillment</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/fulfillment/tool-design-orders.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Fulfillment</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/fulfillment/customise-ff-steps.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Fulfillment</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/fulfillment/tool-design-orders-complete.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Completed Design Orders</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/general-admin/admin-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Completed Design Orders</a>";	
	?>
	</li>			
            

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/general-admin/edit-company-profile.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Basic Settings</a>";	
	?>
	</li>			
 

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/general-admin/add-on-change-request.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/general-admin/add-ons.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/admin-users/admin-users.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/general-admin/states.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/master-admin/master-admin-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/master-admin/sas-cust.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/master-admin/sas-cust.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Add-ons Change Request</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/master-admin/news.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>News</a>";	
	?>
	</li>			
                    
    
	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/design-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Design</a>";	
	?>
	</li>			
  
    
	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/design-email.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Requests</a>";	
	?>
	</li>			
  

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/in-home-consult.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Design Consultation</a>";	
	?>
	</li>			

	
	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/design-req-origin-stats.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Design Request Origin Statistics</a>";	
	?>
	</li>			
	
  
	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/tool-design-list.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Tool Designs</a>";	
	?>
	</li>			
	

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/design/tool-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Design Tool</a>";	
	?>
	</li>			
  

	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/tool/general-setup.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>General Setup</a>";	
	?>
	</li>			

    
	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/tool/material-setup.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Material Setup</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/tool/material-setup.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Material Setup</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/tool/pricing-schemas.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Pricing</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/tool/pieces.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Pieces</a>";	
	?>
	</li>			


	<li>
	<span class="circle"></span>
	<?php		
	$url_str =  SITEROOT."/manage/reports/reports-landing.php";
	$url_str = preg_replace('/(\/+)/','/',$url_str);
	echo "<a href='".$url_str."' class='dashlink' title=''>Reports</a>";	
	?>
	</li>			

-->     
