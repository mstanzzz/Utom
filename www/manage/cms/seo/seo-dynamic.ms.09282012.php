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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Cart Pages SEO";
$page_group = "seo";

	



$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


if(isset($_POST["edit_seo"])){

	$page_seo_id = $_POST["page_seo_id"];	
	$title = trim(addslashes($_POST['title'])); 
	$keywords = trim(addslashes($_POST['keywords'])); 
	$description = trim(addslashes($_POST['description'])); 

	$mssl = $_POST['mssl']; 


	$sql = sprintf("UPDATE page_seo 
			SET title = '%s'
			,keywords  = '%s'
			,description = '%s'
			,mssl = '%u' 
			WHERE page_seo_id = '%u'", 
			$title, $keywords, $description, $mssl, $page_seo_id);
	$result = $dbCustom->getResult($db,$sql);
	if(!$result){
		die(mysql_error());
		$msg = "An Error Occurred.";
	}
	else {
		$msg = "Changes Saved.";	
	}
	

}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
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
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//SEO section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/seo-section-tabs.php");
        $db = $dbCustom->getDbConnect(CART_DATABASE);
		?>
		<form>
			<div class="page_actions edit_page">
				<button type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save Changes </button>
				<hr />
				
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<legend>Product Pages SEO Settings <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Meta Title Tagline</label>
						</div>
						<div class="twocols">
							<em>Company Name</em>  | <input name="meta_title_product" type="text" value='' /> | <em>Current Category > Current Product</em>
						</div>
					</div>				
				</fieldset>
				<fieldset class="edit_content">
					<legend>Catalog Pages SEO Settings <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Meta Title Tagline</label>
						</div>
						<div class="twocols">
							<em>Company Name</em> | <input name="meta_title_Category" type="text" value='' /> | <em>Current Category</em>
						</div>
					</div>				
				</fieldset>
				<fieldset class="edit_content">
					<legend>Showroom Pages SEO Settings <i class="icon-minus-sign icon-white"></i></legend>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Meta Title Tagline</label>
						</div>
						<div class="twocols">
							<em>Company Name</em>  | <input name="meta_title_showroom" type="text" value='' /> | <em>Current Showroom</em>
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

