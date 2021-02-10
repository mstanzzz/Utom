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
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/util_functions.php");

$_SESSION['ret_modal'] = 'edit';

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$_SESSION['unit_id'] = (isset($_GET['unit_id'])) ? $_GET['unit_id'] : 0;

$first_load = (isset($_GET['first_load'])) ? $_GET['first_load'] : 0;

if(!is_numeric($_SESSION['unit_id'])){
	
	echo "not a number";	
	exit;	
}

function getCollectionsArray($unit_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT collection_id
			FROM collection_units_assoc
			WHERE unit_id = '".$unit_id."'";
   	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$ret[] = $row->collection_id; 
	}
	return $ret;
}

$_SESSION['tmp_vars']['collection_ids'] = getCollectionsArray($_SESSION['unit_id']);



function getComponentsArray($unit_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT component_id
				,component_qty
			FROM cabinetry_units_to_cabinetry_components
			WHERE unit_id = '".$unit_id."'";
   	$result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$ret[$i]['component_id'] = $row->component_id;		
		$ret[$i]['component_name'] =  getComponentName($row->component_id);
		$ret[$i]['qty'] = $row->component_qty; 
		$i++;
	}
	return $ret;
}


$_SESSION['component_array'] = getComponentsArray($_SESSION['unit_id']);

if($_SESSION['tool_image'] != '') $_SESSION['tmp_vars']['unit_image'] = $_SESSION['tool_image'];             

$_SESSION['tool_image'] = '';


if($first_load > 0){

	$sql = "SELECT unit_name
			,description
			,collection_id
			,part_type_id
			,unit_image
			,unit_sku
			,unit_number
			,price_unit
			,price_schema_id	
			,qty_schema_id
			,qtyCalcID
			,qty_unit
			,unit_weight
			,material_id
		FROM cabinetry_units
		WHERE unit_id = '".$_SESSION['unit_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$objet = $result->fetch_object();
	
	//echo $objet->unit_name;
	
		$_SESSION['tmp_vars']['description'] = $objet->description;
		//$_SESSION['tmp_vars']['collection_id'] = $objet->collection_id;
		$_SESSION['tmp_vars']['unit_name'] = $objet->unit_name;
		$_SESSION['tmp_vars']['unit_image']  = $objet->unit_image;
		$_SESSION['tmp_vars']['unit_sku']  = $objet->unit_sku;
		$_SESSION['tmp_vars']['unit_number']  = $objet->unit_number;
		$_SESSION['tmp_vars']['price_schema_id'] = $objet->price_schema_id;
		$_SESSION['tmp_vars']['unit_weight']  = $objet->unit_weight;
		$_SESSION['tmp_vars']['price_unit'] = $objet->price_unit;
		$_SESSION['tmp_vars']['qty_schema_id'] = $objet->qty_schema_id;  
		$_SESSION['tmp_vars']['part_type_id'] = $objet->part_type_id;
		$_SESSION['tmp_vars']['qtyCalcID'] = $objet->qtyCalcID;
		$_SESSION['tmp_vars']['qty_unit'] = $objet->qty_unit;
		$_SESSION['tmp_vars']['material_id'] = $objet->material_id;
	
	
	
	}

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


$collection_array = array();


$sql = "SELECT collection_id
			,collection_name
		FROM  collection WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY collection_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$collection_array[$i]['collection_id'] = $row->collection_id;
	$collection_array[$i]['collection_name'] = $row->collection_name;
	$i++;
}


$material_array = array();

$sql = "SELECT material_id 
			,material_name	
		FROM materials
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY material_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$material_array[$i]['material_id'] = $row->material_id;
	$material_array[$i]['material_name'] = $row->material_name;
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


$component_array = array();
$sql = "SELECT component_id	
			,component_name		
		FROM cabinetry_components 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$component_array[$i]['component_id'] = $row->component_id;
	$component_array[$i]['component_name'] = $row->component_name;
	$i++;
}


?>

<div class="modal-tool-admin clearfix" style="border-bottom:none;">
    <p class="modal-tool-admin-title"> Edit Unit</p>
    <form id="upload_form_sub_unit_edit"  method="post" enctype="multipart/form-data">				
		<div class="file-container btn-default btn-mint-border" style="width:192px;">
            <label class="modal-tool-admin-label">Select New Image File</label>
            <input type="file" name="uploadedfile" id="uploadedfile" onchange="submit_edit_unit_upload(<?php echo $_SESSION['unit_id']; ?>);">
        </div>
    </form>
