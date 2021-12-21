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

$_SESSION['section_id'] = isset($_GET['section_id'])? $_GET['section_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT *
		FROM cabinetry_sections
		WHERE section_id = %u", $_SESSION['section_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$section_name = $object->section_name;   
	$unit_price = $object->unit_price;
	$default_section_height = $object->default_section_height;
	$unit_qty = $object->unit_qty;
	$uses_floor_support = $object->uses_floor_support;
	$is_hutch_style = $object->is_hutch_style;
	$qty_schema_id = $object->qty_schema_id;
	$price_schema_id = $object->price_schema_id;
	$qty_calc_id = $object->qty_calc_id;

}else{

	exit;
}


$sql = "SELECT hutch_system_hole
			FROM cabinetry_sections_to_cabinetry_panels
			WHERE section_id = '".$_SESSION['section_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$hutch_system_hole = $object->hutch_system_hole;
}



	$_SESSION['panel_ids'] = array();
	$sql = "SELECT section_to_panel_id, panel_id
			FROM cabinetry_sections_to_cabinetry_panels
			WHERE section_id = '".$_SESSION['section_id']."'";
   	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$_SESSION['panel_ids'] = $row->panel_id; 
	}


	$_SESSION['unit_array'] = array();
	$sql = "SELECT cabinetry_sections_to_cabinetry_units.unit_id
					,cabinetry_sections_to_cabinetry_units.system_hole
					,cabinetry_units.unit_name
			FROM cabinetry_units, cabinetry_sections_to_cabinetry_units
			WHERE cabinetry_units.unit_id = cabinetry_sections_to_cabinetry_units.unit_id
			AND cabinetry_sections_to_cabinetry_units.section_id = '".$_SESSION['section_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['unit_array'][$i]['unit_id'] = $row->unit_id;
		$_SESSION['unit_array'][$i]['unit_name'] = $row->unit_name;	
		$_SESSION['unit_array'][$i]['system_hole'] = $row->system_hole;	
		$i++;
	}


	$_SESSION['toe_plate_array'] = array();
	
	$sql = "SELECT cabinetry_sections_to_cabinetry_toe_plates.toe_plate_id
					,cabinetry_sections_to_cabinetry_toe_plates.system_hole
					,cabinetry_toe_plates.toe_plate_name
			FROM cabinetry_toe_plates, cabinetry_sections_to_cabinetry_toe_plates
			WHERE cabinetry_toe_plates.toe_plate_id = cabinetry_sections_to_cabinetry_toe_plates.toe_plate_id
			AND cabinetry_sections_to_cabinetry_toe_plates.section_id = '".$_SESSION['section_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['toe_plate_array'][$i]['toe_plate_id'] = $row->toe_plate_id;
		$_SESSION['toe_plate_array'][$i]['toe_plate_name'] = $row->toe_plate_name;	
		$_SESSION['toe_plate_array'][$i]['system_hole'] = $row->system_hole;	
		$i++;
	}



	$_SESSION['cleat_array'] = array();
	
	$sql = "SELECT cabinetry_sections_to_cabinetry_cleats.cleat_id
					,cabinetry_sections_to_cabinetry_cleats.system_hole
					,cabinetry_cleats.cleat_name
			FROM cabinetry_cleats, cabinetry_sections_to_cabinetry_cleats
			WHERE cabinetry_cleats.cleat_id = cabinetry_sections_to_cabinetry_cleats.cleat_id
			AND cabinetry_sections_to_cabinetry_cleats.section_id = '".$_SESSION['section_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['cleat_array'][$i]['cleat_id'] = $row->cleat_id;
		$_SESSION['cleat_array'][$i]['cleat_name'] = $row->cleat_name;	
		$_SESSION['cleat_array'][$i]['system_hole'] = $row->system_hole;	
		$i++;
	}



	$_SESSION['backing_array'] = array();
	
	$sql = "SELECT cabinetry_sections_to_cabinetry_backing.backing_id
					,cabinetry_sections_to_cabinetry_backing.offset
					,cabinetry_backing.backing_name
			FROM cabinetry_backing, cabinetry_sections_to_cabinetry_backing
			WHERE cabinetry_backing.backing_id = cabinetry_sections_to_cabinetry_backing.backing_id
			AND cabinetry_sections_to_cabinetry_backing.section_id = '".$_SESSION['section_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['backing_array'][$i]['backing_id'] = $row->backing_id;
		$_SESSION['backing_array'][$i]['backing_name'] = $row->backing_name;	
		$_SESSION['backing_array'][$i]['offset'] = $row->offset;	
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

