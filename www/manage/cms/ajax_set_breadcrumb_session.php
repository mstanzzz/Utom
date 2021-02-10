<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
$progress = new SetupProgress;
$module = new Module;

if(!isset($_SESSION['page_bc_array'])) $_SESSION['page_bc_array'] = array(); 
if(!isset($_SESSION['bc_page_title'])) $_SESSION['bc_page_title'] = ''; 

$sql = "SELECT page_seo_id, page_name 
		FROM page_seo 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		AND page_name != 'checkout'
		AND page_name != 'default'
		AND page_name != 'blog-more'
		";
	//if(!$module->hasAskModule($_SESSION['profile_account_id'])){
		//$sql .= " AND page_name != 'blog'";
		//$sql .= " AND page_name != 'social-network'";			
	//}		
    $sql .= " ORDER BY page_name";
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$result = $dbCustom->getResult($db,$sql);
$page_seo_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$page_seo_array[$i]['page_seo_id'] = $row->page_seo_id;	
	$page_seo_array[$i]['page_name'] = $row->page_name;	
	$i++;
}

$new_breadcrumb_label = (isset($_GET['new_breadcrumb_label']))? $_GET['new_breadcrumb_label'] : '';
$new_breadcrumb_order = (isset($_GET['new_breadcrumb_order']))? $_GET['new_breadcrumb_order'] : 0;
$action = (isset($_GET['action']))? $_GET['action'] : 0;
$new_display_order = (isset($_GET['new_display_order']))? $_GET['new_display_order'] : 0;
$new_page_seo_id = (isset($_GET['new_page_seo_id']))? $_GET['new_page_seo_id'] : 0;
$page_seo_id = (isset($_GET['page_seo_id']))? $_GET['page_seo_id'] : 0;
$new_text = (isset($_GET['new_text']))? $_GET['new_text'] : 0;
$new_bc_page_title = (isset($_GET['new_bc_page_title']))? $_GET['new_bc_page_title'] : 0;

if($action == "change_title"){
	$_SESSION['bc_page_title'] = $new_bc_page_title;
}

if($action == "change_label"){
	for($i = 0; $i < sizeof($_SESSION['page_bc_array']); $i++){
		if($_SESSION['page_bc_array'][$i]['page_seo_id'] == $page_seo_id){
			$_SESSION['page_bc_array'][$i]['text'] = $new_text;
		}
	}
}

if($action == "change_seo_id"){
	//echo $old_page_seo_id."   ".$new_page_seo_id."<br />";
	for($i = 0; $i < sizeof($_SESSION['page_bc_array']); $i++){
		if($_SESSION['page_bc_array'][$i]['page_seo_id'] == $page_seo_id){
			$_SESSION['page_bc_array'][$i]['page_seo_id'] = $new_page_seo_id;
		}
	}
}

if($action == "reorder"){
	if(is_numeric($new_display_order)){
		for($i = 0; $i < sizeof($_SESSION['page_bc_array']); $i++){
			if($_SESSION['page_bc_array'][$i]['page_seo_id'] == $page_seo_id){
				$_SESSION['page_bc_array'][$i]['display_order'] = $new_display_order;
			}
		}
	}
}

if($action == "remove"){
	$temp_array = array();
	$i = 0;
	foreach($_SESSION['page_bc_array'] as $val){ 
		//echo $val['page_seo_id']." ".$remove_page_seo_id."<br />"; 
		if($val['page_seo_id'] != $page_seo_id){
			$temp_array[$i]['text'] = $val['text'];
			$temp_array[$i]['page_seo_id'] = $val['page_seo_id'];
			$temp_array[$i]['display_order'] = $val['display_order'];
			$i++;
		}
	}
	
	//print_r($temp_array);
	$_SESSION['page_bc_array'] = $temp_array;
}



$bc_array_size = sizeof($_SESSION['page_bc_array']);

if($action == 'add'){
	$_SESSION['page_bc_array'][$bc_array_size]['text'] = $new_breadcrumb_label;
	$_SESSION['page_bc_array'][$bc_array_size]['page_seo_id'] = $new_page_seo_id;
	$_SESSION['page_bc_array'][$bc_array_size]['display_order'] = $new_breadcrumb_order;
	$bc_array_size++;
}

if($bc_array_size > 0){
	arraySort2d($_SESSION['page_bc_array'],"display_order");
}

$block = '';
$block .= "<div class='colcontainer formcols'>";
$block .= "<div class='twocols'>";
$block .= "<label>Breadcrumb Page Title</label>";
$block .= "</div>";
$block .= "<div class='twocols'>";
$block .= "<input onchange='update_bc_page_title()' id='bc_page_title' name='bc_page_title' type='text' value='".$_SESSION['bc_page_title']."' />";
$block .= "</div>";
$block .= "</div>";


$block .= "<div class='well'>";
$block .= "<span id='bc_home'><a href='#'>Home</a> &raquo;</span>";
$block .= "<span class='sortablebcs'>";	

