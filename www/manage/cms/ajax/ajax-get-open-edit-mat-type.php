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

$material_type_id = isset($_GET['material_type_id'])? $_GET['material_type_id'] : 0;

$rows_per_page = isset($_GET['rows_per_page'])? $_GET['rows_per_page'] : 0;

$collections = getCollections($material_type_id);

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT	material_type_name
		FROM material_types
		WHERE material_type_id = %u", $material_type_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$material_type_name = $object->material_type_name;
}else{
	$material_type_name = 'Required Field';
}


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


if(!isset($rows_per_page)) $rows_per_page = 8;			

?>



	<div class="content height-auto" style="padding-top:10px;">
		<div class="header" style="border-bottom: 1px solid #d4d4d4;">
			<span style="float:right; font-size:0.8em; margin-right:10px; cursor:pointer;" onclick="close_sub_edit_material_type();" >Cancel</span>
			<center>Edit Material Type</center>
		</div>
                
		<div class="main-content qty-form">
			<div class="plate-detail clearfix">
                <label style="margin-left:20px; margin-top:15px; font-size:1.1em;" class="modal-tool-admin-label">Name</label>
                <input type="text" class="input-border-bottom" id="update_this_material_type_name" name="material_type_name" value="<?php echo $material_type_name; ?>" 
                	style="width:220px; height:40px; font-size: 0.8em;">
                    
				<input type="hidden" id="update_this_material_type_id" name="material_type_id" value="<?php echo $material_type_id; ?>" />
			</div>

			<div class="edit-form-wrapper no-border" style="padding-top:20px;">
            <label class="text-italic">Choose one or more Collections</label>
                
            <select multiple id="update_these_collection_ids" class="rounded-select" size="1" onChange="expand_select(this,<?php echo count($collection_array); ?>)">
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

			<div class="create-new-qty-btn-wrapper" style="padding-bottom:20px;">
            	<button class="btn-default btn-bold with-bottom-shadow" onclick="update_sub_material_type(<?php echo $rows_per_page; ?>);">Save</button>
			</div>
                    
		</div>
	</div>
        
        
        
        
        
