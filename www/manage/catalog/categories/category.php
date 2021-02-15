<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.nav.php');
//reSetAllCatSeoUrl();
//session_destroy();

$progress = new SetupProgress;
$module = new Module;
$nav = new Nav;
$catObj = new Category;


$page_title = "Sub Categories";
$page_group = "cat";

$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0; // not used
$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;


	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['add_cat'])){
	
	$img_id = $_POST['img_id']; 
	
	$restricted_attributes = (isset($_POST["restricted_attributes"]))? $_POST["restricted_attributes"] : array();

	$name = trim(addslashes($_POST['name'])); 
	$short_name =trim( addslashes($_POST['short_name'])); 
	
	$tool_tip = addslashes($_POST['tool_tip']); 

	$description = addslashes($_POST['description']); 

	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;

	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;
	
	$img_alt_text = trim(addslashes($_POST['img_alt_text']));

	$key_words = trim(addslashes($_POST['key_words']));

	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;
	
	
	
	$msg = '';
	
	//$sql = sprintf("SELECT * FROM category WHERE name LIKE '%s'", $name);	
	$sql = sprintf("SELECT cat_id, name FROM category WHERE name = '%s' AND profile_account_id = '%u'", $name, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows){
		$msg .= 'WARNING: You also have another category with this name<br />';
	}
	//canonical

	if(1){
	
		$sql = "SELECT max(profile_cat_id) AS profile_cat_id 
				FROM category 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);		
		if(!$result->num_rows){
			$profile_cat_id = 1;
		}else{
			$object = $result->fetch_object();
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
		
		$result = $dbCustom->getResult($db,$sql);
			
		$cat_id = $db->insert_id;
		
		if(sizeof($parent_cat_ids) > 0){
			foreach($parent_cat_ids as $value){
				$sql = "INSERT INTO child_cat_to_parent_cat 
						(parent_cat_id, child_cat_id) 
						VALUES( '".$value."', '".$cat_id."')";
				$result = $dbCustom->getResult($db,$sql);				
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
			
		$result = $dbCustom->getResult($db,$sql);		

		$seo_list = getCatSeoList($cat_id);
		
		$sql = sprintf("UPDATE category 
			SET seo_list = '%s'  
			WHERE cat_id = '%u'", 
			$seo_list, $cat_id);
		$result = $dbCustom->getResult($db,$sql);		

		foreach($restricted_attributes as $val){
			$sql = "INSERT INTO category_to_attr
					(attribute_id, cat_id)
					VALUES
					('".$val."', '".$cat_id."')";		
			$result = $dbCustom->getResult($db,$sql);
		}
		
		// SEO image file rename
		// This seemsto be cousing problems. Discuss this with Jeremiah to see it it's important.
		// If this used, we should only rename if $name is different than before  
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

		$progress->completeStep('category' ,$_SESSION['profile_account_id']);
		$msg = 'Your change is now live.';

	}else{
		
		$match_obj = mysql_fetch_object($match_res);
		
		$url_str = "edit-category.php";
		$url_str .= "?cat_id=".$match_obj->cat_id;
		$url_str .= "&firstload=1";									
		$url_str .= "&parent_cat_id=".$parent_cat_id;											
		$url_str .= "&strip=".$strip;							
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		$msg =  "<a href='".$url_str."'>A category called ".$match_obj->name." already exists. Click here to edit.</a>";

	}
	


}


if(isset($_POST['edit_cat'])){
	
	
	$name = trim(addslashes($_POST['name'])); 

	$short_name = trim(addslashes($_POST['short_name'])); 
	
	$tool_tip = addslashes($_POST['tool_tip']); 

	$description = addslashes($_POST['description']); 
	
	$cat_id = $_POST['cat_id'];
	$img_id = $_POST['img_id'];
	
	//$original_name = trim(getOriginalCatName($cat_id));

	$parent_cat_ids = (isset($_POST['chosen_categories']))? $_POST['chosen_categories'] : array(); 
	//print_r($parent_cat_ids);
	
	$show_on_home_page = (isset($_POST['show_on_home_page'])) ? $_POST['show_on_home_page'] : 0;

	$show_in_cart = (isset($_POST['show_in_cart'])) ? $_POST['show_in_cart'] : 0;
	
	$show_in_showroom = (isset($_POST['show_in_showroom'])) ? $_POST['show_in_showroom'] : 0;

	$restricted_attributes = (isset($_POST["restricted_attributes"]))? $_POST["restricted_attributes"] : array();

	$img_alt_text = trim(addslashes($_POST['img_alt_text']));
	
	$key_words = trim(addslashes($_POST['key_words']));
	
	$showroom_item_display_priority = (isset($_POST['showroom_item_display_priority']))? $_POST['showroom_item_display_priority'] : 0;	

/*	
	$sql = "DELETE FROM child_cat_to_parent_cat 
			WHERE child_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	

	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);

	if(sizeof($parent_cat_ids) > 0){
		foreach($parent_cat_ids as $value){
			if($cat_id != $value){
				$sql = "INSERT INTO child_cat_to_parent_cat 
						(parent_cat_id, child_cat_id) 
						VALUES( '".$value."', '".$cat_id."')";
				$result = $dbCustom->getResult($db,$sql);				
			}
		}
	}

	foreach($restricted_attributes as $val){
		$sql = "INSERT INTO category_to_attr
				(attribute_id, cat_id)
				VALUES
				('".$val."', '".$cat_id."')";		
		$result = $dbCustom->getResult($db,$sql);	
	}
*/

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
	$result = $dbCustom->getResult($db,$sql);

	//$seo_url = getCatSeoUrl($cat_id, $name);		

$seo_url = "TEST";

	//$destination = getCatDestination($cat_id, $show_in_cart, $show_in_showroom);

	$profile_cat_id = getProfileCatId($cat_id);

	
	/*
	if($destination == 'showroom'){
		$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'showroom');
	}else{
		$canonical_part = $nav->getCatUrl($name, $profile_cat_id, 'shop');
	}

	$sql = sprintf("UPDATE category 
			SET seo_url = '%s', canonical_part = '%s'   
			WHERE cat_id = '%u'", 
			$seo_url, $canonical_part, $cat_id);
	$result = $dbCustom->getResult($db,$sql);	
	*/
	
	//$seo_list = getCatSeoList($cat_id);
	/*	
	$sql = sprintf("UPDATE category 
		SET seo_list = '%s'  
		WHERE cat_id = '%u'", 
		$seo_list, $cat_id);
	$result = $dbCustom->getResult($db,$sql);	
	*/

	//reSetAllCatSeoUrlAndList();
	//reSetAllItemSeoUrlAndList();

	// SEO image file rename
	/*
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
	*/

	$msg = 'Your change is now live.';

	//$progress->completeStep('category' ,$_SESSION['profile_account_id']);
	
}


if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	$cats_from_page_array = explode(",",$_POST["cats_from_this_page"]);

	foreach($cats_from_page_array as $cat_id){
		if(is_numeric($cat_id)){
			$sql = "UPDATE category 
					SET active = '0' 
					WHERE cat_id = '".$cat_id."'";
		$result = $dbCustom->getResult($db,$sql);		}
	}
	
	if(is_array($actives)){	
		foreach($actives as $value){
			$sql = "UPDATE category SET active = '1' WHERE cat_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}

	// set all
	//$sql = "UPDATE category SET active = '1' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	//$result = $dbCustom->getResult($db,$sql);
	//




	$msg = "Changes Saved.";
}




if(isset($_POST['del_cat_id'])){

	$cat_id = $_POST['del_cat_id'];

/*
	$sql = "SELECT name
			FROM category
			WHERE cat_id = '".$cat_id."'";
$result = $dbCustom->getResult($db,$sql);	
	$obj = $result->fetch_object();
	$name = $obj->name; 
*/

	$sql = "DELETE FROM child_cat_to_parent_cat 
			WHERE child_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);	


	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	


	$sql = sprintf("DELETE FROM category WHERE cat_id = '%u'", $cat_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";

}




/*
$sql = "SELECT name, cat_id, profile_cat_id, show_in_cart, show_in_showroom 
		FROM category";
$result = $dbCustom->getResult($db,$sql);		
while($row = $result->fetch_object()){

	$seo_url = getCatSeoUrl($row->cat_id, $row->name);		
	
	//echo $seo_url;
	//echo "<br />";
	
	
	$sql = "UPDATE category
			SET seo_url = '".$seo_url."'
			WHERE cat_id = '".$row->cat_id."'";	
	$res = $dbCustom->getResult($db,$sql);

	$destination = getCatDestination($row->cat_id, $row->show_in_cart, $row->show_in_showroom);

	if($destination == 'showroom'){
		$canonical_part = $nav->getCatUrl($row->name, $row->profile_cat_id, 'showroom');
	}else{
		$canonical_part = $nav->getCatUrl($row->name, $row->profile_cat_id, 'shop');
	}

}

*/



unset($_SESSION['temp_cat_fields']);
unset($_SESSION['temp_attr_ids']);
unset($_SESSION['temp_cats']);
unset($_SESSION['cat_id']);
unset($_SESSION['parent_cat_id']);
unset($_SESSION['paging']);
unset($_SESSION['img_id']);
unset($_SESSION['strip']);
unset($_SESSION["search_str"]);

unset($_SESSION['top_cats']);
unset($_SESSION['nav_bar_cats']);
unset($_SESSION['item_id']);

unset($_SESSION['side_nav_showroom_cats']); // frontend class.nav
unset($_SESSION['top_showroom_cats']); // frontend class.nav
unset($_SESSION['home_cats']); // frontend class.nav
unset($_SESSION['footer_nav_cats']); // frontend class.nav
unset($_SESSION['ret_dir']);
unset($_SESSION['ret_path']);
unset($_SESSION['ret_page']);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("tbody tr").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});
	
	/*
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900,
		afterClose : function() {
			location.reload();
        	return;
    	}	
	});
	
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});	

	*/

});

