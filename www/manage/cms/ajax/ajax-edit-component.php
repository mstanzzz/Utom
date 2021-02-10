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

$_SESSION['component_id'] = isset($_GET['component_id'])? $_GET['component_id'] : 0;

$first_load = isset($_GET['first_load'])? $_GET['first_load'] : 0;

if(!is_numeric($_SESSION['component_id'])){
	exit;	
}

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

if(!isset($_SESSION['collections'])) $_SESSION['collections'] = array();

if($first_load > 0){

	$sql = "SELECT *
			FROM cabinetry_components
			WHERE component_id = '".$_SESSION['component_id']."'";
	
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		$_SESSION['tmp_vars']['component_name'] = $object->component_name; 
		$_SESSION['tmp_vars']['component_image'] = $object->component_image;
		$_SESSION['tmp_vars']['component_sku'] = $object->component_sku; 
		$_SESSION['tmp_vars']['component_number'] = $object->component_number;
		$_SESSION['tmp_vars']['description'] = $object->description;
		$_SESSION['tmp_vars']['component_weight'] = $object->component_weight;
		$_SESSION['tmp_vars']['price_unit'] = $object->price_unit;
		$_SESSION['tmp_vars']['system_hole_occupancy'] = $object->system_hole_occupancy;
		$_SESSION['tmp_vars']['system_hole_increment'] = $object->system_hole_increment;
		$_SESSION['tmp_vars']['system_hole_offset'] = $object->system_hole_offset;
		$_SESSION['tmp_vars']['system_hole_padding_top'] = $object->system_hole_padding_top;
		$_SESSION['tmp_vars']['allow_custom_width'] = $object->allow_custom_width;
		$_SESSION['tmp_vars']['qty_unit'] = $object->qty_unit;
		$_SESSION['tmp_vars']['material_id'] = $object->material_id;
		$_SESSION['tmp_vars']['price_schema_id'] = $object->price_schema_id;
		$_SESSION['tmp_vars']['qty_schema_id'] = $object->qty_schema_id;
		$_SESSION['tmp_vars']['qty_calc_id'] = $object->qty_calc_id;
		$_SESSION['tmp_vars']['width_constraints_id'] = $object->width_constraints_id;
		$_SESSION['tmp_vars']['part_type_id'] = $object->part_type_id;
				
	}else{
				
		echo 'Does not exist';
		exit;	
	}
   
    $sql = "SELECT collection_id 
			FROM collection_components_assoc
			WHERE component_id = '".$_SESSION['component_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$_SESSION['collections'][] = $row->collection_id; 		
	}

}

	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
   
    
	$sql = "SELECT cabinetry_components_to_parts.part_id
					,cabinetry_components_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_components_to_parts
			WHERE parts.part_id = cabinetry_components_to_parts.part_id
			AND cabinetry_components_to_parts.is_fixed_part = '0'
			AND cabinetry_components_to_parts.component_id = '".$_SESSION['component_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['constructed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['constructed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['constructed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['constructed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}

	$sql = "SELECT cabinetry_components_to_parts.part_id
					,cabinetry_components_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_components_to_parts
			WHERE parts.part_id = cabinetry_components_to_parts.part_id
			AND cabinetry_components_to_parts.is_fixed_part = '1'
			AND cabinetry_components_to_parts.component_id = '".$_SESSION['component_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['fixed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['fixed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['fixed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['fixed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}


$part_type_array = array();
$sql = "SELECT part_type_id 
			,part_type_name_user
		FROM part_types
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY part_type_name_user";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$part_type_array[$i]['part_type_id'] = $row->part_type_id;
	$part_type_array[$i]['part_type_name_user'] = $row->part_type_name_user;
	$i++;
}

$qty_schema_array = array();
$sql = "SELECT qty_schema_id 
			,qty_schema_name	
		FROM qty_schema
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY qty_schema_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$qty_schema_array[$i]['qty_schema_id'] = $row->qty_schema_id;
	$qty_schema_array[$i]['qty_schema_name'] = $row->qty_schema_name;
	$i++;
}

