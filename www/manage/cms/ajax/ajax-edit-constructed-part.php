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

$_SESSION['part_id'] = isset($_GET['part_id'])? $_GET['part_id'] : 0;

if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 'thumb_image';

$first_load = isset($_GET['first_load'])? $_GET['first_load'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

if($first_load > 0){
	
	$sql =  sprintf("SELECT *
				FROM parts
				WHERE part_id = %u", $_SESSION['part_id']);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();			
		$_SESSION['tmp_vars']['part_name'] = $object->part_name;
		$_SESSION['tmp_vars']['part_image'] = $object->part_image;
		$_SESSION['tmp_vars']['thumb_image'] = $object->thumb_image;
		$_SESSION['tmp_vars']['part_sku'] = $object->part_sku;
		$_SESSION['tmp_vars']['part_number'] = $object->part_number;
		$_SESSION['tmp_vars']['part_weight'] = $object->part_weight;
		$_SESSION['tmp_vars']['part_type_id'] = $object->part_type_id;
		$_SESSION['tmp_vars']['material_id'] = $object->material_id;
		$_SESSION['tmp_vars']['price_schema_id'] = $object->price_schema_id;
		$_SESSION['tmp_vars']['qty_calc_id'] = $object->qty_calc_id;
		$_SESSION['tmp_vars']['qty_schema_id'] = $object->qty_schema_id;
		$_SESSION['tmp_vars']['description'] = $object->description;
		$_SESSION['tmp_vars']['width'] = $object->width;
		$_SESSION['tmp_vars']['height'] = $object->height;
		$_SESSION['tmp_vars']['depth'] = $object->depth;
		$_SESSION['tmp_vars']['width_offset'] = $object->width_offset;
		$_SESSION['tmp_vars']['height_offset'] = $object->height_offset;
		$_SESSION['tmp_vars']['depth_offset'] = $object->depth_offset;	

	}else{
		echo 'Does not exist';
		exit;	
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

$swg_array = array();
$sql = "SELECT swg_id
			,swg_name 
		FROM cabinetry_section_width_groups
		WHERE saas_id = '".$_SESSION['profile_account_id']."'";

$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$swg_array[$i]['swg_id'] = $row->swg_id;
	$swg_array[$i]['swg_name'] = $row->swg_name;
	$i++;
}

$exclude_part_types_array[] = "10 in. Drawer";  
$exclude_part_types_array[] = "12 in. Drawer";  
$exclude_part_types_array[] = "13 in. Hanging Basket";  
$exclude_part_types_array[] = "17 in. Hanging Basket";  
$exclude_part_types_array[] = "5 in. Drawer";  
$exclude_part_types_array[] = "6 in. Hanging Basket";  
$exclude_part_types_array[] = "7 in. Drawer";  
$exclude_part_types_array[] = "Edge Banding";  
$exclude_part_types_array[] = "Tilt Hamper";


/*
$url_str = $ste_root."manage/upload-pre-crop.php";
$url_str .= "?ret_path=tool-admin/constructed-part";
$url_str .= "&ret_modal=ajax-edit-constructed-part";
$url_str .= "&ret_id=".$_SESSION['part_id'];
*/					
?>

<div class="modal-tool-admin clearfix">
	<div class="clearfix">
    	<p class="modal-tool-admin-title">Edit Constructed Part Detail</p>
		 <form id="upload_form_thumb_edit" method="post" enctype="multipart/form-data">
			<div class="file-container btn-default btn-mint-border" style="width:192px;">
				<label class="modal-tool-admin-label">Select New Thumbnail File</label>
				<input type="file" name="uploadedfile" id="uploadedfile" 
						onchange="submit_edit_constructed_part_upload('0','<?php echo $_SESSION['part_id']; ?>');">
			</div>
		</form>
        <br />
        <form id="upload_form_main_edit"  method="post" enctype="multipart/form-data">				
			<div class="file-container btn-default btn-mint-border" style="width:192px;">
				<label class="modal-tool-admin-label">Select New Image File</label>
				<input type="file" name="uploadedfile" id="uploadedfile" 
						onchange="submit_edit_constructed_part_upload('1','<?php echo $_SESSION['part_id']; ?>');">
			</div>
 		</form>
		</div>
    <br />
    <br />                

<form action="<?php echo $ste_root; ?>/manage/tool-admin/constructed-part.php" method="post" onsubmit="return validate(this);">
<input type="hidden" name="part_id" value="<?php echo $_SESSION['part_id']; ?>" />
<input type="hidden" name="update_constructed_part" value="1" />
<div class="clearfix">
    <div class="left-side">
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Name*</label>
            <input type="text" class="input-border-bottom input-italic"
            id="edit_part_name" name="part_name"  value="<?php echo $_SESSION['tmp_vars']['part_name']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Image</label>
            <input type="text" class="input-border-bottom" 
            id="edit_part_image" name="part_image" value="<?php echo $_SESSION['tmp_vars']['part_image']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Image Thumbnail</label>
            <input type="text" class="input-border-bottom" 
            id="edit_thumb_image" name="thumb_image" value="<?php echo $_SESSION['tmp_vars']['thumb_image']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part SKU</label>
            <input type="text" class="input-border-bottom" 
            id="edit_part_sku" name="part_sku"  value="<?php echo $_SESSION['tmp_vars']['part_sku']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Number</label>
            <input type="text" class="input-border-bottom" 
            id="edit_part_number" name="part_number" value="<?php echo $_SESSION['tmp_vars']['part_number']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Weight</label>
            <input type="text" class="input-border-bottom modal-normal-input" 
            id="edit_part_weight" name="part_weight" value="<?php echo $_SESSION['tmp_vars']['part_weight']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Width</label>
            <input type="text" class="input-border-bottom modal-normal-input" 
            id="edit_width" name="width"  value="<?php echo $_SESSION['tmp_vars']['width']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Height</label>
            <input type="text" class="input-border-bottom modal-normal-input" 
            id="edit_height" name="height" value="<?php echo $_SESSION['tmp_vars']['height']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Depth</label>
            <input type="text" class="input-border-bottom modal-normal-input" 
            id="edit_depth" name="depth" value="<?php echo $_SESSION['tmp_vars']['depth']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Width Offset</label>
            <input type="text" class="input-border-bottom modal-normal-input" 
            id="edit_width_offset" name="width_offset" value="<?php echo $_SESSION['tmp_vars']['width_offset']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Height Offset</label>
            <input type="text" class="input-border-bottom  modal-normal-input" 
            id="edit_height_offset" name="height_offset" value="<?php echo $_SESSION['tmp_vars']['height_offset']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Part Depth Offset</label>
            <input type="text" class="input-border-bottom"
            id="edit_depth_offset"  name="depth_offset" value="<?php echo $_SESSION['tmp_vars']['depth_offset']; ?>"/>
        </div>
        <div class="separator-text-input">
            <label class="modal-tool-admin-label unit-label">Description</label>
            <input type="text" class="input-border-bottom modal-normal-input"
            id="edit_description" name="description" value="<?php echo $_SESSION['tmp_vars']['description']; ?>"/>
        </div>
    </div>
    
    <div class="right-side">
		<div class="label-with-dropdown label-with-dropdown-separator clearfix">
			<label>Part Type</label>
                <select id="edit_part_type_id" name="part_type_id" onchange="set_dimensions(this,'edit');" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px;">
                <option value="0">Select</option>    
                <?php
                foreach($part_type_array as $val){
					if(!in_array($val['part_type_name_user'], $exclude_part_types_array)){
						$sel = ($val['part_type_id'] == $_SESSION['tmp_vars']['part_type_id']) ? 'selected' : '';			
						echo "<option value='".$val['part_type_id']."|".$val['part_type_name_user']."' $sel>".$val['part_type_name_user']."</option>";	
					}
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
        <div class="label-with-dropdown label-with-dropdown-separator clearfix">
            <label>Material</label>
                <select id="edit_material_id" name="material_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px">              
                <option value="0">Select</option>    
                <?php
                foreach($materials_array as $val){
                $sel = ($val['material_id'] == $_SESSION['tmp_vars']['material_id']) ? 'selected' : '';			
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
                <select id="edit_price_schema_id"  name="price_schema_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($price_schema_array as $val){
                $sel = ($val['price_schema_id'] == $_SESSION['tmp_vars']['price_schema_id']) ? 'selected' : '';			
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
                <select id="edit_qty_schema_id"  name="qty_schema_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_schema_array as $val){
                $sel = ($val['qty_schema_id'] == $_SESSION['tmp_vars']['qty_schema_id']) ? 'selected' : '';			
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
            <label>Quantity Calculation</label>
                <select id="edit_qty_calc_id" name="qty_calc_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = ($val['qty_calc_id'] == $_SESSION['tmp_vars']['qty_calc_id']) ? 'selected' : '';			
                echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                }
                ?>
                </select>
            <button type="button" 
            onClick="open_modal_by_id('modify_qty_calculation');" 
            class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
            Modify
            </button>
        </div>
        <div class="label-with-dropdown clearfix">
            <label>Dimension Restrictions</label>
                <select id="edit_swg_id"  name="swg_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                style="padding:4px; width:126px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($swg_array as $val){
                $sel = ($val['swg_id'] == $_SESSION['tmp_vars']['swg_id']) ? 'selected' : '';			
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
	</div>
</div>
<div class="container-btn-bottom">
    <a href="">Delete</a>
    <button class="btn-default btn-bold with-bottom-shadow btn-with-border">
    Update Details
    </button>
    <span class="modal-close" onClick="close_modal_edit();">Cancel</span>
</div>
</form>
</div>

<?php
	$_SESSION['ret_modal'] = '';
?>
            