function regularSubmit() {
  document.form.submit(); 
}	

</script>
</head>
<body>
<?php
if(!$strip){ 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);		
	
	//*********************************  reset *************************//	
	/*
	$sql = "SELECT cat_id, seo_url FROM category WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$canonical_part = $ste_root."/".$_SESSION['global_url_word'].$row->seo_url;
		$sql = "UPDATE category 
				SET canonical_part = '".$canonical_part."'   
				WHERE cat_id = '".$row->cat_id."'"; 
		$res = $dbCustom->getResult($db,$sql);	
	}
	*/	
	
}
?>
<div class="manage_page_container <?php if($strip){ echo "lightbox"; }?>">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 
		if(!$strip){
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$admin_bread_crumb = new AdminBreadCrumb;
					
			if($parent_cat_id > 0){
				$label = $catObj->getCatName($parent_cat_id);
			}elseif($cat_id > 0){
				$label = $catObj->getCatName($cat_id);	
			}else{
				$label = 'Sub Categories';
			}
			$admin_bread_crumb->prune($label);		
			$admin_bread_crumb->add($label, $ste_root.$_SERVER['REQUEST_URI']);
			echo $admin_bread_crumb->output();				
		}
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');       
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/category-section-tabs.php");
		
		$total_sub_cats = array();
		$sub_cats = array();
		if($parent_cat_id > 0){
			$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page, active  
					FROM category, child_cat_to_parent_cat  
					WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
					AND child_cat_to_parent_cat.parent_cat_id = '".$parent_cat_id."'";
		}else{
			$sql = "SELECT cat_id, name, show_on_home_page, img_id, active
				FROM category
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		}

		$search_str = (isset($_REQUEST["search_str"])) ?  trim(addslashes($_REQUEST["search_str"])) : ''; 
		
		if($search_str != ''){
			if(is_numeric($search_str)){
				
				//echo "search_str ".$search_str;
				//echo "<br />";
				
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

			// must have parents
			$sql = "SELECT child_cat_to_parent_cat_id
				FROM child_cat_to_parent_cat 
				WHERE child_cat_to_parent_cat.child_cat_id  = '".$row->cat_id."'";
			$res = $dbCustom->getResult($db,$sql);				
			
					
			if($res->num_rows > 0){
						
				$total_sub_cats[$i]['cat_id'] = $row->cat_id;
				$total_sub_cats[$i]['name'] = $row->name;
				$total_sub_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
				$total_sub_cats[$i]["active"] = $row->active;
						
				$sql = "SELECT file_name 
							FROM image
							WHERE img_id = '".$row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				if($img_res->num_rows > 0){
					$img_obj = $img_res->fetch_object();
					$total_sub_cats[$i]['file_name'] = $img_obj->file_name;	
				}else{
					$total_sub_cats[$i]['file_name'] = '';
				}
				$i++;
			}
		}

		$total_rows = sizeof($total_sub_cats);
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


		$sub_cats = array_slice($total_sub_cats, $start, $end);

		if(count($sub_cats) < 1){ ?>
		<div class="alert alert-info"> <span class="fltlft"><a class="btn btn-info" href="category.php"><i class="icon-arrow-left icon-white"></i> 
        Back to All Subcategories </a></span><strong>This category has no subcategories yet.</strong> Click 'Add a Category' to add subcategories to this category. </div>
		<?php }
		 if(!($parent_cat_id > 0)){ ?>
		<div class="alert alert-info"> <i class="icon-info-sign icon-white"></i> <strong>Note:</strong> This is the full list of all subcategories. Each category has <strong>1 or more</strong> parent categories. </div>
		<?php } 
		
        $url_str = $ste_root."manage/catalog/categories/category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);


		$url_str .= "?strip=".$strip;
		$url_str .= "&parent_cat_id=".$parent_cat_id;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		?>
			<div class="page_actions">
				<div class="search_bar">
   	            <form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" placeholder="Find a Category" />
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
				</div>
                <?php if($admin_access->product_catalog_level > 1){ 

		        $url_str = $ste_root."manage/catalog/categories/category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
			
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">List All</a>            
					
					<?php
        $url_str = $ste_root."manage/catalog/categories/add-category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
					
					$url_str .= "?strip=".$strip;
					$url_str .= "&firstload=1";					
					$url_str .= "&parent_cat_id=".$parent_cat_id;
					$url_str .= "&pagenum=".$pagenum;
					$url_str .= "&sortby=".$sortby;
					$url_str .= "&a_d=".$a_d;
					$url_str .= "&truncate=".$truncate;
				?>
                    <a class="btn btn-large btn-primary <?php //if(!$strip){ echo "fancybox fancybox.iframe"; } ?>" 
                     href="<?php echo $url_str; ?>">
                    <i class="icon-plus icon-white"></i> Add a Category </a> 
                    
              		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

                <?php } ?>
            </div>
            
       	<?php
        $url_str = $ste_root."manage/catalog/categories/category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
		
		$url_str .= "?strip=".$strip;
		$url_str .= "&parent_cat_id=".$parent_cat_id;					
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		
		?>
    	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	        <input type="hidden" name="set_active" value="1">

            
			<div class="data_table">
                <?php 