$price_schema_array = array();					
$sql = "SELECT price_schema_id 
			,price_schema_name	
		FROM price_schema
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY price_schema_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$price_schema_array[$i]['price_schema_id'] = $row->price_schema_id;
	$price_schema_array[$i]['price_schema_name'] = $row->price_schema_name;
	$i++;
}

$qty_calc_array = array();
$sql = "SELECT qty_calc_id 
			,qty_calc_name	
		FROM qty_calc_equations
		ORDER BY qty_calc_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$qty_calc_array[$i]['qty_calc_id'] = $row->qty_calc_id;
	$qty_calc_array[$i]['qty_calc_name'] = $row->qty_calc_name;
	$i++;
}

$materials_array = array();
$sql = "SELECT material_id 
			,material_name	
		FROM materials
		ORDER BY material_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$materials_array[$i]['material_id'] = $row->material_id;
	$materials_array[$i]['material_name'] = $row->material_name;
	$i++;
}


$collection_array = array();
$sql = "SELECT collection_id 
			,collection_name	
		FROM collection
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY collection_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {
	$collection_array[$i]['collection_id'] = $row->collection_id;
	$collection_array[$i]['collection_name'] = $row->collection_name;
	$i++;
}


	$sql = "SELECT swg_id 
				,swg_name	
			FROM cabinetry_section_width_groups
			ORDER BY swg_name";
	$result = $dbCustom->getResult($db,$sql);	
	
	$i = 0;
	$swg_array = array();
	while($row = $result->fetch_object()){		
		$swg_array[$i]['swg_id'] = $row->swg_id;
		$swg_array[$i]['swg_name'] = $row->swg_name;
		$i++;
	}
?>

<div class="modal-tool-admin clearfix" style="border-bottom:none;">
    <p class="modal-tool-admin-title">Edit Component</p>
    <form id="upload_form_main_edit"  method="post" enctype="multipart/form-data">				
        <div class="file-container btn-default btn-mint-border" style="width:192px;">
            <label class="modal-tool-admin-label">Select New Image File</label>
            <input type="file" name="uploadedfile" id="uploadedfile" onchange="submit_edit_component_upload(<?php echo $_SESSION['component_id']; ?>);">
        </div>
    </form>
</div>                
        	
