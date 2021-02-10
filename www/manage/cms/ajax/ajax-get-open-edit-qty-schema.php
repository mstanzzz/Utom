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

$qty_schema_id = isset($_GET['qty_schema_id'])? $_GET['qty_schema_id'] : 0;

function getParamsArray($qty_schema_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
	
	$sql = "SELECT qty_sch_param_assoc.qty_calc_param_id
				,qty_sch_param_assoc.sort_order
				,qty_calc_param.qty_calc_param_name	
			FROM qty_sch_param_assoc, qty_calc_param
			WHERE qty_sch_param_assoc.qty_calc_param_id = qty_calc_param.qty_calc_param_id  
			AND qty_sch_param_assoc.qty_schema_id = '".$qty_schema_id."'
			ORDER BY qty_sch_param_assoc.sort_order";
   	$result = $dbCustom->getResult($db,$sql);
	
	$i = 0;
	while($row = $result->fetch_object()){
		
		$ret[$i]['qty_calc_param_id'] = $row->qty_calc_param_id;
		$ret[$i]['qty_calc_param_name'] = $row->qty_calc_param_name;
		$ret[$i]['sort_order'] = $row->sort_order;
		
		$i++;
	}
	return $ret;
}

$_SESSION['qty_calc_params'] = getParamsArray($qty_schema_id);

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

	$sql = "SELECT qty_schema_name
				,schema_calc_method			
				,rounding_method
				,rounding_value
		FROM qty_schema
		WHERE qty_schema_id = '".$qty_schema_id."'";
    $result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
       	$object = $result->fetch_object();
						
		$qty_schema_name = $object->qty_schema_name;
		$schema_calc_method = $object->schema_calc_method;	
		$rounding_method = $object->rounding_method;	
		$rounding_val = $object->rounding_value;	
					
	}else{		
		echo 'Does not exist';
		exit;	
	}



//schema_calc_method
$sql = "SELECT schema_calc_method_id ,schema_calc_method_value	
		FROM schema_calc_method
		ORDER BY schema_calc_method_value";
$result = $dbCustom->getResult($db,$sql);
$schema_calc_method_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$schema_calc_method_array[$i]['schema_calc_method_id'] = $row->schema_calc_method_id;					
	$schema_calc_method_array[$i]['schema_calc_method_value'] = $row->schema_calc_method_value;
	$i++;
}


//rounding_method
$sql = "SELECT schema_rounding_id ,schema_rounding_value	
		FROM schema_rounding
		ORDER BY schema_rounding_value";
$result = $dbCustom->getResult($db,$sql);
		
$schema_rounding_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$schema_rounding_array[$i]['schema_rounding_id'] = $row->schema_rounding_id;					
	$schema_rounding_array[$i]['schema_rounding_value'] = $row->schema_rounding_value;
	$i++;
}


// params
$sql = "SELECT qty_calc_param_id	
			,qty_calc_param_name		
		FROM qty_calc_param 
		WHERE saas_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
$qty_calc_param_array = array();
$i = 0;
while($row = $result->fetch_object()){
	$qty_calc_param_array[$i]['qty_calc_param_id'] = $row->qty_calc_param_id;					
	$qty_calc_param_array[$i]['qty_calc_param_name'] = $row->qty_calc_param_name;
	$i++;
}

?>

<h4 class="title">Edit QTY schema</h4>

<input type="hidden" id="update_this_sub_qty_schema_id" name="qty_schema_id" value="<?php echo $qty_schema_id; ?>" />

<div class="plate-detail name clearfix">
    <label class="modal-tool-admin-label text-italic">QTY Schema Name</label>
    <input type="text" id="edit_sub_qs_qty_schema_name" name="qty_schema_name" value="<?php echo $qty_schema_name; ?>" 
    class="input-border-bottom text-italic text-transform-unset greyed-input">
</div>

<div class="edit-form-wrapper no-border">
    <label class="text-italic">Calculation Method</label>
    <select id="edit_sub_qs_schema_calc_method" name="schema_calc_method" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($schema_calc_method_array as $val){
        $sel = ($schema_calc_method == $val['schema_calc_method_id'])? "selected" : '';
        echo "<option value='".$val['schema_calc_method_id']."' $sel>".$val['schema_calc_method_value']."</option>";	
        }
        ?>   
    </select>
</div>

<div class="edit-form-wrapper no-border">
    <label class="text-italic">Rounding Price</label>
    <input type="text" id="edit_sub_qs_rounding_value" name="rounding_value" class="greyed-input input-width-140">
</div>

<div class="edit-form-wrapper no-border">
    <label class="text-italic">Rounding Method</label>
    <select id="edit_sub_qs_rounding_method" name="rounding_method" class="rounded-select">
        <option value="0">Select Options</option>
        <?php
        foreach($schema_rounding_array as $val){
        $sel = ($rounding_method == $val['schema_rounding_id'])? "selected" : '';
        echo "<option value='".$val['schema_rounding_id']."' $sel>".$val['schema_rounding_value']."</option>";	
        }
        ?>   
    </select>
</div>

<div class="edit-form-wrapper no-border">
    <label class="text-italic">Parameter</label>
    <button type="button" 
    class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-mint-border btn-modify font-size-12"
    onClick="open_sub_add_qty_schema_param_edit();">Add new parameter</button>
</div>

<div id="param_list_sub_qty_schema_edit" style="position:relative; top:-20px; width:100%;">
<?php
if(count($_SESSION['qty_calc_params']) > 0){
	$block = '';
	$block .= "<table>";
	$block .= "<tr><td width='70%'>Param Name</td><td width:15%;>Sort</td><td width:15%;>Delete</td></tr>";
	foreach($_SESSION['qty_calc_params'] as $v){	
		$block .= "<tr>";
		$block .= "<td>".stripslashes($v['qty_calc_param_name'])."</td>";
		$block .= "<td>".$v['sort_order']."</td>";
		$block .= "<td><span style='cursor:pointer; color:red;' onClick='delete_param_from_sub_qty_scema(1,".$v['qty_calc_param_id'].")'>delete</span></td>";		
		$block .= "</tr>";	
	}
	$block .= "</table>";
	echo $block;
}
?>
</div>       
                            
<div class="btn-wrapper-center">
    <button
    class="btn-default btn-bold btn-mint-border with-bottom-shadow "
    onClick="update_sub_qty_schema();">
    Save
    </button>
	<p style="cursor:pointer" onclick="close_edit_sub_qty_schema();">Cancel</p>
</div>

                    
