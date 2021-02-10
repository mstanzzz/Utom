<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$page_title = "start";
	
$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
if(isset($_GET["nl"])){
	$msg = "You have been redirected from a restricted area.";	
}

$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "UPDATE user
		SET user_type_id = '7'
		WHERE username = 'mark.stanz@gmail.com'";
//$result = $dbCustom->getResult($db,$sql);	

$sql = "UPDATE user
		SET user_type_id = '7'
		WHERE username = 'admin'";
//$result = $dbCustom->getResult($db,$sql);	



//echo "REQUEST_URI  ".$_SERVER['REQUEST_URI'];
//echo "<br />";
//echo "DOCUMENT_ROOT  ".$_SERVER['DOCUMENT_ROOT'];
//echo "<br />";

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
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
|
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
		<br />
		<br />

		<a href="test/speed.php">Speed Test</a>
		<br />
		<br />
	
		<a href="test/img-test.php">Image Test</a>
		<br />
		<br />
	
		
        <?php if($msg != ''){ ?>  
		<div class="alert">
           	<span class="fltlft"><i class="icon-warning-sign"></i></span><?php  echo $msg; ?>
        </div>  
        <?php } ?>
        
        <ul class="dashboard_buttons clearfix">
			<?php if($admin_access->cms_level > 0){?>
			<li><a class="dashbtn cms" href="cms/cms-landing.php"><span>Content Management</span></a>
				<ul>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/cms/logo/logo.php" title="<?php echo $tool_tip_logo; ?>">Logo Image</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/cms/navigation/navbar.php" title="<?php echo $tool_tip_navigation; ?>">Navigation</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/cms/pages/page.php" title="<?php echo $tool_tip_pages; ?>">Pages</a></li>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/cms/blog/blog.php" title="<?php echo $tool_tip_blog; ?>">Blog Posts</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/cms/seo/seo.php" title="<?php echo $tool_tip_seo; ?>">SEO/Breadcrumbs</a></li>
					<li><a class="show_more" href="#">More...</a></li>
		
				</ul>
			</li>
			<?php } 
			if($admin_access->product_catalog_level > 0){?>
			<li><a class="dashbtn catalog" href="catalog/catalog-landing.php"><span>Product Catalog</span></a>
				<ul>
					<li><a href="<?php echo $ste_root;?>/manage/catalog/categories/category-tree.php" title="<?php echo $tool_tip_cart_cat; ?>">Manage Categories</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/catalog/products/item.php" title="<?php echo $tool_tip_cart_item; ?>">Products</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/catalog/attributes/attribute.php" title="<?php echo $tool_tip_attributes; ?>">Product Attributes</a></li>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/catalog/reviews/item-review.php" title="<?php echo $tool_tip_reviews; ?>">Product Reviews</a></li>
					<li><a class="show_more" href="#">More...</a></li>
				</ul>

			</li>
			<?php } 
			if($admin_access->ecommerce_level > 0){
			?>
            <li><a class="dashbtn ecommerce" href="ecomsettings/ecommerce-landing.php"><span>Ecommerce Settings </span></a>
				<ul>
					<li><a href="<?php echo $ste_root;?>/manage/ecomsettings/global-discount.php" title="<?php echo $tool_tip_discounts; ?>">Discount Settings</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/ecomsettings/showroom-banner.php" title="<?php echo $tool_tip_banners; ?>">Showroom Page Banners</a></li>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/ecomsettings/shop-banner.php" title="<?php echo $tool_tip_banners; ?>">Shopping Page Banners</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/ecomsettings/ship-carrier.php" title="<?php echo $tool_tip_shipping; ?>" >Shipping Options</a></li>			
					
					<?php if($module->hasCustomPaymentProcessorModule($_SESSION['profile_account_id'])){ ?>
                    <li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/ecomsettings/payment-processor.php" 
                    title="<?php echo $tool_tip_payment_processor; ?>">Payment Processor</a></li>
					<?php } ?>
					
                    <li><a class="show_more" href="#">More...</a></li>
				</ul>
			</li>
			<?php } 
			if($admin_access->customers_orders_level > 0){?>
			<li><a class="dashbtn custord" href="customer-landing.php"><span>Customers &amp; Orders</span></a>
				<ul id="crm_subnavigation" <?php echo multipleDirectories($custord_open,1); ?>>
					<li><a href="<?php echo $ste_root;?>/manage/customer/customer-list.php" title="<?php echo $tool_tip_customers; ?>">Customers</a></li>
					<?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>
						<?php if(getProfileType() == "master"){ ?>
						<li><a href="<?php echo $ste_root;?>/manage/order-management/master/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>
						<li><a href="<?php echo $ste_root;?>/manage/order-management/master/transaction-list.php" title="<?php echo $tool_tip_transactions; ?>" >Transaction List</a></li>
						<?php }elseif(getProfileType() == "parent"){ ?>
						<li><a href="<?php echo $ste_root;?>/manage/order-management/sas-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>
						<?php }else{ ?>        
						<li><a href="<?php echo $ste_root;?>/manage/order-management/sas-non-parent/order-list.php" title="<?php echo $tool_tip_orders; ?>">Orders</a></li>            
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
							<li><a href="<?php echo $ste_root;?>/manage/social/member-profiles.php" title="<?php echo $tool_tip_designers; ?>">Member Profiles</a></li>
							<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/social/member-skills.php" title="<?php echo $tool_tip_attributes; ?>">Member Attributes</a></li>
							<li><a href="<?php echo $ste_root;?>/manage/social/social-categories.php" title="<?php echo $tool_tip_organizerblog; ?>">Social Blog Categories</a></li>
							<li><a href="<?php echo $ste_root;?>/manage/social/social-carousel.php" title="<?php echo $tool_tip_featured; ?>">Featured Content</a></li>
							<li><a class="show_more" href="#">More...</a></li>
						</ul>
					</li>
			<?php 
				} 
			}
			
			if($admin_access->administration_level > 0){ ?>
            <li><a class="dashbtn admin" href="admin-landing.php"><span>Administration &amp; Settings</span></a>
				<ul id="admin_subnavigation" <?php echo multipleDirectories($admin_open,1); ?>>
					<li><a href="<?php echo $ste_root;?>/manage/general-admin/edit-company-profile.php" title="<?php echo $tool_tip_basicsettings; ?>" >Basic Settings</a></li>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/general-admin/add-on-change-request.php" title="<?php echo $tool_tip_addon; ?>">Add-ons Change Request</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/general-admin/add-ons.php" title="<?php echo $tool_tip_addontoggle; ?>">Add-ons Toggle</a></li>
					<li><a href="<?php echo $ste_root;?>/manage/admin-users/admin-users.php" title="<?php echo $tool_tip_users; ?>">Manage Users</a></li>
					<li class="hidden_dash"><a href="<?php echo $ste_root;?>/manage/general-admin/states.php" title="<?php echo $tool_tip_locationsettings; ?>">Location Settings</a></li>			
					<li><a class="show_more" href="#">More...</a></li>
				</ul>

			</li>
			<?php }?>
		</ul>
		<hr />
		<div class="colcontainer news">
			<div class="twocols">
				<h2 class="center-text">Latest News</h2>
				<hr />
				<?php 
				
				$parent_profile_id = getParentProfileId($_SESSION['profile_account_id']);
				
				$sql = "SELECT * FROM news 
					WHERE type = 'whats_new' 
					AND profile_account_id = '".$parent_profile_id."'				
					ORDER BY list_order";
				
				$db = $dbCustom->getDbConnect(SITE_N_DATABASE);   
			$result = $dbCustom->getResult($db,$sql);				
				$block = '';
				
				while($row = $result->fetch_object()) {
					
					$block .= "<h3>".stripAllSlashes($row->title)."</h3>";
					$date_posted = date("F j, Y",$row->last_update);
					$time_posted = date("g:i a", $row->last_update);	
					$block .= "<p class='postedby'>Posted ".$date_posted." at ".$time_posted." by ".$row->author."</p>";
					$block .= $row->content;
					$block .= "<hr />";
				}
				echo $block;
				?>
			</div>
			<div class="twocols">
				<h2 class="center-text">What's New</h2>
				<hr />
				<?php 
				
				$parent_profile_id = getParentProfileId($_SESSION['profile_account_id']);
				
				$sql = "SELECT * FROM news 
					WHERE type = 'whats_new' 
					AND profile_account_id = '".$parent_profile_id."'				
					ORDER BY list_order";
				
				$db = $dbCustom->getDbConnect(SITE_N_DATABASE);   
			$result = $dbCustom->getResult($db,$sql);				
				$block = '';
				
				while($row = $result->fetch_object()) {
					
					$block .= "<h3>".$row->title."</h3>";
					$date_posted = date("F j, Y",$row->last_update);
					$time_posted = date("g:i a", $row->last_update);	
					$block .= "<p class='postedby'>Posted ".$date_posted." at ".$time_posted." by ".$row->author."</p>";
					$block .= stripAllSlashes($row->content);
					$block .= "<hr />";
				}
				echo $block;
				?>
			</div>



		</div>
	</div>


	<p class="clear"></p>
	<?php 



