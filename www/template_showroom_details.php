<?php
require_once('includes/config.php');
require_once('includes/db_connect.php'); 
require_once('includes/accessory_cart_functions.php');
//require_once('includes/class.price_range_items.php');	
require_once('includes/class.customer_login.php');
require_once('includes/class.shopping_cart.php');
require_once('includes/class.shopping_cart_item.php');
//require_once('includes/class.shopping_items_list.php');
require_once('includes/class.like_items.php');
require_once('includes/class.discount.php');
require_once('includes/class.design_cart.php');
require_once('includes/class.nav.php');
require_once('includes/class.seo.php');
require_once('includes/class.custom_code.php');
require_once('includes/class.custom_meta_tags.php');
require_once('includes/class.module.php');
require_once('includes/class.store_data.php');

//$num = 1;
//echo sprintf('%06d', $num);

$store_data = new StoreData;

$module = new Module;
$custom_meta_tags = new CustomMetaTags;
$custom_code = new CustomCode;

$seo = new Seo;

$nav = new Nav;
$lgn = new CustomerLogin;
$design_cart = new DesignCart;
$cart = new ShoppingCart;
$item = new ShoppingCartItem;
$discount = new Discount;
$likes = new LikeItems;
//$price_range_items = new PriceRangeItems;
//current time stamp
$ts = time();
// activate timed discounts if needed  

$shop_cart_name = getURLFileName('shopping-cart');

$db = $dbCustom->getDbConnect(SITE_DATABASE);

$sql = "UPDATE global_discount 
		SET hide = '0' 
		WHERE when_active <= '".$ts."' 
		AND when_expired > '".$ts."' 
		AND hide = '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

// expire timed  discounts if needed  
$sql = "UPDATE global_discount 
		SET hide = '1' 
		WHERE (when_expired > '0'  AND when_expired <= '".$ts."') OR (when_active > '".$ts."')
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);

$profile_item_id =  (isset($_GET['productId'])) ? $_GET['productId'] : 0;
//echo $item_id;

$item_array = $item->getItem(0,$profile_item_id);

if(isset($_POST['send_review'])){
	
	
}




			    
$attr_array = '';		
$attr_items_array = '';
$opt_array = '';
	$db = $dbCustom->getDbConnect(CART_DATABASE);
        
$sql = "SELECT item_id
        FROM item
        WHERE parent_item_id = '".$item_array['item_id']."'";

$result = $dbCustom->getResult($db,$sql);
                
$i = 0;
$j = 0;
$k = 0;

$attr_block = "";
$attr_items_array[$j] = $item_array['item_id'];			
                
if($result->num_rows > 0){	
                                
	while($a_item_row = $result->fetch_object()){
	                
		$j++;
        $attr_items_array[$j] = $a_item_row->item_id;				
        $sql = "SELECT attribute.attribute_id
                      ,attribute.attribute_name						
                FROM  attribute, opt, item_to_opt
                WHERE opt.attribute_id = attribute.attribute_id
                AND item_to_opt.opt_id = opt.opt_id
                AND item_to_opt.item_id = '".$a_item_row->item_id."'
                ORDER BY attribute_id";
         $res = $dbCustom->getResult($db,$sql);
                    
         while($attr_row = $res->fetch_object()) {                            
			$attr_array[$i][0] = $attr_row->attribute_id;
			$attr_array[$i][1] = $attr_row->attribute_name;
			$i++;

		}
	}
        
	if(count($attr_array) > 1){
		$attr_array = multi_unique($attr_array);
    }
}
        
        
$remain_array = array();
$new_array = array();
$i = 0;
if(count($attr_array) > 1){
	foreach($attr_array as $attr_v){
    	if($attr_v[0] == $item_array['main_attr_id']){
			//break the array and start here in new array 	
            $new_array[0][0] = $attr_v[0];
            $new_array[0][1] = $attr_v[1];
		}else{
			$remain_array[$i][0] = $attr_v[0];
            $remain_array[$i][1] = $attr_v[1];
            $i++;
		}
	}
}
                
$attr_array = array_merge($new_array, $remain_array);        
        
