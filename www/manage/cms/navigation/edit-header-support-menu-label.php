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


$page_title = "Edit header support menu label";
$page_group = "navbar";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

$header_support_menu_label_id = (isset($_GET['header_support_menu_label_id']))? $_GET['header_support_menu_label_id'] : 0;
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
				FROM header_support_menu_label 
				WHERE header_support_menu_label_id = '%u'
				AND profile_account_id = '%u'", $header_support_menu_label_id, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);	
	$object = $result->fetch_object();

	?>
	<form name="edit_header_support_menu_label" action="header-support-menu.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
		<input type="hidden" name="header_support_menu_label_id" value="<?php echo $header_support_menu_label_id; ?>" />
		<div class="lightboxcontent">
			<h2>Edit <?php echo stripslashes($object->label); ?></h2>
            
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>Label</label>
            		<input type="text" name="label" value="<?php echo stripslashes($object->label); ?>">
				</div>
				<div class="twocols">
            		<label>Page Name</label>
                    <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
                    foreach($available_pages_array as $value){
						$selected = ($object->page_seo_id == $value['page_seo_id'])? "selected" : '';										
						$block .= "<option value='".$value['page_seo_id']."' $selected >".ucwords($value['visible_name']).'<option>';
					}
					$block .= "</select>";
					echo $block;
                    ?>
				</div>
			</fieldset>
			<fieldset class="colcontainer">
				<div class="twocols">
					<label>Display Order</label>
					<input type="text" name="display_order" value="<?php echo $object->display_order; ?>">
				</div>
                
				<div class="twocols">
					<label>Active?</label>
					<div class="radiotoggle <?php if($object->active) {echo "on";}else{echo "off";} ?>"> 
                    <span class="ontext">ON</span><a class="switch on" href="#"></a>
                    <span class="offtext">OFF</span>
						<input class="radioinput" type="radio" name="active" value="1" <?php if($object->active) {echo "checked='checked'";} ?> />
					</div>
				</div>
			</fieldset>
            
		</div>
        <div class="savebar">
            <?php 
            if($admin_access->ecommerce_level > 1){
                echo "<button class='btn btn-success btn-large' name='edit_header_support_menu_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
            }else{?>
                <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
            <?php } ?>
            <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'header-support-menu.php'" >Cancel</button>
        </div>
        
	</form>
</div>
</body>
</html>



