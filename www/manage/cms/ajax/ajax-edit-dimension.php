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

$_SESSION['dimension_id'] = isset($_GET['dimension_id'])? $_GET['dimension_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT	dimension_label
						,dimension_value
						,dimension_type	
					FROM dimensions
					WHERE dimension_id = '%u'", $_SESSION['dimension_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$dimension_label = $object->dimension_label;
		$dimension_value = $object->dimension_value;
		$dimension_type = $object->dimension_type;
	}else{
		$dimension_label = '';
		$dimension_value = '';
		$dimension_type = '';
	}

					
?>

<div class="edit-container">
	<h4 class="title">Edit Dimension Detail</h4>
    <div>
    	<ul>
        <li>
	        <a href="#" onClick="submit_edit_dimension_form();">Update</a>
        </li>
        <li>
    	    <a href="#" onClick="delete_dimension(<?php echo $_SESSION['dimension_id']; ?>);">Delete</a>
        </li>
        <li>
        	<a href="#" onclick="close_modal_edit();">Cancel</a>
        </li>
        </ul>
    </div>
	<form id="edit_dimension_form" action="dimensions.php" method="post" enctype="multipart/form-data" target="_parent">	
        <input type="hidden" name="update_dimension" value="1">
        <input type="hidden" name="dimension_id" value="<?php echo $_SESSION['dimension_id']; ?>" />

        <div class="edit-form-wrapper name">
            <label class="text-italic">Dimension Label Name</label>
            <input type="text" class="edit-input" id="edit_dimension_label" name="dimension_label" value="<?php echo $dimension_label; ?>">
            <img src="../assets/svg/edit.svg" class="icon" alt="">
		</div>
        <div class="edit-form-wrapper value no-border">
            <div class="col-50">
                <label class="text-italic">Edit value</label>
                <input type="text"  id="edit_dimension_value" name="dimension_value" value="<?php echo $dimension_value; ?>">
            </div>
            <div class="col-50">
                <label class="text-italic">Type</label>
                <label class="container-radio right-margin-15">Width
                <input type="radio"  id="edit_dimension_type_width" name="dimension_type" value="0" <?php if($dimension_type == 0) echo "checked"; ?> />
                <span class="checkmark"></span>
                </label>
                <label class="container-radio">Depth
                <input type="radio" id="edit_dimension_type_depth" name="dimension_type" value="1" <?php if($dimension_type == 1) echo "checked"; ?> />
                <span class="checkmark"></span>
                </label>
            </div>
        </div>
	</form>
</div>



