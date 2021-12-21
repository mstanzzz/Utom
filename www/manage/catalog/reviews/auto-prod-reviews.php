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

$progress = new SetupProgress;
$module = new Module;

$page_title = "Item Reviews";
$page_group = "item";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$action = (isset($_GET["action"])) ? $_GET["action"] : '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$ts = time();



if(isset($_POST['set_active'])){
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();
	
	$reviews_from_this_page = explode(',',$_POST['reviews_from_this_page']);
	foreach($reviews_from_this_page as $r_id){
		if(is_numeric($r_id)){
			$sql = "UPDATE item_review 
					SET hide = '1' 
					WHERE item_review_id = '".$r_id."'";
			$result = $dbCustom->getResult($db,$sql);		
		}
	}	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			
			$sql = "UPDATE item_review SET hide = '0' WHERE item_review_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}

}


if(isset($_POST["add_item_review"])){

	$headline = trim(addslashes($_POST["headline"]));
	$review = trim(addslashes($_POST["review"]));
	$name = trim(addslashes($_POST['name']));
	$city = trim(addslashes($_POST["city"]));

	$rating = $_POST["rating"];


	//$publish_date = trim(addslashes($_POST["publish_date"]));
	$publish_date = time();
	//$rating = $_POST["rating"];
	$item_id = $_POST["item_id"];

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	// rating will be set only by customer

	$sql = sprintf("INSERT INTO item_review 
					(headline, review, name, city, publish_date, item_id, rating, profile_account_id)
					VALUES
					('%s','%s','%s','%s','%u','%u','%u','%u')", 
					$headline		
					,$review
					,$name
					,$city
					,$publish_date
					,$item_id
					,$rating
					,$_SESSION['profile_account_id']
					);

	$result = $dbCustom->getResult($db,$sql);
	


}

if(isset($_POST["edit_item_review"])){
	
	$item_review_id = $_POST["item_review_id"];
	$headline = trim(addslashes($_POST["headline"]));
	$review = trim(addslashes($_POST["review"]));
	$name = trim(addslashes($_POST['name']));
	$city = trim(addslashes($_POST["city"]));
	
	$rating = $_POST["rating"];


	//$publish_date = trim(addslashes($_POST["publish_date"]));
	$publish_date = time();
	
	//$rating = $_POST["rating"];
	$item_id = $_POST["item_id"];

	$db = $dbCustom->getDbConnect(CART_DATABASE);


	$sql = sprintf("UPDATE item_review 
					SET headline = '%s'
					,review = '%s'
					,name = '%s'
					,city = '%s'
					,publish_date = '%u'
					,rating = '%u'
					WHERE item_review_id = '%u'", 
					$headline		
					,$review
					,$name
					,$city
					,$publish_date
					,$rating
					,$item_review_id);

	$result = $dbCustom->getResult($db,$sql);
	


	//item_id, name, headline, review, city

}


if(isset($_POST["del_item_review_id"])){

	 $item_review_id = $_POST["del_item_review_id"];

	$db = $dbCustom->getDbConnect(CART_DATABASE);

	$sql = sprintf("DELETE FROM item_review WHERE item_review_id = '%u'", $item_review_id);
	$result = $dbCustom->getResult($db,$sql);
	

}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

</head>
<body <?php if($strip){ echo "class='lightbox'"; }?>>
<?php

