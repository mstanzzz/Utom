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

$_SESSION['parent_modal'] = 'edit';

function getEbidsArray($material_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	
	$sql = "SELECT banding_id
			FROM edge_banding_material_assoc
			WHERE material_id = '".$material_id."'";
   	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$ret[] = $row->banding_id; 
	}
	return $ret;
}

$material_id = isset($_GET['material_id'])? $_GET['material_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT	material_name
				,brand_id
				,vendor_id
				,product_num
				,core_id
				,type_id
				,finish_id
				,texture_id
				,green_id
				,material_weight_unit
				,material_width
				,material_thickness
				,material_length
				,material_stocked
				,stain_id
				,RTF
				,HPL
				,hanging_bracket_cover_color_id
				,rail_cover_color_id
				,kd_fitting_color_id
				,tier_id
				,qty_calc_id
		FROM materials
		WHERE material_id = %u", $material_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$material_name = $object->material_name;
	$brand_id = $object->brand_id;
	$vendor_id = $object->vendor_id;
	$product_num = $object->product_num;
	$core_id = $object->core_id;
	$type_id = $object->material_name;
	$finish_id = $object->finish_id;
	$texture_id = $object->texture_id;
	$green_id = $object->green_id;
	$material_weight_unit = $object->material_weight_unit;
	$material_width = $object->material_width;
	$material_thickness = $object->material_thickness;
	$material_length = $object->material_length;
	$material_stocked = $object->material_stocked;
	$stain_id = $object->stain_id;
	$RTF = $object->RTF;
	$HPL = $object->HPL;
	$hanging_bracket_cover_color_id = $object->hanging_bracket_cover_color_id;
	$rail_cover_color_id = $object->rail_cover_color_id;
	$kd_fitting_color_id = $object->kd_fitting_color_id;
	$tier_id = $object->tier_id;
	$qty_calc_id = $object->qty_calc_id;

}else{
	
	exit;
}

$rtf_name = '';
$rtf_brand_id = 0;
$rtf_vendor_id = 0;

$hpl_name = '';
$hpl_brand_id = 0;
$hpl_vendor_id = 0;



$eb_ids = getEbidsArray($material_id);


$sql = "SELECT eb_id
		,eb_name
	FROM edge_banding
	WHERE saas_id = '".$_SESSION['profile_account_id']."'
	ORDER BY eb_name";

	
$result = $dbCustom->getResult($db,$sql);
$edge_banding_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$edge_banding_array[$i]['eb_id'] = $row->eb_id;
	$edge_banding_array[$i]['eb_name'] = $row->eb_name; 
	$i++;
}	


$sql = "SELECT core_id ,core_name,is_green	
		FROM core
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY core_name";
$result = $dbCustom->getResult($db,$sql);
$core_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$core_array[$i]['core_id'] = $row->core_id;
	$core_array[$i]['core_name'] = $row->core_name; 
	$i++;
}	

$sql = "SELECT material_type_id ,material_type_name	
		FROM material_types
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY material_type_name";
$result = $dbCustom->getResult($db,$sql);
$material_type_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$material_type_array[$i]['material_type_id'] = $row->material_type_id;
	$material_type_array[$i]['material_type_name'] = $row->material_type_name; 
	$i++;
}	

$sql = "SELECT finish_id ,finish_name
		FROM finishes
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY finish_name";
$result = $dbCustom->getResult($db,$sql);
$finish_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$finish_array[$i]['finish_id'] = $row->finish_id;
	$finish_array[$i]['finish_name'] = $row->finish_name; 
	$i++;
}	


$sql = "SELECT texture_id ,texture_name	
		FROM textures
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY texture_name";
$result = $dbCustom->getResult($db,$sql);
$texture_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$texture_array[$i]['texture_id'] = $row->texture_id;
	$texture_array[$i]['texture_name'] = $row->texture_name; 
	$i++;
}	


$sql = "SELECT tier_id ,tier_name	
		FROM material_tiers
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY tier_name";
$result = $dbCustom->getResult($db,$sql);
$material_tier_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$material_tier_array[$i]['tier_id'] = $row->tier_id;
	$material_tier_array[$i]['tier_name'] = $row->tier_name; 
	$i++;
}	


$sql = "SELECT id, name 
		FROM color
		WHERE saas_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$color_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$color_array[$i]['id'] = $row->id;
	$color_array[$i]['name'] = $row->name; 
	$i++;
}	


$sql = "SELECT qty_calc_id, qty_calc_name 
		FROM qty_calc_equations
		ORDER BY qty_calc_name";
