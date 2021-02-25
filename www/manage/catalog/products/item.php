<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');

$shipping = new Shipping;

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Products';
$page_group = 'item';

function get_file_name($img_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = "SELECT file_name
			FROM image
			WHERE img_id = '".$img_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		$name = $object->name;
			
		return  $object->file_name;
			
	}
	
	return  '';
	
}

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
//if($cat_id == 0) $cat_id = $parent_cat_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$sortby = (isset($_GET['sortby'])) ? trim(addslashes($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? addslashes($_GET['a_d']) : 'a';
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;

$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : ''; 

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['become_child'])){
	
	$parent_item = (isset($_POST['parent_item']))? $_POST['parent_item'] : 0;
	$item_id = (isset($_POST['item_id']))? $_POST['item_id'] : 0;
	
	if($parent_item > 0 && $item_id > 0){
		
		$sql = "SELECT item_id 
				FROM item
				WHERE parent_item_id > '0'
				AND item_id = '".$parent_item."'";
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
			
			$msg = 'The selected parent product is already a child of another product. This action was not completed.';
						
		}else{
			$sql = "UPDATE item
					SET parent_item_id = '".$parent_item."'
					WHERE item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);			
		}
	}
}



if(isset($_POST['become_associated'])){
	
	$kit_item_ids = (isset($_POST['kit_item_ids']))? $_POST['kit_item_ids'] : array();
	$item_id = (isset($_POST['item_id']))? $_POST['item_id'] : 0;
	
	if(count($kit_item_ids) > 0 && $item_id > 0){
		
		$sql = "SELECT item_id
				FROM item
				WHERE is_kit = '1'
				AND item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
		
			$msg = 'The product is it\'s self already a kit. This action was not completed.';	
		}else{			
			
			$sql = "DELETE FROM item_to_kit
					WHERE item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			foreach($kit_item_ids as $v){
				
				$sql = "INSERT INTO item_to_kit
						(item_id, kit_item_id)
						VALUES
						('".$item_id."', '".$v."')";	
				$r = $dbCustom->getResult($db,$sql);
				
			}
		}
	}
}


if(isset($_POST['set_associated_items'])){
	
	$item_ids = (isset($_POST['item_ids']))? $_POST['item_ids'] : array();
	$item_id = (isset($_POST['item_id']))? $_POST['item_id'] : 0;
	
	if(count($item_ids) > 0 && $item_id > 0){
		
		$sql = "SELECT item_id
				FROM item
				WHERE is_kit = '0'
				AND item_id = '".$item_id."'";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){		
			$msg = 'The product is not a kit. This action was not completed.';	
		}else{
			
			$sql = "DELETE FROM item_to_kit
					WHERE kit_item_id = '".$item_id."'";
			$result = $dbCustom->getResult($db,$sql);
			
			foreach($item_ids as $v){
				
				$sql = "INSERT INTO item_to_kit
						(item_id, kit_item_id)
						VALUES
						('".$v."', '".$item_id."')";	
				$r = $dbCustom->getResult($db,$sql);
					
				
			}
		}
	}
}





if(isset($_POST['add_item'])){

	include('../include-add-item.php');
}



if(isset($_POST['edit_item'])){

	include('../include-edit-item.php');
	
}
	


if(isset($_POST['set_active'])){
	
	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	
	$items_from_page_array = explode(',',$_POST['items_from_this_page']);

	//print_r($items_from_page_array);

	foreach($items_from_page_array as $item_id){
		if(is_numeric($cat_id)){
			$sql = "UPDATE item 
					SET active = '0' 
					WHERE item_id = '".$item_id."'";
			$res = $dbCustom->getResult($db,$sql);
		}
	}
	
	if(is_array($actives)){	
		foreach($actives as $value){
			$sql = "UPDATE item SET active = '1' WHERE item_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
		}
	}

	$msg = 'Changes Saved.';
}


