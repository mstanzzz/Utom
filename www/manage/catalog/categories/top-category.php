<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');

$progress = new SetupProgress;
$module = new Module;
$nav = new Nav;

$page_title = "Top Categories";
$page_group = "top-cat";

$msg = '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$fb = (!$strip) ? "fancybox fancybox.iframe" : ''; 

$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

if(isset($_POST['add_top_cat'])){

	$img_id = $_POST['img_id']; 
	
	$restricted_attributes = (isset($_POST['restricted_attributes']))? $_POST['restricted_attributes'] : array();

	$name = trim(addslashes($_POST['name'])); 
	$short_name = trim(addslashes($_POST['short_name'])); 
	
	$tool_tip = trim(addslashes($_POST['tool_tip'])); 

	$description = trim(addslashes($_POST['description'])); 

	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;

	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;
	
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	
	$key_words = trim(addslashes($_POST['key_words']));
	
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;
	
	//$sql = sprintf("SELECT * FROM category WHERE name LIKE '%s'", $name);	
	$sql = sprintf("SELECT cat_id, name FROM category WHERE name = '%s' AND profile_account_id = '%u'", $name, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	
	if(!$result->num_rows){


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
		,profile_account_id) 
		VALUES ('%s','%s','%s','%s','%u','%s','%s','%u','%u','%u','%u','%u','%u')", 
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
		,$_SESSION['profile_account_id']);
		
		$res = $dbCustom->getResult($db,$sql);
		
		 
		$cat_id = $db->insert_id;
		
		if(sizeof($parent_cat_ids) > 0){
			foreach($parent_cat_ids as $value){
				$sql = "INSERT INTO child_cat_to_parent_cat 
						(parent_cat_id, child_cat_id) 
						VALUES( '".$value."', '".$cat_id."')";
			$res = $dbCustom->getResult($db,$sql);				
			}
		}
		
		
		$seo_url = getCatSeoUrl($cat_id, $name);		

		$destination = getCatDestination($cat_id, $show_in_cart, $show_in_showroom);
	
		if($destination == 'showroom'){
			$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'showroom');
		}else{
			$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'shop');
		}
			
		$sql = sprintf("UPDATE category 
				SET seo_url = '%s', canonical_part = '%s'   
				WHERE cat_id = '%u'", 
				$seo_url, $canonical_part, $cat_id);
		$res = $dbCustom->getResult($db,$sql);	


		$seo_list = getCatSeoList($cat_id);
		
		$sql = sprintf("UPDATE category 
			SET seo_list = '%s'  
			WHERE cat_id = '%u'", 
			$seo_list, $cat_id);
		$res = $dbCustom->getResult($db,$sql);		


		foreach($restricted_attributes as $val){
			$sql = "INSERT INTO category_to_attr
					(attribute_id, cat_id)
					VALUES
					('".$val."', '".$cat_id."')";		
			$res = $dbCustom->getResult($db,$sql);		
		}
		
		
		/*
		$sql = "SELECT file_name 
				FROM image 
				WHERE img_id = '".$img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$old_file_name = $img_obj->file_name;
			$pos = strlen($old_file_name) - 3;
			$ext = substr($old_file_name,$pos);

			$new_file_name = getUrlText($name.'-'.$img_id);	
			if(strlen($new_file_name) > 100){
				$new_file_name = cut_name_from_front($new_file_name, 100);
			}

			$new_file_name .= '.'.$ext;

			rename_cart_images_in_dirs($old_file_name, $new_file_name, $_SERVER['DOCUMENT_ROOT'], $domain);	
			update_cart_image_file_name_in_db($img_id, $new_file_name);			
		}
		*/
		
		$msg = 'Your change is now live.';

	}else{

		$match_obj = mysql_fetch_object($match_res);
		
		$url_str = 'edit-top-category.php';
		$url_str .= '?cat_id='.$match_obj->cat_id;
		$url_str .= '&firstload=1';									
		$url_str .= '&strip='.$strip;							
		$url_str .= '&pagenum='.$pagenum;
		$url_str .= '&sortby='.$sortby;
		$url_str .= '&a_d='.$a_d;
		$url_str .= '&truncate='.$truncate;

		$fb = '';

		$msg =  "<a class='".$fb."' href='".$url_str."'>A category called ".$match_obj->name." already exists. Click here to edit.</a>";
	}
	
	$progress->completeStep('category' ,$_SESSION['profile_account_id']);


}