$url_str = "category.php";

if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, $url_str, $sortby, $a_d,0,0, $search_str,0,0,$strip); 
echo "<br /><br /><br />";
}
				?>


            	<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="7%">Image</th>
   							<th <?php addSortAttr('name',true); ?>>
                            Category Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
							<th>Parent Categories</th>
							<th width="11%">Products</th>
                            
							<th width="10%" <?php addSortAttr('active',true); ?>>
                            Active
                            <i <?php addSortAttr('active',false); ?>></i>
                            </th>
                            
							<th width="17%">Subcategories</th>
							<th width="10%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
					$cats_from_this_page = '';
					$block = ''; 
					foreach ($sub_cats as $sub_cat) {
						$cats_from_this_page .= $sub_cat['cat_id'].",";						
						$block .= "<tr>";
						
						$block .= "<td valign='middle'>";
						if(!$strip){
$block .= "<a class='fancybox' href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/".$sub_cat['file_name']."'>";
$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$sub_cat['file_name']."'></a></td>";
						}else{
$block .= "<a  href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$sub_cat['file_name']."'>";
$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$sub_cat['file_name']."'></a>";
						}
						
//$block .= $sub_cat['file_name'];
 						
						$block .= "</td>";

						
					//Category Name
						//$block .= "<td valign='middle' width='50px'>".stripslashes($sub_cat['name'])."   ".$sub_cat['cat_id']."</td>";
						$block .= "<td valign='middle' width='50px'>".stripslashes($sub_cat['name'])."</td>";
						
						
						//Parent Category
						$sql = "SELECT category.name, category.cat_id  
						FROM category, child_cat_to_parent_cat 
						WHERE category.cat_id = child_cat_to_parent_cat.parent_cat_id
						AND child_cat_to_parent_cat.child_cat_id = '".$sub_cat['cat_id']."'";
						
						$res = $dbCustom->getResult($db,$sql);
						
						$block .= "<td valign='middle' width='50px'>";
						while($cg_row = $res->fetch_object()) {
							//$block .= stripslashes($cg_row->name)."  ".$cg_row->cat_id."<br />";
							$block .= stripslashes($cg_row->name)."<br />";	
						}
							$block .= "</td>";
						//Products
						$block .= "<td valign='middle'><a class='btn btn-primary btn-small' 
						href='../products/item.php?cat_id=".$sub_cat['cat_id']."&parent_cat_id=".$parent_cat_id."'>Products</a></td>";

						$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';


						//active (on/off)
						$checked = ($sub_cat["active"])? "checked='checked'" : ''; 
						$block	.= "<td align='center' valign='middle' >
						<div class='checkboxtoggle on ".$disabled." '> 
						<span class='ontext'>ON</span>
						<a class='switch on' href='#'></a>
						<span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='active[]' value='".$sub_cat['cat_id']."' ".$checked." /></div></td>";	
		

						//Subcategories
						$block .= "<td valign='middle'><a class='btn btn-primary btn-small' 
						href='category.php?parent_cat_id=".$sub_cat['cat_id']."'><i class='icon-cog icon-white'></i> Subcategories</a></td>";
						
	
        $url_str = $ste_root."manage/catalog/categories/edit-category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
				
						$url_str .= "?cat_id=".$sub_cat['cat_id'];		
						$url_str .= "&parent_cat_id=".$parent_cat_id;					
						$url_str .= "&firstload=1";	
						$url_str .= "&strip=".$strip;											
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						

						//Edit 
						$block .= "<td valign='middle'>
						<a class='btn btn-primary btn-small' href='".$url_str."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";


						// Delete
						$block .= "<td valign='middle'>
						<a class='btn btn-danger confirm btn-small ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$sub_cat['cat_id']."' class='itemId' value='".$sub_cat['cat_id']."' /></a></td>";
						
						$block .= "</tr>";
					}
					echo $block;
					?>
					</tbody>
				</table>
                <?php 
$url_str = "category.php";

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

        $url_str = $ste_root."manage/catalog/categories/category.php"; 
		$url_str = preg_replace('/(\/+)/','/',$url_str);
				
	
	$url_str .= "?parent_cat_id=".$parent_cat_id;					
	$url_str .= "&strip=".$strip;											
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
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>