if(isset($_POST['del_item_id'])){


	$item_id = $_POST['del_item_id'];

	$sql = "UPDATE item
			SET parent_item_id = '0'
			WHERE parent_item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		

	$sql = "DELETE FROM item 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		

	$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);		
	
	$sql = "DELETE FROM item_to_kit 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM item_to_kit 
			WHERE kit_item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
			
	$sql = "DELETE FROM item_gallery 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_rating 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_review 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_to_category 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_to_document 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
		
	$sql = "DELETE FROM item_to_media 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_to_opt 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);

	$sql = "DELETE FROM item_to_vend_man 
			WHERE item_id = '".$item_id."'";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "SELECT img_id
			FROM item
			WHERE item_id = '".$item_id."'";
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
			
			exit;
			
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

unset($_SESSION['ret_page']);
unset($_SESSION['ret_dir']);
unset($_SESSION['ret_path']);
unset($_SESSION['item_id']);
unset($_SESSION['temp_item_fields']);
unset($_SESSION['temp_item_cats']);
unset($_SESSION['temp_attr_opt_ids']);
unset($_SESSION['new_img_id']);
unset($_SESSION['img_id']);
unset($_SESSION['parent_item_id']);
unset($_SESSION['paging']);
unset($_SESSION['search_str']);
unset($_SESSION['temp_gallery']);
unset($_SESSION['temp_documents']);
unset($_SESSION['temp_videos']);
unset($_SESSION['img_type']);
unset($_SESSION['side_nav_showroom_cats']); // frontend class.nav

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/class.admin_bread_crumb.php');	
$bread_crumb = new AdminBreadCrumb;
//$bread_crumb->reSet();
//$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");

$bc_parent_cat_id = 0;
$bc_seo_name = '';
$db = $dbCustom->getDbConnect(CART_DATABASE);


/* ****************  DO THIS ONCE */
/*
$sql = "UPDATE item 
		SET hide_id_from_url = '1'";
$res = $dbCustom->getResult($db,$sql);			

$sql = "SELECT item_id 
		FROM item";
$result = $dbCustom->getResult($db,$sql);		
while($r = $result->fetch_object()){

	$seo_url = getItemSeoUrl($r->item_id);
	$sql = "UPDATE item 
			SET seo_url = '".$seo_url."', hide_id_from_url = '1'
			WHERE item_id = '".$r->item_id."'";
	$res = $dbCustom->getResult($db,$sql);
	
}

*/


if($cat_id > 0){

	$sql = "SELECT name, seo_url, seo_list 
			FROM category
			WHERE cat_id = '".$cat_id."'";
			
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){
		$c_obj = $result->fetch_object();		
		$cat_name = stripslashes($c_obj->name);
		$page_title = $cat_name." Products"; 
		
		/*

		$bc_data_out = explode('|',$c_obj->seo_list);
		$i=0;
		$bc_parent_cat_id = $cat_id;		
		foreach($bc_data_out as $bc_out_v){
			$bc_data_in = explode(',',$bc_out_v);
			$bc_cat_id = 0;
			$bc_seo_name = '';
			if(isset($bc_data_in[0])){
				if(is_numeric($bc_data_in[0])){
					$bc_cat_id = $bc_data_in[0];
				}
			}
			if(isset($bc_data_in[1])){
				$bc_seo_name = strtolower($bc_data_in[1]);
			}
			
			$bc_parent_cat_id = $parent_cat_id;
			if(count($bc_data_out) > 1 && $i == 0){
				$bc_parent_cat_id = $bc_cat_id;
			}
			
			*/			
			//if($bc_cat_id > 0){
				//$bread_crumb->add($bc_seo_name, $ste_root.'manage/catalog/categories/category.php?parent_cat_id='.$bc_parent_cat_id);	
				//$bread_crumb->prune($bc_seo_name);				
			//}
		//}
	}



}elseif($parent_cat_id > 0){

/*

	$sql = "SELECT name, seo_url, seo_list 
			FROM category
			WHERE cat_id = '".$cat_id."'";
	$c_res = mysql_query ($sql);
	if(!$c_res)die(mysql_error());
	if(mysql_num_rows($c_res) > 0){
		$c_obj = mysql_fetch_object($c_res);		
		$parent_cat_name = stripslashes($c_obj->name);
		$page_title = $parent_cat_name." Products"; 

		$bc_data_out = explode('|',$c_obj->seo_list);
		$i=0;
		$bc_parent_cat_id = $parent_cat_id;	
		foreach($bc_data_out as $bc_out_v){
			$bc_data_in = explode(',',$bc_out_v);
			$bc_cat_id = 0;
			$bc_seo_name = '';
			if(isset($bc_data_in[0])){
				if(is_numeric($bc_data_in[0])){
					$bc_cat_id = $bc_data_in[0];
				}
			}
			if(isset($bc_data_in[1])){
				$bc_seo_name = strtolower($bc_data_in[1]);
			}
			if($bc_cat_id > 0){
				if($bc_parent_cat_id > 0){
					//$bread_crumb->add($bc_seo_name, $ste_root.'manage/catalog/categories/category.php?parent_cat_id='.$bc_parent_cat_id."&cat_id=".$cat_id);										
				}else{
					//$bread_crumb->add($bc_seo_name, $ste_root.'manage/catalog/categories/category.php?cat_id='.$bc_cat_id);					
				}
				//$bread_crumb->prune($bc_seo_name);
			}
		}
	}
	
	*/
}