</div>                
<input type="hidden" name="unit_id" value="<?php echo $_SESSION['unit_id']; ?>" />
	<div class="modal-tool-admin clearfix">
		<div class="clearfix">
			<div class="left-side">
				<div class="clearfix edit-unit-detail-label">
                    <label class="modal-tool-admin-label">Unit Name*</label>
                    <input type="text" class="input-border-bottom input-italic" id="edit_sub_unit_name" name="unit_name" value="<?php echo $_SESSION['tmp_vars']['unit_name'];  ?>"/>
				</div>                    
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit Image</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_unit_image" name="unit_image" value="<?php echo $_SESSION['tmp_vars']['unit_image']; ?>" />
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit SKU</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_unit_sku" name="unit_sku" value="<?php echo $_SESSION['tmp_vars']['unit_sku']; ?>"/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit Number</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_unit_number" name="unit_number" value="<?php echo $_SESSION['tmp_vars']['unit_number']; ?> "/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit Weight</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_unit_weight" name="unit_weight" value="<?php echo $_SESSION['tmp_vars']['unit_weight']; ?> "/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit Price</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_price_unit" name="price_unit" value="<?php echo $_SESSION['tmp_vars']['price_unit']; ?> "/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Unit QTY</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_qty_unit" name="qty_unit" value="<?php echo $_SESSION['tmp_vars']['qty_unit']; ?> "/>
                </div>
                <div class="separator-text-input">
                    <label class="modal-tool-admin-label unit-label">Description</label>
                    <input type="text" class="input-border-bottom" id="edit_sub_descriptions" name="description" value="<?php echo $_SESSION['tmp_vars']['description']; ?>"/>
                </div>
                <div class="label-with-dropdown clearfix">
                    <label>Choose One or More Collections</label>
                    <select multiple='multiple' size="1" onChange="expand_select(this,<?php echo count($collection_array); ?>)" 
                    id="edit_sub_collection_ids" name='collection_ids[]' 
                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($collection_array as $val){
							if(in_array($val['collection_id'] , $_SESSION['tmp_vars']['collection_ids'])){
								$sel = "selected";	
							}else{
								$sel = '';
							}
								echo "<option value='".$val['collection_id']."' $sel>".$val['collection_name']."</option>";								
							}
                        ?>
                    </select>
                </div>
				<div class="clearfix edit-unit-detail-label" style="padding-top:20px; padding-bottom:20px;">
                    <button type="button"    
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify"
                        onClick="open_modal_sub_unit_add_component_edit();">
	                        Add Component
                    </button>
                    <div id="component_list_sub_unit_edit">
                    <table width="100%" cellpadding="10">
                    <?php
					if(count($_SESSION['component_array']) > 0){
						echo "<tr><td width='80%'>Component Name</td><td>QTY</td><td></td></tr>";	
						foreach($_SESSION['component_array'] as $v){
							echo '<tr><td>'.stripslashes($v['component_name']).'</td><td>'.$v['qty'].'</td>';
							echo "<td><span style='cursor:pointer; color:red;' 
							onClick='delete_component_from_sub_unit(0,".$v['component_id'].",\"unit\")'>delete</span></td>";									
						}
					}
                    ?>
                    </table>
                    </div>
                </div>
			</div>

            <div class="right-side">
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                    <label>Material</label>
                    <select id="edit_sub_material_id" name='material_id' 
                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($material_array as $val){
							$sel = ($val['material_id'] == $_SESSION['tmp_vars']['material_id']) ? "selected" : "";			
							echo "<option value='".$val['material_id']."' $sel>".$val['material_name']."</option>";								
                        }
                        ?>
                    </select>
                </div>
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                    <label>Price Schema ID</label>
                    <select id="edit_sub_price_schema_id" name='price_schema_id' 
                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($price_schema_array as $val){
							$sel = ($val['price_schema_id'] == $_SESSION['tmp_vars']['price_schema_id']) ? "selected" : "";				
							echo "<option value='".$val['price_schema_id']."' $sel>".$val['price_schema_name']."</option>";								
                        }
                        ?>
                    </select>
                </div>
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                    <label>QTY Schema</label>
                    <select id="edit_sub_qty_schema_id" name='qty_schema_id' 
                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($qty_schema_array as $val){
							$sel = ($val['qty_schema_id'] == $_SESSION['tmp_vars']['qty_schema_id']) ? "selected" : "";			
							echo "<option value='".$val['qty_schema_id']."' $sel>".$val['qty_schema_name']."</option>";								
                        }
                        ?>
                    </select>
                </div>
                <div class="label-with-dropdown clearfix">
                    <label>Quantity Calculations</label>
                    <select id="edit_sub_qty_calc_id" name='qty_calc_id' 
                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($qty_calc_array as $val){
							$sel = ($val['qty_calc_id'] == $_SESSION['tmp_vars']['qtyCalcID']) ? "selected" : "";			
							echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                        }
                        ?>
                    </select>

                </div>
                <div class="label-with-dropdown clearfix">
                    <label class="modal-tool-admin-label">Part Type</label>
                    <select id="edit_sub_part_type_id" name="part_type_id" 
	                    class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                        <option value="0">Select</option>    
                        <?php
                        foreach($part_type_array as $val){
                        $sel = ($val['part_type_id'] == $_SESSION['tmp_vars']['part_type_id']) ? "selected" : "";			
                        echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                        }
                        ?>
                    </select>
                </div>
			</div>
		</div>
        <div class="container-btn-bottom">
            <button 
                class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border"
                onclick="update_sub_unit(<?php echo $_SESSION['unit_id']; ?>);">
                    Save  <?php //echo $_SESSION['unit_id']; ?>
            </button>
            <button type="button" class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border">
	            Preview Part
            </button>
            <span class="modal-close" onclick="close_sub_edit_unit();">Cancel</span>
        </div>
	</div>   
