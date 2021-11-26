<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');
require_once($real_root.'/includes/class.nav.php');

$progress = new SetupProgress;
$module = new Module;
$nav = new Nav;

$page_title = "Top Categories";
$page_group = "top-cat";

$msg = '';

unset($_SESSION['from_top_cats']);


function get_svg_icon($svg_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$ret_array['name']='';
	$ret_array['svg_code']='';	
	$sql = "SELECT svg_code, name
			FROM svg
			WHERE svg_id = '".$svg_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		
		$ret_array['name'] = $object->name;
		$ret_array['svg_code'] = $object->svg_code;		
		
	}
	return  $ret_array;
}


$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$fb = (!$strip) ? "fancybox fancybox.iframe" : ''; 
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : '';

if(isset($_POST['add_top_cat'])){
	$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : ''; 
	if(!is_numeric($img_id)) $img_id = 0;
	$restricted_attributes = (isset($_POST['restricted_attributes']))? $_POST['restricted_attributes'] : array();
	$name = (isset($_POST['name']))? trim(addslashes($_POST['name'])) : '';
	$short_name = (isset($_POST['short_name']))? trim(addslashes($_POST['short_name'])) : '';
	$tool_tip = (isset($_POST['tool_tip']))? trim(addslashes($_POST['tool_tip'])) : '';
	$description = (isset($_POST['description']))? trim(addslashes($_POST['description'])) : '';
	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;
	if(!is_numeric($show_on_home_page)) $show_on_home_page = 0;
	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	if(!is_numeric($show_in_cart)) $show_in_cart = 0;
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;
	if(!is_numeric($show_in_showroom)) $show_in_showroom = 0;
	$img_alt_text = (isset($_POST['img_alt_text'])) ? $_POST['img_alt_text'] : '';
	$key_words = (isset($_POST['key_words'])) ? $_POST['key_words'] : '';
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;
	
	$svg_id = (isset($_POST['svg_id'])) ? $_POST['svg_id'] : 0;
	
	$sql = "SELECT max(profile_cat_id) AS profile_cat_id 
			FROM category 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$res = $dbCustom->getResult($db,$sql);		
	
	if(!$res->num_rows){
		$profile_cat_id = 1;
	}else{
		$object = $res->fetch_object();
		$profile_cat_id = $object->profile_cat_id + 1; 	
	}
	
	$sql = sprintf("INSERT INTO category 
		(name
		,short_name
		,tool_tip
		,description
		,img_id
		,img_alt_text
		,key_words
		,show_on_home_page
		,show_in_cart
		,show_in_showroom
		,profile_cat_id
		,showroom_item_display_priority
		,svg_id
		,profile_account_id) 
		VALUES ('%s','%s','%s','%s','%u','%s','%s','%u','%u','%u','%u','%u','%u','%u')", 
		$name
		,$short_name
		,$tool_tip
		,$description
		,$img_id
		,$img_alt_text
		,$key_words
		,$show_on_home_page
		,$show_in_cart
		,$show_in_showroom
		,$profile_cat_id
		,$showroom_item_display_priority
		,$svg_id
		,$_SESSION['profile_account_id']);		
	$res = $dbCustom->getResult($db,$sql);
				 
	$cat_id = $db->insert_id;
	$msg = 'Your change is now live.';
	
	
	foreach($restricted_attributes as $val){
		$sql = "INSERT INTO category_to_attr
				(attribute_id, cat_id)
				VALUES
				('".$val."', '".$cat_id."')";		
		$res = $dbCustom->getResult($db,$sql);		
	}
	
	
}


