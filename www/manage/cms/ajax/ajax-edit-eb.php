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

$_SESSION['eb_id'] = (isset($_GET['eb_id'])) ? $_GET['eb_id'] : 0;

if(!is_numeric($_SESSION['eb_id'])){
	
	echo "not a number";	
	exit;	
}

function getCollectionsArray($eb_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT collection_id
			FROM collection_edgeband_assoc
			WHERE eb_id = '".$eb_id."'";
   	$result = $dbCustom->getResult($db,$sql);
	while($row = $result->fetch_object()){
		$ret[] = $row->collection_id; 
	}
	return $ret;
}


$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$_SESSION['eb_id'] = (isset($_GET['eb_id'])) ? $_GET['eb_id'] : 0; 
	
	$sql = "SELECT eb_name
				,finish_id
				,texture_id
				,brand_id
				,vendor_id
				,vend_prod_num
				,is_stocked
				,eb_roll_length
				,eb_thickness
				,eb_width
				,cost_per_roll
				,glue_cost
				,waste_allowance
				,markup
		FROM edge_banding
		WHERE eb_id = '".$_SESSION['eb_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
    	$object = $result->fetch_object();
		$eb_name = $object->eb_name;
		$finish_id = $object->finish_id;
		$texture_id = $object->texture_id;
		$brand_id = $object->brand_id;
		$vendor_id = $object->vendor_id;
		$vend_prod_num = $object->vend_prod_num;
		$is_stocked = $object->is_stocked;
		$eb_roll_length = $object->eb_roll_length;
		$eb_thickness = $object->eb_thickness;
		$eb_width = $object->eb_width;
		$cost_per_roll = $object->cost_per_roll;
		$glue_cost = $object->glue_cost;
		$waste_allowance = $object->waste_allowance;
		$markup = $object->markup;

	}else{			
		echo 'Does not exist';
		exit;	
	}
	
	//$_SESSION['temp_eb_fields']['collection_ids'] = getCollectionsArray($_SESSION['temp_eb_fields']['eb_id']);




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

<form action="edge-banding.php" method="post" enctype="multipart/form-data" onsubmit="return validate(this);">
<input type="hidden" name="eb_id" value="<?php echo $_SESSION['eb_id'] ?>" />          
<input type="hidden" name="update_eb" value="1" />        
<div class="modal-tool-admin modal-edit-edge clearfix">
	<div class="clearfix">
		<div class="left-side">
            <p class="modal-tool-admin-title">Edit Edge Banding Detail</p>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Edit Banding Name*</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_eb_name" name="eb_name" value="<?php echo $eb_name; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Vendor Product #</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_vend_prod_num" name="vend_prod_num" value="<?php echo $vend_prod_num; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Stocked</label>
                <label class="switch">
                <input type="checkbox" name="is_stocked" value="1" <?php if($is_stocked > 0) echo "checked"; ?> >
                <span class="switch-slider round"></span>
                </label>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Cost Per Roll</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_cost_per_roll" name="cost_per_roll" value="<?php echo $cost_per_roll; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Markup</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_markup" name="markup" value="<?php echo $markup; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Glue Cost</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_glue_cost" name="glue_cost" value="<?php echo $glue_cost; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Waste Allowance</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_waste_allowance" name="waste_allowance" value="<?php echo $waste_allowance; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Roll Lenght</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_eb_roll_length" name="eb_roll_length" value="<?php echo $eb_roll_length; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Thickness</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_eb_thickness" name="eb_thickness" value="<?php echo $eb_thickness; ?>"/>
            </div>
            <div class="clearfix edit-unit-detail-label">
                <label class="modal-tool-admin-label">Width</label>
                <input type="text" class="input-border-bottom modal-normal-input"
                id="edit_eb_width" name="eb_width" value="<?php echo $eb_width; ?>"/>
            </div>
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
                <td>
        	        <span class="text-with-border-bottom">Modify</span>
                </td>
            </tr>
            <tr>
                <td>
	                <span class="">Finish</span> 
                </td>
                <td>
                    <select id="edit_finish_id" name="finish_id" class="rounded-select">
                        <option value="0">Select Options</option>
                        <?php
                        foreach($finish_array as $val){
                        $sel = ($finish_id == $val['finish_id'])? "selected" : "";
                        echo "<option value='".$val['finish_id']."' $sel>".$val['finish_name']."</option>";	
                        }		
                        ?>
                    </select>
                </td>
                <td>
                    <button  type="button"
	                    onClick="open_modal_by_id('modify_finish');" 
    	                class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
        		            Finish
                    </button>
                </td>
            </tr>
            <tr>
                <td>
	                <span class="">Texture</span>
                </td>
                <td>
                    <select id="edit_texture_id" name="texture_id" class="rounded-select">
                        <option value="0">Select Options</option>
                        <?php
                        foreach($texture_array as $val){
                        $sel = ($texture_id == $val['texture_id'])? "selected" : "";
                        echo "<option value='".$val['texture_id']."' $sel>".$val['texture_name']."</option>";	
                        }		
                        ?>
                    </select>
                </td>
                <td>
                    <button  type="button"
	                    onClick="open_modal_by_id('modify_texture');" 
    	                class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
        		            Texture
                    </button>
                </td>
            </tr>
            <tr>
                <td>
	                <span class="">Brand</span>
                </td>
                <td>
                    <select id="edit_brand_id" name="brand_id" class="rounded-select">
                        <option value="0">Select Options</option>
                        <?php
                        foreach($brand_array as $val){
                        $sel = ($brand_id == $val['brand_id'])? "selected" : '';
                        echo "<option value='".$val['brand_id']."' $sel>".$val['name']."</option>";	
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <button  type="button"
	                    onClick="open_modal_by_id('modify_brand');" 
    	                class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
        		            Brands
                    </button>
                </td>
            </tr>
            <tr>
                <td>
	                <span class="">Vendor</span>
                </td>
                <td>
                    <select id="edit_vendor_id" name="vendor_id" class="rounded-select">
                        <option value="0">Select Options</option>
                        <?php
                        foreach($vend_man_array as $val){
                        $sel = ($vendor_id == $val['vend_man_id'])? "selected" : '';												
                        echo "<option value='".$val['vend_man_id']."' $sel>".$val['name']."</option>";	
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <button  type="button"
	                    onClick="open_modal_by_id('modify_vendor');" 
    	                class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-bold btn-italic btn-modify">
        		            Vendors
                    </button>
                </td>
            </tr>
            </table>
            <div class="container-btn-bottom">
                <button class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border">
	                Save
                </button>
                <a href="">Delete</a>
                <span class="modal-close" onClick="close_modal_edit();">Cancel</span>
            </div>
        </div>
	</div>
</div>
</form>
