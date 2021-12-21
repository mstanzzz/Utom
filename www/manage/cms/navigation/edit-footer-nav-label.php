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

$page_title = 'Edit Footer Nav Label';
$page_group = 'navbar';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$footer_nav_label_id = (isset($_GET['footer_nav_label_id']))? $_GET['footer_nav_label_id'] : 0; 

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 
	
$sql = sprintf("SELECT * FROM footer_nav_label WHERE footer_nav_label_id = '%u'", $footer_nav_label_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$label = $object->label;
    $submenu_content_type = $object->submenu_content_type;
    $page_seo_id = $object->page_seo_id;
    $display_order = $object->display_order;
    $active = $object->active;
	$keyword_landing_id = $object->keyword_landing_id;
}else{
	$label = '';
    $submenu_content_type = 1;
    $page_seo_id = 0;
    $display_order = 0;
    $active = 0;
	$keyword_landing_id = 0;
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>

	
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		<?php if($submenu_content_type == 3){ ?>		
		$(".editable_subnavigation").slideDown("fast");
		<?php } ?>
	});

</script>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>

     <form name="edit_footer_nav_label" action="footer-nav.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
     
     <input type="hidden" name="footer_nav_label_id" value="<?php echo $footer_nav_label_id; ?>">
     
	<div class="lightboxcontent">
		<h2>Edit <?php echo stripslashes($label); ?></h2>
			<fieldset class="colcontainer">
            	<p>Select a navigation type.</p>
				<div style="float:left;">
				<label>Use Shop by Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="1" <?php if($submenu_content_type == 1) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">                
				<label>Use Home Page Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="4" <?php if($submenu_content_type == 4) echo "checked";?> /></div>
				</div>


				<div style="clear:both"></div>
                
                
				<div style="float:left;">
				<label>Use Shop by Brand List </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="2" <?php if($submenu_content_type == 2) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">
				<label>Use Editable Subnavigation </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="3" <?php if($submenu_content_type == 3) echo "checked";?> /></div>
				</div>

            

			</fieldset>

        

<div class="twocols editable_subnavigation" style="display:none;">
        
		<fieldset class="colcontainer">
            
			<!--<legend>Label Details</legend>-->          


			<div class="colcontainer">
				<div class="twocols">
					<label>Label</label>
					<input type="text" name="label" value="<?php echo stripslashes($label); ?>"  >
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
                	<label>Keyword Lading Page </label>
                    <?php 
    					$block = "<select name='keyword_landing_id'>";
							
						$block .= "<option value='0'>Select<option>";
							
    					while($row = $result->fetch_object()) {
							$selected = ($keyword_landing_id == $row->keyword_landing_id)? "selected" : '';
							$block .= "<option value='".$row->keyword_landing_id."' $selected >".$row->url_name."<option>";
					
						}
						$block .= "</select>";
						echo $block;
                       ?>
				</div>
                
                <?	
                }
                ?>       
                
                
				
					<label>Static Page</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
					$block .= "<option value='0' $selected >Select<option>";
                    foreach($available_pages_array as $value){
						$selected = ($page_seo_id == $value['page_seo_id'])? "selected" : '';										
						$block .= "<option value='".$value['page_seo_id']."' $selected >".ucwords($value['visible_name'])."<option>";
					}
					$block .= "</select>";
					echo $block;
                    ?>
                 </div>
			</fieldset>
            
            <input type="hidden" name="display_order" value="<?php echo $display_order; ?>">
            <input type="hidden" name="active" value="<?php echo $active; ?>">
            
		
        <!--
		<div class="colcontainer">
			<fieldset class="twocols">
		
				<label>Order</label>
				<input type="text" name="display_order" value="<?php //echo $display_order; ?>">
			</fieldset>
			<fieldset class="twocols">
				<label>Active?</label>
				<div class="radiotoggle <?php //if($active) {echo "on";}else{echo "off";} ?>">  
                <span class="ontext">ON</span><a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
					<input class="radioinput" type="radio" name="active" value="1" <?php //if($active) {echo "checked='checked'";} ?> />
				</div>
			</fieldset>	
            
		</div>
        -->
	</div>
   	<div class="savebar">
		
        
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_footer_nav_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
		
        <a class="btn btn-large" style="width:100px;" href="footer-nav.php?<?php echo $qs_strip; ?>" <?php if(!$strip) echo "target='_top'"; ?>>Cancel</a>

	</div>
 	</form>
</div>
</body>
</html>



