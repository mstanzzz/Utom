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


$page_title = "Edit Side Navigation Label";
$page_group = "navbar";

	

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

$side_nav_label_id = (isset($_GET['side_nav_label_id']))? $_GET['side_nav_label_id'] : 0; 

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

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
	<form name="edit_navbar_submenu_label" action="side-nav.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
    	<div class="lightboxcontent">
		<h2>Add Side Nav label</h2>
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>Label</label>
            		<input type="text" name="label" value=''>
				</div>
                <div class="twocols">
					<label>Selectable Page</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
                    foreach($available_pages_array as $value){
															
						$block .= "<option value='".$value['page_seo_id']."'>".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
                <div style="clear:both;"></div>
			
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
		<fieldset class="colcontainer">
			<div class="threecols">
            	<label>Display Order</label>
            	<input type="text" name="display_order" value=''>
			</div>
			<div class="threecols">
            <label>Show</label>
			<input type="radio" name="active" value="1" checked="checked">
            </div>
			<div class="threecols">
            <label>Hide</label>
			<input type="radio" name="active" value="0" >	
			</div>
		</fieldset>
            <a class="btn btn-large" href="side-nav.php?qs_strip="<?php echo $qs_strip; ?>" target="_top">Cancel</a>
		</div>
        
       	<div class="savebar">
		<?php 
        if($admin_access->cms_level > 1){
            echo "<button class='btn btn-success btn-large' name='add_side_nav_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
 		</div>
    </form>
</div>
</body>
</html>