// SET all items canonical_part
/*
$sql = "SELECT item_id, seo_url FROM item";
$result = $dbCustom->getResult($db,$sql);		
while($r = $result->fetch_object()){
	$canonical_part = $ste_root."/".$_SESSION['global_url_word'].$r->seo_url;
	$sql = "UPDATE item
			SET canonical_part = '".$canonical_part."'
			WHERE item_id = '".$r->item_id."'";
	$res = $dbCustom->getResult($db,$sql);	
}
*/




require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>


$(document).ready(function(){
	
	$(".child").toggle();
	
	$("tbody tr.hoverable").hover(function(){
		if($(this).hasClass("child")){
			$(this).closest("tbody").first("tr").css("background-color", "#F9FBFC");
			$(this).css("background-color", "#dce9f0");
		}
		else {
			$(this).css("background-color", "#F9FBFC");	
		}
	}, function(){
		$(this).css("background-color", "transparent");
		if($(this).hasClass("child")){
			$(this).closest("tbody").first("tr").css("background-color", "transparent");
		}
	});
	
	$(".show-children").click(function(e){
		e.preventDefault();
		
		//$(this).closest("tr").nextAll("tr").toggle();
		$(this).closest("tr").nextAll(".child").toggle();
		
		
		
		var icon = $(this).html();
		if (icon == '<i class="icon-chevron-right"></i>'){
			$(this).html('<i class="icon-chevron-down"></i>');
		}else {
			$(this).html('<i class="icon-chevron-right"></i>');	
		}
	});
	
	

});


function regularSubmit() {
  document.form.submit(); 
}	

</script>
</head>

<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
	
	//echo getItemSeoList(101, 'tie rack');
	
	
