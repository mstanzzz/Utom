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
require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/util_functions.php");

$_SESSION['ret_modal'] = 'edit';

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$_SESSION['cleat_id'] = (isset($_GET['cleat_id'])) ? $_GET['cleat_id'] : 0;

if(!is_numeric($_SESSION['cleat_id'])){
	
	echo "not a number";	
	exit;	
}

$sql = "SELECT cleat_name
		,description
		,collection_id
		,part_type_id
		,qty_schema_id
		,price_schema_id
		,qty_calc_id
		FROM cabinetry_cleats
		WHERE cleat_id = '".$_SESSION['cleat_id']."'";
$result = $dbCustom->getResult($db,$sql);

if($result->num_rows > 0){
	$objet = $result->fetch_object();
	$cleat_name = $objet->cleat_name;
	$collection_id  = $objet->collection_id;
	$part_type_id  = $objet->part_type_id;
	$qty_schema_id  = $objet->qty_schema_id;
	$price_schema_id = $objet->price_schema_id;
	$qty_calc_id  = $objet->qty_calc_id;
	$description  = $objet->description; 
}else{
	exit;	
}





	$_SESSION['constructed_part_array'] = array();
	$_SESSION['fixed_part_array'] = array();
    
	$sql = "SELECT cabinetry_cleats_to_parts.part_id
					,cabinetry_cleats_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_cleats_to_parts
			WHERE parts.part_id = cabinetry_cleats_to_parts.part_id
			AND cabinetry_cleats_to_parts.is_fixed_part = '0'
			AND cabinetry_cleats_to_parts.cleat_id = '".$_SESSION['cleat_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['constructed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['constructed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['constructed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['constructed_part_array'][$i]['qty'] = $row->part_qty;	
		$i++;
	}

	$sql = "SELECT cabinetry_cleats_to_parts.part_id
					,cabinetry_cleats_to_parts.part_qty
					,parts.part_name
					,parts.part_type_id
			FROM parts, cabinetry_cleats_to_parts
			WHERE parts.part_id = cabinetry_cleats_to_parts.part_id
			AND cabinetry_cleats_to_parts.is_fixed_part = '1'
			AND cabinetry_cleats_to_parts.cleat_id = '".$_SESSION['cleat_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	$i = 0;
	while($row = $result->fetch_object()){
		$_SESSION['fixed_part_array'][$i]['part_id'] = $row->part_id;
		$_SESSION['fixed_part_array'][$i]['part_name'] = $row->part_name;
		$_SESSION['fixed_part_array'][$i]['part_type_id'] = $row->part_type_id;	
		$_SESSION['fixed_part_array'][$i]['qty'] = $row->part_qty;	
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
        
        
?>

<input type="hidden" name="cleat_id" value="<?php echo $_SESSION['cleat_id']; ?>" />
<div class="modal-tool-admin clearfix">
    <div class="clearfix">
        <div class="left-side">
            <p class="modal-tool-admin-title">Edit Cleat</p>
            <div class="plate-detail clearfix">
            <label class="modal-tool-admin-label">Cleat Name *</label>
            <input type="text" class="input-border-bottom input-italic" id="edit_sub_cleat_name" name="cleat_name" value="<?php echo $cleat_name;  ?>"/>
        </div>
        <div class="plate-detail clearfix cleat-name-label">
            <label class="modal-tool-admin-label ">Constructed Part</label>
	        <button  type="button" 
    	        class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-constructed-parts" 
            	onClick="open_modal_add_sub_cleat_constructed_part_edit();">
            		Add Constructed Part
            </button>
        </div>
<ul id="ajx_cleat_sub_part_list_edit">
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
            <button type="button" 
	            class="btn-default btn-small with-small-bottom-shadow btn-with-border btn-plate-detail add-catalog-parts" 
    	        onclick="open_modal_add_sub_cleat_fixed_part_edit();">
        		    Add Catalog Part
            </button>
        </div>

<ul id="ajx_cleat_sub_fixed_part_list_edit">
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
            <input type="text" class="input-border-bottom desc-input-1" id="edit_sub_cleat_descr_1" name="descr_1" value="<?php echo $descr_1; ?>" style="width:220px;"/>
            <input type="text" class="input-border-bottom desc-input-2" id="edit_sub_cleat_descr_2" name="descr_2" value="<?php echo $descr_2; ?>" style="width:346px;"/>
        </div> 
                        
        <div class="label-with-dropdown label-with-dropdown-separator clearfix">
	        <label>Collection</label>
                                <!--
                                <select multiple='multiple' name='collection_ids[]' size="1" onChange="expand_select(this,<?php echo count($collection_array); ?>)" 
                                class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                                -->
            <select id="edit_sub_cleat_collection_id" name='collection_id'
            class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown"> 
                <option value="0">Select</option>    
                <?php
                foreach($collection_array as $val){
                $sel = ($collection_id == $val['collection_id']) ? "selected" : '';
                echo "<option value='".$val['collection_id']."' $sel>".$val['collection_name']."</option>";								
                }
                ?>
            </select>
        </div>

        <div class="label-with-dropdown clearfix">
            <label>Part Type</label>
            <select id="edit_sub_cleat_part_type_id" name='part_type_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($part_type_array as $val){
                $sel = ($val['part_type_id'] == $part_type_id) ? "selected" : "";			
                echo "<option value='".$val['part_type_id']."' $sel>".$val['part_type_name_user']."</option>";								
                }
                ?>
            </select>
        </div>
	</div>

    <div class="right-side">
        <div class="label-with-dropdown label-with-dropdown-separator clearfix">
            <label>QTY Schema</label>
            <select id="edit_sub_cleat_qty_calc_id" name='qty_calc_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = ($val['qty_calc_id'] == $qty_calc_id) ? "selected" : "";			
                echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                }
                ?>
            </select>
        </div>

        <div class="label-with-dropdown label-with-dropdown-separator clearfix">
            <label>Price Schema ID</label>
            <select id="edit_sub_cleat_price_schema_id" name='price_schema_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($price_schema_array as $val){
                $sel = ($val['price_schema_id'] == $price_schema_id) ? "selected" : "";			
                echo "<option value='".$val['price_schema_id']."' $sel>".$val['price_schema_name']."</option>";								
                }
                ?>
            </select>
        </div>

        <div class="label-with-dropdown clearfix">
            <label>Quantity Calculations</label>
            <select id="edit_sub_cleat_qty_calc_id" name='qty_calc_id' class="btn-default btn-small text-capitalize with-small-bottom-shadow with-small-dropdown">             
                <option value="0">Select</option>    
                <?php
                foreach($qty_calc_array as $val){
                $sel = ($val['qty_calc_id'] == $qty_calc_id) ? "selected" : "";			
                echo "<option value='".$val['qty_calc_id']."' $sel>".$val['qty_calc_name']."</option>";								
                }
                ?>
            </select>
        </div>

	</div>
</div>

<div class="container-btn-bottom">
    <button type="button" 
    	class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border"
        onClick="update_sub_cleat(<?php echo $_SESSION['cleat_id']; ?>);">
    		Save
    </button>
    
    <button type="button" onclick="open_part_preview();" class="btn-default btn-bold text-capitalize with-bottom-shadow btn-with-border">
    Preview Part
    </button>
    <span class="modal-close" onclick="close_sub_edit_cleat();">Cancel</span>
</div>





