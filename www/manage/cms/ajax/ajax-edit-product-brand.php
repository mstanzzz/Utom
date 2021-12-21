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

require_once($real_root."/includes/config.php");

$_SESSION['ret_modal'] = 'edit';

$_SESSION['panel_brand_id'] = isset($_GET['panel_brand_id'])? $_GET['panel_brand_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT	panel_brand_name
				FROM panel_brands
				WHERE panel_brand_id = '%u'", $_SESSION['panel_brand_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$panel_brand_name = $object->panel_brand_name;
		
	}else{
		$panel_brand_name = 'Required Field';
	}

					
?>

<div class="edit-container">
    <h4 class="title">Edit Brand Detail</h4>
    <div>
        <ul>
        <li>
        <a href="#" onClick="submit_edit_panel_brand_form();">Update</a>
        </li>
        <li>
        <a href="#" onClick="delete_panel_brand(<?php echo $_SESSION['panel_brand_id']; ?>);">Delete</a>
        </li>
        <li>
        <a href="#" onclick="close_modal_edit();">Cancel</a>
        </li>
        </ul>
    </div>
    <form id="edit_panel_brand_form" action="product-brands.php" method="post" enctype="multipart/form-data" target="_parent">	
    <input type="hidden" name="update_panel_brand" value="1">
    <input type="hidden" name="panel_brand_id" value="<?php echo $_SESSION['panel_brand_id']; ?>" />
    <div class="edit-form-wrapper name no-border">
        <label class="text-italic">Product Brand Name</label>
        <input type="text" class="edit-input" style="width:220px;" 
        id="edit_panel_brand_name" name="panel_brand_name" value="<?php echo $panel_brand_name; ?>">
        <img class="icon" src="<?php echo SITEROOT; ?>manage/assets/svg/edit.svg" alt="">
    </div>
    </form>
</div>

        
        <!--
        	Auto box
         <input onkeypress="this.style.width = ((this.value.length + 1) * 15) + 'px';" type="text" class="edit-input" value="Almond">
        
        -->
        