<form action="<?php echo SITEROOT; ?>manage/tool-admin/cabinetry-section.php" method="post" onsubmit="return validate(this);">
<input type="hidden" name="section_id" value="<?php echo $_SESSION['section_id']; ?>" />
<input type="hidden" name="update_cabinetry_section" value="1" />
<div class="modal-tool-admin clearfix">
    <div class="clearfix">
	    <div class="left-side">
            <p class="modal-tool-admin-title">Edit Cabinetry Section Detail</p>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Name*</label>
            <input type="text" class="input-border-bottom modal-normal-input" name="section_name" value="<?php echo $section_name; ?>"/>
            </div>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Default Height (mm)</label>
            <input type="text" class="input-border-bottom" name="default_section_height" value="<?php echo $default_section_height; ?>"/>
            </div>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Unit Price</label>
            <input type="text" class="input-border-bottom modal-normal-input" name="unit_price" value="<?php echo $unit_price; ?>"/>
            </div>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Unit QTY</label>
            <input type="text" class="input-border-bottom modal-normal-input" name="unit_qty" value="<?php echo $unit_qty; ?>"/>
            </div>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Hutch System Hole</label>
            <input type="text" class="input-border-bottom modal-normal-input" name="hutch_system_hole" value=""<?php echo $hutch_system_hole; ?>""/>
            </div>
            <div class="table-edit-cabinetry">
                <label style="width:74px;">Unit</label>
                <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-add-cabinetry" 
                onClick="open_modal_add_cabsec_unit_edit();">
                Add Unit
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_unit');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <ul id="ajx_unit_list_edit">
				<?php
                foreach($_SESSION['unit_array'] as $key => $v){
                echo "<li>".stripslashes($v['unit_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_unit(".$v['unit_id'].")'>delete</span></li>";
                }
                ?>
            </ul>
            <div class="table-edit-cabinetry">
                <label style="width:74px;">Cleats</label>
                <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border  btn-add-cabinetry"
                onClick="open_modal_add_cabsec_cleat_edit();">
                Add Cleat
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_cleat');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <ul id="ajx_cleat_list_edit">
				<?php
                foreach($_SESSION['cleat_array'] as $key => $v){
                echo "<li>".stripslashes($v['cleat_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_cleat(".$v['cleat_id'].")'>delete</span></li>";
                }
                ?>
            </ul>
            <div class="table-edit-cabinetry">
                <label style="width:74px;">Toe Plates</label>
                <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-add-cabinetry"
                onClick="open_modal_add_cabsec_toe_plate_edit();">    
                Add Toe Plates
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_toe_plate');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <ul id="ajx_toe_plate_list_edit">
				<?php
                foreach($_SESSION['toe_plate_array'] as $key => $v){
                echo "<li>".stripslashes($v['toe_plate_name'])."<span style='margin-left:8px;'>System Hole:</span>".$v['system_hole'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_toe_plate(".$v['toe_plate_id'].")'>delete</span></li>";
                }
                ?>
            </ul>
            <div class="table-edit-cabinetry">
                <label style="width:74px;">Backing</label>
                <button type="button" class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-add-cabinetry"
                onClick="open_modal_add_cabsec_backing_edit();"> 
                Add Backing
                </button>
                <button type="button" 
                onClick="open_modal_by_id('modify_backing');" 
                class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                Modify
                </button>
            </div>
            <ul id="ajx_backing_list_edit">
				<?php
                foreach($_SESSION['backing_array'] as $key => $v){
                echo "<li>".stripslashes($v['backing_name'])."<span style='margin-left:8px;'>Offset:</span>".$v['offset'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_backing(".$v['backing_id'].")'>delete</span></li>";
                }
                ?>
            </ul>
		</div>
		<div class="right-side">
            <div class="label-with-dropdown clearfix">
                <label>Panels</label>
                <select name="panel_ids[]" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($panel_array as $val){
                if(in_array($val['panel_id'] , $_SESSION['panel_ids'])){
                $sel = "selected";	
                }else{
                $sel = '';
                }
                echo "<option value='".$val['panel_id']."' $sel>".$val['panel_name']."</option>";								
                }
                ?>
                </select>
            </div>
            <div class="label-with-dropdown clearfix">
                <label>Quantity Calculations</label>
                <select name="qty_calc_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = ($qty_calc_id == $val['qty_calc_id'])? "selected" : '';			
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
                <label>QTY Schema</label>
                <select name="qty_schema_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($qty_schema_array as $val){
                $sel =  '';			
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
            <div class="label-with-dropdown clearfix">
                <label>Price Schema</label>
                <select name="price_schema_id" class="btn-default btn-small with-small-bottom-shadow with-small-dropdown">              
                <option value="0">Select</option>    
                <?php
                foreach($price_schema_array as $val){
                $sel = '';			
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
            <div class="cabinetry-section-switch">
                <div class="add-on-checkbox-item clearfix">
                <span class="add-on-checkbox-text">User Floor Support</span>
                <label class="switch">
                <?php
                $checked = ($uses_floor_support > 0)? "checked" : ""; 
                ?>
                <input type="checkbox" name="uses_floor_support" <?php echo $checked; ?>>
                <span class="switch-slider round"></span>
                </label>
                </div>
            </div>
            <div class="cabinetry-section-switch">
                <div class="add-on-checkbox-item clearfix">
                <span class="add-on-checkbox-text">Is Hutch Style</span>
                <label class="switch">
                <?php
                $checked = ($is_hutch_style > 0)? "checked" : ""; 
                ?>
                <input type="checkbox" name="is_hutch_style">
                <span class="switch-slider round"></span>
                </label>
                </div>
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
</form>
            
            
            

<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT unit_id	
					,unit_name		
				FROM cabinetry_units 
				WHERE saas_id = '".$_SESSION['profile_account_id']."' 
				ORDER BY unit_name";
		$result = $dbCustom->getResult($db,$sql);
?>

<div id="modal_add_cabsec_unit_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Unit</label>
        <select id="unit_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->unit_id."'>".stripslashes($row->unit_name)."</option>";
				}
				?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">System Hole</label>
        <input type="text" id="unit_system_hole_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_unit_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_unit_edit(); add_session_unit_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>


            
<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT cleat_id	
					,cleat_name		
				FROM cabinetry_cleats 
				WHERE saas_id = '".$_SESSION['profile_account_id']."' 
				ORDER BY cleat_name";
		$result = $dbCustom->getResult($db,$sql);
?>


<div id="modal_add_cabsec_cleat_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Cleat</label>
        <select id="cleat_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->cleat_id."'>".stripslashes($row->cleat_name)."</option>";
				}
				?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">System Hole</label>
        <input type="text" id="cleat_system_hole_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_cleat_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_cleat_edit(); add_session_cleat_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>



<?php
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		$sql = "SELECT toe_plate_id	
					,toe_plate_name		
				FROM cabinetry_toe_plates 
				WHERE saas_id = '".$_SESSION['profile_account_id']."' 
				ORDER BY toe_plate_name";
		$result = $dbCustom->getResult($db,$sql);
?>



<div id="modal_add_cabsec_toe_plate_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Toe Plate</label>
        <select id="toe_plate_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->toe_plate_id."'>".stripslashes($row->toe_plate_name)."</option>";
				}
				?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">System Hole</label>
        <input type="text" id="toe_plate_system_hole_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_toe_plate_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_toe_plate_edit(); add_session_toe_plate_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>



<?php
		$sql = "SELECT backing_id	
					,backing_name		
				FROM cabinetry_backing 
				WHERE saas_id = '".$_SESSION['profile_account_id']."' 
				ORDER BY backing_name";
		$result = $dbCustom->getResult($db,$sql);
?>

<div  id="modal_add_cabsec_backing_edit" class="edit-container add-new-scheme-parameter"
	style="visibility:hidden; position:absolute; top:200px; left:64%; z-index:22;">
	<form>
	<div class="edit-form-wrapper no-border">
        <label class="text-italic">Add new Toe Plate</label>
        <select id="backing_id_edit" class="rounded-select" style="width:180px;">
            <option value="0">Select Options</option>
            <?php
				while($row = $result->fetch_object()) {
					echo "<option value='".$row->backing_id."'>".stripslashes($row->backing_name)."</option>";
				}
			?>
        </select>
    </div>
    <div class="edit-form-wrapper sort-order no-border">
        <label class="text-italic">Offset</label>
        <input type="text" id="backing_offset_edit" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button type="button" 
        	class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        	onClick="close_modal_add_cabsec_backing_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_cabsec_backing_edit(); add_session_backing_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>

