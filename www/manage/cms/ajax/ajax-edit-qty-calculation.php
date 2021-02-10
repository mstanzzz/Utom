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

$_SESSION['qty_calc_id'] = isset($_GET['qty_calc_id'])? $_GET['qty_calc_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql =  sprintf("SELECT qty_calc_name						
					,qty_calc_equation
		FROM qty_calc_equations
		WHERE qty_calc_id = %u", $_SESSION['qty_calc_id']);
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
    <form action="qty-calculation.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
        <input type="hidden" name="update_qty_calc_equation" value="1" />
        <input type="hidden" name="qty_calc_id" value="<?php echo $_SESSION['qty_calc_id']; ?>" />
        <div class="plate-detail parameter-name clearfix">
            <label class="modal-tool-admin-label text-italic">QTY Calculation Name</label>
            <input type="text" id="edit_qty_calc_name" name="qty_calc_name" value="<?php echo $qty_calc_name; ?>"
            class="input-border-bottom  full-width  text-italic text-transform-unset greyed-input">
        </div>
        <div class="edit-form-wrapper no-border">
            <label class="text-italic">QTY Calculation</label>
            <input type="text" id="edit_qty_calc_equation" name="qty_calc_equation" value="<?php echo $qty_calc_equation; ?>" class="greyed-input input-width-140">
        </div>
        <div class="edit-form-wrapper no-border">
            <button type="button"
            class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-mint-border btn-modify font-size-13"
            onClick="open_modal_add_qty_calc_info_edit();">
            Instructions
            </button>
        </div>
        <div class="btn-wrapper-center">
            <button class="btn-default btn-bold btn-mint-border with-bottom-shadow ">
            Save
            </button>
            <p style="cursor:pointer" onclick="close_modal_edit_qty_calc();">Cancel</p>
        </div>
    </form>
</div>


                    <div id="modal_add_qty_calc_info_edit" class="information-box"
                    	style="visibility:hidden; position:absolute; left:64%; top:-160px; z-index:22;">
                        
                        <p class="text-italic small-text text-bold">Instructions</p>
                        <p class="small-text">
                            An admin can write a regular quation string using variable names that refer to properties on the respective
                            objects. The allowable variable names currently are:
                        </p>
                        <div class="left-side">
                            <ul class="left-list">
                                <li class="font-size-12 text-bold">Width</li>
                                <li class="font-size-12 text-bold">Height</li>
                                <li class="font-size-12 text-bold">Count</li>
                            </ul>
                            <button 
                            	class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-modify font-size-13"
                                onclick="close_modal_add_qty_calc_info_edit();">
                                Close
                            </button>
                        </div>
                        <div class="right-side">
                            <p class="font-size-12">
                                <span class="text-italic text-bold font-size-12">Examples:</span> <br>
                                Adjustable Shelf Pins:<br>
                                EQ: "Count"
                            </p>
                            <p class="font-size-12">
                                Adjustable Shelf Panel: <br>
                                EQ: "width*depth"
                            </p>
                            <p class="font-size-12">
                                Edge Banding: <br>
                                EQ: "2*depth + height"
                            </p>
                        </div>
                    </div>