$max_display_order = 0;
if($bc_array_size > 0){
	foreach($_SESSION['page_bc_array'] as $val){ 
		$block .= "<span class='bc'><a href='#'>".$val['text']."</a> &raquo; </span>";	
		if($max_display_order < $val['display_order']) $max_display_order = $val['display_order'];
	}
}
$block .= "</span>";	
$block .= "<span id='bc_title'>".$_SESSION['bc_page_title']."</span>";	
$block .= "</div>";	

$block .= "<div id='breadcrumb_container'>";	

//$test = "ttt";
//$block .= "<a onclick='test(\"".$test."\")'>TEST</a>";	

//order, label, link and on the add row we would have order, label, link would be the drop down then the add button. 
$block .= "<div class='breadcrumb_edit_group clearfix'>";	
$block .= "<div class='bc_col1'>Order</div>";
$block .= "<div class='bc_col2'>Link Label</div>";
$block .= "<div class='bc_col3'>Link Destination</div>";
$block .= "<div class='bc_col4'></div>";
$block .= "</div>";


//print_r($_SESSION['page_bc_array']);

if($bc_array_size > 0){
	foreach($_SESSION['page_bc_array'] as $val){ 
		$block .= "<div class='breadcrumb_edit_group clearfix'>";	
		$block .= "<div class='bc_col1'>";
$block .= "<input onchange='reorder_bc(\"".$val['page_seo_id']."\")' type='text' id='breadcrumb_order_".$val['page_seo_id']."' name='breadcrumb_order_".$val['page_seo_id']."' value='".$val['display_order']."' class='bc_order' />";
		$block .= "</div>";

		$block .= "<div class='bc_col2'>";
		$block .= "<input onchange='update_label(\"".$val['page_seo_id']."\")' id='breadcrumb_label_".$val['page_seo_id']."' name='breadcrumb_label_".$val['page_seo_id']."' type='text' value='".$val['text']."' class='bc_title' />";
		$block .= "</div>";
		
		
		$block .= "<div class='bc_col3'>";
		$block .= "<select onchange='update_seo_id(\"".$val['page_seo_id']."\")' id='page_seo_id_".$val['page_seo_id']."' name='page_seo_id_".$val['page_seo_id']."' style='width:160px;'>";
		$block .= "<option value='0'>select</option>";
		foreach($page_seo_array as $page_seo_val){			
			$selected = ($val['page_seo_id'] == $page_seo_val['page_seo_id'])? "selected" : '';
			$block .= "<option value='".$page_seo_val['page_seo_id']."'".$selected." >".$page_seo_val['page_name']."</option>";
		}
		$block .= "</select>";
		$block .= "</div>";
		
		$block .= "<div class='bc_col4'>";
		$block .= "<a onclick='remove_bc(\"".$val['page_seo_id']."\")' class='confirm btn btn-danger btn-tiny fltrt'><i class='icon-remove icon-white'></i></a>";
		$block .= "</div></div>";		
		$block .= "<script type='text/javascript'>$(document).ready(function(){	$('select[multiple]').multiselect({selectedList: 4}).multiselectfilter(); $('select').not('[multiple]').multiselect({multiple: false, selectedList: 1, minWidth: 120}).multiselectfilter();});</script>";
	
	}
}


// get order



$block .= "<div class='breadcrumb_edit_group clearfix'>";	
$block .= "<div class='bc_col1'>";
$block .= "<input type='text' id='new_breadcrumb_order' name='new_breadcrumb_order' value='".++$max_display_order."' class='bc_order' />";
$block .= "</div>";

		$block .= "<div class='bc_col2'>";
$block .= "<input id='new_breadcrumb_label' name='new_breadcrumb_label' type='text' value='' class='bc_title' />";
$block .= "</div>";
		
		
		$block .= "<div class='bc_col3'>";
$block .= "<select id='new_page_seo_id' name='new_page_seo_id' style='width:160px;'>";
$block .= "<option value='0'>select</option>";
foreach($page_seo_array as $page_seo_val){
	$block .= "<option value='".$page_seo_val['page_seo_id']."'>".$page_seo_val['page_name']."</option>";
}
$block .= "</select>";
$block .= "</div>";
		
	
		$block .= "<div class='bc_col4'>";
$block .= "<a onclick='add_breadcrumb()' class='add_breadcrumb btn btn-primary fltrt'><i class='icon-plus-sign icon-white'></i> Add </a>";	
$block .= "</div></div>";
				




$block .= "</div>";	
$block .= "</div>";
$block .= "<script type='text/javascript'>$(document).ready(function(){	$('select[multiple]').multiselect({selectedList: 4}).multiselectfilter(); $('select').not('[multiple]').multiselect({multiple: false, selectedList: 1, minWidth: 160}).multiselectfilter();});</script>";
echo $block;

?>
