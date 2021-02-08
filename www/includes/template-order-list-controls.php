<!-- Begin Product List Controls -->
<?php
	
	if(!isset($search_str)) $search_str = '';
	if(!isset($sort)) $sort = 'date_asc';
	if(!isset($page_rows)) $page_rows = 6;
	if(!isset($pagenum)) $pagenum = 1;
	if(!isset($view_type)) $view_type = 'grid';
	if(!isset($group_view_type)) $group_view_type = '';

	if(!isset($total_rows)) $total_rows = 0;




	
	if(!isset($submit_to_page)){
		$submit_to_page = 'order-history.html';
	}
	
	
	$perpage6 = ($page_rows == 6) ? 'selected' : '';
	$perpage12 = ($page_rows == 12) ? 'selected' : '';
	$perpage24 = ($page_rows == 24) ? 'selected' : '';
	$perpage30 = ($page_rows == 30) ? 'selected' : '';
		
	$active = '';
	$block = '';

	$url_str = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$submit_to_page;
	
	$block .= "<div class='row'>";
	$block .= "<div class='span9 search-controls search-controls-top'>";
	$block .= "<span class='search-orders'>";	
	$block .= "<form action='".$url_str."' method='get' enctype='multipart/form-data'>";
	$block .= "<input type='hidden' name='pageRows' value='".$page_rows."'>";	
	$block .= "<input type='hidden' name='sort' value='".$sort."'>";
	$block .= "<input type='hidden' name='pagenum' value='".$pagenum."'>";
	$block .= "<input type='hidden' name='groupViewType' value='".$group_view_type."'>";
    
	$block .= "<input type='search' name='searchStr' />";
	$block .= "<button class='btn btn-primary btn-mini'><i class='search-icon-large'></i></button>";
	$block .= "</form>";
	$block .= "</span>";
	$block .= "<span class='display-type hide-mobile'>";
	$block .= "View: ";
	
	$active = ($view_type == 'list') ? '' : 'active';
	$block .= "<a class='list-view' href='#'><i class='list-icon $active'></i></a>";
	$active = ($view_type == 'grid') ? '' : 'active';
	$block .= "<a class='grid-view'><i class='grid-icon $active'></i></a></span>";
	$block .= "<span class='pagination'>";




	if($total_rows > 6){
		
		$url_str .= '?sort='.$sort;
		$url_str .= '&groupViewVype='.$group_view_type;
		$url_str .= '&pageRows='.$page_rows;
		$url_str .= '&searchStr='.$search_str;
		
		//<!-- first page -->
		$active = ($pagenum > 1) ? 'active' : '';
		$block .= "<a href='".$url_str."&pagenum=1' class='paging-first'><i class='paging-icon-first ".$active."'></i></a>";
		//<!-- previous page -->
		$p = $pagenum-1;
		$block .= "<a href='".$url_str."&pagenum=".$p."' class='paging-previous'><i class='paging-icon-previous ".$active."'></i></a>";
		//<!-- current out of total pages -->
		$block .= "Page ".$pagenum."/<a href='".$url_str."&pagenum=".$last."' class='paging-last'>".$last."</a>";
		//<!-- next page -->
		$active = ($pagenum < $last) ? 'active' : '';
		$p = $pagenum+1;
		$block .= "<a href='".$url_str."&pagenum=".$p."' class='paging-next'><i class='paging-icon-next ".$active."'></i></a>";
		//<!-- last page -->
		$block .= "<a href='".$url_str."&pagenum=".$last."' class='paging-last'><i class='paging-icon-last ".$active."'></i></a>";
		$block .= "</span>";
		
		
		$block .= "<span class='results-per-page'>";
	
		$url_str = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$submit_to_page;
		$block .= "<form action='".$url_str."' method='get' enctype='multipart/form-data'>";							
		$block .= "<input type='hidden' name='searchStr' value='".$search_str."'>";
		$block .= "<input type='hidden' name='sort' value='".$sort."'>";
		$block .= "<input type='hidden' name='pagenum' value='".$pagenum."'>";
		$block .= "<input type='hidden' name='groupViewType' value='".$group_view_type."'>";
	
		$block .= "<select name='pageRows' onChange='submit_per_page_form($(this))'>";
		$block .= "<option value='6' $perpage6>6</option>";
		
		if($total_rows > 12){					
			$block .= "<option value='12' $perpage12>12</option>";		
			if($total_rows > 24){
				$block .= "<option value='24' $perpage24>24</option>";
				if($total_rows > 30){
					$block .= "<option value='30' $perpage30>30</option>";
				}
			}
		}
		$block .= "</select>";
		$block .= "</form>";
		$block .= "per pg.";
		$block .= "</span>";
		$block .= "<span class='sort-results'>";
	}




	$url_str = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['global_url_word'].$submit_to_page;

	$block .= "Sort:";
	$block .= "<form action='".$url_str."' method='get' enctype='multipart/form-data'>";							
	$block .= "<input type='hidden' name='searchStr' value='".$search_str."'>";
	$block .= "<input type='hidden' name='pageRows' value='".$page_rows."'>";
	$block .= "<input type='hidden' name='pagenum' value='".$pagenum."'>";
	$block .= "<input type='hidden' name='groupViewType' value='".$group_view_type."'>";

	$block .= "<select name='sort' onChange='submit_sort_form($(this))'>";		
	$active = ($sort == 'date_asc')? 'selected' : '';	
	$block .= "<option value='date_asc' ".$active.">Newest First</option>";
	$active = ($sort == 'date_desc')? 'selected' : '';
	$block .= "<option value='date_desc' ".$active.">Oldest First</option>";
	//$block .= "<option value='date_asc'>Newest First</option>";
	//$block .= "<option value='date_desc'>Oldest First</option>";
	
	$block .= "</select>";
	$block .= "</form>";
	$block .= "</span>";
	$block .= "</div>";
	$block .= "</div>";
	echo $block;
 ?>
