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
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

$_SESSION['ret_modal'] = 'edit';

$_SESSION['tier_id'] = isset($_GET['tier_id'])? $_GET['tier_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT tier_name	
				FROM material_tiers 
				WHERE tier_id = '%u'", $_SESSION['tier_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$tier_name = $object->tier_name;
}else{
	$tier_name = '';
}
?>

<div class="edit-container">
	<h4 class="title">Edit Material Tier</h4>
	<div>
        <ul>
            <li>
	            <a href="#" onClick="submit_edit_material_tier_form();">Update</a>
            </li>
            <li>
            &nbsp;
            </li>
            <li>
    	        <a href="#" onclick="close_modal_edit();">Cancel</a>
            </li>
        </ul>
    </div>
    <form id="edit_material_tier_form" action="material-tier.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
        <input type="hidden" name="update_material_tier" value="1" />
        <input type="hidden" name="tier_id" value="<?php echo $_SESSION['tier_id']; ?>" />
        <div class="edit-form-wrapper name no-border">
            <label class="text-italic">Material Name</label>
            <input type="text" class="edit-input" style="width:220px;" id="edit_tier_name" name="tier_name" value="<?php echo $tier_name; ?>">
            <img src="../assets/svg/edit.svg" class="icon" alt="">
        </div>
    </form>
</div>
