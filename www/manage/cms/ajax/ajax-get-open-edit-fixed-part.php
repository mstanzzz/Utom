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

$part_id = isset($_GET['part_id'])? $_GET['part_id'] : 0;

if(!isset($_SESSION['img_type'])) $_SESSION['img_type'] = 'thumb_image';

$first_load = isset($_GET['first_load'])? $_GET['first_load'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

if($first_load > 0 || ($_SESSION['tool_image'] == '' && $_SESSION['thumb_image'] == '')){
	
	$sql =  sprintf("SELECT *
				FROM parts
				WHERE part_id = %u", $part_id);
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();	
		$part_name = $object->part_name;
		$part_type_id = $object->part_type_id;
		$material_id = $object->material_id;
		$width = $object->width;
		$height = $object->height;
		$depth = $object->depth;
		$width_offset = $object->width_offset;
		$height_offset = $object->height_offset;
		$depth_offset = $object->depth_offset;	
		$part_category = $object->part_category;
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


?>


	<input type="hidden" name="part_id" value="<?php echo $part_id; ?>" />

     <div class="modal-tool-admin clearfix" style="width:660px;">
        <div class="clearfix">
            <div class="left-side" style="width:300px;">
				<p class="modal-tool-admin-title"> Add New Catalog Part</p>
				<div class="separator-text-input">
                	<label class="modal-tool-admin-label">Part Name*</label>
                	<input type="text" class="input-border-bottom input-italic" id="edit_sub_fixed_part_name" 
                    name="part_name" value="<?php echo $part_name; ?>" style="width:240px;" placeholder="Required Field"/>
				</div>         
                <div class="label-with-dropdown clearfix">
					<label>Part Type</label>
					<select id="edit_sub_fixed_part_type_id" name="part_type_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
                    	style="padding:4px; width:240px; margin-top:2px;">              
						<option value="0">Select</option>    
                        <?php
                        foreach($part_type_array as $val){
                            $sel = ($part_type_id == $val['part_type_id']) ? "selected" :  '';			
                            echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                        }
                        ?>
					</select>
				</div>
            	<div class="label-with-dropdown clearfix">
					<label>Material</label>
					<select id="edit_sub_fixed_material_id" name="material_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" 
						style="padding:4px; width:240px; margin-top:2px;">              
						<option value="0">Select</option>    						
						<?php
						foreach($materials_array as $val){
                            $sel = ($material_id == $val['material_id']) ? "selected" :  '';			
                            echo "<option value='".$val['material_id']."' $sel>".$val['material_name']."</option>";								
						}
						?>
					</select>
				</div>
			</div>
            <div class="right-side"  style="width:300px; padding-left:20px;">
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Width</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_width" 
                    name="width" value="<?php echo $width; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Height</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_height" 
                    name="height" value="<?php echo $height; ?>" />
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Depth</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_depth" 
                    name="depth" value="<?php echo $depth; ?>" />
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Width Offset</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_width_offset" 
                    name="width_offset" value="<?php echo $width_offset; ?>" />
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Height Offset</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_height_offset" 
                    name="height_offset" value="<?php echo $height_offset; ?>" />
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Depth Offset</label>
					<input type="text" style="width:240px;" class="input-border-bottom" id="edit_sub_fixed_depth_offset" 
                    name="depth_offset" value="<?php echo $depth_offset; ?>" />
				</div>
			</div>
		</div>
        
		<div class="container-btn-bottom">
            <a href="">Delete</a>
            <button type="button"
            	class="btn-default btn-bold with-bottom-shadow btn-with-border"
                onclick="update_sub_fixed_part(<?php echo $part_id; ?>);">
            Add
            </button>
            <span class="modal-close" onclick="close_sub_add_fixed_part();">Cancel</span>
		</div>
        
	</div>