?>
<!--<a onClick="test();">TEST</a>-->
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		
		$bread_crumb->prune($page_title);
		$bread_crumb->add($page_title, $ste_root.$_SERVER['REQUEST_URI']);
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		if($cat_id > 0){
			$sql = "SELECT DISTINCT item.name
				,item.description
				,item.item_id
				,item.img_id
				,item.parent_item_id
				,item.show_in_cart
				,item.show_in_showroom
				,item.is_closet
				,item.short_description	
				,item.prod_number
				,item.sku
				,item.active
			FROM  item, item_to_category 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
			AND item.item_id = item_to_category.item_id 						
			AND item_to_category.cat_id = '".$cat_id."'
			AND parent_item_id = '0'";
		}else{
			$sql = "SELECT DISTINCT item.name
				,item.description
				,item.item_id
				,item.img_id
				,item.parent_item_id
				,item.show_in_cart
				,item.show_in_showroom
				,item.is_closet
				,item.short_description	
				,item.prod_number
				,item.sku
				,item.active
			FROM  item 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
			AND parent_item_id = '0'";	
		}
		
		if($search_str != ''){
			if(is_numeric($search_str)){
				$sql .= " AND (item.name like '%".$search_str."%' 
							OR item.profile_item_id = '".$search_str."'
							OR item.item_id = '".$search_str."'
							OR item.internal_prod_number = '".$search_str."')";				
			}else{
				$sql .= " AND item.name like '%".$search_str."%'";
			}
		}

		$nmx_res = $dbCustom->getResult($db,$sql);
		
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 12;
		
		$last = ceil($total_rows/$rows_per_page); 
		
		if($last == 0) $last = 1;
			
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
		
		//echo "last".$last;
			
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
		
		// OR same thing with
		//$limit = ' limit '.$rows_per_page.' OFFSET '.($pagenum - 1) * $rows_per_page;
		
		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item.name DESC".$limit;
				}else{
					$sql .= " ORDER BY item.name".$limit;		
				}
			}
			
			
			if($sortby == 'sku'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item.sku DESC".$limit;
				}else{
					$sql .= " ORDER BY item.sku".$limit;		
				}
			}
			
			if($sortby == 'prod_number'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item.prod_number DESC".$limit;
				}else{
					$sql .= " ORDER BY item.prod_number".$limit;		
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
						
			//$sql .= " ORDER BY item.name".$limit;
		
			$sql .= " ORDER BY item.item_id".$limit;
		
		}
		
		$result = $dbCustom->getResult($db,$sql);		
		
		$url_str= $ste_root.'manage/catalog/products/item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);
		
		$url_str.= "?cat_id=".$cat_id;
		$url_str.= "&parent_cat_id=".$parent_cat_id;
		$url_str.= "&pagenum=".$pagenum;
		$url_str.= "&sortby=".$sortby;
		$url_str.= "&a_d=".$a_d;
		$url_str.= "&truncate=".$truncate;

		?>
			<div class="page_actions">
				<div class="search_bar">
				
                <form id="search_form" name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" placeholder="Find a Product" />
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
    



	</div>
			  	<?php
                if($admin_access->product_catalog_level > 1){ 
					
					$url_str= $ste_root.'manage/catalog/products/item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);
					
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">List All Products </a>            
					
					<?php

					$url_str = $ste_root.'manage/catalog/products/add-item.php';
					
					echo "<br />";
					echo  $url_str; 
					echo "<br />";
					
					
	$url_str = preg_replace('/(\/+)/','/',$url_str);

					$url_str.= "?cat_id=".$cat_id;
					$url_str.= "&firstload=1";
					$url_str.= "&parent_cat_id=".$parent_cat_id;
					$url_str.= "&pagenum=".$pagenum;
					$url_str.= "&sortby=".$sortby;
					$url_str.= "&a_d=".$a_d;
					$url_str.= "&truncate=".$truncate;
					$url_str.= "&search_str=".$search_str;
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>"><i class="icon-plus icon-white"></i> Add a New Product </a>            

              		<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>

            	<?php } ?>
            </div>
	
    
       	<?php
		$url_str= $ste_root.'manage/catalog/products/item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);

		$url_str.= "?parent_cat_id=".$parent_cat_id;
		$url_str.= "&cat_id=".$cat_id;
		$url_str.= "&pagenum=".$pagenum;
		$url_str.= "&sortby=".$sortby;
		$url_str.= "&a_d=".$a_d;
		$url_str.= "&truncate=".$truncate;
		$url_str.= "&search_str=".$search_str;
		?>
    	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
	        <input type="hidden" name="set_active" value="1">

    		<div class="data_table clearfix">
				<div class="pagination">
       				<?php
					if($total_rows > $rows_per_page){
					echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "item.php", $sortby, $a_d,0,0, $search_str, $cat_id, $parent_cat_id);
					}
					 ?>
				</div>
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>		
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="2%"></th>
							<th width="7%">Image</th>
           					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>

           					<th <?php addSortAttr('sku',true); ?>>
                            SKU
                            <i <?php addSortAttr('sku',false); ?>></i>
                            </th>
							<!--                            
           					<th <?php //addSortAttr('prod_number',true); ?>>
                            Product ID
                            <i <?php //addSortAttr('prod_number',false); ?>></i>
                            </th>
                            -->
                                            
							<th>Categories</th>

							<th width="10%" <?php addSortAttr('active',true); ?>>
                            Active
                            <i <?php addSortAttr('active',false); ?>></i>
                            </th>
							
                            <th width="12%">Add Children</th>
							<th width="11%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<tbody>
