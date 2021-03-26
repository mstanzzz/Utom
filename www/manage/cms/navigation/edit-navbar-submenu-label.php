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


$page_title = "Edit Navbar Submenu Label";
$page_group = "navbar";

	

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

$navbar_label_id = (isset($_GET['navbar_label_id'])) ? $_GET['navbar_label_id'] : 0; 
$parent_submenu_id = (isset($_GET['parent_submenu_id'])) ? $_GET['parent_submenu_id'] : 0; 
$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'navbar';
$navbar_submenu_label_id = (isset($_GET['navbar_submenu_label_id']))? $_GET['navbar_submenu_label_id'] : 0;

//echo "ret_page".$ret_page;
//echo "<br />";
//echo "parent_submenu_id".$parent_submenu_id;

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

	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = sprintf("SELECT * 
					FROM navbar_submenu_label 
					WHERE navbar_submenu_label_id = '%u'
					AND profile_account_id = '%u'", $navbar_submenu_label_id, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);	
	if($result->num_rows){
		$object = $result->fetch_object();
		$label = $object->label;
		$page_seo_id = $object->page_seo_id;
		$custom_url = $object->custom_url;
		$active = $object->active;
		$display_order = $object->display_order;
		$cat_id = $object->cat_id;
		$keyword_landing_id = $object->keyword_landing_id;
	}else{
		$label = '';
		$page_seo_id = 0;
		$custom_url = '';
		$active = 0;
		$display_order = 0;
		$cat_id = 0;
		$keyword_landing_id = 0;		
	}
	if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;
	 
	?>
	<form name="edit_navbar_submenu_label" action="navbar-submenu.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
    	<div class="lightboxcontent">
		<h2>Edit <?php echo stripslashes($object->label); ?></h2>
        <input type="hidden" name="navbar_label_id" value="<?php echo $navbar_label_id; ?>"  />
		<input type="hidden" name="parent_submenu_id" value="<?php echo $parent_submenu_id; ?>"  />
		<input type="hidden" name="navbar_submenu_label_id" value="<?php echo $navbar_submenu_label_id; ?>" />
        <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>"  />
            <fieldset class="colcontainer">
				<div class="twocols">
					<label>Label</label>
            		<input type="text" name="label" value="<?php echo stripslashes($label); ?>">
				</div>
               <div style="clear:both;"></div>
   				<?php
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT keyword_landing_id, url_name 
                        FROM keyword_landing 
                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                $result = $dbCustom->getResult($db,$sql);	
                if($result->num_rows > 0){
                
                ?>				
                    <div class="twocols">
                        <label>Keyword Lading Page </label>
                        <?php 
    						$block = "<select name='keyword_landing_id'>";
							$block .= "<option value='0'> Select <option>";
    						while($row = $result->fetch_object()) {
								
								$selected = ($keyword_landing_id == $row->keyword_landing_id) ? "selected" : '';
								
								$block .= "<option value='".$row->keyword_landing_id."' ".$selected." >".$row->url_name."<option>";
							}
							$block .= "</select>";
							echo $block;
                        ?>
                    </div>
                <?	
                }
                ?>                

               <div style="clear:both;"></div>
               
               
                <div class="twocols">
					<label>Selectable Page</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
					$block .= "<option value='0'> Select <option>";
                    foreach($available_pages_array as $value){
						$selected = ($page_seo_id == $value['page_seo_id'])? "selected" : '';										
						$block .= "<option value='".$value['page_seo_id']."' $selected >".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
               
               <div style="clear:both;"></div>
			
            <div class="twocols">
                If there is a custom url, selectable page will be ignored.<br />
                <label>Custom URL</label>
                <input type="text" name="custom_url" value="<?php echo stripslashes($custom_url); ?>" style="width:300px;">
			</div>
            
            <div style="clear:both;"></div>
            
			<div class="twocols">
	            If there is a category url, selectable page and custom url will be ignored.<br />
            	<label>Category URL</label>
                
				<?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/radio-category-tree-snippet.php");  ?>
            
            </div>

			<div style="clear:both;"></div>

		</fieldset>
		<fieldset class="colcontainer">
			<div class="threecols">
            	<label>Display Order</label>
            	<input type="text" name="display_order" value="<?php echo $display_order; ?>">
			</div>
			<div class="threecols">
            <label>Show</label>
			<input type="radio" name="active" value="1" <?php if($active) echo "checked"; ?>>
            </div>
			<div class="threecols">
            <label>Hide</label>
			<input type="radio" name="active" value="0" <?php if(!$active) echo "checked"; ?>>	
			</div>
		</fieldset>
            <a class="btn btn-large" href="navbar-submenu.php?<?php echo "navbar_label_id=".$navbar_label_id."&".$qs_strip; ?>" target="_top">Cancel</a>
		</div>
        
       	<div class="savebar">
		<?php 
        if($admin_access->cms_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_navbar_submenu_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
 		</div>
    </form>
</div>
</body>
</html>