if(count($attr_items_array) > 1 && $attr_array != ""){
                    
	$i = 0;
                    
	foreach($attr_array as $attr) {
                    
		foreach($attr_items_array as $a_item){		
                    
        	$sql = "SELECT opt.opt_id, opt.opt_name
            		FROM  opt, item_to_opt
                    WHERE item_to_opt.opt_id = opt.opt_id
                    AND item_to_opt.item_id = '".$a_item."'						
                    AND opt.attribute_id = '".$attr[0]."'";
			$opt_res = $dbCustom->getResult($db,$sql);                    
            
			if($opt_res->num_rows > 0){
				$opt_obj = $opt_res->fetch_object();
                $opt_array[$k][0] = $opt_obj->opt_id;
                $opt_array[$k][1] = $opt_obj->opt_name;
                $k++;                       

            }
		}
                                    
		if(count($opt_array) > 1){
        	$opt_array = multi_unique($opt_array);
        }
						
		if($attr[0] == $item_array["main_attr_id"]){
			$attr_block .= "<div class='attribute'>";	
		}else{
			$attr_block .= "<div class='attribute' style='display:none;'>";
		}
				
        //$attr_block .= $attr[1].'     '.$attr[0];
        $attr_block .= "<select id='".$attr[0]."' onchange='change_attrs(".$attr[0].");' name='attr_".$attr[0]."' >";		
		$attr_block .= "<option value='0'>Select ".$attr[1]."</option>";
                        
        foreach($opt_array as $opt){
        	$attr_block .= "<option value='".$opt[0]."'>".stripslashes($opt[1]).'   '.$opt[0]."</option>";
		}
                    
        $opt_array = array();
                        
        $attr_block .= "</select>";
        
        $attr_block .= "</div>";
        
        $i++;
	}
}


				
require_once('includes/class.bread_crumb.php');	
$bread_crumb = new BreadCrumb;

$title = '';
$cat_id = 0;

$bc_data_out = explode('|',$item_array['seo_list']);
$bread_crumb->reSetToHome();
if(isset($bc_data_out[0])){
	
	$bc_data_in = explode(',',$bc_data_out[0]);
	if(count($bc_data_in) > 2){
		$bc_profile_cat_id = 0;
		$bc_seo_name = '';
		$bc_seo_url = '';
		if(isset($bc_data_in[0])){
			if(is_numeric($bc_data_in[0])){
				$bc_profile_cat_id = $bc_data_in[0];
			}
		}
		if(isset($bc_data_in[1])){
			if(is_numeric($bc_data_in[1])){
				$bc_cat_id = $bc_data_in[1];
				$cat_id = $bc_cat_id;
			}
		}
		
		if(isset($bc_data_in[2])){
			$bc_seo_name = strtolower($bc_data_in[2]);
			$bc_seo_name = str_replace('-',' ',$bc_seo_name);			
		}
		
		$title = $bc_seo_name.' '.$title;
		//$title = $title.', '.$bc_seo_name;
		
		if(isset($bc_data_in[3])){
			$bc_seo_url = $bc_data_in[3];
		}
		if($bc_seo_url != '') $bc_seo_url.='/';
		if($bc_profile_cat_id > 0){			
			$bread_crumb->add(strtolower($bc_seo_name), SITEROOT.'/'.$_SESSION['global_url_word'].$bc_seo_url.'category.html?prodCatId='.$bc_profile_cat_id);
		}
	}

}

$bc_name = stripAllSlashes($item_array['name']);
$bread_crumb->add(strtolower($bc_name), SITEROOT.'/'.$_SESSION['global_url_word'].$item_array['seo_url'].'/product.html?productId='.$profile_item_id);

/*
if($bread_crumb->getLength() > 100){
	$bread_crumb->removeByIndex(1);		
}
*/

$title = $item_array['name'].' '.$title;
if($item_array['brand_name'] != ''){
	$title = $item_array['brand_name'].' '.$title;	
}
if($title == ''){
	$title = $seo->title;
}
$title = stripAllSlashes($title);
		

$seo->setMeta('item-details', 1);

if($title == ''){
	$title = $seo->title;
}

$meta_key_words = $item_array['key_words'];

if($meta_key_words == ''){
	$meta_key_words = $seo->keywords;
}