$result = $dbCustom->getResult($db,$sql);
$qty_calc_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$qty_calc_array[$i]['qty_calc_id'] = $row->qty_calc_id;
	$qty_calc_array[$i]['qty_calc_name'] = $row->qty_calc_name; 
	$i++;
}	


$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT brand_id	,name	
		FROM brand
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);
$brand_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$brand_array[$i]['brand_id'] = $row->brand_id;
	$brand_array[$i]['name'] = $row->name; 
	$i++;
}	

$sql = "SELECT vend_man_id, name	
		FROM vend_man
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY name";
$result = $dbCustom->getResult($db,$sql);
$vend_man_array = array();		
$i = 0;
while($row = $result->fetch_object()){
	$vend_man_array[$i]['vend_man_id'] = $row->vend_man_id;
	$vend_man_array[$i]['name'] = $row->name; 
	$i++;
}	


?>

<input type="hidden" id="update_this_material_id" name="material_id" value="<?php echo $material_id; ?>" />


    <div class="clearfix">
		<div class="left-side" style="width:280px;">
			<p class="modal-tool-admin-title">Edit Material</p>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Material Name*</label>
                <input type="text" class="input-border-bottom modal-normal-input input-italic" style="width:260px;"
                id="edit_material_name" name="material_name" value="<?php echo $material_name; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Product Number / SQL</label>
                <input type="text" class="input-border-bottom modal-normal-input" style="width:260px;"
                id="edit_product_num" name="product_num" value="<?php echo $product_num; ?>" />
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Weight</label>
                <input type="text" class="input-border-bottom modal-normal-input" style="width:260px;"
                id="edit_material_weight_unit" name="material_weight_unit" value="<?php echo $material_weight_unit; ?>" />
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Width</label>
                <input type="text" class="input-border-bottom modal-normal-input" style="width:260px;"
                id="edit_material_width" name="material_width" value="<?php echo $material_width; ?>" />
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Thickness</label>
                <input type="text" class="input-border-bottom modal-normal-input" style="width:260px;"
                id="edit_material_thickness" name="material_thickness" value="<?php echo $material_thickness; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Length</label>
                <input type="text" class="input-border-bottom modal-normal-input" style="width:260px;"
                id="edit_material_length"name="material_length" value="<?php echo $material_length; ?>" />
            </div>
            <div class="clearfix edit-unit-detail-label btn-more-edge-banding">
            <i>Choose one or more Edge Banding</i>  
            <div>
                <select multiple id="edit_eb_ids" name="eb_ids[]" class="rounded-select" size="1" 
                onChange="expand_select(this,<?php echo count($edge_banding_array); ?>)" style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($edge_banding_array as $val){
                    if(in_array($val['eb_id'], $eb_ids)){
                    $sel = "selected";	
                    }else{
                    $sel = '';
                    }
                    echo "<option value='".$val['eb_id']."' $sel>".$val['eb_name']."</option>";	
                    }
                    ?>
                </select>
                                                    
                <button type="button" 
	                onClick="open_modal_by_id('modify_edge_banding');" 
    	            class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
        		        Edge Banding
                </button>
            </div>  
		</div>
        <div id="mat_swiches_edit">
        	<div class="clearfix edit-unit-detail-label">
        		<div class="add-on-checkbox-item clearfix">
        			<span class="add-on-checkbox-text add-on-checkbox-left-text">Is green</span>
        			<label class="switch">
        			<input id="edit_green_id" name="green_id" type="checkbox" value="1" <?php if($green_id > 0) echo "checked"; ?>>
        			<span class="switch-slider round"></span>
        			</label>
        			<br>
        			<i>Environmental Friendly</i>
        		</div>
				<div class="add-on-checkbox-item clearfix">
                    <span class="add-on-checkbox-text add-on-checkbox-left-text">Stocked</span>
                    <label class="switch">
                    <input type="checkbox" id="edit_material_stocked" value="1" name="material_stocked" <?php if($material_stocked) echo "checked"; ?>>
                    <span class="switch-slider round"></span>
                    </label>
				</div>
			</div>
		</div>
        <table class="edit-edge-table">
        <tr>
            <td>
	            <span class="">Brand</span> 
            </td>
            <td>
                <select id="edit_brand_id" name="brand_id" class="rounded-select" style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($brand_array as $val){
                    $sel = ($brand_id == $val['brand_id'])? "selected" : '';
                    echo "<option value='".$val['brand_id']."' $sel>".$val['name']."</option>";	
                    }
                    ?>
                </select>
            </td>
		</tr>
		<tr>
            <td>
	            <span class="">Vendor</span> 
            </td>
            <td>
                <select id="edit_vendor_id" name="vendor_id" class="rounded-select" style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($vend_man_array as $val){
                    $sel = ($vendor_id == $val['vend_man_id'])? "selected" : '';												
                    echo "<option value='".$val['vend_man_id']."' $sel>".$val['name']."</option>";	
                    }
                    ?>
                </select>
            </td>
		</tr>
		</table>
	</div>
	<div class="right-side">
		<table class="edit-edge-table">
		<tr class="wrapper-text-with-border-bottom">
			<td>
	            <span class="text-with-border-bottom">Content</span>
            </td>
            <td>
	            <span class="text-with-border-bottom">Options</span>
            </td>
        </tr>
        <tr>
            <td>
        	    <span class="">Core</span> 
            </td>
            <td>
                <select id="edit_core_id" name="core_id" class="rounded-select" style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($core_array as $val){
                    $sel = ($core_id == $val['core_id'])? "selected" : "";
 					echo "<option value='".$val['core_id']."' $sel>".$val['core_name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
		</tr>
		<tr>
            <td>
	            <span class="">Mat.Type</span>
            </td>
            <td>
                <select id="edit_type_id" name="type_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($material_type_array as $val){
						$sel = ($type_id == $val['material_type_id'])? "selected" : "";
						echo "<option value='".$val['material_type_id']."' $sel>".$val['material_type_name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
		</tr>
        <tr>
            <td>
	            <span class="">Finish</span>
            </td>
            <td>
                <select id="edit_finish_id" name="finish_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($finish_array as $val){
						$sel = ($finish_id == $val['finish_id'])? "selected" : "";
						echo "<option value='".$val['finish_id']."' $sel>".$val['finish_name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
	            <span class="">Texture</span>
            </td>
			<td>
                <select id="edit_texture_id" name="texture_id" class="rounded-select"  style="width:200px;">
                	<option value="0">Select Options</option>
					<?php
					foreach($texture_array as $val){
						$sel = ($texture_id == $val['texture_id'])? "selected" : "";
                        echo "<option value='".$val['texture_id']."' $sel>".$val['texture_name']."</option>";	
					}		
					?>
				</select>
            </td>
		</tr>
        <tr>
            <td>
	            <span class="">Tier ID</span>
            </td>
            <td>
                <select id="edit_tier_id" name="tier_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($material_tier_array as $val){
                    	$sel = ($tier_id == $val['tier_id'])? "selected" : "";
                    	echo "<option value='".$val['tier_id']."' $sel>".$val['tier_name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
        </tr>
		<tr>
			<td>
				<span class="">Hanging Bracket Cover Finish</span>
			</td>
            <td>
                <select id="edit_hanging_bracket_cover_color_id" name="hanging_bracket_cover_color_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($color_array as $val){
						$sel = ($hanging_bracket_cover_color_id == $val['id'])? "selected" : "";
						echo "<option value='".$val['id']."' $sel>".$val['name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
		</tr>
		<tr>
            <td>
	            <span class="">Rail Cover Finish</span>
            </td>
            <td>
                <select id="edit_rail_cover_color_id" name="rail_cover_color_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($color_array as $val){
						$sel = ($rail_cover_color_id == $val['id'])? "selected" : "";
						echo "<option value='".$val['id']."' $sel>".$val['name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
		</tr>
		<tr>
            <td>
	            <span class="">KD Fittings Finish</span>
            </td>
            <td>
                <select id="edit_kd_fitting_color_id" name="kd_fitting_color_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($color_array as $val){
                    $sel = ($kd_fitting_color_id == $val['id'])? "selected" : "";
                    echo "<option value='".$val['id']."' $sel>".$val['name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
		</tr>
		<tr>
            <td>
	            <span class="">Quantity Calculations</span>
            </td>
            <td>
                <select id="edit_qty_calc_id" name="qty_calc_id" class="rounded-select"  style="width:200px;">
                    <option value="0">Select Options</option>
                    <?php
                    foreach($qty_calc_array as $val){									
						$sel = ($qty_calc_id == $val['qty_calc_id'])? "selected" : "";
						echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";	
                    }		
                    ?>
                </select>
            </td>
	</tr>
	</table>
    <div class="container-btn-bottom">
        <button 
        	class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border"
            onClick="update_sub_material();">
            	Save 
        </button>           
        <span onclick="close_sub_edit_material();" class="modal-close">Cancel</span>
	</div>
</div>
</div>

