<!-- Begin Product List Controls -->
<?php	

//echo "cat_seo_url:  ".$cat_seo_url;

	
	if(!isset($cat_seo_url)) $cat_seo_url = '';
	if(!isset($cat_id)) $cat_id = 0;
	if(!isset($profile_cat_id)) $profile_cat_id = 0;
	if(!isset($brand_id)) $brand_id = 0;
	if(!isset($price_bottom)) $price_bottom = 0;
	if(!isset($price_top)) $price_top = 0;
	if(!isset($page_rows)) $page_rows = 0;
	if(!isset($sort)) $sort = 0;
	
	
	if(!isset($search_string)) $search_string = '';
	
	
	
	
	/* BRANDS ??????  */
	
	
	
	
	if(isset($searchpage)){			
		$dest_page='search-results.html';							
	}else{
		$dest_page='category.html';										
	}
	
	
	
	$url_str = $_SERVER['DOCUMENT_ROOT'].'/'.$cat_seo_url.$dest_page;
	
	//$url_str .= '?catId='.$cat_id;
	
	$url_str .= '?prodCatId='.$profile_cat_id;
	
	$url_str .= '&brandId='.$brand_id;
	
	
	if($price_top > 0){
		$url_str .= '&priceBottom='.$price_bottom;
		$url_str .= '&priceTop='.$price_top;
	}
	$url_str .= '&pageRows='.$page_rows;
	$url_str .= '&sort='.$sort;
	if($search_string != ''){
		$url_str .= '&search_string='.$search_string;
	}
	
	if(!isset($view_type)) $view_type = (isset($_COOKIE['view_type'])) ? $_COOKIE['view_type'] : 'list';
	
	//$url_str .= '&search_str='.$itemListData['search_str'];
		
	$perpage6 = ($page_rows == 6) ? 'selected' : '';
	$perpage12 = ($page_rows == 12) ? 'selected' : '';
	$perpage24 = ($page_rows == 24) ? 'selected' : '';
	$perpage30 = ($page_rows == 30) ? 'selected' : '';
		
	$active = '';
	$block = '';
	$block .= "<div class='row'>";
	$block .= "<div class='span9 search-controls search-controls-top'>";
	$block .= "<span class='result-summary'>".$num_products." Products Found</span>";
	$block .= "<span class='display-type'>";
	$block .= "<em class='hide-mobile'>View: </em>";

	$active = ($view_type == 'list') ? 'active' : '';

	$block .= "<a class='list-view' onclick='makeListView()'><i class='list-icon $active'></i></a>";

	$active = ($view_type == 'grid') ? 'active' : '';

	$block .= "<a onclick='makeGridView()' class='grid-view'><i class='grid-icon $active'></i></a></span>";




	if($num_products > 6){

	
		$block .= "<span class='pagination'>";
		//<!-- first page -->
		$active = ($pagenum > 1) ? 'active' : '';
		$block .= "<a href='".$url_str."&pagenum=1' class='paging-first'><i class='paging-icon-first ".$active."'></i></a>";
		//<!-- previous page -->
		$p = $pagenum-1;
		$block .= "<a href='".$url_str."&pagenum=".$p."' class='paging-previous'><i class='paging-icon-previous ".$active."'></i></a>";
		//<!-- current out of total pages -->
		$block .= "Page ".$pagenum."/<a href='".$url_str."&pagenum=".$page_count."' class='paging-last'>".$page_count."</a>";
		//<!-- next page -->
		$active = ($pagenum < $page_count) ? 'active' : '';
	
		$p = $pagenum+1;
		$block .= "<a href='".$url_str."&pagenum=".$p."' class='paging-next'><i class='paging-icon-next ".$active."'></i></a>";
		//<!-- last page -->
		$block .= "<a href='".$url_str."&pagenum=".$page_count."' class='paging-last'><i class='paging-icon-last ".$active."'></i></a>";
		$block .= "</span>";
		$block .= "<span class='results-per-page'>";
		
		
		
		$block .= "<form action='".$_SERVER['DOCUMENT_ROOT']."/".$cat_seo_url.$dest_page."' method='get' enctype='multipart/form-data'>";										
		
		//$block .= "<input type='hidden' name='catId' value='".$cat_id."'>";
		
		$block .= "<input type='hidden' name='prodCatId' value='".$profile_cat_id."'>";
		
		$block .= "<input type='hidden' name='brandId' value='".$brand_id."'>";
		if($price_top > 0){
			$block .= "<input type='hidden' name='priceBottom' value='".$price_bottom."'>";
			$block .= "<input type='hidden' name='priceTop' value='".$price_top."'>";
		}
		$block .= "<select name='pageRows' onChange='submit_per_page_form($(this))'>";
		$block .= "<option value='6' $perpage6>6</option>";
		if($num_products > 6){					
			$block .= "<option value='12' $perpage12>12</option>";		
			if($num_products > 12){
				$block .= "<option value='24' $perpage24>24</option>";
				if($num_products > 24){
					$block .= "<option value='30' $perpage30>30</option>";
				}
			}
		}
		$block .= "</select>";

		$block .= "<input type='hidden' name='sort' value='".$sort."'>";
		$block .= "<input type='hidden' name='pagenum' value='".$pagenum."'>";
		
		if($search_string != ''){
			$block .= "<input type='hidden' name='search_string' value='".$search_string."'>";
		}
		
		$block .= "</form>";
		$block .= "<em class='hide-mobile'>per pg.</em>";
		$block .= "</span>";
		
	}
	


	$block .= "<span class='sort-results'>";
	$block .= "<em class='hide-mobile'>Sort:</em>";
	
	$block .= "<form action='".$_SERVER['DOCUMENT_ROOT']."/".$cat_seo_url.$dest_page."' method='get' enctype='multipart/form-data'>";	
	
	
							
	//$block .= "<input type='hidden' name='catId' value='".$cat_id."'>";
	
	$block .= "<input type='hidden' name='prodCatId' value='".$profile_cat_id."'>";
	
	$block .= "<input type='hidden' name='brandId' value='".$brand_id."'>";
	if($price_top > 0){
		$block .= "<input type='hidden' name='priceBottom' value='".$price_bottom."'>";
		$block .= "<input type='hidden' name='priceTop' value='".$price_top."'>";
	}
	$block .= "<input type='hidden' name='pageRows' value='".$page_rows."'>";	
	$block .= "<select name='sort' onChange='submit_sort_form($(this))'>";
	$block .= "<option value=''>Sort</option>";	
	$block .= "<option value='price_asc'>Price: Low to High</option>";
	$block .= "<option value='price_desc'>Price: High to Low</option>";
	$block .= "<option value='featured'>Featured</option>";
	$block .= "</select>";
	$block .= "<input type='hidden' name='pagenum' value='".$pagenum."'>";
	if($search_string != ''){
		$block .= "<input type='hidden' name='search_string' value='".$search_string."'>";	
	}
	$block .= "</form>";

	$block .= "</span>";
	$block .= "</div>";
	$block .= "</div>";
	echo $block;
 ?>
