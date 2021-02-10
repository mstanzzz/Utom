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

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$_SESSION['toe_plate_id'] = (isset($_GET['toe_plate_id'])) ? $_GET['toe_plate_id'] : 0;

if(!is_numeric($_SESSION['toe_plate_id'])){
	
	echo "not a number";	
	exit;	
}

$sql = "SELECT toe_plate_name
		,part_type_id
		,qty_schema_id
		,price_schema_id
		,qty_calc_id
		,system_hole_occupancy
		,system_hole_increment
		,allow_custom_width
		FROM cabinetry_toe_plates
		WHERE toe_plate_id = '".$_SESSION['toe_plate_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$objet = $result->fetch_object();
	$toe_plate_name = $objet->toe_plate_name;
	$part_type_id  = $objet->part_type_id; 
	$qty_schema_id  = $objet->qty_schema_id; 
	$price_schema_id  = $objet->price_schema_id; 
	$qty_calc_id  = $objet->qty_calc_id; 
	$system_hole_occupancy  = $objet->system_hole_occupancy; 
	$system_hole_increment  = $objet->system_hole_increment; 
	$allow_custom_width  = $objet->allow_custom_width; 

}else{
	exit;	
}


	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
    
	$sql = "SELECT cabinetry_toe_plates_to_parts.part_id
					,cabinetry_toe_plates_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_toe_plates_to_parts
			WHERE parts.part_id = cabinetry_toe_plates_to_parts.part_id
			AND cabinetry_toe_plates_to_parts.is_fixed_part = '0'
			AND cabinetry_toe_plates_to_parts.toe_plate_id = '".$_SESSION['toe_plate_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['constructed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['constructed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['constructed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['constructed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}

	$sql = "SELECT cabinetry_toe_plates_to_parts.part_id
					,cabinetry_toe_plates_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_toe_plates_to_parts
			WHERE parts.part_id = cabinetry_toe_plates_to_parts.part_id
			AND cabinetry_toe_plates_to_parts.is_fixed_part = '1'
			AND cabinetry_toe_plates_to_parts.toe_plate_id = '".$_SESSION['toe_plate_id']."'";
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


?>

<form action="<?php echo $ste_root; ?>/manage/tool-admin/toe-plate.php" method="post" onsubmit="return validate(this);">
<input type="hidden" name="edit_toe_plate" value="1" />
<input type="hidden" name="toe_plate_id" value="<?php echo $_SESSION['toe_plate_id']; ?>" />
<div class="modal-tool-admin clearfix">
    <div class="clearfix">
        <div class="left-side">
            <p class="modal-tool-admin-title">Edit Toe Plate</p>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Toe Plate Name</label>
            <input type="text" class="input-border-bottom input-italic" name="toe_plate_name"  value="<?php echo $toe_plate_name; ?>"/>
            </div>
			<div class="plate-detail clearfix cleat-name-label">
					<label class="modal-tool-admin-label ">Constructed Part</label>

                    <button  type="button" 
                    	class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-constructed-parts" 
						onClick="open_modal_add_tp_constructed_part_edit();">
						Add Constructed Part
                    </button>

                    <button type="button" 
                    	onClick="open_modal_by_id('modify_constructed_part');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
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
                        onclick="open_modal_add_tp_fixed_part_edit();">
                        Add Catalog Part
					</button>
                            
                    <button type="button" 
                    	onClick="open_modal_by_id('modify_catalog_part');" 
                        class="btn-default btn-small with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
                        Modify
                    </button>                      
			</div>

			<ul id="ajx_fixed_part_list_edit">
					<?php
					
					//$_SESSION['fixed_part_array'] = array();
					
                    foreach($_SESSION['fixed_part_array'] as $key => $v){
						echo "<li>".stripslashes($v['part_name']);
						echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
						echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_fixed_part(".$v['part_id'].")'>delete</span></li>";
                    }
				?>
            </ul>
			<div class="label-with-dropdown label-with-dropdown-separator clearfix">
				<label>Collection</label>
                <select name='collection_ids[]' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($collection_array as $val){
                $sel = '';			
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
            <div class="label-with-dropdown clearfix">
                <label>Part Type</label>
                <select name="part_type_id" class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($part_type_array as $val){
                $sel = '';			
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
            <div class="separator-text-input">
                <label class="modal-tool-admin-label">System Hole Occupancy</label>
                <input type="text" class="input-border-bottom" name="system_hole_occupancy"  value="<?php echo $system_hole_occupancy; ?>"/>
            </div>
            <div class="separator-text-input">
                <label class="modal-tool-admin-label">System Hole Increment</label>
                <input type="text" class="input-border-bottom" name="system_hole_increment"  value="<?php echo $system_hole_increment; ?>"/>
            </div>
		</div>
		<div class="right-side">
			<div class="label-with-dropdown label-with-dropdown-separator clearfix">
                <label>QTY Calculation</label>
                <select name='qty_calc_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = '';			
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
                <select name='qty_schema_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($qty_schema_array as $val){
                $sel = '';			
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
                <label>Prise Schema ID</label>
                <select name='price_schema_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
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
			<div class="add-on-checkbox-item clearfix">
                <span class="add-on-checkbox-text add-on-checkbox-left-text">Allow Custom Width </span>
                <label class="switch">
                <input type="checkbox" name="allow_custom_width">
                <span class="switch-slider round"></span>
                </label>
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
		$sql = "SELECT part_id	
					,part_name		
				FROM parts 
				WHERE parts.part_category='0' 
				AND saas_id = '".$_SESSION['profile_account_id']."'
				ORDER BY part_name";
		$result = $dbCustom->getResult($db,$sql);
?>

<div  id="modal_add_tp_constructed_part_edit" class="edit-container add-new-scheme-parameter"
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
        onClick="close_modal_add_tp_constructed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_tp_constructed_part_edit(); add_session_constructed_part_edit();">
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
<div id="modal_add_tp_fixed_part_edit" class="edit-container add-new-scheme-parameter"
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
        onClick="close_modal_add_tp_fixed_part_edit();">
	        Cancel
        </button>
        <button type="button" class="btn-default btn-bold btn-mint-border with-bottom-shadow"
        onClick="close_modal_add_tp_fixed_part_edit(); add_session_fixed_part_edit();">
    	    Add
        </button>
    </div>
    </form>
</div>




            