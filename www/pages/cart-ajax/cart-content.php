<?php

require_once("includes/config.php"); 										
 
require_once("includes/class.shopping_cart.php");
require_once("includes/class.shopping_cart_item.php");
require_once("includes/accessory_cart_functions.php");
require_once("includes/class.like_items.php");
require_once("includes/class.discount.php");
require_once("includes/class.customer_login.php");

require_once("includes/class.design_cart.php");

if(!isset($design_cart)) $design_cart = new DesignCart;

if(!isset($cart)) $cart = new ShoppingCart;
if(!isset($item)) $item = new ShoppingCartItem;
if(!isset($discount)) $discount = new Discount;
if(!isset($likes)) $likes = new LikeItems;
if(!isset($lgn)) $lgn = new CustomerLogin;



if($lgn->isLogedIn()){
	$customer_id = $lgn->getCustId();	
}else{
	$customer_id = 0;
	
}

$login_success = (isset($_GET["login_success"])) ? $_GET["login_success"] : 2;

?>

<script> 

$(document).ready(function() {

	var ol_len = $('.outer_box').length;
	//alert(ol_len);
	var i;
	for(i=0;i<=ol_len;i++){
		$('#under_lay'+i).hover(
			function () {				
				$(this).find(".shopping_cart_row").css('background', '#cde5f0');
			},			
			function () {
				$(this).find(".shopping_cart_row").css('background', 'white');
			}		
		);
	}

	$("a.inline").fancybox({
		'autoScale'     :	true	
	});	
	
	$(".remove_item").click(function(){
		var item_id = $(this).find(".e_sub").attr('id');
		//alert(item_id);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '<?php echo SITEROOT; ?>/pages/cart/ajax-remove-item.php?item_id='+item_id,
			success: function() {
				location.reload(true);
				//setCartContent();
			}
		});
	
	});
	
	$(".add_to_wishlist").click(function(){
		var item_id = $(this).find(".e_sub").attr('id');
		//alert(item_id);
		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '<?php echo SITEROOT; ?>/pages/cart/ajax-add-to-wishlist.php?item_id='+item_id,
		});

		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '<?php echo SITEROOT; ?>/pages/cart/ajax-remove-item.php?item_id='+item_id,
			success: function() {
				setCartContent();
				//alert('L');
			}
		});
	});
	

	$(".update_qty").click(function(){
		var item_id = $(this).find(".i_sub").attr('id');
		var qty = $(".uq"+item_id).find(".q_sub").attr('value');
		
		qty = jQuery.trim(qty);
		
		if(!IsNumeric(qty) || qty == ''){
			alert("please enter valid numbers for qty");	
		}else{
		
			$.ajaxSetup({ cache: false}); 
			$.ajax({
				url: '<?php echo SITEROOT; ?>/pages/cart/ajax-update-qty.php?item_id='+item_id+'&qty='+qty,
				success: function() {
					location.reload(true);
					//setCartContent();
				}
			});
		}
	});


	$("#submit_quick_add").click(function() {


		var product_code = document.quick_add_form.product_code.value;
		var qty = document.quick_add_form.qty.value;
		qty = jQuery.trim(qty);
	
	
		if(!IsNumeric(qty) || qty == ''){
			alert("Please enter a valid number for quantity");
			$("input#qty").focus();
		}else{
						
				
			$.ajaxSetup({ cache: false}); 
			$.ajax({
				url: '<?php echo SITEROOT; ?>/pages/cart/ajax-add-item-with-qty.php?item_id='+product_code+'&qty='+qty,
				success: function() {
					location.reload(true);
					//setCartContent();			
				}
			});
			
		}
		
	});
	
	
	$("#signin").click(function() {
		
			$("#sign_in").css('display', 'block');
	});


//$("input#qty").focus();
//$("product_code#qty").focus();
//quick_add_form">
	
});

</script> 


<?php 
if($customer_id == 0){ 
	if($login_success == 0){
		echo "<div class='shopping_cart_signin_msg_box'>";
		echo "The supplied email and password combination was not found. Please register or try again";	
		echo "</div>";
	}
}else{
	if($login_success == 1){
		echo "<div class='shopping_cart_signin_msg_box'>";
		echo "You are now logged in. Thank you";	
		echo "</div>";
	}			
}
?> 



<div class="shopping_cart_left_content">