$heading = '';
if($item_array['brand_name'] != '') $heading .= $item_array['brand_name'].' ';
$heading .= trim($item_array['name']).' ';
//SJC: This is making the product titles WAY too long. i've commented it out for now.	
//$heading .= trim($item_array['short_description']).' ';	
$heading = stripAllSlashes($heading);

$meta_description = $heading.' '.$item_array['description']; 
$meta_description = substr($meta_description, 0 , 250);

$title .= ' '.$_SESSION['html_title_word'];
$title = str_replace("\"", '', $title);

$meta_key_words = strip_tags($meta_key_words);
$meta_key_words = str_replace("\"", '', $meta_key_words);
$meta_description = strip_tags($meta_description);
$meta_description = str_replace("\"", '', $meta_description);

if(!$module->hasSeoModule($_SESSION['profile_account_id'])){
	$title = '';
	$meta_key_words = '';
	$meta_description = '';	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo stripAllSlashes($title);?></title>
<meta name="keywords" content="<?php echo stripAllSlashes($meta_key_words); ?>" />
<meta name="description" content="<?php echo stripAllSlashes($meta_description); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if($module->hasSeoModule($_SESSION['profile_account_id'])){
	echo $custom_meta_tags->getCustomMetaTagsBlock(); 
}
?>
<link href="<?php echo SITEROOT; ?>/css/base.css" rel="stylesheet">
<link href="<?php echo SITEROOT; ?>/css/responsive.css" rel="stylesheet">
<link href="<?php echo SITEROOT; ?>/js/fancybox2/source/jquery.fancybox.css?v=2.1.4" rel="stylesheet">
<link type="text/css" rel="stylesheet" media="all" href="<?php echo SITEROOT; ?>/css/mmenu.css" />

<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/'</script>

<!--

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
-->

<!--<script src="<?php //echo SITEROOT; ?>/js/components.js"></script>--> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

<script src="<?php echo SITEROOT; ?>/js/fancybox2/source/jquery.fancybox.js?v=2.1.4"></script> 




<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- Cross-Browser Adjustments for graceful degradation; remove per version as support drops -->
<!--[if IE 7]>
      <link href="<?php echo SITEROOT; ?>/css/ie.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 8]>
      <link href="<?php echo SITEROOT; ?>/css/ie8.css" rel="stylesheet">
    <![endif]-->
<!--[if IE 9]>
      <link href="<?php echo SITEROOT; ?>/css/ie9.css" rel="stylesheet">
    <![endif]-->
<?php 

if($module->hasSeoModule($_SESSION['profile_account_id'])){
	echo $custom_code->head_block; 
}
?>


<?php $cartLink = SITEROOT."/".$_SESSION['global_url_word']."/shopping-cart.html";?>

<script>

$(document).ready(function(){


	//show_pic(<?php //echo $item_array['item_id']; ?>);
	
	//show_gallery(<?php //echo $item_array['item_id']; ?>);

	//show_tabs_and_review(<?php //echo $item_array['item_id']; ?>);

	$('#add_to_cart').click(function(){
		var qty = 1;
		var addMsg = "";	
		var item_id = $(this).find(".e_sub").attr('id');
		//alert(item_id);
		var str = '';
		var elem = document.getElementById('add_to_cart_form').elements;
	    for(var i = 0; i < elem.length; i++)
        {
			str += elem[i].name.replace("attr_", "");
            str += "|" + elem[i].value + "---";
        } 
		//alert(str);	
		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '<?php echo SITEROOT; ?>/pages/cart/ajax-add-item-multi-attr.php?item_id='+item_id+'&attr_opts='+str,
			dataType: "json"
		}).done(function(data) {
			
			//alert(data.msg);
		
			//if($(data.msg) == "gt" || $(data.msg) == "lt"){
				if(1 == 2){
				addMsg = "Please select an option from each list or try a different combination";	
			}else{
				
				//alert("bbbb");
				
				//addMsg = data.msg+" Qty: "+qty;
				//addMsg = (qty > 1) ? qty+" Items Added" : "1 Item Added";					

				$(".top-nav li.cart > a").html("<i class='header-icon-cart'></i> My Cart ("+data.item_count+")");
				
				//$(".top-nav li.cart > a").html("kkkkkkkkkkkkkkkkkkk");
			
				//alert(data.item_count);
			
				$(data.line_item).prependTo(".top-nav li.cart table tbody");

				//$("#add_to_cart_form .qty").html("Item Added!");
				//$(".add-to-cart").removeClass("btn-success").text("View Cart").unbind("click").attr("href", "<?php //echo $cartLink; ?>");
	
			}

			$("#msg").html(addMsg);
	
	
		}).fail(function(jqXHR, textStatus) {
			console.log( "Request failed: " + textStatus );
		});
	
	
	});

	
});


