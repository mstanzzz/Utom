<?php 
$sub_total = 0;
$total_item_discount = 0;
$total_discount = 0;
$global_discount = 0;
$grand_total = 0;
$total_tax = 0;


$stuff_in_shopping_cart=0;
$total_items = 0;
$cart_html = '';
$hider = '';
$grand_total_without_shipping = 0;


if($cart->hasItems()){
	$stuff_in_shopping_cart=1;
	$cart_contents_array = $cart->getContents();
	$cart_has_items = 1;
	$i = 1;
	$hider = '';
	foreach($cart_contents_array as $cart_array) {
		$total_items++;
		$item_array = $item->getItem($cart_array['item_id']);
		$item_discount = 0;
		$total_item_discount += $item_discount;
		if($item_array['is_taxable']){
			$item_tax = $cart_array['price'] * .07;
		}else{
			$item_tax = 0;
		}
		$hider = ($i > 1) ? 'hide' : '';
		$total_tax += $item_tax; 
		
		
		$brand_name = getBrandName($item_array['brand_id']);
		$details_url = $nav->getItemUrl($item_array['seo_url'], $item_array['name'], $item_array['profile_item_id'], $brand_name, 'shop', $item_array['hide_id_from_url']);		
		
		$cart_html .= "<div class='span8 cart-item ".$hider."' id='".$cart_array['item_id']."'>";
		$cart_html .= "<div class='itembox'>";
		$cart_html .= "<div class='row'>";							
		$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'small') : 'medium'); 
		$cart_html .= "<div class='span1'><span class='product-image'>
						<img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$item_array['file_name']."' 
						alt='".$item_array['img_alt_text']."' /></span></div>";
		$cart_html .= "<div class='span4 product-details'>";
		$cart_html .= "<p><strong>".stripslashes($item_array['name'])."</strong><br/>";
		$cart_html .= "Product Id: ".$item_array['profile_item_id']."</p>";
		$cart_html .= "</div>";
		$cart_html .= "<div class='span1'><p>Qty: ".$cart_array['qty']."</p></div>";
		$cart_html .= "<div class='span2'><p class='align-right gutter-right'>";
		$line_total = ($cart_array['price'] - $total_item_discount) * $cart_array['qty'];
		if($line_total < 0) $line_total = 0;
		$cart_html .= "$".number_format($line_total,2); 
		$sub_total += $line_total;
		$cart_html .= "</p></div></div></div></div>";
		$i++;
	 }
}

$cart_html .= "<div class='hider'></div></div>";



$states = array();
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT state, state_abr 
		FROM states 
		WHERE hide = '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'  
		ORDER BY state"; 
$result = $dbCustom->getResult($db,$sql);	
$i = 0; 
while($row = $result->fetch_object()) {
	$states[$i]['state_abr'] = $row->state_abr;
	$states[$i]['state'] = $row->state;
	$i++;	
}


?>
