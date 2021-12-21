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
require_once($real_root."/manage/admin-includes/util_functions.php");

$_SESSION['ret_modal'] = 'edit';

$backing_id = isset($_GET['backing_id'])? $_GET['backing_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT backing_name
					,description
					,collection_id
					,part_type_id
					,qty_calc_id
					,qty_schema_id
					,price_schema_id
		FROM cabinetry_backing
		WHERE backing_id = %u", $backing_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$backing_name = $object->backing_name;
	$description = $object->description;
	$collection_id = $object->collection_id;
	$part_type_id = $object->part_type_id;
	$qty_calc_id = $object->qty_calc_id;
	$qty_schema_id = $object->qty_schema_id;
	$price_schema_id = $object->price_schema_id;
}else{
	$backing_name = 'Required Field';
	$description = '';
	$collection_id = 0;
	$part_type_id = 0;
	$qty_calc_id = 0;
	$qty_schema_id = 0;
	$price_schema_id = 0;
}


	
	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
    
	$sql = "SELECT cabinetry_backing_to_parts.part_id
					,cabinetry_backing_to_parts.part_qty
					,parts.part_name
			FROM parts, cabinetry_backing_to_parts
			WHERE parts.part_id = cabinetry_backing_to_parts.part_id
			AND cabinetry_backing_to_parts.is_fixed_part = '0'
			AND cabinetry_backing_to_parts.backing_id = '".$backing_id."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['constructed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['constructed_part_array'][$i]['part_name'] = $row->part_name;	
		$_SESSION['constructed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}

	$sql = "SELECT cabinetry_backing_to_parts.part_id
					,cabinetry_backing_to_parts.part_qty
					,parts.part_name
			FROM parts, cabinetry_backing_to_parts 
			WHERE parts.part_id = cabinetry_backing_to_parts.part_id
			AND cabinetry_backing_to_parts.is_fixed_part = '1'
			AND cabinetry_backing_to_parts.backing_id = '".$backing_id."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['fixed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['fixed_part_array'][$i]['part_name'] = $row->part_name;	
		$_SESSION['fixed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}
	

$collection_array = array();

$sql = "SELECT collection_id 
			,collection_name	
		FROM collection
		WHERE saas_id = '".$_SESSION['profile_account_id']."'
		ORDER BY collection_name";
$result = $dbCustom->getResult($db,$sql);
$i=0;
while($row = $result->fetch_object()) {
	$collection_array[$i]['collection_id'] = $row->collection_id;
	$collection_array[$i]['collection_name'] = $row->collection_name;
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
        
?>

<input type="hidden" name="backing_id" value="<?php echo $backing_id; ?>" />
<div class="modal-tool-admin clearfix">
	<div class="clearfix">
		<div class="left-side">
			<p class="modal-tool-admin-title">Edit Backing</p>
            <div class="plate-detail clearfix">
                <label class="modal-tool-admin-label">Backing Name</label>
                <input type="text" class="input-border-bottom input-italic" id="edit_sub_backing_name" name="backing_name" value="<?php echo $backing_name; ?>" />
            </div>
            <div class="plate-detail clearfix">
                <label class="modal-tool-admin-label">Constructed Part</label>  
                <button type="button" 
                	class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail" 
                	onClick="open_modal_add_sub_backing_constructed_part_edit();">
                		Add Constructed Part
                </button>
            </div>
            <ul id="ajx_backing_sub_part_list_edit">
				<?php
                foreach($_SESSION['constructed_part_array'] as $key => $v){
                echo "<li>".stripslashes($v['part_name']);
                echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_constructed_part(".$v['part_id'].")'>delete</span></li>";
                }
                ?>
            </ul>
            <div class="plate-detail clearfix">
                <label class="modal-tool-admin-label">Catalog Part</label>
                <button type="button" 
                	class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail" 
                	onClick="open_modal_add_sub_backing_fixed_part_edit();">
                		Add Catalog Part
                </button>
            </div>
            <ul id="ajx_backing_sub_fixed_part_list_edit">
				<?php
                foreach($_SESSION['fixed_part_array'] as $key => $v){
                echo "<li>".stripslashes($v['part_name']);
                echo "<span style='margin-left:8px;'>QTY:</span>".$v['qty'];
                echo "<span style='margin-left:8px; cursor:pointer; color:red' onClick='remove_session_fixed_part(".$v['part_id'].")'>delete</span></li>";
                }
                ?>
            </ul>             
			<?php
            $descr_1 = substr($description,0,50);
            $descr_2 = substr($description,50);
            ?>
            <div class="plate-detail clearfix">
                <label class="modal-tool-admin-label">Description</label>
                <input type="text" class="input-border-bottom  desc-input-1" id="edit_sub_backing_descr_1" name="descr_1" value="<?php echo $descr_1;  ?>" style="width:340px;" />
                <input type="text" class="input-border-bottom  desc-input-2" id="edit_sub_backing_descr_2" name="descr_2" value="<?php echo $descr_2;  ?>" style="width:340px;"/>
            </div>
            <div class="label-with-dropdown clearfix">
                <label>Collection</label>
                <select id="edit_sub_backing_collection_id" name="collection_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="width:240px;">              
                    <option value="0">Select</option>    
                    <?php
                    foreach($collection_array as $val){
                    $sel = ($val['collection_id'] == $collection_id) ? 'selected' : '';			
                    echo "<option value='".$val['collection_id']."' $sel>".$val['collection_name']."</option>";								
                    }
                    ?>
                </select>
            </div>
            <div class="label-with-dropdown clearfix">
                <label>Part Type</label>       
                <select id="edit_sub_backing_part_type_id" name="part_type_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="width:240px;">              
                    <option value="0">Select</option>    
                    <?php
                    foreach($part_type_array as $val){
                    $sel = ($val['part_type_id'] == $part_type_id) ? 'selected' : '';			
                    echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                    }
                    ?>
                </select>
            </div>
		</div>
		<div class="right-side">
            <div class="label-with-dropdown clearfix">
                <label>QTY Schema</label>
                <select id="edit_sub_backing_qty_schema_id" name="qty_schema_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="width:240px;">              
                    <option value="0">Select</option>    
                    <?php
                    foreach($qty_schema_array as $val){
                    $sel = ($val['qty_schema_id'] == $qty_schema_id) ? 'selected' : '';			
                    echo "<option value='".$val['qty_schema_id']."' $sel>".$val['qty_schema_name']."</option>";								
                    }
                    ?>
                </select>
            </div>
           <div class="label-with-dropdown clearfix">
                <label>Price Schema ID</label>
                <select id="edit_sub_backing_price_schema_id" name="price_schema_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="width:240px;">
                    <option value="0">Select</option>    
                    <?php
                    foreach($price_schema_array as $val){
                    $sel = ($val['price_schema_id'] == $price_schema_id) ? 'selected' : '';			
                    echo "<option value='".$val['price_schema_id']."' $sel>".$val['price_schema_name']."</option>";								
                    }
                    ?>
                </select>
            </div>
            <div class="label-with-dropdown clearfix">
                <label>QTY Calculation</label>
                <select id="edit_sub_backing_qty_calc_id" name="qty_calc_id" 
                class="btn-default btn-small with-small-bottom-shadow with-small-dropdown" style="width:240px;">              
                    <option value="0">Select</option>    
                    <?php
                    foreach($qty_calc_array as $val){
                    $sel = ($val['qty_calc_id'] == $qty_calc_id) ? 'selected' : '';			
                    echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                    }
                    ?>
                </select>
            </div>
		</div>
	</div>
    <div class="container-btn-bottom">
        <button 
            class="btn-default btn-bold with-bottom-shadow btn-with-border"
            onClick="update_sub_backing(<?php echo $backing_id; ?>);">
                Save
        </button>
        <button type="button" onclick="open_part_preview();" class="btn-default btn-bold with-bottom-shadow btn-with-border">
            Preview Part
        </button>
        <span class="modal-close" onClick="close_sub_edit_backing();">Cancel</span>
    </div>
</div>





