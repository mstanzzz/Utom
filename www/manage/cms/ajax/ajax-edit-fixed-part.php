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

$_SESSION['part_id'] = isset($_GET['part_id'])? $_GET['part_id'] : 0;


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql = "SELECT *
		FROM parts
		WHERE part_id = '".$_SESSION['part_id']."'";

$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$object = $result->fetch_object();
	$part_name = $object->part_name;
	$width = $object->width;
	$height = $object->height;
	$depth = $object->depth;
	$width_offset = $object->width_offset;
	$height_offset = $object->height_offset;
	$depth_offset = $object->depth_offset;
	$part_type_id = $object->part_type_id;
	$material_id = $object->material_id;	
			
}else{
			
	echo 'Does not exist';
	exit;	
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

$panel_array = array();					
$sql = "SELECT panel_id ,panel_name	
		FROM cabinetry_panels
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY panel_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {	
	$panel_array[$i]['panel_id'] = $row->panel_id;
	$panel_array[$i]['panel_name'] = $row->panel_name;
	$i++;
}
					
?>
<form action="<?php echo SITEROOT; ?>manage/tool-admin/fixed-part.php" method="post" onsubmit="return validate(this);">
<input type="hidden" name="part_id" value="<?php echo $_SESSION['part_id']; ?>" />
<input type="hidden" name="update_fixed_part" value="1" />
<div class="modal-tool-admin clearfix">
	<div class="clearfix">
		<div class="left-side"  >
			<p class="modal-tool-admin-title"> Add New Catalog Part</p>
			<div class="separator-text-input">
                <label class="modal-tool-admin-label">Part Name*</label>
                <input type="text" class="input-border-bottom input-italic" name="part_name"
                style="width:280px;" value="<?php echo $part_name; ?>"/>
            </div>         
            <div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>Part Type</label>
                <select name="part_type_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="padding:4px; width:160px; margin-top:2px;">              
                <option value="0">Select</option>    
                <?php
                foreach($part_type_array as $val){
                $sel = ($val['part_type_id'] == $part_type_id) ? 'selected' : '';			
                echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                }
                ?>
                </select>
            </div>
                
                <!--
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label>Item Category</label>
                    <div style="float:left;">
                        <select id="iten_cat_id_edit" name="cat_id" onchange="fill_items_edit();" 
                        class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="padding:4px; width:160px; margin-top:2px;">              
                            <option value="0">Select</option>    
                            <?php
                            //foreach($cat_array as $val){
                            //$sel =  '';			     
							//echo "<option value='".$val['cat_id']."' $sel>".$val['name']."</option>";								
                            //}
                            ?>
                        </select>
                    </div>

                            <button type="button" 
                                onClick="open_modal_by_id('modify_item_cat');" 
                                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                                    Modify
                            </button>
				</div>
                <div class="label-with-dropdown label-with-dropdown-separator clearfix">
					<label>Catalog Items</label>
					<div style="float:left;" id="item_select-box_edit">
                    
						<select name="item_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="padding:4px; width:160px; margin-top:2px;">              
                        	<option value="0">Select</option>    
						
                        </select>

					</div>

                            <button type="button" 
                                onClick="open_modal_by_id('modify_item');" 
                                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                                    Modify
                            </button>
                          
				</div>
                -->
			</div>

            <div class="right-side">
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Width</label>
					<input type="text" style="width:160px;" class="input-border-bottom" name="width" value="<?php echo $width; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Height</label>
					<input type="text" style="width:160px;" class="input-border-bottom" name="height" value="<?php echo $height; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:190px;">Catalog Part Depth</label>
					<input type="text" style="width:160px;" class="input-border-bottom" name="depth" value="<?php echo $depth; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Width Offset</label>
					<input type="text" style="width:136px;" class="input-border-bottom" name="width_offset" value="<?php echo $width_offset; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Height Offset</label>
					<input type="text" style="width:136px;" class="input-border-bottom" name="height_offset" value="<?php echo $height_offset; ?>"/>
				</div>
                <div class="separator-text-input">
					<label class="modal-tool-admin-label" style="width:200px;">Catalog Part Depth Offset</label>
					<input type="text" style="width:136px;" class="input-border-bottom" name="depth_offset" value="<?php echo $depth_offset; ?>"/>
				</div>


            	<div class="label-with-dropdown clearfix">
					<label>Material</label>
						<select name="material_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="padding:4px; width:140px; margin-top:2px;">              
							<option value="0">Select</option>    
							<?php
							foreach($materials_array as $val){
                            $sel = ($val['material_id'] == $material_id) ? 'selected' : '';			
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
		</div>
	</div>
    <div class="container-btn-bottom">
        <button class="btn-default btn-bold with-bottom-shadow btn-with-border">
        Update Details
        </button>
        <span class="modal-close" onclick="close_modal_edit();">Cancel</span>
    </div>
</div>