function show_pic(item_id){

	$.ajaxSetup({ cache: false}); 
	$.ajax({
			
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-pic.php?item_id='+item_id,
		success: function(data) {
			//alert(data);
			$('#show_pic').html(data);
				
		}
	});

}


function show_gallery(item_id){

	$.ajaxSetup({ cache: false}); 
	$.ajax({
			
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-gallery.php?item_id='+item_id,
		success: function(data) {
			//alert(data);
			$('#thumbnails_box').html(data);
			if (data != ''){$("#show_pic").addClass("has-alternate-images");}
			initializeSwitcher();
		}
	});

}


function re_load(){
	

	show_pic(<?php echo $item_array['item_id']; ?>);

	var str = '';
    var elem = document.getElementById('add_to_cart_form').elements;
    for(var i = 0; i < elem.length; i++)
     {
		str += elem[i].name.replace("attr_", "");
        str += "|0---";
     } 



	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-attr-m.php?trigger_option=0&item_id=<?php echo $item_array['item_id']; ?>&attr_opts='+str,
		dataType: "json"
	}).done(function(data) {
		
			
		$('#attr_box').html(data.block);
	
		if(data.ret_item_id){

			show_pic(data.ret_item_id);			

			show_heading(data.ret_item_id);

			show_tabs_and_review(data.ret_item_id);

			//show_gallery(data.ret_item_id);

		}
	
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});
}



function change_attrs(trigger_attr){
	
	var msg = '';
	var str = '';
    var elem = document.getElementById('add_to_cart_form').elements;
	var main_attr_id = <?php echo $item_array['main_attr_id']; ?>

	//alert(main_attr_id);
	
	//alert(trigger_attr);	
	
	var trigger_option = $("#"+trigger_attr).val();

	//alert(trigger_option);

    for(var i = 0; i < elem.length; i++)
    {
		str += elem[i].name.replace("attr_", "");
        str += "|" + elem[i].value + "---";
    } 
	
	//alert(str);
	

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-attr-m.php?trigger_option='+trigger_option+'&trigger_attr='+trigger_attr+'&item_id=<?php echo $item_array['item_id']; ?>&main_attr_id='+main_attr_id+'&attr_opts='+str,
		dataType: "json"
	}).done(function(data) {
			
		
		//alert("num items: "+data.num_items);
		//alert("item_id: "+data.ret_item_id);
		
		//alert(data.test);
		
		$('#attr_box').html(data.block);
	
	
		if(data.num_items == 0){
			msg = "There are no products that have the selected options";
		}
	
		if(data.ret_item_id > 0){
			
			//alert(data.ret_item_id);	
			
			show_pic(data.ret_item_id);			

			show_heading(data.ret_item_id);

			show_tabs_and_review(data.ret_item_id);

			//show_gallery(data.ret_item_id);
			

		}

		$("#msg").html(msg);
	
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});


	
}


function show_tabs_and_review(item_id){
	
	//alert(item_id);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-tabs-and-review.php?item_id='+item_id,
		dataType: "json"
	}).done(function(data) {
		$('#review_overview_box').html(data.overview_block);
		$('#tabbed_content_box').html(data.tabs_block);
	}).fail(function(jqXHR, textStatus) {
		console.log( "Request failed: " + textStatus );
	});


	/*
	$.ajaxSetup({ cache: false}); 
	$.ajax({
			
		url: '<?php //echo SITEROOT; ?>/pages/cart/ajax-set-details-tabs-and-review.php?item_id='+item_id,
		success: function(data) {
			alert(data);
			
				
		}
	});
	*/



}


function show_heading(item_id){
	
	//alert(item_id);


	$.ajaxSetup({ cache: false}); 
	$.ajax({
			
		url: '<?php echo SITEROOT; ?>/pages/cart/ajax-set-details-heading.php?item_id='+item_id,
		success: function(data) {
			//alert(data);
			$('#heading').html(data);
				
		}
	});


}




