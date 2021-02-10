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

$qty_calc_id = isset($_GET['qty_calc_id'])? $_GET['qty_calc_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT qty_calc_name						
					,qty_calc_equation
		FROM qty_calc_equations
		WHERE qty_calc_id = %u", $qty_calc_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$qty_calc_name = $object->qty_calc_name;   
	$qty_calc_equation = $object->qty_calc_equation;

}else{

	exit;
}



?>



<div class="edit-container add-qty qty-calculation-form"
	style="position:absolute; left:24%; top:-160px; z-index:16; background:#FFF;">
	<h4 class="title">Edit QTY Calculation</h4>
        
        <input type="hidden" id="update_this_qty_calc_id" name="qty_calc_id" value="<?php echo $qty_calc_id; ?>" />
        
        <div class="plate-detail parameter-name clearfix">
            <label class="modal-tool-admin-label text-italic">QTY Calculation Name</label>
            
            <input type="text" id="update_this_sub_qty_calc_name" name="qty_calc_name" value="<?php echo $qty_calc_name; ?>"
            class="input-border-bottom  full-width  text-italic text-transform-unset greyed-input">
        </div>
        <div class="edit-form-wrapper no-border">
            <label class="text-italic">QTY Calculation</label>
            <input type="text" id="update_this_sub_qty_calc_equation" name="qty_calc_equation" value="<?php echo $qty_calc_equation; ?>" class="greyed-input input-width-140">
        </div>
        <div class="edit-form-wrapper no-border">
            <button type="button"
            class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-mint-border btn-modify font-size-13"
            onClick="open_modal_add_qty_calc_info_edit();">
            Instructions
            </button>
        </div>
        <div class="btn-wrapper-center">
            <button type="button" 
            	class="btn-default btn-bold btn-mint-border with-bottom-shadow"
                onClick="update_sub_qty_calc();">
            		Save
            </button>
            <p style="cursor:pointer" onclick="close_modal_edit_qty_calc();">Cancel</p>
        </div>
    </form>
</div>