<?php 
$items_from_this_page = '';
$block = '';
while($row = $result->fetch_object()) {
	$items_from_this_page .= $row->item_id.",";	
	//children products for this product...
	$sql = "SELECT name
				,item_id
				,img_id
				,parent_item_id
				,prod_number
				,sku
				,active			
			FROM  item
			WHERE parent_item_id = '".$row->item_id."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY item_id";
						
	$child_res = $dbCustom->getResult($db,$sql);
			
	$block .= "<tr class='hoverable'>";
			
	$block .= "<td>";
	if($child_res->num_rows > 0){
		//collapse/expand
		$block .= "<a href='#' class='show-children btn btn-tiny'><i class='icon-chevron-right'></i></a>";
	}
	$block .= "</td>";
	$block .= "<td>";

	$file_name = get_file_name($row->img_id);
	$t_img = $ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name;
	$t_img = preg_replace('/(\/+)/','/',$t_img);
	$block .= "<img width='100' src='".$t_img."'>";
	$block .= "</td>";
	
	$block .= "<td>".stripslashes($row->name)."    ".$row->item_id."</td>";
	//$block .= "<td>".$row->prod_number."</td>";
	$block .= "<td>".$row->sku."</td>";
	//product Categories
	$block .= "<td>";
	$sql = "SELECT DISTINCT category.name  
                    FROM category, item_to_category 
                    WHERE category.cat_id = item_to_category.cat_id
                    AND item_to_category.item_id = '".$row->item_id."'";
	$res = $dbCustom->getResult($db,$sql);		
	while($cg_row = $res->fetch_object()) {
		$block .= "<br />".stripslashes($cg_row->name);	
	}
	$block .= "</td>";     
	$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
	$checked = ($row->active)? "checked='checked'" : ''; 
	$block	.= "<td align='center' valign='middle' >
			<div class='checkboxtoggle on ".$disabled." '> 
			<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->item_id."' ".$checked." /></div></td>";	

	// Add Child
	$url_str= $ste_root.'manage/catalog/products/add-item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);
			$url_str.= "?parent_item_id=".$row->item_id;
			$url_str.= "&parent_cat_id=".$parent_cat_id;
			$url_str.= "&cat_id=".$cat_id;
			$url_str.= "&pagenum=".$pagenum;
			$url_str.= "&sortby=".$sortby;
			$url_str.= "&a_d=".$a_d;
			$url_str.= "&truncate=".$truncate;
			$url_str.= "&search_str=".$search_str;
	
	$block .= "<td><a class='btn btn-small btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Child</a><br />";
	$url_str= $ste_root.'manage/catalog/products/edit-item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);

			$url_str.= "?item_id=".$row->item_id;
			$url_str.= "&firstload=1";
			$url_str.= "&parent_cat_id=".$parent_cat_id;
			$url_str.= "&cat_id=".$cat_id;
			$url_str.= "&pagenum=".$pagenum;
			$url_str.= "&sortby=".$sortby;
			$url_str.= "&a_d=".$a_d;
			$url_str.= "&truncate=".$truncate;
			$url_str.= "&search_str=".$search_str;

	$block .= "<td><a class='btn btn-primary btn-small' 
			href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
			
	$block .= "<td valign='middle'>
			<a class='btn btn-danger confirm ".$disabled." '>
			<i class='icon-remove icon-white'></i>
			<input type='hidden' id='".$row->item_id."' class='itemId' value='".$row->item_id."' /></a></td>";
			
	$block .= "</tr>";

	while($child_row = $child_res->fetch_object()) {
		$items_from_this_page .= $child_row->item_id.",";
		$block .= "<tr class='hoverable child'>";
		
		$file_name = get_file_name($child_row->img_id);
		$t_img = $ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name;
		$t_img = preg_replace('/(\/+)/','/',$t_img);

		$block .= "<td colspan='3' valign='middle' align='left'>";
		$block .= "<img style='width:40px; height:40px;' src='".$t_img."'></td>";
		
		$block .= "<td>".stripSlashes($child_row->name)."</td>";				
		$block .= "<td>".$child_row->sku."</td>";
				
		$sql = "SELECT DISTINCT category.name  
						FROM category, item_to_category 
						WHERE category.cat_id = item_to_category.cat_id
						AND item_to_category.item_id = '".$child_row->item_id."'";
						
		$res = $dbCustom->getResult($db,$sql);

		$block .= "<td>";						
		while($cg_row = $res->fetch_object()) {
			$block .= "<br />".stripslashes($cg_row->name);	
		}
		$block .= "</td>";     
		$checked = ($child_row->active)? "checked='checked'" : ''; 
		$block	.= "<td align='center' valign='middle' >
				<div class='checkboxtoggle on ".$disabled." '> 
				<span class='ontext'>ON</span>
				<a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span>
				<input type='checkbox' class='checkboxinput' name='active[]' value='".$child_row->item_id."' ".$checked." /></div></td>";	
				$url_str= $ste_root.'manage/catalog/products/edit-item.php';
				$url_str = preg_replace('/(\/+)/','/',$url_str);
				
				$url_str.= "?item_id=".$child_row->item_id;
				$url_str.= "&parent_cat_id=".$parent_cat_id;
				$url_str.= "&cat_id=".$cat_id;
				$url_str.= "&pagenum=".$pagenum;
				$url_str.= "&sortby=".$sortby;
				$url_str.= "&a_d=".$a_d;
				$url_str.= "&truncate=".$truncate;
				$url_str.= "&search_str=".$search_str;
								
		$block .= "<td><a class='btn btn-primary btn-small' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
			$block .= "<td valign='middle'><a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$child_row->item_id."' class='itemId' value='".$child_row->item_id."' /></a></td>";	
			$block .= "</tr>";	
	}
			
			
			
	
}