if(isset($_POST['edit_top_cat'])){

	$cat_id = (isset($_POST['cat_id']))? $_POST['cat_id'] : ''; 
	if(!is_numeric($cat_id)) $cat_id = 0;
	$img_id = (isset($_POST['img_id']))? $_POST['img_id'] : ''; 
	if(!is_numeric($img_id)) $img_id = 0;
	
	$name = (isset($_POST['name']))? trim(addslashes($_POST['name'])) : '';

	$short_name = (isset($_POST['short_name']))? trim(addslashes($_POST['short_name'])) : '';
	$tool_tip = (isset($_POST['tool_tip']))? trim(addslashes($_POST['tool_tip'])) : '';
	$description = (isset($_POST['description']))? trim(addslashes($_POST['description'])) : '';
	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;
	if(!is_numeric($show_on_home_page)) $show_on_home_page = 0;
	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	if(!is_numeric($show_in_cart)) $show_in_cart = 0;
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;
	if(!is_numeric($show_in_showroom)) $show_in_showroom = 0;
	$img_alt_text = (isset($_POST['img_alt_text'])) ? $_POST['img_alt_text'] : '';
	$key_words = (isset($_POST['key_words'])) ? $_POST['key_words'] : '';
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;
	$restricted_attributes = (isset($_POST['restricted_attributes']))? $_POST['restricted_attributes'] : array();
	$original_name = '';
	$restricted_attributes = (isset($_POST['restricted_attributes']))? $_POST['restricted_attributes'] : array();
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;

	$svg_id = (isset($_POST['svg_id'])) ? $_POST['svg_id'] : 0;


	$sql = "UPDATE category 
			SET name = '".$name."'
			,short_name = '".$short_name."'
			,tool_tip = '".$tool_tip."'
			,description = '".$description."'
			,img_id = '".$img_id."'
			,img_alt_text = '".$img_alt_text."'
			,key_words = '".$key_words."'
			,show_on_home_page = '".$show_on_home_page."'
			,show_in_cart = '".$show_in_cart."'
			,show_in_showroom = '".$show_in_showroom."'
			,showroom_item_display_priority = '".$showroom_item_display_priority."'
			,svg_id = '".$svg_id."'	
	WHERE cat_id = '".$cat_id."'";
	$res = $dbCustom->getResult($db,$sql);
	
	$profile_cat_id = $cat_id;

}

if(isset($_POST['set_active_and_display_order'])){
	
	$cat_ids  = isset($_POST['cat_ids'])? $_POST['cat_ids'] : array();
	$display_orders  = isset($_POST['display_orders'])? $_POST['display_orders'] : array();
	$actives = (isset($_POST['active']))? $_POST['active'] : array();	
	$cats_from_page_array = explode(',',$_POST['cats_from_this_page']);

	foreach($cats_from_page_array as $cat_id){
		if(is_numeric($cat_id)){
			$sql = "UPDATE category 
					SET active = '0' 
					WHERE cat_id = '".$cat_id."'";
			$result = $dbCustom->getResult($db,$sql);		
		}
	}
	
	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE category SET active = '1' WHERE cat_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}
	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			
			$sql = sprintf("UPDATE category 
				SET display_order = '%u'  
				WHERE cat_id = '%u'",
				$display_orders[$i], $cat_ids[$i]);

			$result = $dbCustom->getResult($db,$sql);
			
		}
	}
	$msg = 'Changes Saved.';

}

if(isset($_POST['del_cat_id'])){

	$cat_id = $_POST['del_cat_id'];
	$sql = "DELETE FROM child_cat_to_parent_cat 
			WHERE child_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	$sql = sprintf("DELETE FROM category WHERE cat_id = '%u'", $cat_id);
	$result = $dbCustom->getResult($db,$sql);
	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "SELECT img_id
			FROM category
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object();
		$img_id = $object->img_id; 
		$sql = "SELECT file_name
				FROM image
				WHERE img_id = '".$img_id."'";
		$res = $dbCustom->getResult($db,$sql);
		if($res->num_rows > 0){	
			$obj = $res->fetch_object();
			
			echo $file_name = $obj->file_name; 
			
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$file_name;
			if(file_exists($p)) unlink($p);

			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$file_name;
			if(file_exists($p)) unlink($p);

			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$file_name;
			if(file_exists($p)) unlink($p);
			
			/* **** wide **** */
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/wide/".$file_name;
			if(file_exists($p)) unlink($p);

			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/wide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/wide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/wide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$file_name;
			if(file_exists($p)) unlink($p);
			
			/* **** extra wide **** */
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/exwide/".$file_name;
			if(file_exists($p)) unlink($p);

			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/exwide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/exwide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$file_name;
			if(file_exists($p)) unlink($p);
						
			$p = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/large/exwide/".$file_name;
			if(file_exists($p)) unlink($p);
			
			$sql = sprintf("DELETE FROM image 
							WHERE img_id = '%u'
							AND profile_account_id = '%u'", $img_id, $_SESSION['profile_account_id']);
			$result = $dbCustom->getResult($db,$sql);

		}		
	}	
	$msg = 'Your change is now live.';
}

