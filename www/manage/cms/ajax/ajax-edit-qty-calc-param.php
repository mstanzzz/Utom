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

$_SESSION['qty_calc_param_id'] = isset($_GET['qty_calc_param_id'])? $_GET['qty_calc_param_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT qty_calc_param_name						
					,param_calc_method
					,rounding_method
					,rounding_value
					,param_type
					,param_value
					,schema_units
		FROM qty_calc_param
		WHERE qty_calc_param_id = %u", $_SESSION['qty_calc_param_id']);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$qty_calc_param_name = $object->qty_calc_param_name;   
	$param_calc_method = $object->param_calc_method;
	$rounding_method = $object->rounding_method;
	$rounding_value = $object->rounding_value;   
	$param_type = $object->param_type;
	$param_value = $object->param_value;
	$schema_units = $object->schema_units;

}else{

	exit;
}

//param_calc_method
$sql = "SELECT param_calc_method_id ,param_calc_method_value	
		FROM param_calc_method
		ORDER BY param_calc_method_value";
$result = $dbCustom->getResult($db,$sql);
$param_calc_method_array = array(); 
$i = 0; 
while($row = $result->fetch_object()) {
	$param_calc_method_array[$i]['param_calc_method_id'] = $row->param_calc_method_id;
	$param_calc_method_array[$i]['param_calc_method_value'] = $row->param_calc_method_value;

	$i++;
}
                    
//param_type
$sql = "SELECT qty_param_type_id ,qty_param_type_value	
		FROM qty_param_type
		ORDER BY qty_param_type_value";
$result = $dbCustom->getResult($db,$sql);
$qty_param_type_array = array(); 
$i = 0; 
while($row = $result->fetch_object()) {
	$qty_param_type_array[$i]['qty_param_type_id'] = $row->qty_param_type_id;
	$qty_param_type_array[$i]['qty_param_type_value'] = $row->qty_param_type_value;
	$i++;
}


//schema_units
$sql = "SELECT schema_units_id ,schema_units_value	
		FROM schema_units
		ORDER BY schema_units_value";
$result = $dbCustom->getResult($db,$sql);
$schema_units_array = array(); 
$i = 0; 
while($row = $result->fetch_object()) {
	$schema_units_array[$i]['schema_units_id'] = $row->schema_units_id;
	$schema_units_array[$i]['schema_units_value'] = $row->schema_units_value;
	$i++;
}

//rounding_method
$sql = "SELECT schema_rounding_id ,schema_rounding_value	
		FROM schema_rounding
		ORDER BY schema_rounding_value";
$result = $dbCustom->getResult($db,$sql);
$schema_rounding_array = array(); 
$i = 0; 
while($row = $result->fetch_object()) {
	$schema_rounding_array[$i]['schema_rounding_id'] = $row->schema_rounding_id;
	$schema_rounding_array[$i]['schema_rounding_value'] = $row->schema_rounding_value;
	$i++;
}


?>

<div class="edit-container price-parameter-form add-parameter-form">
    <h4 class="title">Edit QTY Parameter</h4>
    <form action="qty-parameters.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
    <input type="hidden" name="update_calc_param" value="1" />
    <input type="hidden" name="qty_calc_param_id" value="<?php echo $_SESSION['qty_calc_param_id']; ?>" />
    <div class="plate-detail parameter-name clearfix">
        <label class="modal-tool-admin-label text-italic">QTY Parameter Name</label>
        <input type="text" id="edit_qty_calc_param_name" name="qty_calc_param_name" value="<?php echo $qty_calc_param_name; ?>"   
        class="input-border-bottom text-italic text-transform-unset greyed-input">
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Calc Method</label>
        <select id="edit_param_calc_method" name="param_calc_method" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($param_calc_method_array as $val){
        $sel = ($param_calc_method == $val['param_calc_method_id']) ? "selected" : '';
        echo "<option value='".$val['param_calc_method_id']."' $sel>".$val['param_calc_method_value']."</option>";	
        }
        ?>
        </select>
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Schema Price Unit</label>
        <select id="edit_schema_units" name="schema_units" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($schema_units_array as $val){
        $sel = ($schema_units == $val['schema_units_id']) ? "selected" : '';
        echo "<option value='".$val['schema_units_id']."' $sel>".$val['schema_units_value']."</option>";	
        }
        ?>
        </select>
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Rounding Method</label>
        <select id="edit_rounding_method" name="rounding_method" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($schema_rounding_array as $val){
        $sel = ($rounding_method == $val['schema_rounding_id']) ? "selected" : '';
        echo "<option value='".$val['schema_rounding_id']."' $sel>".$val['schema_rounding_value']."</option>";	
        }
        ?>
        </select>
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Parameter Type</label>
        <select id="edit_param_type" name="param_type" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($qty_param_type_array as $val){
        $sel = ($param_type == $val['qty_param_type_id']) ? "selected" : '';
        echo "<option value='".$val['qty_param_type_id']."' $sel>".$val['qty_param_type_value']."</option>";	
        }
        ?>
        </select>
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Parameter Value</label>
        <input type="text" id="edit_param_value" name="param_value" value="<?php echo $param_value; ?>" class="greyed-input input-width-140">
    </div>
    <div class="edit-form-wrapper no-border">
        <label class="text-italic">Dynamic Level Round Value</label>
        <input type="text" id="edit_rounding_value" name="rounding_value" value="<?php echo $rounding_value; ?>" class="greyed-input input-width-140">
    </div>
    <div class="btn-wrapper-center">
        <button class="btn-default btn-bold btn-mint-border with-bottom-shadow ">
        Save
        </button>
        <p style="cursor:pointer" onclick="close_modal_edit_qty_calc_param();">Cancel</p>
    </div>
</form>
</div>