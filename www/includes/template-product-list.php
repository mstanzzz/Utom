<?php	
if(!isset($shipping)){
	require_once('includes/class.shipping.php');
	$shipping = new Shipping;	
}

$page_count = ceil($num_products/$page_rows); 
if ($pagenum < 1){ 
	$pagenum = 1; 
}elseif ($pagenum > $page_count){ 
	$pagenum = $page_count; 
} 

$start_elmt = ($pagenum - 1) * $page_rows;

$max_elmt = $page_rows;

if(is_array($long_array)){
	$items_array = array_slice($long_array, $start_elmt, $max_elmt);
}else{
	unset($items_array);
	$items_array = array();
}	

		
		//$i = 0;
		$cols = 1;
			
		if(!strpos($_SERVER['REQUEST_URI'], 'default' )){		
			include('template-product-list-controls.php');
		}
		
		
		//we simply change the class from span9 to span3 to switch from list to grid view.
		if ($view_type == 'list') {
			$cols_class = 'span9';
		}else{
			$cols_class = 'span3';
		}
		
		
		$block = '';
		$block .="<div class='results'>";
			$block .="<div class='row'>";
			 foreach($items_array as $item){
				 
				if($item['show_in_cart']){
					$brand_name = getBrandName($item['brand_id']);
					$itemDetailUrl = $nav->getItemUrl($item['seo_url'], $item['name'], $item['profile_item_id'], $brand_name, 'shop');
				}else{
					$itemDetailUrl = $nav->getItemUrl($item['seo_url'], $item['name'], $item['profile_item_id'], '', 'showroom');
				}
				
				
				$imgdir = ($deviceType != 3 ? ($deviceType == 2 ? 'small' : 'small') : 'medium');
				
				$block .="<div class='".$cols_class."'>";
				
				$block .= "<div class='itembox'>";
					//<!-- image -->
					$block .="<span class='product-image'><a href='".$itemDetailUrl."'>";
					$block .="<img src='".$_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/".$imgdir."/".$item['file_name']."' 
					alt='".stripslashes($item['img_alt_text'])."'/></a></span>";
					//<!-- product name -->
					
					$block .="<span class='product_name'>"; //add this to css. Make font smaller and break text into multiple lines to prevent it intruding on price
					$block .="<h3><a href='".$itemDetailUrl."'>".stripAllSlashes($item['name'])."</a></h3>";
					$block .="</span>";
					//<!-- product id -->
					
					$block .="<h5><a href='".$itemDetailUrl."'>(Product Id: ".sprintf('%06d',$item['profile_item_id']).")</a></h5>";
					
					
					
					/*
					if(array_key_exists('internal_prod_number', $item)){
						if ($item['internal_prod_number'] != ''){
							$block .="<h5><a href='".$itemDetailUrl."'>(Mfg Id: ".$item['internal_prod_number'].")</a></h5>";
						}
					}
					*/


					if(array_key_exists('sku', $item)){
						if ($item['internal_prod_number'] != ''){
							$block .="<h5><a href='".$itemDetailUrl."'>(Mfg Id: ".$item['sku'].")</a></h5>";
						}
					}


					//<!--product price-->
					
					if($item['call_for_pricing'] || $item['price'] <= 0){
						
						if($item['show_atc_btn_or_cfp']){
							$block .="<span class='product-price'>Call For Price</span>".$item['call_for_pricing']."---".$item['price'];
						}
					
					}else{
						$block .="<span class='product-price'><strong>$".number_format($item['price'],2)."</strong> per ea.</span>";						
					}


					
					if($item['show_start_design_btn'] || $item['show_design_request_btn']){
						
						$block .= "<div style='float:right; margin-bottom:10px;'>";
						
						if($item['show_design_request_btn']){
							
							$d = $seo->get_url_from_page_name('email-design');
							
							$url = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$d.'.html?item_id='.$item['item_id'];
							
							$block .="<a style='margin-right:6px;' class='btn btn-success' href='".$url."' >Request Design</a>";
							
						}
						
						if($item['show_start_design_btn'] && $module->hasDesignToolModule($_SESSION['profile_account_id'])){
							
							$tool = $_SERVER['DOCUMENT_ROOT']."/tool-page.html";
							
							$block .="<a style='margin-left:6px;' class='btn btn-success' href='".$tool."' >Start Designing</a>";	
						}
					
						$block .= "</div>";
						
					}else{
						
						if(1){
							
								$block .="<span class='qty'>QTY:<input id='qty".$item['item_id']."' type='text' name='qty'  value='1' class='product-qty' /></span>";										
								$block .="<a class='btn btn-success add-to-cart' id='add_".$item['item_id']."' onClick=\"add_item('".$item['item_id']."')\">Add To Cart</a>";
							
						}
						
/*						
						if(has_add_to_cart_btn($module->hasShoppingCartModule($_SESSION['profile_account_id'])
							,$item['call_for_pricing']
							,$item['price']
							,$shipping->getShipType()
							,$item['weight']
							,$item['is_free_shipping']
							,$item['show_atc_btn_or_cfp'])){
						
								$block .="<span class='qty'>QTY:<input id='qty".$item['item_id']."' type='text' name='qty'  value='1' class='product-qty' /></span>";										
								$block .="<a class='btn btn-success add-to-cart' id='add_".$item['item_id']."' onClick=\"add_item('".$item['item_id']."')\">Add To Cart</a>";
							
						}
*/							
						
						/*
						if($module->hasShoppingCartModule($_SESSION['profile_account_id'])){
							if((!($shipping->getShipType() == 'carrier' && $item['weight'] == 0)) || $item['is_free_shipping'] > 0) {
								if(!$item['call_for_pricing'] && $item['price'] > 0 && $item['show_atc_btn_or_cfp'] > 0){
									$block .="<span class='qty'>QTY:<input id='qty".$item['item_id']."' type='text' name='qty'  value='1' class='product-qty' /></span>";										
									$block .="<a class='btn btn-success add-to-cart' id='add_".$item['item_id']."' onClick=\"add_item('".$item['item_id']."')\">Add To Cart</a>";
								}
							}						
						}
						*/
						
						
						
						
					}
				$block .="</div>";
			$block .="</div>";
				//$i++;
			} 
			
			$block .="</div>";
		$block .="</div>";
		echo $block;
		
		if(!strpos($_SERVER['REQUEST_URI'], "default" )){		
			include('template-product-list-controls.php');
		}
?>