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

function getCollections($material_type_id){
	
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$ret_array = array();
	
	$sql = "SELECT collection_id		
		FROM collection_mat_type_assoc 
		WHERE mat_type_id = '".$material_type_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){		
		$ret_array[] = $row->collection_id; 
	}
	
	return $ret_array;	
	
}


$_SESSION['material_type_id'] = isset($_GET['material_type_id'])? $_GET['material_type_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT	material_type_name
		FROM material_types
		WHERE material_type_id = %u", $_SESSION['material_type_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$material_type_name = $object->material_type_name;
}else{
	$material_type_name = 'Required Field';
}


//collection_mat_type_assoc doesn't exist
$collections = getCollections($_SESSION['material_type_id']);


$sql = "SELECT collection_id
			,collection_name
		FROM  collection 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY collection_name";
$result = $dbCustom->getResult($db,$sql);
$collection_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$collection_array[$i]['collection_id'] = $row->collection_id;
	$collection_array[$i]['collection_name'] = $row->collection_name;
	$i++;
}
					
?>


<div class="edit-container">
<h4 class="title">Edit Material Type Detail</h4>
    <div>
        <ul>
        <li>
        <a href="#" onClick="submit_edit_material_type_form();">Update</a>
        </li>
        <li>
        <!--<a href="">Delete</a>-->
        </li>
        <li>
        <a href="#" onClick="close_modal_edit();">Cancel</a>
        </li>
        </ul>
    </div>
	<form id="edit_material_type_form" name="edit_material_type_form" action="material-type.php" method="post" enctype="multipart/form-data" target="_parent" onsubmit="return validate(this);">
    <input type="hidden" name="update_material_type" value="1" />
	<input type="hidden" name="material_type_id" value="<?php echo $_SESSION['material_type_id']; ?>" />
	<div class="edit-form-wrapper name finishes-edit-wrapper">
        <label class="text-italic">Material Type Name*</label>
        <input type="text" id="edit_material_type_name" name="material_type_name" value="<?php echo $material_type_name; ?>" 
        class="input-invisable-bold" style="width:240px;" />
        <img class="icon" src="<?php echo SITEROOT; ?>manage/assets/svg/edit.svg" alt="">
    </div>
	<div class="edit-form-wrapper no-border">
    	<label class="text-italic">Choose one or more Collections</label>
		<select multiple name="collection_ids[]" class="rounded-select" size="1" onChange="expand_select(this,<?php echo count($collection_array); ?>)">
        	<option value="0">Select Options</option>
			<?php
			foreach($collection_array as $val){
				if(in_array($val['collection_id'], $collections)){
					$sel = "selected";	
				}else{
					$sel = '';
				}
				echo "<option value='".$val['collection_id']."' $sel>".$val['collection_name']."</option>";	
			}
			?>
		</select>
	</div>
	</form>
</div>