if(isset($_POST['edit_top_cat'])){
	
	$name = trim(addslashes($_POST['name'])); 
	
	$short_name = trim(addslashes($_POST['short_name'])); 
	
	$tool_tip = addslashes($_POST['tool_tip']); 

	$description = addslashes($_POST['description']); 
	
	$cat_id = $_POST['cat_id'];
	$img_id = $_POST['img_id'];

	$original_name = trim(getOriginalCatName($cat_id));
	
	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;

	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;

	$restricted_attributes = (isset($_POST['restricted_attributes']))? $_POST['restricted_attributes'] : array();

	$img_alt_text = trim(addslashes($_POST['img_alt_text']));

	$key_words = trim(addslashes($_POST['key_words']));
		
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;
	
	$sql = "DELETE FROM child_cat_to_parent_cat 
			WHERE child_cat_id = '".$cat_id."'";
	$res = $dbCustom->getResult($db,$sql);	

	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$res = $dbCustom->getResult($db,$sql);
	
	if(sizeof($parent_cat_ids) > 0){
		foreach ($parent_cat_ids as $value){			
			if($cat_id != $value){
				$sql = "INSERT INTO child_cat_to_parent_cat 
						(parent_cat_id, child_cat_id) 
						VALUES( '".$value."', '".$cat_id."')";
				$res = $dbCustom->getResult($db,$sql);				
			}
		}
	}

	foreach($restricted_attributes as $val){
		$sql = "INSERT INTO category_to_attr
				(attribute_id, cat_id)
				VALUES
				('".$val."', '".$cat_id."')";		
		$res = $dbCustom->getResult($db,$sql);		
	}

	$sql = sprintf("UPDATE category 
	SET name = '%s'
	,short_name = '%s'
	,tool_tip = '%s'
	,description = '%s'
	,img_id = '%u'
	,img_alt_text = '%s'
	,key_words = '%s'
	,show_on_home_page = '%u'
	,show_in_cart = '%u'
	,show_in_showroom = '%u'
	,showroom_item_display_priority = '%u'  
	WHERE cat_id = '%u'", 
	$name, $short_name, $tool_tip, $description, $img_id, $img_alt_text, $key_words, $show_on_home_page,  $show_in_cart, $show_in_showroom, $showroom_item_display_priority, $cat_id);
	$res = $dbCustom->getResult($db,$sql);

	$seo_url = getCatSeoUrl($cat_id, $name);		
	$destination = getCatDestination($cat_id, $show_in_cart, $show_in_showroom);
	
	$profile_cat_id = getProfileCatId($cat_id);
	
	if($destination == 'showroom'){
		$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'showroom');
	}else{
		$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'shop');
	}

	$sql = sprintf("UPDATE category 
			SET seo_url = '%s', canonical_part = '%s'   
			WHERE cat_id = '%u'", 
			$seo_url, $canonical_part, $cat_id);
	$res = $dbCustom->getResult($db,$sql);	

	$seo_list = getCatSeoList($cat_id);
		
	$sql = sprintf("UPDATE category 
		SET seo_list = '%s'  
		WHERE cat_id = '%u'", 
		$seo_list, $cat_id);
	$res = $dbCustom->getResult($db,$sql);	

/*

	reSetAllCatSeoUrlAndList();
	reSetAllItemSeoUrlAndList();

	if($original_name != $name){
		$sql = "SELECT file_name 
				FROM image 
				WHERE img_id = '".$img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);
		
		if($img_res->num_rows > 0){
			$img_obj = $img_res->fetch_object();
			$old_file_name = $img_obj->file_name;
			$pos = strlen($old_file_name) - 3;
			$ext = substr($old_file_name,$pos);
			$new_file_name = getUrlText($name.'-'.$img_id);	
			if(strlen($new_file_name) > 100){
				$new_file_name = cut_name_from_front($new_file_name, 100);
			}
			
			$new_file_name .= '.'.$ext;
	
			rename_cart_images_in_dirs($old_file_name, $new_file_name, $_SERVER['DOCUMENT_ROOT'], $domain);	
			update_cart_image_file_name_in_db($img_id, $new_file_name);			
		}
	}
	
	$msg = 'Your change is now live.';

	$progress->completeStep('category' ,$_SESSION['profile_account_id']);
	
	*/

}


