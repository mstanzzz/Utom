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
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');

$shipping = new Shipping;

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Products';
$page_group = 'item';

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

$bc_parent_cat_id = 0;
$bc_seo_name = '';
$db = $dbCustom->getDbConnect(CART_DATABASE);





if($cat_id > 0){

	$sql = "SELECT name, seo_url, seo_list 
			FROM category
			WHERE cat_id = '".$cat_id."'";
			
	$result = $dbCustom->getResult($db,$sql);		
	if($result->num_rows > 0){
		$c_obj = $result->fetch_object();		
		$cat_name = stripslashes($c_obj->name);
		$page_title = $cat_name." Products"; 

	}



}elseif($parent_cat_id > 0){

}

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

		$sql = "SELECT item.name
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
			AND tmparraykey > '0'";

			$sql .= " ORDER BY item_id DESC";

			
		$result = $dbCustom->getResult($db,$sql);		
		

		************************************************************************>>$url_str= "item.php";
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
					
					************************************************************************>>$url_str= "item.php";
					
					?>
					<a class="btn btn-large btn-primary" href="<?php echo $url_str; ?>">List All Products </a>            
					
					<?php
					************************************************************************>>$url_str= "add-item.php";
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
		************************************************************************>>$url_str= "item.php";
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
			FROM item
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

			//product image
			$sql = "SELECT file_name FROM image WHERE img_id = '".$row->img_id."'";
			$img_res = $dbCustom->getResult($db,$sql);
			if(!$img_res){ die(mysql_error()); }
			if($img_res->num_rows > 0){
				$img_object = $img_res->fetch_object();
				
				$block .= "<a class='fancybox' href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_object->file_name."'>";
				$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$img_object->file_name."'></a>";
			}
			$block .= "</td>";
			
			//product Name
			//$block .= "<td>".stripslashes($row->name)."    ".$row->item_id."</td>";
			$block .= "<td>".stripslashes($row->name)."</td>";
			
			//product ID
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

			//active (on/off)
			$checked = ($row->active)? "checked='checked'" : ''; 
			$block	.= "<td align='center' valign='middle' >
			<div class='checkboxtoggle on ".$disabled." '> 
			<span class='ontext'>ON</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>OFF</span>
			<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->item_id."' ".$checked." /></div></td>";	



			// Add Child
			************************************************************************>>$url_str= "add-item.php";
			$url_str.= "?parent_item_id=".$row->item_id;
			$url_str.= "&parent_cat_id=".$parent_cat_id;
			$url_str.= "&cat_id=".$cat_id;
			$url_str.= "&pagenum=".$pagenum;
			$url_str.= "&sortby=".$sortby;
			$url_str.= "&a_d=".$a_d;
			$url_str.= "&truncate=".$truncate;
			$url_str.= "&search_str=".$search_str;
	
			$block .= "<td><a class='btn btn-small btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Child</a><br />";

			
			//edit
			************************************************************************>>$url_str= "edit-item.php";
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
			
			
			//delete				
			$block .= "<td valign='middle'>
			<a class='btn btn-danger confirm ".$disabled." '>
			<i class='icon-remove icon-white'></i>
			<input type='hidden' id='".$row->item_id."' class='itemId' value='".$row->item_id."' /></a></td>";
			
			$block .= "</tr>";

			while($child_row = $child_res->fetch_object()) {
				$items_from_this_page .= $child_row->item_id.",";
				$block .= "<tr class='hoverable child'>";
				//$block .= "<tr>";
				//product image
				$sql = "SELECT file_name FROM image WHERE img_id = '".$child_row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				if($img_res->num_rows > 0){
					$img_object = $img_res->fetch_object();
					$block .= "<td colspan='3' valign='middle' align='left'><a class='fancybox childthumb' 
					href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_object->file_name."'>";
					$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$img_object->file_name."'></a>";
				}else{
					$block .= "<td colspan='3'>";
				}
				
				//$block .= " ".stripslashes($child_row->name)."  --- ".$child_row->item_id."</td>";
				$block .= " ".stripslashes($child_row->name)."</td>";
				
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

				
				//active (on/off)
				$checked = ($child_row->active)? "checked='checked'" : ''; 
				$block	.= "<td align='center' valign='middle' >
				<div class='checkboxtoggle on ".$disabled." '> 
				<span class='ontext'>ON</span>
				<a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span>
				<input type='checkbox' class='checkboxinput' name='active[]' value='".$child_row->item_id."' ".$checked." /></div></td>";	



				//edit
				************************************************************************>>$url_str= "edit-item.php";
				$url_str.= "?item_id=".$child_row->item_id;
				$url_str.= "&parent_cat_id=".$parent_cat_id;
				$url_str.= "&cat_id=".$cat_id;
				$url_str.= "&pagenum=".$pagenum;
				$url_str.= "&sortby=".$sortby;
				$url_str.= "&a_d=".$a_d;
				$url_str.= "&truncate=".$truncate;
				$url_str.= "&search_str=".$search_str;
								
				$block .= "<td><a class='btn btn-primary btn-small' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
				//delete				
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
					 echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/products/item.php", $sortby, $a_d, 0,0, $search_str, $cat_id, $parent_cat_id);
					}
					 ?>

			</div>
           	<input type="hidden" name="items_from_this_page" value="<?php echo $items_from_this_page; ?>">                 
            </form>
		


  </div>
  <p class="clear"></p>
  <?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	************************************************************************>>$url_str= "item.php";
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