unset($_SESSION['temp_cat_fields']);
unset($_SESSION['temp_attr_ids']);
unset($_SESSION['temp_cats']);
unset($_SESSION['cat_id']);
unset($_SESSION['parent_cat_id']);
unset($_SESSION['paging']);
unset($_SESSION['img_id']);
unset($_SESSION['search_str']);
unset($_SESSION['top_cats']);
unset($_SESSION['nav_bar_cats']);
unset($_SESSION['item_id']);
unset($_SESSION['side_nav_showroom_cats']); // frontend class.nav
unset($_SESSION['top_showroom_cats']); // frontend class.nav
unset($_SESSION['home_cats']); // frontend class.nav
unset($_SESSION['footer_nav_cats']); // frontend class.nav
unset($_SESSION['ret_path']);
unset($_SESSION['ret_dir']);
unset($_SESSION['ret_page']);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>

<script>

function regularSubmit() {
  document.form.submit(); 
}	

</script>

</head>
<body>

<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">

	<?php
	
	$total_top_cats = array();
	$top_cats = array();

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT cat_id
			,name
			,img_id
			,show_on_home_page
			,display_order
			,active
			,show_in_showroom
			,svg_id
			,click_count			
	FROM category 
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";

	$search_str = (isset($_REQUEST["search_str"])) ?  trim(addslashes($_REQUEST["search_str"])) : ''; 		
	if($search_str != ''){
		if(is_numeric($search_str)){
			$sql .= " AND (category.cat_id = '".$search_str."%' || category.profile_cat_id = '".$search_str."')";			
		}else{
			$sql .= " AND category.name like '%".$search_str."%'";
		}
	}
	if($sortby != ''){
		if($sortby == 'name'){
			if($a_d == 'd'){
				$sql .= " ORDER BY name DESC";
			}else{
				$sql .= " ORDER BY name";		
			}
		}			
		if($sortby == 'click_count'){
			if($a_d == 'd'){
				$sql .= " ORDER BY click_count DESC";
			}else{
				$sql .= " ORDER BY click_count";		
			}
		}
		
			
	}else{
		$sql .= " ORDER BY cat_id";					
	}
	$result = $dbCustom->getResult($db,$sql);				
	$i = 0;
	while($row = $result->fetch_object()) {
		$total_top_cats[$i]['cat_id'] = $row->cat_id;
		$total_top_cats[$i]['name'] = $row->name;
		$total_top_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
		$total_top_cats[$i]["display_order"] = $row->display_order;
		$total_top_cats[$i]["active"] = $row->active;
		$total_top_cats[$i]['show_in_showroom'] = $row->show_in_showroom;
		$total_top_cats[$i]['svg_id'] = $row->svg_id;
		$total_top_cats[$i]['click_count'] = $row->click_count;
		
		
		$sql = "SELECT file_name 
				FROM image
				WHERE img_id = '".$row->img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$total_top_cats[$i]['file_name'] = $img_obj->file_name;	
		}else{
			$total_top_cats[$i]['file_name'] = '';
		}
		$i++;
	}		
	$total_rows = sizeof($total_top_cats);
	$rows_per_page = 100;

	$last = ceil($total_rows/$rows_per_page); 
	if($last == 0) $last = 1;
			
	if ($pagenum > $last){ 
		$pagenum = $last; 
	}
	if ($pagenum < 1){ 
		$pagenum = 1; 
	}
	$start = ($pagenum - 1) * $rows_per_page;
	$end = $pagenum * $rows_per_page;

	$top_cats = array_slice($total_top_cats, $start, $end);
	
	$url_str = "top-category.php";
	$url_str .= "?strip=".$strip;
	$url_str .= "&firstload=1";
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	?>
	<div class="search_bar">
	<form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	<input type="text" name="search_str" class="searchbox" />
	<button type="submit" class="btn btn-primary btn-large" value="search">
	Search
	</button>
	</form>
	</div>
	<br />
	<?php 
	$url_str = "top-category.php"; 
	echo "<a style='margin-left:30px;' class='btn btn-large btn-primary' href='".$url_str."'>List All</a>"; 
		
	$url_str = "add-top-category.php"; 
	$url_str .= "?strip=".$strip;
	$url_str .= "&firstload=1";
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	echo "<a style='margin-left:30px;' class='btn btn-large btn-primary' href='".$url_str."'>Add Top Category</a>"; 
	echo "<a style='margin-left:30px;' href='#' onClick='regularSubmit();'  class='btn btn-success btn-large'>Save Changes </a>";		

	$url_str = "top-category.php";
	if($total_rows > $rows_per_page){
		echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, $url_str, $sortby, $a_d,0,0, $search_str,0,0,$strip); 
		echo "<br /><br /><br />";
	}


	$url_str = "top-category.php"; 
	$url_str .= "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
?>
    

