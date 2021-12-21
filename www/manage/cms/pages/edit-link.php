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

$module = new Module;

$page_title = "Edit Link";
$page_group = "home";

	

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

$ret_page = (isset($_GET['ret_page']))? $_GET['ret_page'] : 'home'; 
$link = (isset($_GET['link']))? $_GET['link'] : ''; 
$text = (isset($_GET['text']))? $_GET['text'] : ''; 
$custom_url = (isset($_GET['custom_url']))? $_GET['custom_url'] : ''; 
$page_seo_id = (isset($_GET['page_seo_id']))? $_GET['page_seo_id'] : ''; 
$cat_id = (isset($_GET['cat_id']))? $_GET['cat_id'] : 0; 
$indx = (isset($_GET['indx']))? $_GET['indx'] : 0; 





$_SESSION['cat_id'] = $cat_id;

//echo "navbar_submenu_label_id  ".$navbar_submenu_label_id;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body  class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php }
	?>
	<form name="form" action="<?php echo $ret_page.".php"; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
		<input type="hidden" name="link" value="<?php echo $link; ?>">
		<input type="hidden" name="indx" value="<?php echo $indx; ?>">

    
    
    
    	<div class="lightboxcontent">
		<h2>Edit Link</h2>

			<fieldset>
            
            	<?php if($link != 'link'){ ?>
				<div class="colcontainer">
					<label>Text</label>
            		<input style="width:520px" type="text" name="text" value="<?php echo stripslashes($text); ?>">
				</div>
				<?php }else{
					echo "<input type='hidden' name='text' value=''>";	
				}?>                

				<div class="colcontainer">
					<label>Selectable Page</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
                    foreach($available_pages_array as $value){
						$selected = ($page_seo_id == $value['page_seo_id'])? "selected" : '';										
						$block .= "<option value='".$value['page_seo_id']."' $selected >".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
				<div class="colcontainer">
   	                If there is a custom url, selectable page  will be ignored.<br />
					<label>Custom URL</label>
            		<input style="width:520px" type="text" name="custom_url" value="<?php echo stripslashes($custom_url); ?>">
				</div>

            <br />
			<div class="colcontainer">
	            If there is a category url, selectable page and custom url will be ignored.<br />
            	<label>Category URL</label>
				<?php require_once($real_root."/manage/cms/radio-tree-snippet.php");  ?>
            </div>
		</fieldset>

		<!--
		<fieldset class="colcontainer">
			<div class="threecols">
            	<label>Display Order</label>
            	<input type="text" name="display_order" value="<?php//echo $display_order; ?>">
			</div>
		</fieldset>
        -->
            <a class="btn btn-large" href="<?php echo $ret_page.".php"; ?>" target="_top">Cancel</a>
		</div>
        
       	<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_link' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
 		</div>
    </form>
</div>
</body>
</html>



