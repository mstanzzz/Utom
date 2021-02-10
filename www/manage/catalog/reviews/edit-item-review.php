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
$page_title = "Edit Item Review";
$page_group = "item";

	

//profile_account_id = '".$_SESSION['profile_account_id']."'


$item_review_id =  (isset($_REQUEST['item_review_id'])) ? $_REQUEST['item_review_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;	
$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;	
$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';

$review_type = (isset($_GET['review_type'])) ? $_GET['review_type'] : 'all';

//echo $item_review_id

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script type="text/javascript">
		tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
	content_css : "../../../css/mce.css"
	});

$(document).ready(function() {
	$("#datepicker1").datepicker();
})

</script>

</head>
<body>
<?php
if(!$strip){
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
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
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Product Review", $ste_root."manage/catalog/reviews/item-review.php");
			$bread_crumb->add("Edit Product Review", '');
			echo $bread_crumb->output();
		}		
  		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
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
							<?php echo stripAllSlashes($item_name); ?>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Headline</label>
						</div>
						<div class="twocols">
							<input type="text" name="headline" value="<?php echo prepFormInputStr($headline); ?>" />
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
							<textarea name="review" class="wysiwyg" id="wysiwyg1" ><?php echo stripAllSlashes($review); ?></textarea>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
         					<label>Name</label>
						</div>
						<div class="twocols">
          					<input type="text" name="name" value="<?php echo prepFormInputStr($name); ?>"  />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>City</label>
						</div>
						<div class="twocols">
							<input type="text" name="city" value="<?php echo prepFormInputStr($city); ?>"  />
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
    	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>
</body>
</html>
