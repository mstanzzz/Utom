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
$page_title = "Edit Item Review";
$page_group = "item";

$item_review_id =  (isset($_REQUEST['item_review_id'])) ? $_REQUEST['item_review_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$pagenum = (isset($_GET['pagenum'])) ? trim($_GET['pagenum']) : 0;	
$truncate = (isset($_GET['truncate'])) ? trim($_GET['truncate']) : 1;	
$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

$review_type = (isset($_GET['review_type'])) ? $_GET['review_type'] : 'all';


require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});
</script>

<script>

$(document).ready(function() {
	$("#datepicker1").datepicker();
})

</script>

</head>
<body>
<?php
if(!$strip){
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
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
			$bread_crumb->add("Edit Product Review", '');
			echo $bread_crumb->output();
		}		
  		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT item.item_id
		,item.name as item_name
		,item_review.review
		,item_review.item_review_id  
		,item_review.headline  
		,item_review.review
		,item_review.name
		,item_review.city
		,item_review.rating
		,item_review.publish_date
		,item_review.when
		FROM item, item_review 
		WHERE item.item_id = item_review.item_id
		AND item_review.item_review_id = '".$item_review_id."'
		";
		
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$r_obj = $result->fetch_object();
			$item_id = $r_obj->item_id;
			$item_name = $r_obj->item_name;
			$headline = $r_obj->headline;
			$review = $r_obj->review;
			$item_review_id = $r_obj->item_review_id;
			$name = $r_obj->name;
			$city = $r_obj->city; 
			$rating = $r_obj->rating;
			$publish_date = $r_obj->publish_date;
			$when = $r_obj->when;
		}else{
			$item_id = '';			
			$item_name = '';
			$headline = '';
			$review = '';
			$item_review_id = '';
			$name = '';
			$city = ''; 
			$rating = '';
			$publish_date = '';
			$when = '';
		}

		$url_str = "item-review.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		$url_str .= "&review_type=".$review_type;
		


		?>
   <form id="edit_item_form" name="edit_item" action="<?php echo $url_str; ?>" method="post"   enctype="multipart/form-data">
      <input type="hidden" name="item_review_id" value="<?php echo $item_review_id;  ?>" />
      <input type="hidden" name="item_id" value="<?php echo $item_id;  ?>" />
      
			<div class="page_actions edit_page">
				<?php if($admin_access->product_catalog_level > 1){ ?>  
	                <button type="submit" class="btn btn-success btn-large" name="edit_item_review"><i class="icon-ok icon-white"></i> Save Review </button>
				 <?php }else{ ?>
                    <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
                <?php } ?>
                <hr />
				<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a> </div>
			<div class="edit_page">
				<fieldset>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Product</label>
						</div>
						<div class="twocols">
							<?php echo stripslashes($item_name); ?>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Headline</label>
						</div>
						<div class="twocols">
							<input type="text" name="headline" value="<?php echo stripslashes($headline); ?>" />
						</div>
					</div>
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Star Rating</label>
						</div>
						<div class="twocols">
                        
                     <?php   
                     $block = "<select name='rating'>";
					 	$selected = ($rating == 1) ? 'selected' : '';
						$block .= "<option value='1' $selected>1</option>";
						$selected = ($rating == 2) ? 'selected' : '';
						$block .= "<option value='2' $selected>2</option>";
						$selected = ($rating == 3) ? 'selected' : '';
						$block .= "<option value='3' $selected>3</option>";
						$selected = ($rating == 4) ? 'selected' : '';
						$block .= "<option value='4' $selected>4</option>";
						$selected = ($rating == 5) ? 'selected' : '';
						$block .= "<option value='5' $selected>5</option>";
					$block .= "</select>";
                        
					echo $block;	
					?>	
                        
							
						</div>
					</div>

					<!--
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Publish date</label>
						</div>
						<div class="twocols">
							<input id="datepicker1" type="text" name="publish_date" value='' />
						</div>
					</div>
                    -->
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Review </label>
						</div>
						<div class="twocols">
							<textarea name="review" class="wysiwyg" id="wysiwyg1" ><?php echo stripslashes($review); ?></textarea>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
         					<label>Name</label>
						</div>
						<div class="twocols">
          					<input type="text" name="name" value="<?php echo stripslashes($name); ?>"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>City</label>
						</div>
						<div class="twocols">
							<input type="text" name="city" value="<?php echo stripslashes($city); ?>"  />
						</div>
					</div>
                    
   					<div class="colcontainer formcols">
						<div class="twocols">
         					<label>When Published</label>
						</div>
						<div class="twocols">
          					<?php if($publish_date != '') echo date('m/d/Y',$publish_date); ?>"
						</div>
					</div>


					<div class="colcontainer formcols">
						<div class="twocols">
         					<label>When Created</label>
						</div>
						<div class="twocols">
          					<?php echo date('m/d/Y',$when); ?>"
                            <?php if($when != '') echo date('m/d/Y',$when); ?>"
						</div>
					</div>

				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
	if(!$strip){
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>