if(!$strip){
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container <?php if($strip){ echo "lightbox"; }?>">
	<div class="manage_side_nav">
		<?php
		if(!$strip){ 
        	require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 

		if(!$strip){ 
			require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", SITEROOT."/manage/catalog/catalog-landing.php");
			$bread_crumb->add("Product Review", SITEROOT."/manage/catalog/reviews/item-review.php");
			echo $bread_crumb->output();
		}


        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : '';

		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;	
		
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;	

		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';


					$db = $dbCustom->getDbConnect(CART_DATABASE);
			
					$sql = "SELECT item.item_id
								,item.name as item_name
								,item_review.headline
								,item_review.review
								,item_review.item_review_id
								,item_review.hide 
								,item_review.publish_date
								,item_review.name
								,item_review.rating
					FROM item, item_review 
					WHERE item.item_id = item_review.item_id
					AND item_review.profile_account_id = '".$_SESSION['profile_account_id']."'";
					if(isset($_POST["search_str"])){
						$search_str = trim(addslashes($_POST["search_str"]));
						$sql .= " AND (item_review.review like '%".$search_str."%' 
								  OR  item_review.headline like '%".$search_str."%' 
								  OR  item_review.name like '%".$search_str."%'
								  OR  item.name like '%".$search_str."%')";
						
					}
					
					
					$sql .= "ORDER BY item.item_id, item_review.item_review_id ";

						
		$nmx_res = $dbCustom->getResult($db,$sql);
		

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
			
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
			
		$limit = ' limit '.$rows_per_page.' OFFSET '.($pagenum - 1) * $rows_per_page;

			$sql = "SELECT item.item_id
						,item.name as item_name
						,item_review.headline
						,item_review.review
						,item_review.item_review_id
						,item_review.hide 
						,item_review.publish_date
						,item_review.name
						,item_review.rating
			FROM item, item_review 
			WHERE item.item_id = item_review.item_id
			AND item_review.profile_account_id = '".$_SESSION['profile_account_id']."'";
			if(isset($_POST["search_str"])){
				$search_str = trim(addslashes($_POST["search_str"]));
				$sql .= " AND (item_review.review like '%".$search_str."%' 
						  OR  item_review.headline like '%".$search_str."%' 
						  OR  item_review.name like '%".$search_str."%'
						  OR  item.name like '%".$search_str."%')";
				
			}


		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item_review.name DESC".$limit;
				}else{
					$sql .= " ORDER BY item_review.name".$limit;		
				}
			}
			if($sortby == 'rating'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item_review.rating DESC".$limit;
				}else{
					$sql .= " ORDER BY item_review.rating".$limit;		
				}
			}
			if($sortby == 'item_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY item_id.name DESC".$limit;
				}else{
					$sql .= " ORDER BY item_id.name".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY item.item_id".$limit;
		}
		
