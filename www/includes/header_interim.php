<?php
require_once("class.module.php");
require_once("class.saas_customer.php");

$module = new Module;
$saas_cust = new SaasCustomer;

if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){

	if(!isset($design_cart)){
		$design_cart = new DesignCart;
	}
					
	if(!isset($cart)){
		$cart = new ShoppingCart;
	}
					
	$item_count = $design_cart->getItemCount();			
	$item_count += $cart->getItemCount();

	$sbt = 0;
	$j = 0;
	$max_name_len = 12;
	$cart_block = '';
	$cartLink = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['global_url_word'].'shopping-cart.html';
	$itemDetailsLink = '';
								
	if($cart->hasItems()){	
		$cart_block .= $cart->getHeaderBlock();
		$sbt += $cart->total_price;
	}
	
	if($design_cart->hasItems()){
		$cart_block .= $design_cart->getHeaderBlock();
	}

}else{
	$item_count = 0;	
	$sbt = 0;
	$j = 0;
	$max_name_len = 12;
	$cart_block = '';
	$cartLink = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['global_url_word'].'shopping-cart.html';
	$itemDetailsLink = '';

}

$phone = $saas_cust->phone;
		
$chat_url_array = getCompanyChatLink();
	
$this_page = $_SERVER['REQUEST_URI'];
$checkout = (strpos($this_page,"checkout") > -1) ? "checkout" : '';

$header_support_labels = $nav->getHeaderSupportLabels(); 

$header_support_block = '';
foreach($header_support_labels as $header_support_v){
	$header_support_block .= "<li>";
	$header_support_block .= "<a href='".$_SERVER['DOCUMENT_ROOT']."/".$header_support_v['url']."'>";
	$header_support_block .= $header_support_v["label"];
	$header_support_block .= "</a>";
	$header_support_block .= "</li>";
}

?>

<script>

$(document).ready(function(){

	$("#header_support").hover(function(){
		$(this).next(".subnav").css( "left:", "100px !important;" );
	});

});

</script>


<div id="outer-wrap">
<nav id="mobile-nav" class="hide-desktop">
	<div id="mobile-search-input">
		<form onSubmit="return mobileMenuTextSearch()">
        	<input type="search" class="mobile-menu-search" name="mobile-menu-search" id="mobile-menu-search" placeholder="Search Menu" />
            <button type="submit" name="mobile-menu-search-button" id="mobile-menu-search-button" class="btn btn-mini btn-primary"><i class="search-icon-small"></i></button>
        </form>
     </div>
	<a class="mobile-nav-trigger" href="#top"><i class="icon-remove icon-white"></i> Close Menu</a>
    <ul id="mobile-nav-list"></ul>
</nav>

<nav id="mobile-account-menu" class="hide-desktop">
	<a class="mobile-account-trigger" href="#top"><i class="icon-remove icon-white"></i> Close Menu</a>
</nav>

<div id="inner-wrap">