//$after = time();
//echo ($after-$before);
//exit;


if(isset($_POST['set_active_and_display_order'])){
	
	$cat_ids  = $_POST['cat_id'];
	$display_orders = $_POST['display_order'];
	
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
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
		
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

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
echo "<br />";
?>

<script>

function regularSubmit() {
  document.form.submit(); 
}	

</script>


</head>
<body <?php //if($strip){ echo "class='lightbox'"; }?>>
<?php
if(!$strip){ 
	//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container <?php if($strip){ echo 'lightbox'; }?>">
    <div class="manage_side_nav">
        <?php
		if(!$strip){  
        	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		}
		?>
    </div>	
    <div class="manage_main">
    
		<?php
		
		if($_SESSION['alt_ret_page'] != ''){
			echo "<a href='".$ste_root."manage/mPDF/data-table.php'>Return To Price Sheets</a>";	
		}
		
		
		if(!$strip){
			
			require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/class.admin_bread_crumb.php');	
			$admin_bread_crumb = new AdminBreadCrumb;
			$admin_bread_crumb->prune($page_title);
			$admin_bread_crumb->add($page_title, $ste_root.$_SERVER['REQUEST_URI']);
			echo $admin_bread_crumb->output();
		}
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        //require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/category-section-tabs.php");
				
		$total_top_cats = array();
		$top_cats = array();

		$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql = "SELECT cat_id, name, img_id, show_on_home_page, display_order, active, show_in_showroom 
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
			
			if($sortby == 'show_on_home_page'){
				if($a_d == 'd'){
					$sql .= " ORDER BY show_on_home_page DESC";
				}else{
					$sql .= " ORDER BY show_on_home_page";		
				}
			}
			
			if($sortby == 'display_order'){
				if($a_d == 'd'){
					$sql .= " ORDER BY display_order DESC";
				}else{
					$sql .= " ORDER BY display_order";		
				}
			}
			
			if($sortby == 'active'){
				if($a_d == 'd'){
					$sql .= " ORDER BY active DESC";
				}else{
					$sql .= " ORDER BY active";		
				}
			}
			
		}else{
			$sql .= " ORDER BY cat_id";					
		}

		
		$result = $dbCustom->getResult($db,$sql);				
		$i = 0;
		while($row = $result->fetch_object()) {
			$sql = "SELECT child_cat_to_parent_cat_id 
					FROM child_cat_to_parent_cat
					WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
			$res = $dbCustom->getResult($db,$sql);		
			if(!$res->num_rows > 0){
				$total_top_cats[$i]['cat_id'] = $row->cat_id;
				$total_top_cats[$i]['name'] = $row->name;
				$total_top_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
				$total_top_cats[$i]["display_order"] = $row->display_order;
				$total_top_cats[$i]["active"] = $row->active;
				$total_top_cats[$i]['show_in_showroom'] = $row->show_in_showroom;
				
				
				
				
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
		}
		
		$total_rows = sizeof($total_top_cats);
		$rows_per_page = 16;


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

		//echo "total_rows  ".$total_rows."<br />";
		//echo "rows_per_page  ".$rows_per_page."<br />";
		//echo "pagenum  ".$pagenum."<br />";
		//echo "last  ".$last."<br />";		
		//echo "start  ".$start."<br />";
		//echo "end  ".$end."<br />";


		$top_cats = array_slice($total_top_cats, $start, $end);

        $url_str = $ste_root."manage/catalog/categories/top-category.php";
		$url_str = preg_replace('/(\/+)/','/',$url_str);
		//echo "<a href='".$url_str."' >".$url_str."</a>";	
		$url_str .= "?strip=".$strip;
		$url_str .= "&firstload=1";
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		?>
			<div class="page_actions">
				<div class="search_bar">
	            <form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" />
                    <!--  placeholder="Find a Category" '' -->
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
				</div>
				<?php if($admin_access->product_catalog_level > 1){ 

        $url_str = $ste_root."manage/catalog/top-category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
					
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">List All</a>            
					
					<?php


        $url_str = $ste_root."manage/catalog/categories/add-top-category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
					
					$url_str .= "?strip=".$strip;
					$url_str .= "&firstload=1";
					$url_str .= "&pagenum=".$pagenum;
					$url_str .= "&sortby=".$sortby;
					$url_str .= "&a_d=".$a_d;
					$url_str .= "&truncate=".$truncate;
		
					?>
                    
<a class="btn btn-large btn-primary <?php //if(!$strip){ echo "fancybox fancybox.iframe"; } ?>" 
                    href="<?php echo $url_str ?>"><i class="icon-plus icon-white"></i>Add Top Category </a>
                    <!--<button href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>-->                
		
<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
        
        		<?php
				}else{
					echo "<div style='clear:both;'></div>";	
				}

$url_str = "top-category.php";

if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, $url_str, $sortby, $a_d,0,0, $search_str,0,0,$strip); 
echo "<br /><br /><br />";
}
				?>
				
            </div>
	
    	<?php
		
				