<form action="<?php echo $ste_root; ?>/manage/tool-admin/component.php" method="post" onsubmit="return validate(this);">
<input type="hidden" name="update_component" value="1" />
<input type="hidden" name="component_id" value="<?php echo $_SESSION['component_id']; ?>" />
<div class="modal-tool-admin clearfix">
    <div class="clearfix">
        <div class="left-side">
            <div class="plate-detail clearfix component-name-label">
                <label class="modal-tool-admin-label ">Component Name*</label>
                <input type="text" class="input-border-bottom modal-normal-input" 
                id="edit_component_name" name="component_name" value="<?php echo $_SESSION['tmp_vars']['component_name']; ?>"/>
            </div>
                        
			<div class="plate-detail clearfix cleat-name-label">
					<label class="modal-tool-admin-label ">Constructed Part</label>
                    <button  type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-constructed-parts" 
						onClick="open_modal_add_cmp_constructed_part_edit();">
						Add Constructed Part
                    </button>

                    <button type="button" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify"
						onClick="open_modal_by_id('modify_constructed_part');">
                        Modify
                    </button>
			</div>

			<ul id="ajx_part_list_edit">
                    <?php
					foreach($_SESSION['constructed_part_array'] as $key => $v){
                        echo "<li>".stripslashes($v['part_name']);
                        echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
                        echo "<a style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_constructed_part(".$v['part_id'].")'>delete</a></li>";
					}
					?>
			</ul>

			<div class="plate-detail clearfix cleat-name-label">
					<label class="modal-tool-admin-label">Catalog Part</label>
                    <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-catalog-parts" 
                        onclick="open_modal_add_cmp_fixed_part_edit();">
                        Add Catalog Part
					</button>
                            
                    <button type="button" 
                    	onClick="open_modal_by_id('modify_catalog_part');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        Modify
                    </button>                      
			</div>

			<ul id="ajx_fixed_part_list">
					<?php
                    foreach($_SESSION['fixed_part_array'] as $key => $v){
						echo "<li>".stripslashes($v['part_name']);
						echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
						echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_fixed_part(".$v['part_id'].")'>delete</span></li>";
                    }
                    ?>
            </ul>
            <div class="label-with-dropdown clearfix">
                <label>Choose One or More Collections</label>
                <select class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown"
                multiple='multiple' id="edit_collection_ids" name='collection_ids[]' size="1" 
                onChange="expand_select(this,<?php echo count($collection_array); ?>)">
                <option value="0">Select</option>    
                <?php
                foreach($collection_array as $val){
                if(in_array($val['collection_id'], $_SESSION['collections'])){
                $sel = "selected";	
                }else{
                $sel = '';
                }
                echo "<option value='".$val['collection_id']."' $sel>".$val['collection_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_collection');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="edit-component-detail-input-1">
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">Component Image</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_component_image" name="component_image" value="<?php echo $_SESSION['tmp_vars']['component_image']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">Component SKU</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_component_sku" name="component_sku" value="<?php echo $_SESSION['tmp_vars']['component_sku']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">Component Number</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_component_number" name="component_number" value="<?php echo $_SESSION['tmp_vars']['component_number']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">Component Weight</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_component_weight" name="component_weight" value="<?php echo $_SESSION['tmp_vars']['component_weight']; ?>"/>
                </div>
            </div>
            <div class="edit-component-detail-input-2">
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">System Hole Occupancy</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_system_hole_occupancy" name="system_hole_occupancy" value="<?php echo $_SESSION['tmp_vars']['system_hole_occupancy']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">System Hole Increment</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_system_hole_increment" name="system_hole_increment" value="<?php echo $_SESSION['tmp_vars']['system_hole_increment']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">System Hole Offset</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_system_hole_offset" name="system_hole_offset" value="<?php echo $_SESSION['tmp_vars']['system_hole_offset']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label">System Hole Padding Top</label>
                    <input type="text" class="input-border-bottom" 
                    id="edit_system_hole_padding_top" name="system_hole_padding_top" value="<?php echo $_SESSION['tmp_vars']['system_hole_padding_top']; ?>"/>
                </div>
            </div>
            <div class="separator-text-input">
                <div class="add-on-checkbox-item clearfix">
	                <span class="add-on-checkbox-text add-on-checkbox-left-text">Allow Custom Width</span>
					<label class="switch">
                                    <input type="checkbox" id="edit_allow_custom_width" 
                                    name="allow_custom_width" <?php if($_SESSION['tmp_vars']['allow_custom_width']) echo "checked"; ?> value="1">
                                    <span class="switch-slider round"></span>
                    </label>
				</div>
			</div>
		</div>
		<div class="right-side">
			<div class="separator-text-input-right">
            	<label class="modal-tool-admin-label">Price Unit</label>
                <input type="text" class="input-border-bottom" 
                id="edit_price_unit" name="price_unit" value="<?php echo $_SESSION['tmp_vars']['price_unit']; ?>"/>
			</div>
            <div class="separator-text-input-right">
                <label class="modal-tool-admin-label">QTY Unit</label>
                <input type="text" class="input-border-bottom" 
                id="edit_qty_unit" name="qty_unit" value="<?php echo $_SESSION['tmp_vars']['qty_unit']; ?>"/>
            </div>
            <div class="plate-detail clearfix">
	            <input type="hidden" id="edit_description" name="description" value="<?php echo $_SESSION['tmp_vars']['description']; ?>" />    
                                        <?php
                                        $descr_1 = substr($_SESSION['tmp_vars']['description'],0,50);
                                        $descr_2 = substr($_SESSION['tmp_vars']['description'],50);
                                        ?> 
                                        
                <label class="modal-tool-admin-label">Description</label>
                <input type="text" class="input-border-bottom  desc-input-1" name="descr_1" style="width:300px;"  value="<?php echo $descr_1;  ?>" />
                <input type="text" class="input-border-bottom  desc-input-2" name="descr_2" style="width:300px;"  value="<?php echo $descr_2;  ?>"/>
            </div>
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>Material</label>
                <select id="edit_material_id" name="material_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($materials_array as $val){
                $sel = ($val['material_id'] == $_SESSION['tmp_vars']['material_id']) ? "selected" : '';			
                echo "<option value='".$val['material_id']."' $sel>".$val['material_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_material');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>Price Schema ID</label>
                <select id="edit_price_schema_id" name="price_schema_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($price_schema_array as $val){
                $sel = ($val['price_schema_id'] == $_SESSION['tmp_vars']['price_schema_id']) ? "selected" : '';			
                echo "<option value='".$val['price_schema_id']."' $sel>".$val['price_schema_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_price_schema');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>QTY Schema</label>
                <select id="edit_qty_schema_id" name="qty_schema_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_schema_array as $val){
                $sel = ($val['qty_schema_id'] == $_SESSION['tmp_vars']['qty_schema_id']) ? "selected" : '';			
                echo "<option value='".$val['qty_schema_id']."' $sel>".$val['qty_schema_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_qty_schema');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>Quantity Calculations</label>
                <select id="edit_qty_calc_id" name="qty_calc_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = ($val['qty_calc_id'] == $_SESSION['tmp_vars']['qty_calc_id']) ? "selected" : '';			
                echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_qty_calc');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>Width Constraints</label>
                <select id="edit_width_constraints_id" name="width_constraints_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($swg_array as $val){
                $sel = ($val['swg_id'] == $_SESSION['tmp_vars']['width_constraints_id']) ? "selected" : '';				
                echo "<option value='".$val['swg_id']."' $sel>".$val['swg_name']."</option>";								
                }
                ?>
                </select>
                <button type="button" 
                onClick="open_modal_by_id('modify_dimension_restrictions');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <div class="label-with-dropdown clearfix">
                <label>Part Type</label>
                <select id="edit_part_type_id" name="part_type_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:180px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($part_type_array as $val){
                $sel = ($val['part_type_id'] == $_SESSION['tmp_vars']['part_type_id']) ? "selected" : '';			
                echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                }
                ?>
                </select>
							<!--
                            <button type="button" 
                                onClick="open_modal_by_id('modify_part_type');" 
                                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                                Modify
                            </button>
							-->
			</div>
		</div>
	</div>
    <div class="container-btn-bottom">
        <button class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border">
        Save
        </button>
        <button type="button" onclick="open_part_preview();" class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border">
        Preview Part
        </button>
        <span class="modal-close" onclick="close_modal_edit();">Cancel</span>
    </div>
