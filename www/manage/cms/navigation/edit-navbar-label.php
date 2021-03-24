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

$page_title = 'Edit Navbar Label';
$page_group = 'navbar';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

$navbar_label_id = (isset($_GET['navbar_label_id']))? $_GET['navbar_label_id'] : 0; 
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	
$sql = sprintf("SELECT * FROM navbar_label WHERE navbar_label_id = '%u'", $navbar_label_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$label = $object->label;
    $submenu_content_type = $object->submenu_content_type;
    $page_seo_id = $object->page_seo_id;
    $display_order = $object->display_order;
    $active = $object->active;
	$custom_url = $object->url;
	$cat_id = $object->cat_id;
	$keyword_landing_id = $object->keyword_landing_id;
}else{
	$label = '';
    $submenu_content_type = 3;
    $page_seo_id = 0;
    $display_order = 0;
    $active = 0;
	$custom_url = '';
	$cat_id = 0;
	$keyword_landing_id = 0;
}



//echo $cat_id;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function(){

	<?php if($submenu_content_type == 3){ ?>		
		$("#lower_form").show();
	<?php } ?>

	$(".radiotoggle").click(function(){
		if($("#esm").is(':checked')){		
			$("#lower_form").show();		
		}else{
			$("#lower_form").hide();
		}
	});

});


</script>
</head>
<body  class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg; ?></p>
	</div>
	<?php } ?>
	  
	<form name="edit_navbar_label" action="navbar.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
    <input type="hidden" name="navbar_label_id" value="<?php echo $navbar_label_id; ?>" />
	<div class="lightboxcontent">

		<h2>Edit <?php echo stripslashes($label); ?></h2>
		<fieldset class="colcontainer">
			<legend>Submenu Type</legend>  
                <p>Select a navigation type.</p>
				<div style="float:left;">
				<label>Use Shop by Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="1"  <?php if($submenu_content_type == 1) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">                
				<label>Use Home Page Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="4"  <?php if($submenu_content_type == 4) echo "checked";?> /></div>
				</div>


				<div style="clear:both"></div>
                
                
				<div style="float:left;">
				<label>Use Shop by Brand List </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="2"  <?php if($submenu_content_type == 2) echo "checked";?> /></div>
				</div>

				<div style="float:left; padding-left:160px;">
				<label>Use Editable Subnavigation </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input id="esm" type="radio" class="radioinput" name="submenu_content_type" value="3"  <?php if($submenu_content_type == 3) echo "checked";?> /></div>
				</div>


                
                
                
       </fieldset> 

		<fieldset class="colcontainer">
            
			<legend>Label Details</legend>          

			<div class="colcontainer">
				<label>Label</label>
				<input type="text" name="label" value="<?php echo stripslashes($label); ?>"  >
			</div>
			
            
			<div id='lower_form' style='display:none;'>  
            
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

            
                      
                <div class="colcontainer">
                    <label>Selectable Page</label>
                     <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
					
					$block .= "<option value='0'>Select<option>";
					
                    foreach($available_pages_array as $value){
                    $selected = ($page_seo_id == $value['page_seo_id'])? "selected" : '';										
                    $block .= "<option value='".$value['page_seo_id']."' $selected >".ucwords($value['visible_name'])."<option>";
                    }
                    $block .= "</select>";
                    echo $block;
                    ?>
                    
                </div>
                <div style="clear:both;"></div>
                <div class="colcontainer">			
                    If there is a custom url, selectable page will be ignored.<br />
                    <label>Custom URL</label>
                    <input type="text" name="custom_url" value="<?php echo stripslashes($custom_url); ?>" style="width:300px;">
                </div>            
                <br />
                <div class="colcontainer">
                    If there is a category url, selectable page and custom url will be ignored.<br />
                    <label>Category URL</label>
                    <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/cms/radio-category-tree-snippet.php");  ?>
                </div>
            </div>
            
			<div class="colcontainer">
				<div class="threecols">
					<label>Display Order</label>
					<input type="text" name="display_order" value="<?php echo $display_order; ?>">
				</div>
				<div class="threecols">
					<label>Active?</label>
					<div class="radiotoggle <?php if($object->active) echo "on"; ?>"> <span class="ontext">ON</span><a class="switch on" href="#"></a>
                    <span class="offtext">OFF</span>
						<input class="radioinput" type="radio" name="active" value="1" checked="<?php if($active) echo "checked"; ?>" />
					</div>
				</div>
				<div class="threecols">
				            
				</div>
			</div>
		</fieldset>
		<a class="btn btn-large" href="navbar.php?<?php echo $qs_strip; ?>" <?php if(!$strip) echo "target='_top'";?>>Cancel</a>
		</div>
	
       	<div class="savebar">
		<?php 
        if($admin_access->ecommerce_level > 1){
            echo "<button class='btn btn-success btn-large' name='edit_navbar_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
        <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'navbar.php'" >Cancel</button>
		</div>

    
    
	</form>
</div>
</body>
</html>