function setActiveTab(){
	
	$(".nav-tabs li").removeClass("active");

	$(".tab-content div").removeClass("active");
	
	$("#reviews").addClass("active");	

	$(".nav-tabs li.reviews").addClass("active");	

}

</script>

</head>
<body>
<?php 

include('includes/header.php');
include('includes/nav.php'); 
?>
<div class="container page-content" >

	<?php   
		echo $bread_crumb->output();
    ?>
	<section class="row">
		<div class="span12">
			<h1>
            	<div id="heading">
				<?php 
				echo strip_tags($heading);
				?>
                </div>  
            </h1>
		</div>
    	<div class="span6 pull-right"> 
            <div id="show_pic">
            
            <?php
			
			$db = $dbCustom->getDbConnect(CART_DATABASE);
			$sql = "SELECT image.file_name
						,item.img_alt_text				
					FROM image, item
					WHERE image.img_id = item.img_id 
					AND item.item_id = '".$item_array['item_id']."'";
			$result = $dbCustom->getResult($db,$sql);						
			if($result->num_rows > 0){
				
				$img_obj = $result->fetch_object();
				echo "<span class='product-image image-switch-large'>
				<a class='fancybox' href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_obj->file_name."'>
				<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$img_obj->file_name."' alt='".stripslashes($img_obj->img_alt_text)."' />
				</a> 
				</span>";
			
			}

			?>
            
            </div>
            <div id='thumbnails_box'>
            <?php
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$gallery_img_array = array();
								
				$sql = "SELECT image.file_name
						FROM item_gallery, image
						WHERE item_gallery.img_id = image.img_id
						AND item_gallery.item_id = '".$item_array['item_id']."'";
				$result = $dbCustom->getResult($db,$sql);
 

				$block = '';				
				if($result->num_rows > 0){
					$gallery_img_array[] = $item->getFileNameFromItemId($item_array['item_id']);		
					while($row = $result->fetch_object()){
						$gallery_img_array[] = $row->file_name;
					}
					$block .= "<ul class='product-image-thumbnails'>";
					foreach($gallery_img_array as $gallery_file_name){	
						$block .= "<li><a href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$gallery_file_name."' 
						class='thumbnail-link image-switch-thumb'>
						<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$gallery_file_name."' 
						alt='".stripslashes($gallery_file_name)."' />			</a></li>";
					}
					$block .= "</ul>";
				}
				echo $block;

			?>
            
            </div>
		</div>
		<div class="span6 product-details"> 

            <div class="row">
				<div class="span3"> 
                	<span class="product-price"> 
                    <?php
						if($item_array['call_for_pricing']){
							echo 'Call For Price';	
						}else{
							echo '<strong>$'.number_format($item_array['price'],2).'</strong>  per ea.';
						}
					?>
                    </span>
					                    
                    
                    <!--
					<h5>Available Colors:</h5>
					<ul class="color-swatch-options">
						<li><a href="#" class="option-1"><img src="images/placeholder.jpg" alt="option-1" /></a></li>
						<li><a href="#" class="option-1"><img src="images/placeholder.jpg" alt="option-1" /></a></li>
						<li><a href="#" class="option-1"><img src="images/placeholder.jpg" alt="option-1" /></a></li>
						<li><a href="#" class="option-1"><img src="images/placeholder.jpg" alt="option-1" /></a></li>
					</ul>
                    -->
                	    
				</div>
				<div class="span3 align-right">
                	
                    <span class="stock-msg">
						<!-- the stock message goes here, either in stock or out of stock; out of stock should add the class 'out-of-stock' to the span element.-->
						IN STOCK
					</span>
                    
					<div class="qty muted"> QTY:
						<input type="text" name="qty" value="1" class="product-qty" />
					</div>
                    <div id="attr_box">
                        <form id="add_to_cart_form" name="add_to_cart_form" action="" method="post" enctype="multipart/form-data">
                            <div class="options"> <?php echo $attr_block; ?> </div>
                        </form>
					</div>
					<?php if($module->hasShoppingCartModule($_SESSION["profile_account_id"])){ ?>
                    <span id="add_to_cart" class="btn btn-success full-width" >Add To Cart
                    <div class='e_sub' id='<?php echo $item_array['item_id']; ?>' style='display:none'></div>
                    </span>
					
					<?php } ?>
                    <div id="msg"></div>
				</div>
			</div>
            
            
            <?php 
			$rev_tabs_aray = get_details_tabs_and_review($item_array['item_id']) 
			?>
            
            <hr />
            
            <div id='review_overview_box'><?php echo $rev_tabs_aray['overview_block']; ?></div>
            
			<div class="row">
				<div class="span6" id='tabbed_content_box'><?php echo $rev_tabs_aray['tabs_block']; ?></div>
			</div>

 		</div>
	
	</section>
	<section class="row related-items related-items-horizontal">
		<div class="span12">
			<hr />
			<h5>You May Also Like:</h5>
			<div class="row">
				<?php    
				$likes_ret = $likes->getLikesItems($item_array['item_id']);
				if(count($likes_ret)> 0){
					if($likes_ret != ""){
						$i = 0;
						foreach($likes_ret as $value){
							$block = "";
							$block = "<div class='span4'><div class='itembox'>";
							
$details_link = "<a href='".SITEROOT.'/'.$_SESSION['global_url_word'].$value['seo_url']."/product.html?productId=".$value['profile_item_id']."'>";
							
							
							$block .= "<span class='product-image'>".$details_link;
							$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$value["file_name"]."' 
							style='border: none; height: 120px; width: 120px;'  alt='".stripAllSlashes($value["img_alt_text"])."'/></a></span>";
							$block .= "<h3>".$details_link.stripAllSlashes($value['name'])."</a></h3>";
							$block .= "<h5>Product Id: ".$value['item_id']."</h5>";
							
							if($value['call_for_pricing']){
								$block .= "<span class='product-price'>Call for pricing</h5>";								
							}else{
								$block .= "<span class='product-price'><strong>$".$value['price']."</strong> per ea.</h5>";
							}
							$block .= "</div></div>";
							$i++;
							if ($i == 3){
								$block .= "</div><div class=\"row\">";
								$i = 0;
							}
							echo $block;
						}
					}
				}
    		?>
			</div>
		</div>
	</section>
	<section class="row categories">
		<hr />
		<?php
		
			$sub_cats = $store_data->getSubCatsWithData($cat_id, 'showroom');
			$i = 1;
			if(count($sub_cats) > 0){
		?>
		<div class="span4">
			<h5>Related Showroom</h5>
			<!-- TODO: create new code to grab a related showroom, if it exists -->
			<?php
					
					foreach($sub_cats as $sub_cat){	
					//I'm only outputting the first result
						$block = ""; 
						$block .= "<div class='category showroom'>";
						$block .= "<a href='".SITEROOT."/".$_SESSION['global_url_word'].$sub_cat['seo_url']."/showroom.html?catId=".$sub_cat['cat_id']."'>";	
						$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$sub_cat["file_name"]."' 
						alt='".stripAllSlashes($sub_cat['img_alt_text'])."' />";
						$block .= "<span class='caption'>".stripAllSlashes($sub_cat['name'])."</span>";
						$block .= "</a>";
						$block .= "</div>";
						echo $block;
						break;
					}
					
			?>
		</div>
		<div class="span8">
		<?php } else {?>
		<div class="span12">
		<?php } 
			$sub_cats = $sub_cats = $store_data->getSubCatsWithData($cat_id, 'cart');
			$i = 1;
			if(count($sub_cats) > 0){
		?>
			<h5>Related Categories</h5>
			<div class="row slider-container">
				<div class="slider">
					<ul class="slider-content">
					<?php
							
							foreach($sub_cats as $sub_cat){	
								$block = ""; 
								$block .= "<li class='span2 category'>";
								$block .= "<a href='".SITEROOT."/".$_SESSION['global_url_word'].$sub_cat['seo_url']."/category.html?prodCatId=".$sub_cat['profile_cat_id']."'>";	
								$block .= "<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$sub_cat["file_name"]."' />";
								$block .= "<span class='caption'>".$sub_cat["name"]."</span>";
								$block .= "</a>";
								$block .= "</li>";
								echo $block;
							}
							
					?>
					</ul>
				</div>
				<a id="left" class="disabled" href="#"><i class="slider-arrow-left"></i></a> <a id="right" href="#"><i class="slider-arrow-right"></i></a> </div>
		<?php } ?>
		</div>
	</section>