</div>





<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT part_id	
					,part_name		
				FROM parts 
				WHERE parts.part_category='0' 
				AND saas_id = '".$_SESSION['profile_account_id']."'
				ORDER BY part_name";
		$result = $dbCustom->getResult($db,$sql);
?>

<div  id="modal_add_cmp_constructed_part_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Constructed Part</label>
        <select id="part_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->part_id."'>".stripslashes($row->part_name)."</option>";
				}
				?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">QTY</label>
        <input type="text" id="part_qty_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cmp_constructed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cmp_constructed_part_edit(); add_session_constructed_part_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>




<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT part_id	
					,part_name		
				FROM parts 
				WHERE parts.part_category='1' 
				AND saas_id = '".$_SESSION['profile_account_id']."'
				ORDER BY part_name";
		$result = $dbCustom->getResult($db,$sql);
?>
<div id="modal_add_cmp_fixed_part_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
        		
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Catalog Part</label>

		<select id="fixed_part_id_edit" class="small-popoup-select-box" style="width:180px; font-size:12px;">
                <?php
				while($row = $result->fetch_object()) {
				echo "<option value='".$row->part_id."'>".stripslashes($row->part_name)."</option>";
				}
				?>
        </select>
    </div>            
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">QTY</label>
        <input type="text" id="fixed_part_qty_edit" name="qty" value="1" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cmp_fixed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cmp_fixed_part_edit(); add_session_fixed_part_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>


