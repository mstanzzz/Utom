<?php
$ts = time();
$db = $dbCustom->getDbConnect(CART_DATABASE);

?>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>

function getScreenWidth(){	
	var h = $(window).height();
	var w = $(window).width();
	alert("------- width:"+w);
}


function add_item(item_id){

	var qty = 1;
	var addMsg = "1 Item Added";

	alert("item_id "+item_id);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '../../pages/cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
		  
		alert(data);
		
		$( "#add_to_cart_msg" ).css( "color", "red");
		
		$( "#add_to_cart_msg" ).html(data);
		
			
		}

	});	

}



	function remove_item(item_id){	
		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '../../pages/cart/ajax-remove-item.php?item_id='+item_id,
			success: function(data) {
				
				//alert(data);
				
				location.reload(true);
				//setCartContent();
			}
		});	
		
	}
	

</script>


<br />
<a href="checkout.html"><span style="font-size:40px; color:blue">Checkout</span></a>
<br />


<?php
echo "num items:  ".$cart->getItemCount();
echo "<br />";


$content_height = 0;
$sub_total = 0;
$total_item_discount = 0;
$total_discount = 0;
$global_discount = 0;
$grand_total = 0;
$total_tax = 0;
$weight = 0;
$stuff_in_shopping_cart=0;
$grand_total_without_shipping =0;
		
if($cart->hasItems()){
	$stuff_in_shoppings_cart=1;
	$cart_contents_array = $cart->getContents();						
	$cart_has_items = 1;
	$content_height += 20;
	$i = 1;

	foreach($cart_contents_array as $cart_array) {
		$item_array = $item->getItem($cart_array['item_id']);
		$item_discount = 0;
		$total_item_discount += $item_discount;
		if($item_array['is_taxable']){
			$item_tax = $cart_array["price"] * .07;
		}else{
			$item_tax = 0;
		}
		$total_tax += $item_tax; 
		$weight += $item_array['weight']*$cart_array['qty'];
		$content_height += 90;				

$details_url = $nav->getItemUrl($item_array['seo_url'], $item_array['name'], $item_array['profile_item_id'], $brand_name, 'shop', $item_array['hide_id_from_url']);		
echo "<br />";
echo "<img src='../../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$item_array['file_name']."' >"; 


		$line_total = ($cart_array['price'] - $total_item_discount) * $cart_array['qty'];							
		if($line_total < 0) $line_total = 0;		
echo "<br />";	
echo "line_total: $".number_format($line_total,2); 
		$sub_total += $line_total;
	
	}
echo "<br />";
echo "sub_total:  $".number_format($sub_total,2); 
			
}

?>