<header class="container <?php echo $checkout; ?>" id="top">

	<div class="logo_box" style="width:20%;">
	<a class="logo-image" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>">
        <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/saascustuploads/<?php echo $_SESSION['profile_account_id']; ?>/logo/<?php echo get_logo(); ?>" 
        alt="<?php echo $_SESSION['profile_company']; ?>" /></a>
	</div>
     
	<div style="float:right; width:80%;"> 
    	<div style="float:right;">       
			<nav id="support-nav" class="top-nav hide-mobile hide-tablet">
                <ul>
                    <li><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('about-us').".html"; ?>">Company Info</a></li>
                    <li id="header_support"><a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('faq').".html"; ?>"><i class="header-icon-support"></i> Support</a>
                        <ul class="header_subnav_support">
                            <?php
                            if(strlen($header_support_block) > 3){
                            	echo $header_support_block;
							}
                            ?>
                        </ul>
                    </li>
                    <?php 
                    
                   // if(0){ 
                   //if(strlen($cart_block) > 3){
					   //if(1){
					if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){	   
                    ?>
                     <li class="cart" id="ret_sc_block">
                     
                        <a href="<?php echo $cartLink; ?>" title="<?php echo $_SESSION['profile_company']; ?> Shopping Cart">
                        <i class="header-icon-cart"></i> My Cart (<?php echo $item_count ?>)</a>
                        <ul class="header_subnav_cart">
                        	<li class="drop-heading"><a href="<?php echo $cartLink; ?>"><strong class="pull-right">$<?php echo number_format($sbt,2); ?></strong>
                            	<strong href="#">Subtotal:</strong></a>
							</li>
                                
                            <li class="drop-table">
                                    <table class="drop-table cart">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Item</th>
                                                <th>QTY</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $cart_block; ?>
                                        </tbody>
                                    </table>
                            </li>
                                
                             <?php 
                             if($item_count > 0){
                             ?>
                                <li class="button"><a href="<?php echo $cartLink; ?>" class="btn btn-success">Go to Checkout <i class="icon-triangle-right icon-white"></i></a></li>
                                
                             <?php
                             }						
                             ?>
						</ul>
					</li>
                        
                        
                    <?php } ?>
                    
                    
                   
                    
                </ul>
            </nav>
		</div>            
            
		<div style="clear:both;"></div>
	
		<div style="float:right;">
    
            <div class="info_box_right hide-mobile hide-tablet">
                <a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('shipping').".html"; ?>"  >
                <img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/images/icons/truck.jpg'; ?>" alt=""> 
                Free Shipping 
                </a>
            </div>
            
            <div class="info_box hide-mobile hide-tablet">
                <a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('our-guarantee').".html"; ?>" >
                <img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/images/icons/chev_small.png'; ?>" alt="">
                Our Guarantee 
                </a>
            </div>
    
            <div class="info_box hide-mobile hide-tablet">
                <a href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].getURLFileName('contact-us').".html"; ?>">
                <span style="position:relative; top:-3px;">
                    <i class="icon-envelope"></i> 
                </span>
                Contact Us
                
                </a>
            </div>
    
            <?php	
            if($chat_url_array['chat_show']){ 
            ?>  
            <div class="info_box hide-mobile hide-tablet">
                    
                <a href="#" onClick="<?php echo stripslashes($chat_url_array['chat_url']); ?>" ><i class="header-icon-"></i> Live Help</a> 
    <!--                
    <a onClick="javascript:window.open('<?php //echo $_url_array['_url'];?>'+escape(document.location),'<?php //echo $_url_array['_account']; ?>','width=472,height=320');return false;">
                    <i class="header-icon-"></i> Live Help</a>
    -->                
            </div>
            <?php } ?>
            
            
            <?php if($phone != ''){ ?>
            <div class="info_box hide-mobile hide-tablet">
                <a href="tel:+<?php echo $phone; ?>" title="<?php echo $_SESSION['profile_company']; ?>"><i class="header-icon-phone"></i> <?php echo $phone; ?></a>
            </div> 
            <?php 
            }
            ?>
        
	        <div style="clear:both;"></div>
            
        </div>
                
	</div>

	<div style="clear:both;"></div>
    
    
    
    <!-- Mobile, Full Navigation --> 
	<!-- Fixed Mobile Top Nav -->
	<nav id="mobile-top-nav" class="hide-desktop affix"> 
    	<a class="mobile-nav-trigger" href="#mobile-nav"><i class="mobile-icon-menu"></i></a> 
		
		<?php if($phone != ''){  ?>
		<a id="mobile-contact-info" href="tel:18005263067" title="Call Now!"><i class="mobile-icon-phone"></i><?php echo $phone; ?></a> 
		<?php } ?>
        
        <?php if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){ ?>
			<a id="mobile-cart" href="<?php echo $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word']."shopping-cart.html"; ?>"><i class="mobile-icon-cart"></i><span id="mobile_qty"></span></a> 
        <?php } ?>
        
        <a id="mobile-account-menu-trigger" class="mobile-account-trigger" href="#mobile-account-menu"><i class="mobile-icon-user"></i></a> 
    </nav>



