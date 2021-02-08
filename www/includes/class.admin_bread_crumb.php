<?php

class AdminBreadCrumb{
	
	function __construct() {
		
		if(!isset($_SESSION['admin_breadcrumb'])){
			$_SESSION['admin_breadcrumb'] = array();
			$crumb = array();
			$crumb['label'] = "home";
			$crumb['url'] = $_SERVER['DOCUMENT_ROOT']."/manage/start.php";
			$_SESSION['admin_breadcrumb'][0] = $crumb;
		}
	}
	
	function reSet($label = '', $url = '')
	{
		unset($_SESSION['admin_breadcrumb']);
		$_SESSION['admin_breadcrumb'] = array();
		$crumb = array();
		$crumb['label'] = "home";
		$crumb['url'] = $_SERVER['DOCUMENT_ROOT']."/manage/start.php";
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
			if($label == $crumb["label"]){
				while( $i < count($_SESSION['admin_breadcrumb'])-1){
					array_pop($_SESSION['admin_breadcrumb']);		
				}
			}
		}
	}

	function count()
	{
		$crumb = array();
		$crumb['label'] = $label;
		$crumb['url'] = $url;

		$_SESSION['admin_breadcrumb'][] = $crumb; 
		 
	}

	function show_black($label)
	{
		$img = "  <img src='".$_SERVER['DOCUMENT_ROOT']."/images/double_arrow.jpg'>";
	    return $img."  ".$label;
	}

	function add($label, $url)
	{
		$crumb = array();
		$crumb['label'] = $label;
		$crumb['url'] = $url;

		$_SESSION['admin_breadcrumb'][] = $crumb; 
	}

	function getLength()
	{
		$len = 0;
		
      	foreach ($_SESSION['admin_breadcrumb'] as $crumb)
		{ 
			$len += $char_length = strlen($crumb["label"]);
		}
		return $len; 
	}
	
	
	function removeByIndex($indx = 1)
	{
		//$i = 0;
		$tmp = array();		

		for($i=0; $i < count($_SESSION['breadcrumb']); $i++){

			if($i != $indx){
					$tmp[$i]['label'] = $_SESSION['admin_breadcrumb'][$i]['label'];
					//$_SESSION['breadcrumb'][$i]['label'] = $i;
					$tmp[$i]['url'] = $_SESSION['admin_breadcrumb'][$i]['url'];
					$i++;	
			}
		}

		$_SESSION['admin_breadcrumb'] = $tmp;
		
	}




	function output()
	{
		
		$ret = '';
		
      	foreach ($_SESSION['admin_breadcrumb'] as $i => $crumb)
		{ 
		
				if($i > 0){
					$img = "  <img src='".$_SERVER['DOCUMENT_ROOT']."/images/double_arrow.jpg'>";
				}else{
					$img = '';
				}
				
			if($i == (count($_SESSION['admin_breadcrumb']) -1)){
					
						
	            	$ret .= $img."  ".$crumb['label'].'';

			}else{
				
            	$ret .= $img."  <a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a>";


			}
			
			
		}
		
		
		
		return "<div class='breadcrumb'>".stripslashes($ret)."</div>";
	}



	
	
}




?> 