<?php
$sub_total = 0;
$total_item_discount = 0;
$global_discount = 0;
$grand_total = 0;
$total_tax = 0;

$cart_has_items = 0;




if(0){
//if($cart->hasItems()){
	$cart_contents_array = $cart->getContents();
	$cart_has_items = 1;
?>
	<div class="shopping_cart_content_head">
		<div style="float:left; width:90px; height:10px;">
		</div>
		<div style="float:left; width:190px;">
           	Description
		</div>
		<div style="float:left; width:100px; text-align:right; padding-right:60px;">
			
		</div>
        <div style="float:left; width:100px;">
			
        </div>
		<div style="float:right; width:100px; text-align:right; padding-right:10px;">
			Price
		</div>
		<div class="clear"></div>
	</div>

	<?php		

	$i = 1;
	foreach ($cart_contents_array as $cart_array) {
		$item_array = $item->getItem($cart_array["item_id"]);
		$item_discount = $discount->getItemDiscount($cart_array["item_id"]);
		$total_item_discount += $item_discount;
		if($item_array["is_taxable"]){
			$item_tax = $cart_array["price"] * .07;
		}else{
			$item_tax = 0;
		}
		$total_tax += $item_tax; 
	
	?>
    
	<div id="under_lay<?php echo $i; ?>" class="outer_box">
		<div class="shopping_cart_row">
            <div style="float:left; width:90px; height:10px;">
                <a class="inline" href="<?php echo "uploads/tmp/pre-crop/".$item_array['file_name']; ?>">
                 <img id="item_img<?php $i; ?>" 
                    src="<?php echo SITEROOT; ?>/uploads/cart/list/<?php echo $item_array['file_name']; ?>" 
                    alt='<?php echo $item_array['name']; ?>' /> 
            </a>
                      
            </div>
            <div style="float:left; width:190px;">
                <br />
                <a href="closet-accessory-details/closets-accessory-item/ <?php echo $cart_array['name'];  ?>  /<?php echo $cart_array["item_id"]."/0";  ?>">
                <div style="float:left; padding-right:30px; color:#666;">
                   <b>
                   <?php echo $cart_array['name'];  ?>
                   </b>
                </div>
                </a>
                <div style="float:left; padding-right:30px;">
                    Product ID: <?php echo $cart_array["item_id"];  ?>
                </div>
                <div style="float:left;">
                    <a href="#" class="remove_item">Remove Item
                        <div class='e_sub' id='<?php echo $cart_array["item_id"]; ?>' style='display:none'></div>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <div style="float:left; width:100px; text-align:right; padding-right:60px;">
                <b><?php  echo "$".number_format($cart_array["price"],2); ?></b>        
            </div>
            <div style="float:left; width:100px;">
                <span class="uq<?php echo $cart_array["item_id"]; ?>">
                    <input class="q_sub"  name="qty" value="<?php echo $cart_array["qty"]; ?>" style="width:30px;" />
                </span>
                <a href="#" class="update_qty">update
                    <div class='i_sub' id='<?php echo $cart_array["item_id"]; ?>' style='display:none'></div>
                </a>
            </div>
	        <div style="float:right; width:100px; text-align:right; padding-right:10px;">
                <b>
                <?php 
                $line_total = $cart_array["price"] * $cart_array["qty"];
                echo "$".number_format($line_total,2); 
                $sub_total += $line_total;
                ?> 
                </b>       
            </div>
            <div class="clear"></div>
		</div>
    </div>
	<?php 
	$i++; 
	} 

}