$url_str = $ste_root."manage/catalog/categories/top-category.php"; 
$url_str = preg_replace('/(\/+)/','/',$url_str);
		
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		
		?>
    
    
  <form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
        
	        <input type="hidden" name="set_active_and_display_order" value="1">

			<div class="data_table">
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>	
                <table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="7%">Image</th>
   							<th <?php addSortAttr('name',true); ?>>
                            Category Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
   							<th width="10%" <?php addSortAttr('show_on_home_page',true); ?>>
                            Show on Home?
                            <i <?php addSortAttr('show_on_home_page',false); ?>></i>
                            </th>
   							<th width="10%" <?php addSortAttr('display_order',true); ?>>
                            Display Order
                            <i <?php addSortAttr('display_order',false); ?>></i>
                            </th>
                            <th width="10%">Products</th>
							<th width="10%" <?php addSortAttr('active',true); ?>>
                            Active
                            <i <?php addSortAttr('active',false); ?>></i>
                            </th>

							<th width="10%">Edit</th>
							<th width="10%">Delete</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$cats_from_this_page = '';
						$block = '';
						foreach ($top_cats as $top_cat) {
							
							$cats_from_this_page .= $top_cat['cat_id'].",";
							
							$block .= "<tr>"; 
							$block .= "<td valign='middle'>";

						if(!$strip){
$block .= "<a class='fancybox' href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/".$top_cat['file_name']."'>";
$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."'></a></td>";
						}else{

$block .= "<a  href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$top_cat['file_name']."'>";
$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."'></a>";

						}
						
						$block .= "</td>";
							
							//category name
							$block .= "<td valign='middle' width='200px'>".stripslashes($top_cat['name'])."</td>"; 
							
							//show on home page
							if($top_cat['show_on_home_page']){
								$block .= "<td valign='middle' width='80px'>Yes</td>";
							}else{
								$block .= "<td valign='middle' width='80px'>No</td>";
							}
									
							//display order
							$block .= "<td valign='middle' align='center' >
							<input type='text' name='display_order[]' value='".$top_cat["display_order"]."'/>
							<input type='hidden' name='cat_id[]' value='".$top_cat['cat_id']."' /></td>";
		
							$block .= "<td valign='middle'><a class='btn btn-primary btn-small' href='../products/item.php?cat_id=".$top_cat['cat_id']."'>Products</a></td>";
	
							$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';

							//active (on/off)
							$checked = ($top_cat["active"])? "checked='checked'" : ''; 
							$block	.= "<td align='center' valign='middle' >
							<div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span>
							<a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$top_cat['cat_id']."' ".$checked." /></div></td>";	
		
							//subcategories
							//$block .= "<td valign='middle'><a class='btn btn-primary' 
							//href='category.php?parent_cat_id=".$top_cat['cat_id']."'><i class='icon-cog icon-white'></i> Subcategories</a></td>";
		
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
							<a class='btn btn-primary ".$fb.".' href='".$url_str."'>
							<i class='icon-cog icon-white'></i> Edit</a></td>";
										
							//delete
							$block .= "<td valign='middle'>
							<a class='btn btn-danger confirm ".$disabled." '>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$top_cat['cat_id']."' class='itemId' value='".$top_cat['cat_id']."' /></a></td>";
							$block .= "</tr>";
						}
						echo $block;
						?>
					</tbody>
				</table>
                <?php 
				
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
    <?php
	if(!$strip){  
    	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	$url_str = "top-category.php";
	$url_str = "?strip=".$strip;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	?>
</div>
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


