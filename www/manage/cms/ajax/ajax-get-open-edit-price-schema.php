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

$price_schema_id = isset($_GET['price_schema_id'])? $_GET['price_schema_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);

$sql =  sprintf("SELECT price_schema_name
					,schema_calc_method				
					,rounding_method
					,rounding_value	
				FROM price_schema
				WHERE price_schema_id = %u", $price_schema_id);
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){	
	$object = $result->fetch_object(); 	
	$price_schema_name = $object->price_schema_name;
	$schema_calc_method = $object->schema_calc_method;
	$rounding_method = $object->rounding_method;
	$rounding_value = $object->rounding_value;
}else{
	exit;
}


$sql =  sprintf("SELECT price_calc_param_id				
					,sort_order
				FROM price_sch_param_assoc
				WHERE price_schema_id = %u", $price_schema_id);
$result = $dbCustom->getResult($db,$sql);
$_SESSION['price_calc_params'] = array();
$i = 0;
while($row = $result->fetch_object()){
	$price_calc_param_name = getPriceCalcParamName($row->price_calc_param_id);
	$_SESSION['price_calc_params'][$i]['price_calc_param_id'] = $row->price_calc_param_id;
	$_SESSION['price_calc_params'][$i]['price_calc_param_name'] = $price_calc_param_name;
	$_SESSION['price_calc_params'][$i]['sort_order'] = $row->sort_order;
	$i++;
}


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



?>



    
    <h4 class="title">Edit pricing schema</h4>
    	<input type="hidden" id="update_this_sub_price_schema_id" name="price_schema_id" value="<?php echo $price_schema_id; ?>" />
        <div class="plate-detail name clearfix">
            <label class="modal-tool-admin-label text-italic">Pricing Schema Name</label>
            <input type="text" id="edit_sub_ps_price_schema_name" name="price_schema_name" value="<?php echo $price_schema_name; ?>" 
            class="input-border-bottom text-italic text-transform-unset greyed-input">
        </div>
        <div class="edit-form-wrapper no-border">
            <label class="text-italic">Calculation Method</label>
            <select id="edit_sub_ps_schema_calc_method" name="schema_calc_method" class="rounded-select">
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
            <input type="text" id="edit_sub_ps_rounding_value" name="rounding_value" value="<?php echo $rounding_value; ?>" class="greyed-input input-width-140">
        </div>
        
        <div class="edit-form-wrapper no-border" style="float:left; width:160px; height:60px;">
            <label class="text-italic">Rounding Method</label>
            <select id="edit_sub_ps_rounding_method" name="rounding_method" class="rounded-select">
                <option value="0">Select Options</option>
                <?php
                foreach($schema_rounding_array as $val){
                $sel = ($rounding_method == $val['schema_rounding_id'])? "selected" : '';
                echo "<option value='".$val['schema_rounding_id']."' $sel>".$val['schema_rounding_value']."</option>";	
                }
                ?>
            </select>
        
        </div>
        
        <div class="edit-form-wrapper no-border" style="float:left; width:160px; height:60px;">
        
            <label class="text-italic">Parameter</label>
            <button type="button" 
            class="btn-default btn-small text-capitalize with-bottom-shadow btn-with-border btn-mint-border btn-modify font-size-12"
            onclick="open_sub_edit_price_schema_param();">Add Parameter</button>
            
        </div>
        
        <div style="clear:both;"></div>
        
        <div id="param_list_sub_price_scema_edit" style="position:relative; top:-20px; width:100%;">
			<?php
            if(count($_SESSION['price_calc_params']) > 0){
				$block = '';
				$block .= "<table>";
				$block .= "<tr><td width='70%'>Param Name</td><td width:15%;>Sort</td><td width:15%;>Delete</td></tr>";
				foreach($_SESSION['price_calc_params'] as $v){	
					$block .= "<tr>";
					$block .= "<td>".stripslashes($v['price_calc_param_name'])."</td>";
					$block .= "<td>".$v['sort_order']."</td>";
					$block .= "<td><span style='cursor:pointer; color:red;' 
					onClick='delete_param_from_price_scema(1,".$v['price_calc_param_id'].")'>delete</span></td>";
					$block .= "</tr>";	
				}
				$block .= "</table>";
				echo $block;
            }
            ?>
		</div>       
        <div class="btn-wrapper-center">
            <button 
            class="btn-default btn-bold btn-mint-border with-bottom-shadow"
            onclick="update_sub_price_schema();">
            Save                                  
            </button>
            <p style="cursor:pointer" onclick="close_sub_price_edit_schema();">Cancel</p>
		</div>