if($design_cart->hasItems()){
	$cart_contents_array = $design_cart->getContents();
	$cart_has_items = 1;
	$sub_total = 0;
	$i = 1;
	$temp_job_id = 0;
	
	foreach ($cart_contents_array as $cart_array) {
	
		if($temp_job_id > 0){
			echo "<div style='height:40px;'></div><div class='clear'></div>";	
		}

		
		
		if($temp_job_id != $cart_array["job_id"]){
			$temp_job_id = $cart_array["job_id"];
		
			
	?>




		<div class="shopping_cart_content_head">



            <div style="float:left; width:90px;">
            <?php 
			
			//echo "<div style='color:red;'>".$design_cart->getJobName(160)."</div>";
			
			
			echo $design_cart->getJobName($temp_job_id); 
			//echo $design_cart->getItemCount();
			
			//echo $temp_job_id;
			?>
            </div>

            <div style="float:left; width:190px;">
                Description
            </div>
            <div style="float:left; width:100px; text-align:right; padding-right:60px;">
                
            </div>
            <div style="float:left; width:100px;">
                
            </div>
            <div style="float:right; width:100px; text-align:right; padding-right:10px;">
                Total
            </div>
            <div class="clear"></div>
        
        </div>





	<?php 
	} 
	?>
	
	<div id="under_lay<?php echo $i; ?>" class="outer_box">
		<div class="shopping_cart_row">
            <div style="float:left; width:90px; height:10px;">
                img ?
                <?php 
				echo $cart_array["job_id"]; 
				//print_r($cart_contents_array);
				//exit;
				
				?>

            </div>
            <div style="float:left; width:190px;">
                <br />
                <div style="float:left; padding-right:30px; color:#666;">
                   <b>
                   <?php echo $cart_array['name'];  ?>
                   </b>
                </div>
                </a>
                <div style="float:left; padding-right:30px;">
                    Design ID: <?php echo $cart_array["design_id"];  ?>
                </div>
                <div style="float:left;">
                    <a href="#" class="remove_item">Remove Item
                        <div class='e_sub' id='<?php echo $cart_array["design_id"]; ?>' style='display:none'></div>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <div style="float:left; width:100px; text-align:right; padding-right:60px;">
                <b><?php  //echo "$".number_format($cart_array["price"],2); ?></b>        
            </div>
            <div style="float:left; width:100px;">                    
				<?php //echo $cart_array["qty"]; ?>
            </div>
	        <div style="float:right; width:100px; text-align:right; padding-right:10px;">
                <b>
                <?php 
                $line_total = $cart_array["price"] * $cart_array["qty"];
                echo "$".number_format($line_total,2); 
                $sub_total += $line_total;
                ?> 
                </b>       
            </div>
            <div class="clear"></div>
		</div>
    </div>
	<?php 
	$i++; 
	} 
}


if($cart_has_items){
	//$global_discount = $discount->getGlobalDiscount($sub_total);
	//$total_discount = $total_item_discount + $global_discount;
	//$grand_total = 	$sub_total - $total_discount; 
?>

	




        
        <div class="shopping_job_select_box">


			Jobs
            <br />
            
            <?php
				//$sql = "SELECT  "
			
			
			?>



		</div>        
        
        <div class="shopping_cart_total_box">
			<!--            
            
            <div style="float:right; width:80px; text-align:right; padding-right:12px; padding-top:16px;">
                <b><?php//echo "$".number_format($sub_total,2); ?></b>        
            </div>
            <div style="float:right; padding-top:16px;">
                Product Sub Total:
            </div>
            <div class="clear"></div>
            <div style="float:right; width:80px; text-align:right; padding-right:12px; color:#F60; padding-top:16px;">
                <b><?php//echo "$".number_format($total_discount,2); ?></b>        
            </div>
            <div style="float:right; padding-top:16px;">
                Discount:
            </div>
            <div class="clear"></div>
            <div style="float:right; width:80px; text-align:right; padding-right:12px; color:#F60; padding-top:16px;">
                <b><?php//echo "$".number_format($total_tax,2); ?></b>        
            </div>
            <div style="float:right; padding-top:16px;">
                Tax:
            </div>
            <div class="clear"></div>
            -->
            <div style="float:right; width:80px; text-align:right; padding-right:12px; padding-top:16px; padding-bottom:16px;">
                <b>
				<?php 
					//echo "$".number_format($grand_total,2); 
					echo "$".number_format($sub_total,2); 
				?>
                </b>        
            </div>
            <div style="float:right; padding-top:16px; padding-bottom:16px;">
                Total:
            </div>
            <div class="clear"></div>
        
        
        <div class="shopping_cart_lower_button_box">
        <br />
            <?php
            if($customer_id == 0){
				$block = '';
				$block .= "<div style='float:left;'>";
				$block .= "<span id='signin' class='blue_button' title='sign in' >Sign In</span>";
				$block .= "</div>";
                $block .= "<div style='float:left;'>";
                $block .= "<a href='".SITEROOT."/custom-closet-signup.html'><span class='blue_button'>Register</span></a>"; 
                $block .= "</div>";
                $block .= "<div style='float:left;'>";
                $block .= "<a href='".SITEROOT."/closet-accessory-checkout.html'><span class='blue_button'>Guest Checkout</span></a>"; 
                $block .= "</div>";
				echo $block;
			
			}else{
				$block = '';
                $block .= "<div style='float:right;'>";
                $block .= "<a href='".SITEROOT."/closet-accessory-checkout.html'><span class='blue_button'>Checkout</span></a>"; 
                $block .= "</div>";
				echo $block;
				
			}
            ?>
        </div>    
		<div class="clear"></div>
        <div id="sign_in" class="cart_sign_in">
			<form id="sign_in_form" name="sign_in_form" action="<?php echo SITEROOT; ?>/signin.php" method="post">
                <input type="hidden" name="page" value="cart" />
                <input type="hidden" name="slug" value="cart" />
                <span style="color:#666666;" class="bold">Email Address</span><br />
                <input type="text" name="user_name" style="width:206px;" />
                <div class="sub_spacer"></div>
                <span style="color:#666666;" class="bold">Password</span><br />
                <input type="password" name="password" style="width:206px;" />
                <br /><br />
                <input type="image" src="<?php echo SITEROOT; ?>/images/button_signin.png" alt="Sign In">
               </form>
        </div>
    </div>
    

<?php



}else{
	echo "<br /><br /><br />There are no items in your shopping cart.<br /><br /><br /><br />";
}
?>