</div>
<?php 
include("includes/footer.php"); 
?>
<div id="writeReview">
	<div class="lightbox-content">
		<form name="send_review_form" action="<?php echo  SITEROOT.'/'.$_SESSION['global_url_word'].$item_array['seo_url']."/product.html?productId=".$profile_item_id; ?>" method="post">
		
            
            <div class="row">
				<p><em>Fields marked with an asterisk (*) are required. In our rating scale, 5 stars is Excellent, 1 star is Poor.</em></p>
				<div class="span2">
					<label>Star Rating:*</label>
				</div>
				<div class="span3">
					<select name="rating">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option selected>5</option>
					</select>
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label> Review Headline:*</label>
				</div>
				<div class="span3">
					<input type="text" name="headline" value="Headline">
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label>Review Text:*</label>
				</div>
				<div class="span3">
					<textarea name="review" cols="50" rows="4">Review</textarea>
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label>Your Name: </label>
				</div>
				<div class="span3">
					<input type="text" name="name" value="Name" />
				</div>
			</div>
			<div class="row gutter-top">
				<div class="span2">
					<label>Your City:</label>
				</div>
				<div class="span3">
					<input type="text" name="city" value="City" />
				</div>
			</div>
				<button type="submit" name="send_review" class="btn btn-success">Submit Review!</button>
		</form>
	</div>