echo  $block;
?>
</tbody>
</table>
<?php
if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "item.php", $sortby, $a_d,0,0, $search_str, $cat_id, $parent_cat_id);
}
?>

	</div>
    <input type="hidden" name="items_from_this_page" value="<?php echo $items_from_this_page; ?>">                 
	</form>
  </div>
  <p class="clear"></p>
  <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');

	$url_str= $ste_root.'manage/catalog/products/item.php';
	$url_str = preg_replace('/(\/+)/','/',$url_str);

	$url_str.= "?cat_id=".$cat_id;
	$url_str.= "&parent_cat_id=".$parent_cat_id;
	$url_str.= "&pagenum=".$pagenum;
	$url_str.= "&sortby=".$sortby;
	$url_str.= "&a_d=".$a_d;
	$url_str.= "&truncate=".$truncate;
	$url_str.= "&search_str=".$search_str;
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this product?</h3>
	<form name="del_item_form" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_item_id" class="itemId" type="hidden" name="del_item_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_page" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
<div style="display:none">
  <div id="edit" style="width:900px; height:620px;"> </div>
</div>
<div style="display:none">
  <div id="upload" style="width:280px; height:200px;"> </div>
</div>
<div style="display:none">
  <div id="add" style="width:900px; height:620px;"> </div>
</div>
<div style="display:none">
  <div id="view_desc" style="width:500px; height:200px;"> </div>
</div>
</body>
</html>
<?php 

/*
        $block .= "<td valign='top'>";
		$sql = "SELECT star_count
				FROM item_rating 
				WHERE item_id = '".$row->item_id."'";		
		$result = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows){
			$star_obj = $result->fetch_object();
			$block .= $star_obj->star_count;			
		}else{
			$block .= "not rated";
		}
		$block .= "</td>";
*/



 ?>