/*
$db = $dbCustom->getDbConnect(USER_DATABASE);
$sql = "UPDATE category 
		SET img_id = '0'";
$result = $dbCustom->getResult($db,$sql);	
$sql = "UPDATE item 
		SET img_id = '0'";
$result = $dbCustom->getResult($db,$sql);	
*/


	
    //require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/customer/send-review-feedback-email.php');

	
    ?>
</div>

<br />
<br />
<br />
<a href="folders/">Design Folders Test</a>
<br />
<br />
<br />
<br />
<?php

//phpinfo();


exit;


// TESTING FEDEX

			$path_to_wsdl = $ste_root."/includes/fedex/wsdl/RateService_v16.wsdl";
							
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($path_to_wsdl, array('trace' => 1));


			$request['WebAuthenticationDetail'] = array(
				'UserCredential' =>array(
					'Key' => 'pe74aJ9xmXk58O7X', //'3vQvjcCj6xMahfoG', 
					'Password' => 'uHQyF9oFVqU1QY0vIPiEg0Yip', //'KebUSB1dRVlBDns8kCZbiSAdL'
				)
			); 
			$request['ClientDetail'] = array(
				'AccountNumber' => '221108213', //'510087321', 
				'MeterNumber' => '107818641', //'118674547'
			);
			$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request using PHP ***');
			$request['Version'] = array(
				'ServiceId' => 'crs', 
				'Major' => '16', 
				'Intermediate' => '0', 
				'Minor' => '0'
			);
			
			//$request['ReturnTransitAndCommit'] = true;
			//$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
			//$request['RequestedShipment']['ShipTimestamp'] = date('c');
			
			$request['RequestedShipment']['ServiceType'] = 'FEDEX_GROUND'; // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
			//$request['RequestedShipment']['ServiceType'] = $code;
			
			//$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
			/*
			$request['RequestedShipment']['TotalInsuredValue']=array(
				'Ammount'=>100,
				'Currency'=>'USD'
			);
			*/
			
	
			$request['RequestedShipment']['Shipper'] = array(
					'Contact' => array(
						'PersonName' => 'Sender Name',
						'CompanyName' => 'Sender Company Name',
						'PhoneNumber' => ''
					),
					'Address' => array(
						'StreetLines' => array('Address Line 1'),
						'City' => '',
						'StateOrProvinceCode' => 'OR',
						'PostalCode' => '97239',
						'CountryCode' => 'US'
					)
				);
	
	
		//var $from_zip;
		//var $from_state;
		//var $from_country;
		//var $to_zip;
		//var $to_state;
		//var $to_country;
			
			
			$request['RequestedShipment']['Recipient'] = array(
					'Contact' => array(
						'PersonName' => 'Recipient Name',
						'CompanyName' => 'Company Name',
						'PhoneNumber' => ''
					),
					'Address' => array(
						'StreetLines' => array('Address Line 1'),
						'City' => '',
						'StateOrProvinceCode' => 'OR',
						'PostalCode' => '97239',
						'CountryCode' => 'US',
						'Residential' => false
					)
				);
			
				
			
			$request['RequestedShipment']['PackageCount'] = '1';
			
		
			
			
			$request['RequestedShipment']['RequestedPackageLineItems'] = array(
					'SequenceNumber'=>1,
					'GroupPackageCount'=>1,
					'Weight' => array(
						'Value' => '100',
						'Units' => 'LB'
					)
					
					/*
					,
					
					
					'Dimensions' => array(
						'Length' => 15,
						'Width' => 10,
						'Height' => 10,
						'Units' => 'IN'
					)
					*/
				);
				
				
				$request['RequestedShipment']['TotalWeight'] = '10';
	
			$response = $client->getRates($request);
	
			
			
		//return	print_r($response->HighestSeverity);
			
		//return strpos($response->HighestSeverity , 'ERROR');	
		
		if(strpos($response->HighestSeverity , 'ERROR') !== false){

			print_r($response);	
	
		}else{				
			echo $response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount; 
		}

?>

</div>




</body>
</html>



[HTTP_HOST] => localhost 
[HTTP_REFERER] => http://localhost/manage/start.php 
[SERVER_NAME] => localhost 

[DOCUMENT_ROOT] => /var/www/html 

[CONTEXT_DOCUMENT_ROOT] => /var/www/html 

[SCRIPT_FILENAME] => /var/www/html/manage/catalog/catalog-landing.php 

[REQUEST_URI] => /manage/catalog/catalog-landing.php 
[SCRIPT_NAME] => /manage/catalog/catalog-landing.php 
[PHP_SELF] => /manage/catalog/catalog-landing.php 






