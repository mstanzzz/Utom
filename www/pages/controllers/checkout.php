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


$cart_contents_array = $cart->getContents();
foreach($cart_contents_array as $cart_array) {
		$item_array = $item->getItem($dbCustom,$cart_array['item_id']);
		//$total_tax += $item_tax; 
		//$brand_name = getBrandName($item_array['brand_id']);
		
		//$cart_array['item_id']
		
		//<img src='".SITEROOT."//saascustuploads/".$_SESSION['profile_account_id']."/cart//.$item_array['file_name']."' 
		//stripslashes($item_array['name'])
		//$cart_array['qty']
		//$line_total = ($cart_array['price'] - $total_item_discount) * $cart_array['qty'];
		//if($line_total < 0) $line_total = 0;
		//"$".number_format($line_total,2); 
		//$sub_total += $line_total;

	$cart_html .= "<div class='card card-checkout'>";
	$cart_html .= "<div class='card-checkout__remove-item'>";
	$cart_html .= "<button class='p-0'>";
	$cart_html .= "<img class='img-fluid' src='<?php echo SITEROOT; ?>images/icon-close.svg' alt=''>";
	$cart_html .= "</button>";
	$cart_html .= "</div>";
	$cart_html .= "<div class='card-body d-flex align-items-center'>";
	$cart_html .= "<div class='card-checkout__product__image mr-3'>";
	$cart_html .= "<div class='img-wrap'>";
	$cart_html .= "<img src='<?php echo SITEROOT; ?>images/hardware-resources-knob-oil-rubbed-bronze.png'";
	$cart_html .= "class='img-fluid' alt=''>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
	$cart_html .= "<div class='card-checkout__product'>";
	$cart_html .= "<div class='row align-items-end align-items-lg-center'>";
	$cart_html .= "<div class='col card-checkout__product__title-wrap'>";
	$cart_html .= "<h5 class='card-checkout__product__title'>Special title treatment</h5>";
	$cart_html .= "<p class='card-checkout__product__number'>Product Id: 000168</p>";
	$cart_html .= "</div>";
	//SHOW THIS ON MOBILE SCREEN
	$cart_html .= "<div class='col-auto card-el__show-on-md '>";
	$cart_html .= "<p class='card-checkout__product__label'>";
	$cart_html .= "<span class='card-el__hide-on-md'>Price:</span>";
	$cart_html .= "<span class='card-checkout__product__label-value mark-color'>$44.44</span>";
	$cart_html .= "</p>";
	$cart_html .= "</div>";					
	$cart_html .= "</div>";
	
	//SHOW THIS ON DESKTOP SCREEN
	$cart_html .= "<p class='card-checkout__product__description card-el__hide-on-md'>";
	$cart_html .= "Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob.
						Works well in offices and any closet alike. Available colors:
						Brushed
						Chrome, Oil Rubbed Bronze and Polished Chrome.";
	$cart_html .= "</p>";
				
	$cart_html .= "<div class='d-flex align-items-center justify-content-end justify-content-lg-between mt-2 mt-md-0'>";
	
	//SHOW THIS ON DESKTOP SCREEN
	$cart_html .= "<div class='card-el__hide-on-md'>";
	$cart_html .= "<p class='card-checkout__product__label'>";
	$cart_html .= "<span>Unit Price:</span>"; 
	$cart_html .= "<span class='card-checkout__product__label-value'>$22.22</span>";
	$cart_html .= "</p>";
	$cart_html .= "</div>";

	$cart_html .= "<div class='card-checkout__product__label__buttons__wrap'>";
	//SHOW THIS ON DESKTOP SCREEN
	
	$cart_html .= "<p class='card-checkout__product__label card-el__hide-on-md'>";
	$cart_html .= "<label for='checkbox-quantity-10'>Quantity: </label>";
	$cart_html .= "<span class='input-wrap'>";
	$cart_html .= "<span class='input-wrap__quantity-mark'>x</span>";
	$cart_html .= "<input id='checkbox-quantity-10' type='number' min='0'";
	$cart_html .= " class='card-checkout__product__label-value input'";
	$cart_html .= " value='2'/>";
	$cart_html .= "</span>";
	$cart_html .= "</p>";
						
	$cart_html .= "<div class='card-checkout__product__label__buttons card-el__show-on-md'>";
	$cart_html .= "<span class='butones minus'>-</span>";
	$cart_html .= "<input class='text' type='text' value='1' id='prod-1'/>";
	$cart_html .= "<span class='butones plus'>+</span>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";

	//SHOW THIS ON DESKTOP SCREEN
	$cart_html .= "<div class='card-el__hide-on-md'>";
	$cart_html .= "<p class='card-checkout__product__label'>";
	$cart_html .= "Price:";
	$cart_html .= "<span class='card-checkout__product__label-value mark-color'>$44.44</span>";
	$cart_html .= "</p>";
	$cart_html .= "</div>";
				
	$cart_html .= "<div>";
	$cart_html .= "<div class='idea-folder-on-md'>";
	$cart_html .= "<p class='card-checkout__product__label card-checkout__product__label__sm justify-content-end'>";
	$cart_html .= "<a href='' title='' class='link hover__ltr'>";
	$cart_html .= "<span class='icon-wrap'>";
	$cart_html .= "<svg id='Save' xmlns='http://www.w3.org/2000/svg' width='25.6' height='23.023' viewBox='0 0 25.6 23.023'>";
	$cart_html .= "<path id='Path_205' data-name='Path 205'";
	
	$cart_html .= "d='M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z'";
	$cart_html .= "transform='translate(0 -0.963)'/>";
	$cart_html .= "<path id='Path_207' data-name='Path 207'";
	$cart_html .= "d='M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z'";
	$cart_html .= "transform='translate(13.1 24)' />";
	$cart_html .= "</svg>";
	$cart_html .= "</span>";
	
	//SHOW THIS ON DESKTOP SCREEN
	$cart_html .= "<span class='card-el__hide-on-md'>";
	$cart_html .= "Save to idea folder";
	$cart_html .= "</span>";
	$cart_html .= "</a>";
	$cart_html .= "</p>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
	$cart_html .= "</div>";
		
}














$states = array();
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT state_id, state, state_abr 
		FROM states 
		WHERE hide = '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'  
		ORDER BY state"; 
$result = $dbCustom->getResult($db,$sql);	
$i = 0; 
while($row = $result->fetch_object()) {
	$states[$i]['state_id'] = $row->state_id;	
	$states[$i]['state_abr'] = $row->state_abr;
	$states[$i]['state'] = $row->state;
	$i++;	
}

$countries = array();
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT country_id, country, country_abr 
		FROM countries 
		WHERE hide = '0'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'  
		ORDER BY country"; 
$result = $dbCustom->getResult($db,$sql);	
$i = 0; 
while($row = $result->fetch_object()) {
	$countries[$i]['country_id'] = $row->country_id;	
	$countries[$i]['country_abr'] = $row->country_abr;
	$countries[$i]['country'] = $row->country;
	$i++;	
}





?>