</div>
<?php echo $custom_code->body_block; ?>
</div>
</div>
</body>
</html>

<?php





               /* use for media
				    $sql = sprintf("SELECT media.name, media.media_id 
					   FROM item_to_media, media 
					   WHERE item_to_media.media_id = media.media_id 
					   AND item_to_media.item_id = '%u' ", $item_id);
								
					$doc_result = mysql_query($sql);
					if(!$doc_result)die(mysql_error());
					if(mysql_num_rows($doc_result) > 0){
						echo "<div>Documents:</div>";
					}
					while($doc_row = mysql_fetch_object($doc_result)) {

						$block = ""; 
						$block .= "<div>";
						$block .= "<a href='".SITEROOT."/uploads/".$doc_row->name."' target='_blank'>$doc_row->name</a>";
						$block .= "</div>";
						echo $block;
					}
                */




				/* USE THIS LATER FOR DYNAMIC OPTIONS
				
				$sub_sql = "AND (item_to_opt.item_id = '".$item_id."'";

				$sql = "SELECT item_id
						FROM  item 
						WHERE parent_item_id = '".$item_id."'";
				$si_res = mysql_query ($sql);
				if(!$si_res)die(mysql_error());
				if(mysql_num_rows($si_res)> 0){
					while($si_row = mysql_fetch_object($si_res)){
						$sub_sql .= " OR item_to_opt.item_id = '".$si_row->item_id."'";
						
					}
				}
				$sub_sql .= ")";

				$sql = "SELECT attribute_id, attribute_name
						FROM  attribute 
						ORDER BY attribute_id";
				$attr_res = mysql_query ($sql);
				if(!$attr_res)die(mysql_error());
				while($attr_row = mysql_fetch_object($attr_res)) {
					$sql = "SELECT opt.opt_id, opt.opt_name, item_to_opt.item_id 
							FROM  opt, attribute, item_to_opt 
							WHERE opt.attribute_id = attribute.attribute_id
							AND opt.attribute_id = '".$attr_row->attribute_id."'
							AND item_to_opt.opt_id = opt.opt_id
							".$sub_sql."
							ORDER BY opt_id";
					$opt_res = mysql_query ($sql);
					if(!$opt_res)die(mysql_error());
	
					if(mysql_num_rows($opt_res) > 0){
									
							$block = "";
							$block .= $attr_row->attribute_name;
							$block .= "  <select name='".$attr_row->attribute_id."' >";		
							$block .= "<option value='0'>none</option>";
							while($opt_row = mysql_fetch_object($opt_res)) {
								
								$block .= "<option value='".$opt_row->opt_id."' >$opt_row->opt_name</option>";
							}
							$block .= "</select>";
							$block .= "<br /><br />";
							echo $block;
					}
				}
	
	*/
	
	
			
				?>
