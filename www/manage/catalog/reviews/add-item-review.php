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
$page_title = "Add Item Review";
$page_group = "item";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;	
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;	
$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

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
			$bread_crumb->add("Add Product Review", '');
			echo $bread_crumb->output();
		}		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		
		$url_str = "item-review.php";
		$url_str .= "?strip=".$strip;
		$url_str .= "&pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		?>
		<form name="add_review" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
			
            <div class="page_actions edit_page">

                <button name="add_item_review" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Review </button>
                
				<hr />
				<a href="item-review.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a> </div>
			<div class="edit_page">
				<fieldset>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Product</label>
						</div>
						<div class="twocols">
							<select name="item_id">
                            <?php
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							$sql = "SELECT item_id, name
									FROM  item 
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";			
							$result = $dbCustom->getResult($db,$sql);
							
							$block = '';
							while($row = $result->fetch_object()){
								$block .= "<option value='".$row->item_id."'>".$row->name."</option>";	
							}
							echo $block;
							?>

                        	</select>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Reviewer Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="name" value='' />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Review Headline</label>
						</div>
						<div class="twocols">
							<input type="text" name="headline" value='' />
						</div>
					</div>
                    
                    <div class="colcontainer formcols">
						<div class="twocols">
							<label>Star Rating</label>
						</div>
						<div class="twocols">
                        
                    <select name="rating">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
                        
							
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
							<label>Review Content</label>
						</div>
						<div class="twocols">
							<textarea name="review" class="wysiwyg" id="wysiwyg1"></textarea>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>City</label>
						</div>
						<div class="twocols">
							<input type="text" name="city" value='' />
						</div>
					</div>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
    ?>
</div>
</body>
</html>
