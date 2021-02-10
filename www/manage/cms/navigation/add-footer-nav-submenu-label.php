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

$page_title = 'Footer Nav Submenu Label';
$page_group = 'navbar';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$footer_nav_label_id = (isset($_REQUEST['footer_nav_label_id'])) ? $_REQUEST['footer_nav_label_id'] : 0; 
$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>
	<form name="add_footer_nav_submenu_label" action="footer-nav-submenu.php?<?php echo $qs_strip; ?>" method="post" target="_top">
		<input type="hidden" name="footer_nav_label_id" value="<?php echo $footer_nav_label_id; ?>"  />
		<div class="lightboxcontent">
			<h2>Add a New Footer Subnavigation Item</h2>
			<fieldset class="colcontainer">
				<div class="twocols"> 
					<!-- Page Label -->
					<label>Label</label>
					<input type="text" name="label"  style="width: 200px">
				</div>

	            <?php
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT keyword_landing_id, url_name 
                        FROM keyword_landing 
                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                $result = $dbCustom->getResult($db,$sql);	
                if($result->num_rows > 0){
                ?>				
				<div class="colcontainer">
                	<label>Keyword Landing Page </label>
                    <?php 
    					$block = "<select name='keyword_landing_id'>";
						$block .= "<option value='0'>Select<option>";
    					while($row = $result->fetch_object()) {
							$block .= "<option value='".$row->keyword_landing_id."' >".$row->url_name."<option>";
						}
						$block .= "</select>";
						echo $block;
                       ?>
				</div>
                <?	
                }
                ?>       
                
				<div class="twocols"> 
					<!-- Page Link -->
					<label>Static Page</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
                    $block .= "<option value='0' > Select <option>";
					foreach($available_pages_array as $value){
						$block .= "<option value='".$value['page_seo_id']."' >".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
                <div class="colcontainer">
                    If there is a custom url, selectable page will be ignored.<br />
                    <label>Custom URL</label>
                    <input type="text" name="custom_url" value='' style="width:300px;">
                </div>
                <br />
                <div class="colcontainer">
                    If there is a category url, selectable page and custom url will be ignored.<br />
                 <label>Category URL</label>
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/radio-category-tree-snippet.php");  ?>
	            </div>

			</fieldset>
			<a class="btn btn-large" href="footer-nav-submenu.php?<?php echo $qs_strip; ?>" target="_top">Cancel</a>
		</div>
		<div class="savebar">
			<button class="btn btn-large btn-success" name="add_footer_nav_submenu_label" type="submit" ><i class="icon-ok icon-white"></i> Add Subnavigation Item </button>
		</div>
	</form>
</div>
</body>
</html>
