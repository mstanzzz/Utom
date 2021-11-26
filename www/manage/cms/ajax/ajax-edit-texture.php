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

$_SESSION['texture_id'] = isset($_GET['texture_id'])? $_GET['texture_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql =  sprintf("SELECT texture_name	
					FROM textures 
					WHERE texture_id = '%u'", $_SESSION['texture_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){	
		$object = $result->fetch_object(); 	
		$texture_name = $object->texture_name;
	}else{
		$texture_name = '';
	}					
?>

<div class="edit-container">
	<h4 class="title text-capitalize">Edit Texture detail</h4>
	<div>
		<ul>
    		<li>
	        	<a href="#" onClick="submit_edit_texture_form();">Update</a>
			</li>
            <li>
	            <a href="#" onClick="delete_texture(<?php echo $_SESSION['texture_id']; ?>);">Delete</a>
            </li>
            <li>
	            <a href="#" onclick="close_modal_edit();">Cancel</a>
            </li>
		</ul>
	</div>
    <form id="edit_texture_form" action="textures.php" method="post" enctype="multipart/form-data" target="_parent">	
    	<input type="hidden" name="update_texture" value="1">
        <input type="hidden" name="texture_id" value="<?php echo $_SESSION['texture_id']; ?>" />
        <div class="edit-form-wrapper name no-border">
            <label class="text-italic">Texture Name</label>
            <input type="text" class="edit-input" style="width:240px;" id="edit_texture_name" name="texture_name" value="<?php echo $texture_name; ?>">
            <img src="../assets/svg/edit.svg" class="icon" alt="">
        </div>
    </form>
</div>