$result = $dbCustom->getResult($db,$sql);		

		$url_str = "item-review.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		?>
        
   			<div class="page_actions">
				<div class="search_bar">
	            <form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" />
                    <!-- placeholder="Find a review"  -->
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
				</div>
                <form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                
                <?php if($admin_access->product_catalog_level > 1){ ?>
                    <a class="btn btn-large btn-primary" href="add-item-review.php?ret_page=item-review"><i class="icon-plus icon-white"></i> Add a Review </a>
                    
                    <!--
                	<button type="submit" class="btn btn-primary btn-large" value="set_active">Set Actives</button>
                    -->
                    
                    <input type="submit" name="set_active" class="btn btn-primary btn-large" value="Set Active">
                    
  					<div class="clear"></div>                                  			
				<?php 
				}
				if($total_rows > $rows_per_page){
					
					echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/reviews/item-review.php", $sortby, $a_d, 0,0, $search_str,0,0,$strip);
					echo "<br /><br /><br />";
				}
				?>
				
            </div>

			<div class="data_table">
            
			<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
    		<table cellpadding="10" cellspacing="0">
				<thead>
					<tr>
                    
       					<th <?php addSortAttr('name',true); ?>>
                           Reviewer Name
                        <i <?php addSortAttr('name',true); ?>></i>
                        </th>

                    
       					<th <?php addSortAttr('rating',true); ?>>
                           Star Rating
                        <i <?php addSortAttr('rating',false); ?>></i>
                        </th>
                    
       					<th <?php addSortAttr('publish_date',true); ?>>
                           Date Published
                        <i <?php addSortAttr('publish_date',false); ?>></i>
                        </th>

       					<th <?php addSortAttr('item_name',true); ?>>
                           Product Name
                        <i <?php addSortAttr('item_name',false); ?>></i>
                        </th>

						<th width="13%">Edit</th>
						<th>Active</th>
						<th width="5%">Delete</th>
					</tr>
				</thead>
				<?php
					$block ='';

						
					$reviews_from_this_page = '';	
						
					while($row = $result->fetch_object()) {
			
			
						$reviews_from_this_page .= $row->item_review_id.",";
			
						$block .= "<tr>";
						//Reviewer Name
						$block .= "<td>".stripslashes($row->name)."</td>";
									

						$star_style = '';
						if($row->rating == 1) $star_style = "one-star";
						if($row->rating == 2) $star_style = "two-star";
						if($row->rating == 3) $star_style = "three-star";
						if($row->rating == 4) $star_style = "four-star";
						if($row->rating == 5) $star_style = "five-star";
							
					
						//echo $star_style;
 						// use class='star_rating $rating', where $rating = one-star, two-star, three-star, etc.
						$block .= "<td>";
						if($star_style != ''){
							$block .= "<span class='star_rating ".$star_style."'></span>";
						}
						$block .= "</td>";
							
						//Publish Date
						if($row->publish_date > 0){
							$publish_date = date("m/d/Y", $row->publish_date);								
						}else{
							$publish_date = '';
						}
						$block .= "<td>".$publish_date."</td>";
						//Product
						$block .= "<td>".stripslashes($row->item_name)."</td>";
						
						
						$url_str = "edit-item-review.php";						
						$url_str .= "?strip=".$strip;
						$url_str .= "&item_review_id=".$row->item_review_id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&ret_page=item_review";
						
						//Edit
						$block .= "<td><a href='".$url_str."' class='btn btn-primary'><i class='icon-cog icon-white'></i> Edit</a></td>";

						//active (on/off)
						if(!$row->hide){
						$active = "<div class='checkboxtoggle on'> 
						<span class='ontext'>ON</span><a class='switch on' href='#'></a><span class='offtext'>OFF</span>
						<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->item_review_id."' checked='checked' /></div>";	
						}else{
						$active = "<div class='checkboxtoggle off'> <span class='ontext'>ON</span>
						<a class='switch on' href='#'></a><span class='offtext'>OFF</span><input type='checkbox' class='checkboxinput' name='active[]' value='".$row->item_review_id."' /></div>";	
						}
						$block .= "<td align='center' valign='middle' >".$active."</td>";
					
						$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
					
						//Delete
						$block .= "<td><a class='btn btn-danger btn-small confirm ".$disabled." '>
						<i class='icon-remove icon-white'></i>
						<input type='hidden' id='".$row->item_review_id."' class='itemId' value='".$row->item_review_id."' /></a></td>";		

						$block .= "</tr>";


			
					}

					//
					// Mark, I put in dummy data for now. when you build out the real table for the reviews, use this format.
					//
					//$block .= "<tr>";
					//Reviewer Name
					//$block .= "<td>John Smith</td>";
					//Review Title
					//$block .= "<td>Great Product!</td>";
					//Rating
					// use class='star_rating $rating', where $rating = one-star, two-star, three-star, etc.
					//$block .= "<td><span class='star_rating three-star'></span></td>";
					//Publish Date
					//$block .= "<td>01/01/2012</td>";
					//Product
					//$block .= "<td>Product Name</td>";
					//Edit
					//$block .= "<td><a href='edit-item-review.php?item_review_id=0' class='btn btn-primary'><i class='icon-cog icon-white'></i> Edit</a></td>";
					//Active
					//$block .= "<td><div class='radiotoggle on'> <span class='ontext'>ON</span><a class='switch on' href='#'></a><span class='offtext'>OFF</span><input type='radio' class='radioinput' name='active' value='' checked='checked' /></div></td>";
					//Delete
					//$block .= "<td><a class='btn btn-danger'><i class='icon-remove icon-white'></i></a></td>";
					//$block .= "</tr>";

					echo $block;
    			?>
			</table>
			<?php 
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "catalog/reviews/item-review.php", $sortby, $a_d, 0,0, $search_str,0,0,$strip);
			}
			
			
			?>
            
            <input type="hidden" name="reviews_from_this_page" value="<?php echo $reviews_from_this_page; ?>">
            
            </form>
		</div>
	</div>
	<p class="clear"></p>
	<?php
	if(!$strip){
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}

						$url_str = "item-review.php";						
						$url_str .= "?strip=".$strip;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;


	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this review?</h3>
	<form name="del_item_review_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
		<input id="del_item_review_id" class="itemId" type="hidden" name="del_item_review_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_item_review" type="submit" >Yes, Delete</button>
	</form>
</div>




<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>
