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

$_SESSION['core_id'] = isset($_GET['core_id'])? $_GET['core_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT core_name	
						,is_green
						,core_id		
					FROM core 
					WHERE core_id = '%u'", $_SESSION['core_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$core_name = $object->core_name;
		$is_green = $object->is_green;
		$core_id = $object->core_id;
	}else{
		$core_name = '';
		$is_green = '';
		$core_id = '';
	}

					
?>
<div class="edit-container">
    <h4 class="title">Edit Core Detail</h4>
    <div>
        <ul>
            <li>
            <a href="#" onClick="submit_edit_core_form();">Update</a>
            </li>
            <li>
            <a href="#" onClick="delete_core(<?php echo $_SESSION['core_id']; ?>);">Delete</a>
            </li>
            <li>
            <a href="#" onclick="close_modal_edit();">Cancel</a>
            </li>
        </ul>
    </div>
	<form id="edit_core_form" action="cores.php" method="post" enctype="multipart/form-data" target="_parent">	
    <input type="hidden" name="update_core" value="1">
    <input type="hidden" name="core_id" value="<?php echo $_SESSION['core_id']; ?>" />
    <div class="edit-form-wrapper name edit-core-wrapper">
        <label class="text-italic">Core Name</label>
        <input type="text" class="edit-input" style="width:240px;" id="edit_core_name" name="core_name" value="<?php echo $core_name; ?>">
        <img class="icon" src="<?php echo SITEROOT; ?>manage/assets/svg/edit.svg" alt="">
    </div>
    <div class="edit-form-wrapper no-border">
        <div class="wrapper radio-btns">
            <div class="wrapper-toggle">
            	<label class="outside-label text-italic">Is Green (Environmental Friendly)</label>
            	<div class="toggle toggle--on-off">
					<?php
                    $checked = ($is_green)? "checked" : '';
                    ?>
                    <input class="toggle__input" type="checkbox" name="is_green" value="1" <?php echo $checked; ?>/>
                    <label class="toggle__label" data-on="YES" data-off="NO"></label>
            	</div>
            </div>
        </div>
    </div>
    </form>
</div>