</div>



<div class="like_box_right">
<?php
$likes = new LikeItems;

$acc_likes_ret = array();
$desgn_likes_ret = array();

if(is_array($cart->getContents())){
	$t = $cart->getContents();
	if(is_array($likes->getLikesItemsFromArray($t))){
		$acc_likes_ret = $likes->getLikesItemsFromArray($t); 
	}
}

if(is_array($design_cart->getContents())){
	$t = $design_cart->getContents();	
	if(is_array($likes->getLikesItemsFromDesign($t))){
		$desgn_likes_ret = $likes->getLikesItemsFromDesign($t); 
	}
}

$likes_ret = array_merge($acc_likes_ret,$desgn_likes_ret); 

if(is_array($likes_ret)){
	echo"		
		<div class='like_box_right_head'>
			You may also like
		</div>
		";	

		foreach($likes_ret as $value){
            $block = '';
			$block .= "<div class='like_pic_box'>";
			$block .= "<a href='".SITEROOT."/closet-accessory-details/closets-accessory-item/".getUrlText($value['name'])."/".$value["item_id"]."/0' style='text-decoration:none;'>";
            $block .= "<img src='".SITEROOT."/uploads/cart/like/".$value["file_name"]."' alt='closet organizers'/><br />";
            $block .= "<div class='like_item_name'>".$value['name']."</div>";
            $block .= "</a>";
            $block .= "</div>";
            $block .= "<div class='clear'></div>";
        	echo $block;
		}

	
}



?>

</div>





<div class="clear"></div>












<!--
    <div style="display:none">
        <div id="signin" style="height:180px;">
            <form action="<?php// echo SITEROOT; ?>/signin.php" method="post">
            <input type="hidden" name="page" value="cart" />
            <input type="hidden" name="slug" value="cart" />
            <span style="color:#666666;" class="bold">Email Address</span><br />
            <input type="text" name="user_name" style="width:206px;" />
            <div class="sub_spacer"></div>
            <span style="color:#666666;" class="bold">Password</span><br />
            <input type="password" name="password" style="width:206px;" />
            <br /><br />
            
            <input type="image" src="<?php//echo SITEROOT; ?>/images/button_signin.png" alt="Sign In">
            
             
            </form>
        </div>
    </div>
-->



<!--
   <div class="shopping_cart_quick_add_box">
        <div class="dark_blue">Know the Product ID already?</div>
        <form name="quick_add_form">
        	<input type="text" id="qty" 
            name="qty" value="QTY" style="color:#a2a2a2; width:36px;"  
            onclick="make_blank(this)"
            onblur="defaultText(this,'QTY');" />
        	<input type="text" id="product_code"
            name="product_code" value='' style="color:#a2a2a2; width:106px;" />
            <div style="position:relative; top:1px; right:1px;"> 
        	<img id="submit_quick_add" src="<?php//echo SITEROOT; ?>/images/button_add_cart_sm.jpg" />
            </div>
        </form>
    </div>
-->















