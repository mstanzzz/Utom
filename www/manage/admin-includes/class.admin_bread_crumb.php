<?php

class AdminBreadCrumb{
	
	function __construct() {
		
		if(!isset($_SESSION['admin_breadcrumb'])){
			$_SESSION['admin_breadcrumb'] = array();
			$crumb = array();
			$crumb['label'] = "home";
			$crumb['url'] = $ste_root."manage/start.php";
			$_SESSION['admin_breadcrumb'][0] = $crumb;
		}
	}

	
	function reSet()
	{
		//unset($_SESSION['admin_breadcrumb']);
		$_SESSION['admin_breadcrumb'] = array();
		$crumb = array();
		$crumb['label'] = "home";
		$crumb['url'] = $ste_root."manage/start.php";
		$_SESSION['admin_breadcrumb'][0] = $crumb;
	}

	function crumb_count()
	{
		return count($_SESSION['admin_breadcrumb']);	
	}

	//function prune($level)
	function prune($label)
	{
      	foreach ($_SESSION['admin_breadcrumb'] as $i => $crumb)
		{ 
			if($label == $crumb['label']){
				
				while( $i < count($_SESSION['admin_breadcrumb'])-1){
					array_pop($_SESSION['admin_breadcrumb']);		
				}
			}
		}
	}

	function remove_duplicate($label){
		
		$t = array();
		$i = 0;
      	foreach ($_SESSION['admin_breadcrumb'] as $crumb)
		{ 
			if($crumb['label'] != $label){
				$t[$i]['label'] = $crumb['label'];
				$t[$i]['url'] = $crumb['url'];
				$i++;
			}
		}
		$_SESSION['admin_breadcrumb'] = $t;		
	}

	function add($label, $url)
	{

		// remove duplicate is exists
		$this->remove_duplicate($label); 

		$crumb = array();
		$crumb['label'] = $label;
		$crumb['url'] = $url;
		$_SESSION['admin_breadcrumb'][] = $crumb; 
	}


	function output()
	{
		$ret = '';
      	foreach ($_SESSION['admin_breadcrumb'] as $i => $crumb)
		{ 
			if($i > 0){
				$img = "  <img src='".$ste_root."/images/double_arrow.jpg'>";
			}else{
				$img = '';
			}
				
			if($i == (count($_SESSION['admin_breadcrumb']) -1)){
            	$ret .= $img.'  '.$crumb['label'];
			}else{
            	$ret .= $img."  <a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a>";
			}
		}
		return "<div class='breadcrumb'>".stripslashes($ret)."</div>";
	}



	
	
}




?> 