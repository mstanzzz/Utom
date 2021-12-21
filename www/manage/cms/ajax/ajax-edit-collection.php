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

$_SESSION['collection_id'] = isset($_GET['collection_id'])? $_GET['collection_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT collection_name	
					FROM collection 
					WHERE collection_id = '%u'", $_SESSION['collection_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$collection_name = $object->collection_name;
	}else{
		$collection_name = '';
	}
					
?>
<div class="edit-container">
    <h4 class="title text-capitalize">Edit Collection detail</h4>
    <div>
        <ul>
            <li>
            <a href="#" onClick="submit_edit_collection_form();">Update</a>
            </li>
            <li>
            <a href="#" onClick="delete_collection(<?php echo $_SESSION['collection_id']; ?>);">Delete</a>
            </li>
            <li>
            <a href="#" onclick="close_modal_edit();">Cancel</a>
            </li>
        </ul>
    </div>
    <form id="edit_collection_form" action="collections.php" method="post" enctype="multipart/form-data" target="_parent">	
    <input type="hidden" name="update_collection" value="1">
    <input type="hidden" name="collection_id" value="<?php echo $_SESSION['collection_id']; ?>" />
    <div class="edit-form-wrapper name no-border">
        <label class="text-italic">Collection Name</label>
        <input type="text" class="edit-input" style="width:240px;" id="edit_collection_name"  name="collection_name" value="<?php echo $collection_name; ?>">
        <img src="../assets/svg/edit.svg" class="icon" alt="">
    </div>
    </form>
</div>



