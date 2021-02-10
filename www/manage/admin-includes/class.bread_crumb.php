<?php
class BreadCrumb{
	
	function __construct() {
		
		if(!isset($_SESSION['breadcrumb'])){
			$_SESSION['breadcrumb'] = array();
			$crumb = array();
			$crumb['label'] = "home";
			$crumb['url'] = $ste_root;
			$_SESSION['breadcrumb'][0] = $crumb;
		}
	}
	
	function reSet($label, $url)
	{
		$crumb = array();
		$crumb['label'] = $label;
		$crumb['url'] = $url;
		//echo $crumb['label']."   ".$crumb['url'];
		$_SESSION['breadcrumb'][1] = $crumb;
		$this->prune($label);
	}
	
	
	function reSetToHome()
	{
			$_SESSION['breadcrumb'] = array();
			$crumb = array();
			$crumb['label'] = "home";
			$crumb['url'] = $ste_root;
			$_SESSION['breadcrumb'][0] = $crumb;
	}
	

	
	function getLength()
	{
		$len = 0;
		
      	foreach ($_SESSION['breadcrumb'] as $crumb)
		{ 
		
			$len += $char_length = strlen($crumb["label"]);
		
		}
		
		return $len; 
	}
	
	
	function removeByIndex($indx = 1)
	{
		$tmp = array();		
		for($i=0; $i < count($_SESSION['breadcrumb']); $i++){
			if($i != $indx){
				if(isset($_SESSION['breadcrumb'][$i])){
					$tmp[$i]['label'] = $_SESSION['breadcrumb'][$i]['label'];
					//$_SESSION['breadcrumb'][$i]['label'] = $i;
					$tmp[$i]['url'] = $_SESSION['breadcrumb'][$i]['url'];
				}
			}
		}
		$_SESSION['breadcrumb'] = $tmp;
		//$array = array_values($_SESSION['breadcrumb']);
	}
	
	//function prune($level)
	function prune($label)
	{

      	foreach ($_SESSION['breadcrumb'] as $i => $crumb)
		{ 
			if($label == $crumb["label"]){
				
				while( $i < count($_SESSION['breadcrumb'])-1){
					array_pop($_SESSION['breadcrumb']);		
				}
			}
		}
	}


	function size()
	{
		return count($_SESSION['breadcrumb']);
	}

	function pop()
	{
		return array_pop($_SESSION['breadcrumb']);
	}

	function last()
	{
		return $_SESSION['breadcrumb'][count($_SESSION['breadcrumb'])-1];
	}
	function lastLabel()
	{
		return $_SESSION['breadcrumb'][count($_SESSION['breadcrumb'])-1]['label'];
	}



	function add($label, $url)
	{

		$crumb = array();
		$crumb['label'] = $label;
		$crumb['url'] = $url;

		$_SESSION['breadcrumb'][] = $crumb; 
		 
	}



	// this does nothing ?
	function show_black($label)
	{
		$ret = '';
		
		
      	foreach ($_SESSION['breadcrumb'] as $i => $crumb)
		{ 
		
			if($i == 0){
    	      	$ret .= "<li><a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a></li>";
				
			}else{
	          	$ret .= "<li><a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a></li>";
				
			}				
 
		}
				
		return "<ul class='breadcrumbs'>".stripslashes($ret)."</ul>";
	
	}



	function output()
	{
		$ret = '';
		$i = 0;
      	foreach ($_SESSION['breadcrumb'] as $crumb)
		{ 
			if($i == (count($_SESSION['breadcrumb']) -1)){
            	$ret .= "<li><span>".$crumb['label'].'</span></li>';
			}else{
            	$ret .= "<li><a href='".$crumb['url']."' title='".$crumb['label']."'>".$crumb['label']."</a></li>";
			}
			$i++;
		}
		return "<ul class='breadcrumbs'>".stripslashes($ret)."</ul>";
	}
	
	
}
?>