<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">        
<input type="hidden" name="set_active_and_display_order" value="1">
<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>	
<table cellpadding="6" cellspacing="6" style="width:100%;" >
<tr style="height:60px; background-color: gray; color:white;">
	<td width="10%">Image</td>
	<td>
	
<a href="top-category.php?sortby=name&a_d=a">ascending</a>
<br />
	Category Name
<br />
<a href="top-category.php?sortby=name&a_d=d">descending</a>	
	
	</td>
	<td>
	SVG Icon
	</td>

	<td>
<a href="top-category.php?sortby=click_count&a_d=a">ascending</a>
<br />
click_count
<br />
<a href="top-category.php?sortby=click_count&a_d=d">descending</a>	
	
	<td>
	Add Multi Products
	</td>
	<td width="10%">Products</td>
	<td width="10%" >
<a href="top-category.php?sortby=active&a_d=a">ascending</a>
<br />
	Active
<br />
<a href="top-category.php?sortby=active&a_d=d">descending</a>	
	
	</td>
	<td width="10%">Edit</td>
	<td width="10%">Delete</td>
</tr>

<?php
$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
$cats_from_this_page = '';
$block = '';						
foreach($top_cats as $top_cat) {
							
	$cats_from_this_page .= $top_cat['cat_id'].",";
								
	$block .= "<tr>"; 
	$block .= "<td valign='middle'>";
	$block .= "<a class='fancybox' href='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$top_cat['file_name']."'>";
	$block .= "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."'></a></td>";
	$block .= "</td>";
	
	$block .= "<td valign='middle' width='200px'>".stripslashes($top_cat['name'])."</td>"; 	

	$svg = get_svg_icon($top_cat['svg_id']);
	$block .= "<td valign='middle'>";	
	$block .= $svg['name'];
	$block .= "<br />";
	$block .= $svg['svg_code'];	
	$block .= "</td>";
	
$block .= "<td>";	
$block .= $top_cat['click_count'];
$block .= "</td>";
	
	$url_str = '';
	$url_str .= SITEROOT."manage/catalog/categories/select-item-to-cat.php";
	$url_str .="?cat_id=".$top_cat['cat_id'];
	$block .= "<td>";
	$block .= "<a class='btn btn-primary btn-small' href='".$url_str."'>";
	$block .= "Batch Prod";
	$block .= "</a>";
	$block .= "</td>";



	$url_str = '';
	$url_str .= SITEROOT."manage/catalog/products/item.php";
	$url_str .="?cat_id=".$top_cat['cat_id']."&from_top_cats=1";

	$block .= "<td>";	
	$block .= "<a class='btn btn-primary btn-small' href='".$url_str."'>";
	$block .= "Products";
	$block .= "</a>";
	$block .= "</td>";

	$checked = ($top_cat["active"])? "checked='checked'" : ''; 
	$block	.= "<td align='center' valign='middle' >
				<div class='checkboxtoggle on ".$disabled." '> 
				<span class='ontext'>ON</span>
				<a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span>
				<input type='checkbox' class='checkboxinput' name='active[]' 
				value='".$top_cat['cat_id']."' ".$checked." /></div>";
	$block .= "</td>";	
				
	$url_str = "edit-top-category.php";
	$url_str .= "?cat_id=".$top_cat['cat_id'];
	$url_str .= "&firstload=1";									
	$url_str .= "&strip=".$strip;							
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
		
	$fb = '';
							
	$block .= "<td valign='middle'>
				<a class='btn btn-primary' href='".$url_str."'>
				<i class='icon-cog icon-white'></i> Edit</a>";
	$block .= "</td>";
										
	$block .= "<td valign='middle'>
				<a class='btn btn-danger confirm ".$disabled." '>
				<i class='icon-remove icon-white'></i>
				<input type='hidden' id='".$top_cat['cat_id']."' 
				class='itemId' value='".$top_cat['cat_id']."' /></a>";
	$block .= "</td>";
	$block .= "</tr>";
}
$block .= "</table>";
						
echo $block;
				
$url_str = "top-category.php";
if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, $url_str, $sortby, $a_d,0,0, $search_str,0,0,$strip); 
echo "<br /><br /><br />";
}
?>
</div>
<input type="hidden" name="cats_from_this_page" value="<?php echo $cats_from_this_page; ?>">      
</form> 
  </div>
  <p class="clear"></p>
  
</div>

<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

    <?php
	$url_str = "top-category.php";
	$url_str = "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	?>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Category?</h3>
	<form name="del_category" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_cat_id" class="itemId" type="hidden" name="del_cat_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_cat" type="submit" >Yes, Delete</button>
	</form>
</div>

</body>
</html>


